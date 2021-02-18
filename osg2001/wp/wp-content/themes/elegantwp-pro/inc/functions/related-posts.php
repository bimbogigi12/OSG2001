<?php
/**
* Related posts
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'elegantwp_related_posts' ) ) :

function elegantwp_related_posts() { ?>
<div class="elegantwp-related-posts-wrap" id="elegantwp-related-posts-wrap">
    <?php if ( elegantwp_get_option('related_posts_heading') ) : ?>
    <h4><?php echo esc_html( elegantwp_get_option('related_posts_heading') ); ?></h4>
    <?php else : ?>
    <h4><?php esc_html_e('Related Articles', 'elegantwp-pro'); ?></h4>
    <?php endif; ?>
    <ul class="elegantwp-related-posts-list">
        <?php
        global $post; 
        $categories = get_the_category($post->ID);

        if ($categories) :

        $category_ids = array(); 

        foreach($categories as $individual_category) {
            $category_ids[] = $individual_category->term_id;
        }

        $related_posts_number = 4;
        if ( elegantwp_get_option('related_posts_number') ) {
            $related_posts_number = elegantwp_get_option('related_posts_number');
        }

        $args=array('category__in' => $category_ids,'post__not_in' => array($post->ID),'posts_per_page'=> $related_posts_number,'orderby'=> 'rand','ignore_sticky_posts'=> 1);

        $elegantwp_related_posts_query = new WP_Query( $args );

        if( $elegantwp_related_posts_query->have_posts() ) :
        while( $elegantwp_related_posts_query->have_posts() ) : $elegantwp_related_posts_query->the_post();?>

            <li class="elegantwp-related-post-item">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="elegantwp-related-posts-image"><a class="elegantwp-related-post-item-title" href="<?php the_permalink();?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-related-post-item-thumbnail')); ?></a></div>
                <?php } else { ?>
                    <div class="elegantwp-related-posts-image"><a class="elegantwp-related-post-item-title" href="<?php the_permalink();?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-3.jpg' ); ?>" class="elegantwp-related-post-item-thumbnail"/></a></div>
                <?php } ?>
                <div><a class="elegantwp-related-post-item-title" href="<?php the_permalink();?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title();?></a></div>
            </li>

        <?php 

        endwhile;
        wp_reset_postdata();
        endif;

        endif;

        ?>
    </ul>
</div>
<?php }

endif;