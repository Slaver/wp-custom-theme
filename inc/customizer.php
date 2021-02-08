<?php
/**
 * custom_theme Theme Customizer
 *
 * @package custom_theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function custom_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'custom_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'custom_theme_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'custom_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function custom_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function custom_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Adding the Open Graph in the Language Attributes
 *
 * @url https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
 * @param $output
 * @return string
 */
function custom_theme_customize_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter( 'language_attributes', 'custom_theme_customize_doctype' );

/**
 * Lets add Open Graph Meta Info
 *
 * @url https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
 */
function custom_theme_customize_head() {
	global $post;

	if ( ! is_singular() )
		return;

	echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	echo '<meta property="og:type" content="article"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	echo '<meta property="og:site_name" content="' . get_option( 'blogname' )  . '"/>';
	echo '<meta property="og:description" content="' . get_the_excerpt() .  '"/>';

	// the post does not have featured image, use a default image
	if ( ! has_post_thumbnail( $post->ID ) ) :
		$default_image=""; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	else :
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	endif;

	echo "
";
}
add_action( 'wp_head', 'custom_theme_customize_head', 5 );