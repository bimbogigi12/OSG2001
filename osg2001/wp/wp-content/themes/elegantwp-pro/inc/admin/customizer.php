<?php
/**
* ElegantWP Theme Customizer.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! class_exists( 'WP_Customize_Control' ) ) {return NULL;}

require_once get_template_directory() . '/inc/admin/classes/class-customize-static-text-control.php';
require_once get_template_directory() . '/inc/admin/classes/class-customize-button-control.php';
require_once get_template_directory() . '/inc/admin/classes/class-customize-multiple-select.php';
require_once get_template_directory() . '/inc/admin/classes/class-customize-category-control.php';
require_once get_template_directory() . '/inc/admin/classes/class-customize-reset-control.php';
require_once get_template_directory() . '/inc/admin/classes/class-customize-recommended-plugins.php';

require_once get_template_directory() . '/inc/admin/options/getting-started.php';
require_once get_template_directory() . '/inc/admin/options/color-options.php';
require_once get_template_directory() . '/inc/admin/options/font-options.php';
require_once get_template_directory() . '/inc/admin/options/layout-options.php';
require_once get_template_directory() . '/inc/admin/options/header-options.php';
require_once get_template_directory() . '/inc/admin/options/trending-news.php';
require_once get_template_directory() . '/inc/admin/options/post-options.php';
require_once get_template_directory() . '/inc/admin/options/social-profiles.php';
require_once get_template_directory() . '/inc/admin/options/footer-options.php';
require_once get_template_directory() . '/inc/admin/options/404-options.php';
require_once get_template_directory() . '/inc/admin/options/search-options.php';
require_once get_template_directory() . '/inc/admin/options/contact-page-options.php';
require_once get_template_directory() . '/inc/admin/options/authors-page-options.php';
require_once get_template_directory() . '/inc/admin/options/other-options.php';
require_once get_template_directory() . '/inc/admin/options/reset-options.php';
require_once get_template_directory() . '/inc/admin/options/recommended-plugins.php';
require_once get_template_directory() . '/inc/admin/options/sanitize-callbacks.php';

function elegantwp_register_theme_customizer( $wp_customize ) {

    if ( isset( $_GET['elegantwp-reset-submit'] ) ) {
        delete_option( 'elegantwp_options' );
        remove_theme_mod( 'header_textcolor' );
        remove_theme_mod( 'background_color' );
        $url = get_admin_url().'customize.php';
        wp_safe_redirect( $url );
        exit();
    }

    if(method_exists('WP_Customize_Manager', 'add_panel')):
    $wp_customize->add_panel('elegantwp_main_options_panel', array( 'title' => esc_html__('Theme Options', 'elegantwp-pro'), 'priority' => 10, ));
    endif;
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'elegantwp_main_options_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 20;
    $wp_customize->get_section( 'colors' )->panel = 'elegantwp_main_options_panel';
    $wp_customize->get_section( 'colors' )->priority = 40;
      
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

    elegantwp_getting_started($wp_customize);
    elegantwp_color_options($wp_customize);
    elegantwp_font_options($wp_customize);
    elegantwp_layout_options($wp_customize);
    elegantwp_header_options($wp_customize);
    elegantwp_trending_news_options($wp_customize);
    elegantwp_post_options($wp_customize);
    elegantwp_social_profiles($wp_customize);
    elegantwp_footer_options($wp_customize);
    elegantwp_404_options($wp_customize);
    elegantwp_search_options($wp_customize);
    elegantwp_contact_page_options($wp_customize);
    elegantwp_authors_page_options($wp_customize);
    elegantwp_other_options($wp_customize);
    elegantwp_reset_options($wp_customize);
    elegantwp_recomm_plugin_options($wp_customize);

}

add_action( 'customize_register', 'elegantwp_register_theme_customizer' );

function elegantwp_customizer_js_scripts() {    
    wp_enqueue_script('elegantwp-theme-customizer-js', get_template_directory_uri() . '/inc/admin/js/customizer.js', array( 'jquery', 'customize-preview' ), NULL, true);
}
add_action( 'customize_preview_init', 'elegantwp_customizer_js_scripts' );