<?php
/**
 * Template Name: Default Alt Hero Page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
set_hero_alt();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'page' );
        endwhile
        ?>
    </div><!-- .content-area -->
</div>
<?php
get_footer();
?>