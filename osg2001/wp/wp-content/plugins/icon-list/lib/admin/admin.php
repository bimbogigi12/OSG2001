<?php
class Kamn_Iconlist_Admin {

		/** Properties */
		private $kamn_iconlist_menu_slug;
		private $kamn_iconlist_options_page_hook;

		/** Constructor Method */
		function __construct() {

			/** Let Set Properties */
			$this->kamn_iconlist_menu_slug = 'iconlist-options';
			$this->kamn_iconlist_options_page_hook = 'settings_page_' . $this->kamn_iconlist_menu_slug;

			/** Admin Hooks */
			add_action( 'admin_menu', array( $this, 'kamn_iconlist_options_page' ) );
			add_action( 'admin_init', array( $this, 'kamn_iconlist_options' ) );
			add_action( 'admin_init', array( $this, 'kamn_iconlist_options_init' ), 12 );
			add_action( 'load-'. $this->kamn_iconlist_options_page_hook, array( $this, 'kamn_iconlist_options_page_contextual_help' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'kamn_iconlist_enqueue_scripts' ) );

		}

		/** Options Page Menu */
		function kamn_iconlist_options_page() {
			add_submenu_page( 'options-general.php', esc_html( __( 'Icon List Options', 'kamn-iconlist' ) ), esc_html( __( 'Icon List Options', 'kamn-iconlist' ) ), 'manage_options', $this->kamn_iconlist_menu_slug, array( $this, 'kamn_iconlist_options_do_page' ) );
		}

		/** Options Page */
		function kamn_iconlist_options_do_page() {
			require_once( KAMN_ICONLIST_ADMIN_DIR . 'page.php' );
		}

		/** Options Registration */
		function kamn_iconlist_options() {

			/** Register theme settings. */
			register_setting( 'kamn_iconlist_options_group', 'kamn_iconlist_options', array( $this, 'kamn_iconlist_options_validate' ) );

			/** Fonts Section */
			add_settings_section( 'kamn_iconlist_section_fonts', 'Fonts Options', array( $this, 'kamn_iconlist_section_fonts_cb' ), 'kamn_iconlist_section_fonts_page' );
			add_settings_field( 'kamn_iconlist_field_fontawesome_control', __( 'Load Fontawesome Fonts', 'kamn-iconlist' ), array( $this, 'kamn_iconlist_field_fontawesome_control_cb' ), 'kamn_iconlist_section_fonts_page', 'kamn_iconlist_section_fonts' );

			/** General Section */
			add_settings_section( 'kamn_iconlist_section_general', 'General Options', array( $this, 'kamn_iconlist_section_general_cb' ), 'kamn_iconlist_section_general_page' );
			add_settings_field( 'kamn_iconlist_field_reset_control', __( 'Reset Icon List Options', 'kamn-iconlist' ), array( $this, 'kamn_iconlist_field_reset_control_cb' ), 'kamn_iconlist_section_general_page', 'kamn_iconlist_section_general' );

		}

