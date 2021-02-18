<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$spcdm_ajax = new spdm_ajax;	
$spcdm_ajax_wrapper = new sp_cdm_ajax_wrapper;	


add_action('plugins_loaded', array($spcdm_ajax_wrapper, 'init'));

class sp_cdm_ajax_wrapper{
		
		function init(){
			if ( ! did_action( 'init' ) ) {
add_action( 'wp_ajax_cdm_file_permissions', array($this, 'file_permissions'));
add_action( 'wp_ajax_nopriv_cdm_file_permissions',array($this, 'file_permissions'));

add_action( 'wp_ajax_cdm_folder_permissions', array($this, 'folder_permissions'));
add_action( 'wp_ajax_nopriv_cdm_folder_permissions',array($this, 'folder_permissions'));

add_action( 'wp_ajax_cdm_project_dropdown', array($this, 'project_dropdown'));
add_action( 'wp_ajax_nopriv_cdm_project_dropdown',array($this, 'project_dropdown'));

add_action( 'wp_ajax_cdm_delete_file', array($this, 'delete_file'));
add_action( 'wp_ajax_nopriv_cdm_delete_file',array($this, 'delete_file'));

add_action( 'wp_ajax_cdm_file_info', array($this, 'file_info'));
add_action( 'wp_ajax_nopriv_cdm_file_info',array($this, 'file_info'));

add_action( 'wp_ajax_cdm_remove_category', array($this, 'remove_category'));
add_action( 'wp_ajax_nopriv_cdm_remove_category',array($this, 'remove_category'));

add_action( 'wp_ajax_cdm_save_category', array($this, 'save_category'));
add_action( 'wp_ajax_nopriv_cdm_save_category',array($this, 'save_category'));

add_action( 'wp_ajax_cdm_view_file', array($this, 'view_file'));
add_action( 'wp_ajax_nopriv_cdm_view_file',array($this, 'view_file'));

add_action( 'wp_ajax_cdm_file_list', array($this, 'file_list'));
add_action( 'wp_ajax_nopriv_cdm_file_list',array($this, 'file_list'));

add_action( 'wp_ajax_cdm_thumbnails', array($this, 'thumbnails'));
add_action( 'wp_ajax_nopriv_cdm_thumbnails',array($this, 'thumbnails'));

add_action( 'wp_ajax_cdm_email_vendor', array($this, 'email_vendor'));



add_action( 'wp_ajax_cdm_add_breadcrumb', array($this, 'add_breadcrumb'));
add_action( 'wp_ajax_nopriv_cdm_add_breadcrumb',array($this, 'add_breadcrumb'));	
			}
		}
		
		
		function add_breadcrumb(){
			
			global $spcdm_ajax, $spdm_sub_projects_new;
			
			echo   $spdm_sub_projects_new->getBreadCrumb();
			die();
		
		}
		function file_permissions(){
			global $spcdm_ajax;
			
				echo cdm_file_permissions(intval(cdm_var('pid') ));
				
				die();
		}
		
		function folder_permissions(){
			global $spcdm_ajax;
			
			echo cdm_folder_permissions(intval(cdm_var('pid') ));
			die();
			
		}
		function project_dropdown(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->project_dropdown();
			die();
		}
		
		function delete_file(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->delete_file();	
			die();
		}
		function file_info(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->get_file_info();	
			die();
		}
	
		function remove_category(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->remove_cat(intval(cdm_var('id')));
			die();
		}
		function save_category(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->save_cat(intval(cdm_var('uid') ));
			die();
		}
		function view_file(){
			global $spcdm_ajax,$wpdb, $current_user;
		
			echo $spcdm_ajax->view_file();	
				
			die();
		}
		function file_list(){
			global $spcdm_ajax;
			
		if(get_option('sp_cdm_use_old_file_list') != 1){
		$file_list = 	new cdm_community_file_list;
		$file_list->view();
		}else{
			echo $spcdm_ajax->file_list();	
		}
			die();
			
		}
		function thumbnails(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->thumbnails();		
			die();
		}
	
		function email_vendor(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->email_vendor();					
			die();
		}	
		function project_name(){
			global $spcdm_ajax;
			
			echo $spcdm_ajax->email_vendor();					
			die();
		}
	}
	
	