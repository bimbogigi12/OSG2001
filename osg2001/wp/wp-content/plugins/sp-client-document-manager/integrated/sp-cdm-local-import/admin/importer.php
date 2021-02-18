<?php
class MyRecursiveFilterIteratorExtend extends RecursiveFilterIterator {

    public static $FILTERS = array(
        '__MACOSX',
    );

    public function accept() {
        return !in_array(
            $this->current()->getFilename(),
            self::$FILTERS,
            true
        );
    }

}
$sp_cdm_local_import_admin_integrated = new sp_cdm_local_import_admin_integrated;
add_filter('sp_client_upload_nav_menu', array($sp_cdm_local_import_admin_integrated, 'top_menu'));
add_action('sp_cu_admin_menu', array($sp_cdm_local_import_admin_integrated, 'menu'));



add_action( 'wp_ajax_sp_cdm_import_show_folders', array($sp_cdm_local_import_admin_integrated, 'ajax_get_folders'));
add_action( 'wp_ajax_sp_cdm_import_show_folders', array($sp_cdm_local_import_admin_integrated, 'ajax_get_folders'));

add_action( 'wp_ajax_sp_cdm_import_check_files', array($sp_cdm_local_import_admin_integrated, 'ajax_check_files'));
add_action( 'wp_ajax_nopriv_sp_cdm_import_check_files', array($sp_cdm_local_import_admin_integrated, 'ajax_check_files'));

add_action( 'wp_ajax_sp_cdm_import_start_import', array($sp_cdm_local_import_admin_integrated, 'ajax_start_import'));
add_action( 'wp_ajax_nopriv_sp_cdm_import_start_import', array($sp_cdm_local_import_admin_integrated, 'ajax_start_import'));


add_action( 'wp_ajax_sp_cdm_import_reset_session', array($sp_cdm_local_import_admin_integrated, 'ajax_reset_session'));
add_action( 'wp_ajax_nopriv_sp_cdm_import_reset_session', array($sp_cdm_local_import_admin_integrated, 'ajax_reset_session'));



add_action('wp', array($sp_cdm_local_import_admin_integrated, 'session'));

class sp_cdm_local_import_admin_integrated{
	function session(){
	if(session_id() == '') {	
    session_start();
	}
		
	}
	function ajax_check_files(){
		echo '<div style="margin:10px;padding:10px;background-color:#EFEFEF;border:1px solid #CCC;border-radius:10px;">';
		echo '<strong>Checking</strong> 	'.cdm_var('path').'......<br><br>';
	
		echo $this->count_local_files(cdm_var('path'));
		echo '</div>';
	
	die();
		
		
	}
	
	function ajax_start_import(){
	ini_set('post_max_size', '1024M');
ini_set('upload_max_filesize', '1024M');
	
	
	  $this->copy_local_files(cdm_var('path'),cdm_var('uid'));



	
	die();
		
		
	}
	
	
function add_folder($name,$pid){
	
	global $wpdb;
	if($_SESSION['import_pid'] == ''){
		
		$_SESSION['import_pid'] = cdm_var('pid');
		
	}
	if($pid == ''){
	$pid = cdm_var('pid');	
	}
	$insert['name'] = $name;
	$insert['uid'] = cdm_var('uid');
	$insert['parent'] = $pid;
	#print_r($insert);
	foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }	
	$wpdb->insert("" . $wpdb->prefix . "sp_cu_project", $insert);