		/** Kamn Contextual Help. */
		function kamn_iconlist_options_page_contextual_help() {

			/** Get the plugin data. */
			$plugin = kamn_iconlist_plugin_data();
			$AuthorURI = $plugin['AuthorURI'];
			$PluginURI = $plugin['PluginURI'];

			/** Get the current screen */
			$screen = get_current_screen();

			/** Add theme reference help screen tab. */
			$screen->add_help_tab( array(

				'id' => 'kamn-iconlist-plugin',
				'title' => __( 'Plugin Support', 'kamn-iconlist' ),
				'content' => implode( '', file( KAMN_ICONLIST_ADMIN_DIR . 'help/support.html' ) ),

				)
			);

			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'kamn-iconlist' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Icon List Plugin', 'kamn-iconlist' ) . '</a></p>';
			}
			if ( !empty( $PluginURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $PluginURI ) . '" target="_blank">' . __( 'Icon List Official Page', 'kamn-iconlist' ) . '</a></p>';
			}
			$screen->set_help_sidebar( $sidebar );

		}

		/** Kamn Enqueue Scripts */
		function kamn_iconlist_enqueue_scripts( $hook ) {

			/** Load Scripts For Kamn Options Page */
			if( $hook === $this->kamn_iconlist_options_page_hook ) {

				/** Load Admin Scripts */
				wp_enqueue_script( 'kamn-iconlist-cookie-js-theme-options', esc_url( KAMN_ICONLIST_JS_URI . 'cookie.js' ), array( 'jquery' ) );
				wp_enqueue_script( 'kamn-iconlist-admin-js-theme-options', esc_url( KAMN_ICONLIST_JS_URI . 'admin.js' ), array( 'jquery' ) );

				/** Load Admin Stylesheet */
				wp_enqueue_style( 'kamn-iconlist-admin-css-theme-options', esc_url( KAMN_ICONLIST_CSS_URI . 'admin.css' ) );

			}

		}

		/** Loads the plugin setting. */
		function kamn_iconlist_get_admin_settings() {

			/** Global Data */
			global $kamn_iconlist;

			/* If the settings array hasn't been set, call get_option() to get an array of plugin settings. */
			if ( !isset( $kamn_iconlist->settings_admin ) ) {
				$kamn_iconlist->settings_admin = apply_filters( 'kamn_iconlist_options_admin_filter', wp_parse_args( get_option( 'kamn_iconlist_options', kamn_iconlist_options_default() ), kamn_iconlist_options_default() ) );
			}

			/** return settings. */
			return $kamn_iconlist->settings_admin;
		}

		/** Kamn Options Init */
		function kamn_iconlist_options_init() {

			$kamn_iconlist_options = get_option( 'kamn_iconlist_options' );
			if( !is_array( $kamn_iconlist_options ) ) {
				update_option( 'kamn_iconlist_options', kamn_iconlist_options_default() );
			}

		}

		/** Kamn Options Range */

		/* Boolean Yes | No */
		function kamn_iconlist_boolean_pd() {
			return array (
				1 => __( 'yes', 'kamn-iconlist' ),
				0 => __( 'no', 'kamn-iconlist' )
			);
		}

		/** Kamn Options Validation */
		function kamn_iconlist_options_validate( $input ) {

			/** Default */
			$default = kamn_iconlist_options_default();

			/** Kamn Predefined */
			$kamn_iconlist_boolean_pd = $this->kamn_iconlist_boolean_pd();

			/* Validation: kamn_iconlist_fontawesome_control */
			if ( ! array_key_exists( $input['kamn_iconlist_fontawesome_control'], $kamn_iconlist_boolean_pd ) ) {
				 $input['kamn_iconlist_fontawesome_control'] = $default['kamn_iconlist_fontawesome_control'];
			}

			/** Reset Logic */
			if( isset( $input['kamn_iconlist_reset_control'] ) && $input['kamn_iconlist_reset_control'] == 1 ) {
				$input = $default;
			}

			return $input;

		}

		/** Fonts Section Callback */
		function kamn_iconlist_section_fonts_cb() {
			echo '<div class="kamn-iconlist-section-desc">
			  <p class="description">'. __( 'Customize fonts by using the following settings.', 'kamn-iconlist' ) .'</p>
			</div>';
		}

		/* Fontawesome Control Callback */
		function kamn_iconlist_field_fontawesome_control_cb() {

			$kamn_iconlist_options = $this->kamn_iconlist_get_admin_settings();
			$items = $this->kamn_iconlist_boolean_pd();

			echo '<select id="kamn_iconlist_fontawesome_control" name="kamn_iconlist_options[kamn_iconlist_fontawesome_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $kamn_iconlist_options['kamn_iconlist_fontawesome_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><code>'. __( 'Select "no" if your theme supports fontawesome fonts.', 'kamn-iconlist' ) .'</code></div>';

		}

		/** General Section Callback */
		function kamn_iconlist_section_general_cb() {
			echo '<div class="kamn-iconlist-section-desc">
			  <p class="description">'. __( 'Here are the general settings to customize icon list plugin.', 'kamn-iconlist' ) .'</p>
			</div>';
		}

		/* Reset Control Callback */
		function kamn_iconlist_field_reset_control_cb() {
			echo '<label><input type="checkbox" id="kamn_iconlist_reset_control" name="kamn_iconlist_options[kamn_iconlist_reset_control]" value="1" /> '. __( 'Reset IconList Options.', 'kamn-iconlist' ) .'</label>';
		}
}

/** Initiate Admin */
new Kamn_Iconlist_Admin();
