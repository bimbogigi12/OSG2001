<?php
/**
* Upgrade to pro options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license licennse URI, for example : http://www.gnu.org/licenses/gpl-2.0.html
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_upgrade_to_pro($wp_customize) {

    $wp_customize->add_section( 'sc_elegantwp_upgrade', array( 'title' => esc_html__( 'Upgrade to Pro Version', 'elegantwp' ), 'priority' => 400 ) );
    
    $wp_customize->add_setting( 'elegantwp_options[upgrade_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new ElegantWP_Customize_Static_Text_Control( $wp_customize, 'elegantwp_upgrade_text_control', array(
        'label'       => esc_html__( 'ElegantWP Pro', 'elegantwp' ),
        'section'     => 'sc_elegantwp_upgrade',
        'settings' => 'elegantwp_options[upgrade_text]',
        'description' => esc_html__( 'Do you enjoy ElegantWP? Upgrade to ElegantWP Pro now and get:', 'elegantwp' ).
            '<ul class="elegantwp-customizer-pro-features">' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Color Options', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Font Options', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '10+ Layout Options', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '10+ Custom Page Templates', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '10+ Custom Post Templates', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '10 Different Posts Styles', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '16 Different Featured Posts Widgets(each widget displays recent/popular/random posts or posts from a given category or tag.)', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Featured Posts Slider Widget(this widget displays recent/popular/random posts or posts from a given category or tag.)', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'News Ticker', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Tabbed Widget', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Social Profiles Widget and About Me Widget', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( '2 Header Layouts (full-width header or header+728x90 ad)', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Post Share Buttons', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Related Posts with Thumbnails', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Author Bio Box with Social Buttons', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Sticky Menu/Sticky Sidebars with enable/disable capability', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Built-in Contact Form', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'WooCommerce Support', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'Search Engine Optimized', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'More Customizer options', 'elegantwp' ) . '</li>' .
                '<li><i class="fa fa-check"></i> ' . esc_html__( 'More Features...', 'elegantwp' ) . '</li>' .
            '</ul>'.
            '<strong><a href="'.ELEGANTWP_PROURL.'" class="button button-primary" target="_blank"><i class="fa fa-shopping-cart"></i> ' . esc_html__( 'Upgrade To ElegantWP PRO', 'elegantwp' ) . '</a></strong>'
    ) ) ); 

}