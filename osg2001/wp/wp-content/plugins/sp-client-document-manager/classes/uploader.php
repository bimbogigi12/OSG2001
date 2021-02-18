<?php

$cdm_uploader = new cdm_uploader;


add_action('sp_cdm_bottom_uploader_page', array(
 $cdm_uploader,
 'upload_dialog'
));
add_action('wp_footer', array(
 $cdm_uploader,
 'view_file_modal'
));
add_action('admin_footer', array(
 $cdm_uploader,
 'view_file_modal'
));


#add_action('admin_footer',  array($cdm_uploader,'admin_upload_dialog'));
class cdm_uploader
{
 
 function __construct()
 {
  
 }
 
 

 
 function links()
 {
  
 }
 function add_folder()
 {
  global $current_user;
  
  
  
  
  $add_project = '<div class="remodal" data-remodal-id="folder" data-remodal-options="{ \'hashTracking\': false }"> <a data-remodal-action="close" class="remodal-close"></a>';
  
  if (cdm_var('page') == 'sp-client-document-manager-fileview') {
   $add_project .= '<input type="hidden" id="sub_category_uid" name="uid" value="' . sanitize_text_field(cdm_var('id')) . '">';
  } else {
   $add_project .= '<input type="hidden" id="sub_category_uid" name="uid" value="' . $current_user->ID . '">';
  }
  if (defined(CU_PREMIUM)) {
   
   $add_project .= '	<input type="hidden" class="cdm_premium_pid_field" name="parent" value="0">';
  }
  $add_project .= '
	
		

		' . sp_cdm_folder_name() . ' ' . __("Name", "sp-cdm") . ' <input  id="sub_category_name" type="text" name="project-name"  style="width:200px !important"> 

		<input type="submit" value="' . __("Add", "sp-cdm") . ' ' . sp_cdm_folder_name() . '" name="add-project" onclick="sp_cu_add_project()">

	

	</div>';
  //$add_project = apply_filters('sp_cdm_add_project_form', $add_project);
  
  return $add_project;
 }
 function above_uploader()
 {
  
  
  do_action('cdm_above_uploader');
  
 }
 function admin_upload_dialog()
 {
  
  
  $mystring = sanitize_text_field(cdm_var('page'));
  $findme   = 'sp-client-document-manager';
  $pos      = strpos($mystring, $findme);
  
  
  if ($pos !== false) {
   
   
   
   $this->upload_dialog();
   
  }
  
 }
 function view_file_modal()
 {
  
  
  $html = '<div style="display:none"><div class="cdm-modal" data-remodal-options="{ \'hashTracking\': false }" data-remodal-id="file"> <a data-remodal-action="close" class="remodal-close"></a>
			<div class="view-file-content">
			
			</div>
		</div></div>
				';
  
  
  echo $html;
  
  
  
 }
 function upload_dialog()
 {
  
  global $post;
  


  echo '<div style="display:none">
				';
  echo cdm_uploader::above_uploader();
  echo cdm_uploader::add_folder();
  
  if (!class_exists('cdmPremiumUploader') or get_option('sp_cu_free_uploader') == 1) {
   echo '<div class="remodal" data-remodal-id="upload" data-remodal-options="{ \'hashTracking\': false }"> <a data-remodal-action="close" class="remodal-close"></a>	';
   
   echo display_sp_upload_form();
   
  
   echo '</div>';
  } else {
   
   do_action('cdm_upload_dialog');
  }
  
  echo '
				
		</div>';
  
  
 

  
  
 }
}