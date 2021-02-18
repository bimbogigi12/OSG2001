<?php
/**
* The header for ElegantWP theme.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class('elegantwp-animated elegantwp-fadein'); ?> id="elegantwp-site-body" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<div class="elegantwp-outer-wrapper-full">
<div class="elegantwp-outer-wrapper">

<div class="elegantwp-container elegantwp-secondary-menu-container clearfix">
<div class="elegantwp-secondary-menu-container-inside clearfix">

<nav class="elegantwp-nav-secondary" id="elegantwp-secondary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'elegantwp-menu-secondary-navigation', 'menu_class' => 'elegantwp-secondary-nav-menu elegantwp-menu-secondary', 'fallback_cb' => 'elegantwp_top_fallback_menu', ) ); ?>
</nav>

</div>
</div>

<div class="elegantwp-container" id="elegantwp-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
<div class="elegantwp-head-content clearfix" id="elegantwp-head-content">

<?php if ( get_header_image() ) : ?>
<div class="elegantwp-header-image clearfix">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="elegantwp-header-img-link">
    <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="" class="elegantwp-header-img"/>
</a>
</div>
<?php endif; ?>

<?php if ( !(elegantwp_get_option('hide_header_content')) ) { ?>
<div class="elegantwp-header-inside clearfix">
<div id="elegantwp-logo">
<?php if ( has_custom_logo() ) : ?>
    <div class="site-branding">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="elegantwp-logo-img-link">
        <img src="<?php echo esc_url( elegantwp_custom_logo() ); ?>" alt="" class="elegantwp-logo-img"/>
    </a>
    </div>
<?php else: ?>
    <div class="site-branding">
      <h1 class="elegantwp-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="elegantwp-site-description"><?php bloginfo( 'description' ); ?></p>
    </div>
<?php endif; ?>
</div><!--/#elegantwp-logo -->

<div id="elegantwp-header-banner">
<?php dynamic_sidebar( 'elegantwp-header-banner' ); ?>
</div><!--/#elegantwp-header-banner -->
</div>
<?php } ?>

</div><!--/#elegantwp-head-content -->
</div><!--/#elegantwp-header -->

<div class="elegantwp-container elegantwp-primary-menu-container clearfix">
<div class="elegantwp-primary-menu-container-inside clearfix">

<nav class="elegantwp-nav-primary" id="elegantwp-primary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'elegantwp-menu-primary-navigation', 'menu_class' => 'elegantwp-nav-primary-menu elegantwp-menu-primary', 'fallback_cb' => 'elegantwp_fallback_menu', ) ); ?>
</nav>

<?php if ( !(elegantwp_get_option('hide_header_social_buttons')) ) { elegantwp_header_social_buttons(); } ?>

<div class='elegantwp-social-search-box'>
<?php get_search_form(); ?>
</div>

</div>
</div>

<?php elegantwp_top_wide_widgets(); ?>

<div class="elegantwp-container clearfix" id="elegantwp-wrapper">
<div class="elegantwp-content-wrapper clearfix" id="elegantwp-content-wrapper">