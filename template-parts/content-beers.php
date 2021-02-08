<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package custom_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-beer' ); ?>>

    <header class="entry-header text-center">
        <h1 class="entry-title mb-2<?php if ( get_field( 'beer_available_now' ) ): ?> pl-2<?php endif; ?>">
            <?php the_title(); ?><?php if ( get_field( 'beer_available_now' ) ): ?><span class="available ml-2" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Available now', 'custom_theme' ) ?>"></span><?php endif; ?>
        </h1>

        <div class="mb-3 mb-md-5">
            <p class="beer-subtitle">
            <?php if ( get_field( 'beer_subtitle' ) ): ?>
                <span class="text-uppercase"><?php the_field( 'beer_subtitle' ); ?></span>
            <?php endif; ?>
            <?php if ( get_field( 'beer_collaborators' ) ): ?>
                × <span class="text-uppercase"><?php _e( 'Collaboration with', 'custom_theme' ) ?> <?php the_field( 'beer_collaborators' ); ?></span>
            <?php endif; ?>
            </p>
        </div>
    </header>

    <?php
    $term = get_queried_object();
    $beer_style = get_field( 'beer_style', $term );
    $beer_flavors = get_field( 'beer_flavors', $term );
    $beer_type = get_field( 'beer_type' );
    $beer_traits = get_field( 'beer_traits' );
    $beer_tare = get_field( 'beer_tare' );
    $beer_abv = get_field( 'beer_abv' );
    $beer_series = get_field( 'beer_series' );

    $beer_hops = get_field( 'beer_hops', $term );
    $beer_yeast = false; //get_field( 'beer_yeast', $term );
    $beer_malts = get_field( 'beer_malts', $term );
    $beer_ingredients = get_field( 'beer_ingredients', $term );

    $beer_temperature = get_field( 'beer_temperature' );
    $beer_glass = get_field( 'beer_glass' );
    $beer_food_pairing = get_field( 'beer_food_pairing', $term );

    $beer_untappd_url = get_field( 'beer_untappd_url', $term );
    $beer_ratebeer_url = get_field( 'beer_ratebeer_url', $term );
    $beer_pivoby_url = get_field( 'beer_pivoby_url', $term );

    $transient_expires = false;
    $available_places = [];

    if ( get_field( 'beer_available_now' ) ) :

        if ( $transient = get_transient( 'your_beer_on_sale' ) ) :
            $transient_expires = (int) get_option( '_transient_timeout_your_beer_on_sale', 0 );
            $data = json_decode($transient);
            foreach ( $data->places as $place ) :
                foreach ( $place->beers as $beer ) :
                    if ( $beer->name == get_the_title() ) :
                        $available_places[ $place->id ] = [
                            'title' => trim($place->name),
                            'city' => $place->city,
                            'address' => $place->address,
                            'cord' => $place->cord,
                            'link' => 'https://your.beer/place/' . $place->slug,
                            'phones' => ($place->phones) ? implode(', ', $place->phones) : '',
                        ];
                    endif;
                endforeach;
            endforeach;
        endif;
    endif;

    ?>

    <div class="row">

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-5 mb-4 mb-md-0">
            <?php custom_theme_post_thumbnail(); ?>
            <div class="text-center mt-4">
                <?php if ( $beer_untappd_url ): ?>
                    <a href="<?php echo $beer_untappd_url ?>" class="btn btn-social"><i class="fab fa-untappd"></i> Untappd</a>
                <?php endif; ?>
                <?php if ( $beer_ratebeer_url ): ?>
                    <a href="<?php echo $beer_ratebeer_url ?>" class="btn btn-social btn-ratebeer">RateBeer</a>
                <?php endif; ?>
                <?php if ( get_field( 'beer_available_now' ) && ! empty ( $available_places ) ) : ?>
                    <p class="mt-2">
                        <a href="<?php echo $beer_pivoby_url ?>" class="btn btn-light btn-outline-danger"><?php _e( 'Where to buy', 'custom_theme' ) ?></a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-xs-12 col-sm-12 col-md-12 <?php if ( has_post_thumbnail() ) : ?>col-lg-6 col-xl-7<?php else : ?>col-lg-12 col-xl-12<?php endif; ?>">

            <?php
            the_content();
            ?>

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 <?php if ( has_post_thumbnail() ) : ?>col-lg-12 col-xl-12<?php else : ?>col-lg-6 col-xl-6<?php endif; ?>">

                    <h4 class="py-2"><?php _e( 'Beer Specs', 'custom_theme' ) ?></h4>

                    <table class="table">
                        <tbody>
                        <?php if ( $beer_style ): ?>
                            <tr>
                                <th><?php _e( 'Style', 'custom_theme' ) ?></th><td><?php echo $beer_style->name; ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_series ): ?>
                            <tr>
                                <th>
                                    <?php if ( $lang !== 'en' ) : ?>
                                        <?php _e( 'Serie', 'custom_theme' ) ?>
                                    <?php else : ?>
                                        <?php _e( 'Series', 'custom_theme' ) ?>
                                    <?php endif; ?>
                                </th>

                                <td><a href="<?php echo home_url( '/beers/?series[]=' . $beer_series->slug ) ?>"><?php echo $beer_series->name; ?></a></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'beer_start_date' ) ): ?>
                            <tr>
                                <th>
                                    <?php if ( ! empty($beer_type['label']) && $beer_type['value'] !== 'oneoff' ) : ?>
                                        <?php _e( 'First release date', 'custom_theme' ) ?>
                                    <?php else : ?>
                                        <?php _e( 'Release date', 'custom_theme' ) ?>
                                    <?php endif; ?>
                                </th>
                                <td><?php the_field( 'beer_start_date' ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_abv ): ?>
                            <tr>
                                <th><?php _e( 'ABV', 'custom_theme' ) ?></th><td><?php echo number_format( $beer_abv, 1, ',', '' ); ?>%</td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'beer_og' ) ): ?>
                            <tr>
                                <th><?php _e( 'OG', 'custom_theme' ) ?></th><td><?php the_field( 'beer_og' ); ?>°</td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'beer_ibu' ) ): ?>
                            <tr>
                                <th><?php _e( 'IBU', 'custom_theme' ) ?></th><td><?php the_field( 'beer_ibu' ); ?><?php if ( $lang !== 'en' ) : ?> IBU<?php endif; ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_type ): ?>
                            <tr>
                                <th><?php _e( 'Type', 'custom_theme' ) ?></th><td class="text-lowercase"><?php _e( $beer_type['label'], 'custom_theme' ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_traits ): ?>
                            <tr>
                                <th><?php _e( 'Traits', 'custom_theme' ) ?></th><td class="text-lowercase">
                                    <?php
                                    foreach ( $beer_traits as $trait ) :
                                        $traits[] = __( $trait['label'], 'custom_theme' );
                                    endforeach;
                                    echo implode( ', ', $traits );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_tare ): ?>
                            <tr>
                                <th><?php _e( 'Tare', 'custom_theme' ) ?></th><td class="text-lowercase">
                                    <?php
                                    foreach ( $beer_tare as $tare ) :
                                        $tares[] = __( $tare['label'], 'custom_theme' );
                                    endforeach;
                                    echo implode( ', ', $tares );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_flavors ): ?>
                            <tr>
                                <th><?php _e( 'Flavor', 'custom_theme' ) ?></th><td class="text-lowercase">
                                    <?php
                                    foreach ( $beer_flavors as $flavor ) :
                                        $flavors[] = $flavor->name;
                                    endforeach;
                                    echo implode( ', ', $flavors );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>

                    <h4 class="py-2"><?php _e( 'Ingredients', 'custom_theme' ) ?></h4>

                    <table class="table">
                        <tbody>
                        <?php if ( $beer_hops && in_array( $beer_style->name, custom_filter_hops_list() ) ) : ?>
                            <tr>
                                <th><?php _e( 'Hops', 'custom_theme' ) ?></th><td>
                                    <?php
                                    foreach ( $beer_hops as $hop ) :
                                        //$hops[] = '<a href="'.get_term_link( $hop ).'">'.$hop->name.'</a>';
                                        $hops[] = '<a href="'.home_url( '/beers/?hops[]=' . $hop->slug ).'">'.$hop->name.'</a>';
                                    endforeach;
                                    echo implode( ', ', $hops );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_malts ): ?>
                            <tr>
                                <th><?php _e( 'Malts', 'custom_theme' ) ?></th><td>
                                    <?php
                                    foreach ( $beer_malts as $malt ) :
                                        $malts[] = $malt->name;
                                    endforeach;
                                    echo implode( ', ', $malts );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_yeast ): ?>
                            <tr>
                                <th><?php _e( 'Yeast', 'custom_theme' ) ?></th><td>
                                    <?php
                                    foreach ( $beer_yeast as $yeast ) :
                                        $yeasts[] = $yeast->name;
                                    endforeach;
                                    echo implode( ', ', $yeasts );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if ( $beer_ingredients ): ?>
                            <tr>
                                <th><?php _e( 'Other Ingredients', 'custom_theme' ) ?></th><td>
                                    <?php
                                    foreach ( $beer_ingredients as $ingredient ) :
                                        $ingredients[] = $ingredient->name;
                                    endforeach;
                                    echo implode( ', ', $ingredients );
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 <?php if ( has_post_thumbnail() ) : ?>col-lg-12 col-xl-12<?php else : ?>col-lg-6 col-xl-6<?php endif; ?>">

                    <?php if ( $beer_temperature || $beer_glass || $beer_food_pairing ) : ?>

                        <h4 class="py-2"><?php _e( 'Serving', 'custom_theme' ) ?></h4>

                        <table class="table">
                            <tbody>
                            <?php if ( $beer_temperature ): ?>
                                <tr>
                                    <th><?php _e( 'Serving temperature', 'custom_theme' ) ?></th><td>
                                        <?php echo $beer_temperature ?>°
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if ( $beer_glass ): ?>
                                <tr>
                                    <th><?php _e( 'Serving glass', 'custom_theme' ) ?></th><td>
                                        <?php if ( $lang !== 'en' ) : ?>
                                            <a href="<?php echo esc_url( home_url( 'glasses' ) ); ?>" class="pseudo text-lowercase"><?php _e( $beer_glass, 'custom_theme' ) ?></a>
                                        <?php else : ?>
                                            <?php _e( $beer_glass, 'custom_theme' ) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if ( $beer_food_pairing ): ?>
                                <tr>
                                    <th><?php _e( 'Food pairing', 'custom_theme' ) ?></th><td>
                                        <?php
                                        foreach ( $beer_food_pairing as $food ) :
                                            $foods[] = $food->name;
                                        endforeach;
                                        echo implode( ', ', $foods );
                                        ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <h4 class="py-2"><?php _e( 'Flavor Profiles', 'custom_theme' ) ?></h4>

                    <?php
                    $profiles = [
                        'beer_taste_crisp_clean', 'beer_taste_hoppy_bitter', 'beer_taste_malty_sweet',
                        'beer_taste_dark_roasty', 'beer_taste_fruit_spice', 'beer_taste_sour_tart_funky'
                    ];
                    ?>

                    <?php foreach ( $profiles as $profile ) : ?>
                        <?php if ( ! empty( get_field_object( $profile )['label'] ) ) : ?>
                        <div class="d-flex flex-column flex-md-row px-2 px-md-3 pt-1 pb-3">
                            <div class="entry-beer-taste-title text-lowercase">
                                <strong><?php _e( get_field_object( $profile )['label'], 'custom_theme' ) ?></strong>
                            </div>
                            <div class="align-middle flex-fill pt-2">
                                <div class="progress">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo get_field( $profile ) * 20 ?>%;"></div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>


    </div>

</article>