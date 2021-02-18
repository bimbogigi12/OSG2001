<?php
/**
 * The main archive loop template.
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

			<?php evolvethemes_loop(); ?>

			<?php printf( '<div class="%s-loop-search">', esc_attr( $evolvethemes_key ) ); ?>
				<p><?php esc_html_e( 'Didn\'t you find what you were looking for?', 'crowley' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		</div>

		<?php get_sidebar(); ?>

	</div>
</div>
