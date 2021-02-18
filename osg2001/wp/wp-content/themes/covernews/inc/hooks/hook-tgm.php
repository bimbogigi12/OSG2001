<?php
/**
 * Recommended plugins
 *
 * @package CoverNews
 */

if ( ! function_exists( 'covernews_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function covernews_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WP Post Author', 'covernews' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'covernews' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'covernews_recommended_plugins' );
