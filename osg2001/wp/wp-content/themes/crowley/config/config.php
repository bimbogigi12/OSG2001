<?php
/**
 * Theme configuration.
 *
 * @package theme\config
 */

/* Configuration base folder path. */
$evolvethemes_config_base_folder = trailingslashit( get_template_directory() . '/config' );

/* Templates folder path. */
$evolvethemes_templates_folder = trailingslashit( get_template_directory() . '/templates' );

/* Helpers folder path. */
$evolvethemes_helpers_folder = trailingslashit( get_template_directory() . '/helpers' );

/* Theme page configuration. */
require_once $evolvethemes_config_base_folder . 'theme-page.php';

/* Modules configuration. */
require_once $evolvethemes_config_base_folder . 'config-modules.php';

/* Global functionality and theme setup. */
require_once $evolvethemes_config_base_folder . 'global-functionality.php';

/* Blog helpers. */
require_once $evolvethemes_helpers_folder . 'blog.php';

/* Page content */
require_once $evolvethemes_helpers_folder . 'page-content.php';

/* Page header */
require_once $evolvethemes_helpers_folder . 'page-header.php';

/* Menu */
require_once $evolvethemes_helpers_folder . 'menu.php';

/* Header */
require_once $evolvethemes_helpers_folder . 'header.php';

/* Sidebar */
require_once $evolvethemes_helpers_folder . 'sidebar.php';

/* Comments */
require_once $evolvethemes_helpers_folder . 'comments.php';

/* Page header templates. */
require_once $evolvethemes_templates_folder . 'page-header/page-header.php';

/* Customizer. */
require_once $evolvethemes_config_base_folder . 'customizer/customizer.php';

/* Brix support. */
require_once $evolvethemes_config_base_folder . '/brix/brix.php';

/* Gutenberg support. */
require_once $evolvethemes_config_base_folder . '/gutenberg/gutenberg.php';

/* Jetpack support. */
require_once $evolvethemes_config_base_folder . '/jetpack/jetpack.php';

/* Contact Form 7 support. */
require_once $evolvethemes_config_base_folder . '/cf7/cf7.php';

/* Elementor support. */
require_once $evolvethemes_config_base_folder . '/elementor/elementor.php';

/* Beaver builder support. */
require_once $evolvethemes_config_base_folder . '/beaver/beaver.php';

/**
 * Define the theme key.
 *
 * @since 1.0.0
 * @return string
 */
function crowley_theme_key() {
	$theme_key = 'crowley';

	return $theme_key;
}

add_filter( 'evolvethemes_theme_key', 'crowley_theme_key' );

/**
 * Define the theme name.
 *
 * @since 1.0.0
 * @param  string $theme_name The theme name.
 * @return string
 */
function crowley_theme_name( $theme_name ) {
	$theme_name = 'Crowley';

	return $theme_name;
}

add_filter( 'evolvethemes_theme_name', 'crowley_theme_key' );
