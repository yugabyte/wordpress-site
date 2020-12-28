<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * iubenda_Forms class.
 *
 * @class iubenda_Forms
 */
class iubenda_Forms {

	public $sources = array();
	public $statuses = array();

	/**
	 * Class constructor.
	 */
	public function __construct() {
		// actions
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_post_status' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}

	/**
	 * Initialize forms data.
	 *
	 * @return void
	 */
	public function init() {
		// WOrdPress commenting form
		$this->sources['wp_comment_form'] = 'WordPress Comment';

		// check if Contact Form 7 is active
		if ( class_exists( 'WPCF7' ) ) {
			$this->sources['wpcf7'] = 'Contact Form 7';
		}
		
		// check if WP Forms is active
		if ( function_exists( 'wpforms' ) ) {
			$this->sources['wpforms'] = 'WP Forms';
		}
		
		// check if EooCommerce is active
		if ( function_exists( 'WC' ) ) {
			$this->sources['woocommerce'] = 'WooCommerce Checkout';
		}

		$this->sources = apply_filters( 'iub_supported_form_sources', $this->sources );

		$this->statuses = array(
			'publish'		=> _x( 'To Map', 'post status', 'iubenda' ),
			'mapped'		=> _x( 'Mapped', 'post status', 'iubenda' ),
			'needs_update'	=> _x( 'Needs Update', 'post status', 'iubenda' ),
			// 'trash'			=> _x( 'Ignored', 'post status', 'iubenda' )
		);
	}

	/**
	 * Enqueue frontend script.
	 */
	public function wp_enqueue_scripts() {
		if ( ! empty( iubenda()->options['cons']['public_api_key'] ) ) {
			wp_register_script( 'iubenda-forms', IUBENDA_PLUGIN_URL . '/js/frontend.js', array( 'jquery' ), iubenda()->version, true );

			$args = array();

			$form_args = array(
				'post_status'	=> array( 'mapped', 'needs_update' )
			);

			$forms = $this->get_forms( $form_args );
			
			// echo '<pre>'; print_r( $forms ); echo '</pre>';

			if ( ! empty( $forms ) ) {
				// required form parameters
				$form_parameters = array(
					'subject',
					'preferences',
					'exclude',
					'legal_notices'
				);
				// loop through forms
				foreach ( $forms as $form ) {
					// bail if user is logged in and source is WP comment form
					if ( $form->form_source == 'wp_comment_form' && is_user_logged_in() )
						continue;

					// we need unique identifier for the html form
					// by default it's object id, used in form html id
					$args[$form->form_source][$form->object_id] = array();

					foreach ( $form_parameters as $parameter ) {
						$parameter_name = 'form_' . $parameter;
						$parameter_value = ! empty( $form->$parameter_name ) ? $form->$parameter_name : '';
						
						// echo '<pre>'; print_r( $parameter_value ); echo '</pre>';

						switch ( $parameter ) {
							case 'legal_notices' :
								if ( $parameter_value && is_array( $parameter_value ) ) {
									foreach( $parameter_value as $value ) {
										$args[$form->form_source][$form->object_id]['consent']['legal_notices'][] = array( 'identifier' => $value );
									}
								}
								break;
							default :
								if ( $parameter_value ) {
									switch ( $form->form_source ) {
										case 'wpforms' :
											// replace integers with field names
											foreach ( $parameter_value as $index => $parameter_item ) {
												$parameter_value[$index] = $form->form_fields[$parameter_item]['name'];
											}
											$args[$form->form_source][$form->object_id]['form']['map'][$parameter] = $parameter_value;
											break;
										default :
											$args[$form->form_source][$form->object_id]['form']['map'][$parameter] = $parameter_value;
											break;
									}
								}
								break;
						}
					}
				}
			}

			// echo '<pre>'; print_r( $args ); echo '</pre>'; exit;

			wp_localize_script(
				'iubenda-forms',
				'iubForms',
				json_encode( $args )
			);

			wp_enqueue_script( 'iubenda-forms' );
		}
	}

	/**
	 * Register iubenda form post type.
	 */
	public function register_post_type() {
		register_post_type( 'iubenda_form', array(
			'labels'			 => array(
				'name'			 => __( 'Forms', 'iubenda' ),
				'singular_name'	 => __( 'Form', 'iubenda' ),
			),
			'rewrite'			 => false,
			'query_var'			 => false,
			'public'			 => false,
			'capability_type'	 => 'page'
		) );
	}

	/**
	 * Register iubenda form post status.
	 */
	public function register_post_status() {
		foreach ( $this->statuses as $name => $label ) {
			if ( $name === 'publish' )
				continue;

			register_post_status( $name, array(
				'label'                     => $label,
				'public'                    => true,
				'exclude_from_search'       => false,
				'show_in_admin_all_list'    => true,
				'show_in_admin_status_list' => true,
				'post_type'                 => array( 'iubenda_form' ),
				// 'label_count'               => _n_noop( 'Mapped <span class="count">(%s)</span>', 'Mapped <span class="count">(%s)</span>', 'iubenda' ),
			) );
		}

	}

	/**
	 * Get iubenda forms function.
	 *
	 * @param type $args
	 * @return array
	 */
	public function get_forms( $args = array() ) {
		$defaults = array(
			'post_status'	 => 'any',
			'posts_per_page' => -1,
			'offset'		 => 0,
			'orderby'		 => 'ID',
			'order'			 => 'ASC',
			'form_source'	 => 'any'
		);

		$args = wp_parse_args( $args, $defaults );

		$args['post_type'] = 'iubenda_form';

		// specific sources only
		if ( $args['form_source'] != 'any' && ( is_string( $args['form_source'] ) || is_array( $args['form_source'] ) ) ) {
			$args['meta_query'] = array(
				array(
					'key'		 => '_iub_form_source',
					'value'		 => $args['form_source'],
					'compare'	 => 'IN',
				),
			);
		}

		$q = new WP_Query();

		$posts = $q->query( $args );

		$metakeys = array(
			'form_source',
			'object_type',
			'object_id',
			'form_fields',
			'form_subject',
			'form_preferences',
			'form_exclude',
			'form_legal_notices'
		);

		if ( ! empty( $posts ) ) {
			foreach ( $posts as $index => $post ) {
				// get form data
				$metadata_raw = get_metadata( 'post', $post->ID );

				foreach ( $metakeys as $metakey ) {
					$metadata = ! empty( $metadata_raw['_iub_' . $metakey][0] ) ? maybe_unserialize( $metadata_raw['_iub_' . $metakey][0] ) : '';

					if ( ! empty( $metadata ) ) {
						 // unset empty values
						if ( is_array( $metadata ) ) {
							foreach ( $metadata as $metadata_key => $metadata_value ) {
								if ( $metadata_value == '' && ! in_array( $metakey, array( 'form_legal_notices' ) ) )
								   unset( $metadata[$metadata_key] );
							}
						}

						 $posts[$index]->{$metakey} = $metadata;
					}
					/* object id needs to ba an integer
					} elseif ( in_array( $metakey, array( 'object_id' ) ) ) {
						$posts[$index]->{$metakey} = ! empty( $metadata ) ? absint( $metadata ) : 0;
					}
					*/
				}
			}
		}

		return $posts;
	}

	/**
	 * Get form function.
	 *
	 * @param int
	 * @return object
	 */
	public function get_form( $id ) {
		$form_id = ! empty( $id ) ? absint( $id ) : 0;

		if ( ! $form_id )
			return false;

		$form = get_post( $form_id );

		if ( ! $form )
			return false;

		$metakeys = array(
			'form_source',
			'object_type',
			'object_id',
			'form_fields',
			'form_subject',
			'form_preferences',
			'form_exclude',
			'form_legal_notices'
		);

		// get form data
		$metadata = get_metadata( 'post', $form->ID );

		foreach ( $metakeys as $metakey ) {
			$form->{$metakey} = ! empty( $metadata['_iub_' . $metakey][0] ) ? maybe_unserialize( $metadata['_iub_' . $metakey][0] ) : '';
		}

		return $form;
	}

	/**
	 * Delete form function.
	 *
	 * @param int
	 * @return int
	 */
	public function delete_form( $id ) {
		$form_id = ! empty( $id ) ? absint( $id ) : 0;

		if ( ! $form_id )
			return false;

		$form = get_post( $form_id );

		if ( ! $form )
			return false;

		$result = wp_delete_post( $id, true );

		return $result;
	}

	/**
	 * Insert form function.
	 *
	 * @param array $args
	 * @return int
	 */
	public function save_form( $args = array() ) {
		$defaults = array(
			'ID'					=> 0,
			'status'				=> 'publish',
			'object_type'			=> 'post', // object type where the form data is stored
			'object_id'				=> 0, // unique object id
			'form_source'			=> '', // source slug
			'form_title'			=> '', // form title
			'form_date'				=> current_time( 'mysql' ), // form last modified date
			'form_fields'			=> array(), // form field names array
			'form_subject'			=> array(), // mapped form with iubenda consent subject param
			'form_preferences'		=> array(), // mapped form with iubenda consent preferences param
			'form_exclude'			=> array(), // mapped form with iubenda consent exclude param
			'form_legal_notices'	=> array() // form legal notices
		);

		$args = wp_parse_args( $args, $defaults );

		// sanitize args
		$args['ID'] = ! empty( $args['ID'] ) ? absint( $args['ID'] ) : 0;
		$args['status'] = ! empty( $args['status'] ) && in_array( $args['status'], array_keys( $this->statuses ) ) ? $args['status'] : 'publish';
		$args['object_type'] = 'post';
		$args['object_id'] = ! empty( $args['object_id'] ) ? (int) $args['object_id'] : 0;
		$args['form_source'] = ! empty( $args['form_source'] ) && in_array( $args['form_source'], array_keys( $this->sources ) ) ? $args['form_source'] : '';
		$args['form_title'] = ! empty( $args['form_title'] ) ? esc_html( $args['form_title'] ) : '';
		$args['form_date'] = date( 'Y-m-d H:i:s', ( ! empty( $args['form_date'] ) ? strtotime( $args['form_date'] ) : current_time( 'mysql' ) ) );
		$args['form_fields'] = ! empty( $args['form_fields'] ) && is_array( $args['form_fields'] ) ? $args['form_fields'] : array();
		$args['form_subject'] = ! empty( $args['form_subject'] ) && is_array( $args['form_subject'] ) ? array_map( 'esc_attr', $args['form_subject'] ) : array();
		$args['form_preferences'] = ! empty( $args['form_preferences'] ) && is_array( $args['form_preferences'] ) ? array_map( 'esc_attr', $args['form_preferences'] ) : array();
		$args['form_exclude'] = ! empty( $args['form_exclude'] ) && is_array( $args['form_exclude'] ) ? array_map( 'esc_attr', $args['form_exclude'] ) : array();
		$args['form_legal_notices'] = ! empty( $args['form_legal_notices'] ) && is_array( $args['form_legal_notices'] ) ? array_map( 'esc_attr', $args['form_legal_notices'] ) : array();
		
		$form_fields = array();
		
		// sanitize form fields
		if ( ! empty( $args['form_fields'] ) && is_array( $args['form_fields'] ) ) {
			foreach ( $args['form_fields'] as $form_field ) {
				if ( ! empty( $form_field ) && is_array( $form_field ) ) {
					$form_fields[] = array_map( 'esc_attr', $form_field );
				} else {
					$form_fields[] = esc_attr( $form_field );
				}
			}
		}
		
		// echo '<pre>'; print_r( $args ); echo '</pre>'; exit;

		// bail if any issues
		if ( ! $args['form_source'] || ! $args['form_fields'] )
			return false;

		$post = $args['ID'] !== 0 ? get_post( $args['ID'] ) : false;
		$update = empty( $post ) ? false : true;

		// insert new form
		if ( ! $update ) {
			$post_id = wp_insert_post( array(
				'post_type'		=> 'iubenda_form',
				'post_status'	=> $args['status'],
				'post_title'	=> $args['form_title'],
				'post_content'	=> '',
				'post_date'		=> $args['form_date'],
				'post_modified'	=> $args['form_date']
			) );
			// update form
		} else {
			$post_id = wp_update_post( array(
				'ID'			=> $args['ID'],
				'post_status'	=> $args['status'],
				'post_modified'	=> $args['form_date']
			) );
		}

		// save form source
		if ( isset( $args['form_source'] ) )
			update_post_meta( $post_id, '_iub_form_source', $args['form_source'] );

		// save object type
		if ( isset( $args['object_type'] ) )
			update_post_meta( $post_id, '_iub_object_type', $args['object_type'] );

		// save object id
		if ( isset( $args['object_id'] ) )
			update_post_meta( $post_id, '_iub_object_id', absint( $args['object_id'] ) );

		// save form fields
		if ( isset( $args['form_fields'] ) )
			update_post_meta( $post_id, '_iub_form_fields', $form_fields );

		// save form subject
		if ( isset( $args['form_subject'] ) )
			update_post_meta( $post_id, '_iub_form_subject', $args['form_subject'] );

		// save form preferences
		if ( isset( $args['form_preferences'] ) )
			update_post_meta( $post_id, '_iub_form_preferences', $args['form_preferences'] );

		// save form exclude
		if ( isset( $args['form_exclude'] ) )
			update_post_meta( $post_id, '_iub_form_exclude', $args['form_exclude'] );

		// save legal notices
		if ( isset( $args['form_legal_notices'] ) )
			update_post_meta( $post_id, '_iub_form_legal_notices', $args['form_legal_notices'] );

		return $post_id;
	}

	/**
	 * Autodetect forms action.
	 *
	 * @return bool
	 */
	public function autodetect_forms() {
		$found_forms = $new_forms = array();

		// get forms from active sources
		if ( ! empty( $this->sources ) ) {
			foreach ( $this->sources as $source => $source_name ) {
				$found_forms[$source] = call_user_func( array( $this, 'get_source_forms' ), $source );
			}
		}

		// insert forms
		if ( ! empty( $found_forms ) ) {
			foreach ( $found_forms as $source => $source_forms ) {
				if ( ! empty( $source_forms ) ) {

					foreach ( $source_forms as $formdata ) {

						$exists = $this->get_form_by_object_id( array(
							'id'		=> $formdata['object_id'],
							'source'	=> $formdata['form_source']
						) );

						// form does not exist
						if ( ! $exists ) {
							$result = $this->save_form( $formdata );

							if ( $result )
								$new_forms['new'] = $result;
						} else {
							// check for fields changes
							$new_fields = array_merge( array_diff( $formdata['form_fields'], $exists->form_fields ), array_diff( $exists->form_fields, $formdata['form_fields'] ) );
							
							if ( $new_fields ) {
								$new_forms['updated'] = $exists->ID;
								
								// update form
								$formdata['ID'] = $exists->ID;
								
								// update to need status if form is already mapped
								if ( $exists->post_status == 'mapped' )
									$formdata['status'] = 'needs_update';
								
								// echo '<pre>'; print_r( $formdata ); echo '</pre>'; exit;
								
								$result = $this->save_form( $formdata );
							}
						}
					}
				}
			}
		}

		// echo '<pre>'; print_r( $found_forms ); echo '</pre>'; exit;

		return ! empty( $new_forms ) ? $new_forms : array();
	}

	/**
	 * Get source forms.
	 *
	 * @param string
	 * @return array
	 */
	public function get_source_forms( $source = '' ) {
		$source = ! empty( $source ) && in_array( $source, array_keys( $this->sources ) ) ? $source : '';
		$forms = array();

		$restricted_fields = apply_filters( "iub_{$source}_restricted_fields", array(
			'submit',
			'file',
			'quiz'
		) );

		switch ( $source ) {
			case 'wpforms' :
				$args = array(
					'post_type'		 => 'wpforms',
					'no_found_rows'	 => true,
					'nopaging'       => true,
				);
				$posts = get_posts( $args );
	
				// echo '<pre>'; print_r( $posts ); echo '</pre>'; exit;

				if ( ! empty( $posts ) ) {
					foreach ( $posts as $post ) {
						// get form data
						$formdata = array(
							'object_type'	 => 'post', // object type where the form data is stored
							'object_id'		 => $post->ID, // unique object id
							'form_source'	 => $source, // source slug
							'form_title'	 => $post->post_title, // form title
							'form_date'		 => $post->post_modified, // form last modified date
							'form_fields'	 => array() // form field names array
						);

						$input_fields = array(
							'text',
							'textarea',
							'select',
							'radio',
							'checkbox',
							'gdpr-checkbox',
							'email',
							'address',
							'url',
							'name',
							'hidden',
							'date-time',
							'phone',
							'number',
						);

						$fields_raw = function_exists( 'wpforms_get_form_fields' ) ? wpforms_get_form_fields( $post->ID ) : false;

						// echo '<pre>'; print_r( $fields_raw ); echo '</pre>'; exit;

						if ( ! empty( $fields_raw ) ) {
							foreach ( $fields_raw as $index => $field ) {
								// specific field types only
								if ( ! empty( $field['type'] ) && in_array( $field['type'], $input_fields ) ) {
									switch ( $field['type'] ) {
										case 'name' :
											if ( ! empty( $field['format'] ) ) {
												switch ( $field['format'] ) {
													case 'first-last' :
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . '][first]',
															'type'	=> $field['type'],
															'label'	=> __( 'First name', 'iubenda' )
														);
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . '][last]',
															'type'	=> $field['type'],
															'label'	=> __( 'Last name', 'iubenda' )
														);
														break;
													case 'first-middle-last' :
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . '][first]',
															'type'	=> $field['type'],
															'label'	=> __( 'First name', 'iubenda' )
														);
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . '][middle]',
															'type'	=> $field['type'],
															'label'	=> __( 'Middle name', 'iubenda' )
														);
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . '][last]',
															'type'	=> $field['type'],
															'label'	=> __( 'Last name', 'iubenda' )
														);
														break;
													default :
														$formdata['form_fields'][] = array(
															'id'	=> $field['id'],
															'name'	=> 'wpforms[fields][' . $index . ']',
															'type'	=> $field['type'],
															'label'	=> $field['label']
														);
														break;
												}
											} else {
												$formdata['form_fields'][] = array(
													'id'	=> $field['id'],
													'name'	=> 'wpforms[fields][' . $index . ']',
													'type'	=> $field['type'],
													'label'	=> $field['label']
												);
											}
											break;
										// fix multiple choice checkbox
										case 'checkbox' :
											$formdata['form_fields'][] = array(
												'id'	=> $field['id'],
												'name'	=> 'wpforms[fields][' . $index . '][]',
												'type'	=> $field['type'],
												'label'	=> $field['label']
											);
											break;
										default : 
											$formdata['form_fields'][] = array(
												'id'	=> $field['id'],
												'name'	=> 'wpforms[fields][' . $index . ']',
												'type'	=> $field['type'],
												'label'	=> $field['label']
											);
									}
									
								}
							}
						}

