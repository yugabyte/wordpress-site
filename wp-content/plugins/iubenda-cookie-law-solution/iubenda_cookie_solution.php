<?php
/*
  Plugin Name: Cookie and Consent Solution for the GDPR & ePrivacy
  Plugin URI: https://www.iubenda.com
  Description: An All-in-One approach developed by iubenda, which includes functionalities of two powerful solutions that help to make your website GDPR and ePrivacy compliant.
  Version: 2.3.18
  Author: iubenda
  Author URI: https://www.iubenda.com
  License: MIT License
  License URI: http://opensource.org/licenses/MIT
  Text Domain: iubenda
  Domain Path: /languages

  Cookie and Consent Solution for the GDPR & ePrivacy
  Copyright (C) 2018-2020, iubenda s.r.l

  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

// define contants
define( 'IUB_DEBUG', false );

/**
 * iubenda final class.
 *
 * @class iubenda
 * @version	2.3.18
 */
class iubenda {

	private static $instance;
	public $options = array();
	public $defaults = array(
		'cs' => array(
			'parse'				=> false, // iubenda_parse
			'skip_parsing'		=> true, // skip_parsing
			'ctype'				=> true, // iubenda_ctype
			'parser_engine'		=> 'new', // parser_engine
			'output_feed'		=> true, // iubenda_output_feed
			'output_post'		=> true,
			'code_default'		=> false, // iubenda-code-default,
			'menu_position'		=> 'topmenu',
			'amp_support'		=> false,
			'amp_source'		=> 'local',
			'amp_template_done' => false,
			'amp_template'		=> '',
			'custom_scripts'	=> array(),
			'custom_iframes'	=> array(),
			'deactivation'		=> false
		),
		'cons' => array(
			'public_api_key' => '',
		)
	);
	public $base_url;
	public $version = '2.3.18';
	public $activation = array(
		'update_version'	=> 0,
		'update_notice'		=> true,
		'update_date'		=> '',
		'update_delay_date'	=> 0
	);
	public $no_html = false;
	public $multilang = false;
	public $languages = array();
	public $lang_default = '';
	public $lang_current = '';

	/**
	 * Disable object clone.
	 */
	private function __clone() {

	}

	/**
	 * Disable unserializing of the class.
	 */
	private function __wakeup() {

	}

