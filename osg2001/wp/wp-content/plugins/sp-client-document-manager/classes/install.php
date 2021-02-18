<?php

$sp_cdm_installer = new sp_cdm_installer;
register_activation_hook(''.SP_CDM_PLUGIN_DIR.'cu.php', array($sp_cdm_installer,'install') );
add_action('plugins_loaded',  array($sp_cdm_installer,'upgrade_check') );
add_action('init',  array($sp_cdm_installer,'check_caps') );
if(cdm_var('force_upgrade') == 1){
add_action('plugins_loaded',  array($sp_cdm_installer,'install') );	
}

add_action( 'init', array($sp_cdm_installer,'sp_cdm_premium_upgrades') );	
add_action('admin_init',  array($sp_cdm_installer,'sp_cdm_check_admin_caps'));
add_action('admin_bar_menu',array($sp_cdm_installer,'admin_bar'), 100);
	add_action('init',array($sp_cdm_installer,'sp_client_upload_upgrader'));

class sp_cdm_installer{
	
	
	

function sp_client_upload_upgrader(){
	global $wpdb;
   global  $sp_client_upload_premium;
  
   $tables = array();
   $check_cu_project = $wpdb->get_results("SHOW COLUMNS FROM `".$wpdb->prefix . "sp_cu_project`", ARRAY_A);

  
  $columns = array();
  foreach($check_cu_project as $column){
	  
		$columns[] = $column['Field'];
		
		
  }
  
  	if(!in_array('default_order',$columns)){
		$query = "ALTER TABLE `".$wpdb->prefix."sp_cu_project` ADD `default_order`  INT( 11 ) NOT NULL DEFAULT 0;";
		$wpdb->query($query); 	

	}
	
	
	
  $check_cu = $wpdb->get_results("SHOW COLUMNS FROM `".$wpdb->prefix . "sp_cu`", ARRAY_A);
  $columns_cu_ar = array();
  foreach($check_cu as $column_cu){
	  
		$columns_cu_ar[] = $column_cu['Field'];
		
		
  }



	if(!in_array('file_size',$columns_cu_ar)){
			$wpdb->query('ALTER TABLE `'.$wpdb->prefix.'sp_cu` ADD `file_size` VARCHAR(255);'); 
				
	}
	
	

	
	
   
}
	
	
	
	function admin_bar($admin_bar){
		global $wpdb,$current_user,$post;
		if(current_user_can('sp_cdm')){
		
		$admin_bar->add_menu( array(
		'id'    => 'document-dashboard',
		'title' => '<span class="ab-icon"></span><span class="ab-label">'.__('Documents Dashboard','sp-cdm').'</span>',
		'href'  => get_admin_url().'admin.php?page=sp-client-document-manager',	
		'meta'  => array(
			'title' => __('Document Dashboard',"sp-cdm"),			
		),
		));
		
		//Settings
		if(current_user_can('sp_cdm_settings')){
		$admin_bar->add_menu( array(
		'id'    => 'cdm-settings',
		'parent' => 'document-dashboard',
		'title' => '<span class="ab-icon"></span><span class="ab-label">'.__('Settings','sp-wpfh').'</span>',
		'href'  => get_admin_url().'admin.php?page=sp-client-document-manager-settings',	
		'meta'  => array(
			'title' => __('Settings',"sp-cdm"),			
		),
		));
		}
		if(current_user_can('sp_cdm_uploader')){
		$admin_bar->add_menu( array(
		'id'    => 'document-uploader',
		'title' => '<span class="ab-icon"></span><span class="ab-label">'.__('Admin Uploader','sp-cdm').'</span>',
		'href'  => get_admin_url().'admin.php?page=sp-client-document-manager-fileview',	
		'meta'  => array(
			'title' => __('Document Uploader',"sp-cdm"),			
		),
		));
		}
		}
		do_action('cdm/admin_bar');
		

	}

function sp_cdm_check_admin_caps(){
	global $current_user;
	

	
	if($current_user != ''){
	
	@require_once(ABSPATH . 'wp-includes/pluggable.php');
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm') ) {
		$role = get_role( 'administrator' );
		$role->add_cap( 'sp_cdm' );	
		$role->add_cap( 'sp_cdm_vendors' );	
		$role->add_cap( 'sp_cdm_settings' );	
		$role->add_cap( 'sp_cdm_projects' );	
		$role->add_cap( 'sp_cdm_uploader' );
	
}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_help') ) {$role = get_role( 'administrator' ); $role->add_cap( 'sp_cdm_help' );}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_forms') ) {$role = get_role( 'administrator' ); $role->add_cap( 'sp_cdm_forms' );}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_groups') ) {$role = get_role( 'administrator' );  $role->add_cap( 'sp_cdm_groups' );}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_categories') ) {$role = get_role( 'administrator' ); $role->add_cap( 'sp_cdm_categories' );}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_top_menu') ) {$role = get_role( 'administrator' ); $role->add_cap( 'sp_cdm_top_menu' );}
if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_show_folders_as_nav') ) {$role = get_role( 'administrator' ); $role->add_cap( 'sp_cdm_show_folders_as_nav' );}
	}
}


		
	
	
function sp_cdm_premium_upgrades(){
	
	   global $wpdb;
	   $upgrade_count =0;
	   $upgrade_count += 0;
		$updated = '';
  		$table_name = "".$wpdb->prefix . "sp_cu_meta";
		 if($wpdb->get_var("show tables like '$table_name'") != $table_name){			
			$sql_meta = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
			  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			  `fid` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `pid` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `uid` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `meta_key` varchar(255) DEFAULT NULL,
			  `meta_value` longtext,
			  PRIMARY KEY (`id`)
			);" ;
			
			$upgrade_count +=1;
			  
		 }	
	
	apply_filters('sp_cdm_premium_upgrades',$upgrade_count);
	
	
	if(cdm_var('database_upgrade')){
	$database_upgrade = 1;	
	}else{
	$database_upgrade = 0;		
	}
	if($database_upgrade == 1 or  $upgrade_count >0){
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql_meta );
	

	
	$updated = 1;
	}
	if($updated != 1){
	if($upgrade_count > 0){

	}
	}
	
}
	
