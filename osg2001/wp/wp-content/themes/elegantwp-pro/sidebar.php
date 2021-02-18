<?php
/**
* The file for displaying the sidebars.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php if ( is_page_template() ) { ?>

<?php if(!is_page_template(array( 'template-c-s2-page.php', 'template-c-s2-post.php', 'template-s2-c-page.php', 'template-s2-c-post.php' ))) { ?>
<div class="elegantwp-sidebar-one-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-one-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-one-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-one' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-one-wrapper-->
<?php } ?>

<?php if(!is_page_template(array( 'template-s1-c-page.php', 'template-s1-c-post.php', 'template-c-s1-page.php', 'template-c-s1-post.php' ))) { ?>
<div class="elegantwp-sidebar-two-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-two-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-two-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-two' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-two-wrapper-->
<?php } ?>

<?php } else { ?>

<?php if ( ('one-column' === elegantwp_get_option('layout_style')) && elegantwp_get_option('hide_sidebar_one_column') ) { ?>
<?php // no sidebars ?>
<?php } else { ?>

<?php if ( !('c-s2' === elegantwp_get_option('layout_style')) && !('s2-c' === elegantwp_get_option('layout_style')) ) { ?>
<div class="elegantwp-sidebar-one-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-one-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-one-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-one' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-one-wrapper-->
<?php } ?>

<?php if ( !('s1-c' === elegantwp_get_option('layout_style')) && !('c-s1' === elegantwp_get_option('layout_style')) ) { ?>
<div class="elegantwp-sidebar-two-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-two-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-two-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-two' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-two-wrapper-->
<?php } ?>

<?php } ?>

<?php } ?>