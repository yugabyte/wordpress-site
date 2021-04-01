<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
if( is_singular('success-story') ) {
    set_ss_hero();
} else {
    set_hero_alt();
}
?>

<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile
        ?>
    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>