	$_SESSION['import_pid'] = $wpdb->insert_id;
	return $wpdb->insert_id;
}
function random_hash($filename){
  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $length= 4;
  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[mt_rand(0, $max)];


	  $parts=explode(".",$filename);
   return ''.$parts[0].'_'.$str.'.'.$parts[count($parts)-1].'';

}
function add_file($file,$pid,$uid){
	global $wpdb;
	
	
	
	
	$dir = '' . SP_CDM_UPLOADS_DIR . '' . $uid . '/';
	
	
	 if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
	$filename = $this->random_hash(sanitize_file_name(basename($file)));
	$nicename = sanitize_file_name(basename($file));
	$local_file_path = ''.$dir.''.$filename.'';	
	#if(!file_exists($local_file_path)){
	#$file_contents = file_get_contents($file);
	#file_put_contents($local_file_path, $file_contents);

if (!copy($file, $local_file_path)) {
    echo "failed to copy $file...\n";
}
	#}
	#echo $local_file_path;
	
	$insert['name'] = $nicename;
	$insert['file'] = $filename;
	$insert['uid'] = $uid ;
	$insert['pid'] = $pid;
	#print_r($insert);
	foreach($insert as $key=>$value){ if(is_null($value)){ unset($insert[$key]); } }	
	$wpdb->insert("" . $wpdb->prefix . "sp_cu", $insert);
	
	return $wpdb->insert_id;
	
	
}

function copy_local_files($dir) {
   $contents = array();

   	if($_SESSION['import_pid'] == ''){
		
		$_SESSION['import_pid'] = cdm_var('pid');
		
	}
    if($dir == ''){
	$dir = cdm_var('path');	
	}
    if($uid == ''){
	$uid = cdm_var('uid');	
	}
	$_SESSION['import_starting_dir'] = $dir;
/*
   #print_r($_SESSION);
    foreach (scandir($dir) as $node) {
        if ($node == '.' || $node == '..') continue;
        if (!is_dir($dir . '/' . $node)) {
			    $contents['__file_import'][] = $dir . '/' .$node;
				$this->add_file($dir . '/' .$node,$uid);
			
		
        } else {
        $insert_folder = $this->add_folder($node,$uid);
		
         $contents[$node] =  $this->copy_local_files($dir . '/' . $node,$uid);
			echo '<div class="updated"><p>Imported '.$node.'!</p></div>';
        }
    }
	
	*/

	if(cdm_var('pid')== ''){
	
	$pid = 0;
	
	}else{
		
	$pid = cdm_var('pid');	
	}

	if($_SESSION['start'] ==1){
		
			unset($_SESSION['start']);
			unset($_SESSION['structure']);
			unset($_SESSION['continue_folder_import'] );
			
			
		$structure = $this->find_folder_structure($dir,$pid);
			ksort($structure);
			
		
		$_SESSION['continue_folder_import'] = $structure;
		$_SESSION['folder_import_original'] = $structure;
		$_SESSION['structure'] = array();
	
		
	}

	 
	if($_SESSION['done'] == 1){
	
	echo 'Done';	
	unset($_SESSION['continue_folder_import']);
	unset($_SESSION['structure']);
	unset($_SESSION['folder_import_original']);
	exit;
	}else{
			echo '<div style="margin:10px;padding:10px;background-color:#EFEFEF;border:1px solid #CCC;border-radius:10px;">';
		echo '<pre>';
	 $this->process($pid,cdm_var('uid'));
	 echo '</pre>';
	 		echo '</div>';
	}

	#$this->copy_local_files_process($contents,$uid,$destination);

		
	
   exit;
}



function count_path($path){
	$path_dir = explode("/", $dir);
	$total = count($path_dir) -1;
	return $total;
}

