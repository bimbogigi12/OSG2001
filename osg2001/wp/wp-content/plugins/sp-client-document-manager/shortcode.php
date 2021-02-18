<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_filter('sp_cdm/mail/headers', 'cdm_community_email_headers',10,5);

function cdm_community_email_headers($headers,$from,$to,$subject,$message){
		
	

		if(!is_array($headers)){
		$headers = array();	
		}
	
		foreach($headers as $key=>$header){
			
			
			if( strpos( $header, 'From:' ) !== false  or  strpos( $header, 'Reply-to:' ) !== false ) {
				
				unset($headers[$key]);
			}
		}
		
		if(is_object($from)){
		$user_info = get_userdata($from->ID);
		
		#$headers[] = "" . __("From:", "sp-cdm") . " <" .  apply_filters('sp_cdm/mail/admin_email',get_option('admin_email')) . ">";
		#$headers[] = "" . __("Reply-to:", "sp-cdm") . "<" . $user_info->user_email . ">";
	
		$headers[] = 'From: '. apply_filters('sp_cdm/mail/admin_email',get_option('admin_email')).'';
		$headers[] = 'Reply-to: '.$user_info->user_email .'';
		
		}else{
		$headers[] = "" . __("From:", "sp-cdm") . " " . apply_filters('sp_cdm/mail/admin_email',get_option('admin_email')) . "";
		$headers[] = "" . __("Reply-to:", "sp-cdm") . " " . $from . "";	
			
		}
		
		
		return $headers;
		
	}


