<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package custom_theme
 */

?>
	</div><!-- #content -->
</div><!-- #page -->

<?php if ( ! is_post_type_archive( 'beers' ) && ! is_tax( 'series' ) ) : ?>
<div class="mt-4 pt-4 beer-list beer-list-full">
    <div class="container">
        <h2 class="mb-4<?php if ( ! is_front_page() ) : ?> text-center<?php endif; ?>"><?php _e( 'Latest beers', 'custom_theme' ) ?></h2>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            $query = new WP_Query( [
                'post_type' => 'beers',
                'posts_per_page' => 4,
                'offset' => 0,
            ] );
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post();
                    get_template_part( 'template-parts/archive', 'beers' );
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div class="col-12">
            <div class="text-center my-5">
                <a href="<?php echo get_post_type_archive_link( 'beers' ); ?>" class="btn btn-lg btn-danger btn-back"><?php _e( 'All beers', 'custom_theme' ) ?></a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<footer id="colophon" class="footer mt-auto py-3">
	<div class="container">
		<div class="text-center">
			&copy; 2019–<?php echo date('Y') ?> Custom Theme. <a href="<?php echo get_post_type_archive_link( 'beers' ); ?>"><?php _e( 'All beers', 'custom_theme' ) ?></a>
		</div><!-- .site-info -->
	</div><!-- .container -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
