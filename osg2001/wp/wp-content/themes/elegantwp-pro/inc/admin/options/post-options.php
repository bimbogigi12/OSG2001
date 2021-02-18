<?php
/**
* Post options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_post_options($wp_customize) {

    $wp_customize->add_section( 'sc_elegantwp_posts', array( 'title' => esc_html__( 'Post Options', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 260 ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_posts_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_posts_heading_control', array( 'label' => esc_html__( 'Hide HomePage Posts Heading', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_posts_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[posts_heading]', array( 'default' => esc_html__( 'Recent Posts', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'elegantwp_posts_heading_control', array( 'label' => esc_html__( 'HomePage Posts Heading', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'elegantwp_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_thumbnail_link' ) );

    $wp_customize->add_control( 'elegantwp_thumbnail_link_control', array( 'label' => esc_html__( 'Thumbnail Link', 'elegantwp-pro' ), 'description' => esc_html__('Do you want single post thumbnail to be linked to their post?', 'elegantwp-pro'), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'elegantwp-pro'), 'no' => esc_html__('No', 'elegantwp-pro') ) ) );

    $wp_customize->add_setting( 'elegantwp_options[post_style]', array( 'default' => 'style-4', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_post_style' ) );

    $wp_customize->add_control( 'elegantwp_post_style_control', array( 'label' => esc_html__( 'Non-Singular Posts Style', 'elegantwp-pro' ), 'description' => esc_html__('Select the post style you want for home/categories/tags/archive/search-results pages.', 'elegantwp-pro'), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[post_style]', 'type' => 'select', 'choices' => array( 'style-1' => esc_html__('Style 1', 'elegantwp-pro'), 'style-2' => esc_html__('Style 2', 'elegantwp-pro'), 'style-3' => esc_html__('Style 3', 'elegantwp-pro'), 'style-4' => esc_html__('Style 4', 'elegantwp-pro'), 'style-5' => esc_html__('Style 5', 'elegantwp-pro'), 'style-6' => esc_html__('Style 6', 'elegantwp-pro'), 'style-8' => esc_html__('Style 8', 'elegantwp-pro'), 'style-9' => esc_html__('Style 9', 'elegantwp-pro'), 'style-12' => esc_html__('Style 12', 'elegantwp-pro'), 'style-13' => esc_html__('Style 13', 'elegantwp-pro') ) ) );

    $wp_customize->add_setting( 'elegantwp_options[read_more_length]', array( 'default' => 25, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_read_more_length' ) );

    $wp_customize->add_control( 'elegantwp_read_more_length_control', array( 'label' => esc_html__( 'Auto Post Summary Length', 'elegantwp-pro' ), 'description' => esc_html__('Enter the number of words need to display in the post summary. Default is 25 words.', 'elegantwp-pro'), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[read_more_length]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[read_more_text]', array( 'default' => esc_html__( 'Continue Reading...', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'elegantwp_read_more_text_control', array( 'label' => esc_html__( 'Read More Text', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[read_more_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_posted_date_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_posted_date_home_control', array( 'label' => esc_html__( 'Hide Posted Date from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_posted_date_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_author_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_author_home_control', array( 'label' => esc_html__( 'Hide Post Author from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_author_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_categories_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_categories_home_control', array( 'label' => esc_html__( 'Hide Post Categories from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_categories_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_tags_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_tags_home_control', array( 'label' => esc_html__( 'Hide Post Tags from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_tags_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_comments_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_comments_link_home_control', array( 'label' => esc_html__( 'Hide Comment Link from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_comments_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_edit_control', array( 'label' => esc_html__( 'Hide Post Edit Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_edit]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_thumbnail_control', array( 'label' => esc_html__( 'Hide Thumbnails from Every Page', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_thumbnail_single]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_thumbnail_single_control', array( 'label' => esc_html__( 'Hide Thumbnails from Posts/Pages', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_thumbnail_single]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_post_snippet]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_post_snippet_control', array( 'label' => esc_html__( 'Hide Post Snippet', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_post_snippet]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_read_more_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_read_more_button_control', array( 'label' => esc_html__( 'Hide Read More Button', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_read_more_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_share_buttons_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_share_buttons_home_control', array( 'label' => esc_html__( 'Hide Share Buttons from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_share_buttons_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_share_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_share_buttons_control', array( 'label' => esc_html__( 'Hide Share Buttons from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_share_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_author_bio_box]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_author_bio_box_control', array( 'label' => esc_html__( 'Hide Author Bio Box', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_author_bio_box]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_related_posts_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_related_posts_home_control', array( 'label' => esc_html__( 'Hide Related Posts from Posts Summaries', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_related_posts_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[hide_related_posts]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_related_posts_control', array( 'label' => esc_html__( 'Hide Related Posts from Single Posts', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[hide_related_posts]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[related_posts_heading]', array( 'default' => esc_html__( 'Related Articles', 'elegantwp-pro' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'elegantwp_related_posts_heading_control', array( 'label' => esc_html__( 'Related Posts Heading', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[related_posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'elegantwp_options[related_posts_number]', array( 'default' => 4, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_related_posts_number' ) );

    $wp_customize->add_control( 'elegantwp_related_posts_number_control', array( 'label' => esc_html__( 'Number of Related Posts', 'elegantwp-pro' ), 'description' => esc_html__('Choose the number of posts you need to display in the related posts area', 'elegantwp-pro'), 'section' => 'sc_elegantwp_posts', 'settings' => 'elegantwp_options[related_posts_number]', 'type' => 'select', 'choices' => array( 4 => esc_html__( '4 Posts', 'elegantwp-pro' ), 8 => esc_html__( '8 Posts', 'elegantwp-pro' ), 12 => esc_html__( '12 Posts', 'elegantwp-pro' ), 16 => esc_html__( '16 Posts', 'elegantwp-pro' ), ) ) );

}