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

<div id="post-<?php the_ID(); ?>" class="elegantwp-fp01-post">

    <?php if ( !(elegantwp_get_option('hide_thumbnail')) ) { ?>
    <div class="elegantwp-fp01-post-thumbnail">
    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-mini-image', array('class' => 'elegantwp-fp01-post-img')); ?></a>
    <?php } else { ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-small.png' ); ?>" class="elegantwp-fp01-post-img"/></a>
    <?php } ?>
    </div>
    <?php } ?>

    <?php the_title( sprintf( '<h3 class="elegantwp-fp01-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

    <?php elegantwp_style_1_postmeta(); ?>

    <?php if ( !(elegantwp_get_option('hide_post_snippet')) ) { ?><div class="elegantwp-fp01-post-snippet"><?php the_excerpt(); ?></div><?php } ?>

</div>