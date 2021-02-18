<?php
/**
* Sanitize callback functions
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && ( true == $input ) ) ? true : false );
}

function elegantwp_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function elegantwp_sanitize_thumbnail_link( $input, $setting ) {
    $valid = array('yes','no');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_post_style( $input, $setting ) {
    $valid = array('style-1','style-2','style-3','style-4','style-5','style-6','style-8','style-9','style-12','style-13');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_email( $input, $setting ) {
    if ( '' != $input && is_email( $input ) ) {
        $input = sanitize_email( $input );
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_related_posts_number( $input, $setting ) {
    $valid = array(4, 8, 12, 16);
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_fonts( $input, $setting ) {
    global $elegantwp_font_families;
 
    if ( array_key_exists( $input, $elegantwp_font_families ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_font_sizes( $input, $setting ) {
    global $elegantwp_font_sizes;
 
    if ( array_key_exists( $input, $elegantwp_font_sizes ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_font_weights( $input, $setting ) {
    global $elegantwp_font_weights;
 
    if ( array_key_exists( $input, $elegantwp_font_weights ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_font_styles( $input, $setting ) {
    global $elegantwp_font_styles;
 
    if ( array_key_exists( $input, $elegantwp_font_styles ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_line_height( $input, $setting ) {
    $input = (float) $input;
    return ( 0 < $input ) ? $input : $setting->default;
}

function elegantwp_sanitize_font_subsets( $input, $setting ) {
    global $elegantwp_font_subsets;

    foreach ($input as $value) {
        if ( !array_key_exists( $value, $elegantwp_font_subsets ) ) {
            return $setting->default;
        }
    }
    return $input;
}

function elegantwp_sanitize_layout( $input, $setting ) {
    $valid = array(
            's1-c-s2' => esc_html__( 'Sidebar 1 + Content + Sidebar 2', 'elegantwp-pro' ),
            's2-c-s1' => esc_html__( 'Sidebar 2 + Content + Sidebar 1', 'elegantwp-pro' ),
            'c-s1-s2' => esc_html__( 'Content + Sidebar 1 + Sidebar 2', 'elegantwp-pro' ),
            'c-s2-s1' => esc_html__( 'Content + Sidebar 2 + Sidebar 1', 'elegantwp-pro' ),
            's1-s2-c' => esc_html__( 'Sidebar 1 + Sidebar 2 + Content', 'elegantwp-pro' ),
            's2-s1-c' => esc_html__( 'Sidebar 2 + Sidebar 1 + Content', 'elegantwp-pro' ),
            's1-c' => esc_html__( 'Sidebar 1 + Content', 'elegantwp-pro' ),
            'c-s1' => esc_html__( 'Content + Sidebar 1', 'elegantwp-pro' ),
            'c-s2' => esc_html__( 'Content + Sidebar 2', 'elegantwp-pro' ),
            's2-c' => esc_html__( 'Sidebar 2 + Content', 'elegantwp-pro' ),
            'one-column' => esc_html__( 'One Column', 'elegantwp-pro' )
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function elegantwp_sanitize_read_more_length( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function elegantwp_sanitize_positive_integer( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function elegantwp_sanitize_news_ticker_type( $input, $setting ) {
    $valid = array('recent-posts','popular-posts','random-posts','category-posts','tag-posts');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}