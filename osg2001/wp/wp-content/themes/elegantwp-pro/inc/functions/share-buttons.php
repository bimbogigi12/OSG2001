<?php
/**
* Post share buttons
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function elegantwp_social_sharing_buttons() {

        global $post;

        // Get current page URL 
        $elegantwp = urlencode(get_permalink());

        // Get current page title
        $elegantwptitle = urlencode(get_the_title());

        // Get Post Thumbnail for pinterest
        $elegantwpimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

        // Construct sharing URL without using any script
        $elegantwp_bufferURL = 'https://bufferapp.com/add?url='.$elegantwp.'&amp;text='.$elegantwptitle;
        $elegantwp_twitterURL = 'https://twitter.com/intent/tweet?text='.$elegantwptitle.'&amp;url='.$elegantwp.'&amp;via=ThemesDNA';
        $elegantwp_facebookURL = 'https://www.facebook.com/sharer.php?u='.$elegantwp;
        $elegantwp_googleURL = 'https://plus.google.com/share?url='.$elegantwp;
        $elegantwp_redditURL = 'http://www.reddit.com/submit?url='.$elegantwp.'&amp;title='.$elegantwptitle;
        $elegantwp_vkURL = 'https://vkontakte.ru/share.php?url='.$elegantwp;
        $elegantwp_diggURL = 'http://digg.com/submit?url='.$elegantwp.'&amp;title='.$elegantwptitle;
        $elegantwp_linkedinURL = 'http://www.linkedin.com/shareArticle?mini=true&amp;title='.$elegantwptitle.'&amp;url='.$elegantwp;
        $elegantwp_deliciousURL = 'http://del.icio.us/post?url='.$elegantwp.'&amp;title='.$elegantwptitle;

        // Based on popular demand added Pinterest too
        $elegantwp_pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$elegantwp.'&amp;media='.$elegantwpimg[0].'&amp;description='.$elegantwptitle;

        // Add sharing button at the end of page/page content
        $elegantwp_socialcontent = '<div class="elegantwp-share-buttons clearfix"><span class="elegantwp-share-text">'.esc_html__('Share: ', 'elegantwp-pro').'</span>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-twitter" href="'.esc_url($elegantwp_twitterURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Tweet This!', 'elegantwp-pro').'"><i class="fa fa-twitter"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-facebook" href="'.esc_url($elegantwp_facebookURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Facebook', 'elegantwp-pro').'"><i class="fa fa-facebook"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-gplus" href="'.esc_url($elegantwp_googleURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Google+', 'elegantwp-pro').'"><i class="fa fa-google-plus"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-pinterest" href="'.esc_url($elegantwp_pinterestURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Pinterest', 'elegantwp-pro').'"><i class="fa fa-pinterest"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-reddit" href="'.esc_url($elegantwp_redditURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Reddit', 'elegantwp-pro').'"><i class="fa fa-reddit"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-vk" href="'.esc_url($elegantwp_vkURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on VK', 'elegantwp-pro').'"><i class="fa fa-vk"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-digg" href="'.esc_url($elegantwp_diggURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Digg', 'elegantwp-pro').'"><i class="fa fa-digg"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-linkedin" href="'.esc_url($elegantwp_linkedinURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Linkedin', 'elegantwp-pro').'"><i class="fa fa-linkedin"></i></a>';
        $elegantwp_socialcontent .= '<a class="elegantwp-share-buttons-delicious" href="'.esc_url($elegantwp_deliciousURL).'" target="_blank" rel="nofollow" title="'.esc_html__('Share this on Delicious', 'elegantwp-pro').'"><i class="fa fa-delicious"></i></a>';
        $elegantwp_socialcontent .= '</div>';

        return $elegantwp_socialcontent;

}