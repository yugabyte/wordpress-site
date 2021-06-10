<?php
/**
 * Inset Right Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'inset_right_col-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'inset_right_col';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$cont_left = get_field('cont_left');
$cont_right = get_field('cont_right');

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix">
            <div class="grid nopadding">
                <div class="left col-8-12 mobile-col-1-1 nopadding">
                    <div class="inner wysiwyg">
                        <?php echo $cont_left; ?>
                    </div>
                </div>
                <div class="right col-4-12 mobile-col-1-1 nopadding">
                    <div class="inner wysiwyg">
                        <?php echo $cont_right; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>