if (!function_exists('sp_cdm_display_project_shortcode_show')) {
    function sp_cdm_display_project_shortcode_show($atts)
    {
        global $wpdb, $current_user, $user_ID;
        $pid       = $atts['project'];
        $date      = $atts['date'];
        $order     = $atts['order'];
        $direction = $atts['direction'];
        $limit     = $atts['limit'];
        if ($order == "") {
            $order = 'name';
        } else {
            $order = $order;
        }
        if ($limit != "") {
            $limit = ' LIMIT ' . $limit . '';
        } else {
            $limit = '';
        }
        if ($pid == '') {
            $content .= '<p style="color:red">No project selected</p>';
        } else {
            $r = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where pid = '" . $pid . "' AND recycle = 0  order by " . esc_attr($order) . " " . esc_attr($direction) . " " . esc_attr($limit) . "", ARRAY_A);
            $content .= '<ul>';
            for ($i = 0; $i < count($r); $i++) {
                if ($date == 1) {
                    $inc_date = '<em style="font-size:10px"> - ' . cdm_datetime($r[$i]['date']) . '</em>';
                } else {
                    $inc_date = '';
                }
                $content .= '<li><a  href="' . admin_url('admin-ajax.php?cdm-download-file-id=' . base64_encode($r[$i]['id'] . '|' . $r[$i]['date'] . '|' . $r[$i]['file']) . '') . '" class="cdm-download-file-link" data-id="' . base64_encode($r[$i]['id'] . '|' . $r[$i]['date'] . '|' . $r[$i]['file']) . '" >' . stripslashes($r[$i]['name']) . '</a> ' . $inc_date . ' </li>';
            }
            $content .= '</ul>';
        }
        return apply_filters('cdm/shortcodes/cdm_project', $content, $atts);
    }
    add_shortcode('cdm-project', 'sp_cdm_display_project_shortcode_show');
    function sp_cdm_file_link_shortcode($atts)
    {
        global $wpdb, $current_user, $user_ID;
        $fid  = $atts['file'];
        $date = $atts['date'];
        $real = $atts['real'];
        if ($fid == '') {
            $content = '<a href="#" style="color:red">No file  selected</a>';
        } else {
            $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where id = %d order by date desc",$fid), ARRAY_A);
            if ($real == 1) {
                return '' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '';
            } else {
                if ($date == 1) {
                    $inc_date = '<em  style="font-size:10px"> - ' . cdm_datetime($r[0]['date']) . '</em>';
                } else {
                    $inc_date = '';
                }
                $content = '<a ' . cdm_download_file_link(base64_encode($r[0]['id'] . '|' . $r[0]['date'] . '|' . $r[0]['file']), get_option('sp_cu_js_redirect')) . ' >' . stripslashes($r[0]['name']) . '</a> ' . $inc_date . ' </a>';
            }
            return $content;
        }
    }
    add_shortcode('cdm-link', 'sp_cdm_file_link_shortcode');
    function display_sp_thumbnails2($r, $overide_uid = false)
    {
        global $wpdb, $current_user, $user_ID;
        $content = '';
        if (get_option('sp_cu_wp_folder') == '') {
            $wp_con_folder = '/';
        } else {
            $wp_con_folder = get_option('sp_cu_wp_folder');
        }
        if ($overide_uid != false) {
            $user_ID = $overide_uid;
        }
        $content .= '

	

	<script type="text/javascript">

	
	function cdm_ajax_search(){

		sp_cdm_loading_image();
	var cdm_search = "";
	cdm_search = jQuery("#search_files").val();
	
	var pid = jQuery.cookie("pid");

	if(! pid){
	var pid = 0;	
	}

				
	
	jQuery.get(sp_vars.ajax_url, {action: "cdm_file_list", uid: "' . $user_ID . '", pid: pid, search: cdm_search}, function(response){
				jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
	})
		
 		  cdm_check_folder_perms(pid);
		  cdm_check_file_perms(pid);
	}

	function sp_cdm_sort(sort,pid){

	if(pid != ""){

		var pidurl = "&pid=" + pid;

	}else{

		var pidurl = "&cid=" + pid;	

	}

		
		jQuery.get(sp_vars.ajax_url, {action: "cdm_file_list", uid: "' . $user_ID . '", sort: sort}, function(response){
				jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
		})
		 cdm_check_folder_perms(pid);
		 cdm_check_file_perms(pid);

}



	

	function sp_cdm_loading_image(){

		jQuery("#cmd_file_thumbs").html(\'<div style="padding:100px; text-align:center" class="sp-cdm-loading"><img src="' . SP_CDM_PLUGIN_URL . 'images/loading.gif"></div>\');		

	}

	function sp_cdm_load_file_manager(){

		sp_cdm_loading_image();


	jQuery.get(sp_vars.ajax_url, {action: "cdm_file_list", uid: "' . $user_ID . '"}, function(response){
				jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
	})
	
	cdm_ajax_search();
	

	}

	

	jQuery(document).ready( function() {

			
var pid = jQuery.cookie("pid");

	if(pid != 0){
	sp_cdm_load_project(pid)
	}else{
	sp_cdm_load_file_manager();	
	}
			

		

		 



			

		});

		

		

		function sp_cdm_load_project(pid){
			 sp_cdm_add_breadcrumb(pid);
			sp_cdm_loading_image();
			
	jQuery("#cdm_current_folder").val(pid);
	
	jQuery(".cdm_premium_pid_field").attr("value", pid);
	jQuery.cookie("pid", pid, { expires: 7 , path:"/" });
	
			if(pid != 0 && jQuery("#cdm_premium_sub_projects").val() != 1){
				jQuery(".cdm_add_folder_button").hide();	
			
				}else{
				jQuery(".cdm_add_folder_button").show();
			
				}
	    cdm_check_folder_perms(pid);
		  cdm_check_file_perms(pid);
		    jQuery("#sub_category_parent").val(pid);
		  jQuery(".cdm_premium_pid_field").val(pid);
		  
		  
		  
		
		jQuery.get(sp_vars.ajax_url, {action: "cdm_file_list", uid: "' . $user_ID . '", pid: pid}, function(response){
						jQuery("#cmd_file_thumbs").html(response).hide().fadeIn();
		})
				

		}

		

		

	

	</script>
';
        $content .= '<form id="cdm_wrapper_form">';
        $extra_js = '';
        $extra_js = apply_filters('sp_cdm_uploader_above', $extra_js);
        $content .= '
	' . $extra_js . '
	
  <input type="hidden" name="cdm_current_folder" id="cdm_current_folder" value="0">
	<div id="cdm_wrapper">

	<div id="cmd_file_thumbs">

	<div style="padding:100px; text-align:center" class="sp-cdm-loading"><img src="' . SP_CDM_PLUGIN_URL . 'images/loading.gif"></div>	

	

	</div>

	<div style="clear:both"></div>

	</div>
</form>
	';
        return $content;
    }
    if (!function_exists('display_sp_upload_form')) {
        function display_sp_upload_form()
        {
            $html = '';
            global $wpdb, $current_user;
            $hidden = '

<script type="text/javascript">





function sp_cdm_change_indicator(){

	



jQuery(".sp_change_indicator_button").hide();

jQuery(".sp_change_indicator").slideDown();







jQuery(\'.sp_change_indicator\').html(\'<img src="' . SP_CDM_PLUGIN_URL . 'images/loading.gif" class="sp-cdm-loading"> ' . __("Please wait, your file is currently uploading", "sp-cdm") . 'Please wait, your file is currently uploading! </em>\');

document.forms["sp_upload_form"].submit();

return true;



}





jQuery(document).ready(function() {

	jQuery("#upload_form").simpleValidate({

	  errorElement: "em",

	  ajaxRequest: false,

	  errorText: "' . __("Required", "sp-cdm") . '",

	   completeCallback: function() {

   

	  sp_cdm_change_indicator();

	  }

	});

});



</script>';
            $hidden .= '
<div style="display:none">';
            $hidden .= '

	

<div id="sp_cu_confirm_delete">

<p>' . get_option('sp_cu_delete') . '</p>

</div>







		



</div>';
            $html .= '



<form  action="' . $_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data" id="upload_form" name="sp_upload_form" >';
            $html .= wp_nonce_field('cdm_upload_file', 'cdm_upload_file_field', true, false);
            $html .= '<div>
			<h2>' . __("Add File", "sp-cdm") . '</h2>
			<p>' . stripslashes(get_option('sp_cu_form_instructions')) . '</p>

			<p>
			

    <input  type="text" name="dlg-upload-name" class="required" placeholder="' . __("File Name", "sp-cdm") . '"></p>

  

  ';
            # $html .= sp_cdm_display_projects();
            if (defined(CU_PREMIUM)) {
                $html .= sp_cdm_display_categories();
            }
            $html .= '

  <div id="cdm_upload_fields">
		
  <input id="file_upload" name="dlg-upload-file[]" type="file" class="required" placeholder="' . __("Upload Files", "sp-cdm") . '">

<div id="upload_list"></div></div>';
             if (defined(CU_PREMIUM)) {
                if (get_option('sp_cu_enable_tags') == 1) {
                    $html .= '

 <p>
			

    <textarea id="tags" name="tags"  style="width:90%;height:30px" placeholder="' . __("Tags", "sp-cdm") . '"></textarea>

  </p>';
                }
                $html .= display_sp_cdm_form();
            } else {
                $html .= '<p>
			
    <textarea style="width:90%;height:50px" name="dlg-upload-notes" placeholder="' . __("Notes", "sp-cdm") . '"></textarea>
	</p>

  ';
            }
            $spcdm_form_upload_fields = '';
            $spcdm_form_upload_fields .= apply_filters('spcdm_form_upload_fields', $spcdm_form_upload_fields);
            $html .= $spcdm_form_upload_fields;
            $html .= '

  

						<div class="sp_change_indicator_button"><input id="dlg-upload"  type="submit" name="sp-cdm-community-upload" value="' . __("Upload", "sp-cdm") . '" ></div>

						<div class="sp_change_indicator" ></div>	
';
            $html .= '

</div>';
            $html .= '



	</form>

	

	

	';
            return $html;
        }
        function check_folder_sp_client_upload()
        {
            global $user_ID;
            $dir = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
            if (!is_dir(SP_CDM_UPLOADS_DIR)) {
                mkdir(SP_CDM_UPLOADS_DIR, 0777);
            }
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
        }
        function sp_cu_process_email($id, $email)
        {
            global $wpdb;
            $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where id = %d  order by date desc", $id), ARRAY_A);
            if ($r[0]['pid'] != "") {
                $r_project = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d",$r[0]['pid']), ARRAY_A);
            }
            if ($r[0]['cid'] != "") {
                $r_cats = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_cats   where id = %d",$r[0]['cid']), ARRAY_A);
            }
            if (@CU_PREMIUM == 1) {
                $notes = stripslashes(sp_cdm_get_form_fields($r[0]['id']));
            } else {
                $notes = stripslashes($r[0]['notes']);
            }
            $user_info = get_userdata($r[0]['uid']);
            $message   = nl2br($email);
            $message   = apply_filters('sp_cdm_shortcode_email_before', $message, $r, $r_project, $r_cats);
            $message   = str_replace('[file]', '<a ' . cdm_download_file_link(base64_encode($r[0]['id'] . '|' . $r[0]['date'] . '|' . $r[0]['file']), get_option('sp_cu_js_redirect')) . '>' . $r[0]['file'] . '</a>', $message);
            $message   = str_replace('[file_directory]', sp_cdm_folder_link($r[0]['pid']), $message);
            $message   = str_replace('[file_directory_shortlink]', sp_cdm_short_url(sp_cdm_folder_link($r[0]['pid'])), $message);
            $message   = str_replace('[file_name]', $r[0]['file'], $message);
            $message   = str_replace('[file_real_path]', '' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '', $message);
            $message   = str_replace('[file_in_document_area]', '<a href="' . sp_cdm_short_url(sp_cdm_file_link($id)) . '">' . __("View File", "sp-cdm") . '</a>', $message);
            $message   = str_replace('[file_in_document_area_raw]', sp_cdm_short_url(sp_cdm_file_link($id)), $message);
            $message   = str_replace('[file_shortlink]', '<a ' . cdm_download_file_link(base64_encode($r[0]['id'] . '|' . $r[0]['date'] . '|' . $r[0]['file']), get_option('sp_cu_js_redirect')) . '>' . $r[0]['file'] . '</a>', $message);
            $message   = str_replace('[notes]', $notes, $message);
            $message   = str_replace('[user]', $user_info->display_name, $message);
            $message   = str_replace('[uid]', $user_info->ID, $message);
            $message   = str_replace('[project]', stripslashes($r_project[0]['name']), $message);
            $message   = str_replace('[category]', stripslashes($r_cats[0]['name']), $message);
            $message   = str_replace('[user_profile]', '<a href="' . admin_url('user-edit.php?user_id=' . $r[0]['uid'] . '') . '">' . admin_url('user-edit.php?user_id=' . $r[0]['uid'] . '') . '</a>', $message);
            $message   = str_replace('[client_documents]', '<a href="' . admin_url('admin.php?page=sp-client-document-manager') . '">' . admin_url('admin.php?page=sp-client-document-manager') . '</a>', $message);
            $message   = apply_filters('sp_cdm_shortcode_email_after', $message, $r, $r_project, $r_cats);
            return $message;
        }
        function sp_cdm_check_file_type($file)
        {
            $valid     = true;
            $info      = new SplFileInfo($file);
            $bad_files = array(
                'php',
                'phps',
                'php3',
                'php4',
                'php5',
                'php6',
                'php7',
                '.htaccess',
                'asp',
                'aspx',
                'vb',
                'pl',
                'phtml'
            );
            if (in_array($info->getExtension(), $bad_files)) {
                $valid = false;
            }
            return $valid;
        }
        function cdm_upload_file($files, $key, $uid)
        {
            global $wpdb;
            global $current_user;
            $name        = $files['dlg-upload-file']['name'][$key];
            # $wp_filetype = wp_check_filetype( $name );
            #  if ( ! $wp_filetype['ext'] && ! current_user_can( 'unfiltered_upload' ) ){
            #return  'upload_error';
            #}
            $dir         = '' . SP_CDM_UPLOADS_DIR . '' . $uid . '/';
            #$filename = ''.sp_client_upload_filename($uid) .''.$files['dlg-upload-file']['name'][$key].'';
            $filename    = apply_filters('sp_cdm/premium/upload/file_name', $files['dlg-upload-file']['name'][$key], $uid);
            $filename    = strtolower($filename);
            $filename    = sanitize_file_name($filename);
            $filename    = remove_accents($filename);
            $filename    = apply_filters('sp_cdm/premium/upload/file_rename', $filename, $uid);
            $target_path = $dir . $filename;
            move_uploaded_file($files['dlg-upload-file']['tmp_name'][$key], $target_path);
            $ext = preg_replace('/^.*\./', '', $filename);
            if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick')) {
                $info    = new Imagick();
                $formats = $info->queryFormats();
                if (in_array(strtoupper($ext), $formats)) {
                    cdm_thumbPdf($target_path);
                }
            }
            $fileinfo['filename'] = $name;
            $fileinfo['filepath'] = $filename;
            return $fileinfo;
        }
		
	
        function display_sp_client_upload_process()
        {
            global $wpdb;
            global $user_ID;
            global $current_user;
			global $post;
           
		   
		    if (cdm_var('page') == 'sp-client-document-manager-fileview' && cdm_var('id') != '') {
                $user_ID = sanitize_text_field(cdm_var('id'));
            }
            if (cdm_var('dlg-delete-file') != "") {
					cdm_recycle('file',sanitize_text_field(cdm_var('dlg-delete-file')));
			
            }
            if (cdm_var('sp-cdm-community-upload') != "" || cdm_var('cdm_upload_file_field')) {
             
                $data  = $_POST;
                $files = $_FILES;
                check_folder_sp_client_upload();
                foreach ($files['dlg-upload-file']['tmp_name'] as $key => $file) {
                    if ($file == '') {
                        unset($files['dlg-upload-file']['tmp_name'][$key]);
                        unset($files['dlg-upload-file']['name'][$key]);
                        unset($files['dlg-upload-file']['type'][$key]);
                        unset($files['dlg-upload-file']['error'][$key]);
                        unset($files['dlg-upload-file']['size'][$key]);
                    }
                }
                foreach ($files['dlg-upload-file']['tmp_name'] as $key => $file) {
                    $type = sp_cdm_check_file_type($files['dlg-upload-file']['name'][$key]);
                    if ($type == false) {
                        unset($files['dlg-upload-file']['tmp_name'][$key]);
                        unset($files['dlg-upload-file']['name'][$key]);
                        unset($files['dlg-upload-file']['type'][$key]);
                        unset($files['dlg-upload-file']['error'][$key]);
                        unset($files['dlg-upload-file']['size'][$key]);
                    }
                }
                $files['dlg-upload-file']['tmp_name'] = array_values($files['dlg-upload-file']['tmp_name']);
                $files['dlg-upload-file']['type']     = array_values($files['dlg-upload-file']['type']);
                $files['dlg-upload-file']['error']    = array_values($files['dlg-upload-file']['error']);
                $files['dlg-upload-file']['size']     = array_values($files['dlg-upload-file']['size']);
                $files['dlg-upload-file']['name']     = array_values($files['dlg-upload-file']['name']);
                if (count($files['dlg-upload-file']['name']) > 0) {
                    if ($error != '') {
                        $html .= $error;
                    } else {
                        foreach ($files['dlg-upload-file']['name'] as $key => $value) {
                            $upload = cdm_upload_file($files, $key, $user_ID);
                            if ($data['dlg-upload-name'] == '') {
                                $a['name'] = $upload['filename'];
                            } else {
                                $a['name'] = $data['dlg-upload-name'];
                            }
                            $a['file']  = $upload['filepath'];
                            $a['date']  = date("Y-m-d G:i:s", current_time('timestamp'));
                            $a['uid']   = $user_ID;
                            $a['pid']   = cdm_cookie('pid');
                            $a['cid']   = $data['cid'];
                            $a['tags']  = $data['tags'];
                            $a['notes'] = $data['dlg-upload-notes'];
                           		$dir = '' . SP_CDM_UPLOADS_DIR . '' . $user_ID . '/';
             				 $a['file_size'] = filesize($dir.$upload['filepath']) ;
						   
						    foreach ($a as $key => $value) {
                                if (is_null($value)) {
                                    unset($a[$key]);
                                }
                            }
                            $insert = $wpdb->insert("" . $wpdb->prefix . "sp_cu", $a);
                            unset($a);
                            $file_id = $wpdb->insert_id;
                        }
                        add_user_meta($user_ID, 'last_project', $a['pid'], true);
                        if (@CU_PREMIUM == 1) {
                            process_sp_cdm_form_vars($data['custom_forms'], $file_id);
                        }
                        $user_info = get_userdata($user_ID);
                        if (cdm_var('page') == 'sp-client-document-manager-fileview') {
                            $to            = $user_info->user_email;
                            $email_subject = 'sp_cu_admin_user_email_subject';
                            $email_body    = 'sp_cu_admin_user_email';
                            $email_cc      = 'sp_cu_additional_admin_cc';
                            $user_email    = false;
                        } else {
                            $to            = apply_filters('sp_cdm/mail/admin_email', get_option('admin_email'));
                            $email_subject = 'sp_cu_admin_email_subject';
                            $email_body    = 'sp_cu_admin_email';
                            $email_cc      = 'sp_cu_additional_admin_emails';
                            $user_email    = true;
                        }
                        #send admin email
                        if (get_option($email_body) != "") {
                            $headers[] = "" . __("From:", "sp-cdm") . " " . $current_user->user_firstname . " " . $current_user->user_lastname . " <" . $current_user->user_email . ">\r\n";
                            if (get_option($email_cc) != "") {
                                $cc_admin = explode(",", get_option($email_cc));
                                foreach ($cc_admin as $key => $email) {
                                    if ($email != "") {
                                        $pos = strpos($email, '@');
                                        if ($pos === false) {
                                            $role_emails = sp_cdm_find_users_by_role($email);
                                            foreach ($role_emails as $keys => $role_email) {
                                                $headers[] = 'Cc: ' . $role_email . '';
                                            }
                                        } else {
                                            $headers[] = 'Cc: ' . $email . '';
                                        }
                                    }
                                }
                            }
                            $message = sp_cu_process_email($file_id, stripslashes(get_option($email_body)));
                            $subject = sp_cu_process_email($file_id, stripslashes(get_option($email_subject)));
                            add_filter('wp_mail_content_type', 'set_html_content_type');
                            wp_mail($to, $subject, $message, apply_filters('sp_cdm/mail/headers', $headers, wp_get_current_user(), $to, $subject, $message), $attachments);
                            remove_filter('wp_mail_content_type', 'set_html_content_type');
                            unset($headers);
                            unset($pos);
                        }
                        if (get_option('sp_cu_user_email') != "" && $user_email == true) {
                            $subject = sp_cu_process_email($file_id, stripslashes(get_option('sp_cu_user_email_subject')));
                            $message = sp_cu_process_email($file_id, stripslashes(get_option('sp_cu_user_email')));
                            
							$user_info = get_userdata($user_ID);
							$to      = $user_info->user_email;
                            if (get_option('sp_cu_additional_user_emails') != "") {
                                $cc_user = explode(",", get_option('sp_cu_additional_user_emails'));
                                foreach ($cc_user as $key => $user_email) {
                                    if ($user_email != "") {
                                        $pos = strpos($user_email, '@');
                                        if ($pos === false) {
                                            $role_user_emails = sp_cdm_find_users_by_role($user_email);
                                            foreach ($role_user_emails as $keys => $role_user_email) {
                                                $user_headers[] = 'Cc: ' . $role_user_email . '';
                                            }
                                        } else {
                                            $user_headers[] = 'Cc: ' . $user_email . '';
                                        }
                                    }
                                }
                            }
                            $message      = apply_filters('spcdm_user_email_message', $message, $post, $uid);
                            $to           = apply_filters('spcdm_user_email_to', $to, $post, $uid);
                            $subject      = apply_filters('spcdm_user_email_subject', $subject, $post, $uid);
                            $attachments  = apply_filters('spcdm_user_email_attachments', $attachments, $post, $uid);
                            $user_headers = apply_filters('spcdm_user_email_headers', $user_headers, $post, $uid);
                            add_filter('wp_mail_content_type', 'set_html_content_type');
                            wp_mail($to, $subject, $message, apply_filters('sp_cdm/mail/headers', $user_headers, apply_filters('sp_cdm/mail/admin_email', get_option('admin_email')), $to, $subject, $message), $attachments);
                            remove_filter('wp_mail_content_type', 'set_html_content_type');
                        }
						
						update_user_meta($current_user->ID,'_cdm_show_thankyou',1);
                       	wp_redirect(get_permalink($post->ID));
						#exit;
                    }
                } else {
                    #$html .= '<p style="color:red">' . __("Please upload a file!", "sp-cdm") . '</p>';
                }
            }
            $html = '<div style="display:none">
<div class="remodal" data-remodal-id="cdm-utility" data-remodal-options="{ \'hashTracking\': false }" >
	<a data-remodal-action="close" class="remodal-close"></a>
	
	<div class="cdm-utility-modal">
	</div>
</div>
</div>';
          #  echo $html;
        }
		
		function cdm_display_thankyou(){
			
		global $current_user;
		if(get_user_meta($current_user->ID,'_cdm_show_thankyou',true) == 1){
			
		echo '
		
		
<div id="sp_cu_thankyou">

<p>' . get_option('sp_cu_thankyou') . '</p>

</div>

		<script type="text/javascript">





jQuery(document).ready(function() {

 sp_cu_dialog("#sp_cu_thankyou",400,200);

});

</script>


';
update_user_meta($current_user->ID,'_cdm_show_thankyou',0);

		}
		}
		add_action('admin_footer','cdm_display_thankyou');
		add_action('wp_footer','cdm_display_thankyou');
        function display_sp_client_upload($atts)
        {
            global $wpdb;
            global $user_ID;
            global $current_user;
			
			$atts = shortcode_atts( array(
		'uid' => '',
	
	), $atts, 'sp-client-document-manager' );
			
			
            if (@$atts['uid'] != '') {
                $overide_uid = $atts['uid'];
            } else {
                $overide_uid = false;
            }
            $html = '';
            wp_get_current_user();
            if (is_user_logged_in()) {
                $disabled_users        = array();
                $disabled_users_string = get_option('sp_cu_disabled_users');
                if ($disabled_users_string != '') {
                    $disabled_users = explode(",", $disabled_users_string);
                }
                if (in_array($current_user->ID, $disabled_users)) {
                    $html .= '<div style="padding:10px">';
                    $html .= stripslashes(get_option('sp_cu_disabled_users_error'));
                    $html .= '</div>';
                } else {
                    $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where uid = %d  order by date desc",$user_ID), ARRAY_A);
                    //show uploaded documents
                    $html .= '





 

';
                    if (get_option('sp_cu_user_disable_search') == 1) {
                        $hide_search = ';display:none;';
                    }
                    $html = apply_filters('sp_cdm_above_nav_buttons', $html);
                    $html .= '<div class="cdm_nav_buttons"  id="cdm_nav_buttons">';
                    if (cdm_user_can_add($current_user->ID) == true) {
                        if (class_exists('cdmPremiumUploader') && get_option('sp_cu_free_uploader') != 1) {
                            global $premium_add_file_link;
                            $link = $premium_add_file_link;
                        } else {
                            $link = '#';
                        }
                        $html .= '  <a href="' . $link . '"  class="sp_cdm_open_modal sp_cdm_add_file hide_add_file_permission" data-modal="upload"><i class="fa fa-plus-circle" aria-hidden="true"></i> ' . __("Add File", "sp-cdm") . '</a> ';
                        $addbuttons = '';
                        $addbuttons = apply_filters('sp_cdm_add_buttons', $addbuttons);
                        $html .= $addbuttons;
                        if ((get_option('sp_cu_user_projects') == 1 or current_user_can('manage_options')) && sp_cdm_is_featured_disabled('base', 'disable_folders') == false) {
                            $html .= '  <a href="#" data-modal="folder" class="sp_cdm_open_modal hide_add_folder_permission"><i class="fa fa-folder" aria-hidden="true"></i> ' . __(sprintf("Add %s",sp_cdm_folder_name()), "sp-cdm") . '</a>  ';
                        }
                        $morebuttons = '';
                        $morebuttons .= apply_filters('sp_cdm_more_buttons', $morebuttons);
                        $html .= $morebuttons;
                        $html .= '   <a href="javascript:cdm_ajax_search()"  class="sp_cdm_refresh"><i class="fa fa-refresh" aria-hidden="true"></i> ' . __("Refresh", "sp-cdm") . '</a> ';
                    }
                    if (sp_cdm_is_featured_disabled('base', 'disable_logout') == false) {
                        $html .= '   <a href="' . cdm_logout_url() . '"  class="sp_cdm_logout" ><i class="fa fa-sign-out" aria-hidden="true"></i> ' . __("Logout", "sp-cdm") . '</a> ';
                    }
                    $html .= '<div style="clear:both"></div>';
                    $html .= '</div>';
                    if (get_option('sp_cu_user_disable_search') == 1) {
                        $hide_search = ';display:none;';
                    } else {
                        $hide_search = '';
                    }
                    $html .= apply_filters('sp_cdm/search_form', '<div style="text-align:right;padding:10px' . $hide_search . '"><input   type="text" name="search" id="search_files"><a href="#" class="sp-cdm-search-button ">' . __("Search", "sp-cdm") . '</a></div>');
                    $html .= '<div class="sp-cdm-below-search-nav cdm_nav_buttons">';
                    $html = apply_filters('sp_cu_below_search_nav', $html);
                    $html .= '<div style="clear:both"></div></div>';
                    if (get_option('sp_cu_user_projects_thumbs') == 1 && @CU_PREMIUM == 1) {
                        $upload_view = display_sp_cdm_thumbnails($r, $overide_uid);
                    } else {
                        $upload_view = display_sp_thumbnails2($r, $overide_uid);
                    }
                    $html .= apply_filters('sp_cdm_upload_view', $upload_view, $overide_uid);
                   $html = apply_filters('sp_cdm_upload_bottom', $html);
                          
						
                }
            } else {
                return '<script type="text/javascript">

<!--

window.location = "' . wp_login_url($_SERVER['REQUEST_URI']) . '"

//-->

</script>';
            }
			
			
            return $html;
        }
    }
    function sp_cu_add_file_link_free()
    {
        $add_file_link = 'javascript:sp_cu_dialog(\'#cp_cdm_upload_form\',700,600)';
    }
	
	
	function sp_cu_add_cdm_to_selected_page($content){
		global $post;
		if(get_option('sp_cu_uploads_page') != ''){
				
				if(get_option('sp_cu_uploads_page') == $post->ID && get_option('sp_cu_uploads_page_disable_injection') != 1){
				$content = do_shortcode('[sp-client-document-manager]');	
				}
				
		}
		return $content;
	}
	
	
	function sp_cdm_bottom_uploader_page(){
	global $post;
	
	$used = false;	 
	
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
  'sp-client-document-manager-advanced-groups'
 );
 
 if (is_admin()) {
  
  if (in_array($page,$admin_pages)) {
   $used = true;
  
   
  }
 }else{
	
	
	
	
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
 
 
	 if( $used == true){
		 
		 do_action('sp_cdm_bottom_uploader_page');
	 }
		
	}
	
	
	add_filter('the_content','sp_cu_add_cdm_to_selected_page',99);
    add_action('sp_cu_add_file_link', 'sp_cu_add_file_link_free', 5);
    add_shortcode('sp-client-media-manager', 'display_sp_client_upload');
    add_shortcode('sp-client-document-manager', 'display_sp_client_upload');
    add_action('wp', 'display_sp_client_upload_process');
    add_action('admin_init', 'display_sp_client_upload_process');

	add_action('wp_footer', 'sp_cdm_bottom_uploader_page');
    add_action('admin_footer', 'sp_cdm_bottom_uploader_page');

}
?>