<?php
/**
* Authors page options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_authors_page_options($wp_customize) {

    $wp_customize->add_section( 'sc_authors_page', array( 'title' => esc_html__( 'Authors Page', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 540 ) );

    $wp_customize->add_setting( 'elegantwp_options[authors_page_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new ElegantWP_Customize_Static_Text_Control( $wp_customize, 'elegantwp_authors_page_text_control', array(
        'label'       => esc_html__( 'Authors Page Configuration', 'elegantwp-pro' ),
        'section'     => 'sc_authors_page',
        'settings' => 'elegantwp_options[authors_page_text]',
        'description' => esc_html__( 'Follow these steps to create a authors page:', 'elegantwp-pro' ).
            '<hr/><ul>' .
                '<li>' . esc_html__( '1. On the editing screen of a new page/existing page, scroll down to "Page Attributes" section, and you will find the "Template" drop down menu.', 'elegantwp-pro' ) . '</li>' .
                '<li>' . esc_html__( '2. Click on it and select "Authors" template from available template list.', 'elegantwp-pro' ) . '</li>' .
                '<li>' . esc_html__( '3. Publish/update your page.', 'elegantwp-pro' ) . '</li>' .
            '</ul>'
    ) ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_admin_authors_page]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_admin_authors_page_control', array( 'label' => esc_html__( 'Hide site administrators from Authors page', 'elegantwp-pro' ), 'section' => 'sc_authors_page', 'settings' => 'elegantwp_options[hide_admin_authors_page]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_noposts_authors_page]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_noposts_authors_page_control', array( 'label' => esc_html__( 'Hide authors with zero posts from Authors page', 'elegantwp-pro' ), 'section' => 'sc_authors_page', 'settings' => 'elegantwp_options[hide_noposts_authors_page]', 'type' => 'checkbox', ) );

}