if(!(window.console && console.log)) {
  console = {
    log: function(){},
    debug: function(){},
    info: function(){},
    warn: function(){},
    error: function(){}
  };
}
	
function cdm_update_projects_dropdown(){
	
	
	
	jQuery.post(sp_vars.ajax_url, {action: "cdm_update_projects_dropdown"}, function(msg){
				
				console.log(msg);
				console.log('replacing selects');
				jQuery(".pid_select").empty();
				jQuery(".pid_select").html(msg);
				
		});
	
}
	
jQuery( document ).ready(function($) {
	
			console.log(jQuery.cookie("pid"));
		if(sp_vars.sp_cu_user_projects_required == 1 && (jQuery.cookie("pid") == 0 || jQuery.cookie("pid") == null)){
			
			$('.sp_cdm_add_file').hide();
		}
	
	

	
	
	

		$( document ).on( "click", ".sp-cdm-search-button", function() {
			cdm_ajax_search();
			return false;
		});
		
		
		$('#search_files').keypress(function (e) {
		  if (e.which == 13) {
			cdm_ajax_search();
			return false;    //<---- Add this line
		  }
		});
		
		

	
	
		$( document ).on( "click", ".sp_cdm_open_modal", function() {
		
		
		var inst = $('[data-remodal-id='+$(this).attr('data-modal')+']').remodal();
		inst.open();
			console.log('Opened ' + $(this).attr('data-modal'));		
		
		return false;
	});
	
	// edit a folder
	$( document ).on( "click", ".sp-cdm-save-category", function() {
			
			var id = jQuery(this).attr('data-id');
					
			if(jQuery("#edit_project_name_" + id).val() == ""){
			alert("Please enter a project name");
	
			}else{
			
			
				jQuery.post(sp_vars.ajax_url, {action: "cdm_save_category", name: jQuery("#edit_project_name_" + id).val(), id: id}, function(response){
										cdm_ajax_search();
		
					jQuery("#edit_category").dialog("close");
					cdm_update_projects_dropdown();
					alert(response);	
				})
			
			}
			
			return false;
			
		});
		
		
		// Delete a folder
		$( document ).on( "click", ".sp-cdm-delete-category", function() {
			var id = jQuery(this).attr('data-id');
			
			jQuery( "#delete_category_" + id ).dialog({

			resizable: false,

			height:240,

			width:440,

			modal: true,

			buttons: {

				"Delete all items": function() {

							jQuery.post(sp_vars.ajax_url, {action: "cdm_remove_category", id: id}, function(response){
								jQuery.cookie("pid", 0, { expires: 7 , path:"/" }); 
								cdm_ajax_search();
							})

					 

					jQuery( this ).dialog( "close" );	

						

				},

				Cancel: function() {

					jQuery( this ).dialog( "close" );

				}

			}

		});

			
		return false;	
			
		});
		
		
});
				


	
	function cdm_download_file(id){
		jQuery.get(sp_vars.ajax_url, {action: "cdm_download_file", fid:id}, function(response){
			
		});
		return false;
	}
	function cdm_download_project(id,nonce){
		
			window.location.href = sp_vars.ajax_url +"?action=cdm_download_project&nonce=" + nonce + "&id="+ id;
		
			
				return false;
	}

	function cdmOpenModal(name){
				jQuery(".cdm-modal").remodal({ hashTracking: false});	
			  var inst = jQuery.remodal.lookup[jQuery("[data-remodal-id=" + name + "]").data("remodal")];
				inst.open();	
				
	}
			function cdmCloseModal(name){
				jQuery(".cdm-modal").remodal({ hashTracking: false});	
			  var inst = jQuery.remodal.lookup[jQuery("[data-remodal-id=" + name + "]").data("remodal")];
			
				inst.close();	
				
			}
			
			function cdmRefreshFile(file){
				
					jQuery(".view-file-content").empty();
				
				jQuery.get(sp_vars.ajax_url, {action: "cdm_view_file", id: file}, function(response){
						jQuery(".view-file-content").html(response);
				})		
				
			}
			function cdmViewFile(file){
				
				jQuery(".view-file-content").empty();
				
				jQuery.get(sp_vars.ajax_url, {action: "cdm_view_file", id: file}, function(response){
						jQuery(".view-file-content").html(response);
						 jQuery(".cdm-modal").remodal({ hashTracking: false});	
						 var inst = jQuery.remodal.lookup[jQuery("[data-remodal-id=file]").data("remodal")];
						 inst.open();
				})
			 
						 		
		
		}
		
		
jQuery(document).on('closed', ".cdm-modal", function (e) {

jQuery.cookie("viewfile_tab", 0, { expires: 7 , path:"/" }); 	
 
});

		function sp_cu_add_project(){
		
			
				jQuery.post(sp_vars.ajax_url, {action: "cdm_save_category", name: jQuery("#sub_category_name").val(), uid: jQuery("#sub_category_uid").val(),parent: jQuery(".cdm_premium_pid_field").val()}, function(response){
						 cdmCloseModal("folder");
						 cdm_ajax_search();
										cdm_update_projects_dropdown();
		
				})				
		
			
		
		}




function cdm_refresh_file_view(fid){
	jQuery(".view-file-content").empty();
	
	 jQuery.get(sp_vars.ajax_url, {action: "cdm_view_file", id: fid}, function(response){
						jQuery(".view-file-content").html(response);
	})	
	 
	
}

