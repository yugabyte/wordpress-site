<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpsisac_Admin {

	function __construct() {		

		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wpsisac_register_menu'), 12 );

		// Admin init process
		add_action( 'admin_init', array($this, 'wpsisac_admin_init_process') );
	}

	/**
	 * Function to add menu
	 * 
	 * @package WP Slick Slider and Image Carousel
	 * @since 1.0.0
	 */
	function wpsisac_register_menu() {

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WPSISAC_POST_TYPE, __('Upgrade to PRO - WP Slick Slider and Image Carousel', 'wp-slick-slider-and-image-carousel'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'wp-slick-slider-and-image-carousel').'</span>', 'manage_options', 'wpsisac-premium', array($this, 'wpsisac_premium_page') );

		// Register plugin hire us page
		add_submenu_page( 'edit.php?post_type='.WPSISAC_POST_TYPE, __('Hire Us', 'wp-slick-slider-and-image-carousel'), '<span style="color:#2ECC71">'.__('Hire Us', 'wp-slick-slider-and-image-carousel').'</span>', 'manage_options', 'wpnw-hireus', array($this, 'wpsisac_hireus_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Slick Slider and Image Carousel
	 * @since 1.0.0
	 */
	function wpsisac_premium_page() {
		include_once( WPSISAC_VERSION_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Hire Us Page Html
	 * 
	 * @package WP Slick Slider and Image Carousel
	 * @since 1.0.0
	 */
	function wpsisac_hireus_page() {		
		include_once( WPSISAC_VERSION_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Function to notification transient
	 * 
	 * @package WP Slick Slider and Image Carousel
	 * @since 1.5
	 */
	function wpsisac_admin_init_process() {
		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'wpsisac-plugin-notice' ) {
	    	set_transient( 'wpsisac_install_notice', true, 604800 );
	    }
	}
}

$wpsisac_admin = new Wpsisac_Admin();