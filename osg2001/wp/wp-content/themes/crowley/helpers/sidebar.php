<?php
/**
 * The sidebar helpers.
 *
 * @package theme\helpers
 */

/**
 * Check if the main sidebar is active and add a CSS class to the <body> element.
 *
 * @since 1.0.0
 * @param array $class The body classes.
 * @return array
 */
function crowley_is_sidebar_active_body_class( $class ) {
	$evolvethemes_key = evolvethemes_theme_key();

	if ( is_active_sidebar( 'main-sidebar' ) ) {
		$class[] = $evolvethemes_key . '-sidebar-active';
	}

	return $class;
}

add_filter( 'body_class', 'crowley_is_sidebar_active_body_class' );
