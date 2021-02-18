<?php

/***** Fetch Theme Data *****/

$mh_magazine_lite_data = wp_get_theme('mh-magazine-lite');
$mh_magazine_lite_version = $mh_magazine_lite_data['Version'];
$financial_news_data = wp_get_theme('financial-news');
$financial_news_version = $financial_news_data['Version'];

/***** Load Stylesheets *****/

function financial_news_styles() {
	global $mh_magazine_lite_version, $financial_news_version;
    wp_enqueue_style('mh-magazine-lite', get_template_directory_uri() . '/style.css', array(), $mh_magazine_lite_version);
    wp_enqueue_style('financial-news', get_stylesheet_uri(), array('mh-magazine-lite'), $financial_news_version);
    if (is_rtl()) {
		wp_enqueue_style('mh-magazine-lite-rtl', get_template_directory_uri() . '/rtl.css', array(), $mh_magazine_lite_version);
	}
}
add_action('wp_enqueue_scripts', 'financial_news_styles');

/***** Load Translations *****/

function financial_news_theme_setup(){
	load_child_theme_textdomain('financial-news', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'financial_news_theme_setup');

/***** Change Defaults for Custom Colors *****/

function financial_news_custom_colors() {
	remove_theme_support('custom-header');
	add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '333', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
}
add_action('after_setup_theme', 'financial_news_custom_colors');

/***** Remove Functions from Parent Theme *****/

function financial_news_remove_parent_functions() {
    remove_action('mh_before_header', 'mh_magazine_boxed_container_open');
    remove_action('mh_after_footer', 'mh_magazine_boxed_container_close');
    remove_action('admin_notices', 'mh_magazine_lite_admin_notice');
}
add_action('wp_loaded', 'financial_news_remove_parent_functions');

/***** Enable Wide Layout *****/

function financial_news_wide_container_open() {
	echo '<div class="mh-container mh-container-outer">' . "\n";
}
add_action('mh_after_header', 'financial_news_wide_container_open');

function financial_news_wide_container_close() {
	mh_before_container_close();
	echo '</div><!-- .mh-container-outer -->' . "\n";
}
add_action('mh_before_footer', 'financial_news_wide_container_close');

?>