<?php

//CUSTOM POST TYPES
/*function cpt_product() { 
	register_post_type( 'darrigoproduct',
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Products', 'post type general name'),
			'singular_name' => __('Product', 'post type singular name'),
			'add_new' => __('Add New', 'custom post type item'),
			'add_new_item' => __('Add New Product'),
			'edit' => __( 'Edit' ),
			'edit_item' => __('Edit Product'),
			'new_item' => __('New Product'),
			'view_item' => __('View Product'),
			'search_items' => __('Search Products'),
			'not_found' =>  __('Nothing found in the Database.'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => 'Parent Product:'
			),
			'description' => __( 'D\'ArrigoNY Products' ),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 30, 
			'menu_icon' => 'dashicons-products',
			'capability_type' => 'post',
			'hierarchical' => true,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
			'has_archive' => false,
			'taxonomies' => array('producttypes'),
			'rewrite' => array( 'slug' => 'products', 'with_front' => false ),
			'query_var' => true
	 	)
	);
} 
add_action( 'init', 'cpt_product');*/

//TAXONOMIES
/*function register_taxonomies() {

	$topic_labels = array(
		'name'              => _x( 'Product Types', 'taxonomy general name', 'darrigo' ),
		'singular_name'     => _x( 'Product Type', 'taxonomy singular name', 'darrigo' ),
		'search_items'      => __( 'Search Product Types', 'darrigo' ),
		'all_items'         => __( 'All Product Types', 'darrigo' ),
		'parent_item'       => __( 'Parent Product Type', 'darrigo' ),
		'parent_item_colon' => __( 'Parent Product Type:', 'darrigo' ),
		'edit_item'         => __( 'Edit Product Type', 'darrigo' ),
		'update_item'       => __( 'Update Product Type', 'darrigo' ),
		'add_new_item'      => __( 'Add New Product Type', 'darrigo' ),
		'new_item_name'     => __( 'New Product Type Name', 'darrigo' ),
		'menu_name'         => __( 'Product Types', 'darrigo' ),
	);

	$topic_args = array(
		'hierarchical' => true,
		'labels' => $topic_labels,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'products/type' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	);

	register_taxonomy('producttypes', array('darrigoproduct'), $topic_args);

}
add_action( 'init', 'register_taxonomies');*/

?>