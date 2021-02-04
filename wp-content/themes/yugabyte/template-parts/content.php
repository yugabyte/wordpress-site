<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('scrollnimate, item, clearfix'); ?>>
    <div class="grid">
    <?php
    if( has_post_thumbnail() ) {
        $img_class = 'has_image';
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<div class="col-4-12">';
        echo '<a class="cont thumb" href="'.esc_url( get_permalink() ).'"><img src="'.$thumb[0].'" alt="'.get_the_title().'" /></a>';
        echo '</div>';
        echo '<div class="col-8-12">';
    } else {
        $img_class = '';
        echo '<div class="col-1-1">';
    }
    ?>
    
    <div class="list_cont <?php echo $img_class; ?>">
        <header class="entry-header">
            <?php
                echo '<h2 class="entry-title"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h2>';
            ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php            
            if( $post->post_content != '' ) {
                if( has_excerpt() ) {
                    $article_excerpt = get_the_excerpt();
                } else {
                    $article_excerpt = substr( strip_tags( strip_shortcodes(get_the_content()) ), 0, 200 ).'&hellip;';
                }
                echo '<p class="nomargin">'.$article_excerpt.' <a href="'.get_permalink().'">Read more</a></p>';
            }
            ?>
        </div><!-- .entry-content -->
    </div>
    </div>
    </div>
</article><!-- #post-## -->
