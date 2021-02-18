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
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'elegantwp-pro' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="elegantwp-tags-links"><i class="fa fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'elegantwp-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_9_cats' ) ) :
function elegantwp_style_9_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp09-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
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
    <span class="elegantwp-fp09-post-comment elegantwp-fp09-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;



if ( ! function_exists( 'elegantwp_style_4_cats' ) ) :
function elegantwp_style_4_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp04-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
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
    <span class="elegantwp-fp04-post-comment elegantwp-fp04-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_1_postmeta' ) ) :
function elegantwp_style_1_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp01-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp01-post-author elegantwp-fp01-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp01-post-meta elegantwp-fp01-post-date"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp01-post-meta elegantwp-fp01-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_3_cats' ) ) :
function elegantwp_style_3_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp03-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_8_cats' ) ) :
function elegantwp_style_8_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp08-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_3_postmeta' ) ) :
function elegantwp_style_3_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp03-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp03-post-author elegantwp-fp03-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp03-post-date elegantwp-fp03-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp03-post-comment elegantwp-fp03-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_8_postmeta' ) ) :
function elegantwp_style_8_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp08-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp08-post-author elegantwp-fp08-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp08-post-date elegantwp-fp08-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp08-post-comment elegantwp-fp08-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_5_cats' ) ) :
function elegantwp_style_5_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp05-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_6_cats' ) ) :
function elegantwp_style_6_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp06-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_5_postmeta' ) ) :
function elegantwp_style_5_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp05-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp05-post-author elegantwp-fp05-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp05-post-date elegantwp-fp05-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp05-post-comment elegantwp-fp05-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_6_postmeta' ) ) :
function elegantwp_style_6_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp06-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp06-post-author elegantwp-fp06-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp06-post-date elegantwp-fp06-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp06-post-comment elegantwp-fp06-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_2_cats' ) ) :
function elegantwp_style_2_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp02-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_2_postmeta' ) ) :
function elegantwp_style_2_postmeta() { ?>
    <?php global $elegantwp_post_counter; ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp02-post-footer">
    <?php if(1 == $elegantwp_post_counter) { ?><?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp02-post-author elegantwp-fp02-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp02-post-meta elegantwp-fp02-post-date"><?php echo get_the_date('d-m-Y'); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp02-post-meta elegantwp-fp02-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_12_cats' ) ) :
function elegantwp_style_12_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp12-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_12_postmeta' ) ) :
function elegantwp_style_12_postmeta() { ?>
    <?php global $elegantwp_post_counter; ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp12-post-footer">
    <?php if(1 == $elegantwp_post_counter) { ?><?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp12-post-author elegantwp-fp12-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp12-post-meta elegantwp-fp12-post-date"><?php echo get_the_date('d-m-Y'); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp12-post-meta elegantwp-fp12-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_style_13_cats' ) ) :
function elegantwp_style_13_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-fp13-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'elegantwp_style_13_postmeta' ) ) :
function elegantwp_style_13_postmeta() { ?>
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) || !(elegantwp_get_option('hide_posted_date_home')) || !(elegantwp_get_option('hide_comments_link_home')) ) { ?>
    <div class="elegantwp-fp13-post-footer">
    <?php if ( !(elegantwp_get_option('hide_post_author_home')) ) { ?><span class="elegantwp-fp13-post-author elegantwp-fp13-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_posted_date_home')) ) { ?><span class="elegantwp-fp13-post-date elegantwp-fp13-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="elegantwp-fp13-post-comment elegantwp-fp13-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'elegantwp_single_cats' ) ) :
function elegantwp_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'elegantwp-pro' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="elegantwp-entry-meta-single elegantwp-entry-meta-single-top"><span class="elegantwp-entry-meta-single-cats"><i class="fa fa-folder-open-o"></i>&nbsp;' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</span></div>', $categories_list ); // WPCS: XSS OK.
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
    <span class="elegantwp-entry-meta-single-comments"><i class="fa fa-comments-o"></i>&nbsp;<?php comments_popup_link( esc_attr__( 'Leave a comment', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(elegantwp_get_option('hide_post_edit')) ) { ?><?php edit_post_link( esc_html__( 'Edit', 'elegantwp-pro' ), '<span class="edit-link">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;