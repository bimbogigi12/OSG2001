<?php
/**
 * Default theme options.
 *
 * @package CoverNews
 */

if (!function_exists('covernews_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function covernews_get_default_theme_options() {

    $defaults = array();
    // Preloader options section
    $defaults['enable_site_preloader'] = 1;

    // Header options section
    $defaults['header_layout'] = 'header-layout-1';

    $defaults['show_top_header_section'] = 0;
    $defaults['top_header_background_color'] = "#353535";
    $defaults['top_header_text_color'] = "#ffffff";

    $defaults['show_top_menu'] = 0;
    $defaults['show_social_menu_section'] = 0;
    $defaults['disable_sticky_header_option'] = 0;
    
    $defaults['show_date_section'] = 0;
    $defaults['show_minicart_section'] = 1;

    $defaults['disable_header_image_tint_overlay'] = 0;
    $defaults['show_offpanel_menu_section'] = 1;


    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';
    $defaults['banner_advertisement_open_on_new_tab'] = 1;
    $defaults['banner_advertisement_scope'] = 'front-page-only';


    // breadcrumb options section
    $defaults['enable_breadcrumb'] = 1;
    $defaults['select_breadcrumb_mode'] = 'simple';

    // Frontpage Section.

    $defaults['show_flash_news_section'] = 1;
    $defaults['flash_news_title'] = __('Flash Story', 'covernews');
    $defaults['select_flash_news_category'] = 0;
    $defaults['number_of_flash_news'] = 5;
    $defaults['select_flash_new_mode'] = 'flash-slide-left';
    $defaults['banner_flash_news_scope'] = 'front-page-only';

    $defaults['show_main_news_section'] = 1;

    $defaults['main_news_slider_title'] = __('Main Story', 'covernews');
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_main_banner_section_mode'] = 'slider-editors-picks-trending';
    $defaults['number_of_slides'] = 5;

    $defaults['editors_picks_title'] = __("Editor's Picks", 'covernews');
    $defaults['select_editors_picks_category'] = 0;

    $defaults['trending_slider_title'] = __("Trending Story", 'covernews');
    $defaults['select_trending_news_category'] = 0;
    $defaults['number_of_trending_slides'] = 5;

    $defaults['show_featured_news_section'] = 1;
    $defaults['featured_news_section_title'] = __('Featured Story', 'covernews');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 5;

    $defaults['frontpage_content_alignment'] = 'align-content-left';
    $defaults['frontpage_sticky_sidebar'] = 1;

    //layout options
    $defaults['global_content_layout'] = 'default-content-layout';
    $defaults['global_content_alignment'] = 'align-content-left';
    $defaults['global_image_alignment'] = 'full-width-image';
    $defaults['global_post_date_author_setting'] = 'show-date-author';
    $defaults['global_excerpt_length'] = 20;
    $defaults['global_read_more_texts'] = __('Read more', 'covernews');
    $defaults['global_widget_excerpt_setting'] = 'trimmed-content';
    $defaults['global_date_display_setting'] = 'theme-date';

    $defaults['archive_layout'] = 'archive-layout-grid';
    $defaults['archive_image_alignment'] = 'archive-image-left';
    $defaults['archive_content_view'] = 'archive-content-excerpt';
    $defaults['disable_main_banner_on_blog_archive'] = 0;


    //Related posts
    $defaults['single_show_related_posts'] = 1;
    $defaults['single_related_posts_title']     = __( 'More Stories', 'covernews' );
    $defaults['single_number_of_related_posts']  = 6;

    //Pagination.
    $defaults['site_pagination_type'] = 'default';

    //Mailchimp
    $defaults['footer_show_mailchimp_subscriptions'] = 1;
    $defaults['footer_mailchimp_subscriptions_scopes'] = 'front-page';
    $defaults['footer_mailchimp_title']     = __( 'Subscribe To  Our Newsletter', 'covernews' );
    $defaults['footer_mailchimp_shortcode']  = '';
    $defaults['footer_mailchimp_background_color']  = '#1f2125';
    $defaults['footer_mailchimp_field_border_color']  = '#4d5b73';


    // Footer.
    // Latest posts
    $defaults['frontpage_show_latest_posts'] = 1;
    $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'covernews');
    $defaults['frontpage_latest_posts_category'] = 0;
    $defaults['number_of_frontpage_latest_posts'] = 4;

    //Instagram
    $defaults['footer_show_instagram_post_carousel'] = 0;
    $defaults['footer_instagram_post_carousel_scopes'] = 'front-page';
    $defaults['instagram_username'] = 'fashion_week';
    $defaults['instagram_access_token'] = '7510889272.577c420.c6d613a1e7d24499ae6432d8e2e6fe9f';
    $defaults['number_of_instagram_posts'] = 6;
    $defaults['footer_instagram_post_carousel_thumb_size'] = 'small';


    $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'covernews');
    $defaults['hide_footer_menu_section']  = 0;
    $defaults['hide_footer_site_title_section']  = 0;
    $defaults['hide_footer_copyright_credits']  = 0;
    $defaults['number_of_footer_widget']  = 3;
    $defaults['footer_background_color']  = '#1f2125';
    $defaults['footer_texts_color']  = '#ffffff';
    $defaults['footer_credits_background_color']  = '#000000';
    $defaults['footer_credits_texts_color']  = '#ffffff';



    // font and color options
    $defaults['site_title_font_size']     = 100;
    $defaults['primary_color']     = '#2a2a2a';
    $defaults['secondary_color']     = '#bb1919';
    $defaults['link_color']     = '#404040';
    $defaults['site_wide_title_color']     = '#000000';
    $defaults['main_navigation_link_color']     = '#ffffff';
    $defaults['main_navigation_badge_background']     = '#353535';
    $defaults['main_navigation_badge_color']     = '#ffffff';
    $defaults['title_link_color']     = '#404040';
    $defaults['title_over_image_color']     = '#ffffff';




    //font option

    $defaults['primary_font']      = 'Source+Sans+Pro:400,400i,700,700i';
    $defaults['secondary_font']    = 'Lato:400,300,400italic,900,700';
    $defaults['post_format_color']    = '#ffffff';

