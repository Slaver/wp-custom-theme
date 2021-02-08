<?php

function custom_theme_register_taxonomies() {

	/**
	 * Taxonomy: Styles.
	 */

	$labels = [
		'name' => __( 'Styles', 'custom_theme' ),
		'singular_name' => __( 'Style', 'custom_theme' ),
		'menu_name' => __( 'Styles', 'custom_theme' ),
		'all_items' => __( 'All Styles', 'custom_theme' ),
		'edit_item' => __( 'Edit Style', 'custom_theme' ),
		'view_item' => __( 'View Style', 'custom_theme' ),
		'update_item' => __( 'Update Style Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Style', 'custom_theme' ),
		'new_item_name' => __( 'New Style Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Style', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Style:', 'custom_theme' ),
		'search_items' => __( 'Search Styles', 'custom_theme' ),
		'popular_items' => __( 'Popular Styles', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Styles with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Styles', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Styles', 'custom_theme' ),
		'not_found' => __( 'No Styles found', 'custom_theme' ),
		'no_terms' => __( 'No styles', 'custom_theme' ),
		'items_list_navigation' => __( 'Styles list navigation', 'custom_theme' ),
		'items_list' => __( 'Styles list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Styles', 'custom_theme' ),
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'style', 'with_front' => true,],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rest_base' => 'style',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'style', ['beers'], $args );

	/**
	 * Taxonomy: Hops.
	 */

	$labels = [
		'name' => __( 'Hops', 'custom_theme' ),
		'singular_name' => __( 'Hop', 'custom_theme' ),
		'menu_name' => __( 'Hops', 'custom_theme' ),
		'all_items' => __( 'All Hops', 'custom_theme' ),
		'edit_item' => __( 'Edit Hop', 'custom_theme' ),
		'view_item' => __( 'View Hop', 'custom_theme' ),
		'update_item' => __( 'Update Hop Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Hop', 'custom_theme' ),
		'new_item_name' => __( 'New Hop Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Hop', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Hop:', 'custom_theme' ),
		'search_items' => __( 'Search Hops', 'custom_theme' ),
		'popular_items' => __( 'Popular Hops', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Hops with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Hops', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Hops', 'custom_theme' ),
		'not_found' => __( 'No Hops found', 'custom_theme' ),
		'no_terms' => __( 'No hops', 'custom_theme' ),
		'items_list_navigation' => __( 'Hops list navigation', 'custom_theme' ),
		'items_list' => __( 'Hops list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Hops', 'custom_theme' ),
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'hops', 'with_front' => true,],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rest_base' => 'hops',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'hops', ['beers'], $args );

	/**
	 * Taxonomy: Malts.
	 */

	$labels = [
		'name' => __( 'Malts', 'custom_theme' ),
		'singular_name' => __( 'Malt', 'custom_theme' ),
		'menu_name' => __( 'Malts', 'custom_theme' ),
		'all_items' => __( 'All Malts', 'custom_theme' ),
		'edit_item' => __( 'Edit Malt', 'custom_theme' ),
		'view_item' => __( 'View Malt', 'custom_theme' ),
		'update_item' => __( 'Update Malt Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Malt', 'custom_theme' ),
		'new_item_name' => __( 'New Malt Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Malt', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Malt:', 'custom_theme' ),
		'search_items' => __( 'Search Malts', 'custom_theme' ),
		'popular_items' => __( 'Popular Malts', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Malts with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Malt', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Malts', 'custom_theme' ),
		'not_found' => __( 'No Malts found', 'custom_theme' ),
		'no_terms' => __( 'No malts', 'custom_theme' ),
		'items_list_navigation' => __( 'Malts list navigation', 'custom_theme' ),
		'items_list' => __( 'Malts list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Malts', 'custom_theme' ),
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'malt', 'with_front' => true,],
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rest_base' => 'malts',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'malts', ['beers'], $args );

	/**
	 * Taxonomy: Yeast.
	 */

	$labels = [
		'name' => __( 'Yeast', 'custom_theme' ),
		'singular_name' => __( 'Yeast', 'custom_theme' ),
		'menu_name' => __( 'Yeast', 'custom_theme' ),
		'all_items' => __( 'All Yeast', 'custom_theme' ),
		'edit_item' => __( 'Edit Yeast', 'custom_theme' ),
		'view_item' => __( 'View Yeast', 'custom_theme' ),
		'update_item' => __( 'Update Yeast Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Yeast', 'custom_theme' ),
		'new_item_name' => __( 'New Yeast Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Yeast', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Yeast:', 'custom_theme' ),
		'search_items' => __( 'Search Yeast', 'custom_theme' ),
		'popular_items' => __( 'Popular Yeast', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Yeast with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Yeast', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Yeast', 'custom_theme' ),
		'not_found' => __( 'No Yeast found', 'custom_theme' ),
		'no_terms' => __( 'No yeast', 'custom_theme' ),
		'items_list_navigation' => __( 'Yeast list navigation', 'custom_theme' ),
		'items_list' => __( 'Yeast list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Yeast', 'custom_theme' ),
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'yeast', 'with_front' => true,],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rest_base' => 'yeast',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'yeast', ['beers'], $args );

	/**
	 * Taxonomy: Other Ingredients.
	 */

	$labels = [
		'name' => __( 'Other Ingredients', 'custom_theme' ),
		'singular_name' => __( 'Ingredient', 'custom_theme' ),
		'menu_name' => __( 'Ingredients', 'custom_theme' ),
		'all_items' => __( 'All Ingredients', 'custom_theme' ),
		'edit_item' => __( 'Edit Ingredient', 'custom_theme' ),
		'view_item' => __( 'View Ingredient', 'custom_theme' ),
		'update_item' => __( 'Update Ingredient Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Ingredient', 'custom_theme' ),
		'new_item_name' => __( 'New Ingredient Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Ingredient', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Ingredient:', 'custom_theme' ),
		'search_items' => __( 'Search Ingredients', 'custom_theme' ),
		'popular_items' => __( 'Popular Ingredients', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Ingredients with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Ingredients', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Ingredients', 'custom_theme' ),
		'not_found' => __( 'No Ingredients found', 'custom_theme' ),
		'no_terms' => __( 'No ingredients', 'custom_theme' ),
		'items_list_navigation' => __( 'Ingredients list navigation', 'custom_theme' ),
		'items_list' => __( 'Ingredients list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Other Ingredients', 'custom_theme' ),
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'ingredient', 'with_front' => true,],
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rest_base' => 'ingredients',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'ingredients', ['beers'], $args );

	/**
	 * Taxonomy: Flavor Profiles.
	 */

	$labels = [
		'name' => __( 'Flavor Profiles', 'custom_theme' ),
		'singular_name' => __( 'Flavor', 'custom_theme' ),
		'menu_name' => __( 'Flavors', 'custom_theme' ),
		'all_items' => __( 'All Flavors', 'custom_theme' ),
		'edit_item' => __( 'Edit Flavor', 'custom_theme' ),
		'view_item' => __( 'View Flavor', 'custom_theme' ),
		'update_item' => __( 'Update Flavor Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Flavor', 'custom_theme' ),
		'new_item_name' => __( 'New Flavor Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Flavor', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Flavor:', 'custom_theme' ),
		'search_items' => __( 'Search Flavors', 'custom_theme' ),
		'popular_items' => __( 'Popular Flavors', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Flavors with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Flavor', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Flavors', 'custom_theme' ),
		'not_found' => __( 'No Flavors found', 'custom_theme' ),
		'no_terms' => __( 'No flavors', 'custom_theme' ),
		'items_list_navigation' => __( 'Flavors list navigation', 'custom_theme' ),
		'items_list' => __( 'Flavors list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Flavor Profiles', 'custom_theme' ),
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'flavor', 'with_front' => true,],
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rest_base' => 'flavor',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'flavor', ['beers'], $args );

	/**
	 * Taxonomy: Food pairing.
	 */

	$labels = [
		'name' => __( 'Food pairing', 'custom_theme' ),
		'singular_name' => __( 'Dish', 'custom_theme' ),
		'menu_name' => __( 'Dishes', 'custom_theme' ),
		'all_items' => __( 'All Dishes', 'custom_theme' ),
		'edit_item' => __( 'Edit Dish', 'custom_theme' ),
		'view_item' => __( 'View Dish', 'custom_theme' ),
		'update_item' => __( 'Update Dish Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Dish', 'custom_theme' ),
		'new_item_name' => __( 'New Dish Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Dish', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Dish:', 'custom_theme' ),
		'search_items' => __( 'Search Dishes', 'custom_theme' ),
		'popular_items' => __( 'Popular Dishes', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Dishes with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Dish', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Dishes', 'custom_theme' ),
		'not_found' => __( 'No Dishes found', 'custom_theme' ),
		'no_terms' => __( 'No dishes', 'custom_theme' ),
		'items_list_navigation' => __( 'Dishes list navigation', 'custom_theme' ),
		'items_list' => __( 'Dishes list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Food pairing', 'custom_theme' ),
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'food', 'with_front' => true,],
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rest_base' => 'food',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'food', ['beers'], $args );

	/**
	 * Taxonomy: Series.
	 */

	$labels = [
		'name' => __( 'Series', 'custom_theme' ),
		'singular_name' => __( 'Series', 'custom_theme' ),
		'menu_name' => __( 'Series', 'custom_theme' ),
		'all_items' => __( 'All Series', 'custom_theme' ),
		'edit_item' => __( 'Edit Series', 'custom_theme' ),
		'view_item' => __( 'View Series', 'custom_theme' ),
		'update_item' => __( 'Update Series Name', 'custom_theme' ),
		'add_new_item' => __( 'Add New Series', 'custom_theme' ),
		'new_item_name' => __( 'New Series Name', 'custom_theme' ),
		'parent_item' => __( 'Parent Series', 'custom_theme' ),
		'parent_item_colon' => __( 'Parent Series:', 'custom_theme' ),
		'search_items' => __( 'Search Series', 'custom_theme' ),
		'popular_items' => __( 'Popular Series', 'custom_theme' ),
		'separate_items_with_commas' => __( 'Separate Series with commas', 'custom_theme' ),
		'add_or_remove_items' => __( 'Add or remove Series', 'custom_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Series', 'custom_theme' ),
		'not_found' => __( 'No Series found', 'custom_theme' ),
		'no_terms' => __( 'No series', 'custom_theme' ),
		'items_list_navigation' => __( 'Series list navigation', 'custom_theme' ),
		'items_list' => __( 'Series list', 'custom_theme' ),
    ];

	$args = [
		'label' => __( 'Series', 'custom_theme' ),
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'series', 'with_front' => true,],
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rest_base' => 'series',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => false,
    ];
	register_taxonomy( 'series', ['beers'], $args );
}
add_action( 'init', 'custom_theme_register_taxonomies' );
