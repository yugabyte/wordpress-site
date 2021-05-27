<?php
/**
 * Content Logos Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'metrics_cont-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'metrics_cont';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$bg_image = get_field('bg_image');
$flip = get_field('flip');
$cont = get_field('cont');

$flip_class_metrics = ( $flip ) ? 'col-1-2 mobile-col-1-1 metrics' : 'col-1-2 mobile-col-1-1 push-right metrics';
$flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right cont flip' : 'col-1-2 mobile-col-1-1 cont';

$bg_color_class = ( $bg_color ) ? $bg_color : '';
if( $bg_image ) {
    $bg_image_src = $bg_image['url'];
    $bg_img_set = 'style="background-image:url('.$bg_image_src.');"';
} else {
    $bg_img_set = '';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>" <?php echo $bg_img_set; ?>>
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid eq_h nopadding">
                <div class="eq_r nopadding <?php echo $flip_class_metrics; ?>">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( have_rows('metrics') ):
                                echo '<ul class="metrics_grid">';
                                while ( have_rows('metrics') ): the_row();
                                    $metric = get_sub_field('metric');
                                    $label = get_sub_field('label');
                                
                                    echo '<li class="clearfix">';
                                    echo '<span class="metric">'.$metric.'</span>';
                                    if( $label ) {
                                        echo '<span class="metric_label">'.$label.'</span>';
                                    }
                                    echo '</li>';
                                endwhile;
                                echo '</ul>';
                            endif;
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
        </div>
    </div>
</div>