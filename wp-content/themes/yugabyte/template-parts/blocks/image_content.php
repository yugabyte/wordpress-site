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
$narrow_block = get_field('narrow_block');
$wide_content = get_field('wide_content');
$wide_img = get_field('wide_img');
$zoomable = get_field('zoomable');
$narrow_img = get_field('narrow_img');
$cont = get_field('cont');
$image = get_field('image');
$img_src = $image['sizes']['large'];
$img_alt = $image['alt'];

if( $wide_content ) {
    if( $narrow_img ) {
        $flip_class_img = ( $flip ) ? 'col-3-12 push-2-12 mobile-col-1-1 img' : 'col-3-12 mobile-col-1-1 push-right img';
        $flip_class_cont = ( $flip ) ? 'col-6-12 mobile-col-1-1 cont' : 'col-6-12 mobile-col-1-1 cont';
    } else {
        $flip_class_img = ( $flip ) ? 'col-5-12 mobile-col-1-1 img' : 'col-5-12 mobile-col-1-1 push-right img';
        $flip_class_cont = ( $flip ) ? 'col-7-12 mobile-col-1-1 push-right cont' : 'col-7-12 mobile-col-1-1 cont';
    }
} else {
    if( $narrow_img ) {
        $flip_class_img = ( $flip ) ? 'col-3-12 push-2-12 mobile-col-1-1 img' : 'col-6-12 mobile-col-1-1 push-right img';
        $flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 cont' : 'col-1-2 mobile-col-1-1 cont';
    } else {
        $flip_class_img = ( $flip ) ? 'col-1-2 mobile-col-1-1 img' : 'col-1-2 mobile-col-1-1 push-right img';
        $flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right cont' : 'col-1-2 mobile-col-1-1 cont';
    }
}
//if the 'wide image' field is checked, it'll trump all others
if( $wide_img ) {
    $flip_class_img = ( $flip ) ? 'col-7-12 mobile-col-1-1 img' : 'col-7-12 mobile-col-1-1 push-right img';
    $flip_class_cont = ( $flip ) ? 'col-5-12 mobile-col-1-1 push-right cont' : 'col-5-12 mobile-col-1-1 cont';
}

$bg_color_class = ( $bg_color ) ? $bg_color : '';
$wide_class = ( $wide_content ) ? 'wide_content' : '';
$flip_class = ( $flip ) ? 'flip' : '';
$z_class = ( $zoomable ) ? 'zoomable' : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?> <?php echo $flip_class; ?> <?php echo $wide_class; ?>">
    <div class="content_section_inner">
        <div class="clearfix vert_align">
            <?php
            if( $narrow_block ) {
                echo '<div class="grid">';
                echo '<div class="col-10-12 push-1-12 mobile-col-1-1">';
            }
            ?>
            <div class="grid nopadding">
                <div class="eq_r nopadding <?php echo $flip_class_img; ?>">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( $zoomable ) {
                                echo '<div class="zoom_cont '.$z_class.'">';
                                echo '<img src="'.$img_src.'" alt="'.$img_alt.'" />';
                                echo '<div class="hover_prompt"></div>';
                                echo '</div>';
                            } else {
                                echo '<img src="'.$img_src.'" alt="'.$img_alt.'" />';
                            }
                            ?>
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
            <?php
            if( $narrow_block ) {
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>