	/**
	 * Main plugin instance,
	 * Insures that only one instance of the plugin exists in memory at one time.
	 *
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof iubenda ) ) {

			self::$instance = new iubenda;
			self::$instance->define_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( self::$instance, 'init' ) );

			self::$instance->includes();

			self::$instance->AMP = new iubenda_AMP();
			self::$instance->forms = new iubenda_Forms();
			self::$instance->settings = new iubenda_Settings();
		}

		return self::$instance;
	}

	/**
	 * Class constructor.
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		// settings
		$cs_options = (array) get_option( 'iubenda_cookie_law_solution', $this->defaults['cs'] );
		$cons_options = (array) get_option( 'iubenda_consent_solution', $this->defaults['cons'] );

		// activate AMP if not available before
		if ( function_exists( 'is_amp_endpoint' ) || function_exists( 'ampforwp_is_amp_endpoint' ) ) {
			if ( ! isset( $cs_options['amp_support'] ) )
				$this->defaults['cs']['amp_support'] = true;
		}

		$this->options['cs'] = array_merge( $this->defaults['cs'], $cs_options );
		$this->options['cons'] = array_merge( $this->defaults['cons'], $cons_options );

		$this->base_url = esc_url_raw( add_query_arg( 'page', 'iubenda', admin_url( $this->options['cs']['menu_position'] === 'submenu' ? 'options-general.php' : 'admin.php' ) ) );

		// check old custom scripts
		if ( ! empty( $this->options['cs']['custom_scripts'] ) && is_array( $this->options['cs']['custom_scripts'] ) && ! is_int( reset( $this->options['cs']['custom_scripts'] ) ) ) {
			$data = array();

			foreach ( $this->options['cs']['custom_scripts'] as $script ) {
				$data[$script] = 0;
			}

			$this->options['cs']['custom_scripts'] = $data;
		}

		// check old custom iframes
		if ( ! empty( $this->options['cs']['custom_iframes'] ) && is_array( $this->options['cs']['custom_iframes'] ) && ! is_int( reset( $this->options['cs']['custom_iframes'] ) ) ) {
			$data = array();

			foreach ( $this->options['cs']['custom_iframes'] as $iframe ) {
				$data[$iframe] = 0;
			}

			$this->options['cs']['custom_iframes'] = $data;
		}

		// actions
		add_action( 'after_setup_theme', array( $this, 'register_shortcode' ) );
		add_action( 'wp_head', array( $this, 'wp_head_cs' ), 0 );
		add_action( 'wp_head', array( $this, 'wp_head_cons' ), 1 );
		add_action( 'template_redirect', array( $this, 'output_start' ), 0 );
		add_action( 'shutdown', array( $this, 'output_end' ), 100 );
		add_action( 'template_redirect', array( $this, 'disable_jetpack_tracking' ) );
		add_action( 'admin_init', array( $this, 'maybe_do_upgrade' ) );
		add_action( 'upgrader_process_complete', array( $this, 'upgrade' ), 10, 2 );
	}

	/**
	 * Setup plugin constants.
	 *
	 * @return void
	 */
	private function define_constants() {
		define( 'IUBENDA_PLUGIN_URL', plugins_url( '', __FILE__ ) );
		define( 'IUBENDA_PLUGIN_REL_PATH', dirname( plugin_basename( __FILE__ ) ) . '/' );
		define( 'IUBENDA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Include required files.
	 *
	 * @return void
	 */
	private function includes() {
		include_once( IUBENDA_PLUGIN_PATH . 'includes/settings.php' );
		include_once( IUBENDA_PLUGIN_PATH . 'includes/forms.php' );
		include_once( IUBENDA_PLUGIN_PATH . 'includes/amp.php' );
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
			// get current language
			$this->lang_current = pll_current_language();

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
			// get current language
			$this->lang_current = $sitepress->get_current_language();
		}

		// load iubenda parser
		include_once( dirname( __FILE__ ) . '/iubenda-cookie-class/iubenda.class.php' );
	}

	/**
	 * Plugin activation.
	 *
	 * @return void
	 */
	public function activation() {
		set_transient( 'iub_activation_completed', 1, 3600 );

		add_option( 'iubenda_cookie_law_solution', $this->options['cs'], '', 'no' );
		add_option( 'iubenda_cookie_law_solution', $this->options['cons'], '', 'no' );
		add_option( 'iubenda_cookie_law_version', $this->version, '', 'no' );
		add_option( 'iubenda_activation_data', $this->activation, '', 'no' );
	}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public function deactivation() {
		// remove options from database?
		if ( $this->options['cs']['deactivation'] ) {
			delete_option( 'iubenda_cookie_law_solution' );
			delete_option( 'iubenda_consent_solution' );
			delete_option( 'iubenda_cookie_law_version' );
			delete_option( 'iubenda_activation_data' );
		}
	}

	/**
	 * Plugin upgrae.
	 *
	 * @return void
	 */
	public function upgrade( $upgrader_object, $options ) {
		// the path to our plugin's main file
		$our_plugin = plugin_basename( __FILE__ );

		// if an update has taken place and the updated type is plugins and the plugins element exists
		if ( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
			// iterate through the plugins being updated and check if ours is there
			foreach ( $options['plugins'] as $plugin ) {
				if ( $plugin == $our_plugin ) {
					// set a transient to record that our plugin has just been updated
					set_transient( 'iub_upgrade_completed', 1, 3600 );
				}
			}
		}
	}

	/**
	 * Load textdomain.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'iubenda', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register shortcode function.
	 *
	 * @return void
	 */
	public function register_shortcode() {
		add_shortcode( 'iub-cookie-policy', array( $this, 'block_shortcode' ) );
		add_shortcode( 'iub-cookie-block', array( $this, 'block_shortcode' ) );
		add_shortcode( 'iub-cookie-skip', array( $this, 'skip_shortcode' ) );
	}

	/**
	 * Handle block shortcode function.
	 *
	 * @param array $atts
	 * @param mixed $content
	 * @return mixed
	 */
	public function block_shortcode( $atts, $content = '' ) {
		return '<!--IUB-COOKIE-BLOCK-START-->' . do_shortcode( $content ) . '<!--IUB-COOKIE-BLOCK-END-->';
	}

	/**
	 * Handle skip shortcode function.
	 *
	 * @param array $atts
	 * @param mixed $content
	 * @return mixed
	 */
	public function skip_shortcode( $atts, $content = '' ) {
		return '<!--IUB-COOKIE-BLOCK-SKIP-START-->' . do_shortcode( $content ) . '<!--IUB-COOKIE-BLOCK-SKIP-END-->';
	}

	/**
	 * Add wp_head cookie soution content.
	 *
	 * @return mixed
	 */
	public function wp_head_cs() {

		// check content type
		if ( (bool) $this->options['cs']['ctype'] == true ) {
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
		if ( ( $_POST && $this->options['cs']['output_post'] ) || $this->no_html )
			return;

		// initial head output
		$iubenda_code = '';

		if ( $this->multilang === true && defined( 'ICL_LANGUAGE_CODE' ) && isset( $this->options['cs']['code_' . ICL_LANGUAGE_CODE] ) ) {
			$iubenda_code .= $this->options['cs']['code_' . ICL_LANGUAGE_CODE];

			// no code for current language, use default
			if ( ! $iubenda_code )
				$iubenda_code .= $this->options['cs']['code_default'];
		} else
			$iubenda_code .= $this->options['cs']['code_default'];

		$iubenda_code = $this->parse_code( $iubenda_code, true );

		if ( $iubenda_code !== '' ) {
			$iubenda_code .= "\n
			<script>
				var iCallback = function() {};
				var _iub = _iub || {};

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

			echo '<!--IUB-COOKIE-SKIP-START-->' . $iubenda_code . '<!--IUB-COOKIE-SKIP-END-->';
		}
	}

	/**
	 * Add wp_head consent solution content.
	 *
	 * @return mixed
	 */
	public function wp_head_cons() {
		if ( ! empty( $this->options['cons']['public_api_key'] ) ) {

			$parameters = apply_filters( 'iubenda_cons_init_parameters', array(
				'log_level'			 => 'error',
				'logger'			 => 'console',
				'send_from_local'	 => true
			) );

			echo '<!-- Library initialization -->
			<script type="text/javascript">
				var _iub = _iub || { };

				_iub.cons_instructions = _iub.cons_instructions || [ ];
				_iub.cons_instructions.push(
					[ "init", {
							api_key: "' . $this->options['cons']['public_api_key'] . '",
							log_level: "' . $parameters['log_level'] . '",
							logger: "' . ( ! empty( $parameters['logger'] ) && in_array( $parameters['logger'], array( 'console', 'none' ) ) ? $parameters['logger'] : 'console' ) . '",
							sendFromLocalStorageAtLoad: ' . ( (bool) ( $parameters['send_from_local'] ) ? 'true' : 'false' ) . '
						}, function ( ) {
							// console.log( "init callBack" );
						}
					]
				);
			</script>
			<script type="text/javascript" src="//cdn.iubenda.com/cons/iubenda_cons.js" async></script>';
		}
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
		// check whether to run parser or not
		// bail on ajax, xmlrpc or iub_no_parse request
		if (
		( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_SERVER["HTTP_X_REQUESTED_WITH"] ) || isset( $_GET['iub_no_parse'] )
		)
			return $output;

		// bail on admin side
		if ( is_admin() )
			return $output;

		// bail on rss feed
		if ( is_feed() && $this->options['cs']['output_feed'] )
			return $output;

		if ( strpos( $output, "<html" ) === false )
			return $output;
		elseif ( strpos( $output, "<html" ) > 200 )
			return $output;

		// bail if skripts blocking disabled
		if ( ! $this->options['cs']['parse'] )
			return $output;

		// bail if consent given and skip parsing enabled
		if ( iubendaParser::consent_given() && $this->options['cs']['skip_parsing'] )
			return $output;

		// bail on POST request
		if ( $_POST && $this->options['cs']['output_post'] )
			return $output;

		// bail if bot detectd, no html in output or it's a post request
		if ( iubendaParser::bot_detected() || $this->no_html )
			return $output;

		// google recaptcha v3 compatibility
		if ( class_exists( 'WPCF7' ) && (int) WPCF7::get_option( 'iqfix_recaptcha' ) === 0 && ! iubendaParser::consent_given() )
			$this->options['cs']['custom_scripts']['grecaptcha'] = 2;

		// Jetpack compatibility
		if ( class_exists( 'Jetpack' ) )
			$this->options['cs']['custom_scripts']['stats.wp.com'] = 5;

		$startime = microtime( true );
		$output = apply_filters( 'iubenda_initial_output', $output );

		// prepare scripts and iframes
		$scripts = $this->prepare_custom_data( $this->options['cs']['custom_scripts'] );
		$iframes = $this->prepare_custom_data( $this->options['cs']['custom_iframes'] );

		// experimental class
		if ( $this->options['cs']['parser_engine'] == 'new' ) {
			$iubenda = new iubendaParser( mb_convert_encoding( $output, 'HTML-ENTITIES', 'UTF-8' ), array(
				'type' => 'faster',
				'amp' => $this->options['cs']['amp_support'],
				'scripts' => $scripts,
				'iframes' => $iframes
			) );

			// render output
			$output = $iubenda->parse();

			// append signature
			$output .= '<!-- Parsed with iubenda experimental class in ' . round( microtime( true ) - $startime, 4 ) . ' sec. -->';
			// default class
		} else {
			$iubenda = new iubendaParser( $output, array(
				'type' => 'page',
				'amp' => $this->options['cs']['amp_support'],
				'scripts' => $scripts,
				'iframes' => $iframes
			) );

			// render output
			$output = $iubenda->parse();

			// append signature
			$output .= '<!-- Parsed with iubenda default class in ' . round( microtime( true ) - $startime, 4 ) . ' sec. -->';
		}

		return apply_filters( 'iubenda_final_output', $output );
	}

	/**
	 * Prepare scripts/iframes.
	 *
	 * @param array $data
	 * @return array
	 */
	public function prepare_custom_data( $data ) {
		$newdata = array();

		foreach ( $data as $script => $type ) {
			if ( ! array_key_exists( $type, $newdata ) )
				$newdata[$type] = array();

			$newdata[$type][] = $script;
		}

		return $newdata;
	}

	/**
	 * Parse iubenda code.
	 *
	 * @param string $source
	 * @param bool $display
	 * @return string
	 */
	public function parse_code( $source, $display = false ) {
		// return $source;
		$source = trim( $source );

		preg_match_all( '/(\"(?:html|content)\"(?:\s+)?\:(?:\s+)?)\"((?:.*?)(?:[^\\\\]))\"/s', $source, $matches );

		// found subgroup?
		if ( ! empty( $matches[1] ) && ! empty( $matches[2] ) ) {
			foreach ( $matches[2] as $no => $match ) {
				$source = str_replace( $matches[0][$no], $matches[1][$no] . '[[IUBENDA_TAG_START]]' . $match . '[[IUBENDA_TAG_END]]', $source );
			}

			// kses it
			$source = wp_kses( $source, $this->get_allowed_html() );

			preg_match_all( '/\[\[IUBENDA_TAG_START\]\](.*?)\[\[IUBENDA_TAG_END\]\]/s', $source, $matches_tags );

			if ( ! empty( $matches_tags[1] ) ) {
				foreach ( $matches_tags[1] as $no => $match ) {
					$source = str_replace( $matches_tags[0][$no], '"' . ( $display ? str_replace( '</', '<\/', $matches[2][$no] ) : $matches[2][$no] ) . '"', $source );
				}
			}
		}

		return $source;
	}

	/**
	 * Disable Jetpack tracking on AMO cached pages.
	 *
	 * @return void
	 */
	public function disable_jetpack_tracking() {
		// bail no Jetpack active
		if ( ! class_exists( 'Jetpack' ) )
			return;

		// disable if it's not AMP cached request
		if ( ! class_exists( 'Jetpack_AMP_Support' ) || ! Jetpack_AMP_Support::is_amp_request() )
			return;

		// if ( is_feed() || is_robots() || is_trackback() || is_preview() || jetpack_is_dnt_enabled() )
		// bail if skripts blocking disabled
		if ( ! $this->options['cs']['parse'] )
			return;

		// bail if consent given and skip parsing enabled
		if ( iubendaParser::consent_given() && $this->options['cs']['skip_parsing'] )
			return;

		remove_action( 'wp_head', 'stats_add_shutdown_action' );
		remove_action( 'wp_footer', 'stats_footer', 101 );
	}

	/**
	 * Perform actions on plugin installation/upgrade.
	 *
	 * @return void
	 */
	public function maybe_do_upgrade() {
		if ( ! current_user_can( 'install_plugins' ) )
			return;

		// bail if no activation or upgrade transient is set
		if ( ! get_transient( 'iub_upgrade_completed' ) && ! get_transient( 'iub_activation_completed' ) )
			return;

		// delete the activation transient
		delete_transient( 'iub_activation_completed' );
		// delete the upgrade transient
		delete_transient( 'iub_upgrade_completed' );

		// bail if activating from network, or bulk, or within an iFrame
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) || defined( 'IFRAME_REQUEST' ) )
			return;

		// generate AMP template file if AMP plugins available
		if ( function_exists( 'is_amp_endpoint' ) || function_exists( 'ampforwp_is_amp_endpoint' ) ) {
			iubenda()->AMP->generate_amp_template();
		}
	}

