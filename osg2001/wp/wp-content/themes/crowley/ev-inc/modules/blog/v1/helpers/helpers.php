<?php
/**
 * Blog helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\blog\v1
 * @since 1.0.0
 */

/**
 * Add an extra class to the sticky entry.
 *
 * @since 1.0.0
 * @param  array $classes The entry title classes.
 * @return array
 */
function evolvethemes_entry_title_sticky_class( $classes ) {
	$theme_key = evolvethemes_theme_key();

	if ( is_sticky() ) {
		$classes[] = $theme_key . '-sticky';
	}

	return $classes;
}

add_filter( 'evolvethemes_entry_title_classes', 'evolvethemes_entry_title_sticky_class' );

/**
 * Determine whether blog/site has more than one category.
 *
 * @since 1.0.0
 * @return bool True of there is more than one category, false otherwise.
 */
function evolvethemes_categorized_blog() {
	$all_the_cool_cats = get_transient( 'evolvethemes_categories' );

	if ( false === $all_the_cool_cats ) {
		/* Create an array of all the categories that are attached to posts. */
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				/* We only need to know if there is more than one category. */
				'number'     => 2,
			)
		);

		/* Count the number of categories that are attached to the posts. */
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'evolvethemes_categories', $all_the_cool_cats );
	}

	return $all_the_cool_cats > 1;
}

/**
 * Refresh whether blog/site has more than one category.
 *
 * @since 1.0.0
 */
function evolvethemes_refresh_categorized_transient() {
	delete_transient( 'evolvethemes_categories' );
	evolvethemes_categorized_blog();
}

add_action( 'edited_category', 'evolvethemes_refresh_categorized_transient' );
add_action( 'create_category', 'evolvethemes_refresh_categorized_transient' );
add_action( 'delete_category', 'evolvethemes_refresh_categorized_transient' );

/**
 * Get the post categories if the theme is using more than one category.
 *
 * @since 1.0.0
 * @param string $separator Used between categories.
 * @return string
 */
function evolvethemes_get_post_categories( $separator = ', ' ) {
	$categories_list = get_the_category_list( $separator );

	if ( $categories_list ) {
		return $categories_list;
	}

	return '';
}

/**
 * Display the post categories
 *
 * @since 1.0.0
 */
function evolvethemes_post_categories() {
	$theme_key = evolvethemes_theme_key();
	$categories = evolvethemes_get_post_categories();

	if ( $categories ) {
		printf(
			'<div class="%s-cl">%s</div>',
			esc_attr( $theme_key ),
			wp_kses_post( $categories )
		);
	}
}

/**
 * Get the post tags.
 *
 * @since 1.0.0
 * @param string $separator Used between tags.
 * @return string
 */
function evolvethemes_get_post_tags( $separator = ', ' ) {
	$tag_list = get_the_tag_list( '', $separator, '' );

	if ( $tag_list ) {
		return $tag_list;
	}

	return '';
}

/**
 * Display the post tags.
 *
 * @since 1.0.0
 */
function evolvethemes_post_tags() {
	$theme_key = evolvethemes_theme_key();
	$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'crowley' ) );

	if ( $tags_list ) {
		printf(
			'<div class="%s-tl">%s</div>',
			esc_attr( $theme_key ),
			wp_kses_post( $tags_list )
		);
	}
}
