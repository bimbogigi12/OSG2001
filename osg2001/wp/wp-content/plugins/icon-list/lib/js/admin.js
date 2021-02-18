/*
 * Elegant Posts Widget Admin v1.0
 * TemplateByte.com
 *
 * Copyright (c) 2017 TemplateByte.com
 *
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 */

( function( $ ) {
	"use strict";

	var kamnIconList = {

		// Tab Init
		tabInit: function() {

			// Location Hash
			var locationHash = ( 'undefined' !== typeof( Cookies.get( 'kamn-iconlist-tab' ) ) )? Cookies.get( 'kamn-iconlist-tab' ) : window.location.hash;

			// Tab Panel
			if ( '' !== locationHash ) {

				kamnIconList.tabPanel( locationHash );

			}

		},

		// Tab Click
		tabClick: function() {

			// Tab Control
			$( '.nav-tab' ).off( 'click' ).on( 'click', function( e ) {

				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// Location Hash
				var locationHash = $( this ).attr( 'href' );

				// Tab Panel
				kamnIconList.tabPanel( locationHash );

			} );

		},

		// Tab Panel
		tabPanel: function( locationHash  ) {

			// Set Cookie
			Cookies.set( 'kamn-iconlist-tab', locationHash );

			// Expected Hash Format: #top#general
			var targetHash      = locationHash.split( '#top' );
			var targetTabPanel  = targetHash[1];
			var targetTab       = targetTabPanel + '-tab';

			// Tab Logic
			$( '.nav-tab' ).removeClass( 'nav-tab-active' );
			$( targetTab ).addClass( 'nav-tab-active' );

			// Tab Panel Logic
			$( '.nav-tab-section' ).hide();
			$( targetTabPanel ).show();

			// Change Location
			window.location.hash = locationHash;

		}

	};

	// Document Ready
	$( document ).ready( function() {

		// Tab Init
		kamnIconList.tabInit();

		// Tab Click
		kamnIconList.tabClick();

	} );

} )( jQuery );
