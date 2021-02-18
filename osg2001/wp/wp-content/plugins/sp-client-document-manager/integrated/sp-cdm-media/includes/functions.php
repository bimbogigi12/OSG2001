<?php


function sp_cdm_media_screenshot($movie){
	if(function_exists('ffmpeg_movie')){
		
		
			$frame = 10;
			$thumbnail = ''.$movie.'.png';
			
			$mov = new ffmpeg_movie($movie);
			$frame = $mov->getFrame($frame);
			if ($frame) {
				$gd_image = $frame->toGDImage();
				if ($gd_image) {
					imagepng($gd_image, $thumbnail);
					imagedestroy($gd_image);
					
				}
			}
	
	}
	
	
}