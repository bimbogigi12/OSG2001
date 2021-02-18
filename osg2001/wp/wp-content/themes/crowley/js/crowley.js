( function( $ ) {
	'use strict';

	/**
	 * Main theme object.
	 */
	var EvolveThemes_Crowley = function() {

		var self = this;

		/**
		 * Load fonts.
		 */
		this.load_fonts = function() {
			if ( typeof window.FontsLoadr === 'undefined' ) {
				return;
			}

			if ( typeof window.crowley.fonts === 'undefined' ) {
				return;
			}

			if ( typeof window.Preloadr !== 'undefined' ) {
				window.document.documentElement.addEventListener( 'evolvethemes-fonts-active', function() {
					window.Preloadr.complete( 'fonts' );
				} );

				window.document.documentElement.addEventListener( 'evolvethemes-fonts-inactive', function() {
					window.Preloadr.complete( 'fonts' );
				} );
			}

			window.FontsLoadr.init( window.crowley.fonts );
		};

		/**
		 * Correctly size embeds.
		 */
		this.size_embeds = function() {
			$( '.crowley-mc-content' ).fitVids();
		};

		/**
		 * Load images.
		 */
		this.load_images = function() {
			if ( typeof window.ImgLoadr === 'undefined' ) {
				return;
			}

			window.ImgLoadr.size();
			window.ImgLoadr.load();
		};

		/**
		 * Initialize the preloader.
		 */
		this.init_preloader = function() {
			if ( typeof window.Preloadr === 'undefined' ) {
				return;
			}

			if ( typeof window.crowley.preloader === 'undefined' ) {
				return;
			}

			window.Preloadr.init( window.crowley.preloader );
		};

		/**
		 * Event binding.
		 */
		this.bind = function() {
			/* Initialize the preloader. */
			self.init_preloader();

			/* Load fonts. */
			self.load_fonts();

			/* Load images. */
			self.load_images();

			/* Size embeds. */
			self.size_embeds();
		};

		/**
		 * Initialization.
		 */
		this.init = function() {
			self.bind();
		};

		this.init();

	};

	( window.crowley.controller = new EvolveThemes_Crowley() );

} )( jQuery );
