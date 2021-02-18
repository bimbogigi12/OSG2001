<?php



	function cdm_customizer_css()
{
	$theme_settings = cdm_customizer_settings();

	
    ?>
         <style type="text/css">
		  /* SP Client Document Manager Customizer Styles */

<?php if(isset($theme_settings['button_color'])){ ?>#cdm_nav_buttons a:link, #cdm_nav_buttons a:visited,.cdm_nav_buttons a:link, .cdm_nav_buttons a:visited { background: <?php echo $theme_settings['button_color']; ?>}<?php }?>
<?php if(isset($theme_settings['button_font_color'])){ ?>#cdm_nav_buttons a:link, #cdm_nav_buttons a:visited,.cdm_nav_buttons a:link, .cdm_nav_buttons a:visited { color: <?php echo $theme_settings['button_font_color']; ?> !important}<?php }?>	
<?php if(isset($theme_settings['button_border_radius'])){ ?>#cdm_nav_buttons a:link, #cdm_nav_buttons a:visited,.cdm_nav_buttons a:link, .cdm_nav_buttons a:visited { border-radius: <?php echo $theme_settings['button_border_radius']; ?>}<?php }?>	
<?php if(isset($theme_settings['folder_background_color'])){ ?>.sp-cdm-r-folder ,.sp-cdm-rc-folder{ background: <?php echo $theme_settings['folder_background_color']; ?>}<?php }?>
<?php if(isset($theme_settings['file_background_color'])){ ?>.sp-cdm-r-file ,.sp-cdm-rc-file{ background: <?php echo $theme_settings['file_background_color']; ?>}<?php }?>


<?php if(isset($theme_settings['folder_font_color'])){ ?>.sp-cdm-r-folder, .sp-cdm-r-folder a, ,.sp-cdm-rc-folder, ,.sp-cdm-rc-folder a { color: <?php echo $theme_settings['folder_font_color']; ?>}<?php }?>
<?php if(isset($theme_settings['file_font_color'])){ ?>.sp-cdm-r-file, .sp-cdm-r-file a,.sp-cdm-rc-file, ,.sp-cdm-rc-file a { color: <?php echo $theme_settings['file_font_color']; ?>}<?php }?>

<?php if(isset($theme_settings['folder_hover_background_color'])){ ?>.sp-cdm-r-folder,.sp-cdm-r-file,  { background: <?php echo $theme_settings['folder_hover_background_color']; ?>}<?php }?>


			 <?php do_action('sp_cdm/customizer/css'); ?>
			 /* SP Client Document Manager Customizer Styles */ 
         </style>
    <?php

}
add_action( 'wp_head', 'cdm_customizer_css');

add_action( 'customize_register','cdm_customizer');
	function cdm_customizer( $wp_customize ) {


$wp_customize->add_panel( 'cdm_customizer', array(
 'priority'       => 10,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __('SP Client Document Manager', 'mytheme'),

) );

 
  $wp_customize->add_section('cdm_customizer', array(
        'title'    => __('Button Settings', 'sp-cdm'),
        'description' => '',
        'priority' => 120,
		 'panel'  => 'cdm_customizer',
    ));
 
  
  
  
  
  #Button Background color
  $wp_customize->add_setting('cdm_customizer[button_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_color', array(
        'label'    => __('Button Backround Color', 'sp-cdm'),
        'section'  => 'cdm_customizer',
        'settings' => 'cdm_customizer[button_color]',
    )));

	#Button Background color
  $wp_customize->add_setting('cdm_customizer[button_font_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_font_color', array(
        'label'    => __('Button Font  Color', 'sp-cdm'),
        'section'  => 'cdm_customizer',
        'settings' => 'cdm_customizer[button_font_color]',
    )));	
	
	#Button Border radius
	
	  $wp_customize->add_setting('cdm_customizer[button_border_radius]', array(
 
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'transport' => 'refresh',
 
    ));
 
    $wp_customize->add_control('list_border_radius', array(
        'label'      => __('Button Border Radius', 'sp-wpfh'),
		'description' => ' ex: 5px',
        'section'    => 'cdm_customizer',
        'settings'   => 'cdm_customizer[button_border_radius]',
    ));
	
	


  $wp_customize->add_section('cdm_customizer_list_colors', array(
        'title'    => __('File List Display', 'sp-cdm'),
        'description' => '',
        'priority' => 120,
		 'panel'  => 'cdm_customizer',
    ));
	
	
	
	
	  #FolderBackground color
  $wp_customize->add_setting('cdm_customizer[folder_background_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'folder_background_color', array(
        'label'    => __('Folder Backround Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[folder_background_color]',
    )));
	
	
		  #Folder Font color
  $wp_customize->add_setting('cdm_customizer[folder_font_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'folder_font_color', array(
        'label'    => __('Folder Font Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[folder_font_color]',
    )));
	
	
  #File Background color
  $wp_customize->add_setting('cdm_customizer[file_background_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'file_background_color', array(
        'label'    => __('File Backround Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[file_background_color]',
    )));


	  #File  Font Background color
  $wp_customize->add_setting('cdm_customizer[file_font_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'file_font_color', array(
        'label'    => __('File Font Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[file_font_color]',
    )));
	
	
	
	
	  #File Hover Background color
  $wp_customize->add_setting('cdm_customizer[file_hover_background_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'file_hover_background_color', array(
        'label'    => __('File Hover Backround Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[file_hover_background_color]',
    )));


	  #File  Font Background color
  $wp_customize->add_setting('cdm_customizer[file_hover_font_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'file_hover_font_color', array(
        'label'    => __('File Hover Font Color', 'sp-cdm'),
        'section'  => 'cdm_customizer_list_colors',
        'settings' => 'cdm_customizer[file_hover_font_color]',
    )));		
	
	}
	