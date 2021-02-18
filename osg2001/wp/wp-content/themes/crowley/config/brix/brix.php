<?php
/**
 * Brix support.
 *
 * @package theme\config\brix
 */

if ( ! defined( 'BRIX' ) ) {
	return;
}

/**
 * Enqueue the assets that are required by the theme for Brix compatiblity.
 *
 * @since 1.0.0
 */
function crowley_enqueue_brix_assets() {
	$evolvethemes_key = evolvethemes_theme_key();

	wp_enqueue_style( $evolvethemes_key . '-brix-style', get_template_directory_uri() . '/css/theme-brix.css', array(), '1.0.0' );
	wp_enqueue_script( $evolvethemes_key . '-brix-script', get_template_directory_uri() . '/js/crowley-brix.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'evolvethemes_assets_styles', 'crowley_enqueue_brix_assets' );
