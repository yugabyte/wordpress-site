<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * iubenda_List_Table_Forms class.
 *
 * @class iubenda_List_Table_Forms
 */
class iubenda_List_Table_Forms extends WP_List_Table {
	
	public $items;
	public $extra_items;
	public $base_url;
	
	/**
	 * Class constructor.
	 */
	public function __construct() {
		global $status, $page;

		// set parent defaults
		parent::__construct( array(
			'ajax' => false
		) );

		$this->base_url = esc_url_raw( add_query_arg( array( 'tab' => 'cons' ), iubenda()->base_url ) );
	}
	
	
	
	/**
	 * Prepare the items for the table to process.
	 */
	public function prepare_items() {
		if ( ! empty( $_GET['status'] ) && array_key_exists( $_GET['status'], iubenda()->forms->statuses ) )
			$status = $_GET['status'];
		else
			$status = '';

		$orderby = ( isset( $_GET['orderby'] ) ) ? esc_attr( $_GET['orderby'] ) : 'date';
		$order = ( isset( $_GET['order'] ) ) && in_array( $_GET['order'], array( 'asc', 'desc' ) ) ? esc_attr( $_GET['order'] ) : 'desc';

		$per_page = 20;
		
		if ( isset( $_GET['number'] ) ) {
			$number = (int) $_GET['number'];
		} else {
			$number = $per_page + min( 8, $per_page ); // grab a few extra
		}
		$page = $this->get_pagenum();

		$args = array(
			'orderby'		=> $orderby,
			'order'			=> $order,
			'offset'		=> 0,
			'number'		=> 0,
			'post_status'	=> $status
		);

		$items = iubenda()->forms->get_forms( $args );

		// echo '<pre>'; print_r( $items ); echo '</pre>';

		if ( is_array( $items ) ) {
			$this->items = array_slice( $items, 0, $per_page );
			$this->extra_items = array_slice( $items, $per_page );
		}

		// echo '<pre>'; print_r( $this->extra_items ); echo '</pre>';

		$this->set_pagination_args( array(
			'total_items'	 => count( $items ),
			'per_page'		 => $per_page,
		) );

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
	}
	
	/**
	 * Override the parent columns method. Defines the columns to use in your listing table.
	 * 
	 * @return array
	 */
	public function get_columns() {
		$columns = array(
			'cb'			=> '<input type="checkbox"/>',
			'title'			=> __( 'Form Title', 'iubenda' ),
			'ID'			=> __( 'Form ID', 'iubenda' ),
			'source'		=> __( 'Form Source', 'iubenda' ),
			'fields'		=> __( 'Fields', 'iubenda' ),
			'date'			=> __( 'Date', 'iubenda' ),
		);

		return $columns;
	}
	
	/**
	 * Define the sortable columns.
	 * 
	 * @return array
	 */
	public function get_sortable_columns() {
		$columns = array(
			'title'			=> array( 'name', true )
		);
		return $columns;
	}
	
	/**
	 * Handle single row content.
	 *
	 * @param array $item
	 * @return mixed
	 */
	public function single_row( $item ) {
		$classes = array();
		$classes[] = 'item-' . $item->ID;
		?>
		<tr id="item-<?php echo $item->ID; ?>" class="<?php echo implode( ' ', $classes ); ?>">
			<?php $this->single_row_columns( $item ); ?>
		</tr>
		<?php
	}
	
	/**
	 * Get the name of the default primary column.
	 *
	 * @return string Name of the default primary column, in this case, 'title'.
	 */
	public function get_default_primary_column_name() {
		return 'title';
	}
	
	/**
	 * Generate and display row actions links.
	 *
	 * @param object $item
	 * @param string $column_name
	 * @param string $primary
	 * @return string|void
	 */
	public function handle_row_actions( $item, $column_name, $primary ) {
		if ( $column_name !== 'title' ) {
			return '';
		}

		$output = '';

		$del_nonce = esc_html( '_wpnonce=' . wp_create_nonce( "delete-form_{$item->ID}" ) );
		$url = add_query_arg( array( 'form_id' => $item->ID ), $this->base_url );
		$edit_url = add_query_arg( array( 'action' => 'edit' ), $url );
		$delete_url = add_query_arg( array( 'action' => 'delete' ), $url ) . "&$del_nonce";

		// preorder it: View | Approve | Unapprove | Delete
		$actions = array(
			'view'	 => '',
			'delete' => ''
		);

		$actions['view'] = "<a href='$edit_url' aria-label='" . esc_attr__( 'Edit this form', 'iubenda' ) . "'>" . __( 'Edit' ) . '</a>';
		$actions['delete'] = "<a href='$delete_url' aria-label='" . esc_attr__( 'Delete this form', 'iubenda' ) . "'>" . __( 'Delete', 'iubenda' ) . '</a>';

		$i = 0;
		$output .= '<div class="row-actions">';
		foreach ( $actions as $action => $link ) {
			++ $i;
			$sep = ( 1 === $i ) ? $sep = '' : $sep = ' | ';
			$output .= '<span class="' . ( $action === 'delete' ? 'delete delete-form' : $action ) . '">' . $sep . $link . '</span>';
		}
		$output .= '</div>';

		return $output;
	}
	
