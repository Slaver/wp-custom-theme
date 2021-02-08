<?php

function custom_theme_register_post_types() {

	/**
	 * Post Type: Beers.
	 */

	$labels = array(
		'name' => __( 'Beers', 'custom_theme' ),
		'singular_name' => __( 'Beer', 'custom_theme' ),
		'menu_name' => __( 'Beers', 'custom_theme' ),
		'all_items' => __( 'All Beers', 'custom_theme' ),
		'add_new' => __( 'Add New', 'custom_theme' ),
		'add_new_item' => __( 'Add New Beer', 'custom_theme' ),
		'edit_item' => __( 'Edit Beer', 'custom_theme' ),
		'new_item' => __( 'New Beer', 'custom_theme' ),
		'view_item' => __( 'View Beer', 'custom_theme' ),
		'view_items' => __( 'View Beers', 'custom_theme' ),
		'search_items' => __( 'Search Beer', 'custom_theme' ),
		'not_found' => __( 'No Beers found', 'custom_theme' ),
		'not_found_in_trash' => __( 'No Beers found in Trash', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Beer:', 'custom_theme' ),
		'featured_image' => __( 'Featured image for this beer', 'custom_theme' ),
		'set_featured_image' => __( 'Set featured image for this beer', 'custom_theme' ),
		'remove_featured_image' => __( 'Remove featured image for this beer', 'custom_theme' ),
		'use_featured_image' => __( 'Use as featured image for this beer', 'custom_theme' ),
		'archives' => __( 'Beer archives', 'custom_theme' ),
		'insert_into_item' => __( 'Insert into beer', 'custom_theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this beer', 'custom_theme' ),
		'filter_items_list' => __( 'Filter beers list', 'custom_theme' ),
		'items_list_navigation' => __( 'Beers List Navigation', 'custom_theme' ),
		'items_list' => __( 'Beers list', 'custom_theme' ),
		'attributes' => __( 'Beers Attributes', 'custom_theme' ),
		'name_admin_bar' => __( 'Beer', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Beer:', 'custom_theme' ),
	);

	$args = array(
		'label' => __( 'Beers', 'custom_theme' ),
		'labels' => $labels,
		'description' => 'Beers',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'delete_with_user' => false,
		'show_in_rest' => true,
		'rest_base' => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive' => 'beers',
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'beer', 'with_front' => true ),
		'query_var' => true,
		'menu_position' => 5,
		'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCA0NDggNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGZpbGw9IiNhMWE2YWEiIGQ9Ik0yODcuNCAxOTIuN2wtMTYtMTc4LjFDMjcwLjcgNi4zIDI2My45IDAgMjU1LjcgMGgtNjMuNWwzMC42IDYzLjctODUuNSA1NkwxODYuNyAyMjQgNjUuMiAxMDQuM2w4NS41LTU2TDExNy45IDBIMzIuM2MtOC4yIDAtMTUgNi4zLTE1LjcgMTQuNkwuNiAxOTIuN2MtNy4yIDgwIDUwLjcgMTQ4LjkgMTI3LjQgMTU3LjZWNDgwSDc0LjFjLTI0LjUgMC0zMy4yIDMyLTIwIDMyaDE3OS44YzEzLjEgMCA0LjUtMzItMjAtMzJIMTYwVjM1MC4zYzc2LjctOC44IDEzNC42LTc3LjYgMTI3LjQtMTU3LjZ6IiBjbGFzcz0iIj48L3BhdGg+PC9zdmc+',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author' ),
		'taxonomies' => array( 'style' ),
	);

	register_post_type( 'beers', $args );
}

add_action( 'init', 'custom_theme_register_post_types' );

/**
 * Placing a Custom Post Type Menu Above the Posts Menu Using menu_position
 */
function custom_theme_edit_admin_menu(){
    global $menu;

	$menu[7] = $menu[5];
	unset($menu[5]);
	ksort($menu);
}

// Move Beers above Posts
add_action('admin_head', 'custom_theme_edit_admin_menu');