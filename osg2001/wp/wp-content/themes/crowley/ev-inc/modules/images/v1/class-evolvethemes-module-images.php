<?php
/**
 * Images module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\images\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Images module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Images {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		/* Including layout helpers. */
		$this->helpers();

		add_action( 'evolvethemes_assets_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue assets on frontend.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		/* Main images script. */
		wp_enqueue_script( 'evolvethemes-images', EV_INC_FOLDER_URI . 'modules/images/v1/js/images.js', null, '1.0.0', true );
	}

	/**
	 * Including image helpers.
	 *
	 * @since 1.0.0
	 */
	private function helpers() {
		/* Image helpers. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers/image.php';
	}
}

( new EvolveThemes_Module_Images() );