						$forms[] = $formdata;
					}

					// echo '<pre>'; print_r( $forms ); echo '</pre>'; exit;
				}

				break;
			
			case 'wpcf7' :
				$args = array(
					'post_type'		 => 'wpcf7_contact_form',
					'posts_per_page' => -1
				);
				$posts = get_posts( $args );

				if ( ! empty( $posts ) ) {
					foreach ( $posts as $post ) {
						// get form data
						$contact_form = class_exists( 'WPCF7_ContactForm' ) ? WPCF7_ContactForm::get_instance( $post->ID ) : false;

						if ( ! empty( $contact_form ) ) {
							$formdata = array(
								'object_type'	 => 'post', // object type where the form data is stored
								'object_id'		 => $post->ID, // unique object id
								'form_source'	 => $source, // source slug
								'form_title'	 => $post->post_title, // form title
								'form_date'		 => $post->post_modified, // form last modified date
								'form_fields'	 => array() // form field names array
							);

							$fields_raw = $contact_form->scan_form_tags();

							// echo '<pre>'; print_r( $fields_raw ); echo '</pre>'; exit;

							if ( ! empty( $fields_raw ) ) {
								foreach ( $fields_raw as $field ) {
									// specific field types only
									if ( ! empty( $field['basetype'] ) && ! in_array( $field['basetype'], $restricted_fields ) ) {
										$formdata['form_fields'][] = $field['name'];
									}
								}
							}

							$forms[] = $formdata;
						}

						// echo '<pre>'; print_r( $contact_form ); echo '</pre>'; exit;
					}
				}

				break;
				
			case 'woocommerce' :
				$checkout_form = '';

				ob_start();
				
				// Ensure gateways and shipping methods are loaded early.
				WC()->payment_gateways();
				WC()->shipping();
				
				/*
				 * First lets start the session. You cant use here WC_Session directly
				 * because it's an abstract class. But you can use WC_Session_Handler which
				 * extends WC_Session
				 */
				WC()->session = new WC_Session_Handler;

				/*
				 * Next lets create a customer so we can access checkout fields
				 * If you will check a constructor for WC_Customer class you will see
				 * that if you will not provide user to create customer it will use some
				 * default one. Magic.
				 */
				WC()->customer = new WC_Customer;

				// Create a cart contents
				WC()->cart  = new WC_Cart;
				
				// Create an abstract order
				WC()->order  = new WC_Order;

				wc_get_template(
					'checkout/form-checkout.php', array(
						'checkout' => WC()->checkout()
					)
				);
				
				wc_get_template(
					'checkout/form-pay.php', array(
						'order' => WC()->order
					)
				);

				$checkout_form = ob_get_contents();
				ob_end_clean();
				
				if ( ! empty( $checkout_form ) ) {
					$formdata = array(
						'object_type'	 => 'custom', // object type where the form data is stored
						'object_id'		 => 0, // unique object id
						'form_source'	 => $source, // source slug
						'form_title'	 => $this->sources[$source], // form title
						'form_date'		 => current_time( 'mysql' ), // form last modified date
						'form_fields'	 => array() // form field names array
					);

					$input_fields = array(
						'input',
						'textarea',
						'select'
					);
					
					// DOMDoc parser
					if ( iubenda()->options['cs']['parser_engine'] == 'new' ) {
						libxml_use_internal_errors( true );

						$document = new DOMDocument();

						// set document arguments
						$document->formatOutput = true;
						$document->preserveWhiteSpace = false;

						// load HTML
						$document->loadHTML( $checkout_form );

						// search for nodes
						foreach ( $input_fields as $input_field ) {
							$fields_raw = $document->getElementsByTagName( $input_field );

							if ( ! empty( $fields_raw ) && is_object( $fields_raw ) ) {
								foreach ( $fields_raw as $field ) {
									$field_name = $field->getAttribute( 'name' );
									$field_type = $field->getAttribute( 'type' );

									// exclude submit
									if ( ! empty( $field_type ) && ! in_array( $field_type, array( 'submit', 'hidden' ) ) )
										$formdata['form_fields'][] = $field->getAttribute( 'name' );
								}
							}
						}

						$forms[] = $formdata;

						libxml_use_internal_errors( false );

					// Simple HTML Dom parser
					} else {
						$html = str_get_html( $checkout_form, $lowercase = true, $force_tags_closed = true, $strip = false );

						if ( is_object( $html ) ) {
							// search for nodes
							foreach ( $input_fields as $input_field ) {
								$fields_raw = $html->find( $input_field );

								if ( is_array( $fields_raw ) ) {
									foreach ( $fields_raw as $field ) {
										$field_name = $field->name;
										$field_type = $field->type;

										// exclude submit
										if ( ! empty( $field_type ) && ! in_array( $field_type, array( 'submit', 'hidden' ) ) )
											$formdata['form_fields'][] = $field->getAttribute( 'name' );
									}
								}
							}

							$forms[] = $formdata;

						}
					}
					
				}

				/*
				echo '<pre>';
				print_r( $checkout_form );
				echo '</pre>';
				exit;
				*/
				break;

			case 'wp_comment_form' :
				$comment_form = '';
				
				// get comment form for logged out user
				$current_user_id = get_current_user_id();
				
				// get first post
				$post_args = array(
					'numberposts' => 1,
					'orderby' => 'ID',
					'order' => 'ASC',
					'fields' => 'ids'
				);
				
				$posts = get_posts( $post_args );
				
				// get comment form
				if ( ! empty( $posts ) ) {
					wp_set_current_user( 0 );

					ob_start();

					comment_form( array(), $posts[0] );

					$comment_form = ob_get_contents();
					ob_end_clean();

					wp_set_current_user( $current_user_id );
				}

				if ( ! empty( $comment_form ) ) {
					$formdata = array(
						'object_type'	 => 'custom', // object type where the form data is stored
						'object_id'		 => 0, // unique object id
						'form_source'	 => $source, // source slug
						'form_title'	 => $this->sources[$source], // form title
						'form_date'		 => current_time( 'mysql' ), // form last modified date
						'form_fields'	 => array() // form field names array
					);

					$input_fields = array(
						'input',
						'textarea',
						'select'
					);

					// DOMDoc parser
					if ( iubenda()->options['cs']['parser_engine'] == 'new' ) {
						libxml_use_internal_errors( true );

						$document = new DOMDocument();

						// set document arguments
						$document->formatOutput = true;
						$document->preserveWhiteSpace = false;

						// load HTML
						$document->loadHTML( $comment_form );

						// search for nodes
						foreach ( $input_fields as $input_field ) {
							$fields_raw = $document->getElementsByTagName( $input_field );

							if ( ! empty( $fields_raw ) && is_object( $fields_raw ) ) {
								foreach ( $fields_raw as $field ) {
									$field_name = $field->getAttribute( 'name' );
									$field_type = $field->getAttribute( 'type' );

									// exclude submit
									if ( ! empty( $field_type ) && ! in_array( $field_type, array( 'submit' ) ) )
										$formdata['form_fields'][] = $field->getAttribute( 'name' );
								}
							}
						}

						$forms[] = $formdata;

						libxml_use_internal_errors( false );

					// Simple HTML Dom parser
					} else {
						$html = str_get_html( $comment_form, $lowercase = true, $force_tags_closed = true, $strip = false );

						if ( is_object( $html ) ) {
							// search for nodes
							foreach ( $input_fields as $input_field ) {
								$fields_raw = $html->find( $input_field );

								if ( is_array( $fields_raw ) ) {
									foreach ( $fields_raw as $field ) {
										$field_name = $field->name;
										$field_type = $field->type;

										// exclude submit
										if ( ! empty( $field_type ) && ! in_array( $field_type, array( 'submit' ) ) )
											$formdata['form_fields'][] = $field->getAttribute( 'name' );
									}
								}
							}

							$forms[] = $formdata;

						}
					}
				}

				break;
		}

		return $forms;
	}

	/**
	 * Get Post object by post_meta query
	 *
	 * @return array
	 */
	public function get_form_by_object_id( $args = array() ) {
		// parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args );

		// grab page
		$args = array(
			'meta_query'	 => array(
				array(
					'key'	 => '_iub_object_id',
					'value'	 => $args['id'],
				),
				array(
					'key'	 => '_iub_form_source',
					'value'	 => $args['source'],
				)
			),
			'post_type'		 => 'iubenda_form',
			'post_status'	 => 'any',
			'posts_per_page' => '1',
			'fields'		 => 'ids'
		);

		// run query
		$posts = get_posts( $args );

		// check result
		if ( ! $posts || is_wp_error( $posts ) )
			return false;
		
		$form = $this->get_form( $posts[0] );

		// kick back results
		return $form;
	}

}
