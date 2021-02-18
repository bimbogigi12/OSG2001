( function( $ ) {
	"use strict";

	var Crowley_Brix = function() {

		var self = this;

		/**
		 * Event binding.
		 */
		this.bind = function() {
		};

		/**
		 * Initialization.
		 */
		this.init = function() {
			self.bind();

			if ( $( 'body' ).hasClass( 'crowley-sidebar-active' ) ) {
				window.brix_extended_section_offset = $( window ).width() - $( ".crowley-c" ).outerWidth() - $( ".crowley-c" ).offset().left - 24;
				window.brix_extended_section_offset_position = "right";
			}
		};

		this.init();

	};

	( new Crowley_Brix() );

} )( jQuery );
