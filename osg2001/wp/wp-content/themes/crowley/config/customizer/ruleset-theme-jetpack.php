<?php
/**
 * Customizer theme-jetpack ruleset.
 *
 * @package WordPress
 * @since 1.0.0
 * @version 1.0.0
 */

$evolvethemes_ruleset = json_decode( '{"typography_text":{"group":"typography","selectors":{".widget_jetpack_display_posts_widget .jetpack-display-remote-posts h4":{"_type":"desktop","_font-family":"secondary","font-family":"IBM Plex Sans, sans-serif","font-size":"16px","line-height":"1.5","letter-spacing":"0","variant":"regular","text-transform":"none"}}},"typography_text_small":{"group":"typography","selectors":{".widget_jetpack_display_posts_widget .jetpack-display-remote-posts h4":{"_type":"desktop","_font-family":"secondary","font-size":"14px","_line-height":"1.5","_letter-spacing":"0","_variant":"regular","_text-transform":"none"}}},"typography_text_smaller":{"group":"typography","selectors":{".widget_upcoming_events_widget .upcoming-events li .event-when":{"_type":"desktop","_font-family":"secondary","font-size":"12px","_line-height":"1.5","_letter-spacing":"0","_variant":"regular","_text-transform":"none"}}},"typography_small_headings":{"group":"typography","selectors":{".widget.widget-grofile h4":{"_type":"desktop","_font-family":"secondary","font-family":"IBM Plex Sans, sans-serif","font-size":"12px","line-height":"1.25em","letter-spacing":"0.2em","variant":"600","text-transform":"uppercase"}}},"colors_details":{"group":"colors","selectors":{".widget_goodreads div[class^=\"gr_custom_container\"]":{"_type":"desktop","border-color":"rgba(0, 0, 0, 0.1)"},".widget_goodreads div[class^=\"gr_custom_each_container\"]":{"_type":"desktop","border-color":"rgba(0, 0, 0, 0.1)"}}}}', true );
return $evolvethemes_ruleset;
