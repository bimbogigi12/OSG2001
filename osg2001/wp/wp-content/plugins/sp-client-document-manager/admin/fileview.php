<?php
class sp_cdm_fileview {
	


function __construct(){
	
	
	add_action('sp_cdm/enqueue_scripts', array($this,'scripts'));
}
function scripts(){

	if(cdm_var('page') == 'sp-client-document-manager-fileview'){
	wp_enqueue_script('select2',  plugins_url( 'js/select2/select2.min.js', dirname(__FILE__) ));	
	wp_enqueue_style('select2', plugins_url( 'js/select2/select2.min.css', dirname(__FILE__) ));	
	
	}
}
function view(){
	
		global $wpdb;
	
	echo '
	
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("select").select2();
	
		
		
		
	});
	</script>
	';
	
	$dropdown =  '
	
	
	<h2>'.__("User Files","sp-cdm").'</h2>'.sp_client_upload_nav_menu().''.__("Choose a user below to view their files","sp-cdm").'<p>
	<div style="margin-top:20px;margin-bottom:20px">
	<script type="text/javascript">
	jQuery(document).ready(function() {

	jQuery("#user_uid").change(function() {
		jQuery.cookie("pid", 0, { expires: 7 , path:"/" });
		jQuery.cookie("uid", jQuery("#user_uid").val(), { expires: 7 , path:"/" });
	window.location = "admin.php?page=sp-client-document-manager-fileview&id=" + jQuery("#user_uid").val();
	
	
	})
	});
	</script>
	<form>';
	$dropdown .= 	wp_dropdown_users(array('name' => 'user_uid', 'show_option_none' => 'Choose a user', 'selected'=>sanitize_text_field(cdm_var('id')),'echo'=>false));
	 
	$dropdown .=  '</form></div>';

	echo apply_filters('sp_cdm/admin/fileview/dropdown', $dropdown);
		if(cdm_var('id') != ''){
			
			
			echo do_shortcode('[sp-client-document-manager uid="'.sanitize_text_field(cdm_var('id')).'"]');
			
		}



}
	
}

?>