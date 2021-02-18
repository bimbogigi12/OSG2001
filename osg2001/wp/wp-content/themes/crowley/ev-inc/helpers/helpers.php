<?php
/**
 * General helpers.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Return the theme name.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_theme_name() {
	$theme_name = '';

	return apply_filters( 'evolvethemes_theme_name', $theme_name );
}

/**
 * Return the theme key.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_theme_key() {
	$theme_key = '';

	return apply_filters( 'evolvethemes_theme_key', $theme_key );
}

/**
 * HTML classes
 *
 * @since 1.0.0
 */
function evolvethemes_html_class() {
	$classes = array();

	$classes = apply_filters( 'evolvethemes_html_class', $classes );

	echo esc_attr( implode( ' ', $classes ) );
}

/**
 * CSS classes applied to the body of the page.
 *
 * @since 1.0.0
 * @param array $class An array of CSS classes.
 * @return array
 */
function evolvethemes_body_class( $class ) {
	$theme_key = evolvethemes_theme_key();

	$mobile = function_exists( 'jetpack_is_mobile' ) ? jetpack_is_mobile() : wp_is_mobile(); // @codingStandardsIgnoreLine

	if ( $mobile ) {
		$class[] = $theme_key . '-mobile';
	}

	return $class;
}

add_filter( 'body_class', 'evolvethemes_body_class' );

/**
 * Gets the current post type in the WordPress Admin.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_admin_get_current_post_type() {
	global $post, $typenow, $current_screen, $pagenow;

	if ( $post && $post->post_type ) {
		return $post->post_type;
	} elseif ( $typenow ) {
		return $typenow;
	} elseif ( $current_screen && $current_screen->post_type ) {
		return $current_screen->post_type;
	} elseif ( isset( $_REQUEST['post_type'] ) ) {
		return sanitize_key( $_REQUEST['post_type'] );
	} elseif ( isset( $_REQUEST['post'] ) ) {
		return get_post_type( sanitize_key( $_REQUEST['post'] ) );
	} elseif ( $pagenow && 'post-new.php' == $pagenow ) {
		return 'post';
	}

	return null;
}

/**
 * Get contents from a template.
 *
 * @since 1.0.0
 * @param string  $path The full path to the template file.
 * @param array   $data The data array to be passed to the template.
 * @param boolean $echo True to echo the template part.
 * @return string
 */
function evolvethemes_template( $path, $data = array(), $echo = true ) {
	$path = evolvethemes_string_ensure_right( $path, '.php' );

	if ( file_exists( $path ) ) {
		extract( $data ); // @codingStandardsIgnoreLine

		if ( ! $echo ) {
			ob_start();
			include $path;
			$content = ob_get_contents();
			ob_end_clean();

			return $content;
		} else {
			include $path;
		}
	}

	return '';
}

/**
 * Get contents from a partial template. If we're in a child theme, the
 * function will attempt to look for the resource in the child theme directory
 * first.
 *
 * @since 1.0.0
 * @param string  $file The template file.
 * @param array   $data The data array to be passed to the template.
 * @param boolean $echo True to echo the template part.
 * @return string
 */
function evolvethemes_get_template_part( $file, $data = array(), $echo = true ) {
	$file = evolvethemes_string_ensure_right( $file, '.php' );
	$path = locate_template( $file );

	return evolvethemes_template( $path, $data, $echo );
}

/**
 * Read an SVG file and return its contents.
 *
 * @since 1.0.0
 * @param string $path The path to the file relative to the plugins' path.
 * @return string
 */
function evolvethemes_load_svg( $path ) {
	$svg = trailingslashit( get_template_directory() ) . $path;

	if ( file_exists( $svg ) ) {
		return implode( '', file( $svg ) );
	}

	return '';
}

/**
 * Display the contents of an SVG file.
 *
 * @since 1.0.0
 * @param string $path The path to the file relative to the plugins' path.
 */
function evolvethemes_svg( $path ) {
	echo evolvethemes_load_svg( $path ); // @codingStandardsIgnoreLine
}

/**
 * Check if a string contains a particular substring.
 *
 * @since 1.0.0
 * @param string $haystack The string to search in.
 * @param string $needle The substring to look for.
 * @return boolean
 */
function evolvethemes_string_contains( $haystack, $needle ) {
	return strpos( $haystack, $needle ) !== false;
}

/**
 * Check if a string ends with particular substring.
 *
 * @since 1.0.0
 * @param string $haystack The string to search in.
 * @param string $needle The substring to look for.
 * @return boolean
 */
