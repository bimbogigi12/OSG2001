<?php
/**
* Other options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_other_options($wp_customize) {

    $wp_customize->add_section( 'sc_other_options', array( 'title' => esc_html__( 'Other Options', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 560 ) );

    $wp_customize->add_setting( 'elegantwp_options[disable_sticky_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_disable_sticky_menu_control', array( 'label' => esc_html__( 'Disable Sticky Menu', 'elegantwp-pro' ), 'section' => 'sc_other_options', 'settings' => 'elegantwp_options[disable_sticky_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[disable_sticky_sidebar]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_disable_sticky_sidebar_control', array( 'label' => esc_html__( 'Disable Sticky Sidebar', 'elegantwp-pro' ), 'section' => 'sc_other_options', 'settings' => 'elegantwp_options[disable_sticky_sidebar]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[disable_backtotop]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_disable_backtotop_control', array( 'label' => esc_html__( 'Disable Back to Top Button', 'elegantwp-pro' ), 'section' => 'sc_other_options', 'settings' => 'elegantwp_options[disable_backtotop]', 'type' => 'checkbox', ) );

}