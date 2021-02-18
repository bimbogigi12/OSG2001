<?php
if (!function_exists('covernews_front_page_main_section_3')) :
    /**
     * Banner Slider
     *
     * @since CoverNews 1.0.0
     *
     */
    function covernews_front_page_main_section_3()
    {
        $global_content_layout = covernews_get_option('global_content_layout');
        $covernews_enable_main_slider = covernews_get_option('show_main_news_section');
        $covernews_slider_title = covernews_get_option('main_news_slider_title');
        $covernews_nav_control_class = empty($covernews_slider_title) ? 'no-section-title' : '';
        $covernews_slider_category = covernews_get_option('select_slider_news_category');
        $covernews_number_of_slides = covernews_get_option('number_of_slides');

        $color_class = covernews_get_category_color_class($covernews_slider_category);

        ?>

        <section class="af-blocks">
            <?php if ($covernews_enable_main_slider): ?>
                <div class="container af-main-banner main-banner-3rd default-section-slider">
                    <div class="row">
                        <?php do_action('covernews_action_banner_exclusive_posts'); ?>

                        <div class="for-main-row">
                            <div class="main-story-wrapper col-sm-9">
                                <?php if ($covernews_slider_title): ?>
                                    <h4 class="header-after1">
                                    <span class="header-after <?php echo esc_attr($color_class); ?>">
                                        <?php echo esc_html($covernews_slider_title); ?>
                                    </span>
                                    </h4>
                                <?php endif; ?>
                                <div class="main-slider-wrapper">
                                <div class="main-slider full-slider-mode">
                                    <?php
                                    $slider_posts = covernews_get_posts($covernews_number_of_slides, $covernews_slider_category);
                                    if ($slider_posts->have_posts()) :
                                        while ($slider_posts->have_posts()) : $slider_posts->the_post();
                                            if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-slider-full');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                            }
                                            global $post;
                                            ?>
                                            <figure class="slick-item">
                                                <div class="data-bg data-bg-hover data-bg-hover data-bg-slide"
                                                     data-background="<?php echo esc_url($url); ?>">
                                                    <a class="aft-slide-items" href="<?php the_permalink(); ?>"></a>
                                                    <?php echo covernews_post_format($post->ID); ?>
                                                    <figcaption class="slider-figcaption slider-figcaption-1">
                                                        <div class="figure-categories figure-categories-bg">
                                                            <?php covernews_post_categories(); ?>
                                                        </div>
                                                        <div class="title-heading">
                                                            <h3 class="article-title slide-title">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                        </div>
                                                        <div class="grid-item-metadata grid-item-metadata-1">
                                                            <?php covernews_post_item_meta(); ?>
                                                        </div>
                                                    </figcaption>
                                                </div>
                                            </figure>
                                        <?php
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                                <div class="af-main-navcontrols <?php echo esc_attr($covernews_nav_control_class); ?>"></div>
                            </div>
                            </div>

                            <?php
                            $covernews_trending_slider_title = covernews_get_option('trending_slider_title');
                            $covernews_trending_slider_category = covernews_get_option('select_trending_news_category');
                            $color_class = covernews_get_category_color_class($covernews_trending_slider_category);
                            ?>
                            <div id="aft-trending-story-five" class="trending-story col-sm-3">
                                <?php if ($covernews_trending_slider_title): ?>
                                    <h4 class="header-after1">
                                    <span class="header-after <?php echo esc_attr($color_class); ?>">
                                        <?php echo esc_html($covernews_trending_slider_title); ?>
                                    </span>
                                    </h4>
                                <?php endif; ?>
                                <?php do_action('covernews_action_banner_trending_posts'); ?>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endif; ?>


            <div class="container container-full-width">
                <div class="row">
                    <?php
                    $covernews_enable_featured_news = covernews_get_option('show_featured_news_section');
                    $covernews_featured_category = covernews_get_option('select_featured_news_category');
                    $color_class = covernews_get_category_color_class($covernews_featured_category);
                    if ($covernews_enable_featured_news):
                        $covernews_featured_news_title = covernews_get_option('featured_news_section_title');
                        ?>

                        <div class="af-main-banner-featured-posts grid-layout">

                            <?php if (!empty($covernews_featured_news_title)): ?>

                                <h4 class="header-after1 ">
                                <span class="header-after <?php echo esc_attr($color_class); ?>">
                                    <?php echo esc_html($covernews_featured_news_title); ?>
                                </span>

                                </h4>
                            <?php endif; ?>

                            <?php do_action('covernews_action_banner_featured_posts'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('covernews_action_front_page_main_section_3', 'covernews_front_page_main_section_3', 40);