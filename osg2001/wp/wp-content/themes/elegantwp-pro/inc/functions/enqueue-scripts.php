<?php
/**
* Enqueue scripts and styles
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_scripts() {
    wp_enqueue_style('elegantwp-maincss', get_stylesheet_uri(), array(), NULL);
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), NULL );

    $elegantwp_font_subsets_array = elegantwp_get_option('font_subsets');
    if($elegantwp_font_subsets_array) {
        $elegantwp_font_subsets_list = rtrim(implode(',', $elegantwp_font_subsets_array), ',');
        $elegantwp_font_subsets_list = '&amp;subset='.$elegantwp_font_subsets_list;
    } else {
        $elegantwp_font_subsets_list = '';
    }
    wp_enqueue_style('elegantwp-webfont', '//fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i|Domine:400,700|Oswald:400,700|Poppins:400,400i,700,700i'.$elegantwp_font_subsets_list, array(), NULL);

    wp_enqueue_script('fitvids', get_template_directory_uri() .'/assets/js/jquery.fitvids.min.js', array( 'jquery' ), NULL, true);
    wp_enqueue_script('marquee', get_template_directory_uri() .'/assets/js/jquery.marquee.min.js', array( 'jquery' ), NULL, true);

    $elegantwp_sticky_menu = FALSE;
    if ( !elegantwp_get_option('disable_sticky_menu') ) {
        $elegantwp_sticky_menu = TRUE;
    }

    $elegantwp_sticky_sidebar = FALSE;
    if ( !elegantwp_get_option('disable_sticky_sidebar') ) {
        $elegantwp_sticky_sidebar = TRUE;
    }
    if ( is_page_template() ) {
        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-page-sidebar.php', 'template-full-width-post.php', 'template-full-width-post-sidebar.php', 'template-contact-page.php', 'template-sitemap.php', 'template-site-authors.php' ) ) ) {
           $elegantwp_sticky_sidebar = FALSE;
        }
    }
    if ( !is_page_template() ) {
        if ( ('one-column' === elegantwp_get_option('layout_style')) || is_404() ) {
            $elegantwp_sticky_sidebar = FALSE;
        }
    }
    if ( $elegantwp_sticky_sidebar ) {
        wp_enqueue_script('ResizeSensor', get_template_directory_uri() .'/assets/js/ResizeSensor.min.js', array( 'jquery' ), NULL, true);
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() .'/assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), NULL, true);
    }

    $elegantwp_news_ticker = FALSE;
    if ( elegantwp_get_option('enable_news_ticker') ) {
        $elegantwp_news_ticker = TRUE;
    }

    wp_enqueue_script('elegantwp-customjs', get_template_directory_uri() .'/assets/js/custom.js', array( 'jquery' ), NULL, true);
    wp_localize_script( 'elegantwp-customjs', 'elegantwp_ajax_object',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'sticky_menu' => $elegantwp_sticky_menu,
            'sticky_sidebar' => $elegantwp_sticky_sidebar,
            'news_ticker' => $elegantwp_news_ticker,
        )
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'elegantwp_scripts' );

/**
 * Enqueue IE compatible scripts and styles.
 */
function elegantwp_ie_scripts() {
    wp_enqueue_script( 'html5shiv', get_template_directory_uri(). '/assets/js/html5shiv.min.js', array(), NULL, false);
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond', get_template_directory_uri(). '/assets/js/respond.min.js', array(), NULL, false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'elegantwp_ie_scripts' );

/**
 * Enqueue customizer styles.
 */
function elegantwp_enqueue_customizer_styles() {
    wp_enqueue_style( 'elegantwp-customizer-styles', get_template_directory_uri() . '/inc/admin/css/customizer-style.css', array(), NULL );
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), NULL );
}
add_action( 'customize_controls_enqueue_scripts', 'elegantwp_enqueue_customizer_styles' );

function elegantwp_get_font_name($fonturl){
    if($fonturl){
        $patterns = array('!^//fonts.googleapis.com/css\?!', '!(family=[^&:]+).*$!', '!family=!', '!\+!');
        $replacements = array("", '$1', '', ' ');
        $fontname = preg_replace($patterns,$replacements,$fonturl);
        if (strpos($fonturl, 'fonts.googleapis.com') !== false) {
            return "'".$fontname."'";
        } else {
            return $fontname;
        }
    } else {
        return '';
    }
}

