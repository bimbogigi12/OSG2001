<?php
/**
 * The main loop template.
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

			<?php evolvethemes_loop(); ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</div>
