<?php
/**
 * Simple Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion_simple-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion_simple';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$cont = get_field('cont');
//acc_cont

$bg_color_class = ( $bg_color ) ? $bg_color : 'light-blue';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid eq_h nopadding">
                <div class="eq_r nopadding col-1-2 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1 cont">
                    <div class="inner">
                        <div class="inner_content">
                            <?php echo $cont; ?>
                        </div>
                    </div>
                </div>
                <div class="eq_l nopadding col-1-2 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1 push-right tablet-push-left acc">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php
                            if( have_rows('acc_rows') ):
                                echo '<div class="accordion_wrap">';
                                echo '<ul class="accordion">';
                                while ( have_rows('acc_rows') ): the_row();
                                    $acc_icon = get_sub_field('acc_icon');
                                    $acc_h = get_sub_field('acc_h');
                                    $acc_cont = get_sub_field('acc_cont');
                        
                                    echo '<li>';
                                    echo '<h4 class="acc_heading">';
                                    echo '<a href="">';
                                    if( $acc_icon ) {
                                        $acc_icon_src = $acc_icon['url'];
                                        $acc_icon_alt = $acc_icon['alt'];
                                        echo '<span class="acc_icon"><img src="'.$acc_icon_src.'" alt="'.$acc_icon_alt.'" /></span>';
                                    }
                                    echo '<span>'.$acc_h.'</span><span class="toggle"></span></a></h4>';
                                    echo '<div class="acc_content wysiwyg">';
                                    echo '<div class="inner">'.$acc_cont.'</div>';
                                    echo '</div>';
                                    echo '</li>';
                                endwhile;
                                echo '</ul>';
                                echo '</div>';
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>