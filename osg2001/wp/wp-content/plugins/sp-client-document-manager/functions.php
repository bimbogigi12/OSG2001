<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_activation_hook(__FILE__, 'sp_zip_cleanup_cron_activation');
register_deactivation_hook(__FILE__, 'sp_zip_cleanup_cron_deactivation');
if(get_option('sp_zip_cleanup_cron') == false){
	add_action('init','sp_zip_cleanup_cron_activation');
	update_option('sp_zip_cleanup_cron',1);
}
add_action('sp_zip_cleanup_cron', 'sp_zip_cleanup_cron_process');


function cdm_move_file_to_user($from,$to,$file_id){
	global $wpdb;
	
	
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where id = %d",intval($file_id)), ARRAY_A);	
	
	$from_file = '' . SP_CDM_UPLOADS_DIR . ''.$from.'/'.$r[0]['file'].'';
	$to_file = '' . SP_CDM_UPLOADS_DIR . ''.$to.'/'.$r[0]['file'].'';
	
	 if(file_exists($from_file)){	
	 
	  if (!is_dir('' . SP_CDM_UPLOADS_DIR . ''.$to.'/')) {
            mkdir('' . SP_CDM_UPLOADS_DIR . ''.$to.'/', 0777);
        }
	 
	 rename ($from_file,$to_file );	 
	 }
	
	 $update['uid'] = $to;
	 $where['id'] = $file_id;
	 $wpdb->update("" . $wpdb->prefix . "sp_cu", $update,$where);
	 
	
}

function cdm_move_folder_to_user($from,$to,$folder_id){
	global $wpdb;
	
	
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d",intval($folder_id)), ARRAY_A);	
	
	
	
	 $update['uid'] = $to;
	 $where['id'] = $folder_id;
	 $wpdb->update("" . $wpdb->prefix . "sp_cu_project", $update,$where);	 
	
}

function cdm_reassign_user_files($from,$to){
	global $wpdb;
	
	
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where uid = %d",intval($from)), ARRAY_A);	
	
	if($r != false){
		for ($i = 0; $i < count($r); $i++) {
		cdm_move_file_to_user($from,$to,$r[$i]['id']);
		}
		
	}
	
}



function cdm_reassign_user_folders($from,$to){
	global $wpdb;
	
	
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where uid = %d",intval($from)), ARRAY_A);	
	
	if($r != false){
		for ($i = 0; $i < count($r); $i++) {
		cdm_move_folder_to_user($from,$to,$r[$i]['id']);
		}
		
	}
	
}



function cdm_delete_user_files($user_id){
	global $wpdb;
	
	$spdm_ajax = new spdm_ajax;
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where uid = %d",intval($user_id)), ARRAY_A);	
	
	if($r != false){
		for ($i = 0; $i < count($r); $i++) {
		$spdm_ajax->delete_file($r[$i]['id']);
		}
		
	}
	
}

function cdm_delete_user_folders($user_id){
	global $wpdb;
	

	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where uid = %d",intval($user_id)), ARRAY_A);	
	
	if($r != false){
		for ($i = 0; $i < count($r); $i++) {
		  $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d",intval($r[$i]['id'])));
		}
		
	}
	
}

function cdm_user_has_files($user_id){
		global $wpdb;
		
	$query = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu   where uid= %d ",intval($user_id)));	

	if($query == false){
		return false;
	}else{
			
		return true;
	}
}

function cdm_user_has_folders($user_id){
		global $wpdb;
		
	$query = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu_project   where uid= %d ",intval($user_id)));	
	if($query == false){
		return false;
	}else{
		
		return true;
	}
}

function cdm_parent_exists($file_id){
	
		global $wpdb;
		$ok = true;
		if($file_id != 0 && $file_id != ''){
	$query = $wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu   where id= %d ",sanitize_text_field($file_id));	
	$r = $wpdb->get_results($query, ARRAY_A);
		
			if($r == false){	
			$lost_children = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu   where parent = %d ",sanitize_text_field($file_id)), ARRAY_A);
			$ok = false;	
				    for ($i = 0; $i < count($lost_children ); $i++) {
					spdm_ajax::delete_file($lost_children[$i]['id']);	
					}
			}
		}
		
		return $ok ;
	
}
function cdm_get_option($option,$default = NULL){
	
	if($default == NULL){
		
		$option = get_option($option);
	}else{
		$option = get_option($option,$default);	
	}
		$option = stripslashes($option);
		
		return $option;
}

function cdm_download_file_link($file_id,$type,$ext=NULL,$file_types= NULL){
		
		$link = '';
		if(get_option('sp_cu_file_direct_access') == 1){
		
		return 	admin_url( 'admin-ajax.php?cdm-download-file-id='.$file_id.'' );;	
		}
		
		if($ext != NULL && $file_types != NULL){
	   if ($type == 1 or in_array($ext,$file_types) ) {
           $link .=  'target="_blank" ';
        } else {
           $link .= ' ';
        }
		}
		
		$url = 	admin_url( 'admin-ajax.php?cdm-download-file-id='.$file_id.'' );
		$link .= ' href="'.$url.'" ';
		if(get_option('sp_cu_js_redirect') == 1){
		$link .=' target="_blank"';	
		}
		
		$link = apply_filters('cdm/file/link',$link, $file_id,$type,$ext,$file_types);
		return $link;
}

