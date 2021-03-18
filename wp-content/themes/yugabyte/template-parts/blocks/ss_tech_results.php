<?php
/**
 * Success Story Technical Results Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_tech_results-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_tech_results';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
//metric_buckets
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> light-blue">
    <div class="content_section_inner tall_pad centered">
        <?php
        echo '<h2 class="lined">'.$heading.'</h2>';
        
        if( have_rows('metric_buckets') ):
            echo '<div class="metric_buckets">';
            while ( have_rows('metric_buckets') ): the_row();
                $lg_text = get_sub_field('lg_text');
                $desc = get_sub_field('desc');
                
                echo '<div class="bucket">';
                if( $lg_text ) {
                    echo '<p class="lg_text">'.$lg_text.'</p>';
                }
                if( $desc ) {
                    echo '<p>'.$desc.'</p>';
                }
                echo '</div>';
            endwhile;
            echo '</div>';
        endif;
        ?>
    </div>
</div>