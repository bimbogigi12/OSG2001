<?php
/**
 * Customizer Font Family Control template.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\customizer\v1\controls\templates
 * @since 1.0.0
 * @version 1.0.0
 */

?>
<script type="text/x-template" id="evolvethemes-customizer-font-family">
	<div class="evolvethemes-font-family evolvethemes-fc-m">
		<div class="evolvethemes-fc-h" v-on:click="toggleFamilyInstance">
			<span class="evolvethemes-fc-l">{{ value.label }}
				<button type="button" class="evolvethemes-fc-ir" v-on:click="remove" v-if="value._custom"><?php esc_html_e( 'Remove', 'crowley' ); ?></button>
			</span>
			<span class="evolvethemes-fc-lh">{{ familyInfo }}</span>
			<span class="evolvethemes-fc-e">
				<span class="evolvethemes-fc-ie"><?php evolvethemes_svg( 'inc/res/img/edit.svg' ); ?></span>
				<span class="evolvethemes-fc-ic"><?php evolvethemes_svg( 'inc/res/img/close.svg' ); ?></span>
			</span>
		</div>

		<div class="evolvethemes-fc-c">
			<div class="evolvethemes-f">
				<span class="evolvethemes-f-l"><?php esc_html_e( 'Label', 'crowley' ); ?></span>
				<input type="text" v-model="value.label">
			</div>

			<div class="evolvethemes-f">
				<evolvethemes-graphic-radio v-model="value.source" v-bind:options="getFontSources()" class="evolvethemes-f-gr-horz"></evolvethemes-graphic-radio>
			</div>

			<div v-if="value.source == 'google_fonts'">
				<div class="evolvethemes-f">
					<span class="evolvethemes-f-l"><?php esc_html_e( 'Family', 'crowley' ); ?></span>
					<evolvethemes-select v-model="value.google_fonts.font_family" v-on:input="refreshGoogleFont" v-bind:options="this.getFontFamiliesForSelect()" max="1"></evolvethemes-select>
				</div>

				<div v-show="value.google_fonts.font_family != ''">
					<div class="evolvethemes-f">
						<span class="evolvethemes-f-l"><?php esc_html_e( 'Variants', 'crowley' ); ?></span>
						<evolvethemes-select v-model="value.google_fonts.variants" v-bind:options="googleFontVariants" class="evolvethemes-font-variants"></evolvethemes-select>
					</div>

					<div class="evolvethemes-f">
						<span class="evolvethemes-f-l"><?php esc_html_e( 'Subsets', 'crowley' ); ?></span>
						<evolvethemes-select v-model="value.google_fonts.subsets" v-bind:options="googleFontSubsets" class="evolvethemes-font-subsets"></evolvethemes-select>
					</div>
				</div>
			</div>
			<div v-if="value.source == 'typekit'">
				<div class="evolvethemes-f">
					<span class="evolvethemes-f-l"><?php esc_html_e( 'Kit ID', 'crowley' ); ?></span>
					<input type="text" v-model="value.typekit.kitId">
				</div>

				<div class="evolvethemes-f" v-if="value.typekit.kitId">
					<span class="evolvethemes-f-l"><?php esc_html_e( 'Family', 'crowley' ); ?></span>
					<input type="text" v-model="value.typekit.font_family">
				</div>
			</div>
			<div v-if="value.source == 'custom'">
				<div class="evolvethemes-f">
					<span class="evolvethemes-f-l"><?php esc_html_e( 'Family', 'crowley' ); ?></span>
					<input type="text" v-model="value.custom.font_family">
				</div>

				<div class="evolvethemes-f">
					<span class="evolvethemes-f-l"><?php esc_html_e( 'Stylesheet URL', 'crowley' ); ?></span>
					<input type="text" v-model="value.custom.url">
				</div>
			</div>
		</div>
	</div>
</script>
