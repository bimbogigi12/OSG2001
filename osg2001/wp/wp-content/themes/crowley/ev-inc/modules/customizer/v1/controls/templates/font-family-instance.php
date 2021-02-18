<?php
/**
 * Customizer Font Family Instance Control template.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\customizer\v1\controls\templates
 * @since 1.0.0
 * @version 1.0.0
 */

?>
<script type="text/x-template" id="evolvethemes-customizer-font-family-instance">
	<div class="evolvethemes-font-family-instance evolvethemes-fc-m">
		<div class="evolvethemes-fc-h" v-on:click="toggleFamilyInstance">
			<span class="evolvethemes-fc-l">{{ this.label }}</span>
			<span class="evolvethemes-fc-lh">{{ fontInfo }}</span>
			<span class="evolvethemes-fc-e">
				<span class="evolvethemes-fc-ie"><?php evolvethemes_svg( 'inc/res/img/edit.svg' ); ?></span>
				<span class="evolvethemes-fc-ic"><?php evolvethemes_svg( 'inc/res/img/close.svg' ); ?></span>
			</span>
		</div>

		<div class="evolvethemes-fc-c">
			<div class="evolvethemes-f">
				<label class="evolvethemes-f-l"><?php esc_html_e( 'Family', 'crowley' ); ?></label>
				<select v-model="value['font-family']" v-on:change="changeFamily">
					<option v-for="( family, key ) in families" v-bind:value="key">{{ family.label }}</option>
				</select>
			</div>

			<div v-if="value['font-family'] != '' && families[value['font-family']]">
				<div class="evolvethemes-f" v-if="families[value['font-family']].source == 'google_fonts' || families[value['font-family']].source == 'typekit'">
					<label class="evolvethemes-f-l"><?php esc_html_e( 'Variant', 'crowley' ); ?></label>

					<select class="evolvethemes-fi-v" v-model="value.variant">
						<option v-for="variant in getFamilyVariants( families, value['font-family'] )" v-bind:value="variant">{{ variant }}</option>
					</select>
				</div>

				<div class="evolvethemes-fc-fpr">
					<div class="evolvethemes-f">
						<label class="evolvethemes-f-l"><?php esc_html_e( 'Size', 'crowley' ); ?></label>
						<input type="text" v-model="value['font-size']" v-bind:placeholder="this._defaults['font-size']">
					</div>
					<div class="evolvethemes-f">
						<label class="evolvethemes-f-l"><?php esc_html_e( 'Height', 'crowley' ); ?></label>
						<input type="text" v-model="value['line-height']" v-bind:placeholder="this._defaults['line-height']">
					</div>
					<div class="evolvethemes-f">
						<label class="evolvethemes-f-l"><?php esc_html_e( 'Spacing', 'crowley' ); ?></label>
						<input type="text" v-model="value['letter-spacing']" v-bind:placeholder="this._defaults['letter-spacing']">
					</div>
				</div>

				<div class="evolvethemes-f">
					<label class="evolvethemes-f-l"><?php esc_html_e( 'Transform', 'crowley' ); ?></label>
					<select v-model="value['text-transform']">
						<option value="none"><?php esc_html_e( 'None', 'crowley' ); ?></option>
						<option value="uppercase"><?php esc_html_e( 'Uppercase', 'crowley' ); ?></option>
						<option value="lowercase"><?php esc_html_e( 'Lowercase', 'crowley' ); ?></option>
						<option value="capitalize"><?php esc_html_e( 'Capitalize', 'crowley' ); ?></option>
					</select>
				</div>
			</div>
		</div>

	</div>
</script>
