<?php
/**
 * The page header template logic.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

/**
 * Get the template part relative to the page header.
 *
 * @since 1.0.0
 */
function evolvethemes_page_header() {
	$post_type = get_post_type();

	$template = 'templates/page-header/types/page-header-default';
	$template = apply_filters( 'evolvethemes_page_header_template', $template );
	$template = apply_filters( "evolvethemes_page_header_template[post_type:$post_type]", $template );

	get_template_part( $template );
}

add_action( 'evolvethemes_before_content', 'evolvethemes_page_header', 5 );
