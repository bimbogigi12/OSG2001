function sp_cdm_local_import_start(){
	
		
					
					
						jQuery.ajax({					
						type: "POST",
						url: ajaxurl,
						data: {			'action': 'sp_cdm_import_start_import', 
										'path' :  jQuery('.sp-cdm-import-check-files-location').val(),	
										'uid' :  jQuery('.sp-cdm-import-assign').val(),
										'pid' :  jQuery('.pid_select').val()	
								},
						success: function (msg) { 
							
							
							if(msg == 'Done'){
							jQuery('.sp-cdm-check-files-view').append('Done');
							jQuery('.sp-cdm-start-import').prop('disabled',false);	
							  return false;
							}else{
							
							jQuery('.sp-cdm-check-files-view').prepend(msg);
							sp_cdm_local_import_start();
							}
							
							
						}		
						});	
	
}


jQuery( document ).ready(function($) {
	
	
			$(document).on('click', '.sp-cdm-import-check-files', function () {
						
						
						$.ajax({					
						type: "POST",
						url: ajaxurl,
						data: {'action': 'sp_cdm_import_check_files', 'path' :  $('.sp-cdm-import-check-files-location').val() },		
						success: function (msg) { 
							
							$('.sp-cdm-check-files-view').html(msg);
							
						}		
						});	
						
						return false;	
				 });
			
				$(document).on('change', '.sp-cdm-import-assign', function () {
						
						var user_id = $(this).val();
					 
						$.ajax({					
						type: "POST",
						url: ajaxurl,
						data: {'action': 'sp_cdm_import_show_folders', 'user_id' : user_id },		
						success: function (msg) { 
							
							$('.sp-cdm-import-folders').html(msg);
							
						}		
						});		
				 });
				 
				$(document).on('click', '.sp-cdm-start-import', function () {
						
						
				   $('.sp-cdm-start-import').prop('disabled',true);
		
			jQuery.ajax({					
						type: "POST",
						url: ajaxurl,
						data: {			'action': 'sp_cdm_import_reset_session'
								},
						success: function (msg) { 
							
							sp_cdm_local_import_start();
						}		
						});	
	
						
						
						
						
						return false;	
				 });
			
	
	
});