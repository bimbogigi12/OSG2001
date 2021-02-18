<?php
/**
 * Custom widgets.
 *
 * @package balanced_blog
 */

if ( ! function_exists( 'balanced_blog_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function balanced_blog_load_widgets() {

		// Extended Recent Post.
		register_widget( 'balanced_blog_Extended_Recent_Posts' );

		// Popular Post.
		register_widget( 'balanced_blog_Popular_Posts' );

	}

endif;

add_action( 'widgets_init', 'balanced_blog_load_widgets' );

/**
 * Recent Posts Widget
 */
require get_template_directory() . '/includes/widgets/recent-posts.php';

/**
 * Popular Posts Widget
 */
require get_template_directory() . '/includes/widgets/popular-posts.php';
