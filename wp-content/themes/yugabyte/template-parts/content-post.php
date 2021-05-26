<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
    
    if( $post->post_content != '' ) {
        the_content();
    }
    
    //SOCIAL SHARING
    echo '<div id="yb_social_bar">';
    echo do_shortcode('[addtoany]');
    echo '</div>';
    
    //LIST CATEGORIES AND TAGS    
    $tags = wp_get_object_terms(get_the_ID(), 'post_tag', '');
    if( $tags ):
        echo '<p class="nomargin">Tags: ';
        $t_len = count($tags);
        $t_cur = 1;
    
        foreach( $tags as $term ):
            $tag_slug = $term->slug;
            $tag_name = $term->name;
            $url = get_term_link($term);
            echo '<a href="'.$url.'">'.$tag_name.'</a>';
            if( $t_cur != $t_len ) {
                echo ', ';
            }
            $t_cur++;
        endforeach;
        echo '</p>';
    endif;
    
    $topics = wp_get_object_terms(get_the_ID(), 'category', '');
    if( $topics ):
        echo '<p>Categories: ';
        $t_len = count($topics);
        $t_cur = 1;
    
        foreach( $topics as $term ):
            $topic_slug = $term->slug;
            $topic_name = $term->name;
            $url = get_term_link($term);
            if( $topic_slug != 'blog' ) {
                echo '<a href="'.$url.'">'.$topic_name.'</a>';
                if( $t_cur != $t_len ) {
                    echo ', ';
                }
            }
            $t_cur++;
        endforeach;
        echo '</p>';
    endif;
    
    //RELATED POSTS
    echo '<div id="related">';
    rp4wp_children();
    echo '</div>';
    ?>

</article>