<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


function cdm_cookie($var,$type='int'){
	
	if(isset($_COOKIE[$var])){
	
	if($type == 'int'){
		
	
	return intval($_COOKIE[$var]);		
	}else{
		
	return sanitize_text_field($_COOKIE[$var]);
		
	}
		
	}else{
		
	return false;	
	}
	
}


function cdm_var($var,$request=false){
	
	if($request == false){
		
	$request = $_REQUEST;	
	}
	if(isset($request[$var])){
		
		if(is_array($request[$var])){
		return $request[$var];	
		}else{
		return sanitize_text_field($request[$var]);	
		}
	
	}else{
		
	return false;	
	}
	
	
}
function cdm_customizer_get_option($option){
	
	
	$options = get_option('cdm_customizer');;
	
	if(isset($options[$option])){
	return $options[$option];	
	}else{
	return false;	
	}
	
}

function cdm_customizer_settings(){
	
	return get_option('cdm_customizer');
}


function cdm_date($date){

#$date = new DateTime($date);

if(is_numeric($date)) {
     return date_i18n( get_option( 'date_format' ), $date);  
    } else {
	return date_i18n( get_option( 'date_format' ), strtotime($date)); 	
	}


#return $date->format(get_option('date_format') );	
	
	
}
function cdm_datetime($date){

#$date = new DateTime($date);

if(is_numeric($date)) {
     return date_i18n( get_option( 'date_format' ).' '. get_option( 'time_format' ), $date);  
    } else {
	return date_i18n( get_option( 'date_format' ).' '. get_option( 'time_format' ), strtotime($date)); 	
	}


#return $date->format(get_option('date_format') );	
	
	
}
function cdm_community_limit_filename($input){

$maxLen = 45;

if (strlen($input) > $maxLen) {
    $characters = floor($maxLen / 2);
    $input =  substr($input, 0, $characters) . '...' . substr($input, -1 * $characters);
}	
	return $input;
}

		function cdm_community_locate_template( $template_name, $template_path = '', $default_path = '' ) {
			
			if ( ! $template_path ) {
				$template_path =SP_CDM_COMMUNITY_TEMPLATE_DIR;
			}
		
			if ( ! $default_path ) {
				$default_path = SP_CDM_COMMUNITY_PLUGIN_DIR;
			}
		
			// Look within passed path within the theme - this is priority.
			$template = locate_template(
				array(
					trailingslashit( $template_path ) . $template_name,
					$template_name
				)
			);
			
			
			// Get default template/
			if ( ! $template  ) {
				$template = $default_path . $template_name;
			}
				if(file_exists( get_stylesheet_directory() . '/sp-client-document-manager/'.$template_name)){					
					$template = get_stylesheet_directory() . '/sp-client-document-manager/'.$template_name;
				}	
			// Return what we found.
			return apply_filters( 'cdm_community_locate_template', $template, $template_name, $template_path );
		}
			
		function cdm_community_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
			if ( ! empty( $args ) && is_array( $args ) ) {
				extract( $args );
			}
	
			$located = cdm_community_locate_template( $template_name, $template_path, $default_path );
			
			if ( ! file_exists( $located ) ) {
				echo 'Template not found';
				return;
			}
		
			// Allow 3rd party plugin filter template file from their plugin.
			$located = apply_filters( 'cdm_community_get_template', $located, $template_name, $args, $template_path, $default_path );
		
			do_action( 'cdm_community_before_template_part', $template_name, $template_path, $located, $args );
		
			include( $located );
		
			do_action( 'cdm_community_after_template_part', $template_name, $template_path, $located, $args );
		}
			



