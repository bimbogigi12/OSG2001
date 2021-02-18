<?php
/**********************************************
* Default Options
**********************************************/

function kamn_iconlist_options_default()  {

	$default = array(

		'kamn_iconlist_fontawesome_control' => 1,
		'kamn_iconlist_reset_control' => 0

	);

	return $default;

}

/**********************************************
* Plugin Settings
**********************************************/

/** Loads the plugin setting. */
function kamn_iconlist_get_settings() {

	/** Global Data */
	global $kamn_iconlist;

	/* If the settings array hasn't been set, call get_option() to get an array of plugin settings. */
	if ( !isset( $kamn_iconlist->settings ) ) {
		$kamn_iconlist->settings = apply_filters( 'kamn_iconlist_options_filter', wp_parse_args( get_option( 'kamn_iconlist_options', kamn_iconlist_options_default() ), kamn_iconlist_options_default() ) );
	}

	/** return settings. */
	return $kamn_iconlist->settings;
}

/**********************************************
* Plugin Data
**********************************************/

/** Function for getting the plugin data */
function kamn_iconlist_plugin_data() {

	/** Global Data */
	global $kamn_iconlist;

	/** If the parent theme data isn't set, let grab it. */
	if ( !isset( $kamn_iconlist->plugin_data ) ) {
		$kamn_iconlist->plugin_data = get_plugin_data( KAMN_ICONLIST_DIR . 'icon-list.php' );
	}

	/** Return the plugin data. */
	return $kamn_iconlist->plugin_data;
}

/**********************************************
* External Link
**********************************************/

function kamn_iconlist_external_link( $key = '' ) {

	$kamn_iconlist_external_link = array(
		'fa-icons' => 'http://fontawesome.io/icons/',
	);

	return $kamn_iconlist_external_link[$key];

}
