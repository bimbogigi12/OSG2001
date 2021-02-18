<?php

remove_filter('sp_cdm_above_nav_buttons', 'cdm_responsive_button');
add_filter('sp_cdm_above_nav_buttons', 'cdm_community_responsive_button');

function cdm_community_responsive_button($html)
  {
    
    
    $html .= '
<script type="text/javascript">


	
		jQuery(document).ready(function() {

		jQuery(".cdm_responsive_button a").on("click",function(){
			
			if ( jQuery( ".cdm_responsive_button a" ).is( ".dropdown-button" ) ) {
			
			jQuery("#cdm_nav_buttons").addClass("open-cdm-nav");
			jQuery(".cdm_responsive_button a").addClass("dropdown-button-open");
			jQuery(".cdm_responsive_button a").removeClass("dropdown-button");
			}else{
			
			jQuery("#cdm_nav_buttons").removeClass("open-cdm-nav");
			jQuery(".cdm_responsive_button a").addClass("dropdown-button");			
			jQuery(".cdm_responsive_button a").removeClass("dropdown-button-open");
				
			}
	
				return false;
		});
			
			
			jQuery(document).bind("click", function(e) {
				  if(!jQuery(e.target).is(".dropdown-button-open") && !jQuery(e.target).is("#search_files") &&  !jQuery(e.target).is(".open-cdm-nav") ) {
							
			jQuery("#cdm_nav_buttons").removeClass("open-cdm-nav");
			jQuery(".cdm_responsive_button a").addClass("dropdown-button");			
			jQuery(".cdm_responsive_button a").removeClass("dropdown-button-open");
				  }
				});
	
			
		});
		
		
		</script>

	<span class="cdm_responsive_button"><a href="#" class="dropdown-button" ><span class="dashicons dashicons-menu"></span> Menu</a></span>';
    
    
    return $html;
  }