function ajax_reset_session(){
	
	unset($_SESSION['continue_folder_import']);
	unset($_SESSION['folder_import_original']);
	unset($_SESSION['structure']);
	unset($_SESSION['done']);
	$_SESSION['start'] = 1;
	die();
	
}
function process($pid,$uid){
	ini_set('memory_limit', '1024M');
	
	echo '<div class="updated"><p>Total left: '. count($_SESSION['continue_folder_import']).'</p></div>';
	
	
	$dir[key( $_SESSION['continue_folder_import'])] = $_SESSION['continue_folder_import'][key( $_SESSION['continue_folder_import'])];
	#print_r($dir);
	

	
$file_count = 0;
$folder_count= 0;
	
	$path_dir =   array_values(array_filter(explode("/", cdm_var('path'))));

	$total= count($path_dir) -1;	
	$starting_path = $path_dir[$total];

	
	
	
		foreach($dir as $path=>$files){
		
		$current_folder_dir =   array_values(array_filter(explode("/", $path)));
		$current_folder_total= count($current_folder_dir) -1;	
		$current_folder = $current_folder_dir[$current_folder_total];		
		#print_r($current_folder_dir);
		#echo '<h2>Current FOlder:'.$current_folder.' ||'. $starting_path.'	';
	
	
			if($current_folder == $starting_path){
				
			$parent = cdm_var('pid');	
			}else{
			$parent_folder_total= count($current_folder_dir) -2;	
			$parent_folder = $current_folder_dir[$parent_folder_total];
			
			$parent_path = preg_replace('|/[^/]*$|','', $path);
						
			$parent = $_SESSION['structure'][$_SESSION['folder_import_original'][$parent_path]['__base_id']];
									
			}
			#echo ' || '.$parent_folder.'</h2>';
			if($current_folder != $starting_path){
			$set_pid = $this->add_folder($current_folder ,$parent,$uid);
			echo '<div class="updated"><p>Added Folder : '.$current_folder.'</p></div>';
			$folder_count++;
			$_SESSION['structure'][$files['__base_id']] = $set_pid;
			}
			#print_r($files);
			foreach($files as $file_key=>$file){
				
				if( is_numeric($file_key ) && !is_dir($path.'/'.$file)){
				
					if($current_folder == $starting_path){
					$set_pid  = cdm_var('pid');		
					}
				
					$this->add_file($path.'/'.$file,$set_pid,$uid);
					$file_count++;
					
				}
		
			}
			}
			
	
	echo '<div class="updated"><p>Imported '. $file_count.' files into '.$current_folder.'</p></div>';
		unset($_SESSION['continue_folder_import'][key( $_SESSION['continue_folder_import'])]);
		unset($dir);
			if(count($_SESSION['continue_folder_import']) == 0){
			$_SESSION['done'] = 1;	
			}
		}

function process_old($dir,$pid,$uid){
	
	ksort($dir);
	print_r($dir);exit;
	
if($pid == ''){
	
	$pid = 0;
	
}
$file_count = 0;
$folder_count= 0;
	$path_dir = explode("/", cdm_var('path'));
	$total = count($path_dir) -1;	
	$starting_path = $path_dir[$total];
	
	$_SESSION['structure'] = array();
		foreach($dir as $path=>$files){
		
	$loop_path_dir = explode("/", $path);
	$loop_total = count($loop_path_dir) -1;	
	$current_folder = $loop_path_dir[$loop_total];
	
	if($loop_total >= $total){
	
	
		if($path ==cdm_var('path')){
			
			foreach($files as $file_key=>$file){
			if(!in_array($file,array('.','..')) && $file_key != '__base_id'){
			$this->add_file($path.'/'.$file,$pid,$uid);
			$file_count++;
			}
			}
				
		}else{
				
				if(count($loop_path_dir) > count($path_dir)){
					
				$loop_parent = count($loop_path_dir) -2;	
				$parent_folder = $loop_path_dir[$loop_parent];
					#echo $parent_folder;
					#echo '-';
					#echo $starting_path;
					
					if($parent_folder == $starting_path){
					
					$parent = cdm_var('pid');
						
					}else{
						$parent_path = preg_replace('|/[^/]*$|','', $path);
						
					$parent = $_SESSION['structure'][$parent_path.'_'.$parent_folder];
						
					}
					#echo 'parent:'.$parent_path.'_'.$parent_folder.'';
					
						$pid = $this->add_folder($current_folder ,$parent,$uid);
						$folder_count++;
						$_SESSION['structure'][$path.'_'.$current_folder] = $pid;
						foreach($files as $file_key=>$file){
						if(!in_array($file,array('.','..')) && $file_key != '__base_id'){
						$this->add_file($path.'/'.$file,$pid,$uid);	
						$file_count++;
						}
						}
					
					
					
				}
	
		}
	}
		}
		echo '<div class="updated"><p>Imported '. $file_count.' files and '.$folder_count.' folders!</p></div>';
		#print_r( $_SESSION['structure']);
}
function get_base($dir){
		
		$base = explode("/", $dir);
		$base_total = count($base ) -1;	
		$current_folder = $loop_path_dir[$loop_total];
}

