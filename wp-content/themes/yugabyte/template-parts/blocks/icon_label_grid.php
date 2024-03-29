<?php
/**
 * Icon and Label Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'icon_label_grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'icon_label_grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$standard_h2 = get_field('standard_h2');
$intro = get_field('intro');
//icons

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner centered">
        <div class="grid nopadding">
            <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                <?php
                if( $heading || $intro ) {
                    echo '<div class="intro">';
                    if( $heading ) {
                        if( $standard_h2 ) {
                            echo '<h2 class="lined">'.$heading.'</h2>';
                        } else {
                            echo '<h3 class="lined">'.$heading.'</h3>';
                        }
                    }
                    if( $intro ) {
                        echo $intro;
                    }
                    echo '</div>';
                }
        
                if( have_rows('icons') ):
                    echo '<div class="icons">';
                    while ( have_rows('icons') ): the_row();
                        $icon = get_sub_field('icon');
                        $icon_label = get_sub_field('icon_label');
                        $subheading = get_sub_field('subheading');
                
                        $icon_src = $icon['url'];
                        $icon_alt = $icon['alt'];
                
                        echo '<div class="bucket row_h">';
                            echo '<div class="inner">';
                                echo '<div class="top inner_content">';
                                    echo '<div class="icon" style="background-image:url('.$icon_src.');"></div>';
                                    if( $icon_label ) {
                                        echo '<h4>'.$icon_label.'</h4>';
                                    }
                                echo '</div>';
                                //echo '<div class="inner_content">';
                                if( $subheading ) {
                                    echo '<p>'.$subheading.'</p>';
                                }
                                //echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                    echo '</div>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>