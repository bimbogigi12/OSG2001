<?php
/**
* The template for displaying sitemap page.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*
* Template Name: Sitemap
* Template Post Type: page
*/

get_header(); ?>

<div class="elegantwp-main-wrapper clearfix" id="elegantwp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="elegantwp-main-wrapper-inside clearfix">

<div class="elegantwp-posts-wrapper" id="elegantwp-posts-wrapper">

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('elegantwp-post-singular'); ?>>

    <header class="entry-header">
        <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content clearfix">

    <div class="elegantwp-row">
    <div class="elegantwp-col-6">
    <?php the_widget( 'WP_Widget_Recent_Posts', array( 'title' => esc_html__( 'Recent Posts', 'elegantwp-pro' ), 'number' => 10 ) ); ?>
    <?php the_widget( 'WP_Widget_Recent_Comments', array( 'title' => esc_html__( 'Recent Comments', 'elegantwp-pro' ), 'number' => 10 ) ); ?>
    </div>
    <div class="elegantwp-col-6">
    <?php the_widget( 'WP_Widget_Pages',  array( 'title' => esc_html__( 'Pages', 'elegantwp-pro' ), 'sortby' => 'menu_order', 'exclude' => null ) ); ?>
    </div>
    </div>
    <div class="elegantwp-row">
    <div class="elegantwp-col-6">
    <?php the_widget( 'WP_Widget_Categories', array( 'title' => esc_html__( 'Categories', 'elegantwp-pro' ), 'count' => 1, 'hierarchical' => 1, 'dropdown' => 0 ) ); ?>
    </div>
    <div class="elegantwp-col-6">
    <?php the_widget( 'WP_Widget_Tag_Cloud', array( 'title' => esc_html__( 'Tags', 'elegantwp-pro' ), 'taxonomy' => 'post_tag' ) ); ?>
    <?php the_widget( 'WP_Widget_Archives', array( 'title' => esc_html__( 'Archives', 'elegantwp-pro' ), 'count' => 1, 'dropdown' => 0 ) ); ?>
    <h2><?php esc_html_e( 'Authors', 'elegantwp-pro' ); ?></h2>
    <ul><?php wp_list_authors(); ?></ul>
    </div>
    </div>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'elegantwp-pro' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
        
</article>

<?php endwhile; ?>
<div class="clear"></div>

</div><!--/#elegantwp-posts-wrapper -->

</div>
</div>
</div><!-- /#elegantwp-main-wrapper -->

<?php get_footer(); ?>