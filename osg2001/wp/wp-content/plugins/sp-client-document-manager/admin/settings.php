<?php
function sp_client_upload_settings()
{
    global $wpdb;
	$content = '';

    if (cdm_var('save_options')) {

	if ( wp_verify_nonce( cdm_var('cdm_nonce_save_settings'), 'cdm_nonce_save_settings' ) == false) {exit('Security Error');}	
		
        foreach ($_POST as $key => $value) {
            update_option($key, $value);
        }
        $sp_cdm_disable_features = cdm_var('sp_cdm_disable_features');
      
	    if (@count($sp_cdm_disable_features) > 0 && is_array($sp_cdm_disable_features)) {
            foreach ($sp_cdm_disable_features as $feature) {
                if (count($feature) > 0) {
                    foreach ($feature as $setting) {
                        if (@$sp_cdm_disable_features[$feature][$setting] == 1) {
                            @$sp_cdm_disable_features[$feature][$setting] = 1;
                        } else {
                            @$sp_cdm_disable_features[$feature][$setting] = 0;
                        }
                    }
                }
            }
			
		#cdm_htaccess_protect_dir(SP_CDM_UPLOADS_DIR ,true)	;
        }
		
		update_option('sp_cu_uploads_page',cdm_var('sp_cu_uploads_page'));
        update_option('sp_cdm_disable_features', $sp_cdm_disable_features);
		
		
		  if (cdm_var('sp_cu_uploads_page_disable_injection') == "1") {
            update_option('sp_cu_uploads_page_disable_injection', '1');
        } else {
            update_option('sp_cu_uploads_page_disable_injection', '0');
        }
		
        if (cdm_var('sp_cu_user_projects') == "1") {
            update_option('sp_cu_user_projects', '1');
        } else {
            update_option('sp_cu_user_projects', '0');
        }
        if (cdm_var('sp_cu_user_projects_required') == "1") {
            update_option('sp_cu_user_projects_required', '1');
        } else {
            update_option('sp_cu_user_projects_required', '0');
        }
        if (cdm_var('sp_cu_js_redirect') == "1") {
            update_option('sp_cu_js_redirect', '1');
        } else {
            update_option('sp_cu_js_redirect', '0');
        }
        if (cdm_var('sp_cu_user_uploads_disable') == "1") {
            update_option('sp_cu_user_uploads_disable', '1');
        } else {
            update_option('sp_cu_user_uploads_disable', '0');
        }
        if (cdm_var('sp_cu_user_delete_disable') == "1") {
            update_option('sp_cu_user_delete_disable', '1');
        } else {
            update_option('sp_cu_user_delete_disable', '0');
        }
        if (cdm_var('sp_cu_hide_project') == "1") {
            update_option('sp_cu_hide_project', '1');
        } else {
            update_option('sp_cu_hide_project', '0');
        }
        if (cdm_var('sp_cu_user_require_login_download') == "1") {
            update_option('sp_cu_user_require_login_download', '1');
        } else {
            update_option('sp_cu_user_require_login_download', '0');
        }
        if (cdm_var('sp_cu_user_projects_modify') == "1") {
            update_option('sp_cu_user_projects_modify', '1');
        } else {
            update_option('sp_cu_user_projects_modify', '0');
        }
        if (cdm_var('sp_cu_user_disable_search') == "1") {
            update_option('sp_cu_user_disable_search', '1');
        } else {
            update_option('sp_cu_user_disable_search', '0');
        }
    }
    if (get_option('sp_cu_user_disable_search') == 1) {
        $sp_cu_user_disable_search = ' checked="checked" ';
    } else {
        $sp_cu_user_disable_search = '  ';
    }
    if (get_option('sp_cu_user_projects_required') == 1) {
        $sp_cu_user_projects_required = ' checked="checked" ';
    } else {
        $sp_cu_user_projects_required = '  ';
    }
    if (get_option('sp_cu_user_projects') == 1) {
        $sp_cu_user_projects = ' checked="checked" ';
    } else {
        $sp_cu_user_projects = '  ';
    }
    if (get_option('sp_cu_js_redirect') == 1) {
        $sp_cu_js_redirect = ' checked="checked" ';
    } else {
        $sp_cu_js_redirect = '  ';
    }
    if (get_option('sp_cu_user_uploads_disable') == 1) {
        $sp_cu_user_uploads_disable = ' checked="checked" ';
    } else {
        $sp_cu_user_uploads_disable = '  ';
    }
    if (get_option('sp_cu_user_delete_disable') == 1) {
        $sp_cu_user_delete_disable = ' checked="checked" ';
    } else {
        $sp_cu_user_delete_disable = '  ';
    }
    if (get_option('sp_cu_hide_project') == 1) {
        $sp_cu_hide_project = ' checked="checked" ';
    } else {
        $sp_cu_hide_project = '  ';
    }
    if (get_option('sp_cu_user_require_login_download') == 1) {
        $sp_cu_user_require_login_download = ' checked="checked" ';
    } else {
        $sp_cu_user_require_login_download = '  ';
    }
    if (get_option('sp_cu_user_projects_modify') == 1) {
        $sp_cu_user_projects_modify = ' checked="checked" ';
    } else {
        $sp_cu_user_projects_modify = '  ';
    }
	if (get_option('sp_cu_uploads_page_disable_injection') == 1) {
        $sp_cu_uploads_page_disable_injection= ' checked="checked" ';
    } else {
        $sp_cu_uploads_page_disable_injection = '  ';
    }
	
	
	 
	
    echo '' . sp_client_upload_nav_menu() . '';
    if (current_user_can('sp_cdm_help')) {
        echo '

<div class="updated">';

        echo '





</div>';
    }
	    wp_enqueue_media();
    echo "<script type=\"text/javascript\">
		 
 jQuery(document).ready(function($){
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
 
	$('.wpfh-metabox-table .button').click(function(e) {
		var container = $(this).parent();
		var preview_image = $(this).next('.preview-image');
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$(\"#\"+id).val(attachment.url);
				$(preview_image).html('<img src=\"'+ attachment.url + '\"  height=\"150\">')
			
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
 
		wp.media.editor.open(button);
		return false;
	});
 
	$('.add_media').on('click', function(){
		_custom_media = false;
	});
});
		</script>";
    echo '

<script type="text/javascript">
jQuery(function($) {
	$(".cdm-admin-settings-tabs").responsiveTabs({
	 startCollapsed: false
	});
});
</script>



<style type="text/css">
strong{font-weight:800}
</style>

	<form action="admin.php?page=sp-client-document-manager-settings&save_options=1" method="post" novalidate>'.wp_nonce_field( 'cdm_nonce_save_settings', 'cdm_nonce_save_settings', true, false ).'
	<div class="cdm-admin-settings-tabs">
  <ul>
    <li><a href="#cdm-tab-settings">' . __('Main Settings', 'sp-cdm') . '</a></li>
    <li><a href="#cdm-tab-mail">' . __('Mail Settings', 'sp-cdm') . '</a></li>
     <li><a href="#cdm-tab-premium">' . __('Premium Settings', 'sp-cdm') . '</a></li>
	 <li><a href="#cdm-tab-advanced">' . __('Advanced Settings', 'sp-cdm') . '</a></li>
	  <li><a href="#cdm-tab-disable-features">' . __('Disable Features', 'sp-cdm') . '</a></li>';
    do_action('sp_cdm_settings_add_tab');
    echo '
  
  </ul>
  <div id="cdm-tab-settings">
 ';
    if (cdm_var('force_upgrades')) {
        echo '

<div class="updated">
Database verified, you should be good to go!</a>
</div>';
    } else {
        echo '

<div class="update-nag">
Having problems? <a href="admin.php?page=sp-client-document-manager-settings&force_upgrade=1&force_upgrades=1">Click here to make sure your database structure is correct</a>
</div>';
    }
    echo '
	 <table class="wp-list-table widefat fixed posts" cellspacing="0">
   <tr>

    <td width="300"><strong>Documents page</strong><br><em>Select a page to be used for your documents, you can also insert the shortcode [sp-client-document-manager] into a page as well.</em></td>

    <td>';
	 $args = array(

    'selected'              => get_option('sp_cu_uploads_page'),
    'echo'                  => 0,
    'name'                  => 'sp_cu_uploads_page',
    
    'show_option_none'      =>'No overide', // string
   
);

$pages_dropdown =  wp_dropdown_pages( $args ); 
	
	
	echo ''.$pages_dropdown.' </td>

  </tr>
   <tr>

    <td width="300"><strong>Disable auto injection of the shortcode?</strong><br><em>If you are outputting the shortcode into your code directly in your template then enable this feature, this stops CDM from injecting the shortcode.</em></td>

    <td><input type="checkbox" name="sp_cu_uploads_page_disable_injection"   value="1" ' . $sp_cu_uploads_page_disable_injection . '> </td>

  </tr>
    <tr>

    <td width="300"><strong>Company Name</strong><br><em>This could be your name or your company name which will go in the "from" area in the vendor email.</em></td>

    <td><input type="text" name="sp_cu_company_name"  value="' . stripslashes(get_option('sp_cu_company_name')) . '"  size=80"> </td>

  </tr>

		 <tr>

    <td width="300"><strong>Filename Format</strong><br><em>Use the below codes to determine the file format, whatever you put in the box will show up before the actual file name.If you keep this blank then you leave the risk to existing files. Please see the example to the right.</em><br><br>
	%n =  File Input Name: yyyy<br> 
	
	%f =  File Name: yyyy<br> 

	%y =  Year: yyyy<br> 

	%d =  Day:  dd<br>

	%m =  Month: mm<br>

	%h =  Hour: 24 hour format<br>

	%min = Minute<br>

	%u = Username<br>

	%uid = User ID<br>

	%t = Timstamp<br>

	%r = Random #<br>

	

	</td>

    <td><input type="text" name="sp_cu_filename_format"  value="' . get_option('sp_cu_filename_format') . '"  size=80"><br><div style="margin:5px;padding:5px;"> Example:<br><br>

	If the user uploads a file called example.pdf and you put<strong>  %y-%m-%d-</strong> the final file name  will be: <strong>' . date("Y") . '-' . date("m") . '-' . date("d") . '-example.pdf</strong></div></td>

  </tr>

      <tr>

    <td width="300"><strong>Thank you message</strong><br><em>This is the thank you text the user sees after they upload.</em></td>

    <td><input type="text" name="sp_cu_thankyou"  value="' . get_option('sp_cu_thankyou') . '"  size=80"> </td>

  </tr>

       <tr>

    <td width="300"><strong>Delete Message</strong><br><em>The confirmation screen asking the user if they want to delete the file.</em></td>

    <td><input type="text" name="sp_cu_delete"  value="' . get_option('sp_cu_delete') . '"  size=80"> </td>

  </tr>



      <tr>

    <td width="300"><strong>Disable User Uploads?</strong><br><em>Check this box to disable user uploads.</em></td>

    <td><input type="checkbox" name="sp_cu_user_uploads_disable"   value="1" ' . $sp_cu_user_uploads_disable . '> </td>

  </tr>

     <tr>

	   <tr>

    <td width="300"><strong>Disable User Deleting?</strong><br><em>Check this box to not allow user to delete file.</em></td>

    <td><input type="checkbox" name="sp_cu_user_delete_disable"   value="1" ' . $sp_cu_user_delete_disable . '> </td>

  </tr>

    
    <tr>

    <td width="300"><strong>Folders Name</strong><br><em>We call folders what they are "Folders", if you want to call them something else specify that here. Please give both the singular and plural word for the replacement.</em></td>

    <td>Singular: <input type="text" name="sp_cu_folder_name_single"   value="' . stripslashes(get_option('sp_cu_folder_name_single')) . '"> Plural:  <input type="text" name="sp_cu_folder_name_plural"   value="' . stripslashes(get_option('sp_cu_folder_name_plural')) . '"></td>

  </tr>
    <tr>

    <td width="300"><strong>Hide project if empty?</strong><br><em>Hide a project if there are no files on it.</em></td>

    <td><input type="checkbox" name="sp_cu_hide_project"   value="1" ' . $sp_cu_hide_project . '> </td>

  </tr>

    <tr>

    <td width="300"><strong>Allow users to create projects?</strong><br><em>If you want to allow the user to create projects check this box.</em></td>

    <td><input type="checkbox" name="sp_cu_user_projects"   value="1" ' . $sp_cu_user_projects . '> </td>

  </tr>
    <tr>

    <td width="300"><strong>Do not allow user to delete or edit projects</strong><br><em>Check this box if you do not want the users to edit or delete projects.</em></td>

    <td><input type="checkbox" name="sp_cu_user_projects_modify"   value="1" ' . $sp_cu_user_projects_modify . '> </td>

  </tr>


    <tr>

    <td width="300"><strong>Form Instructions</strong><br><em>Just a short statement that will go above the upload form, you can use html!</em></td>

    <td><textarea  name="sp_cu_form_instructions"  style="width:100%;height:60px" >' . stripslashes(get_option('sp_cu_form_instructions')) . '</textarea> </td>

  </tr>

   

   

  

  

  ';
    if (class_exists('cdmProductivityGoogle')) {
        echo '   <tr>

    <td width="300"><strong>Google API Key</strong><br><em>This is your google API if you are using the google shortlink addon in the productivity suite, this also may be used for future google services integration.</em></td>

    <td><input type="text" name="sp_cu_google_api_key"  value="' . get_option('sp_cu_google_api_key') . '"  size=80"> </td>

  </tr>';
    }
    echo '

    <tr>

    <td>&nbsp;</td>

    <td><input type="submit" name="save_options" value="Save Options"></td>

  </tr>

</table>

</div>


  <div id="cdm-tab-mail">


<h2>Admin Email</h2>
 <table class="wp-list-table widefat fixed posts" cellspacing="0">

 

   <tr>

    <td width="300"><strong></strong><br><em>If you have additional people that need to get a copy of the admin when a user uploads a file then list them here seperated by a comma. You can also specify a wordpress role that would receive the email, so for instance if you have a custom role called "Customer Service" the email would be sent to everyone in the "Customer Service" Role. Roles should be lower case.</em></td>

    <td><input style="width:100%" type="text" name="sp_cu_additional_admin_emails" value="' . stripslashes(get_option('sp_cu_additional_admin_emails')) . '" ></td>

  </tr>

     <tr>

    <td width="300"><strong>Admin Email</strong><br><em>This is the email that is dispatched to admin.</em><br><br>Template Tags:<br><br>

	

	[file] = Link to File<br>
	
	[file_name] = Actual File Name<br>
	[file_shortlink] = Shortlink URL<br>
	[file_real_path] = Real Path URL to the file<br>
	[file_in_document_area] = Link to the file in document area<br>
	[file_directory] = Link to folder<br>
	[file_directory_shortlink] = Link to folder with shortlink (requires google api key)<br>

	[notes] = Notes or extra fields<br>

	[user] = users name<br>
	
	[uid] = User ID<br>

	[project] = project<br>

	[category] = category<br>

	[user_profile] = Link to user profile<br>

	[client_documents] = Link to the client document manager

	</td>

    <td>Subject: <input style="width:100%" type="text" name="sp_cu_admin_email_subject" value="' . get_option('sp_cu_admin_email_subject') . '"><br>Body:<br>
		';
    echo wp_editor(stripslashes(get_option('sp_cu_admin_email')), 'sp_cu_admin_email');
    echo '
	
 </td>

  </tr>';
    do_action('sp_cu_email_extra', 'sp_cu_admin_email');
    echo '</table>
  
  
  
<h2>User Email</h2>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
      <tr>

    <td width="300"><strong>Additional User Emails</strong><br><em>If you have additional people that need to get a copy of the email when a user uploads a file then list them here seperated by a comma.  You can also specify a wordpress role that would receive the email, so for instance if you have a custom role called "Customer Service" the email would be sent to everyone in the "Customer Service" Role. Roles should be lower case.</em></td>

    <td><input style="width:100%" type="text" name="sp_cu_additional_user_emails" value="' . stripslashes(get_option('sp_cu_additional_user_emails')) . '" ></td>

  </tr>

    <tr>

    <td width="300"><strong>User Email</strong><br><em>This is the email that is dispatched to user.</em><br><br>Template Tags:<br><br>

	

	[file] = Link to File<br>
	[file_name] = Actual File Name<br>
	[file_shortlink] = Shortlink URL<br>
	[file_real_path] = Real Path URL to the file<br>
	[file_in_document_area] = Link to the file in document area<br>
	[file_directory] = Link to folder<br>
	[file_directory_shortlink] = Link to folder with shortlink (requires google api key)<br>
	[notes] = Notes or extra fields<br>

	[user] = users name<br>
	
	[uid] = User ID<br>
	[project] = project<br>

	[category] = category<br>

	[user_profile] = Link to user profile<br>

	[client_documents] = Link to the client document manager</td>

    <td>Subject: <input style="width:100%" type="text" name="sp_cu_user_email_subject" value="' . get_option('sp_cu_user_email_subject') . '"><br>Body:<br>
	';
    echo wp_editor(stripslashes(get_option('sp_cu_user_email')), 'sp_cu_user_email');
    echo ' </td>

  </tr>';
    do_action('sp_cu_email_extra', 'sp_cu_user_email');
    echo '</table>';
    echo '
  
  
  
<h2>Admin Upload to User Email</h2>
<table class="wp-list-table widefat fixed posts" cellspacing="0">



    <tr>

    <td width="300"><strong>Admin to user email</strong><br><em>This email is dispatched when an admin adds a file in the administration area to a user.</em><br><br>Template Tags:<br><br>

	

	[file] = Link to File<br>
	[file_in_document_area] = Link to the file in document area<br>
	[file_shortlink] = Shortlink URL<br>
	[file_directory] = Link to folder<br>
	[file_directory_shortlink] = Link to folder with shortlink (requires google api key)<br>
	[notes] = Notes or extra fields<br>

	[user] = users name<br>

	[project] = project<br>

	[category] = category<br>

	[user_profile] = Link to user profile<br>

	[client_documents] = Link to the client document manager</td>

    <td>Subject: <input style="width:100%" type="text" name="sp_cu_admin_user_email_subject" value="' . get_option('sp_cu_admin_user_email_subject') . '"><br>Body:<br>
		';
    echo wp_editor(stripslashes(get_option('sp_cu_admin_user_email')), 'sp_cu_admin_user_email');
    echo '
	
	 </td>

  </tr>';
    do_action('sp_cu_email_extra', 'sp_cu_admin_user_email');
    echo '

 </table>

<h2>Vendor Email</h2>
<table class="wp-list-table widefat fixed posts" cellspacing="0">



    <tr>

    <td width="300"><strong>Vendor Email</strong><br><em>This email is dispatched when a user sends a file to a vendor.</em><br><br>Template Tags:<br><br>

	

	[file] = Link to File<br>

	[notes] = Notes<br></td>

    <td>Subject: <input style="width:100%" type="text" name="sp_cu_vendor_email_subject" value="' . get_option('sp_cu_vendor_email_subject') . '"><br>
	CC: <input style="width:100%" type="text" name="sp_cu_vendor_email_cc" value="' . get_option('sp_cu_vendor_email_cc') . '"><br>
	Body:<br>
	';
    echo wp_editor(stripslashes(get_option('sp_cu_vendor_email')), 'sp_cu_vendor_email');
    echo '
	
	 </td>

  </tr>';
    echo do_action('sp_cu_email_extra', 'sp_cu_vendor_email');
    echo '

 </table>';
    do_action('sp_cdm_settings_email');
    echo '
 <table class="wp-list-table widefat fixed posts" cellspacing="0">

<tr>

    <td width="300">&nbsp;</td>

    <td><input type="submit" name="save_options" value="Save Email Settings" style="padding:10px;font-size:1.5em"></td>

  </tr>
  </table>
</div>

  <div id="cdm-tab-advanced">





 <table class="wp-list-table widefat fixed posts" cellspacing="0">

 <tr>

    <td width="300"><strong>Alternate Uploads Folder</strong><br><em>If you would to store your uploads in another folder please enter the full path to the uploads with a trailing slash!. Please update the URL as well. Could be absolute or relative, if you fail to update the URL then your files will not be accessible. If you are using a path that is not web accessible then do not bother putting in the path URL. The script will strictly use fread() to serve the file and will not offer up the full URL. This is a complete secure solution so nobody can access your files. Also be sure to enable "Require login to download" if you want to stop remote linking to your files. Also remember thumbnails will not work wh<br><br> 

	This feature will not move your uploads folder, If you need to change your uploads folder and you already have existing files you must move the folder from its default path in /wp-content/uploads/.

	

	</td>';
    if (get_option('sp_cu_overide_upload_path') != "" && !is_dir(get_option('sp_cu_overide_upload_path'))) {
        $does_not_exist = '<span style="color:red">Uploads Directory does not exist, please remove the custom upload path or create the folder!';
    }
    echo '

    <td><span style="width:120px">System Path:</span> <input type="text" name="sp_cu_overide_upload_path"  value="' . stripslashes(get_option('sp_cu_overide_upload_path')) . '"  size=80"><br>

	<em><strong>Example: </strong><br>linux: /home/mysite/public_html/uploads/ <br>windows: C:\websites\mysite\uploads\</em><br><br><br>

	   <span style="width:120px"> Direct URL:</span> <input type="text" name="sp_cu_overide_upload_url"  value="' . stripslashes(get_option('sp_cu_overide_upload_url')) . '"  size=80"><br>

	   	<em><strong>Example:</strong><br> http://mywebsites/uploads/</em>

	   

	    </td>

  </tr> 

 
  

  

    <tr>

    <td width="300"><strong>Require Login to Download?</strong><br><em>Check this option to require the user to login to download a file, this can only be used securely if you are not using the javascript downloads</em></td>

    <td><input type="checkbox" name="sp_cu_user_require_login_download"   value="1" ' . $sp_cu_user_require_login_download . '> </td>

  </tr>
    <tr>

    <td width="300"><strong>Disable Searching?</strong><br><em>Checking this will disable the search box on the front end.</em></td>

    <td><input type="checkbox" name="sp_cu_user_disable_search"   value="1" ' . $sp_cu_user_disable_search . '> </td>

  </tr>
  <tr>

  

    <td width="300"><strong>Javascript Redirect?</strong><br><em>If your on a windows system you need to use javascript redirection as FastCGI does not allow force download files.</em></td>

    <td><input type="checkbox" name="sp_cu_js_redirect"   value="1" ' . $sp_cu_js_redirect . '> </td>

  </tr>

      <tr>

    <td width="300"><strong>Mandatory ' . sp_cdm_folder_name(1) . '?</strong><br><em>If you want to require that a user select a project then check this box.</em></td>

    <td><input type="checkbox" name="sp_cu_user_projects_required"   value="1" ' . $sp_cu_user_projects_required . '> </td>

  </tr>   <tr>

    <td width="300"><strong>WP Folder</strong><br><em>Use this option only if your wp installation is in a sub folder of your url. For instance if your site is www.example.com/blog/ then put /blog/ in the field. This helps find the uploads directory.</em></td>

    <td><input type="text" name="sp_cu_wp_folder"  value="' . stripslashes(get_option('sp_cu_wp_folder')) . '"  size=80"> </td>

  </tr> 
   <tr>

    <td width="300"><strong>Disable Users</strong><br><em><strong>Comma seperate</strong> user IDs for users you do not want to access the document manager. They will receive an error on the document manager page.</em></td>

    <td><input type="text" name="sp_cu_disabled_users"  value="' . stripslashes(get_option('sp_cu_disabled_users')) . '"  size=80"> </td>

  </tr>
 <tr>

    <td width="300"><strong>Disabled Users error</strong><br><em>This is the error for users who cannot view the document manager.</em></td>

    <td>';
	
	 wp_editor(stripslashes(get_option('sp_cu_disabled_users_error')), 'sp_cu_disabled_users_error');
	echo ' </td>

  </tr>';
  
    do_action('sp_cdm_settings_advanced');
  
  echo'

  

 

    <tr>

    <td>&nbsp;</td>

    <td><input type="submit" name="save_options" value="Save Options"></td>

  </tr></table>
  </div>';
    $disable_features = get_option('sp_cdm_disable_features');
    echo '<div id="cdm-tab-disable-features">
  
  

 <table class="wp-list-table widefat fixed posts" cellspacing="0">
<thead>
<tr>
<th  style="width:200px">Feature</th>
<th>Disable</th>
</tr>
</thead>
 <tr>
 <td colspan="2"><h3>Base Features</h3></td>
 </tr>
  <tr>
 <td >Security: Disable direct file access protection</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][disable_security_direct_file]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'disable_security_direct_file') . '></td>
 </tr>
   <tr>
 <td >Security: Disable directory browsing protection</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][disable_security_directory_browsing]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'disable_security_directory_browsing') . '></td>
 </tr>
 <tr>
 <td >Disable Folders</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][disable_folders]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'disable_folders') . '></td>
 </tr>
  <tr>
 <td >Disable Logout Button</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][disable_logout]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'disable_logout') . '></td>
 </tr>
   <tr>
 <td >View file: Event logger</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][event_logger]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'event_logger') . '></td>
 </tr>
 <tr>
 <td >View file: File Name</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_file_name]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_file_name') . '></td>
 </tr>
  <tr>
 <td >View file: File Date and File ID</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_file_date_id]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_file_date_id') . '></td>
 </tr>
   <tr>
    <tr>
 <td >View file: File Size</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_file_size]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_file_size') . '></td>
 </tr>
   <tr>
 <td >View file: File Type</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_file_type]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_file_type') . '></td>
 </tr>
   <tr>
 <td >View file: Folder Name</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_folder_name]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_folder_name') . '></td>
 </tr>
 <tr>
 <td >View file: File Owner</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][view_file_owner]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'view_file_owner') . '></td>
 </tr>
  <tr>
 <td >User Delete: Move file to another user</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][cdm_disable_move]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'cdm_disable_move') . '></td>
 </tr>
 
   <tr>
 <td >User Downloads</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][cdm_disable_delete]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'cdm_disable_delete') . '></td>
 </tr>
    <tr>
 <td >Auto Recycle Bin Deleting</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][cdm_recycle_bin]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'cdm_recycle_bin') . '></td>
 </tr>
 
 ';
    do_action('sp_cdm_disable_features', $disable_features);
    echo '<tr>

    <td >&nbsp;</td>

    <td><input type="submit" name="save_options" value="Save Options"></td>

  </tr></table>
  </div>
  
  ';
    
        echo ' <div id="cdm-tab-premium">  ';
		 if (!class_exists('sp_premium_license')) {
			
		echo '<p class="cdm_error">You do not currently have premium installed. If you would like to upgrade and unlock a ton of features then <a href="https://www.smartypantsplugins.com">click here</a>.<p>';	
			
		 }
        do_action('cdm_premium_settings');
        echo '</div>';
  
	    do_action('sp_cdm_settings_add_tab_content');
   		 do_action('sp_cdm_settings/tab/content');
    echo '</div>





</form>

	

	';
    echo $content;
}
function sp_client_upload_settings_checkbox($disable_features, $plugin, $feature)
{	
    if (is_array($disable_features)) {
        if (@$disable_features[$plugin][$feature] == 1) {
            return 'checked="checked"';
        }
    }
}