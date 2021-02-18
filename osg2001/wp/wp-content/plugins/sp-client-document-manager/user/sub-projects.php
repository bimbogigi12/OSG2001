<?php


$spdm_sub_projects_new = new spdm_sub_projects_new;
add_action('sp_cdm_sub_projects',array($spdm_sub_projects_new, 'get_sub'));
add_filter('wpfh_sub_projects', array($spdm_sub_projects_new ,'project_dropdown'),10,2); 
add_filter('sp_cdm_add_project_form', array($spdm_sub_projects_new ,'sub_project_form')); 
add_action('sp_cdm_project_query', array($spdm_sub_projects_new ,'project_query')); 
add_action('cdm_premium_settings', array($spdm_sub_projects_new ,'settings')); 

add_filter('sp_cdm_uploader_above', array($spdm_sub_projects_new ,'makeInput'),1,19); 
add_filter('sp_cdm_shortcode_email_before', array($spdm_sub_projects_new ,'emailBreadCrumb'),4,10); 


class spdm_sub_projects_new{
	
	

	function getBreadCrumbRecursor($pid){
		
				global $wpdb;
				
			$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu_project   where id = %d ",$pid), ARRAY_A);	
				
			$content .= '<span><a href="javascript:sp_cdm_load_project('.$r[0]['id'].');"  >'.stripslashes($r[0]['name']).'</a> &raquo; </span>';
			
				if($r[0]['parent'] != 0){
				$content .=  $this->getBreadCrumbRecursor($r[0]['parent'])	;
				}
			
			return $content;
			
				
	}
	function getBreadCrumb(){
		global $wpdb;

		$pid = sanitize_text_field(@cdm_var('pid'));
		$content = '';
		if($pid != 0){
		$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu_project   where id = %d ",$pid), ARRAY_A);
		
			$content .= '<span><a href="javascript:sp_cdm_load_project('.$r[0]['id'].');"  >'.stripslashes($r[0]['name']).'</a> &raquo; <span>';
			
				if($r[0]['parent'] != 0){
				$content .=  $this->getBreadCrumbRecursor($r[0]['parent'])	;
				}
		}
			return $content;
			
		
	}
	
	
	
	
	function getBreadCrumbRecursor_email($pid){
		
				global $wpdb;
				
			$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu_project   where id = %d ",$pid), ARRAY_A);	
				
			$content .= ''.stripslashes($r[0]['name']).'|';
			
				if($r[0]['parent'] != 0){
				$content .=  $this->getBreadCrumbRecursor_email($r[0]['parent'])	;
				}
			
			return $content;
			
				
	}
	function getBreadCrumb_email($pid){
		global $wpdb;
	
		
		if($pid != 0){
		$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu_project   where id = %d ",$pid), ARRAY_A);
		
			$content .= ''.stripslashes($r[0]['name']).'|';
			
				if($r[0]['parent'] != 0){
				$content .=  $this->getBreadCrumbRecursor_email($r[0]['parent'])	;
				}
		}
			return $content;
			
		
	}
	
	
	function emailBreadCrumb($message,$r ,$r_project,$r_cats){
		
		
		$trail = $this->getBreadCrumb_email($r[0]['pid']);
		$total_arr  = array();
		$total_arr = explode('|',$trail);
		$trailer .='Main Folder ';
		if(count($total_arr) > 0){
			$array = array_reverse($total_arr);			
			foreach($array as $key => $value){
				if($value != ''){
				$trailer .= ' &raquo; '.$value.'  ';
				}
			}
		}
	    $message   = str_replace('[project]', $trailer, $message);
		return $message;
	}
	function makeInput($extra_js){
		global $user_ID;
		
		$extra_js .= '<input type="hidden" name="cdm_premium_sub_projects"  id="cdm_premium_sub_projects" value="1">
				
		
		<script type="text/javascript">
			var old_sp_cdm_load_project = sp_cdm_load_project;
	
		
		
		function sp_cdm_add_breadcrumb(pid){
			

				jQuery.post(sp_vars.ajax_url, {action: "cdm_add_breadcrumb", pid: pid}, function(msg){
						jQuery("#sp_cdm_breadcrumbs_subs").html(msg);
					 jQuery("#sp_cdm_breadcrumbs_subs span").reverseOrder();  
				})
				
		
			
			
		}
		</script>
		<div id="sp_cdm_breadcrumbs"><span><a href="javascript:sp_cdm_load_project(0);"   class="sp_cdm_home"">'.__("Home", "sp-cdm").'</a> &raquo;</span> <span id="sp_cdm_breadcrumbs_subs">  </span>  </div>';
		
		return $extra_js;
		
	}