function install(){
	global $wpdb,$sp_client_upload;
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 
  
  
  	//create upload directories
   	$dir = SP_CDM_UPLOADS_DIR;
	$cdm_upload_dir =  wp_upload_dir();
	
	if(!is_dir($cdm_upload_dir['basedir'])){
	
		@mkdir($cdm_upload_dir['basedir'], 0777);
	}
	
	if(!is_dir($dir)){
	
		@mkdir($dir, 0777);
	}
	
	//install the tables
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	$tables = $this->db_tables();
	foreach($tables as $key => $value){
		  if($value != ""){
		  dbDelta($value);			
		  }
	}
	

		do_action('sp_cdm_install');
	
		if ( get_option( 'sp_client_upload') == '') {
		  add_option("sp_client_upload", $sp_client_upload);
		  add_option("sp_client_upload_page", 'Please enter the page');
		
		}else{
		update_option("sp_client_upload", $sp_client_upload);
		}
	}
	
	function upgrade_check(){
		
	global $wpdb,$sp_client_upload;
	
	$alters = $this->db_alters();
		if(count($alters) >0){
			foreach( $alters as $key => $value){
				  if($value != ""){
				  $wpdb->query($value);
				  }
			}
		do_action('sp_cdm_upgrade_check');
		update_option("sp_client_upload", $sp_client_upload);
		}
		  
	
		
	}
