<?php
/**
* Trending News options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_trending_news_options($wp_customize) {

    $wp_customize->add_section( 'sc_news_ticker', array( 'title' => esc_html__( 'News Ticker', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 250 ) );

    $wp_customize->add_setting( 'elegantwp_options[enable_news_ticker]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_enable_news_ticker_control', array( 'label' => esc_html__( 'Enable News Ticker', 'elegantwp-pro' ), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[enable_news_ticker]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_heading]', array( 'default' => esc_html__( 'Breaking News', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'elegantwp_news_ticker_heading_control', array( 'label' => esc_html__( 'News Ticker Heading', 'elegantwp-pro' ), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[news_ticker_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_length]', array( 'default' => 5, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_positive_integer' ) );

    $wp_customize->add_control( 'elegantwp_news_ticker_length_control', array( 'label' => esc_html__( 'Number of News Ticker Posts', 'elegantwp-pro' ), 'description' => esc_html__('Enter the number of posts you need to display in the news ticker area. Default is 5 posts.', 'elegantwp-pro'), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[news_ticker_length]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_post_type]', array( 'default' => 'recent-posts', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_news_ticker_type' ) );

    $wp_customize->add_control( 'elegantwp_news_ticker_post_type_control', array( 'label' => esc_html__( 'News Ticker Posts Type', 'elegantwp-pro' ), 'description' => esc_html__('Select a post type to display in news ticker.', 'elegantwp-pro'), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[news_ticker_post_type]', 'type' => 'select', 'choices' => array( 'recent-posts' => esc_html__('Recent Posts', 'elegantwp-pro'), 'popular-posts' => esc_html__('Popular Posts', 'elegantwp-pro'), 'random-posts' => esc_html__('Random Posts', 'elegantwp-pro'), 'category-posts' => esc_html__('Category Posts', 'elegantwp-pro'), 'tag-posts' => esc_html__('Tag Posts', 'elegantwp-pro') ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_cat]', array( 'default' => 0, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ) );

    $wp_customize->add_control( new ElegantWP_Customize_Category_Control( $wp_customize, 'elegantwp_news_ticker_cat_control', array( 'label' => esc_html__( 'News Ticker Posts Category', 'elegantwp-pro' ), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[news_ticker_cat]', 'description' => esc_html__( 'Select a category if Posts Type option is Category Posts', 'elegantwp-pro' ) ) ) );

    $wp_customize->add_setting( 'elegantwp_options[news_ticker_tag]', array( 'default' => 0, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ) );

    $wp_customize->add_control( new ElegantWP_Customize_Category_Control( $wp_customize, 'elegantwp_news_ticker_tag_control', array( 'label' => esc_html__( 'News Ticker Posts Tag', 'elegantwp-pro' ), 'section' => 'sc_news_ticker', 'settings' => 'elegantwp_options[news_ticker_tag]', 'description' => esc_html__( 'Select a tag if Posts Type option is Tag Posts', 'elegantwp-pro' ), 'dropdown_args' => array( 'taxonomy' => 'post_tag', ), ) ) );

}