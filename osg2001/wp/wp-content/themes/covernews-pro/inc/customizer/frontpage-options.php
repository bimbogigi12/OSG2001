<?php

/**
 * Option Panel
 *
 * @package CoverNews
 */

$default = covernews_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package CoverNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title'      => esc_html__('Frontpage Options', 'covernews'),
        'priority'   => 199,
        'capability' => 'edit_theme_options',
    )
);


// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title'      => esc_html__('Banner Advertisement', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default'           => $default['banner_advertisement_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label'       => esc_html__('Banner Section Advertisement', 'covernews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'covernews'), 1170, 90),
            'section'     => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority'    => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default'           => $default['banner_advertisement_section_url'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label'    => esc_html__('URL Link', 'covernews'),
        'section'  => 'frontpage_advertisement_settings',
        'type'     => 'text',
        'priority' => 130,
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_open_on_new_tab',
    array(
        'default'           => $default['banner_advertisement_open_on_new_tab'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);
$wp_customize->add_control('banner_advertisement_open_on_new_tab',
    array(
        'label'    => esc_html__('Open in new tab', 'covernews'),
        'section'  => 'frontpage_advertisement_settings',
        'type'     => 'checkbox',
        'priority' => 130,
    )
);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('banner_advertisement_scope',
    array(
        'default'           => $default['banner_advertisement_scope'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'banner_advertisement_scope',
    array(
        'label'       => esc_html__('Show banner advertisement on', 'covernews'),
        'description' => esc_html__('Select scope to display on banner advertisement section', 'covernews'),
        'section'     => 'frontpage_advertisement_settings',
        'type'        => 'select',
        'choices'               => array(
            'front-page-only' => esc_html__( 'Show on Homepage only', 'covernews' ),
            'site-wide' => esc_html__( 'Show sitewide', 'covernews' ),
        ),
        'priority'    => 130,

    ));

// Trending Posts Section.
$wp_customize->add_section('covernews_flash_posts_section_settings',
    array(
        'title'      => esc_html__('Flash Posts', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('show_flash_news_section',
    array(
        'default'           => $default['show_flash_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_flash_news_section',
    array(
        'label'    => esc_html__('Enable Flash Posts Section', 'covernews'),
        'section'  => 'covernews_flash_posts_section_settings',
        'type'     => 'checkbox',
        'priority' => 22,

    )
);

// Setting - number_of_slides.
$wp_customize->add_setting('flash_news_title',
    array(
        'default'           => $default['flash_news_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('flash_news_title',
    array(
        'label'    => esc_html__('Flash Story Title', 'covernews'),
        'section'  => 'covernews_flash_posts_section_settings',
        'type'     => 'text',
        'priority' => 23,
        'active_callback' => 'covernews_flash_posts_section_status'

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_flash_news_category',
    array(
        'default'           => $default['select_flash_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new CoverNews_Dropdown_Taxonomies_Control($wp_customize, 'select_flash_news_category',
    array(
        'label'       => esc_html__('Flash Posts Category', 'covernews'),
        'description' => esc_html__('Select category to be shown on trending posts ', 'covernews'),
        'section'     => 'covernews_flash_posts_section_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'covernews_flash_posts_section_status'
    )));



// Setting - flash news.
$wp_customize->add_setting('number_of_flash_news',
    array(
        'default'           => $default['number_of_flash_news'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control( 'number_of_flash_news',
    array(
        'label'    => __( 'Number of Flash Posts ', 'covernews' ),
        'section'  => 'covernews_flash_posts_section_settings',
        'type'     => 'number',
        'priority' => 100,
        'active_callback' => 'covernews_flash_posts_section_status'
    )
);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_flash_new_mode',
    array(
        'default'           => $default['select_flash_new_mode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'select_flash_new_mode',
    array(
        'label'       => esc_html__('Select Flash Slide Mode', 'covernews'),
        'section'     => 'covernews_flash_posts_section_settings',
        'type'        => 'select',
        'choices'               => array(
            'flash-slide-left' => esc_html__( "Slide Right to Left", 'covernews' ),
            'flash-slide-right' => esc_html__( "Slide Right to Left", 'covernews' ),

        ),
        'priority'    => 23,
        'active_callback' => 'covernews_flash_posts_section_status'
    ));



/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title'      => esc_html__('Main Banner Section', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default'           => $default['show_main_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label'    => esc_html__('Enable Main Banner Slider', 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'checkbox',
        'priority' => 22,

    )
);

// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_main_banner_section_mode',
    array(
        'default'           => $default['select_main_banner_section_mode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'select_main_banner_section_mode',
    array(
        'label'       => esc_html__('Select Banner Section Mode', 'covernews'),
        'description' => esc_html__('Select Banner Section Mode', 'covernews'),
        'section'     => 'frontpage_main_banner_section_settings',
        'type'        => 'select',
        'choices'               => array(
            'slider-editors-picks-trending' => esc_html__( "Slider, Editor's Picks and Trending", 'covernews' ),
            'slider-editors-picks' => esc_html__( "Slider and Editor's Picks", 'covernews' ),
            'slider-trending' => esc_html__( "Slider and Trending", 'covernews' ),
        ),
        'priority'    => 23,
        'active_callback' => 'covernews_main_banner_section_status'
    ));


// Setting - number_of_slides.
$wp_customize->add_setting('main_news_slider_title',
    array(
        'default'           => $default['main_news_slider_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('main_news_slider_title',
    array(
        'label'    => esc_html__('Main Story Slider Title', 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'text',
        'priority' => 23,
        'active_callback' => 'covernews_main_banner_section_status'

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default'           => $default['select_slider_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new CoverNews_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label'       => esc_html__('Slider Posts Category', 'covernews'),
        'description' => esc_html__('Select category to be shown on Main Story slider section', 'covernews'),
        'section'     => 'frontpage_main_banner_section_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'covernews_main_banner_section_status'
    )));



// Setting - number_of_slides.
$wp_customize->add_setting('number_of_slides',
    array(
        'default'           => $default['number_of_slides'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('number_of_slides',
    array(
        'label'    => esc_html__('Number of Slides', 'covernews'),
        'description' => esc_html__('Accepts any postive number.', 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'number',
        'priority' => 23,
        'active_callback' => 'covernews_main_banner_section_status'

    )
);

// Setting - number_of_slides.
$wp_customize->add_setting('editors_picks_title',
    array(
        'default'           => $default['editors_picks_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('editors_picks_title',
    array(
        'label'    => esc_html__("Editor's Picks Title", 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'text',
        'priority' => 23,
        'active_callback' => function( $control ) {
            return (
                covernews_main_banner_section_status( $control )
                &&
                covernews_banner_mode_editor_picks_status( $control )
            );
        },

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_editors_picks_category',
    array(
        'default'           => $default['select_editors_picks_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new CoverNews_Dropdown_Taxonomies_Control($wp_customize, 'select_editors_picks_category',
    array(
        'label'       => esc_html__("Editor's Picks Category", 'covernews'),
        'description' => esc_html__("Select category to be shown on Editor's Picks section", 'covernews'),
        'section'     => 'frontpage_main_banner_section_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => function( $control ) {
            return (
                covernews_main_banner_section_status( $control )
                &&
                covernews_banner_mode_editor_picks_status( $control )
            );
        },
    )));


// Setting - number_of_slides.
$wp_customize->add_setting('trending_slider_title',
    array(
        'default'           => $default['trending_slider_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('trending_slider_title',
    array(
        'label'    => esc_html__("Trending Vertical Slider Title", 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'text',
        'priority' => 23,
        'active_callback' => function( $control ) {
            return (
                covernews_main_banner_section_status( $control )
                &&
                covernews_banner_mode_status( $control )
            );
        },

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_news_category',
    array(
        'default'           => $default['select_trending_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new CoverNews_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_news_category',
    array(
        'label'       => esc_html__("Trending News Category", 'covernews'),
        'description' => esc_html__("Select category to be shown on Trending section", 'covernews'),
        'section'     => 'frontpage_main_banner_section_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => function( $control ) {
            return (
                covernews_main_banner_section_status( $control )
                &&
                covernews_banner_mode_status( $control )
            );
        },
    )));


// Setting - number_of_slides.
$wp_customize->add_setting('number_of_trending_slides',
    array(
        'default'           => $default['number_of_trending_slides'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('number_of_trending_slides',
    array(
        'label'    => esc_html__('Number of Trending Slides', 'covernews'),
        'description' => esc_html__('Accepts any postive number.', 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'number',
        'priority' => 23,
        'active_callback' => function( $control ) {
            return (
                covernews_main_banner_section_status( $control )
                &&
                covernews_banner_mode_status( $control )
            );
        },

    )
);

// Disable main banner in blog
$wp_customize->add_setting('disable_main_banner_on_blog_archive',
    array(
        'default'           => $default['disable_main_banner_on_blog_archive'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('disable_main_banner_on_blog_archive',
    array(
        'label'    => esc_html__('Disable main banner section on blog archive', 'covernews'),
        'description' => esc_html__('The option will disable trending news, main slider, featured news, featured products from blog archive page.', 'covernews'),
        'section'  => 'frontpage_main_banner_section_settings',
        'type'     => 'checkbox',
        'priority' => 50,
        'active_callback' => 'covernews_main_banner_section_status'
    )
);

/**
 * Featured News Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_featured_news_settings',
    array(
        'title'      => esc_html__('Featured Posts Section', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);

// Setting - show_featured_news_section.
$wp_customize->add_setting('show_featured_news_section',
    array(
        'default'           => $default['show_featured_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_featured_news_section',
    array(
        'label'    => esc_html__('Enable Featured New Section', 'covernews'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'checkbox',
        'priority' => 24,


    )
);



// Setting - featured_news_section_title.
$wp_customize->add_setting('featured_news_section_title',
    array(
        'default'           => $default['featured_news_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_news_section_title',
    array(
        'label'    => esc_html__('Featured Posts Section Title', 'covernews'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'text',
        'priority' => 24,
        'active_callback' => 'covernews_featured_news_section_status'

    )
);

// Setting - featured news category.
$wp_customize->add_setting('select_featured_news_category',
    array(
        'default'           => $default['select_featured_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(new CoverNews_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
    array(
        'label'       => esc_html__('Featured Posts Category', 'covernews'),
        'description' => esc_html__('Select category to be shown on featured section ', 'covernews'),
        'section'     => 'frontpage_featured_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 24,
        'active_callback' => 'covernews_featured_news_section_status'
    )));

// Setting - number_of_slides.
$wp_customize->add_setting('number_of_featured_news',
    array(
        'default'           => $default['number_of_featured_news'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('number_of_featured_news',
    array(
        'label'    => esc_html__('Number of featured news', 'covernews'),
        'description' => esc_html__('Accepts any postive number.', 'covernews'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'number',
        'priority' => 24,
        'active_callback' => 'covernews_featured_news_section_status'
    )
);



// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title'      => esc_html__('Frontpage Layout Settings', 'covernews'),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default'           => $default['frontpage_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'frontpage_content_alignment',
    array(
        'label'       => esc_html__('Frontpage Content alignment', 'covernews'),
        'description' => esc_html__('Select frontpage content alignment', 'covernews'),
        'section'     => 'frontpage_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Home Content - Home Sidebar', 'covernews' ),
            'align-content-right' => esc_html__( 'Home Sidebar - Home Content', 'covernews' ),
            'full-width-content' => esc_html__( 'Only Home Content', 'covernews' )
        ),
        'priority'    => 10,
    ));

// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting('frontpage_sticky_sidebar',
    array(
        'default'           => $default['frontpage_sticky_sidebar'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_sticky_sidebar',
    array(
        'label'    => esc_html__('Make Frontpage Sidebar Sticky', 'covernews'),
        'section'  => 'frontpage_layout_settings',
        'type'     => 'checkbox',
        'priority' => 24,
        'active_callback' => 'frontpage_content_alignment_status'
    )
);