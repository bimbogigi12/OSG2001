<?php
/*
Plugin Name: Icon List
Plugin URI: https://designorbital.com/icon-list/
Description: Use an icon list for different purposes on your WordPress site using the Icon List plugin.
Author: DesignOrbital.com
Author URI: https://designorbital.com
Text Domain: kamn-iconlist
Domain Path: /languages/
Version: 0.6
License: GPL v3

Icon List Plugin
Copyright (C) 2013, DesignOrbital.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/** Plugin Constants */
if ( !defined( 'KAMN_ICONLIST_VERSION' ) ) {
	define( 'KAMN_ICONLIST_VERSION', '0.6' );
}

/** Directory Location Constants */
if ( ! defined( 'KAMN_ICONLIST_BASENAME' ) ) {
	define( 'KAMN_ICONLIST_BASENAME', plugin_basename( __FILE__ ) );
}

if ( !defined( 'KAMN_ICONLIST_DIR_BASENAME' ) ) {
	define( 'KAMN_ICONLIST_DIR_BASENAME', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
}

if ( !defined( 'KAMN_ICONLIST_DIR' ) ) {
	define( 'KAMN_ICONLIST_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

/** URI Location Constants */
if ( !defined( 'KAMN_ICONLIST_URI' ) ) {
	define( 'KAMN_ICONLIST_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}

/** Plugin Init */
require_once( KAMN_ICONLIST_DIR . 'lib/init.php' );
