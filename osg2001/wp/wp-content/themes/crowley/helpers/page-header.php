<?php
/**
 * The page header helpers.
 *
 * @package theme\helpers
 */

/**
 * Display a page title.
 *
 * @since 1.0.0
 */
function evolvethemes_page_title() {
	$title = '';
	$data_attrs = array();
	$classes = array();
	$evolvethemes_key = evolvethemes_theme_key();

	if ( is_search() ) {
		$title = sprintf( '&#8220;%s&#8221;', get_search_query() );
	} else if ( is_archive() ) {
		$title = get_the_archive_title();
	} else if ( is_404() ) {
		$title = __( 'Page not found', 'crowley' );
	} else {
		$title = get_the_title();
	}

	$title = apply_filters( 'evolvethemes_page_title', $title );

	if ( ! $title ) {
		return;
	}

	$classes[] = $evolvethemes_key . '-ph-t';

	if ( is_front_page() ) {
		$title_markup = 'h2';
	} else {
		$title_markup = 'h1';
	}

	printf( '<%s class="%s" %s><span>', esc_html( $title_markup ), esc_attr( implode( ' ', $classes ) ), esc_attr( implode( ' ', $data_attrs ) ) );
		echo wp_kses_post( $title );
	printf( '</span></%s>', esc_html( $title_markup ) );
}

/**
 * Disable the page header in the blog index.
 *
 * @since 1.0.0
 */
function crowley_disable_page_header() {
	if ( is_home() ) {
		remove_action( 'evolvethemes_page_content', 'evolvethemes_page_header', 5 );
	}
}

add_action( 'wp_head', 'crowley_disable_page_header' );

/**
 * Before page title.
 *
 * @since 1.0.0
 */
function crowley_page_before_title() {
	$evolvethemes_key = evolvethemes_theme_key();
	$classes = array();
	$before_title = '';

	$classes[] = $evolvethemes_key . '-ph-bt';

	if ( is_singular( 'post' ) ) {
		$before_title = evolvethemes_get_post_categories();
	} else if ( is_search() ) {
		$before_title = __( 'Search results for:', 'crowley' );
	} else if ( is_author() ) {
		$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
		$avatar = get_avatar_url( $author->data->ID );
		$before_title = evolvethemes_get_image( $avatar, array( 'lazy' => false ) );
	} else if ( is_archive() ) {
		$before_title = __( 'Archive for:', 'crowley' );
	} else if ( is_404() ) {
		$before_title = __( 'Error 404', 'crowley' );
	}

	$before_title = apply_filters( 'crowley_page_before_title', $before_title );

	if ( $before_title ) {
		printf( '<div class="%s-ph-bt_w">', esc_html( $evolvethemes_key ) );

		if ( is_author() ) {
			printf( '<div class="%s">%s</div>', esc_attr( implode( ' ', $classes ) ), wp_kses_post( $before_title ) );
		} else {
			printf( '<p class="%s">%s</p>', esc_attr( implode( ' ', $classes ) ), wp_kses_post( $before_title ) );
		}

		echo '</div>';
	}
}

/**
 * After page title.
 *
 * @since 1.0.0
 */
function crowley_page_after_title() {
	$evolvethemes_key = evolvethemes_theme_key();
	$classes = array();
	$after_title = '';

	$classes[] = $evolvethemes_key . '-ph-at';

	if ( is_singular( 'post' ) ) {
		$after_title = evolvethemes_get_entry_date();
	}
	if ( is_archive() ) {
		if ( is_author() ) {
			$after_title = get_the_author_meta( 'description' );
			$after_title = wpautop( wptexturize( $after_title ) );

			$classes[] = $evolvethemes_key . '-ph-at-author-bio';
		} else {
			$after_title = category_description();
		}
	}

	$after_title = apply_filters( 'crowley_page_after_title', $after_title );

	if ( $after_title ) {
		printf( '<div class="%s-ph-at_w">', esc_html( $evolvethemes_key ) );

		if ( is_archive() && is_author() ) {
			$author_title = apply_filters( 'crowley_author_title', '' );

			if ( $author_title ) {
				printf(
					'<p class="%s">%s</p>',
					esc_attr( $evolvethemes_key . '-ph-at ' . $evolvethemes_key . '-ph-at-author-title' ),
					esc_html( $author_title )
				);
			}

			$author_links = array();

			$url = get_the_author_meta( 'url' );

			if ( $url ) {
				$author_links[ $url ] = __( 'Website', 'crowley' );
			}

			$author_links = apply_filters( 'crowley_author_links', $author_links );

			if ( $author_links ) {
				printf(
					'<p class="%s">',
					esc_attr( $evolvethemes_key . '-ph-at ' . $evolvethemes_key . '-ph-at-author-links' )
				);

				foreach ( $author_links as $url => $link_text ) {
					printf(
						'<a href="%s">%s</a>',
						esc_url( $url ),
						esc_html( $link_text )
					);
				}

				echo '</p>';
			}

			printf( '<div class="%s">%s</div>', esc_attr( implode( ' ', $classes ) ), wp_kses_post( $after_title ) );
		} else {
			printf( '<p class="%s">%s</p>', esc_attr( implode( ' ', $classes ) ), wp_kses_post( $after_title ) );
		}

		echo '</div>';
	}
}

/**
 * Show the featured image.
 *
 * @since 1.0.0
 */
function crowley_page_header_featured_image() {
	if ( is_archive() || is_search() ) {
		return;
	}

	evolvethemes_get_image( get_post_thumbnail_id(), array( 'echo' => true ) );
}

add_action( 'crowley_page_header_end', 'crowley_page_header_featured_image' );
