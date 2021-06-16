<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
set_hero();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                <?php
                $sales_intro = get_field('sales_intro');
                $sales_form = get_field('sales_form');
                $inquiry_intro = get_field('inquiry_intro');
                $inquiry_form = get_field('inquiry_form');
                ?>
                
                <div id="contact_panels">
                    
                    <div id="contact_tabs" class="content_section">
                        <div class="content_section_inner centered nopadding_bottom">
                            <div class="tab"><a id="Sales" class="inactive">Contact Sales</a></div>
                            <div class="tab"><a id="Inquiry">General Inquiry</a></div>
                        </div>
                    </div>
                    
                    <div class="contact_cont" id="SalesC">
                        <div class="content_section">
                            <div class="content_section_inner centered">
                                <div class="grid nopadding">
                                    <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                                        <?php
                                        if( $sales_intro ) {
                                            echo '<div class="intro">';
                                            echo $sales_intro;
                                            echo '</div>';
                                        }
        
                                        if( have_rows('sales_locs') ):
                                            echo '<div class="sales_locs">';
                                            while ( have_rows('sales_locs') ): the_row();
                                                $name = get_sub_field('name');
                                                $info = get_sub_field('info');
                
                                                echo '<div class="bucket">';
                                                if( $name ) {
                                                    echo '<h4>'.$name.'</h4>';
                                                }
                                                if( $info ) {
                                                    echo '<p>'.$info.'</p>';
                                                }
                                                echo '</div>';
                                            endwhile;
                                            echo '</div>';
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_section form_embed light-blue">
                            <div class="content_section_inner centered nopadding_bottom">
                                <div class="clearfix">
                                    <div class="grid nopadding">
                                        <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                                            <div class="inner">
                                                <?php
                                                $title = $sales_form['title'];
                                                echo '<h2>'.$title.'</h2>';
                                                if( $sales_form['description'] ) {
                                                    $subheading = $sales_form['description'];
                                                    echo '<p class="desc">'.$subheading.'</p>';
                                                }
                                                gravity_form($sales_form['id'], false, false, false, '', true, 1);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact_cont" id="InquiryC">
                        <div class="content_section">
                            <div class="content_section_inner centered">
                                <div class="grid nopadding">
                                    <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                                        <?php
                                        if( $inquiry_intro ) {
                                            echo '<div class="intro">';
                                            echo $inquiry_intro;
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_section form_embed">
                            <div class="content_section_inner centered">
                                <div class="clearfix">
                                    <div class="grid nopadding">
                                        <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                                            <div class="inner">
                                                <?php
                                                $title = $inquiry_form['title'];
                                                echo '<h2>'.$title.'</h2>';
                                                if( $inquiry_form['description'] ) {
                                                    $subheading = $inquiry_form['description'];
                                                    echo '<p class="desc">'.$subheading.'</p>';
                                                }
                                                gravity_form($inquiry_form['id'], false, false, false, '', true, 1);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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