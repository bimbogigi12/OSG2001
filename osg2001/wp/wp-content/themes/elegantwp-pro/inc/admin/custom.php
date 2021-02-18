<?php
/**
* Customizer Options
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_customizer_fonts() {
    ?>
    <style type="text/css">
    body{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('body_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('body_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('body_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('body_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('body_line_height') ); ?>;}

    h1{font-size:<?php echo esc_attr( elegantwp_get_option('h1_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h1_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h1_font_style') ); ?>;}
    h2{font-size:<?php echo esc_attr( elegantwp_get_option('h2_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h2_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h2_font_style') ); ?>;}
    h3{font-size:<?php echo esc_attr( elegantwp_get_option('h3_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h3_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h3_font_style') ); ?>;}
    h4{font-size:<?php echo esc_attr( elegantwp_get_option('h4_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h4_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h4_font_style') ); ?>;}
    h5{font-size:<?php echo esc_attr( elegantwp_get_option('h5_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h5_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h5_font_style') ); ?>;}
    h6{font-size:<?php echo esc_attr( elegantwp_get_option('h6_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('h6_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('h6_font_style') ); ?>;}
    h1,h2,h3,h4,h5,h6{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('headings_fonts')); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('headings_line_height') ); ?>;}

    .elegantwp-nav-secondary a{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('secondary_menu_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('secondary_menu_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('secondary_menu_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('secondary_menu_font_style') ); ?>;}

    .elegantwp-site-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('site_title_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('site_title_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('site_title_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('site_title_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('site_title_line_height') ); ?> !important;}
    .elegantwp-site-description{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('site_desc_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('site_desc_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('site_desc_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('site_desc_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('site_desc_line_height') ); ?> !important;}

    .elegantwp-nav-primary a{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('primary_menu_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('primary_menu_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('primary_menu_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('primary_menu_font_style') ); ?>;}

    .elegantwp-trending-news{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('news_ticker_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('news_ticker_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('news_ticker_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('news_ticker_font_style') ); ?>;}

    .entry-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('post_title_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('post_title_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('post_title_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('post_title_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('post_title_line_height') ); ?>;}

    .elegantwp-posts .elegantwp-posts-heading,.elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title,.elegantwp-featured-posts-area .widget .elegantwp-widget-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('widget_title_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('widget_title_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('widget_title_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('widget_title_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('sidebar_title_line_height') ); ?>;}

    #elegantwp-footer-blocks .widget .elegantwp-widget-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('footer_title_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('footer_title_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('footer_title_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('footer_title_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('footer_title_line_height') ); ?>;}

    .elegantwp-fp01-post .elegantwp-fp01-post-title,.elegantwp-fp02-post .elegantwp-fp02-post-title,.elegantwp-fp10-post .elegantwp-fp10-post-title,.elegantwp-fp11-post .elegantwp-fp11-post-title,.elegantwp-fp12-post .elegantwp-fp12-post-title,.elegantwp-fp13-post .elegantwp-fp13-post-title,.elegantwp-fp14-post .elegantwp-fp14-post-title,.elegantwp-fp15-post .elegantwp-fp15-post-title,.elegantwp-carousel-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('hpost_title_sm_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('hpost_title_sm_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('hpost_title_sm_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('hpost_title_sm_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('hpost_title_sm_line_height') ); ?>;}

    .elegantwp-related-posts-wrap h4,.elegantwp-fp02-posts-left .elegantwp-fp02-post .elegantwp-fp02-post-title,.elegantwp-fp03-post .elegantwp-fp03-post-title,.elegantwp-fp04-post .elegantwp-fp04-post-title,.elegantwp-fp05-post .elegantwp-fp05-post-title,.elegantwp-fp06-post .elegantwp-fp06-post-title,.elegantwp-fp08-post .elegantwp-fp08-post-title,.elegantwp-fp09-post .elegantwp-fp09-post-title,.elegantwp-fp11-post:first-child .elegantwp-fp11-post-title,.elegantwp-fp12-posts-left .elegantwp-fp12-post .elegantwp-fp12-post-title,.elegantwp-fp14-post:first-child .elegantwp-fp14-post-title,.elegantwp-fp15-post:first-child .elegantwp-fp15-post-title,.elegantwp-fp16-post .elegantwp-fp16-post-title{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('hpost_title_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('hpost_title_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('hpost_title_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('hpost_title_font_style') ); ?>;line-height:<?php echo esc_attr( elegantwp_get_option('hpost_title_line_height') ); ?>;}

    .elegantwp-fp02-post-categories a,.elegantwp-fp03-post-categories a,.elegantwp-fp04-post-categories a,.elegantwp-fp05-post-categories a,.elegantwp-fp06-post-categories a,.elegantwp-fp08-post-categories a,.elegantwp-fp09-post-categories a,.elegantwp-fp11-post-categories a,.elegantwp-fp12-post-categories a,.elegantwp-fp13-post-categories a,.elegantwp-fp14-post-categories a,.elegantwp-fp15-post-categories a,.elegantwp-fp16-post-categories a{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('hpost_cats_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('hpost_cats_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('hpost_cats_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('hpost_cats_font_style') ); ?>;}

    .elegantwp-entry-meta-single,.elegantwp-fp01-post-footer,.elegantwp-fp02-post-footer,.elegantwp-fp03-post-footer,.elegantwp-fp04-post-footer,.elegantwp-fp05-post-footer,.elegantwp-fp06-post-footer,.elegantwp-fp08-post-footer,.elegantwp-fp09-post-footer,.elegantwp-fp10-post-footer,.elegantwp-fp11-post-footer,.elegantwp-fp12-post-footer,.elegantwp-fp13-post-footer,.elegantwp-fp14-post-footer,.elegantwp-fp15-post-footer,.elegantwp-fp16-post-footer{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('hpost_meta_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('hpost_meta_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('hpost_meta_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('hpost_meta_font_style') ); ?>;}

    .elegantwp-fp02-post-read-more,.elegantwp-fp03-post-read-more,.elegantwp-fp04-post-read-more,.elegantwp-fp05-post-read-more,.elegantwp-fp06-post-read-more,.elegantwp-fp08-post-read-more,.elegantwp-fp11-post-read-more,.elegantwp-fp12-post-read-more,.elegantwp-fp13-post-read-more,.elegantwp-fp14-post-read-more,.elegantwp-fp15-post-read-more{font-family:<?php echo elegantwp_get_font_name(elegantwp_get_option('read_more_fonts')); ?>;font-size:<?php echo esc_attr( elegantwp_get_option('read_more_font_size') ); ?>;font-weight:<?php echo esc_attr( elegantwp_get_option('read_more_font_weight') ); ?>;font-style:<?php echo esc_attr( elegantwp_get_option('read_more_font_style') ); ?>;}
    </style>
    <?php
}
add_action( 'wp_head', 'elegantwp_customizer_fonts' );

// Customizer Options
function elegantwp_customizer_css() {
    ?>
    <style type="text/css">
    <?php if ( elegantwp_get_option('selected_text_color') ) { ?>
    ::-moz-selection{color:<?php echo esc_attr( elegantwp_get_option('selected_text_color') ); ?>;}
    ::selection{color:<?php echo esc_attr( elegantwp_get_option('selected_text_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('selected_text_bg_color') ) { ?>
    ::-moz-selection{background-color:<?php echo esc_attr( elegantwp_get_option('selected_text_bg_color') ); ?>;}
    ::selection{background-color:<?php echo esc_attr( elegantwp_get_option('selected_text_bg_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('button_text_color') ) { ?>
    button,input[type="button"],input[type="reset"],input[type="submit"]{color:<?php echo esc_attr( elegantwp_get_option('button_text_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('button_text_shadow_color') ) { ?>
    button,input[type="button"],input[type="reset"],input[type="submit"]{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('button_text_shadow_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('button_bg_color') ) { ?>
    button,input[type="button"],input[type="reset"],input[type="submit"]{background:<?php echo esc_attr( elegantwp_get_option('button_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('button_bd_color') ) { ?>
    button,input[type="button"],input[type="reset"],input[type="submit"]{border:1px solid <?php echo esc_attr( elegantwp_get_option('button_bd_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('button_hover_bg_color') ) { ?>
    button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover{background:<?php echo esc_attr( elegantwp_get_option('button_hover_bg_color') ); ?>}
    button:focus,input[type="button"]:focus,input[type="reset"]:focus,input[type="submit"]:focus,button:active,input[type="button"]:active,input[type="reset"]:active,input[type="submit"]:active{background:<?php echo esc_attr( elegantwp_get_option('button_hover_bg_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('body_text_color') ) { ?>
    body,button,input,select,textarea{color:<?php echo esc_attr( elegantwp_get_option('body_text_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('link_color') ) { ?>
    a{color:<?php echo esc_attr( elegantwp_get_option('link_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('link_hover_color') ) { ?>
    a:hover{color:<?php echo esc_attr( elegantwp_get_option('link_hover_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('headings_color') ) { ?>
    h1,h2,h3,h4,h5,h6{color:<?php echo esc_attr( elegantwp_get_option('headings_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('outer_border_one_color') ) { ?>
    .elegantwp-outer-wrapper-full{border:1px solid <?php echo esc_attr( elegantwp_get_option('outer_border_one_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('outer_border_two_color') ) { ?>
    .elegantwp-outer-wrapper{border:1px solid <?php echo esc_attr( elegantwp_get_option('outer_border_two_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('secondary_menu_bg_color') ) { ?>
    .elegantwp-nav-secondary{background:<?php echo esc_attr( elegantwp_get_option('secondary_menu_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_menu_color') ) { ?>
    .elegantwp-secondary-nav-menu a{color:<?php echo esc_attr( elegantwp_get_option('secondary_menu_color') ); ?>}
    @media only screen and (max-width: 1112px) {
    .elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu > .menu-item-has-children:before,.elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu > .page_item_has_children:before{color:<?php echo esc_attr( elegantwp_get_option('secondary_menu_color') ); ?>}
    .elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu .elegantwp-secondary-menu-open.menu-item-has-children:before,.elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu .elegantwp-secondary-menu-open.page_item_has_children:before{color:<?php echo esc_attr( elegantwp_get_option('secondary_menu_color') ); ?>}
    }
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_menu_shadow_color') ) { ?>
    .elegantwp-secondary-nav-menu a{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('secondary_menu_shadow_color') ); ?>}
    @media only screen and (max-width: 1112px) {
    .elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu > .menu-item-has-children:before,.elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu > .page_item_has_children:before{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('secondary_menu_shadow_color') ); ?>}
    .elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu .elegantwp-secondary-menu-open.menu-item-has-children:before,.elegantwp-secondary-nav-menu.elegantwp-secondary-responsive-menu .elegantwp-secondary-menu-open.page_item_has_children:before{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('secondary_menu_shadow_color') ); ?>}
    }
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_menu_hover_color') ) { ?>
    .elegantwp-secondary-nav-menu a:hover,.elegantwp-secondary-nav-menu .current-menu-item > a,.elegantwp-secondary-nav-menu .sub-menu .current-menu-item > a:hover,.elegantwp-secondary-nav-menu .current_page_item > a,.elegantwp-secondary-nav-menu .children .current_page_item > a:hover{color:<?php echo esc_attr( elegantwp_get_option('secondary_menu_hover_color') ); ?>}
    .elegantwp-secondary-nav-menu .sub-menu .current-menu-item > a,.elegantwp-secondary-nav-menu .children .current_page_item > a{color:<?php echo esc_attr( elegantwp_get_option('secondary_menu_hover_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_menu_hover_bg_color') ) { ?>
    .elegantwp-secondary-nav-menu a:hover,.elegantwp-secondary-nav-menu .current-menu-item > a,.elegantwp-secondary-nav-menu .sub-menu .current-menu-item > a:hover,.elegantwp-secondary-nav-menu .current_page_item > a,.elegantwp-secondary-nav-menu .children .current_page_item > a:hover{background:<?php echo esc_attr( elegantwp_get_option('secondary_menu_hover_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_submenu_one_bg_color') ) { ?>
    .elegantwp-secondary-nav-menu .sub-menu,.elegantwp-secondary-nav-menu .children{background:<?php echo esc_attr( elegantwp_get_option('secondary_submenu_one_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_submenu_one_bd_color') ) { ?>
    .elegantwp-secondary-nav-menu .sub-menu a,.elegantwp-secondary-nav-menu .children a{border:1px solid <?php echo esc_attr( elegantwp_get_option('secondary_submenu_one_bd_color') ); ?>;border-top:none;}
    .elegantwp-secondary-nav-menu .sub-menu li:first-child a,.elegantwp-secondary-nav-menu .children li:first-child a{border-top:1px solid <?php echo esc_attr( elegantwp_get_option('secondary_submenu_one_bd_color') ); ?>;}
    .elegantwp-secondary-nav-menu > li > a{border-right:1px solid <?php echo esc_attr( elegantwp_get_option('secondary_submenu_one_bd_color') ); ?>;}
    .elegantwp-secondary-nav-menu > li:first-child > a {border-left: 0px solid <?php echo esc_attr( elegantwp_get_option('secondary_submenu_one_bd_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('secondary_menu_icon_color') ) { ?>
    .elegantwp-secondary-responsive-menu-icon::before{color: <?php echo esc_attr( elegantwp_get_option('secondary_menu_icon_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('header_bg_color') ) { ?>
    .elegantwp-head-content{background:<?php echo esc_attr( elegantwp_get_option('header_bg_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('primary_menu_bg_color') ) { ?>
    .elegantwp-nav-primary{background:<?php echo esc_attr( elegantwp_get_option('primary_menu_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_bd_color') ) { ?>
    .elegantwp-nav-primary{border-bottom:3px solid <?php echo esc_attr( elegantwp_get_option('primary_menu_bd_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_color') ) { ?>
    .elegantwp-nav-primary-menu a{color:<?php echo esc_attr( elegantwp_get_option('primary_menu_color') ); ?>}
    @media only screen and (max-width: 1112px) {
    .elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu > .menu-item-has-children:before,.elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu > .page_item_has_children:before{color:<?php echo esc_attr( elegantwp_get_option('primary_menu_color') ); ?>}
    .elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu .elegantwp-primary-menu-open.menu-item-has-children:before,.elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu .elegantwp-primary-menu-open.page_item_has_children:before{color:<?php echo esc_attr( elegantwp_get_option('primary_menu_color') ); ?>}
    }
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_shadow_color') ) { ?>
    .elegantwp-nav-primary-menu a{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('primary_menu_shadow_color') ); ?>}
    @media only screen and (max-width: 1112px) {
    .elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu > .menu-item-has-children:before,.elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu > .page_item_has_children:before{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('primary_menu_shadow_color') ); ?>}
    .elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu .elegantwp-primary-menu-open.menu-item-has-children:before,.elegantwp-nav-primary-menu.elegantwp-primary-responsive-menu .elegantwp-primary-menu-open.page_item_has_children:before{text-shadow:0 1px 0 <?php echo esc_attr( elegantwp_get_option('primary_menu_shadow_color') ); ?>}
    }
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_hover_color') ) { ?>
    .elegantwp-nav-primary-menu a:hover,.elegantwp-nav-primary-menu .current-menu-item > a,.elegantwp-nav-primary-menu .sub-menu .current-menu-item > a:hover,.elegantwp-nav-primary-menu .current_page_item > a,.elegantwp-nav-primary-menu .children .current_page_item > a:hover{color:<?php echo esc_attr( elegantwp_get_option('primary_menu_hover_color') ); ?>}
    .elegantwp-nav-primary-menu .sub-menu .current-menu-item > a,.elegantwp-nav-primary-menu .children .current_page_item > a{color:<?php echo esc_attr( elegantwp_get_option('primary_menu_hover_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_hover_bg_color') ) { ?>
    .elegantwp-nav-primary-menu a:hover,.elegantwp-nav-primary-menu .current-menu-item > a,.elegantwp-nav-primary-menu .sub-menu .current-menu-item > a:hover,.elegantwp-nav-primary-menu .current_page_item > a,.elegantwp-nav-primary-menu .children .current_page_item > a:hover{background:<?php echo esc_attr( elegantwp_get_option('primary_menu_hover_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_submenu_one_bg_color') ) { ?>
    .elegantwp-nav-primary-menu .sub-menu,.elegantwp-nav-primary-menu .children{background:<?php echo esc_attr( elegantwp_get_option('primary_submenu_one_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_submenu_two_bd_color') ) { ?>
    .elegantwp-nav-primary-menu > li > a{border-left:1px solid <?php echo esc_attr( elegantwp_get_option('primary_submenu_two_bd_color') ); ?>;}
    .elegantwp-nav-primary-menu > li:first-child > a {border-left: 0px solid <?php echo esc_attr( elegantwp_get_option('primary_submenu_two_bd_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_submenu_one_bd_color') ) { ?>
    .elegantwp-nav-primary-menu .sub-menu a,.elegantwp-nav-primary-menu .children a{border:1px solid <?php echo esc_attr( elegantwp_get_option('primary_submenu_one_bd_color') ); ?>;border-top:none;}
    .elegantwp-nav-primary-menu .sub-menu li:first-child a,.elegantwp-nav-primary-menu .children li:first-child a{border-top:1px solid <?php echo esc_attr( elegantwp_get_option('primary_submenu_one_bd_color') ); ?>;}
    .elegantwp-nav-primary-menu > li > a{border-right:1px solid <?php echo esc_attr( elegantwp_get_option('primary_submenu_one_bd_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('primary_menu_icon_color') ) { ?>
    .elegantwp-primary-responsive-menu-icon::before{color: <?php echo esc_attr( elegantwp_get_option('primary_menu_icon_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('header_social_color') ) { ?>
    .elegantwp-top-social-icons a{color: <?php echo esc_attr( elegantwp_get_option('header_social_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('header_social_hover_color') ) { ?>
    .elegantwp-top-social-icons a:hover{color: <?php echo esc_attr( elegantwp_get_option('header_social_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('news_ticker_bg_color') ) { ?>
    .elegantwp-trending-news{background: <?php echo esc_attr( elegantwp_get_option('news_ticker_bg_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('news_ticker_heading_color') ) { ?>
    .elegantwp-trending-news-title{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_heading_color') ); ?> !important;}
    span.elegantwp-trending-news-item-date{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_heading_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('news_ticker_heading_bg_color') ) { ?>
    .elegantwp-trending-news-title{background: <?php echo esc_attr( elegantwp_get_option('news_ticker_heading_bg_color') ); ?>;}
    .elegantwp-trending-news-title:after{border-left: 15px solid <?php echo esc_attr( elegantwp_get_option('news_ticker_heading_bg_color') ); ?>;}
    span.elegantwp-trending-news-item-date{background: <?php echo esc_attr( elegantwp_get_option('news_ticker_heading_bg_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('news_ticker_text_color') ) { ?>
    .elegantwp-trending-news-items.elegantwp-marquee a{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_text_color') ); ?> !important;}
    span.elegantwp-trending-news-item-title:before{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_text_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('news_ticker_hover_text_color') ) { ?>
    .elegantwp-trending-news-items.elegantwp-marquee a:hover{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_hover_text_color') ); ?>;}
    .elegantwp-trending-news-items.elegantwp-marquee a:hover .elegantwp-trending-news-item-title:before{color: <?php echo esc_attr( elegantwp_get_option('news_ticker_hover_text_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('fullwidth_bg_color') ) { ?>
    .elegantwp-top-wrapper{background:<?php echo esc_attr( elegantwp_get_option('fullwidth_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('fullwidth_bd_one_color') ) { ?>
    .elegantwp-top-wrapper{border-bottom:1px solid <?php echo esc_attr( elegantwp_get_option('fullwidth_bd_one_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('fullwidth_bd_two_color') ) { ?>
    .elegantwp-top-wrapper-outer{border-bottom:1px solid <?php echo esc_attr( elegantwp_get_option('fullwidth_bd_two_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('content_bg_color') ) { ?>
    .elegantwp-content-wrapper{background:<?php echo esc_attr( elegantwp_get_option('content_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_one_bg_color') ) { ?>
    .elegantwp-sidebar-one-wrapper{background:<?php echo esc_attr( elegantwp_get_option('sidebar_one_bg_color') ); ?>}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_two_bg_color') ) { ?>
    .elegantwp-sidebar-two-wrapper{background:<?php echo esc_attr( elegantwp_get_option('sidebar_two_bg_color') ); ?>}
    <?php } ?>

    <?php if ( elegantwp_get_option('post_title_color') ) { ?>
    .entry-title,.entry-title a{color:<?php echo esc_attr( elegantwp_get_option('post_title_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('mini_post_title_color') ) { ?>
    .elegantwp-fp01-post .elegantwp-fp01-post-title,.elegantwp-fp01-post .elegantwp-fp01-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp02-post .elegantwp-fp02-post-title,.elegantwp-fp02-post .elegantwp-fp02-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp03-post .elegantwp-fp03-post-title,.elegantwp-fp03-post .elegantwp-fp03-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp04-post .elegantwp-fp04-post-title,.elegantwp-fp04-post .elegantwp-fp04-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp05-post .elegantwp-fp05-post-title,.elegantwp-fp05-post .elegantwp-fp05-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp09-post .elegantwp-fp09-post-title,.elegantwp-fp09-post .elegantwp-fp09-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp10-post .elegantwp-fp10-post-title,.elegantwp-fp10-post .elegantwp-fp10-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp11-post .elegantwp-fp11-post-title,.elegantwp-fp11-post .elegantwp-fp11-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp12-post .elegantwp-fp12-post-title,.elegantwp-fp12-post .elegantwp-fp12-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp13-post .elegantwp-fp13-post-title,.elegantwp-fp13-post .elegantwp-fp13-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp14-post .elegantwp-fp14-post-title,.elegantwp-fp14-post .elegantwp-fp14-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    .elegantwp-fp15-post .elegantwp-fp15-post-title,.elegantwp-fp15-post .elegantwp-fp15-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('post_title_hover_color') ) { ?>
    .entry-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('post_title_hover_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('mini_post_title_hover_color') ) { ?>
    .elegantwp-fp01-post .elegantwp-fp01-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp02-post .elegantwp-fp02-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp03-post .elegantwp-fp03-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp04-post .elegantwp-fp04-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp05-post .elegantwp-fp05-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp09-post .elegantwp-fp09-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp10-post .elegantwp-fp10-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp11-post .elegantwp-fp11-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp12-post .elegantwp-fp12-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp13-post .elegantwp-fp13-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp14-post .elegantwp-fp14-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp15-post .elegantwp-fp15-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('mini_post_title_two_color') ) { ?>
    .elegantwp-fp06-post .elegantwp-fp06-post-title,.elegantwp-fp06-post .elegantwp-fp06-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_color') ); ?> !important;}
    .elegantwp-fp08-post .elegantwp-fp08-post-title,.elegantwp-fp08-post .elegantwp-fp08-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_color') ); ?> !important;}
    .elegantwp-fp15-post:first-child .elegantwp-fp15-post-title,.elegantwp-fp15-post:first-child .elegantwp-fp15-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_color') ); ?> !important;}
    .elegantwp-fp16-post .elegantwp-fp16-post-title,.elegantwp-fp16-post .elegantwp-fp16-post-title a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_color') ); ?> !important;}
    .elegantwp-carousel-title,.elegantwp-posts-carousel .elegantwp-slide-item .text-over,.elegantwp-posts-carousel .elegantwp-slide-item .text-over a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('mini_post_title_two_hover_color') ) { ?>
    .elegantwp-fp06-post .elegantwp-fp06-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp08-post .elegantwp-fp08-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp15-post:first-child .elegantwp-fp15-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-fp16-post .elegantwp-fp16-post-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_hover_color') ); ?> !important;}
    .elegantwp-posts-carousel .elegantwp-slide-item .text-over a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_title_two_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('post_body_link_color') ) { ?>
    .entry-content a{color:<?php echo esc_attr( elegantwp_get_option('post_body_link_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('post_body_link_hover_color') ) { ?>
    .entry-content a:hover{color:<?php echo esc_attr( elegantwp_get_option('post_body_link_hover_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('postcats_color') ) { ?>
    .elegantwp-fp02-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp03-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp04-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp05-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp06-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp08-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp09-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp11-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp12-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp13-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp14-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp15-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    .elegantwp-fp16-post-categories a{color:<?php echo esc_attr( elegantwp_get_option('postcats_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('postcats_bg_color') ) { ?>
    .elegantwp-fp02-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp03-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp04-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp05-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp06-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp08-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp09-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp11-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp12-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp13-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp14-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp15-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    .elegantwp-fp16-post-categories a{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('postcats_hover_color') ) { ?>
    .elegantwp-fp02-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp03-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp04-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp05-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp06-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp08-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp09-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp11-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp12-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp13-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp14-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp15-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    .elegantwp-fp16-post-categories a:hover{color:<?php echo esc_attr( elegantwp_get_option('postcats_hover_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('postcats_bg_hover_color') ) { ?>
    .elegantwp-fp02-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp03-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp04-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp05-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp06-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp08-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp09-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp11-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp12-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp13-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp14-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp15-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    .elegantwp-fp16-post-categories a:hover{background:<?php echo esc_attr( elegantwp_get_option('postcats_bg_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('post_meta_color') ) { ?>
    .elegantwp-entry-meta-single,.elegantwp-entry-meta-single a{color:<?php echo esc_attr( elegantwp_get_option('post_meta_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('mini_post_meta_color') ) { ?>
    .elegantwp-fp01-post-footer,.elegantwp-fp01-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp02-post-footer,.elegantwp-fp02-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp03-post-footer,.elegantwp-fp03-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp04-post-footer,.elegantwp-fp04-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp05-post-footer,.elegantwp-fp05-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp09-post-footer,.elegantwp-fp09-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp10-post-footer,.elegantwp-fp10-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp11-post-footer,.elegantwp-fp11-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp12-post-footer,.elegantwp-fp12-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp13-post-footer,.elegantwp-fp13-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    .elegantwp-fp14-post-footer,.elegantwp-fp14-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('post_meta_hover_color') ) { ?>
    .elegantwp-entry-meta-single a:hover{color:<?php echo esc_attr( elegantwp_get_option('post_meta_hover_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('mini_post_meta_hover_color') ) { ?>
    .elegantwp-fp01-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp02-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp03-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp04-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp05-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp09-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp10-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp11-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp12-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp13-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    .elegantwp-fp14-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('mini_post_meta_two_color') ) { ?>
    .elegantwp-fp06-post-footer,.elegantwp-fp06-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_color') ); ?> !important;}
    .elegantwp-fp08-post-footer,.elegantwp-fp08-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_color') ); ?> !important;}
    .elegantwp-fp15-post-footer,.elegantwp-fp15-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_color') ); ?> !important;}
    .elegantwp-fp16-post-footer,.elegantwp-fp16-post-footer a{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('mini_post_meta_two_hover_color') ) { ?>
    .elegantwp-fp06-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_hover_color') ); ?> !important;}
    .elegantwp-fp08-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_hover_color') ); ?> !important;}
    .elegantwp-fp15-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_hover_color') ); ?> !important;}
    .elegantwp-fp16-post-footer a:hover{color:<?php echo esc_attr( elegantwp_get_option('mini_post_meta_two_hover_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('rmore_color') ) { ?>
    .elegantwp-fp02-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp03-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp04-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp05-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp06-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp08-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp11-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp12-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp13-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp14-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    .elegantwp-fp15-post-read-more a{color:<?php echo esc_attr( elegantwp_get_option('rmore_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('rmore_bg_color') ) { ?>
    .elegantwp-fp02-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp03-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp04-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp05-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp06-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp08-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp11-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp12-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp13-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp14-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    .elegantwp-fp15-post-read-more a{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('rmore_hover_color') ) { ?>
    .elegantwp-fp02-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp03-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp04-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp05-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp06-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp08-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp11-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp12-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp13-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp14-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    .elegantwp-fp15-post-read-more a:hover{color:<?php echo esc_attr( elegantwp_get_option('rmore_hover_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('rmore_bg_hover_color') ) { ?>
    .elegantwp-fp02-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp03-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp04-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp05-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp06-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp08-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp11-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp12-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp13-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp14-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    .elegantwp-fp15-post-read-more a:hover{background:<?php echo esc_attr( elegantwp_get_option('rmore_bg_hover_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('sidebar_title_color') ) { ?>
    .elegantwp-posts .elegantwp-posts-heading,.elegantwp-posts .elegantwp-posts-heading a,.elegantwp-posts .elegantwp-posts-heading a:hover{color:<?php echo esc_attr( elegantwp_get_option('sidebar_title_color') ); ?>;}
    .page-header,.page-header h1{color:<?php echo esc_attr( elegantwp_get_option('sidebar_title_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title,.elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title a,.elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('sidebar_title_color') ); ?>;}
    .elegantwp-featured-posts-area .widget .elegantwp-widget-title,.elegantwp-featured-posts-area .widget .elegantwp-widget-title a,.elegantwp-featured-posts-area .widget .elegantwp-widget-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('sidebar_title_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_title_bg_one_color') ) { ?>
    .elegantwp-posts .elegantwp-posts-heading{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_one_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_one_color') ); ?>;}
    .elegantwp-featured-posts-area .widget .elegantwp-widget-title{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_one_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_title_bg_two_color') ) { ?>
    .elegantwp-posts .elegantwp-posts-heading span{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-posts .elegantwp-posts-heading span:after{border-left:15px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-posts .elegantwp-posts-heading{border-bottom:3px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .page-header{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title span{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title span:after{border-left:15px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget .elegantwp-widget-title{border-bottom:3px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-featured-posts-area .widget .elegantwp-widget-title span{background:<?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-featured-posts-area .widget .elegantwp-widget-title span:after{border-left:15px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    .elegantwp-featured-posts-area .widget .elegantwp-widget-title{border-bottom:3px solid <?php echo esc_attr( elegantwp_get_option('sidebar_title_bg_two_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('sidebar_link_color') ) { ?>
    .elegantwp-sidebar-widget-areas .widget a{color:<?php echo esc_attr( elegantwp_get_option('sidebar_link_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_link_hover_color') ) { ?>
    .elegantwp-sidebar-widget-areas .widget a:hover{color:<?php echo esc_attr( elegantwp_get_option('sidebar_link_hover_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('sidebar_list_bd_color') ) { ?>
    .elegantwp-sidebar-widget-areas .widget li{border-bottom:1px dotted <?php echo esc_attr( elegantwp_get_option('sidebar_list_bd_color') ); ?>;}
    .elegantwp-sidebar-widget-areas .widget li:last-child{border-bottom:none;}
    .elegantwp-featured-posts-area .widget li{border-bottom:1px dotted <?php echo esc_attr( elegantwp_get_option('sidebar_list_bd_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('tag_cloud_color') ) { ?>
    .widget_tag_cloud a{color:<?php echo esc_attr( elegantwp_get_option('tag_cloud_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('tag_cloud_bg_color') ) { ?>
    .widget_tag_cloud a{background:<?php echo esc_attr( elegantwp_get_option('tag_cloud_bg_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('tag_cloud_hover_color') ) { ?>
    .widget_tag_cloud a:hover{color:<?php echo esc_attr( elegantwp_get_option('tag_cloud_hover_color') ); ?> !important;}
    <?php } ?>
    <?php if ( elegantwp_get_option('tag_cloud_hover_bg_color') ) { ?>
    .widget_tag_cloud a:hover{background:<?php echo esc_attr( elegantwp_get_option('tag_cloud_hover_bg_color') ); ?> !important;}
    <?php } ?>

    <?php if ( elegantwp_get_option('footer_bg_color') ) { ?>
    #elegantwp-footer-blocks{background:<?php echo esc_attr( elegantwp_get_option('footer_bg_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_title_color') ) { ?>
    #elegantwp-footer-blocks .widget .elegantwp-widget-title,#elegantwp-footer-blocks .widget .elegantwp-widget-title a,#elegantwp-footer-blocks .widget .elegantwp-widget-title a:hover{color:<?php echo esc_attr( elegantwp_get_option('footer_title_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_title_bd_one_color') ) { ?>
    #elegantwp-footer-blocks .widget .elegantwp-widget-title{border-bottom:1px dotted <?php echo esc_attr( elegantwp_get_option('footer_title_bd_one_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_title_bd_one_color') ) { ?>
    #elegantwp-footer-blocks .widget .elegantwp-widget-title span{border-bottom:1px dotted <?php echo esc_attr( elegantwp_get_option('footer_title_bd_one_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_text_color') ) { ?>
    #elegantwp-footer-blocks{color:<?php echo esc_attr( elegantwp_get_option('footer_text_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_link_color') ) { ?>
    #elegantwp-footer-blocks a{color:<?php echo esc_attr( elegantwp_get_option('footer_link_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_link_hover_color') ) { ?>
    #elegantwp-footer-blocks a:hover{color:<?php echo esc_attr( elegantwp_get_option('footer_link_hover_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('footer_list_bd_color') ) { ?>
    #elegantwp-footer-blocks .widget li{border-bottom:1px dotted <?php echo esc_attr( elegantwp_get_option('footer_list_bd_color') ); ?>;}
    #elegantwp-footer-blocks .widget li:last-child{border-bottom:none;}
    <?php } ?>

    <?php if ( elegantwp_get_option('cp_bg_color') ) { ?>
    #elegantwp-footer{background:<?php echo esc_attr( elegantwp_get_option('cp_bg_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('cp_bd_color') ) { ?>
    #elegantwp-footer{border-top:1px solid <?php echo esc_attr( elegantwp_get_option('cp_bd_color') ); ?>;}
    <?php } ?>
    <?php if ( elegantwp_get_option('cp_color') ) { ?>
    #elegantwp-footer .elegantwp-foot-wrap a,#elegantwp-footer .elegantwp-foot-wrap p.elegantwp-copyright,#elegantwp-footer .elegantwp-foot-wrap p.elegantwp-credit{color:<?php echo esc_attr( elegantwp_get_option('cp_color') ); ?>;}
    <?php } ?>

    <?php if ( elegantwp_get_option('disable_backtotop') ) { ?>.elegantwp-scroll-top {display:none !important;}<?php } ?>
    <?php if ( elegantwp_get_option('disable_shadow_color') ) { ?>.elegantwp-content-wrapper,.elegantwp-head-content,.elegantwp-nav-secondary,.elegantwp-nav-primary,#elegantwp-footer{-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}<?php } ?>
    </style>
    <?php
}
add_action( 'wp_head', 'elegantwp_customizer_css' );

// Header styles
if ( ! function_exists( 'elegantwp_header_style' ) ) :
function elegantwp_header_style() {
    $header_text_color = get_header_textcolor();
    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) { return; }
    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
        .elegantwp-site-title, .elegantwp-site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}
    <?php else : ?>
        .elegantwp-site-title, .elegantwp-site-title a, .elegantwp-site-description {color: #<?php echo esc_attr( $header_text_color ); ?>;}
    <?php endif; ?>
    </style>
    <?php
}
endif;