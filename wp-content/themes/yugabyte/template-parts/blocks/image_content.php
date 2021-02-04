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
$flip = get_field('flip');
$wide_img_col = get_field('wide_img_col');
$vert_align = get_field('vert_align');
$cont = get_field('cont') ?: 'Lorem ipsum dolor sit amet...';
$image = get_field('image') ?: 335;
$img_src = $image['sizes']['large'];
$img_alt = $image['alt'];

$flip_class_img = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right img' : 'col-1-2 mobile-col-1-1 img';
$flip_class_cont = ( $flip ) ? 'col-5-12 mobile-col-1-1 cont' : 'col-5-12 push-1-12 mobile-col-1-1 push-right cont';

if( $flip ) {
    if( $wide_img_col ) {
        $flip_class_img = 'col-7-12 mobile-col-1-1 push-right img';
        $flip_class_cont = 'col-4-12 mobile-col-1-1 cont';
    } else {
        $flip_class_img = 'col-1-2 mobile-col-1-1 push-right img';
        $flip_class_cont = 'col-5-12 mobile-col-1-1 cont';
    }
    
} else {
    if( $wide_img_col ) {
        $flip_class_img = 'col-7-12 mobile-col-1-1 img';
        $flip_class_cont = 'col-4-12 push-1-12 mobile-col-1-1 push-right cont';
    } else {
        $flip_class_img = 'col-1-2 mobile-col-1-1 img';
        $flip_class_cont = 'col-5-12 push-1-12 mobile-col-1-1 push-right cont';
    }
}

$vert_align_class = ( $vert_align ) ? 'vert_align' : '';

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section">
    <div class="content_section_inner <?php echo esc_attr($className); ?>">
        <div class="clearfix <?php echo esc_attr($vert_align_class); ?>">
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