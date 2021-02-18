<?php
/* Theme Customizer */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seos_football_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	

/***********************************************************************************
 * Sanitize Functions
***********************************************************************************/
					
		function seos_football_sanitize_checkbox( $input ) {
			if ( $input ) {
				return 1;
			}
			return 0;
		}
/***********************************************************************************/
		
		function seos_football_sanitize_social( $input ) {
			$valid = array(
				'' => esc_attr__( ' ', 'seos-football' ),
				'_self' => esc_attr__( '_self', 'seos-football' ),
				'_blank' => esc_attr__( '_blank', 'seos-football' ),
			);

			if ( array_key_exists( $input, $valid ) ) {
				return $input;
			} else {
				return '';
			}
		}
		
/***********************************************************************************
 * Contacts Panel
***********************************************************************************/

		$wp_customize->add_panel( 'seos_football_contacts' , array(
			'title'       => __( 'Contacts Section', 'seos-football' ),
			'description' => __( 'Social media and Contacts', 'seos-football' ),
			'priority'   => 64,
		) );

		/************ General ***************/

		$wp_customize->add_section( 'seos_football_social_section_general' , array(
			'title'       => __( 'General', 'seos-football' ),
			'panel'       => 'seos_football_contacts',
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'social_media_activate_header', array (
			'sanitize_callback' => 'seos_football_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate_header', array(
			'label'    => __( 'Activate Contacts Section in Header:', 'seos-football' ),
			'section'  => 'seos_football_social_section_general',
			'settings' => 'social_media_activate_header',
			'type' => 'checkbox',
		) ) );
		
		$wp_customize->add_setting( 'social_media_activate', array (
			'sanitize_callback' => 'seos_football_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate', array(
			'label'    => __( 'Activate Contacts Section in Footer:', 'seos-football' ),
			'section'  => 'seos_football_social_section_general',
			'settings' => 'social_media_activate',
			'type' => 'checkbox',
		) ) );
				
		$wp_customize->add_setting( 'social_media_activate_posts', array (
			'sanitize_callback' => 'seos_football_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate_posts', array(
			'label'    => __( 'Activate Contacts Section in Posts:', 'seos-football' ),
			'section'  => 'seos_football_social_section_general',
			'settings' => 'social_media_activate_posts',
			'type' => 'checkbox',
		) ) );
						
		$wp_customize->add_setting( 'social_media_activate_pages', array (
			'sanitize_callback' => 'seos_football_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate_pages', array(
			'label'    => __( 'Activate Contacts Section in Pages:', 'seos-football' ),
			'section'  => 'seos_football_social_section_general',
			'settings' => 'social_media_activate_pages',
			'type' => 'checkbox',
		) ) );
		
/************ Social media option ***************/
 
		$wp_customize->add_section( 'seos_football_social_section' , array(
			'title'       => __( 'Social Media', 'seos-football' ),
			'panel'       => 'seos_football_contacts',
			'description' => __( 'Social media buttons', 'seos-football' ),
			'priority'   => 64,
		) );
		

		
		$wp_customize->add_setting( 'seos_football_social_link_type', array (
			'sanitize_callback' => 'seos_football_sanitize_social',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_social_link_type', array(
			'label'    => __( 'Link Type', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_social_link_type',
			'type'     =>  'select',
            'choices'  => array(
				'' => esc_attr__( ' ', 'seos-football' ),
				'_self' => esc_attr__( '_self', 'seos-football' ),
				'_blank' => esc_attr__( '_blank', 'seos-football' ),
            ),			
		) ) );
		
		$wp_customize->add_setting( 'social_media_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_color', array(
			'label'    => __( 'Social Icons Color:', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'social_media_color',
		) ) );
				
		$wp_customize->add_setting( 'social_media_hover_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_hover_color', array(
			'label'    => __( 'Social Hover Icons Color:', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'social_media_hover_color',
		) ) );
		
		$wp_customize->add_setting( 'seos_football_facebook', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_facebook', array(
			'label'    => __( 'Enter Facebook url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_facebook',
		) ) );
	
		$wp_customize->add_setting( 'seos_football_twitter', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_twitter', array(
			'label'    => __( 'Enter Twitter url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_twitter',
		) ) );

		$wp_customize->add_setting( 'seos_football_google', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_google', array(
			'label'    => __( 'Enter Google+ url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_google',
		) ) );
		
		$wp_customize->add_setting( 'seos_football_linkedin', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_linkedin', array(
			'label'    => __( 'Enter Linkedin url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_linkedin',
		) ) );


		$wp_customize->add_setting( 'seos_football_rss', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_rss', array(
			'label'    => __( 'Enter RSS url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_rss',
		) ) );
		
		$wp_customize->add_setting( 'seos_football_pinterest', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_pinterest', array(
			'label'    => __( 'Enter Pinterest url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_pinterest',
		) ) );
		
		$wp_customize->add_setting( 'seos_football_youtube', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_youtube', array(
			'label'    => __( 'Enter Youtube url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_youtube',
		) ) );
					
		$wp_customize->add_setting( 'seos_football_vimeo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_vimeo', array(
			'label'    => __( 'Enter Vimeo url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_vimeo',
		) ) );
		
							
		$wp_customize->add_setting( 'seos_football_instagram', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_instagram', array(
			'label'    => __( 'Enter Ynstagram url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_instagram',
		) ) );
			
		$wp_customize->add_setting( 'seos_football_stumbleupon', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_stumbleupon', array(
			'label'    => __( 'Enter Stumbleupon url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_stumbleupon',
		) ) );
											
		$wp_customize->add_setting( 'seos_football_flickr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_flickr', array(
			'label'    => __( 'Enter Flickr url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_flickr',
		) ) );
		
													
		$wp_customize->add_setting( 'seos_football_dribbble', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_dribbble', array(
			'label'    => __( 'Enter Dribbble url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_dribbble',
		) ) );
															
		$wp_customize->add_setting( 'seos_football_digg', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_digg', array(
			'label'    => __( 'Enter Digg url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_digg',
		) ) );
																	
		$wp_customize->add_setting( 'seos_football_skype', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_skype', array(
			'label'    => __( 'Enter Skype url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_skype',
		) ) );
																			
		$wp_customize->add_setting( 'seos_football_deviantart', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_deviantart', array(
			'label'    => __( 'Enter Deviantart url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_deviantart',
		) ) );
																					
		$wp_customize->add_setting( 'seos_football_yahoo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_yahoo', array(
			'label'    => __( 'Enter Yahoo url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_yahoo',
		) ) );
																							
		$wp_customize->add_setting( 'seos_football_reddit_alien', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_reddit_alien', array(
			'label'    => __( 'Enter Reddit Alien url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_reddit_alien',
		) ) );
		
																									
		$wp_customize->add_setting( 'seos_football_paypal', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_paypal', array(
			'label'    => __( 'Enter Paypal url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_paypal',
		) ) );
																											
		$wp_customize->add_setting( 'seos_football_dropbox', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_dropbox', array(
			'label'    => __( 'Enter Dropbox url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_dropbox',
		) ) );
																													
		$wp_customize->add_setting( 'seos_football_soundcloud', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_soundcloud', array(
			'label'    => __( 'Enter Soundcloud url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_soundcloud',
		) ) );
		
																															
		$wp_customize->add_setting( 'seos_football_vk', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_vk', array(
			'label'    => __( 'Enter VK url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_vk',
		) ) );
																																	
		$wp_customize->add_setting( 'seos_football_envelope', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_envelope', array(
			'label'    => __( 'Enter Envelope url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_envelope',
		) ) );
																																			
		$wp_customize->add_setting( 'seos_football_address_book', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_book', array(
			'label'    => __( 'Enter Address Book url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_book',
		) ) );
																																					
		$wp_customize->add_setting( 'seos_football_address_apple', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_apple', array(
			'label'    => __( 'Enter Apple url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_apple',
		) ) );
																																							
		$wp_customize->add_setting( 'seos_football_address_apple', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_amazon', array(
			'label'    => __( 'Enter Amazon url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_amazon',
		) ) );
																																									
		$wp_customize->add_setting( 'seos_football_address_slack', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_slack', array(
			'label'    => __( 'Enter Slack url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_slack',
		) ) );
																																											
		$wp_customize->add_setting( 'seos_football_address_slideshare', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_slideshare', array(
			'label'    => __( 'Enter Slideshare url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_slideshare',
		) ) );
																																													
		$wp_customize->add_setting( 'seos_football_address_wikipedia', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_wikipedia', array(
			'label'    => __( 'Enter Wikipedia url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_wikipedia',
		) ) );
																																															
		$wp_customize->add_setting( 'seos_football_address_wordpress', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_wordpress', array(
			'label'    => __( 'Enter WordPress url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_wordpress',
		) ) );
																																																	
		$wp_customize->add_setting( 'seos_football_address_odnoklassniki', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_odnoklassniki', array(
			'label'    => __( 'Enter Odnoklassniki url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_odnoklassniki',
		) ) );
																																																			
		$wp_customize->add_setting( 'seos_football_address_tumblr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_address_tumblr', array(
			'label'    => __( 'Enter Tumblr url', 'seos-football' ),
			'section'  => 'seos_football_social_section',
			'settings' => 'seos_football_address_tumblr',
		) ) );
			
	
