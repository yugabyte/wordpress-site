<?php

//CUSTOM POST TYPES
function cpt_teammember() { 
	register_post_type( 'teammember',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Team Members', 'post type general name'),
			'singular_name' => __('Team Member', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Team Member'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Team Member'),
			'new_item' => __('New Team Member'),
			'view_item' => __('View Team Member'),
			'search_items' => __('Search Team Members'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Team Member:'
			),
			'description' => __( 'Yugabyte Team Members' ),
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-businessman',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'team-members', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_teammember');

function cpt_success_story() { 
	register_post_type( 'success-story',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Success Stories', 'post type general name'),
			'singular_name' => __('Success Story', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Success Story'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Success Story'),
			'new_item' => __('New Success Story'),
			'view_item' => __('View Success Story'),
			'search_items' => __('Search Success Stories'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Success Story:'
			),
			'description' => __( 'Yugabyte Success Stories' ),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-awards',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title', 'editor'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'success-stories', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_success_story');

function cpt_testimonial() { 
	register_post_type( 'testimonial',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Testimonials', 'post type general name'),
			'singular_name' => __('Testimonial', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Testimonial'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Testimonial'),
			'new_item' => __('New Testimonial'),
			'view_item' => __('View Testimonial'),
			'search_items' => __('Search Testimonials'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Testimonial:'
			),
			'description' => __( 'Yugabyte Testimonials' ),
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-format-quote',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'testimonials', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_testimonial');

function cpt_resource() { 
	register_post_type( 'resource',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Resources', 'post type general name'),
			'singular_name' => __('Resource', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Resource'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Resource'),
			'new_item' => __('New Resource'),
			'view_item' => __('View Resource'),
			'search_items' => __('Search Resources'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Resource:'
			),
			'description' => __( 'Yugabyte Resources' ),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-media-interactive',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'resources', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_resource');

function cpt_ybnews() { 
	register_post_type( 'ybnews',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('YB News', 'post type general name'),
			'singular_name' => __('YB News', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New YB News'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit YB News'),
			'new_item' => __('New YB News'),
			'view_item' => __('View YB News'),
			'search_items' => __('Search YB News'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent YB News:'
			),
			'description' => __( 'Yugabyte News posts' ),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-megaphone',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'yugabyte-news', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_ybnews');

function cpt_ybevent() { 
	register_post_type( 'ybevent',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Events', 'post type general name'),
			'singular_name' => __('Event', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Event'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Event'),
			'new_item' => __('New Event'),
			'view_item' => __('View Event'),
			'search_items' => __('Search Events'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Event:'
			),
			'description' => __( 'Yugabyte Events' ),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-tickets-alt',
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'events', 'with_front' => false ),
			'query_var' => true
	 	)
	);
}
add_action( 'init', 'cpt_ybevent');

//TAXONOMIES
function register_taxonomies() {

	$topic_labels = array(
		'name'              => _x( 'Industries', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Industry', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Industries', 'yugabyte' ),
		'all_items'         => __( 'All Industries', 'yugabyte' ),
		'parent_item'       => __( 'Parent Industry', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Industry:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Industry', 'yugabyte' ),
		'update_item'       => __( 'Update Industry', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Industry', 'yugabyte' ),
		'new_item_name'     => __( 'New Industry Name', 'yugabyte' ),
		'menu_name'         => __( 'Industries', 'yugabyte' ),
	);

	$topic_args = array(
		'hierarchical' => true,
		'labels' => $topic_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'industries' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('industries', array('success-story'), $topic_args);
	
	$topic_labels = array(
		'name'              => _x( 'Features', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Feature', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Features', 'yugabyte' ),
		'all_items'         => __( 'All Features', 'yugabyte' ),
		'parent_item'       => __( 'Parent Feature', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Feature:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Feature', 'yugabyte' ),
		'update_item'       => __( 'Update Feature', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Feature', 'yugabyte' ),
		'new_item_name'     => __( 'New Feature Name', 'yugabyte' ),
		'menu_name'         => __( 'Features', 'yugabyte' ),
	);

	$topic_args = array(
		'hierarchical' => true,
		'labels' => $topic_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'features' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('features', array('success-story'), $topic_args);
	
	$type_labels = array(
		'name'              => _x( 'Resource Types', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Resource Type', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Resource Types', 'yugabyte' ),
		'all_items'         => __( 'All Resource Types', 'yugabyte' ),
		'parent_item'       => __( 'Parent Resource Type', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Resource Type:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Resource Type', 'yugabyte' ),
		'update_item'       => __( 'Update Resource Type', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Resource Type', 'yugabyte' ),
		'new_item_name'     => __( 'New Resource Type Name', 'yugabyte' ),
		'menu_name'         => __( 'Resource Types', 'yugabyte' ),
	);

	$type_args = array(
		'hierarchical' => true,
		'labels' => $type_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'type' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('resource_types', array('resource'), $type_args);
	
	$type_labels = array(
		'name'              => _x( 'News Types', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'News Type', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search News Types', 'yugabyte' ),
		'all_items'         => __( 'All News Types', 'yugabyte' ),
		'parent_item'       => __( 'Parent News Type', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent News Type:', 'yugabyte' ),
		'edit_item'         => __( 'Edit News Type', 'yugabyte' ),
		'update_item'       => __( 'Update News Type', 'yugabyte' ),
		'add_new_item'      => __( 'Add New News Type', 'yugabyte' ),
		'new_item_name'     => __( 'New News Type Name', 'yugabyte' ),
		'menu_name'         => __( 'News Types', 'yugabyte' ),
	);

	$type_args = array(
		'hierarchical' => false,
		'labels' => $type_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'type' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('news_types', array('ybnews'), $type_args);
	
	$ev_type_labels = array(
		'name'              => _x( 'Event Types', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Event Type', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Event Types', 'yugabyte' ),
		'all_items'         => __( 'All Event Types', 'yugabyte' ),
		'parent_item'       => __( 'Parent Event Type', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Event Type:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Event Type', 'yugabyte' ),
		'update_item'       => __( 'Update Event Type', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Event Type', 'yugabyte' ),
		'new_item_name'     => __( 'New Event Type Name', 'yugabyte' ),
		'menu_name'         => __( 'Event Types', 'yugabyte' ),
	);

	$ev_type_args = array(
		'hierarchical' => true,
		'labels' => $ev_type_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'type' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('event_types', array('ybevent'), $ev_type_args);
	
	$ev_loc_labels = array(
		'name'              => _x( 'Event Locations', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Event Location', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Event Locations', 'yugabyte' ),
		'all_items'         => __( 'All Event Locations', 'yugabyte' ),
		'parent_item'       => __( 'Parent Event Location', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Event Location:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Event Location', 'yugabyte' ),
		'update_item'       => __( 'Update Event Location', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Event Location', 'yugabyte' ),
		'new_item_name'     => __( 'New Event Location Name', 'yugabyte' ),
		'menu_name'         => __( 'Event Locations', 'yugabyte' ),
	);

	$ev_loc_args = array(
		'hierarchical' => true,
		'labels' => $ev_loc_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'location' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('event_locations', array('ybevent'), $ev_loc_args);

}
add_action( 'init', 'register_taxonomies');

?>