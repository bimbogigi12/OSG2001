<?php function seos_video_animation_classes () { ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
				jQuery('.animate-article').addClass("hidden").viewportChecker({
					classToAdd: 'animated bounceInUp', // Class to add to the elements when they are visible
					offset: 100    
				   }); 
		});  
	</script>
<?php } 

add_action('wp_footer', 'seos_video_animation_classes');				   
				   
		
		