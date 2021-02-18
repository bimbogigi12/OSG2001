<?php 

add_filter('sp_cdm_viewfile' , array('sp_cdm_media_viewfile', 'whole_view'),10,2);

add_filter('wp_cdm_download_before' , array('sp_cdm_media_viewfile', 'stream'),10,2);

add_filter('sp_cdm_view_file_tab' , array('sp_cdm_media_viewfile', 'tab_name'),8,2);
add_filter('sp_cdm_view_file_content', array('sp_cdm_media_viewfile', 'tab_content'),8,2);

add_filter('sp_cdm_viewfile_download_url', array('sp_cdm_media_viewfile', 'viewfile_delete_button'),10,2);
#add_filter('sp_cdm_viewfile_shortlink_button', array('sp_cdm_media_viewfile', 'viewfile_delete_button'),10,2);
add_filter('sp_cdm_viewfile_revision_button', array('sp_cdm_media_viewfile', 'viewfile_delete_button'),10,2);


#add_filter('sp_cdm_viewfile_replace_file_infos', array('sp_cdm_media_viewfile', 'file_info_view'),8,4);
class sp_cdm_media_viewfile{
	
	
		function viewfile_delete_button($html,$r){
			
			if($r[0]['file'] == 'embed'){
				
			unset($html);	
			}
		
		return $html;
		
		}
	
	
	function stream(){
		global $wpdb;
		
		if(cdm_var('stream') == 1){
		
		ob_start();

		$file_decrypt = base64_decode(sanitize_text_field(cdm_var('fid')));
		$file_arr = explode("|",$file_decrypt);
		
		#print_r($file_arr);
		$fid = $file_arr[0];
		$file_date = $file_arr[1];
		$file_name = $file_arr[2];

		
	$r = $wpdb->get_results($wpdb->prepare("SELECT *  FROM ".$wpdb->prefix."sp_cu   where id= %d AND date = %d  AND file = %s",$fid,$file_date,$file_name), ARRAY_A);
		$path= ''.SP_CDM_UPLOADS_DIR.''.$r[0]['uid'].'/'.$r[0]['file'].'';
		
	

$size=filesize($path);

$fm=@fopen($path,'rb');
if(!$fm) {
  // You can also redirect here
  header ("HTTP/1.0 404 Not Found");
  die();
}

$begin=0;
$end=$size;

if(isset($_SERVER['HTTP_RANGE'])) {
  if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)) {
    $begin=intval($matches[0]);
    if(!empty($matches[1])) {
      $end=intval($matches[1]);
    }
  }
}


  header('HTTP/1.0 200 OK');

header("Content-Type: video/mp4");
header('Accept-Ranges: bytes');
header('Content-Length:'.($end-$begin));
header("Content-Disposition: inline;");
header("Content-Range: bytes $begin-$end/$size");
header("Content-Transfer-Encoding: binary\n");
header('Connection: close');

$cur=$begin;
fseek($fm,$begin,0);

while(!feof($fm)&&$cur<$end&&(connection_status()==0))
{ print fread($fm,min(1024*16,$end-$cur));
  $cur+=1024*16;
  usleep(1000);
}
die();
		}
		
		
	}
	
	function video($stream,$ext,$embed = false){
		
		
		if($ext == 'mp3'){
		$height = 'padding-bottom: 6.25%; /* 16:9 */';		
		}else{
		$height = 'padding-bottom: 56.25%; /* 16:9 */';	
		}
		
		$html .='
		<style type="text/css">
		.sp_cdm_video_holder{
	position: relative;
	'.$height .'
	padding-top: 25px;
	height: 0;
}
.sp_cdm_video_holder video{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.sp_cdm_video_holder iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
		
		</style>
		
		<div class="sp_cdm_video_holder">
		';
		
		if($embed != false){
			
		$html .=  stripslashes($embed);	
		}else{
		$html .='
		<video width="100%"  controls>
  <source src="'.$stream.'" type="video/mp4">
 
  Your browser does not support the video tag.
</video>
	
		';	
		}
		$html .='</div>';
		return $html;
		
	}
	function whole_view($html,$r){
		
		
		$style= get_option( 'sp_cdm_media_style', 'tab' );
		$ext = substr(strrchr($r[0]['file'], '.'), 1);
		if($style == 'whole' && (in_array($ext,array('mp4','ogg','webm','mp3')) or $r[0]['file'] == 'embed')){
			 
			
			#$stream = '' . SP_CDM_PLUGIN_URL . 'download.php?fid=' .base64_encode($r[0]['id'].'|'.$r[0]['date'].'|'.$r[0]['file']). '&stream=1&type=mp4';	
			$stream= ''.SP_CDM_UPLOADS_DIR_URL.''.$r[0]['uid'].'/'.$r[0]['file'].'';
			$html =	 sp_cdm_media_viewfile::video($stream,$ext,$r[0]['embed']);
			
		
		
		}
		return $html;
		
	}
	function file_info_view($html,$r,$info_left_column,$info_right_column){
		$style= get_option( 'sp_cdm_media_style', 'info' );
		$ext = substr(strrchr($r[0]['file'], '.'), 1);
		if($style == 'info' && (in_array($ext,array('mp4','ogg','webm','mp3')) or $r[0]['file'] == 'embed')){
			#$stream = '' . SP_CDM_PLUGIN_URL . 'download.php?fid=' .base64_encode($r[0]['id'].'|'.$r[0]['date'].'|'.$r[0]['file']). '&stream=1&type=mp4';		
			$stream= ''.SP_CDM_UPLOADS_DIR_URL.''.$r[0]['uid'].'/'.$r[0]['file'].'';
			$html =  sp_cdm_media_viewfile::video($stream,$ext,$r[0]['embed']);
			$html .='<div style="padding:10px">'.$info_right_column.'</div>';
		}
		
		return $html;
		
	}
	function tab_name($html,$r){
		$style= get_option( 'sp_cdm_media_style', 'tab' );
		$ext = substr(strrchr($r[0]['file'], '.'), 1);
		if($style == 'tab' && (in_array($ext,array('mp4','ogg','webm','mp3')) or $r[0]['file'] == 'embed')){
		 $html .= '<li><a href="#cdm-media">'.get_option('sp_cdm_media_word','Media').'</a></li>';
		}
		
		return $html;
	}
	
	function tab_content($html,$r){
		
		$style= get_option( 'sp_cdm_media_style', 'tab' );
		$ext = substr(strrchr($r[0]['file'], '.'), 1);
		if($style == 'tab' && (in_array($ext,array('mp4','ogg','webm','mp3')) or $r[0]['file'] == 'embed')){
		$html .='<div id="cdm-media">';	
		#$stream = '' . SP_CDM_PLUGIN_URL . 'download.php?fid=' .base64_encode($r[0]['id'].'|'.$r[0]['date'].'|'.$r[0]['file']). '&stream=1&type=mp4';		
		$stream= ''.SP_CDM_UPLOADS_DIR_URL.''.$r[0]['uid'].'/'.$r[0]['file'].'';	
		$html .=	 sp_cdm_media_viewfile::video($stream,$ext,$r[0]['embed']);	
		$html .='</div>';	
		}
		
		return $html;
		
		
	}
	
	
	
	
}