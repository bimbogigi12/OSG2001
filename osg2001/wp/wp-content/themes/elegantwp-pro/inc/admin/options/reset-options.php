<?php
/**
* Reset options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_reset_options($wp_customize) {

    // Customizer Section: Reset
    $wp_customize->add_section( 'sc_reset_settings', array( 'title' => esc_html__( 'Reset Settings', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 800 ) );

    $wp_customize->add_setting( 'elegantwp_options[reset_settings]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_reset_button' ) );

    $wp_customize->add_control( new ElegantWP_Customize_Reset_Control( $wp_customize, 'elegantwp_reset_settings_control', array( 'label' => esc_html__( 'Reset all theme options made for this theme to their default values by clicking the button below.', 'elegantwp-pro' ), 'section' => 'sc_reset_settings', 'settings' => 'elegantwp_options[reset_settings]', 'type' => 'elegantwp-reset-button' ) ) );

}