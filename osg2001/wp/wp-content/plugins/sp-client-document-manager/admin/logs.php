<?php

$sp_cdm_user_logs = new sp_cdm_user_logs;
add_filter('sp_client_upload_nav_menu', array($sp_cdm_user_logs , 'submenu'));
add_action('sp_cu_admin_menu', array($sp_cdm_user_logs , 'menu'));
add_action('admin_init', array($sp_cdm_user_logs , 'permissions'));

class sp_cdm_user_logs{
	
	
	function permissions(){
		
		global $current_user;
			if($current_user != ''){
			
					if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_user_logs') ) {
						@require_once(ABSPATH . 'wp-includes/pluggable.php');
							$role = get_role( 'administrator' );
							$role->add_cap( 'sp_cdm_user_logs' );	
							
					}
			
			}
		
	}
	
	
function write($string){
	global $current_user;
	$current_log .= '<strong>'.date_i18n( get_option( 'date_format' ),  current_time('timestamp') ).' '.date_i18n( 'g:i a', current_time('timestamp') ).':</strong> '.$current_user->display_name.' '.$string.'<br>';
	$current_log .= get_option('sp_cdm_user_log');
	update_option('sp_cdm_user_log', $current_log);
}

function view(){
	
	echo '<h2>'.__("User Log","sp-cdm").'</h2>'.sp_client_upload_nav_menu().'';
	
	echo get_option('sp_cdm_user_log');
	
	
	
}
function menu(){
	
	add_submenu_page('sp-client-document-manager', 'User Logs', 'User Logs', 'sp_cdm_user_logs', 'sp-client-document-manager-user-logs', array(
        $this,
        'view'
    ));
}

function submenu($content){
	
	if(current_user_can('sp_cdm_user_logs')){
	$content .= '<li><a href="admin.php?page=sp-client-document-manager-user-logs" >' . __("User Logs", "sp-cdm") . '</a></li>';
	}
	return $content;

}
	
	
	
}

?>