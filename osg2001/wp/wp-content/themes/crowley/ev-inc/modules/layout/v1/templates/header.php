<?php
/**
 * Header templates.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Display the site header according to its type and the page context.
 *
 * @since 1.0.0
 */
function evolvethemes_header() {
	$key = 'evolvethemes_header';

	evolvethemes_do_action( "${key}_before" );

		evolvethemes_do_action( $key );

	evolvethemes_do_action( "${key}_after" );
}

/**
 * Get the template part relative to the footer.
 *
 * @since 1.0.0
 */
function evolvethemes_header_load_template() {
	$evolvethemes_header_path = 'templates/header/header';
	$evolvethemes_header_path = apply_filters( 'evolvethemes_header_path', $evolvethemes_header_path );
	get_template_part( $evolvethemes_header_path );
}

add_action( 'evolvethemes_header', 'evolvethemes_header_load_template' );

/**
 * Display the site's navigation.
 *
 * @since 1.0.0
 * @param string $location The menu location name.
 * @param string $classes The menu classes.
 */
function evolvethemes_nav( $location = 'primary', $classes = '' ) {
	$locations = get_nav_menu_locations();

	if ( ! isset( $locations[ $location ] ) ) {
		return;
	}

	// Menu output.
	$menu_markup = '';
	$menu_nav_markup = '';
	$theme_key = evolvethemes_theme_key();

	if ( $location ) {
		ob_start();
		wp_nav_menu(
			array(
				'theme_location' => $location,
			)
		);
		$menu_nav_markup = ob_get_contents();
		ob_end_clean();
	}

	$menu_class = esc_attr( $theme_key ) . '-nav';
	$menu_class = apply_filters( 'evolvethemes_menu_class', $menu_class );

	$menu_id = esc_attr( $theme_key ) . '-nav';

	if ( $menu_nav_markup ) {
		$menu_markup = '<nav id="' . esc_attr( $menu_id ) . '" class="' . esc_attr( $menu_class ) . '" role="navigation">';
		$menu_markup .= $menu_nav_markup;
		$menu_markup .= '</nav>';
	}

	// Menu wrapper output.
	ob_start();

	do_action( 'evolvethemes_nav_menu_before', $location );
	do_action( "evolvethemes_nav_menu_before[location:$location]", $location );

	print wp_kses_post( $menu_markup ); // @codingStandardsIgnoreLine

	do_action( 'evolvethemes_nav_menu_after', $location );
	do_action( "evolvethemes_nav_menu_after[location:$location]", $location );

	$menu_wrapper_markup = ob_get_contents();
	ob_end_clean();

	if ( ! $menu_wrapper_markup ) {
		return;
	}
	?>
	<div class="<?php echo esc_attr( $theme_key ); ?>-nav_w <?php echo esc_attr( $classes ); ?>">
		<?php print wp_kses_post( $menu_wrapper_markup ); // @codingStandardsIgnoreLine ?>
	</div>
	<?php
}

/**
 * The theme logo
 *
 * @since 1.0.0
 */
function evolvethemes_logo() {
	$site_name      = get_bloginfo( 'name', true );
	$site_desc      = get_bloginfo( 'description', true );
	$theme_key      = evolvethemes_theme_key();
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	printf( "<div class='%s-logo'>", esc_html( $theme_key ) );

	if ( has_custom_logo() ) {
		the_custom_logo();
	}

	if ( display_header_text() == 1 ) {
		printf( '<a href="%s" rel="home" itemprop="url">', esc_attr( home_url( '/' ) ) );
			if ( $site_name ) {
				printf( '<p class="%s-site-title">%s</p>', esc_attr( $theme_key ), esc_html( $site_name ) );
			}
			if ( $site_desc ) {
				printf( '<p class="%s-site-description">%s</p>', esc_attr( $theme_key ), esc_html( $site_desc ) );
			}
		echo '</a>';
	}

	echo '</div>';
}
