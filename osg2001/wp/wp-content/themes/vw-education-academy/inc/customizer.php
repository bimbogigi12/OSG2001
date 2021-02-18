<?php
/**
 * VW Education Academy Theme Customizer
 *
 * @package VW Education Academy
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_education_academy_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_education_academy_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-education-academy' ),
	) );

	// Layout
	$wp_customize->add_section( 'vw_education_academy_left_right', array(
    	'title'      => __( 'General Settings', 'vw-education-academy' ),
		'panel' => 'vw_education_academy_panel_id'
	) );

	$wp_customize->add_setting('vw_education_academy_theme_options',array(
        'default' => __('Right Sidebar','vw-education-academy'),
        'sanitize_callback' => 'vw_education_academy_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_education_academy_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-education-academy'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-education-academy'),
        'section' => 'vw_education_academy_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-education-academy'),
            'Right Sidebar' => __('Right Sidebar','vw-education-academy'),
            'One Column' => __('One Column','vw-education-academy'),
            'Three Columns' => __('Three Columns','vw-education-academy'),
            'Four Columns' => __('Four Columns','vw-education-academy'),
            'Grid Layout' => __('Grid Layout','vw-education-academy')
        ),
	) );

	$wp_customize->add_setting('vw_education_academy_page_layout',array(
        'default' => __('Right Sidebar','vw-education-academy'),
        'sanitize_callback' => 'vw_education_academy_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_education_academy_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-education-academy'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-education-academy'),
        'section' => 'vw_education_academy_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-education-academy'),
            'Right Sidebar' => __('Right Sidebar','vw-education-academy'),
            'One Column' => __('One Column','vw-education-academy')
        ),
	) );

	//Topbar
	$wp_customize->add_section( 'vw_education_academy_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-education-academy' ),
		'panel' => 'vw_education_academy_panel_id'
	) );

	$wp_customize->add_setting('vw_education_academy_header_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_education_academy_header_call',array(
		'label'	=> __('Add Phone Number','vw-education-academy'),
		'input_attrs' => array(
            'placeholder' => __( '+00 123 125 4568', 'vw-education-academy' ),
        ),
		'section'=> 'vw_education_academy_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_education_academy_header_email',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_education_academy_header_email',array(
		'label'	=> __('Add Email Address','vw-education-academy'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'vw-education-academy' ),
        ),
		'section'=> 'vw_education_academy_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_education_academy_header_search',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_education_academy_header_search',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Search','vw-education-academy'),
       'section' => 'vw_education_academy_topbar',
    ));
    
	//Slider
	$wp_customize->add_section( 'vw_education_academy_slidersettings' , array(
    	'title'      => __( 'Slider Section', 'vw-education-academy' ),
		'panel' => 'vw_education_academy_panel_id'
	) );

	$wp_customize->add_setting('vw_education_academy_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_education_academy_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-education-academy'),
       'section' => 'vw_education_academy_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'vw_education_academy_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_education_academy_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_education_academy_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-education-academy' ),
			'description' => __('Slider image size (1500 x 590)','vw-education-academy'),
			'section'  => 'vw_education_academy_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//About us section
	$wp_customize->add_section( 'vw_education_academy_about_section' , array(
    	'title'      => __( 'About us', 'vw-education-academy' ),
		'priority'   => null,
		'panel' => 'vw_education_academy_panel_id'
	) );

	$wp_customize->add_setting('vw_education_academy_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_education_academy_section_title',array(
		'label'	=> __('Add Section Title','vw-education-academy'),
		'input_attrs' => array(
            'placeholder' => __( 'ABOUT US', 'vw-education-academy' ),
        ),
		'section'=> 'vw_education_academy_about_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_education_academy_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'vw_education_academy_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_education_academy_about_page', array(
		'label'    => __( 'Select About Page', 'vw-education-academy' ),
		'section'  => 'vw_education_academy_about_section',
		'type'     => 'dropdown-pages'
	) );

	//Content Craetion
	$wp_customize->add_section( 'vw_education_academy_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-education-academy' ),
		'priority' => null,
		'panel' => 'vw_education_academy_panel_id'
	) );

	$wp_customize->add_setting('vw_education_academy_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new vw_education_academy_Content_Creation( $wp_customize, 'vw_education_academy_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-education-academy' ),
		),
		'section' => 'vw_education_academy_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-education-academy' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_education_academy_footer',array(
		'title'	=> __('Footer','vw-education-academy'),
		'panel' => 'vw_education_academy_panel_id',
	));	
	
	$wp_customize->add_setting('vw_education_academy_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_education_academy_footer_text',array(
		'label'	=> __('Copyright Text','vw-education-academy'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-education-academy' ),
        ),
		'section'=> 'vw_education_academy_footer',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_education_academy_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Education_Academy_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Education_Academy_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Education_Academy_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Education PRO', 'vw-education-academy' ),
					'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-education-academy' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/academic-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-education-academy-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-education-academy-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Education_Academy_Customize::get_instance();