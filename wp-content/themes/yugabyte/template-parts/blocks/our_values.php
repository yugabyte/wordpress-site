<?php
/**
 * Our Values Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'values_tenets-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'values_tenets';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$intro = get_field('intro');
//tenets
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> grad-dkpurple-blue">
    <div class="content_section_inner tall_pad">
        <div class="grid nopadding">
            <div class="col-10-12 push-1-12 mobile-col-1-1 nopadding">
            <?php
            if( $heading ) {
                echo '<h2 class="lined_left">'.$heading.'</h2>';
            }
            if( $intro ) {
                echo $intro;
            }
            
            if ( have_rows('tenets') ):
                echo '<div class="tenets">';
                while ( have_rows('tenets') ): the_row();
                    $content = get_sub_field('content');
                    echo '<div class="bucket">';
                    echo '<div class="inner">';
                    echo $content;
                    echo '</div></div>';

                endwhile;
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </div>
</div>