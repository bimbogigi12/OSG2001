<?php
/**
* Layout options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_layout_options($wp_customize) {

    $wp_customize->add_section( 'sc_layout', array( 'title' => esc_html__( 'Layout Options', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 230 ) );

    $wp_customize->add_setting( 'elegantwp_options[layout_style]', array( 'default' => 's1-c-s2', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_layout', ) );

    $wp_customize->add_control( 'elegantwp_layout_style_control', array( 'label' => esc_html__( 'Layout Style', 'elegantwp-pro' ), 'description' => esc_html__( 'Select your layout style.', 'elegantwp-pro' ), 'section' => 'sc_layout', 'settings' => 'elegantwp_options[layout_style]', 'type' => 'radio', 'choices' => array( 's1-c-s2' => esc_html__( 'Sidebar 1 + Content + Sidebar 2', 'elegantwp-pro' ), 's2-c-s1' => esc_html__( 'Sidebar 2 + Content + Sidebar 1', 'elegantwp-pro' ), 'c-s1-s2' => esc_html__( 'Content + Sidebar 1 + Sidebar 2', 'elegantwp-pro' ), 'c-s2-s1' => esc_html__( 'Content + Sidebar 2 + Sidebar 1', 'elegantwp-pro' ), 's1-s2-c' => esc_html__( 'Sidebar 1 + Sidebar 2 + Content', 'elegantwp-pro' ), 's2-s1-c' => esc_html__( 'Sidebar 2 + Sidebar 1 + Content', 'elegantwp-pro' ), 's1-c' => esc_html__( 'Sidebar 1 + Content', 'elegantwp-pro' ), 'c-s1' => esc_html__( 'Content + Sidebar 1', 'elegantwp-pro' ), 'c-s2' => esc_html__( 'Content + Sidebar 2', 'elegantwp-pro' ), 's2-c' => esc_html__( 'Sidebar 2 + Content', 'elegantwp-pro' ), 'one-column' => esc_html__( 'One Column', 'elegantwp-pro' ) ), ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_sidebar_one_column]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_sidebar_one_column_control', array( 'label' => esc_html__( 'Hide Sidebar from One Column Layout', 'elegantwp-pro' ), 'section' => 'sc_layout', 'settings' => 'elegantwp_options[hide_sidebar_one_column]', 'type' => 'checkbox', ) );

}