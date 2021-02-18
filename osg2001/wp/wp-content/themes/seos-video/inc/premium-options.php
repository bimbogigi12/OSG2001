<?php

add_action('admin_menu', 'seos_video_admin_menu');

function seos_video_admin_menu() {

global $seos_video_settings_page;

   $seos_video_settings_page = add_theme_page('Seos Video', 'Premium Theme ', 'edit_theme_options',  'my-unique-identifier', 'seos_video_settings_page');

	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {

}

function seos_video_settings_page() {
?>
<div class="wrap">

	<form class="theme-options" method="post" action="options.php" accept-charset="ISO-8859-1">
		<?php settings_fields( 'seos-settings-group' ); ?>
		<?php do_settings_sections( 'seos-settings-group' ); ?>
		
		<div class="seos-video">
			<a target="_blank" href="https://seosthemes.com/free-wordpress-video-theme/">
				<div class="btn s-red">
					 <?php _e('Buy', 'seos-video'); ?> <img class="ss-logo" src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>"/><?php _e(' Now', 'seos-video'); ?>
				</div>
			</a>
		</div>
		<div style="width: 100%; margin: 0 auto; text-align: center;	display: inline-block;">
		<h1><?php _e('You can support us by Buying an Seos Video Pro theme with a lot new features & extensions!', 'seos-video'); ?></h1>
			<a class="p-demo" href="http://seosthemes.info/seos-video-free-wp-theme/" target="_blank">Premium Demo</a>
		</div>
		
		<div class="cb-center">	
			<img class="sb-demo" src="<?php echo get_template_directory_uri() . '/images/seos-video.png'; ?>"/>			
		</div>
		
	</form>
	
</div>
<?php } ?>