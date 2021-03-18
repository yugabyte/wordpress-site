<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ff6e42">
    <meta name="msapplication-TileColor" content="#2b59c3">
    <meta name="theme-color" content="#ffffff">
    
    <!-- SourceSans Google Font (Temporary, eventual self-hosting) -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    
    <!--<meta name="google-site-verification" content="QAVpjS-3Bynxyn-A3WoOupO3lVPhzHQzW9aqugSRWys" />-->        	
	<?php wp_head(); ?>
	
	<!-- TODO: ADD GOOGLE ANALYTICS AND PAGE VERIFICATION? -->
	<!--<meta name="google-site-verification" content="R0-l_4c6h_NY5wrlIo7A7aLmXzGtOcLAMunTYmyg2Xg" />-->
	
</head>

<body <?php body_class(); ?>>

    <?php
    the_post(); rewind_posts();
    
    $pageclass = '';
    
    //CTA SETUP
    $header_cta = get_field('header_cta','option');
    $header_cta_ext = get_field('header_cta_ext','option');
    $header_cta_btn_txt = get_field('header_cta_btn_txt','option');
    if( $header_cta || $header_cta_ext ) {
        $cta_url = '';
        if( $header_cta_ext ) {
            if( $header_cta ) {
                $cta_url = $header_cta;
            } else {
                $cta_url = $header_cta_ext;
            }
        } else {
            $cta_url = $header_cta;
        }
        echo '<a href="'.$cta_url.'" id="header_cta" class="btn">'.$header_cta_btn_txt.'</a>';
    }
    ?>

    <div id="page" class="site <?php echo $pageclass; ?>">
        <a href="#" id="back_to_top" title="Back to top"><span class="inner"></span></a>
        <div id="mobile_nav_tray">
            <nav id="primary-navigation-mobile" class="site-navigation primary-navigation" role="navigation">
                <a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'link_after' => '<a class="toggle" href="#"><span>Toggle Submenu</span></a>' ) ); ?>
            </nav>
            <?php
            if( $header_cta || $header_cta_ext ) {
                echo '<a href="'.$cta_url.'" id="header_cta_mobile" class="btn">'.$header_cta_btn_txt.'</a>';
            }
            ?>
            <div id="search_container_mobile">
                <?php get_search_form(); ?>
            </div>
        </div>
        
        <div id="site-inner">
            <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentytwenty' ); ?></a>
            <header id="masthead" class="site-header" role="banner">
                <div class="header_inner clearfix">
                    <div class="grid">
                        <div class="col-8-12 tablet-col-9-12 mobile-col-9-12 nopadding">
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="" src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo-main-light.svg' ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></p>
                            <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
                                <a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>
                                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                            </nav>
                        </div>
                        <div class="col-4-12 tablet-col-3-12 mobile-col-3-12 nopadding">
                            <div class="header_right clearfix">
                                <?php
                                if( $header_cta || $header_cta_ext ) {
                                    echo '<a href="'.$cta_url.'" id="header_cta" class="btn">'.$header_cta_btn_txt.'</a>';
                                }
                                ?>
                                <div id="search_container">
                                    <?php get_search_form(); ?>
                                </div>
                                <a id="mobile_nav_toggle" href="#">
                                    <div class="inner">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header><!-- #masthead -->
        
            <div id="main" class="site-main">
