( function() {
	'use strict';

	/**
	 * Checkbox component.
	 * Usage:
	 *
	 * <evolvethemes-checkbox v-model="" label="" id=""></evolvethemes-checkbox>
	 */
	Vue.component( 'evolvethemes-checkbox', {
		template: '\
			<div class="evolvethemes-checkbox">\
				<input type="checkbox" v-bind:id="id" v-bind:checked="value == true" v-on:change="updateValue( $event.target.checked )">\
				<label v-bind:for="id"><span class="screen-reader-text">{{ label }}</span></label>\
			</div>\
		',
		props: [ 'value', 'id', 'label' ],
		methods: {
			updateValue: function( v ) {
				this.value = ( v === true );

				this.$emit( 'input', this.value );
			}
		}
	} );
} )( jQuery );