if(!function_exists('cdm_var')){
function cdm_var($var){
	
	
	$value = isset($_REQUEST[$var]) ? $_REQUEST[$var] : '';
	return $value;
}
	
}
function cdm_delete_cache(){
	global $wpdb;
 $query = "DELETE FROM ".$wpdb->options." WHERE option_name LIKE '_transient_sp_cdm_groups_cache%'";
		  $wpdb->query( $query );	
		
		  $query =  "DELETE FROM ".$wpdb->options." WHERE option_name LIKE '_transient_cdm_folder_permissions_%'
				  												   OR option_name LIKE '_transient_timeout_cdm_folder_permissions_%'
																   OR option_name LIKE '_transient_timeout_cdm_file_permissions_%'
																   OR option_name LIKE '_transient_cdm_file_permissions_%'
																   OR option_name LIKE '_transient_timeout_cdm_file_permissions_%'
																   OR option_name LIKE '_transient_cdm_delete_permissions_%'
																   OR option_name LIKE '_transient_timeout_cdm_delete_permissions_%'
																   ";
																   
	$wpdb->query( $query );		
	
}
function cdm_recycle($type, $id, $restore = false)
{
    global $wpdb;
	
	
    $retention = get_option('sp_cu_recycle_bin_retention', 30);
    if($retention  == ''){
	$retention = 30;	
	}
	
	if ($retention == 0 && $restore == false) {
        if ($type == 'file') {
		echo $retention;exit;
            cdm_delete_file($id);
        }
        if ($type == 'folder') {
            cdm_delete_folder($id);
        }
    } else {
	
        if ($restore == true) {
            $update['recycle'] = 0;
        } else {
            $update['recycle'] = 1;
        }
        if ($restore != true) {
            $update['recycle_date'] = date("Y-m-d");
        } else {
            $update['recycle_date'] = '';
        }
        $where['id'] = $id;
        if ($type == 'file') {
            $table = '' . $wpdb->prefix . 'sp_cu';
        } elseif ($type == 'folder') {
            $table = '' . $wpdb->prefix . 'sp_cu_project';
        }
        $wpdb->update($table, $update, $where);
        #sp_cdm_user_logs::write('Recycled folder: '.$r[0]['name'].'');
    }
}
function cdm_delete_folder($project_id = NULL,$force = false)
{
    global $wpdb, $current_user;
    if (!is_user_logged_in())
        exit;
    if ($project_id != NULL) {
        $project_id = $project_id;
    } else {
        $project_id = cdm_var('id');
    }
    $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d ", $project_id), ARRAY_A);
    if ((($current_user->ID == $r[0]['uid'] or cdmFindLockedGroup($current_user->ID, $r[0]['uid']) == true) && get_option('sp_cu_user_delete_disable') != 1) or current_user_can('manage_options') or cdm_folder_permissions($project_id) == 1 or $force == true) {
        #delete this projects files
        $f = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu where pid = %d ", $project_id), ARRAY_A);
        for ($j = 0; $j < count($f); $j++) {
            cdm_delete_file($f[$j]['id']);
        }
        #find and remove sub folders
        $p = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project where parent = %d ", $project_id), ARRAY_A);
        for ($i = 0; $i < count($p); $i++) {
            cdm_delete_folder($p[$i]['id']);
        }
        #delete the project
        sp_cdm_user_logs::write('Deleted folder: ' . $r[0]['name'] . '');
        $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d", $project_id));
    } else {
        sp_cdm_user_logs::write('Error: Failed removing folder: ' . $r[0]['name'] . '');
    }
}
function cdm_delete_file($file_id = false,$force = false)
{
    global $wpdb, $current_user;
    if (!is_user_logged_in())
        exit;
   
	
	if ($file_id == false) {
        $file_id = sanitize_text_field(cdm_var('file_id'));
        if ($file_id != NULL) {
            $file_id = $file_id;
        } else {
            $file_id = sanitize_text_field(cdm_var('dlg-delete-file'));
        }
    }
    $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where id = %d  order by date desc", $file_id), ARRAY_A);
   
    $is_remote  = apply_filters('sp_cdm/delete/is_remote', false,$r);
   	if( $is_remote == false){
   
    
		if(file_exists('' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '')){
		@unlink('' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '');
		}
		if(file_exists('' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '.lock')){
		@unlink('' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '.lock');
		}
    $ext   = preg_replace('/^.*\./', '', $r[0]['file']);
    $small = '' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '_small.png';
    $big   = '' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '_big.png';
    if(file_exists($small)){
	@unlink($small);
	}
	if(file_exists($big)){
    @unlink($big);
	}
 
   
	}
	
	 do_action('sp_cdm_delete_file', $r[0]);
	 sp_cdm_user_logs::write('Deleted file: ' . $r[0]['name'] . '');
    cdm_event_log($r[0]['pid'], $current_user->ID, 'folder', '<strong style="color:red">' . __('Deleted File: ' . $r[0]['name'] . '</strong>', 'sp-cdm') . '');
	 $wpdb->query($wpdb->prepare("
	DELETE FROM " . $wpdb->prefix . "sp_cu WHERE id = %d ", $file_id));
	 $lost_children = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where parent = %d ", sanitize_text_field($file_id)), ARRAY_A);
    if ($lost_children != false) {
        for ($i = 0; $i < count($lost_children); $i++) {
            spdm_ajax::delete_file($lost_children[$i]['id']);
        }
    }
   
}
if (!function_exists('array_replace')) {
    function array_replace(array &$array, array &$array1)
    {
        $args  = func_get_args();
        $count = func_num_args();
        for ($i = 0; $i < $count; ++$i) {
            if (is_array($args[$i])) {
                foreach ($args[$i] as $key => $val) {
                    $array[$key] = $val;
                }
            } else {
                trigger_error(__FUNCTION__ . '(): Argument #' . ($i + 1) . ' is not an array', E_USER_WARNING);
                return NULL;
            }
        }
        return $array;
    }
}
if (!function_exists('sp_share_space_members')) {
    function sp_share_space_members_file($file_uid)
    {
        global $wpdb, $current_user;
        $r = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_groups_assign WHERE  uid = %d",$file_uid ), ARRAY_A);
        for ($i = 0; $i < count($r); $i++) {
            $r_check = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_groups_assign WHERE  gid = %d",$r[$i]['gid']), ARRAY_A);
            for ($i = 0; $i < count($r_check); $i++) {
                $ids[] = $r_check[$i]['uid'];
            }
        }
        if (in_array($current_user->ID, $ids)) {
            return true;
        } else {
            return false;
        }
    }
}
function sp_cdm_file_upload_rename($filename, $uid)
{
    $actual_name   = pathinfo($filename, PATHINFO_FILENAME);
    $original_name = $actual_name;
    $extension     = pathinfo($filename, PATHINFO_EXTENSION);
    if (file_exists('' . SP_CDM_UPLOADS_DIR . '' . $uid . '/' . $actual_name . "." . $extension)) {
        $i = 1;
        while (file_exists('' . SP_CDM_UPLOADS_DIR . '' . $uid . '/' . $actual_name . "." . $extension)) {
            $actual_name = (string) $original_name . $i;
            $filename    = $actual_name . "." . $extension;
            $i++;
        }
    }
    return $filename;
}
add_filter('sp_cdm/premium/upload/file_rename', 'sp_cdm_file_upload_rename', 10, 2);
if (!function_exists('sp_cdm_get_user_sub_projects')) {
    function sp_cdm_get_user_sub_projects($pid, $uid)
    {
        global $wpdb;
        $r = $wpdb->get_results($wpdb->prepare("SELECT  * FROM " . $wpdb->prefix . "sp_cu_project where parent = %d  and recycle = 0", $pid), ARRAY_A);
        for ($i = 0; $i < count($r); $i++) {
            $projects[] = $r[$i]['id'];
        }
        $projects[] = $pid;
        return $projects;
    }
}
function sp_cdm_get_user_projects($uid = false)
{
    global $current_user, $wpdb;
    $projects = array();
    if ($uid == false) {
        $uid = $current_user->ID;
    }
	
	
    $r = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE  uid = %d and recycle = 0", $uid), ARRAY_A);
    for ($i = 0; $i < count($r); $i++) {
        $projects[] = $r[$i]['id'];
    }
	
    $projects_final = apply_filters('cdm/common/get_projects', $projects, $uid);

    return $projects_final;
}
function findRootParent($id)
{
    global $wpdb;
    $r = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE  id = %d", $id), ARRAY_A);
    if (@$r[0]['parent'] != 0) {
        $super_id = findRootParent(@$r[0]['parent']);
    } else {
        $super_id = @$r[0]['id'];
    }
    return $super_id;
}
function sp_cdm_date($date)
{
    $date = new DateTime($date);
    return $date->format(get_option('date_format'));
}
function sp_cdm_is_featured_disabled($plugin, $feature)
{
    $disable_features = get_option('sp_cdm_disable_features');
    if ($disable_features == false) {
        return false;
    }
    if (is_array($disable_features)) {
        if (@$disable_features[$plugin][$feature] == '' or @$disable_features[$plugin][$feature] == 0) {
            return false;
        } else {
            return true;
        }
    }
}
function sp_cdm_array_flatten($array, $return)
{
    for ($x = 0; $x <= count($array); $x++) {
        if (is_array($array[$x])) {
            $return = sp_cdm_array_flatten($array[$x], $return);
        } else {
            if (isset($array[$x])) {
                $return[] = $array[$x];
            }
        }
    }
    return $return;
}
function sp_cdm_short_url($url)
{
   
    return $url;
}
function sp_cdm_short_link($id)
{

return	 sp_cdm_file_link($id);
}
function sp_cdm_show_folder_linked($html)
{
    global $wpdb;
    $fid = sanitize_text_field(cdm_var('folder_id'));
	
    if ($fid != '') {
        $fid = base64_decode($fid);
    
	
	    $html .= '<script type="text/javascript">
					jQuery(document).ready(function() {
				
					';
        if ($fid != '') {
            $html .= 'sp_cdm_load_project(' . $fid . ');cdm_ajax_search()';
        }
        $html .= '	
		
					
					});
				</script>';
    }
    return $html;
}
add_filter('sp_cdm_upload_view', 'sp_cdm_show_folder_linked');
function sp_cdm_show_file_linked($html)
{
    global $wpdb, $current_user;
    $fid = sanitize_text_field(cdm_var('fid'));
    if ($fid != '') {
   
        $fid = base64_decode($fid);
   	$r   = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu WHERE id = %d",$fid), ARRAY_A);     
		
        if (cdm_folder_permissions($r[0]['pid']) == 1) {
            $html .= '<script type="text/javascript">
					jQuery(document).ready(function() {
					console.log("loading project");
					';
            if ($r[0]['pid'] != '') {
                $html .= 'sp_cdm_load_project(' . $r[0]['pid'] . ');cdm_ajax_search()';
            }
            $html .= '	
		
						cdmViewFile(' . $r[0]['id'] . ');
					});
				</script>';
        } else {
            $html .= '<script type="text/javascript">
					jQuery(document).ready(function() {
				
					alert("You do not have access to this file");
					
					
					});
				</script>';
            cdm_event_log($r[0]['id'], $current_user->ID, 'file', '' . __('<strong>Security Exception:</strong> Tried viewing this file through a share link without permissions.', 'sp-cdm') . '');
        }
    }
    return $html;
}
add_filter('sp_cdm_upload_view', 'sp_cdm_show_file_linked');
function sp_cdm_file_link($fid)
{
    return '' . get_site_url() . '/?sp-cdm-link=' . base64_encode($fid) . '&view=1';
}
function sp_cdm_folder_link($fid)
{
    return '' . get_site_url() . '/?cdm-f=' . base64_encode($fid) . '&view=1';
}
function sp_cdm_link_to_folder()
{
 	
	global $wpdb;
	
	
	$and = '';
    $link_id = sanitize_text_field(cdm_var('cdm-f'));
	
	$r   = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu WHERE id = %d",base64_decode($link_id)), ARRAY_A);
    if($r == false){
		
	return false;	
		
	}
	$folder_id =  $r[0]['pid'];
	if ($link_id != '') {
        if ((is_user_logged_in() && get_option('sp_cu_user_require_login_download') == 1) or (get_option('sp_cu_user_require_login_download') == '' or get_option('sp_cu_user_require_login_download') == 0)) {
            $url = cdm_shortcode_url($and);
			
            if (get_option('sp_cu_dashboard_page') != '' ) {
                $url = get_permalink(get_option('sp_cu_dashboard_page'));
            }
		
            setcookie("pid", $folder_id, time()+86400*7, '/');
            $url = apply_filters('sp_cdm_before_link_redirect', $url);
         
            if (cdm_folder_permissions($folder_id) == 1 ) {
                wp_redirect($url);
                exit;
            } else {
                setcookie("pid", 0, 0, '/');
                wp_redirect(cdm_shortcode_url($and));
            }
        } else {
            auth_redirect();
        }
    }
}
add_action('wp', 'sp_cdm_link_to_folder');
function sp_cdm_link_to_file()
{
    $sp_cdm_link = sanitize_text_field(cdm_var('sp-cdm-link'));
    if ($sp_cdm_link != '') {
	
        if ((is_user_logged_in() && get_option('sp_cu_user_require_login_download') == 1) or (get_option('sp_cu_user_require_login_download') == '' or get_option('sp_cu_user_require_login_download') == 0)) {
            $url = cdm_shortcode_url('fid=' . $sp_cdm_link . '');
       
		    if (get_option('sp_cu_dashboard_page') != '' && class_exists('sp_cdm_dashboard')) {
                $page = get_page(get_option('sp_cu_dashboard_page'));
          
			    if ($page->post_status == 'publish') {
                    $url = get_permalink(get_option('sp_cu_dashboard_page'));
                    if (get_option('permalink_structure') != '') {
                        $url = '' . $url . '?fid=' . $sp_cdm_link . '';
                    } else {
                        $url = '' . $url . '&fid=' . $sp_cdm_link . '';
                    }
                }
            }
			
			
            $url = apply_filters('sp_cdm_before_link_redirect', $url);
      	
		    wp_redirect($url);
			exit;
        } else {
            auth_redirect();
        }
    }
}
add_action('init', 'sp_cdm_link_to_file');
function cdm_shortcode_url($and)
{
    global $wpdb;
	
	if(get_option('sp_cu_uploads_page') != ''){
		
		$url = get_permalink(get_option('sp_cu_uploads_page'));
        if (get_option('permalink_structure') != '') {
            return '' . $url . '?' . $and . '';
        } else {
            return '' . $url . '&' . $and . '';
        }
		
		
	}
	

    $r = $wpdb->get_results("SELECT * FROM  " . $wpdb->prefix . "posts where post_content LIKE   '%[sp-client-document-manager]%' and post_type = 'page' and (post_status = 'publish' or post_status = 'private')", ARRAY_A);
	
	
    if ($r[0]['ID'] == "") {
        return false;
    } else {
        $url = get_permalink($r[0]['ID']);
       
	    if (get_option('permalink_structure') != '') {
            return '' . $url . '?' . $and . '';
        } else {
            return '' . $url . '&' . $and . '';
        }
    }
}
function cdm_document_ajax_url()
{
    global $current_user;
    $pid = cdm_cookie('pid');
    if ($pid == '') {
        $pid = 0;
    }
    if (cdm_var('page') == 'sp-client-document-manager-fileview') {
        $uid = sanitize_text_field(cdm_var('uid'));
    } else {
        $uid = $current_user->ID;
    }
    if (get_option('sp_cu_user_projects_thumbs') == 1) {
        $url = 'jQuery.get(sp_vars.ajax_url, {action: "cdm_file_list", uid: "' . $uid . '", pid: "' . $pid . '"}, function(response){
				jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
				})';
    }
    if (get_option('sp_cu_free_file_list') == 1) {
        $url = 'jQuery.get(sp_vars.ajax_url, {action: "cdm_thumbnails", uid: "' . $uid . '", pid: "' . $pid . '"}, function(response){
				jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
				})';
    } else {
        
    }
    $url = apply_filters('sp_document_view_ajax_url', $url);
    return $url;
}
function cdm_file_size($file)
{
    $size = @filesize($file);
    if ($size > 1048576) {
        $filesize = ($size * .0009765625) * .0009765625; // bytes to MB
        $type     = 'MB';
    } else {
        $filesize = $size * .0009765625; // bytes to KB	
        $type     = 'KB';
    }
	
	
    if ($filesize <= 0) {
        return $filesize = 'Unknown file size';
    } else {
        return round($filesize, 2) . ' ' . $type;
    }
}

