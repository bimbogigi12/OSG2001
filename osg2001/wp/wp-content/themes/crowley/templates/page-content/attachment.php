<?php
/**
 * The attachment template.
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
				<p><?php evolvethemes_entry_author(); ?></p>
				<p><?php evolvethemes_entry_date(); ?></p>
				<p><?php evolvethemes_image_meta(); ?></p>
			</div>

			<?php get_template_part( 'templates/comments/comments' ); ?>

		</div>

	</div>
</div>
