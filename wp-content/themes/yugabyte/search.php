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
if( is_category('blog') ) {
    set_hero();
} else {
    set_hero_alt();
}
?>
<div class="content_section">
    <div class="content_section_inner clearfix">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
        
                <?php if ( have_posts() ) :

                    // Start the Loop.
                    echo '<div class="listing">';
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'search' );
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
            //CONTACT CTA WIDGETS, MANAGED IN THE GLOBAL YB OPTIONS PANEL
            if( have_rows('blog_ctas', 'option') ):
                echo '<div class="blog_ctas">';
                while ( have_rows('blog_ctas', 'option') ): the_row();
                    $text_label = get_sub_field('text_label');
                    $icon = get_sub_field('icon');
                    $page_link = get_sub_field('page_link');
                    
                    
                    if( $page_link ) {
                        echo '<div class="widget">';
                        echo '<a class="inner" href="'.$page_link.'">';
                            if( $icon ) {
                                $icon_src = $icon['url'];
                                echo '<div class="icon" style="background-image:url('.$icon_src.');"></div>';
                            }
                            if( $text_label ) {
                                echo '<h3>'.$text_label.'</h3>';
                            }
                        echo '</a>';
                        echo '</div>';
                    }
                endwhile;
                echo '</div>';
            endif;
            
            echo '<div class="widget_wrap">';
            dynamic_sidebar('sidebar-blog');
            echo '</div>';
            ?>
        </div>
    </div>
</div>
<?php
setGlobalFWCTA();
?>
<?php get_footer(); ?>