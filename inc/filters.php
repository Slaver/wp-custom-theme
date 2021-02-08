<?php

add_action( 'wp_ajax_beerfilter', 'custom_theme_filter_function' ); 
add_action( 'wp_ajax_nopriv_beerfilter', 'custom_theme_filter_function' );
add_action( 'pre_get_posts', 'custom_theme_filter_get_posts' );
add_action( 'parse_query', 'custom_theme_disable_canonical_redirect' );

add_filter( 'pre_get_document_title', function() {
    $echo = false;
    $sep = apply_filters( 'document_title_separator', '&#8211;' );

    if ( get_post_type() === 'beers' ) :
        $params = custom_theme_filter_params();

        if ( $params['series'] ) :
            $echo = sprintf( esc_html__( 'Beers in %1$s series', 'custom_theme' ), single_term_title( '', false ) );
        endif;

        if ( $params['hops'] ) :
            $echo = sprintf( esc_html__( 'Beers with %1$s hops', 'custom_theme' ), single_term_title( '', false ) );
        endif;

        if ( $params['style'] ) :
            $echo = sprintf( esc_html__( 'Beers in %1$s style', 'custom_theme' ), single_term_title( '', false ) );
        endif;

        if ( $params['available'] ) :
            if ( ! empty($echo)) :
                $echo = $echo . " $sep " . esc_html__( 'Available now', 'custom_theme' );
            else :
                $echo = esc_html__( 'Available now', 'custom_theme' );
            endif;
        endif;

        if ( $echo ) :
            return $echo . " $sep " . get_bloginfo('name') . " $sep " . get_bloginfo('description');
        endif;
    else:
        return get_bloginfo('name') . " $sep " . get_bloginfo('description');
    endif;
} );

/**
 * GET Posts Filters
 * 
 * @url https://support.advancedcustomfields.com/forums/topic/get_field_object-return-false#post-76111
 * @param $query
 * @return mixed
 */
function custom_theme_filter_get_posts( $query ) {
    if ( is_admin() ) {
        return $query;
    }

    if ( isset( $query->query_vars['post_type']) && $query->query_vars['post_type'] == 'beers' ) {
        $params = custom_theme_filter_params();

        if ( $params['available'] ) {
            $query->set( 'meta_query', [[
                'key' => 'beer_available_now',
                'compare' => '=',
                'value' => '1',
            ]] );
        }

        if ( $params['collaboration'] ) {
            $query->set( 'meta_query', [[
                'key' => 'beer_collaborators',
                'compare' => '!=',
                'value' => '',
            ]] );
        }

        if ( $params['traits'] ) {
            foreach ( $params['traits'] as $trait ) :
                $query->set( 'meta_query', [[
                    'key' => 'beer_traits',
                    'compare' => 'LIKE',
                    'value' => $trait,
                ]] );
            endforeach;
        }

        if ( $params['tare'] ) {
            foreach ( $params['tare'] as $tare ) :
                $query->set( 'meta_query', [[
                    'key' => 'beer_tare',
                    'compare' => 'LIKE',
                    'value' => $tare,
                ]] );
            endforeach;
        }
    }

    return $query;
}

/**
 * @return array
 */
function custom_theme_filter_params() {
    return [
        'available' => filter_input( INPUT_GET, 'available', FILTER_SANITIZE_STRING ),
        'collaboration' => filter_input( INPUT_GET, 'collaboration', FILTER_SANITIZE_STRING ),
        'style' => filter_input( INPUT_GET, 'style', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ),
        'hops' => filter_input( INPUT_GET, 'hops', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ),
        'traits' => filter_input( INPUT_GET, 'traits', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ),
        'series' => filter_input( INPUT_GET, 'series', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ),
        'tare' => filter_input( INPUT_GET, 'tare', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY ),
    ];
}

/**
 * AJAX Post Filters
 */
