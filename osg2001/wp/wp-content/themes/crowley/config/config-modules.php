<?php
/**
 * Modules configuration.
 *
 * @package WordPress
 * @subpackage config
 * @since 1.0.0
 */

/**
 * Require inc modules.
 *
 * @since 1.0.0
 */
function ev_inc_require_modules() {
	$config = parse_ini_file( 'config.ini', true );

	if ( isset( $config['inc_modules'] ) && is_array( $config['inc_modules'] ) ) {
		foreach ( $config['inc_modules'] as $module => $module_version ) {
			if ( file_exists( trailingslashit( get_template_directory() ) . 'ev-inc/modules/' . $module . '/' . $module_version . '/index.php' ) ) {
				require_once( trailingslashit( get_template_directory() ) . 'ev-inc/modules/' . $module . '/' . $module_version . '/index.php' );
			}
		}
	}
}

ev_inc_require_modules();
