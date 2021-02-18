<?php



function sp_client_upload_options_vendors(){

	

	global $wpdb;

	

	

	

	

if(cdm_var('submit-vendor')){

if ( wp_verify_nonce( cdm_var('cdm_nonce_save_vendor'), 'cdm_nonce_save_vendor' ) == false) {exit('Security Error');}		

	

	$v_array['name'] = cdm_var('name');

	$v_array['email'] = cdm_var('email');

	

	

	$insert['option_value'] = serialize($v_array);

	$insert['option_name'] =  'sp_client_upload_vendors_'.$v_array['name'].'_'.time().'';

foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }
  print_r($insert);
   $wpdb->insert("".$wpdb->prefix."options",$insert );

   

}



if(cdm_var('delete-vendor')){

	

		$wpdb->query("

	DELETE FROM ".$wpdb->prefix."options WHERE option_id = ".intval(cdm_var('delete-vendor'))."

	");

	

}











	$vendors = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix."options   where option_name  LIKE 'sp_client_upload_vendors%'  order by option_name", ARRAY_A);





echo '

 <h2>'.__("Vendors","sp-cdm").'</h2>'.sp_client_upload_nav_menu().'

 <p>'.__("You can use this section to route downloads to a certain vendor in the users section, when you click on a user there will be checkboxes next to the file. Check the checkboxes you would like to send then scroll down, choose a vendor and click send. This works well for sending files to department members or different vendors","sp-cdm").'</p>





<form action="admin.php?page=sp-client-document-manager-vendors" method="post" style="margin:15px">'.wp_nonce_field( 'cdm_nonce_save_vendor', 'cdm_nonce_save_vendor', true, false ).'

'.__("Name:","sp-cdm").' <input type="text" name="name">  '.__("Email:","sp-cdm").' <input type="text" name="email"> <input type="submit" name="submit-vendor" value="Add new vendor">

</form>

<table class="wp-list-table widefat fixed posts" cellspacing="0">

	<thead>

	<tr>

<th>'.__("Name","sp-cdm").'</th>

<th>'.__("Email","sp-cdm").'</th>

<th>'.__("Delete","sp-cdm").'</th>

</tr>

	</thead>';

				for($i=0; $i<count(	$vendors); $i++){

				

				$vendor_info[$i] = unserialize($vendors[$i]['option_value']);	

					

				echo '	<tr>

<td>'.$vendor_info[$i]['name'].'</td>

<td>'.$vendor_info[$i]['email'].'</td>

<td><a href="admin.php?page=sp-client-document-manager-vendors&delete-vendor='.$vendors[$i]['option_id'].'">'.__("Delete","sp-cdm").'</a></td>

</tr>';	

					

				}

				echo '</table>';

	

	

	

	

	

	

}

?>