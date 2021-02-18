<?php
/**
 * Jetpack support.
 *
 * @package theme\config\jetpack
 */

if ( ! class_exists( 'Jetpack' ) ) {
	return;
}

/**
 * Enqueue the assets that are required by the theme for Brix compatiblity.
 *
 * @since 1.0.0
 */
function crowley_enqueue_jetpack_stylesheet() {
	$evolvethemes_key = evolvethemes_theme_key();

	wp_enqueue_style( $evolvethemes_key . '-jetpack-style', get_template_directory_uri() . '/css/theme-jetpack.css', array(), '1.0.0' );
}
add_action( 'evolvethemes_assets_styles', 'crowley_enqueue_jetpack_stylesheet' );
