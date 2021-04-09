<?php
/**
 * Template Name: Events Page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
set_hero();

//$posts_per_page = get_option( 'posts_per_page' );
$posts_per_page = 2;
$paged = get_query_var( 'page', 0 );
$preloaded_amt = 0;

if (!empty($paged)) {
	$startpage = $paged - 1;
	$offset = ($posts_per_page * $startpage) + 1;
	//$offset = 0;
} else {
	$offset = 0;
}

$exclude = array();

//CURRENT DATETIME, FOR LIMITING TO UPCOMING EVENTS
$current_time = current_time('Y-m-d H:i:s');

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
                <div id="yb_events" class="grid">
                    <div class="col-3-12 nopadding">
                        <?php 
                        //	Add the filter shortcode
                        echo do_shortcode('[ajax_load_more_filters 
                            id="eventsfilter" 
                            target="eventslist"
                        ]');
        
                        echo '<a id="filters_clear" href="#" class="btn outline small">Clear filters</a>';
                        ?>
                    </div>
                    <div class="col-9-12 nopadding">
                        <?php
                        //	Start the list wrapper
                        echo '<div id="events-list">';

                        //	Add the main shortcode
                        echo do_shortcode('[ajax_load_more 
                            id="eventslist" 
                            container_type="ul" 
                            meta_key="start_time" 
                            meta_value="'.$current_time.'" 
                            meta_compare=">=" 
                            meta_type="DATE" 
                            order="ASC" 
                            orderby="meta_value_num" 
                            target="eventsfilter" 
                            filters="true" 
                            seo="true" 
                            post_type="ybevent" 
                            repeater="template_2" 
                            posts_per_page="' . $posts_per_page . '" 
                            paging="true" 
                            paging_show_at_most="0" 
                            paging_scroll="true:100" 
                            paging_controls="true" 
                            paging_previous_label="Previous" 
                            paging_next_label="Next" 
                            button_label="Load More" 
                            pause="false" 
                        ]');

                        //	End the list wrapper
                        echo '</div>';
                        ?>
                    </div>
                </div><!-- #success_stories -->
                <?php
                //MEETUP GROUPS
                $mu_groups_heading = get_field('mu_groups_heading');
                $mu_groups = get_field('mu_groups');
                
                if( have_rows('mu_groups') ):
                    echo '<div class="content_section light-blue">';
                    echo '<div class="content_section_inner tall_pad small_padding_bottom centered">';
                    
                    if( $mu_groups_heading ) {
                        echo '<h2 class="lined">'.$mu_groups_heading.'</h2>';
                    }
                    echo '<ul class="mu_groups_list">';
                    while ( have_rows('mu_groups') ): the_row();
                        $mu_loc = get_sub_field('mu_loc');
                        $mu_img = get_sub_field('mu_img');
                        $mu_url = get_sub_field('mu_url');
                        
                        echo '<li>';
                        if( $mu_url ) {
                            echo '<a href="'.$mu_url.'" target="_blank">';
                        }
                        if( $mu_img ) {
                            $mu_img_src = $mu_img['url'];
                            $mu_img_alt = ( $mu_img['alt'] ) ? $mu_img['alt'] : $mu_loc;
                            echo '<div class="img"><img src="'.$mu_img_src.'" alt="'.$mu_img_alt.'" /></div>';
                        }
                        if( $mu_loc ) {
                            echo '<h4>'.$mu_loc.'</h4>';
                        }
                        if( $mu_url ) {
                            echo '</a>';
                        }
                        echo '</li>';
            
                    endwhile;
                    echo '</ul>';
                    echo '</div></div>';
                    wp_reset_postdata();
                endif;
                
                
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