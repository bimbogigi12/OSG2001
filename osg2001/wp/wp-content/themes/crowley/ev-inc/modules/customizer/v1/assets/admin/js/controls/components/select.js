( function( $ ) {
	'use strict';

	/**
	 * Select component.
	 * Usage:
	 *
	 * <evolvethemes-select v-model="" options="" class="" max=""></evolvethemes-select>
	 */
	Vue.component( 'evolvethemes-select', {
		template: '\
			<div class="evolvethemes-select">\
				<input data-evolvethemes-select-input type="text">\
			</div>\
		',
		props: [ 'value', 'options', 'class', 'max' ],
		mounted: function() {
			var self = this,
				input = $( 'input', this.$el ),
				max = typeof this.max !== 'undefined' ? parseInt( this.max, 10 ) : null,
				plugins = [],
				select_options = [];

			if ( this[ 'class' ] ) {
				$( this.$el ).addClass( this[ 'class' ] );
			}

			if ( ! max ) {
				plugins = [ 'remove_button', 'drag_drop' ];
			}

			if ( this.options.length ) {
				if ( typeof this.options[0].label === 'undefined' ) {
					$.each( this.options, function( i, val ) {
						select_options.push( {
							label: val,
							value: val
						} );
					} );
				}
				else {
					select_options = this.options;
				}
			}

			input.val( this.value );

			input.selectize( {
				plugins: plugins,
				maxItems: max,
				valueField: 'value',
				labelField: 'label',
				searchField: [ 'label', 'value' ],
				options: select_options,
				// dropdownParent: "body",
				onChange: function( value ) {
					self.value = value;
					self.emit();
				},
				hideSelected: true
			} );
		},
		methods: {
			emit: function() {
				this.$emit( 'input', this.value );
			}
		}
	} );
} )( jQuery );
