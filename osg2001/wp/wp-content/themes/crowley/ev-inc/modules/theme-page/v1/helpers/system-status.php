<?php
/**
 * System status Helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\theme-page\v1
 * @since 1.0.0
 */

/**
 * Add the system status tab.
 *
 * @param  array $tabs The theme page tabs array.
 * @return array
 */
function evolvethemes_system_status_tab( $tabs ) {
	$tabs[] = array(
		'slug' => 'system-status',
		'title' => __( 'System status', 'crowley' ),
		'content' => trailingslashit( get_template_directory() ) . 'ev-inc/modules/theme-page/v1/templates/system-status.php',
	);

	return $tabs;
}

add_filter( 'evolvethemes_theme_page_tabs', 'evolvethemes_system_status_tab', 20 );

/**
 * Get the computed value of Max File Upload.
 *
 * @since 1.0.0
 * @return string
 */
function evolvethemes_max_file_upload_in_bytes() {
	$max_file_upload = wp_max_upload_size();
	$max_file_upload = ( $max_file_upload / ( 1024 * 1024 ) ) . 'M';

	return $max_file_upload;
}

/**
 * Get the system status report.
 *
 * @since 1.0.0
 * @return array
 */
function evolvethemes_system_status() {
	$status = array();

	/* Data. */
	$memory = WP_MEMORY_LIMIT;
	$memory_codex_url = 'https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP';

	if ( function_exists( 'memory_get_usage' ) ) {
		$system_memory = ini_get( 'memory_limit' );
		$memory        = max( intval( $memory ), intval( $system_memory ) );
		$memory        .= 'M';
	}

	$debug = defined( 'WP_DEBUG' ) && WP_DEBUG;
	$debug_codex_url = 'https://codex.wordpress.org/Editing_wp-config.php#Debug';

	$php_version = phpversion();
	$php_post_max_size = ini_get( 'post_max_size' );
	$php_time_limit = ini_get( 'max_execution_time' );
	$php_max_input_vars = ini_get( 'max_input_vars' );
	$php_max_file_upload = evolvethemes_max_file_upload_in_bytes();

	$plugins = array();
	$active_plugins = get_option( 'active_plugins' );
	$all_plugins = get_plugins();

	foreach ( $active_plugins as $active_plugin ) {
		$plugins[ $all_plugins[ $active_plugin ]['Name'] ] = $all_plugins[ $active_plugin ]['Version'];
	}

	if ( is_multisite() ) {
		$network_active_plugins = get_site_option( 'active_sitewide_plugins' );

		foreach ( $network_active_plugins as $active_plugin => $last_updated ) {
			$plugins[ $all_plugins[ $active_plugin ]['Name'] ] = $all_plugins[ $active_plugin ]['Version'];
		}
	}

	$theme = evolvethemes_get_theme();
	$theme_version = $theme->get( 'Version' );

	/* WordPress checks. */
	$status['wp_version'] = array(
		'value' => get_bloginfo( 'version' ),
	);

	$status['wp_multisite'] = array(
		'value' => is_multisite() ? __( 'On', 'crowley' ) : __( 'Off', 'crowley' ),
	);

	$status['wp_memory_limit'] = array(
		'value' => $memory,
		/* translators: codex page for memory. */
		'warning' => intval( $memory ) < 64 ? sprintf( __( 'We recommend setting memory to at least 64MB. See <a href="%s" target="_blank" rel="noopener noreferrer">official WordPress documentation</a>.', 'crowley' ), esc_attr( $memory_codex_url ) ) : '',
	);

	$status['wp_debug'] = array(
		'value' => $debug ? __( 'On', 'crowley' ) : __( 'Off', 'crowley' ),
		/* translators: codex page for debug. */
		'warning' => $debug ? sprintf( __( 'Debug mode is not suitable for production use, you might want to turn it off. See <a href="%s" target="_blank" rel="noopener noreferrer">official WordPress documentation</a>.', 'crowley' ), esc_attr( $debug_codex_url ) ) : '',
	);

	/* Server-side checks. */
	$status['php_version'] = array(
		'value' => $php_version,
		'warning' => version_compare( $php_version, '5.6', '<' ) ? __( 'Although the theme is compatible with PHP 5.2+, we recommend a minimum PHP version of 5.6.', 'crowley' ) : '',
	);

	$status['php_post_max_size'] = array(
		'value' => $php_post_max_size,
	);

	$status['php_time_limit'] = array(
		/* translators: %s: the number of seconds. */
		'value' => sprintf( _x( '%s seconds', 'php time limit', 'crowley' ), $php_time_limit ),
	);

	$status['php_max_input_vars'] = array(
		'value' => $php_max_input_vars,
	);

	$status['php_max_file_upload'] = array(
		'value' => $php_max_file_upload,
	);

	/* Theme checks. */
	$status['theme_version'] = array(
		'value' => $theme_version,
	);

	$status['theme_child'] = array(
		'value' => is_child_theme() ? __( 'On', 'crowley' ) : __( 'Off', 'crowley' ),
	);

	/* Error count. */
	$status['_errors'] = 0;

	foreach ( $status as $check ) {
		if ( isset( $check['warning'] ) && ! empty( $check['warning'] ) ) {
			$status['_errors']++;
		}
	}

	return $status;
}

/**
 * Add a multiple notices to the notices management.
 *
 * @param  array $notices The notices array.
 * @return array
 */
function evolvethemes_system_status_notices( $notices ) {
	$status = evolvethemes_system_status();

	foreach ( $status as $check ) {
		if ( isset( $check['warning'] ) && ! empty( $check['warning'] ) ) {
			$notices['system-status'][] = array(
				'type' => 'warning',
				'content' => $check['warning'],
			);
		}
	}

	return $notices;
}

add_filter( 'evolvethemes_get_notices', 'evolvethemes_system_status_notices' );
