<?php
/**
 * video functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Video
 */


/*********************************************************************************************************
* Basics
**********************************************************************************************************/

if ( ! function_exists( 'seos_video_setup' ) ) :

function seos_video_setup() {

	load_theme_textdomain( 'seos-video', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
			
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'seos-video' ),
	) );
	
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seos_video_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'seos_video_setup' );
	
function seos_video_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seos_video_content_width', 640 );
}
add_action( 'after_setup_theme', 'seos_video_content_width', 0 );

/**
 * Register widget area.
 */
function seos_video_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'seos-video' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'seos-video' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
}

add_action( 'widgets_init', 'seos_video_widgets_init' );

/************************** Includes ******************************/

		require get_template_directory() . '/inc/custom-header.php';
		require get_template_directory() . '/inc/template-tags.php';
		require get_template_directory() . '/inc/extras.php';
		require get_template_directory() . '/inc/customizer.php';
		require get_template_directory() . '/inc/jetpack.php';
		require get_template_directory() . '/inc/premium-options.php';
		require get_template_directory() . '/js/viewportchecker.php';
	
/**
 * Enqueue scripts and styles.
 */
function seos_video_scripts() {
	wp_enqueue_style( 'seos-video-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery');
	
	wp_enqueue_style( 'seos_video_animation_menu', get_template_directory_uri() . '/css/bounceInUp.css');
	
	wp_enqueue_style( 'seos_video_animata_css', get_template_directory_uri() . '/css/animate.css');
	
	wp_enqueue_style( 'seos_scroll_css', get_template_directory_uri() . '/css/scroll-effect.css');

	wp_enqueue_script( 'viewportchecker', get_template_directory_uri() . '/js/viewportchecker.js');
	
	wp_enqueue_script( 'seos-video-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'seos-video-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seos_video_scripts' );


function seos_video_admin_scripts() {

	wp_enqueue_style( 'seos_video_admin', get_template_directory_uri() . '/css/admin.css');

}

add_action( 'admin_enqueue_scripts', 'seos_video_admin_scripts' );


/*********************************************************************************************************
* Excerpt
**********************************************************************************************************/
	
function seos_video_excerpt_more( $seos_video_link ) {
	if ( is_admin() ) {
		return $seos_video_link;
	}

	$seos_video_link = sprintf( '<p class="link-more"><a href="%1$s" class="read-more">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'seos-video' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $seos_video_link;
}
add_filter( 'excerpt_more', 'seos_video_excerpt_more' );

/***********************************************************************************
 * Seos Video Buy
***********************************************************************************/

		function magazine_news_support($wp_customize){
			class magazine_news_Customize extends WP_Customize_Control {
				public function render_content() { ?>
				<div class="seos_video-info"> 
						<a class="sv-info" href="<?php echo esc_url( 'https://seosthemes.com/free-wordpress-video-theme/' ); ?>" title="<?php esc_attr_e( 'Seos Video Pro Feature', 'seos-video' ); ?>" target="_blank">
						<?php _e( 'Seos Video Pro Feature', 'seos-video' ); ?>
						</a>
						<br />
						<br />
						<a class="sv-info" href="<?php echo esc_url( 'https://seosthemes.info/seos-video-free-wp-theme/' ); ?>" title="<?php esc_attr_e( 'Check demo here.', 'seos-video' ); ?>" target="_blank">
						<?php _e( 'Check demo here.', 'seos-video' ); ?>
						</a>
				</div>
				<?php
				}
			}
		}
		add_action('customize_register', 'magazine_news_support');

		function customize_styles_magazine_news( $input ) { ?>
			<style type="text/css">
				#customize-theme-controls #accordion-section-seos_video_buy_section .accordion-section-title,
				#customize-theme-controls #accordion-section-seos_video_buy_section > .accordion-section-title {
					background: #555555;
					color: #FFFFFF;
				}

				.magazine_news-info button a {
					color: #FFFFFF;
				}	
			</style>
		<?php }
		
		add_action( 'customize_controls_print_styles', 'customize_styles_magazine_news');

		if ( ! function_exists( 'seos_video_buy' ) ) :
			function seos_video_buy( $wp_customize ) {
				
				$wp_customize->add_panel( 'seos_video_buy_panel', array(
				'title'			=> __('Seos Video Premium Options', 'seos-video'),

				'priority'		=> 200,
			));
			
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section', array(
				'title'			=> __('Seos Video Premium', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting', array(
						'label'		=> __('Seos Video  Premium', 'seos-video'),
						'section'	=> 'seos_video_buy_section',
						'settings'	=> 'seos_video_setting',
					)
				)
			);

			
						
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section1', array(
				'title'			=> __('Homepage Image Slider 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting1', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting1', array(
						'label'		=> __('Homepage Image Slider', 'seos-video'),
						'section'	=> 'seos_video_buy_section1',
						'settings'	=> 'seos_video_setting1',
					)
				)
			);			
						
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section12', array(
				'title'			=> __('Seos Video Slider 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting12', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting12', array(
						'label'		=> __('Homepage Image Slider', 'seos-video'),
						'section'	=> 'seos_video_buy_section12',
						'settings'	=> 'seos_video_setting12',
					)
				)
			);

			
						
						
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section2', array(
				'title'			=> __('Hide Options 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting2', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting2', array(
						'label'		=> __('Hide Options', 'seos-video'),
						'section'	=> 'seos_video_buy_section2',
						'settings'	=> 'seos_video_setting2',
					)
				)
			);
		

									
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section4', array(
				'title'			=> __('Header Logo 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting4', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting4', array(
						'label'		=> __('Header Logo', 'seos-video'),
						'section'	=> 'seos_video_buy_section4',
						'settings'	=> 'seos_video_setting4',
					)
				)
			);

												
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section5', array(
				'title'			=> __('Mobile CalL Now 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting5', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting5', array(
						'label'		=> __('Mobile CalL Now', 'seos-video'),
						'section'	=> 'seos_video_buy_section5',
						'settings'	=> 'seos_video_setting5',
					)
				)
			);
