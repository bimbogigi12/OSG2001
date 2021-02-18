( function() {
	'use strict';

	/**
	 * Gradient component.
	 * Usage:
	 *
	 * <evolvethemes-gradient v-model="" opacity="" id=""></evolvethemes-gradient>
	 */
	Vue.component( 'evolvethemes-gradient', {
		template: '\
			<div class="evolvethemes-gradient">\
				<div class="evolvethemes-g-h">\
				<span class="evolvethemes-f-l">{{ inc_components.gradient.color }}</span>\
					<span class="evolvethemes-f-l">{{ inc_components.gradient.location }}</span>\
				</div>\
				<div class="evolvethemes-g-cs" v-for="color in this.value.steps">\
					<evolvethemes-color v-bind:opacity="opacity" v-bind:value="color"></evolvethemes-color>\
					<input type="number" min="0" max="100" v-model="color.position">\
				</div>\
				<span class="evolvethemes-f-l">{{ inc_components.gradient.direction }}</span>\
				<evolvethemes-graphic-radio v-model="value.direction" class="evolvethemes-f-gr-horz evolvethemes-f-g-direction" v-bind:options="inc_components.gradient.directions[id]"></evolvethemes-graphic-radio>\
			</div>\
		',
		props: [ 'value', 'opacity', 'id' ],
		data: function () {
			return {};
		}
	} );
} )( jQuery );
