<?php
/**
 * Customizer module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\customizer\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Customizer module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Customizer {

	/**
	 * The Customizer class instance.
	 *
	 * @static
	 * @var EvolveThemes_Module_Customizer
	 */
	private static $_instance = null;

	/**
	 * Map of the custom controls.
	 *
	 * @var array
	 */
	private $controls = array();

	/**
	 * Contstructor.
	 */
	public function __construct() {
		/* Declaring custom Customizer controls. */
		$this->controls();

		/* Store generated CSS. */
		add_action( 'customize_save_after', array( $this, 'store' ) );

		/* Output generated CSS. */
		add_action( 'wp_enqueue_scripts', array( $this, 'output' ) );
	}

	/**
	 * Register a specific control assigning it to a specific handler class.
	 *
	 * @since 1.0.0
	 * @param string               $key The control key.
	 * @param WP_Customize_Control $handler The handler class.
	 */
	public function add_control( $key, $handler ) {
		$this->controls[ $key ] = $handler;
	}

	/**
	 * Batch compute the generated rulesets.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_rulesets() {
		$ruleset = array();

		foreach ( glob( get_template_directory() . '/config/customizer/ruleset-*.php' ) as $filename ) {
			$_ruleset = require_once $filename;

			$ruleset = array_merge( $ruleset, $_ruleset );
		}

		return $ruleset;
	}

	/**
	 * Store the generated CSS.
	 *
	 * @since 1.0.0
	 */
	public function store() {
		$css = $this->css();

		set_theme_mod( 'evolvethemes_customizer_css', $css );

		do_action( 'evolvethemes_customizer_store', $css );
	}

	/**
	 * Fetch cached generated CSS.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function fetch() {
		$css = get_theme_mod( 'evolvethemes_customizer_css' );
		$css = apply_filters( 'evolvethemes_customizer_fetch', $css );

		return $css;
	}

	/**
	 * Ouput the generated CSS.
	 *
	 * @since 1.0.0
	 */
	public function output() {
		$css = '';

		if ( is_customize_preview() ) {
			$css = $this->css();
		} else {
			$css = $this->fetch();
		}

		wp_register_style( 'evolvethemes-customizer', false, array(), '1.0.0' );
		wp_enqueue_style( 'evolvethemes-customizer' );

		wp_add_inline_style( 'evolvethemes-customizer', $css );
	}

	/**
	 * Compute the CSS.
	 *
	 * @since 1.0.0
	 */
	private function css() {
		$custom_style = array();
		$ruleset = $this->get_rulesets();

		foreach ( $ruleset as $key => $selectors ) {
			$control = $selectors['group'];

			foreach ( $selectors['selectors'] as $selector => $rules ) {
				$media = '';

				if ( isset( $rules['_type'] ) ) {
					if ( 'desktop' !== $rules['_type'] ) {
						$media = $rules['_type'];
					}

					unset( $rules['_type'] );
				}

				if ( $media ) {
					$selector = $media . '{' . $selector;
				}

				$css = '';

				if ( in_array( $control, array_keys( $this->controls ) ) && method_exists( $this->controls[ $control ], 'css' ) ) {
					/* If the rule was generated with one of the EvolveThemes controls, let the control handle its rendering. */
					$css = $this->controls[ $control ]->css( $control, $key, $rules );
				} else if ( in_array( $key, array_keys( $this->controls ) ) && method_exists( $this->controls[ $key ], 'css' ) ) {
					/* If the rule was generated with one of the EvolveThemes controls, let the control handle its rendering. */
					$css = $this->controls[ $key ]->css( $control, $key, $rules );
				} else {
					$mod_value = get_theme_mod( $key );

					if ( false !== $mod_value ) {
						$css = sprintf( '%s:%s;', $rule_name, $rule_value );
					}
				}

				if ( $css ) {
					if ( ! isset( $custom_style[ $selector ] ) ) {
						$custom_style[ $selector ] = '';
					}

					$custom_style[ $selector ] .= $css;
				}
			}
		}

		$style = '';

		foreach ( $custom_style as $selector => $rules ) {
			$style .= $selector . '{' . rtrim( $rules, ';' ) . '}';

			if ( strpos( $selector, '@media' ) === 0 ) {
				$style .= '}';
			}
		}

		return $style;
	}

	/**
	 * Declaring custom Customizer controls.
	 *
	 * @since 1.0.0
	 */
	private function controls() {
		/* Color Customizer control. */
		require_once dirname( __FILE__ ) . '/controls/color.php';

		/* Typography Customizer control. */
		require_once dirname( __FILE__ ) . '/controls/typography.php';
	}

	/**
	 * Return the instance of the Customizer class.
	 *
	 * @static
	 * @since 1.0.0
	 * @return EvolveThemes_Module_Customizer
	 */
	public static function instance() {
		if ( null === self::$_instance ) {
			self::$_instance = new EvolveThemes_Module_Customizer();
		}

		return self::$_instance;
	}

}

( EvolveThemes_Module_Customizer::instance() );
