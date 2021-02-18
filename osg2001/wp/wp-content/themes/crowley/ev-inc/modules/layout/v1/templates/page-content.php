<?php
/**
 * Page content templates.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\layout\v1
 * @since 1.0.0
 */

/**
 * Display the site page content according to the page context.
 *
 * @since 1.0.0
 */
function evolvethemes_page_content() {
	$key = 'evolvethemes_page_content';

	evolvethemes_do_action( "${key}_before" );

		evolvethemes_do_action( $key );

	evolvethemes_do_action( "${key}_after" );
}

/**
 * Display a loop of posts.
 *
 * @since 1.0.0
 * @param array $args The loop arguments.
 */
function evolvethemes_loop( $args = array() ) {
	$query = apply_filters( 'evolvethemes_loop_query', isset( $args['query'] ) ? $args['query'] : false );

	if ( ! $query ) {
		global $wp_query;

		$query = $wp_query;
	}

	$theme_key    = evolvethemes_theme_key();
	$content_base = apply_filters( 'evolvethemes_loop_content_base_template', 'content' );

	$params = array(
		'query' => $query,
	);

	if ( $query->have_posts() ) {
		$loop_classes = array(
			$theme_key . '-l-w',
		);

		$loop_classes = apply_filters( 'evolvethemes_loop_classes', $loop_classes );

		printf(
			'<div class="%s" id="%s">',
			esc_attr( implode( ' ', $loop_classes ) ),
			esc_attr( $theme_key . '-l-w' )
		);

		do_action( 'evolvethemes_loop_start' );

		while ( $query->have_posts() ) {
			$query->the_post();

			$content_template = apply_filters( 'evolvethemes_loop_content_template', $content_base );

			evolvethemes_load_template( $content_template, $params );
		}

		do_action( 'evolvethemes_loop_end' );

		echo '</div>';
	} else {
		$content_template = $content_base . '-none';

		evolvethemes_load_template( $content_template, $params );
	}

	wp_reset_postdata();

	$pagination_config = isset( $args['pagination'] ) ? $args['pagination'] : array(
		'query' => $query,
	);

	$pagination_config = apply_filters( 'evolvethemes_loop_pagination_config', $pagination_config );

	evolvethemes_pagination( $pagination_config );
}

/**
 * Display the posts navigation.
 *
 * @since 1.0.0
 * @param array $config Configuration array.
 */
function evolvethemes_pagination( $config = array() ) {
	$html = evolvethemes_get_pagination( $config );

	if ( $html ) {
		$theme_key = evolvethemes_theme_key();

		ob_start();
		posts_nav_link( ' &#183; ', 'previous page', 'next page' );
		ob_end_clean();

		printf( '<div class="%s-page-navigation">', esc_attr( $theme_key ) );
			echo wp_kses_post( $html );
		echo '</div>';
	}

	evolvethemes_do_action( 'evolvethemes_pagination' );
}

/**
 * Get the posts navigation markup.
 *
 * @since 1.0.0
 * @param array $config Configuration array.
 * @return string
 */
