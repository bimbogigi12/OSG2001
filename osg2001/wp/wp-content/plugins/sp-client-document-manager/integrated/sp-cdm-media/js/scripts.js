jQuery( document ).ready(function($) {
	
	
	
	$(document).on('close', '.remodal', function (e) {
   
   	$('.sp_cdm_video_holder').remove();
});
	
	
	
	//load edit form
		$( document ).on( "submit", "#cdm_embed_media", function() {
		
					
			
			$.ajax({					
				type: "POST",
				url: sp_cdm_media.ajax,
				data:$(this).serialize(),		
				success: function (msg) { 
				   var obj = jQuery.parseJSON(msg);
				   
				   if(obj.success == 1){
					 
					 
					 cdmCloseModal('add-embed');	
					    $('#cdm_embed_media')[0].reset();
						cdmViewFile(obj.file_id);
						cdm_ajax_search();
						cdmViewFile(obj.file_id);   
					   
				   }
				   
				}
		
			});
			return false;
		});
		
	
});