/************ Contacts option ***************/
 
		$wp_customize->add_section( 'seos_football_contacts_section' , array(
			'title'       => __( 'Contacts', 'seos-football' ),
			'panel'       => 'seos_football_contacts',
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'social_media_contacts_address', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_contacts_address', array(
			'label'    => __( 'Add content and activate address:', 'seos-football' ),
			'section'  => 'seos_football_contacts_section',
			'settings' => 'social_media_contacts_address',
			'type' => 'text'
		) ) );
				
		$wp_customize->add_setting( 'social_media_contacts_phone', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_contacts_phone', array(
			'label'    => __( 'Add content and activate phone:', 'seos-football' ),
			'section'  => 'seos_football_contacts_section',
			'settings' => 'social_media_contacts_phone',
			'type' => 'text'
		) ) );
		
/***********************************************************************************
 * Search Options
***********************************************************************************/

		$wp_customize->add_section( 'seos_football_search_section' , array(
			'title'       => __( 'Search Options', 'seos-football' ),
			'description' => __( 'Search field in header', 'seos-football' ),
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'search_activate_header', array (
			'sanitize_callback' => 'seos_football_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'search_activate_header', array(
			'label'    => __( 'Activate search field in header:', 'seos-football' ),
			'section'  => 'seos_football_search_section',
			'settings' => 'search_activate_header',
			'type' => 'checkbox',
		) ) );
		
