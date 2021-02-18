<?php
/**
 * The theme page configuration.
 *
 * @package WordPress
 * @subpackage config
 * @since 1.0.0
 */

/**
 * Return the about text for the Theme Page.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_theme_page_about() {
	$about = __( 'Crowley is a free blog theme with clean type, smart layouts and a design flexibility that makes it perfect for publishers of all kinds.', 'crowley' );

	return $about;
}

add_filter( 'evolvethemes_theme_page_about', 'evolvethemes_theme_page_about' );

/**
 * Configuration of the theme page tabs
 *
 * @since 1.0.0
 * @param  array $tabs The theme page tabs.
 * @return array
 */
function evolvethemes_theme_page_tabs( $tabs ) {
	$tabs[] = array(
		'slug' => '',
		'title' => __( 'Welcome', 'crowley' ),
		'content' => trailingslashit( get_template_directory() ) . 'config/theme-page/welcome.php',
	);

	return $tabs;
}

add_filter( 'evolvethemes_theme_page_tabs', 'evolvethemes_theme_page_tabs' );
