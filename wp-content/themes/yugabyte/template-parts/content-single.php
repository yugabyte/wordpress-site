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
        echo '<div class="content_section">';
        echo '<div class="content_section_inner wysiwyg">';
        the_content();
        echo '</div>';
        echo '</div>';
    }
    
    
    ?>

</article>