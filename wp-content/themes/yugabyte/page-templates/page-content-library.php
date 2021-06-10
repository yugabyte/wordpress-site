<?php
/**
 * Template Name: Content Library Page
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
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="content_section">
                    <div class="content_section_inner full nopadding">
                        <div id="resources_search" class="grid">
                            <div class="left row_h col-1-2 mobile-col-1-1 nopadding">
                                <div class="inner_content">
                                    <h3>Find Resources</h3>
                                </div>
                            </div>
                            <div class="right row_h col-1-2 mobile-col-1-1 nopadding">
                                <div class="inner_content">
                                    <div class="filter_wrap">
                                        <?php 
                                        //	Add the filter shortcode
                                        echo do_shortcode('[ajax_load_more_filters 
                                            id="resourcessearchfilter" 
                                            target="resourceslist"
                                        ]');
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="content_section light-blue">
                    <div class="content_section_inner full nopadding_lr">
    
                        <?php
                        //SET UP ALM GRID AND FILTERING, FOLLOWED BY ANY STANDARD GUTENBERG CONTENT
                        ?>
                        <div id="resources" class="grid">
                            <div class="col-3-12 nopadding">
                                <?php 
                                //	Add the filter shortcode
                                echo do_shortcode('[ajax_load_more_filters 
                                    id="resourcesfilter" 
                                    target="resourceslist"
                                ]');
        
                                echo '<a id="filters_clear" href="#" class="btn outline small">Clear filters</a>';
                                ?>
                            </div>
                            <div class="col-9-12 nopadding">
                                <?php
                                //	Start the list wrapper
                                echo '<div id="resources-list">';

                                //	Add the main shortcode
                                echo do_shortcode('[ajax_load_more 
                                    id="resourceslist" 
                                    container_type="ul" 
                                    order="DESC" 
                                    orderby="date" 
                                    repeater="template_4" 
                                    target="resourcesfilter" 
                                    filters="true" 
                                    seo="true" 
                                    post_type="resource" 
                                    category__not_in="' . $category__not_in . '" 
                                    posts_per_page="' . $posts_per_page . '" 
                                    scroll_distance="0" 
                                    offset="' . $offset . '" 
                                    button_label="Load More" 
                                    pause="false" 
                                ]');

                                //	End the list wrapper
                                echo '</div>';
                                ?>
                            </div>
                        </div><!-- #resources -->
                    </div>
                </div>
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