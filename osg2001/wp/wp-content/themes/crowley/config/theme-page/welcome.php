<?php
/**
 * The theme page content.
 *
 * @package WordPress
 * @subpackage theme-page
 * @since 1.0.0
 */

?>
<div class="wp-clearfix">
	<div class="evolvethemes-themepage-content">

		<div class="evolvethemes-themepage-promo">
			<div class="evolvethemes-themepage-promo_w">
				<h3><?php echo esc_html__( 'Delivering Beautiful & Unique WordPress themes and plugins', 'crowley' ); ?></h3>
				<p><?php echo esc_html__( 'Come and join the over 9000 people that have chosen us for their online presence. Our themes & plugins are rock solid, maintained and leave the bloat behind, allowing you to care about what really matters: your ideas.', 'crowley' ); ?></p>
				<?php printf( '<a href="%s" class="button button-primary button-hero">%s</a>', 'https://justevolve.it/themes/', esc_html__( 'Browse our catalog', 'crowley' ) ); ?>
			</div>
		</div>

		<div class="evolvethemes-themepage-brix-promo">
			<div class="evolvethemes-themepage-brix-promo_w">
				<img class="evolvethemes-themepage-brix_logo" src="<?php echo esc_url( EV_INC_FOLDER_URI . 'modules/theme-page/v1/img/brix_logo.svg' ); ?>">
				<h3><?php echo esc_html__( 'Want to take Crowley to the next level? Try Brix, the WordPress page builder plugin!', 'crowley' ); ?></h3>
				<p><?php echo esc_html__( 'Brix is a new and powerful drag & drop WordPress page builder that allows you to visually compose any page or layout you can imagine with a grid-based, easy interface, without touching a single line of code.', 'crowley' ); ?></p>
				<?php printf( '<a href="%s" class="button button-primary button-hero">%s</a>', 'https://wordpress.org/plugins/brix-page-builder/', esc_html__( 'Download for free!', 'crowley' ) ); ?>
			</div>
		</div>
	</div>
</div>
