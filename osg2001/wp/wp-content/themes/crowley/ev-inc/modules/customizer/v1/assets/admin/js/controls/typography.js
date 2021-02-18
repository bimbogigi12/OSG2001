( function( $, Vue ) {
	'use strict';

	var EvolveThemes_Customizer_Typography_Control = function() {

		var self = this;

		/**
		 * Loaded status.
		 */
		self.loaded = false;

		/**
		 * Control instance.
		 */
		self.instance = null;

		/**
		 * Object cloning.
		 */
		this.clone = function( obj, extend ) {
			var clone = JSON.parse( JSON.stringify( obj ) );

			if ( extend ) {
				clone = $.extend( {}, clone, extend );
			}

			return clone;
		};

		/**
		 * Load the control.
		 */
		this.load = function() {
			if ( self.loaded ) {
				return;
			}

			self.loaded = true;

			self.instance = new Vue( {

				el: '.evolvethemes-typography',

				data: window.evolvethemes_customizer_typography_control.data,

				components: {
					'evolvethemes-customizer-font-family-instance': window.evolvethemes_customizer_typography_control.controls.font_family_instance,
					'evolvethemes-customizer-font-family': window.evolvethemes_customizer_typography_control.controls.font_family
				},

				methods: {
					addFamily: function() {
						var d = new Date().getTime(),
							label = window.prompt( window.evolvethemes_customizer_typography_control.strings.family_label_ask , '' ),
							id = 'font-family-' + d,
							family_data = self.clone( window.evolvethemes_customizer_typography_control.family_default_data, {
								'label': label,
								'google_fonts': {
									'font_family': 'Open Sans',
									'variants': 'regular',
									'subsets': ''
								}
							} );

						if ( label ) {
							Vue.set( this.families, id, family_data );

							Vue.nextTick( function() {
								$( '.evolvethemes-font-family.evolvethemes-fc-exp' ).removeClass( 'evolvethemes-fc-exp' );
								$( '.evolvethemes-font-family' ).last().addClass( 'evolvethemes-fc-exp' );
							} );
						}
					},
					removeFamily: function( id ) {
						var self = this;

						Vue.delete( this.families, id ); // jshint ignore:line

						if ( this.$data.instances ) {
							$.each( this.$data.instances, function( key, obj ) {
								if ( typeof self.$data.families[ obj.data['font-family'] ] === 'undefined' ) {
									var family_keys = Object.keys( self.$data.families );

									Vue.set( obj.data, 'font-family', family_keys[ 0 ] );

									return false;
								}
							} );
						}
					},
					getFamilyLabel: function( id ) {
						var label = this.families[id].label;

						if ( label ) {
							return label;
						}

						return id;
					},
					refreshGoogleFontVariants: function( instances ) {
						var self = this;

						$.each( instances, function( group, instance ) {
							$.each( instance, function( key, obj ) {
								if ( obj.font_family && self.$data.families[ obj.font_family ].source === 'google_fonts' ) {
									Vue.set( obj, 'variant', 'regular' );
								}
							} );
						} );

						$( '.evolvethemes-fi-v' ).each( function() {
							if ( $( this ).children().length === 1 ) {
								$( this ).val( $( this ).children().first().attr( 'value' ) );
							}
						} );
					},
					updateControl: function() {
						var $control = $( this.$el ).parents( '.customize-control' ).first(),
							_data = self.clone( this.$data );

						$.each( _data.instances, function() {
							delete this._defaults;

							$.each( this, function() {
								delete this._defaults;
							} );
						} );

						$( '[data-customize-setting-link]', $control )
							.val( JSON.stringify( _data ) )
							.trigger( 'change' );
					}
				}

			} );
		};

		/**
		 * Event binding.
		 */
		this.bind = function() {
			if ( typeof wp.customize !== 'undefined' ) {
				wp.customize.bind( 'pane-contents-reflowed', self.load, false );
			}
		};

		/**
		 * Initialization.
		 */
		this.init = function() {
			self.bind();
		};

		this.init();

	};

	( new EvolveThemes_Customizer_Typography_Control() );

} )( jQuery, Vue || {} );
