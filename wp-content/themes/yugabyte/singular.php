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

$is_full = ( is_singular('success-story') ) ? 'full' : '';
?>

<?php
if( is_singular('post') ): ?>

    <div class="content_section">
        <div class="content_section_inner clearfix">
            <div id="primary" class="content-area <?php echo $is_full; ?>">
                <div id="content" class="site-content" role="main">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', get_post_type() );
                    endwhile
                    ?>
                </div><!-- .content-area -->
            </div>
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
    <?php setGlobalFWCTA(); ?>
    
<?php else: ?>
    <div id="primary" class="content-area <?php echo $is_full; ?>">
        <div id="content" class="site-content" role="main">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile
            ?>
        </div><!-- .content-area -->
    </div>
<?php endif; ?>
<?php get_footer(); ?>
