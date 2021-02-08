<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package custom_theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page-header text-center">
				<h1 class="page-title">
					<?php _e( 'Our beers', 'custom_theme' ) ?>
				</h1>
			</header><!-- .page-header -->

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <?php
                    get_template_part( 'template-parts/filters', 'beers' );
                    ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">

                    <div class="spinner justify-content-center text-center m-5" style="display: none;">
                        <div class="spinner-border">
                            <span class="sr-only"><?php echo __( 'Loading…', 'custom_theme' ); ?></span>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start beer-list pt-3 my-3" style="border: 0;">

                        <?php
                        if ( have_posts() ) :
                            /* Start the Loop */
                            while ( have_posts() ) :
                                the_post();
    
                                /*
                                 * Include the Post-Type-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/archive', get_post_type() );
    
                            endwhile;
                        else :

                            _e( 'Sorry, but nothing matched your search criteria', 'custom_theme' );

                        endif;
                        ?>

                    </div>

                    <?php
                    $current_page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    ?>
                    <div class="mt-4 mb-3 text-center">
                        <button type="button" class="btn btn btn-outline-dark btn-lg load-more" data-next="<?php echo $current_page + 1; ?>" <?php if ( $wp_query->max_num_pages <= $current_page ) : ?> style="display: none"<?php endif; ?>><?php echo __( 'Load more', 'custom_theme' ); ?></button>
                    </div>
                </div>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();