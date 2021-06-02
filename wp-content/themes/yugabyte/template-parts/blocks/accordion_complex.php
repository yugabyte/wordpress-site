<?php
/**
 * Complex Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion_complex-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion_complex';
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
$cont_left = get_field('cont_left');
$cont_right = get_field('cont_right');
//acc_cont

$bg_color_class = ( $bg_color ) ? $bg_color : 'light-blue';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <?php
        if( $heading || $intro ) {
            echo '<div class="grid nopadding">';
            echo '<div class="col-10-12 push-1-12 mobile-col-1-1 nopadding">';
            echo '<div class="intro">';
            if( $heading ) {
                echo '<h2 class="lined">'.$heading.'</h2>';
            }
            if( $intro ) {
                echo $intro;
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        <div class="clearfix vert_align">
            <div class="grid eq_h nopadding">
                <div class="eq_r nopadding col-1-2 mobile-col-1-1 cont_left">
                    <div class="inner">
                        <div class="inner_content">
                            <?php echo $cont_left; ?>
                        </div>
                    </div>
                </div>
                <div class="eq_l nopadding col-1-2 mobile-col-1-1 push-right cont_right">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php echo $cont_right; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid nopadding">
            <div class="nopadding col-10-12 push-1-12 mobile-col-1-1 acc">
                <div class="inner">
                    <div class="inner_content wysiwyg plast">
                        <?php
                        if( have_rows('acc_rows') ):
                            echo '<div class="accordion_wrap">';
                            echo '<ul class="accordion">';
                            while ( have_rows('acc_rows') ): the_row();
                                $acc_h = get_sub_field('acc_h');
                                $acc_sh = get_sub_field('acc_sh');
                                $acc_cont = get_sub_field('acc_cont');
                    
                                echo '<li>';
                                echo '<h4 class="acc_heading"><a href=""><div class="inner">';
                                echo '<span class="h">'.$acc_h.'</span><span class="sh">'.$acc_sh.'</span><span class="toggle"></span></div></a></h4>';
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