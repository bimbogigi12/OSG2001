<?php
/**
* Color options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_color_options($wp_customize) {

    $wp_customize->add_setting( 'elegantwp_options[body_text_color]', array( 'default' => '#555555', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_body_text_color_control', array( 'label' => esc_html__( 'Main Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[body_text_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[link_color]', array( 'default' => '#666666', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_link_color_control', array( 'label' => esc_html__( 'Main Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[link_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[link_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_link_hover_color_control', array( 'label' => esc_html__( 'Main Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[link_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[headings_color]', array( 'default' => '#111111', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_headings_color_control', array( 'label' => esc_html__( 'General Headings Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[headings_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[outer_border_one_color]', array( 'default' => '#c8c8c8', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_outer_border_one_color_control', array( 'label' => esc_html__( 'Outer Border 1 Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[outer_border_one_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[outer_border_two_color]', array( 'default' => '#f9f9f9', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_outer_border_two_color_control', array( 'label' => esc_html__( 'Outer Border 2 Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[outer_border_two_color]' ) ) );



    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_bg_color_control', array( 'label' => esc_html__( 'Secondary Menu Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_color_control', array( 'label' => esc_html__( 'Secondary Menu Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_shadow_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_shadow_color_control', array( 'label' => esc_html__( 'Secondary Menu Link Shadow Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_shadow_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_hover_color]', array( 'default' => '#dddddd', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_hover_color_control', array( 'label' => esc_html__( 'Secondary Menu Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_hover_bg_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_hover_bg_color_control', array( 'label' => esc_html__( 'Secondary Menu Link Hover Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_hover_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_submenu_one_bg_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_submenu_one_bg_color_control', array( 'label' => esc_html__( 'Secondary Sub Menu Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_submenu_one_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_submenu_one_bd_color]', array( 'default' => '#666666', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_submenu_one_bd_color_control', array( 'label' => esc_html__( 'Secondary Sub Menu Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_submenu_one_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[secondary_menu_icon_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_secondary_menu_icon_color_control', array( 'label' => esc_html__( 'Secondary Responsive Menu Icon Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[secondary_menu_icon_color]' ) ) );



    $wp_customize->add_setting( 'elegantwp_options[header_bg_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_header_bg_color_control', array( 'label' => esc_html__( 'Header Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[header_bg_color]' ) ) );



    $wp_customize->add_setting( 'elegantwp_options[primary_menu_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_bg_color_control', array( 'label' => esc_html__( 'Primary Menu Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_bd_color]', array( 'default' => '#cd2122', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_bd_color_control', array( 'label' => esc_html__( 'Primary Menu Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_color_control', array( 'label' => esc_html__( 'Primary Menu Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_shadow_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_shadow_color_control', array( 'label' => esc_html__( 'Primary Menu Link Shadow Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_shadow_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_hover_color_control', array( 'label' => esc_html__( 'Primary Menu Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_hover_bg_color]', array( 'default' => '#cd2122', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_hover_bg_color_control', array( 'label' => esc_html__( 'Primary Menu Link Hover Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_hover_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_submenu_one_bg_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_submenu_one_bg_color_control', array( 'label' => esc_html__( 'Primary Sub Menu Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_submenu_one_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_submenu_one_bd_color]', array( 'default' => '#222222', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_submenu_one_bd_color_control', array( 'label' => esc_html__( 'Primary Sub Menu Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_submenu_one_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_submenu_two_bd_color]', array( 'default' => '#383838', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_submenu_two_bd_color_control', array( 'label' => esc_html__( 'Primary Sub Menu Border 2 Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_submenu_two_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[primary_menu_icon_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_primary_menu_icon_color_control', array( 'label' => esc_html__( 'Primary Responsive Menu Icon Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[primary_menu_icon_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[header_social_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_header_social_color_control', array( 'label' => esc_html__( 'Header Social Icons Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[header_social_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[header_social_hover_color]', array( 'default' => '#dddddd', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_header_social_hover_color_control', array( 'label' => esc_html__( 'Header Social Icons Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[header_social_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[news_ticker_bg_color]', array( 'default' => '#888888', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_news_ticker_bg_color_control', array( 'label' => esc_html__( 'News Ticker Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[news_ticker_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_heading_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_news_ticker_heading_color_control', array( 'label' => esc_html__( 'News Ticker Heading Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[news_ticker_heading_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_heading_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_news_ticker_heading_bg_color_control', array( 'label' => esc_html__( 'News Ticker Heading Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[news_ticker_heading_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_text_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_news_ticker_text_color_control', array( 'label' => esc_html__( 'News Ticker Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[news_ticker_text_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_hover_text_color]', array( 'default' => '#dddddd', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_news_ticker_hover_text_color_control', array( 'label' => esc_html__( 'News Ticker Hover Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[news_ticker_hover_text_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[fullwidth_bg_color]', array( 'default' => '#e0e0e0', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_fullwidth_bg_color_control', array( 'label' => esc_html__( 'Top Full Width Area Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[fullwidth_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[fullwidth_bd_one_color]', array( 'default' => '#c8c8c8', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_fullwidth_bd_one_color_control', array( 'label' => esc_html__( 'Top Full Width Area Border 1 Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[fullwidth_bd_one_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[fullwidth_bd_two_color]', array( 'default' => '#f9f9f9', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_fullwidth_bd_two_color_control', array( 'label' => esc_html__( 'Top Full Width Area Border 2 Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[fullwidth_bd_two_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[content_bg_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_content_bg_color_control', array( 'label' => esc_html__( 'Main Content Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[content_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_one_bg_color]', array( 'default' => '#e0e0e0', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_one_bg_color_control', array( 'label' => esc_html__( 'Sidebar 1 Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_one_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_two_bg_color]', array( 'default' => '#e0e0e0', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_two_bg_color_control', array( 'label' => esc_html__( 'Sidebar 2 Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_two_bg_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[mini_post_title_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_title_color_control', array( 'label' => esc_html__( 'Home/Featured Post Title Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_title_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_title_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_title_color_control', array( 'label' => esc_html__( 'Single Post Title Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_title_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[mini_post_title_hover_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_title_hover_color_control', array( 'label' => esc_html__( 'Home/Featured Post Title Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_title_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_title_hover_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_title_hover_color_control', array( 'label' => esc_html__( 'Single Post Title Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_title_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[mini_post_title_two_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_title_two_color_control', array( 'label' => esc_html__( 'Home/Featured Post Title Color 2', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_title_two_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[mini_post_title_two_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_title_two_hover_color_control', array( 'label' => esc_html__( 'Home/Featured Post Title Hover Color 2', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_title_two_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[post_body_link_color]', array( 'default' => '#409BD4', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_body_link_color_control', array( 'label' => esc_html__( 'Post Content Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_body_link_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_body_link_hover_color]', array( 'default' => '#08ACD5', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_body_link_hover_color_control', array( 'label' => esc_html__( 'Post Content Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_body_link_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[postcats_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_postcats_color_control', array( 'label' => esc_html__( 'Post Categories Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[postcats_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[postcats_bg_color]', array( 'default' => '#8c2828', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_postcats_bg_color_control', array( 'label' => esc_html__( 'Post Categories Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[postcats_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[postcats_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_postcats_hover_color_control', array( 'label' => esc_html__( 'Post Categories Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[postcats_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[postcats_bg_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_postcats_bg_hover_color_control', array( 'label' => esc_html__( 'Post Categories Hover Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[postcats_bg_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[mini_post_meta_color]', array( 'default' => '#666666', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_meta_color_control', array( 'label' => esc_html__( 'Home/Featured Post Meta Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_meta_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_meta_color]', array( 'default' => '#666666', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_meta_color_control', array( 'label' => esc_html__( 'Single Post Meta Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_meta_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[mini_post_meta_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_meta_hover_color_control', array( 'label' => esc_html__( 'Home/Featured Post Meta Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_meta_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_meta_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_post_meta_hover_color_control', array( 'label' => esc_html__( 'Single Post Meta Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[post_meta_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[mini_post_meta_two_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_meta_two_color_control', array( 'label' => esc_html__( 'Home/Featured Post Meta Color 2', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_meta_two_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[mini_post_meta_two_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_mini_post_meta_two_hover_color_control', array( 'label' => esc_html__( 'Home/Featured Post Meta Hover Color 2', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[mini_post_meta_two_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[rmore_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_rmore_color_control', array( 'label' => esc_html__( 'Read More Button Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[rmore_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[rmore_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_rmore_bg_color_control', array( 'label' => esc_html__( 'Read More Button Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[rmore_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[rmore_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_rmore_hover_color_control', array( 'label' => esc_html__( 'Read More Button Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[rmore_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[rmore_bg_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_rmore_bg_hover_color_control', array( 'label' => esc_html__( 'Read More Button Hover Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[rmore_bg_hover_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[sidebar_title_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_title_color_control', array( 'label' => esc_html__( 'Sidebar Title Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_title_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_title_bg_one_color]', array( 'default' => '#2c2c2c', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_title_bg_one_color_control', array( 'label' => esc_html__( 'Sidebar Title Background Color 1', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_title_bg_one_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_title_bg_two_color]', array( 'default' => '#cd2122', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_title_bg_two_color_control', array( 'label' => esc_html__( 'Sidebar Title Background Color 2', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_title_bg_two_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_link_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_link_color_control', array( 'label' => esc_html__( 'Sidebar Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_link_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_link_hover_color]', array( 'default' => '#666666', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_link_hover_color_control', array( 'label' => esc_html__( 'Sidebar Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_link_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[sidebar_list_bd_color]', array( 'default' => '#d6d6d6', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_sidebar_list_bd_color_control', array( 'label' => esc_html__( 'Sidebar List Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[sidebar_list_bd_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[tag_cloud_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_tag_cloud_color_control', array( 'label' => esc_html__( 'Tag Cloud Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[tag_cloud_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[tag_cloud_bg_color]', array( 'default' => '#888888', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_tag_cloud_bg_color_control', array( 'label' => esc_html__( 'Tag Cloud Link Background', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[tag_cloud_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[tag_cloud_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_tag_cloud_hover_color_control', array( 'label' => esc_html__( 'Tag Cloud Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[tag_cloud_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[tag_cloud_hover_bg_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_tag_cloud_hover_bg_color_control', array( 'label' => esc_html__( 'Tag Cloud Link Hover Background', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[tag_cloud_hover_bg_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[footer_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_bg_color_control', array( 'label' => esc_html__( 'Footer Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_title_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_title_color_control', array( 'label' => esc_html__( 'Footer Title Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_title_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_title_bd_one_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_title_bd_one_color_control', array( 'label' => esc_html__( 'Footer Title Border One Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_title_bd_one_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_title_bd_two_color]', array( 'default' => '#222222', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_title_bd_two_color_control', array( 'label' => esc_html__( 'Footer Title Border Two Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_title_bd_two_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_text_color]', array( 'default' => '#cecece', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_text_color_control', array( 'label' => esc_html__( 'Footer Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_text_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_link_color]', array( 'default' => '#dbdbdb', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_link_color_control', array( 'label' => esc_html__( 'Footer Link Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_link_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_link_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_link_hover_color_control', array( 'label' => esc_html__( 'Footer Link Hover Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_link_hover_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[footer_list_bd_color]', array( 'default' => '#3a3a3a', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_footer_list_bd_color_control', array( 'label' => esc_html__( 'Footer List Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[footer_list_bd_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[cp_bg_color]', array( 'default' => '#303436', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_cp_bg_color_control', array( 'label' => esc_html__( 'Copyrights Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[cp_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[cp_bd_color]', array( 'default' => '#3D3D3D', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_cp_bd_color_control', array( 'label' => esc_html__( 'Copyrights Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[cp_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[cp_color]', array( 'default' => '#ECFFF1', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_cp_color_control', array( 'label' => esc_html__( 'Copyrights Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[cp_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[button_text_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_button_text_color_control', array( 'label' => esc_html__( 'Button Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[button_text_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[button_text_shadow_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_button_text_shadow_color_control', array( 'label' => esc_html__( 'Button Text Shadow Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[button_text_shadow_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[button_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_button_bg_color_control', array( 'label' => esc_html__( 'Button Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[button_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[button_bd_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_button_bd_color_control', array( 'label' => esc_html__( 'Button Border Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[button_bd_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[button_hover_bg_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_button_hover_bg_color_control', array( 'label' => esc_html__( 'Button Hover Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[button_hover_bg_color]' ) ) );


    $wp_customize->add_setting( 'elegantwp_options[selected_text_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_selected_text_color_control', array( 'label' => esc_html__( 'Selected Text Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[selected_text_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[selected_text_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elegantwp_selected_text_bg_color_control', array( 'label' => esc_html__( 'Selected Text Background Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[selected_text_bg_color]' ) ) );

    $wp_customize->add_setting( 'elegantwp_options[disable_shadow_color]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_disable_shadow_color_control', array( 'label' => esc_html__( 'Disable Shadow Color', 'elegantwp-pro' ), 'section' => 'colors', 'settings' => 'elegantwp_options[disable_shadow_color]', 'type' => 'checkbox', ) );

}