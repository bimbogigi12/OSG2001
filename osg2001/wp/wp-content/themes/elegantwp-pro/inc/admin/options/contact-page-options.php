<?php
/**
* Contact page options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_contact_page_options($wp_customize) {

    $wp_customize->add_section( 'sc_contact_page', array( 'title' => esc_html__( 'Contact Page', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 530 ) );

    $wp_customize->add_setting( 'elegantwp_options[contact_page_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new ElegantWP_Customize_Static_Text_Control( $wp_customize, 'elegantwp_contact_page_text_control', array(
        'label'       => esc_html__( 'Contact Page Configuration', 'elegantwp-pro' ),
        'section'     => 'sc_contact_page',
        'settings' => 'elegantwp_options[contact_page_text]',
        'description' => esc_html__( 'Follow these steps to create a contact page with a built-in contact form:', 'elegantwp-pro' ).
            '<hr/><ul>' .
                '<li>' . esc_html__( '1. On the editing screen of a new page/existing page, scroll down to "Page Attributes" section, and you will find the "Template" drop down menu.', 'elegantwp-pro' ) . '</li>' .
                '<li>' . esc_html__( '2. Click on it and select "Contact Form" template from available template list.', 'elegantwp-pro' ) . '</li>' .
                '<li>' . esc_html__( '3. Publish/update your page.', 'elegantwp-pro' ) . '</li>' .
            '</ul>'
    ) ) );

    $wp_customize->add_setting( 'elegantwp_options[contact_form_email]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_email' ) );

    $wp_customize->add_control( 'elegantwp_contact_form_email_control', array( 'label' => esc_html__( 'Contact Form Email Address', 'elegantwp-pro' ), 'description' => esc_html__('When a user contacts you using the built-in contact form of the theme, this is your email address to get these messages.', 'elegantwp-pro'), 'section' => 'sc_contact_page', 'settings' => 'elegantwp_options[contact_form_email]', 'type' => 'text' ) );

}