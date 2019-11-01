( function ( $ ) {

    $( document ).ready( function () {
	
	// read more option
	$( '#iub_parse' ).change( function () {
		if ( $( this ).is(':checked') ) {
			$( '#iub_parser_engine_container' ).slideDown( 'fast' );
		} else {
			$( '#iub_parser_engine_container' ).slideUp( 'fast' );
		}
	} );
	
	// move notices
	var errors = $( '.settings-error' ).detach();
	
	$( '.iubenda-link' ).after( errors );
		
    } );

} )( jQuery );