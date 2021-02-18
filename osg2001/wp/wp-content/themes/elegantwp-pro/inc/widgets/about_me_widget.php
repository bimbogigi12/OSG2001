<?php
/**
* About me widget
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class elegantwp_about_widget extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array( 'classname' => 'elegantwp-aboutme-widget', 'description' => esc_html__( 'This widget can use to add an image and description about you.', 'elegantwp-pro' ) );
    $control_ops = array( 'id_base' => 'elegantwp-aboutme-widget-id' );
    parent::__construct( 'elegantwp-aboutme-widget-id', esc_html__( 'ElegantWP About Widget', 'elegantwp-pro' ), $widget_ops, $control_ops );
  }

  function form($instance)
  {
    $defaults = array( 'title' => esc_html__( 'About Me', 'elegantwp-pro' ), 'image' => '', 'description' => '', 'round_buttons' => false, 'facebook' => '', 'twitter' => '',  'googleplus' => '', 'pinterest' => '', 'linkedin' => '', 'instagram' => '', 'flickr' => '', 'youtube' => '', 'vimeo' => '', 'soundcloud' => '', 'lastfm' => '', 'github' => '', 'bitbucket' => '', 'tumblr' => '', 'digg' => '', 'delicious' => '', 'stumbleupon' => '', 'reddit' => '', 'dribbble' => '', 'behance' => '', 'vk' => '', 'codepen' => '', 'jsfiddle' => '', 'stackoverflow' => '', 'stackexchange' => '', 'buysellads' => '', 'slideshare' => '', 'skype' => '', 'envelope' => '', 'rss' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'elegantwp-pro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Profile Image URL', 'elegantwp-pro' ); ?>:</label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['image'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'elegantwp-pro' ); ?></label>
            <textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'round_buttons' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'round_buttons' ) ); ?>" type="checkbox" <?php checked( $instance['round_buttons'] ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'round_buttons' ) ); ?>"><?php esc_html_e( 'Display round social buttons?','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e('Facebook URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e('Twitter URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_html_e('Google Plus URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['googleplus'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e('Pinterest URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e('Linkedin URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e('Instagram URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php esc_html_e('Flickr URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['flickr'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e('Youtube URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e('Vimeo URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>"><?php esc_html_e('SoundCloud URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['soundcloud'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'lastfm' ) ); ?>"><?php esc_html_e('Lastfm URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lastfm' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lastfm' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['lastfm'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>"><?php esc_html_e('Github URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['github'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bitbucket' ) ); ?>"><?php esc_html_e('Bitbucket URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bitbucket' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bitbucket' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['bitbucket'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e('Tumblr URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>"><?php esc_html_e('Digg URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digg' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['digg'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'delicious' ) ); ?>"><?php esc_html_e('Delicious URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'delicious' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'delicious' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['delicious'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>"><?php esc_html_e('Stumbleupon URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stumbleupon' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['stumbleupon'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>"><?php esc_html_e('Reddit URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['reddit'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e('Dribbble URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['dribbble'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_html_e('Behance URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['behance'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php esc_html_e('VK URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vk'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'codepen' ) ); ?>"><?php esc_html_e('Codepen URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'codepen' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'codepen' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['codepen'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'jsfiddle' ) ); ?>"><?php esc_html_e('JSFiddle URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'jsfiddle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'jsfiddle' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['jsfiddle'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'stackoverflow' ) ); ?>"><?php esc_html_e('Stack Overflow URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stackoverflow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stackoverflow' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['stackoverflow'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'stackexchange' ) ); ?>"><?php esc_html_e('Stack Exchange URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stackexchange' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stackexchange' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['stackexchange'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'buysellads' ) ); ?>"><?php esc_html_e('BuySellAds URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'buysellads' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'buysellads' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['buysellads'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'slideshare' ) ); ?>"><?php esc_html_e('SlideShare URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'slideshare' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slideshare' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['slideshare'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>"><?php esc_html_e('Skype Username:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skype' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['skype'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'envelope' ) ); ?>"><?php esc_html_e('Email Address:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'envelope' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'envelope' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['envelope'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e('RSS Feed URL:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['rss'] ); ?>" />
        </p>
<?php
  }

  function update($new_instance,$old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['image'] = esc_url_raw( $new_instance['image'] );
    $instance['description'] = wp_kses_post( force_balance_tags( $new_instance['description'] ) );
    $instance['round_buttons'] = isset( $new_instance['round_buttons'] ) ? (bool) $new_instance['round_buttons'] : false;
    $instance['facebook'] = esc_url_raw( $new_instance['facebook'] );
    $instance['twitter'] = esc_url_raw( $new_instance['twitter'] );
    $instance['googleplus'] = esc_url_raw( $new_instance['googleplus'] );
    $instance['pinterest'] = esc_url_raw( $new_instance['pinterest'] );
    $instance['linkedin'] = esc_url_raw( $new_instance['linkedin'] );
    $instance['instagram'] = esc_url_raw( $new_instance['instagram'] );
    $instance['flickr'] = esc_url_raw( $new_instance['flickr'] );
    $instance['youtube'] = esc_url_raw( $new_instance['youtube'] );
    $instance['vimeo'] = esc_url_raw( $new_instance['vimeo'] );
    $instance['soundcloud'] = esc_url_raw( $new_instance['soundcloud'] );
    $instance['lastfm'] = esc_url_raw( $new_instance['lastfm'] );
    $instance['github'] = esc_url_raw( $new_instance['github'] );
    $instance['bitbucket'] = esc_url_raw( $new_instance['bitbucket'] );
    $instance['tumblr'] = esc_url_raw( $new_instance['tumblr'] );
    $instance['digg'] = esc_url_raw( $new_instance['digg'] );
    $instance['delicious'] = esc_url_raw( $new_instance['delicious'] );
    $instance['stumbleupon'] = esc_url_raw( $new_instance['stumbleupon'] );
    $instance['reddit'] = esc_url_raw( $new_instance['reddit'] );
    $instance['dribbble'] = esc_url_raw( $new_instance['dribbble'] );
    $instance['behance'] = esc_url_raw( $new_instance['behance'] );
    $instance['vk'] = esc_url_raw( $new_instance['vk'] );
    $instance['codepen'] = esc_url_raw( $new_instance['codepen'] );
    $instance['jsfiddle'] = esc_url_raw( $new_instance['jsfiddle'] );
    $instance['stackoverflow'] = esc_url_raw( $new_instance['stackoverflow'] );
    $instance['stackexchange'] = esc_url_raw( $new_instance['stackexchange'] );
    $instance['buysellads'] = esc_url_raw( $new_instance['buysellads'] );
    $instance['slideshare'] = esc_url_raw( $new_instance['slideshare'] );
    $instance['skype'] = sanitize_text_field( $new_instance['skype'] );
    $instance['envelope'] = sanitize_email( $new_instance['envelope'] );
    $instance['rss'] = esc_url_raw( $new_instance['rss'] );
    return $instance;
  }

  function widget($args,$instance)
  {

    extract($args, EXTR_SKIP);

    $title = ( ! empty( $instance['title'] ) ) ? apply_filters('widget_title',$instance['title'],$this->id_base) : '';
    $image = ( ! empty( $instance['image'] ) ) ? $instance['image'] : '';
    $description = ( ! empty( $instance['description'] ) ) ? $instance['description'] : '';
    $round_buttons = isset( $instance['round_buttons'] ) ? (bool) $instance['round_buttons'] : false;
    $facebook = ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '';
    $twitter = ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '';
    $googleplus = ( ! empty( $instance['googleplus'] ) ) ? $instance['googleplus'] : '';
    $pinterest = ( ! empty( $instance['pinterest'] ) ) ? $instance['pinterest'] : '';
    $linkedin = ( ! empty( $instance['linkedin'] ) ) ? $instance['linkedin'] : '';
    $instagram = ( ! empty( $instance['instagram'] ) ) ? $instance['instagram'] : '';
    $flickr = ( ! empty( $instance['flickr'] ) ) ? $instance['flickr'] : '';
    $youtube = ( ! empty( $instance['youtube'] ) ) ? $instance['youtube'] : '';
    $vimeo = ( ! empty( $instance['vimeo'] ) ) ? $instance['vimeo'] : '';
    $soundcloud = ( ! empty( $instance['soundcloud'] ) ) ? $instance['soundcloud'] : '';
    $lastfm = ( ! empty( $instance['lastfm'] ) ) ? $instance['lastfm'] : '';
    $github = ( ! empty( $instance['github'] ) ) ? $instance['github'] : '';
    $bitbucket = ( ! empty( $instance['bitbucket'] ) ) ? $instance['bitbucket'] : '';
    $tumblr = ( ! empty( $instance['tumblr'] ) ) ? $instance['tumblr'] : '';
    $digg = ( ! empty( $instance['digg'] ) ) ? $instance['digg'] : '';
    $delicious = ( ! empty( $instance['delicious'] ) ) ? $instance['delicious'] : '';
    $stumbleupon = ( ! empty( $instance['stumbleupon'] ) ) ? $instance['stumbleupon'] : '';
    $reddit = ( ! empty( $instance['reddit'] ) ) ? $instance['reddit'] : '';
    $dribbble = ( ! empty( $instance['dribbble'] ) ) ? $instance['dribbble'] : '';
    $behance = ( ! empty( $instance['behance'] ) ) ? $instance['behance'] : '';
    $vk = ( ! empty( $instance['vk'] ) ) ? $instance['vk'] : '';
    $codepen = ( ! empty( $instance['codepen'] ) ) ? $instance['codepen'] : '';
    $jsfiddle = ( ! empty( $instance['jsfiddle'] ) ) ? $instance['jsfiddle'] : '';
    $stackoverflow = ( ! empty( $instance['stackoverflow'] ) ) ? $instance['stackoverflow'] : '';
    $stackexchange = ( ! empty( $instance['stackexchange'] ) ) ? $instance['stackexchange'] : '';
    $buysellads = ( ! empty( $instance['buysellads'] ) ) ? $instance['buysellads'] : '';
    $slideshare = ( ! empty( $instance['slideshare'] ) ) ? $instance['slideshare'] : '';
    $skype = ( ! empty( $instance['skype'] ) ) ? $instance['skype'] : '';
    $envelope = ( ! empty( $instance['envelope'] ) ) ? $instance['envelope'] : '';
    $rss = ( ! empty( $instance['rss'] ) ) ? $instance['rss'] : '';

    if($round_buttons) {
        $button_class = 'elegantwp-about-social-round-icons';
    } else {
        $button_class = 'elegantwp-about-social-normal-icons';
    }

    echo $before_widget;

    if(!empty($title)) { echo $before_title.$title.$after_title; }
    ?>
    <div class="elegantwp-about-widget clearfix">
    <?php if ( $image ) : ?>
    <div class="elegantwp-about-widget-image">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
    </div>
    <?php endif; ?>

    <?php if ( $description ) : ?>
    <div class="elegantwp-about-widget-description">
        <?php echo wp_kses_post( force_balance_tags( $description ) ); ?>
    </div>
    <?php endif; ?>
    <div class="elegantwp-about-widget-social <?php echo esc_attr($button_class); ?>">
    <ul>
    <?php if ( $facebook ) : ?>
        <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-facebook"><i class="fa fa-facebook" title="<?php esc_attr_e('Facebook','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $twitter ) : ?>
        <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-twitter"><i class="fa fa-twitter" title="<?php esc_attr_e('Twitter','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $googleplus ) : ?>
        <li><a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-google-plus"><i class="fa fa-google-plus" title="<?php esc_attr_e('Google Plus','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $pinterest ) : ?>
        <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-pinterest"><i class="fa fa-pinterest" title="<?php esc_attr_e('Pinterest','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $linkedin ) : ?>
        <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-linkedin"><i class="fa fa-linkedin" title="<?php esc_attr_e('Linkedin','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $instagram ) : ?>
        <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-instagram"><i class="fa fa-instagram" title="<?php esc_attr_e('Instagram','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $flickr ) : ?>
        <li><a href="<?php echo esc_url( $flickr ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-flickr"><i class="fa fa-flickr" title="<?php esc_attr_e('Flickr','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $youtube ) : ?>
        <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-youtube"><i class="fa fa-youtube" title="<?php esc_attr_e('Youtube','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $vimeo ) : ?>
        <li><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-vimeo"><i class="fa fa-vimeo" title="<?php esc_attr_e('Vimeo','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $soundcloud ) : ?>
        <li><a href="<?php echo esc_url( $soundcloud ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-soundcloud"><i class="fa fa-soundcloud" title="<?php esc_attr_e('SoundCloud','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $lastfm ) : ?>
        <li><a href="<?php echo esc_url( $lastfm ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-lastfm"><i class="fa fa-lastfm" title="<?php esc_attr_e('Lastfm','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $github ) : ?>
        <li><a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-github"><i class="fa fa-github" title="<?php esc_attr_e('Github','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $bitbucket ) : ?>
        <li><a href="<?php echo esc_url( $bitbucket ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-bitbucket"><i class="fa fa-bitbucket" title="<?php esc_attr_e('Bitbucket','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $tumblr ) : ?>
        <li><a href="<?php echo esc_url( $tumblr ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-tumblr"><i class="fa fa-tumblr" title="<?php esc_attr_e('Tumblr','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $digg ) : ?>
        <li><a href="<?php echo esc_url( $digg ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-digg"><i class="fa fa-digg" title="<?php esc_attr_e('Digg','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $delicious ) : ?>
        <li><a href="<?php echo esc_url( $delicious ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-delicious"><i class="fa fa-delicious" title="<?php esc_attr_e('Delicious','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $stumbleupon ) : ?>
        <li><a href="<?php echo esc_url( $stumbleupon ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-stumbleupon"><i class="fa fa-stumbleupon" title="<?php esc_attr_e('Stumbleupon','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $reddit ) : ?>
        <li><a href="<?php echo esc_url( $reddit ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-reddit"><i class="fa fa-reddit" title="<?php esc_attr_e('Reddit','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $dribbble ) : ?>
        <li><a href="<?php echo esc_url( $dribbble ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-dribbble"><i class="fa fa-dribbble" title="<?php esc_attr_e('Dribbble','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $behance ) : ?>
        <li><a href="<?php echo esc_url( $behance ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-behance"><i class="fa fa-behance" title="<?php esc_attr_e('Behance','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $vk ) : ?>
        <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-vk"><i class="fa fa-vk" title="<?php esc_attr_e('VK','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $codepen ) : ?>
        <li><a href="<?php echo esc_url( $codepen ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-codepen"><i class="fa fa-codepen" title="<?php esc_attr_e('Codepen','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $jsfiddle ) : ?>
        <li><a href="<?php echo esc_url( $jsfiddle ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-jsfiddle"><i class="fa fa-jsfiddle" title="<?php esc_attr_e('JSFiddle','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $stackoverflow ) : ?>
        <li><a href="<?php echo esc_url( $stackoverflow ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-stack-overflow"><i class="fa fa-stack-overflow" title="<?php esc_attr_e('Stack Overflow','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $stackexchange ) : ?>
        <li><a href="<?php echo esc_url( $stackexchange ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-stack-exchange"><i class="fa fa-stack-exchange" title="<?php esc_attr_e('Stack Exchange','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $buysellads ) : ?>
        <li><a href="<?php echo esc_url( $buysellads ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-buysellads"><i class="fa fa-buysellads" title="<?php esc_attr_e('BuySellAds','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $slideshare ) : ?>
        <li><a href="<?php echo esc_url( $slideshare ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-slideshare"><i class="fa fa-slideshare" title="<?php esc_attr_e('SlideShare','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $skype ) : ?>
        <li><a href="skype:<?php echo esc_attr( $skype ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-skype"><i class="fa fa-skype" title="<?php esc_attr_e('Skype','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $envelope ) : ?>
        <li><a href="mailto:<?php echo esc_attr( $envelope ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-envelope"><i class="fa fa-envelope" title="<?php esc_attr_e('Email Us','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    <?php if ( $rss ) : ?>
        <li><a href="<?php echo esc_url( $rss ); ?>" target="_blank" rel="nofollow" class="elegantwp-about-social-rss"><i class="fa fa-rss" title="<?php esc_attr_e('RSS','elegantwp-pro'); ?>"></i></a></li>
    <?php endif; ?>
    </ul>
    </div>
    </div>
    <?php
    echo $after_widget;
  }

}

function elegantwp_about_widget_function() {
    register_widget( 'elegantwp_about_widget' );
}
add_action( 'widgets_init', 'elegantwp_about_widget_function' );