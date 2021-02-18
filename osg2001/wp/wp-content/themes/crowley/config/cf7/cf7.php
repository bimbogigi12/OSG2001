<?php
/**
 * Contact Form 7 support.
 *
 * @package theme\config\cf7
 */

if ( ! defined( 'WPCF7_VERSION' ) ) {
	return;
}


/**
 * Enqueue the assets that are required by the theme for Contact Form 7 compatiblity.
 *
 * @since 1.0.0
 */
function crowley_enqueuecf7_assets() {
	$evolvethemes_key = evolvethemes_theme_key();

	wp_enqueue_style( $evolvethemes_key . '-cf7-style', get_template_directory_uri() . '/css/theme-cf7.css', array(), '1.0.0' );
}

add_action( 'evolvethemes_assets_styles', 'crowley_enqueuecf7_assets' );
