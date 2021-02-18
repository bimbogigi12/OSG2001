<?php
/**
* The template for displaying site authors.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*
* Template Name: Authors
* Template Post Type: page
*/

get_header(); ?>

<div class='elegantwp-main-wrapper clearfix' id='elegantwp-main-wrapper' itemscope='itemscope' itemtype='http://schema.org/Blog' role='main'>
<div class='theiaStickySidebar'>
<div class="elegantwp-main-wrapper-inside clearfix">

<div class='elegantwp-posts-wrapper' id='elegantwp-posts-wrapper'>

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('elegantwp-post-singular'); ?>>

    <header class="entry-header">
        <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content clearfix">
    <?php echo wp_kses_post( force_balance_tags( elegantwp_site_authors_info() ) ); ?>
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