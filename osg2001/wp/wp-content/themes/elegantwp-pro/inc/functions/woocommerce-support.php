<?php
/**
* WooCommerce support
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Checking if WooCommerce is active
if ( ELEGANTWP_WOOCOMMERCE_ACTIVE ) {

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'elegantwp_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'elegantwp_woo_wrapper_end', 10);

function elegantwp_woo_wrapper_start() { ?>

    <div class="elegantwp-main-wrapper clearfix" id="elegantwp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
    <div class="theiaStickySidebar">
    <div class="elegantwp-main-wrapper-inside clearfix">

    <?php elegantwp_top_widgets(); ?>

    <div class="elegantwp-posts-wrapper" id="elegantwp-posts-wrapper">

    <div class="elegantwp-posts">
    <div class="elegantwp-posts-content">

<?php }

function elegantwp_woo_wrapper_end() { ?>

    </div>
    </div>

    </div><!--/#elegantwp-posts-wrapper -->

    <?php elegantwp_bottom_widgets(); ?>

    </div>
    </div>
    </div><!-- /#elegantwp-main-wrapper -->

    <?php //get_sidebar(); ?>

<?php }

}