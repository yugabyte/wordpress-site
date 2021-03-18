<?php
/**
 * Success Story Yugabyte Solution Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_yb_solution-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_yb_solution';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
//icon_buckets
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner tall_pad centered">
        <?php
        echo '<h2 class="lined">'.$heading.'</h2>';
        
        if( have_rows('icon_buckets') ):
            echo '<div class="icon_buckets">';
            while ( have_rows('icon_buckets') ): the_row();
                $icon = get_sub_field('icon');
                $desc = get_sub_field('desc');
                
                $icon_src = $icon['url'];
                $icon_alt = $icon['alt'];
                
                echo '<div class="bucket">';
                echo '<div class="icon"><img src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
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