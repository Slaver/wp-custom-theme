<?php

if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on custom_theme, use a find and replace
		 * to change 'custom_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'custom_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'custom_theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'custom_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'custom_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'custom_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts() {
	wp_enqueue_style( 'custom_theme-style', get_template_directory_uri() . '/assets/css/style.css', [], wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'custom_theme-scripts', get_template_directory_uri() . '/assets/js/scripts.js', [ 'jquery' ], wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom admin functions.
 */
require get_template_directory() . '/inc/admin-functions.php';

/**
 * Post-types initilization.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Taxonomies initilization.
 */
require get_template_directory() . '/inc/taxonomies.php';

/**
 * WP Multilang functions.
 */
require get_template_directory() . '/inc/wpm-functions.php';

/**
 * Filters.
 */
require get_template_directory() . '/inc/filters.php';

/**
 * AJAX.
 */
require get_template_directory() . '/inc/ajax.php';