function elegantwp_fonts() {
    $body_fonts_url = elegantwp_get_option('body_fonts');
    $site_title_fonts_url = elegantwp_get_option('site_title_fonts');
    $site_desc_fonts_url = elegantwp_get_option('site_desc_fonts');
    $primary_menu_fonts_url = elegantwp_get_option('primary_menu_fonts');
    $secondary_menu_fonts_url = elegantwp_get_option('secondary_menu_fonts');
    $news_ticker_fonts_url = elegantwp_get_option('news_ticker_fonts');
    $hpost_title_fonts_url = elegantwp_get_option('hpost_title_fonts');
    $hpost_title_sm_fonts_url = elegantwp_get_option('hpost_title_sm_fonts');
    $hpost_cats_fonts_url = elegantwp_get_option('hpost_cats_fonts');
    $hpost_meta_fonts_url = elegantwp_get_option('hpost_meta_fonts');
    $read_more_fonts_url = elegantwp_get_option('read_more_fonts');
    $post_title_fonts_url = elegantwp_get_option('post_title_fonts');
    $widget_title_fonts_url = elegantwp_get_option('widget_title_fonts');
    $footer_title_fonts_url = elegantwp_get_option('footer_title_fonts');
    $headings_fonts_url = elegantwp_get_option('headings_fonts');

    $custom_font_urls = array($body_fonts_url, $site_title_fonts_url, $site_desc_fonts_url, $primary_menu_fonts_url, $secondary_menu_fonts_url, $news_ticker_fonts_url, $hpost_title_fonts_url, $hpost_title_sm_fonts_url, $hpost_cats_fonts_url, $hpost_meta_fonts_url, $read_more_fonts_url, $post_title_fonts_url, $widget_title_fonts_url, $footer_title_fonts_url, $headings_fonts_url);
    $custom_font_urls = array_filter( array_unique( $custom_font_urls ) );

    $custom_font_exclude_urls = array('//fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i', '//fonts.googleapis.com/css?family=Domine:400,700', '//fonts.googleapis.com/css?family=Oswald:400,700', '//fonts.googleapis.com/css?family=Poppins:400,400i,700,700i', 'Arial,"Helvetica Neue",Helvetica,sans-serif', '"Arial Black","Arial Bold",Gadget,sans-serif', '"Comic Sans MS", cursive, sans-serif', 'Impact, Charcoal, sans-serif', '"Lucida Sans Unicode", "Lucida Grande", sans-serif', 'Tahoma,Verdana,Segoe,sans-serif', '"Trebuchet MS","Lucida Grande","Lucida Sans Unicode","Lucida Sans",Tahoma,sans-serif', 'Verdana,Geneva,sans-serif', 'Georgia,Times,"Times New Roman",serif', 'Palatino,"Palatino Linotype","Palatino LT STD","Book Antiqua",Georgia,serif', '"Times New Roman",Times,Baskerville,Georgia,serif', '"Courier New",Courier,"Lucida Sans Typewriter","Lucida Typewriter",monospace', '"Lucida Console", Monaco, monospace');
    $custom_font_new_urls = array_diff($custom_font_urls, $custom_font_exclude_urls);

    if($custom_font_new_urls) {

    $elegantwp_font_subsets_array = elegantwp_get_option('font_subsets');
    if($elegantwp_font_subsets_array) {
        $elegantwp_font_subsets_list = rtrim(implode(',', $elegantwp_font_subsets_array), ',');
        $elegantwp_font_subsets_list = '&amp;subset='.$elegantwp_font_subsets_list;
    } else {
        $elegantwp_font_subsets_list = '';
    }

    $numfonts = count($custom_font_new_urls);
    $indexfont = 0;
    $elegantwp_custom_font_families = '';
    foreach ($custom_font_new_urls as $key => $value) {
        $value = str_replace('//fonts.googleapis.com/css?family=','',$value);
        $elegantwp_custom_font_families .= $value;
        if(++$indexfont != $numfonts) {
            $elegantwp_custom_font_families .= '|';
        }
    }

    if($elegantwp_custom_font_families) {
        wp_enqueue_style( 'elegantwp-customfont', '//fonts.googleapis.com/css?family='.$elegantwp_custom_font_families.$elegantwp_font_subsets_list, array(), NULL );
    }

    }
}
add_action( 'wp_enqueue_scripts', 'elegantwp_fonts' );