function cdm_check_file_perms(pid){
			
		
		jQuery.post(sp_vars.ajax_url, {action: "cdm_file_permissions", pid:pid}, function(msg){
					
					if(msg == 1){
						
					if(sp_vars.sp_cu_user_projects_required == 1 && (jQuery.cookie("pid") == 0 || jQuery.cookie("pid") == null)){
					jQuery('.hide_add_file_permission').hide();	
					}else{
						jQuery('.hide_add_file_permission').show();	
					}
						
					
					}else{
					jQuery('.hide_add_file_permission').hide();		
					}	
		});
				
	
}

function cdm_check_folder_perms(pid){
			
			
		jQuery.post(sp_vars.ajax_url, {action: "cdm_file_permissions", pid:pid}, function(msg){
					
					if(msg == 1){
					jQuery('.hide_add_folder_permission').show();	
					}else{
					jQuery('.hide_add_folder_permission').hide();		
					}	
		});
		



jQuery.event.trigger({
	type: "cdm_check_folder_perms",
	pid: pid
});		
	
}


function sp_cu_reload_all_projects(context_folder_pid){
	

		
		jQuery.post(sp_vars.ajax_url, {action: "cdm_project_dropdown", pid:ontext_folder_pid}, function(msg){
					
					jQuery('.pid_select').html(msg);		
		});
		


		
	
}

function sp_cu_confirm_delete(div,h,file_id){

		
if(jQuery(window).width()*0.9< 768){
	var width = jQuery(window).width()*0.9;	
	}else{
		var width = 320;
	}

	var NewDialog = jQuery('<div id="sp_cu_confirm_delete"> ' + div + '</div>');

	

	jQuery(  NewDialog ).dialog({

			width:width,

			height:'auto',

			modal: true,

			buttons: {

				"Yes": function() {

				
					jQuery.post(sp_vars.ajax_url, {action: "cdm_delete_file", file_id:file_id}, function(response){
						
				cdmCloseModal('file');
				jQuery( NewDialog ).remove();
				 cdm_ajax_search();
				});
				

				

				},

				Cancel: function() {

					jQuery( NewDialog ).remove();

				}

			}

		});

	

}







function sp_cu_confirm(div,h,url){

	
if(jQuery(window).width()*0.9< 768){
	var width = jQuery(window).width()*0.9;	
	}else{
		var width = 320;
	}
	jQuery(  div ).dialog({

			width:width,

			height:'auto',

			modal: true,

			buttons: {

				"Yes": function() {

					window.location = url;

				},

				Cancel: function() {

					jQuery( this ).dialog( "close" );

				}

			}

		});

	

}



function sp_cu_dialog(div,w,h){

	
	
	
	if(jQuery(window).width()*0.9< 768){
	var width = jQuery(window).width()*0.9;	
	}else{
		var width = w;
	}
	var dialogBox = jQuery(div);
     var usableDialog = dialogBox[0];
      //jQuery("div.ui-dialog").remove();
            
	
	
	jQuery(usableDialog).dialog({

			height:'auto',

			width:width

	});

}

/*
jQuery(document).ready(function() {
//  jQuery("#cdm_upload_table tr:first").css("display", "none");
jQuery("#cdm_og").attr("checked","checked");
   
setInterval(function(){cdmPremiumReValidate();},1000);

});
*/

function cdm_disable_uploads(){
	
	jQuery(".sp_cdm_add_file").hide();
	jQuery(".sp_cdm_add_folder").hide();
	
}

function cdm_enable_uploads(){
	
	jQuery(".sp_cdm_add_file").hide();
	jQuery(".sp_cdm_add_folder").hide();
	
}
jQuery(document).ready(function($) {

	
	
	jQuery( document ).on( "click", ".cdm_refresh_file_view", function() {
		cdm_refresh_file_view(jQuery(this).attr('data-id'));
		
		return false;
	});
	
	

jQuery( ".cdm_button" ).button();


jQuery.ajaxSetup({ cache: false });



//add another file input when one is selected

var max = 20;

var replaceMe = function(){

	var obj = jQuery(this);

	if(jQuery("#cdm_upload_fields input[type='file']").length > max)

	{

		alert('fail');

		obj.val("");

		return false;

	}

	jQuery(obj).css({'position':'absolute','left':'-9999px','display':'none'}).parent().prepend('<input type="file" name="'+obj.attr('name')+'"/>')
	
	var text = obj.val();
	var text = text.substring(text.lastIndexOf("\\") + 1, text.length);
	
	jQuery('#upload_list').append('<div class="sp_upload_div"><span class="sp_upload_name">'+ text+'</span><span class="dashicons dashicons-trash cdm-community-remove-queue"></span><div>');

	jQuery("#cdm_upload_fields input[type='file']").change(replaceMe);

	jQuery("#cdm_upload_fields .cdm-community-remove-queue").click(function(){

		jQuery(this).parent().remove();

		jQuery(obj).remove();

		return false;

		

		

	});

}

jQuery("#cdm_upload_fields input[type='file']").change(replaceMe);















        jQuery('a.su_ajax').click(function() {

            var url = this.href;

            // show a spinner or something via css

            var dialog = jQuery('<div style="display:none" class="loading"></div>').appendTo('body');

            // open the dialog

            dialog.dialog({

                // add a close listener to prevent adding multiple divs to the document

                close: function(event, ui) {

                    // remove div with all data and events

                    dialog.remove();

                },

                modal: true,

				title: jQuery(this).attr('title'),

				height:'auto',

				width:700

            });

            // load remote content

            dialog.load(

                url, 

                {}, // omit this param object to issue a GET request instead a POST request, otherwise you may provide post parameters within the object

                function (responseText, textStatus, XMLHttpRequest) {

                    // remove the loading class

                    dialog.removeClass('loading');

                }

            );

            //prevent the browser to follow the link

            return false;

        });



});










