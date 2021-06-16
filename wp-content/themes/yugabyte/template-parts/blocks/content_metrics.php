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
//$flip = get_field('flip');
$cont = get_field('cont');

//content_rows
$c_m_r = get_field('content_metric_rows');
$total_rows = 1;
if ( !empty($c_m_r) ) {
    $total_rows = count( $c_m_r );
}

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
        <?php
        if( have_rows('content_metric_rows') ):
            $i = 1;
            
            while ( have_rows('content_metric_rows') ): the_row();
                $cont = get_sub_field('cont');
                
                
                //check for last
                $is_last = ( $i == $total_rows ) ? 'last' : '';
                
                //open grid
                echo '<div class="clearfix vert_align '.$is_last.'">';
                echo '<div class="grid eq_h nopadding">';
                
                //alternating row classes
                
                
                $metrics_classes = ( $i % 2 == 0 ) ? 'col-1-2 mobile-col-1-1 push-right metrics' : 'col-1-2 mobile-col-1-1 metrics';
                $cont_classes = ( $i % 2 == 0 ) ? 'col-1-2 mobile-col-1-1 cont' : 'col-1-2 mobile-col-1-1 push-right cont flip';
                //$cont_flip = ( $i % 2 == 0 ) ? 'flip' : '';
                ?>
                <div class="eq_r nopadding <?php echo $metrics_classes; ?> tablet-col-5-12">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( have_rows('metrics') ):
                                echo '<ul class="metrics_grid">';
                                while ( have_rows('metrics') ): the_row();
                                    $logo = get_sub_field('logo');
                                    $metric = get_sub_field('metric');
                                    $label = get_sub_field('label');
                                
                                    echo '<li class="clearfix">';
                                    if( $logo ) {
                                        $logo_src = $logo['url'];
                                        $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $metric.$label;
                                        echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
                                    }
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
                <div class="eq_l nopadding <?php echo $cont_classes; ?> tablet-col-7-12">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php echo $cont; ?>
                        </div>
                    </div>
                </div>
                <?php
                //close grid
                echo '</div>';
                echo '</div>';
                
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</div>