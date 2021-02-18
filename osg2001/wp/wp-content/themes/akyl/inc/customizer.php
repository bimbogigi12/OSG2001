<?php
/**
 * Add support for custom backgrounds
 */
add_theme_support( 'custom-background', array(
	'default-color' => 'f2f6ff',
	'default-image' => '',
));

/**
 * Add support for custom headers
 */
add_theme_support( 'custom-header', array(
	'width'         => 1500,
	'height'        => 300,
	'uploads'       => true,
));

/**
 * Add theme support for site logo
 */
add_theme_support( 'custom-logo' );

function akyl_customize_register( $wp_customize ) {

	/**--------------------------------
	 * Modify core settings
	 --------------------------------*/
	$wp_customize->get_setting( 'header_textcolor' )->type = 'option'; // get_option faster than get_theme_mod
	$wp_customize->get_setting( 'header_textcolor' )->default = '#fff';
	$wp_customize->get_setting( 'background_color' )->default = '#f2f6ff';

	/**--------------------------------------
	 * Add Header Background Color Setting
	 -----------------------------------------*/
	$wp_customize->add_setting( 'akyl_header_background_color' , array(
		'default'   => '#2c4769',
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'akyl_header_background_color', 
		array(
			'label'      => __( 'Header Background Color', 'akyl' ),
			'section'    => 'colors',
			'settings'   => 'akyl_header_background_color',
		) 
	) );

	/**--------------------------------
	 * Add Footer Settings
	 --------------------------------*/
	$wp_customize->add_section( 'akyl_footer_settings', array(
		'title' => __( 'Footer', 'akyl' ),
		'priority' => 90,
	));

	// Footer Background Color
	$wp_customize->add_setting( 'akyl_footer_background_color' , array(
		'default'   => '#041323',
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'akyl_footer_background_color', 
		array(
			'label'      => __( 'Footer Background Color', 'akyl' ),
			'section'    => 'akyl_footer_settings',
			'settings'   => 'akyl_footer_background_color',
		) 
	) );

	// Footer Widget Background Color
	$wp_customize->add_setting( 'akyl_footer_widget_area_background_color' , array(
		'default'   => '#05182c',
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'akyl_footer_widget_area_background_color', 
		array(
			'label'      => __( 'Footer Widget Area Background Color', 'akyl' ),
			'section'    => 'akyl_footer_settings',
			'settings'   => 'akyl_footer_widget_area_background_color',
		) 
	) );

	/**--------------------------------
	 * Add Social Links Settings
	 --------------------------------*/
	$wp_customize->add_section( 'akyl_social_settings', array(
		 'title' => __( 'Social Media Links', 'akyl' ),
		 'priority' => 100,
	 ));
	 
	$social_sites = array(
		'akyl_facebook', 
		'akyl_twitter', 
		'akyl_google-plus',
		'akyl_dribbble',
		'akyl_instagram',
	);

	$priority = 5;
	 
	foreach( $social_sites as $social_site ) {
	 
		$wp_customize->add_setting( "$social_site", array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control( $social_site, array(
			'label' => ucwords( str_replace('akyl_', '', $social_site) . "URL:" ),
			'section' => 'akyl_social_settings',
			'type' => 'url',
			'priority' => $priority,
		));

		$priority += 5;
	}
}
add_action( 'customize_register', 'akyl_customize_register' );

function akyl_customize_css()
{
	?>
	 <style type="text/css">
		<?php if ( ! get_option('background_image') ): ?>

			.bg-image::after { background-color: <?php echo esc_attr(get_option('background_color')); ?>; }

		<?php endif; ?>

		.banner, .site-title a { color: #<?php echo esc_attr(get_option('header_textcolor')); ?>; }
		.banner { background-color: <?php echo esc_attr(get_option('akyl_header_background_color', '#2c4769')); ?>; }
		footer { background-color: <?php echo esc_attr(get_option('akyl_footer_background_color', '#041323')); ?>; }
		.footer-widget-area { background-color: <?php echo esc_attr(get_option('akyl_footer_widget_area_background_color', '#05182c')); ?>; }
	 </style>
	<?php
}
add_action( 'wp_head', 'akyl_customize_css');