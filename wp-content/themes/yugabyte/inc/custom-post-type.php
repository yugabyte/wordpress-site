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

//TAXONOMIES
/*function register_taxonomies() {

	$topic_labels = array(
		'name'              => _x( 'Teams', 'taxonomy general name', 'yugabyte' ),
		'singular_name'     => _x( 'Team', 'taxonomy singular name', 'yugabyte' ),
		'search_items'      => __( 'Search Teams', 'yugabyte' ),
		'all_items'         => __( 'All Teams', 'yugabyte' ),
		'parent_item'       => __( 'Parent Team', 'yugabyte' ),
		'parent_item_colon' => __( 'Parent Team:', 'yugabyte' ),
		'edit_item'         => __( 'Edit Team', 'yugabyte' ),
		'update_item'       => __( 'Update Team', 'yugabyte' ),
		'add_new_item'      => __( 'Add New Team', 'yugabyte' ),
		'new_item_name'     => __( 'New Team Name', 'yugabyte' ),
		'menu_name'         => __( 'Teams', 'yugabyte' ),
	);

	$topic_args = array(
		'hierarchical' => true,
		'labels' => $topic_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'teams' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('teams', array('teammember'), $topic_args);

}
add_action( 'init', 'register_taxonomies');*/

?>