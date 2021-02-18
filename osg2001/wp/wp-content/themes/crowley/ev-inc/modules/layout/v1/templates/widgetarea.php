<?php
/**
 * Sidebar templates.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Display the widget area markup.
 *
 * @param string $widgetarea_name The widget area name.
 * @param string $class An extra widget area class.
 * @since 1.0.0
 */
function evolvethemes_get_widgetarea( $widgetarea_name, $class = '' ) {
	$theme_key = evolvethemes_theme_key();
	global $wp_registered_sidebars;

	if ( ! is_active_sidebar( $widgetarea_name ) ) {
		return;
	}

	$label = $wp_registered_sidebars[ $widgetarea_name ]['name'];

	printf( '<aside class="%s-widgetarea %s" role="complementary" aria-label="%s">', esc_attr( $theme_key ), esc_attr( $class ), esc_attr( $label ) );
		do_action( 'evolvethemes_widget_area_before', $widgetarea_name );
		do_action( "evolvethemes_widget_area_before[widgetarea:$widgetarea_name]", $widgetarea_name );

			dynamic_sidebar( $widgetarea_name );

		do_action( 'evolvethemes_widget_area_after', $widgetarea_name );
		do_action( "evolvethemes_widget_area_after[widgetarea:$widgetarea_name]", $widgetarea_name );
	echo '</aside>';
}
