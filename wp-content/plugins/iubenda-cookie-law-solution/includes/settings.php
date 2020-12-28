<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * iubenda_Settings class.
 *
 * @class Post_Views_Counter_Settings
 */
class iubenda_Settings {

	public $tabs = array();
	public $action = '';
	public $links = array();
	public $notice_types = array( 'error', 'success', 'notice' );
	public $subject_fields = array();

	public function __construct() {
		// actions
		add_action( 'after_setup_theme', array( $this, 'load_defaults' ) );
		add_action( 'admin_init', array( $this, 'register_options' ) );
		add_action( 'admin_init', array( $this, 'update_plugin' ), 9 );
		add_action( 'admin_init', array( $this, 'admin_page_redirect' ), 20 );
		add_action( 'admin_init', array( $this, 'process_actions' ), 20 );
		add_action( 'admin_init', array( $this, 'maybe_show_notice' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu_options' ) );
		add_action( 'admin_notices', array( $this, 'settings_errors' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_print_styles', array( $this, 'admin_print_styles' ) );
		// add_action( 'admin_footer-options-discussion.php', array( $this, 'admin_footer' ) );
		add_action( 'wp_ajax_iubenda_dismiss_notice', array( $this, 'dismiss_notice' ) );

		// filters
		add_filter( 'submenu_file', array( $this, 'submenu_file' ), 10, 2 );
	}

	/**
	 * Load default settings.
	 */
	public function load_defaults() {
		$this->subject_fields = array(
			'id' => __( 'string', 'iubenda' ),
			'email' => __( 'string', 'iubenda' ),
			'first_name' => __( 'string', 'iubenda' ),
			'last_name' => __( 'string', 'iubenda' ),
			'full_name' => __( 'string', 'iubenda' ),
			// 'verified' => __( 'boolean', 'iubenda' ),
		);

		$this->legal_notices = array(
			'privacy_policy',
			'cookie_policy',
			'terms'
		);

		$this->tabs = array(
			'cs'	 => array(
				'name'	 => __( 'Cookie Solution', 'iubenda' ),
				'key'	 => 'iubenda_cookie_law_solution',
				'submit' => 'save_iubenda_options',
				'reset'	 => 'reset_iubenda_options'
			),
			'cons'	 => array(
				'name'	 => __( 'Consent Solution', 'iubenda' ),
				'key'	 => 'iubenda_consent_solution',
				'submit' => 'save_consent_options',
				'reset'	 => 'reset_consent_options'
			)
		);

		$this->tag_types = array(
			0 => __( 'Not set', 'iubenda' ),
			1 => __( 'Strictly necessary', 'iubenda' ),
			2 => __( 'Basic interactions & functionalities', 'iubenda' ),
			3 => __( 'Experience enhancement', 'iubenda' ),
			4 => __( 'Analytics', 'iubenda' ),
			5 => __( 'Targeting & Advertising', 'iubenda' )
		);

		$links = array(
			'en' => array(
				'iab' => 'https://www.iubenda.com/en/help/7440-enable-preference-management-iab-framework',
				'guide'	=> 'https://www.iubenda.com/en/cookie-solution',
				'plugin_page' => 'https://www.iubenda.com/en/help/posts/1215',
				'generating_code' => 'https://www.iubenda.com/en/help/1177-cookie-solution-getting-started',
				'support_forum' => 'https://support.iubenda.com/support/home',
				'documentation' => 'https://www.iubenda.com/en/help/posts/1215'
			),
			'it' => array(
				'iab' => 'https://www.iubenda.com/en/help/7440-enable-preference-management-iab-framework',
				'guide'	=> 'https://www.iubenda.com/it/cookie-solution',
				'plugin_page' => 'https://www.iubenda.com/it/help/posts/810',
				'generating_code' => 'https://www.iubenda.com/it/help/680-introduzione-cookie-solution',
				'support_forum' => 'https://support.iubenda.com/support/home',
				'documentation' => 'https://www.iubenda.com/it/help/posts/810',
			)
		);

		$locale = explode( '_', get_locale() );
		$locale_code = $locale[0];

		// assign links
		$this->links = in_array( $locale_code, array_keys( $links ) ) ? $links[$locale_code] : $links['en'];

		// handle actions
		if ( ! empty( $_POST['save'] ) ) {
			// update item action
			$this->action = 'save';
		} else {
			$this->action = isset( $_REQUEST['action'] ) && -1 != $_REQUEST['action'] ? esc_attr( $_REQUEST['action'] ) : '';
			$this->action = isset( $_REQUEST['action2'] ) && -1 != $_REQUEST['action2'] ? esc_attr( $_REQUEST['action2'] ) : $this->action;
		}
	}

	/**
	 * Register plugin options.
	 *
	 * @return void
	 */
	public function register_options() {
		register_setting( 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution', array( $this, 'save_cookie_law_options' ) );

		add_settings_section( 'iubenda_cookie_law_solution', '', '', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_code', __( 'Code', 'iubenda' ), array( $this, 'iub_code' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_amp_support', __( 'Google AMP', 'iubenda' ), array( $this, 'iub_amp_support' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_parse', __( 'Script blocking', 'iubenda' ), array( $this, 'iub_parse' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_custom_scripts', __( 'Custom scripts', 'iubenda' ), array( $this, 'iub_custom_scripts' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_ctype', __( 'Content type', 'iubenda' ), array( $this, 'iub_ctype' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_output_feed', __( 'RSS feed', 'iubenda' ), array( $this, 'iub_output_feed' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_output_post', __( 'POST requests', 'iubenda' ), array( $this, 'iub_output_post' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_menu_position', __( 'Menu position', 'iubenda' ), array( $this, 'iub_menu_position' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );
		add_settings_field( 'iub_deactivation', __( 'Deactivation', 'iubenda' ), array( $this, 'iub_deactivation' ), 'iubenda_cookie_law_solution', 'iubenda_cookie_law_solution' );

		// forms list
		if ( ! in_array( $this->action, array( 'save', 'edit' ) ) ) {
			register_setting( 'iubenda_consent_solution', 'iubenda_consent_solution', array( $this, 'save_consent_options' ) );
			add_settings_section( 'iubenda_consent_solution', __( 'Forms', 'iubenda' ), '', 'iubenda_consent_solution' );
			add_settings_field( 'iub_public_api_key', __( 'Public Api Key', 'iubenda' ), array( $this, 'iub_public_api_key' ), 'iubenda_consent_solution', 'iubenda_consent_solution' );
			// only if api key is given
			if ( ! empty( iubenda()->options['cons']['public_api_key'] ) )
				add_settings_section( 'iubenda_consent_forms', __( 'Field Mapping', 'iubenda' ), array( $this, 'iubenda_consent_forms' ), 'iubenda_consent_solution' );
		// single form
		} else {
			register_setting( 'iubenda_consent_solution', 'iubenda_consent_forms' );
			add_settings_section( 'iubenda_consent_form', __( 'Field Mapping', 'iubenda' ), array( $this, 'iubenda_consent_form' ), 'iubenda_consent_solution' );
		}
	}

	/**
	 * Display errors and notices.
	 *
	 * @global string $pagenow
	 */
	public function settings_errors() {
		global $pagenow;

		// force display notices in top menu settings page
		if ( $pagenow == 'options-general.php' )
			return;

		$tab_key = ! empty( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'cs';

		settings_errors( "{$tab_key}_settings_errors" );
	}

	/**
	 * Add submenu.
	 *
	 * @return void
	 */
	public function admin_menu_options() {
		if ( iubenda()->options['cs']['menu_position'] === 'submenu' ) {
			// sub menu
			add_submenu_page(
				'options-general.php', 'iubenda', 'iubenda', apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda', array( $this, 'options_page' )
			);
		} else {
			// top menu
			add_menu_page(
				'iubenda', 'iubenda', apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda', array( $this, 'options_page' ), 'none'
			);
			add_submenu_page( 'iubenda', __( 'Cookie Solution', 'iubenda' ), __( 'Cookie Solution', 'iubenda' ), apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda', array( $this, 'options_page' ) );
			add_submenu_page( 'iubenda', __( 'Consent Solution', 'iubenda' ), __( 'Consent Solution', 'iubenda' ), apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ), 'iubenda&tab=cons', array( $this, 'options_page' ) );
		}
	}

	/**
	 * Load admin scripts and styles.
	 *
	 * @param string $page
	 * @return void
	 */
	public function admin_enqueue_scripts( $page ) {
		wp_enqueue_style( 'iubenda-admin', IUBENDA_PLUGIN_URL . '/css/admin.css' );
		
		if ( ! in_array( $page, array( 'toplevel_page_iubenda', 'settings_page_iubenda' ) ) )
			return;

		wp_enqueue_script(
		'iubenda-admin', IUBENDA_PLUGIN_URL . '/js/admin.js', array( 'jquery' )
		);

		$args = array(
			'formId'		=> 0,
			'deleteForm'	=> __( 'Are you sure you want to delete this form?', 'iubenda' )
		);

		// get form data on edit screen
		if ( in_array( $this->action, array( 'edit' ) ) ) {
			$form_id = ! empty( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;
			$form = ! empty( $form_id ) ? iubenda()->forms->get_form( $form_id ) : array();

			$args['formId'] = $form_id;
		}

		wp_localize_script(
			'iubenda-admin',
			'iubAdminArgs',
			json_encode( $args )
		);
	}

	/**
	 * Load admin style inline, for menu icon only.
	 *
	 * @return mixed
	 */
	public function admin_print_styles() {
		echo '
		<style>
			a.toplevel_page_iubenda .wp-menu-image {
				background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj48c3ZnIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAyMzIgNTAzIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zOnNlcmlmPSJodHRwOi8vd3d3LnNlcmlmLmNvbS8iIHN0eWxlPSJmaWxsLXJ1bGU6ZXZlbm9kZDtjbGlwLXJ1bGU6ZXZlbm9kZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MS40MTQyMTsiPiAgICA8ZyB0cmFuc2Zvcm09Im1hdHJpeCgxLDAsMCwxLDEzNi4yNDcsMjY4LjgzMSkiPiAgICAgICAgPHBhdGggZD0iTTAsLTM1LjgxTC0zNi4zLDAuNDg5TC0zNi4zLDE0MC45NzhMMCwxNDAuOTc4TDAsLTM1LjgxWk0tMjAuOTM4LC0xMjkuODAyQy02LjI4NywtMTI5LjgwMiA1LjU4NywtMTQxLjU2NSA1LjU4NywtMTU2LjA2QzUuNTg3LC0xNzAuNTU2IC02LjI4NywtMTgyLjMwOCAtMjAuOTM4LC0xODIuMzA4Qy0zNS42LC0xODIuMzA4IC00Ny40NzQsLTE3MC41NTYgLTQ3LjQ3NCwtMTU2LjA2Qy00Ny40NzQsLTE0MS41NjUgLTM1LjYsLTEyOS44MDIgLTIwLjkzOCwtMTI5LjgwMk04OS4zNiwtMTU0LjQxNkM4OS4zNiwtMTI3LjgyNSA3OS41NzUsLTEwMy40OTkgNjMuMjY5LC04NC42NzJMODYuNjk0LDIyNi42MjhMLTEyMi43MjgsMjI2LjYyOEwtMTAwLjAyNCwtNzkuMjI5Qy0xMTkuMzUxLC05OC42NjggLTEzMS4yNDcsLTEyNS4xNTkgLTEzMS4yNDcsLTE1NC40MTZDLTEzMS4yNDcsLTIxNC4wODYgLTgxLjg3NCwtMjYyLjQzOCAtMjAuOTM4LC0yNjIuNDM4QzM5Ljk5OSwtMjYyLjQzOCA4OS4zNiwtMjE0LjA4NiA4OS4zNiwtMTU0LjQxNiIgc3R5bGU9ImZpbGw6d2hpdGU7ZmlsbC1ydWxlOm5vbnplcm87Ii8+ICAgIDwvZz48L3N2Zz4=);
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 7px auto;
			}
		</style>
		';
	}
	
	/**
	 * Highlight comments cookies opt-in checkbox option.
	 * 
	 * @return mixed
	 */
	public function admin_footer() {
		if ( ! empty( $_GET['iub-highlight'] ) ) {
			echo '
			<style>
				label[for=show_comments_cookies_opt_in] {
					border: 1px dashed red;
				}
			</style>
			';
		}
	}

	/**
	 * Redirect to the correct urle after switching menu position.
	 *
	 * @global string $pagenow
	 * @return void
	 */
	public function admin_page_redirect() {
		if ( ! empty( $_GET['settings-updated'] ) && ! empty( $_GET['page'] ) && in_array( $_GET['page'], array( 'iubenda' ) ) ) {
			global $pagenow;

			// no redirect by default
			$redirect_to = false;

			if ( iubenda()->options['cs']['menu_position'] === 'submenu' && $pagenow === 'admin.php' ) {
				// sub menu
				$redirect_to = admin_url( 'options-general.php?page=iubenda' );
			} elseif ( iubenda()->options['cs']['menu_position'] === 'topmenu' && $pagenow === 'options-general.php' ) {
				// top menu
				$redirect_to = admin_url( 'admin.php?page=iubenda' );
			}

			if ( $redirect_to ) {
				// make sure it's current host location
				wp_safe_redirect( add_query_arg( 'settings-updated', true, $redirect_to ) );
				exit;
			}
		}
	}
	
	/**
	 * Perform show notice on plugin installation/upgrade.
	 *
	 * @return void
	 */
	public function maybe_show_notice() {
		if ( ! current_user_can( 'install_plugins' ) )
			return;
		
		$current_update = 1;
		$activation = (array) get_option( 'iubenda_activation_data', iubenda()->activation );
		
		// delete_option( 'iubenda_activation_data' );
		// echo '<pre>'; print_r( $activation ); echo '</pre>'; exit;

		// get current time
		$current_time = time();

		if ( $activation['update_version'] < $current_update ) {
			// check version, if update ver is lower than plugin ver, set update notice to true
			$activation = array_merge( $activation, array( 'update_version' => $current_update, 'update_notice' => true ) );

			// set activation date if not set
			if ( $activation['update_date'] == false )
				$activation = array_merge( $activation, array( 'update_date' => $current_time ) );
			
			update_option( 'iubenda_activation_data', $activation );
		}

		// display current version notice
		if ( $activation['update_notice'] === true ) {
			// include notice js, only if needed
			add_action( 'admin_print_scripts', array( $this, 'admin_inline_js' ), 999 );

			// get activation date
			$activation_date = $activation['update_date'];
			
			// set delay in seconds
			$delay = WEEK_IN_SECONDS * 2;

			if ( (int) $activation['update_delay_date'] === 0 ) {
				if ( $activation_date + $delay > $current_time )
					$activation['update_delay_date'] = $activation_date + $delay;
				else
					$activation['update_delay_date'] = $current_time;

				update_option( 'iubenda_activation_data', $activation );
			}

			if ( ( ! empty( $activation['update_delay_date'] ) ? (int) $activation['update_delay_date'] : $current_time ) <= $current_time ) {
				// add notice
				add_action( 'admin_notices', array( $this, 'show_notice' ) );
			}
		}
	}
	
	/**
	 * Display admin notices at iubenda settings.
	 */
	public function show_notice() {
		global $pagenow;

		$display = true;
		/*
		$page = isset( $_GET['page'] ) ? esc_attr( $_GET['page'] ) : '';

		if ( iubenda()->options['cs']['menu_position'] === 'submenu' && $page === 'iubenda' ) {
			$display = true;
		} elseif ( iubenda()->options['cs']['menu_position'] === 'topmenu' && $page === 'iubenda' ) {
			$display = true;
		}
		*/
		?>
		<?php if ( $display ) { ?>
			<div class="iubenda-notice notice is-dismissible">
				<div>
					<p class="step-1">
						<span class="notice-question"><?php _e( 'Enjoying the iubenda Cookie & Consent Solution Plugin?', 'iubenda' ); ?></span>
						<span class="notice-reply">
							<a href="#" class="reply-yes"><?php _e( 'Yes', 'iubenda' ); ?></a>
							<a href="#" class="reply-no"><?php _e( 'No', 'iubenda' ); ?></a>
						</span>
					</p>
					<p class="step-2 step-yes">
						<span class="notice-question"><?php _e( "Whew, what a relief!😅 We've worked countless hours to make this plugin as useful as possible – so we're pretty happy that you're enjoying it. While you here, would you mind leaving us a 5 star rating? It would really help us out.", 'iubenda' ); ?></span>
						<span class="notice-reply">
							<a href="https://wordpress.org/support/plugin/iubenda-cookie-law-solution/reviews/?filter=5" target="_blank" class="reply-yes"><?php _e( 'Sure!', 'iubenda' ); ?></a>
							<a href="javascript:void(0)" class="reply-no"><?php _e( 'No thanks', 'iubenda' ); ?></a>
						</span>
					</p>
					<p class="step-2 step-no">
						<span class="notice-question"><?php _e( "We’re sorry to hear that. Would you mind giving us some feedback?", 'iubenda' ); ?></span>
						<span class="notice-reply">
							<a href="https://iubenda.typeform.com/to/BXuSMZ" target="_blank" class="reply-yes"><?php _e( 'Ok sure!', 'iubenda' ); ?></a>
							<a href="javascript:void(0)" class="reply-no"><?php _e( 'No thanks', 'iubenda' ); ?></a>
						</span>
					</p>
				</div>
			</div>
		<?php } ?>
		<?php
	}
	
	/**
	 * Print admin scripts.
	 *
	 * @return void
	 */
	public function admin_inline_js() {
		if ( ! current_user_can( 'install_plugins' ) )
			return;
		
		$delay = MONTH_IN_SECONDS * 6;
		?>
		<script type="text/javascript">
			( function ( $ ) {
				$( document ).ready( function () {
					// step 1
					$( '.iubenda-notice .step-1 a' ).on( 'click', function ( e ) {
						e.preventDefault();

						$( '.iubenda-notice .step-1' ).slideUp( 'fast' );
						
						if ( $( e.target ).hasClass( 'reply-yes' ) ) {
							$( '.iubenda-notice .step-2.step-yes' ).slideDown( 'fast' );
						} else {
							$( '.iubenda-notice .step-2.step-no' ).slideDown( 'fast' );
						};
					} );
					// step 2
					$( '.iubenda-notice.is-dismissible' ).on( 'click', '.notice-dismiss, .step-2 a', function ( e ) {
						// console.log( $( e ) );
						
						var delay = <?php echo $delay; ?>;
						
						if ( $( e.target ).hasClass( 'reply-yes' ) ) {
							delay = 0;
						}
						
						$.post( ajaxurl, {
							action: 'iubenda_dismiss_notice',
							delay: delay,
							url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
							iubenda_nonce: '<?php echo wp_create_nonce( 'iubenda_dismiss_notice' ); ?>'
						} );
					
						$( e.delegateTarget ).slideUp( 'fast' );
					} );
				} );
			} )( jQuery );
		</script>
		<?php
	}
	
	/**
	 * Dismiss notice.
	 *
	 * @return void
	 */
	public function dismiss_notice() {
		$result = false;
		
		if ( ! current_user_can( 'install_plugins' ) )
			return $result;
		
		$nonce = wp_verify_nonce( $_REQUEST['iubenda_nonce'], 'iubenda_dismiss_notice' );

		if ( $nonce ) {
			$delay = ! empty( $_REQUEST['delay'] ) ? absint( $_REQUEST['delay'] ) : 0;
			$activation = (array) get_option( 'iubenda_activation_data', iubenda()->activation );
			
			// delay notice
			if ( $delay > 0 ) {
				$activation = array_merge( $activation, array( 'update_delay_date' => time() + $delay ) );
			// hide notice permanently
			} else {
				$activation = array_merge( $activation, array( 'update_delay_date' => 0, 'update_notice' => false ) );
			}
			
			// update activation options
			$result = update_option( 'iubenda_activation_data', $activation );
		}
		
		echo json_encode( $result );
		exit;
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
				if ( ! empty( iubenda()->languages ) ) {
					foreach ( iubenda()->languages as $lang_id => $lang_name ) {
						$code = get_option( 'iubenda-code-' . $lang_id );

						if ( ! empty( $code ) ) {
							$options['code_' . $lang_id] = $code;

							delete_option( 'iubenda-code-' . $lang_id );
						}
					}
				}

				add_option( 'iubenda_cookie_law_solution', $options, '', 'no' );
				add_option( 'iubenda_cookie_law_version', iubenda()->version, '', 'no' );
			}
		}
	}

	/**
	 * Load admin options page.
	 *
	 * @return void
	 */
	public function options_page() {
		global $pagenow;
		
		if ( ! current_user_can( apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ) ) ) {
			wp_die( __( "You don't have permission to access this page.", 'iubenda' ) );
		}

		$tab_key = ! empty( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'cs';
		
		// get redirect url
		if ( iubenda()->options['cs']['menu_position'] === 'submenu' && $pagenow === 'admin.php' ) {
			// sub menu
			$redirect_to = admin_url( 'options-general.php?page=iubenda&tab=' . $tab_key );
		} else {
			// top menu
			$redirect_to = admin_url( 'admin.php?page=iubenda&tab=' . $tab_key );
		}
		?>
		<div class="wrap">

			<div id="iubenda-header">
				<?php
				echo '
					<a class="iubenda-link" href="http://iubenda.com" title="iubenda" title="_blank">
						<img id="iubenda-logo" alt="iubenda logo" width="300" height="90" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjM3LjggMjgzLjUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYzNy44IDI4My41OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHN0eWxlIHR5cGU9InRleHQvY3NzIj4uc3Qwe2ZpbGw6IzFDQzY5MTt9LnN0MXtmaWxsOiM1MTUyNTQ7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTE3OC45LDk5LjljMCw4LjItMywxNS42LTgsMjEuNGw3LjIsOTUuNGgtNjQuMmw3LTkzLjhjLTUuOS02LTkuNi0xNC4xLTkuNi0yMy4xYzAtMTguMywxNS4xLTMzLjEsMzMuOC0zMy4xUzE3OC45LDgxLjYsMTc4LjksOTkuOSBNMTQ1LjEsMTA3LjRjNC41LDAsOC4xLTMuNiw4LjEtOC4xcy0zLjYtOC04LjEtOGMtNC41LDAtOC4xLDMuNi04LjEsOFMxNDAuNiwxMDcuNCwxNDUuMSwxMDcuNCBNMTUxLjUsMTM2LjJsLTExLjEsMTEuMXY0My4xaDExLjFWMTM2LjJ6Ii8+PHBhdGggY2xhc3M9InN0MSIgZD0iTTI2NS40LDE3OC42Yy0yLjMsMS4yLTQuNywxLjgtNy4yLDEuOGMtMi44LDAtNS4zLTAuOC03LjQtMi40Yy0yLjEtMS42LTMuNS0zLjctNC4zLTYuMmMtMC44LTIuNS0xLjItNi4xLTEuMi0xMC44di0xOC4yYzAsMCwwLTAuOSwwLTIuOGMwLTAuNSwwLTIuOC0xLjUtMy41Yy0wLjItMC4xLTAuNi0wLjItMS4yLTAuM2MtMC40LDAtMC44LTAuNC0wLjgtMC44bDAtMi40YzAtMC41LDAuNC0wLjksMC44LTAuOWg5LjNjMS4zLDAsMi40LDEuMSwyLjQsMi40VjE0N2wwLDE1LjVjMCw0LjYsMC44LDcuNywyLjUsOS4xYzEuNiwxLjUsMy42LDIuMiw1LjksMi4yYzEuNiwwLDMuNC0wLjUsNS40LTEuNWMyLTEsNS4zLTIuOCw4LjEtNS42bDAtMi40bDAtMjIuMlYxNDBjMC0wLjUsMC0yLjgtMS40LTMuNWMtMC4yLTAuMS0wLjYtMC4yLTEuMS0wLjNjLTAuNC0wLjEtMC44LTAuNC0wLjgtMC44bDAtMi40YzAtMC41LDAuNC0wLjksMC45LTAuOWg5LjJjMS4zLDAsMi40LDEuMSwyLjQsMi40djhjMCwwLjEsMCwwLjEsMCwwLjJ2MTYuNmMwLDMuOCwwLDcuNCwwLDEwLjZjMCwwLjcsMCwxLjIsMCwxLjJjMCwwLjUtMC4xLDMuMSwxLjQsMy44YzAuMiwwLjEsMC42LDAuMiwxLjIsMC4zYzAuNCwwLDAuOCwwLjQsMC44LDAuOGwwLDIuNGMwLDAuNS0wLjQsMC44LTAuOSwwLjloLTkuMmMtMS4zLDAtMi40LTEuMS0yLjQtMi40bDAtNC41bDAtMi41QzI3MS45LDE3NC41LDI2Ny43LDE3Ny40LDI2NS40LDE3OC42Ii8+PHBhdGggY2xhc3M9InN0MSIgZD0iTTMwOS4yLDE3NmMxLjksMC45LDMuOSwxLjMsNiwxLjNjMy4yLDAsNi4zLTEuNyw5LTUuMmMyLjgtMy41LDQuMi04LjUsNC4yLTE1LjJjMC02LjEtMS40LTEwLjgtNC4yLTE0LjFjLTIuOC0zLjMtNi00LjktOS41LTQuOWMtMS45LDAtMy44LDAuNS01LjcsMS40Yy0xLjIsMC42LTIuOCwxLjgtNC43LDMuNGMtMC41LDAuNS0wLjgsMS4xLTAuOCwxLjhWMTcxYzAsMC43LDAuMywxLjQsMC44LDEuOEMzMDYsMTc0LjIsMzA3LjYsMTc1LjMsMzA5LjIsMTc2IE0yOTQuOCwxMThjMC0wLjUsMC0yLjctMS40LTMuNGMtMC4yLTAuMS0wLjMtMC4xLTAuNi0wLjJjLTAuNC0wLjEtMC42LTAuNC0wLjYtMC44bDAtMi4zYzAtMC41LDAuNC0wLjgsMC45LTAuOWgxLjhoNi41YzEuMywwLDIuMywxLDIuMywyLjNsMCwxMnYxNS40YzQuNy02LjQsOS44LTkuNiwxNS4zLTkuNmM1LDAsOS40LDIuMSwxMy4xLDYuM2MzLjcsNC4yLDUuNiw5LjksNS42LDE3LjJjMCw4LjUtMi45LDE1LjMtOC42LDIwLjVjLTQuOSw0LjQtMTAuNSw2LjctMTYuNSw2LjdjLTIuOCwwLTUuNy0wLjUtOC43LTEuNWMtMi41LTAuOS01LjEtMi4xLTcuNy0zLjdjLTAuOC0wLjUtMS4zLTEuNC0xLjMtMi40di00NmMwLTAuOSwwLTIsMC0zLjNMMjk0LjgsMTE4eiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0zODkuMywxNzkuMWMtMC41LDAtMC45LTAuNC0wLjktMC45bDAtMi4zYzAtMC40LDAuMy0wLjgsMC43LTAuOGMwLjUtMC4xLDAuOC0wLjEsMS0wLjJjMS40LTAuNywxLjQtMi45LDEuNC0zLjR2LTIuN2MwLDAsMC01LjgsMC0xNy41YzAtMS45LDAtMy44LDAuMS01LjVsMC00LjZjMC0wLjUsMC0xLDAtMS41YzAtMC42LDAtMi44LTEuNC0zLjVjLTAuMS0wLjEtMC4zLTAuMS0wLjUtMC4yYy0wLjQtMC4xLTAuNi0wLjQtMC42LTAuOGwwLTIuM2MwLTAuNSwwLjQtMC44LDAuOS0wLjloOC4xYzEuMywwLDIuMywxLDIuMywyLjN2My40YzAsMCwwLDAuNiwwLDEuOGMwLDAuMywwLjIsMC42LDAuNiwwLjZjMC4yLDAsMC4zLTAuMSwwLjQtMC4yYzUuNC01LjksMTIuMy04LjgsMTcuMi04LjhjMi43LDAsNSwwLjYsNi45LDEuOWMxLjksMS4zLDMuNCwzLjQsNC42LDYuM2MwLjgsMi4xLDEuMiw1LjIsMS4yLDkuNHYxNi41bDAsNi4zYzAsMC41LDAsMi43LDEuNCwzLjRjMC4yLDAuMSwwLjQsMC4yLDAuOCwwLjJjMC40LDAuMSwwLjcsMC40LDAuNywwLjhsMCwyLjNjMCwwLjUtMC40LDAuOC0wLjgsMC45Yy0wLjgsMC0xLjUsMC0yLDBoLTYuNWMtMC4xLDAtMC4zLDAtMC40LDBoLTMuMWMtMS4xLDAtMi0wLjktMi0yYzAtMSwwLjctMS45LDEuNi0yLjJjMC4xLDAsMC4xLDAsMC4yLTAuMWMxLTAuNSwxLjMtMS44LDEuNC0yLjd2LTcuNGwwLTE1LjJjMC00LjMtMC42LTcuNC0xLjctOS4zYy0xLjItMS45LTMuMS0yLjktNS44LTIuOWMtNC4yLDAtMTAuMywyLjItMTQuNCw2Ljd2MjAuOHYwLjNsMCw2LjRjMCwwLjUsMCwyLjgsMS40LDMuNWMwLjEsMCwwLjEsMCwwLjIsMC4xYzEsMC4zLDEuNiwxLjIsMS42LDIuMmMwLDEuMS0wLjksMi0yLDJIMzk0QzM5NCwxNzkuMSwzOTIuNCwxNzkuMSwzODkuMywxNzkuMSIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik01MTUsMTUzLjRjLTYuNiwxLjMtMTAuNCwyLjItMTEuNCwyLjVjLTMuNywxLjItNi42LDIuNi02LjgsOC43Yy0wLjEsMi41LDAuOCw0LjcsMi4zLDYuM2MxLjUsMS43LDMuMywyLjUsNS4zLDIuNWMyLjUsMCw1LjctMS44LDkuNi00LjhjMC43LTAuNSwxLjEtMS4zLDEuMS0yLjJWMTUzLjR6IE01MjMuOCwxNzAuOGMwLDAuMSwwLDAuMiwwLDAuMmMwLDAuMiwwLDAuMywwLDAuNGMwLjEsMS40LDAuNiwyLjQsMS40LDIuOGMwLjIsMC4xLDAuNCwwLjIsMC42LDAuMmMwLjQsMC4xLDAuNywwLjQsMC43LDAuOGwwLDIuNGMwLDAuNS0wLjQsMC44LTAuOSwwLjloLTguM2MtMS4zLDAtMi4zLTEtMi4zLTIuM3YtNC41Yy01LDMuOS04LjIsNi4xLTkuNSw2LjdjLTEuOSwwLjktNCwxLjMtNi4xLDEuM2MtMy40LDAtNi4yLTEuMi04LjQtMy40Yy0yLjItMi4zLTMuMy01LjMtMy4zLTkuMWMwLTIuNCwwLjUtNC40LDEuNi02LjJjMS41LTIuNCwzLjctNS4yLDcuNi02LjhjNC0xLjYsNy4zLTIsMTgtNC40YzAtMC4zLDAtNCwwLTQuM2MwLTQuNS0wLjgtOS4yLTguNC04LjdjLTUuMywwLjMtMTAuMiwyLTE0LjcsNWMtMC40LDAuMy0wLjksMC4yLTEuMi0wLjJjLTAuMS0wLjEtMC4xLTAuMy0wLjEtMC41di0yLjhjMC0xLjUsMC4zLTIuNCwwLjktMi45YzMuMS0yLjUsMTAuOS01LjUsMTguNS01YzguNCwwLjYsMTEuNCw0LDEyLjksOS4zYzAuNSwxLjYsMSwyLjgsMSw3LjV2MTQuNWMwLDIsMCw0LDAsNS44VjE3MC44eiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik00NjUuNCwxMzcuOGMtMS43LTEtMy40LTEuNS01LTEuNWMtMywwLTUuOCwxLjMtOC4zLDMuOGMtMi43LDIuOC00LjYsNi41LTQuNiwxMy41YzAsNywxLjUsMTIuNCw0LjYsMTYuMmMzLDMuNyw2LjQsNS42LDEwLjIsNS42YzIuNywwLDUuMy0xLjEsNy44LTMuNGMwLjktMC44LDEuNC0xLjksMS40LTN2LTIwLjhDNDcxLjQsMTQzLjksNDY5LjEsMTQwLDQ2NS40LDEzNy44IE00ODEuMywxNzQuNmMwLjEsMC4xLDAuMywwLjEsMC41LDAuMmMwLjQsMC4xLDAuNiwwLjQsMC42LDAuOGwwLDIuM2MwLDAuNS0wLjQsMC44LTAuOSwwLjloLThjLTEuMiwwLTIuMy0xLTIuMy0yLjJ2LTIuMmMtMi4zLDIuNC00LjYsNC4yLTYuOCw1LjNjLTIuMiwxLjEtNC42LDEuNi03LjEsMS42Yy01LjIsMC05LjctMi4yLTEzLjYtNi42Yy0zLjktNC40LTUuOC0xMC01LjgtMTYuOXMyLjEtMTMuMSw2LjQtMTguOGM0LjMtNS43LDkuOC04LjUsMTYuNS04LjVjNC4yLDAsNy42LDEuMywxMC40LDR2LTE2LjdjMC0wLjUsMC0yLjctMS40LTMuNGMtMC4xLTAuMS0wLjMtMC4xLTAuNS0wLjJjLTAuNC0wLjEtMC42LTAuNC0wLjYtMC44bDAtMi40YzAtMC41LDAuNC0wLjksMC45LTAuOWg3LjljMS4yLDAsMi4zLDEsMi4zLDIuMnY1OC45QzQ3OS45LDE3MS44LDQ3OS45LDE3My45LDQ4MS4zLDE3NC42Ii8+PHBhdGggY2xhc3M9InN0MSIgZD0iTTM1MCwxNTAuMmMwLDAuMSwwLDAuMywwLjEsMC4zYzAuMSwwLjEsMC4yLDAuMSwwLjQsMC4xaDIzLjljMC4zLDAsMC41LTAuMiwwLjUtMC40YzAuMy0yLjUsMC40LTctMy4zLTEwLjhjLTEuOC0xLjktNC4xLTIuOC04LjMtMi44QzM1NS43LDEzNi42LDM1MC44LDE0My45LDM1MCwxNTAuMiBNMzQ3LjUsMTc0LjljLTMuOS00LjMtNS45LTExLjMtNS45LTE4LjJjMC03LjMsMi4zLTEzLjksNi40LTE4LjdjNC4zLTUsMTAuMi03LjcsMTcuMS03LjdjNS44LDAsMTAuMiwyLDEzLjIsNS44YzIuNywzLjYsNC4xLDguOCw0LjEsMTUuNGMwLDAuOCwwLDEuOS0wLjEsMy4zYy0wLjEsMC45LTAuOCwxLjYtMS43LDEuNmgtMjkuOGMtMC4xLDAtMC4zLDAuMS0wLjQsMC4xYy0wLjEsMC4xLTAuMSwwLjItMC4xLDAuNGMwLjEsNS40LDEuOCwxMCw1LDEzLjJjMy4xLDMuMiw3LjQsNC45LDEyLjQsNC45YzMuNywwLDguNi0xLDEyLjQtMi4xYzAuNS0wLjIsMS4xLDAuMSwxLjMsMC43YzAuMSwwLjIsMC4xLDAuNCwwLDAuNWwtMC41LDEuOWMtMC4yLDAuNy0wLjcsMS4zLTEuMywxLjZjLTMuNywxLjgtOS4zLDMuNS0xNSwzLjVDMzU3LjYsMTgxLjIsMzUxLjYsMTc5LjUsMzQ3LjUsMTc0LjkiLz48cGF0aCBjbGFzcz0ic3QxIiBkPSJNMjMxLjEsMTM1Ljl2MzYuOWMwLDEsMC42LDEuOSwxLjQsMi4zYzAuOSwwLjQsMS40LDEuMywxLjQsMi4zdjAuN2MwLDAuOC0wLjYsMS40LTEuNCwxLjRIMjIwYy0wLjgsMC0xLjQtMC42LTEuNC0xLjR2LTAuN2MwLTEsMC42LTEuOSwxLjQtMi4zYzAuOS0wLjQsMS40LTEuMywxLjQtMi4zdi0zNS43YzAtMC41LTAuNC0wLjktMC45LTAuOXMtMC45LTAuNC0wLjktMC45di0xLjJjMC0xLjIsMC45LTIuMSwyLjEtMi4xaDUuNkMyMjkuNCwxMzIsMjMxLjEsMTMzLjcsMjMxLjEsMTM1LjkiLz48cGF0aCBjbGFzcz0ic3QxIiBkPSJNMjI2LjMsMTEwLjhjMy4zLDAsNiwyLjcsNiw1LjljMCwzLjMtMi43LDUuOS02LDUuOXMtNi0yLjctNi01LjlDMjIwLjMsMTEzLjUsMjIzLDExMC44LDIyNi4zLDExMC44Ii8+PC9zdmc+"/>
					</a>';

				if ( $tab_key === 'cs' ) {
					echo '
					<p class="iubenda-text">
						' . __( "This plugin is the easiest and most comprehensive way to adapt your WordPress site to the ePrivacy (EU Cookie Law). Upon your users’ first visit, the plugin will take care of collecting their consent, blocking the most popular cookie-scripts and subsequently reactivating these scripts as soon as consent is provided. The basic settings include obtaining consent by a simple scroll action (the most effective method) and script reactivation without refreshing the page (asynchronous script reactivation).", 'iubenda' ) . '
					</p>
					<p class="iubenda-text">
						<span class="iubenda-title">' . __( "Does the Cookie Solution support IAB’s Transparency and Consent Framework?", 'iubenda' ) . '</span><br />
						' . sprintf( __( "Yes it does. You can read more about it <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">here.</a>", 'iubenda' ), $this->links['iab'] ) . '
					</p>
					<p class="iubenda-text">
						<span class="iubenda-title">' . __( "Would you like to know more about the cookie law?", 'iubenda' ) . '</span><br />
						' . sprintf( __( "Read our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">complete guide to the cookie law.</a>", 'iubenda' ), $this->links['guide'] ) . '
					</p>
					<p class="iubenda-text">
						<span class="iubenda-title">' . __( "What is the full functionality of the plugin?", 'iubenda' ) . '</span><br />
						' . sprintf( __( "Visit our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">plugin page.</a>", 'iubenda' ), $this->links['plugin_page'] ) . '
					</p>
					<p class="iubenda-text">
						<span class="iubenda-title">' . __( "Enter the iubenda code for the Cookie Solution below.", 'iubenda' ) . '</span><br />
						' . sprintf( __( "In order to run the plugin, you need to enter the iubenda code that activates the cookie law banner and the cookie policy in the form below. This code can be generated on www.iubenda.com, following <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">this guide.</a>", 'iubenda' ), $this->links['generating_code'] ) . '
					</p>';
				} else {
					echo '
					<p class="iubenda-text">
						' . __( 'Maintaining comprehensive records of consent is a vital part of privacy compliance in general but is specifically required under the GDPR. These records should include a way of identifying the user, store proof of consent, record of the consenting action, and the legal documents available to the user at the time of consent, among other things. You can read about the <a href="https://www.iubenda.com/en/help/5428-gdpr-guide#records-of-consent" target="_blank">full requirements here</a>.', 'iubenda' ) . '
					</p>';
				}
				?>
			</div>

			<?php
			if ( $tab_key === 'cs' ) {
				// add per-purpose notice
				if ( iubenda()->options['cs']['skip_parsing'] ) {
					$iubenda_code = '';

					if ( iubenda()->multilang === true && defined( 'ICL_LANGUAGE_CODE' ) && isset( iubenda()->options['cs']['code_' . ICL_LANGUAGE_CODE] ) ) {
						$iubenda_code = iubenda()->options['cs']['code_' . ICL_LANGUAGE_CODE];

						// no code for current language, use default
						if ( ! $iubenda_code )
							$iubenda_code = iubenda()->options['cs']['code_default'];
					} else
						$iubenda_code = iubenda()->options['cs']['code_default'];

					$per_purpose_enabled = preg_match( '/(?:"|\')perPurposeConsent(?:"|\')\: *(?:"|\'*)true(?:"|\'*)/', $iubenda_code );
					$reject_enabled = preg_match( '/(?:"|\')rejectButtonDisplay(?:"|\')\: *(?:"|\'*)true(?:"|\'*)/', $iubenda_code );

					if ( $per_purpose_enabled || $reject_enabled )
						$this->add_notice( 'iub_per_purpose_enabled', sprintf( __( 'If you are using per-purpose script blocking or Reject option please disable the "Leave scripts untouched on the page if the user has already given consent" option. <a href="%s" target="_self">Disable now</a>', 'iubenda' ), esc_url( add_query_arg( 'action', 'disable_skip_parsing', $redirect_to ) ) ), 'notice' );
				}
				
				// add AMP notice
				if ( iubenda()->options['cs']['amp_support'] && iubenda()->options['cs']['amp_template_done'] ) {
					$ssl_support = true;
					
					// multilang support
					if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
						foreach ( iubenda()->languages as $lang_id => $lang_name ) {
							$url = iubenda()->options['cs']['amp_source'] === 'remote' ? iubenda()->options['cs']['amp_template'][$lang_id] : iubenda()->AMP->get_amp_template_url( $lang_id );
							$bits = explode( '/', $url );
							
							if ( $bits[0] === 'http:' )
								$ssl_support = false;
						}
					} else {
						$url = iubenda()->options['cs']['amp_source'] === 'remote' ? iubenda()->options['cs']['amp_template'] : iubenda()->AMP->get_amp_template_url();
						$bits = explode( '/', $url );
						
						if ( $bits[0] === 'http:' )
							$ssl_support = false;
					}
					
					if ( ! $ssl_support )
						$this->add_notice( 'iub_amp_ssl_required', __( 'AMP configuration file requires HTTPS. Make sure your SSL Certificate is configured correctly.', 'iubenda' ), 'error' );
				}

			}
		
			// render custom notices
			$this->print_notices();
			?>

			<h2 style="display: none;"></h2>
			<h2 class="nav-tab-wrapper iubenda-tab-wrapper">
				<a class="nav-tab<?php echo $tab_key == 'cs' ? ' nav-tab-active' : ''; ?>" href="<?php echo esc_url( iubenda()->base_url ); ?>"><?php _e( 'Cookie Solution', 'iubenda' ); ?></a>
				<a class="nav-tab<?php echo $tab_key == 'cons' ? ' nav-tab-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'tab' => 'cons' ), iubenda()->base_url ) ); ?>"><?php _e( 'Consent Solution', 'iubenda' ); ?></a>
			</h2>

			<div id="iubenda-settings">

				<form id="iubenda-tabs" action="options.php" method="post">
					
					
					<?php 
					if ( $tab_key === 'cs' ) {
						echo '<p>' . sprintf( __( 'This plugin drastically reduces the need for direct interventions in the code of the site by integrating with iubenda’s Cookie Solution. It provides a fully customizable cookie banner, dynamically generates a cookie policy <a href="%s" target="_blank">to match the services in use on your site</a>, and, fully manages cookie-related consent – including the blocking of the most common widgets and third-party cookies before consent is received – in order to comply with the GDPR and ePrivacy.', 'iubenda' ), 'https://www.iubenda.com/en/help/19004-how-to-use-the-site-scanner-from-within-the-generator' ) . '</p>'; 
					} else {
						echo '<p>' . __( 'Maintaining valid records of consent is a vital part of privacy compliance in general, and it is specifically required under the GDPR. These records should include a userid, timestamp, consent proof, record of the consenting action, and the legal documents available to the user at the time of consent, among other things. This plugin is THE most complete solution for recording, sorting and maintaining GDPR records of consent*. The plugin also boasts built-in compatibility with WordPress comment form, Contact Form 7 and WP Forms plugins for your convenience, but can be manually integrated with any type of web-form and can even store consent proofs for consents collected offline (e.g in-store sign-ups) via WP media upload.' ) . '</p>'; 
					}
					?>

					<?php
					settings_fields( $this->tabs[$tab_key]['key'] );
					do_settings_sections( $this->tabs[$tab_key]['key'] );

					if ( ! in_array( $this->action, array( 'save', 'edit' ) ) ) {
						echo '	<p class="submit submit-' . $tab_key . '">';

						// consent solution tab only
						if ( $tab_key != 'cs' && ! empty( iubenda()->options['cons']['public_api_key'] ) ) {
							echo '<a href="' . esc_url( add_query_arg( array( 'tab' => 'cons', 'action' => 'autodetect' ), iubenda()->base_url ) ) . '" class="button button-primary button-large iub-autodetect-forms">' . esc_html__( 'Autodetect Forms', 'iubenda' ) . '</a>';
							echo '<br />';
						}
						submit_button( '', 'primary', $this->tabs[$tab_key]['submit'], false );
						echo ' ';
						submit_button( __( 'Reset to defaults', 'iubenda' ), 'secondary', $this->tabs[$tab_key]['reset'], false );
						echo '	</p>';
					}
					?>
					
				</form>
				
			</div>

			<div id="iubenda-footer">
				<?php echo '
				<p class="iubenda-text">
					<span class="iubenda-title">' . __( 'Need support for this plugin?', 'iubenda' ) . '</span><br />
					' . sprintf( __( "Visit our <a href=\"%s\" class=\"iubenda-url\" target=\"_blank\">support forum.</a>", 'iubenda' ), $this->links['support_forum'] ) . '
				</p>';
				?>
			</div>

			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Code option.
	 *
	 * @return mixed
	 */
	public function iub_code() {
		// multilang support
		if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
			echo '
			<div id="contextual-help-wrap" class="contextual-help-wrap hidden" tabindex="-1" style="display: block;">
				<div id="contextual-help-back" class="contextual-help-back"></div>
				<div id="contextual-help-columns" class="contextual-help-columns">
					<div class="contextual-help-tabs">
						<ul>';
			foreach ( iubenda()->languages as $lang_id => $lang_name ) {
				echo '
							<li class="' . ( iubenda()->lang_default == $lang_id ? 'active' : '' ) . '">
								<a href="#tab-panel-' . $lang_id . '" aria-controls="tab-panel-' . $lang_id . '">' . $lang_name . '</a>
							</li>';
			}
			echo '
						</ul>
					</div>

					<div id="contextual-help-tabs-wrap" class="contextual-help-tabs-wrap">';
						foreach ( iubenda()->languages as $lang_id => $lang_name ) {
							// get code for the language
							$code = ! empty( iubenda()->options['cs']['code_' . $lang_id] ) ? html_entity_decode( iubenda()->parse_code( iubenda()->options['cs']['code_' . $lang_id] ) ) : '';
							// handle default, if empty
							$code = empty( $code ) && $lang_id == iubenda()->lang_default ? html_entity_decode( iubenda()->parse_code( iubenda()->options['cs']['code_default'] ) ) : $code;

							echo '
							<div id="tab-panel-' . $lang_id . '" class="help-tab-content' . ( iubenda()->lang_default == $lang_id ? ' active' : '' ) . '">
								<textarea name="iubenda_cookie_law_solution[code_' . $lang_id . ']" class="large-text" cols="50" rows="10">' . $code . '</textarea>
								<p class="description">' . sprintf( __( 'Enter the iubenda code for %s.', 'iubenda' ), $lang_name ) . '</p>
							</div>';
						}
			echo '
					</div>
				</div>
			</div>';
		} else {
			echo '
			<div id="iub_code_default">
				<textarea name="iubenda_cookie_law_solution[code_default]" class="large-text" cols="50" rows="10">' . html_entity_decode( iubenda()->parse_code( iubenda()->options['cs']['code_default'] ) ) . '</textarea>
				<p class="description">' . __( 'Enter the iubenda code.', 'iubenda' ) . '</p>
			</div>';
		}
	}

	/**
	 * Custom scripts option.
	 *
	 * @return void
	 */
	public function iub_custom_scripts() {
		echo '
		<div id="contextual-help-wrap-2" class="contextual-help-wrap hidden" tabindex="-1" style="display: block;">
				<div id="contextual-help-back-2" class="contextual-help-back"></div>
				<div id="contextual-help-columns-2" class="contextual-help-columns">
				<div class="contextual-help-tabs">
					<ul>
						<li class="active">
							<a href="#tab-panel-scripts" aria-controls="tab-panel-scripts">' . esc_html__( 'Scripts', 'iubenda' ) . '</a>
						</li>
						<li>
							<a href="#tab-panel-iframes" aria-controls="tab-panel-iframes">' . esc_html__( 'Iframes', 'iubenda' ) . '</a>
						</li>
					</ul>
				</div>
				<div id="contextual-help-tabs-wrap-2" class="contextual-help-tabs-wrap">
					<div id="tab-panel-scripts" class="help-tab-content active">
						<p class="description">' . __( 'Provide a list of custom scripts you’d like to block and assign their purpose.', 'iubenda' ) . '</p>
						<div id="custom-script-field-template" class="template-field" style="display: none;">
							<input type="text" class="regular-text" value="" name="iubenda_cookie_law_solution[custom_scripts][script][]" placeholder="' . __( 'Enter custom script', 'iubenda' ) . '" /> ' . $this->render_tag_types( 'script', 0 ) . ' <a href="#" class="remove-custom-script-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
						</div>';

		if ( ! empty( iubenda()->options['cs']['custom_scripts'] ) ) {
			foreach ( iubenda()->options['cs']['custom_scripts'] as $script => $type ) {
				echo '
						<div class="custom-script-field">
							<input type="text" class="regular-text" value="' . esc_attr( $script ) . '" name="iubenda_cookie_law_solution[custom_scripts][script][]" placeholder="' . __( 'Enter custom script', 'iubenda' ) . '" /> ' . $this->render_tag_types( 'script', $type ) . ' <a href="#" class="remove-custom-script-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
						</div>';
			}
		}

		echo '
						<a href="#" class="add-custom-script-field button-secondary">Add New Script</a>
					</div>
					<div id="tab-panel-iframes" class="help-tab-content">
						<p class="description">' . __( 'Provide a list of custom iframes you’d like to block and assign their purpose. ', 'iubenda' ) . '</p>
						<div id="custom-iframe-field-template" class="template-field" style="display: none;">
							<input type="text" class="regular-text" value="" name="iubenda_cookie_law_solution[custom_iframes][iframe][]" placeholder="' . __( 'Enter custom iframe', 'iubenda' ) . '" /> ' . $this->render_tag_types( 'iframe', 0 ) . ' <a href="#" class="remove-custom-iframe-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
						</div>';

		if ( ! empty( iubenda()->options['cs']['custom_iframes'] ) ) {
			foreach ( iubenda()->options['cs']['custom_iframes'] as $iframe => $type ) {
				echo '
						<div class="custom-iframe-field">
							<input type="text" class="regular-text" value="' . esc_attr( $iframe ) . '" name="iubenda_cookie_law_solution[custom_iframes][iframe][]" placeholder="' . __( 'Enter custom iframe', 'iubenda' ) . '" /> ' . $this->render_tag_types( 'iframe', $type ) . ' <a href="#" class="remove-custom-iframe-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
						</div>';
			}
		}

		echo '
						<a href="#" class="add-custom-iframe-field button-secondary">Add New Iframe</a>
					</div>
				</div>
			</div>
		</div>';
	}

	/**
	 * Prepare tag types select.
	 *
	 * @param string $type
	 * @param int $selected
	 * @return string
	 */
	function render_tag_types( $type, $selected ) {
		$html = '<select name="iubenda_cookie_law_solution[custom_' . $type . 's][type][]">';

		foreach ( $this->tag_types as $tag_id => $tag_name ) {
			$html .= '<option value="' . esc_attr( $tag_id ) . '" ' . selected( $selected, $tag_id, false ) . '>' . esc_html( $tag_name ) . '</option>';
		}

		return $html . '</select>';
	}

	/**
	 * Parsing option.
	 *
	 * @return mixed
	 */
	public function iub_parse() {
		echo '
		<div id="iub_parse_container">
			<label><input id="iub_parse" type="checkbox" name="iubenda_cookie_law_solution[parse]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['parse'], false ) . '/>' . __( 'Automatically block scripts detected by the plugin', 'iubenda' ) . '</label>
			<p class="description">' . '(' . sprintf( __( "see <a href=\"%s\" target=\"_blank\">our documentation</a> for the list of detected scripts.", 'iubenda' ), $this->links['documentation'] ) . ')' . '</p>
			<div id="iub_parser_engine_container"' . ( iubenda()->options['cs']['parse'] === false ? ' style="display: none;"' : '' ) . '>
				<div>
					<label><input id="iub_parser_engine-new" type="radio" name="iubenda_cookie_law_solution[parser_engine]" value="new" ' . checked( 'new', iubenda()->options['cs']['parser_engine'], false ) . ' />' . __( 'Primary', 'iubenda' ) . '</label>
					<label><input id="iub_parser_engine-default" type="radio" name="iubenda_cookie_law_solution[parser_engine]" value="default" ' . checked( 'default', iubenda()->options['cs']['parser_engine'], false ) . ' />' . __( 'Secondary', 'iubenda' ) . '</label>
					<p class="description">' . __( 'Select parsing engine.', 'iubenda' ) . '</p>
				</div>
				<div>
					<label><input id="iub_skip_parsing" type="checkbox" name="iubenda_cookie_law_solution[skip_parsing]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['skip_parsing'], false ) . '/>' . __( 'Leave scripts untouched on the page if the user has already given consent', 'iubenda' ) . '</label>
					<p class="description">(' . __( "improves performance, highly recommended, to be deactivated only if your site uses a caching system or if you're collecting per-category consent.", 'iubenda' ) . ')</p>
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
			<label><input id="iub_ctype" type="checkbox" name="iubenda_cookie_law_solution[ctype]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['ctype'], false ) . '/>' . __( 'Restrict the plugin to run only for requests that have "Content-type: text / html" (recommended)', 'iubenda' ) . '</label>
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
			<label><input id="iub_output_feed" type="checkbox" name="iubenda_cookie_law_solution[output_feed]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['output_feed'], false ) . '/>' . __( 'Do not run the plugin inside the RSS feed (recommended)', 'iubenda' ) . '</label>
		</div>';
	}
	
	/**
	 * POST request option.
	 *
	 * @return mixed
	 */
	public function iub_output_post() {
		echo '
		<div id="iub_output_post_container">
			<label><input id="iub_output_post" type="checkbox" name="iubenda_cookie_law_solution[output_post]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['output_post'], false ) . '/>' . __( 'Do not run the plugin on POST requests (recommended)', 'iubenda' ) . '</label>
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
			<label><input id="iub_menu_position-topmenu" type="radio" name="iubenda_cookie_law_solution[menu_position]" value="topmenu" ' . checked( 'topmenu', iubenda()->options['cs']['menu_position'], false ) . ' />' . __( 'Top menu', 'iubenda' ) . '</label>
			<label><input id="iub_menu_position-submenu" type="radio" name="iubenda_cookie_law_solution[menu_position]" value="submenu" ' . checked( 'submenu', iubenda()->options['cs']['menu_position'], false ) . ' />' . __( 'Submenu', 'iubenda' ) . '</label>
			<p class="description">' . __( 'Select whether to display iubenda in a top admin menu or the Settings submenu.', 'iubenda' ) . '</p>
		</div>';
	}
	
	/**
	 * Google AMP support option.
	 *
	 * @return mixed
	 */
	public function iub_amp_support() {
		echo '
		<div id="iub_amp_support_container">
			<label><input id="iub_amp_support" type="checkbox" name="iubenda_cookie_law_solution[amp_support]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['amp_support'], false ) . '/>' . __( 'Enable Google AMP support.', 'iubenda' ) . '</label>
			<p class="description">' . sprintf( __( 'This feature enables iubenda on AMP pages via the <a href="%s" target="_blank">AMP</a> and <a href="%s" target="_blank">AMP for WP</a> plugins. AMP requires specific configuration parameters and a page hosted on your domain where the configuration is loaded from. <a href="%s" target="_blank">Learn more on iubenda and AMP</a>.', 'iubenda' ), 'https://wordpress.org/plugins/amp/', 'https://wordpress.org/plugins/accelerated-mobile-pages/', 'https://www.iubenda.com/en/help/3182-cookie-solution-amp#wordpress' ) . '</p>
			<div id="iub_amp_options_container"' . ( iubenda()->options['cs']['amp_support'] === false ? ' style="display: none;"' : '' ) . '>
				<div>
					<label><input id="iub_amp_source-local" class="iub_amp_source" type="radio" name="iubenda_cookie_law_solution[amp_source]" value="local" ' . checked( 'local', iubenda()->options['cs']['amp_source'], false ) . ' />' . __( 'Auto-generated configuration file', 'iubenda' ) . '</label>
					<label><input id="iub_amp_source-remote" class="iub_amp_source" type="radio" name="iubenda_cookie_law_solution[amp_source]" value="remote" ' . checked( 'remote', iubenda()->options['cs']['amp_source'], false ) . ' />' . __( 'Custom configuration file', 'iubenda' ) . '</label>
					<p class="description">' . __( 'Select the iubenda AMP configuration file location.', 'iubenda' ) . '</p>
				</div>
				<div id="iub_amp_template-local"' . ( iubenda()->options['cs']['amp_source'] === 'remote' ? ' style="display: none;"' : '' ) . '>';
		if ( empty( iubenda()->options['cs']['amp_template_done'] ) ) {
			echo '
					<p class="description">' . __( 'No file available. Save changes to generate iubenda AMP configuration file.', 'iubenda' ) . '</p>';
		} else {
			// multilang support
			if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
				foreach ( iubenda()->languages as $lang_id => $lang_name ) {
					echo $lang_name . ':
					<a href="' . iubenda()->AMP->get_amp_template_url( $lang_id ) . '" target="_blank">' . iubenda()->AMP->get_amp_template_url( $lang_id ) . '</a><br />';
				}
			} else {
			echo '
					<a href="' . iubenda()->AMP->get_amp_template_url() . '" target="_blank">' . iubenda()->AMP->get_amp_template_url() . '</a>';
			}
		}
		echo '					
				</div>
				<div id="iub_amp_template-remote"' . ( iubenda()->options['cs']['amp_source'] === 'local' ? ' style="display: none;"' : '' ) . '>';
		
		// multilang support
		if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
			foreach ( iubenda()->languages as $lang_id => $lang_name ) {
				echo $lang_name . ':
					<label><input id="iub_amp_template-' . $lang_id . '" type="text" class="regular-text" name="iubenda_cookie_law_solution[amp_template][' . $lang_id . ']" value="' . ( isset( iubenda()->options['cs']['amp_template'][$lang_id] ) ? esc_url( iubenda()->options['cs']['amp_template'][$lang_id] ) : '' ) . '" /></label><br />';
			} 
			} else {
				echo '
					<label><input id="iub_amp_template" type="text" class="regular-text" name="iubenda_cookie_law_solution[amp_template]" value="' . ( isset( iubenda()->options['cs']['amp_template'] ) ? esc_url( iubenda()->options['cs']['amp_template'] ) : '' ) . '" /></label>';
			}
			echo '
					<p class="description">' . __( 'If you\'re experiencing issues with AMP setup download the generated iubenda AMP configuration file, upload it to any SSL server and paste the file link to the field above.', 'iubenda' ) . '</p>
				</div>
				<p class="description">' . sprintf( __( 'Seeing the AMP cookie notice when testing from Google but not when visiting your AMP pages directly? <a href="%s" target="_blank">Learn how to fix it</a>.', 'iubenda' ), 'https://www.iubenda.com/en/help/3182-cookie-solution-amp#amp-domain' ) . '</p>
			</div>
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
			<label><input id="iub_deactivation" type="checkbox" name="iubenda_cookie_law_solution[deactivation]" value="1" ' . checked( true, (bool) iubenda()->options['cs']['deactivation'], false ) . '/>' . __( 'Delete all plugin data upon deactivation', 'iubenda' ) . '</label>
		</div>';
	}

	/**
	 * Public API Key option.
	 *
	 * @return mixed
	 */
	public function iub_public_api_key() {
		echo '
		<div id="iub_public_api_key_container">
			<label><input id="iub_public_api_key" type="text" class="regular-text" name="iubenda_consent_solution[public_api_key]" value="' . iubenda()->options['cons']['public_api_key'] . '" /></label>
			<p class="description">' . __( 'Enter your iubenda Javascript library public API key.', 'iubenda' ) . '</p>
		</div>';
	}

	/**
	 * Forms list.
	 *
	 * @return mixed
	 */
	public function iubenda_consent_forms() {
		$form_id = ! empty( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;
		$form = ! empty( $form_id ) ? iubenda()->forms->get_form( $form_id ) : false;

		$supported_forms = iubenda()->forms->sources;

		echo '
		<p class="description">' . __( 'This section lists the forms available for field mapping. The plugin currently supports & detects: WordPress Comment, Contact Form 7, WooCommerce Checkout and WP Forms.', 'iubenda' ) . '</p>';

		// list screen
		if ( ! class_exists( 'WP_List_Table' ) )
			include_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

		include_once( IUBENDA_PLUGIN_PATH . '/includes/forms-list-table.php' );

		$list_table = new iubenda_List_Table_Forms();

		echo '
			<div id="iubenda-consent-forms">';
		$list_table->views();
		$list_table->prepare_items();
		$list_table->display();

		echo '
			</div>';
	}

	/**
	 * Single form.
	 *
	 * @return mixed
	 */
	public function iubenda_consent_form() {
		$form_id = ! empty( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;
		$form = ! empty( $form_id ) ? iubenda()->forms->get_form( $form_id ) : false;

		if ( ! $form )
			return;

		$status = isset( $form->post_status ) && in_array( $form->post_status, array_keys( iubenda()->forms->statuses ) ) ? esc_attr( $form->post_status ) : 'publish';
		$subject = isset( $form->form_subject ) && is_array( $form->form_subject ) ? array_map( 'esc_attr', $form->form_subject ) : array();
		$preferences = isset( $form->form_preferences ) && is_array( $form->form_preferences ) ? array_map( 'esc_attr', $form->form_preferences ) : array();
		$exclude = isset( $form->form_exclude ) && is_array( $form->form_exclude ) ? array_map( 'esc_attr', $form->form_exclude ) : array();
		$legal_notices = isset( $form->form_legal_notices ) && is_array( $form->form_legal_notices ) ? array_map( 'esc_attr', $form->form_legal_notices ) : array();
		
		$available_fields = array();

		if ( ! empty( $form->form_fields ) && is_array( $form->form_fields ) ) {
			foreach ( $form->form_fields as $index => $form_field ) {
				if ( is_array( $form_field ) ) {
					// print_r( $form_field );
					$available_fields[] = $form_field['label'] . ' (' . $form_field['type'] . ')';
				} else {
					$available_fields[] = $form_field;
				}
			}
		}
		
		// print_r( $form );

		echo '
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<h1>' . $form->post_title . '</h1>
						</div>
						<p class="description">' . sprintf( __( '%s form title.', 'iubenda' ), ( array_key_exists( $form->form_source, iubenda()->forms->sources ) ? iubenda()->forms->sources[$form->form_source] : __( 'Unknown', 'iubenda' ) ) ) . '</p>

						<div style="margin-top: 18px"><strong>' . __( 'Available form fields:', 'iubenda' ) . '</strong><br /><p class="description">' . implode( ', ', $available_fields ) . '</p></div>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="">
						<div id="submitdiv" class="postbox ">
							<h3 class="hndle"><span>' . __( 'Publish' ) . '</span></h3>
							<div class="inside">
								<div id="submitpost" class="submitbox">
									<div id="minor-publishing">
										<div class="misc-pub-section misc-pub-post-status">
											<label for="status">' . __( 'Status' ) . ':</label>
											<div id="status-select" class="" style="margin: 3px 0 0;">
												<select id="status" name="status">';
													foreach ( iubenda()->forms->statuses as $name => $label ) {
														echo '
														<option value="' . $name . '"' . selected( $form->post_status, $name, true ) . '>' . $label . '</option>';
													}
													echo '
												</select>
											</div>
										</div>
										<div id="major-publishing-actions">
											<div id="delete-action">
												<a class="submitdelete deletion" href="' . esc_url( add_query_arg( array( 'tab' => 'cons' ), iubenda()->base_url ) ) . '">' . __( 'Cancel' ) . '</a>
											</div>
											<div id="publishing-action">
												<span class="spinner"></span>
												<input type="hidden" value="' . $form->ID . '" name="form_id">
												<input id="publish" class="button button-primary button-large" type="submit" value="' . __( 'Save' ) . '" name="save">
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<div id="normal-sortables" class="meta-box-sortables">
						<div id="map-fields" class="postbox">
							<h3 class="hndle ui-sortable-handle"><span>' . __( 'Map fields', 'iubenda' ) . '</span></h3>
							<div class="inside">
								<table class="widefat">
									<tbody>
										<tr>
											<td class="label table-label">
												<h4>' . __( 'Subject fields', 'iubenda' ) . ' <span class="required">(required)</span></h4>
												<p class="description">' . __( 'Subject fields allow you to store a series of identifying values about your individual subjects/users. Please map the subject  field with the corresponding form fields where applicable.', 'iubenda' ) . '</p>
											</td>
											<td>
												<table class="widefat subject-table">
													<thead>
														<td class="label">' . __( 'Subject field', 'iubenda' ) . '</td>
														<td class="label">' . __( 'Form field', 'iubenda' ) . '</td>
													</thead>
													<tbody>';

													foreach ( $this->subject_fields as $field_name => $field_label ) {
														$selected = isset( $subject[$field_name] ) ? $subject[$field_name] : '';
														$none = $field_name == 'id' ? __( 'Autogenerated', 'iubenda' ) : __( 'None', 'iubenda' );

														echo '
														<tr class="subject-field options-field">
															<td>' . $field_name . ' (' . $field_label . ')' . '</td>
															<td>
																<select class="subject-fields-select select-' . $field_name . '" name="subject[' . $field_name . ']">
																	<option value="" ' . selected( $selected, '', false ) . '>' . $none . '</option>';
																	if ( ! empty( $form->form_fields ) ) {
																		foreach ( $form->form_fields as $index => $form_field  ) {
																			// get field data
																			$form_field_value = is_array( $form_field ) ? $index : $form_field;
																			$form_field_label = is_array( $form_field ) ? $form_field['label'] . ' (' . $form_field['type'] . ')' : $form_field;
																			$form_field_selected = is_array( $form_field ) ? $index : $form_field;
																			
																			echo '<option value="' . $form_field_value . '" ' . selected( $selected, $form_field_selected, false ) . '>' . $form_field_label . '</option>';
																		}
																	}
																	echo '
																</select>
															</td>
														</tr>
															';
													}
													echo '
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td class="label table-label">
												<h4>' . __( 'Preferences fields', 'iubenda' ) . ' <span class="required">(required)</span></h4>
												<p class="description">' . __( 'Preferences fields allow you to store a record of the various opt-ins points at which the user has agreed or given consent, such as fields for agreeing to terms and conditions, newsletter, profiling, etc. *Please create at least one preference field.', 'iubenda' ) . '</p>
											</td>
											<td>
												<table class="widefat preferences-table">
													<thead>
														<td class="label">' . __( 'Preferences field', 'iubenda' ) . '</td>
														<td class="label">' . __( 'Form field', 'iubenda' ) . '</td>
													</thead>
													<tbody>';
													echo '
															<tr id="preferences-field-template" class="template-field" style="display: none;">
																<td><input type="text" class="regular-text" value="" name="preferences[__PREFERENCE_ID__][field]" placeholder="' . __( 'Enter field name', 'iubenda' ) . '" /></td>
																<td>
																	<select class="preferences-fields-select select-' . $field_name . '" name="preferences[__PREFERENCE_ID__][value]">';
																		if ( ! empty( $form->form_fields ) ) {
																			foreach ( $form->form_fields as $index => $form_field  ) {
																				// get field data
																				$form_field_value = is_array( $form_field ) ? $index : $form_field;
																				$form_field_label = is_array( $form_field ) ? $form_field['label'] . ' (' . $form_field['type'] . ')' : $form_field;
																			
																				echo '<option value="' . $form_field_value . '">' . $form_field_label . '</option>';
																			}
																		}
																		echo '
																	</select>
																	<a href="javascript:void(0)" class="remove-preferences-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
																</td>
															</tr>';

													if ( $preferences ) {
														$index = 0;

														foreach ( $preferences as $field_name => $field_value ) {
															$selected = isset( $preferences[$field_name] ) ? $preferences[$field_name] : '';

															echo '
															<tr class="preferences-field options-field">
																<td><input type="text" class="regular-text" value="' . $field_name . '" name="preferences[' . $index . '][field]" placeholder="' . __( 'Enter field name', 'iubenda' ) . '" /></td>
																<td>
																	<select class="preferences-fields-select select-' . $field_name . '" name="preferences[' . $index . '][value]">';
																		if ( ! empty( $form->form_fields ) ) {
																			foreach ( $form->form_fields as $index => $form_field  ) {
																				// get field data
																				$form_field_value = is_array( $form_field ) ? $index : $form_field;
																				$form_field_label = is_array( $form_field ) ? $form_field['label'] . ' (' . $form_field['type'] . ')' : $form_field;
																				$form_field_selected = is_array( $form_field ) ? $index : $form_field;
																			
																				echo '<option value="' . $form_field_value . '" ' . selected( $selected, $form_field_selected, false ) . '>' . $form_field_label . '</option>';
																			}
																		}
																		echo '
																	</select>
																	<a href="javascript:void(0)" class="remove-preferences-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
																</td>
															</tr>';

														$index++;
														}
													}

													echo '
														<tr class="submit-field"><td colspan="2"><a href="javascript:void(0)" class="add-preferences-field button-secondary">' . __( 'Add New Preference', 'iubenda' ) . '</a></td></tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td class="label table-label">
												<h4>' . __( 'Exclude fields', 'iubenda' ) . '</h4>
												<p class="description">' . __( 'Exclude fields allow you to create a list of fields that you would like to exclude from your Consent Solution recorded proofs (for e.g. password or other fields not related to the consent).', 'iubenda' ) . '</p>
											</td>
											<td>
												<table class="widefat exclude-table">
													<thead>
														<td class="label">' . __( 'Exclude field', 'iubenda' ) . '</td>
														<td class="label"></td>
													</thead>
													<tbody>';
													echo '
															<tr id="exclude-field-template" class="template-field" style="display: none;">
																<td>
																	<select class="exclude-fields-select select-' . $field_name . '" name="exclude[__EXCLUDE_ID__][field]">';
																		if ( ! empty( $form->form_fields ) ) {
																			foreach ( $form->form_fields as $index => $form_field  ) {
																				// get field data
																				$form_field_value = is_array( $form_field ) ? $index : $form_field;
																				$form_field_label = is_array( $form_field ) ? $form_field['label'] . ' (' . $form_field['type'] . ')' : $form_field;
																			
																				echo '<option value="' . $form_field_value . '">' . $form_field_label . '</option>';
																			}
																		}
																		echo '
																	</select>
																	<a href="javascript:void(0)" class="remove-exclude-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
																</td>
																<td></td>

															</tr>';

													if ( $exclude ) {
														$index = 0;

														foreach ( $exclude as $index => $field_name ) {
															$selected = isset( $exclude[$index] ) ? $exclude[$index] : '';

															echo '
															<tr class="exclude-field options-field">
																<td>
																	<select class="exclude-fields-select select-' . $field_name . '" name="exclude[' . $index . '][field]">';
																		if ( ! empty( $form->form_fields ) ) {
																			foreach ( $form->form_fields as $index => $form_field  ) {
																				// get field data
																				$form_field_value = is_array( $form_field ) ? $index : $form_field;
																				$form_field_label = is_array( $form_field ) ? $form_field['label'] . ' (' . $form_field['type'] . ')' : $form_field;
																				$form_field_selected = is_array( $form_field ) ? $index : $form_field;
																			
																				echo '<option value="' . $form_field_value . '" ' . selected( $selected, $form_field_selected, false ) . '>' . $form_field_label . '</option>';
																			}
																		}
																		echo '
																	</select>
																	<a href="javascript:void(0)" class="remove-exclude-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a>
																</td>
																<td></td>
															</tr>';

														$index++;
														}
													}

													echo '
														<tr class="submit-field"><td colspan="2"><a href="javascript:void(0)" class="add-exclude-field button-secondary">' . __( 'Add New Exclude', 'iubenda' ) . '</a></td></tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="legal-notices" class="postbox">
							<h3 class="hndle ui-sortable-handle"><span>' . __( 'Legal Notices', 'iubenda' ) . '</span></h3>
							<div class="inside">
								<table class="widefat">
									<tbody>
										<tr>
											<td class="label table-label">
												<h4>' . __( 'Legal documents', 'iubenda' ) . '</h4>
												<p class="description">' . __( 'In general, it’s important that you declare which legal documents are being agreed upon when each consent is collected. However, if you use iubenda for your legal documents, it is *required*  that you identify the documents by selecting them here.', 'iubenda' ) . '</p>
											</td>
											<td>
												<table class="widefat legal_notices-table">
													<thead>
														<td class="label">' . __( 'Identifier', 'iubenda' ) . '</td>
														<td class="label"></td>
													</thead>
													<tbody>';
													
													// default identifiers
													foreach ( $this->legal_notices as $index => $field_name ) {
														echo '
														<tr class="legal_notices-field default-field">
															<td>' . ( $index === 0 ? '<p class="description">' . __( 'Please select each legal document available on your site.', 'iubenda' ) . '</p>' : '' ) . '<label for="legal_notices-default-field=' . $index . '"><input id="legal_notices-default-field=' . $index . '" type="checkbox" value="' . $field_name . '" name="legal_notices[' . $index . '][field]"' . checked( in_array( $field_name, $legal_notices, true ), true, false ) . 'placeholder="' . __( 'Enter field name', 'iubenda' ) . '" />' . $field_name . '</label></td>
															<td></td>
														</tr>';
													}
													
													$index++;
													
													// custom identifiers
													echo '
														<tr id="legal_notices-field-template" class="template-field" style="display: none;">
															<td><input type="text" class="regular-text" value="" name="legal_notices[__LEGAL_NOTICE_ID__][field]" placeholder="' . __( 'Enter field name', 'iubenda' ) . '" /> <a href="javascript:void(0)" class="remove-legal_notices-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a></td>
															<td></td>
														</tr>';
													
													echo '
														<tr>
															<td colspan="2"><p class="description" style="margin-bottom: 0;">' . __( 'Alternatively, you may add your own custom document identifiers.', 'iubenda' ) . '</p></td>
														</tr>';
													
													if ( $legal_notices ) {
														foreach ( $legal_notices as $field_name ) {
															if ( in_array( $field_name, $this->legal_notices, true ) )
																continue;
															
															echo '
															<tr class="legal_notices-field options-field">
																<td><input type="text" class="regular-text" value="' . $field_name . '" name="legal_notices[' . $index . '][field]" placeholder="' . __( 'Enter field name', 'iubenda' ) . '" /> <a href="javascript:void(0)" class="remove-legal_notices-field button-secondary" title="' . __( 'Remove', 'iubenda' ) . '">-</a></td>
																<td></td>
															</tr>';
															
														$index++;
														}
													}

													echo '
														<tr class="submit-field"><td colspan="2"><a href="javascript:void(0)" class="add-legal_notices-field button-secondary">' . __( 'Add New Document', 'iubenda' ) . '</a></td></tr>';
													echo '
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>';

		// echo '<pre>'; print_r( $form ); echo '</pre>';
	}

	/**
	 * Save cookie solution options.
	 *
	 * @return void
	 */
	public function save_cookie_law_options( $input ) {
		if ( ! current_user_can( apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ) ) )
			return $input;

		// save options
		if ( isset( $_POST['save_iubenda_options'] ) ) {
			$input['parse'] = (bool) isset( $input['parse'] );
			$input['parser_engine'] = isset( $input['parser_engine'] ) && in_array( $input['parser_engine'], array( 'default', 'new' ) ) ? $input['parser_engine'] : iubenda()->defaults['cs']['parser_engine'];
			$input['skip_parsing'] = (bool) isset( $input['skip_parsing'] );
			$input['ctype'] = (bool) isset( $input['ctype'] );
			$input['output_feed'] = (bool) isset( $input['output_feed'] );
			$input['output_post'] = (bool) isset( $input['output_post'] );
			$input['menu_position'] = isset( $input['menu_position'] ) && in_array( $input['menu_position'], array( 'topmenu', 'submenu' ) ) ? $input['menu_position'] : iubenda()->defaults['cs']['menu_position'];
			$input['amp_support'] = (bool) isset( $input['amp_support'] );
			$input['deactivation'] = (bool) isset( $input['deactivation'] );

			// multilang support
			if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
				$iubenda_code = array();
				
				foreach ( iubenda()->languages as $lang_id => $lang_name ) {
					$input['code_' . $lang_id] = $iubenda_code[$lang_id] = ! empty( $input['code_' . $lang_id] ) ? iubenda()->parse_code( $input['code_' . $lang_id] ) : '';

					// handle default lang too
					if ( $lang_id == iubenda()->lang_default ) {
						$input['code_default'] = ! empty( $input['code_' . $lang_id] ) ? iubenda()->parse_code( $input['code_' . $lang_id] ) : iubenda()->options['cs']['code_default'];
					}
				}
			} else {
				$iubenda_code = '';
				
				$input['code_default'] = $iubenda_code = ! empty( $input['code_default'] ) ? iubenda()->parse_code( $input['code_default'] ) : '';
			}
			
			// generate amp template file
			if ( isset( $input['amp_support'] ) ) {
				$template_done = false;
				
				if ( ! empty( $iubenda_code ) ) {
					if ( is_array( $iubenda_code ) ) {
						$template_done = array();
						
						foreach ( $iubenda_code as $lang => $code ) {
							$template_done[$lang] = (bool) iubenda()->AMP->generate_amp_template( $code, $lang );
						}
					} else {
						$template_done = (bool) iubenda()->AMP->generate_amp_template( $iubenda_code );
					}
				}
				
				$input['amp_template_done'] = $template_done;
				
				if ( is_array( $input['amp_template'] ) ) {
					foreach ( $input['amp_template'] as $lang => $template ) {
						$input['amp_template'][$lang] = esc_url( $template );
					}
				} else {
					$input['amp_template'] = esc_url( $input['amp_template'] );
				}
			}

			// scripts
			if ( ! empty( $input['custom_scripts'] ) && ! empty( $input['custom_scripts']['script'] ) && ! empty( $input['custom_scripts']['type'] ) ) {
				$scripts = array();

				// first field is template
				if ( count( $input['custom_scripts']['script'] ) > 1 ) {
					foreach ( $input['custom_scripts']['script'] as $number => $script ) {
						$trimmed = trim( $script );

						if ( $trimmed !== '' )
							$scripts[$trimmed] = (int) $input['custom_scripts']['type'][$number];
					}
				}

				$input['custom_scripts'] = $scripts;
			} else
				$input['custom_scripts'] = array();

			// iframes
			if ( ! empty( $input['custom_iframes'] ) && ! empty( $input['custom_iframes']['iframe'] ) && ! empty( $input['custom_iframes']['type'] ) ) {
				$iframes = array();

				// first field is template
				if ( count( $input['custom_iframes']['iframe'] ) > 1 ) {
					foreach ( $input['custom_iframes']['iframe'] as $number => $iframe ) {
						$trimmed = trim( $iframe );

						if ( $trimmed !== '' )
							$iframes[$trimmed] = (int) $input['custom_iframes']['type'][$number];
					}
				}

				$input['custom_iframes'] = $iframes;
			} else
				$input['custom_iframes'] = array();

			add_settings_error( 'cs_settings_errors', 'iub_cs_settings_updated', __( 'Settings saved.', 'iubenda' ), 'updated' );
			// reset options
		} elseif ( isset( $_POST['reset_iubenda_options'] ) ) {
			$input = iubenda()->defaults['cs'];

			// multilang support
			if ( iubenda()->multilang && ! empty( iubenda()->languages ) ) {
				foreach ( iubenda()->languages as $lang_id => $lang_name ) {
					$input['code_' . $lang_id] = '';
				}
			}

			add_settings_error( 'cs_settings_errors', 'iub_cs_settings_restored', __( 'Settings restored to defaults.', 'iubenda' ), 'updated' );
		}

		return $input;
	}

	/**
	 * Save consent solution options.
	 *
	 * @return void
	 */
	public function save_consent_options( $input ) {

		if ( ! current_user_can( apply_filters( 'iubenda_cookie_law_cap', 'manage_options' ) ) )
			return $input;

		// save options
		if ( isset( $_POST['save_consent_options'] ) ) {
			$input['public_api_key'] = isset( $input['public_api_key'] ) ? esc_attr( $input['public_api_key'] ) : '';

			add_settings_error( 'cons_settings_errors', 'iub_cons_settings_updated', __( 'Settings saved.', 'iubenda' ), 'updated' );
			// reset options
		} elseif ( isset( $_POST['reset_consent_options'] ) ) {
			$input = iubenda()->defaults['cons'];

			add_settings_error( 'cons_settings_errors', 'iub_cons_settings_restored', __( 'Settings restored to defaults.', 'iubenda' ), 'updated' );
		}

		return $input;
	}

	/**
	 * Process the bulk actions
	 *
	 * @return void
	 */
	public function process_actions() {
		global $pagenow;
		
		$page = ! empty( $_POST['option_page'] ) ? esc_attr( $_POST['option_page'] ) : ( ! empty( $_GET['page'] ) ? esc_attr( $_GET['page'] ) : '' );
		$id = isset( $_REQUEST['form_id'] ) ? ( is_array( $_REQUEST['form_id'] ) ? array_map( 'ansint', $_REQUEST['form_id'] ) : absint( $_REQUEST['form_id'] ) ) : false;
		$tab_key = ! empty( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'cs';

		if ( ! $page )
			return;
		
		// get redirect url
		if ( iubenda()->options['cs']['menu_position'] === 'submenu' && $pagenow === 'admin.php' ) {
			// sub menu
			$redirect_to = admin_url( 'options-general.php?page=iubenda&tab=' . $tab_key );
		} else {
			// top menu
			$redirect_to = admin_url( 'admin.php?page=iubenda&tab=' . $tab_key );
		}

		// add comments cookie option notice
		if ( $tab_key != 'cs' && ! empty( iubenda()->options['cons']['public_api_key'] ) ) {
			$cookies_enabled = get_option( 'show_comments_cookies_opt_in' );

			if ( ! $cookies_enabled ) {
				$this->add_notice( 'iub_comment_cookies_disabled', sprintf( __( 'Please enable comments cookies opt-in checkbox in the <a href="%s" target="_blank">Discussion settings</a>.', 'iubenda' ), esc_url( admin_url( 'options-discussion.php' ) ) ), 'notice' );
			}
		}

		$result = null;

		switch ( $this->action ) {
			case 'autodetect' :
				$result = iubenda()->forms->autodetect_forms();

				// new forms notice
				if ( ! empty( $result['new'] ) )
					$this->add_notice( 'iub_autodetect_success', sprintf( _n( '%d form detected successfully.', '%d forms detected successfully.', count( $result['new'] ), 'iubenda' ), $result ), 'success' );

				// forms changed notice
				if ( ! empty( $result['updated'] ) )
					$this->add_notice( 'iub_autodetect_success', sprintf( _n( '%d form change detected.', '%d form changes detected.', count( $result['updated'] ), 'iubenda' ), $result ), 'success' );
				
				// no changes notice
				if ( empty( $result['new'] ) && empty( $result['updated'] ) )
					$this->add_notice( 'iub_autodetect_success', __( 'No forms or form changes detected.', 'iubenda' ), 'error' );

				// make sure it's current host location
				wp_safe_redirect( $redirect_to );
				exit;

				break;

			case 'save' :
				if ( ! $id )
					return;

				$form = iubenda()->forms->get_form( $id );

				if ( $form->ID != $id )
					return;

				$status = isset( $_POST['status'] ) && in_array( $_POST['status'], array_keys( iubenda()->forms->statuses ) ) ? esc_attr( $_POST['status'] ) : 'publish';
				$subject = isset( $_POST['subject'] ) && is_array( $_POST['subject'] ) ? array_map( 'esc_attr', $_POST['subject'] ) : array();
				$preferences = array();
				$exclude = array();
				$legal_notices = array();

				$preferences_raw = isset( $_POST['preferences'] ) && is_array( $_POST['preferences'] ) ? array_map( array( $this, 'array_map_callback' ), $_POST['preferences'] ) : array();
				$exclude_raw = isset( $_POST['exclude'] ) && is_array( $_POST['exclude'] ) ? array_map( array( $this, 'array_map_callback' ), $_POST['exclude'] ) : array();
				$legal_notices_raw = isset( $_POST['legal_notices'] ) && is_array( $_POST['legal_notices'] ) ? array_map( array( $this, 'array_map_callback' ), $_POST['legal_notices'] ) : array();

				// format preferences data
				if ( ! empty( $preferences_raw ) && is_array( $preferences_raw ) ) {
					foreach ( $preferences_raw as $index => $data ) {
						if ( ! empty( $data['field'] ) && ! empty( $data['value'] ) )
							$preferences[ sanitize_key( $data['field'] ) ] = $data['value'];
					}
				}

				// format exclude data
				if ( ! empty( $exclude_raw ) && is_array( $exclude_raw ) ) {
					foreach ( $exclude_raw as $index => $data ) {
						if ( ! empty( $data['field'] ) )
							$exclude[] = $data['field'];
					}
				}

				// format legal notices data
				if ( ! empty( $legal_notices_raw ) && is_array( $legal_notices_raw ) ) {
					foreach ( $legal_notices_raw as $index => $data ) {
						if ( ! empty( $data['field'] ) )
							$legal_notices[] = $data['field'];
					}
				}
				
				// form first save, update status to mapped automatically
				if ( empty( $form->form_subject ) && empty( $form->form_preferences ) ) {
					$status = 'mapped';
				}
				
				// echo '<pre>'; print_r( $_POST ); echo '</pre>'; exit;
				
				// bail if empty fields
				if ( empty( $subject ) || empty( $preferences ) ) {
					$this->add_notice( 'iub_form_fields_missing', __( 'Form saving failed. Please fill the Subject and Preferences fields.', 'iubenda' ), 'error' );
					return;
				}

				$args = array(
					'ID'					=> $form->ID,
					'status'				=> $status,
					'object_type'			=> $form->object_type,
					'object_id'				=> $form->object_id,
					'form_source'			=> $form->form_source,
					'form_title'			=> $form->post_title,
					'form_date'				=> $form->post_modified,
					'form_fields'			=> $form->form_fields,
					'form_subject'			=> $subject,
					'form_preferences'		=> $preferences,
					'form_exclude'			=> $exclude,
					'form_legal_notices'	=> $legal_notices
				);

				$result = iubenda()->forms->save_form( $args );

				if ( $result ) {
					// form save, inform about form status update
					if ( empty( $form->form_subject ) && empty( $form->form_preferences ) ) {
						$this->add_notice( 'iub_form_saved', __( 'Form saved successfully - form status changed to Mapped.', 'iubenda' ), 'success' );
					// form update
					} else {
						$this->add_notice( 'iub_form_updated', __( 'Form updated successfully.', 'iubenda' ), 'success' );
					}
				} else {
					$this->add_notice( 'iub_form_failed', __( 'Form saving failed.', 'iubenda' ), 'error' );
				}

				break;

			case 'delete' :
				if ( ! $id )
					return;

				$form = iubenda()->forms->get_form( $id );

				if ( empty( $form ) )
					return;

				$result = iubenda()->forms->delete_form( $id );

				if ( $result )
					$this->add_notice( 'iub_form_deleted', __( 'Form deleted successfully.', 'iubenda' ), 'success' );
				else
					$this->add_notice( 'iub_form_delete_failed', __( 'Form delete failed.', 'iubenda' ), 'error' );

				// make sure it's current host location
				wp_safe_redirect( $redirect_to );
				exit;
				
				break;
				
			case 'disable_skip_parsing' :
				
				// disable skip parsing option
				$options = iubenda()->options['cs'];
				$options['skip_parsing'] = false;
				
				update_option( 'iubenda_cookie_law_solution', $options );
				
				$this->add_notice( 'iub_settings_updated', __( 'Settings saved.', 'iubenda' ), 'success' );
				
				// make sure it's current host location
				wp_safe_redirect( $redirect_to );
				exit;
				
				break;

			default :
				return;
		}

		if ( ! empty ( $result ) ) {
			//
		} else {
			//
		}
	}

	/**
	 * Add admin notice.
	 *
	 * @param mixed $message
	 * @param string $notice_type
	 */
	public function add_notice( $key, $message, $notice_type = 'notice' ) {
		$key = ! empty( $key ) ? sanitize_key( $key ) : '';
		$message = ! empty( $message ) ? wp_kses_post( $message ) : '';
		$notice_type = ! empty( $notice_type ) && in_array( $notice_type, $this->notice_types ) ? $notice_type : 'notice';

		if ( ! $key || ! $message )
			return;

		$notices = get_transient( 'iubenda_dashboard_notices' );
		$delay = MINUTE_IN_SECONDS * 2;

		if ( empty( $notices ) || ! array_key_exists( $key, $notices[$notice_type] ) ) {
			$notices[$notice_type][$key] = $message;

			set_transient( 'iubenda_dashboard_notices', $notices, $delay );
		}
	}

	/**
	 * Display admin notices.
	 *
	 * @return mixed
	 */
	public function print_notices() {
		$notices = get_transient( 'iubenda_dashboard_notices' );
		$notices_array = array();

		foreach ( $this->notice_types as $notice_type ) {
			if ( $this->notice_count( $notices, $notice_type ) > 0 ) {
				echo '<div class="notice notice-' . ( $notice_type === 'notice' ? 'info' : $notice_type ) . ' below-h2 is-dismissible">';

				foreach ( $notices[$notice_type] as $key => $notice ) {
					echo '<p><strong>' . wp_kses_post( $notice ) . '</strong></p>';
				}

				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.' ) . '</span></button>';

				echo '</div>';
			}
		}

		delete_transient( 'iubenda_dashboard_notices' );
	}

	/**
	 * Count notices function.
	 *
	 * @param string $notice_type
	 * @return int
	 */
	public function notice_count( $all_notices = array(), $notice_type = '' ) {
		$notice_count = 0;

		if ( isset( $all_notices[$notice_type] ) ) {
			$notice_count = absint( sizeof( $all_notices[$notice_type] ) );
		} elseif ( empty( $notice_type ) ) {
			foreach ( $all_notices as $notices ) {
				$notice_count += absint( sizeof( $all_notices ) );
			}
		}

		return $notice_count;
	}

	/**
	 * Adjust highlighted menu.
	 *
	 * @param type $file
	 * @return type
	 */
	public function submenu_file( $submenu_file, $parent_file ) {
		global $menu, $submenu;

		if ( $parent_file == 'iubenda' ) {
			$tab_key = ! empty( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'cs';

			if ( $tab_key == 'cons' ) {
				$submenu_file = 'admin.php?page=iubenda&tab=cons';
				$submenu['iubenda'][1][2] = 'admin.php?page=iubenda&tab=cons';
			}
		}

        return $submenu_file;
	}

	/**
	 * Sanitize array helper function.
	 *
	 * @param array $array
	 * @return array
	 */
	public function array_map_callback( $array ) {
		if ( ! is_array( $array ) )
			return array();

		return array_map( 'esc_attr', $array );
	}

}
