<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

$image_class = covernews_get_option('archive_layout');
if ($image_class == 'archive-layout-list') {
    $image_align_class = covernews_get_option('archive_image_alignment');
    $image_class .= ' ';
    $image_class .= $image_align_class;
}

$excerpt_length = 20;
if (has_post_thumbnail()) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium');
    $url = $thumb['0'];
} else {
    $url = '';
}
global $post;
$col_class = 'col-ten';
?>
<div class="base-border <?php echo esc_attr($image_class); ?>">
    <div class="align-items-center">
        <?php

        if (!empty($url)):
            $col_class = 'col-five';
            ?>
            <div class="col <?php echo $col_class; ?> col-image">
                <figure class="categorised-article">
                    <div class="categorised-article-wrapper">
                        <div class="data-bg data-bg-hover data-bg-categorised"
                             data-background="<?php echo esc_url($url); ?>"><a
                                    href="<?php the_permalink(); ?>"></a>

                        </div>
                    </div>
                </figure>
                <?php echo covernews_post_format($post->ID); ?>
            </div>
        <?php endif; ?>
        <div class="col <?php echo $col_class; ?> col-details">
            <div class="row prime-row">
                <?php if ('post' === get_post_type()) : ?>
                    <div class="figure-categories figure-categories-bg">
                        
                        <?php covernews_post_categories('/'); ?>
                    </div>
                <?php endif; ?>
            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
            </h3>'); ?>
            <div class="grid-item-metadata">

                <?php covernews_post_item_meta(); ?>
            </div>
            <?php
            $archive_content_view = covernews_get_option('archive_content_view');
            if ($archive_content_view != 'archive-content-none'):
                ?>
                <div class="full-item-discription">
                    <div class="post-description">

                        <?php

                        if ($archive_content_view == 'archive-content-excerpt') {

                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        </div>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'covernews'),
            'after' => '</div>',
        ));
        ?>
    </div>
</div>






