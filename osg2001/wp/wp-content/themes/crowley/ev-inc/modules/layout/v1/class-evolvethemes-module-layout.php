<?php
/**
 * Layout module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\layout\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Layout module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Layout {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		/* Including layout helpers. */
		$this->helpers();
	}

	/**
	 * Including layout helpers.
	 *
	 * @since 1.0.0
	 */
	private function helpers() {
		/* Template helpers. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers/template.php';

		/* Layout helpers. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers/layout.php';

		/* Header templates. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'templates/header.php';

		/* Footer templates. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'templates/footer.php';

		/* Page content templates. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'templates/page-content.php';

		/* Sidebar templates. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'templates/widgetarea.php';
	}

}

( new EvolveThemes_Module_Layout() );
