<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Donovan
 */

/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object.
 */
function donovan_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section.
	$wp_customize->add_section( 'donovan_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'donovan' ),
		'priority' => 70,
		'panel' => 'donovan_options_panel',
		)
	);

	// Add custom Upgrade Content control.
	$wp_customize->add_setting( 'donovan_theme_options[upgrade]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Donovan_Customize_Upgrade_Control(
		$wp_customize, 'donovan_theme_options[upgrade]', array(
		'section' => 'donovan_section_upgrade',
		'settings' => 'donovan_theme_options[upgrade]',
		'priority' => 1,
		)
	) );

}
add_action( 'customize_register', 'donovan_customize_register_upgrade_settings' );
