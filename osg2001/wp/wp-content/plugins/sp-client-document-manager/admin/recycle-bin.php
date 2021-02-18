<?php


new cdm_recycle_bin;





class cdm_recycle_bin{
	
	
		function __construct(){
			$this->db_ver = '1.0.1';
			
			add_action('init', array($this,'install'));			
			add_action('init',array($this,'empty_reycle_bin_cron'));
			add_action('sp_cdm_settings_advanced',array($this,'admin_settings'));
			add_action('sp_cdm_run_recycler', array($this,'run_cron'));
			add_action('sp_cu_admin_menu', array($this, 'menu'));
			add_filter('sp_client_upload_top_menu', array($this, 'top_menu'));
			add_filter('sp_cdm_file_search_query', array($this,'search_query'));
			add_filter('sp_cdm/admin/projects/list/query/search', array($this, 'search_query'));
			add_filter('sp_cdm_projects_query_dropdown', array($this,'search_query'));
			
			#ajax
			add_action( 'wp_ajax_cdm_admin_view_recycled_item', array($this, 'view_recycled_item'));
			add_action( 'wp_ajax_cdm_admin_view_recycled_item', array($this, 'view_recycled_item'));
			add_action( 'wp_ajax_cdm_admin_view_restore_object', array($this, 'restore_object'));
			add_action( 'wp_ajax_cdm_admin_view_delete_object', array($this, 'delete_object'));
			
			add_action( 'wp_ajax_cdm_admin_view_empty_recycle_bin', array($this, 'empty_recycle_bin'));
			add_action( 'wp_ajax_cdm_admin_view_restore_recycle_bin', array($this, 'restore_recycle_bin'));
		}
		function search_query($search_query){
			
			$search_query .= ' AND recycle = 0  ';
			
			return $search_query;
		}
		
