<?php
/**
 * Fonts module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\fonts\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Fonts module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Fonts {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		add_action( 'evolvethemes_assets_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue assets on frontend.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		/* Webfontloader. */
		wp_register_script( 'evolvethemes-webfontloader', EV_INC_FOLDER_URI . 'modules/fonts/v1/js/webfontloader.min.js', null, '1.0.0', true );

		/* Main images script. */
		wp_enqueue_script( 'evolvethemes-fonts', EV_INC_FOLDER_URI . 'modules/fonts/v1/js/fonts.js', array( 'evolvethemes-webfontloader' ), '1.0.0', true );
	}

}

( new EvolveThemes_Module_Fonts() );