function find_folder_structure($dir){



$directory = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
$ritit  = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST );


$map = array();
foreach ($ritit as $splFileInfo) {
    $dir = dirname($splFileInfo->getRealPath());
	#if(!$splFileInfo->isDot()){
    $map[ $dir ][] = $splFileInfo->getFileName();
	#}
}

	$path_dir = explode("/", cdm_var('path'));
	$total = count($path_dir);
	$total_starting = count($path_dir);
foreach($map as $key=>$array){
		
$map[$key]['__base_id'] = rand();
}

return $map;
	
}


function find_folder_structurezzz($dir){

$directory = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
$ritit  = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST );

$map = array();
foreach ($ritit as $splFileInfo) {
    $dir = dirname($splFileInfo->getRealPath());
	#if(!$splFileInfo->isDot()){
    $map[ $dir ][] = $splFileInfo->getFileName();
	#}
}

#print_r($map);
	$path_dir = explode("/", cdm_var('path'));
	$total = count($path_dir);
	$total_starting = count($path_dir);
foreach($map as $key=>$array){
		
		
		
	$path_dir_loop = explode("/", $key);
	$total_loop = count($path_dir_loop);
	$total_current = $total_loop -1;
	$starting_path = $path_dir_loop[$total_current];
	$total_parent = $total_loop -2;
	if($total_loop >= $total){
	$parent_path = $path_dir_loop[$total_parent];
	}else{
	$parent_path = cdm_var('pid');	
	}
if($total_loop >= $total){
	$arr[$key] = $array;
	$arr[$key]['__base_id'] = rand();
	#$arr[$key]['__folder'] = $starting_path;
	#$arr[$key]['__parent'] = $parent_path;
		
	
}
}

exit;
return $arr;
	
}
function plotTreeCreate_folders($arr, $indent=0, $mother_run=true,$pid = 0){
    if ($mother_run) {
        // the beginning of plotTree. We're at rootlevel
        echo "start\n";
    }

    foreach ($arr as $k=>$v){
        // skip the baseval thingy. Not a real node.
        if ($k == "__base_val") continue;
        // determine the real value of this node.
        $show_val = (is_array($v) ? $v["__base_val"] : $v);
      
		if(is_array($v)){
			$pid = $this->add_folder($k,$pid);
			 $this->plotTree($v, ($indent+1), false,$pid);
		}
	  
      
    }

    if ($mother_run) {
        echo "end\n";
    }
}
function plotTree($arr, $indent=0, $mother_run=true,$pid = 0){
    if ($mother_run) {
        // the beginning of plotTree. We're at rootlevel
        echo "start\n";
    }

    foreach ($arr as $k=>$v){
        // skip the baseval thingy. Not a real node.
        if ($k == "__base_val") continue;
        // determine the real value of this node.
        $show_val = (is_array($v) ? $v["__base_val"] : $v);
      
	  
	  	if(!is_array($v)){
			
			$this->add_file($v,$pid);
		}
	  	
		
		if(is_array($v)){
			$pid = $this->add_folder($k,$pid);
			 $this->plotTree($v, ($indent+1), false,$pid);
		}
	  
      
    }

    if ($mother_run) {
        echo "end\n";
    }
}
function get_folder_structure($dir){
	
		  $ite=new RecursiveDirectoryIterator($dir);

    $bytestotal=0;
    $nbfiles=0;
	$iterator = new RecursiveIteratorIterator($ite);

    foreach ($iterator as $filename=>$cur) {
     
	  if(!is_dir($filename)){
	    $filesize=$cur->getSize();
        $bytestotal+=$filesize;
        $nbfiles++;
		$cutname = str_replace($dir,'',$filename);
        $files[$cutname] = $filename;
	  }
    }
	
	
	
	
	return $this->explodeTree($files, $delimiter = '/',true);
	
}
function count_local_files($path) { 
		if(is_dir($path)){
			
			
			  $ite=new RecursiveDirectoryIterator($path);

    $bytestotal=0;
    $nbfiles=0;
	$iterator = new RecursiveIteratorIterator($ite);

    foreach ($iterator as $filename=>$cur) {
      
	  if(!is_dir($filename)){
	    $filesize=$cur->getSize();
        $bytestotal+=$filesize;
        $nbfiles++;
        $files[] = $filename;
	  }
    }
	
    $bytestotal=number_format($bytestotal);


			 return  ' <div class="updated"><p>'. $nbfiles.' Files located in this directory with a total of '.$bytestotal.' bytes</p></div>';
		}else{
			return ' <div class="error"><p>File does not appear to be a valid directory!</p></div>';
			
		}
}