/***********************************************************************************
 * Sidebar Options
***********************************************************************************/
 
		$wp_customize->add_section( 'seos_football_sidebar' , array(
			'title'       => __( 'Sidebar Options', 'seos-football' ),
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'seos_football_sidebar_width', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_sidebar_width', array(
			'label'    => __( 'Sidebar Width:', 'seos-football' ),
			'section'  => 'seos_football_sidebar',		
			'settings' => 'seos_football_sidebar_width',
			'type'     =>  'range',		
			'input_attrs'     => array(
				'min'  => 10,
				'max'  => 50,
				'step' => 1,
	),			
		) ) );
		
		$wp_customize->add_setting( 'seos_football_sidebar_position', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_football_sidebar_position', array(
			'label'    => __( 'Sidebar Position', 'seos-football' ),
			'section'  => 'seos_football_sidebar',
			'settings' => 'seos_football_sidebar_position',
			'type' => 'radio',
			'choices' => array(
				'1' => __( 'Left', 'seos-football' ),
				'2' => __( 'Right', 'seos-football' ),
				'3' => __( 'No Sidebar', 'seos-football' ),
				),			
			
		) ) );
		
/********************************************
* Sidebar Title Background
*********************************************/ 
	
		$wp_customize->add_setting('seos_football_aside_background_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_football_aside_background_color', array(
		'label' => __('Sidebar Title Background Color', 'seos-football'),        
		'section' => 'seos_football_sidebar',
		'settings' => 'seos_football_aside_background_color'
		)));
		
/********************************************
* Sidebar Title Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_football_aside_title_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_football_aside_title_color', array(
		'label' => __('Sidebar Title Color', 'seos-football'),        
		'section' => 'seos_football_sidebar',
		'settings' => 'seos_football_aside_title_color'
		)));

/********************************************
* Sidebar Background
*********************************************/ 
	
		$wp_customize->add_setting('seos_football_aside_background_color1', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_football_aside_background_color1', array(
		'label' => __('Sidebar Background Color', 'seos-football'),        
		'section' => 'seos_football_sidebar',
		'settings' => 'seos_football_aside_background_color1'
		)));
		
