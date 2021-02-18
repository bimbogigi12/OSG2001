<?php
/**
 * Template Helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\layout\v1
 * @since 1.0.0
 */

/**
 * Get the template of a page.
 *
 * @since 1.0.0
 * @param integer $post_id The page ID.
 * @return string
 */
function evolvethemes_get_page_template( $post_id = false ) {
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}

	$page_template = '';

	if ( ! get_post_type( $post_id ) === 'page' ) {
		return false;
	}

	if ( $post_id ) {
		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
	}

	if ( empty( $page_template ) ) {
		$page_template = 'default';
	}

	return $page_template;
}

/**
 * Load a template part based on the current context.
 *
 * @since 1.0.0
 * @param string $content_template The base template to load.
 * @param array  $params An array of parameters passed to the template.
 */
function evolvethemes_load_template( $content_template, $params = array() ) {
	$context = evolvethemes_get_context();

	extract( $params ); // @codingStandardsIgnoreLine

	foreach ( $context as $c ) {
		$located_template = locate_template( $content_template . '-' . $c . '.php' );

		if ( $located_template ) {
			include $located_template;

			return;
		}
	}

	$located_template = locate_template( $content_template . '.php' );

	if ( $located_template ) {
		include $located_template;
	}
}