function check_caps(){
global 	$current_user;
$alters = array();
	@require_once(ABSPATH . 'wp-includes/pluggable.php');
if (  user_can(@$current_user->ID,'manage_options') && !current_user_can('sp_cdm') ) {
	
		$role = get_role( 'administrator' );
		$role->add_cap( 'sp_cdm' );	
		$role->add_cap( 'sp_cdm_vendors' );	
		$role->add_cap( 'sp_cdm_settings' );	
		$role->add_cap( 'sp_cdm_projects' );	
		$role->add_cap( 'sp_cdm_uploader' );
		
}
	do_action('sp_cdm_check_caps');
}
	
	function db_alters(){
		global $wpdb,$sp_client_upload;
		$alters = array();
		$cur_sp_client_upload  =	 get_option( 'sp_client_upload');
			
		if($cur_sp_client_upload < '1.2.1' ){
			$alters[] = 'ALTER TABLE `'.$wpdb->prefix . 'sp_cu` ADD `cid` INT( 11 ) NOT NULL;';
 		}	
		if($cur_sp_client_upload < '1.2.3' ){
			$alters[] =  'ALTER TABLE `'.$wpdb->prefix . 'sp_cu` ADD `tags` text NOT NULL;';
 		}
		if($cur_sp_client_upload < '1.2.7' ){
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `parent` INT( 11 ) NOT NULL DEFAULT '0'";	
		}
		if($cur_sp_client_upload < '1.2.8' ){
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_groups` ADD `locked` INT( 1 ) NOT NULL DEFAULT '0'";	
		}
		if($cur_sp_client_upload < '2.0.5' ){
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `parent` INT( 11 ) NOT NULL DEFAULT '0'";	
		}
		if($cur_sp_client_upload < '2.0.6' ){
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `permissions` TEXT ";	
		}
	
		if($cur_sp_client_upload < '2.5.2' ){
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `status` INT( 11 ) NOT NULL;";	
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `form_id` INT( 11 ) NOT NULL; ";
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `group_id` INT( 11 ) NOT NULL; ";
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu_project` ADD `client_id` INT( 11 ) NOT NULL; ";
			
				$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu` ADD `status` INT( 11 ) NOT NULL;";	
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu` ADD `form_id` INT( 11 ) NOT NULL; ";
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu` ADD `group_id` INT( 11 ) NOT NULL; ";
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu` ADD `client_id` INT( 11 ) NOT NULL; ";
			$alters[] = "ALTER TABLE `".$wpdb->prefix ."sp_cu` ADD `entry_id` INT( 11 ) NOT NULL; ";
		}
		
		return $alters;
	
	}
	
	
	
	
	
	function db_tables(){
global $wpdb,$sp_client_upload;
	$db_tables = array(	"".$wpdb->prefix ."sp_cu" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `file` varchar(255) NOT NULL,
					  `notes` text NOT NULL,
					  `tags` text NOT NULL,
					  `uid` int(11) NOT NULL,
					  `cid` int(11) NOT NULL,
					  `pid` int(11) NOT NULL,
					  `parent` int(11) NOT NULL,
					  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  `status` int(11) NOT NULL,
					  `form_id` int(11) NOT NULL,
					  `entry_id` int(11) NOT NULL,
					  `group_id` int(11) NOT NULL,
					  `client_id` int(11) NOT NULL,
					  `recycle` INT(1) DEFAULT 0,
					  `recycle_date` DATE,
					  PRIMARY KEY (`id`)
						) ;",
						
						
						

						
						
						"".$wpdb->prefix ."sp_cu_cats" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_cats` (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `cat_limit` INT( 11 ) NOT NULL  DEFAULT '0',
					  `cat_limit_type` INT( 11 ) NOT NULL  DEFAULT '0',					  
					  PRIMARY KEY (`id`)
						);",
						"".$wpdb->prefix ."sp_cu_forms" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_forms` (
					   `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `template` text NOT NULL,
					  `type` varchar(255) NOT NULL,
					  `defaults` text NOT NULL,
					  `sort` int(11) NOT NULL DEFAULT '0',
					  `required` varchar(11) NOT NULL DEFAULT 'No',
					  PRIMARY KEY (`id`)
					);",
					"".$wpdb->prefix ."sp_cu_form_entries" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_form_entries` (
					   `id` int(11) NOT NULL AUTO_INCREMENT,
					  `uid` int(11) NOT NULL,
					  `fid` int(11) NOT NULL,
					  `value` varchar(255) NOT NULL,
					  `file_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					);",
					"".$wpdb->prefix ."sp_cu_groups" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_groups` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `locked` int(1) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`id`)
					);",
					"".$wpdb->prefix ."sp_cu_groups_assign" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_groups_assign` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `gid` int(11) NOT NULL,
					  `uid` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					);",
					"".$wpdb->prefix ."sp_cu_project" => 
						"CREATE TABLE IF NOT EXISTS `".$wpdb->prefix ."sp_cu_project` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `uid` int(11) NOT NULL,
					  `parent` int(11) NOT NULL DEFAULT '0',
					  `cat_limit` int(11) NOT NULL DEFAULT '0',
					  `parent_base` int(11) NOT NULL DEFAULT '0',
					   `inherit_permissions` int(1) NOT NULL DEFAULT '0',
					   `default_order` int(11) NOT NULL DEFAULT '0',
					   `hide` INT( 1 ) NOT NULL DEFAULT '0',
					   `recycle` INT(11) DEFAULT 0,
					   `recycle_date` DATE,
					    `user_only` int(1) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`id`)
					);"
						);
						
						
				
						
						
return $db_tables;
	}

	
	
	
	
}

?>