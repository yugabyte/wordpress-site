<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * iubenda_AMP class.
 *
 * @class iubenda_AMP
 */
class iubenda_AMP {
	
	/**
	 * Class constructor.
	 */
	public function __construct() {
		// actions
		add_action( 'wp_head', array( $this, 'wp_head_amp' ), 100 );
		add_action( 'wp_footer', array( $this, 'wp_footer_amp' ), 100 );
		add_action( 'amp_post_template_css', array( $this, 'amp_post_template_css' ), 100 );
		add_action( 'amp_post_template_footer', array( $this, 'wp_footer_amp' ), 100 );
		add_action( 'amp_post_template_footer', array( $this, 'fix_analytics_amp_for_wp' ), 1 );
		
		// filters
		add_filter( 'amp_post_template_data', array( $this, 'amp_post_template_data' ), 100 );
		add_filter( 'amp_analytics_entries', array( $this, 'fix_analytics_wp_amp' ), 10 );
	}
	
	/**
	 * Add scripts and CSS to WP AMP plugin in Transitional mode.
	 *
	 * @return mixed
	 */
	public function wp_head_amp() {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return;

		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() && ! function_exists( 'ampforwp_is_amp_endpoint' ) ) {
			echo '
				<script async custom-element="amp-consent" src="https://cdn.ampproject.org/v0/amp-consent-latest.js"></script>
				<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-latest.js"></script>';
			
			// optional geo support
			if ( iubenda()->multilang && ! empty( iubenda()->lang_current ) ) {
				$code = iubenda()->options['cs']['code_' . iubenda()->lang_current];
			} else {
				$code = iubenda()->options['cs']['code_default'];
			}

			$configuration_raw = iubenda()->parse_configuration( $code );

			if ( isset( $configuration_raw['gdprAppliesGlobally'] ) && ! $configuration_raw['gdprAppliesGlobally'] ) {
				echo '
				<script async custom-element="amp-geo" src="https://cdn.ampproject.org/v0/amp-geo-0.1.js"></script>';
			}

			// CSS style
			echo '
				<style amp-custom>
					.popupOverlay {
						position:fixed;
						top: 0;
						bottom: 0;
						left: 0;
						right: 0;
					}
					amp-iframe {
						margin: 0;
					}
					amp-consent.amp-active {
						position:fixed;
						top: 0;
						bottom: 0;
						left: 0;
						right: 0;
					}
				</style>';
		}
	}
	
	/**
	 * Add AMP consent HTML to WP AMP plugin in Transitional mode.
	 *
	 * @return mixed
	 */
	public function wp_footer_amp() {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return;

		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() || ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) ) {

			// get code
			if ( iubenda()->multilang && ! empty( iubenda()->lang_current ) ) {
				$code = iubenda()->options['cs']['code_' . iubenda()->lang_current];
			} else {
				$code = iubenda()->options['cs']['code_default'];
			}
			
			$configuration = iubenda()->parse_configuration( $code );

			if ( empty( $configuration ) )
				return;
			
			// local file
			if ( iubenda()->options['cs']['amp_source'] === 'local' ) {
				// multilang support
				if ( iubenda()->multilang && ! empty( iubenda()->lang_current ) )
					$template_url = $this->get_amp_template_url( iubenda()->lang_current );
				else
					$template_url = $this->get_amp_template_url();
			// remote file
			} else {
				// multilang support
				if ( iubenda()->multilang && ! empty( iubenda()->lang_current ) )
					$template_url = esc_url( isset( iubenda()->options['cs']['amp_template'][iubenda()->lang_current] ) ? iubenda()->options['cs']['amp_template'][iubenda()->lang_current] : '' );
				else
					$template_url = esc_url( iubenda()->options['cs']['amp_template'] );
			}

			if ( empty( $template_url ) )
				return;

			echo '
			<amp-consent id="myUserConsent" layout="nodisplay">
				<script type="application/json">
					{
						"consentInstanceId": "consent' . $configuration['siteId'] . '",
						"consentRequired": true,
						"promptUI": "myConsentFlow"
					}
				</script>
				<div id="myConsentFlow" class="popupOverlay">
					<amp-iframe
						layout="fill"
						sandbox="allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
						src="' . esc_url( $template_url ) . '">
						<div placeholder>' . __( 'Loading', 'iubenda' ) . '</div>
					</amp-iframe>
				</div>
			</amp-consent>';
		}
	}

	/**
	 * Add scripts to AMP for WP plugin and WP AMP plugin in Standard mode.
	 *
	 * @return mixed
	 */
	public function amp_post_template_data( $data ) {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return $data;

		if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
			$data['amp_component_scripts'] = array_merge( $data['amp_component_scripts'],
				array( 'amp-consent' => 'https://cdn.ampproject.org/v0/amp-consent-latest.js' )
			);
			$data['amp_component_scripts'] = array_merge( $data['amp_component_scripts'],
				array( 'amp-iframe' => 'https://cdn.ampproject.org/v0/amp-iframe-latest.js' )
			);
		}
		
		return $data;
	}

	/**
	 * Add CSS to AMP for WP plugin and WP AMP plugin in Standard mode.
	 *
	 * @return mixed
	 */
	public function amp_post_template_css( $data ) {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return;
		
		echo '
.popupOverlay {
	position:fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}
amp-iframe {
	margin: 0;
}
amp-consent.amp-active {
	position:fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}';
	}

	/**
	 * Block analytics in AMP for WP plugin.
	 *
	 * @return mixed
	 */
	public function fix_analytics_amp_for_wp( $data ) {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return $data;

		global $redux_builder_amp;

		if ( $redux_builder_amp == null ) {
			$redux_builder_amp = get_option( 'redux_builder_amp', true );
		}

		// trick to block the analytics using global $redux_builder_amp variable
		if ( ! iubendaParser::consent_given() )
			$redux_builder_amp = true;

		return $data;
	}
	
	/**
	 * Block analytics in WP AMP plugin.
	 *
	 * @return mixed
	 */
	public function fix_analytics_wp_amp( $analytics_entries ) {
		if ( iubenda()->options['cs']['amp_support'] === false )
			return $analytics_entries;

		// block the analytics using the entries filter hook
		if ( ! iubendaParser::consent_given() && ! empty( $analytics_entries ) && is_array( $analytics_entries ) ) {
			foreach ( $analytics_entries as $id => $entry ) {
				$entry['attributes'] = ! empty( $entry['attributes'] ) ? $entry['attributes'] : array();
				
				$analytics_entries[$id]['attributes'] = array_merge( array( 'data-block-on-consent' => '_till_accepted' ), $entry['attributes'] );
			}
		}
		
		return $analytics_entries;
	}

	/**
	 * Prepare HTML iframe template for the AMP.
	 *
	 * @return mixed
	 */
	public function prepare_amp_template( $code ) {
		$html = '';
		
		$configuration_raw = iubenda()->parse_configuration( $code );

		if ( ! empty( $configuration_raw ) ) {
			// get script
			$script_src = ! empty( $configuration_raw['script'] ) ? $configuration_raw['script'] : '//cdn.iubenda.com/cs/iubenda_cs.js';
			
			// remove from configuration
			if ( isset( $configuration_raw['script'] ) )
				unset( $configuration_raw['script'] );
			
			// encode array
			$configuration = json_encode( $configuration_raw );
			
			// remove quotes
			$configuration = preg_replace( '/"([a-zA-Z]+[a-zA-Z0-9]*)":/', '$1:', $configuration );
			// replace brackets
			$configuration = str_replace( array( '{', '}' ), '', $configuration );

			$html .= '<!DOCTYPE html>
<html lang="' . $configuration_raw['lang'] . '">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>' . __( 'AMP Cookie Consent', 'iubenda' ) . '</title>
	<script type="text/javascript">
	var _iub = _iub || [];
	_iub.csConfiguration = {
	  ';
			// print configuration
			$html .= $configuration . ',';
			$html .= '
	  banner: {
		position: \'float-bottom-center\',
		acceptButtonDisplay: true,
		customizeButtonDisplay: true,
		rejectButtonDisplay: true,
		backgroundOverlay: true
	  },
	  callback: {
		onPreferenceExpressed: function(preference) {
		  var consentAction = \'reject\';
		  if (preference && preference.consent) {
			consentAction = \'accept\';
		  }
		  console.log(\'send consent-response\', consentAction);
		  window.parent.postMessage({
			type: \'consent-response\',
			action: consentAction
		  }, \'*\');
		}
	  }
	};
	</script>
	<script async src="' . $script_src . '"></script>
	</head>
	<body></body>
</html>';
		}

		return $html;
	}

	/**
	 * Get local file template url;
	 *
	 * @return string
	 */
	public function get_amp_template_url( $template_lang = '' ) {
		$template_url = '';
		$template_lang = ! empty( $template_lang ) && is_string( $template_lang ) ? $template_lang : '';
		
		// get basic site host and template file data
		$file_url = ! empty( $template_lang ) ? IUBENDA_PLUGIN_URL . '/templates/amp' . '-' . $template_lang . '.html' : IUBENDA_PLUGIN_URL . '/templates/amp.html';
		// $file_url = 'https://cdn.iubenda.com/cs/test/cs-for-amp.html'; // debug only
		$parsed_site = parse_url( home_url() );
		$parsed_file = parse_url( $file_url );
		$site_host = $parsed_site['host'] !== 'localhost' ? iubenda()->domain( $parsed_site['host'] ) : 'localhost';
		$file_host = $parsed_file['host'] !== 'localhost' ? iubenda()->domain( $parsed_file['host'] ) : 'localhost';
		$is_localhost = (bool) ( $site_host == 'localhost' );
		$is_subdomain = ! $is_localhost ? (bool) ( $parsed_file['host'] !== $file_host ) : false;

		// check if file host and server host match
		// if not, we're good to go
		if ( $site_host !== $file_host ) {
			$template_url = $file_url;
		// if are located on same host do additional tweaks
		} else {
			// all ok if we're on different subdomains
			if ( $parsed_site['host'] !== $parsed_file['host'] )
				$template_url = $file_url;
			// same hosts, let's tweak the http/https
			else {
				$has_www = strpos( $parsed_file['host'], 'www.' ) === 0;

				//  add or remove www from url string to make iframe url pass AMP validation
				$tweaked_host = ! $is_localhost && ! $is_subdomain ? ( ! $has_www ? 'www.' . $parsed_file['host'] : preg_replace( '/^www\./i', '', $parsed_file['host'] ) ) : $parsed_file['host'];

				// generate new url
				$tweaked_url = $parsed_file['scheme'] . '://' . $tweaked_host . ( isset( $parsed_file['port'] ) ? ':' . $parsed_file['port'] : '' ) . $parsed_file['path'] . ( ! empty( $parsed_file['query'] ) ? '?' . $parsed_file['query'] : '' );

				// check if file url is valid
				if ( $tweaked_url ) {
					$template_url = $tweaked_url;
				}
			}
		}

		return $template_url;
	}

	/**
	 * Generate HTML iframe template for the AMP.
	 *
	 * @return mixed
	 */
	public function generate_amp_template( $code, $lang = '' ) {
		$template_dir = IUBENDA_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
		$template_file = $template_dir . ( ! empty( $lang ) && in_array( $lang, array_keys( iubenda()->languages ) ) ? 'amp' . '-' . $lang . '.html' : 'amp.html' );
		$html = $this->prepare_amp_template( $code );

		// bail if the template was not created properly
		if ( empty( $html ) )
			return false;

		$result = file_put_contents( $template_file, $html );

		return (bool) $result;
	}
	
}