<?php
/**
* Template part for displaying single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('elegantwp-post-singular'); ?>>

    <header class="entry-header">
        <?php if ( !(elegantwp_get_option('hide_post_categories')) ) { ?><?php elegantwp_single_cats(); ?><?php } ?>

        <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

        <?php elegantwp_single_postmeta(); ?>
    </header><!-- .entry-header -->

    <div class="entry-content clearfix">
            <?php
            if ( has_post_thumbnail() ) {
                if ( !(elegantwp_get_option('hide_thumbnail')) ) {
                    if ( !(elegantwp_get_option('hide_thumbnail_single')) ) {
                        if ( elegantwp_get_option('thumbnail_link') == 'no' ) {
                            the_post_thumbnail('elegantwp-featured-image', array('class' => 'elegantwp-post-thumbnail-single'));
                        } else { ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-featured-image', array('class' => 'elegantwp-post-thumbnail-single')); ?></a>
                <?php   }
                    }
                }
            }

            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span> <span class="meta-nav">&rarr;</span>', 'elegantwp-pro' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
             'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'elegantwp-pro' ) . '</span>',
             'after'       => '</div>',
             'link_before' => '<span>',
             'link_after'  => '</span>',
             ) );
             ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if ( !(elegantwp_get_option('hide_share_buttons')) ) { echo wp_kses_post( force_balance_tags( elegantwp_social_sharing_buttons() ) ); } ?>
        <?php if ( !(elegantwp_get_option('hide_post_tags')) ) { ?><?php elegantwp_post_tags(); ?><?php } ?>
    </footer><!-- .entry-footer -->

    <?php if ( !(elegantwp_get_option('hide_author_bio_box')) ) { echo wp_kses_post( force_balance_tags( elegantwp_add_author_bio_box() ) ); } ?>

    <?php if ( !(elegantwp_get_option('hide_related_posts')) ) { elegantwp_related_posts(); } ?>

</article>