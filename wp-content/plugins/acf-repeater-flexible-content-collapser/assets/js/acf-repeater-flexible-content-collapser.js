jQuery(document).ready(function($) {

	var allRows;

 	var acf_settings_collapse = acf.model.extend({
 		
 		actions: {
 			'open_field':			'render_fields'
 		},

		events: {
			'change .hide-collapse':		'change_collapse',
		},

		render_fields: function(){
			
			var self = this;
			
			$('.acf-field-object.open').each(function(){
					
				self.render_field( $(this) );
				
			});	
			
		},

		render_field: function( $field ){

			// vars
			var $input = $field.find('.hide-collapse'),
				checked = $input.prop('checked'),
				$td = $input.closest('.acf-field');

 		 	if( checked ) {
 		 		
 		 		$td.siblings('[data-name*="collapse_all"]').hide();
 		 		$td.siblings('[data-name="btn-icon-only"]').hide();
 		 	
 		 	} else {
		
				$td.siblings('[data-name*="collapse_all"]').show();
				$td.siblings('[data-name="btn-icon-only"]').show();
			
			}
		},
 				
 		change_collapse: function( e ){
 			
 			// bail early if not correct field type
 			if( e.$field.attr('data-type') != 'repeater' && e.$field.attr('data-type') != 'flexible_content' ) {
 				
 				return;
 				
 			}

 			// vars
 			var $input = e.$el,
 				checked = e.$el.prop('checked'),
 				$td = $input.closest('.acf-field');

 		 	if( checked ) {
 		 		
 		 		$td.siblings('[data-name*="collapse_all"]').hide();
 		 		$td.siblings('[data-name="btn-icon-only"]').hide();
 		 	
 		 	} else {
		
				$td.siblings('[data-name*="collapse_all"]').show();
				$td.siblings('[data-name="btn-icon-only"]').show();
			
			}
 			// clear name
 			// $el.find('.acf-field[data-name="name"] input').val('').trigger('change');
 			
 		}
 		
 	});

	/**
	 * set up the buttons on the entire form
	 */
	function acfRepeaterCollapserInit() {
		// HTML to put above each repeater instance & flexible instance
		collapseRepeaterButton = '<button type="button" role="button" class="button field-repeater-toggle field-repeater-toggle-all"><span>'+collapsetranslation.collapseAll+'</span></button>';
		collapseFlexButton = '<button type="button" role="button" class="button field-flexible-toggle field-flexible-toggle-all"><span>'+collapsetranslation.collapseAll+'</span></button>';

		// find each repeater instance and add the button
		$('.acf-field-repeater').each( function() {
			repeater = $(this);

			repeater.children('.acf-input').children('.acf-repeater').each(function() {
				
				allRows = repeater.children('.acf-input').children('.acf-repeater').children('.acf-table').children('tbody');
				
				if ( repeater.hasClass('repeater-collapse') ) {
					repeater.prepend( collapseRepeaterButton );
				}

				if ( repeater.hasClass('collapse-all') ) {
					allRows.children('.acf-row').not('.acf-clone').each( function() {
						$(this).addClass('-collapsed');
					});
				}
			});
			
			if ( allRows.children('.acf-row').not('.acf-clone').length == allRows.children('.acf-row.-collapsed').not('.acf-clone').length ) {
				button = repeater.find('.field-repeater-toggle');
				button.addClass('collapsed-row');
				button.find('span').text(collapsetranslation.expandAll);
			}
		});

		// Bind click event to the button for the Repeater Fields
		$('.field-repeater-toggle-all').live('click', function() {
			button = $(this);
			theRepeater = button.parent().children('.acf-input').children('.acf-repeater');
			theRows = theRepeater.children('.acf-table').children('tbody').children('.acf-row').not('.acf-clone');
			colspan = theRows.children('.acf-field').length / theRows.length;

			if ( button.hasClass('collapsed-row') ) {
				button.removeClass('collapsed-row');
				button.find('span').text(collapsetranslation.collapseAll);
				theRows.removeClass('-collapsed');
				theRows.find('.acf-field.-collapsed-target').removeAttr('colspan');
			} else {
				button.addClass('collapsed-row');
				button.find('span').text(collapsetranslation.expandAll);
				theRows.addClass('-collapsed');
				if ( theRepeater.hasClass('-table') ) {
					theRows.children('.acf-field.-collapsed-target').attr('colspan', colspan);
				}
			}

			// prevent bubbling up to parent repeater rowset
			event.stopPropagation();
		});

		// find each flexible instance and add the button
		$('.acf-field-flexible-content').each( function() {
			affectedFlexible = $(this);
			affectedFlexible.data('acf-rowset-collapsed', false).attr('aria-expanded', false);
				
			if ( affectedFlexible.hasClass('flexible-collapse') ) {
				affectedFlexible.prepend( collapseFlexButton ).data('acf-rowset-collapsed', false);
			}

			

			allRows	= affectedFlexible.children('.acf-input').children('.acf-flexible-content').children('.values');

			if ( affectedFlexible.hasClass('collapse-all') ) {
				allRows.children('.layout').each( function() {
					$(this).addClass('-collapsed');
				});
			}

			if ( allRows.children('.layout').length == allRows.children('.layout.-collapsed').length  ) {
				button = affectedFlexible.find('.field-flexible-toggle-all');
				button.addClass('collapsed-row');
				button.find('span').text(collapsetranslation.expandAll);
			}

		});

		// Bind click event to the button for the Flexible Content Fields
		$('.field-flexible-toggle-all').live('click', function() {
			button = $(this);
			theFlex = button.parent().children('.acf-input').children('.acf-flexible-content');
			theRows = theFlex.children('.values').children('.layout');

			if ( button.hasClass('collapsed-row') ) {
				button.removeClass('collapsed-row');
				button.find('span').text(collapsetranslation.collapseAll);
				theRows.removeClass('-collapsed');
			} else {
				button.addClass('collapsed-row');
				button.find('span').text(collapsetranslation.expandAll);
				theRows.addClass('-collapsed');				
			}

			// prevent bubbling up to parent repeater rowset
			event.stopPropagation();
		});
	}

	// Initiatilize the plugin
	acfRepeaterCollapserInit();


});