	function project_query(){
		
		unset($r_projects);
	global $wpdb;
		
if(cdm_var('search')){


$search_project .= " AND ".$wpdb->prefix."sp_cu_project.name LIKE '%".cdm_var('search')."%' ";	

}

	 if(function_exists('cdmFindGroups')){

		$find_groups = cdmFindGroups(@cdm_var('uid'),1);

	  }

		if(get_option('sp_cu_hide_project') == 1){		
			
		$r_projects = $wpdb->get_results("SELECT ".$wpdb->prefix."sp_cu.name,
												 ".$wpdb->prefix."sp_cu.id,
												 ".$wpdb->prefix."sp_cu.pid ,
												 ".$wpdb->prefix."sp_cu.uid,
												 ".$wpdb->prefix."sp_cu.parent,
												 ".$wpdb->prefix."sp_cu_project.name AS project_name,
												 ".$wpdb->prefix."sp_cu_project.parent
												
												 
										FROM ".$wpdb->prefix."sp_cu   
										LEFT JOIN ".$wpdb->prefix."sp_cu_project  ON ".$wpdb->prefix."sp_cu.pid = ".$wpdb->prefix."sp_cu_project.id
										WHERE (".$wpdb->prefix."sp_cu.uid = '".cdm_var('uid')."'  ".$find_groups .")
										AND pid != 0
										AND parent = 0 
										AND  ".$wpdb->prefix."sp_cu.parent = 0 
										".$sub_projects."
										".$search_project."
										GROUP BY pid
										ORDER by date desc", ARRAY_A);
										
					
		}else{
			
		$r_projects = $wpdb->get_results("SELECT 
												".$wpdb->prefix."sp_cu_project.id,
												".$wpdb->prefix."sp_cu_project.id AS pid,
												".$wpdb->prefix."sp_cu_project.uid,
												 ".$wpdb->prefix."sp_cu_project.name AS project_name,
												 ".$wpdb->prefix."sp_cu_project.parent
												 
										FROM ".$wpdb->prefix."sp_cu_project
										WHERE (".$wpdb->prefix."sp_cu_project.uid = '".cdm_var('uid')."'  ". cdmFindGroups(cdm_var('uid'),1) .")										
										AND parent = 0  
										".$search_project."
										
										ORDER by name", ARRAY_A);
										
									
			
		}
		return $r_projects;
	}
	
	
function recursor($datas, $parent = 0, $depth = 0,$chosen){
    if($depth > 5000) return ''; // Make sure not to have an endless recursion
    $tree = '';
	if(is_array($datas)){
    for($i=0, $ni=count($datas); $i < $ni; $i++){
		
		
		if($datas[$i]['id'] == $chosen){
		$selected = 'selected="selected"';	
		}else{
		$selected = '';		
		}
        if($datas[$i]['parent'] == $parent){
           $tree .='<option value="'.$datas[$i]['id'] . '" '.	$selected.'>';
		    $tree .= str_repeat('--', $depth);
            $tree .= '- '.stripslashes($datas[$i]['name']) . '</option>';
            $tree .=spdm_sub_projects_new::recursor(@$datas[$i]['children'], $datas[$i]['id'], $depth+1,$chosen);
        }
    }
	}
    return $tree;
}






function sub_project_form($form){
	
			global $wpdb,$current_user;
			
			if(cdm_var('id') != '' && user_can($current_user->ID,'manage_options')){
	$uid = cdm_var('id');	
}else{
	$uid = $current_user->ID;
}
			
			$options = $this->parents();
			$html = '<div class="remodal" data-remodal-id="folder" data-remodal-options="{ \'hashTracking\': false }">
			
		<input type="hidden" id="sub_category_uid" name="uid" value="'.$uid.'">
		<p>
		<label>
		'.sp_cdm_folder_name() .' '.__("Name","sp-cdm").': </label>
		<input  id="sub_category_name" type="text" name="project-name"  style="width:200px !important">
		</p>
		<p>
		<label>
		'.sp_cdm_folder_name() .' '.__("Parent","sp-cdm").':</label>
		 <select name="pid" id="sub_category_parent"><option value="0">None</option>'. $this->recursor( $options).'</select>
		 </p>
		 
		<p><input type="submit" value="'.__("Add","sp-cdm").' '.sp_cdm_folder_name() .'" name="add-project" onclick="sp_cu_add_project()"></p>

	</div>';
				
	return $html;
}

function recursor2( $array, $r = 0, $p = null,$chosen) {

if(is_array($array)){
	for($i=0; $i<count( $array); $i++){
if ($array[$i]['parent'] == $p) {
            // reset $r
            $r = 0;
        }
  	  $dash = ($array[$i]['parent'] == 0) ? '' : str_repeat('&nbsp;&nbsp;', $r) .' ';
			
			if($chosen == $array[$i]['id']){
			$selected = 'selected="selected"';	
			}else{
			$selected = '';	
			}
		$options .='<option value="'.$array[$i]['id'].'" '.$selected.'>'. $dash.''.stripslashes($array[$i]['name']).'</option>';
		
		
		 if (isset($array[$i]['children'])) {
         $options .=   $this->recursor($array[$i]['children'], ++$r, $array[$i]['parent']);
        }
		
		
	}
}

	return $options;
}
function parents(){
	
	global $wpdb,$current_user;


if(cdm_cookie('uid ')!= '' && cdm_cookie('uid ')  != 0 ){

	$uid = cdm_cookie('uid ') ;	
}else{
	$uid = $current_user->ID;
}

	 if(function_exists('cdmFindGroups')){

		$find_groups = cdmFindGroups($uid ,1);

	  }


		
		$r_projects_query_search = apply_filters('sp_cdm_projects_query', $r_projects_query_search ,$uid);	
		
$r_projects_query = "SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE  ( uid = '".$uid ."' ".$find_groups." ".$r_projects_query_search.")  

								
									and recycle = 0 
										ORDER by name";		
			
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);
		

				
				
				$tree = array('NULL' => array('children' => array()));
 foreach( $projects as $item){
	
    if(isset($tree[$item['id']])){
       $tree[$item['id']] = array_merge($tree[$item['id']],$item);
    } else {
       $tree[$item['id']] = $item;
    }

    $parentid = is_null($item['parent']) ? 'NULL' : $item['parent'];
    if(!isset($tree[$parentid])) $tree[$parentid] = array('children' => array());
    //this & is where the magic happens: any alteration to $tree[$item['id']
    //  will reflect in the item $tree[$parentid]['children'] as they are the same
    //  variable. For instance, adding a child to $tree[$item['id']]['children]
    //  will be seen in 
    //  $tree[$parentid]['children'][<whatever index $item['id'] has>]['children]
    $tree[$parentid]['children'][] = &$tree[$item['id']];
	
 }
 


 unset($tree['NULL']);
		
		
			
				
				return $tree[0]['children'] ;		 	
}	


function parents_all($id){
	
	global $wpdb,$current_user;




		
	
		
$r_projects_query = $wpdb->prepare("SELECT *

	

									 FROM ".$wpdb->prefix."sp_cu_project

									WHERE recycle = 0 
									AND id != %d
										ORDER by name",$id);		
			
  $projects = $wpdb->get_results($r_projects_query, ARRAY_A);
		
				
				$tree = array('NULL' => array('children' => array()));
 foreach( $projects as $item){
	
    if(isset($tree[$item['id']])){
       $tree[$item['id']] = array_merge($tree[$item['id']],$item);
    } else {
       $tree[$item['id']] = $item;
    }

    $parentid = is_null($item['parent']) ? 'NULL' : $item['parent'];
    if(!isset($tree[$parentid])) $tree[$parentid] = array('children' => array());
    //this & is where the magic happens: any alteration to $tree[$item['id']
    //  will reflect in the item $tree[$parentid]['children'] as they are the same
    //  variable. For instance, adding a child to $tree[$item['id']]['children]
    //  will be seen in 
    //  $tree[$parentid]['children'][<whatever index $item['id'] has>]['children]
    $tree[$parentid]['children'][] = &$tree[$item['id']];
	
 }
 


 unset($tree['NULL']);
		
		
			
				
				return $tree[0]['children'] ;		 	
}	

function project_dropdown($html,$chosen= false){
	global $wpdb,$current_user;
	unset($html);

$options = $this->parents();

	if(get_option('sp_cu_user_projects_required') == 1){
	$requird = ' required';	
	}else{
		$requird = '';	
  }	

	  $html .= '<select name="pid" class="pid_select'.$requird.'"><option value="">'.__("None", "sp-cdm").'</option>
	  '. $this->recursor( $options,0,0,$chosen).'</select>';
	
	

	


	return $html;
}




function project_dropdown_all($html,$id,$chosen= false){
	global $wpdb,$current_user;
	unset($html);
$html = '';
$options = $this->parents_all($id);

	if(get_option('sp_cu_user_projects_required') == 1){
	$requird = ' required';	
	}else{
		$requird = '';	
  }	

	  $html .= '<select name="pid" class="pid_select'.$requird.'"><option value="0">'.__("None", "sp-cdm").'</option>
	  '. $this->recursor( $options,0,0,$chosen).'</select>';
	
	

	


	return $html;
}
function project_dropdown_replace(){
	global $wpdb,$current_user;
	unset($html);

$options = spdm_sub_projects_new::parents();

	  $html .= '<option value="">'.__("None", "sp-cdm").'</option>'. spdm_sub_projects_new::recursor( $options).'';
	
	

	


	return $html;
}
function get_sub(){
	
	echo '<tr >
	<td class="cdm_file_icon ext_directory"></td>
		<td class="cdm_file_info">Im a sub</td>
		<td class="cdm_file_date">&nbsp;</td>
		
		<td class="cdm_file_type"></td>
	</tr>';
	
	
	
}
	
	function settings(){
		
		
		
	}
	
	
	
	
}
