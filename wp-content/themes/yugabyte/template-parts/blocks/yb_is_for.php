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
$id = 'yb_is_for-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'yb_is_for';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
//icons
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner centered tall_pad">
        <?php
        if( $heading ) {
            echo '<h2 class="lined">'.$heading.'</h2>';
        }
        
        if( have_rows('contentbuckets') ):
            echo '<div class="contentbuckets row_h">';
            while ( have_rows('contentbuckets') ): the_row();
                $img = get_sub_field('img');
                $bucketheading = get_sub_field('heading');
                $cont = get_sub_field('cont');
                
                $img_src = $img['url'];
                $img_alt = $img['alt'];
                
                echo '<div class="bucket">';
                echo '<div class="img" style="background-image:url('.$img_src.');"></div>';
                echo '<div class="cont">';
                    echo '<div class="inner">';
                        echo '<div class="inner_content wysiwyg">';
                        if( $bucketheading ) {
                            echo '<h4 class="checkmark">'.$bucketheading.'</h4>';
                        }
                        echo $cont;
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '</div>';
            endwhile;
            echo '</div>';
        endif;
        ?>
    </div>
</div>