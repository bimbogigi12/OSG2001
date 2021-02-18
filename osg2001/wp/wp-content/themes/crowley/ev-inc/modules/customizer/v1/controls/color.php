<?php
/**
 * Customizer module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\customizer\v1\controls\color
 * @since 1.0.0
 * @version 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Color Customizer control.
	 */
	class EvolveThemes_Customize_Color_Control extends WP_Customize_Color_Control {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 * @uses WP_Customize_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Optional. Arguments to override class property defaults.
		 */
		public function __construct( $manager, $id, $args = array() ) {
			$id = 'colors_' . $id;

			/* Also add a setting linked to the control. */
			$manager->add_setting(
				$id, array(
					'default'           => isset( $args['default'] ) ? $args['default'] : '',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			/* Register the control in the module. */
			EvolveThemes_Module_Customizer::instance()->add_control( $id, $this );

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Compute the CSS.
		 *
		 * @since 1.0.0
		 * @param string $control The control group name.
		 * @param string $key The control key name.
		 * @param array  $rules An array of rules from the control configuration.
		 * @return string
		 */
		public function css( $control, $key, $rules ) {
			$mod_value = get_theme_mod( $key );

			if ( '' == $mod_value ) {
				return '';
			}

			$css = '';

			foreach ( $rules as $rule_name => $rule_value ) {
				if ( $rule_value !== $mod_value ) {
					$css .= sprintf( '%s:%s;', str_replace( '_', '-', $rule_name ), $this->compress_color( $mod_value ) );
				}
			}

			return $css;
		}

		/**
		 * When possible, convert a long hex color code to its short version.
		 *
		 * @since 1.0.0
		 * @param string $hex The hex color code.
		 * @return string
		 */
		private function compress_color( $hex ) {
			if ( $hex[1] == $hex[2] && $hex[3] == $hex[4] && $hex[5] == $hex[6] ) {
				return '#' . $hex[1] . $hex[3] . $hex[5];
			}

			return $hex;
		}

	}

endif;