function smartReadFile($location, $filename, $mimeType='application/octet-stream')
{ if(!file_exists($location))
  { header ("HTTP/1.0 404 Not Found");
    return;
  }
  




  $size= filesize($location);
  $time=date('r',filemtime($location));
 
  $fm=fopen($location,'r')  or die("Couldn't get handle");
  


  
  
  if(!$fm)
  { header ("HTTP/1.0 505 Internal server error");
    return;
  }
  
  $begin=0;
  $end=$size;
  
  if(isset($_SERVER['HTTP_RANGE']))
  { if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches))
    { $begin=intval($matches[0]);
      if(!empty($matches[1]))
        $end=intval($matches[1]);
    }
  }
 

  if($begin>0||$end<$size)
    header('HTTP/1.0 206 Partial Content');
  else
    header('HTTP/1.0 200 OK');  

  header('Content-Type: application/force-download');
  header('Cache-Control: public, must-revalidate, max-age=0');
  header('Pragma: no-cache');  
  header('Accept-Ranges: bytes');
  header('Content-Length:'.($end-$begin));
  header("Content-Range: bytes $begin-$end/$size");
  header("Content-Disposition: attachment; filename=$filename");
    header('Content-Transfer-Encoding: binary');
  header("Last-Modified: $time");
  header('Connection: close');  

// check for IE only headers

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
    header("Cache-control: private");
    header('Pragma: private');
} else {
    header('Pragma: public');
}
  $cur=$begin;
  fseek($fm,$begin,0);


#  while(!feof($fm)&&$cur<$end&&(connection_status()==0))
#  { print fread($fm,min(1024*16,$end-$cur));
#    $cur+=1024*16;
#  }
  
  
#  if ( function_exists( 'apache_get_modules' ) && in_array( 'mod_xsendfile', apache_get_modules() ) ) {
#			
#			header( "X-Sendfile: $location" );
#			exit;
#		} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'lighttpd' ) ) {
#			
#			header( "X-Lighttpd-Sendfile: $location" );
#			exit;
#		} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'nginx' ) || stristr( getenv( 'SERVER_SOFTWARE' ), 'cherokee' ) ) {
#			
#			$xsendfile_path = trim( preg_replace( '`^' . str_replace( '\\', '/', getcwd() ) . '`', '',$location ), '/' );
#			header( "X-Accel-Redirect: /$xsendfile_path" );
#			exit;
#	}
  
  
  
  
  
	$chunksize = 1024 * 1024;
	

		if ( false === $fm ) {
			return false;
		}

		while ( ! @feof($fm ) ) {
			echo @fread( $fm, $chunksize );

			if ( ob_get_length() ) {
				ob_flush();
				flush();
			}
		}
 
@fclose($fm);
  
  
  exit;
#  ob_end_flush();
}

if(!function_exists('mime_content_type')) {



    function mime_content_type($filename) {



        $mime_types = array(



            'txt' => 'text/plain',

			

			

            'htm' => 'text/html',

            'html' => 'text/html',

			

			

            'php' => 'text/html',

            'css' => 'text/css',

            'js' => 'application/javascript',

			

			

            'json' => 'application/json',

			

			

            'xml' => 'application/xml',

            'swf' => 'application/x-shockwave-flash',

            'flv' => 'video/x-flv',



            // images

            'png' => 'image/png',

            'jpe' => 'image/jpeg',

            'jpeg' => 'image/jpeg',

            'jpg' => 'image/jpeg',

            'gif' => 'image/gif',

            'bmp' => 'image/bmp',

            'ico' => 'image/vnd.microsoft.icon',

            'tiff' => 'image/tiff',

            'tif' => 'image/tiff',

            'svg' => 'image/svg+xml',

            'svgz' => 'image/svg+xml',



            // archives

            'zip' => 'application/zip',

            'rar' => 'application/x-rar-compressed',

            'exe' => 'application/x-msdownload',

            'msi' => 'application/x-msdownload',

            'cab' => 'application/vnd.ms-cab-compressed',



            // audio/video

            'mp3' => 'audio/mpeg',

            'qt' => 'video/quicktime',

            'mov' => 'video/quicktime',



            // adobe

            'pdf' => 'application/pdf',

            'psd' => 'image/vnd.adobe.photoshop',

            'ai' => 'application/postscript',

            'eps' => 'application/postscript',

            'ps' => 'application/postscript',

		

            // ms office

            'doc' => 'application/msword',

            'rtf' => 'application/rtf',

            'xls' => 'application/vnd.ms-excel',

            'ppt' => 'application/vnd.ms-powerpoint',

			'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
			'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
			'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
			'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
			'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',

            // open office

            'odt' => 'application/vnd.oasis.opendocument.text',

            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',

			

			

			

        );



        $ext = strtolower(array_pop(explode('.',$filename)));

        if (array_key_exists($ext, $mime_types)) {

            return $mime_types[$ext];
		
        }

        elseif (function_exists('finfo_open')) {
		
            $finfo = finfo_open(FILEINFO_MIME);

            $mimetype = finfo_file($finfo, $filename);

            finfo_close($finfo);

            return $mimetype;

			

        }

        else {

            return 'application/octet-stream';

        }

    }

}


