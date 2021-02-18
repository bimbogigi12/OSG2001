<?php
/**
 * Beaver builder support.
 *
 * @package theme\config\beaver
 */

/**
 * Check if the Beaver builder plugin is active.
 *
 * @since 1.0.0
 * @return boolean
 */
function crowley_is_beaver_activated() {
	return class_exists( 'FLBuilderLoader' ) ? true : false;
}

if ( ! crowley_is_beaver_activated() ) {
	return;
}

/**
 * Enqueue the scripts and styles for Beaver builder.
 *
 * @since 1.0.0
 */
function crowley_beaver_assets() {
	$evolvethemes_key = evolvethemes_theme_key();

	/* Main stylesheet. */
	wp_enqueue_style( $evolvethemes_key . '-beaver-style', get_template_directory_uri() . '/css/theme-beaver.css', array(), '1.0.0' );
}

add_action( 'wp_enqueue_scripts', 'crowley_beaver_assets' );
