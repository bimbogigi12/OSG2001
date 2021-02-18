<?php
/**
* 404 options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_404_options($wp_customize) {

    $wp_customize->add_section( 'sc_error_page', array( 'title' => esc_html__( '404 Page', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 500 ) );

    $wp_customize->add_setting( 'elegantwp_options[error_404_heading]', array( 'default' => esc_html__( 'Oops! That page can not be found.', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_html', ) );

    $wp_customize->add_control( 'elegantwp_error_404_heading_control', array( 'label' => esc_html__( '404 Error Page Heading', 'elegantwp-pro' ), 'description' => esc_html__( 'Enter the heading for the 404 error page.', 'elegantwp-pro' ), 'section' => 'sc_error_page', 'settings' => 'elegantwp_options[error_404_heading]', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'elegantwp_options[error_404_message]', array( 'default' => esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_html', ) );

    $wp_customize->add_control( 'elegantwp_error_404_message_control', array( 'label' => esc_html__( 'Error 404 Message', 'elegantwp-pro' ), 'description' => esc_html__( 'Enter a message to display on the 404 error page.', 'elegantwp-pro' ), 'section' => 'sc_error_page', 'settings' => 'elegantwp_options[error_404_message]', 'type' => 'textarea', ) );

}