function cdm_logout_url(){
		global $wp_query;
		$post_id = @$wp_query->post->ID;
		
	
		
	
	$logout = wp_logout_url(  get_post_permalink($post_id ) );
	$logout = apply_filters('spcdm/links/logout',$logout);
	return $logout;
	
}
function sp_zip_cleanup_cron_deactivation() {
	wp_clear_scheduled_hook('sp_zip_cleanup_cron');
}
function sp_zip_cleanup_cron_activation() {
	wp_schedule_event(time(), 'twicedaily', 'sp_zip_cleanup_cron');
}

function sp_zip_cleanup_cron_process() {
	
$zip_dir = "" . SP_CDM_UPLOADS_DIR."".md5(SP_CDM_UPLOADS_DIR)."/";	
	
$files = glob(''.$zip_dir.'*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
}


if (!function_exists('sp_client_upload_settings')) {
	function sp_cdm_remove_accents($string) {
    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    $chars = array(
    // Decompositions for Latin-1 Supplement
    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
    chr(195).chr(191) => 'y',
    // Decompositions for Latin Extended-A
    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
    chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
    );

    $string = strtr($string, $chars);

    return $string;
}
	
	function cdm_has_permission($uid,$file_uid,$id,$type){
			global $wpdb,$current_user;
		$view = 0; 
		
	 if(current_user_can('manage_options'))
		 return true;
	
			
		if($file_uid == $uid){ $view = 1; }	
			
		$view = apply_filters('sp_cdm_has_permission',$view,$uid,$file_uid,$id,$type);	
	
		return $view;
		
		
		
	}
	
	
	function cdm_user_can_delete($uid){
		
		 if(current_user_can('manage_options'))
		 return true;
		
		
		  if (
		  
		  ((
		  
		  ($current_user->ID == $r[0]['uid'] or cdmFindLockedGroup($current_user->ID, $r[0]['uid']) == true or get_option('' . $this->namesake . '_project_remove_' .  $r[0]['pid'] . '') == 1)
		   && 
		   get_option('sp_cu_user_delete_disable') != 1) or current_user_can('manage_options')) 
		   && 
		(get_option('sp_cdm_groups_addon_global_remove_roles_'.sp_cdm_get_current_user_role_name ().'') == '' 
		or get_option('sp_cdm_groups_addon_global_remove_roles_'.sp_cdm_get_current_user_role_name ().'') == 1 )
		) {
			return true;
			
		}else{
				return false;
		}
	}
	
	function cdm_user_can_add($uid){
		 
		 if(current_user_can('manage_options'))
		 return true;
		 
		 if (get_option('sp_cu_user_uploads_disable') != 1  and( 
			(get_option('sp_cdm_groups_addon_global_add_roles_'.sp_cdm_get_current_user_role_name ().'') == '' or
			get_option('sp_cdm_groups_addon_global_add_roles_'.sp_cdm_get_current_user_role_name ().'') == 1 )
			)
			) {
				return true;
				
			}else{
				return false;	
			}
		
	}
    function cdmFindLockedGroup($uid, $creator_id)
    {
        global $wpdb;
        $r_group_user = $wpdb->get_results("SELECT " . $wpdb->prefix . "sp_cu_groups_assign.gid,

											  " . $wpdb->prefix . "sp_cu_groups_assign.uid,

											  " . $wpdb->prefix . "sp_cu_groups_assign.id AS asign_id,

											  " . $wpdb->prefix . "sp_cu_groups.name,

											

											  " . $wpdb->prefix . "sp_cu_groups.id AS group_id

											    FROM " . $wpdb->prefix . "sp_cu_groups_assign 

												LEFT JOIN   " . $wpdb->prefix . "sp_cu_groups ON " . $wpdb->prefix . "sp_cu_groups_assign.gid = " . $wpdb->prefix . "sp_cu_groups.id

												WHERE uid = '" . $uid . "' ", ARRAY_A);
        $serve        = 0;
        for ($i = 0; $i < count($r_group_user); $i++) {
            if ($r_group_user[$i]['gid'] != "") {
                $r_group_user_select[$i] = $wpdb->get_results("SELECT * FROM  " . $wpdb->prefix . "sp_cu_groups_assign  

										LEFT JOIN " . $wpdb->prefix . "sp_cu_groups ON  " . $wpdb->prefix . "sp_cu_groups_assign.gid = " . $wpdb->prefix . "sp_cu_groups.id 

										WHERE " . $wpdb->prefix . "sp_cu_groups_assign.uid = '" . $creator_id . "' AND " . $wpdb->prefix . "sp_cu_groups_assign.gid = " . $r_group_user[$i]['group_id'] . " ", ARRAY_A);
                if ($r_group_user_select[$i][0]['id'] != "" && $r_group_user_select[$i][0]['locked'] == 1) {
                    $serve += 1;
                }
            }
        }
        if ($serve > 0) {
            return true;
        } else {
            return false;
        }
    }
	
	
	
	function cdm_thumbPdf($pdf){
		
		if(class_exists('imagick')){
			
			$upload_dir = wp_upload_dir();
			$tmp_folder =  $upload_dir['basedir'].'/imageMagick_tmp/';
			      if (!is_dir($tmp_folder)) {
            mkdir($tmp_folder, 0777);
        }
			
			$tmp    = $tmp_folder;
            $format = "png";
            $source = $pdf;
            $dest   = "" . $pdf . "_big.$format";
            $dest2   = "" . $pdf . "_small.$format";
			
			
			// read page 1 
$im = new imagick( ''.  $source.'[0]' ); 

// convert to jpg 
$im->setImageColorspace(255); 
$im->setImageFormat( $format); 

//resize 
$im->resizeImage(650, 650, imagick::FILTER_LANCZOS, 1);  

//write image on server 
$im->writeImage($dest); 

//resize 
$im->resizeImage(250, 250, imagick::FILTER_LANCZOS, 1);  

//write image on server 
$im->writeImage($dest2); 

$im->clear(); 
$im->destroy(); 
			
		}else{
			echo 'php-image-magick not installed. Please disable the pdf thumbnail options or install the php extention correctly.';exit;
		}
		
	
	}
    function __depcreated_cdm_thumbPdf($pdf)
    {
        try {
            $tmp    = SP_CDM_UPLOADS_DIR;
            $format = "png";
            $source = $pdf;
            $dest   = "" . $pdf . "_small.$format";
            $dest2  = "" . $pdf . "_big.$format";
            if (get_option('sp_cu_image_magick_path') != '') {
                $imageMagick_path = get_option('sp_cu_image_magick_path');
            } else {
                $imageMagick_path = '/usr/local/bin/convert';
            }
            $exec = "" . $imageMagick_path . " -scale 80x80 " . $source . "[0] $dest";
            $debug .= $exec . '<br>';
            exec($exec, $output, $result);
            if ($result != true) {
            } else {
                $debug .= '<br>Converted: ' . $result . '<br>';
            }
            $exec2 = "" . $imageMagick_path . " -scale 250x250 " . $source . "[0] $dest2";
            $debug .= $exec2 . '<br>';
            exec($exec2, $output, $result);
            if ($result != true) {
            } else {
                $debug .= '<br>Converted: ' . $result . '<br>';
            }
            $im = new Imagick($dest);
        }
        catch (Exception $e) {
            // echo $e->getMessage();
            $debug .= $e->getMessage() . '<br>';
        }
    }
   
    if (!function_exists('sp_client_upload_help')) {
        function sp_client_upload_help()
        {
			
		
			
			
            echo '' . sp_client_upload_nav_menu() . '
		
		
		

 <table class="wp-list-table widefat fixed posts" cellspacing="0">

 <tr>
<td>
	<h1>'.get_option('sp_cu_brand', 'Smarty Pants Client Document Manager').'</h1>
<ol>
  <li>Upload the plugin to your plugins folder</li>
  <li>Activate the plugin</li>
  <li>Create a new page and enter the shortcode [sp-client-document-manager]</li>
  <li>Go to the plugin admin page and click settings to configure the plugin (VERY IMPORTANT!)</li>
  <li>If you\'re using the premium version please upload the zip archive in the settings area.</li>
</ol>
<h2>Short Codes</h2>
<p>x = configurable area</p>
<h3>Main shortcode</h3>
<div class="updated"><strong>[sp-client-document-manager]</strong></div>
<h3>Link to a file</h3>
<div class="updated"><strong>[cdm-link file="x" date="1" real="1"]</strong></div>
<ul>
  <li>file = required, this is the file id. You can find the file id in admin under files or by clicking on a file. The ID is listed next to the date.</li>
  <li>date = (set to 1) optional, show the date of a file</li>
  <li>real = (set to 1) optional, generate the real url for the file, the link tags are not generated and only the url is returned. This is good for custom links and image url\'s</li>
</ul>
<h4>examples</h4>
<ul>
  <li>[cdm-link file="53" date="1"]</li>
  <li>Will generate a link with the file name and date</li>
</ul>
<p>\'&lt; img src="[cdm-link file="53" real="1"]" width="100"&gt;</p>
<p>Will generate a full url for use in an image</p>
<h3>Link to a project</h3>
<div class="updated"><strong>[cdm-project project="x" date="1" order="x" direction="x" limit="x" ]</strong></div>
<p>This shortlink will display a unordered list of files, it is a basic html ul so you can use css to display it however you want.</p>
<ul>
  <li>project = required, this is the project id which you can get in admin under the projects tab.</li>
  <li>date = optional, put\'s the date of the file next to the file name</li>
  <li>order = (name,date,id,file) optional, use one of the fields to order the list by</li>
  <li>direction = (asc,desc) optional, Only to be used with order, use asc for ascending order or desc for decending order</li>
  <li>limit = optional, use to limit the amount of results shown.</li>
</ul>
<h4>examples</h4>
<ul>
  <li>[cdm-project project="1" date="1" ]</li>
  <li>[cdm-project project="1" date="1" order="name" direction="asc" limit="10" ]</li>
  </ul>
<h3>Public view (premium only)</h3>
<div class="updated"><strong>[cdm_public_view]</strong></div>
</h3>
<p>This is a shortcode for premium members only, it displays the file list to the public. This shortcode lists all the files from all users.
<h2>User Role Capabilities</h2>
<p>If you use "User Role Editor" plugin and want to assign CDM capabilities to another role then please use the following custom captabilities. All are automatically set for administrator</p>
<ul>
  <li>sp_cdm = You need this role to view the plugin, this is a very minimal role. You can view files, edit and delete.</li>
  <li>sp_cdm_settings = Show Settings tab</li>
  <li>sp_cdm_vendors = Show vendors tab</li>
  <li>sp_cdm_projects = Show projects tab</li>
  <li>sp_cdm_uploader = Use the uploader (add files) </li>
  <li>sp_cdm_categories = Show the categories tab (premium only)</li>
  <li>sp_cdm_forms = Show the forms tab (premium only)</li>
  <li>sp_cdm_help = Show the help tab and display branding (premium only)</li>
  <li>sp_cdm_logs = Show the user logs (premium only)</li>
  <li>sp_cdm_show_folders_as_nav = Show the folders as its own nav (premium only)</li>
  <li>sp_cdm_top_menu = Show or hide the top menu (premium only)</li>
  <li>sp_cdm_uploader = Show the uploader tab (premium only)</li>
</ul>
<p><strong></p>
<h3>Premium Users</h3>
<p>*Premium users must have free + premium version installed. The premium extends the free version.</p>
</td></tr></table>
';
        }
    }
    if (!function_exists('sp_client_upload_nav_menu')) {
        function sp_client_upload_nav_menu($nav = NULL)
        {
			global $wpdb,$current_user;
			$content ='';
            global $cu_ver, $sp_client_upload, $sp_cdm_ver;
    
	 if (current_user_can('sp_cdm_top_menu')) {
	        $content .= '

	<script type="text/javascript">

    jQuery(document).ready(function(){

        jQuery("#menu1").ptMenu();

    });

</script>

	

	<ul id="menu1" style="margin-top:20px;margin-bottom:10px;">';
            if (current_user_can('sp_cdm')) {
                $content .= '<li><a href="admin.php?page=sp-client-document-manager" >Home</a></li>';
            }
            if (current_user_can('sp_cdm_settings')) {
                $content .= '<li><a href="admin.php?page=sp-client-document-manager-settings" >' . __("Settings", "sp-cdm") . '</a><ul>';
				    $content .= '<li><a href="admin.php?page=sp-client-document-manager-settings" >' . __("Global Settings", "sp-cdm") . '</a></li>';
                if (current_user_can('sp_cdm_vendors')) {
                    $content .= '<li><a href="admin.php?page=sp-client-document-manager-vendors" >' . __("Vendors", "sp-cdm") . '</a></li>';
                }
                if (current_user_can('sp_cdm_projects')) {
                    $content .= '<li><a href="admin.php?page=sp-client-document-manager-projects" >' .sp_cdm_folder_name(1) . '</a></li>';
                }
					
                if (@CU_PREMIUM == 1) {
                    if (current_user_can('sp_cdm_groups')) {
                        $content .= '<li><a href="admin.php?page=sp-client-document-manager-groups" >' . __("Share Spaces", "sp-cdm") . '</a></li>';
					}
					 if (current_user_can('sp_cdm_forms')) {
                        $content .= '<li><a href="admin.php?page=sp-client-document-manager-forms">' . __("Forms", "sp-cdm") . '</a></li>';
					 }
					  if (current_user_can('sp_cdm_categories')) {
                        $content .= '<li><a href="admin.php?page=sp-client-document-manager-categories" >' . __("Categories", "sp-cdm") . '</a></li>';
                    }
                }
                $extra_menus = '';
                $extra_menus .= apply_filters('sp_client_upload_nav_menu', $extra_menus);
                $content .= '' . $extra_menus . '</ul></li>';
            }
            if (current_user_can('sp_cdm_uploader')) {
                $content .= '<li><a href="admin.php?page=sp-client-document-manager-fileview" >' . __("User Files / Uploader", "sp-cdm") . '</a></li>

			';
            }
			 if (current_user_can('sp_cdm_help')) {
            $content .= '	
	<li><a href="admin.php?page=sp-client-document-manager-help" >' . __("Instructions", "sp-cdm") . '</a></li>';
			 }
	
	 $extra_top_menus = '';
       $extra_top_menus .= apply_filters('sp_client_upload_top_menu',  $extra_top_menus);
	$content .=''. $extra_top_menus.'

	</ul>';
	
	 }
			 if (current_user_can('sp_cdm_help')) {
            if (@CU_PREMIUM == 1) {
                $ver = $sp_cdm_ver;
            } else {
                $ver = $sp_client_upload;
            }
            $content .= '<div style="text-align:right"><strong style="margin-right:10px">Version:</strong> ' . get_option('sp_client_upload') . '';
            if (@CU_PREMIUM == 1) {
                $content .= ' <strong style="margin-left:50px;margin-right:10px;">Premium Version:</strong> ' . get_option('sp_client_upload_premium') . '';
            
			 }
            $content .= '</div>';
			}
            if (cdm_var('sphidemessage') == 1) {
                $content .= '		

			<script type="text/javascript">

				jQuery(document).ready( function() {

				 sp_cu_dialog("#sp_cdm_ignore",400,200);

			 

				});

			</script>



			<div style="display:none">

			

			<div id="sp_cdm_ignore">

			<h2>It\'s OK!</h2>

			<p>Hey no hard feelings, we hate nag messages too! If you change your mind and want to give us some love checkout the settings page for a link to the our website!</p>

			</div>

		    </div>';
                update_option("sp_cdm_ignore", 1);
            }
            if (cdm_var('sphidemessage') == '2') {
                update_option("sp_cdm_ignore", 0);
            }
            if (@CU_PREMIUM != 1 && get_option("sp_cdm_ignore") != 1) {
                $content .= '	

	<div class="updated">

	<p><strong>Upgrade to the premium version today to get enhanced features and support. Features include: File versioning system, Categories for files, Thumbnails for files, auto generation of thumbnails from PDF and PSD, Additional fields form builder, Support and many more enhanced settings!</strong> <br />

<br />

<a href="http://smartypantsplugins.com/sp-client-document-manager/" target="_blank" class="button">Click here to upgrade! </a> <a style="margin-left:10px" href="http://www.youtube.com/watch?feature=player_embedded&v=m6szdA3r-1Q" target="_blank" class="button">View the youtube video</a> <a style="margin-left:10px" href="http://smartypantsplugins.com/donate/" target="_blank" class="button">Click here to donate</a> <a href="admin.php?page=sp-client-document-manager&sphidemessage=1"  class="button" style="margin-left:10px">Click here to ignore us!</a></p>

	</div>';
            }
			
			
			 $r = $wpdb->get_results("SELECT * FROM  " . $wpdb->prefix . "posts where post_content LIKE   '%[sp-client-document-manager]%' and post_type = 'page'", ARRAY_A);
			if($r == false){
			$page_id = '';	
			}else{
			$page_id = $r[0]['ID'] ;	
			}
			
				if(get_option('sp_cu_uploads_page') != ''){
		
		$url = get_permalink(get_option('sp_cu_uploads_page'));
        $page_id = get_option('sp_cu_uploads_page');
		
	}
			
	
		if(count($r)>1){
                $content .= '<div class="sp_cdm_error" style="margin-bottom:20px">You have the  <strong>[sp-client-document-manager]</strong> shortcode on multiple pages, this can cause issues with linking and file locations. It\'s recommended to only have one shortcode per installation. If you need to display files you can do that with another one of our shortcodes.<a href="http://learn.smartypantsplugins.com/sp-premium-client-document-and-project-manager/advanced-shortcodes/" target="_blank">Click here to view more shortcodes</a></div>';
		}
	
	
	if(count($r)>0 && get_option('sp_cu_uploads_page') != ''){
                $content .= '<div class="sp_cdm_error" style="margin-bottom:20px">You have the  <strong>[sp-client-document-manager]</strong> shortcode set as well as the "Overide Documents page" set in advanced settings. Please choose one method by removing the shortcode or by unselecting a page in advanced settings.</div>';
		}
	
	
			
	if (cdm_var('ignore') == 'shortcode') {
                add_option('cdm_ignore_shortcode', 1);
            }
			
		if($page_id == ""  && get_option('cdm_ignore_shortcode') != 1){
                $content .= '<div class="sp_cdm_error" style="margin-bottom:20px">It looks like you do not have a page with the shortcode <strong>[sp-client-document-manager]</strong> on it. Please create one or use the form below and we will create one for you!';
				
				
				if(cdm_var('page-name-cdm')){
			
			if ( wp_verify_nonce( cdm_var('cdm_nonce'), 'cdm_nonce' ) == false) {exit('Security Error');}		

		
				// Create post object
			$my_post = array(
			  'post_title'    => sanitize_text_field(cdm_var('page-name-cdm')),
			  'post_content'  => '[sp-client-document-manager]',
			  'post_type'   => 'page',
			  'post_status'   => 'publish',
			  'post_author'   => $current_user->ID,
			 
			);

	
			$post = wp_insert_post( $my_post );
			$content .= '<div style="margin:10px;font-size:1.3em" class="sp_cdm_success"><strong>'.sanitize_text_field(cdm_var('page-name-cdm')).'</strong> Page Created! <a href="'.get_page_link($post).'" target="_blank">Click here to preview the page</a></div>';	
				}else{
				$content .='<form action="admin.php?page=sp-client-document-manager" method="post">'.wp_nonce_field( 'cdm_nonce', 'cdm_nonce', true, false ).'
				Page Name: <input type="text" name="page-name-cdm" value=""> <input type="submit" name="add-shortcode-page" value="Add">
				</form>
				<div style="text-align:right">
				<a href="admin.php?page=sp-client-document-manager-settings&ignore=shortcode" class="button">click here to ignore this message</a>
				</div>
				';
					
				}
				$content .='</div>';
            }
			
            if (cdm_var('ignore') == 'tml') {
                add_option('cdm_ignore_tml', 1);
            }
        
            echo $content;
            do_action('sp_cdm_errors');
        }
        add_action('cdm_nav_menu', 'sp_client_upload_nav_menu');
    }
    if (!function_exists('sp_client_upload_admin')) {
        function sp_client_upload_admin()
        {
            global $wpdb;
			$html = '';
            $search = '';
			$download_user = '';
			$user_id = sanitize_text_field(cdm_var('user_id'));
            $file = sanitize_text_field(cdm_var('dlg-delete-file'));
		    if (  $file  != "") {
             
			 	cdm_recycle('file',sanitize_text_field(cdm_var('dlg-delete-file')));
			 
            }
			if(cdm_var('cdm_limit')){
			update_option('cdm_admin_listings_limit' , sanitize_text_field(cdm_var('cdm_limit')));
			}
			$limit = get_option('cdm_admin_listings_limit', 15);
			
			if(cdm_var('from') != '' ){
			$search .=	" AND date > '".date("Y-m-d",strtotime( sanitize_text_field(cdm_var('from'))))."' ";
			}
			if(cdm_var('to') != '' ){
			$search .=	" AND date < '".date("Y-m-d",strtotime( sanitize_text_field(cdm_var('to'))))."' ";
			}
            if ($user_id != "") {
                echo '<h2>' . __("User Uploads", "sp-cdm") . '</h2><a name="downloads"></a>';
                $r             = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where uid = $user_id  and parent = 0 and recycle = 0 order by date desc", ARRAY_A);
                $delete_page   = 'user-edit.php?user_id=' . $user_id . '';
               
            } else {
				
                $r = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where  parent = 0 ".$search." and recycle = 0 order by id desc LIMIT ".$limit."", ARRAY_A);
            
                $delete_page   = 'admin.php?page=sp-client-document-manager';
              
            }
			
			if(cdm_var('page') == 'sp-client-document-manager'){
			$html .='<script>
  jQuery(function($) {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<form action="admin.php?page=sp-client-document-manager" method="post">
<table class="wp-list-table widefat fixed posts" cellspacing="0" style="margin:20px 0px">
<tr><td style="width:70px">
<strong>Show</strong> <br><input style="width:50px"type="text" name="cdm_limit" value="'.get_option('cdm_admin_listings_limit', 15).'">  </td><td style="width:170px"><label for="from"><strong>From</strong></label>
<br><input type="text" id="from" name="from" value="'. sanitize_text_field(cdm_var('from')).'"></td><td style="width:170px">
<label for="to"><strong>to</strong></label><br>
<input type="text" id="to" name="to"  value="'.sanitize_text_field(cdm_var('to')).'"></td><td><input style="margin-top:20px;" type="submit" value="Show" name="limit">
</td></tr></table>
</form>';
			}
            if ($r == FALSE) {
                $html .= '<p style="color:red">' . __("No Uploads Exist!", "sp-cdm") . '</p>';
            } else {
                //show uploaded documents
                $html .= '

<script type="text/javascript">



function sp_client_upload_email_vendor(){
	console.log(jQuery("#file-dashboard-page").serializeArray());

	jQuery.post(sp_vars.ajax_url, jQuery("#file-dashboard-page").serializeArray(), function(response){
								jQuery("#updateme").empty();

								jQuery("#updateme").append( response);
						
	})	


    	

	

	return false;

}



</script>

' . $download_user . '';

if(cdm_var('page') == 'sp-client-document-manager'){
$html .='<form id="file-dashboard-page" >';
	}
$html .='<input type="hidden" name="action" value="cdm_email_vendor">'.wp_nonce_field( 'cdm_nonce', 'cdm_nonce', true, false ).'
  <table class="wp-list-table widefat fixed posts" cellspacing="0">

	<thead>

	<tr>

	<th style="width:30px">' . __("ID", "sp-cdm") . '</th>	

<th style="width:80px">' . __("Thumbnail", "sp-cdm") . '</th>	

<th>' . __("File Name", "sp-cdm") . '</th>

<th>' . __("User", "sp-cdm") . '</th>

<th>' . __("Date", "sp-cdm") . '</th>

<th>' . __("Download", "sp-cdm") . '</th>

<th>' . __("Email", "sp-cdm") . '</th>';

$additional_headers = '';
$html .= apply_filters('sp_cdm/admin/file_list/column/header',$additional_headers);

$html .= '</tr>

	</thead>





';
                for ($i = 0; $i < count($r); $i++) {
                   $img = '';
				    if ($r[$i]['name'] == "") {
                        $name = $r[$i]['file'];
                    } else {
                        $name = $r[$i]['name'];
                    }
                    $r_user = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "users where ID = " . $r[$i]['uid'] . "", ARRAY_A);
                    if (get_option('sp_cu_js_redirect') == 1) {
                        $target = 'target="_blank"';
                    } else {
                        $target = ' ';
                    }
                   $ext = substr(strrchr($r[$i]['file'], '.'), 1);
        
        if ($ext == 'png' or $ext == 'jpg' or $ext = 'jpeg' or $ext = 'gif') {
            $icon = '<td width="160"><img src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[$i]['uid'] . '/' . $r[$i]['file'] . '" width="80"></td>';
        } else {
            $icon = '';
        }
        $ext        = preg_replace('/^.*\./', '', $r[$i]['file']);
        $images_arr = array(
            "jpg",
            "png",
            "jpeg",
            "gif",
            "bmp"
        );
      
	  
	  
			if(get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')){
	
			$info = new Imagick();
			$formats = $info->queryFormats();
			
			}else{
				$formats = array();
			}
	  
	  
	  
	    if (in_array(strtolower($ext), $images_arr)) {
            if (get_option('sp_cu_overide_upload_path') != '' && get_option('sp_cu_overide_upload_url') == '') {
                $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/package_labled.png">';
            } else {				
                $img = '<img src="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $r[$i]['uid'] . '/' . $r[$i]['file'] . NULL, 80) . '">';
            }

			
			 } elseif (strtolower($ext) == 'mp3') {
	$img = '<div class="wp-video">
		<!--[if lt IE 9]><script>document.createElement(\'video\');</script><![endif]-->
		<audio %s controls="controls" class="wp-video-shortcode" preload="metadata" style="width:100%">
		<source type="audio/mpeg" src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[$i]['uid'] . '/' . $r[$i]['file'].'" />
		</audio></div>';	
		
			
		 } elseif (strtolower($ext) == 'mp4') {
	$img = '<div style="width:100%" class="wp-video">
		<!--[if lt IE 9]><script>document.createElement(\'video\');</script><![endif]-->
		<video %s controls="controls" class="wp-video-shortcode" preload="metadata" style="width:100%">
		<source type="video/mp4" src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[$i]['uid'] . '/' . $r[$i]['file'].'" />
		</video></div>';	
			
        } elseif ($ext == 'xls' or $ext == 'xlsx') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_excel.png">';
        } elseif ($ext == 'doc' or $ext == 'docx') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_word.png">';
        } elseif ($ext == 'pub' or $ext == 'pubx') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_publisher.png">';
        } elseif ($ext == 'ppt' or $ext == 'pptx') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_powerpoint.png">';
        } elseif ($ext == 'adb' or $ext == 'accdb') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_access.png">';
        } elseif (in_array(strtoupper($ext),$formats)) {
            if (file_exists('' . SP_CDM_UPLOADS_DIR . '' . $r[$i]['uid'] . '/' . $r[$i]['file'] . '_big.png')) {
                $img = '<img src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[$i]['uid'] . '/' . $r[$i]['file'] . '_big.png" width="80">';
            } else {
                $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png">';
            }
        } elseif ($ext == 'pdf' or $ext == 'xod') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png">';
        } else {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/package_labled.png">';
        }
		
		$img = apply_filters('sp_cdm_viewfile_image', $img,$r[$i]);
					
					
					
					
					
                    $html .= '

	

 <tr>

 <td>' . $r[$i]['id'] . '</td>

 <td>' . $img . '</td>

    <td ><strong>' . stripslashes($name) . '</strong>';
                    if (@CU_PREMIUM == 1) {
                        $html .= sp_cdm_get_form_fields($r[$i]['id']);
                    } else {
                        $html .= '<br><em>' . __("Notes: ", "sp-cdm") . ' ' . stripslashes($r[$i]['notes']) . '</em>';
                    }
                    if ($r[$i]['tags'] != "") {
                        $html .= '<br><strong>' . __("Tags ", "sp-cdm") . '</strong><em>: ' . $r[$i]['tags'] . '</em>';
                    }
                    $html .= '

	

	

	</td>

	<td><a href="user-edit.php?user_id=' . $r[$i]['uid'] . '">' . $r_user[0]['display_name'] . '</a></td>

	 <td >' . date('F jS Y h:i A', strtotime($r[$i]['date'])) . '</td>

   

    <td><a style="margin-right:15px" href="javascript:cdmViewFile(' . $r[$i]['id'] . ')" >' . __("View", "sp-cdm") . '</a> <a href="' . $delete_page . '&dlg-delete-file=' . $r[$i]['id'] . '#downloads">' . __("Delete", "sp-cdm") . '</a> </td>

<td><input type="checkbox" name="vendor_email[]" value="' . $r[$i]['id'] . '"></td>';


$additional_header_column = '';
$html .= apply_filters('sp_cdm/admin/file_list/column/header/content',$additional_header_column, $r[$i]);

$html .='	</tr>





  

  ';
                }
                $html .= '</table>

			

				<div style="text-align:right">

			<div id="updateme"></div>

				' . __("Choose  the files you want to send above, type a message and choose a vendor then click submit:", "sp-cdm") . '  <select name="vendor">

				';
                if (cdm_var('submit-vendor')) {
                 
                }
                $vendors = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "options   where option_name  LIKE 'sp_client_upload_vendors%'  order by option_name", ARRAY_A);
                for ($i = 0; $i < count($vendors); $i++) {
                    $vendor_info[$i] = unserialize($vendors[$i]['option_value']);
                    $html .= '<option value="' . $vendor_info[$i]['email'] . '">' . $vendor_info[$i]['name'] . '</option>';
                }
                $html .= '</select> ' . __("Message:", "sp-cdm") . ' <input type="text" name="vendor-message"> <select name="vendor_attach"><option value="1">' . __("Attach to email:", "sp-cdm") . ' </option><option value="0">' . __("Send links to files", "sp-cdm") . ' </option><option value="3">' . __("Attach and link to to files", "sp-cdm") . ' </option></select> <input type="submit" name="submit-vendor" value="' . __("Email vendor files!", "sp-cdm") . '" onclick="sp_client_upload_email_vendor();return false;"> 

				</div>

				';
            }
			if(cdm_var('page') == 'sp-client-document-manager'){
			$html .='</form>';
			}
            if ($user_id != "") {
                echo $html;
            } else {
              
                return $html;
            }
        }
    }
}
add_action('edit_user_profile', 'sp_client_upload_admin');
?>