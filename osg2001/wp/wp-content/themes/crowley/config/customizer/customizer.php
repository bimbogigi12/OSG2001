<?php
/**
 * Theme customization.
 *
 * @package theme\config\customizer
 */

/**
 * Register the theme Customizer controls.
 *
 * @since 1.0.0
 * @param WP_Customize $wp_customize The Customizer object.
 */
function crowley_customize_register( $wp_customize ) {
	$wp_customize->add_control(
		new EvolveThemes_Customize_Color_Control(
			$wp_customize, 'highlight', array(
				'default' => '#FC5E63',
				'section' => 'colors',
				'label' => __( 'Accent color', 'crowley' ),
				'description' => __( 'The accent color is used to highlight specific parts of the template, in order to make them stand out compared to the standard text color.', 'crowley' ),
			)
		)
	);

	$wp_customize->add_control(
		new EvolveThemes_Customize_Color_Control(
			$wp_customize, 'highlight_light', array(
				'default' => '#FCF6F0',
				'section' => 'colors',
				'label' => __( 'Accent companion color', 'crowley' ),
				'description' => __( 'The accent companion color is used to give a subtle highlight to specific parts of the template, such as menu and footer background. Ideally, for best results, this color should be chosen to work well alongside the accent color.', 'crowley' ),
			)
		)
	);
}

add_action( 'customize_register', 'crowley_customize_register' );

/**
 * Load theme webfonts.
 *
 * @since 1.0.0
 * @param array $config The theme localization array.
 * @return array
 */
function crowley_load_fonts( $config ) {
	$config['fonts'] = array(
		array(
			'source' => 'google_fonts',
			'google_fonts' => array(
				'font_family' => 'IBM Plex Serif',
				'variants' => 'italic,700',
				'subsets' => 'latin',
			),
		),
		array(
			'source' => 'google_fonts',
			'google_fonts' => array(
				'font_family' => 'IBM Plex Sans',
				'variants' => '300,300italic,600,700',
				'subsets' => 'latin',
			),
		),
	);

	return $config;
}

add_filter( 'crowley_localize_script', 'crowley_load_fonts' );
