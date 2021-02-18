<?php





if(!function_exists('sp_cdm_display_projects')){

function sp_cdm_replace_project_select($pid_selected){
	
	
	global $wpdb,$current_user;



$html = '';



if(cdm_var('id') != '' && user_can($current_user->ID,'manage_options')){

	$uid = sanitize_text_field(cdm_var('id'));	

}else{

	$uid = $current_user->ID;

}



if(cdm_var('add-project')){

	

			$insert['name'] =sanitize_text_field( cdm_var('project-name'));

			$insert['uid'] = $uid;
foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }
	$wpdb->insert( "".$wpdb->prefix . "sp_cu_project",$insert );

}





if (@CU_PREMIUM == 1){  	

		$find_groups = cdmFindGroups($uid,'_project');

			 }else{
				$find_groups = ''; 
			 }






$r_projects_query = "SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE  ( uid = '".$uid ."' ".$find_groups.")  

									 ";
			$r_projects_query = apply_filters('sp_cdm_projects_query_dropdown', $r_projects_query ,$uid);							 
			$r_projects_query .="

										ORDER by name";						 
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);	





  if(count($projects) > 0 or get_option('sp_cu_user_projects') == 1 or get_option('sp_cu_user_projects_required') ==1){



	
if(get_option('sp_cu_user_projects_required') == 1){
	$requird = ' required';	
	}else{
		$requird = '';	
  }

	

	if(get_option('sp_cu_user_projects_required') == 0){	

	$select_dropdown .='<option name="" selected="selected">' . __("No Folder", "sp-cdm") . '</option>';	

	}

		for($i=0; $i<count($projects); $i++){

								

		if($pid_selected == $projects[$i]['id'] ){	

			$required = ' selected="selected" '	;

		}else{

			$required = ''	;

		}

		

		if($projects[$i]['name'] != ''){

	 $select_dropdown .='<option value="'.$projects[$i]['id'].'" '.$required.'>'.stripslashes($projects[$i]['name']).'</option>';	

		}

		}

	



	

	$select_dropdown =  apply_filters('wpfh_sub_projects', $select_dropdown ); 	

	$html  .= $select_dropdown;

	

	
	
	  

  }



	return $html;

	
	
	
}


	add_action( 'wp_ajax_cdm_update_projects_dropdown', 'cdm_ajax_update_projects_dropdown');
	
	function cdm_ajax_update_projects_dropdown(){
		
	echo 	sp_cdm_display_projects(true,true);
		
	die();	
	}
	

	
function sp_cdm_display_projects($showadd = true,$onlyoptions=false){

	

	

	global $wpdb,$current_user;



$html = '';



if(cdm_var('id') != '' && user_can($current_user->ID,'manage_options')){

	$uid = sanitize_text_field(cdm_var('id'));	

}else{

	$uid = $current_user->ID;

}



if(cdm_var('add-project')){

	

			$insert['name'] = sanitize_text_field(cdm_var('project-name'));

			$insert['uid'] = $uid;
foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }
	$wpdb->insert( "".$wpdb->prefix . "sp_cu_project",$insert );

}





if (@CU_PREMIUM == 1){  	

		$find_groups = cdmFindGroups($uid,'_project');

			 }else{
				$find_groups = ''; 
			 }






$r_projects_query = "SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE  ( uid = '".$uid ."' ".$find_groups.")  

									 ";
			$r_projects_query = apply_filters('sp_cdm_projects_query_dropdown', $r_projects_query ,$uid);							 
			
			
			$r_projects_query .="

										ORDER by name";		
										
													 
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);	



  if(count($projects) > 0 or get_option('sp_cu_user_projects') == 1 or get_option('sp_cu_user_projects_required') ==1){

	if($onlyoptions == false){

	  $html .= ' <p>
			<label>'.sp_cdm_folder_name() .'</label>
';
	}
	
if(get_option('sp_cu_user_projects_required') == 1){
	$requird = ' required';	
	$none = '';
	}else{
		$requird = '';	
		$none = '<option value="0" >'.__("None", 'sp-cdm').'</option>';
  }
	if($onlyoptions == false){
	$select_dropdown .='
	
	<select name="pid" class="pid_select'.$requird.'" >';
	}
	
	$select_dropdown .=''.$none .'';

	

	if(get_option('sp_cu_user_projects_required') == 0){	

	$select_dropdown .='<option name="" selected="selected">' . __("No Folder", "sp-cdm") . '</option>';	

	}

		for($i=0; $i<count($projects); $i++){

								

		if($current_user->last_project == $projects[$i]['id'] ){	

			$required = ' selected="selected" '	;

		}else{

			$required = ''	;

		}

		

		if($projects[$i]['name'] != ''){

	 $select_dropdown .='<option value="'.$projects[$i]['id'].'" '.$required.'>'.stripslashes($projects[$i]['name']).'</option>';	

		}

		}

	
	if($onlyoptions == false){
	$select_dropdown .='</select>';
	}
	

	$select_dropdown =  apply_filters('wpfh_sub_projects', $select_dropdown ); 	

	$html  .= $select_dropdown;

	

	

	  

  }



	return $html;

	

}


