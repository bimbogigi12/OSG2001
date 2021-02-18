<?php
/**
* Author bio box
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

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
                <h4>'.esc_html__( 'Author: ', 'elegantwp' ).'<span>'. get_the_author_link() .'</span></h4>'. get_the_author_meta('description',get_query_var('author') ) .'
            </div>
            </div>
            </div>
        ';
    }
    return $content;
}