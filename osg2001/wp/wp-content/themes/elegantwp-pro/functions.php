<?php
/**
* ElegantWP functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

define( 'ELEGANTWP_PROURL', 'https://themesdna.com/elegantwp-pro-wordpress-theme/' );
define( 'ELEGANTWP_CONTACTURL', 'https://themesdna.com/contact/' );
define( 'ELEGANTWP_THEMEOPTIONSDIR', get_template_directory() . '/inc/admin' );

// Add new constant that returns true if WooCommerce is active
define( 'ELEGANTWP_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

require_once( ELEGANTWP_THEMEOPTIONSDIR . '/customizer.php' );

function elegantwp_get_option($option) {
    $elegantwp_options = get_option('elegantwp_options');
    if ((is_array($elegantwp_options)) && (array_key_exists($option, $elegantwp_options))) {
        return $elegantwp_options[$option];
    }
    else {
        return '';
    }
}

if ( ! function_exists( 'elegantwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function elegantwp_setup() {
    
    global $wp_version;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ElegantWP, use a find and replace
     * to change 'elegantwp-pro' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'elegantwp-pro', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'elegantwp-large-image',  1230, 9999, false );
        add_image_size( 'elegantwp-featured-image',  680, 340, true );
        add_image_size( 'elegantwp-medium-image',  480, 360, true );
        add_image_size( 'elegantwp-mini-image',  100, 100, true );
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'primary' => esc_html__('Primary Menu', 'elegantwp-pro'),
    'secondary' => esc_html__('Secondary Menu', 'elegantwp-pro')
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    $markup = array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' );
    add_theme_support( 'html5', $markup );

    add_theme_support( 'custom-logo', array(
        'height'      => 90,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Support for Custom Header
    add_theme_support( 'custom-header', apply_filters( 'elegantwp_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => '333333',
    'width'                  => 1250,
    'height'                 => 200,
    'flex-height'            => true,
        'wp-head-callback'       => 'elegantwp_header_style',
        'uploads'                => true,
    ) ) );

    // Set up the WordPress core custom background feature.
    $background_args = array(
            'default-color'          => 'eeeeee',
            'default-image'          => get_template_directory_uri() .'/assets/images/background.png',
            'default-repeat'         => 'repeat',
            'default-position-x'     => 'left',
            'default-position-y'     => 'top',
            'default-size'     => 'auto',
            'default-attachment'     => 'fixed',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => 'admin_head_callback_func',
            'admin-preview-callback' => 'admin_preview_callback_func',
    );
    add_theme_support( 'custom-background', apply_filters( 'elegantwp_custom_background_args', $background_args) );
    
    // Support for Custom Editor Style
    add_editor_style( 'css/editor-style.css' );

    add_theme_support( 'woocommerce' );

}
endif;
add_action( 'after_setup_theme', 'elegantwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elegantwp_content_width() {
    $content_width = 680;

    if ( is_page_template() ) {

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-page-sidebar.php', 'template-full-width-post.php', 'template-full-width-post-sidebar.php', 'template-contact-page.php', 'template-sitemap.php', 'template-site-authors.php' ) ) ) {
       $content_width = 1230;
    }
    if ( is_page_template( array( 'template-s1-c-s2-page.php', 'template-s1-c-s2-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-s2-c-s1-page.php', 'template-s2-c-s1-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-c-s1-s2-page.php', 'template-c-s1-s2-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-c-s2-s1-page.php', 'template-c-s2-s1-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-s1-s2-c-page.php', 'template-s1-s2-c-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-s2-s1-c-page.php', 'template-s2-s1-c-post.php' ) ) ) {
        $content_width = 680;
    }
    if ( is_page_template( array( 'template-s1-c-page.php', 'template-s1-c-post.php' ) ) ) {
        $content_width = 855;
    }
    if ( is_page_template( array( 'template-c-s1-page.php', 'template-c-s1-post.php' ) ) ) {
        $content_width = 855;
    }
    if ( is_page_template( array( 'template-c-s2-page.php', 'template-c-s2-post.php' ) ) ) {
        $content_width = 855;
    }
    if ( is_page_template( array( 'template-s2-c-page.php', 'template-s2-c-post.php' ) ) ) {
        $content_width = 855;
    }

    }

    if ( !is_page_template() ) {

    if ( ('one-column' === elegantwp_get_option('layout_style')) || is_404() ) {
        $content_width = 1230;
    }
    if ( 's1-c-s2' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 's2-c-s1' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 'c-s1-s2' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 'c-s2-s1' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 's1-s2-c' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 's2-s1-c' === elegantwp_get_option('layout_style') ) {
        $content_width = 680;
    }
    if ( 's1-c' === elegantwp_get_option('layout_style') ) {
        $content_width = 855;
    }
    if ( 'c-s1' === elegantwp_get_option('layout_style') ) {
        $content_width = 855;
    }
    if ( 'c-s2' === elegantwp_get_option('layout_style') ) {
        $content_width = 855;
    }
    if ( 's2-c' === elegantwp_get_option('layout_style') ) {
        $content_width = 855;
    }

    }

    $GLOBALS['content_width'] = apply_filters( 'elegantwp_content_width', $content_width );
}
add_action( 'template_redirect', 'elegantwp_content_width', 0 );

require_once get_template_directory() . '/inc/functions/enqueue-scripts.php';
require_once get_template_directory() . '/inc/functions/widgets-init.php';
require_once get_template_directory() . '/inc/functions/share-buttons.php';
require_once get_template_directory() . '/inc/functions/social-buttons.php';
require_once get_template_directory() . '/inc/functions/author-bio-box.php';
require_once get_template_directory() . '/inc/functions/postmeta.php';
require_once get_template_directory() . '/inc/functions/posts-navigation.php';
require_once get_template_directory() . '/inc/functions/woocommerce-support.php';
require_once get_template_directory() . '/inc/functions/related-posts.php';
require_once get_template_directory() . '/inc/functions/menu.php';
require_once get_template_directory() . '/inc/functions/trending-news.php';
require_once get_template_directory() . '/inc/functions/other.php';
require_once get_template_directory() . '/inc/admin/custom.php';

// Widgets
require_once get_template_directory() . '/inc/widgets/social_widget.php';
require_once get_template_directory() . '/inc/widgets/about_me_widget.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_1.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_2.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_3.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_4.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_5.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_6.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_7.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_8.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_9.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_10.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_11.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_12.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_13.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_14.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_15.php';
require_once get_template_directory() . '/inc/widgets/featured_posts_widget_16.php';
require_once get_template_directory() . '/inc/widgets/tabbed_widget.php';