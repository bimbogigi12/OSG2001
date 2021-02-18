<?php
/**
 * Multipurpose Photography Theme Customizer
 * @package Multipurpose Photography
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function multipurpose_photography_customize_register( $wp_customize ) {	

	//add home page setting pannel
	$wp_customize->add_panel( 'multipurpose_photography_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'multipurpose-photography' ),
	    'description' => __( 'Description of what this panel does.', 'multipurpose-photography' ),
	) );

	//layout setting
	$wp_customize->add_section( 'multipurpose_photography_theme_layout', array(
    	'title'      => __( 'Layout Settings', 'multipurpose-photography' ),    	
    	'description'	=> __('Here you can select the blog sidebar layout.','multipurpose-photography'),
		'priority'   => null,
		'panel' => 'multipurpose_photography_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('multipurpose_photography_layout',array(
        'default' => __( 'Right Sidebar', 'multipurpose-photography' ),
        'sanitize_callback' => 'multipurpose_photography_sanitize_choices'
	) );
	$wp_customize->add_control(new multipurpose_photography_Image_Radio_Control($wp_customize, 'multipurpose_photography_layout', array(
        'type' => 'radio',
        'label' => esc_html__('Select Sidebar layout', 'multipurpose-photography'),
        'section' => 'multipurpose_photography_theme_layout',
        'settings' => 'multipurpose_photography_layout',
        'choices' => array(
            'Right Sidebar' => get_template_directory_uri() . '/images/layout3.png',
            'Left Sidebar' => get_template_directory_uri() . '/images/layout2.png',
            'One Column' => get_template_directory_uri() . '/images/layout1.png',
            'Three Columns' => get_template_directory_uri() . '/images/layout4.png',
            'Four Columns' => get_template_directory_uri() . '/images/layout5.png',
            'Grid Layout' => get_template_directory_uri() . '/images/layout6.png'
   	))));

	//Topbar section
	$wp_customize->add_section('multipurpose_photography_topbar_icon',array(
		'title'	=> __('Topbar Section','multipurpose-photography'),
		'description'	=> __('Add Header Content here','multipurpose-photography'),
		'priority'	=> null,
		'panel' => 'multipurpose_photography_panel_id',
	));

	$wp_customize->add_setting('multipurpose_photography_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('multipurpose_photography_call',array(
		'label'	=> __('Add Phone No.','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_call',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('multipurpose_photography_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_facebook_url',array(
		'label'	=> __('Add Facebook link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_twitter_url',array(
		'label'	=> __('Add Twitter link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_insta_url',array(
		'label'	=> __('Add Instagram link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('multipurpose_photography_youtube_url',array(
		'label'	=> __('Add Youtube link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_youtube_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_linkedin_url',array(
		'label'	=> __('Add Youtube link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_pinterest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_pinterest_url',array(
		'label'	=> __('Add Pinterest link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_pinterest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_tumblr_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('multipurpose_photography_tumblr_url',array(
		'label'	=> __('Add Tumblr link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_tumblr_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_google_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('multipurpose_photography_google_url',array(
		'label'	=> __('Add Google link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_google_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('multipurpose_photography_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('multipurpose_photography_rss_url',array(
		'label'	=> __('Add Google link','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_topbar_icon',
		'setting'	=> 'multipurpose_photography_rss_url',
		'type'	=> 'url'
	));

	//Slider section
  	$wp_customize->add_section('multipurpose_photography_slidersettings',array(
	    'title' => __('Slider Section','multipurpose-photography'),
	    'description' => '',
	    'priority'  => null,
	    'panel' => 'multipurpose_photography_panel_id',
	)); 

	$wp_customize->add_setting('multipurpose_photography_slider_hide_show',array(
	  'default' => 'false',
	  'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('multipurpose_photography_slider_hide_show',array(
	  'type' => 'checkbox',
	  'label' => __('Show / Hide slider','multipurpose-photography'),
	  'section' => 'multipurpose_photography_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		// Add color scheme setting and control.
		$wp_customize->add_setting( 'multipurpose_photography_slidersettings_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'multipurpose_photography_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'multipurpose_photography_slidersettings_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'multipurpose-photography' ),
			'section'  => 'multipurpose_photography_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//About Section
	$wp_customize->add_section('multipurpose_photography_services',array(
		'title'	=> __('Services Section','multipurpose-photography'),
		'description'	=> __('Add About sections below.','multipurpose-photography'),
		'panel' => 'multipurpose_photography_panel_id',
	));

	$wp_customize->add_setting('multipurpose_photography_services_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('multipurpose_photography_services_title',array(
		'label'	=> __('Section Title','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_services',
		'type'		=> 'text'
	));

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('multipurpose_photography_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('multipurpose_photography_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','multipurpose-photography'),
		'description'=> __('Size of image should be 80 x 80 ','multipurpose-photography'),
		'section' => 'multipurpose_photography_services',
	));

	//footer text
	$wp_customize->add_section('multipurpose_photography_footer_section',array(
		'title'	=> __('Footer Text','multipurpose-photography'),
		'description'	=> __('Add some text for footer like copyright etc.','multipurpose-photography'),
		'panel' => 'multipurpose_photography_panel_id'
	));
	
	$wp_customize->add_setting('multipurpose_photography_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('multipurpose_photography_text',array(
		'label'	=> __('Copyright Text','multipurpose-photography'),
		'section'	=> 'multipurpose_photography_footer_section',
		'type'		=> 'text'
	));	
}
add_action( 'customize_register', 'multipurpose_photography_customize_register' );	

load_template( ABSPATH . 'wp-includes/class-wp-customize-control.php' );

class multipurpose_photography_Image_Radio_Control extends WP_Customize_Control {

    public function render_content() {
 
        if (empty($this->choices))
            return;
 
        $name = '_customize-radio-' . $this->id;
        ?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <ul class="controls" id='multipurpose-photography-img-container'>
            <?php
            foreach ($this->choices as $value => $label) :
                $class = ($this->value() == $value) ? 'multipurpose-photography-radio-img-selected multipurpose-photography-radio-img-img' : 'multipurpose-photography-radio-img-img';
                ?>
                <li style="display: inline;">
                    <label>
                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
                          	$this->link();
                          	checked($this->value(), $value);
                          	?> />
                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
                    </label>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
        <?php
    } 
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Multipurpose_Photography_Customize {

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
		$manager->register_section_type( 'Multipurpose_photography_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Multipurpose_photography_Customize_Section_Pro(
			$manager,
			'example_1',
				array(
				'priority'   => 9,
				'title'    => esc_html__( 'Photography Pro', 'multipurpose-photography' ),
				'pro_text' => esc_html__( 'Go Pro', 'multipurpose-photography' ),
				'pro_url'  => esc_url('https://www.themesglance.com/themes/wordpress-photography-themes/')					
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

		wp_enqueue_script( 'multipurpose-photography-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'multipurpose-photography-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!

Multipurpose_Photography_Customize::get_instance();