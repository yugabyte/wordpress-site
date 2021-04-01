<?php
/**
 * Blog Picker Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blog_picker-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blog_picker';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$blog_cat = get_field('blog_cat');
$blog_tag = get_field('blog_tag');
$post_picker = get_field('post_picker');
$ct = get_field('ct');
$ct_btn_txt = get_field('ct_btn_txt');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> light-blue">
    <div class="content_section_inner centered tall_pad">
        <div class="grid nopadding">
            <div class="col-10-12 push-1-12 mobile-col-1-1 nopadding">
                <?php
                if( $heading ) {
                    echo '<h3 class="lined">'.$heading.'</h3>';
                }
                echo '<ul class="featured_posts">';
                if( $post_picker ):
                    foreach( $post_picker as $p ):
                        setup_postdata($p);
        
                        $title = get_the_title($p->ID);
                        $link = get_permalink($p->ID);
        
                        echo '<li class="item"><a href="'.$link.'">';
                        if( has_post_thumbnail($p->ID) ) {
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium' );
                            $thumb = $thumb[0];
                            echo '<div class="top"><div class="inner" style="background-image:url('.$thumb.');">';
                        } else {
                            echo '<div class="top"><div class="inner">';
                        }
                        echo '</div></div>';
                        echo '<div class="btm"><div class="inner lefted">';
                        echo '<h4>'.$title.'</h4>';
                        echo '</div></div>';
                        echo '<div class="rm_wrap"><span class="read_more">See Story</span></div>';
                        echo '</li>';  
        
                    endforeach;
                    wp_reset_postdata();
                else:
                    
                    if( $blog_cat || $blog_tag ) {
                        $term = ( $blog_tag ) ? $blog_tag : $blog_cat;
                        $t_id = $term->ID;
                        $t_link = get_term_link($term);
                        $t_slug = $term->slug;
                        
                        /*echo '<pre>';
                        var_dump($blog_cat);
                        echo '</pre>';*/
                        
                        if( $blog_tag ) {
                            $args = array(
                                'posts_per_page'	=> 3,
                                'tag'		=> $t_slug
                            );
                        } else {
                            $args = array(
                                'posts_per_page'	=> 3,
                                'category_name'		=> $t_slug
                            );
                        }
                        $tax_q = new WP_Query( $args );
                        if ( $tax_q->have_posts() ) :
                            while ( $tax_q->have_posts() ): $tax_q->the_post();
                                $title = get_the_title();
                                $link = get_permalink();
        
                                echo '<li class="item"><a href="'.$link.'">';
                                if( has_post_thumbnail() ) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $thumb = $thumb[0];
                                    echo '<div class="top"><div class="inner" style="background-image:url('.$thumb.');">';
                                } else {
                                    echo '<div class="top"><div class="inner">';
                                }
                                echo '</div></div>';
                                echo '<div class="btm"><div class="inner lefted">';
                                echo '<h4>'.$title.'</h4>';
                                echo '</div></div>';
                                echo '<div class="rm_wrap"><span class="read_more">See Story</span></div>';
                                echo '</li>';
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        
                    }
                endif;
                echo '</ul>';
    
                //READ ALL CLICKTHROUGH BTN
                if( $post_picker && $ct ) {
                    $cat = get_category_by_slug( $ct );
                    $read_all_link = get_category_link( $cat );
                    echo '<a href="'.$read_all_link.'" class="btn nomargin">'.$ct_btn_txt.'</a>';
                } else {
                    if( $blog_cat || $blog_tag ) {
                        $term = ( $blog_tag ) ? $blog_tag : $blog_cat;
                        $t_id = $term->ID;
                        $t_link = get_term_link($term);
                        $t_name = $term->name;
                        
                        echo '<a href="'.$t_link.'" class="btn nomargin">'.$ct_btn_txt.'</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>