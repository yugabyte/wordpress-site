<?php
/**
 * WP Table Builder Table Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ybtable-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ybtable';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$intro = get_field('intro');
$wptb_sc = get_field('wptb_sc');
$table_footnote = get_field('table_footnote');
$narrow_table = get_field('narrow_table');

$table_grid_classes = ( $narrow_table ) ? 'col-6-12 push-3-12 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1 nopadding narrow_table' : 'col-8-12 push-2-12 tablet-col-10-12 tablet-push-1-12 mobile-col-1-1 nopadding';
$bg_color_class = ( $bg_color ) ? $bg_color : 'white';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner full tall_pad">
        <div class="grid nopadding">
            <div class="col-8-12 push-2-12 mobile-col-1-1 nopadding centered">
            <?php
            if( $heading ) {
                echo '<h2 class="lined">'.$heading.'</h2>';
            }
            if( $intro ) {
                echo $intro;
            }
            ?>
            </div>
        </div>
        <div class="grid nopadding">
            <div class="<?php echo $table_grid_classes; ?>">
                <?php
                echo do_shortcode($wptb_sc);
                if( $table_footnote ) {
                    echo '<p class="table_footnote">'.$table_footnote.'</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>