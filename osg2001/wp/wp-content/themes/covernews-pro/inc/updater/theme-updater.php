<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if (!class_exists('EDD_Theme_Updater_Admin')) {
	include (dirname(__FILE__).'/theme-updater-admin.php');
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.afthemes.com', // Site where EDD is hosted
		'item_name'      => 'CoverNews Pro', // Name of theme
		'theme_slug'     => 'covernews-pro', // Theme slug
		'version'        => '1.1.7', // The current version of this theme
		'author'         => 'AF themes', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => 'https://afthemes.com/my-profile/'// Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __('Theme License', 'covernews'),
		'enter-key'                 => __('Enter your theme license key.', 'covernews'),
		'license-key'               => __('License Key', 'covernews'),
		'license-action'            => __('License Action', 'covernews'),
		'deactivate-license'        => __('Deactivate License', 'covernews'),
		'activate-license'          => __('Activate License', 'covernews'),
		'status-unknown'            => __('License status is unknown.', 'covernews'),
		'renew'                     => __('Renew?', 'covernews'),
		'unlimited'                 => __('unlimited', 'covernews'),
		'license-key-is-active'     => __('License key is active.', 'covernews'),
		'expires%s'                 => __('Expires %s.', 'covernews'),
		'%1$s/%2$-sites'            => __('You have %1$s / %2$s sites activated.', 'covernews'),
		'license-key-expired-%s'    => __('License key expired %s.', 'covernews'),
		'license-key-expired'       => __('License key has expired.', 'covernews'),
		'license-keys-do-not-match' => __('License keys do not match.', 'covernews'),
		'license-is-inactive'       => __('License is inactive.', 'covernews'),
		'license-key-is-disabled'   => __('License key is disabled.', 'covernews'),
		'site-is-inactive'          => __('Site is inactive.', 'covernews'),
		'license-status-unknown'    => __('License status is unknown.', 'covernews'),
		'update-notice'             => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'covernews'),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'covernews')
	)

);
