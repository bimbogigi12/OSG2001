<?php
/**
 * Layout Helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\layout\v1
 * @since 1.0.0
 */

/**
 * Output a series of CSS classes to be applied to the main layout wrapper
 * element.
 *
 * @since 1.0.0
 */
function evolvethemes_layout_class() {
	$theme_key = evolvethemes_theme_key();
	$classes = array();

	$classes[] = $theme_key . '-l';

	$classes = apply_filters( 'evolvethemes_layout_classes', $classes );

	echo esc_attr( implode( ' ', $classes ) );
}
