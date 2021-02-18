( function() {
	'use strict';

	/**
	 * Graphic radio component.
	 * Usage:
	 *
	 * <evolvethemes-graphic-radio v-model="" options="" class=""></evolvethemes-graphic-radio>
	 */
	Vue.component( 'evolvethemes-graphic-radio', {
		template: '\
			<div class="evolvethemes-graphic-radio" v-bind:class="this.class">\
				<div v-bind:data-value="option.value" v-for="option in this.options" v-if="isOptionVisible( option.value )">\
					<input v-bind:checked="value === option.value" v-on:change="updateValue( $event.target.value )" v-bind:id="option.id" v-bind:class="getInputClass( option.label )" type="radio" v-bind:value="option.value">\
					<label v-bind:for="option.id" v-html="option.label"></label>\
				</div>\
			</div>\
		',
		props: [ 'value', 'options', 'class', 'visibility' ],
		methods: {
			isOptionVisible: function( v ) {
				if ( typeof this.visibility !== 'undefined' && typeof this.visibility[ v ] !== 'undefined' ) {
					return this.visibility[ v ];
				}

				return true;
			},
			getInputClass: function( label ) {
				var classname = [ 'evolvethemes-f-gr' ],
					isHTML = RegExp.prototype.test.bind(/(<([^>]+)>)/i);

				if ( ! isHTML( label ) ) {
					classname.push( 'evolvethemes-f-gr-t' );
				}

				return classname.join( ' ' );
			},
			updateValue: function( v ) {
				this.value = v;

				this.$emit( 'input', this.value );
				this.$emit( 'change', this.value );
			}
		}
	} );
} )( jQuery );