//font options additional value
    global $covernews_google_fonts;
    $covernews_google_fonts = array(
        'ABeeZee:400,400italic'                     => 'ABeeZee',
        'Abel'                                      => 'Abel',
        'Abril+Fatface'                             => 'Abril Fatface',
        'Aldrich'                                   => 'Aldrich',
        'Alegreya:400,400italic,700,900'            => 'Alegreya',
        'Alex+Brush'                                => 'Alex Brush',
        'Alfa+Slab+One'                             => 'Alfa Slab One',
        'Amaranth:400,400italic,700'                => 'Amaranth',
        'Andada'                                    => 'Andada',
        'Anton'                                     => 'Anton',
        'Archivo+Black'                             => 'Archivo Black',
        'Archivo+Narrow:400,400italic,700'          => 'Archivo Narrow',
        'Arimo:400,400italic,700'                   => 'Arimo',
        'Arvo:400,400italic,700'                    => 'Arvo',
        'Asap:400,400italic,700'                    => 'Asap',
        'Bangers'                                   => 'Bangers',
        'BenchNine:400,700'                         => 'BenchNine',
        'Bevan'                                     => 'Bevan',
        'Bitter:400,400italic,700'                  => 'Bitter',
        'Bree+Serif'                                => 'Bree Serif',
        'Cabin:400,400italic,500,600,700'           => 'Cabin',
        'Cabin+Condensed:400,500,600,700'           => 'Cabin Condensed',
        'Cantarell:400,400italic,700'               => 'Cantarell',
        'Carme'                                     => 'Carme',
        'Cherry+Cream+Soda'                         => 'Cherry Cream Soda',
        'Cinzel:400,700,900'                        => 'Cinzel',
        'Comfortaa:400,300,700'                     => 'Comfortaa',
        'Cookie'                                    => 'Cookie',
        'Covered+By+Your+Grace'                     => 'Covered By Your Grace',
        'Crete+Round:400,400italic'                 => 'Crete Round',
        'Crimson+Text:400,400italic,600,700'        => 'Crimson Text',
        'Cuprum:400,400italic'                      => 'Cuprum',
        'Dancing+Script:400,700'                    => 'Dancing Script',
        'Didact+Gothic'                             => 'Didact Gothic',
        'Droid+Sans:400,700'                        => 'Droid Sans',
        'Dosis:400,300,600,800'                     => 'Dosis',
        'Droid+Serif:400,400italic,700'             => 'Droid Serif',
        'Economica:400,700,400italic'               => 'Economica',
        'Expletus+Sans:400,400i,700,700i'           => 'Expletus Sans',
        'EB+Garamond'                               => 'EB Garamond',
        'Exo:400,300,400italic,600,800'             => 'Exo',
        'Exo+2:400,300,400italic,600,700,900'       => 'Exo 2',
        'Fira+Sans:400,500'                         => 'Fira Sans',
        'Fjalla+One'                                => 'Fjalla One',
        'Francois+One'                              => 'Francois One',
        'Fredericka+the+Great'                      => 'Fredericka the Great',
        'Fredoka+One'                               => 'Fredoka One',
        'Fugaz+One'                                 => 'Fugaz One',
        'Great+Vibes'                               => 'Great Vibes',
        'Handlee'                                   => 'Handlee',
        'Hammersmith+One'                           => 'Hammersmith One',
        'Hind:400,300,600,700'                      => 'Hind',
        'Inconsolata:400,700'                       => 'Inconsolata',
        'Indie+Flower'                              => 'Indie Flower',
        'Istok+Web:400,400italic,700'               => 'Istok Web',
        'Josefin+Sans:400,600,700,400italic'        => 'Josefin Sans',
        'Josefin+Slab:400,400italic,700,600'        => 'Josefin Slab',
        'Jura:400,300,500,600'                      => 'Jura',
        'Karla:400,400italic,700'                   => 'Karla',
        'Kaushan+Script'                            => 'Kaushan Script',
        'Kreon:400,300,700'                         => 'Kreon',
        'Lateef'                                    => 'Lateef',
        'Lato:400,300,400italic,900,700'            => 'Lato',
        'Libre+Baskerville:400,400italic,700'       => 'Libre Baskerville',
        'Limelight'                                 => 'Limelight',
        'Lobster'                                   => 'Lobster',
        'Lobster+Two:400,700,700italic'             => 'Lobster Two',
        'Lora:400,400italic,700,700italic'          => 'Lora',
        'Maven+Pro:400,500,700,900'                 => 'Maven Pro',
        'Merriweather:400,400italic,300,900,700'    => 'Merriweather',
        'Merriweather+Sans:400,400italic,700,800'   => 'Merriweather Sans',
        'Monda:400,700'                             => 'Monda',
        'Montserrat:400,700'                        => 'Montserrat',
        'Muli:400,300italic,300'                    => 'Muli',
        'News+Cycle:400,700'                        => 'News Cycle',
        'Noticia+Text:400,400italic,700'            => 'Noticia Text',
        'Noto+Sans:400,400italic,700'               => 'Noto Sans',
        'Noto+Serif:400,400italic,700'              => 'Noto Serif',
        'Nunito:400,300,700'                        => 'Nunito',
        'Old+Standard+TT:400,400italic,700'         => 'Old Standard TT',
        'Open+Sans:400,400italic,600,700'           => 'Open Sans',
        'Open+Sans+Condensed:300,300italic,700'     => 'Open Sans Condensed',
        'Oswald:300,400,700'                        => 'Oswald',
        'Oxygen:400,300,700'                        => 'Oxygen',
        'Pacifico'                                  => 'Pacifico',
        'Passion+One:400,700,900'                   => 'Passion One',
        'Pathway+Gothic+One'                        => 'Pathway Gothic One',
        'Patua+One'                                 => 'Patua One',
        'Poiret+One'                                => 'Poiret One',
        'Pontano+Sans'                              => 'Pontano Sans',
        'Poppins:300,400,500,600,700'               => 'Poppins',
        'Play:400,700'                              => 'Play',
        'Playball'                                  => 'Playball',
        'Playfair+Display:400,400italic,700,900'    => 'Playfair Display',
        'PT+Sans:400,400italic,700'                 => 'PT Sans',
        'PT+Sans+Caption:400,700'                   => 'PT Sans Caption',
        'PT+Sans+Narrow:400,700'                    => 'PT Sans Narrow',
        'PT+Serif:400,400italic,700'                => 'PT Serif',
        'Quattrocento+Sans:400,700,400italic'       => 'Quattrocento Sans',
        'Questrial'                                 => 'Questrial',
        'Quicksand:400,700'                         => 'Quicksand',
        'Raleway:400,300,500,600,700,900'           => 'Raleway',
        'Righteous'                                 => 'Righteous',
        'Roboto:100,300,400,500,700'                => 'Roboto',
        'Roboto+Condensed:400,300,400italic,700'    => 'Roboto Condensed',
        'Roboto+Slab:400,300,700'                   => 'Roboto Slab',
        'Rokkitt:400,700'                           => 'Rokkitt',
        'Ropa+Sans:400,400italic'                   => 'Ropa Sans',
        'Russo+One'                                 => 'Russo One',
        'Sanchez:400,400italic'                     => 'Sanchez',
        'Satisfy'                                   => 'Satisfy',
        'Shadows+Into+Light'                        => 'Shadows Into Light',
        'Sigmar+One'                                => 'Sigmar One',
        'Signika:400,300,700'                       => 'Signika',
        'Six+Caps'                                  => 'Six Caps',
        'Slabo+27px'                                => 'Slabo 27px',
        'Source+Sans+Pro:400,400i,700,700i' => 'Source Sans Pro',
        'Source+Serif+Pro:400,700'                  => 'Source Serif Pro',
        'Squada+One'                                => 'Squada One',
        'Tangerine:400,700'                         => 'Tangerine',
        'Tinos:400,400italic,700'                   => 'Tinos',
        'Titillium+Web:400,300,400italic,700,900'   => 'Titillium Web',
        'Ubuntu:400,400italic,500,700'              => 'Ubuntu',
        'Ubuntu+Condensed'                          => 'Ubuntu Condensed',
        'Varela+Round'                              => 'Varela Round',
        'Vollkorn:400,400italic,700'                => 'Vollkorn',
        'Voltaire'                                  => 'Voltaire',
        'Yanone+Kaffeesatz:400,300,700'             => 'Yanone Kaffeesatz',
    );

    //font option

    $defaults['primary_font']      = 'Source+Sans+Pro:400,400i,700,700i';
    $defaults['secondary_font']    = 'Montserrat:400,700';
    $defaults['post_format_color']    = '#ffffff';


    $defaults['category_color_1']    = '#bb1919';
    $defaults['category_color_2']    = '#2a4051';
    $defaults['category_color_3']    = '#d60000';
    $defaults['category_color_4']    = '#e91e63';
    $defaults['category_color_5']    = '#f99500';
    $defaults['category_color_6']    = '#61c436';
    $defaults['category_color_7']    = '#a66bbe';
    $defaults['category_color_8']    = '#ffffff';


    //font size
    $defaults['site_title_font_size']    = 48;
    $defaults['letter_spacing']    = 0;
    $defaults['line_height']    = 1.3;
    $defaults['main_banner_silder_caption_font_size']    = 35;
    $defaults['covernews_page_posts_title_font_size']    = 50;
    $defaults['covernews_section_title_font_size']    = 20;
    $defaults['content_widget_article_title_font_size']    = 18;

    // Pass through filter.
    $defaults = apply_filters('covernews_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
