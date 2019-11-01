<?php
/*
Plugin Name: iubenda Cookie Solution for GDPR
Plugin URI: https://www.iubenda.com
Description: iubenda Cookie Solution allows you to make your website GDPR compliant and manage all aspects of cookie law on WP.
Version: 1.15.3
Author: iubenda
Author URI: https://www.iubenda.com
License: MIT License
License URI: http://opensource.org/licenses/MIT
Text Domain: iubenda-cookie-law-solution
Domain Path: /languages

ibenda Cookie Solution
Copyright (C) 2018, iubenda s.r.l

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

// define contants
define( 'IUB_DEBUG', false );

// set plugin instance
$iubenda_cookie_law_solution = new iubenda_Cookie_Law_Solution();

/**
 * iubenda_Cookie_Law_Solution final class.
 *
 * @class iubenda_Cookie_Law_Solution
 * @version	1.15.2
 */
class iubenda_Cookie_Law_Solution {

	public $options;
	public $defaults = array(
		'parse'			 => false, // iubenda_parse
		'skip_parsing'	 => true, // skip_parsing
		'ctype'			 => true, // iubenda_ctype
		'parse'			 => false, // iubenda_parse
		'parser_engine'	 => 'new', // parser_engine
		'output_feed'	 => true, // iubenda_output_feed
		'code_default'	 => false, // iubenda-code-default,
		'menu_position'	 => 'topmenu',
		'deactivation'	 => false
	);
	public $version = '1.15.3';
	public $no_html = false;
	public $links = array();
	public $multilang = false;
	public $languages = array();
	public $lang_default = '';

