<?php
/**
* Post meta functions
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'elegantwp_post_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function elegantwp_post_tags() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'elegantwp' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="elegantwp-tags-links"><i class="fa fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'elegantwp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_9_cats' ) ) :
function elegantwp_style_9_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp09-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_9_postmeta' ) ) :
function elegantwp_style_9_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp09-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp09-post-author elegantwp-fp09-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp09-post-date elegantwp-fp09-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp09-post-comment elegantwp-fp09-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp' ), esc_attr__( '1 Comment', 'elegantwp' ), esc_attr__( '% Comments', 'elegantwp' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;



if ( ! function_exists( 'elegantwp_style_4_cats' ) ) :
function elegantwp_style_4_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp04-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_4_postmeta' ) ) :
function elegantwp_style_4_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp04-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp04-post-author elegantwp-fp04-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp04-post-date elegantwp-fp04-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp04-post-comment elegantwp-fp04-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp' ), esc_attr__( '1 Comment', 'elegantwp' ), esc_attr__( '% Comments', 'elegantwp' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_single_cats' ) ) :
function elegantwp_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'elegantwp' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-entry-meta-single elegantwp-entry-meta-single-top"><span class="elegantwp-entry-meta-single-cats"><i class="fa fa-folder-open-o"></i>&nbsp;' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp' ) . '</span></div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_single_postmeta' ) ) :
function elegantwp_single_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author')) || !(elegantwp_get_option('hide_posted_date')) || !(elegantwp_get_option('hide_comments_link')) || !(elegantwp_get_option('hide_post_edit')) ) { ?>
    <div class="elegantwp-entry-meta-single">
    <?php if ( !(elegantwp_get_option('hide_post_author')) ) { ?><span class="elegantwp-entry-meta-single-author"><i class="fa fa-user-circle-o"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date')) ) { ?><span class="elegantwp-entry-meta-single-date"><i class="fa fa-clock-o"></i>&nbsp;<?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-entry-meta-single-comments"><i class="fa fa-comments-o"></i>&nbsp;<?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp' ), esc_attr__( '1 Comment', 'elegantwp' ), esc_attr__( '% Comments', 'elegantwp' ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_post_edit')) ) { ?><?php edit_post_link( esc_html__( 'Edit', 'elegantwp' ), '<span class="edit-link">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;