function evolvethemes_string_ends_with( $haystack, $needle ) {
	$length = strlen( $needle );

	if ( 0 === $length ) {
		return true;
	}

	return ( substr( $haystack, -$length ) === $needle );
}

/**
 * Check if a string ends with particular substring.
 *
 * @since 1.0.0
 * @param string $haystack The string to search in.
 * @param string $needle The substring to look for.
 * @return boolean
 */
function evolvethemes_string_starts_with( $haystack, $needle ) {
	$length = strlen( $needle );
	return ( substr( $haystack, 0, $length ) === $needle );
}

/**
 * Ensure that a string starts with a particular substring.
 *
 * @since 1.0.0
 * @param string $haystack The string to search in.
 * @param string $needle The substring to look for.
 * @return string The modified string, if needed.
 */
function evolvethemes_string_ensure_left( $haystack, $needle ) {
	if ( ! evolvethemes_string_starts_with( $haystack, $needle ) ) {
		return $needle . $haystack;
	}

	return $haystack;
}

/**
 * Ensure that a string starts with a particular substring.
 *
 * @since 1.0.0
 * @param string $haystack The string to search in.
 * @param string $needle The substring to look for.
 * @return string The modified string, if needed.
 */
function evolvethemes_string_ensure_right( $haystack, $needle ) {
	if ( ! evolvethemes_string_ends_with( $haystack, $needle ) ) {
		return $haystack . $needle;
	}

	return $haystack;
}

/**
 * Return the context string of the current page.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_get_context() {
	$context = array();

	/* Get the currently queried object. */
	$object = get_queried_object();
	$object_id = get_queried_object_id();

	if ( is_front_page() ) {
		/* Front page. */
		$context[] = 'home';
	}

	if ( is_home() ) {
		/* Blog page. */
		$context[] = 'blog';
	} elseif ( is_singular() ) {
		/* Singular views. */
		$context[] = 'singular';
		$context[] = "singular-{$object->post_type}";
		$context[] = "singular-{$object->post_type}-{$object_id}";

		if ( 'page' === $object->post_type ) {
			$templates = wp_get_theme()->get_page_templates( $object );
			$page_template = evolvethemes_get_page_template( $object_id );
			$template = '';

			if ( in_array( $page_template, array_keys( $templates ) ) ) {
				$template = current( $templates );
			} else {
				$template = $page_template;
			}

			$template = sanitize_title( $template );

			$context[] = 'page-template-' . $template;
		}
	} elseif ( is_archive() ) {
		/* Archive views. */
		$context[] = 'archive';

		if ( is_post_type_archive() ) {
			/* Post type archives. */
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			$context[] = "archive-{$post_type->name}";
		}

		if ( is_tax() || is_category() || is_tag() ) {
			/* Taxonomy archives. */
			$context[] = 'taxonomy';
			$context[] = "taxonomy-{$object->taxonomy}";
			$slug = ( ( 'post_format' == $object->taxonomy ) ? str_replace( 'post-format-', '', $object->slug ) : $object->slug );
			$context[] = "taxonomy-{$object->taxonomy}-" . sanitize_html_class( $slug, $object->term_id );
		}

		if ( is_author() ) {
			/* User/author archives. */
			$user_id = get_query_var( 'author' );
			$context[] = 'user';
			$context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', $user_id ), $user_id );
		}

		if ( is_date() ) {
			/* Date archives. */
			$context[] = 'date';

			if ( is_year() ) {
				$context[] = 'year';
			}

			if ( is_month() ) {
				$context[] = 'month';
			}

			if ( get_query_var( 'w' ) ) {
				$context[] = 'week';
			}

			if ( is_day() ) {
				$context[] = 'day';
			}
		}

		if ( is_time() ) {
			/* Time archives. */
			$context[] = 'time';

			if ( get_query_var( 'hour' ) ) {
				$context[] = 'hour';
			}

			if ( get_query_var( 'minute' ) ) {
				$context[] = 'minute';
			}
		}
	} elseif ( is_search() ) {
		/* Search results. */
		$context[] = 'search';
	} elseif ( is_404() ) {
		/* Error 404 pages. */
		$context[] = 'error-404';
	} // End if().

	$context = apply_filters( 'evolvethemes_get_context', array_unique( $context ) );

	return array_map( 'esc_attr', array_reverse( $context ) );
}

/**
 * Perform action hooks according to the context and optionally external data.
 *
 * @since 1.0.7
 * @param string $key The hook key.
 * @param array  $data The external data.
 */
