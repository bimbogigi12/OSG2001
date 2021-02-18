( function( $ ) {
	'use strict';

	window.evolvethemes_customizer_typography_control = window.evolvethemes_customizer_typography_control || {};
	window.evolvethemes_customizer_typography_control.controls = window.evolvethemes_customizer_typography_control.controls || {};

	/**
	 * Get a list of Google Fonts.
	 *
	 * @since 1.0.0
	 * @return {object}
	 */
	function evolvethemes_customizer_get_google_fonts() {
		return window.evolvethemes_customizer_typography_control.google_fonts;
	}

	/**
	 * Get a list of Google Fonts to be used in a multiple select.
	 *
	 * @since 1.0.0
	 * @return {object}
	 */
	function evolvethemes_customizer_google_fonts_for_select() {
		var fonts = [];

		$.each( evolvethemes_customizer_get_google_fonts(), function( family ) {
			fonts.push( {
				label: family,
				value: family,
				category: this.category,
				variants: this.variants,
				subsets: this.subsets
			} );
		} );

		return fonts;
	}

	/**
	 * Customizer font family selector component.
	 * Usage:
	 *
	 * <evolvethemes-customizer-font-family></evolvethemes-customizer-font-family>
	 */
	window.evolvethemes_customizer_typography_control.controls.font_family = {

		template: '#evolvethemes-customizer-font-family',

		props: [
			'value',
			'id',
			'label',
			'_id'
		],

		data: function () {
			return {
				'_variants': '',
				'_subsets': ''
			};
		},

		methods: {
			getFontFamiliesForSelect: function() {
				return evolvethemes_customizer_google_fonts_for_select();
			},
			remove: function() {
				this.$emit( 'removefontfamily', this._id );
			},
			toggleFamilyInstance: function() {
				$( this.$el ).siblings().removeClass( 'evolvethemes-fc-exp' );
				$( this.$el ).toggleClass( 'evolvethemes-fc-exp' );
			},
			getFontSources: function() {
				var sources = [],
					self = this;

				$.each( window.evolvethemes_customizer_typography_control.font_sources, function() {
					var s = JSON.parse( JSON.stringify( this ) );
					s.id = self.id + '_' + s.id;

					sources.push( s );
				} );

				return sources;
			},
			refreshGoogleFont: function( family ) {
				this.refreshGoogleFontVariants( family );
				this.refreshGoogleFontSubsets( family );
			},
			refreshGoogleFontSubsets: function( family ) {
				var s = $( '.evolvethemes-font-subsets [data-evolvethemes-select-input]', this.$el )[0].selectize,
					val = s.getValue();

				if ( val ) {
					this.$data._subsets = '' + val;
				}

				var select_options = [];

				$.each( this._googleFontSubsets(), function( i, val ) {
					select_options.push( {
						label: val,
						value: val
					} );
				} );

				s.clearOptions();
				s.addOption( select_options );

				if ( family ) {
					s.setValue( this.$data._subsets.split( ',' ) );
					this.$data._subsets = '';
				}
			},
			refreshGoogleFontVariants: function( family ) {
				var s = $( '.evolvethemes-font-variants [data-evolvethemes-select-input]', this.$el )[0].selectize,
					val = s.getValue();

				if ( val ) {
					this.$data._variants = '' + val;
				}

				var select_options = [];

				$.each( this._googleFontVariants(), function( i, val ) {
					select_options.push( {
						label: val,
						value: val
					} );
				} );

				s.clearOptions();
				s.addOption( select_options );

				if ( family ) {
					s.setValue( this.$data._variants.split( ',' ) );
					this.$data._variants = '';
				}
			},
			_googleFontVariants: function() {
				var fonts = evolvethemes_customizer_get_google_fonts();

				if ( this.value.google_fonts.font_family && typeof fonts[this.value.google_fonts.font_family] !== 'undefined' ) {
					return fonts[this.value.google_fonts.font_family].variants;
				}

				return [];
			},
			_googleFontSubsets: function() {
				var fonts = evolvethemes_customizer_get_google_fonts();

				if ( this.value.google_fonts.font_family && typeof fonts[this.value.google_fonts.font_family] !== 'undefined' ) {
					return fonts[this.value.google_fonts.font_family].subsets;
				}

				return [];
			},
			normalizeFamilyInstances: function() {
				if ( this.value.source === 'google_fonts' ) {
					if ( this.value.google_fonts.variants === '' ) {
						var s = $( '.evolvethemes-font-variants [data-evolvethemes-select-input]', this.$el )[0].selectize;
						s.addItem( 'regular' );

						this.$emit( 'refresh_google_fonts_variants', {} );
					}
				}
			}
		},
		computed: {
			googleFontVariants: function() {
				return this._googleFontVariants();
			},
			googleFontSubsets: function() {
				return this._googleFontSubsets();
			},
			familyInfo: function() {
				var family = this.value[ this.value.source ] ? this.value[ this.value.source ].font_family : '';

				return family;
			}
		},
		updated: function() {
			this.normalizeFamilyInstances();

			this.$emit( 'input', this.value );
		}

	};

} )( jQuery );
