<?php 
$sp_cdm_media_settings= new sp_cdm_media_settings;

add_action('sp_cdm_settings_add_tab', array($sp_cdm_media_settings, 'tab'));
add_action('sp_cdm_settings/tab/content', array($sp_cdm_media_settings, 'tab_content'));
add_action('sp_cdm_disable_features', array($sp_cdm_media_settings, 'disable_features'),1,1);

class sp_cdm_media_settings{
	
	
	function tab(){
		
	echo ' <li><a href="#cdm-tab-media">Media</a></li>';	
		
	}
		function disable_features($disable_features){
		
		echo '  <tr>
 <td >Disable Add Video</td><td>
 <input type="checkbox" name="sp_cdm_disable_features[base][cdm_add_video]"   value="1" ' . sp_client_upload_settings_checkbox($disable_features, 'base', 'cdm_add_video') . '></td>
 </tr>

 ';
		
	}
	
	function tab_content(){
		
		$text_api = get_option( 'sp_cdm_media_style', 'tab' );
		
			
		if($text_api == 'tab'){
			$tab_selected = 'selected="selected"';
		}
		if($text_api == 'whole'){
			$whole_selected = 'selected="selected"';
		}
		if($text_api == 'info'){
			$info_selected = 'selected="selected"';
		}
		
		
	echo '<div id="cdm-tab-media">	

 <table class="wp-list-table widefat fixed posts" cellspacing="0">


  

  

    <tr>

    <td width="300"><strong>Display Style</strong><br><em>Choose if you want the video take the whole file upload screen or put the video in a tab.</em></td>

    <td><select name="sp_cdm_media_style"><option value="tab" '.$tab_selected.'>Video Tab</option><option value="whole" '.$whole_selected.'>Whole Screen</option><option value="info" '.$info_selected.'>File Info Tab</option></select></td>

  </tr>
  <tr>

    <td width="300"><strong>Word for tab</strong><br><em>The tab title, default is "Video"</em></td>

    <td><input type="text" name="sp_cdm_media_word"  value="' . get_option('sp_cdm_media_word','Video') . '"  style="width:100%"> </td>

  </tr> 
 
    <tr>

    <td>&nbsp;</td>

    <td><input type="submit" name="save_options" value="Save Options"></td>

  </tr>
  </table>';
	
	
	
	echo '</div>';
		
	}
}