	/**
	 * Get configuration data parsed from iubenda code
	 *
	 * @param type $iubenda_code
	 * @param type $args
	 * @return type
	 */
	public function parse_configuration( $code, $args = array() ) {
		$configuration = array();
		$defaults = array(
			'mode'	 => 'basic',
			'parse' => false
		);

		// parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );

		if ( empty( $code ) )
			return $configuration;

		// parse code if needed
		$parsed_code = $args['parse'] === true ? $this->parse_code( $code, true ) : $code;

		// get script
		$parsed_script = '';

		preg_match_all( '/src\=(?:[\"|\'])(.*?)(?:[\"|\'])/', $parsed_code, $matches );

		// find the iubenda script url
		if ( ! empty( $matches[1] ) ) {
			foreach ( $matches[1] as $found_script ) {
				if ( wp_http_validate_url( $found_script ) && strpos( $found_script, 'iubenda_cs.js' ) ) {
					$parsed_script = $found_script;
					continue;
				}
			}
		}

		// strip tags
		$parsed_code = wp_kses( $parsed_code, array() );

		// get configuration
		preg_match( '/_iub.csConfiguration *= *{(.*?)\};/', $parsed_code, $matches );

		if ( ! empty( $matches[1] ) )
			$parsed_code = '{' . $matches[1] . '}';

		// decode
		$decoded = json_decode( $parsed_code, true );

		if ( ! empty( $decoded ) && is_array( $decoded ) ) {

			$decoded['script'] = $parsed_script;

			// basic mode
			if ( $args['mode'] === 'basic' ) {
				if ( isset( $decoded['banner'] ) )
					unset( $decoded['banner'] );
				if ( isset( $decoded['callback'] ) )
					unset( $decoded['callback'] );
				if ( isset( $decoded['perPurposeConsent'] ) )
					unset( $decoded['perPurposeConsent'] );
			// Banner mode to get banner configuration only
			} else if ( 'banner' == $args['mode'] ) {
				if ( isset( $decoded['banner'] ) ) {
					return $decoded['banner'];
				}

				return array();
			}

			$configuration = $decoded;
		}

		return $configuration;
	}

