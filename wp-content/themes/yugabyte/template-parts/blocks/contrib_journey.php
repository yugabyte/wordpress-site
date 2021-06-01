<?php
/**
 * YugabyteDB is For... Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contrib_journey-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'contrib_journey';
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
$ct = get_field('ct');
$ct_btn_txt = get_field('ct_btn_txt');

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner centered tall_pad">
        <div class="grid nopadding">
            <div class="col-1-1 cont_wrap">
                <?php
                if( $heading || $intro ) {
                    echo '<div class="intro">';
                    if( $heading ) {
                        echo '<h2 class="lined">'.$heading.'</h2>';
                    }
                    if( $intro ) {
                        echo $intro;
                    }
                    echo '</div>';
                }
        
                if( have_rows('contentbuckets') ):
                    echo '<div class="contentbuckets row_h">';
                    while ( have_rows('contentbuckets') ): the_row();
                        $cont = get_sub_field('cont');
                
                        echo '<div class="bucket">';
                            echo '<div class="notched">';
                            echo '<div class="inner">';
                                echo '<div class="inner_content wysiwyg">';
                                echo $cont;
                                echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();
                endif;
        
                if( $ct ) {
                    echo '<a href="'.$ct.'" class="btn sq">'.$ct_btn_txt.'</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>