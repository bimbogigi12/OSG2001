<?php
/**
 * Layout Helpers.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\theme-page\v1
 * @since 1.0.0
 */

/**
 * Define the theme page structure.
 *
 * @since 1.0.0
 */
function evolvethemes_theme_page_structure() {
	$theme_data    = evolvethemes_get_theme();
	$notices       = evolvethemes_get_notices();

	/* translators: %1$s: The theme name, %2$s: The theme version number */
	$theme_page_title = sprintf( __( 'Welcome to %1$s - Version %2$s', 'crowley' ), $theme_data->get( 'Name' ), $theme_data->get( 'Version' ) );
	$theme_page_title = apply_filters( 'evolvethemes_theme_page_title', $theme_page_title );

	$about_theme = '';
	$about_theme = apply_filters( 'evolvethemes_theme_page_about', $about_theme );

	$badge = sprintf( '<a target="_blank" href="%s" class="evolvethemes-badge wp-badge"><span>Evolve Themes</span></a>', esc_url( 'https://justevolve.it' ) );
	$badge = apply_filters( 'evolvethemes_theme_page_badge', $badge );

	$tab_slug = null;

	if ( isset( $_GET['tab'] ) ) {
		$tab_slug = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
	} else {
		$tab_slug = null;
	}

	$tabs = evolvethemes_get_tabs();

	?>
	<div class="wrap about-wrap theme_info_wrapper">
		<h1><?php echo esc_html( $theme_page_title ); ?></h1>
		<?php if ( ! empty( $about_theme ) ) : ?>
			<div class="about-text"><?php echo esc_html( $about_theme ); ?></div>
		<?php endif; ?>

		<?php echo wp_kses_post( $badge ); ?>

		<hr class="wp-header-end">

		<h2 class="nav-tab-wrapper wp-clearfix">
			<?php
			foreach ( $tabs as $tab ) {
				$notices_count = 0;
				$notice_markup = '';

				if ( empty( $tab['slug'] ) ) {
					$tab['slug'] = 'default';
				}

				if ( ! empty( $notices[ $tab['slug'] ] ) ) {
					$notices_count = count( $notices[ $tab['slug'] ] );
				}

				if ( $notices_count > 0 ) {
					$notice_markup = sprintf( '<span class="evolvethemes-notice-count">%s</span>', esc_html( $notices_count ) );
				}

				if ( 'default' == $tab['slug'] ) {
					printf( '<a href="%s" class="nav-tab %s">%s %s</a>', admin_url( 'themes.php?page=evolvethemes_about' ), is_null( $tab_slug ) ? ' nav-tab-active' : null, esc_html( $tab['title'] ), wp_kses_post( $notice_markup ) );
				} else {
					printf( '<a href="%s" class="nav-tab %s">%s %s</a>', add_query_arg( 'tab', esc_html( $tab['slug'] ), admin_url( 'themes.php?page=evolvethemes_about' ) ), esc_html( $tab['slug'] ) == $tab_slug ? ' nav-tab-active' : null, esc_html( $tab['title'] ), wp_kses_post( $notice_markup ) );
				}
			}
			?>
		</h2>

		<?php do_action( 'evolvethemes_theme_page_tabs_content', $tab_slug ); ?>
	</div>
	<?php
}

/**
 * Render the tabs content.
 *
 * @since 1.0.0
 * @param  string $tab_slug The current tab slug.
 */
function evolvethemes_theme_page_render_tab_content( $tab_slug ) {
	$tabs = evolvethemes_get_tabs();

	printf( '<div class="%s-tab info-tab-content">', esc_html( $tab_slug ) );

	do_action( 'evolvethemes_theme_page_tab_start', array( 'tab_slug' => $tab_slug ) );

	foreach ( $tabs as $tab ) {
		if ( is_null( $tab_slug ) && empty( $tab['slug'] ) ) {
			echo wp_kses_post( evolvethemes_template( $tab['content'] ) );

			break;
		} else {
			if ( $tab_slug == $tab['slug'] ) {
				echo wp_kses_post( evolvethemes_template( $tab['content'], array( 'tab_slug' => $tab['slug'] ) ) );

				break;
			}
		}
	}

	echo '</div>';
}

add_action( 'evolvethemes_theme_page_tabs_content', 'evolvethemes_theme_page_render_tab_content' );

/**
 * Get theme notices.
 *
 * @since 1.0.0
 * @return array
 */
function evolvethemes_get_notices() {
	$tabs = evolvethemes_get_tabs();
	$notices = array();

	foreach ( $tabs as $tab ) {
		if ( empty( $tab['slug'] ) ) {
			$tab['slug'] = 'default';
		}

		$notices[ $tab['slug'] ] = array();
	}

	$notices = apply_filters( 'evolvethemes_get_notices', $notices );

	return $notices;
}

/**
 * Get the theme page tabs.
 *
 * @since 1.0.0
 * @return array The tabs array
 */
function evolvethemes_get_tabs() {
	$tabs = array();
	$tabs = apply_filters( 'evolvethemes_theme_page_tabs', $tabs );

	return $tabs;
}
