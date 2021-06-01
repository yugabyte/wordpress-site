<?php
/**
 * Link Lists Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'link_groups-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'link_groups';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner centered tall_pad">
        <div class="grid nopadding">
            <div class="col-10-12 push-1-12 mobile-col-1-1 nopadding">
                <?php
                if( have_rows('lists') ):
                    echo '<div class="lists_wrap">';
                    while ( have_rows('lists') ): the_row();
                        $icon = get_sub_field('icon');
                        $heading = get_sub_field('heading');
                
                        echo '<div class="bucket">';
                        echo '<div class="head">';
                            if( $icon ) {
                                $icon_src = $icon['url'];
                                $icon_alt = $icon['alt'];
                                echo '<div class="icon"><img src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
                            }
                            if( $heading ) {
                                echo '<h4>'.$heading.'</h4>';
                            }
                        echo '</div>';
                
                        if( have_rows('links') ):
                            echo '<ul class="links">';
                            while ( have_rows('links') ): the_row();
                                $link_icon = get_sub_field('link_icon');
                                $link_text = get_sub_field('link_text');
                                $link_int = get_sub_field('link_int');
                                $link_ext = get_sub_field('link_ext');
                                $link_tar = get_sub_field('link_tar');
                        
                                if( $link_ext ) {
                                    $link_url = ( $link_int ) ? $link_int : $link_ext;
                                } elseif( $link_int ) {
                                    $link_url = $link_int;
                                }
                        
                                echo '<li><a href="'.$link_url.'" target="'.$link_tar.'">';
                                if( $link_icon ) {
                                    $link_icon_src = $link_icon['url'];
                                    $link_icon_alt = $link_icon['alt'];
                                    echo '<span class="link_icon"><img src="'.$link_icon_src.'" alt="'.$link_icon_alt.'" /></span>';
                                }
                                echo '<span>'.$link_text.'</span>';
                                echo '<span class="arrow"></span>';
                                echo '</a></li>';
                            endwhile;
                            echo '</ul>';
                            wp_reset_postdata();
                        endif;
                        echo '</div>';
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>