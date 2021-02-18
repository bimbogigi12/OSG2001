<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Sample implementation of the Custom Header feature.
 *
 */
function seos_football_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'seos_football_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/framework/images/athletes.jpg',	
		'default-text-color'     => 'fff',
		'width'                  => 1300,
		'height'                 => 250,
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'seos_football_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'seos_football_custom_header_setup' );

register_default_headers( array(
    'img1' => array(
        'url'           => get_stylesheet_directory_uri() . '/framework/images/athletes.jpg',
        'thumbnail_url' => get_stylesheet_directory_uri() . '/framework/images/athletes.jpg',
        'description'   => esc_html__( 'Default Image 1', 'seos-football' )
    ),	
	
    'img2' => array(
        'url'           => get_stylesheet_directory_uri() . '/framework/images/header.gif',
        'thumbnail_url' => get_stylesheet_directory_uri() . '/framework/images/header.gif',
        'description'   => esc_html__( 'Default Image 2', 'seos-football' )
    ),

));

if ( ! function_exists( 'seos_football_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see seos_football_custom_header_setup().
 */
function seos_football_header_style() {
	$seos_football_header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			.site-title,
			.site-description {
				display: none !important;
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			header .site-branding .site-title a, header .header-img .site-title a, header .header-img .site-description,
			header  .site-branding .site-description {
				color: #<?php echo esc_attr( $seos_football_header_text_color ); ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}
endif;

/**
 * Custom Header Options
 */

add_action( 'customize_register', 'seos_football_customize_custom_header_meta' );

function seos_football_customize_custom_header_meta($wp_customize ) {
	
    $wp_customize->add_setting(
        'custom_header_position',
        array(
            'default'    => 'default',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'seos_football_sanitize_select',			
        )
    );

    $wp_customize->add_control(
        'custom_header_position',
        array(
            'settings' => 'custom_header_position',	
			'priority'    => 1,
            'label'    => __( 'Activate Header Image:', 'seos-football' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                'deactivate' => __( 'Deactivate Header Image', 'seos-football' ),
                'default' => __( 'Default Image', 'seos-football' ),
                'all' => __( 'All Pages', 'seos-football' ),
                'home'  => __( 'Home Page', 'seos-football' )
            ),
			'default'    => 'deactivate'
        )
    );
	
    $wp_customize->add_setting(
        'custom_header_overlay',
        array(
            'default'    => 'on',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'seos_football_sanitize_overlay',			
        )
    );

    $wp_customize->add_control(
        'custom_header_overlay',
        array(
            'settings' => 'custom_header_overlay',
			'priority'    => 1,			
            'label'    => __( 'Hide Overlay:', 'seos-football' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                '' => __( ' ', 'seos-football' ),
                'on' => __( 'Show Overlay', 'seos-football' ),
                'off'  => __( 'Hide Overlay', 'seos-football' )
            ),
			'default'    => 'on'
        )
    );

	$wp_customize->add_setting( 'header_height', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'header_height', array(
		'type' => 'number',
		'priority' => 1,
		'section' => 'header_image',
		'label' => __( 'Custom Height: ', 'seos-football' ),
		'description' => __( 'Min-height 200px.', 'seos-football' ),
		'input_attrs' => array(
			'min' => 200,
			'max' => 1000,
			'step' => 1,
		),
	) );
	
    $wp_customize->add_setting(
        'custom_header_background_attachment',
        array(
            'default'    => 'inherit',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'seos_football_sanitize_background_attachment',			
        )
    );

    $wp_customize->add_control(
        'custom_header_background_attachment',
        array(
            'settings' => 'custom_header_background_attachment',	
			'priority'    => 1,
            'label'    => __( 'Background Attachment:', 'seos-football' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                'inherit' => __( 'Inherit', 'seos-football' ),
                'fixed' => __( 'Fixed', 'seos-football' )
            ),
			'default'    => 'inherit'
        )
    );

    $wp_customize->add_setting(
        'custom_header_image_repeat',
        array(
            'default'    => 'no-repead',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'seos_football_sanitize_image_repeat',			
        )
    );

    $wp_customize->add_control(
        'custom_header_image_repeat',
        array(
            'settings' => 'custom_header_image_repeat',	
			'priority'    => 1,
            'label'    => __( 'Image Repaed:', 'seos-football' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                'no-repeat' => __( 'No Repeat', 'seos-football' ),			
                'repeat' => __( 'Repeat', 'seos-football' )
            ),
			'default'    => 'no-repeat'
        )
    );
	
    $wp_customize->add_setting(
        'custom_header_image_shadow',
        array(
            'default'    => 'show',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'seos_football_sanitize_image_shadow',			
        )
    );

    $wp_customize->add_control(
        'custom_header_image_shadow',
        array(
            'settings' => 'custom_header_image_shadow',	
			'priority'    => 1,
            'label'    => __( 'Header Shadow:', 'seos-football' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
				'show' => __( 'Show', 'seos-football' ),
                'hide' => __( 'Hide', 'seos-football' )
            ),
			'default'    => 'show'
        )
    );		
}

function seos_football_customize_css () { ?>
	<style>
		<?php if(get_theme_mod('header_height')) { ?> .header-img { height: <?php echo esc_attr(get_theme_mod('header_height')); ?>px; } <?php } ?>
		<?php if(get_theme_mod('custom_header_image_repeat') == "repeat") { ?> .header-img { background-repeat: repeat !important; background-size: inherit !important; } <?php } ?>
		<?php if(get_theme_mod('custom_header_image_shadow') =="hide") { ?> .header-img { -webkit-box-shadow: none !important; } <?php } ?>
		<?php if(get_theme_mod('custom_header_background_attachment')) { ?> .header-img { background-attachment: <?php echo esc_attr(get_theme_mod('custom_header_background_attachment')); ?>; } <?php } ?>
	</style>
<?php	
}

add_action('wp_head','seos_football_customize_css');

function seos_football_sanitize_background_attachment( $input ) {
	$valid = array(
                'inherit' => __( 'Inherit', 'seos-football' ),
                'fixed' => __( 'Fixed', 'seos-football' )
	);
	
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function seos_football_sanitize_image_repeat( $input ) {
	$valid = array(
                'no-repeat' => __( 'No Repeat', 'seos-football' ),			
                'repeat' => __( 'Repeat', 'seos-football' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function seos_football_sanitize_image_shadow( $input ) {
	$valid = array(
				'show' => __( 'Show', 'seos-football' ),
                'hide' => __( 'Hide', 'seos-football' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function seos_football_sanitize_select( $input ) {
	$valid = array(
                'deactivate' => __( 'Deactivate Header Image', 'seos-football' ),
                'default' => __( 'Default Image', 'seos-football' ),
                'all' => __( 'All Pages', 'seos-football' ),
                'home'  => __( 'Home Page', 'seos-football' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function seos_football_sanitize_overlay( $input ) {
	$valid = array(
        '' => __( ' ', 'seos-football' ),
        'on' => __( 'Show Overlay', 'seos-football' ),
        'off'  => __( 'Hide Overlay', 'seos-football' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}