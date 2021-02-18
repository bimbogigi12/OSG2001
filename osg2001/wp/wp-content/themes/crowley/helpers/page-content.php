<?php
/**
 * The page content helpers.
 *
 * @package theme\helpers
 */

/**
 * Display the output for the page content.
 *
 * @since 1.0.0
 */
function evolvethemes_page_content_output() {
	$template = 'templates/page-content/content';

	if ( is_home() ) {
		$template = 'templates/page-content/content-loop';
	} elseif ( is_search() ) {
		$template = 'templates/page-content/content-loop-search';
	} elseif ( is_archive() ) {
		$template = 'templates/page-content/archive';
	} elseif ( is_attachment() ) {
		$template = 'templates/page-content/attachment';
	} elseif ( is_404() ) {
		$template = 'templates/page-content/404';
	}

	get_template_part( apply_filters( 'evolvethemes_page_content_output', $template ) );
}

/* Hooking the page content. */
add_action( 'evolvethemes_page_content', 'evolvethemes_page_content_output' );

/**
 * Add extra markup to the main sidebar.
 *
 * @since 1.0.0
 */
function crowley_main_widget_area_before() {
	$evolvethemes_key = evolvethemes_theme_key();

	printf( '<div class="%s-widgetarea_w-i">', esc_attr( $evolvethemes_key ) );
}

/**
 * Close the main sidebar extra markup
 *
 * @since 1.0.0
 */
function crowley_main_widget_area_after() {
	echo '</div>';

}

add_action( 'evolvethemes_widget_area_before[widgetarea:main-sidebar]', 'crowley_main_widget_area_before' );
add_action( 'evolvethemes_widget_area_after[widgetarea:main-sidebar]', 'crowley_main_widget_area_after' );

/**
 * Return the single post navigation template.
 *
 * @since 1.0.0
 */
function crowley_get_single_post_nav() {
	get_template_part( 'templates/single-post/single-post-nav' );
}

/**
 * Show the post navigation if is singular post and option is checked.
 *
 * @since 1.0.0
 */
function crowley_single_post_navigation() {
	if ( is_singular( 'post' ) ) {
		add_action( 'crowley_after_the_content', 'crowley_get_single_post_nav' );
	}
}

add_action( 'wp_head', 'crowley_single_post_navigation' );

/**
 * Return the post tags
 *
 * @since 1.0.0
 */
function crowley_single_post_metas() {
	if ( ! is_singular() ) {
		return;
	}

	$tags = evolvethemes_get_post_tags( '' );
	$evolvethemes_key = evolvethemes_theme_key();

	if ( ! empty( $tags ) ) {
		printf( '<div class="%s-sp-metas">', esc_attr( $evolvethemes_key ) );
			printf( '<div class="%s-sp-tags">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( $tags ) );
		echo '</div>';
	}
}

add_action( 'crowley_after_the_content', 'crowley_single_post_metas' );

/**
 * Convert the submit input of a password-protected post to a <button>.
 *
 * @since 1.0.0
 * @param string $html The form HTML.
 * @return string
 */
function crowley_the_password_form( $html ) {
	$html = str_replace( '<form action=', '<div class="crowley-post-pass_w"><form action=', $html );
	$html = str_replace( '</p></form>', '</p></form></div>', $html );
	$html = str_replace(
		'This content is password protected. To view it please enter your password below:',
		'<span>' . __( 'This content is password protected.', 'crowley' ) . '</span><span>' . __( 'To view it please enter your password below', 'crowley' ) . '</span>',
		$html
	);
	$html = str_replace(
		'Password:',
		'<span class="screen-reader-text">' . __( 'Password:', 'crowley' ) . '</span>',
		$html
	);
	$html = str_replace( '<input type="submit"', '<button type="submit"', $html );
	$html = str_replace(
		'/></p></form>', sprintf(
			'><span class="screen-reader-text">%s</span></button></p></form>',
			esc_html__( 'Enter', 'crowley' )
		), $html
	);

	return $html;
}

add_filter( 'the_password_form', 'crowley_the_password_form' );