/********************************************
* Sidebar Link Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_football_aside_link_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_football_aside_link_color', array(
		'label' => __('Sidebar Link Color', 'seos-football'),        
		'section' => 'seos_football_sidebar',
		'settings' => 'seos_football_aside_link_color'
		)));
						
/********************************************
* Sidebar Link Hover Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_football_aside_link_hover_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_football_aside_link_hover_color', array(
		'label' => __('Sidebar Link Hover Color', 'seos-football'),        
		'section' => 'seos_football_sidebar',
		'settings' => 'seos_football_aside_link_hover_color'
		)));
			
	
}
add_action( 'customize_register', 'seos_football_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seos_football_customize_preview_js() {
	wp_enqueue_script( 'seos_football_customizer', get_template_directory_uri() . '/framework/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'seos_football_customize_preview_js' );


		function seos_football_customize_all_css() {
    ?>
		<style type="text/css">
			<?php if ( (!is_front_page() or !is_home()) and get_theme_mod('custom_header_position') == "home") { ?> .site-header { display: none;} <?php } ?> 
			<?php if ( get_theme_mod('custom_header_position') == "deactivate") { ?> .site-header { display: none;} <?php } ?> 
			<?php if(get_theme_mod('seos_football_aside_background_color')) { ?>#content aside h2 {background:<?php echo esc_attr (get_theme_mod('seos_football_aside_background_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_football_aside_background_color1')) { ?>#content aside ul, #content .widget {background:<?php echo esc_attr (get_theme_mod('seos_football_aside_background_color1')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_football_aside_title_color')) { ?>#content aside h2 {color:<?php echo esc_attr (get_theme_mod('seos_football_aside_title_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_football_aside_link_color')) { ?>#content aside a {color:<?php echo esc_attr (get_theme_mod('seos_football_aside_link_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_football_aside_link_hover_color')) { ?>#content aside a:hover {color:<?php echo esc_attr (get_theme_mod('seos_football_aside_link_hover_color')); ?>;} <?php } ?> 
			
			<?php if(get_theme_mod('social_media_color')) { ?> .social .fa-icons i {color:<?php echo esc_attr (get_theme_mod('social_media_color')); ?> !important;} <?php } ?> 
			<?php if(get_theme_mod('social_media_hover_color')) { ?> .social .fa-icons i:hover {color:<?php echo esc_attr (get_theme_mod('social_media_hover_color')); ?> !important;} <?php } ?>

			<?php if(get_theme_mod('seos_football_titles_setting_1')) { ?> .single-title, .sr-no-sidebar .entry-title, .full-p .entry-title { display: none !important;} <?php } ?>

		</style>
		
    <?php	
}
		add_action('wp_head', 'seos_football_customize_all_css');
		
/**************************************
Sidebar Options
**************************************/


	function seos_football_sidebar_width () {
		if(get_theme_mod('seos_football_sidebar_width')) {
	
	$seos_football_content_width = 96;
	$seos_football_sidebar_width = esc_attr(get_theme_mod('seos_football_sidebar_width'));
	$seos_football_sidebar_sum = $seos_football_content_width - $seos_football_sidebar_width;

	?>
		<style>
			#content aside {width: <?php echo esc_attr(get_theme_mod('seos_football_sidebar_width')); ?>% !important;}
			#content main {width: <?php echo esc_attr($seos_football_sidebar_sum); ?>%  !important;}
		</style>
		
	<?php }
}
	add_action('wp_head','seos_football_sidebar_width');
	
/*********************************************************************************************************
* Sidebar Position
**********************************************************************************************************/

	function seos_football_sidebar(){
	$option_sidebar = get_theme_mod( 'seos_football_sidebar_position');		
	if($option_sidebar == '2') { 
			wp_enqueue_style( 'seos-right-sidebar', get_template_directory_uri() . '/css/right-sidebar.css');
		}

	$option_sidebar = get_theme_mod( 'seos_football_sidebar_position');			
		if($option_sidebar == '3') { 
			wp_enqueue_style( 'seos-no-sidebar', get_template_directory_uri() . '/css/no-sidebar.css');
		}
	}
	add_action( 'wp_enqueue_scripts', 'seos_football_sidebar' );
	
		
	
