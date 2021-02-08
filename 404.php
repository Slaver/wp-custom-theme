<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package custom_theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <header class="page-header text-center">
                <h1 class="page-title">
                    <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'custom_theme' ); ?>
                </h1>
            </header><!-- .page-header -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