function evolvethemes_do_action( $key, $data = array() ) {
	do_action( $key );

	/* Optionally filter the passed data. */
	$data = apply_filters( 'evolvethemes_do_action_data', $data );
	$data = apply_filters( "${key}_data", $data );

	$context = evolvethemes_get_context();

	foreach ( $context as $k => $v ) {
		do_action( $key . "[context:$v]" );
	}

	foreach ( $data as $k => $v ) {
		do_action( $key . "[$k:$v]" );
	}
}

/**
 * Return the entry date element for the current post in a loop.
 *
 * @since 1.0.0
 * @param string $classes An optional set of CSS classes to be passed to the time element.
 * @return string
 */
function evolvethemes_get_entry_date( $classes = '' ) {
	$time_string = '<time class="entry-date published updated ' . esc_attr( $classes ) . '" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published ' . esc_attr( $classes ) . '" datetime="%1$s">%2$s</time><time class="updated screen-reader-text' . esc_attr( $classes ) . '" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	return $time_string;
}

/**
 * Display the entry date element for the current post in a loop.
 *
 * @since 1.0.0
 * @param string $classes An optional set of CSS classes to be passed to the time element.
 */
function evolvethemes_entry_date( $classes = '' ) {
	echo evolvethemes_get_entry_date( $classes ); // @codingStandardsIgnoreLine
}

/**
 * Return the post author element for the current post in a loop.
 *
 * @since 1.0.0
 * @param boolean $avatar Set to true to display the author avatar.
 * @param boolean $only_avatar Set to true to display exclusively the author avatar.
 * @return string
 */
function evolvethemes_get_entry_author( $avatar = false, $only_avatar = false ) {
	global $post;

	$post_author = '';

	if ( $post ) {
		$author_id  = $post->post_author;

		if ( ! $author_id ) {
			return '';
		}

		$avatar_img = '';

		if ( true == $avatar ) {
			$avatar_img = get_avatar( $author_id, 80 );
		}

		if ( true != $only_avatar ) {
			$post_author = '<span class="author vcard"><a class="url fn" href="%1$s">%2$s<span>%3$s</span></a></span>';

			$post_author = sprintf(
				$post_author,
				esc_url( get_author_posts_url( $author_id ) ),
				$avatar_img,
				esc_html( get_the_author_meta( 'display_name', $author_id ) )
			);
		} else {
			$post_author = $avatar_img;
		}
	}

	return $post_author;
}

/**
 * Display the post author element for the current post in a loop.
 *
 * @since 1.0.0
 * @param boolean $avatar Set to true to display the author avatar.
 */
function evolvethemes_entry_author( $avatar = false ) {
	echo evolvethemes_get_entry_author( $avatar ); // @codingStandardsIgnoreLine
}

/**
 * Return the theme object.
 *
 * @since 1.0.0
 * @return WP_Theme
 */
function evolvethemes_get_theme() {
	$theme = new stdClass();

	if ( ! is_child_theme() ) {
		$theme = wp_get_theme();
	} else {
		$child_theme = wp_get_theme();
		$theme = wp_get_theme( $child_theme->get( 'Template' ) );
	}

	return $theme;
}

/**
 * Display custom classes and attributes for the element that should define the
 * title of an entry in a loop.
 *
 * @since 1.0.0
 * @param array $classes An array of CSS classes.
 */
function evolvethemes_entry_title_attrs( $classes = array() ) {
	$classes = (array) $classes;

	$classes[] = 'entry-title';
	$classes = apply_filters( 'evolvethemes_entry_title_classes', $classes );

	$attrs = array();
	$attrs = apply_filters( 'evolvethemes_entry_title_attrs', $attrs );

	printf(
		'class="%s" %s',
		implode( ' ', array_map( 'esc_attr', $classes ) ),
		implode( ' ', array_map( 'esc_attr', $attrs ) )
	);
}

/**
 * Add support for the <time> element when escaping with wp_kses*.
 *
 * @since 1.0.0
 * @param array $allowed_html An array of allowed HTMl attributes.
 * @return array
 */
function evolvethemes_entry_date_wp_kses_allowed_html( $allowed_html ) {
	if ( ! isset( $allowed_html['time'] ) ) {
		$allowed_html['time'] = array();
	}

	$allowed_html['time']['class'] = 1;
	$allowed_html['time']['datetime'] = 1;

	return $allowed_html;
}

add_filter( 'wp_kses_allowed_html', 'evolvethemes_entry_date_wp_kses_allowed_html' );
