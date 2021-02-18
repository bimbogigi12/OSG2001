<?php
/**
 * The header template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
$crowley_header_image = get_header_image();
$crowley_header_style = '';
$crowley_header_class = array(
	$evolvethemes_key . '-h',
);

if ( $crowley_header_image ) {
	$crowley_header_style = 'background-image:url(' . esc_attr( $crowley_header_image ) . ')';
	$crowley_header_class[] = $evolvethemes_key . '-w-h-bg';
}

?>
<?php printf( '<header class="%s" role="banner">', esc_attr( implode( ' ', $crowley_header_class ) ) ); ?>

	<?php printf( '<div class="%s-h-logo_w" style="%s">', esc_attr( $evolvethemes_key ), esc_attr( $crowley_header_style ) ); ?>
		<?php printf( '<div class="%s-h-logo_w-i">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_logo(); ?>
		</div>
	</div>

	<?php evolvethemes_nav(); ?>
</header>
