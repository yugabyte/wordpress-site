<?php
/**
 * Template Name: Success Stories Page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
set_hero();

//$posts_per_page = get_option( 'posts_per_page' );
$posts_per_page = 6;
$paged = get_query_var( 'page', 0 );
$preloaded_amt = 3;

if (!empty($paged)) {
	$startpage = $paged - 1;
	$offset = ($posts_per_page * $startpage) + 1;
	//$offset = 0;
} else {
	$offset = 0;
}

$exclude = array();
$category__not_in = ($exclude) ? implode(',', $exclude) : '';
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                <?php
                //SET UP ALM GRID AND FILTERING, FOLLOWED BY ANY STANDARD GUTENBERG CONTENT
                ?>
                <div id="success_stories" class="grid">
                    <div class="col-3-12 nopadding">
                        <?php 
                        //	Add the filter shortcode
                        echo do_shortcode('[ajax_load_more_filters 
                            id="ssfilter" 
                            target="sslist"
                        ]');
        
                        echo '<a id="filters_clear" href="#" class="btn outline small">Clear filters</a>';
                        ?>
                    </div>
                    <div class="col-9-12 nopadding">
                        <?php
                        //	Start the list wrapper
                        echo '<div id="success-stories-list">';

                        //	Add the main shortcode
                        echo do_shortcode('[ajax_load_more 
                            id="sslist" 
                            container_type="ul" 
                            order="ASC" 
                            orderby="title" 
                            cta="true" 
                            cta_position="after:' . ($posts_per_page) . '" 
                            cta_repeater="template_1" 
                            target="ssfilter" 
                            filters="true" 
                            seo="true" 
                            post_type="success-story" 
                            category__not_in="' . $category__not_in . '" 
                            posts_per_page="' . $posts_per_page . '" 
                            scroll_distance="0" 
                            offset="' . $offset . '" 
                            button_label="Load More" 
                            pause="false" 
                            preloaded="true" 
                            preloaded_amount="' . $preloaded_amt . '"
                        ]');

                        //	End the list wrapper
                        echo '</div>';
                        ?>
                    </div>
                </div><!-- #success_stories -->
                <?php
                if( $post->post_content != '' ) {
                    the_content();
                }
                ?>
            </article>
        <?php    
        endwhile
        ?>
    </div><!-- .content-area -->
</div>
<?php
get_footer();
?>