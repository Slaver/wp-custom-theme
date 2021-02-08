<?php
$params = custom_theme_filter_params();
?>
<form method="POST" class="beer-filters mt-3">
    <div class="row rounded-md py-2 pt-3">
        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input name="available" type="checkbox" class="custom-control-input" value="1" id="beer_available" <?php if ($params['available']) : ?> checked<?php endif; ?>>
                    <label class="custom-control-label" for="beer_available"><?php echo __( 'Available now' , 'custom_theme' ) ?></label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="collaboration" type="checkbox" class="custom-control-input" value="1" id="beer_collaboration" <?php if ($params['collaboration']) : ?> checked<?php endif; ?>>
                    <label class="custom-control-label" for="beer_collaboration"><?php echo __( 'Collaboration' , 'custom_theme' ) ?></label>
                </div>
            </div>
        </fieldset>

        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <h5 class="beer-filters-title active"><?php echo __( 'Tare', 'custom_theme' ) ?></h5>
            <div class="form-group">
                <?php
                $tare = get_field_object('beer_tare');
                if ( ! empty( $tare['choices'] ) ) :
                    foreach ( $tare['choices'] as $tare_slug => $tare_value ) :
                        $checked = $params['tare'] && in_array($tare_slug, $params['tare']);
                        echo '<div class="custom-control custom-checkbox">
                            <input name="tare[]" type="checkbox" class="custom-control-input" value="' . $tare_slug . '" id="tare_' . $tare_slug . '" ' . ($checked ? ' checked' : '') . '>
                            <label class="custom-control-label" for="tare_' . $tare_slug . '">' . __( $tare_value, 'custom_theme' ) . '</label>
                        </div>';
                    endforeach;
                endif;
                ?>
            </div>
        </fieldset>

        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <h5 class="beer-filters-title active"><?php echo __( 'Style', 'custom_theme' ) ?></h5>
            <div class="form-group">
                <?php
                if ( $terms = get_terms( [
                    'taxonomy' => 'style',
                    'orderby' => 'name'
                ] ) ) :
                    // if categories exist, display the dropdown
                    foreach ( $terms as $term ) :
                        $checked = $params['style'] && in_array($term->slug, $params['style']);
                        echo '<div class="custom-control custom-checkbox">
                            <input name="style[]" type="checkbox" class="custom-control-input" value="' . $term->slug . '" id="style_' . $term->slug . '" ' . ($checked ? ' checked' : '') . '>
                            <label class="custom-control-label" for="style_' . $term->slug . '">' . $term->name . '</label>
                        </div>';
                    endforeach;
                endif;
                ?>
            </div>
        </fieldset>

        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <h5 class="beer-filters-title <?php if (isset($_GET['series'])) : ?> active<?php endif; ?>"><?php _e( 'Series', 'custom_theme' ) ?></h5>
            <div class="form-group <?php if ( ! isset($_GET['series'])) : ?> d-none<?php endif; ?>">
                <?php
                if ( $terms = get_terms( [
                    'taxonomy' => 'series',
                    'orderby' => 'name'
                ] ) ) :
                    // if categories exist, display the dropdown
                    foreach ( $terms as $term ) :
                        $checked = $params['series'] && in_array($term->slug, $params['series']);
                        echo '<div class="custom-control custom-checkbox">
                            <input name="series[]" type="checkbox" class="custom-control-input" value="' . $term->slug . '" id="series_' . $term->slug . '" ' . ($checked ? ' checked' : '') . '>
                            <label class="custom-control-label" for="series_' . $term->slug . '">' . $term->name . '</label>
                        </div>';
                    endforeach;
                endif;
                ?>
            </div>
        </fieldset>

        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <h5 class="beer-filters-title <?php if (isset($_GET['hops'])) : ?> active<?php endif; ?>"><?php echo __( 'Hops', 'custom_theme' ) ?></h5>
            <div class="form-group <?php if ( ! isset($_GET['hops'])) : ?> d-none<?php endif; ?>">
                <?php
                $objects_ids = [];
                $objects = get_posts( [ 
                    'post_type' => 'beers',
                    'numberposts' => -1,
                    'tax_query' => custom_theme_filter_hops_styles()
                ] );
                foreach ($objects as $object) {
                    $objects_ids[] = $object->ID;
                }

                if ( $terms = wp_get_object_terms( $objects_ids, 'hops' ) ) :
                    // if categories exist, display the dropdown
                    foreach ( $terms as $term ) :
                        $checked = $params['hops'] && in_array($term->slug, $params['hops']);
                        echo '<div class="custom-control custom-checkbox">
                            <input name="hops[]" type="checkbox" class="custom-control-input" value="' . $term->slug . '" id="hops_' . $term->slug . '" ' . ($checked ? ' checked' : '') . '>
                            <label class="custom-control-label" for="hops_' . $term->slug . '">' . $term->name . '</label>
                        </div>';
                    endforeach;
                endif;
                ?>
            </div>
        </fieldset>

        <fieldset class="col-xs-12 col-sm-12 col-md-4 col-lg-12 col-xl-12">
            <h5 class="beer-filters-title <?php if (isset($_GET['traits'])) : ?> active<?php endif; ?>"><?php echo __( 'Traits', 'custom_theme' ) ?></h5>
            <div class="form-group <?php if ( ! isset($_GET['traits'])) : ?> d-none<?php endif; ?>">
                <?php
                $traits = get_field_object('beer_traits');
                if ( ! empty( $traits['choices'] ) ) :
                    foreach ( $traits['choices'] as $trait_slug => $trait_value ) :
                        $checked = $params['traits'] && in_array($trait_slug, $params['traits']);
                        echo '<div class="custom-control custom-checkbox">
                            <input name="traits[]" type="checkbox" class="custom-control-input" value="' . $trait_slug . '" id="traits_' . $trait_slug . '" ' . ($checked ? ' checked' : '') . '>
                            <label class="custom-control-label" for="traits_' . $trait_slug . '">' . __( $trait_value, 'custom_theme' ) . '</label>
                        </div>';
                    endforeach;
                endif;
                ?>
            </div>
        </fieldset>
    </div>

    <?php
    
    ?>

    <!--<input type="hidden" name="page" value="">-->
    <input type="hidden" name="action" value="beerfilter">
</form>