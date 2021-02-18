<?php
/**
* Author bio box
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

/* This code adds new profile fields to the user profile editor */
function elegantwp_modify_contact_methods($profile_fields) {

    // Add new fields
    $profile_fields['elegantwptwitter'] = esc_html__( 'Twitter URL', 'elegantwp-pro' );
    $profile_fields['elegantwpfacebook'] = esc_html__( 'Facebook URL', 'elegantwp-pro' );
    $profile_fields['elegantwpgplus'] = esc_html__( 'Google+ URL', 'elegantwp-pro' );
    $profile_fields['elegantwppinterest'] = esc_html__( 'Pinterest URL', 'elegantwp-pro' );
    $profile_fields['elegantwplinkedin'] = esc_html__( 'Linkedin URL', 'elegantwp-pro' );
    $profile_fields['elegantwpdribbble'] = esc_html__( 'Dribbble URL', 'elegantwp-pro' );
    $profile_fields['elegantwpgithub'] = esc_html__( 'Github URL', 'elegantwp-pro' );

    // Remove old fields
    unset($profile_fields['aim']);
    unset($profile_fields['yim']);
    unset($profile_fields['jabber']);

    return $profile_fields;
}
add_filter('user_contactmethods', 'elegantwp_modify_contact_methods');


// Author bio box
function elegantwp_add_author_bio_box() {
    $content='';
    if (is_single()) {
        $content .= '
            <div class="elegantwp-author-bio">
            <div class="elegantwp-author-bio-top">
            <div class="elegantwp-author-bio-gravatar">
                '. get_avatar( get_the_author_meta('email') , 80 ) .'
            </div>
            <div class="elegantwp-author-bio-text">
                <h4>'.esc_html__( 'Author: ', 'elegantwp-pro' ).'<span>'. get_the_author_link() .'</span></h4>'. get_the_author_meta('description',get_query_var('author') ) .'
            </div>
            </div>
        ';
        $content .= '
            <div class="elegantwp-author-bio-social">
            ';
            if( get_the_author_meta('elegantwptwitter',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwptwitter' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Twitter', 'elegantwp-pro' ).'"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a> ';
            if( get_the_author_meta('elegantwpfacebook',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwpfacebook' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Facebook', 'elegantwp-pro' ).'"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a> ';
            if( get_the_author_meta('elegantwpgplus',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwpgplus' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'GooglePlus', 'elegantwp-pro' ).'"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a> ';
            if( get_the_author_meta('elegantwppinterest',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwppinterest' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Pinterest', 'elegantwp-pro' ).'"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a> ';
            if( get_the_author_meta('elegantwplinkedin',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwplinkedin' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Linkedin', 'elegantwp-pro' ).'"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a> ';
            if( get_the_author_meta('elegantwpdribbble',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwpdribbble' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Dribbble', 'elegantwp-pro' ).'"><i class="fa fa-dribbble" aria-hidden="true"></i> Dribbble</a> ';
            if( get_the_author_meta('elegantwpgithub',get_query_var('author') ) )
                $content .= '<a href="' . esc_url( get_the_author_meta( 'elegantwpgithub' ) ) . '" target="_blank" rel="nofollow" title="'.esc_attr__( 'Github', 'elegantwp-pro' ).'"><i class="fa fa-github" aria-hidden="true"></i> Github</a>';
        $content .= '
            </div>
            </div>
        ';
    }
    return $content;
}