	/**
	 * Class constructor.
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		// settings
		$this->options = array_merge( $this->defaults, (array) get_option( 'iubenda_cookie_law_solution', $this->defaults ) );

		// actions
		add_action( 'admin_init', array( $this, 'register_options' ) );
		add_action( 'admin_init', array( $this, 'update_plugin' ), 9 );
		add_action( 'admin_init', array( $this, 'admin_page_redirect' ), 20 );
		add_action( 'admin_menu', array( $this, 'admin_menu_options' ) );
		add_action( 'admin_notices', array( $this, 'settings_errors' ) );
		// add_action( 'admin_menu', array( $this, 'save_options' ), 9 );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'after_setup_theme', array( $this, 'register_shortcode' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_print_styles', array( $this, 'admin_print_styles' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ), 99 );
		add_action( 'template_redirect', array( $this, 'output_start' ), 0 );
		add_action( 'shutdown', array( $this, 'output_end' ), 100 );
	}

	/**
	 * Initialize plugin.
	 * 
	 * @return void
	 */
	public function init() {
		// check if WPML or Polylang is active
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		// Polylang support
		if ( ( is_plugin_active( 'polylang/polylang.php' ) || is_plugin_active( 'polylang-pro/polylang.php' ) ) && function_exists( 'PLL' ) ) {
			$this->multilang = true;

			// get registered languages
			$registered_languages = PLL()->model->get_languages_list();

			if ( ! empty( $registered_languages ) ) {
				foreach ( $registered_languages as $language )
					$this->languages[$language->slug] = $language->name;
			}

			// get default language
			$this->lang_default = pll_default_language();

		// WPML support
		} elseif ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) && class_exists( 'SitePress' ) ) {
			$this->multilang = true;

			global $sitepress;

			// get registered languages
			$registered_languages = icl_get_languages();

			if ( ! empty( $registered_languages ) ) {
				foreach ( $registered_languages as $language )
					$this->languages[$language['code']] = $language['display_name'];
			}

			// get default language
			$this->lang_default = $sitepress->get_default_language();
		}

		// load iubenda parser
		require_once( dirname( __FILE__ ) . '/iubenda-cookie-class/iubenda.class.php' );
		
		$links = array(
			'en' => array(
				'guide'	=> 'https://www.iubenda.com/en/iubenda-cookie-law-solution',
				'plugin_page' => 'https://www.iubenda.com/en/help/posts/1215',
				'generating_code' => 'https://www.iubenda.com/en/help/posts/1177',
				'support_forum' => 'https://support.iubenda.com/forums/314835-general/suggestions/9670701-discussion-regarding-the-iubenda-cookie-law-soluti',
				'documentation' => 'https://www.iubenda.com/en/help/posts/1215'
			),
			'it' => array(
				'guide'	=> 'https://www.iubenda.com/it/soluzione-cookie-law',
				'plugin_page' => 'https://www.iubenda.com/it/help/posts/810',
				'generating_code' => 'https://www.iubenda.com/it/help/posts/680',
				'support_forum' => 'https://support.iubenda.com/forums/314835-general/suggestions/9670701-discussion-regarding-the-iubenda-cookie-law-soluti',
				'documentation' => 'https://www.iubenda.com/it/help/posts/810',
			)
		);
		
		$locale = explode( '_', get_locale() );
		$locale_code = $locale[0];
		
		// assign links
		$this->links = in_array( $locale_code, array_keys( $links ) ) ? $links[$locale_code] : $links['en'];
	}

	/**
	 * Plugin activation.
	 * 
	 * @return void
	 */
	public function activation() {
		add_option( 'iubenda_cookie_law_solution', $this->options, '', 'no' );
		add_option( 'iubenda_cookie_law_version', $this->version, '', 'no' );
	}

	/**
	 * Plugin deactivation.
	 * 
	 * @return void
	 */
	public function deactivation() {
		// remove options from database?
		if ( $this->options['deactivation'] ) {
			delete_option( 'iubenda_cookie_law_solution' );
			delete_option( 'iubenda_cookie_law_version' );
		}
	}

	/**
	 * Plugin options migration for versions < 1.14.0
	 * 
	 * @return void
	 */
	public function update_plugin() {
		if ( ! current_user_can( 'install_plugins' ) )
			return;

		$db_version = get_option( 'iubenda_cookie_law_version' );
		$db_version = ! $db_version ? '1.13.0' : $db_version;

		if ( $db_version != false ) {
			if ( version_compare( $db_version, '1.14.0', '<' ) ) {
				$options = array();

				$old_new = array(
					'iubenda_parse'			 => 'parse',
					'skip_parsing'			 => 'skip_parsing',
					'iubenda_ctype'			 => 'ctype',
					'iubenda_parse'			 => 'parse',
					'parser_engine'			 => 'parser_engine',
					'iubenda_output_feed'	 => 'output_feed',
					'iubenda-code-default'	 => 'code_default',
					'default_skip_parsing'	 => '',
					'default_iubendactype'	 => '',
					'default_iubendaparse'	 => '',
					'default_parser_engine'	 => '',
					'iub_code'				 => '',
				);

				foreach ( $old_new as $old => $new ) {
					if ( $new ) {
						$options[$new] = get_option( $old );
					}
					delete_option( $old );
				}

				// multilang support
				if ( ! empty( $this->languages ) ) {
					foreach ( $this->languages as $lang ) {
						$code = get_option( 'iubenda-code-' . $lang );

						if ( ! empty( $code ) ) {
							$options['code_' . $lang] = $code;

							delete_option( 'iubenda-code-' . $lang );
						}
					}
				}

				add_option( 'iubenda_cookie_law_solution', $options, '', 'no' );
				add_option( 'iubenda_cookie_law_version', $this->version, '', 'no' );
			}
		}
	}

	/**
	 * Register shortcode function.
	 *
	 * @return void
	 */
	public function register_shortcode() {
		add_shortcode( 'iub-cookie-policy', array( $this, 'shortcode' ) );
	}

	/**
	 * Handle shortcode function.
	 * 
	 * @param array $atts
	 * @param mixed $content
	 * @return mixed
	 */
	public function shortcode( $atts, $content = '' ) {
		return '<!--IUB-COOKIE-BLOCK-START-->' . do_shortcode( $content ) . '<!--IUB-COOKIE-BLOCK-END-->';
	}

	/**
	 * Add submenu.
	 *
	 * @return void
	 */
	public function admin_menu_options() {
		if ( $this->options['menu_position'] === 'submenu' ) {
			// sub menu
			add_submenu_page(
				'options-general.php', 'iubenda', 'iubenda', apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda-cookie-law-solution', array( $this, 'options_page' ), 'none' 
			);
		} else {
			// top menu
			add_menu_page(
				'iubenda', 'iubenda', apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda-cookie-law-solution', array( $this, 'options_page' ), 'none' 
			);
		}
	}

	/**
	 * Load textdomain.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'iubenda-cookie-law-solution', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Load admin scripts and styles.
	 * 
	 * @param string $page
	 * @return void
	 */
	public function admin_enqueue_scripts( $page ) {
		if ( ! in_array( $page, array( 'toplevel_page_iubenda-cookie-law-solution', 'settings_page_iubenda-cookie-law-solution' ) ) )
			return;

		wp_enqueue_script(
		'iubenda-admin', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' )
		);

		wp_enqueue_style( 'iubenda-admin', plugins_url( 'css/admin.css', __FILE__ ) );
	}

	/**
	 * Load admin style inline, for menu icon only.
	 * 
	 * @return mixed
	 */
	public function admin_print_styles() {
		echo '
		<style>
			a.toplevel_page_iubenda-cookie-law-solution .wp-menu-image {
				background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDkuNDE4IiBoZWlnaHQ9IjI3My4wMTgiIHZpZXdCb3g9IjAgMCAxMDkuNDE4IDI3My4wMTgiPjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjRkZGIiBkPSJNMTA5LjQxOCA1NC41M0MxMDkuNDE4IDI0LjQwNCA4NC45MzYgMCA1NC43MDggMCAyNC40ODYgMCAwIDI0LjQwNCAwIDU0LjUzYzAgMTQuNzY1IDUuOSAyOC4xNCAxNS40ODcgMzcuOTUzTDQuMTI0IDI3My4wMThoMTAzLjg3TDk2LjQ3NyA4OS43MzJjOC4wODYtOS41MDQgMTIuOTQtMjEuNzgyIDEyLjk0LTM1LjIwMnptLTY1LjM2LTkuOTAzQzQ3LjAwNyA0MS42OCA1MC42MyA0MC4yIDU0LjkzIDQwLjJjNC4yIDAgNy43NzMgMS40OCAxMC43MjUgNC40MjcgMi45NDggMi45NDggNC40MjQgNi41MjIgNC40MjQgMTAuNzI0IDAgNC4xOTctMS40NzYgNy43OTUtNC40MjQgMTAuNzk1LTIuOTUyIDMtNi41MjQgNC40OTgtMTAuNzI0IDQuNDk4LTQuMTk4IDAtNy44LTEuNDk4LTEwLjc5Ny00LjQ5OC0zLTMtNC41LTYuNi00LjUtMTAuNzk0LS4wMDItNC4yIDEuNDczLTcuNzc0IDQuNDI2LTEwLjcyM3ptNDQuMTY1IDIwOC44M0gyMS40ODZ2LTUuNDAyYzYuNyAwIDExLjItLjY0NiAxMy40OTgtMS45NDYgMi4yOTgtMS4yOTUgNC4xMjUtMy40NSA1LjQ3NS02LjQ0NyAxLjM0Ni0zIDIuMDIzLTguNzQ3IDIuMDIzLTE3LjI0N3YtNTIuOTQzYzAtMTQuODk4LS40NTMtMjQuNTQtMS4zNTItMjguOTQ0LS42OTgtMy4xOTYtMS43OTctNS40Mi0zLjMtNi42Ny0xLjQ5NS0xLjI1LTMuNTQ4LTEuODc0LTYuMTQ3LTEuODc0LTIuNzk4IDAtNi4yLjc1LTEwLjE5NyAyLjI1bC0yLjEwMi01LjQgNDEuMzk0LTE2Ljc5N2g2LjZ2MTEwLjM3N2MwIDguNTk4LjYyNCAxNC4zMiAxLjg3NSAxNy4xNyAxLjI1IDIuODQ4IDMuMDk2IDQuOTc0IDUuNTQ4IDYuMzc0IDIuNDUgMS40MDMgNi45MjYgMi4wOTcgMTMuNDIzIDIuMDk3djUuNHoiLz48L3N2Zz4=);
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 7px auto;
			}
		</style>
		';
	}
	
	/**
	 * Redirect to the correct urle after switching menu position.
	 * 
	 * @global string $pagenow
	 * @return void
	 */
	public function admin_page_redirect() {
		if ( ! empty( $_GET['settings-updated'] ) && ! empty( $_GET['page'] ) && in_array( $_GET['page'], array( 'iubenda-cookie-law-solution' ) ) ) {
			global $pagenow;
			
			// no redirect by default
			$redirect_to = false;
			
			if ( $this->options['menu_position'] === 'submenu' && $pagenow === 'admin.php' ) {
				// sub menu
				$redirect_to = admin_url( 'options-general.php?page=iubenda-cookie-law-solution' );
			} elseif ( $this->options['menu_position'] === 'topmenu' && $pagenow === 'options-general.php' ) {
				// top menu
				$redirect_to = admin_url( 'admin.php?page=iubenda-cookie-law-solution' );
			}
			
			if ( $redirect_to ) {
				// make sure it's current host location
				wp_safe_redirect( add_query_arg( 'settings-updated', true, $redirect_to ) );
				exit;
			}	
		}
	}

	/**
	 * Add wp_head content.
	 * 
	 * @return void
	 */
	public function wp_head() {
		// break on admin side
		if ( is_admin() )
			return;

		// check content type
		if ( (bool) $this->options['ctype'] == true ) {
			$iub_headers = headers_list();
			$destroy = true;

			foreach ( $iub_headers as $header ) {
				if ( strpos( $header, "Content-Type: text/html" ) !== false || strpos( $header, "Content-type: text/html" ) !== false ) {
					$destroy = false;
					break;
				}
			}

			if ( $destroy )
				$this->no_html = true;
		}

		// is post or not html content type?
		if ( $_POST || $this->no_html )
			return;

		// initial head output
		$iubenda_code = "";

		if ( $this->multilang === true && defined( 'ICL_LANGUAGE_CODE' ) && isset( $this->options['code_' . ICL_LANGUAGE_CODE] ) ) {
			$iubenda_code .= $this->options['code_' . ICL_LANGUAGE_CODE];

			// no code for current language, use default
			if ( ! $iubenda_code ) {
				$iubenda_code .= $this->options['code_default'];
			}
		} else
			$iubenda_code .= $this->options['code_default'];

		$iubenda_code .= "\n
		<script>
			var iCallback = function() {};
	
			if ( typeof _iub.csConfiguration != 'undefined' ) {
				if ( 'callback' in _iub.csConfiguration ) {
					if ( 'onConsentGiven' in _iub.csConfiguration.callback )
						iCallback = _iub.csConfiguration.callback.onConsentGiven;
		
					_iub.csConfiguration.callback.onConsentGiven = function() {
						iCallback();
	
						/* separator */	   
						jQuery('noscript._no_script_iub').each(function (a, b) { var el = jQuery(b); el.after(el.html()); });
					}
				}
			}
		</script>";

		echo $iubenda_code;
	}

	/**
	 * Initialize html output.
	 * 
	 * @return void
	 */
	public function output_start() {
		if ( ! is_admin() )
			ob_start( array( $this, 'output_callback' ) );
	}

	/**
	 * Finish html output.
	 * 
	 * @return void
	 */
	public function output_end() {
		if ( ! is_admin() && ob_get_level() )
			ob_end_flush();
	}

	/**
	 * Handle final html output.
	 * 
	 * @param mixed $output
	 * @return mixed
	 */
	public function output_callback( $output ) {
		// break on ajax, xmlrpc or iub_no_parse request
		if (
			( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) 
			|| ( defined( 'DOING_AJAX' ) && DOING_AJAX ) 
			|| isset( $_SERVER["HTTP_X_REQUESTED_WITH"] ) 
			|| isset( $_GET['iub_no_parse'] ) 
		)
			return $output;

		// break on admin side
		if ( is_admin() )
			return $output;

		// break on rss feed
		if ( is_feed() && $this->options['output_feed'] )
			return $output;

		if ( strpos( $output, "<html" ) === false )
			return $output;
		elseif ( strpos( $output, "<html" ) > 200 )
			return $output;

		// check whether to run parser or not
		if ( ! $this->options['parse'] || ( iubendaParser::consent_given() && $this->options['skip_parsing'] ) || iubendaParser::bot_detected() || $_POST || $this->no_html )
			return $output;

		$startime = microtime( true );
		$output = apply_filters( 'iubenda_initial_output', $output );

		// experimental class
		if ( $this->options['parser_engine'] == 'new' ) {
			$iubenda = new iubendaParser( mb_convert_encoding( $output, 'HTML-ENTITIES', 'UTF-8' ), array( 'type' => 'faster' ) );

			// render output
			$output = $iubenda->parse();

			// append signature
			$output .= '<!-- Parsed with iubenda experimental class in ' . round( microtime( true ) - $startime, 4 ) . ' sec. -->';
		// default class
		} else {
			$iubenda = new iubendaParser( $output, array( 'type' => 'page' ) );

			// render output
			$output = $iubenda->parse();

			// append signature
			$output .= '<!-- Parsed with iubenda default class in ' . round( microtime( true ) - $startime, 4 ) . ' sec. -->';
		}

		return apply_filters( 'iubenda_final_output', $output );
	}

	/**
	 * Register plugin options.
	 *
	 * @return void
	 */
	public function register_options() {
		register_setting( 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution', array( $this, 'save_options' ) );

		add_settings_section( 'iubenda_cookie_law_solution', '', '', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_code', __( 'Code', 'iubenda-cookie-law-solution' ), array( $this, 'iub_code' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_parse', __( 'Scripts blocking', 'iubenda-cookie-law-solution' ), array( $this, 'iub_parse' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_ctype', __( 'Content type', 'iubenda-cookie-law-solution' ), array( $this, 'iub_ctype' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_output_feed', __( 'RSS feed', 'iubenda-cookie-law-solution' ), array( $this, 'iub_output_feed' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_menu_position', __( 'Menu position', 'iubenda-cookie-law-solution' ), array( $this, 'iub_menu_position' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_deactivation', __( 'Deactivation', 'iubenda-cookie-law-solution' ), array( $this, 'iub_deactivation' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
	}

	/**
	 * Display errors and notices.
	 * 
	 * @global string $pagenow
	 */
	public function settings_errors() {
		global $pagenow;
		
		// force display notices in top menu settings page
		if ( $pagenow != 'options-general.php' )
			settings_errors( 'iub_settings_errors' );
	}

	/**
	 * Code option.
	 * 
	 * @return mixed
	 */
	public function iub_code() {
		// multilang support
		if ( $this->multilang && ! empty( $this->languages ) ) {
			echo '
			<div id="contextual-help-wrap" class="hidden" tabindex="-1" style="display: block;">
				<div id="contextual-help-back"></div>
				<div id="contextual-help-columns">
					<div class="contextual-help-tabs">
						<ul>';
			foreach ( $this->languages as $lang_id => $lang_name ) {
				echo '
							<li id="tab-link-overview" class="' . ( $this->lang_default == $lang_id ? 'active' : '' ) . '">
								<a href="#tab-panel-' . $lang_id . '" aria-controls="tab-panel-' . $lang_id . '">' . $lang_name . '</a>
							</li>';
			}
			echo '
						</ul>
					</div>

					<div class="contextual-help-tabs-wrap">';
						foreach ( $this->languages as $lang_id => $lang_name ) {
							// get code for the language
							$code = ! empty( $this->options['code_' . $lang_id] ) ? html_entity_decode( trim( wp_kses( $this->options['code_' . $lang_id], $this->get_allowed_html() ) ) ) : '';
							// handle default, if empty
							$code = empty( $code ) && $lang_id == $this->lang_default ? html_entity_decode( trim( wp_kses( $this->options['code_default'], $this->get_allowed_html() ) ) ) : $code;
							
							echo '
							<div id="tab-panel-' . $lang_id . '" class="help-tab-content' . ( $this->lang_default == $lang_id ? ' active' : '' ) . '">
								<textarea name="iubenda_cookie_law_solution[code_' . $lang_id . ']" class="large-text" cols="50" rows="10">' . $code . '</textarea>
								<p class="description">' . sprintf( __( 'Enter the iubenda code for %s.', 'iubenda-cookie-law-solution' ), $lang_name ) . '</p>
							</div>';
						}
			echo '
					</div>
				</div>
			</div>';
		} else {
			echo '
			<div id="iub_code_default">
				<textarea name="iubenda_cookie_law_solution[code_default]" class="large-text" cols="50" rows="10">' . html_entity_decode( trim( wp_kses( $this->options['code_default'], $this->get_allowed_html() ) ) ) . '</textarea>
				<p class="description">' . __( 'Enter the iubenda code.', 'iubenda-cookie-law-solution' ) . '</p>
			</div>';
		}
	}

	/**
	 * Parsing option.
	 * 
	 * @return mixed
	 */
	public function iub_parse() {
		echo '
		<div id="iub_parse_container">
			<label><input id="iub_parse" type="checkbox" name="iubenda_cookie_law_solution[parse]" value="1" ' . checked( true, (bool) $this->options['parse'], false ) . '/>' . __( 'Automatically block scripts detected by the plugin.', 'iubenda-cookie-law-solution' ) . '</label>
			<p class="description">' . '(' . sprintf( __( "see <a href=\"%s\" target=\"_blank\">our documentation</a> for the list of detected scripts.", 'iubenda-cookie-law-solution' ), $this->links['documentation'] ) . ')' . '</p>
			<div id="iub_parser_engine_container"' . ( $this->options['parse'] === false ? ' style="display: none;"' : '' ) . '>
				<div>
					<label><input id="iub_parser_engine-new" type="radio" name="iubenda_cookie_law_solution[parser_engine]" value="new" ' . checked( 'new', $this->options['parser_engine'], false ) . ' />' . __( 'Primary', 'iubenda-cookie-law-solution' ) . '</label>
					<label><input id="iub_parser_engine-default" type="radio" name="iubenda_cookie_law_solution[parser_engine]" value="default" ' . checked( 'default', $this->options['parser_engine'], false ) . ' />' . __( 'Secondary', 'iubenda-cookie-law-solution' ) . '</label>
					<p class="description">' . __( 'Select parsing engine.', 'iubenda-cookie-law-solution' ) . '</p>
				</div>
				<div>
					<label><input id="iub_skip_parsing" type="checkbox" name="iubenda_cookie_law_solution[skip_parsing]" value="1" ' . checked( true, (bool) $this->options['skip_parsing'], false ) . '/>' . __( 'Leave scripts untouched on the page if the user has already given consent', 'iubenda-cookie-law-solution' ) . '</label>
					<p class="description">(' . __( "improves performance, highly recommended, to be deactivated only if your site uses a caching system", 'iubenda-cookie-law-solution' ) . ')</p>
				</div>
			</div>
		</div>';
	}

	/**
	 * Ctype option.
	 * 
	 * @return mixed
	 */
	public function iub_ctype() {
		echo '
		<div id="iub_ctype_container">
			<label><input id="iub_ctype" type="checkbox" name="iubenda_cookie_law_solution[ctype]" value="1" ' . checked( true, (bool) $this->options['ctype'], false ) . '/>' . __( 'Restrict the plugin to run only for requests that have "Content-type: text / html" (recommended)', 'iubenda-cookie-law-solution' ) . '</label>
		</div>';
	}

	/**
	 * RSS feed option.
	 * 
	 * @return mixed
	 */
	public function iub_output_feed() {
		echo '
		<div id="iub_output_feed_container">
			<label><input id="iub_ctype" type="checkbox" name="iubenda_cookie_law_solution[output_feed]" value="1" ' . checked( true, (bool) $this->options['output_feed'], false ) . '/>' . __( 'Do not run the plugin inside the RSS feed (recommended)', 'iubenda-cookie-law-solution' ) . '</label>
		</div>';
	}
	
	/**
	 * Menu option.
	 * 
	 * @return mixed
	 */
	public function iub_menu_position() {
		echo '
		<div id="iub_menu_position_container">
			<label><input id="iub_menu_position-topmenu" type="radio" name="iubenda_cookie_law_solution[menu_position]" value="topmenu" ' . checked( 'topmenu', $this->options['menu_position'], false ) . ' />' . __( 'Top menu', 'iubenda-cookie-law-solution' ) . '</label>
			<label><input id="iub_menu_position-submenu" type="radio" name="iubenda_cookie_law_solution[menu_position]" value="submenu" ' . checked( 'submenu', $this->options['menu_position'], false ) . ' />' . __( 'Submenu', 'iubenda-cookie-law-solution' ) . '</label>
			<p class="description">' . __( 'Select whether to display iubenda in a top admin menu or the Settings submenu.', 'iubenda-cookie-law-solution' ) . '</p>
		</div>';
	}

	/**
	 * Deactivation option.
	 * 
	 * @return mixed
	 */
	public function iub_deactivation() {
		echo '
		<div id="iub_deactivation_container">
			<label><input id="iub_deactivation" type="checkbox" name="iubenda_cookie_law_solution[deactivation]" value="1" ' . checked( true, (bool) $this->options['deactivation'], false ) . '/>' . __( 'Delete all plugin data upon deactivation?', 'iubenda-cookie-law-solution' ) . '</label>
		</div>';
	}

	/**
	 * Save options.
	 * 
	 * @return void
	 */
	public function save_options( $input ) {
		if ( ! current_user_can( apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ) ) )
			return $input;
		
		// save options
		if ( isset( $_POST['save_iubenda_options'] ) ) {
			$input['parse'] = (bool) isset( $input['parse'] );
			$input['parser_engine'] = isset( $input['parser_engine'] ) && in_array( $input['parser_engine'], array( 'default', 'new' ) ) ? $input['parser_engine'] : $this->defaults['parser_engine'];
			$input['skip_parsing'] = (bool) isset( $input['skip_parsing'] );
			$input['ctype'] = (bool) isset( $input['ctype'] );
			$input['output_feed'] = (bool) isset( $input['output_feed'] );
			$input['menu_position'] = isset( $input['menu_position'] ) && in_array( $input['menu_position'], array( 'topmenu', 'submenu' ) ) ? $input['menu_position'] : $this->defaults['menu_position'];
			$input['deactivation'] = (bool) isset( $input['deactivation'] );

			// multilang support
			if ( $this->multilang && ! empty( $this->languages ) ) {
				foreach ( $this->languages as $lang_id => $lang_name ) {
					$input['code_' . $lang_id] = ! empty( $input['code_' . $lang_id] ) ? wp_kses( $input['code_' . $lang_id], $this->get_allowed_html() ) : '';
					
					// handle default lang too
					if ( $lang_id == $this->lang_default ) {
						$input['code_default'] = ! empty( $input['code_' . $lang_id] ) ? wp_kses( $input['code_' . $lang_id], $this->get_allowed_html() ) : $this->options['code_default'];
					}
				}
			} else {
				$input['code_default'] = ! empty( $input['code_default'] ) ? wp_kses( $input['code_default'], $this->get_allowed_html() ) : '';
			}

			add_settings_error( 'iub_settings_errors', 'iub_settings_updated', __( 'Settings saved.', 'iubenda-cookie-law-solution' ), 'updated' );
			// reset options
		} elseif ( isset( $_POST['reset_iubenda_options'] ) ) {
			$input = $this->defaults;

			// multilang support
			if ( $this->multilang && ! empty( $this->languages ) ) {
				foreach ( $this->languages as $lang_id => $lang_name ) {
					$input['code_' . $lang_id] = '';
				}
			}
			add_settings_error( 'iub_settings_errors', 'iub_settings_restored', __( 'Settings restored to defaults.', 'iubenda-cookie-law-solution' ), 'updated' );
		}

		return $input;
	}
	
	/**
	 * Get allowed iubenda script HTML.
	 *
	 * @return array
	 */
	public function get_allowed_html() {
		return apply_filters(
			'iub_code_allowed_html',
			array_merge(
				wp_kses_allowed_html( 'post' ),
				array(
					'script' => array(
						'type' => array(),
						'src' => array(),
						'charset' => array(),
						'async' => array()
					),
					'noscript' => array(),
					'style' => array(
						'type' => array()
					),
					'iframe' => array(
						'src' => array(),
						'height' => array(),
						'width' => array(),
						'frameborder' => array(),
						'allowfullscreen' => array()
					)
				)
			)
		);
	}

	/**
	 * Load admin options page.
	 * 
	 * @return void
	 */
	public function options_page() {
		if ( ! current_user_can( apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ) ) ) {
			wp_die( __( "You don't have permission to access this page.", 'iubenda-cookie-law-solution' ) );
		}
		?>
		<div class="wrap">
			<div id="iubenda-view">
			<?php 
			echo '
				<a class="iubenda-link" href="http://iubenda.com"><img id="iubenda-logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG4AAAAdCAMAAAB8M6mmAAAAhFBMVEUAAAA0O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0I0O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr380O0Ibr3/////G69+35tdTw5/U8Ofx+vdiyKd+0rep4c/i9e8otIeN17/AB1g0AAAAHnRSTlMAEBAgIDAwQEBQUGBwcICAkJCgoLCwwMDQ0ODg8PCQCZ0FAAACrklEQVR4Xr2V63LbIBCFF1OZKBCiKAohlK7kXHt5//cruyDjjFTX42l9fnhh1+yHGB0EAJu7kXS/gUto8zRmPV2Edz/OergA7ctYtV0DCKPPBCgrF7kb4rzs3incrCzpEd05LKEDolqkb4nzNr1RuF1UB8TzcE1E/CPu+7Rbxwnozn06Eddw25H0wr9XsJQh3Flyazh4HGd9hRWpf4zbfptx15fAwR53dRHcWHFSkQDKoOJ05w5M1NjBdXpvFU0WW9TlHidN73rbVtz7844PU7mIiADQOkyaccIjqQOW6DHQ/3yTxiYg2pQhqVIfMPYDYiwZHdF3gdpk3K/XadoVH6hCgbbivMcsyzSPhntiFBAcbcOj6xI/QKl7UYynciOTj9YWJ/z8scfBjIOKQ68ADC2n8+oKNc37FHuqp7xMsQGuRzHvV1U/tMVQVwm0O4oLIg+4v0CkKXNiChZxEMVmbQrN/tBjweVdygXu7g84B3N/D6AxWhYdY8ZZgDroM6QaQUfGiwXu8Tiu5UyP0e3VLHERccUIqseCuzkVJzjjMEDVAtfgCk4HdLrgbk/FQcHhMZxa4hqPLg0WuKcTce1fcPITTvMbtoIbj+MaHvWIAxQFuXqYuuLYMKH08xQeTsVpbqRrPx1h9VVxFcd+6w77PX7G+dmtC5zDILK90XAl2nUjoD7A2fJUzRK3AYCBLzc5JCwqIarNTdmHxaRg7YBR5Gl3iJOx8EyKVkjFuxO8qhky7nV6m79ALXdDLyhGxXdf0EJYjO1s9yLFN2TZjgiIngaaSt4FjPla55AWc5o+dx/P0zQ9fzCOT5EfMBU19+nygl5CkeVEaCo6gOfI76AKuewwWgnQ0NRJcNwVxirGgdSGOlkFs5SxLZFrwppaXUoZ6qD1PFWSQ8p9wl3D/9ZvoAF23RgFj1kAAAAASUVORK5CYII="/></a>
				<p class="iubenda-text">
					' . __( "This plugin is the easiest and most comprehensive way to adapt your WordPress site to the European cookie law. Upon your user's first visit, the plugin will take care of collecting their consent, of blocking the most popular among the scripts that install cookies and subsequently reactivate these scripts as soon as consent is provided. The basic settings include obtaining consent by a simple scroll action (the most effective method) and script reactivation without refreshing the page.", 'iubenda-cookie-law-solution' ) . '
				</p>
				<p class="iubenda-text">
					<span class="iubenda-title">' . __( "Would you like to know more about the cookie law?", 'iubenda-cookie-law-solution' ) . '</span><br />
					' . sprintf( __( "Read our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">complete guide to the cookie law.</a>", 'iubenda-cookie-law-solution' ), $this->links['guide'] ) . '
				</p>
				<p class="iubenda-text">	
					<span class="iubenda-title">' . __( "What is the full functionality of the plugin?", 'iubenda-cookie-law-solution' ) . '</span><br />
					' . sprintf( __( "Visit our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">plugin page.</a>", 'iubenda-cookie-law-solution' ), $this->links['plugin_page'] ) . '
				</p>
				<p class="iubenda-text">
					<span class="iubenda-title">' . __( "Enter the iubenda code for the Cookie Solution below.", 'iubenda-cookie-law-solution' ) . '</span><br />
					' . sprintf( __( "In order to run the plugin, you need to enter the iubenda code that activates the cookie law banner and the cookie policy in the form below. This code can be generated on www.iubenda.com, following <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">this guide.</a>", 'iubenda-cookie-law-solution' ), $this->links['generating_code'] ) . '
				</p>';
		?>
				<form id="iubenda-tabs" action="options.php" method="post">
				<?php
				settings_fields( 'iubenda_cookie_law_solution' );
				do_settings_sections( 'iubenda_cookie_law_solution' );

				echo '	<p class="submit">';
				submit_button( '', 'primary', 'save_iubenda_options', false );
				echo ' ';
				submit_button( __( 'Reset to defaults', 'iubenda-cookie-law-solution' ), 'secondary', 'reset_iubenda_options', false );
				echo '	</p>';
				?>
				</form>
					<?php echo '
				<p class="iubenda-text">
					<span class="iubenda-title">' . __( 'Need support for this plugin?', 'iubenda-cookie-law-solution' ) . '</span><br />
					' . sprintf( __( "Visit our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">support forum.</a>", 'iubenda-cookie-law-solution' ), $this->links['support_forum'] ) . '
				</p>
				<p class="iubenda-text">
					<span class="iubenda-title">' . __( 'Want to try a beta version of this plugin with the latest features?', 'iubenda-cookie-law-solution' ) . '</span><br />
					' . sprintf( __( "Visit our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">documentation pages</a> and follow the instructions to install a beta version.", 'iubenda-cookie-law-solution' ), $this->links['documentation'] ) . '
				</p>';
					?>
			</div>
			<div class="clear"></div>
		</div>
		<?php
	}

}