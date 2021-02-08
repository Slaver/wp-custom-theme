<?php
/**
 * Template part for displaying archive in archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package custom_theme
 */

?>

<a href="<?php the_permalink() ?>" class="card" title="<?php the_title(); ?>">
    <div class="card-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_field( 'beer_subtitle' ); ?>" />
        <?php else: ?>
		    <img src="https://fakeimg.pl/200x200/" alt="" />
        <?php endif; ?>

        <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center<?php if ( get_field( 'beer_new' ) ): ?> card-img-new<?php endif; ?>"></div>
    </div>
</a>
