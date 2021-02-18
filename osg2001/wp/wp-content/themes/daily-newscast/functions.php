<?php
/*This file is part of Daily Newscast child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function daily_newscast_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'covernews-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700';
    wp_enqueue_style('daily_newscast-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'daily_newscast',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'daily_newscast_enqueue_child_styles' );



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function daily_newscast_customize_register($wp_customize) {
     $wp_customize->get_setting( 'header_textcolor' )->default = '#000000';    
}
add_action('customize_register', 'daily_newscast_customize_register', 99999);



/*Add the demo file*/
function daily_newscast_add_demo_files($demos) {
    $demos[] = array(
        'import_file_name'             => esc_html__( 'Child - Daily Newscast', 'daily-newscast' ),
        'local_import_file'            => trailingslashit( get_stylesheet_directory() ) . 'demo-content/daily-newscast/covernews.xml',
        'local_import_widget_file'     => trailingslashit( get_stylesheet_directory() ) . 'demo-content/daily-newscast/covernews.wie',
        'local_import_customizer_file' => trailingslashit( get_stylesheet_directory() ) . 'demo-content/daily-newscast/covernews.dat',
        'import_preview_image_url'     => trailingslashit( get_stylesheet_directory_uri() ) . 'demo-content/assets/covernews-daily-newscast.jpg',
        'preview_url'                  => 'https://demo.afthemes.com/covernews/daily-newscast',
    );
    return $demos;
}
add_filter( 'aft_demo_import_files', 'daily_newscast_add_demo_files');