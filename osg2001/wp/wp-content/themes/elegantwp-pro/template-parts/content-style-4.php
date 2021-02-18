<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<div id="post-<?php the_ID(); ?>" class="elegantwp-fp04-post">

    <?php if ( has_post_thumbnail() ) { ?>
    <?php if ( !(elegantwp_get_option('hide_thumbnail')) ) { ?>
    <div class="elegantwp-fp04-post-thumbnail">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-fp04-post-thumbnail-img')); ?></a>
    </div>
    <?php } ?>
    <?php } ?>

    <?php if((has_post_thumbnail()) && !(elegantwp_get_option('hide_thumbnail'))) { ?><div class="elegantwp-fp04-post-details"><?php } ?>
    <?php if(!(has_post_thumbnail()) || (elegantwp_get_option('hide_thumbnail'))) { ?><div class="elegantwp-fp04-post-details-full"><?php } ?>

    <?php if ( !(elegantwp_get_option('hide_post_categories_home')) ) { ?><?php elegantwp_style_4_cats(); ?><?php } ?>

    <?php the_title( sprintf( '<h3 class="elegantwp-fp04-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

    <?php elegantwp_style_4_postmeta(); ?>

    <?php if ( !(elegantwp_get_option('hide_post_snippet')) ) { ?><div class="elegantwp-fp04-post-snippet"><?php the_excerpt(); ?></div><?php } ?>

    <?php if ( !(elegantwp_get_option('hide_read_more_button')) ) { ?><div class='elegantwp-fp04-post-read-more'><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( elegantwp_read_more_text() ); ?></a></div><?php } ?>

    <?php if(!(has_post_thumbnail()) || (elegantwp_get_option('hide_thumbnail'))) { ?></div><?php } ?>
    <?php if((has_post_thumbnail()) && !(elegantwp_get_option('hide_thumbnail'))) { ?></div><?php } ?>

</div>