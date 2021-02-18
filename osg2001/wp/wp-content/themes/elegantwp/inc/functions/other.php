<?php
/**
* More Custom Functions
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Get custom-logo URL
function elegantwp_custom_logo() {
    if ( ! has_custom_logo() ) {return;}
    $elegantwp_custom_logo_id = get_theme_mod( 'custom_logo' );
    $elegantwp_logo = wp_get_attachment_image_src( $elegantwp_custom_logo_id , 'full' );
    return $elegantwp_logo[0];
}

function elegantwp_read_more_text() {
       $readmoretext = esc_html__( 'Continue Reading...', 'elegantwp' );
        if ( elegantwp_get_option('read_more_text') ) {
                $readmoretext = elegantwp_get_option('read_more_text');
        }
       return $readmoretext;
}

// Category ids in post class
function elegantwp_category_id_class($classes) {
        global $post;
        foreach((get_the_category($post->ID)) as $category) {
            $classes [] = 'wpcat-' . $category->cat_ID . '-id';
        }
        return $classes;
}
add_filter('post_class', 'elegantwp_category_id_class');

// Change excerpt length
function elegantwp_excerpt_length($length) {
    if ( is_admin() ) {
        return $length;
    }
    $read_more_length = 25;
    if ( elegantwp_get_option('read_more_length') ) {
        $read_more_length = elegantwp_get_option('read_more_length');
    }
    return $read_more_length;
}
add_filter('excerpt_length', 'elegantwp_excerpt_length');

// Change excerpt more word
function elegantwp_excerpt_more($more) {
       if ( is_admin() ) {
         return $more;
       }
       return '...';
}
add_filter('excerpt_more', 'elegantwp_excerpt_more');

// Adds custom classes to the array of body classes.
function elegantwp_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'elegantwp-group-blog';
    }

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
       $classes[] = 'elegantwp-layout-full-width';
    }

    if ( is_404() ) {
        $classes[] = 'elegantwp-layout-full-width';
    }

    return $classes;
}
add_filter( 'body_class', 'elegantwp_body_classes' );


function elegantwp_post_style() {
       $post_style = 'style-4';
        if ( elegantwp_get_option('post_style') ) {
                $post_style = elegantwp_get_option('post_style');
        }
       return $post_style;
}