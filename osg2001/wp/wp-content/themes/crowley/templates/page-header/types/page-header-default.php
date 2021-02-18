<?php
/**
 * The header template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();

?>
<?php printf( '<div class="%s-ph">', esc_attr( $evolvethemes_key ) ); ?>

	<?php printf( '<div class="%s-ph_wi">', esc_attr( $evolvethemes_key ) ); ?>
		<?php crowley_page_before_title(); ?>
		<?php evolvethemes_page_title(); ?>
		<?php crowley_page_after_title(); ?>
	</div>

	<?php do_action( 'crowley_page_header_end' ); ?>
</div>