	/**
	 * Domain info helper function.
	 *
	 * @param type $domainb
	 * @return type
	 */
	public function domain( $domainb ) {
		$bits = explode( '/', $domainb );
		if ( $bits[0] == 'http:' || $bits[0] == 'https:' ) {
			$domainb = $bits[2];
		} else {
			$domainb = $bits[0];
		}
		unset( $bits );
		$bits = explode( '.', $domainb );
		$idz = 0;
		while ( isset( $bits[$idz] ) ) {
			$idz += 1;
		}
		$idz -= 3;
		$idy = 0;
		while ( $idy < $idz ) {
			unset( $bits[$idy] );
			$idy += 1;
		}
		$part = array();
		foreach ( $bits AS $bit ) {
			$part[] = $bit;
		}
		unset( $bit );
		unset( $bits );
		unset( $domainb );
		$domainb = '';

		if ( strlen( $part[1] ) > 3 ) {
			unset( $part[0] );
		}
		foreach ( $part AS $bit ) {
			$domainb .= $bit . '.';
		}
		unset( $bit );

		return preg_replace( '/(.*)\./', '$1', $domainb );
	}

	/**
	 * Check if file exists helper function.
	 *
	 * @param type $file
	 */
	public function file_exists( $file ) {
		$file_headers = @get_headers( $file );

		if ( ! $file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' ) {
			$exists = false;
		} else {
			$exists = true;
		}
	}

	/**
	 * Get allowed iubenda script HTML.
	 *
	 * @return array
	 */
	public function get_allowed_html() {
		// Jetpack fix
		remove_filter( 'pre_kses', array( 'Filter_Embedded_HTML_Objects', 'filter' ), 11 );

		$html = array_merge(
		wp_kses_allowed_html( 'post' ), array(
			'script'	 => array(
				'type'		 => array(),
				'src'		 => array(),
				'charset'	 => array(),
				'async'		 => array()
			),
			'noscript'	 => array(),
			'style'		 => array(
				'type' => array()
			),
			'iframe'	 => array(
				'src'				 => array(),
				'height'			 => array(),
				'width'				 => array(),
				'frameborder'		 => array(),
				'allowfullscreen'	 => array()
			)
		)
		);

		return apply_filters( 'iub_code_allowed_html', $html );
	}

}

/**
 * Initialise iubenda Cookie Solution
 *
 * @return object
 */
function iubenda() {
	static $instance;

	// first call to instance() initializes the plugin
	if ( $instance === null || ! ( $instance instanceof iubenda ) )
		$instance = iubenda::instance();

	return $instance;
}

$iubenda = iubenda();
