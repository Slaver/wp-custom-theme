<?php
/**
 * Custom functions for WP Multilang
 * 
 * @url https://github.com/VaLeXaR/wp-multilang
 */

if ( function_exists( 'wpm' ) ) :

    $post_types = get_post_types();

    $post_types['beers'] = 'beers';
    
    foreach ( $post_types as $post_type ) {
        if ( null === wpm_get_post_config( $post_type ) ) {
            continue;
        }
    
        add_action( "manage_{$post_type}_posts_custom_column", 'custom_theme_render_posts_language_column' );
    }
    
    $taxonomies = get_taxonomies();
    
    foreach ( $taxonomies as $taxonomy ) {
        if ( null === wpm_get_taxonomy_config( $taxonomy ) ) {
            continue;
        }
    
        add_filter( "manage_{$taxonomy}_custom_column", 'custom_theme_render_taxonomy_language_column', 10, 3 );
    }

endif;

function custom_theme_render_posts_language_column( $column ) {
	if ( 'languages' === $column ) {
		$post      = wpm_untranslate_post( get_post() );
		$output    = [];
		$text      = $post->post_title . $post->post_content;
		$strings   = wpm_value_to_ml_array( $text );
		$languages = wpm_get_lang_option();

		foreach ( $languages as $code => $language ) {
			if ( isset( $strings[ $code ] ) && ! empty( $strings[ $code ] ) ) {
				if ( wpm_get_language() == $code ) :
					$output[] = '<strong>' . strtoupper( $code ) . '</strong>';
				else :
					$output[] = strtoupper( $code );
				endif;
			}
		}

		if ( ! empty( $output ) ) {
			echo implode( ' ', $output );
		}
	}
}

function custom_theme_render_taxonomy_language_column( $columns, $column, $term_id ) {
	if ( 'languages' === $column ) {
		remove_filter( 'get_term', 'wpm_translate_term', 5 );
		$term = get_term( $term_id );
		add_filter( 'get_term', 'wpm_translate_term', 5, 2 );
		$output    = array();
		$text      = $term->name . $term->description;
		$strings   = wpm_value_to_ml_array( $text );
		$languages = wpm_get_lang_option();

		foreach ( $languages as $code => $language ) {
			if ( isset( $strings[ $code ] ) && ! empty( $strings[ $code ] ) ) {
				if ( wpm_get_language() == $code ) :
					$output[] = '<strong>' . strtoupper( $code ) . '</strong>';
				else :
					$output[] = strtoupper( $code );
				endif;
			}
		}

		if ( ! empty( $output ) ) {
			$columns .= implode( ' ', $output );
		}
	}

	return $columns;
}