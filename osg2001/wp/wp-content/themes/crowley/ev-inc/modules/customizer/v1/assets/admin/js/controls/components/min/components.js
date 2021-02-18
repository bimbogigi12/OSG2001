( function( $ ) {
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
		props: [ "value", "id", "label" ],
		data: function () {
			return {}
		},
		methods: {
			updateValue: function( v ) {
				this.value = ( v === true );

				this.$emit( "input", this.value );
			}
		}
	} );
} )( jQuery );
;( function( $ ) {
	'use strict';

	/**
	 * Color component.
	 * Usage:
	 *
	 * <evolvethemes-color v-model="" opacity=""></evolvethemes-color>
	 */
	Vue.component( 'evolvethemes-color', {
		template: '\
			<div class="evolvethemes-color">\
				<input v-bind:value="value.color" v-bind:data-opacity="value.opacity" type="text">\
			</div>\
		',
		props: [ "value", "opacity" ],
		data: function() {
			return {
				color: "",
				opacity: ""
			}
		},
		mounted: function() {
			var self = this,
				input = $( "input", this.$el ),
				opacity = self.opacity == true || self.opacity === "true",
				format = opacity ? "rgb" : "hex";

			input.minicolors( {
				opacity: opacity,
				format: format,
				position: "top left",
				change: function( v, o ) {
					self.value.color = v;
					self.value.opacity = o;

					self.emit();
				}
			} );
		},
		methods: {
			emit: function() {
				this.$emit( "input", this.value );
			}
		}
	} );
} )( jQuery );
;( function( $ ) {
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
		props: [ "value", "opacity", "id" ],
		data: function () {
			return {}
		}
	} );
} )( jQuery );
;( function( $ ) {
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
		props: [ "value", "options", "class", "visibility" ],
		data: function () {
			return {}
		},
		methods: {
			isOptionVisible: function( v ) {
				if ( typeof this.visibility !== "undefined" && typeof this.visibility[ v ] !== "undefined" ) {
					return this.visibility[ v ];
				}

				return true;
			},
			getInputClass: function( label ) {
				var classname = [ "evolvethemes-f-gr" ],
					isHTML = RegExp.prototype.test.bind(/(<([^>]+)>)/i);

				if ( ! isHTML( label ) ) {
					classname.push( "evolvethemes-f-gr-t" );
				}

				return classname.join( " " );
			},
			updateValue: function( v ) {
				this.value = v;

				this.$emit( "input", this.value );
				this.$emit( "change", this.value );
			}
		}
	} );
} )( jQuery );
;( function( $ ) {
	'use strict';

	// if ( typeof window.Ev_MediaSelector === "undefined" ) {
	// 	return;
	// }

	/**
	 * Image upload component.
	 * Usage:
	 *
	 * <evolvethemes-image v-model="" load-label="" change-label="" remove-label="" preview-size=""></evolvethemes-image>
	 */
	Vue.component( 'evolvethemes-image', {
		template: '\
			<div class="evolvethemes-image">\
				<div class="evolvethemes-f-p_w">\
					<img v-bind:src="value._url" alt="">\
				</div>\
				<input type="hidden" v-model="value.id">\
				<button class="evolvethemes-btn" type="button" v-on:click="this.load">{{ empty ? loadLabel : changeLabel }}</button>\
				<button class="evolvethemes-btn evolvethemes-remove" type="button" v-on:click="this.remove" v-if="empty === false">{{ removeLabel }}</button>\
			</div>\
		',
		props: [ "value", "load-label", "change-label", "remove-label", "preview-size" ],
		data: function () {
			return {}
		},
		computed: {
			empty: function() {
				return this.value.id == "";
			},
			imgUrl: function() {
				var url = this.value._url;

				if ( url != "" ) {
					return url;
				}

				return "";
			}
		},
		methods: {
			emit: function() {
				this.$emit( "input", this.value );
			},
			load: function() {
				var self = this,
					media = new window.Ev_MediaSelector( {
					type: "image",
					multiple: false,
					select: function( selection ) {
						var image_url = "";

						if ( selection.sizes ) {
							if ( selection.sizes[ self.previewSize ] && selection.sizes[ self.previewSize ].url ) {
								image_url = selection.sizes[ self.previewSize ].url;
							}
							else if ( selection.sizes.full && selection.sizes.full.url ) {
								image_url = selection.sizes.full.url;
							}
						}
						else {
							image_url = selection.url;
						}

						self.value.id = selection.id;
						self.value._url = image_url;

						self.emit();
					}
				} );

				media.open( [ self.value.id ] );
			},
			remove: function() {
				this.value.id = "";
				this.value._url = "";

				this.emit();
			}
		}
	} );
} )( jQuery );
;( function( $ ) {
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
		props: [ "value", "options", "class", "max" ],
		data: function() {
			return {}
		},
		mounted: function() {
			var self = this,
				input = $( "input", this.$el ),
				max = typeof this.max !== "undefined" ? parseInt( this.max, 10 ) : null,
				plugins = [],
				select_options = [];

			if ( this.class ) {
				$( this.$el ).addClass( this.class );
			}

			if ( ! max ) {
				plugins = [ 'remove_button', 'drag_drop' ];
			}

			if ( this.options.length ) {
				if ( typeof this.options[0].label === "undefined" ) {
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
				this.$emit( "input", this.value );
			}
		}
	} );
} )( jQuery );
