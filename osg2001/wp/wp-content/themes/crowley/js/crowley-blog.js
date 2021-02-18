( function() {
	'use strict';

	/**
	 * Blog object.
	 */
	var EvolveThemes_Crowley_Blog = function() {

		var self = this;

		/**
		 * Masonry instance.
		 */
		this.masonry = null;

		/**
		 * Comments container.
		 */
		this.comments_container = document.querySelector( '#comments' );

		/**
		 * Comments trigger.
		 */
		this.comments_trigger = document.querySelector( '.crowley-c-trigger a' );

		/**
		 * Layout.
		 */
		this.layout = function() {
			if ( ! document.querySelector( '.crowley-l-w' ) ) {
				return;
			}

			self.masonry = new Masonry( '.crowley-l-w', { // jshint ignore:line
				itemSelector: '.hentry',
				columnWidth: '.crowley-sizer',
				transitionDuration: 0
			} );

			if ( typeof window.Preloadr !== 'undefined' ) {
				self.masonry.on( 'layoutComplete', function() {
					window.Preloadr.complete( 'blog' );
				} );

				self.masonry.layout();
			}
		};

		/**
		 * Expand hidden threaded comments.
		 */
		this.expandComments = function( e ) {
			if ( e.target.matches( '.children, .children *' ) ) {
				e.stopPropagation();

				self.comments_container.classList.remove( 'crowley-comments-hidden' );
				self.comments_container.removeEventListener( 'click', self.expandComments );
			}
		};

		/**
		 * Event binding.
		 */
		this.bind = function() {
			if ( this.comments_container ) {
				this.comments_container.addEventListener( 'click', self.expandComments );
			}

			/**
			 * Open the comments section.
			 */
			if ( this.comments_trigger ) {
				this.comments_trigger.addEventListener( 'click', function() {
					document.body.classList.add( 'crowley-comments-open' );
				} );
			}
		};

		/**
		 * Initialization.
		 */
		this.init = function() {
			self.bind();
			self.layout();
		};

		this.init();

	};

	( new EvolveThemes_Crowley_Blog() );

} )();
