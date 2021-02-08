<?php

/**
 * Ajax support
 */
function custom_theme_ajaxurl() { ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        /* ]]> */
    </script>
    <?php
}
add_action( 'wp_head', 'custom_theme_ajaxurl' );

/**
 * Load posts by ajax
 *
 * @url https://wordpress.stackexchange.com/questions/302209/get-posts-with-ajax/302212
 */
function custom_theme_ajax_load() {
    $output = '';

    $url = ( isset( $_POST['url'] ) ) ? $_POST['url'] : false;

    if ( $url ) {
        $id = url_to_postid( $url );
        $loop = new WP_Query( [
            'p' => $id,
            'post_type' => 'page',
        ] );

        if ( $loop->have_posts() ) :
            while ( $loop->have_posts() ) : $loop->the_post();
                $output = [
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                ];
            endwhile;
        endif;
        wp_reset_postdata();
    }

    echo json_encode( $output );
    wp_die();
}

add_action( 'wp_ajax_ajax_load', 'custom_theme_ajax_load' );
add_action( 'wp_ajax_nopriv_ajax_load', 'custom_theme_ajax_load' );