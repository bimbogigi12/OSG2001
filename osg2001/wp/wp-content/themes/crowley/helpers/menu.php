<?php
/**
 * The menu helpers.
 *
 * @package theme\helpers
 */

/**
 * Add extra markup to the main navigation.
 *
 * @since 1.0.0
 */
function crowley_nav_menu_before() {
	$evolvethemes_key = evolvethemes_theme_key();

	printf( '<div class="%s-nav_w-i">', esc_attr( $evolvethemes_key ) );
}

/**
 * Close the extra markup of the main navigation.
 *
 * @since 1.0.0
 */
function crowley_nav_menu_after() {
	echo '</div>';
}

add_action( 'evolvethemes_nav_menu_before', 'crowley_nav_menu_before' );
add_action( 'evolvethemes_nav_menu_after', 'crowley_nav_menu_after' );
