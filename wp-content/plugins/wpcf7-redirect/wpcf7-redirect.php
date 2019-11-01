<?php
/**
 * Plugin Name:  Contact Form 7 Redirection
 * Plugin URI:   http://querysol.com/blog/product/contact-form-7-redirection/
 * Description:  Contact Form 7 Add-on - Redirect after mail sent.
 * Version:      1.2.9
 * Author:       Query Solutions
 * Author URI:   http://querysol.com
 * Contributors: querysolutions, yuvalsabar
 * Requires at least: 4.7.0
 *
 * Text Domain: wpcf7-redirect
 * Domain Path: /lang
 *
 * @package Contact Form 7 Redirection
 * @category Contact Form 7 Addon
 * @author Query Solutions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main WPCF7_Redirect Class
 */
class WPCF7_Redirect {
	/**
	 * Construct class
	 */
	public function __construct() {
		$this->plugin_url       = plugin_dir_url( __FILE__ );
		$this->plugin_path      = plugin_dir_path( __FILE__ );
		$this->version          = '1.2.9';
		$this->add_actions();
	}

	/**
	 * Add Actions
	 */
	private function add_actions() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );
		add_action( 'wpcf7_editor_panels', array( $this, 'add_panel' ) );
		add_action( 'wpcf7_after_save', array( $this, 'store_meta' ) );
		add_action( 'wpcf7_after_create', array( $this, 'duplicate_form_support' ) );
		add_action( 'wpcf7_submit', array( $this, 'non_ajax_redirection' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'wpcf7-redirect', false, basename( dirname( __FILE__ ) ) . '/lang' );
	}

	/**
	 * Enqueue theme styles and scripts - back-end
	 */
	public function enqueue_backend() {
		wp_enqueue_style( 'wpcf7-redirect-admin-style', $this->plugin_url . 'admin/wpcf7-redirect-admin-style.css' );
		wp_enqueue_script( 'wpcf7-redirect-admin-script', $this->plugin_url . 'admin/wpcf7-redirect-admin-script.js', array(), null, true );
	}

	/**
	 * Enqueue theme styles and scripts - front-end
	 */
	public function enqueue_frontend() {
		wp_enqueue_script( 'wpcf7-redirect-script', $this->plugin_url . 'js/wpcf7-redirect-script.js', array(), null, true );
		wp_localize_script( 'wpcf7-redirect-script', 'wpcf7_redirect_forms', $this->get_forms() );

		if ( isset( $this->enqueue_new_tab_script ) && $this->enqueue_new_tab_script ){
			wp_add_inline_script( 'wpcf7-redirect-script', 'window.open("'. $this->redirect_url .'");' );
		}
	}

	/**
	 * Adds a tab to the editor on the form edit page
	 *
	 * @param array $panels An array of panels. Each panel has a callback function.
	 */
	public function add_panel( $panels ) {
		$panels['redirect-panel'] = array(
			'title'     => __( 'Redirect Settings', 'wpcf7-redirect' ),
			'callback'  => array( $this, 'create_panel_inputs' ),
		);
		return $panels;
	}

	/**
	 * Create plugin fields
	 *
	 * @return array of plugin fields: name and type (type is for validation)
	 */
	public function get_plugin_fields() {
		$fields = array(
			array(
				'name' => 'page_id',
				'type' => 'number',
			),
			array(
				'name' => 'external_url',
				'type' => 'url',
			),
			array(
				'name' => 'use_external_url',
				'type' => 'checkbox',
			),
			array(
				'name' => 'open_in_new_tab',
				'type' => 'checkbox',
			),
			array(
				'name' => 'http_build_query',
				'type' => 'checkbox',
			),
			array(
				'name' => 'http_build_query_selectively',
				'type' => 'checkbox',
			),
			array(
				'name' => 'http_build_query_selectively_fields',
				'type' => 'text',
			),
			array(
				'name' => 'after_sent_script',
				'type' => 'textarea',
			),
		);

		return $fields;
	}

	/**
	 * Get all fields values
	 *
	 * @param integer $post_id Form ID.
	 * @return array of fields values keyed by fields name
	 */
	public function get_fields_values( $post_id ) {
		$fields = $this->get_plugin_fields();

		foreach ( $fields as $field ) {
			$values[ $field['name'] ] = get_post_meta( $post_id, '_wpcf7_redirect_' . $field['name'] , true );
		}

		return $values;
	}

	/**
	 * Validate and store meta data
	 *
	 * @param object $contact_form WPCF7_ContactForm Object - All data that is related to the form.
	 */
	public function store_meta( $contact_form ) {
		if ( ! isset( $_POST ) || empty( $_POST ) ) {
			return;
		} else {
			if ( ! wp_verify_nonce( $_POST['wpcf7_redirect_page_metaboxes_nonce'], 'wpcf7_redirect_page_metaboxes' ) ) {
				return;
			}

			$form_id        = $contact_form->id();
			$fields         = $this->get_plugin_fields( $form_id );
			$data           = $_POST['wpcf7-redirect'];

			foreach ( $fields as $field ) {
				$value = isset( $data[ $field['name'] ] ) ? $data[ $field['name'] ] : '';

				switch ( $field['type'] ) {
					case 'text':
					case 'checkbox':
						$value = sanitize_text_field( $value );
						break;

					case 'textarea':
						$value = htmlspecialchars( $value );
						break;

					case 'number':
						$value = intval( $value );
						break;

					case 'url':
						$value = esc_url_raw( $value );
						break;
				}

				update_post_meta( $form_id, '_wpcf7_redirect_' . $field['name'], $value );
			}
		}
	}

	/**
	 * Push all forms redirect settings data into an array.
	 * @return array  Form redirect settings data
	 */
	public function get_forms() {
		$args = array(
			'post_type' => 'wpcf7_contact_form',
			'posts_per_page' => -1,
			'suppress_filters' => true
		);
		$query = new WP_Query( $args );

		$forms = array();
		
		if ( $query->have_posts() ) :

			$fields = $this->get_plugin_fields();

			while ( $query->have_posts() ) : $query->the_post();

				$post_id = get_the_ID();

				foreach ( $fields as $field ) {
					$forms[ $post_id ][ $field['name'] ] = get_post_meta( $post_id, '_wpcf7_redirect_' . $field['name'], true );

					if ( $field['type'] == 'textarea' ) {
						$forms[ $post_id ][ $field['name'] ] = $forms[ $post_id ][ $field['name'] ];
					}
				}

				// Thank you page URL is a little bit different...
				$forms[ $post_id ]['thankyou_page_url'] = $forms[ $post_id ]['page_id'] ? get_permalink( $forms[ $post_id ]['page_id'] ) : '';
			endwhile;
			wp_reset_postdata();
		endif;

		return $forms;
	}

	/**
	 * Copy Redirect page key and assign it to duplicate form
	 *
	 * @param object $contact_form WPCF7_ContactForm Object - All data that is related to the form.
	 */
	public function duplicate_form_support( $contact_form ) {
		$contact_form_id = $contact_form->id();

		if ( ! empty( $_REQUEST['post'] ) && ! empty( $_REQUEST['_wpnonce'] ) ) {
			$post_id = intval( $_REQUEST['post'] );

			$fields = $this->get_plugin_fields();

			foreach ( $fields as $field ) {
				update_post_meta( $contact_form_id, '_wpcf7_redirect_' . $field['name'], get_post_meta( $post_id, '_wpcf7_redirect_' . $field['name'], true ) );
			}
		}
	}

	/**
	 * Verify CF7 dependencies.
	 */
	public function admin_notice() {
		if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
			$wpcf7_path = plugin_dir_path( dirname( __FILE__ ) ) . 'contact-form-7/wp-contact-form-7.php';
			$wpcf7_data = get_plugin_data( $wpcf7_path, false, false );

			// If CF7 version is < 4.8.
			if ( $wpcf7_data['Version'] < 4.8 ) {
				?>

				<div class="wpcf7-redirect-error error notice">
					<h3>
						<?php esc_html_e( 'Contact Form Redirection', 'wpcf7-redirect' );?>
					</h3>
					<p>
						<?php esc_html_e( 'Error: Contact Form 7 version is too old. Contact Form Redirection is compatible from version 4.8 and above. Please update Contact Form 7.', 'wpcf7-redirect' );?>
					</p>
				</div>

				<?php
			}
		} else {
			// If CF7 isn't installed and activated, throw an error.
			?>
			<div class="wpcf7-redirect-error error notice">
				<h3>
					<?php esc_html_e( 'Contact Form Redirection', 'wpcf7-redirect' );?>
				</h3>
				<p>
					<?php esc_html_e( 'Error: Please install and activate Contact Form 7.', 'wpcf7-redirect' );?>
				</p>
			</div>

			<?php
		}
	}

	/**
	 * Add plugin support to browsers that don't support ajax 
	 */
	public function non_ajax_redirection( $contact_form ) {
		$this->fields = $this->get_fields_values( $contact_form->id() );

		if ( isset( $this->fields ) && ! WPCF7_Submission::is_restful() ) {
			$submission   = WPCF7_Submission::get_instance();

			if ( $submission->get_status() == 'mail_sent' ) {

				// Use extrnal url
				if ( $this->fields['external_url'] && $this->fields['use_external_url'] == 'on' ) {
					$this->redirect_url = $this->fields['external_url'];
				} else {
					$this->redirect_url = get_permalink( $this->fields['page_id'] );
				}

				// Pass all fields from the form as URL query parameters
				if ( isset( $this->redirect_url ) && $this->redirect_url ) {	
					if ( $this->fields['http_build_query'] == 'on' ) {
						$posted_data  = $submission->get_posted_data();
						// Remove WPCF7 keys from posted data
						$remove_keys  = array( '_wpcf7', '_wpcf7_version', '_wpcf7_locale', '_wpcf7_unit_tag', '_wpcf7_container_post' );
						$posted_data  = array_diff_key( $posted_data, array_flip( $remove_keys ) );
						$this->redirect_url = add_query_arg( $posted_data, $this->redirect_url );
					}
				}

				// Open link in a new tab
				if ( isset( $this->redirect_url ) && $this->redirect_url ) {
					if ( $this->fields['open_in_new_tab'] == 'on' ) {
						$this->enqueue_new_tab_script = true;
					} else {
						wp_redirect( $this->redirect_url );
						exit;
					}
				}
			}
		}
	}

	/**
	 * Create the panel inputs
	 *
	 * @param  object $post Post object.
	 */
	public function create_panel_inputs( $post ) {
		wp_nonce_field( 'wpcf7_redirect_page_metaboxes', 'wpcf7_redirect_page_metaboxes_nonce' );

		$fields = $this->get_fields_values( $post->id() );
		?>

		<h2>
			<?php esc_html_e( 'Redirect Settings', 'wpcf7-redirect' );?>
		</h2>

		<fieldset>
			<div class="field-wrap field-wrap-page-id">
				<label for="wpcf7-redirect-page-id">
					<?php esc_html_e( 'Select a page to redirect to on successful form submission.', 'wpcf7-redirect' );?>   
				</label>
				<?php
				echo wp_dropdown_pages( array(
						'echo'              => 0,
						'name'              => 'wpcf7-redirect[page_id]',
						'show_option_none'  => __( 'Choose Page', 'wpcf7-redirect' ),
						'option_none_value' => '0',
						'selected'          => $fields['page_id'],
						'id'                => 'wpcf7-redirect-page-id',
					)
				);
			?>        
		</div>

		<div class="field-wrap field-wrap-external-url">
			<input type="url" id="wpcf7-redirect-external-url" placeholder="<?php esc_html_e( 'External URL', 'wpcf7-redirect' );?>" name="wpcf7-redirect[external_url]" value="<?php echo $fields['external_url'];?>">
		</div>

		<div class="field-wrap field-wrap-use-external-url">
			<input type="checkbox" id="wpcf7-redirect-use-external-url" name="wpcf7-redirect[use_external_url]" <?php checked( $fields['use_external_url'], 'on', true ); ?>/>
			<label for="wpcf7-redirect-use-external-url">
				<?php esc_html_e( 'Use external URL', 'wpcf7-redirect' );?>
			</label>
		</div>


		<div class="field-wrap field-wrap-open-in-new-tab">
			<input type="checkbox" id="wpcf7-redirect-open-in-new-tab" name="wpcf7-redirect[open_in_new_tab]" <?php checked( $fields['open_in_new_tab'], 'on', true ); ?>/>
			<label for="wpcf7-redirect-open-in-new-tab"><?php esc_html_e( 'Open page in a new tab', 'wpcf7-redirect' );?></label>
			<div class="field-notice field-notice-alert field-notice-hidden">
				<strong>
					<?php esc_html_e( 'Notice!', 'wpcf7-redirect' );?>        
				</strong>
				<?php esc_html_e( 'This option might not work as expected, since browsers often block popup windows. This option depends on the browser settings.', 'wpcf7-redirect' );?>
			</div>
		</div>

		<div class="field-wrap field-wrap-http-build-query">
			<input type="checkbox" id="wpcf7-redirect-http-build-query" class="checkbox-radio-1" name="wpcf7-redirect[http_build_query]" <?php checked( $fields['http_build_query'], 'on', true ); ?>/>
			<label for="wpcf7-redirect-http-build-query">
				<?php esc_html_e( 'Pass all the fields from the form as URL query parameters', 'wpcf7-redirect' );?>      
			</label>
		</div>

		<div class="field-wrap field-wrap-http-build-query-selectively">
			<input type="checkbox" id="wpcf7-redirect-http-build-query-selectively" class="checkbox-radio-1" name="wpcf7-redirect[http_build_query_selectively]" <?php checked( $fields['http_build_query_selectively'], 'on', true ); ?>/>
			<label for="wpcf7-redirect-http-build-query-selectively">
				<?php esc_html_e( 'Pass specific fields from the form as URL query parameters', 'wpcf7-redirect' );?>      
			</label>
			<input type="text" id="wpcf7-redirect-http-build-query-selectively-fields" class="field-hidden" placeholder="<?php esc_html_e( 'Fields to pass, separated by commas', 'wpcf7-redirect' );?>" name="wpcf7-redirect[http_build_query_selectively_fields]" value="<?php echo $fields['http_build_query_selectively_fields'];?>">
		</div>

		<hr />

		<div class="field-wrap field-wrap-after-sent-script">
			<label for="wpcf7-redirect-after-sent-script">
				<?php esc_html_e( 'Here you can add scripts to run after form sent successfully.', 'wpcf7-redirect' );?>
			</label>
			<div class="field-message">
				<?php esc_html_e( 'Do not include <script> tags.', 'wpcf7-redirect' );?>
				</div>
				<textarea id="wpcf7-redirect-after-sent-script" name="wpcf7-redirect[after_sent_script]" rows="8" cols="100"><?php echo $fields['after_sent_script'];?></textarea>
			</div>
			<div class="field-notice field-warning-alert field-notice-hidden">
				<strong>
					<?php esc_html_e( 'Warning!', 'wpcf7-redirect' );?>        
				</strong>
				<?php esc_html_e( 'This option is for developers only - use with caution. If the plugin does not redirect after you have added scripts, it means you have a problem with your script. Either fix the script, or remove it.', 'wpcf7-redirect' );?>
			</div>
		</fieldset>

		<?php
	}
}

$cf7_redirect = new WPCF7_Redirect();