function sp_cdm_display_projects_select($id){

	

	

	global $wpdb,$current_user;



$html = '';



if(cdm_var('id') != '' && user_can($current_user->ID,'manage_options')){

	$uid = sanitize_text_field(cdm_var('id'));	

}else{

	$uid = $current_user->ID;

}



if(cdm_var('add-project')){

	

			$insert['name'] = sanitize_text_field(cdm_var('project-name'));

			$insert['uid'] = $uid;
foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }
	$wpdb->insert( "".$wpdb->prefix . "sp_cu_project",$insert );

}





if (@CU_PREMIUM == 1){  	

		$find_groups = cdmFindGroups($uid,'_project');

			 }else{
				$find_groups = ''; 
			 }






$r_projects_query = "SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE  ( uid = '".$uid ."' ".$find_groups.")  

									 ";
			$r_projects_query = apply_filters('sp_cdm_projects_query_dropdown', $r_projects_query ,$uid);							 
			$r_projects_query .="

										ORDER by name";						 
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);	





  if(count($projects) > 0 or get_option('sp_cu_user_projects') == 1){

	  $html .= ' <tr>

    <td><strong>'.sp_cdm_folder_name() .'</strong>

	



	

	

	</td>

    <td>';

	

	$select_dropdown .='

	<select name="pid" class="pid_select">';

	

	if(get_option('sp_cu_user_projects_required') == 0){	

	$select_dropdown .='<option name="" selected="selected">'.__("No","sp-cdm").' '.sp_cdm_folder_name() .'</option>';	

	}

		for($i=0; $i<count($projects); $i++){

								

		if($current_user->last_project == $projects[$i]['id'] ){	

			$required = ' selected="selected" '	;

		}else{

			$required = ''	;

		}

		

		if($projects[$i]['name'] != ''){

	 $select_dropdown .='<option value="'.$projects[$i]['id'].'" '.$required.'>'.stripslashes($projects[$i]['name']).'</option>';	

		}

		}

	

	$select_dropdown .='</select>';

	

	$select_dropdown =  apply_filters('wpfh_sub_projects', $select_dropdown ); 	

	$html  .= $select_dropdown;

	

	if(get_option('sp_cu_user_projects') == 1  or current_user_can( 'manage_options' )){

		

		$html .= '<a href="javascript:sp_cu_dialog(\'#sp_cu_add_project\',550,130)" class="button" style="margin-left:15px">' . __(sprintf("Add %s",sp_cdm_folder_name()), "sp-cdm") . '</a>

		

	

		

		';

		

	}

	$html .='</td>

  </tr>';

	  

  }



	return $html;

	

}

function sp_cdm_display_projects_select_by_id($uid,$name,$class = 'pid_select'){

	

	

	global $wpdb;







if (@CU_PREMIUM == 1){  	

		$find_groups = cdmFindGroups($uid,'_project');

			 }else{
				$find_groups = ''; 
			 }






$r_projects_query = "SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE  ( uid = '".$uid ."' ".$find_groups.")  
									AND recycle = 0
									 ";
			$r_projects_query = apply_filters('sp_cdm_projects_query_dropdown', $r_projects_query ,$uid);							 
			$r_projects_query .="

										ORDER by name";						 
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);	





  if(count($projects) > 0 or get_option('sp_cu_user_projects') == 1){

	

	$select_dropdown .='

	<select name="'.$name.'" class="'.$class.'">';

	

	if(get_option('sp_cu_user_projects_required') == 0){	

	$select_dropdown .='<option name="" selected="selected">'.__("No","sp-cdm").' '.sp_cdm_folder_name() .'</option>';	

	}

		for($i=0; $i<count($projects); $i++){

								

		if($current_user->last_project == $projects[$i]['id'] ){	

			$required = ' selected="selected" '	;

		}else{

			$required = ''	;

		}

		

		if($projects[$i]['name'] != ''){

	 $select_dropdown .='<option value="'.$projects[$i]['id'].'" '.$required.'>'.stripslashes($projects[$i]['name']).'</option>';	

		}

		}

	

	$select_dropdown .='</select>';

	

	$select_dropdown =  apply_filters('wpfh_sub_projects', $select_dropdown ); 	

	$html  .= $select_dropdown;


	  

  }



	return $html;

	

}


}



?>