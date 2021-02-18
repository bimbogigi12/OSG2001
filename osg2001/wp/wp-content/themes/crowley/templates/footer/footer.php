<?php
/**
 * The footer template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>

<?php if ( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2' ) || is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
	<?php printf( '<div class="%s-f-s">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<div class="%s-f-s_w-i">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-sidebar-1', 'crowley-footer-sidebar' ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-sidebar-2', 'crowley-footer-sidebar' ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-sidebar-3', 'crowley-footer-sidebar' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php printf( '<footer class="%s-f" role="contentinfo">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%s-f_w-i">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<p>&copy; %s &mdash; %s, Designed by <a href="%s" target="_blank">Evolve Themes</a> and Proudly powered by <a href="%s" target="_blank">WordPress</a>.</p>', esc_html( date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ), esc_url( 'https://justevolve.it/' ), esc_url( 'https://wordpress.org/' ) ); ?>
	</div>
</footer>
