<?php

/**
 * Front page section additions.
 */


if (!function_exists('covernews_full_width_upper_footer_section')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function covernews_full_width_upper_footer_section()
    {

        if (1 == covernews_get_option('frontpage_show_latest_posts')) {
            covernews_get_block('latest');
        }


        $mailchimp_scope = covernews_get_option('footer_mailchimp_subscriptions_scopes');
        if ($mailchimp_scope == 'front-page') {
            if (is_front_page() || is_home()) {
                if (1 == covernews_get_option('footer_show_mailchimp_subscriptions')) {
                    covernews_get_block('mailchimp');
                }
            }
        } else {
            if (1 == covernews_get_option('footer_show_mailchimp_subscriptions')) {
                covernews_get_block('mailchimp');
            }
        }


        $instagram_scope = covernews_get_option('footer_instagram_post_carousel_scopes');
        if ($instagram_scope == 'front-page') {
            if (is_front_page() || is_home()) {
                if (1 == covernews_get_option('footer_show_instagram_post_carousel')) {
                    covernews_get_block('instagram');
                }
            }
        } else {
            if (1 == covernews_get_option('footer_show_instagram_post_carousel')) {
                covernews_get_block('instagram');
            }
        }




    }
endif;
add_action('covernews_action_full_width_upper_footer_section', 'covernews_full_width_upper_footer_section');
