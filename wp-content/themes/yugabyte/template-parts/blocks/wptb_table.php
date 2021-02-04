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
$heading = get_field('heading');
$intro = get_field('intro');
$wptb_sc = get_field('wptb_sc');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner full">
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
            <div class="col-8-12 push-2-12 mobile-col-1-1 nopadding">
                <?php
                echo do_shortcode($wptb_sc);
                ?>
            </div>
        </div>
    </div>
</div>