<?php

		$cdm_virtual_directory_admin = new cdm_virtual_directory_admin;
   
	
	
	add_action('cdm_virtual_directory_admin', array($sp_cdm_premium_projects, 'cdm_virtual_directory_admin'));
	
	
	
class cdm_virtual_directory_admin{
	
	
	
		function menu(){
					add_submenu_page('sp-client-document-manager',__(sprintf('Sort %s', sp_cdm_folder_name(1)),'sp-cdm'),__(sprintf('Sort %s', sp_cdm_folder_name(1)),'sp-cdm'), 'sp_cdm_projects', 'sp-client-document-manager-projects-sort', array(
				   	$this,
					'view_sortable'
				));
				
				
			}
			
	
	function view(){
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
}