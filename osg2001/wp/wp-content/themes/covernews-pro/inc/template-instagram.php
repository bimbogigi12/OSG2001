<?php
/**
 * Custom template images for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CoverNews
 */


if (!function_exists('covernews_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    // based on https://gist.github.com/cosmocatalano/4544576
    function covernews_scrape_instagram($username, $access_token, $slice = 9)
    {
        $username = strtolower($username);
        $username = str_replace('@', '', $username);

        if (false === ($instagram = get_transient('instagram-a3-' . sanitize_title_with_dashes($username)))) {

            $remote = wp_remote_get('https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token);

            if (is_wp_error($remote)) {
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'covernews'));
            }

            if (200 != wp_remote_retrieve_response_code($remote)) {
                return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'covernews'));
            }

            $response = wp_remote_retrieve_body($remote);
            if ($response === false) {
                return new WP_Error('invalid_body', esc_html__('Instagram did not return a 200.', 'covernews'));
            }

            $data = json_decode($response, true);
            if ($data === null) {
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'covernews'));
            }

            if (isset($data['data'])) {
                $images = $data['data'];
            } else {
                return new WP_Error('bad_json_2', esc_html__('Instagram has returned invalid data.', 'covernews'));
            }

            if (!is_array($images)) {
                return new WP_Error('bad_array', esc_html__('Instagram has returned invalid data.', 'covernews'));
            }

            $instagram = array();

            if (isset($images)) {

                foreach ($images as $node) {

                    $node['thumbnail_src'] = preg_replace('/^https?\:/i', '', $node['images']['thumbnail']['url']);
                    $node['low_resolution'] = preg_replace('/^https?\:/i', '', $node['images']['low_resolution']['url']);
                    $node['standard_resolution'] = preg_replace('/^https?\:/i', '', $node['images']['standard_resolution']['url']);

                    $caption = '';
                    if ( ! empty( $node['caption'] ) ) {
                        $caption = $node['caption'];
                    }

                    $instagram[] = array(
                        'thumbnail' => $node['thumbnail_src'],
                        'small' => $node['low_resolution'],
                        'original' => $node['standard_resolution'],
                        'comments'	  	=> $node['comments']['count'],
                        'likes'		 	=> $node['likes']['count'],
                        'description'   => $caption,
                    );
                }
            }

            // do not set an empty transient - should help catch private or empty accounts
            if (!empty($instagram)) {
                set_transient('instagram-a3-' . sanitize_title_with_dashes($username), $instagram, apply_filters('covernews_instagram_cache_time', HOUR_IN_SECONDS * 2));
            }
        }

        if (!empty($instagram)) {

            return array_slice($instagram, 0, $slice);
        } else {
            return new WP_Error('no_images', esc_html__('Instagram did not return any images.', 'covernews'));
        }
    }
endif;
