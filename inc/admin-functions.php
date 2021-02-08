<?php

/**
 * Enqueue custom admin scripts and styles
 */
function custom_theme_admin_styles() {
	wp_register_style( 'admin-custom-style', get_theme_file_uri( '/assets/css/admin.css' ) , [], wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'admin-custom-style' );

	if ( in_array( basename($_SERVER['SCRIPT_NAME']), [ 'edit.php', 'edit-tags.php', 'post-new.php', 'post.php', 'upload.php', 'widgets.php', 'nav-menus.php' ] ) ) :
		echo '<style type="text/css">.wrap h1.wp-heading-inline {
			margin-top: 20px !important;
		}</style>';
	endif;

	if ( basename( $_SERVER['SCRIPT_NAME'] ) == 'options-general.php' ) :
		if ( ! empty( $_GET['page'] ) && $_GET['page'] == 'wpm-settings' ) :
			echo '';
		else :
			echo '<style type="text/css">.wrap h1 {
				margin-top: 20px !important;
			}</style>';
		endif;
	endif;

	if ( basename( $_SERVER['SCRIPT_NAME'] ) == 'term.php' ) :
		echo '<style type="text/css">.wrap h1 {
			margin-top: 20px !important;
		}</style>';
	endif;
}
add_action( 'admin_enqueue_scripts', 'custom_theme_admin_styles' );