<?php
/*
Plugin Name: SP Project & Document Manager
Plugin URI: http://smartypantsplugins.com/
Description: A WordPress plug-in that allows your business manage documents and projects with permissions in an easy to use interface.
Author: smartypants
Version: 3.8.5
Text Domain: sp-cdm
Author URI: http://smartypantsplugins.com
*/
global $sp_client_upload;
$sp_client_upload = "3.8.5";

add_action('wp_logout', 'sp_cdm_logout');
function sp_cdm_logout()
{
 $time = time() - 36000;
 setcookie("pid", 0, $time, '/');
 do_action('sp_cdm/logout');
}
function sp_disable_old_plugins()
{
 $redirect = false;
 if (!function_exists('is_plugin_active'))
  require_once(ABSPATH . '/wp-admin/includes/plugin.php');
 if (is_plugin_active('sp-cdm-sub-projects/index.php')) {
  deactivate_plugins('/sp-cdm-sub-projects/index.php');
  update_option('sp_disabled_sub_projects_notify', 1);
  $redirect = true;
 }
 if (is_plugin_active('sp-cdm-local-import/index.php')) {
  deactivate_plugins('/sp-cdm-local-import/index.php');
  update_option('sp_disabled_import_notify', 1);
  $redirect = true;
 }
 if (is_plugin_active('sp-cdm-media/index.php')) {
  deactivate_plugins('/sp-cdm-media/index.php');
  update_option('sp_disabled_media_notify', 1);
  $redirect = true;
 }
 if (is_plugin_active('sp-cdm-link/index.php')) {
  deactivate_plugins('/sp-cdm-link/index.php');
  update_option('sp_disabled_link_notify', 1);
  $redirect = true;
 }
}
register_activation_hook(__FILE__, 'sp_disable_old_plugins');
function cdm_wp_media_files()
{
 wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'cdm_wp_media_files');
