( function( window, factory ) {
	if ( typeof module === 'object' && module.exports ) {
		module.exports.FontsLoadr = factory();
	}
	else {
		window.FontsLoadr = factory();
	}
} )( typeof window !== 'undefined' ? window : this, function() {
	'use strict';

	var self = {};

	/**
	 * Configuration.
	 */
	self.config = {};

	/**
	 * Load a font from a custom upload.
	 *
	 * @since 1.0.0
	 * @param {Object} font The font object.
	 */
	self.load_custom_font = function( font, webfontloader_config ) {
		if ( typeof webfontloader_config.custom === 'undefined' ) {
			webfontloader_config.custom = {
				families: [],
				urls: []
			};
		}

		if ( font.custom.url ) {
			webfontloader_config.custom.families.push( font.custom.font_family );
			webfontloader_config.custom.urls.push( font.custom.url );
		}
	};

	/**
	 * Load a font from the Typekit service.
	 *
	 * @since 1.0.0
	 * @param {Object} font The font object.
	 */
	self.load_typekit_font = function( font, webfontloader_config ) {
		if ( typeof webfontloader_config.typekit === 'undefined' ) {
			webfontloader_config.typekit = {
				id: ''
			};
		}

		if ( font.typekit.kitId ) {
			webfontloader_config.typekit.id = font.typekit.kitId;
		}
	};

	/**
	 * Load a font from the Google Fonts service.
	 *
	 * @since 1.0.0
	 * @param {Object} font The font object.
	 */
	self.load_google_font = function( font, webfontloader_config ) {
		if ( typeof webfontloader_config.google === 'undefined' ) {
			webfontloader_config.google = {
				families: []
			};
		}

		var load = font.google_fonts.font_family;

		if ( font.google_fonts.variants ) {
			load += ':' + font.google_fonts.variants;
		}

		if ( font.google_fonts.subsets ) {
			load += ':' + font.google_fonts.subsets;
		}

		webfontloader_config.google.families.push( load );
	};

	/**
	 * Begin the loading process.
	 */
	self.load = function() {
		var webfontloader_config = {
			/**
			 * All fonts have loaded callback.
			 */
			'active': function() {
				var event = new CustomEvent( 'evolvethemes-fonts-active' );

				window.document.documentElement.dispatchEvent( event );
			},

			/**
			 * No fonts have loaded callback.
			 */
			'inactive': function() {
				var event = new CustomEvent( 'evolvethemes-fonts-inactive' );

				window.document.documentElement.dispatchEvent( event );
			}
		};

		self.config.forEach( function( font ) {
			switch ( font.source ) {
				case 'google_fonts':
					self.load_google_font( font, webfontloader_config );
					break;
				case 'typekit':
					self.load_typekit_font( font, webfontloader_config );
					break;
				case 'custom':
					self.load_custom_font( font, webfontloader_config );
					break;
				default:
					break;
			}
		} );

		if ( typeof WebFont !== 'undefined' ) {
			WebFont.load( webfontloader_config ); // jshint ignore:line
		}
	};

	/**
	 * Initialization.
	 */
	self.init = function( config ) {
		self.config = config;

		( function() {
			function CustomEvent( event, params ) {
				params = params || { bubbles: false, cancelable: false, detail: undefined };
				var evt = document.createEvent( 'CustomEvent' );
				evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
				return evt;
			}

			CustomEvent.prototype = window.Event.prototype;

			window.CustomEvent = CustomEvent;
		} )();

		self.load();
	};

	return self;

} );
