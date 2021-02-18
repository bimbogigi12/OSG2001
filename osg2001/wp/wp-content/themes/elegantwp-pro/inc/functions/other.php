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
       $readmoretext = esc_html__( 'Continue Reading...', 'elegantwp-pro' );
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

    if ( is_page_template() ) {

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-page-sidebar.php', 'template-full-width-post.php', 'template-full-width-post-sidebar.php', 'template-contact-page.php', 'template-sitemap.php', 'template-site-authors.php' ) ) ) {
       $classes[] = 'elegantwp-layout-full-width';
    }
    if ( is_page_template( array( 'template-s1-c-s2-page.php', 'template-s1-c-s2-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s1-c-s2';
    }
    if ( is_page_template( array( 'template-s2-c-s1-page.php', 'template-s2-c-s1-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s2-c-s1';
    }
    if ( is_page_template( array( 'template-c-s1-s2-page.php', 'template-c-s1-s2-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-c-s1-s2';
    }
    if ( is_page_template( array( 'template-c-s2-s1-page.php', 'template-c-s2-s1-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-c-s2-s1';
    }
    if ( is_page_template( array( 'template-s1-s2-c-page.php', 'template-s1-s2-c-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s1-s2-c';
    }
    if ( is_page_template( array( 'template-s2-s1-c-page.php', 'template-s2-s1-c-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s2-s1-c';
    }
    if ( is_page_template( array( 'template-s1-c-page.php', 'template-s1-c-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s1-c';
    }
    if ( is_page_template( array( 'template-c-s1-page.php', 'template-c-s1-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-c-s1';
    }
    if ( is_page_template( array( 'template-c-s2-page.php', 'template-c-s2-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-c-s2';
    }
    if ( is_page_template( array( 'template-s2-c-page.php', 'template-s2-c-post.php' ) ) ) {
        $classes[] = 'elegantwp-layout-s2-c';
    }

    }

    if ( !is_page_template() ) {

    if ( ('one-column' === elegantwp_get_option('layout_style')) || is_404() ) {
        $classes[] = 'elegantwp-layout-full-width';
    }
    if ( 's1-c-s2' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s1-c-s2';
    }
    if ( 's2-c-s1' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s2-c-s1';
    }
    if ( 'c-s1-s2' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-c-s1-s2';
    }
    if ( 'c-s2-s1' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-c-s2-s1';
    }
    if ( 's1-s2-c' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s1-s2-c';
    }
    if ( 's2-s1-c' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s2-s1-c';
    }
    if ( 's1-c' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s1-c';
    }
    if ( 'c-s1' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-c-s1';
    }
    if ( 'c-s2' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-c-s2';
    }
    if ( 's2-c' === elegantwp_get_option('layout_style') ) {
        $classes[] = 'elegantwp-layout-s2-c';
    }

    }

    if ( elegantwp_get_option('enable_fullwidth_header') ) {
        $classes[] = 'elegantwp-header-full-width';
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


function elegantwp_site_authors_info() {
         $display_admins = true;
         $order_by = 'post_count'; // 'nicename', 'email', 'url', 'registered', 'display_name', or 'post_count'
         $order = 'DESC';
         $role = ''; // 'subscriber', 'contributor', 'editor', 'author' - leave blank for 'all'
         $avatar_size = 161;
         $hide_empty = false; // hides authors with zero posts

        if ( elegantwp_get_option('hide_admin_authors_page') ) {
                $display_admins = false;
        }
        if ( elegantwp_get_option('hide_noposts_authors_page') ) {
                $hide_empty = true;
        }

         if(!empty($display_admins)) {
              $blogusers = get_users('orderby='.$order_by.'&order='.$order.'&role='.$role);
         } else {

         $admins = get_users('role=administrator');
         $exclude = array();
         
         foreach($admins as $ad) {
              $exclude[] = $ad->ID;
         }

         $exclude = implode(',', $exclude);
         $blogusers = get_users('exclude='.$exclude.'&orderby='.$order_by.'&order='.$order.'&role='.$role);
         }

         $authors = array();
         foreach ($blogusers as $bloguser) {
         $user = get_userdata($bloguser->ID);

         if(!empty($hide_empty)) {
              $numposts = count_user_posts($user->ID);
              if($numposts < 1) continue;
              }
              $authors[] = (array) $user;
         }

         $content='';
         $content .= '<div id="elegantwp-authors-list">';
         foreach($authors as $author) {
              $display_name = $author['data']->display_name;
              $avatar = get_avatar($author['ID'], $avatar_size);
              $author_profile_url = get_author_posts_url($author['ID']);
              $author_description = get_the_author_meta('description',$author['ID']);

              $content .= '<div class="elegantwp-author-item clearfix">';
              $content .= '<div class="elegantwp-author-gravatar"><a href="'. $author_profile_url .'">'. $avatar .'</a></div>';
              $content .= '<h4 class="elegantwp-author-name"><a href="'. $author_profile_url .'" class="elegantwp-author-link">'. $display_name .'</a></h4>';
              $content .= '<div class="elegantwp-author-description">'.$author_description.'</div>';
              $content .= '<div class="elegantwp-author-social">';
              if( get_the_author_meta('elegantwptwitter',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwptwitter',$author['ID']) ). '"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>';
              }
              if( get_the_author_meta('elegantwpfacebook',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwpfacebook',$author['ID']) ). '"><i class="fa fa-facebook" aria-hidden="true"></i> Twitter</a>';
              }
              if( get_the_author_meta('elegantwpgplus',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwpgplus',$author['ID']) ). '"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a>';
              }
              if( get_the_author_meta('elegantwppinterest',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwppinterest',$author['ID']) ). '"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a>';
              }
              if( get_the_author_meta('elegantwplinkedin',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwplinkedin',$author['ID']) ). '"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a>';
              }
              if( get_the_author_meta('elegantwpdribbble',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwpdribbble',$author['ID']) ). '"><i class="fa fa-dribbble" aria-hidden="true"></i> Dribbble</a>';
              }
              if( get_the_author_meta('elegantwpgithub',$author['ID']) ) {
                  $content .= '<a href="' .esc_url( get_the_author_meta('elegantwpgithub',$author['ID']) ). '"><i class="fa fa-github" aria-hidden="true"></i> Github</a>';
              }
              $content .= '</div>';
              $content .= '</div>';
         }
         $content .= '</div>';

         return $content;
}