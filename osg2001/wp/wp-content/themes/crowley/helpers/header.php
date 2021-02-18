<?php
/**
 * The header helpers.
 *
 * @package theme\helpers
 */

/**
 * Add a custom inline style for the header text color.
 *
 * @since 1.0.0
 */
function crowley_header_custom_color() {
	$header_text_color = get_header_textcolor();

	if ( empty( $header_text_color ) ) {
		return;
	}

	$custom_css = ".crowley-logo a { color: #{$header_text_color}; }";

	wp_add_inline_style( 'crowley-style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'crowley_header_custom_color' );

/**
 * Add the mobile navigation trigger inside the navigation component.
 *
 * @since 1.0.0
 */
function crowley_mobile_nav_trigger() {
	$evolvethemes_key = evolvethemes_theme_key();

	printf( '<a href="#crowley-nav" class="%s-nav-trigger"><span></span></a>', esc_attr( $evolvethemes_key ) );
}

add_action( 'evolvethemes_nav_menu_before', 'crowley_mobile_nav_trigger' );
