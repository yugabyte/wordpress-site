jQuery(document).ready(function($) {
    // field - open in a new tab
	jQuery( '#wpcf7-redirect-open-in-new-tab' ).change(function() {
        if ( jQuery( this ).is( ":checked" ) ) {
            jQuery( '.field-notice-alert' ).removeClass( 'field-notice-hidden' );
        } else {
        	jQuery( '.field-notice-alert' ).addClass( 'field-notice-hidden' );
        }
    });

    if ( jQuery( '#wpcf7-redirect-open-in-new-tab' ).is( ":checked" ) ) {
    	jQuery( '.field-notice-alert' ).removeClass( 'field-notice-hidden' );
    }

    // fields - http build query
    jQuery( '#wpcf7-redirect-http-build-query-selectively' ).change(function() {
        if ( jQuery( this ).is( ":checked" ) ) {
            jQuery( '#wpcf7-redirect-http-build-query-selectively-fields' ).removeClass( 'field-hidden' );
        }
    });

    jQuery( '#wpcf7-redirect-http-build-query' ).change(function() {
        if ( jQuery( this ).is( ":checked" ) ) {
            jQuery( '#wpcf7-redirect-http-build-query-selectively-fields' ).addClass( 'field-hidden' );
        }
    });

    if ( jQuery( '#wpcf7-redirect-http-build-query-selectively' ).is( ":checked" ) ) {
        jQuery( '#wpcf7-redirect-http-build-query-selectively-fields' ).removeClass( 'field-hidden' );
    }

    jQuery('.checkbox-radio-1').change(function() {
        var checked = jQuery(this).is(':checked');
        jQuery('.checkbox-radio-1').prop('checked', false);
        if ( checked ) {
            jQuery(this).prop('checked',true);
        } 
    });

    // field - after sent script
    jQuery( '#wpcf7-redirect-after-sent-script' ).keyup(function(event) {
        if ( jQuery(this).val().length != 0 ) {
            jQuery( '.field-warning-alert' ).removeClass( 'field-notice-hidden' );
        } else {
            jQuery( '.field-warning-alert' ).addClass( 'field-notice-hidden' );
        }
    });

    if ( jQuery( '#wpcf7-redirect-after-sent-script' ).val() ) {
        jQuery( '.field-warning-alert' ).removeClass( 'field-notice-hidden' );
    }
});
