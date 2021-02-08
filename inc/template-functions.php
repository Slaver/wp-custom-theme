<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function custom_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'custom_theme_body_classes' );

/**
 * Display language switcher in templates
 *
 * @param string $class
 *
 * @return string
 */
function custom_theme_language_switcher( $class = '' ) {
	$lang = wpm_get_language();
	$languages = wpm_get_languages();
	$codes = [ 'be' => 'БЕ', 'ru' => 'РУ', 'en' => 'EN' ];
	?>
	<ul class="<?php echo $class ?>">
		<?php foreach ( $languages as $code => $language ) { ?>
			<li<?php if ( $code === $lang ) { ?> class="active"<?php } ?>>
			<?php if ( wpm_get_language() == $code ) { ?>
				<span data-lang="<?php echo esc_attr( $code ); ?>">
					<?php } else { ?>
						<a href="<?php echo esc_url( wpm_translate_current_url( $code ) ); ?>" data-lang="<?php echo esc_attr( $code ); ?>">
					<?php } ?>
						<span><?php echo $codes[ $code ]; ?></span>
				<?php if ( wpm_get_language() == $code ) { ?>
					</span>
				<?php } else { ?>
					</a>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
<?php
}

/**
 * Advanced Custom Fields placeholders
 */
if ( ! function_exists( 'get_field' ) ) :
    function get_field( $selector, $post_id = false, $format_value = true ) {
        return;
    }
endif;

if ( ! function_exists( 'get_field_object' ) ) :
    function get_field_object( $selector, $post_id = false, $format_value = true, $load_value = true ) {
        return;
    }
endif;

// 