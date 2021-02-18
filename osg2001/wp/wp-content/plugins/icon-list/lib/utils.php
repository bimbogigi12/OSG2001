<?php
/**********************************************
* Translation
**********************************************/

load_plugin_textdomain( 'kamn-iconlist', false, KAMN_ICONLIST_DIR_BASENAME . 'languages/' );

/**********************************************
* Media
**********************************************/

/** Enqueue Scripts */
add_action( 'wp_enqueue_scripts', 'kamn_iconlist_media' );

/** Enqueue Scripts */
function kamn_iconlist_media() {

	/** Enqueue CSS Files */

	/** Plugin Stylesheet */
	wp_enqueue_style( 'kamn-css-iconlist', esc_url( KAMN_ICONLIST_URI . 'icon-list.css' ) );

}
