<?php
/**
 * The 404 template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>
<?php printf( '<div class="%s-c_w">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%s-c_w-i">', esc_attr( $evolvethemes_key ) ); ?>

		<?php printf( '<div id="main-content" class="%s-c" role="main">', esc_attr( $evolvethemes_key ) ); ?>

			<?php do_action( 'evolvethemes_before_content' ); ?>

			<?php printf( '<div class="%s-mc-w_i %s-mc-content">', esc_attr( $evolvethemes_key ), esc_attr( $evolvethemes_key ) ); ?>

				<p><?php echo wp_kses_post( __( 'We are sorry, but the page you are looking for does not exist.', 'crowley' ) ); ?><br /><?php echo wp_kses_post( __( 'Please check entered address and try again or go to', 'crowley' ) ); ?> <?php printf( '<a href="%s">%s</a>', esc_attr( home_url() ), esc_html__( 'home page', 'crowley' ) ); ?></p>

				<?php get_search_form(); ?>
			</div>
		</div>

	</div>
</div>