function explodeTree($array, $delimiter = '_', $baseval = false)
{
    if(!is_array($array)) return false;
    $splitRE   = '/' . preg_quote($delimiter, '/') . '/';
    $returnArr = array();
    foreach ($array as $key => $val) {
        // Get parent parts and the current leaf
        $parts  = preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
        $leafPart = array_pop($parts);

        // Build parent structure
        // Might be slow for really deep and large structures
        $parentArr = &$returnArr;
        foreach ($parts as $part) {
            if (!isset($parentArr[$part])) {
                $parentArr[$part] = array();
            } elseif (!is_array($parentArr[$part])) {
                if ($baseval) {
                    $parentArr[$part] = array('__base_val' => $parentArr[$part]);
                } else {
                    $parentArr[$part] = array();
                }
            }
            $parentArr = &$parentArr[$part];
        }

        // Add the final part to the structure
        if (empty($parentArr[$leafPart])) {
            $parentArr[$leafPart] = $val;
        } elseif ($baseval && is_array($parentArr[$leafPart])) {
            $parentArr[$leafPart]['__base_val'] = $val;
        }
    }
    return $returnArr;
}	
	
	function ajax_get_folders(){
		
		
		if(cdm_var('user_id') == '-1'){
			
			echo 'Choose a user first';
			
		}else{
	
		echo sp_cdm_display_projects_select_by_id(cdm_var('user_id') ,'sp-cdm-import-user',$class = 'sp-cdm-import-user');
			
		}
	
		
	die();	
	}
	
	
	function menu(){
	
	add_submenu_page('sp-client-document-manager', __("Local Import", "sp-cdm"), __("Local Import", "sp-cdm"), 'sp_cdm', 'sp-client-document-manager-local-import', array(
        $this,
        'view'
    ));
		
	}
	
	function top_menu($html){
		
		$html .= '<li><a href="admin.php?page=sp-client-document-manager-local-import" >' . __("Local Import", "sp-cdm") . '</a></li>';
		return $html;	
	}
	function view(){
		$_SESSION['import_pid'] = '';
	if(@$_SESSION['import_starting_dir'] == ''){
		
		$dir = $_SERVER['DOCUMENT_ROOT'] ;
	}else{
		
		$dir = $_SESSION['import_starting_dir'];
	}
		
	 echo '<h2>' . __("Local Import", "sp-cdm") . '</h2>' . sp_client_upload_nav_menu() . '
	 <form action="" method="post">
	 	 <table class="wp-list-table widefat fixed posts" cellspacing="0">
		 <tr><td style="width:200px">Local Path</td><td><input type="text" name="local-path" placeholder="'.$dir .'" style="width:400px" class="sp-cdm-import-check-files-location"> <a href="#" class="sp-cdm-import-check-files button" >Check Files</a> <div class="sp-cdm-check-files-view"></div></td></tr>
		 <tr><td>Assign to user</td><td>'.wp_dropdown_users(array('name' => 'assign-to', 'echo'=> false, 'class'=>'sp-cdm-import-assign','show_option_none'=>'Select a user')) .'</td></tr>
		 <tr><td >Destination Folder</td><td><span class="sp-cdm-import-folders">Choose a user first</span></td></tr>
		 <tr><td ></td><td><input type="submit" name="import-files" class="sp-cdm-start-import" value="Import"></td></tr>
		 </table>
	 
	 </form>
	 
	 ';
	 
	 
	 
	 
	 
	
	
	}
}