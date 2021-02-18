<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

<?php if ( !(elegantwp_get_option('hide_posts_heading')) ) { ?>
<?php if(is_home() && !is_paged()) { ?>
<?php if ( elegantwp_get_option('posts_heading') ) : ?>
<h1 class="elegantwp-posts-heading"><span><?php echo esc_html( elegantwp_get_option('posts_heading') ); ?></span></h1>
<?php else : ?>
<h1 class="elegantwp-posts-heading"><span><?php esc_html_e( 'Recent Posts', 'elegantwp' ); ?></span></h1>
<?php endif; ?>
<?php } ?>
<?php } ?>

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