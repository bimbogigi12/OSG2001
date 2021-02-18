<?php




add_action('plugins_loaded','activate_sp_cdm_media');
function activate_sp_cdm_media(){	
$sp_cdm_media = new sp_cdm_medias;	
}



class sp_cdm_medias{
	
	function	__construct(){
			
			$this->namesake = 'cdm_media';
			$this->version = '1.0.4';
			$this->name = ' SP Client Document Manager Media Viewer';
			$this->item_name = $this->name;
			$this->license_option_name ='sp_'.$this->namesake.'_premium_license';
			$this->license_key = trim( get_option($this->license_option_name)); 
			$this->store_url = 'http://www.smartypantsplugins.com';
			
		
			define('SP_CDM_MEDIA_DIR', plugin_dir_path( __FILE__ ));
			define('SP_CDM_MEDIA_URL',  plugins_url('', __FILE__));
			include_once ''.dirname(__FILE__).'/includes/functions.php';
			include_once ''.dirname(__FILE__).'/admin/settings.php';
			include_once ''.dirname(__FILE__).'/user/viewfile.php';
			include_once ''.dirname(__FILE__).'/user/uploader.php';
			
			add_action('admin_enqueue_scripts', array($this,'admin_js'));
			add_action('admin_enqueue_scripts',  array($this,'admin_css'));
			
			
			add_action('admin_init',  array($this ,'permissions'));	
			add_action('admin_init',  array($this ,'install'));
			
			add_action('wp_enqueue_scripts', array($this,'js'));
			add_action('wp_enqueue_scripts',  array($this,'css'));
			
			add_action('admin_enqueue_scripts', array($this,'js'));
			add_action('admin_enqueue_scripts',  array($this,'css'));

			
			
			
		}
	
	
	function permissions(){
		
		global $current_user;
	if($current_user != ''){
		
		if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_media') ) {
		
		@require_once(ABSPATH . 'wp-includes/pluggable.php');
		$role = get_role( 'administrator' );
		$role->add_cap( 'sp_cdm_media' );	
			
		}
		
	}
		
	}
	function install(){
		global $wpdb;
		
		if( get_option( 'sp_cdm_'.$this->namesake.'_version') == '' or get_option( 'sp_cdm_'.$this->namesake.'_version') < $this->version  ){
			
			$alters[] = "ALTER TABLE  ".$wpdb->prefix."sp_cu ADD  embed TEXT NOT NULL;";	
			
			if(count($alters) > 0){
			foreach($alters as $alter){			
			$wpdb->query($alter);
			}	
			}
		   update_option('sp_cdm_'.$this->namesake.'_version',$this->version );
		}
	}
	
	function admin_js(){
	wp_register_script('sp-cdm-media',''.SP_CDM_MEDIA_URL.'/js/scripts.js', array('jquery'));
	wp_localize_script( 'sp-cdm-media', 'sp_cdm_media', array( 'ajax' => admin_url( 'admin-ajax.php')) ); 
    wp_enqueue_script( 'sp-cdm-media' );
	
	
	}
	function admin_css(){
		  	
	}
	
	
	function js(){
	wp_register_script('sp-cdm-media', plugin_dir_url( __FILE__ ) . 'js/scripts.js' , array('jquery'));
	wp_localize_script( 'sp-cdm-media', 'sp_cdm_media', array( 'ajax' => admin_url( 'admin-ajax.php')) ); 
    wp_enqueue_script( 'sp-cdm-media' );
	
	}
	
	function css(){
		
	}
	
	
	
	
	

		
	
	
	
}

	


?>