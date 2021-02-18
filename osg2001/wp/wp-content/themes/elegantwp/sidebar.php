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

<div class="elegantwp-sidebar-one-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-one-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-one-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-one' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-one-wrapper-->

<div class="elegantwp-sidebar-two-wrapper elegantwp-sidebar-widget-areas clearfix" id="elegantwp-sidebar-two-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="elegantwp-sidebar-two-wrapper-inside clearfix">

<?php dynamic_sidebar( 'elegantwp-sidebar-two' ); ?>

</div>
</div>
</div><!-- /#elegantwp-sidebar-two-wrapper-->