<?php
/**
* Getting started options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_getting_started($wp_customize) {

    $wp_customize->add_section( 'sc_elegantwp_getting_started', array( 'title' => esc_html__( 'Getting Started', 'elegantwp-pro' ), 'description' => esc_html__( 'Thanks for your interest in ElegantWP! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 5, ) );

    $wp_customize->add_setting( 'elegantwp_options[documentation]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new ElegantWP_Customize_Button_Control( $wp_customize, 'elegantwp_documentation_control', array( 'label' => esc_html__( 'Documentation', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_getting_started', 'settings' => 'elegantwp_options[documentation]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => 'https://themesdna.com/elegantwp-wordpress-theme/', 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'elegantwp_options[contact]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new ElegantWP_Customize_Button_Control( $wp_customize, 'elegantwp_contact_control', array( 'label' => esc_html__( 'Contact Us', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_getting_started', 'settings' => 'elegantwp_options[contact]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => 'https://themesdna.com/contact/', 'button_target' => '_blank', ) ) );

}