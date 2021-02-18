<?php
/**
 * Theme page module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\theme-page\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Layout module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_ThemePage {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		/* Including theme page helpers. */
		$this->helpers();

		/* Enqueue the admin styles. */
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

		/* Add the theme page. */
		add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
	}

	/**
	 * Add the theme page.
	 *
	 * @since 1.0.0
	 */
	public function add_theme_page() {
		$theme_data    = evolvethemes_get_theme();
		$notices       = evolvethemes_get_notices();
		$notices_count = 0;

		foreach ( $notices as $notice ) {
			if ( ! empty( $notice ) ) {
				$notices_count += count( $notice );
			}
		}

		if ( $notices_count > 0 ) {
			/* translators: %1$s: The number of notices */
			$update_label = sprintf( _n( '%1$s notice', '%1$s notices', $notices_count, 'crowley' ), $notices_count );
			$count = "<span class='update-plugins count-" . esc_attr( $notices_count ) . "' title='" . esc_attr( $update_label ) . "'><span class='update-count'>" . number_format_i18n( $notices_count ) . '</span></span>';
			/* translators: %1$s: The theme name, %2$s: The number of notices */
			$menu_item_title = sprintf( esc_html__( 'About %1$s %2$s', 'crowley' ), $theme_data->get( 'Name' ), wp_kses_post( $count ) );
		} else {
			/* translators: %1$s: The theme name */
			$menu_item_title = sprintf( esc_html__( 'About %1$s', 'crowley' ), $theme_data->get( 'Name' ) );
		}

		$menu_item_title = apply_filters( 'evolvethemes_theme_page_menu_title', $menu_item_title );

		/* translators: %1$s: The theme name */
		$menu_page_title = sprintf( esc_html__( 'About %1$s', 'crowley' ), $theme_data->get( 'Name' ) );
		$menu_page_title = apply_filters( 'evolvethemes_theme_page_menu_page_title', $menu_page_title );

		add_theme_page( $menu_page_title, $menu_item_title, 'edit_theme_options', 'evolvethemes_about', 'evolvethemes_theme_page_structure' );
	}

	/**
	 * Enqueue assets on admin
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'evolvethemes-theme-page-css', EV_INC_FOLDER_URI . 'modules/theme-page/v1/css/theme-page.css', array(), '1.0.0' );
	}

	/**
	 * Including theme page helpers.
	 *
	 * @since 1.0.0
	 */
	private function helpers() {
		/* System status helpers. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers/system-status.php';

		/* General templates. */
		require_once trailingslashit( dirname( __FILE__ ) ) . 'templates/general.php';
	}

}

( new EvolveThemes_Module_ThemePage() );
