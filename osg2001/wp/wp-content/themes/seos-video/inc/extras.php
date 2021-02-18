<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package video
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $seos_video_classes Classes for the body element.
 * @return array
 */
function seos_video_body_classes( $seos_video_classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$seos_video_classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$seos_video_classes[] = 'hfeed';
	}

	return $seos_video_classes;
}
add_filter( 'body_class', 'seos_video_body_classes' );
