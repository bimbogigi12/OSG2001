<?php
/**
* Social profiles options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_social_profiles($wp_customize) {

    $wp_customize->add_section( 'sc_elegantwp_sociallinks', array( 'title' => esc_html__( 'Social Links', 'elegantwp-pro' ), 'panel' => 'elegantwp_main_options_panel', 'priority' => 400, ));

    $wp_customize->add_setting( 'elegantwp_options[hide_header_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'elegantwp_hide_header_social_buttons_control', array( 'label' => esc_html__( 'Hide Header Social Buttons', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[hide_header_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'elegantwp_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'elegantwp_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'elegantwp_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[vklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_vklink_control', array( 'label' => esc_html__( 'VK Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[vklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_githublink_control', array( 'label' => esc_html__( 'Github URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_redditlink_control', array( 'label' => esc_html__( 'Reddit Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_behancelink_control', array( 'label' => esc_html__( 'Behance Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_codepenlink_control', array( 'label' => esc_html__( 'Codepen Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_bsalink_control', array( 'label' => esc_html__( 'BuySellAds Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare Link', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'elegantwp_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'elegantwp_sanitize_email' ) );

    $wp_customize->add_control( 'elegantwp_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'elegantwp_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'elegantwp_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'elegantwp-pro' ), 'section' => 'sc_elegantwp_sociallinks', 'settings' => 'elegantwp_options[rsslink]', 'type' => 'text' ) );

}