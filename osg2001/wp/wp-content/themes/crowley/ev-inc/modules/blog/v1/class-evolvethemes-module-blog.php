<?php
/**
 * Blog module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\blog\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Blog module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Blog {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		/* Including blog helpers. */
		$this->helpers();
	}

	/**
	 * Including blog helpers.
	 *
	 * @since 1.0.0
	 */
	private function helpers() {
		/* Blog helpers. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers/helpers.php';
	}

}

( new EvolveThemes_Module_Blog() );
