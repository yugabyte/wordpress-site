<?php
/**
 * Template Name: Gated Landing Page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
set_hero_gated();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                <?php
                $gate_form = get_field('gate_form');
                $pre_gate_label = get_field('pre_gate_label');
                $pre_gate_label_alt_bg = get_field('pre_gate_label_alt_bg');
                $pre_gate_img = get_field('pre_gate_img');
                $pre_gate_vid = get_field('pre_gate_vid');
                $poster_img = get_sub_field('poster_img');
                
                $alt_bg = ( $pre_gate_label_alt_bg ) ? 'alt_bg' : '';
                ?>
                
                <div class="content_section">
                    <div class="content_section_inner">
                        <div class="grid nopadding">
                            <div id="cont_col" class="col-5-12 push-1-12 tablet-col-10-12 tablet-push-1-12 mobile-col-1-1 nopadding">
                                <?php
                                if( $post->post_content != '' ) {
                                    the_content();
                                }
                                ?>
                            </div>
                            <div id="form_col" class="col-4-12 push-1-12 tablet-col-10-12 tablet-push-1-12 mobile-col-1-1 nopadding">
                                <div class="inner">
                                    <div class="cont">
                                    <?php
                                    if( $pre_gate_label ) {
                                        echo '<div id="pre_gate_label" class="'.$alt_bg.'">';
                                        echo '<h3>'.$pre_gate_label.'</h3>';
                                        echo '</div>';
                                    }
                                    
                                    if( $pre_gate_img || $pre_gate_vid ) {
                                        echo '<div id="pre_gate_asset">';
                                        //IF BOTH SET, THE VIDEO WILL TAKE PRECEDENCE
                                        if( $pre_gate_vid ) {
                                            if( $poster_img ) {
                                                $poster_src = $poster_img['sizes']['medium'];
                                            } else {
                                                //NEED DEFAULT POSTER IMAGE
                                                $poster_src = get_stylesheet_directory_uri().'/assets/images/default-blog-thumbnail.jpg';
                                            }
                                            video_setup($pre_gate_vid, $poster_src);
                                        } else {
                                            if( $pre_gate_img ) {
                                                $pre_gate_img_src = $pre_gate_img['sizes']['medium'];
                                                echo '<img src="'.$pre_gate_img_src.'" alt="'.$pre_gate_label.'" />';
                                            }
                                        }
                                        echo '</div>';
                                        
                                        //SET THE FORM
                                        gravity_form($gate_form['id'], false, false, false, '', true, 1);
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </article>
        <?php   
        endwhile
        ?>
    </div><!-- .content-area -->
</div>
<?php
get_footer();
?>