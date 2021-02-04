( function ( $ ) {

	$( document ).ready( function () {
		
		var iubendaConsentSolution = new function () {
			var _this = this;
			
			// parse args
			var args = $.parseJSON( iubForms );

			// console.log( args );

			// get forms
			this.init = function () {
				// loop though plugins
				if ( $( args ).length > 0 ) {
					$.each( args, function( source, forms ) {
						// loop through forms
						if ( $( forms ).length > 0 ) {
							$.each( forms, function( id, form ) {
								// console.log( form );

								// get corresponding html form id
								switch ( source ) {

									// WooCommerce Checkout Form
									case 'woocommerce' :
										var htmlFormContainer = $( '.woocommerce-checkout' );

										// form exists, let's use it
										if ( htmlFormContainer.length > 0 ) {
											// setup vars
											formArgs = {
												submitElement: null,
												form: {
													selector: document.querySelectorAll( 'form.woocommerce-checkout' )[0],
													map: form.form.map
												}
											};

											// handle ajax submit
											$( htmlFormContainer ).on( 'checkout_place_order', function( e ) {
												_this.submitForm( form, formArgs );
												
												_iub.cons.sendData();
												// don't send before page refresh
												// on succcessfull submit it will be sent automatically
												// _iub.cons.sendFromLocalStorage();
											} );
										}

										break;

									// WordPress Comment Form
									case 'wp_comment_form' :
										var htmlFormContainer = $( '#commentform' );

										// form exists, let's use it
										if ( htmlFormContainer.length > 0 ) {
											// adjust submit element id
											var submitElement = document.getElementById( htmlFormContainer.attr( 'id' ) ).querySelectorAll( 'input[type=submit]' )[0];

											/* id="submit" override
											if ( typeof submitElement !== 'undefined' && submitElement.name == 'submit' ) {
												submitElement.id = 'wp-comment-submit';
												submitElement.name = 'wp-comment-submit';
											}
											*/

											// setup vars
											formArgs = {
												// submitElement: submitElement,
												submitElement: null,
												form: {
													selector: document.getElementById( htmlFormContainer.attr( 'id' ) ),
													map: form.form.map
												}
											};

											$( submitElement ).on( 'click touchstart', function( e ) {
												_this.submitForm( form, formArgs );
													
												_iub.cons.sendData();
												// don't send before page refresh
												// on succcessfull submit it will be sent automatically
												// _iub.cons.sendFromLocalStorage();
											} );
										}

										break;

									// Contact Form 7
									case 'wpcf7' :
										// var regex = new RegExp( '^wpcf7-f([0-9]*)-' );
										var htmlFormContainer = $( 'div[id^="wpcf7-f' + id + '-"]' );

										// form exists, let's use it
										if ( htmlFormContainer.length > 0 ) {
											var selector = document.getElementById( htmlFormContainer.attr( 'id' ) ).getElementsByClassName( 'wpcf7-form' )[0];

											// handle ajax submit
											$( document ).on( 'wpcf7mailsent', selector, function( e ) {
												// setup vars
												formArgs = {
													// submitElement: document.getElementById( htmlFormContainer.attr( 'id' ) ).getElementsByClassName( 'wpcf7-submit' )[0],
													submitElement: null,
													form: {
														selector: selector,
														map: form.form.map
													}
												};

												// send only if specific form has been submitted
												if ( selector.parentElement.id == e.target.id ) {
													_this.submitForm( form, formArgs );
													
													_iub.cons.sendData();
													_iub.cons.sendFromLocalStorage();
												}
											} );

										};

										break;

									// WP Forms
									case 'wpforms' :
										var htmlFormContainer = $( 'div[id^="wpforms-' + id + '"]' );

										// form exists, let's use it
										if ( htmlFormContainer.length > 0 ) {
											var selector = document.getElementById( 'wpforms-form-' + id );
											var isAjax = $( '#wpforms-form-' + id ).hasClass( 'wpforms-ajax-form' );

											// handle ajax submit
											$( document ).on( 'wpformsAjaxSubmitSuccess', selector, function( e ) {
												// setup vars
												formArgs = {
													submitElement: ( isAjax ? null : document.getElementById( 'wpforms-submit-' + id ) ),
													form: {
														selector: selector,
														map: form.form.map
													}
												};

												// send only if specific form has been submitted
												if ( selector.id == e.target.id ) {
													_this.submitForm( form, formArgs );
													
													_iub.cons.sendData();
													_iub.cons.sendFromLocalStorage();
												}
											} );
										};

										break;
								}
								
								// console.log( source );

							} );
						}
					} );
				}
			};
			
			// submit form
			this.submitForm = function ( form, formArgs ) {
				// push consent vars
				if ( typeof form.consent !== 'undefined' && form.consent.legal_notices.length > 0 ) {
					formArgs.consent = {};
					formArgs.consent.legal_notices = form.consent.legal_notices;
				}

				console.log( formArgs );

				// build form consent data
				_iub.cons_instructions.push( [ 'load', formArgs ]	);
			};
			
		};
		
		// initialize
		iubendaConsentSolution.init();
		
	} );

} )( jQuery );