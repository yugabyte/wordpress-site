<?php
/**
 * Logo Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logo_grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'logo_grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$alt_heading = get_field('alt_heading');

$alt_class = ( $alt_heading ) ? 'alt' : '';
$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner centered tall_pad small_padding_bottom">
        <?php
        if( have_rows('logos') ):
            if( $heading ) {
                echo '<h2 class="lined '.$alt_class.'">'.$heading.'</h2>';
            }
            echo '<ul class="logos">';
            while ( have_rows('logos') ): the_row();
                $name = get_sub_field('name');
                $logo = get_sub_field('logo');
                $link = get_sub_field('link');
                                
                echo '<li class="gridblock">';
                echo '<div class="inner">';
                    if( $logo ) {
                        $logo_src = $logo['url'];
                        $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $name;
                        if( $link ) {
                            echo '<a class="logo" href="'.$link.'" target="_blank">';
                        } else {
                            echo '<div class="logo">';
                        }
                        echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
                        if( $link ) {
                            echo '</a>';
                        } else {
                            echo '</div>';
                        }
                    }
                echo '</div>';
                echo '</li>';
            endwhile;
            echo '</ul>';
        endif;
        ?>
    </div>
</div>