function sp_admin_notices_alert()
{
 if (get_option('sp_disabled_sub_projects_notify') == 1) {
  echo ' <div class="notice notice-error is-dismissible">
        <p><strong>The sub projects functionality is now included with the base version of the document manager, the sub projects addon has been disabled. You may delete the addon at any time!</strong></p>
    </div>';
  update_option('sp_disabled_sub_projects_notify', 0);
 }
 if (get_option('sp_disabled_import_notify') == 1) {
  echo ' <div class="notice notice-error is-dismissible">
        <p><strong>The importer is now integrated with the base version of smarty client document manager!</strong></p>
    </div>';
  update_option('sp_disabled_import_notify', 0);
 }
 if (get_option('sp_disabled_media_notify') == 1) {
  echo ' <div class="notice notice-error is-dismissible">
        <p><strong>The Media addon is now integrated with the base version of smarty client document manager!</strong></p>
    </div>';
  update_option('sp_disabled_media_notify', 0);
 }
 if (get_option('sp_disabled_link_notify') == 1) {
  echo ' <div class="notice notice-error is-dismissible">
        <p><strong>The Link Manager is now integrated with the base version of smarty client document manager!</strong></p>
    </div>';
  update_option('sp_disabled_link_notify', 0);
 }
}
add_action('admin_notices', 'sp_admin_notices_alert');
function sp_cdm_load_languages()
{
 load_plugin_textdomain('sp-cdm', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('init', 'sp_cdm_load_languages');
if (get_option('sp_cu_limit_file_size') == "") {
 ini_set('upload_max_filesize', '2000M');
 ini_set('post_max_size', '2000M');
 ini_set('max_input_time', 300);
 ini_set('max_execution_time', 300);
} else {
 ini_set('upload_max_filesize', '' . get_option('sp_cu_limit_file_size') . 'M');
 ini_set('post_max_size', '' . get_option('sp_cu_limit_file_size') . 'M');
 ini_set('max_input_time', 300);
 ini_set('max_execution_time', 300);
}
$cdm_upload_dir = wp_upload_dir();
define('SP_CRM_STORE_URL','https://smartypantsplugins.com');
define('SP_CDM_COMMUNITY_TEMPLATE_DIR', plugin_dir_path(__FILE__) . 'templates/');
define('SP_CDM_COMMUNITY_PLUGIN_DIR', plugin_dir_path(__FILE__) . 'templates/');
define('SP_CDM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SP_CDM_PLUGIN_URL', plugin_dir_url(__FILE__));
if (get_option('sp_cu_overide_upload_path') != "") {
 define('SP_CDM_UPLOADS_DIR', stripslashes(get_option('sp_cu_overide_upload_path')));
 define('SP_CDM_UPLOADS_DIR_URL', stripslashes(get_option('sp_cu_overide_upload_url')));
} else {
 define('SP_CDM_UPLOADS_DIR', $cdm_upload_dir['basedir'] . '/sp-client-document-manager/');
 define('SP_CDM_UPLOADS_DIR_URL', $cdm_upload_dir['baseurl'] . '/sp-client-document-manager/');
}
add_action('admin_menu', 'sp_client_upload_menu');
add_filter('wp_enqueue_scripts', 'sp_cdm_tinymce_editor');
function sp_cdm_tinymce_editor()
{
 wp_admin_css('thickbox');
 wp_enqueue_script('post');
 wp_enqueue_script('media-upload');
 wp_enqueue_script('jquery');
 wp_enqueue_script('jquery-ui-core');
 wp_enqueue_script('jquery-ui-tabs');
 wp_enqueue_script('jquery-effects-core');
 wp_enqueue_script('jquery-effects-pulsate');
 wp_enqueue_script('jquery-effects-highlight');
 wp_enqueue_script('tiny_mce');
 wp_enqueue_script('editor');
 wp_enqueue_script('editor-functions');
 add_thickbox();
}
require_once '' . dirname(__FILE__) . '/common.php';
require_once '' . dirname(__FILE__) . '/classes/event.logger.php';
require_once '' . dirname(__FILE__) . '/admin/logs.php';
require_once '' . dirname(__FILE__) . '/classes/uploader.php';
require_once '' . dirname(__FILE__) . '/classes/install.php';
if (!function_exists('bfi_thumb')) {
 require_once '' . dirname(__FILE__) . '/classes/mat.thumb.php';
}
require_once '' . dirname(__FILE__) . '/integrated/sp-cdm-local-import/index.php';
require_once '' . dirname(__FILE__) . '/integrated/sp-cdm-link/index.php';
require_once '' . dirname(__FILE__) . '/integrated/sp-cdm-media/index.php';
require_once '' . dirname(__FILE__) . '/user/sub-projects.php';
require_once '' . dirname(__FILE__) . '/classes/ajax.php';
require_once '' . dirname(__FILE__) . '/ajax.php';

require_once '' . dirname(__FILE__) . '/zip.class.php';
require_once '' . dirname(__FILE__) . '/admin/vendors.php';
require_once '' . dirname(__FILE__) . '/admin/projects.php';
require_once '' . dirname(__FILE__) . '/admin/users.php';
require_once '' . dirname(__FILE__) . '/user/projects.php';
require_once '' . dirname(__FILE__) . '/functions.php';
require_once '' . dirname(__FILE__) . '/shortcode.php';
require_once '' . dirname(__FILE__) . '/admin/fileview.php';
require_once '' . dirname(__FILE__) . '/admin/settings.php';
require_once '' . dirname(__FILE__) . '/download.php';
require_once '' . dirname(__FILE__) . '/admin/recycle-bin.php';
require_once '' . dirname(__FILE__) . '/user/file-list.php';
require_once '' . dirname(__FILE__) . '/user/customizer.php';
require_once '' . dirname(__FILE__) . '/admin/addons.php';


function sp_available_licenses(){
	$licenses = array();
	return apply_filters('sp/cdm/license_slugs',$licenses);
		
}
function sp_js_vars()
{
 global $current_user;
 if (cdm_var('page') == 'sp-client-document-manager-fileview') {
  $user_id = cdm_var('id');
 } else {
  $user_id = $current_user->ID;
 }
 $vars = array(
  'ajax_url' => admin_url('admin-ajax.php'),
  'plugin_url' => SP_CDM_PLUGIN_URL,
  'uid' => $user_id,
  'sp_cu_user_projects_required' => get_option('sp_cu_user_projects_required', 0)
 );
 $vars = apply_filters('sp_cdm/javascript_vars', $vars);
 return $vars;
}
function sp_client_upload_init()
{
 global $sp_client_upload;
 if (sp_is_used() == true) {
   wp_enqueue_style( 'dashicons' );	 
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-dialog');
  wp_enqueue_script('jquery-ui-tabs');
  wp_enqueue_script('jquery-ui-button');
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_script('wp-mediaelement');
  wp_enqueue_script('jquery-form');
  
    
  wp_register_style('jquery-remodal-css',  plugins_url('css/jquery.remodal.css', __FILE__));
  wp_enqueue_style('jquery-remodal-css');
  
  wp_register_script('jquery-remodal-js',  plugins_url('js/jquery.remodal.js', __FILE__));
  wp_enqueue_script('jquery-remodal-js');
  
  
  wp_register_style('jquery-responsive-tabs-css', plugins_url('css/jquery.responsive.tabs.css', __FILE__));
  wp_enqueue_style('jquery-responsive-tabs-css');
  
  wp_register_script('jquery-responsive-tabs', plugins_url('js/jquery.responsive.tabs.js', __FILE__));
  wp_enqueue_script('jquery-responsive-tabs');
  
  wp_enqueue_script('smcdmvalidate', plugins_url('js/jquery.validate.js', __FILE__));
  wp_enqueue_script('cdm-jquery-cookie', plugins_url('js/jquery.cookie.js', __FILE__), array(
   'jquery'
  ));
  wp_register_script('smUpload', plugins_url('upload.js', __FILE__), array(
   'jquery',
   'jquery-ui-core',
   'jquery-ui-dialog',
   'jquery-ui-button',
   'cdm-jquery-cookie'
  ));
  wp_localize_script('smUpload', 'sp_vars', sp_js_vars());
  wp_enqueue_script('smUpload');
  wp_enqueue_script('jquery-dialog-responsive', plugins_url('js/jquery.modal.responsive.js', __FILE__), array(
   'jquery',
   'jquery-ui-dialog',
   'cdm-jquery-cookie'
  ));
  wp_enqueue_script('cdm_reverse_order', plugins_url('js/reverse.js', __FILE__), array(
   'jquery'
  ));
  wp_register_style('cdm_reverse_order', plugins_url('css/breadcrumbs.css', __FILE__));
  wp_enqueue_style('cdm_reverse_order');
  
  if (get_option('sp_cu_jqueryui_theme') != 'none') {
   wp_register_style('jquery-ui-css',  plugins_url( 'css/smoothness/jquery-ui-1.8.18.custom.css',  __FILE__ ));
   wp_enqueue_style('jquery-ui-css');
  }
  #no more font awesome is awesome
  #wp_enqueue_style('font-awesome-smarty', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
  wp_enqueue_style('cdm-style', plugins_url('style.css', __FILE__), array(), $sp_client_upload);
  
  
  if (is_admin()) {
   
   
   wp_enqueue_media();
   wp_enqueue_script('cdm-potatoe-menu-js', plugins_url('js/menu.js', __FILE__), array(
    'jquery'
   ));
   wp_register_style('cdm-potatoe-menu', plugins_url('css/menu.css', __FILE__));
   wp_enqueue_style('cdm-potatoe-menu');
   
   
  }
  
  do_action('sp_cdm/enqueue_scripts');
 }
 
}


function sp_is_used()
{
 global $post;
 $used        = false;
 $page        = cdm_var('page');
 $admin_pages = array(
  'sp-client-document-manager',
  'sp-client-document-manager-settings',
  'sp-client-document-manager-vendors',
  'sp-client-document-manager-projects',
  'sp-client-document-manager-user-logs',
  'sp-client-document-manager-local-import',
  'sp-client-document-manager-fileview',
  'sp-client-document-manager-help',
  'sp-client-document-manager-recycle',
  'sp-client-document-manager-groups',
  'sp-client-document-manager-forms',
  'sp-client-document-manager-categories',
  'sp-client-document-manager-security',
  'sp-client-document-manager-groups-addon',
  'sp-client-document-manager-forms-manager',
  'sp-client-document-manager-forms-manager-category',
  'sp-client-document-manager-clients',
  'sp-client-document-manager-logs',
   'sp-cdm-addons-view',
  'sp-client-document-manager-advanced-groups'
 );
 
 if (is_admin()) {
  
  if (in_array($page,$admin_pages)) {
   $used = true;
   
  }
 } else {
  
  $shortcodes = array(
   'cdm-project',
   'cdm-link',
   'sp-client-media-manager',
   'sp-client-document-manager',
   'cdm_public_view'
  );
  foreach ($shortcodes as $shortcode) {
  if (isset($post->post_content) && strpos($post->post_content, $shortcode) !== false) {
    $used = true;
	
   }
  }
  
  if(isset($post->ID)){
	  if ($post->ID == get_option('sp_cu_dashboard_page')) {
	   $used = true;
	   
	  }
	  
	  if (get_option('sp_cu_uploads_page') == $post->ID) {
	   
	   $used = true;
	
	  }
  }

 }
 
 
 return apply_filters('sp_is_used', $used);
 
}


add_action('wp_enqueue_scripts', 'sp_client_upload_init');
add_action('admin_enqueue_scripts', 'sp_client_upload_init');




function cdm_htaccess_protect_dirx($dir, $force = false)
{
 $htacess = $dir . '.htaccess';
 if (file_exists($htacess)) {
  unlink($htacess);
 }
}
function cdm_htaccess_protect_dir($dir, $force = false)
{
 
 $htacess = $dir . '.htaccess';
 if (file_exists($htacess)) {
  unlink($htacess);
 }
}
cdm_htaccess_protect_dir(SP_CDM_UPLOADS_DIR);
function sp_client_upload_menu()
{
 $projects        = new cdmProjects;
 $sp_cdm_fileview = new sp_cdm_fileview;
 add_menu_page('Documents', 'Documents', 'sp_cdm', 'sp-client-document-manager', 'sp_client_upload_options', 'dashicons-media-default', 2);
 add_submenu_page('sp-client-document-manager', sp_cdm_folder_name(1), sp_cdm_folder_name(1), 'sp_cdm_projects', 'sp-client-document-manager-projects', array(
  $projects,
  'view'
 ));
 add_submenu_page('sp-client-document-manager', 'Vendors', 'Vendors', 'sp_cdm_vendors', 'sp-client-document-manager-vendors', 'sp_client_upload_options_vendors');
 add_submenu_page('sp-client-document-manager', 'Help', 'Help', 'sp_cdm_help', 'sp-client-document-manager-help', 'sp_client_upload_help');
 add_submenu_page('sp-client-document-manager', 'Settings', 'Settings', 'sp_cdm_settings', 'sp-client-document-manager-settings', 'sp_client_upload_settings');
 add_submenu_page('sp-client-document-manager', 'User Files', 'User Files', 'sp_cdm_uploader', 'sp-client-document-manager-fileview', array(
  $sp_cdm_fileview,
  'view'
 ));
 do_action('sp_cu_admin_menu');
 if (current_user_can('sp_cdm_show_folders_as_nav')) {
  add_menu_page(sp_cdm_folder_name(1), sp_cdm_folder_name(1), 'sp_cdm_show_folders_as_nav', 'sp-client-document-manager-projects', array(
   $projects,
   'view'
  ), 'dashicons-portfolio', 3);
 }
}
function sp_client_upload_options()
{
 global $wpdb;
 if (cdm_var('sp-client-document-manager-submit')) {
  update_option('sp_client_upload_page', sanitize_text_field(cdm_var('sp_client_upload_page')));
  echo '<p style="color:green">' . __("Updated Settings!", "sp-cdm") . '</p>';
 }
 echo '<h2>' . __("Latest uploads", "sp-cdm") . '</h2>' . sp_client_upload_nav_menu() . '
				' . sp_client_upload_admin() . '';
}
function cdm_upgradeProjects()
{
 global $wpdb;
 if (get_option('cdm_projects_upgrade') != 1) {
  #  $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "sp_cu_project` ADD `parent_base` INT( 11 ) NOT NULL DEFAULT '0'");
  #  update_option('cdm_projects_upgrade', 1);
 }
}
add_action('init', 'cdm_upgradeProjects');
register_activation_hook(__FILE__, 'cdm_recycle_scheduler');
register_deactivation_hook(__FILE__, 'cdm_recycle_scheduler_remove');
add_action('init', 'cdm_recycle_scheduler');
function cdm_recycle_scheduler()
{
 if (get_option('sp_cdm_recycle_bin_schedule') != 1) {
  wp_schedule_event(time(), 'daily', 'sp_cdm_run_recycler');
  update_option('sp_cdm_recycle_bin_schedule', 1);
 }
}
function cdm_recycle_scheduler_remove()
{
 wp_clear_scheduled_hook('sp_cdm_run_recycler');
}
?>