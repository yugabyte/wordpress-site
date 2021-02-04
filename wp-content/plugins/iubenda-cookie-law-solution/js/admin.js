( function ( $ ) {

	$(function() {
		// parse args
		var args = $.parseJSON( iubAdminArgs );

		// parser options
		$( '#iub_parse' ).change( function () {
			if ( $( this ).is( ':checked' ) ) {
				$( '#iub_parser_engine_container' ).slideDown( 'fast' );
			} else {
				$( '#iub_parser_engine_container' ).slideUp( 'fast' );
			}
		} );

		// amp options
		$( '#iub_amp_support' ).change( function () {
			if ( $( this ).is( ':checked' ) ) {
				$( '#iub_amp_options_container' ).slideDown( 'fast' );
			} else {
				$( '#iub_amp_options_container' ).slideUp( 'fast' );
			}
		} );

		// amp options
		$( 'input.iub_amp_source' ).change( function () {
			var value = $( 'input.iub_amp_source:checked' ).val();

			if ( value === 'remote' ) {
				$( '#iub_amp_template-local' ).fadeOut( 'fast', function () {
					$( '#iub_amp_template-remote' ).fadeIn( 'fast' );
				} );
			} else {
				$( '#iub_amp_template-remote' ).fadeOut( 'fast', function () {
					$( '#iub_amp_template-local' ).fadeIn( 'fast' );
				} );
			}
		} );

		// move notices
		var errors = $( '.settings-error' ).detach();

		$( '.iubenda-link' ).after( errors );

		// Help tabs
		$( '.contextual-help-tabs a' ).off( 'click' ).click( function ( e ) {
			var link = $( this ),
				panel,
				panelParent;

			e.preventDefault();

			// don't do anything if the click is for the tab already showing.
			if ( link.is( '.active a' ) )
				return false;

			panelParent = link.closest( '.contextual-help-wrap' );

			// links
			$( panelParent ).find( '.contextual-help-tabs .active' ).removeClass( 'active' );
			link.parent( 'li' ).addClass( 'active' );

			panel = $( link.attr( 'href' ) );

			// panels
			$( panelParent ).find( '.help-tab-content' ).not( panel ).removeClass( 'active' ).hide();
			panel.addClass( 'active' ).show();
		} );

		// Preferences fields
		var preferencesID = $( '.preferences-field' ).length;

		// Add new preferences field
		$( document ).on( 'click', '.add-preferences-field', function ( e ) {
			e.preventDefault();

			$( '#postbox-container-2' ).change();

			var html = $( '#preferences-field-template' ).html();
			html = html.replace( /__PREFERENCE_ID__/g, preferencesID++ );

			$( '.preferences-table .add-preferences-field' ).closest( 'tr' ).before( '<tr class="preferences-field options-field" style="display: none;">' + html + '</tr>' );

			var last = $( '.preferences-field' ).last();

			last.fadeIn( 300 );
		} );

		// Remove preferences field
		$( document ).on( 'click', '.remove-preferences-field', function ( e ) {
			e.preventDefault();

			$( '#postbox-container-2' ).change();

			$( this ).closest( '.preferences-field' ).fadeOut( 300, function () {
				$( this ).remove();
			} );
		} );

		// Exclude fields
		var excludeID = $( '.exclude-field' ).length;

		// Add new preferences field
		$( document ).on( 'click', '.add-exclude-field', function ( e ) {
			e.preventDefault();

			console.log( this );

			$( '#postbox-container-2' ).change();

			var html = $( '#exclude-field-template' ).html();
			html = html.replace( /__EXCLUDE_ID__/g, excludeID++ );

			$( '.exclude-table .add-exclude-field' ).closest( 'tr' ).before( '<tr class="exclude-field options-field" style="display: none;">' + html + '</tr>' );

			var last = $( '.exclude-field' ).last();

			last.fadeIn( 300 );
		} );

		// Remove exclude field
		$( document ).on( 'click', '.remove-exclude-field', function ( e ) {
			e.preventDefault();

			$( '#postbox-container-2' ).change();

			$( this ).closest( '.exclude-field' ).fadeOut( 300, function () {
				$( this ).remove();
			} );
		} );

		// Legal notices fields
		var legalNoticesID = $( '.legal_notices-field' ).length;

		// Add new preferences field
		$( document ).on( 'click', '.add-legal_notices-field', function ( e ) {
			e.preventDefault();

			$( '#postbox-container-2' ).change();

			var html = $( '#legal_notices-field-template' ).html();
			html = html.replace( /__LEGAL_NOTICE_ID__/g, legalNoticesID++ );

			console.log( html );

			$( '.legal_notices-table .add-legal_notices-field' ).closest( 'tr' ).before( '<tr class="legal_notices-field options-field" style="display: none;">' + html + '</tr>' );

			var last = $( '.legal_notices-field' ).last();

			last.fadeIn( 300 );
		} );

		// Remove legal notices field
		$( document ).on( 'click', '.remove-legal_notices-field', function ( e ) {
			e.preventDefault();

			$( '#postbox-container-2' ).change();

			$( this ).closest( '.legal_notices-field' ).fadeOut( 300, function () {
				$( this ).remove();
			} );
		} );

		// add new script field
		$( document ).on( 'click', '.add-custom-script-field', function( e ) {
			e.preventDefault();

			$( this ).before( '<div class="custom-script-field" style="display: none;">' + $( '#custom-script-field-template' ).html() + '</div>' );
			$( '#tab-panel-scripts' ).find( '.custom-script-field' ).last().fadeIn( 300 );
		} );

		// remove custom script field
		$( document ).on( 'click', '.remove-custom-script-field', function( e ) {
			e.preventDefault();

			$( this ).closest( '.custom-script-field' ).fadeOut( 300, function() {
				$( this ).remove();
			} );
		} );

		// add new iframe field
		$( document ).on( 'click', '.add-custom-iframe-field', function( e ) {
			e.preventDefault();

			$( this ).before( '<div class="custom-iframe-field" style="display: none;">' + $( '#custom-iframe-field-template' ).html() + '</div>' );
			$( '#tab-panel-iframes' ).find( '.custom-iframe-field' ).last().fadeIn( 300 );
		} );

		// remove custom iframe field
		$( document ).on( 'click', '.remove-custom-iframe-field', function( e ) {
			e.preventDefault();

			$( this ).closest( '.custom-iframe-field' ).fadeOut( 300, function() {
				$( this ).remove();
			} );
		} );

		// Remove template fields on save
		$( document ).on( 'click', '#publish', function () {
			$( '#preferences-field-template' ).remove();
			$( '#exclude-field-template' ).remove();
			$( '#legal_notices-field-template' ).remove();
		} );

		// Confirm form delete
		$( document ).on( 'click', '#iubenda-consent-forms .delete-form', function () {
			return confirm( args.deleteForm );
		} );

		// Handle form fields data
		$( document ).on( 'change', '#postbox-container-2', function() {
			var fields = {},
				fieldsTypes = [ 'subject', 'preferences', 'exclude' ];

			if ( args.formId > 0 ) {
				// get all fields
				fields.all = $( '.subject-fields-select.select-id option:not([value=""])' ).map( function() { return $( this ).val(); } ).get();

				// get specific fields
				$.each( fieldsTypes, function( index, fieldType ) {
					fields[fieldType] = [];

					var fieldItems = $( '.' + fieldType + '-field select' );

					// get selected values
					$.each( fieldItems, function( index, item ) {
						if ( $( item ).val() != '' )
							fields[fieldType].push( $( item ).val() );
					} );

					fields.fieldType = $.unique( fields[fieldType] );

					// remove available fields if needed
					if ( fields[fieldType].length > 0 ) {

						// get options count
						var templateItemsCount = $( '.template-field .' + fieldType + '-fields-select option:disabled' ).length;

						// update if options count changed
						if ( templateItemsCount !== 0 && fields[fieldType].length != templateItemsCount ) {
							// console.log( fields[fieldType] );
						}

						// disable add button if needed
						if ( fields.all.length == fields[fieldType].length ) {
							$( '.add-' + fieldType + '-field' ).attr( 'disabled', 'disabled' );
						} else {
							$( '.add-' + fieldType + '-field' ).attr( 'disabled', false );
						}

						// adjust disabled options
						$.each( fields.all, function( index, fieldName ) {
							if ( $.inArray( fieldName, fields[fieldType] ) < 0 ) {
								// options field
								$( '.' + fieldType + '-fields-select option:not(:checked)[value="' + fieldName + '"]' ).attr( 'disabled', false );
								// template field
								$( '.template-field .' + fieldType + '-fields-select option[value="' + fieldName + '"]' ).attr( 'disabled', false );
							} else {
								$( '.' + fieldType + '-fields-select option:not(:checked)[value="' + fieldName + '"]' ).attr( 'disabled', 'disabled' );
								$( '.template-field .' + fieldType + '-fields-select option[value="' + fieldName + '"]' ).attr( 'disabled', 'disabled' );
							}
						} );
					}
				} );

				// console.log( fields );
			}

		} );

		// Force trigger change on document ready
		$( function() {	
			$( '#postbox-container-2' ).change();
		} );

		$( document ).on( 'mouseenter mouseleave', '#postbox-container-2 .options-field, #postbox-container-2 .submit-field', function() {
			$( '#postbox-container-2' ).change();
		} );

	} );

} )( jQuery );
