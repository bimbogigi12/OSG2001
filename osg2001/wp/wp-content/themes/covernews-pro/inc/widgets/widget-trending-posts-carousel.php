<?php
if (!class_exists('CoverNews_Trending_Posts_Carousel')) :
    /**
     * Adds CoverNews_Trending_Posts_Carousel widget.
     */
    class CoverNews_Trending_Posts_Carousel extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('covernews-posts-slider-title', 'covernews-posts-slider-subtitle', 'covernews-posts-slider-number');
            $this->select_fields = array('covernews-select-category');

            $widget_ops = array(
                'classname' => 'covernews_trending_posts_carousel_widget grid-layout',
                'description' => __('Displays posts carousel from selected category.', 'covernews'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('covernews_trending_posts_carousel', __('CoverNews Trending Posts Carousel', 'covernews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::covernews_sanitize_data($instance, $instance);
            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['covernews-posts-slider-title'], $instance, $this->id_base);

            $number_of_posts = isset($instance['covernews-posts-slider-number']) ? $instance['covernews-posts-slider-number'] : 7;
            $category = isset($instance['covernews-select-category']) ? $instance['covernews-select-category'] : '0';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title)): ?>
            <div class="em-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title);  ?>
                            </span>
                    </h4>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            <?php
            $covernews_nav_control_class = empty($title) ? 'no-section-title' : '';
            $all_posts = covernews_get_posts($number_of_posts, $category);
            $count = 1;
            ?>
            <div class="banner-trending-posts-wrapper clearfix">
                <div class="trending-posts-vertical-carousel">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }

                            global $post;
                            ?>
                            <div class="slick-item">
                                <!-- <span style="margin: 0 0 10px 0; display: block;"> -->
                                <figure class="carousel-image">
                                    <div class="no-gutter-col">
                                        <figure class="featured-article">
                                            <div class="featured-article-wrapper">
                                                <div class="data-bg data-bg-hover data-bg-hover data-bg-featured" data-background="<?php echo esc_url($url); ?>">
                                                    <a href="<?php the_permalink(); ?>"></a>
                                                </div>
                                            </div>
                                            <span class="trending-no">
                                                <?php echo sprintf( __( '%s', 'covernews' ), $count); ?>
                                            </span>
                                            <?php //echo covernews_post_format($post->ID); ?>
                                        </figure>

                                        <figcaption>
                                            <div class="figure-categories figure-categories-bg">
                                                <?php covernews_post_categories(); ?>
                                            </div>
                                            <div class="title-heading">
                                                <h3 class="article-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </figcaption>
                                    </div>
                                    </figcaption>
                                </figure>
                                <!-- </span> -->
                            </div>
                            <?php
                            $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <?php
            //print_pre($all_posts);

            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $categories = covernews_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::covernews_generate_text_input('covernews-posts-slider-title', 'Title', 'Trending Posts Carousel');
                echo parent::covernews_generate_select_options('covernews-select-category', __('Select category', 'covernews'), $categories);
                echo parent::covernews_generate_text_input('covernews-posts-slider-number', __('Number of posts', 'covernews'), '7');


            }
        }
    }
endif;