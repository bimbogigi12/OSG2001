<?php



if (!class_exists('cdmProjects')) {
	


    class cdmProjects
    {
		
        function add()
        {
            global $wpdb;
            $r= array();
			 $selected = '';
			 $spdm_sub_projects_new = new spdm_sub_projects_new;
			 
			echo '

<form action="admin.php?page=sp-client-document-manager-projects" method="post">'.wp_nonce_field( 'cdm_nonce', 'cdm_nonce', true, false ).'';

if(cdm_var('parent') != ''){
	$parent = $wpdb->get_results("SELECT  * FROM " . $wpdb->prefix . "sp_cu_project where id = '" . sanitize_text_field(cdm_var('parent')) . "'  ", ARRAY_A);
	echo '<input type="hidden" name="parent" value="'.sanitize_text_field(cdm_var('parent')).'">';

$selected = $parent[0]['uid'];
}else{

}
            if (cdm_var('id') != "") {
                $r = $wpdb->get_results($wpdb->prepare("SELECT  * FROM " . $wpdb->prefix . "sp_cu_project where id = %d  ", intval(cdm_var('id') )), ARRAY_A);
                echo '<input type="hidden" name="id" value="' . $r[0]['id'] . '"><input type="hidden" name="old_id" value="' . $r[0]['id'] . '">';
        		 $selected = $r[0]['uid'];
		 
		    } //cdm_var('id') != ""
            $users = $wpdb->get_results("SELECT * FROM " . $wpdb->base_prefix . "users order by display_name  ", ARRAY_A);
           
            echo '

	 <table class="wp-list-table widefat fixed posts" cellspacing="0">

  <tr>

    <th width="250">' . __("Name:", "sp-cdm") . '</th>

    <td><input type="text" name="project-name" value="' . stripslashes(@$r[0]['name']) . '" style="width:100%"></td>

  </tr>
		 <tr>

    <th>' . __(sprintf("Parent %s",sp_cdm_folder_name()), "sp-cdm") . '</th>

    <td>'.$spdm_sub_projects_new->project_dropdown_all('',$r[0]['id'],$r[0]['parent']).'</td>

  </tr>
  <tr>

    <th>' . __("User:", "sp-cdm") . '</th>

    <td>';
            wp_dropdown_users(array(
                'name' => 'uid',
                'selected' => $selected,
				'show_option_none'  => __("Not Assigned","sp-cdm")
            ));
            echo '</td>

  </tr>';
  
   do_action('sp_cdm_edit_project_main_form', $r);
  echo '

  <tr>

    <td>&nbsp;</td>

    <td><input type="submit" name="save-project" value="' . __("Save", "sp-cdm") . '"></td>

  </tr>

</table>';
           
		   if(cdm_var('id') != ''){
		    do_action('sp_cdm_edit_project_form', sanitize_text_field(cdm_var('id')));
		   }
            echo '

</form>





';
        }
		function get_parent_count($id,$count =0){
			
			
			global $wpdb;
			$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d",$id), ARRAY_A);	
			
			if($r[0]['parent'] != 0){
			
			$count = $count +1;
			
			$total = $this->get_parent_count($r[0]['parent'],$count);	
				
			}else{
			$total = $count;	
			}
			
			return $total;
			
			
		}
		function getParentName($id){
			global $wpdb;	
			
		$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d",$id), ARRAY_A);	
		
		return $r[0]['name'];
		}
		function getChildren($id,$level = 0){
			
		global $wpdb;
		$html = '';
		  $spacer = '';  
		    $query =$wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where parent = %d  and recycle = 0 order by parent",$id );
		
			$r = $wpdb->get_results($query, ARRAY_A);
			
			if(count($r)>0){
				
				
				
				for ($i = 0; $i < count($r ); $i++) {
					
					//start loop
					
			$total_levels = $this->get_parent_count($r[$i]['id']);
				for ($x = 1; $x <= $total_levels; $x++) {
				$spacer .= '<span style="margin-right:10px">&rarr; </div>';
				}
                  $html .= '	<tr>
<td colspan="2">'.$spacer.' #' . stripslashes($r[$i]['id']) . ' ' . stripslashes($r[$i]['name']) . '</td>
				

<td>'.$spacer.'<em>Parent: '.$this->getParentName($r[$i]['parent']).'</em></td>



<td>

<a href="javascript: cdm_download_project('.$r[$i]['id'] .',\''.wp_create_nonce( 'my-action_'.$r[$i]['id'] ).'\')" style="margin-right:15px" >' . __("Download Archive", "sp-cdm") . '</a> ';

if($r[$i]['parent'] == 0 or class_exists('spdm_sub_projects')){
 
 $html .='<a href="admin.php?page=sp-client-document-manager-projects&function=add&parent=' . $r[$i]['id'] . '" style="margin-right:15px" >' . __(sprintf("Add Sub %s",sp_cdm_folder_name()), "sp-cdm") . '</a> '; 

}


 $html .='<a href="admin.php?page=sp-client-document-manager-projects&function=delete&id=' . $r[$i]['id'] . '" style="margin-right:15px" >' . __("Delete", "sp-cdm") . '</a> 

<a href="admin.php?page=sp-client-document-manager-projects&function=edit&id=' . $r[$i]['id'] . '" >' . __("Modify", "sp-cdm") . '</a></td>

</tr><tr><td colspan="4">'.$this->getChildren($r[$i]['id'],	$level ).'</td></tr>';
      
					
					//end loop
					
					
				}
			}
			
			
			return $html;
		}
		
		function move_sub_folders($id,$uid){
			global $wpdb;
			 
			 $projects = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where parent = %d",$id), ARRAY_A);
			 
			 if( $projects != false){
			  for ($p = 0; $p < count( $projects); $p++) {
			 $insert['uid']  = $uid;
			 $where['id'] =  $projects[$p]['id'];
			 $wpdb->update("" . $wpdb->prefix . "sp_cu_project", $insert, $where);
                  
                 
					$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where pid = %d", $projects[$p]['id']), ARRAY_A);	
					 if($r != false){
						 for ($i = 0; $i < count($r); $i++) {
							 if(file_exists('' . SP_CDM_UPLOADS_DIR . ''.$r[$i]['uid'].'/'.$r[$i]['file'].'')){
								rename('' . SP_CDM_UPLOADS_DIR . ''.$r[$i]['uid'].'/'.$r[$i]['file'].'', '' . SP_CDM_UPLOADS_DIR . '' . $uid . '/'.$r[$i]['file'].'');
							 }
						 }
					 }
					
					
					$update['uid']        = $uid;
                    $where_project['pid'] =  $projects[$p]['id'];
                  
				    $wpdb->update("" . $wpdb->prefix . "sp_cu", $update, $where_project);
					$this->move_sub_folders(  $projects[$p]['id'],$uid);
			  }
			 }
		}
		
		

        function view()
        {
            global $wpdb,$spcdm_ajax;
			  echo '<h2>' . sp_cdm_folder_name(1) . '</h2>' . sp_client_upload_nav_menu() . '';
			
            if (cdm_var('save-project') != "") {
				if ( wp_verify_nonce( cdm_var('cdm_nonce'), 'cdm_nonce' ) == false) {exit('Security Error');}	
				
				$old_project_details = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d", sanitize_text_field(@cdm_var('id'))), ARRAY_A);	
				
				
                $insert['name'] = sanitize_text_field(cdm_var('project-name'));
                $insert['uid']  = sanitize_text_field(cdm_var('uid'));
				$insert['parent'] = sanitize_text_field(cdm_var('pid'));
               if(cdm_var('parent') != ''){
				  $insert['parent']  = sanitize_text_field(cdm_var('parent')); 
				   
			   }
			   
			   
			    if (cdm_var('id') != "") {
                    $where['id'] = sanitize_text_field(@cdm_var('id'));
					
					
                    $wpdb->update("" . $wpdb->prefix . "sp_cu_project", $insert, $where);
                  #flush cache
				  $query =  "DELETE FROM ".$wpdb->options." WHERE option_name LIKE '_transient_cdm_folder_permissions_".$where['id']."_%'
				  												   OR option_name LIKE '_transient_timeout_cdm_folder_permissions_".$where['id']."_%'
																   OR option_name LIKE '_transient_timeout_cdm_file_permissions_".$where['id']."_%'
																   OR option_name LIKE '_transient_cdm_file_permissions_".$where['id']."_%'
																   OR option_name LIKE '_transient_timeout_cdm_file_permissions_".$where['id']."_%'
																   OR option_name LIKE '_transient_cdm_delete_permissions_".$where['id']."_%'
																   OR option_name LIKE '_transient_timeout_cdm_delete_permissions_".$where['id']."_%'
																   ";
																   
															
				  $wpdb->query(  $query  );
																   
															
				  
				  
				  
				  
				  #move files if ID is different
                 if($old_project_details[0]['uid'] != cdm_var('uid')){
					 #make folder if it doesnt exist
					  $dir = '' . SP_CDM_UPLOADS_DIR . '' . intval(cdm_var('uid') ). '/';
						if (!is_dir($dir)) {
							mkdir($dir, 0777);
						}
					#get all files in this folder and move them
					$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where pid = %d",intval( cdm_var('id'))), ARRAY_A);	
					 if($r != false){
					 for ($i = 0; $i < count($r); $i++) {
						 if(file_exists('' . SP_CDM_UPLOADS_DIR . ''.$r[$i]['uid'].'/'.$r[$i]['file'].'')){
								rename('' . SP_CDM_UPLOADS_DIR . ''.$r[$i]['uid'].'/'.$r[$i]['file'].'', '' . SP_CDM_UPLOADS_DIR . '' . intval(cdm_var('uid')) . '/'.$r[$i]['file'].'');
							 }
						}
					 }
					
					#update the user id for files in this folder
					$update['uid']        = sanitize_text_field(cdm_var('uid'));
                    $where_project['pid'] = sanitize_text_field(cdm_var('id'));                  
				    $wpdb->update("" . $wpdb->prefix . "sp_cu", $update, $where_project);
					
					#move all sub folders
					$this->move_sub_folders( sanitize_text_field(cdm_var('id')),sanitize_text_field(cdm_var('uid')));
					
				 }
					
					$insert_id = sanitize_text_field( cdm_var('id'));
					
					do_action('sp_cdm_edit_project_update', $insert_id);
					 cdm_delete_cache();
                } else {
					foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }
                    $wpdb->insert("" . $wpdb->prefix . "sp_cu_project", $insert);
                    $insert_id = $wpdb->insert_id;
					do_action('sp_cdm_edit_project_add', $insert_id);
					 cdm_delete_cache();
                }
                do_action('sp_cdm_edit_project_save', $insert_id);
            }
            if (cdm_var('function') == 'add' or cdm_var('function') == 'edit') {
                $this->add();
            }
            elseif (cdm_var('function') == 'delete') {
				
			$spcdm_ajax->remove_cat(sanitize_text_field(cdm_var('id')));
		
		
			echo '<script type="text/javascript">
				window.location = "admin.php?page=sp-client-document-manager-projects";
				</script>';	 
	
				


            } 
            else {
				
				$search = '';
				$extra_queries = apply_filters('sp_cdm/admin/projects/list/query/search', $search);
                $query = "SELECT " . $wpdb->prefix . "sp_cu_project.name as projectName,

									" . $wpdb->prefix . "sp_cu_project.uid,
									" . $wpdb->prefix . "sp_cu_project.parent,
									" . $wpdb->prefix . "sp_cu_project.id AS projectID,
									" . $wpdb->base_prefix . "users.ID,
									" . $wpdb->base_prefix . "users.user_nicename								
									
									FROM " . $wpdb->prefix . "sp_cu_project
									LEFT JOIN " . $wpdb->base_prefix . "users ON " . $wpdb->prefix . "sp_cu_project.uid = " . $wpdb->base_prefix . "users.ID
									
									 WHERE " . $wpdb->prefix . "sp_cu_project.parent = 0 
									  and recycle = 0 
									 	".$extra_queries."	
									 order by " . $wpdb->prefix . "sp_cu_project.name";
									
				$r = $wpdb->get_results($query, ARRAY_A);
              
                do_action('sp_cdm/admin/projects/list/above_button');
				echo '

								

									 

									 

									 <div style="margin:10px">

									 <a href="admin.php?page=sp-client-document-manager-projects&function=add" class="button">' . __("Add", "sp-cdm") . ' ' . sp_cdm_folder_name() . '</a> ';
									 do_action('sp_cdm/admin/projects/list/buttons');
									 echo'</div>';
									 
									  do_action('sp_cdm/admin/projects/list/below_button');

									 echo'<table class="wp-list-table widefat fixed posts" cellspacing="0">

	<thead>

	<tr>

<th style="width:40px"><strong>' . __("ID", "sp-cdm") . '</strong></th>

<th><strong>' . __("Name", "sp-cdm") . '</strong></th>

<th><strong>' . __("User", "sp-cdm") . '</strong></th>

<th><strong>' . __("Action", "sp-cdm") . '</strong></th>';

do_action('sp_cdm/admin/projects/list/header');
echo '</tr>

	</thead><tbody id="sortable_projects">';
                for ($i = 0; $i < count($r); $i++) {
                 
                    echo '	<tr>

<td style="font-weight:bold;background-color:#EFEFEF">#' . $r[$i]['projectID'] . '</td>				

<td style="font-weight:bold;background-color:#EFEFEF">' . stripslashes($r[$i]['projectName']) . '</td>

<td style="font-weight:bold;background-color:#EFEFEF">' . $r[$i]['user_nicename'] . '</td>

<td style="font-weight:bold;background-color:#EFEFEF">

<a href="javascript:cdm_download_project('.$r[$i]['projectID'].',\''.wp_create_nonce( 'cdm-download-archive' ).'\');" style="margin-right:15px" >' . __("Download Archive", "sp-cdm") . '</a>  ';


if($r[$i]['parent'] == 0 or class_exists('spdm_sub_projects')){
 
 echo '<a href="admin.php?page=sp-client-document-manager-projects&function=add&parent=' . $r[$i]['projectID'] . '" style="margin-right:15px" >' . __(sprintf("Add Sub %s",sp_cdm_folder_name()), "sp-cdm") . '</a> '; 

}




 echo '<a href="admin.php?page=sp-client-document-manager-projects&function=delete&id=' . $r[$i]['projectID'] . '" style="margin-right:15px" >' . __("Delete", "sp-cdm") . '</a> 

<a href="admin.php?page=sp-client-document-manager-projects&function=edit&id=' . $r[$i]['projectID'] . '" >' . __("Modify", "sp-cdm") . '</a></td>

';
do_action('sp_cdm/admin/projects/list/loop',$r[$i]);
echo '</tr>';
echo'<tr><td colspan="4">'.$this->getChildren($r[$i]['projectID'] ).'</td></tr>';
                } //$i = 0; $i < count($r); $i++
                echo '</tbody></table>';
            }
        }
    }
} //!class_exists('cdmProjects')
?>