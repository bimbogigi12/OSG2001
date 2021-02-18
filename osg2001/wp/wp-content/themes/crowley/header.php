<?php
/**
 * Header template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="<?php evolvethemes_html_class(); ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<a class="screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'crowley' ); ?></a>

		<div class="<?php evolvethemes_layout_class(); ?>">

		<?php
			/**
			 * Function that is entitled to display header markup.
			 *
			 * Eg. add_action( 'evolvethemes_header', 'your_custom_function' );
			 */
			evolvethemes_header();
		?>
