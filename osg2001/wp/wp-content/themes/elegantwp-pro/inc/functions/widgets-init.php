<?php
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_widgets_init() {

register_sidebar(array(
    'id' => 'elegantwp-header-banner',
    'name' => esc_html__( 'Header Banner', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is located on the header of the web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-header-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title">',
    'after_title' => '</h2>'));

register_sidebar(array(
    'id' => 'elegantwp-sidebar-one',
    'name' => esc_html__( 'Sidebar 1', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is normally located on the left-hand side of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-side-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-sidebar-two',
    'name' => esc_html__( 'Sidebar 2', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is normally located on the right-hand side of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-side-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-home-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Home Page Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This full-width widget area is located at the top of homepage.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-single-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Posts Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This full-width widget area is located at the top of single post.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-singular-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Posts/Pages Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This full-width widget area is located at the top of single post/page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Every Page)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This full-width widget area is located at the top of every page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-home-top-widgets',
    'name' => esc_html__( 'Top Widgets (Home Page Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the top of homepage.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-single-top-widgets',
    'name' => esc_html__( 'Top Widgets (Posts Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the top of single post.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget elegantwp-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-singular-top-widgets',
    'name' => esc_html__( 'Top Widgets (Posts/Pages Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the top of single post/page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget elegantwp-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-top-widgets',
    'name' => esc_html__( 'Top Widgets (Every Page)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the top of every page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-home-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Home Page Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the bottom of homepage.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-single-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Posts Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget elegantwp-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-singular-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Posts/Pages Only)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post/page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget elegantwp-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Every Page)', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the bottom of every page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-single-post-bottom-widgets',
    'name' => esc_html__( 'Post Bottom Widgets', 'elegantwp-pro' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post. before the comments', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-main-widget widget elegantwp-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-footer-1',
    'name' => esc_html__( 'Footer 1', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is located on the left bottom of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-footer-2',
    'name' => esc_html__( 'Footer 2', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is located on the middle bottom of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-footer-3',
    'name' => esc_html__( 'Footer 3', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is located on the middle bottom of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'elegantwp-footer-4',
    'name' => esc_html__( 'Footer 4', 'elegantwp-pro' ),
    'description' => esc_html__( 'This sidebar is located on the right bottom of web page.', 'elegantwp-pro' ),
    'before_widget' => '<div id="%1$s" class="elegantwp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="elegantwp-widget-title"><span>',
    'after_title' => '</span></h2>'));

}
add_action( 'widgets_init', 'elegantwp_widgets_init' );


function elegantwp_top_wide_widgets() { ?>

<?php if ( is_active_sidebar( 'elegantwp-home-fullwidth-widgets' ) || is_active_sidebar( 'elegantwp-single-fullwidth-widgets' ) || is_active_sidebar( 'elegantwp-singular-fullwidth-widgets' ) || is_active_sidebar( 'elegantwp-fullwidth-widgets' ) ) : ?>
<div class="elegantwp-top-wrapper-outer clearfix">
<div class="elegantwp-featured-posts-area elegantwp-top-wrapper clearfix">
<?php if(is_front_page() && !is_paged()) { ?>
<?php dynamic_sidebar( 'elegantwp-home-fullwidth-widgets' ); ?>
<?php } ?>

<?php if(is_single()) { ?>
<?php dynamic_sidebar( 'elegantwp-single-fullwidth-widgets' ); ?>
<?php } ?>

<?php if(is_singular()) { ?>
<?php dynamic_sidebar( 'elegantwp-singular-fullwidth-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'elegantwp-fullwidth-widgets' ); ?>
</div>
</div>
<?php endif; ?>

<?php }


function elegantwp_top_widgets() { ?>

<div class="elegantwp-featured-posts-area elegantwp-featured-posts-area-top clearfix">
<?php if(is_front_page() && !is_paged()) { ?>
<?php dynamic_sidebar( 'elegantwp-home-top-widgets' ); ?>
<?php } ?>

<?php if(is_single()) { ?>
<?php dynamic_sidebar( 'elegantwp-single-top-widgets' ); ?>
<?php } ?>

<?php if(is_singular()) { ?>
<?php dynamic_sidebar( 'elegantwp-singular-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'elegantwp-top-widgets' ); ?>
</div>

<?php }


function elegantwp_bottom_widgets() { ?>

<div class='elegantwp-featured-posts-area elegantwp-featured-posts-area-bottom clearfix'>
<?php if(is_front_page() && !is_paged()) { ?>
<?php dynamic_sidebar( 'elegantwp-home-bottom-widgets' ); ?>
<?php } ?>

<?php if(is_single()) { ?>
<?php dynamic_sidebar( 'elegantwp-single-bottom-widgets' ); ?>
<?php } ?>

<?php if(is_singular()) { ?>
<?php dynamic_sidebar( 'elegantwp-singular-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'elegantwp-bottom-widgets' ); ?>
</div>

<?php }