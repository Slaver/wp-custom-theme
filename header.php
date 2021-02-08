<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package custom_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="h-100">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&amp;subset=cyrillic-ext">
</head>

<body <?php body_class( 'd-flex flex-column h-100' ); ?>>

<div id="page">

	<div class="jumbotron mb-0">

		<div class="container">
			<div class="jumbotron-content d-flex flex-column text-center">
				<div class="jumbotron-content-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="https://fakeimg.pl/300x300/?text=Logo" alt="" />
					</a>
				</div>

				<?php
                if ( function_exists( 'wpm' ) ) :
                    custom_theme_language_switcher( 'jumbotron-content-languages' );
                endif;
                ?>
			</div>
		</div>
	</div>

	<div class="container">