/***********************************************************************************
 * Buy
***********************************************************************************/

		function seos_football_support($wp_customize){
			class seos_Customize extends WP_Customize_Control {
				public function render_content() { ?>
				<div class="seos-info"> 
						<a href="<?php echo esc_url( 'https://seosthemes.com/wordpress-football-theme' ); ?>" title="<?php esc_attr_e( 'SEOS Football Pro', 'seos-football' ); ?>" target="_blank">
						<?php _e( 'Pro Feature', 'seos-football' ); ?>
						</a>
						<br /><br /><a href="<?php echo esc_url( 'https://seosthemes.info/wordpress-football-theme/' ); ?>" title="<?php esc_attr_e( 'Check demo here.', 'seos-football' ); ?>" target="_blank">
						<?php _e( 'Check demo here.', 'seos-football' ); ?>
						</a>								
				</div>
				<?php
				}
			}
		}
		add_action('customize_register', 'seos_football_support');

		function seos_football_seos_football_customize_styles_seos( $input ) { ?>
			<style type="text/css">
				#customize-theme-controls #accordion-panel-seos_football_buy_panel .accordion-section-title, #accordion-section-seos_football_buy_section0,
				#customize-theme-controls #accordion-panel-seos_football_buy_panel > .accordion-section-title {
					background: #555555 !important;
					color: #FFFFFF;
				}

				.seos-info button a {
					color: #FFFFFF;
				}

				#customize-theme-controls   #accordion-section-seos_football_buy_section .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section1 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section2 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section3 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section4 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section5 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section6 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section7 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section8 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section9 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section10 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section11 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section12 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section13 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section14 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section15 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section16 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section17 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section18 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section19 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section20 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section21 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section22 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section23 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section24 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_football_buy_section25 .accordion-section-title:after {
					font-size: 13px;
					font-weight: bold;
					content: "Premium";
					float: right;
					right: 40px;
					position: relative;
					color: #FF0000;
				}			
				
				#customize-control-seos_setting0 {
					display: none !important;
				}
				
			</style>
		<?php }
		
		add_action( 'customize_controls_print_styles', 'seos_football_seos_football_customize_styles_seos');

		if ( ! function_exists( 'seos_football_buy' ) ) :
			function seos_football_buy( $wp_customize ) {
			$wp_customize->add_panel( 'seos_football_buy_panel', array(
				'title'			=> __('SEOS Football Pro', 'seos-football'),
 
				'priority'		=> 200,
			));
			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section0', array(
				'title'			=> __('Preview The Theme', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
				'description'	=> __('	<a href="https://seosthemes.info/wordpress-football-theme/" target="_blank">Preview SEOS Football Pro.</a> ','seos-football'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting0', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,'seos_setting0', array(
						'section'	=> 'seos_football_buy_section0',
						'settings'	=> 'seos_setting0',
					)
				)
			);

