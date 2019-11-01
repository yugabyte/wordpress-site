<?php
/**
 * Plugin Name: WP Slick Slider and Image Carousel
 * Plugin URI: https://www.wponlinesupport.com/plugins
 * Text Domain: wp-slick-slider-and-image-carousel
 * Domain Path: /languages/
 * Description: Easy to add and display wp slick image slider and carousel. Also work with Gutenberg shortcode block.  
 * Author: WP OnlineSupport
 * Version: 1.8
 * Author URI: https://www.wponlinesupport.com
 *
 * @package WordPress
 * @author WP OnlineSupport
 */

if( !defined('WPSISAC_VERSION') ) {
	define( 'WPSISAC_VERSION', '1.8' ); // Plugin version
}
if( !defined( 'WPSISAC_VERSION_DIR' ) ) {
	define( 'WPSISAC_VERSION_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPSISAC_URL' ) ) {
	define( 'WPSISAC_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPSISAC_POST_TYPE' ) ) {
	define( 'WPSISAC_POST_TYPE', 'slick_slider' ); // Plugin post type
}

register_activation_hook( __FILE__, 'free_wpsisac_install_premium_version' );
function free_wpsisac_install_premium_version(){
if( is_plugin_active('wp-slick-slider-and-image-carousel-pro/wp-slick-image-slider.php') ){
	 add_action('update_option_active_plugins', 'free_wpsisac_deactivate_premium_version');
	}
}
function free_wpsisac_deactivate_premium_version(){
   deactivate_plugins('wp-slick-slider-and-image-carousel-pro/wp-slick-image-slider.php',true);
}
add_action( 'admin_notices', 'free_wpsisac_rpfs_admin_notice');
function free_wpsisac_rpfs_admin_notice() {
	global $pagenow;

	$dir = ABSPATH . 'wp-content/plugins/wp-slick-slider-and-image-carousel-pro/wp-slick-image-slider.php';
	$notice_link        = add_query_arg( array('message' => 'wpsisac-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'wpsisac_install_notice' );

	if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {        
		echo '<div class="updated notice" style="position:relative;">
			<p>
				<strong>'.sprintf( __('Thank you for activating %s', 'wp-slick-slider-and-image-carousel'), 'WP Slick Slider and Image Carousel').'</strong>.<br/>
				'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-slick-slider-and-image-carousel'), '<strong>(<em>WP Slick Slider and Image Carousel  Pro</em>)</strong>' ).'
			</p>
			<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
		</div>';
	}
}

add_action('plugins_loaded', 'wpsisac_load_textdomain');
function wpsisac_load_textdomain() {
	load_plugin_textdomain( 'wp-slick-slider-and-image-carousel', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
} 

// Function file
require_once( WPSISAC_VERSION_DIR . '/includes/wpsisac-function.php' );

// Script
require_once( WPSISAC_VERSION_DIR . '/includes/class-wpsisac-script.php' );

// Post type file
require_once( WPSISAC_VERSION_DIR . '/includes/wpsisac-slider-custom-post.php' );

// Shortcode File
require_once( WPSISAC_VERSION_DIR . '/includes/shortcodes/wpsisac-slider.php' );
require_once( WPSISAC_VERSION_DIR . '/includes/shortcodes/wpsisac-carousel.php' );

// Admin File
require_once( WPSISAC_VERSION_DIR . '/includes/admin/class-wpsisac-admin.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WPSISAC_VERSION_DIR . '/includes/admin/wpsisac-how-it-work.php' );	
}

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl25_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'			=> 25,
							'file'			=> plugin_basename( __FILE__ ),
							'name'			=> 'WP Slick Slider and Image Carousel',
							'slug'			=> 'wp-slick-slider-and-image-carousel',
							'type'			=> 'plugin',
							'menu'			=> 'edit.php?post_type=slick_slider',
							'text_domain'	=> 'wp-slick-slider-and-image-carousel',
							'promotion'		=> array(
													'bundle' => array(
															'name'	=> 'Download FREE 50+ Plugins, 10+ Themes and Dashboard Plugin',
															'desc'	=> 'Download FREE 50+ Plugins, 10+ Themes and Dashboard Plugin',
															'file'	=> 'https://www.wponlinesupport.com/latest/wpos-free-50-plugins-plus-12-themes.zip'
														)
													),
							'offers'		=> array(
													'trial_premium' => array(
														'image'	=> 'http://analytics.wponlinesupport.com/?anylc_img=25',
														'link'	=> 'http://analytics.wponlinesupport.com/?anylc_redirect=25',
														'desc'	=> 'Or start using the plugin from admin menu',
													)
												),
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl25_load();
/* Plugin Wpos Analytics Data Ends */