class cdm_community_file_list
  {
    
    
    
    
    function __construct()
      {
        
        add_action('spcdm/community/file_list/above', array(
            $this,
            'edit_folder_navigation'
        ));
        add_action('sp_cdm/community/file_list/image', array(
            $this,
            'file_list_image'
        ), 10, 2);
        
        
        
      }
    
    
    
    function edit_folder_navigation()
      {
        global $wpdb, $current_user;
        $user_permissions = cdm_file_permissions(cdm_var('pid'));
        if ((cdm_var('pid') != "0" && cdm_var('pid') != '') && ((get_option('sp_cu_user_projects') == 1 && get_option('sp_cu_user_projects_modify') != 1) or current_user_can('manage_options') or $user_permissions == 1))
          {
            
            if (get_option('sp_cu_project_ordering_method', 'Name') == 'Name')
              {
                $project_listing_type = 'name';
              }
            else
              {
                $project_listing_type = 'default_order';
              }
            
            $r_project_info = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sp_cu_project where id = " . cdm_var('pid') . "  ORDER by " . $project_listing_type . "", ARRAY_A);
            
            if (get_option('sp_cu_user_delete_folders') != 1)
              {
                echo '<div  class="sp-cdm-folder-navigation"><div  class="sp-cdm-folder-navigation-buttons">';
                
                if ($user_permissions == 1 && get_option('sp_cu_user_projects_modify') != 1)
                  {
                    echo '<a href="javascript:sp_cu_dialog(\'#edit_category_' . sanitize_text_field(cdm_var('pid')) . '\',550,130)"><img src="' . SP_CDM_PLUGIN_URL . 'images/application_edit.png"> ' .__(sprintf("Edit %s Name",sp_cdm_folder_name()), "sp-cdm"). '</a>';
                  }
                
                if (cdm_delete_permission(cdm_var('pid')) == 1 && get_option('sp_cu_user_projects_modify') != 1)
                  {
                    echo '<a href="#" class="sp-cdm-delete-category" data-id="' . sanitize_text_field(cdm_var('pid')) . '" style="margin-left:20px"> <img src="' . SP_CDM_PLUGIN_URL . 'images/delete_small.png">  ' .__(sprintf("Remove %s",sp_cdm_folder_name()), "sp-cdm") . ' </a>';
                  }
                
                
                
                
                do_action('cdm/ajax/folder/navigation', cdm_var('pid'));
                
                
                echo '<div style="clear:both"></div></div><div style="display:none">	

		

		

		
		<div id="delete_category_' . cdm_var('pid') . '" title="' .__(sprintf("Remove %s?",sp_cdm_folder_name()), "sp-cdm"). '">

	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' .__(sprintf("Are you sure you would like to delete this %s? Doing so will remove all files related to this %s.",sp_cdm_folder_name(),sp_cdm_folder_name()), "sp-cdm")  . '</p>

		</div>



		

		

				<div id="edit_category_' . cdm_var('pid') . '">			

			

			<input type="hidden"  name="edit_project_id" id="edit_project_id_' . cdm_var('pid') . '" value="' . cdm_var('pid') . '">		

			' . sp_cdm_folder_name() . ' ' . __("Name", "sp-cdm") . ': <input value="' . stripslashes($r_project_info[0]['name']) . '" id="edit_project_name_' . cdm_var('pid') . '" type="text" name="name"  style="width:200px !important"> 

			<input type="submit" value="' . __("Save", "sp-cdm") . ' ' . sp_cdm_folder_name() . '"  class="sp-cdm-save-category" data-id="' . sanitize_text_field(cdm_var('pid')) . '" >

			

			</div>

			

		

		
<div style="clear:both"></div>
		</div>

		

		


		

		';
              }
          }
        
      }
    function file_list_image($file, $width)
      {
        global $wpdb, $current_user;
        $ext        = preg_replace('/^.*\./', '', $file['file']);
        $images_arr = array(
            "jpg",
            "png",
            "jpeg",
            "gif",
            "bmp"
        );
        
        if (get_option('sp_cu_user_projects_thumbs_pdf') == 1 && class_exists('imagick'))
          {
            
            $info    = new Imagick();
            $formats = $info->queryFormats();
            
          }
        else
          {
            $formats = array();
          }
        
        
        if (in_array(strtolower($ext), $images_arr))
          {
            if (get_option('sp_cu_overide_upload_path') != '' && get_option('sp_cu_overide_upload_url') == '')
              {
                $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/package_labled.png" width="' . $width . '">';
              }
            else
              {
                $img = '<img src="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $file['uid'] . '/' . $file['file'] . '', NULL, 70) . '"  rel="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $file['uid'] . '/' . $file['file'] . '', 250) . '" width="' . $width . '" class="cdm-hover-thumb">';
                
              }
            
            
            
          }
        elseif (in_array($ext, array(
          
		    'mp4',
            'ogg',
            'webm',
            'avi',
            'mpg',
            'mpeg',
            'mkv'
        )))
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/video.png" width="' . $width . '">';
          }
		   elseif ($ext == 'mp3' or $ext == 'wav')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/audio.png" width="' . $width . '">';
          } 
		  
        elseif ($ext == 'xls' or $ext == 'xlsx')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_excel.png" width="' . $width . '">';
          }
        elseif ($ext == 'doc' or $ext == 'docx')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_word.png" width="' . $width . '">';
          }
        elseif ($ext == 'pub' or $ext == 'pubx')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_publisher.png" width="' . $width . '">';
          }
        elseif ($ext == 'ppt' or $ext == 'pptx')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_powerpoint.png" width="' . $width . '">';
          }
        elseif ($ext == 'adb' or $ext == 'accdb')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/microsoft_office_access.png" width="' . $width . '">';
          }
        elseif (in_array(strtoupper($ext), $formats))
          {
            if (file_exists('' . SP_CDM_UPLOADS_DIR . '' . $file['uid'] . '/' . $file['file'] . '_small.png'))
              {
                $img = '<img src="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $file['uid'] . '/' . $file['file'] . '_small.png', NULL, 70) . '" width="' . $width . '" rel="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $file['uid'] . '/' . $file['file'] . '', 250) . '" class="cdm-hover-thumb">';
                
              }
            else
              {
                $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png" width="' . $width . '">';
              }
          }
        elseif ($ext == 'pdf' or $ext == 'xod')
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png" width="' . $width . '">';
          }
        else
          {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/package_labled.png" width="' . $width . '">';
          }
        
        echo apply_filters('sp_cdm_viewfile_image', $img, $file);
        
      }
    function view()
      {
        
        
        
        global $wpdb, $current_user,$spcdm_ajax ;
        if (!is_user_logged_in())
            exit;
        #	ini_set('display_errors', 1);
        #ini_set('display_startup_errors', 1);
        #error_reporting(E_ALL);
        
		
		
		
        global $data;
        $data = array();
        $search_project  = '';
        $search_file= '';
        $r_projects_groups_addon_search= '';
       
	 	  $pid = intval(cdm_var('pid'));
	   	  $uid = intval(cdm_var('uid'));
	
	   
	   
	    if (get_option('sp_cu_project_ordering_method', 'Name') == 'Name')
          {
            $project_listing_type = 'project_name';
          }
        else
          {
            $project_listing_type = 'default_order';
          }
        
        
        $output = array();
        parse_str(cdm_var('seach_form'), $output);
        
        
        if (cdm_var('order',$output)== 'name')
          {
            $project_listing_type = 'project_name';
          }
        
        
        if ($pid == '' or $pid == 'undefined')
          {
            $data['pid'] = 0;
            
          }
        else
          {
            $data['pid'] = $pid;
          }
        $data['uid']     = $uid;
        $data['user_id'] = $current_user->ID;
        
        
        $back_image           = '' . SP_CDM_PLUGIN_URL . 'images/my_projects_folder.png';
        $data['back_image']   = apply_filters('spcdm/files/images/back_button', $back_image);
        $folder_image         = '' . SP_CDM_PLUGIN_URL . 'images/my_projects_folder.png';
        $data['folder_image'] = apply_filters('spcdm/files/images/folder_button', $folder_image);
        
        
        
        
        if ($pid != 0)
          {
            
            
            if (cdm_var('search') != "")
              {
                $search_project = " WHERE " . $wpdb->prefix . "sp_cu_project.name LIKE '%" . cdm_var('search') . "%' ";
              }else{
				  
				$search_project = " WHERE  parent = '" . $pid . "' ";  
			  }
			  
			  
			  $query = "SELECT 
				  
												" . $wpdb->prefix . "sp_cu_project.id,

												" . $wpdb->prefix . "sp_cu_project.id AS pid,

												" . $wpdb->prefix . "sp_cu_project.uid,

												 " . $wpdb->prefix . "sp_cu_project.name AS project_name,
												 	 " . $wpdb->prefix . "sp_cu_project.default_order,

												  " . $wpdb->prefix . "sp_cu_project.parent
												  

									 FROM " . $wpdb->prefix . "sp_cu_project

									".$search_project ."
									AND recycle = 0 
									
									ORDER by " . $project_listing_type . "	
									 ";
									 
								
            $r_projects = $wpdb->get_results($query, ARRAY_A);
   
            $data['current_user_projects'] = sp_cdm_get_user_sub_projects($pid, $uid);
            
            
          }
        else
          {
            
            
            
            
            if (function_exists('cdmFindGroups'))
              {
                $find_groups = cdmFindGroups($uid, 1);
                
              }
            
            
            
            
            
            
            
            
            
            
            $data['current_user_projects'] = sp_cdm_get_user_projects($uid);
         
            if ($data['pid'] != 0)
              {
                
                $data['current_user_projects'][] = $pid;
              }
            
            if (cdm_var('search') != "")
              {
                $search_project .= " AND " . $wpdb->prefix . "sp_cu_project.name LIKE '%" . cdm_var('search') . "%' ";
              }
            else
              {
                if ($pid == '' or $pid == 'undefined')
                  {
                    $search_project .= " AND " . $wpdb->prefix . "sp_cu_project.parent = '0' ";
                  }
                else
                  {
                    $search_project .= " AND " . $wpdb->prefix . "sp_cu_project.parent = '" .$pid . "' ";
                  }
              }
            
            
            
            #temp fix
			$r_projects_groups_addon = '';
			$find_groups = '';
            $r_projects_groups_addon = apply_filters('sp_cdm_projects_query', $r_projects_groups_addon, $uid);
            
            $search_project = apply_filters('sp_cdm_search_project_query', $search_project);
            
            
            
            if ($pid == 0 or $pid == '')
              {
                $user_query = " AND " . $wpdb->prefix . "sp_cu_project.uid = '" . $uid . "' ";
              }
            
            
            $r_projects_query = "SELECT 

												" . $wpdb->prefix . "sp_cu_project.id,

												" . $wpdb->prefix . "sp_cu_project.id AS pid,

												" . $wpdb->prefix . "sp_cu_project.uid,

												 " . $wpdb->prefix . "sp_cu_project.name AS project_name,
												 	 " . $wpdb->prefix . "sp_cu_project.default_order,

												  " . $wpdb->prefix . "sp_cu_project.parent

												 

										FROM " . $wpdb->prefix . "sp_cu_project

									  WHERE (" . $wpdb->prefix . "sp_cu_project.id != '' " . $user_query . " " . $find_groups . " " . $r_projects_groups_addon . ")										

										

										" . $search_project . "

										";
            
            $r_projects_query .= "
									AND recycle = 0 
										ORDER by " . $project_listing_type . "";
            
            
            if (get_option('sp_cu_release_the_kraken') == 1)
              {
                unset($r_projects_query);
                $r_projects_query = "SELECT 										 
																					" . $wpdb->prefix . "sp_cu_project.id,
								
																				" . $wpdb->prefix . "sp_cu_project.id AS pid,
								
																				" . $wpdb->prefix . "sp_cu_project.uid,
								
																				 " . $wpdb->prefix . "sp_cu_project.name AS project_name,
																				 " . $wpdb->prefix . "sp_cu_project.default_order,
								
																				  " . $wpdb->prefix . "sp_cu_project.parent
																		FROM " . $wpdb->prefix . "sp_cu_project
																		WHERE id != ''
																		
																		" . $search_project . " AND recycle = 0  ORDER by " . $project_listing_type . "
								";
								
								
              }
            
            
            
            
            
            $r_projects_query = apply_filters('sp_cdm_project_query_final', $r_projects_query);
            
            
           
            $r_projects = $wpdb->get_results($r_projects_query, ARRAY_A);
          
            
            if ( $pid == 'drafts' && !is_int($pid))
              {
				
              unset($r_projects);
              }
           
          }
        
        
        if ($pid != 0)
          {
            
            $search_project = apply_filters('sp_cdm_search_project_query', '');
            
            $query_project = $wpdb->get_results($wpdb->prepare("SELECT *

									 FROM " . $wpdb->prefix . "sp_cu_project

									WHERE  id = %d
									

									 ",$pid), ARRAY_A);
            
            
            $data['current_folder'] = apply_filters('sp_cdm/file_list/current_folder', $query_project[0]);
            
          }
        else
          {
            $data['current_folder'] = false;
          }
        
     
        $r_projects = apply_filters('sp_cdm_project_array_filter', $r_projects);
        
        
        $data['projects'] = $r_projects;
        
        #print_r($data);
        
        $sort = 'name';
        
        if (cdm_var('sort') == '')
          {
            $sort = $spcdm_ajax->order_by();
            
          }
        else
          {
            $sort = cdm_var('sort');
          }
        
        if (cdm_var('order',$output)== 'name')
          {
            $sort = 'name';
          }
        if (cdm_var('order',$output)== 'date')
          {
            $sort = 'date';
          }
        
        $sort_type = 'ASC';
        if (cdm_var('order_type',$output) != '')
          {
            $sort_type = cdm_var('order_type',$output);
          }
        $sort = str_replace("asc", "", $sort);
        $sort = str_replace("desc", "", $sort);
        #print_r($output);
        
        if ($pid == '' or $pid == 'undefined')
          {
            $pid = 0;
          }
        
        
        
        if ($pid == "" or $pid == "0" or $pid == "undefined" or $pid == "null")
          {
            if (cdm_var('search') != "")
              {
                
                $search_file .= " AND (name LIKE '%" . cdm_var('search') . "%' or  tags LIKE '%" . cdm_var('search') . "%')  ";
                $r_projects_groups_addon_search = str_replace("" . $wpdb->prefix . "sp_cu_project.id", "pid", $r_projects_groups_addon);
              }
            else
              {
                
                $search_file .= " AND pid = 0  AND parent = 0  ";
              }
            $search_file = apply_filters("sp_cdm_file_search_query", $search_file, $pid);
            
            $sort = str_replace("asc", "", $sort);
            $sort = str_replace("desc", "", $sort);
            
            #echo $query;
            $query = "SELECT *  FROM " . $wpdb->prefix . "sp_cu   where (uid = '" .$uid . "' " . $r_projects_groups_addon_search . ")  	 " . $search_file . " and parent = 0 and recycle =0  order by " . $sort . " " . $sort_type . "";
            
            
            $query = apply_filters('sp_cdm_query_string', $query);
            
            $r = $wpdb->get_results($query, ARRAY_A);
            
          }
        else
          {
            	if(cdm_var('search') == ''){
            $search_file .= " where (pid = '" . $pid . "')";
			}else{
			 $search_file .= " where (pid != '')";	
			}
            if (cdm_var('search') != "")
              {
                $search_file .= " AND (name LIKE '%" . cdm_var('search') . "%' or  tags LIKE '%" . cdm_var('search') . "%') and recycle =0  ";
              }
            else
              {
                $search_file .= "  AND parent = 0  and recycle =0   ";
              }
            $search_file = apply_filters("sp_cdm_file_search_query", $search_file, $pid);
            $query       = "SELECT *  FROM " . $wpdb->prefix . "sp_cu   " . $search_file . "  order by " . $sort . "  " . $sort_type . "";
            
            $query = apply_filters("sp_cdm_file_main_responsive_query", $query, $pid);
            
            $r = $wpdb->get_results($query, ARRAY_A);
            
          }
        
        
        if (get_option('sp_cu_release_the_kraken') == 1)
          {
            unset($r);
            unset($search_file);
            if ($pid == '')
              {
                
                $pid = 0;
                
              }
            
            if ($pid == "" or $pid == "0" or $pid == "undefined" or $pid == "null")
              {
                $search_file .= " WHERE  pid = 0  ";
                $query = "SELECT *  FROM " . $wpdb->prefix . "sp_cu 	 " . $search_file . " and parent = 0 and recycle =0  order by " . $sort . " " . $sort_type . "";
                
              }
            else
              {
                $search_file .= " AND (pid = '" . $pid . "') ";
              }
            
            
      
            $r = $wpdb->get_results($query, ARRAY_A);
            
            
          }
        
        if (cdm_var('search') == "" && get_option('sp_cu_release_the_kraken') != 1)
          {
            $r = apply_filters('sp_cdm_file_loop_array', $r, $pid);
          }
        if (cdm_var('search') != '')
          {
            $data['search'] = cdm_var('search');
          }
        
        $data['files'] = $r;
        
      
        
  
        
        cdm_community_get_template('file-list/' . apply_filters('sp_cdm/community/file_list/template', get_option('sp_cdm_community_file_list_template', 'list')) . '.php');
        
        
        
        
        
        
      }
    
    
  }