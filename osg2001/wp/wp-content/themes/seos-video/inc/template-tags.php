<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

if ( ! function_exists( 'seos_video_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function seos_video_posted_on() {
	$seos_video_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$seos_video_time_string = ' <i class="fa fa-clock-o"></i> <time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$seos_video_time_string = sprintf( $seos_video_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$seos_video_posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'seos-video' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $seos_video_time_string . '</a>'
	);

	$seos_video_byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'seos-video' ),
		'<span class="author vcard"> <i class="fa fa-male"></i> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $seos_video_posted_on . '</span><span class="byline"> ' . $seos_video_byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'seos_video_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function seos_video_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$seos_video_categories_list = get_the_category_list( esc_html__( ', ', 'seos-video' ) );
		if ( $seos_video_categories_list && seos_video_categorized_blog() ) {
			printf( '<i class="fa fa-folder-open"></i><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'seos-video' ) . '</span>', $seos_video_categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$seos_video_tags_list = get_the_tag_list( '', esc_html__( ', ', 'seos-video' ) );
		if ( $seos_video_tags_list ) {
			printf( ' <i class="fa fa-tags" aria-hidden="true"></i> <span class="tags-links">' . esc_html__( 'Tagged %1$s', 'seos-video' ) . '</span>', $seos_video_tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' <i class="fa fa-comment"></i><span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'seos-video' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( ' Edit %s', 'seos-video' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		' <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seos_video_categorized_blog() {
	if ( false === ( $seos_video_all_the_cool_cats = get_transient( 'seos_video_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$seos_video_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$seos_video_all_the_cool_cats = count( $seos_video_all_the_cool_cats );

		set_transient( 'seos_video_categories', $seos_video_all_the_cool_cats );
	}

	if ( $seos_video_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so seos_video_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so seos_video_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in seos_video_categorized_blog.
 */
function seos_video_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'seos_video_categories' );
}
add_action( 'edit_category', 'seos_video_category_transient_flusher' );
add_action( 'save_post',     'seos_video_category_transient_flusher' );
