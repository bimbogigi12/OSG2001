<?php
/**
 * Page preloader module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\preloader\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Page preloader module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Preloader {

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
		/* Main preloader script. */
		wp_enqueue_script( 'evolvethemes-preloader', EV_INC_FOLDER_URI . 'modules/preloader/v1/js/preloader.min.js', null, '1.0.0', false );

		/**
		 * Preloader queue filter.
		 * Adding items to this array will make the preloader stop until all the elements in the queue
		 * have been declared "completed".
		 *
		 * @param array An array of preloader keys.
		 */
		$preloader_queue = apply_filters( 'evolvethemes_preloader_queue', array() );

		/* Localizing the preloader script. */
		wp_localize_script( 'evolvethemes-preloader', 'evolvethemes_preloader_queue', $preloader_queue );
	}

}

( new EvolveThemes_Module_Preloader() );
