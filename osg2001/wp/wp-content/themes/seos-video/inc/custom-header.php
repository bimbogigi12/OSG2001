<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses seos_video_header_style()
 */
function seos_video_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'seos_video_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/header.png',
		'default-text-color'     => 'CEBF94',
		'width'                  => 1300,
		'height'                 => 100,
		'flex-height'            => true,
		'wp-head-callback'       => 'seos_video_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'seos_video_custom_header_setup' );

register_default_headers( array(
	'yourimg' => array(
	'url' => get_template_directory_uri() . '/images/header.png',
	'thumbnail_url' => get_template_directory_uri() . '/images/header.png',
	'description' => _x( 'Default Image', 'header image description', 'seos-video' )),
));

if ( ! function_exists( 'seos_video_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see seos_video_custom_header_setup().
 */
function seos_video_header_style() {
	$seos_video_header_text_color = get_header_textcolor();

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
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			header .site-branding .site-title a,
			.site-description {
				color: #<?php echo esc_attr( $seos_video_header_text_color ); ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}
endif;