function cdm_human_filesize($bytes, $decimals = 2) {
    $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
function _cdm_file_size($r){
	
	if($r['file_size'] == ''){
	
	$file_size = cdm_file_size(''.SP_CDM_UPLOADS_DIR . '' . $r['uid'] . '/' . $r['file'] . '');	
		
	}else{
		
	$file_size = cdm_human_filesize($r['file_size']);	
	}
	
	return apply_filters('sp_cdm/file_size',$file_size,$r);
		
	
	
}
function cdm_get_folder_tree($pid, $projects = array())
{
    global $wpdb;
    global $wpdb;
 
  $cache = get_transient('cdm_file_permissions_folder_tree_' . $pid . '');
 	if( $cache== false){
    $r = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE  parent = %d", $pid), ARRAY_A);
    if ($r != false) {
        for ($i = 0; $i < count($r); $i++) {
            $projects[$r[$i]['id']] = $r[$i]['id'];
            $projects               = cdm_get_folder_tree($r[$i]['id'], $projects);
        }
    }
	 set_transient('cdm_file_permissions_folder_tree_' . $pid . '', $projects, 72 * HOUR_IN_SECONDS);
	
	}else{
		
	$projects = $cache;
		
	}
	

    return $projects;
}



function cdm_file_permissions($pid)
{
    global $wpdb, $current_user;
    if (cdm_var('uid') != '') {
        $uid = cdm_var('uid');
    } else {
        $uid = $current_user->ID;
    }
	
	 //if owner of the folder
        $owner = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d", $pid), ARRAY_A);
        if ($uid == @$owner[0]['uid']) {
           return 1;
        }
		
		if(cdmFindLockedGroup($uid, @$owner[0]['uid']) == true){
		
			return 1;
		}
		
	if(get_option('sp_cu_release_the_kraken') == 1){
	return 1;	
	}
	
    $cache_permission = get_transient('cdm_file_permissions_' . $pid . '_' . $uid . '');
   
    if ($cache_permission == false) {
        $permission  = 0;
        $pid         = apply_filters('cdm/file_permissions', $pid);
        $parent      = findRootParent($pid);
      #  $parent_tree = cdm_get_folder_tree($parent);
        //if an admin
        if (current_user_can('manage_options')) {
           return 1;
        }
       
        //if given permission for groups addon
        if (class_exists('sp_cdm_groups_addon')) {
            global $sp_cdm_groups_addon_projects;
            $sp_cdm_groups_perm = new sp_cdm_groups_addon;
            //can delete folder
            if (get_option('sp_cdm_groups_addon_project_add_folders_' . $pid . '') == 1) {
               return 1;
            }
            //check to see if user is part of a buddy press group that has access to this folder
            if ($sp_cdm_groups_perm->buddypress == true) {
                $folder_perm = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_buddypress_permission_add_' . $pid . '');
                $query       = $wpdb->prepare("SELECT user_id,group_id,name," . $wpdb->prefix . "bp_groups.id FROM  " . $wpdb->prefix . "bp_groups_members  
	   									   LEFT JOIN " . $wpdb->prefix . "bp_groups ON " . $wpdb->prefix . "bp_groups_members.group_id = " . $wpdb->prefix . "bp_groups.id  where user_id = %d",$uid );
                $groups_info = $wpdb->get_results($query, ARRAY_A);
                if (count($groups_info) > 0) {
                    for ($i = 0; $i < count($groups_info); $i++) {
                        if (@in_array($groups_info[$i]['id'], $folder_perm)) {
                            return 1;
                        }
                    }
                }
            } //end buddypress
            if (class_exists('sp_cdm_groups_addon_projects')) {
                //check roles permission
                $folder_perm_roles = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_role_permission_add_' . $pid . '');
                #print_r(  $folder_perm_roles);
                $user_roles        = $current_user->roles;
                #	print_r($user_roles);
                if (count($user_roles) > 0) {
                    foreach ($user_roles as $key => $role) {
                        if (@in_array($role, $folder_perm_roles)) {
                            return 1;
                        }
                    }
                }
                //check to see if user is part of a buddy press group that has access to this folder
                $folder_perm = sp_cdm_groups_addon_projects::get_permissions('sp_cdm_groups_addon_groups_permission_add_' . findRootParent($pid) . '');
                $r           = $wpdb->get_results($wpdb->prepare("SELECT  * FROM " . $wpdb->prefix . "sp_cu_advanced_groups_assign where uid = %d ", $uid), ARRAY_A);
                if (count($r) > 0) {
                    for ($i = 0; $i < count($r); $i++) {
                        if (@in_array($r[$i]['gid'], $folder_perm)) {
                            return 1;
                        }
                    }
                }
                //end roles permission
                $folder_user_permissions = get_option("sp_cdm_groups_share_user_" . $pid . "");
				
                if ($folder_user_permissions != false) {
                    $folder_user_permissions = unserialize($folder_user_permissions);
                 
				    foreach ($folder_user_permissions as $key => $folder) {
                        if ($key == $current_user->ID && $folder['write'] == 1) {
                          
						   return 1;
                        }
                    }
                }
            } //end grioups addon
            //global setting
            if (get_option('sp_cdm_groups_addon_project_add_' . $pid . '') == 1) {
                return 1;
            }
        }
        //is part of premium group
        if ($pid == 0 or $pid == '') {
            return 1;
        }
        $permission = apply_filters('cdm_file_permissions', $permission, $pid, $uid);
        if (current_user_can('manage_options')) {
           return 1;
        }
        if (get_option('sp_cu_user_projects_required', 0) == 1 && ($pid == 0 or $pid == '')) {
            return 0;
        }
        set_transient('cdm_file_permissions_' . $pid . '_' . $current_user->ID . '', $permission, 72 * HOUR_IN_SECONDS);
    } else {
        $permission = $cache_permission;
    }
    return $permission;
}
function cdm_contains_viewable($pid)
{
    $show       = 0;
    $viewable   = array();
    $viewable   = cdm_get_folder_tree($pid);
	
    $viewable[] = $pid;
    if (count($viewable) > 0) {
        foreach ($viewable as $vid) {
            if (cdm_folder_permissions($vid) == 1) {
                return 1;
            }
        }
    }
    return $show;
}
function cdm_folder_permissions($pid)
{
    global $wpdb, $current_user;
    if (cdm_var('uid') != '') {
        $uid = cdm_var('uid');
    } else {
        $uid = $current_user->ID;
    }
    $cache_permission = get_transient('cdm_folder_permissions_' . $pid . '_' . $current_user->ID . '');
    $no_cache         = 1;
    $skip_transient   = 1;
   $cache_permission = false;
  
	if(get_option('sp_cu_release_the_kraken') == 1){
	return 1;	
	}
    if ( $cache_permission == false) {
		 
        $permission  = 0;
        $opid        = $pid;
        $pid         = apply_filters('cdm/file_permissions', $pid);
        $parent      = findRootParent($pid);
        $parent_tree = array();
      #  $parent_tree = cdm_get_folder_tree($parent);
        //if an admin
        if (current_user_can('manage_options')) {
            return 1;
        }
		
        //if owner of the folder
        $owner = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d",$pid), ARRAY_A);
        if ($uid == $owner[0]['uid']) {
           return 1;
        }
	
		if(cdmFindLockedGroup($uid, $owner[0]['uid']) == true){
			return 1;
		}
        //cdm premium groups
        if ($pid > 0 && is_numeric($pid)) {
            $groups_premium = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_groups_assign WHERE uid = %d",$owner[0]['uid']), ARRAY_A);
            for ($i = 0; $i < count($groups_premium); $i++) {
                $groups_part_of[] = $groups_premium[$i]['gid'];
            }
            if (count($groups_part_of) > 0) {
                foreach ($groups_part_of as $key => $value) {
                    $groups_premium_find = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_groups_assign WHERE gid = %d AND uid = %d",$value,$current_user->ID), ARRAY_A);
                    if (count($groups_premium_find) > 0) {
                        return 1;
                    }
                }
            }
        }
		
		
        //if given permission for groups addon
        if (class_exists('sp_cdm_groups_addon')) {
            $sp_cdm_groups_perm = new sp_cdm_groups_addon;
            //can delete folder
            if (get_option('sp_cdm_groups_addon_project_add_folders_' . $pid . '') == 1) {
				
            #   return 1;
            }
			
            //check to see if user is part of a buddy press group that has access to this folder
            if ($sp_cdm_groups_perm->buddypress == true) {
                $folder_perm = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_buddypress_permission_' . $pid . '');
                $query       = $wpdb->prepare("SELECT user_id,group_id,name," . $wpdb->prefix . "bp_groups.id FROM  " . $wpdb->prefix . "bp_groups_members  
	   									   LEFT JOIN " . $wpdb->prefix . "bp_groups ON " . $wpdb->prefix . "bp_groups_members.group_id = " . $wpdb->prefix . "bp_groups.id  where user_id = %d",$uid);
                $groups_info = $wpdb->get_results($query, ARRAY_A);
               
			    if (count($groups_info) > 0) {
                    for ($i = 0; $i < count($groups_info); $i++) {
                        if (@in_array($groups_info[$i]['id'], $folder_perm)) {
                          
						  
						   return 1;
                        }
                    }
                }
            } //end buddypress
            
			
			//check roles permission
            $folder_perm_roles = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_role_permission_' . $pid . '');
            $user_roles        = $current_user->roles;
            if (count($user_roles) > 0) {
                foreach ($user_roles as $key => $role) {
                    if (@in_array($role, $folder_perm_roles)) {
						
                        return 1;
                    }
                }
            }
			
			
            /*
            if(count($parent_tree)>0){
            $total = count($parent_tree);
            foreach($parent_tree as $tree){
            
            $parent_look .= ' OR option_name = "' .$sp_cdm_groups_perm->namesake . '_role_permission_'.$tree.'" ';	
            
            }
            
            $query = "SELECT * FROM  " . $wpdb->prefix . "options  
            WHERE (option_value = 'null' ".$parent_look.")";
            
            $parent_lookup = $wpdb->get_results($query, ARRAY_A);
            
            if($parent_lookup != false && count($parent_lookup) >0){
            for ($i = 0; $i < count( $parent_lookup); $i++) {
            unset($roles_array);
            $roles_array = unserialize(unserialize( $parent_lookup[$i]['option_value']));
            
            foreach ($user_roles as $key =>$role) {
            
            if (@in_array($role, $roles_array)) {
            
            $permission = 1;
            }	
            
            }
            
            }
            }
            }
            
            */
            //end roles permission
            $folder_perm = sp_cdm_groups_addon_projects::get_permissions('sp_cdm_groups_addon_groups_permission_' . $pid . '');
            $r           = $wpdb->get_results($wpdb->prepare("SELECT  * FROM " . $wpdb->prefix . "sp_cu_advanced_groups_assign where uid = %d ", $uid), ARRAY_A);
            if (count($r) > 0) {
                for ($i = 0; $i < count($r); $i++) {
                    if (@in_array($r[$i]['gid'], $folder_perm)) {
						
                       return 1;
                    }
                }
            }
            $folder_user_permissions_o = get_option("sp_cdm_groups_share_user_" . $opid . "");
            if (get_option("sp_cdm_groups_share_user_" . $pid . "") != false) {
                $folder_user_permissions_c = array();
                if (get_option("sp_cdm_groups_share_user_" . $pid . "") != false) {
                    $folder_user_permissions_c = @unserialize(get_option("sp_cdm_groups_share_user_" . $pid . ""));
                }
                $folder_user_permissions_o = array();
                if (get_option("sp_cdm_groups_share_user_" . $opid . "") != false) {
                    $folder_user_permissions_o = @unserialize(get_option("sp_cdm_groups_share_user_" . $opid . ""));
                }
                $folder_user_permissions = array();
                $folder_user_permissions = array_replace($folder_user_permissions_c, $folder_user_permissions_o);
                if (count($folder_user_permissions) > 0) {
                    foreach ($folder_user_permissions as $key => $folder) {
                        if ($key == $current_user->ID && $folder['read'] == 1) {
                           return 1;
                        }
                    }
                }
            }
            //global setting
            if (get_option('sp_cdm_groups_addon_project_add_folder_' . $pid . '') == 1) {
           
			 return 1;
			 
            }
        } //end grioups addon
        //is part of premium group
		
		
        if ($pid == 0 or $pid == '') {
			
           return 1 ;
        }
        if ($permission != 1) {
            $permission = apply_filters('cdm_folder_permissions', $permission, $pid, $uid);
        }
		
        if (current_user_can('manage_options')) {
			
            return 1;
        }
		
        set_transient('cdm_folder_permissions_' . $pid . '_' . $current_user->ID . '', $permission, 72 * HOUR_IN_SECONDS);
    } else {
        $permission = $cache_permission;
    }


	
    return $permission;
}
function cdm_delete_permission($pid)
{
    global $wpdb, $current_user;
    if (cdm_var('uid') != '') {
        $uid = cdm_var('uid');
    } else {
        $uid = $current_user->ID;
    }
    $cache_permission = get_transient('cdm_delete_permissions_' . $pid . '_' . $current_user->ID . '');
   if(get_option('sp_cu_release_the_kraken') == 1){
	return 1;	
	}
	if ($cache_permission === false) {
        $permission = 0;
        $permission = 0;
        $pid        = apply_filters('cdm/file_permissions', $pid);
        //if an admin
		
		
        if (current_user_can('manage_options')) {
           # $permission = 1;
        }
		
		
		
        //if owner of the folder
        $owner = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d", $pid), ARRAY_A);
        if ($uid == $owner[0]['uid']) {
            $permission = 1;
        }
        //if given permission for groups addon
        if (class_exists('sp_cdm_groups_addon')) {
            $sp_cdm_groups_perm = new sp_cdm_groups_addon;
            //can delete folder
            if (get_option('sp_cdm_groups_addon_project_delete_folders_' . $pid . '') == 1) {
                $permission = 1;
            }
            //check to see if user is part of a buddy press group that has access to this folder
            if ($sp_cdm_groups_perm->buddypress == true) {
                $folder_perm = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_buddypress_permission_delete_' . $pid . '');
                $query       = $wpdb->prepare("SELECT user_id,group_id,name," . $wpdb->prefix . "bp_groups.id FROM  " . $wpdb->prefix . "bp_groups_members  
	   									   LEFT JOIN " . $wpdb->prefix . "bp_groups ON " . $wpdb->prefix . "bp_groups_members.group_id = " . $wpdb->prefix . "bp_groups.id  where user_id = %d",$uid);
                $groups_info = $wpdb->get_results($query, ARRAY_A);
                if (count($groups_info) > 0) {
                    for ($i = 0; $i < count($groups_info); $i++) {
                        if (@in_array($groups_info[$i]['id'], $folder_perm)) {
                            $permission = 1;
                        }
                    }
                }
            } //end buddypress
            //check roles permission
            $folder_perm_roles = sp_cdm_groups_addon_projects::get_permissions('' . $sp_cdm_groups_perm->namesake . '_role_permission_delete_' . $pid . '');
           
	
		    $user_roles        = $current_user->roles;
			
            if (count($user_roles) > 0) {
                foreach ($user_roles as $key => $role) {
                    if (@in_array($role, $folder_perm_roles)) {
                        $permission = 1;
                    }
                }
            }
            //end roles permission
            //global setting
        } //end grioups addon
        //is part of premium group
		
	
        if ($pid == 0 or $pid == '') {
            $permission = 1;
        }
        if (current_user_can('manage_options')) {
          #  $permission = 1;
        }
		
		
        $permission = apply_filters('cdm_delete_permissions', $permission, $pid, $uid);
        
		set_transient('cdm_delete_permissions_' . $pid . '_' . $current_user->ID . '', $permission, 72 * HOUR_IN_SECONDS);
		
    } else {
        $permission = $cache_permission;
    }
    return $permission;
}
if (!function_exists('sp_cdm_category_value')) {
    function sp_cdm_category_value($id)
    {
        global $wpdb;
        $r_cat = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_cats   where id = %d",$id), ARRAY_A);
        return stripslashes($r_cat[0]['name']);
    }
    function sp_cdm_category_name()
    {
        if (get_option('sp_cu_cat_text') != '') {
            $cat = get_option('sp_cu_cat_text');
        } else {
            $cat = __("Category", "sp-cdm");
        }
        return $cat;
    }
}
if (!function_exists('set_html_content_type')) {
    function set_html_content_type()
    {
        return 'text/html';
    }
}
if (!function_exists('sp_cdm_folder_name')) {
    function sp_cdm_folder_name($type = 0)
    {
        if ($type == 1) {
            if (get_option('sp_cu_folder_name_plural') == '') {
                return __("Folders", "sp-cdm");
            } else {
                return stripslashes(get_option('sp_cu_folder_name_plural'));
            }
        } else {
            if (get_option('sp_cu_folder_name_single') == '') {
                return __("Folder", "sp-cdm");
            } else {
                return stripslashes(get_option('sp_cu_folder_name_single'));
            }
        }
    }
}
function sp_cdm_thumbnail($url, $w = NULL, $h = NULL)
{
    global $wpdb;
    $path  = str_replace(SP_CDM_UPLOADS_DIR_URL, SP_CDM_UPLOADS_DIR, $url);
    $thumb = false;

	
    if (file_exists($path)) {
		$file_size =  filesize($path) ;
	
	
	
        if($file_size > '5447460'){
		
		return false;
		}
		
		
		$size = getimagesize($path);
	
		
		
		
		
        if ($h != NULL) {
            $settings['height'] = $h;
            if ($size[1] < $settings['height']) {
                $settings['height'] = $size[1];
            }
        }
        if ($w != NULL) {
            $settings['width'] = $w;
            if ($size[0] < $settings['width']) {
                $settings['width'] = $size[0];
            }
        }
        $settings['crop'] = false;
        $thumb            = bfi_thumb($url, $settings);
    }
    return $thumb;
}
function sp_cdm_get_current_user_role_name()
{
    global $current_user;
    wp_get_current_user();
    $user_roles = $current_user->roles;
    $user_role  = array_shift($user_roles);
    return $user_role;
}

function sp_cdm_get_file($id)
{
    global $wpdb;
   
    $r = $wpdb->get_results($wpdb->prepare("SELECT *

	

									 FROM " . $wpdb->prefix . "sp_cu_project

									 WHERE id = %d", intval($id)), ARRAY_A);
    if($r == false){
	return false;	
	}else{
	return $r[0];	
	}
}

function sp_cdm_get_project_name($id)
{
    global $wpdb;
    if ($id == '' or $id == 0) {
        return __('Root', 'sp-cdm');
    }
    $r = $wpdb->get_results("SELECT *

	

									 FROM " . $wpdb->prefix . "sp_cu_project

									 WHERE id = '" . $id . "'", ARRAY_A);
    if ($r[0]['name'] != "") {
        return stripslashes($r[0]['name']);
    } else {
        return false;
    }
}
function sp_cdm_get_current_user_role()
{
    global $current_user;
    $user_roles = $current_user->roles;

    $user_role = array_shift($user_roles);
    return $user_role;
}
function sp_cdm_find_users_by_role($role)
{
    global $wpdb;
    $wp_user_search = new WP_User_Query(array(
        "role" => $role
    ));
    $role_data      = $wp_user_search->get_results();
    foreach ($role_data as $item) {
        $role_data_ids[] = $item->ID;
    }
    $ids = implode(',', $role_data_ids);
    $r   = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where id IN(" . $ids . ")", ARRAY_A);
    for ($i = 0; $i < count($r); $i++) {
        $emails[$i] = $r[$i]['user_email'];
    }
    return $emails;
}
function sp_do_function_header($file)
{
}
function sp_client_upload_filename($user_id)
{
    global $wpdb;
    $r     = $wpdb->get_results("SELECT*

									 FROM " . $wpdb->prefix . "users  where id = $user_id", ARRAY_A);
    $extra = get_option('sp_cu_filename_format');
    $extra = str_replace('%y', date('Y'), $extra);
    $extra = str_replace('%h', date('H'), $extra);
    $extra = str_replace('%min', date('i'), $extra);
    $extra = str_replace('%m', date('m'), $extra);
    $extra = str_replace('%d', date('d'), $extra);
    $extra = str_replace('%t', time(), $extra);
    $extra = str_replace('%uid', $user_id, $extra);
    $extra = str_replace('%u', $r[0]['display_name'], $extra);
    $extra = str_replace('%r', rand(100000, 100000000000), $extra);
    return $extra;
}
add_filter('sp_cdm/premium/upload/file_name', 'sp_client_upload_filename_new', 8, 2);
function sp_client_upload_filename_new($filename, $user_id)
{
    global $wpdb;
	
	$request = $_REQUEST;
    $original_name = $filename;
    if (get_option('sp_cu_filename_format') == '') {
        return $filename;
    } else {
        $r          = $wpdb->get_results("SELECT *

									 FROM " . $wpdb->prefix . "users  where id = $user_id", ARRAY_A);
        $filename   = get_option('sp_cu_filename_format');
        $path_parts = pathinfo($original_name);
		
	
        $filename = str_replace('%f', $path_parts['filename'], $filename);
		
		
		
		
		if(cdm_var('filename') == ''){
		$name = 	cdm_var('name');
		}else{
		$name = 	cdm_var('filename');	
		}
		if(!$request){
		$name = $original_name;	
		}
		$filename = str_replace('%n', $name, $filename);
    
        $filename = str_replace('%y', date('Y'), $filename);
        $filename = str_replace('%h', date('H'), $filename);
        $filename = str_replace('%min', date('i'), $filename);
        $filename = str_replace('%m', date('m'), $filename);
        $filename = str_replace('%d', date('d'), $filename);
        $filename = str_replace('%t', time(), $filename);
        $filename = str_replace('%uid', $user_id, $filename);
        $filename = str_replace('%u', $r[0]['display_name'], $filename);
        $filename = str_replace('%r', rand(100000, 100000000000), $filename);
        $filename .= '.' . $path_parts['extension'] . '';
     
        return $filename;
    }
}



function sp_client_upload_filename_direct($id)
{
    global $wpdb;

 $file          = $wpdb->get_results($wpdb->prepare("SELECT *

									 FROM " . $wpdb->prefix . "sp_cu  where id = %d", $id), ARRAY_A);

    if (get_option('sp_cu_filename_format') == '') {
        return $file[0]['file'];
    } else {
       							 
		
	   
	    $r          = $wpdb->get_results($wpdb->prepare("SELECT *

									 FROM " . $wpdb->prefix . "users  where ID = %d",$file[0]['uid']), ARRAY_A);
		$user_id = $r[0]['uid'];							 
        $filename   = get_option('sp_cu_filename_format');
        $path_parts = pathinfo($file[0]['file']);
        
		
		
		$filename = str_replace('%f', $path_parts['filename'], $filename);
		$name = $r[0]['name'];
		$filename = str_replace('%n', $name, $filename);
    
        $filename = str_replace('%y', date('Y'), $filename);
        $filename = str_replace('%h', date('H'), $filename);
        $filename = str_replace('%min', date('i'), $filename);
        $filename = str_replace('%m', date('m'), $filename);
        $filename = str_replace('%d', date('d'), $filename);
        $filename = str_replace('%t', time(), $filename);
        $filename = str_replace('%uid', $user_id, $filename);
        $filename = str_replace('%u', $r[0]['display_name'], $filename);
        $filename = str_replace('%r', rand(100000, 100000000000), $filename);
        $filename .= '.' . $path_parts['extension'] . '';
       
	   
	   
        return $filename;
    }
}

function sp_array_remove_empty($arr)
{
    $narr = array();
    while (list($key, $val) = each($arr)) {
        if (is_array($val)) {
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val) != 0) {
                // yes :-)
                $narr[$key] = $val;
            }
        } else {
            if (trim($val) != "") {
                $narr[$key] = $val;
            }
        }
    }
    unset($arr);
    return $narr;
}
function sp_uploadFile($files, $history = NULL)
{
    global $wpdb;
    global $user_ID;
    global $current_user;
    if (cdm_var('page') == 'sp-client-document-manager-fileview' && cdm_var('id') != '') {
        $user_ID = sanitize_text_field(cdm_var('id'));
    }
    $dir = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
    }
    $count = sp_array_remove_empty($files['dlg-upload-file']['name']);
    if ($history == 1) {
        $name        = $files['dlg-upload-file']['name'][0];
        $wp_filetype = wp_check_filetype($name);
        if (!$wp_filetype['ext'] && !current_user_can('unfiltered_upload')) {
            echo __('Invalid file type');
            exit;
        }
        $dir         = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
        $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][0], $user_ID);
        $filename    = strtolower($filename);
        $filename    = sanitize_file_name($filename);
        $filename    = remove_accents($filename);
        $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
        $target_path = $dir . $filename;
        move_uploaded_file($files['dlg-upload-file']['tmp_name'][0], $target_path);
        $ext = preg_replace('/^.*\./', '', $filename);
        if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')) {
            $info    = new Imagick();
            $formats = $info->queryFormats();
            if (in_array(strtoupper($ext), $formats)) {
                cdm_thumbPdf($target_path);
            }
        }
        return $filename;
    } else {
        if (count($count) > 1) {
            //echo $count;
            //	echo '<pre>';
            //print_r($files);exit;
            //echo '</pre>';
            $fileTime = date("D, d M Y H:i:s T");
            $zip      = new Zip(true);
            for ($i = 0; $i < count($files['dlg-upload-file']['name']); $i++) {
                $name = $files['dlg-upload-file']['name'][$i];
                if ($files['dlg-upload-file']['error'][$i] == 0) {
                    $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][$i], $user_ID);
                    $filename    = strtolower($filename);
                    $filename    = sanitize_file_name($filename);
                    $filename    = remove_accents($filename);
                    $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
                    $target_path = $dir . $filename;
                    move_uploaded_file($files['dlg-upload-file']['tmp_name'][$i], $target_path);
                    $zip->addFile(file_get_contents($target_path), $filename, filectime($target_path));
                }
            }
            $return_file = "" . rand(100000, 100000000000) . "_Archive.zip";
            $zip->getZipData($return_file);
            return $return_file;
        } else {
            $name        = $files['dlg-upload-file']['name'][1];
            # $wp_filetype = wp_check_filetype( $name );
            #  if ( ! $wp_filetype['ext'] && ! current_user_can( 'unfiltered_upload' ) ){
            #return  'upload_error';
            #}
            $dir         = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
            #$filename = ''.sp_client_upload_filename($user_ID) .''.$files['dlg-upload-file']['name'][1].'';
            $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][1], $user_ID);
            $filename    = strtolower($filename);
            $filename    = sanitize_file_name($filename);
            $filename    = remove_accents($filename);
            $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
            $target_path = $dir . $filename;
            move_uploaded_file($files['dlg-upload-file']['tmp_name'][1], $target_path);
            $ext = preg_replace('/^.*\./', '', $filename);
            if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')) {
                $info    = new Imagick();
                $formats = $info->queryFormats();
                if (in_array(strtoupper($ext), $formats)) {
                    cdm_thumbPdf($target_path);
                }
            }
            return $filename;
        }
    }
}
function sp_Admin_uploadFile($files, $user_ID)
{
    global $wpdb;
    $dir   = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
    $count = sp_array_remove_empty($files['dlg-upload-file']['name']);
    if ($history == 1) {
        $dir         = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
        #$filename = ''.sp_client_upload_filename($user_ID) .''.$files['dlg-upload-file']['name'][0].'';
        $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][0], $user_ID);
        $filename    = strtolower($filename);
        $filename    = sanitize_file_name($filename);
        $filename    = remove_accents($filename);
        $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
        $target_path = $dir . $filename;
        move_uploaded_file($files['dlg-upload-file']['tmp_name'][0], $target_path);
        $ext = preg_replace('/^.*\./', '', $filename);
        if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')) {
            $info    = new Imagick();
            $formats = $info->queryFormats();
            if (in_array(strtoupper($ext), $formats)) {
                cdm_thumbPdf($target_path);
            }
        }
        return $filename;
    } else {
        if (count($count) > 1) {
            //echo $count;
            //	echo '<pre>';
            //print_r($files);exit;
            //echo '</pre>';
            $fileTime = date("D, d M Y H:i:s T");
            $zip      = new Zip(true);
            for ($i = 0; $i < count($files['dlg-upload-file']['name']); $i++) {
                if ($files['dlg-upload-file']['error'][$i] == 0) {
                    #$filename = ''.sp_client_upload_filename($user_ID) .''.$files['dlg-upload-file']['name'][$i].'';
                    $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][$i], $user_ID);
                    $filename    = strtolower($filename);
                    $filename    = sanitize_file_name($filename);
                    $filename    = remove_accents($filename);
                    $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
                    $target_path = $dir . $filename;
                    move_uploaded_file($files['dlg-upload-file']['tmp_name'][$i], $target_path);
                    $zip->addFile(file_get_contents($target_path), $filename, filectime($target_path));
                }
            }
            $return_file = "" . rand(100000, 100000000000) . "_Archive.zip";
            $zip->getZipData($return_file);
            return $return_file;
        } else {
            $dir         = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
            #$filename = ''.sp_client_upload_filename($user_ID) .''.$files['dlg-upload-file']['name'][1].'';
            $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][1], $user_ID);
            $filename    = strtolower($filename);
            $filename    = sanitize_file_name($filename);
            $filename    = remove_accents($filename);
            $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $user_ID);
            $target_path = $dir . $filename;
            move_uploaded_file($files['dlg-upload-file']['tmp_name'][1], $target_path);
            $ext = preg_replace('/^.*\./', '', $filename);
            if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')) {
                $info    = new Imagick();
                $formats = $info->queryFormats();
                if (in_array(strtoupper($ext), $formats)) {
                    cdm_thumbPdf($target_path);
                }
            }
            return $filename;
        }
    }
}
?>