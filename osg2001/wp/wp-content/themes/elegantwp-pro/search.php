<?php
/**
* The template for displaying search results pages.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class="elegantwp-main-wrapper clearfix" id="elegantwp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="elegantwp-main-wrapper-inside clearfix">

<?php elegantwp_top_widgets(); ?>

<div class="elegantwp-posts-wrapper" id="elegantwp-posts-wrapper">

<div class="elegantwp-posts">

<header class="page-header">
<h1 class="page-title"><?php /* translators: %s: search query. */ printf( esc_html__( 'Search Results for: %s', 'elegantwp-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</header>

<div class="elegantwp-posts-content">

<?php if (have_posts()) : ?>

    <div class="elegantwp-posts-container">
    <?php $elegantwp_total_posts = $wp_query->post_count; ?>
    <?php $elegantwp_post_counter=1; while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', elegantwp_post_style() ); ?>

    <?php $elegantwp_post_counter++; endwhile; ?>
    </div>
    <div class="clear"></div>

    <?php elegantwp_posts_navigation(); ?>

<?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

</div>
</div>

</div><!--/#elegantwp-posts-wrapper -->

<?php elegantwp_bottom_widgets(); ?>

</div>
</div>
</div><!-- /#elegantwp-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>