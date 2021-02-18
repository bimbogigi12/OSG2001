<?php
/**
 * Balanced Blog Theme Customizer
 *
 * @package Balanced Blog
 */

$balanced_blog_sections = array( 'info' );

foreach( $balanced_blog_sections as $s ){
    require get_template_directory() . '/lib/customizer/' . $s . '.php';
}

function balanced_blog_customizer_scripts() {
    wp_enqueue_style( 'balanced-blog-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'balanced-blog-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'balanced_blog_customizer_scripts' );