/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section23', array(
				'title'			=> __('Image Slider', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting23', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting23', array(
						'label'		=> __('Image Slider', 'seos-football'),
						'section'	=> 'seos_football_buy_section23',
						'settings'	=> 'seos_setting23',
					)
				)
			);
			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section22', array(
				'title'			=> __('Gallery', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting22', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting22', array(
						'label'		=> __('Gallery', 'seos-football'),
						'section'	=> 'seos_football_buy_section22',
						'settings'	=> 'seos_setting22',
					)
				)
			);
			
	
						
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section2', array(
				'title'			=> __('Animations', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting2', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting2', array(
						'label'		=> __('Animations', 'seos-football'),
						'section'	=> 'seos_football_buy_section2',
						'settings'	=> 'seos_setting2',
					)
				)
			);
									
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section3', array(
				'title'			=> __('All Google Fonts', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting3', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting3', array(
						'label'		=> __('All Google Fonts', 'seos-football'),
						'section'	=> 'seos_football_buy_section3',
						'settings'	=> 'seos_setting3',
					)
				)
			);
												
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section4', array(
				'title'			=> __('Banners', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting4', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting4', array(
						'label'		=> __('Banners', 'seos-football'),
						'section'	=> 'seos_football_buy_section4',
						'settings'	=> 'seos_setting4',
					)
				)
			);
															
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section5', array(
				'title'			=> __('Shortcode Scroll Animation', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting5', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting5', array(
						'label'		=> __('Shortcode Scroll Animation', 'seos-football'),
						'section'	=> 'seos_football_buy_section5',
						'settings'	=> 'seos_setting5',
					)
				)
			);

																					
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section7', array(
				'title'			=> __('Disabel all Comments', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting7', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting7', array(
						'label'		=> __('Disabel all Comments', 'seos-football'),
						'section'	=> 'seos_football_buy_section7',
						'settings'	=> 'seos_setting7',
					)
				)
			);
																								
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section8', array(
				'title'			=> __('Entry Meta', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting8', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting8', array(
						'label'		=> __('Entry Meta', 'seos-football'),
						'section'	=> 'seos_football_buy_section8',
						'settings'	=> 'seos_setting8',
					)
				)
			);
			
																											
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section9', array(
				'title'			=> __('Hide Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting9', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting9', array(
						'label'		=> __('Hide All Titles', 'seos-football'),
						'section'	=> 'seos_football_buy_section9',
						'settings'	=> 'seos_setting9',
					)
				)
			);
																														
																																	
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section11', array(
				'title'			=> __('Players Custom Post Type', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting11', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting11', array(
						'label'		=> __('Players Custom Post Type', 'seos-football'),
						'section'	=> 'seos_football_buy_section11',
						'settings'	=> 'seos_setting11',
					)
				)
			);
																																				
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section12', array(
				'title'			=> __('WooCommerce Colors', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting12', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting12', array(
						'label'		=> __('WooCommerce Colors', 'seos-football'),
						'section'	=> 'seos_football_buy_section12',
						'settings'	=> 'seos_setting12',
					)
				)
			);
			
																																							
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section13', array(
				'title'			=> __('WooCommerce Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting13', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting13', array(
						'label'		=> __('WooCommerce Options', 'seos-football'),
						'section'	=> 'seos_football_buy_section13',
						'settings'	=> 'seos_setting13',
					)
				)
			);
																																										
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section14', array(
				'title'			=> __('Footer Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting14', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting14', array(
						'label'		=> __('Footer Options', 'seos-football'),
						'section'	=> 'seos_football_buy_section14',
						'settings'	=> 'seos_setting14',
					)
				)
			);

/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section5', array(
				'title'			=> __('Contacts Section', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting1', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting1', array(
						'label'		=> __('Contacts', 'seos-football'),
						'section'	=> 'seos_football_buy_section5',
						'settings'	=> 'seos_setting1',
					)
				)
			);

/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section24', array(
				'title'			=> __('Menu Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting1', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting1', array(
						'label'		=> __('Menu Options', 'seos-football'),
						'section'	=> 'seos_football_buy_section24',
						'settings'	=> 'seos_setting1',
					)
				)
			);
						
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section15', array(
				'title'			=> __('Font Sizes', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting15', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting15', array(
						'label'		=> __('Font Sizes', 'seos-football'),
						'section'	=> 'seos_football_buy_section15',
						'settings'	=> 'seos_setting15',
					)
				)
			);
																																																
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section16', array(
				'title'			=> __('Under Construction', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting16', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting16', array(
						'label'		=> __('Under Construction', 'seos-football'),
						'section'	=> 'seos_football_buy_section16',
						'settings'	=> 'seos_setting16',
					)
				)
			);
																																																			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section17', array(
				'title'			=> __('Read More Button Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting17', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting17', array(
						'label'		=> __('Read More Button Options', 'seos-football'),
						'section'	=> 'seos_football_buy_section17',
						'settings'	=> 'seos_setting17',
					)
				)
			);

																																																												
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section20', array(
				'title'			=> __('Back To Top Button Options', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting20', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting20', array(
						'label'		=> __('Back To Top Button Options', 'seos-football'),
						'section'	=> 'seos_football_buy_section20',
						'settings'	=> 'seos_setting20',
					)
				)
			);
		
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_football_buy_section21', array(
				'title'			=> __('Copy Protection', 'seos-football'),
				'panel'			=> 'seos_football_buy_panel',
 
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_setting21', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_Customize(
					$wp_customize,'seos_setting21', array(
						'label'		=> __('Copy Protection', 'seos-football'),
						'section'	=> 'seos_football_buy_section21',
						'settings'	=> 'seos_setting21',
					)
				)
			);			
			
		}
		endif;
		 
		add_action('customize_register', 'seos_football_buy');