	/**
	 * Define what data to show on each column of the table.
	 * 
	 * @param array $item
	 * @param string $column_name
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		$output = '';
		
		if ( ! empty( $_GET['status'] ) && array_key_exists( $_GET['status'], iubenda()->forms->statuses ) )
			$status = $_GET['status'];
		else
			$status = '';
		
		// print_r( $item ); 
		
		// get columns content
		switch ( $column_name ) {
			case 'ID':
				$output = $item->ID;
				break;
			case 'title':
				$output = '<strong>' . ( current_user_can( 'edit_post', $item->ID ) ? '<a href="' . esc_url_raw( add_query_arg( array( 'form_id' => $item->ID, 'action' => 'edit' ), $this->base_url ) ) . '">' . $item->post_title . '</a>' : $item->post_title );
				
				if ( ! $status ) {
					if ( in_array( $item->post_status, array( 'publish', 'needs_update' ) ) ) {
						$output .= ' &mdash; ';
						$output .= '<span class="post-state to-map-state">' . iubenda()->forms->statuses[$item->post_status] . '</span>';
					}
				}
				
				$output .= '</strong>';
				
				break;
			case 'source':
				$output = array_key_exists( $item->form_source, iubenda()->forms->sources ) ? iubenda()->forms->sources[$item->form_source] : '&#8212;';
				break;
			case 'fields':
				$output = count( $item->form_fields );
				break;
			case 'date':
				$output = date_i18n( $item->post_date );
				break;
			default:
				break;
		}
		
		return $output;
	}
	
	/**
	 * Display checkboxex callback.
	 * 
	 * @return string
	 */
	public function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />', 'form', $item->ID
		);
	}
	
	/**
	 * Generate the table navigation above or below the table
	 *
	 * @since 3.1.0
	 * @param string $which
	 */
	protected function display_tablenav( $which ) {
		?>
		<div class="tablenav <?php echo esc_attr( $which ); ?>">
			<?php
			// $this->extra_tablenav( $which );
			$this->pagination( $which );
			?>

			<br class="clear" />
		</div>
		<?php
	}
	
	/**
	 * @param string $which
	 */
	protected function extra_tablenav( $which ) {
		?>
		<div class="alignleft actions">
		<?php
		if ( 'top' === $which ) {
			ob_start();

			$this->sources_dropdown();

			$output = ob_get_clean();

			if ( ! empty( $output ) ) {
				echo $output;
				submit_button( __( 'Filter' ), '', 'filter_action', false, array( 'id' => 'post-query-submit' ) );
			}
		}
		?>
		</div>
		<?php
	}
	
	/**
	 * Displays a sources drop-down for filtering on the list table.
	 * 
	 * @return mixed
	 */
	protected function sources_dropdown() {
		if ( ! empty( iubenda()->forms->sources ) ) {
			$current = ! empty( $_GET['source'] ) && in_array( $_GET['source'], iubenda()->forms->sources ) ? esc_attr( $_GET['source'] ) : '';
			echo '
				<label class="screen-reader-text" for="cat">' . __( 'Filter by source', 'iubenda' ) . '</label>
				<select name="source" id="filter-by-source">
					<option ' . selected( '', $current, false ) . 'value="">' . __( 'All form sources', 'iubenda' ) . '</option>';
			foreach ( iubenda()->forms->sources as $key => $label ) {
				echo '
					<option ' . selected( $key, $current, false ) . 'value="' . $key . '">' . $label . '</option>';
			}

			echo '</select>';
		}
	}
	
	/**
	 * Display views.
	 * 
	 * @return array
	 */
	public function get_views() {
		if ( ! empty( $_GET['status'] ) && array_key_exists( $_GET['status'], iubenda()->forms->statuses ) )
			$status = $_GET['status'];
		else
			$status = '';
		
		$orderby = ( isset( $_GET['orderby'] ) ) ? esc_attr( $_GET['orderby'] ) : '';
		$order = ( isset( $_GET['order'] ) ) ? esc_attr( $_GET['order'] ) : '';

		$per_page = 20;
		
		if ( isset( $_GET['number'] ) ) {
			$number = (int) $_GET['number'];
		} else {
			$number = $per_page + min( 8, $per_page ); // grab a few extra
		}
		$page = $this->get_pagenum();
		$items_total = 0;
		
		$args = array(
			'orderby'		=> $orderby,
			'order'			=> $order,
			'offset'		=> 0,
			'number'		=> 0
		);
		
		foreach ( iubenda()->forms->statuses as $key => $view ) {
			$args['post_status'] = $key;
			
			$items = iubenda()->forms->get_forms( $args );

			$items_count[$key] = count( $items );
			$items_total = $items_total + $items_count[$key];
		}

		$views = $items_total > 0 ? array(
			'all' => '<a href="' . $this->base_url . '"' . ($status === '' ? ' class="current"' : '') . '>' . esc_html__( 'All' ) . ' <span class="count">(' . $items_total . ')</span></a>'
		) : '';
		
		foreach ( iubenda()->forms->statuses as $key => $view ) {
			if ( (int) $items_count[$key] > 0 )
				$views[$key] = '<a href="' . esc_url_raw( add_query_arg( array( 'status' => $key ), $this->base_url ) ) . '" ' . ($status === $key ? ' class="current"' : '') . '>' . sprintf( _n( '%1$s <span class="count">(%2$s)</span>', '%1$s <span class="count">(%2$s)</span>', $items_count[$key], 'iubenda' ), $view, $items_count[$key] ) . '</a>';
		}

		return $views;
	}
	
	/**
	 * Display empty result.
	 * 
	 * @return string
	 */
	public function no_items() {
		echo __( 'No forms found.', 'iubenda' );
	}

}