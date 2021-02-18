<?php

$sp_cdm_admin_users = new sp_cdm_admin_users;

	
class sp_cdm_admin_users{
	
function __construct(){
	
	add_action( 'delete_user_form', array($this,'delete_user_content_question'),10,2 );
	add_action( 'admin_init', array($this,'process_delete_user'));
	
}

function process_delete_user(){
	
	$nonce = cdm_var('_wpnonce');

	
	
	
	if(cdm_var('delete_option_cdm') != ''){
		
	
		
	if ( cdm_var('users')== false &&  cdm_var('user')== false ) {
		
	}else{
	
	if ( cdm_var('users') == false )
		$userids = array( cdm_var('user') );
	else
		$userids = array_map( 'intval', (array) cdm_var('users') );

	
	$cdm_method = cdm_var('delete_option_cdm');
			
			switch($cdm_method){
				
				case "delete":
				
				foreach($userids as $user_id){
					
					cdm_delete_user_files($user_id);
					cdm_delete_user_folders($user_id);	
						
				}
				
				
				break;	
				case "reassign":
				$to = cdm_var('reassign_user_cdm');
				foreach($userids as $user_id){
				cdm_reassign_user_files($user_id,$to);
				cdm_reassign_user_folders($user_id,$to);
				}
				break;
				
				
			}
			
	}
			
			
	}
	
}
function delete_user_content_question($current_user, $userids){
	global $wpdb;
	
	

	$godelete = 0;

	
	foreach ( $userids as $id ) {
		if( cdm_user_has_files($id) == true or  cdm_user_has_folders($id) == true){
		$godelete += 1;	
		}		
	}
	

	if ( $godelete == 0 or sp_cdm_is_featured_disabled('base', 'cdm_disable_move') != false ) : ?>
	<fieldset><p><legend><strong><?php _e( 'All document manager files and folders will be removed once this user is deleted.', 'sp-cdm' ); ?></strong></legend></p>
    	<input type="hidden" name="delete_option_cdm" value="delete" />
	<?php else: ?>
		<fieldset><p><legend><strong><?php _e( 'What should we do with the document manager content?', 'sp-cdm' ); ?></strong></legend></p>
		<ul style="list-style:none;">
			<li><label><input type="radio" id="delete_option0" name="delete_option_cdm" value="delete" checked />
			<?php _e('Delete all content.', 'sp-cdm'); ?></label></li>
			<li><input type="radio" id="delete_option1" name="delete_option_cdm" value="reassign" />
			<?php echo '<label for="delete_option1">' . __( 'Move folders and files to:', 'sp-cdm' ) . '</label> ';
			wp_dropdown_users( array(
				'name' => 'reassign_user_cdm',
				'exclude' => array_diff( $userids, array( $current_user->ID ) ),
				'show' => 'display_name_with_login',
			) ); ?></li>
		</ul></fieldset>
	<?php endif;
	
}
		
	
}