<?php



function cdm_event_log_installer(){
		global $wpdb;
	
	$table_name =  $wpdb->prefix . "sp_cu_event_log";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	
	$table = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `log` text NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($table );
	
	update_option('sp_cu_event_logger_installer',  'installed');
	}
	
	
	
	
}
add_action('init', 'cdm_event_log_installer');

function cdm_event_log($id,$uid,$type,$log){
	
	global $wpdb,$current_user;;
	
	
	$insert['type'] = $type;
	$insert['log'] = $log;
	$insert['uid'] = $uid;
	$insert['item_id'] = $id;
	
	$insert = $wpdb->insert("".$wpdb->prefix . "sp_cu_event_log", apply_filters('sp_cdm/event_log/insert',$insert));
	do_action('sp_cdm/event_log/insert/after',$wpdb->insert_id,$id,$uid,$type,$log);
}

function cdm_get_event_log($id,$type,$limit=10,$array= false){
	
	global $wpdb;
	 $h = '';
	  $query = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix . "sp_cu_event_log WHERE type = %s AND item_id = %d order by date desc limit %d", $type,$id,$limit);
	
	  $log = $wpdb->get_results( $query, ARRAY_A);
        
		
		if($array == true){
			
			return $log;
			
		}else{
			
		$h .= '<div class="sp_cu_event_log">';
		
		if($log == false){
			$h .='<p>'.__('No events logged', 'sp-cdm').'</p>';	
		}else{
		 for ($i = 0; $i < count($log); $i++) {
			 
			$log_user = get_userdata($log[$i]['uid']);
			$log_date =  date_i18n( get_option( 'date_format' ).' h:i A', strtotime($log[$i]['date'] ) );
			 	$h .= '<div class="sp_cu_event_log_item">
						<p class="sp_cu_event_log_item_content">'.$log[$i]['log'].'</p>
						<p class="sp_cu_event_log_item_by"><em>On<strong> '.$log_date.'</strong> by <strong>'.$log_user->display_name.'</strong></em></p>
						</div>';
			unset($log_user);
			unset($log_date);
			 
		 }
		}
		$h .='</div>';	
		return $h;
		}
	
	
}