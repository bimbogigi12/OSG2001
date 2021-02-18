<?php
/**
 * Image Helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\images\v1
 * @since 1.0.0
 */

/**
 * Get the proper markup for an image to be lazy-loaded.
 *
 * @since 1.0.0
 * @param integer|string $url Image ID or URL.
 * @param array          $args Arguments.
 * @return string
 */
function evolvethemes_get_image( $url, $args = array() ) {
	if ( ! $url ) {
		return '';
	}

	$theme_key = evolvethemes_theme_key();

	/* Preserving the original URL/ID, just in case. */
	$original_url = $url;

	/* If we're specifying an ID, declare the image as internal (uploaded through the Media Library). */
	$external = ! is_numeric( $url );

	/* CSS classes added to the <img> element. */
	$classes = array();

	if ( isset( $args['classes'] ) ) {
		if ( is_string( $args['classes'] ) ) {
			$classes = array_merge( $classes, explode( ' ', $args['classes'] ) );
		} elseif ( is_array( $args['classes'] ) ) {
			$classes = $args['classes'];
		}
	}

	$classes = apply_filters( $theme_key . '_lazy_image_classes', $classes );

	$figure_classes = apply_filters( $theme_key . '_image_figure_classes', array( 'evolvethemes-image' ) );

	/* Figure classes */
	if ( isset( $args['figure_classes'] ) ) {
		$figure_classes = array_merge( $figure_classes, (array) $args['figure_classes'] );
	}

	/* Image width. */
	$width = isset( $args['width'] ) ? intval( $args['width'] ) : '';

	/* Image height. */
	$height = isset( $args['height'] ) ? intval( $args['height'] ) : '';

	/* Image 'alt' attribute. */
	$alt = isset( $args['alt'] ) ? $args['alt'] : '';

	/* Image custom attributes. */
	$attrs = isset( $args['attrs'] ) ? (array) $args['attrs'] : array();

	/* Image caption. */
	$caption = isset( $args['caption'] ) ? $args['caption'] : '';

	/* Image caption class. */
	$caption_class = isset( $args['caption_class'] ) ? $args['caption_class'] : '';

	/* Image loading attribute. */
	$mode = isset( $args['mode'] ) ? $args['mode'] : 'srcset';

	if ( $external ) {
		$mode = 'src';
	}

	if ( ! $external ) {
		/* Image size. */
		$size = isset( $args['size'] ) ? $args['size'] : apply_filters( $theme_key . '_lazy_image_size_default', 'full' );

		/* Alt text. */
		$alt = get_post_meta( $url, '_wp_attachment_image_alt', true );

		$meta = wp_get_attachment_metadata( $url );

		if ( 'full' != $size && isset( $meta['sizes'][ $size ] ) ) {
			/* Natural image ratio. */
			$ratio = intval( $meta['sizes'][ $size ]['width'] ) / intval( $meta['sizes'][ $size ]['height'] );

			if ( ! $height ) {
				$height = $meta['sizes'][ $size ]['height'];
			} else {
				if ( ! $width ) {
					$width = $height * $ratio;
				}
			}

			if ( ! $width ) {
				$width = $meta['sizes'][ $size ]['width'];
			}
		} else {
			if ( $meta ) {
				/* Natural image ratio. */
				$ratio = intval( $meta['width'] ) / intval( $meta['height'] );

				if ( ! $height ) {
					if ( isset( $meta['height'] ) ) {
						$height = $meta['height'];
					}
				} else {
					if ( ! $width ) {
						$width = $height * $ratio;
					}
				}

				if ( ! $width ) {
					if ( isset( $meta['width'] ) ) {
						$width = $meta['width'];
					}
				}
			}
		}

		if ( $width ) {
			$attrs['width'] = $width;
		}

		if ( $height ) {
			$attrs['height'] = $height;
		}

		/* Extract the srcset attribute from the image. */
		if ( 'srcset' === $mode ) {
			$regular_markup = wp_get_attachment_image( $url, $size );

			preg_match( '/srcset=\"(.*?)\"/', $regular_markup, $srcset_matches, PREG_OFFSET_CAPTURE );

			if ( isset( $srcset_matches[1][0] ) ) {
				$url = $srcset_matches[1][0];
			} else {
				$mode = 'src';
				$url = wp_get_attachment_image_url( $url, $size );
			}
		} else {
			$url = wp_get_attachment_image_url( $url, $size );
		}
	}

	/* Set to true not to load images on page parsing. */
	$lazy = isset( $args['lazy'] ) ? (bool) $args['lazy'] : true;

	/* Image placeholder. */
	$placeholder = $url;

	if ( $lazy ) {
		$classes[] = 'evolvethemes-preloaded-image';

		$default_placeholder = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : $default_placeholder;
	}

	$placeholder = apply_filters( $theme_key . '_lazy_image_placeholder', $placeholder );

	$lazy_element_attrs = '';

	if ( $lazy ) {
		$lazy_element_attrs = sprintf(
			'data-%s="%s"',
			esc_attr( $mode ),
			esc_attr( $url )
		);
	}

	$attrs_markup = '';

	$attrs['alt'] = $alt;

	foreach ( $attrs as $a => $v ) {
		if ( 'src' === $a || 'alt' === $a || '' !== $v ) {
			$attrs_markup .= ' ' . $a . '="' . esc_attr( $v ) . '"';
		}
	}

	$img_html = '';

	$img_html .= sprintf(
		'<img %s %s="%s" class="%s" %s />',
		$lazy_element_attrs,
		esc_attr( $mode ),
		esc_attr( $placeholder ),
		esc_attr( implode( ' ', $classes ) ),
		$attrs_markup
	);

	if ( $caption ) {
		if ( true === $caption && ! $external ) {
			$caption = wp_get_attachment_caption( $original_url );
		}

		if ( $caption_class ) {
			$img_html .= sprintf(
				'<figcaption class="%s">%s</figcaption>',
				esc_attr( $caption_class ),
				wp_kses_post( $caption )
			);
		} else {
			$img_html .= sprintf( '<figcaption>%s</figcaption>', wp_kses_post( $caption ) );
		}
	}

	$html = sprintf(
		'<figure class="%s">%s</figure>',
		esc_attr( implode( ' ', $figure_classes ) ),
		$img_html
	);

	if ( isset( $args['echo'] ) && true === $args['echo'] ) {
		echo wp_kses_post( $html );
	}

	return $html;
}

/**
 * Add support for lazy loaded images even when we're escaping for output.
 *
 * @since 1.0.0
 * @param array $allowed_html An array of allowed HTMl attributes.
 * @return array
 */
function evolvethemes_images_wp_kses_allowed_html( $allowed_html ) {
	$allowed_html['img']['srcset'] = 1;
	$allowed_html['img']['data-src'] = 1;
	$allowed_html['img']['data-srcset'] = 1;

	return $allowed_html;
}

add_filter( 'wp_kses_allowed_html', 'evolvethemes_images_wp_kses_allowed_html' );
