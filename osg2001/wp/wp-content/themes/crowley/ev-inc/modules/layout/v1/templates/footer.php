<?php
/**
 * Footer templates.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Display the site footer according to its type and the page context.
 *
 * @since 1.0.0
 */
function evolvethemes_footer() {
	$key = 'evolvethemes_footer';

	evolvethemes_do_action( "${key}_before" );

		evolvethemes_do_action( $key );

	evolvethemes_do_action( "${key}_after" );
}

/**
 * Get the template part relative to the footer.
 *
 * @since 1.0.0
 */
function evolvethemes_footer_load_template() {
	$evolvethemes_footer_path = 'templates/footer/footer';
	$evolvethemes_footer_path = apply_filters( 'evolvethemes_footer_path', $evolvethemes_footer_path );
	get_template_part( $evolvethemes_footer_path );
}

add_action( 'evolvethemes_footer', 'evolvethemes_footer_load_template' );
