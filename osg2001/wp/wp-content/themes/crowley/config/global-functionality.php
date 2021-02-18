<?php
/**
 * The global theme functionality.
 *
 * @package WordPress
 * @subpackage config
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) { // @codingStandardsIgnoreLine
	/* Set the content width based on the theme's design and stylesheet. */
	$content_width = 0; // @codingStandardsIgnoreLine
}

/**
 * Theme setup.
 *
 * @since 1.0.0
 */
function crowley_theme_setup() {
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'crowley' ),
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	/* Add support for the custom logo. */
	add_theme_support( 'custom-logo' );

	/* Add the support for the custom header. */
	add_theme_support(
		'custom-header', array(
			'width' => 1440,
			'height' => 320,
		)
	);

	/* Add the support for custom backgrounds. */
	add_theme_support( 'custom-background' );
}

add_action( 'after_setup_theme', 'crowley_theme_setup' );

/**
 * Register the theme sidebars.
 *
 * @since 1.0.0
 */
function crowley_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Widget Area', 'crowley' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'crowley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 1', 'crowley' ),
			'id'            => 'footer-sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the first footer column.', 'crowley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 2', 'crowley' ),
			'id'            => 'footer-sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in the second footer column.', 'crowley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 3', 'crowley' ),
			'id'            => 'footer-sidebar-3',
			'description'   => esc_html__( 'Add widgets here to appear in the third footer column.', 'crowley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);
}

add_action( 'widgets_init', 'crowley_widgets_init' );

/**
 * Enqueue the assets that are required by the theme.
 *
 * @since 1.0.0
 */
function crowley_enqueue_main_stylesheet() {
	$evolvethemes_key = evolvethemes_theme_key();

	/* Main style dependencies. */
	$theme_style_dependencies = apply_filters( 'evolvethemes_theme_main_style_dependencies', array( 'wp-mediaelement' ) );

	/* Main stylesheet. */
	wp_enqueue_style( $evolvethemes_key . '-icons', get_template_directory_uri() . '/fonts/theme_icons/crowley_theme_icons.css', array(), '1.0.0' );
	wp_enqueue_style( $evolvethemes_key . '-style', get_template_directory_uri() . '/css/theme-style.css', array(), '1.0.0' );

	if ( is_child_theme() ) {
		/* Including the parent theme stylesheet in the event that we're using a child theme. */
		wp_enqueue_style( $evolvethemes_key . '-child-style', get_stylesheet_directory_uri() . '/style.css', array( $evolvethemes_key . '-style' ), '1.0.0' );
	}

	/* Theme scripts. */
	$theme_script_dependencies = array( 'evolvethemes-preloader', 'evolvethemes-fonts', 'evolvethemes-images', 'jquery' );
	$theme_script_dependencies = apply_filters( 'evolvethemes_theme_main_style_dependencies', $theme_script_dependencies );

	wp_enqueue_script( $evolvethemes_key . '-fitvids', get_template_directory_uri() . '/js/libs/jquery.fitvids.js', $theme_script_dependencies, '1.0.0', true );
	wp_enqueue_script( $evolvethemes_key . '-script', get_template_directory_uri() . '/js/crowley.js', $theme_script_dependencies, '1.0.0', true );
	wp_enqueue_script( $evolvethemes_key . '-menu-script', get_template_directory_uri() . '/js/crowley-menu.js', array( 'jquery', $evolvethemes_key . '-script' ), '1.0.0', true );

	if ( is_home() || is_archive() || is_singular() || is_search() ) {
		wp_enqueue_script( $evolvethemes_key . '-blog-script', get_template_directory_uri() . '/js/crowley-blog.js', array( 'masonry', $evolvethemes_key . '-script' ), '1.0.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		/* If we're in a single post page with comments ON, include the threaded comments JavaScript helper. */
		wp_enqueue_script( 'comment-reply' );
	}

	/* Main script localization. */
	wp_localize_script(
		$evolvethemes_key . '-script', $evolvethemes_key, apply_filters(
			'crowley_localize_script',
			array()
		)
	);
}

add_action( 'evolvethemes_assets_styles', 'crowley_enqueue_main_stylesheet' );

/**
 * Configurate the theme preloader.
 *
 * @since 1.0.0
 * @param array $config The theme localization array.
 * @return array
 */
function crowley_preloader_config( $config ) {
	$config['preloader'] = array(
		'fonts',
	);

	$config['preloader'] = apply_filters( 'crowley_preloader_config', $config['preloader'] );

	return $config;
}

add_filter( 'crowley_localize_script', 'crowley_preloader_config' );

/**
 * Modify the page title in archive pages.
 *
 * @since 1.0.0
 * @param string $title The page title.
 * @return string
 */
function crowley_get_the_archive_title( $title ) {
	if ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'crowley_get_the_archive_title' );
