<?php
/**
 *  Setup.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Theme setup
 *
 * @since 1.0.0
 */
function evolvethemes_theme_setup() {
	/*
	 * Make theme available for translation.
	 *
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'crowley', get_template_directory() . '/languages' );

	if ( is_child_theme() ) {
		/* Also load the child theme text domain. */
		load_theme_textdomain( wp_get_theme()->stylesheet, get_stylesheet_directory() . '/languages' );

		/* Also load the parent theme text domain so that we can translate the parent as well from the child. */
		load_theme_textdomain( 'crowley', get_stylesheet_directory() . '/languages' );
	}

	/* Add default posts and comments RSS feed links to head. */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 *
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/* Add theme support for selective refresh for widgets. */
	add_theme_support( 'customize-selective-refresh-widgets' );
}

add_action( 'after_setup_theme', 'evolvethemes_theme_setup' );

/**
 * Enqueue the scripts and styles that are required by the theme.
 *
 * @since 1.0.0
 */
function evolvethemes_assets() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		/* If we're in a single post page with comments ON, include the threaded comments JavaScript helper. */
		wp_enqueue_script( 'comment-reply' );
	}

	/* Theme stylesheets. */
	evolvethemes_do_action( 'evolvethemes_assets_styles' );

	/* Theme scripts. */
	evolvethemes_do_action( 'evolvethemes_assets_scripts' );
}

/* Adds the scripts and styles to the page. */
add_action( 'wp_enqueue_scripts', 'evolvethemes_assets' );