function custom_theme_filter_function() {
    // Cache all ids and posts
    $ids = $posts = [];
    // Check if non empty query
    $ajax = false;

    // Search params
    $params = [
        'available' => [
            'key'      => 'beer_available_now',
            'compare'  => '=',
        ],
        'collaboration' => [
            'key'      => 'beer_collaborators',
            'compare'  => '!=',
            'value'    => '',
        ],
        'series' => [
            'taxonomy' => 'series',
            'field'    => 'slug',
            'operator' => 'IN'
        ],
        'style' => [
            'taxonomy' => 'style',
            'field'    => 'slug',
            'operator' => 'IN'
        ],
        'hops' => [
            'taxonomy' => 'hops',
            'field'    => 'slug',
            'operator' => 'IN',  
        ],
        'traits' => [
            'key'      => 'beer_traits',
            'compare'  => 'LIKE'
        ],
        'tare' => [
            'key'      => 'beer_tare',
            'compare'  => 'LIKE'
        ],
    ];

    // Pagination
    $paged = (isset($_POST['paged'])) ? $_POST['paged'] : 1;
    $posts_per_page = get_option( 'posts_per_page' );
    $offset = ( $posts_per_page * ( $paged - 2 ) ) + get_option('posts_per_page');

    // Default search args
    $default = [
        'post_type' => 'beers',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
		'post_status' => 'publish',
        'offset' => $offset,
        'paged' => $paged,
    ];

    $args = [];
    foreach ( $params as $type => $param ) :
        if ( ! empty( $_POST[ $type ] ) ) :
            $ajax = true;

            if ( $type === 'hops' ) :
                $args['tax_query'][] = custom_theme_filter_hops_styles();
            endif;

            if ( ! empty( $param[ 'field' ] ) ) :
                $args['tax_query'][] = array_merge( [ 'terms' => $_POST[ $type ] ], $param );
            else :
                $args['meta_query']['relation'] = 'AND';
                if ( is_array( $_POST[ $type ] ) ) :
                    foreach ( $_POST[ $type ] as $search ) :
                        $args['meta_query'][] = [
                            'key'     => $param['key'],
                            'compare' => $param['compare'],
                            'value'	  => $search,
                        ];
                    endforeach;
                else :
                    $args['meta_query'][] = [
                        'key'     => $param['key'],
                        'compare' => $param['compare'],
                        'value'	  => (isset($param['value'])) ? $param['value'] : $_POST[$type],
                    ];
                endif;
            endif;
        endif;
    endforeach;

    $query = new WP_Query( array_merge( $default, $args ) );
    foreach ( $query->posts as $post ) :
        $posts[$post->ID] = $post;
        $ids[$type][] = $post->ID;
    endforeach;

    if ( $ajax ) :
        // Filters
        if ( count($ids) > 1 ) :
            $intersect = call_user_func_array( 'array_intersect', $ids );
        else :
            $intersect = array_reduce( $ids, 'array_merge', [] );
        endif;
    
        foreach ( $intersect as $id ) :
            $result[] = $posts[$id];
        endforeach;

    else :
        // Show all
        $query = new WP_Query( $default );
        foreach ( $query->posts as $post ) :
            $result[] = $post;
        endforeach;
    endif;

    if ( ! empty( $result ) ) :
        foreach ( $result as $post ) :
            $output['posts'][] = [
                'id' => $post->ID,
                'url' => get_permalink( $post->ID ),
                'title' => $post->post_title,
                'image' => get_the_post_thumbnail_url( $post->ID ),
                'subtitle' => get_field( 'beer_subtitle', $post->ID ),
                //'new' => get_field( 'beer_new', $post->ID ),
            ];
        endforeach;
        $output['data'] = [
            'count' => $query->post_count,
            'total' => $query->found_posts,
            'pages' => $query->max_num_pages
        ];
    else :
        $output['error'] = __( 'Sorry, but nothing matched your search criteria', 'custom_theme' );
    endif;
    wp_reset_postdata();

    echo json_encode( $output );
    wp_die();

}

/**
 * Don't redirect '?paged=' urls
 *
 * @param $query
 */
function custom_theme_disable_canonical_redirect( $query ) {
    if ( ! empty( $query->query_vars['paged'] ) ) {
        remove_filter('template_redirect', 'redirect_canonical');
    }
}

/**
 * List of styles for showing related hops
 */
function custom_theme_filter_hops_list() {
    return [ 'Double IPA', 'Grisette', 'IPA', 'Milkshake IPA', 'New England IPA', 'Saison', 'Sour IPA', 'Triple IPA' ];
}

/**
 * Custom filter rules for beers' hops with defined styles
 */
function custom_theme_filter_hops_styles() {
    return [
        [
            'taxonomy' => 'style',
            'field' => 'name',
            'terms' => custom_theme_filter_hops_list(),
        ]
    ];
}