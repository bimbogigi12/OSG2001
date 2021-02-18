<?php
/**
* Posts navigation functions
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'elegantwp_wp_pagenavi' ) ) :
function elegantwp_wp_pagenavi() {
    ?>
    <nav class="navigation posts-navigation clearfix" role="navigation">
        <?php wp_pagenavi(); ?>
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'elegantwp_posts_navigation' ) ) :
function elegantwp_posts_navigation() {
    if ( function_exists( 'wp_pagenavi' ) ) {
        elegantwp_wp_pagenavi();
    } else {
        the_posts_navigation(array('prev_text' => esc_html__( '&larr; Older posts', 'elegantwp' ), 'next_text' => esc_html__( 'Newer posts &rarr;', 'elegantwp' )));
    }
}
endif;