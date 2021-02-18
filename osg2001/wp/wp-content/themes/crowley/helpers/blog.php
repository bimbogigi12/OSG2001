<?php
/**
 * Blog helpers.
 *
 * @package theme\helpers
 */

/**
 * Add a sizer block for the loop masonry component.
 *
 * @since 1.0.0
 */
function crowley_loop_start() {
	echo '<div class="crowley-sizer"></div>';
}

add_action( 'evolvethemes_loop_start', 'crowley_loop_start' );

/**
 * Define the CSS classes that are applied to loop items.
 *
 * @since 1.0.0
 * @param array    $classes An array of CSS classes.
 * @param WP_Query $query Main query object.
 * @return array
 */
function crowley_loop_post_classes( $classes, $query ) {
	if ( is_home() && 0 === $query->current_post && 0 === $query->query_vars['paged'] ) {
		$classes[] = 'crowley-highlight';
	}

	return $classes;
}

add_filter( 'crowley_loop_post_classes', 'crowley_loop_post_classes', 10, 2 );

/**
 * Enable the display of the first entry in loop posts.
 *
 * @since 1.0.0
 * @param WP_Query $query Main query object.
 * @return boolean
 */
function crowley_loop_first_entry( $query ) {
	if ( is_home() && 0 === $query->current_post && 0 === $query->query_vars['paged'] ) {
		return true;
	}

	return false;
}

/**
 * Adding the blog to the preloader queue.
 *
 * @since 1.0.0
 * @param array $config The preloader configuration.
 * @return array
 */
function crowley_preloader_blog_config( $config ) {
	if ( is_home() || is_archive() ) {
		$config[] = 'blog';
	}

	return $config;
}

add_filter( 'crowley_preloader_config', 'crowley_preloader_blog_config' );

/**
 * Change the pagination configuration.
 *
 * @since 1.0.0
 * @param array $config Configuration array.
 * @return array
 */
function crowley_loop_pagination_config( $config ) {
	$config['prev'] = '';
	$config['next'] = '';

	return $config;
}

add_filter( 'evolvethemes_loop_pagination_config', 'crowley_loop_pagination_config' );
