<?php
/**********************************************
* Widgets
**********************************************/

/** Widgets Skeleton */
function kamn_iconlist_widgets_skeleton() {

	/** Theme Settings */
	$kamn_iconlist_options = kamn_iconlist_get_settings();

	/** Skeleton */
	$kamn_iconlist_widgets_skeleton = array(

		'Kamn_Widget_Iconlist' => array(
			'enable' => 1,
			'class' => KAMN_ICONLIST_LIB_DIR . 'widget-iconlist.php',
			'enqueue_script' => 0,
			'enqueue_style' => $kamn_iconlist_options['kamn_iconlist_fontawesome_control'],
			'scripts' => array(),
			'styles' => array(
				1 => array(
					'handle' => 'kamn-iconlist-css-fontawesome',
					'src' => KAMN_ICONLIST_CSS_URI . 'font-awesome.css'
				)
			)
		)

	);

	return $kamn_iconlist_widgets_skeleton;

}

/** Widgets */
add_action( 'widgets_init', 'kamn_iconlist_widgets' );

/** Register Widgets */
function kamn_iconlist_widgets() {

	/** Avaiable Widgets */
	$kamn_iconlist_widgets_skeleton = kamn_iconlist_widgets_skeleton();

	/** Register Widgets */
	foreach( $kamn_iconlist_widgets_skeleton as $key => $widget ) {
		if( $widget['enable'] == 1 ) {
			require_once( $widget['class'] );
			register_widget( $key );
		}
	}

	/** Enqueue Widget Scripts */
	add_action( 'wp_enqueue_scripts', 'kamn_iconlist_media_widget', 20 );
	function kamn_iconlist_media_widget() {

		/** Avaiable Widgets */
		$kamn_iconlist_widgets_skeleton = kamn_iconlist_widgets_skeleton();

		/** Iterate */
		foreach( $kamn_iconlist_widgets_skeleton as $key => $widget ) {

			/** Enqueue Scripts */
			if( $widget['enable'] == 1 && $widget['enqueue_script'] == 1 ) {
				foreach( $widget['scripts'] as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], '1.0', true );
				}
			}

			/** Enqueue Styles */
			if( $widget['enable'] == 1 && $widget['enqueue_style'] == 1 ) {
				foreach( $widget['styles'] as $style ) {
					wp_enqueue_style( $style['handle'], $style['src'] );
				}
			}

		}

	}

}