/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section3', array(
				'title'			=> __('Read More Options 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting3', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting3', array(
						'label'		=> __('Read More Options', 'seos-video'),
						'section'	=> 'seos_video_buy_section3',
						'settings'	=> 'seos_video_setting3',
					)
				)
			);
			
			/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section6', array(
				'title'			=> __('Remove Comments 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting6', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting6', array(
						'label'		=> __('Remove Comments', 'seos-video'),
						'section'	=> 'seos_video_buy_section6',
						'settings'	=> 'seos_video_setting6',
					)
				)
			);
			
						
			/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section7', array(
				'title'			=> __('Back to Top 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting7', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting7', array(
						'label'		=> __('Back to Top', 'seos-video'),
						'section'	=> 'seos_video_buy_section7',
						'settings'	=> 'seos_video_setting7',
					)
				)
			);
									
			/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section8', array(
				'title'			=> __('WooCommerce Options 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting8', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting8', array(
						'label'		=> __('WooCommerce Options', 'seos-video'),
						'section'	=> 'seos_video_buy_section8',
						'settings'	=> 'seos_video_setting8',
					)
				)
			);
			
															
			/***********************************************************************/

		
			$wp_customize->add_section( 'seos_video_buy_section11', array(
				'title'			=> __('Footer Options 🔒', 'seos-video'),
				'panel'			=> 'seos_video_buy_panel',	

				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_video_setting11', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new magazine_news_Customize(
					$wp_customize,'seos_video_setting11', array(
						'label'		=> __('Footer Options', 'seos-video'),
						'section'	=> 'seos_video_buy_section11',
						'settings'	=> 'seos_video_setting11',
					)
				)
			);
			
			
			
			
		}
		endif;
		 
		add_action('customize_register', 'seos_video_buy');
		
		
