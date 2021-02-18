<?php
/**
* Search options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_search_options($wp_customize) {

    $wp_customize->add_section( 'sc_search', array( 'title' => esc_html__( 'Search Page', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 520 ) );

    $wp_customize->add_setting( 'elegantwp_options[no_search_heading]', array( 'default' => esc_html__( 'Nothing Found', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_html', ) );

    $wp_customize->add_control( 'elegantwp_no_search_heading_control', array( 'label' => esc_html__( 'No Search Results Heading', 'elegantwp-pro' ), 'description' => esc_html__( 'Enter a heading to display when no search results are found.', 'elegantwp-pro' ), 'section' => 'sc_search', 'settings' => 'elegantwp_options[no_search_heading]', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'elegantwp_options[no_search_results]', array( 'default' => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_html', ) );

    $wp_customize->add_control( 'elegantwp_no_search_results_control', array( 'label' => esc_html__( 'No Search Results Message', 'elegantwp-pro' ), 'description' => esc_html__( 'Enter a message to display when no search results are found.', 'elegantwp-pro' ), 'section' => 'sc_search', 'settings' => 'elegantwp_options[no_search_results]', 'type' => 'textarea' ) );

}