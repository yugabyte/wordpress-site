<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wpsisacm_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */
function wpsisacm_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WPSISAC_POST_TYPE, __('How it works, our plugins and offers', 'wp-slick-slider-and-image-carousel'), __('How It Works', 'wp-slick-slider-and-image-carousel'), 'manage_options', 'wpsisacm-designs', 'wpsisacm_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */
function wpsisacm_designs_page() {

	$wpos_feed_tabs = wpsisacm_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap wpsisacm-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WPSISAC_POST_TYPE, 'page' => 'wpsisacm-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="wpsisacm-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wpsisacm_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wpsisacm_get_plugin_design( 'plugins-feed' );
			} else {
				echo wpsisacm_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .wpsisacm-tab-cnt-wrp -->

	</div><!-- end .wpsisacm-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */
function wpsisacm_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wpsisacm_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'wpsisacm_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed 			= wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'wp-slick-slider-and-image-carousel' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */
function wpsisacm_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'wp-slick-slider-and-image-carousel'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'wp-slick-slider-and-image-carousel'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('Hire Us', 'wp-slick-slider-and-image-carousel'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/wpos-offers.php',
													'transient_key'		=> 'wpos_offers_feed',
													'transient_time'	=> 86400,
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package WP Slick Slider and Image Carousel
 * @since 1.0.0
 */
function wpsisacm_howitwork_page() { ?>

	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpsisacm-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpsisacm-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and shortcode', 'wp-slick-slider-and-image-carousel' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Geeting Started with Slick Slider', 'wp-slick-slider-and-image-carousel'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Go to "Slick Slider --> Add Slide tab".', 'wp-slick-slider-and-image-carousel'); ?></li>
														<li><?php _e('Step-2. Add image title, description and images as a featured image', 'wp-slick-slider-and-image-carousel'); ?></li>
														<li><?php _e('Step-3. Repeat this process for number of slides you want.', 'wp-slick-slider-and-image-carousel'); ?></li>
														<li><?php _e('Step-4. To display multiple slider, you can use category shortcode under "Slick Slider--> Slider Category"', 'wp-slick-slider-and-image-carousel'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'wp-slick-slider-and-image-carousel'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like Slider OR add the shortcode in any page.', 'wp-slick-slider-and-image-carousel'); ?></li>
														<li><?php _e('Step-2. Put below shortcode as per your need.', 'wp-slick-slider-and-image-carousel'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'wp-slick-slider-and-image-carousel'); ?>:</label>
												</th>
												<td>
													<span class="wpsisacm-shortcode-preview">[slick-slider]</span> – <?php _e('Slick slider Shortcode (design-1 to design-5)', 'wp-slick-slider-and-image-carousel'); ?> <br />
													<span class="wpsisacm-shortcode-preview">[slick-carousel-slider]</span> – <?php _e('Slick slider carousel Shortcode (design-6)', 'wp-slick-slider-and-image-carousel'); ?> <br />
													<span class="wpsisacm-shortcode-preview">[slick-carousel-slider centermode="true"]</span> – <?php _e('Slick slider carousel with center mode Shortcode (design-6)', 'wp-slick-slider-and-image-carousel'); ?> <br />
													<span class="wpsisacm-shortcode-preview">[slick-carousel-slider variablewidth="true" centermode="true"]</span> – <?php _e('Slick slider carousel with variablewidth Shortcode (design-6)', 'wp-slick-slider-and-image-carousel'); ?>
												</td>
											</tr>						
												
											<tr>
												<th>
													<label><?php _e('Need Support?', 'wp-slick-slider-and-image-carousel'); ?></label>
												</th>
												<td>
													<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'wp-slick-slider-and-image-carousel'); ?></p> <br/>
													<a class="button button-primary" href="http://docs.wponlinesupport.com/wp-slick-slider-and-image-carousel/" target="_blank"><?php _e('Documentation', 'wp-slick-slider-and-image-carousel'); ?></a>									
													<a class="button button-primary" href="http://demo.wponlinesupport.com/slick-slider-demo/" target="_blank"><?php _e('Demo for Designs', 'wp-slick-slider-and-image-carousel'); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e( 'Upgrate to Pro', 'wp-slick-slider-and-image-carousel' ); ?></span>
								</h3>
								<div class="inside">										
									<ul class="wpos-list">
										<li>90+ Predefined stunning designs</li>
										<li>Visual composer support</li>
										<li>Drag & Drop order change</li>
										<li>30 Image Slider Designs</li>
										<li>30 Image Carousel and Center Slider Designs</li>
										<li>33 Slider Variable width Designs</li>
										<li>Custom css</li>									
										<li>Slider Center Mode Effect</li>
										<li>Slider RTL support</li>
										<li>Fully responsive</li>
										<li>100% Multi language</li>
									</ul>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wp-plugin/wp-slick-slider-and-image-carousel/" target="_blank"><?php _e('Go Premium ', 'wp-slick-slider-and-image-carousel'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/pro-wp-slick-slider-and-carousel-demo/" target="_blank"><?php _e('View PRO Demo ', 'wp-slick-slider-and-image-carousel'); ?></a></p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'wp-slick-slider-and-image-carousel' ); ?></span>
									</h3>									
									<div class="inside">										
										<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/wp-slick-slider-and-image-carousel/reviews/" target="_blank">5 stars!</a></p>
									</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php }