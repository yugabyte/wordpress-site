<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('scrollnimate item clearfix'); ?>>
    <div class="grid clearfix">
        <?php
        echo '<div class="left col-4-12 nopadding">';
        echo '<a class="cont thumb" href="'.esc_url( get_permalink() ).'">';
        if( has_post_thumbnail() ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
            echo '<div class="img" style="background-image:url('.$thumb[0].');"></div>';
        } else {
            echo '<div class="img" style="background-image:url('.get_stylesheet_directory_uri().'/assets/images/default-blog-thumbnail.jpg);"></div>';
        }
        echo '</a>';
        $topics = wp_get_object_terms(get_the_ID(), 'category', '');
        if( $topics ):
            echo '<p class="meta_cats">';
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
        echo '</div>';
        ?>
        <div class="right col-8-12 nopadding">
            <div class="list_cont">
                    <header class="entry-header">
                        <?php
                            echo '<h3 class="entry-title"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h3>';
                        ?>
                    </header><!-- .entry-header -->
                    <div class="entry-content wysiwyg">
                        <?php                        
                        $author_id = get_the_author_meta('ID');
                        $author = get_the_author();
                        $author_link = get_author_posts_url($author_id);
                        $author_headshot = get_avatar_url($author_id);
                        $author_fname = get_user_meta( $author_id, 'first_name', true );
                        $author_lname = get_user_meta( $author_id, 'last_name', true );
                        $date = get_the_date('', get_the_ID());
                        $date_formatted = date('F j, Y', strtotime($date));
                        
                        echo '<div class="byline">';
                            if( $author_headshot ) {
                                echo '<a class="headshot" href="'.$author_link.'" style="background-image:url('.$author_headshot.');"></a>';
                            }
                            echo '<p><span>By <a href="'.$author_link.'">'.$author_fname.' '.$author_lname.'</a></span><br />'.$date_formatted.'</p>';
                        echo '</div>';
                        
                        if( $post->post_content != '' ) {
                            if( has_excerpt() ) {
                                $article_excerpt = get_the_excerpt();
                            } else {
                                $article_excerpt = substr( strip_tags( strip_shortcodes(get_the_content()) ), 0, 200 ).'&hellip;';
                            }
                            echo '<p>'.$article_excerpt.' <a href="'.get_permalink().'">Read More &gt;</a></p>';
                        }
                        
                        //SOCIAL SHARING
                        echo '<div id="yb_social_bar">';
                        echo do_shortcode('[addtoany]');
                        echo '</div>';
                        ?>
                    </div><!-- .entry-content -->
            </div>
        </div>
    </div>
</article><!-- #post-## -->