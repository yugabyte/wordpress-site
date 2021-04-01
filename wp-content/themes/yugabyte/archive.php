<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */


get_header();
set_hero_alt(); ?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        
        <?php if ( have_posts() ) :

            // Start the Loop.
            echo '<div class="listing">';
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', '' );
            endwhile;
            echo '</div>';
            yb_paging_nav();

        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </div><!-- .site-content -->
</div><!-- .content-area -->
<div id="secondary" class="flip">
    <?php
    //get_sidebar();
    ?>
</div>
<?php get_footer(); ?>