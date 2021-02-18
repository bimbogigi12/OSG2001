<?php
/**
* Trending News
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'elegantwp_trending_news' ) ) :

function elegantwp_trending_news() { ?>
<div class="elegantwp-trending-news">
    <?php if ( elegantwp_get_option('news_ticker_heading') ) : ?>
    <div class="elegantwp-trending-news-title"><?php echo esc_html( elegantwp_get_option('news_ticker_heading') ); ?></div>
    <?php else : ?>
    <div class="elegantwp-trending-news-title"><?php esc_html_e('Breaking News', 'elegantwp-pro'); ?></div>
    <?php endif; ?>

    <?php
    $news_ticker_length = 5;
    if ( elegantwp_get_option('news_ticker_length') ) {
        $news_ticker_length = elegantwp_get_option('news_ticker_length');
    }

    $news_ticker_post_type = 'recent-posts';
    if ( elegantwp_get_option('news_ticker_post_type') ) {
        $news_ticker_post_type = elegantwp_get_option('news_ticker_post_type');
    }

    $news_ticker_cat = elegantwp_get_option('news_ticker_cat');
    $news_ticker_tag = elegantwp_get_option('news_ticker_tag');

    if($news_ticker_post_type === 'popular-posts') {
        $news_ticker_query = new WP_Query("orderby=comment_count&showposts=".$news_ticker_length."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif($news_ticker_post_type === 'random-posts') {
        $news_ticker_query = new WP_Query("orderby=rand&showposts=".$news_ticker_length."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif(($news_ticker_post_type === 'category-posts') && $news_ticker_cat) {
        $news_ticker_query = new WP_Query("orderby=date&showposts=".$news_ticker_length."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&cat=$news_ticker_cat");
    } elseif(($news_ticker_post_type === 'tag-posts') && $news_ticker_tag) {
        $news_ticker_query = new WP_Query("orderby=date&showposts=".$news_ticker_length."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&tag_id=$news_ticker_tag");
    } else {
        $news_ticker_query = new WP_Query("orderby=date&showposts=".$news_ticker_length."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    }

    if ($news_ticker_query->have_posts()) : ?>

    <div class="elegantwp-marquee-wrapper">
    <div class="elegantwp-trending-news-items elegantwp-marquee">
        <?php while ($news_ticker_query->have_posts()) : $news_ticker_query->the_post();  ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>">
        <span class="elegantwp-trending-news-item-date"><?php echo get_the_date('d-m-Y'); ?></span>
        <span class="elegantwp-trending-news-item-title"><?php the_title(); ?></span>
        </a>
        <?php endwhile; ?>
    </div>
    </div>

    <?php wp_reset_postdata();  // Restore global post data stomped by the_post().
    endif; ?>

</div>
<?php }

endif;