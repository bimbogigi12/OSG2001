<?php
/**
 * Elementor support.
 *
 * @package theme\config\elementor
 */

/**
 * Check if Elementor is active.
 *
 * @since 1.0.0
 * @return boolean
 */
function crowley_is_elementor_activated() {
	return defined( 'ELEMENTOR_VERSION' ) ? true : false;
}

if ( ! crowley_is_elementor_activated() ) {
	return;
}

/**
 * Enqueue the scripts and styles for Elementor.
 *
 * @since 1.0.0
 */
function crowley_elementor_assets() {
	$evolvethemes_key = evolvethemes_theme_key();

	/* Elementor compatibility stylesheet. */
	wp_enqueue_style( $evolvethemes_key . '-elementor-style', get_template_directory_uri() . '/css/theme-elementor.css', array(), '1.0.0' );
}

add_action( 'wp_enqueue_scripts', 'crowley_elementor_assets' );

/**
 * Override the container width value
 *
 * @since 1.0.0
 * @param mixed  $value  Value of the option. If stored serialized, it will be
 *                       unserialized prior to being returned.
 * @param string $option Option name.
 */
function crowley_option_elementor_container_width( $value, $option ) {
	return '';
}

add_filter( 'option_elementor_container_width', 'crowley_option_elementor_container_width', 10, 2 );
