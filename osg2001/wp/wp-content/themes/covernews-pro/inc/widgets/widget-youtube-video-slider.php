<?php
/**
 * Adds CoverNews_Youtube_Video_Slider widget.
 */
class CoverNews_Youtube_Video_Slider extends AFthemes_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
        $this->text_fields = array('covernews-youtube-video-slider-title');

         $this->url_fields = array('covernews-youtube-video-url-1', 'covernews-youtube-video-url-2', 'covernews-youtube-video-url-3', 'covernews-youtube-video-url-4', 'covernews-youtube-video-url-5', 'covernews-youtube-video-url-6', 'covernews-youtube-video-url-7', 'covernews-youtube-video-url-8', 'covernews-youtube-video-url-9', 'covernews-youtube-video-url-10');


        $widget_ops = array(
            'classname' => 'covernews_youtube_video_slider_widget',
            'description' => __('Displays youtube video slider.', 'covernews'),
            'customize_selective_refresh' => true,
        );

        parent::__construct('covernews_youtube_video_slider', __('CoverNews YouTube Video Slider', 'covernews'), $widget_ops);
    }

    /**
     * Outputs the content for the current widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args Display arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $instance = parent::covernews_sanitize_data($instance, $instance);
        $title = apply_filters('widget_title', $instance['covernews-youtube-video-slider-title'], $instance, $this->id_base);

        echo $args['before_widget'];

        ?>
        <?php if (!empty($title)): ?>
        <div class="em-title-subtitle-wrap">
            <?php if (!empty($title)): ?>
                <h4 class="widget-title header-after1">
                    <span class="header-after"><?php echo esc_html($title); ?></span>
                </h4>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if(!empty($instance['covernews-youtube-video-url-1'])): ?>

            <div class="slider-pro video-slider">
                <div class="sp-slides">
                    <?php for ($i=1; $i <= 7 ; $i++) { ?>
                        <div class="sp-slide">
                            <?php $mp_video_url = $instance['covernews-youtube-video-url-'.$i]; ?>
                            <?php if (!empty($mp_video_url)) { ?>
                                <?php
                                $url = $mp_video_url;
                                parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );

                                ?>
                                <a class="sp-video" href="<?php echo esc_url($mp_video_url); ?>">
                                    <img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']; ?>/maxresdefault.jpg">
                                </a>

                            <?php } else {
                                //_e('Video URL not found','covernews' );
                            } ?>
                        </div>
                    <?php  } ?>
                </div>
                <div class="af-sp-arrows"></div>
                <div class="sp-thumbnails">
                    <?php for ($j=1; $j <= 10 ; $j++) { ?>
                        <?php $mp_video_urls = $instance['covernews-youtube-video-url-'.$j] ?>
                        <?php if (!empty($mp_video_urls)) { ?>
                            <?php
                            $url = $mp_video_urls;
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $video_array );
                            ?>
                            <div class="sp-thumbnail">
                                <div class="sp-thumbnail-image-container">
                                    <img src="https://img.youtube.com/vi/<?php echo $video_array['v']; ?>/mqdefault.jpg">
                                </div>
                            </div>
                        <?php } else {
                            //_e('Video URL not found','covernews' );
                        } ?>
                    <?php  } ?>
                </div>
            </div>
    <?php endif; ?>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @since 1.0.0
     *
     * @param array $instance Previously saved values from database.
     *
     *
     */
    public function form($instance)
    {
        $this->form_instance = $instance;
        // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
        echo parent::covernews_generate_text_input('covernews-youtube-video-slider-title', 'Title', 'YouTube Video Slider');

        ?><h4><?php _e('YouTube links:', 'covernews'); ?></h4>
        <?php
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-1', 'Video 1','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-2', 'Video 2','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-3', 'Video 3','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-4', 'Video 4','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-5', 'Video 5','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-6', 'Video 6','');
        echo parent::covernews_generate_text_input('covernews-youtube-video-url-7', 'Video 7','');


    }

}