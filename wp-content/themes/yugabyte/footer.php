<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

            </div><!-- #main -->
            <footer id="colophon" class="site-footer" role="contentinfo">
                
                <div class="footer_inner clearfix">
                    <div class="grid extra_wide">
                        <div class="col-9-12 tablet-col-10-12 mobile-col-1-1 push-right nopadding">
                            <?php
                            wp_nav_menu( array( 'container'=> false, 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) );
                            ?>
                        </div>
                        <div class="col-3-12 tablet-col-2-12 mobile-col-1-1 nopadding">
                            <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="" src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo-main.svg' ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                            
                            <?php
                            //SOCIAL MEDIA
                            $github = get_field('github','option');
                            $slack = get_field('slack','option');
                            $twitter = get_field('twitter','option');
                            $linkedin = get_field('linkedin','option');
                            $youtube = get_field('youtube','option');
                            $facebook = get_field('facebook','option');
                            
                            //ICON SVG IMAGES
                            $icon_gh = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/github.svg' );
                            $icon_sl = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/slack.svg' );
                            $icon_tw = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/twitter.svg' );
                            $icon_ln = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/linkedin.svg' );
                            $icon_yt = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/youtube.svg' );
                            $icon_fb = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/facebook.svg' );
                            
                            echo '<div class="social_cont">';
                            if( $github ) {
                                echo '<a href="'.$github.'" class="social gh first" target="_blank"><span>GitHub</span>'.$icon_gh.'</a>';
                            }
                            if( $slack ) {
                                echo '<a href="'.$slack.'" class="social sl" target="_blank"><span>Slack</span>'.$icon_sl.'</a>';
                            }
                            if( $twitter ) {
                                echo '<a href="'.$twitter.'" class="social tw" target="_blank"><span>Twitter</span>'.$icon_tw.'</a>';
                            }
                            if( $linkedin ) {
                                echo '<a href="'.$linkedin.'" class="social ln" target="_blank"><span>LinkedIn</span>'.$icon_ln.'</a>';
                            }
                            if( $youtube ) {
                                echo '<a href="'.$youtube.'" class="social yt" target="_blank"><span>YouTube</span>'.$icon_yt.'</a>';
                            }
                            if( $facebook ) {
                                echo '<a href="'.$facebook.'" class="social fb" target="_blank"><span>Facebook</span>'.$icon_fb.'</a>';
                            }
                            echo '</div>';
                            
                            //COPYRIGHT
                            $copyright = get_field('copyright', 'option');
                            if( $copyright ) {
                                echo '<p class="copyright nomargin">&copy; 2020-'.date("Y").' '.$copyright.'</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </footer><!-- #colophon -->
        </div><!-- .site-inner -->
    </div><!-- .site -->    
<?php wp_footer(); ?>
</body>
</html>