function evolvethemes_get_pagination( $config = array() ) {
	if ( false === $config ) {
		return '';
	}

	global $wp_query;

	$config = wp_parse_args(
		$config, array(
			'query' => $wp_query,
			'title' => __( 'Posts navigation', 'crowley' ),
			'range' => 1,
			'prev'  => '&lsaquo;',
			'next'  => '&rsaquo;',
		)
	);

	$query = $config['query'];
	$title = $config['title'];
	$range = $config['range'];
	$prev  = $config['prev'];
	$next  = $config['next'];

	$allowed_html = array(
		'span' => array(
			'class' => array(),
		),
	);

	/* Total number of pages. */
	$pages = $query->max_num_pages ? absint( $query->max_num_pages ) : 1;

	if ( $pages <= 1 ) {
		return '';
	}

	$html = '';

	/* Current page. */
	$paged = 1;

	if ( get_query_var( 'paged' ) ) {
		$paged = absint( get_query_var( 'paged' ) );
	} elseif ( get_query_var( 'page' ) ) {
		$paged = absint( get_query_var( 'page' ) );
	}

	/* Link back to the first page. */
	$show_first = true;

	/* Link to the last page. */
	$show_last = true;

	/* Link to the next page. */
	$show_next = $paged < $pages;

	/* Link to the previous page. */
	$show_prev = $paged > 1;

	$html .= '<nav class="navigation pagination">';
	if ( ! empty( $config['title'] ) ) {
		$html .= sprintf( '<h2 class="screen-reader-text">%s</h2>', esc_html( $config['title'] ) );
	}

		$link = '<a class="%s page-numbers" title="%s" href="%s">%s</a>';
		$current = '<span class="%s page-numbers" title="%s" href="%s">%s</span>';

		$html .= '<div class="nav-links">';
	if ( $show_next ) {
		$html .= sprintf(
			'<a class="next page-numbers" title="%s" href="%s">%s</a>',
			esc_attr( __( 'Go to the next page', 'crowley' ) ),
			esc_attr( get_pagenum_link( $paged + 1 ) ),
			esc_html( $next )
		);
	}

	if ( $show_first ) {
		$show_first_class = '';
		$show_first_html = $link;

		if ( 1 == $paged ) {
			$show_first_class = 'current';
			$show_first_html = $current;
		}

		$html .= sprintf(
			$show_first_html,
			esc_attr( $show_first_class ),
			esc_attr( __( 'Go to the first page', 'crowley' ) ),
			esc_attr( get_pagenum_link( 1 ) ),
			esc_html( 1 )
		);
	}

	if ( $paged - $range > 2 ) {
		$html .= '<span class="page-numbers dots">&hellip;</span>';
	}

	for ( $i = 2; $i < $pages; $i++ ) {
		if ( $i <= $paged + $range && $i >= $paged - $range ) {
			$number_class = '';
			$number_html = $link;

			if ( $i == $paged ) {
				$number_class = 'current';
				$number_html = $current;
			}

			/* translators: page number */
			$text = sprintf( wp_kses( __( '<span class="meta-nav screen-reader-text">Page </span>%s', 'crowley' ), $allowed_html ), $i );

			$html .= sprintf(
				$number_html,
				esc_attr( $number_class ),
				/* translators: page number */
				esc_attr( sprintf( __( 'Go to page number %s', 'crowley' ), $i ) ),
				esc_attr( get_pagenum_link( $i ) ),
				wp_kses_post( $text ),
				esc_html( $i )
			);
		}
	}

	if ( $paged < $pages - $range - 1 ) {
		$html .= '<span class="page-numbers dots">&hellip;</span>';
	}

	if ( $show_last ) {
		$show_last_class = '';
		$show_last_html = $link;

		if ( $pages == $paged ) {
			$show_last_class = 'current';
			$show_last_html = $current;
		}

		$html .= sprintf(
			$show_last_html,
			esc_attr( $show_last_class ),
			esc_attr( __( 'Go to the last page', 'crowley' ) ),
			esc_attr( get_pagenum_link( $pages ) ),
			esc_html( $pages )
		);
	}

	if ( $show_prev ) {
		$html .= sprintf(
			'<a class="prev page-numbers" title="%s" href="%s">%s</a>',
			esc_attr( __( 'Go to the previous page', 'crowley' ) ),
			esc_attr( get_pagenum_link( $paged - 1 ) ),
			esc_html( $prev )
		);
	}
		$html .= '</div>';
	$html .= '</nav>';

	return $html;
}

/**
 * Return the single post title.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_get_entry_title() {
	$entry_title = get_the_title();

	if ( empty( $entry_title ) ) {
		$entry_title = __( 'No title', 'crowley' );
	}

	return $entry_title;
}

/**
 * Display the comments count for the current entry.
 *
 * @since 1.0.0
 * @param boolean $numeric True if the output should be numeric.
 */
function evolvethemes_comments_number( $numeric = false ) {
	global $post;

	if ( $numeric ) {
		comments_number( '0', '1', '%' );
	} else {
		comments_number( esc_html__( 'No comments', 'crowley' ), esc_html__( '1 comment', 'crowley' ), esc_html__( '% comments', 'crowley' ) );
	}
}

/**
 * Display the image meta attachment link.
 *
 * @since 1.0.0
 */
function evolvethemes_image_meta() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$metadata = wp_get_attachment_metadata();
		printf(
			'<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			esc_html_x( 'Full size', 'Used before full size attachment link.', 'crowley' ),
			esc_url( wp_get_attachment_url() ),
			esc_html( $metadata['width'] ),
			esc_html( $metadata['height'] )
		);
	}
}
