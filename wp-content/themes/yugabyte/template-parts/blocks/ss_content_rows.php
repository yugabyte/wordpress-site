<?php
/**
 * Success Story Alternating Content Rows Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_cont_rows-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_cont_rows';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
//content_rows
$c_r = get_field('content_rows');
$total_rows = 1;
if ( !empty($c_r) ) {
    $total_rows = count( $c_r );
}

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> light-blue">
    <div class="content_section_inner tall_pad">
        <?php
        if( have_rows('content_rows') ):
            $i = 1;
            
            if( $heading ) {
                echo '<h2 class="lined centered">'.$heading.'</h2>';
            }
            while ( have_rows('content_rows') ): the_row();
                $linked_content = get_sub_field('linked_content');
                $naked_video = get_sub_field('naked_video');
                $poster_img = get_sub_field('poster_img');
                if( $poster_img ) {
                    $poster_src = $poster_img['sizes']['medium'];
                }
                $custom_title = get_sub_field('title');
                $custom_teaser = get_sub_field('custom_teaser');
                
                //check for last
                $is_last = ( $i == $total_rows ) ? 'last' : '';
                
                //open grid
                echo '<div class="clearfix vert_align '.$is_last.'">';
                echo '<div class="grid eq_h nopadding">';
                
                //alternating row classes
                $cont_classes = ( $i % 2 == 0 ) ? 'col-7-12 mobile-col-1-1 cont' : 'col-7-12 mobile-col-1-1 push-right cont';
                $img_classes = ( $i % 2 == 0 ) ? 'col-5-12 mobile-col-1-1 push-right img' : 'col-5-12 mobile-col-1-1 img';
                $cont_flip = ( $i % 2 == 0 ) ? 'flip' : '';
                
                //if linked content post is set
                if( $linked_content ):
                
                    foreach( $linked_content as $lc ):
                        setup_postdata($lc);
                        $title = get_the_title($lc->ID);
                        $link = get_permalink($lc->ID);
                        $cpt = get_post_type($lc->ID);
                        
                        if( $custom_teaser ) {
                            $the_excerpt = $custom_teaser;
                        } else {
                            if( has_excerpt($lc->ID) ) {
                                $the_excerpt = get_the_excerpt($lc->ID);
                            } else {
                                $the_excerpt = substr( strip_tags( strip_shortcodes(get_the_content( $lc->ID )) ), 0, 300 ).'&hellip;';
                            }
                        }
                        
                        echo '<div class="eq_r nopadding '.$cont_classes.'">';
                            echo '<div class="inner">';
                                echo '<div class="inner_content '.$cont_flip.'">';
                                    $the_title = ( $custom_title ) ? $custom_title : $title;
                                    echo '<h4>'.$the_title.'</h4>';
                                    if( $the_excerpt ) {
                                        echo '<p>'.$the_excerpt.'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="eq_l nopadding '.$img_classes.'">';
                            echo '<div class="inner">';
                                echo '<div class="inner_content">';
                                    if( has_term(array('video','webinar'),'resource_types', $lc->ID) ) {
                                        //is a video or webinar
                                        $video_url = get_field('video_url', $lc->ID);
                                        video_setup($video_url, $poster_src);
                                        
                                    } else {
                                        //get featured image
                                        if( has_post_thumbnail($lc->ID) ) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $lc->ID ), 'medium' );
                                            $thumb = $thumb[0];
                                            echo '<a href="'.$link.'" class="img_cont" style="background-image: url('.$thumb.');" ></a>';
                                        }
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                    endforeach;
                    wp_reset_postdata();
                    
                elseif( $naked_video ):
                    
                    echo '<div class="eq_r nopadding '.$cont_classes.'">';
                        echo '<div class="inner">';
                            echo '<div class="inner_content '.$cont_flip.'">';
                                if( $custom_title ) {
                                    echo '<h4>'.$custom_title.'</h4>';
                                }
                                if( $custom_teaser ) {
                                    echo '<p>'.$custom_teaser.'</p>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="eq_l nopadding '.$img_classes.'">';
                        echo '<div class="inner">';
                            echo '<div class="inner_content">';
                                video_setup($naked_video, $poster_src);
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    
                endif;
                //close grid
                echo '</div>';
                echo '</div>';
                
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</div>