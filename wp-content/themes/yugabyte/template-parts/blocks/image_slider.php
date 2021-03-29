<?php
/**
 * Image Gallery Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'img_slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'img_slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$intro_cont = get_field('intro_cont');
//slider_images
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> light-blue">
    <div class="content_section_inner tall_pad">
        <div class="grid nopadding">
            <div class="col-8-12 push-2-12 mobile-col-1-1 nopadding centered">
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
            <div class="col-10-12 push-1-12 mobile-col-10-12 nopadding clearfix">
                <?php
                if ( have_rows('slider_images') ):
                    echo '<ul class="img_gallery_slider">';
                    while ( have_rows('slider_images') ): the_row();
                        $image = get_sub_field('image');
                        if( $image ) {
                            $img_src = $image['url'];
                            $img_thumb = $image['sizes']['medium'];
                            $img_alt = $image['alt'];
                        }
                        echo '<li class="clearfix">';
                        echo '<div class="inner">';
                        echo '<img src="'.$img_thumb.'" alt="'.$img_alt.'" />';
                        echo '</div></li>';

                    endwhile;
                    echo '</ul>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>