		function restore_recycle_bin(){
			global $wpdb;
			$json = array();
		$five_days_ago = date("Y-m-d",strtotime('-5 days'));
		$today = date("Y-m-d");	
		
		#echo "SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle_date BETWEEN '".$five_days_ago." AND '".$today." and recycle = 1";exit;
		 $folders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle = 1", ARRAY_A);	
			if($folders){
			for ($i = 0; $i < count(  $folders  ); $i++) {
			$this->restore_folder($folders[$i]['id']);	
			}
			}
			
			
		 $files = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where  recycle = 1", ARRAY_A);
			if($files){
			for ($i = 0; $i < count(  $files  ); $i++) {
				
					$update['recycle'] = 0;
					$update['recycle_date'] = '';
				$where['id'] = $files[$i]['id'];
				$table = "" . $wpdb->prefix . "sp_cu";
				$wpdb->update($table , $update,$where);
				
		
		
			}
			}
			
			$json['message']  = 'Restored recycle bin!';
			sp_cdm_user_logs::write($json['message'] );
			echo json_encode($json);
		die();	
		}
		function empty_recycle_bin(){
			global $wpdb;
			
			$json = array();
		$five_days_ago = date("Y-m-d",strtotime('-5 days'));
		$today = date("Y-m-d");	
		
		#echo "SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle_date BETWEEN '".$five_days_ago." AND '".$today." and recycle = 1";exit;
		 $files = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where  recycle = 1  limit 5", ARRAY_A);
			if($files){
			for ($i = 0; $i < count(  $files  ); $i++) {
			cdm_delete_file( $files[$i]['id'],true);				
			}
			}
			
			
			$xfiles = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where  recycle = 1 ", ARRAY_A);
			if(count($xfiles)>0 ){
			$json['rerun'] = 1;
			$json['total_items'] = count($xfiles).' Files Left';
			$json['message']  = 'Rerunning';
			echo json_encode($json);
			die();
			}
			
			
			
		
			
			
			
			
			
			
			$folders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle = 1 limit 5", ARRAY_A);	
			if($folders){
			for ($i = 0; $i < count(  $folders  ); $i++) {
			cdm_delete_folder( $folders[$i]['id'],true);				
			}
			}
			
		
			
				
		 	$xfolders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle = 1", ARRAY_A);	
		 	
			if( count($xfolders)>0){
			$json['rerun'] = 1;
			$json['total_items'] =  count($xfolders).' Folders Left';
			
			$json['message']  = 'Rerunning';
			echo json_encode($json);
			die();
				
			}
			
			
			$json['rerun'] = 0;
			$json['message']  = 'Emptied recycle bin!';
			sp_cdm_user_logs::write($json['message'] );
			echo json_encode($json);
		die();	
		}
		function restore_object(){
			global $wpdb;
			$json = array();
			$type = cdm_var('type');
			$id = cdm_var('id');
			
			$update['recycle'] = 0;
			$update['recycle_date'] = '';
			
			$where['id'] = $id;
			if($type == 'folder'){
				$this->restore_folder($id);
				
				$json['message'] = __('Folder Restored  from recycle bin!');
			}elseif($type == 'file'){
				$table = "" . $wpdb->prefix . "sp_cu";
				$wpdb->update($table , $update,$where);
				$json['message'] = __('Files Restored from recycle bin!');
			}
			sp_cdm_user_logs::write($json['message'] );
			echo json_encode($json);
		die();	
		}
		function delete_object(){
			global $wpdb;
			$json = array();
			$type = cdm_var('type');
			$id = cdm_var('id');
			
		
			if($type == 'folder'){
				cdm_delete_folder($id);
			
			$json['message'] = __('Folder Deleted  from recycle bin!');
			}elseif($type == 'file'){
				cdm_delete_file($id);
				$json['message'] = __('File Deleted  from recycle bin!');
			}
			sp_cdm_user_logs::write($json['message'] );
			echo json_encode($json);
		die();	
		}
		function view_recycled_item(){
			global $wpdb,$spcdm_ajax;
			
		
			
					
			$type = cdm_var('type');
			$id = cdm_var('id');
			if($type == 'file'){
				
			 $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where id = %d",$id), ARRAY_A);
			 
		echo '<div class="cdm-recycle-bin-menu"><a href="#" class="button cdm-recycle-function" data-type="file" data-id="'.$id.'" data-method="delete">'.__('Delete File Permanently','sp-cdm').'</a>    <a href="#" class="button cdm-recycle-function" data-type="file" data-id="'.$id.'" data-method="restore">'.__('Restore File','sp-cdm').'</a></div>
				
		
			';	
		echo '
		<div class="sp_su_project">	
	<strong>' . __("Recycled Date", "sp-cdm") . ': </strong> ' . date("F j, Y",strtotime($r[0]['recycle_date'])) . '	
	</div>
	<div class="sp_su_project">	
	<strong>' . __("Automatic Removal Date", "sp-cdm") . ': </strong>  ' . date("F j, Y",strtotime($r[0]['recycle_date'].'  + '.get_option('sp_cu_recycle_bin_retention',30).' days')) . '	
	</div>
		<div class="sp_su_project">	
	<strong>' . __("File Name", "sp-cdm") . ': </strong> ' . stripslashes($r[0]['name']) . '	
	</div>
	<div class="sp_su_project">
	' . date('F jS Y h:i A', strtotime($r[0]['date'])) . ' &bull; File ID: #' . $r[0]['id'] . ' 
	</div>
	<div class="sp_su_project">	
	<strong>' . __("File", "sp-cdm") . ': </strong> ' . stripslashes($r[0]['file']) . '	
	</div>';
	
			$owner = get_userdata( $r[0]['uid']); 
		echo '<div class="sp_su_project">
		
		<strong>' . __("File Owner", "sp-cdm") . ': </strong> '.apply_filters('sp_cdm/file/owner_name',$owner->display_name,$r[0]) .'
		
		
		</div>';		
		
	echo '<div class="sp_su_project">
	
	<strong>' .sp_cdm_folder_name()  . ' #'.$r[0]['uid'].': </strong>' . sp_cdm_get_project_name($r[0]['pid']) . '
	
	</div>
	<div style="text-align:center;padding:10px">'.$this->preview_image($r).'</div>
	';
	
			}else{				
			 $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id  = %d",$id), ARRAY_A);	
			
			echo '<div class="cdm-recycle-bin-menu"><a href="#" class="button cdm-recycle-function" data-type="folder" data-id="'.$id.'" data-method="delete">'.__('Delete Folder Permanently','sp-cdm').'</a>    <a href="#" class="button cdm-recycle-function" data-type="folder" data-id="'.$id.'" data-method="restore">'.__('Restore Folder','sp-cdm').'</a></div>
				
		
			';	
		echo '
		<div class="sp_su_project">	
	<strong>' . __("Recycled Date", "sp-cdm") . ': </strong> ' . stripslashes($r[0]['recycle_date']) . '	
	</div>
		<div class="sp_su_project">	
	<strong>' . __("Automatic Removal Date", "sp-cdm") . ': </strong>  ' . date("F j, Y",strtotime($r[0]['recycle_date'].'  + '.get_option('sp_cu_recycle_bin_retention',30).' days')) . '	
	</div>
		<div class="sp_su_project">	
	<strong>' . __("Folder Name", "sp-cdm") . ': </strong> ' . stripslashes($r[0]['name']) . '	
	</div>
	<div class="sp_su_project">	
	<strong>' . __("Folder Parent", "sp-cdm") . ': </strong> ' . stripslashes( sp_cdm_get_project_name($r[0]['parent'])) . '	
	</div>';
			
			}
			
			
		die();	
		}
		function top_menu($menu){
			
			$menu .='<li><a href="admin.php?page=sp-client-document-manager-recycle" >' . __("Recycle Bin", "sp-cdm") . '</a></li>';
			return $menu ;
		}
		function menu(){
			
		    add_menu_page( 'Recycle Bin', 'Recycle Bin', 'sp_cdm', 'sp-client-document-manager-recycle', array(
        $this,
        'view_recycle_bin'
    ),'dashicons-trash',4);
		
		}
		function view_recycle_bin(){
			
			  global $wpdb;
			  
			  
			  $retention_date = get_option('sp_cu_recycle_bin_retention',30);
		
		
		
			  echo '<div class="cdm-recycle-bin"><h2>Recycle Bin</h2><div class=cdm-recycle-bin-inner">   <div class="cdm-recycle-bin-menu">
			  <a href="#" class="button cdm-empty-recycle-bin">Empty Recycle Bin</a>    <a href="#" class="button cdm-restore-recycle-bin">Restore Everything</a>  <p><span>Files are currently kept for '. $retention_date.' days then removed automatically from the recycle bin. You can change the amount of days to keep files in advanced settings.</span></p>
			  <div class="cdm-recycle-bin-output"></div>
			  </div>' . sp_client_upload_nav_menu() . '';
			  $r_folders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where recycle = 1", ARRAY_A);
			  $r_files = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu   where recycle = 1", ARRAY_A);
       			
			   $folders_array = array();
			  
			  echo '<h3>Recycled Folders</h3>
			
			  ';
			 if($r_folders){
					echo '<div class="cdm-recycled-items">';
					
					for ($i = 0; $i < count( $r_folders ); $i++) {
						echo '
								<a href="#" class="cdm-recycled-item cdm-recycled-item-view cdm-recycled-item-folder" data-id="'.$r_folders[$i]['id'].'" data-type="folder"><span class="dashicons dashicons-portfolio"></span> '.$r_folders[$i]['name'].'</a>
							 
							 ';
							 
							 $folders_array[] = $r_folders[$i]['id'];
					}
					echo '<div style="clear:both"></div></div>';
				 
			 }else{
				echo '<p class="sp_cdm_error">No folders in recycle bin</p>';  
			 }
			 
			   echo '<h3>Recycled Files</h3>';
			 if( $r_files){
					echo '<div class="cdm-recycled-items">';
					for ($i = 0; $i < count(  $r_files ); $i++) {
						
						if(!in_array($r_files[$i]['pid'], $folders_array)){
						
						if($r_files[$i]['name'] == ''){
						$name = $r_files[$i]['file'];	
						}else{
						$name = $r_files[$i]['name'];	
						}
						echo '
								
								<a href="#" class="cdm-recycled-item cdm-recycled-item-view cdm-recycled-item-file" data-id="'. $r_files[$i]['id'].'" data-type="file"><span class="dashicons dashicons-admin-page"></span> '. $name.'</a>
							 
							';
						}
					}
					echo '<div style="clear:both"></div></div>';
				 
			 }else{
				echo '<p class="sp_cdm_error">No files in recycle bin</p>'; 
			 }
			 echo '</div></div>';
			  
			  
			  echo '<div style="display:none">
			  <div class="cdm-modal" data-remodal-options="{ \'hashTracking\': false }" data-remodal-id="recycle-bin-remove"> 
			   <a data-remodal-action="close" class="remodal-close"></a>
			<div class="recycle-bin-remove-content">
			
			</div>
			  </div>
			  ';
			  
			  echo '</div>';
		}
		function install(){
		global $wpdb;
		$alters = array();	
		
		$force_upgrades = (cdm_var('force_upgrades')) ? cdm_var('force_upgrades') : '';
	$check_cu = $wpdb->get_results("SHOW COLUMNS FROM `".$wpdb->prefix . "sp_cu`", ARRAY_A);
	$check_cu_project = $wpdb->get_results("SHOW COLUMNS FROM `".$wpdb->prefix . "sp_cu_project`", ARRAY_A);
  
  $columns = array();
  foreach($check_cu as $column){
	  
		$columns[] = $column['Field'];
		
		
  }
   $pcolumns = array(); 
 foreach($check_cu_project as $column){
	  
		$pcolumns[] = $column['Field'];
		
		
  }
  	
		
		
		if(!in_array('recycle',$columns)){
				global $wpdb;
				$alters[] =  'ALTER TABLE `'.$wpdb->prefix . 'sp_cu` ADD `recycle` INT(1) DEFAULT 0;';	
				$alters[] =  'ALTER TABLE `'.$wpdb->prefix . 'sp_cu` ADD `recycle_date` DATE;';	
				$alters[] =  'ALTER TABLE `'.$wpdb->prefix . 'sp_cu_project` ADD `recycle` INT(11) DEFAULT 0;';	
				$alters[] =  'ALTER TABLE `'.$wpdb->prefix . 'sp_cu_project` ADD `recycle_date` DATE;';
				foreach($alters as $alter){
					  $wpdb->query($alter);	
				}
			update_option('cdm_recycle_bin_install',$this->db_ver);	
			}
			
		if(!in_array('parent_base',$pcolumns)){	
		 $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "sp_cu_project` ADD `parent_base` INT( 11 ) NOT NULL DEFAULT '0'");
        update_option('cdm_projects_upgrade', 1);
		}
			
		}
		function run_cron(){
			
			
			$this->empty_reycle_bin_cron();
		}
		
		function empty_reycle_bin_cron(){
				global $wpdb,$current_user;
		if (sp_cdm_is_featured_disabled('base', 'cdm_recycle_bin') == false) {
		
		if ( is_user_logged_in() ) {
		$retention = get_option('sp_cu_recycle_bin_retention',30);
		$retention_removal = date("Y-m-d",strtotime('-'.$retention.' days'));
		if(get_transient('sp_cdm_recycle_bin_run') == false or get_option('cdm_rerun_recycler') == 1){
		
	
		
		
		 $folders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project where recycle_date <= '".$retention_removal."' AND recycle = 1 limit 50", ARRAY_A);	
			if($folders){
				for ($i = 0; $i < count(  $folders  ); $i++) {
				cdm_delete_folder( $folders[$i]['id']);				
				}
			}
		
	
	
		 $files = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu where recycle_date <= '".$retention_removal."' AND  recycle = 1  limit 50", ARRAY_A);

			if($files){
				for ($i = 0; $i < count(  $files  ); $i++) {
				cdm_delete_file( $files[$i]['id']);				
				}
			}
			set_transient('sp_cdm_recycle_bin_run', 1,DAY_IN_SECONDS ); 	
		}
		
		
		
		 $folders = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project where recycle_date <= '".$retention_removal."' AND recycle = 1", ARRAY_A);
		  $files = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "sp_cu where recycle_date <= '".$retention_removal."' AND  recycle = 1", ARRAY_A);	
			if(count($files)>0 or count($folders)>0){
			
			update_option('cdm_rerun_recycler',1);	
			}else{
			update_option('cdm_rerun_recycler',0);		
			}
		}
		}
		}
		function admin_settings(){
			
				echo '
				<tr><td colspan="2"><h2>Recycle Bin Settings</h2>
				<tr>

    <td width="300"><strong>Recycle bin rentention</strong><br><em>How many days to save the files before the system automatically deletes all the items in the recycle bin. Set to 0 to disable the recycle bin. Setting to 0 will automatically delete files and folders when you press the delete button.</em></td>

    <td><input type="text" name="sp_cu_recycle_bin_retention"  value="' . stripslashes(get_option('sp_cu_recycle_bin_retention',30)) . '"  size=80"> </td>

  </tr>';	
			
		}
		
		
		function restore_folder($project_id)
    {
        global $wpdb, $current_user;
		if ( !is_user_logged_in() ) 
exit; 
		
         $r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project   where id = %d ",$project_id), ARRAY_A);
     
	   
		#delete this projects files
						$f = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu where pid = %d ",$project_id), ARRAY_A);
							
							for ($j = 0; $j < count($f); $j++) {
								
								cdm_recycle('file',$f[$j]['id'],true);
								#$this->delete_file($f[$j]['id']);
								
								#$this->remove_cat($id);
							}
					
						#find and remove sub folders
						$p = $wpdb->get_results($wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "sp_cu_project where parent = %d ",$project_id), ARRAY_A);
						for ($i = 0; $i < count($p); $i++) {
							
							$this->restore_folder($p[$i]['id']);
							#cdm_recycle('folder',$p[$i]['id'],true);
						}
					#delete the project
					#sp_cdm_user_logs::write('Recycled folder: '.$r[0]['name'].'');
					#$wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "sp_cu_project WHERE id = %d",$project_id ));							
						
				cdm_recycle('folder',$project_id,true);
    }
		
	
	function preview_image($r){
	
	
	   if ($ext == 'png' or $ext == 'jpg' or $ext = 'jpeg' or $ext = 'gif') {
            $icon = '<td width="160"><img src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '" width="150"></td>';
        } else {
            $icon = '';
        }
        $ext        = preg_replace('/^.*\./', '', $r[0]['file']);
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
                $img = '<img src="' . sp_cdm_thumbnail('' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'] . NULL, 250) . '">';
            }
			
			
		 } elseif (strtolower($ext) == 'mp4') {
	$img = '<div style="width:100%" class="wp-video">
		<!--[if lt IE 9]><script>document.createElement(\'video\');</script><![endif]-->
		<video %s controls="controls" class="wp-video-shortcode" preload="metadata" style="width:100%">
		<source type="video/mp4" src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'].'" />
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
            if (file_exists('' . SP_CDM_UPLOADS_DIR . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '_big.png')) {
                $img = '<img src="' . SP_CDM_UPLOADS_DIR_URL . '' . $r[0]['uid'] . '/' . $r[0]['file'] . '_big.png" width="250">';
            } else {
                $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png">';
            }
        } elseif ($ext == 'pdf' or $ext == 'xod') {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/adobe.png">';
        } else {
            $img = '<img src="' . SP_CDM_PLUGIN_URL . 'images/package_labled.png">';
        }
		
		$img = apply_filters('sp_cdm_viewfile_image', $img,$r[0]);
		
		return $img;
		
		
	}
	
}