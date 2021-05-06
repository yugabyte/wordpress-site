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
$id = 'image_rows-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image_rows';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$intro_cont = get_field('intro_cont');
$img_rows = get_field('img_rows');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner tall_pad">
        <div class="grid nopadding">
            <div class="intro col-8-12 push-2-12 mobile-col-1-1 nopadding centered">
            <?php
            if( $heading ) {
                echo '<h2 class="lined">'.$heading.'</h2>';
            }
            if( $intro_cont ) {
                echo $intro_cont;
            }
            ?>
            </div>
        </div>
        <div class="grid nopadding">
            <div class="col-10-12 push-1-12 mobile-col-10-12 nopadding clearfix centered">
                <?php
                if ( have_rows('img_rows') ):
                    echo '<div class="zoom_row">';
                    while ( have_rows('img_rows') ): the_row();
                        $row_title = get_sub_field('row_title');
                        if( $row_title ) {
                            echo '<h3>'.$row_title.'</h3>';
                        }
                        
                        if ( have_rows('images') ):
                            echo '<div class="zoom_images">';
                            while ( have_rows('images') ): the_row();
                                $image = get_sub_field('image');
                                $zoomable = get_sub_field('zoomable');
                                $image_src = $image['url'];
                                
                                $z_class = ( $zoomable ) ? 'zoomable' : '';
                                echo '<div class="zoom_cont '.$z_class.'">';
                                echo '<img src="'.$image_src.'" alt="" />';
                                //echo '<div class="zoom_mover" style="background-image:url('.$image_src.');"></div>';
                                echo '<div class="hover_prompt"></div>';
                                echo '</div>';
                            endwhile;
                            echo '</div>';
                        endif;
                        wp_reset_postdata();

                    endwhile;
                    echo '</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>