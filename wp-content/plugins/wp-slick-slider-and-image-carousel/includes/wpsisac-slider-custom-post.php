<?php

add_action('init', 'wpsisac_slider_init');
function wpsisac_slider_init() {
    $wpsisac_slider_labels = array(
    'name'                 => _x('Slick Slider', 'wp-slick-slider-and-image-carousel'),
    'singular_name'        => _x('slick slider', 'wp-slick-slider-and-image-carousel'),
    'add_new'              => _x('Add Slide', 'wp-slick-slider-and-image-carousel'),
    'add_new_item'         => __('Add New slide', 'wp-slick-slider-and-image-carousel'),
    'edit_item'            => __('Edit Slick Slider', 'wp-slick-slider-and-image-carousel'),
    'new_item'             => __('New Slick Slider', 'wp-slick-slider-and-image-carousel'),
    'view_item'            => __('View Slick Slider', 'wp-slick-slider-and-image-carousel'),
    'search_items'         => __('Search Slick Slider', 'wp-slick-slider-and-image-carousel'),
    'not_found'            =>  __('No Slick Slider Items found', 'wp-slick-slider-and-image-carousel'),
    'not_found_in_trash'   => __('No Slick Slider Items found in Trash', 'wp-slick-slider-and-image-carousel'), 
	'featured_image' 		=> __('Set slider image', 'wp-slick-slider-and-image-carousel'),
	'set_featured_image'	=> __( 'Set slider image' , 'wp-slick-slider-and-image-carousel' ),
	'remove_featured_image' => __( 'Remove slider image', 'wp-slick-slider-and-image-carousel' ),
    '_builtin'             =>  false, 
    'parent_item_colon'    => '',  
	'menu_name'            => _x( 'Slick Slider', 'admin menu', 'wp-slick-slider-and-image-carousel' )
  );

  $wpsisac_slider_args = array(
    'labels'                => $wpsisac_slider_labels,
    'public'                => false,    
    'show_ui'               => true,
    'show_in_menu'          => true, 
    'query_var'             => false,
    'rewrite'               => false,
    'capability_type'       => 'post',
    'has_archive'           => false,
    'hierarchical'          => false, 
	'exclude_from_search'   => true,	
    'menu_icon'             => 'dashicons-slides',
    'supports'              => array('title','editor','thumbnail')
  );

  register_post_type('slick_slider',$wpsisac_slider_args);

}

/* Register Taxonomy */
add_action( 'init', 'wpsisac_slider_taxonomies');
function wpsisac_slider_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'wp-slick-slider-and-image-carousel' ),
        'singular_name'     => _x( 'Category', 'wp-slick-slider-and-image-carousel' ),
        'search_items'      => __( 'Search Category', 'wp-slick-slider-and-image-carousel' ),
        'all_items'         => __( 'All Category', 'wp-slick-slider-and-image-carousel' ),
        'parent_item'       => __( 'Parent Category', 'wp-slick-slider-and-image-carousel' ),
        'parent_item_colon' => __( 'Parent Category' , 'wp-slick-slider-and-image-carousel' ),
        'edit_item'         => __( 'Edit Category', 'wp-slick-slider-and-image-carousel' ),
        'update_item'       => __( 'Update Category', 'wp-slick-slider-and-image-carousel' ),
        'add_new_item'      => __( 'Add New Category', 'wp-slick-slider-and-image-carousel' ),
        'new_item_name'     => __( 'New Category Name', 'wp-slick-slider-and-image-carousel' ),
        'menu_name'         => __( 'Slider Category', 'wp-slick-slider-and-image-carousel' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'wpsisac_slider-category' ),
    );

    register_taxonomy( 'wpsisac_slider-category', array( 'slick_slider' ), $args );
}

function wpsisac_slider_rewrite_flush() {  
		wpsisac_slider_init();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'wpsisac_slider_rewrite_flush' );


// Manage Category Shortcode wpcolumns

add_filter("manage_wpsisac_slider-category_custom_column", 'wpsisac_slider_category_columns', 10, 3);
add_filter("manage_edit-wpsisac_slider-category_columns", 'wpsisac_slider_category_manage_columns'); 
function wpsisac_slider_category_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'slider_shortcode' => __( 'Slider Category Shortcode', 'wp-slick-slider-and-image-carousel' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);

    return $new_columns;
}

function wpsisac_slider_category_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'wpsisac_slider-category');
    switch ($column_name) {      
        case 'title':
            echo get_the_title();
        break;
        case 'slider_shortcode':
			echo '[slick-slider category="' . $theme_id. '"]<br />';
			  echo '[slick-carousel-slider category="' . $theme_id. '"]';		  

        break;
        default:
            break;
    }
    return $out;   

}

/* Custom meta box for slider link */
function wpsisac_add_meta_box() {
		add_meta_box('custom-metabox',__( 'Read More Link', 'wp-slick-slider-and-image-carousel' ),'wpsisac_box_callback','slick_slider');
}
add_action( 'add_meta_boxes', 'wpsisac_add_meta_box' );
function wpsisac_box_callback( $post ) {
	wp_nonce_field( 'wpsisac_save_meta_box_data', 'wpsisac_meta_box_nonce' );
	$value = get_post_meta( $post->ID, 'wpsisac_slide_link', true );
	echo '<input type="url" style="width:100%;" id="wpsisac_slide_link" name="wpsisac_slide_link" value="' . esc_attr( $value ) . '" size="25" /><br />';
	echo '<em>Display link on image eg. http://www.google.com</em>';
}
function wpsisac_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wpsisac_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wpsisac_meta_box_nonce'], 'wpsisac_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'slick_slider' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['wpsisac_slide_link'] ) ) {
		return;
	}
	$link_data = sanitize_text_field( $_POST['wpsisac_slide_link'] );
	update_post_meta( $post_id, 'wpsisac_slide_link', $link_data );
}
add_action( 'save_post', 'wpsisac_save_meta_box_data' );