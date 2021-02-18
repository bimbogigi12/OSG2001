( function( $ ) {
	'use strict';

	window.evolvethemes_customizer_typography_control = window.evolvethemes_customizer_typography_control || {};
	window.evolvethemes_customizer_typography_control.controls = window.evolvethemes_customizer_typography_control.controls || {};

	/**
	 * Customizer font family instance component.
	 * Usage:
	 *
	 * <evolvethemes-customizer-font-family-instance></evolvethemes-customizer-font-family-instance>
	 */
	window.evolvethemes_customizer_typography_control.controls.font_family_instance = {

		template: '#evolvethemes-customizer-font-family-instance',

		props: [ 'value', 'id', 'label', 'families', '_defaults' ],

		created: function() {
			if ( typeof this._defaults !== 'undefined' ) {
				if ( typeof this._defaults['letter-spacing'] === 'undefined' || ! this._defaults['letter-spacing'] ) {
					this._defaults['letter-spacing'] = '0';
				}

				if ( typeof this._defaults['line-height'] === 'undefined' || ! this._defaults['line-height'] ) {
					this._defaults['line-height'] = '1em';
				}

				if ( typeof this._defaults['font-size'] === 'undefined' || ! this._defaults['font-size'] ) {
					this._defaults['font-size'] = '1em';
				}
			}

			if ( ! this.value.variant ) {
				if ( typeof this._defaults !== 'undefined' && this._defaults.variant ) {
					this.value.variant = this._defaults.variant;
				}
				else {
					this.value.variant = 'regular';
				}
			}

			if ( ! this.value.font_family && typeof this._defaults !== 'undefined' && this._defaults.font_family ) {
				this.value.font_family = this._defaults.font_family;
			}
		},
		methods: {
			toggleFamilyInstance: function() {
				$( '.evolvethemes-font-family-instance.evolvethemes-fc-exp' ).removeClass( 'evolvethemes-fc-exp' );
				$( this.$el ).toggleClass( 'evolvethemes-fc-exp' );
			},
			changeFamily: function() {
				var families = this.families,
					family = this.value.font_family,
					variants = this.getFamilyVariants( families, family ),
					variant = this.value.variant;

				if ( ! family ) {
					return;
				}

				if ( families[family].source === 'google_fonts' ) {
					if ( ( variant && variants.indexOf( variant ) === -1 ) || variants.length === 0 ) {
						this.value.variant = 'regular';
					}
				}
			},
			getFamilyVariants: function( families, family ) {
				var variants = [];

				if ( ! family ) {
					return variants;
				}

				if ( families[family].source === 'google_fonts' ) {
					variants = families[family].google_fonts.variants ? families[family].google_fonts.variants.split( ',' ) : [ '' ];

					if ( variants.length === 1 && variants[0] === '' ) {
						variants = [ 'regular' ];
					}
				}
				else {
					variants = [
						'100',
						'100italic',
						'200',
						'200italic',
						'300',
						'300italic',
						'regular',
						'italic',
						'500',
						'500italic',
						'600',
						'600italic',
						'700',
						'700italic',
						'800',
						'800italic',
						'900',
						'900italic'
					];
				}

				return variants;
			}
		},
		computed: {
			fontInfo: function() {
				var font_size = '',
					line_height = '';

				if ( this.value['font-size'] ) {
					font_size = this.value['font-size'];
				}
				else {
					if ( typeof this._defaults !== 'undefined' && this._defaults['font-size'] ) {
						font_size = this._defaults['font-size'];
					}
				}

				if ( this.value['line-height'] ) {
					line_height = this.value['line-height'];
				}
				else {
					if ( typeof this._defaults !== 'undefined' && this._defaults['line-height'] ) {
						line_height = this._defaults['line-height'];
					}
				}

				return font_size + ' / ' + line_height;
			}
		},
		updated: function() {
			this.$emit( 'input', this.value );
		}

	};

} )( jQuery );
