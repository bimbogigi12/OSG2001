<?php
/**
 * Customizer module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\customizer\v1\controls\typography
 * @since 1.0.0
 * @version 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Typography Customizer control.
	 *
	 * This control enables to pick font families and their variants and subsets from a
	 * list. Possible sources are Google Fonts, Typekit, or custom stylesheet.
	 */
	class EvolveThemes_Customize_Typography_Control extends WP_Customize_Control {

		/**
		 * The type of the control.
		 *
		 * @var string
		 */
		public $type = 'evolvethemes_typography';

		/**
		 * An array that contains the font families definitions.
		 *
		 * @var array
		 */
		private $families = array();

		/**
		 * An array that contains the font instances definitions.
		 *
		 * @var array
		 */
		private $instances = array();

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
			$id = 'typography';

			if ( isset( $args['families'] ) && ! empty( $args['families'] ) ) {
				/* Default font families. */
				$this->families = $args['families'];
			}

			if ( isset( $args['instances'] ) && ! empty( $args['instances'] ) ) {
				/* Font instances definition. */

				foreach ( $args['instances'] as $group_key => $group ) {
					$i = 0;

					foreach ( $group['fields'] as $instance_key => $instance_label ) {
						$this->instances[ $id . '_' . $instance_key ] = array();
						$this->instances[ $id . '_' . $instance_key ]['_instance_label'] = $instance_label;

						if ( 0 === $i ) {
							$this->instances[ $id . '_' . $instance_key ]['_group_label'] = $group['label'];
						}

						$i++;
					}
				}
			}

			if ( ! $this->families && ! $this->instances ) {
				return;
			}

			/* Also add a setting linked to the control. */
			$manager->add_setting(
				$id, array(
					'default'           => isset( $args['default'] ) ? $args['default'] : '',
					'sanitize_callback' => array( $this, 'sanitize' ),
				)
			);

			/* Control required assets. */
			$this->assets();

			/* Include control subtemplates. */
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'templates' ) );

			/* Register the control in the module. */
			EvolveThemes_Module_Customizer::instance()->add_control( $id, $this );

			/* Call the parent constructor in the WP_Customize_Control class. */
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Control required assets.
		 *
		 * @since 1.0.0
		 */
		private function assets() {
			/* Vue. */
			wp_register_script( 'evolvethemes-customizer-vue', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/min/vue.min.js', array(), '2.5.16' );

			/* Selectize. */
			wp_register_script( 'evolvethemes-customizer-selectize', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/min/selectize.min.js', array(), '0.12.6' );

			/* Components. */
			wp_register_script( 'evolvethemes-customizer-components', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/controls/components/min/components.js', array( 'evolvethemes-customizer-vue', 'evolvethemes-customizer-selectize' ), '1.0.0' );

			/* Font family control. */
			wp_register_script( 'evolvethemes-customizer-typography-control-font-family', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/controls/typography-font-family.js', array( 'evolvethemes-customizer-components' ), '1.0.0' );

			/* Font family instance control. */
			wp_register_script( 'evolvethemes-customizer-typography-control-font-family-instance', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/controls/typography-font-family-instance.js', array( 'evolvethemes-customizer-typography-control-font-family' ), '1.0.0' );
		}

		/**
		 * Control subtemplates.
		 *
		 * @since 1.0.0
		 */
		public function templates() {
			/* Font family control. */
			require_once EV_INC_FOLDER . 'modules/customizer/v1/controls/templates/font-family.php';

			/* Font family instance control. */
			require_once EV_INC_FOLDER . 'modules/customizer/v1/controls/templates/font-family-instance.php';
		}

		/**
		 * Control data sanitization.
		 *
		 * @since 1.0.0
		 * @param array $data The control data.
		 * @return array
		 */
		public function sanitize( $data ) {
			return $data;
		}

		/**
		 * Control data.
		 *
		 * @since 1.0.0
		 * @return array
		 */
		private function data() {
			$theme_mods = get_theme_mod( $this->id );

			/* User data. */
			$user_families = false;
			$user_instances = false;

			if ( $theme_mods ) {
				$user_data = json_decode( $theme_mods, true );

				$user_families = $user_data['families'];
				$user_instances = $user_data['instances'];
			}

			$ruleset = EvolveThemes_Module_Customizer::instance()->get_rulesets();

			/* Families. */
			$families = array();

			foreach ( $this->families as $family_key => $family_data ) {
				$families[ $family_key ] = $family_data;
			}

			if ( $user_families ) {
				foreach ( $user_families as $family_key => $family_data ) {
					if ( isset( $families[ $family_key ] ) ) {
						$families[ $family_key ] = wp_parse_args( $family_data, $families[ $family_key ] );
					} else {
						$families[ $family_key ] = $family_data;
					}
				}
			}

			foreach ( $families as $family_key => &$family_data ) {
				$family_data = wp_parse_args(
					$family_data, array(
						'google_fonts' => array(
							'font_family' => '',
						),
						'typekit' => array(
							'font_family' => '',
							'kitId' => '',
						),
						'custom' => array(
							'font_family' => '',
						),
					)
				);
			}

			/* Font instances definitions. */
			$instances = array();

			foreach ( $this->instances as $instance_key => $instance_data ) {
				$defaults = array();

				if ( isset( $ruleset[ $instance_key ] ) ) {
					$defaults = reset( $ruleset[ $instance_key ]['selectors'] );
				}

				$instances[ $instance_key ]['_group_label'] = isset( $instance_data['_group_label'] ) ? $instance_data['_group_label'] : '';
				$instances[ $instance_key ]['_instance_label'] = isset( $instance_data['_instance_label'] ) ? $instance_data['_instance_label'] : '';
				$instances[ $instance_key ]['data'] = array();
				$instances[ $instance_key ]['_defaults'] = wp_parse_args(
					$defaults, array(
						'text-transform' => 'none',
					)
				);
			}

			if ( $user_instances ) {
				foreach ( $user_instances as $instance_key => $instance_data ) {
					if ( isset( $instances[ $instance_key ] ) ) {
						$instances[ $instance_key ] = wp_parse_args( $instance_data, $instances[ $instance_key ] );
					}
				}
			}

			foreach ( $instances as $instance_key => &$instance_data ) {
				if ( ! isset( $instances[ $instance_key ]['data']['text-transform'] ) ) {
					$instances[ $instance_key ]['data']['text-transform'] = $instances[ $instance_key ]['_defaults']['text-transform'];
				}

				if ( ! isset( $instances[ $instance_key ]['data']['font-family'] ) && isset( $instances[ $instance_key ]['_defaults']['_font-family'] ) ) {
					$instances[ $instance_key ]['data']['font-family'] = $instances[ $instance_key ]['_defaults']['_font-family'];
				}

				if ( ! isset( $instances[ $instance_key ]['data']['variant'] ) && isset( $instances[ $instance_key ]['data']['font-family'] ) ) {
					$font_family = $instances[ $instance_key ]['data']['font-family'];

					if ( isset( $families[ $font_family ]['google_fonts']['variants'] ) ) {
						$variants = explode( ',', $families[ $font_family ]['google_fonts']['variants'] );
						$variant = array_shift( $variants );

						$instances[ $instance_key ]['data']['variant'] = $variant;
					}
				}
			}

			$data = array(
				'strings' => array(
					'family_label_ask' => __( 'Give a label to the font family', 'crowley' ),
				),
				'family_default_data' => array(
					'_custom' => true,
					'label' => '',
					'source' => 'google_fonts',
					'google_fonts' => array(
						'font_family'   => '',
						'variants' => '',
						'subsets'  => '',
					),
					'typekit' => array(
						'kitId' => '',
						'font_family' => '',
					),
					'custom' => array(
						'url' => '',
						'font_family' => '',
					),
				),
				'font_sources' => array(
					array(
						'value' => 'google_fonts',
						'id'    => 'source-google_fonts',
						'label' => __( 'Google Fonts', 'crowley' ),
					),
					array(
						'value' => 'typekit',
						'id'    => 'source-typekit',
						'label' => __( 'Typekit', 'crowley' ),
					),
					array(
						'value' => 'custom',
						'id'    => 'source-custom',
						'label' => __( 'Custom', 'crowley' ),
					),
				),
				'google_fonts' => $this->get_google_fonts(),
				'data' => array(
					'families'  => $families,
					'instances' => $instances,
				),
			);

			return $data;
		}

		/**
		 * Enqueue scripts/styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			/* Main typography control. */
			wp_enqueue_script( 'evolvethemes-customizer-typography-control', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/js/controls/typography.js', array( 'evolvethemes-customizer-typography-control-font-family-instance' ), '1.0.0', true );

			/* Main typography control style. */
			wp_enqueue_style( 'evolvethemes-customizer-typography-control', EV_INC_FOLDER_URI . 'modules/customizer/v1/assets/admin/css/typography.css', array(), '1.0.0' );

			/* Localize the font family control. */
			wp_localize_script( 'evolvethemes-customizer-typography-control-font-family', 'evolvethemes_customizer_typography_control', $this->data() );
		}

		/**
		 * Get a list of available Google Fonts.
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_google_fonts() {
			$webfonts_file = locate_template( 'config/customizer/webfonts.json' );

			if ( ! $webfonts_file ) {
				return array();
			}

			$google_fonts_json = json_decode( implode( '', file( $webfonts_file ) ) );
			$google_fonts = array();

			foreach ( $google_fonts_json->items as $font ) {
				$google_fonts[ $font->family ] = array(
					'category' => $font->category,
					'variants' => $font->variants,
					'subsets' => $font->subsets,
				);
			}

			return $google_fonts;
		}

		/**
		 * Render the control interface.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>

			<input type="hidden" <?php $this->link(); ?>>

			<div class="evolvethemes-typography">
				<span class="evolvethemes-fc-sh"><?php esc_html_e( 'Font families', 'crowley' ); ?></span>
				<div class="evolvethemes-ff-c">
					<evolvethemes-customizer-font-family
						v-bind:key="id"
						v-for="( data, id ) in families"
						v-bind:_id="id"
						v-bind:id="id + '-font-family'"
						v-bind:value="families[id]"
						v-on:input="updateControl"
						v-on:removefontfamily="removeFamily"
					></evolvethemes-customizer-font-family>

					<button type="button" class="evolvethemes-ff-add" v-on:click="addFamily"><?php esc_html_e( 'Add font family', 'crowley' ); ?></button>
				</div>

				<div class="evolvethemes-ffi" v-for="( instance, key ) in instances" v-bind:key="key" v-if="instances">
					<h2 v-if="instance._group_label">{{ instance._group_label }}</h2>

					<div class="evolvethemes-ffi-c">
						<h3>{{ instance._instance_label }}</h3>

						<evolvethemes-customizer-font-family-instance
							v-bind:id="key"
							v-bind:value="instance.data"
							v-bind:families="families"
							v-on:input="updateControl"
							v-bind:_defaults="instance._defaults"
						></evolvethemes-customizer-font-family-instance>
					</div>
				</div>
			</div>

			<?php
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
			$mod_value = get_theme_mod( $control );

			if ( ! $mod_value ) {
				return '';
			}

			$mod_value = json_decode( $mod_value, true );

			if ( ! isset( $mod_value['instances'][ $key ] ) ) {
				$family_key = $rules['_font-family'];
				$family_source = $mod_value['families'][ $family_key ]['source'];

				if ( $rules['font-family'] !== $mod_value['families'][ $family_key ][ $family_source ]['font_family'] ) {
					return 'font-family:"' . $mod_value['families'][ $family_key ][ $family_source ]['font_family'] . '";';
				}

				return '';
			}

			foreach ( $rules as $rule_key => $rule_value ) {
				$rules[ str_replace( '-', '_', $rule_key ) ] = $rules[ $rule_key ];
			}

			$user_data = $mod_value['instances'][ $key ]['data'];

			$value = wp_parse_args( $user_data, $rules );

			$typography_rules = array(
				'font-family',
				'variant',
				'font-size',
				'line-height',
				'letter-spacing',
				'text-transform',
			);

			$css = '';

			foreach ( $typography_rules as $rule_name ) {
				if ( ! isset( $value[ $rule_name ] ) || '' === $value[ $rule_name ] ) {
					continue;
				}

				if ( isset( $rules[ $rule_name ] ) && $value[ $rule_name ] === $rules[ $rule_name ] ) {
					continue;
				}

				switch ( $rule_name ) {
					case 'font-family':
						if ( $value[ $rule_name ] !== $value[ '_' . $rule_name ] ) {
							if ( ! isset( $mod_value['families'][ $value[ $rule_name ] ] ) ) {
								continue;
							}

							$family = $mod_value['families'][ $value[ $rule_name ] ];
							$family_name = $family[ $family['source'] ]['font_family'];

							$css .= sprintf( '%s:"%s";', str_replace( '_', '-', $rule_name ), $family_name );
						}
						break;
					case 'variant':
						switch ( $value[ $rule_name ] ) {
							case 'regular':
								$css .= 'font-style:normal;font-weight:normal;';
								break;
							case 'bold':
								$css .= 'font-style:normal;font-weight:bold;';
								break;
							case 'italic':
								$css .= 'font-style:italic;font-weight:normal;';
								break;
							case 'bolditalic':
								$css .= 'font-style:italic;font-weight:bold;';
								break;
							default:
								$font_style = strpos( $value[ $rule_name ], 'italic' ) !== false ? 'italic' : 'normal';
								$font_weight = str_replace( 'italic', '', $value[ $rule_name ] );
								$css .= "font-style:$font_style;font-weight:$font_weight;";
								break;
						}
						break;
					case 'font-size':
					case 'line-height':
					case 'letter-spacing':
						$css .= sprintf( '%s:%s;', str_replace( '_', '-', $rule_name ), $value[ $rule_name ] );
						break;
					case 'text-transform':
						if ( 'none' === $value[ $rule_name ] && ! isset( $rules[ $rule_name ] ) ) {
							continue;
						}

						$css .= sprintf( '%s:%s;', str_replace( '_', '-', $rule_name ), $value[ $rule_name ] );
						break;
				}
			}

			return $css;
		}

	}

endif;
