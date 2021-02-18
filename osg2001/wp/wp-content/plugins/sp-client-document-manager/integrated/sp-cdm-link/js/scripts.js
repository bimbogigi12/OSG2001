
function sp_cdm_link_go(url){
	 window.open(url,'_blank');

}

jQuery( document ).ready(function($) {
	
	
	
	
	
	//load edit form
		$( document ).on( "submit", "#cdm_embed_link", function() {
		
					
			
			$.ajax({					
				type: "POST",
				url: sp_cdm_link.ajax,
				data:$(this).serialize(),		
				success: function (msg) { 
				   var obj = jQuery.parseJSON(msg);
				   
				   if(obj.success == 1){
					 
					 
					 
					 
					 cdmCloseModal('add-link');	
					    $('#cdm_embed_link')[0].reset();
						cdmViewFile(obj.file_id);
						cdm_ajax_search();
						cdmViewFile(obj.file_id);   
					   
				   }
				   
				}
		
			});
			return false;
		});
		
	
});