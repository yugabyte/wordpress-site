<?php 

// Register Custom Navigation Walker
if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

// Register Menu
function register_my_menu() {
  register_nav_menu('header-menu',( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

// Register Resource Post Type
if (! function_exists('yb_add_resources_post_type')) {

	function yb_add_resources_post_type() {
		$labels = array(
	    'name' => _x( 'Resources', 'post type general name' ),
	    'singular_name' => _x( 'Resource', 'post type singular name' ),
	    'add_new' => _x( 'Add New', 'Resource'),
	    'add_new_item' => __( 'Add New Resource '),
	    'edit_item' => __( 'Edit Resource '),
	    'new_item' => __( 'New Resource '),
	    'view_item' => __( 'View Resource '),
	    'search_items' => __( 'Search Resources '),
	    'not_found' =>  __( 'No Resource found' ),
	    'not_found_in_trash' => __( 'No Resources found in Trash' ),
	    'parent_item_colon' => ''
	  );

	  $supports = array( 'title' , 'editor' , 'thumbnail' , 'excerpt' , 'revisions' );

	  $post_type_args = array(
	    'labels' => $labels,
	    'singular_label' => __( 'Resource' ),
	    'public' => true,
	    'show_ui' => true,
	    'publicly_queryable' => true,
	    'query_var' => true,
	    'capability_type' => 'page',
	    'has_archive' => true,
	    'hierarchical' => false,
	    'rewrite' => array( 'slug' => 'resources' ),
	    'supports' => $supports,
	    'menu_position' => 5,
	    'taxonomies' => array( 'post_tag','category' )
	  );

	register_post_type( 'yb_resources' , $post_type_args );
	}

	add_action('init', 'yb_add_resources_post_type', 1);

}

if ( ! function_exists('yb_add_custom_post_types') ) {

// Register Custom Post Type
function yb_add_custom_post_types() {

	$labels = array(
		'name'                  => _x( 'Global Sections', 'Post Type General Name', 'yugabyte' ),
		'singular_name'         => _x( 'Global Setion', 'Post Type Singular Name', 'yugabyte' ),
		'menu_name'             => __( 'Global Sections', 'yugabyte' ),
		'name_admin_bar'        => __( 'Global Section', 'yugabyte' ),
		'archives'              => __( 'Global Section Archives', 'yugabyte' ),
		'attributes'            => __( 'Global Section Attributes', 'yugabyte' ),
		'parent_item_colon'     => __( 'Parent Global Section:', 'yugabyte' ),
		'all_items'             => __( 'All Global Sections', 'yugabyte' ),
		'add_new_item'          => __( 'Add New Global Section', 'yugabyte' ),
		'add_new'               => __( 'Add New', 'yugabyte' ),
		'new_item'              => __( 'New Global Section', 'yugabyte' ),
		'edit_item'             => __( 'Edit Global Section', 'yugabyte' ),
		'update_item'           => __( 'Update Global Section', 'yugabyte' ),
		'view_item'             => __( 'View Global Section', 'yugabyte' ),
		'view_items'            => __( 'View Global Sections', 'yugabyte' ),
		'search_items'          => __( 'Search Global Section', 'yugabyte' ),
		'not_found'             => __( 'Not found', 'yugabyte' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'yugabyte' ),
		'featured_image'        => __( 'Featured Image', 'yugabyte' ),
		'set_featured_image'    => __( 'Set featured image', 'yugabyte' ),
		'remove_featured_image' => __( 'Remove featured image', 'yugabyte' ),
		'use_featured_image'    => __( 'Use as featured image', 'yugabyte' ),
		'insert_into_item'      => __( 'Insert into global section', 'yugabyte' ),
		'uploaded_to_this_item' => __( 'Uploaded to this global section', 'yugabyte' ),
		'items_list'            => __( 'Global Sections list', 'yugabyte' ),
		'items_list_navigation' => __( 'Global Sections list navigation', 'yugabyte' ),
		'filter_items_list'     => __( 'Filter global sections list', 'yugabyte' ),
	);
	$args = array(
		'label'                 => __( 'Global Setion', 'yugabyte' ),
		'description'           => __( 'Global sections that are used and reused throughout the site', 'yugabyte' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'global_section', $args );

}
add_action( 'init', 'yb_add_custom_post_types', 0 );

}

function checkTableIcon($cellValue = '') {
	if(trim($cellValue) == 'y' || trim($cellValue) == 'n') {
		if($cellValue == 'y') {
			return '<i class="yb-icon-check">YES</i>';
		} else {
			return '<i class="yb-icon-x">NO</i>';
		}
	}		
	
	return $cellValue;
} 

function userIsAuthorizedToDownload() {
	if (isset($_COOKIE["ybcf"])) {
		include(locate_template('template_parts/resource-download/button.php'));
	} else {
		include(locate_template('template_parts/resource-download/form.php'));
	}

	die();
}

function addSecurityHeaders() {
    // use php header function to set new http vary header value,
    // for the second parameter, true means replace the previous header, false means add a second header.
    header('Strict-Transport-Security: max-age=31536000', true);
    header('x-frame-options: SAMEORIGIN', true);
    header('Referrer-Policy: same-origin', true);
    header('X-Content-Type-Options: nosniff', true);
    header('Content-Security-Policy: script-src \'self\' \'unsafe-inline\' https:', true);
    header('Feature-Policy: vibrate \'self\'; sync-xhr \'self\'', true);
}
    
add_action( 'wp_ajax_userIsAuthorizedToDownload', 'userIsAuthorizedToDownload');
add_action( 'wp_ajax_nopriv_userIsAuthorizedToDownload', 'userIsAuthorizedToDownload' );
add_action( 'send_headers', 'addSecurityHeaders' );

// register custom query variables for content library page filters
function content_lib_query_vars( $qvars ) {
	$qvars[] = 'type';
	return $qvars;
}
add_filter( 'query_vars', 'content_lib_query_vars' );

// uncomment below to globally disable the spam filter
// add_filter( 'wpcf7_spam', 'custom_spam_filter', 10, 1 );
// function custom_spam_filter( $spam ) {
// 	return false;
// }

function _checkArrayContains ( $arr, $tag_name, $needle ) {
	foreach ($arr as $obj) {
		if ($obj[$tag_name] == $needle) {
			return True;
		}
	}
	return False;
}

function getIntegrationsList( $test ) {
	$vote_count = get_post_meta($_REQUEST["post_id"]);
	$type = $_REQUEST["type"];
	$fields = get_field_objects($_REQUEST["post_id"]);	
	if (!isset($type) || $type == 'All') {
		$partners = array();
		$integrations = array();
		foreach ($fields["partners_repeater"]["value"] as $company) {		
			if (_checkArrayContains($company["tags"], "tag_name", "Partner")) {
				array_push($partners, $company);
			} else if (_checkArrayContains($company["tags"], "tag_name", "Integration")) {
				array_push($integrations, $company);
			}
		}
		echo json_encode(array(
			"Partners" => $partners,
			"Integrations" => $integrations
		));
		die();
	}
	$companies = array();
	foreach ($fields["partners_repeater"]["value"] as $company) {		
		if (_checkArrayContains($company["tags"], "tag_name", $type)) {
			array_push($companies, $company);
		}
	}
	echo json_encode(array(
		$type => $companies
	));
	die();
}
add_action("wp_ajax_get_integrations_list", "getIntegrationsList");
add_action("wp_ajax_nopriv_get_integrations_list", "getIntegrationsList");
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');


?>
