<?php
/**
* The template for displaying Sidebar 1 + Sidebar 2 + Content page.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*
* Template Name: Sidebar 1 + Sidebar 2 + Content
* Template Post Type: page
*/

get_header(); ?>

<div class="elegantwp-main-wrapper clearfix" id="elegantwp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="elegantwp-main-wrapper-inside clearfix">

<?php elegantwp_top_widgets(); ?>

<div class="elegantwp-posts-wrapper" id="elegantwp-posts-wrapper">

<?php while (have_posts()) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', 'page' ); ?>

    <?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || get_comments_number() ) :
            comments_template();
    endif;
    ?>

<?php endwhile; ?>
<div class="clear"></div>

</div><!--/#elegantwp-posts-wrapper -->

<?php elegantwp_bottom_widgets(); ?>

</div>
</div>
</div><!-- /#elegantwp-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>