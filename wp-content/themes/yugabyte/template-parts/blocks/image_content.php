<?php
/**
 * Image Content Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'img_cont-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'img_cont';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$flip = get_field('flip');
$cont = get_field('cont');
$image = get_field('image');
$img_src = $image['sizes']['large'];
$img_alt = $image['alt'];

$flip_class_img = ( $flip ) ? 'col-1-2 mobile-col-1-1 img' : 'col-1-2 mobile-col-1-1 push-right img';
$flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right cont' : 'col-1-2 mobile-col-1-1 cont';

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid eq_h nopadding">
                <div class="eq_r nopadding <?php echo $flip_class_img; ?>">
                    <div class="inner">
                        <div class="inner_content">
                            <?php echo '<img src="'.$img_src.'" alt="'.$img_alt.'" />'; ?>
                        </div>
                    </div>
                </div>
                <div class="eq_l nopadding <?php echo $flip_class_cont; ?>">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php echo $cont; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>