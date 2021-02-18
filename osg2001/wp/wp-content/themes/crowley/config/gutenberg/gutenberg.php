<?php
/**
 * Gutenberg support.
 *
 * @package theme\config\gutenberg
 */

if ( ! function_exists( 'register_block_type' ) ) {
	return;
}

/**
 * Enqueue the assets that are required by the theme for Gutenberg compatiblity.
 *
 * @since 1.0.0
 */
function crowley_enqueue_gutenberg_stylesheet() {
	$evolvethemes_key = evolvethemes_theme_key();

	wp_enqueue_style( $evolvethemes_key . '-gutenberg-style', get_template_directory_uri() . '/css/theme-gutenberg.css', array(), '1.0.0' );
}

add_action( 'evolvethemes_assets_styles', 'crowley_enqueue_gutenberg_stylesheet' );

/**
 * Add the theme supports for Gutenberg.
 */
function crowley_gutenberg_theme_setup() {
	/* Add support for Gutenberg wide images. */
	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'crowley_gutenberg_theme_setup' );
