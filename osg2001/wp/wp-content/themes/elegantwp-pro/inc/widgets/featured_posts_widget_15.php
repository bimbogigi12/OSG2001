<?php
/**
* Featured posts widget 15
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class elegantwp_posts_widget_fifteen extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array( 'classname' => 'elegantwp-featured-posts-widget-fifteen', 'description' => esc_html__( 'This widget displays recent/popular/random posts or displays posts from a given category or tag.', 'elegantwp-pro' ) );
    $control_ops = array( 'id_base' => 'elegantwp-featured-posts-widget-fifteen-id' );
    parent::__construct( 'elegantwp-featured-posts-widget-fifteen-id', esc_html__( 'ElegantWP Featured Posts - Style 15', 'elegantwp-pro' ), $widget_ops, $control_ops );
  }

  function form($instance)
  {
    $posttypes = array( 'recentposts' => esc_html__( 'Recent Posts', 'elegantwp-pro' ), 'popularposts' => esc_html__( 'Popular Posts', 'elegantwp-pro' ), 'randomposts' => esc_html__( 'Random Posts', 'elegantwp-pro' ), 'catposts' => esc_html__( 'Category Posts', 'elegantwp-pro' ), 'tagposts' => esc_html__( 'Tag Posts', 'elegantwp-pro' ) );
    $defaults = array( 'title' => esc_html__( 'Featured Posts - Style 15', 'elegantwp-pro' ), 'title_one' => esc_html__( 'Featured Posts - Style 15 - Left', 'elegantwp-pro' ), 'title_two' => esc_html__( 'Featured Posts - Style 15 - Right', 'elegantwp-pro' ), 'number' => 5,  'show_cats' => false, 'show_author' => true, 'show_date' => true, 'show_comments' => true, 'post_type_one' => 'recentposts', 'post_type_two' => 'recentposts', 'featured_cat_one' => '', 'featured_cat_two' => '', 'featured_tag_one' => '', 'featured_tag_two' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_one' ) ); ?>"><?php esc_html_e( 'Left Side Posts Title:', 'elegantwp-pro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_one' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_one' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title_one'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_type_one' ) ); ?>"><?php esc_html_e( 'Choose the Post Type to Display as Left Side Posts', 'elegantwp-pro' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'post_type_one' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_type_one' ) ); ?>" class="widefat">
                <?php
                foreach ( $posttypes as $posttypevalue => $posttypename ) {
                    echo '<option value="' . esc_attr($posttypevalue) . '" id="' . esc_attr($posttypevalue) . '"', $instance['post_type_one'] == $posttypevalue ? ' selected="selected"' : '', '>', esc_html($posttypename), '</option>';
                }
                ?>
            </select>
        </p>
       <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_cat_one' ) ); ?>"><?php esc_html_e( 'Select a Category for Left Side Posts (If post type option is Category Posts for left side posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_cat_one'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_cat_one' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_cat_one' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'category', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_tag_one' ) ); ?>"><?php esc_html_e( 'Select a Tag for Left Side Posts (If post type option is Tag Posts for left side posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_tag_one'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_tag_one' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_tag_one' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'post_tag', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_two' ) ); ?>"><?php esc_html_e( 'Right Posts Title:', 'elegantwp-pro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_two' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_two' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title_two'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_type_two' ) ); ?>"><?php esc_html_e( 'Choose the Post Type to Display as Right Side Posts', 'elegantwp-pro' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'post_type_two' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_type_two' ) ); ?>" class="widefat">
                <?php
                foreach ( $posttypes as $posttypevalue => $posttypename ) {
                    echo '<option value="' . esc_attr($posttypevalue) . '" id="' . esc_attr($posttypevalue) . '"', $instance['post_type_two'] == $posttypevalue ? ' selected="selected"' : '', '>', esc_html($posttypename), '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_cat_two' ) ); ?>"><?php esc_html_e( 'Select a Category for Right Side Posts (If post type option is Category Posts for right side posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_cat_two'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_cat_two' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_cat_two' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'category', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_tag_two' ) ); ?>"><?php esc_html_e( 'Select a Tag for Right Side Posts (If post type option is Tag Posts for right side posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_tag_two'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_tag_two' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_tag_two' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'post_tag', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: 5','elegantwp-pro'); ?></small>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_cats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cats' ) ); ?>" type="checkbox" <?php checked( $instance['show_cats'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_cats' ) ); ?>"><?php esc_html_e( 'Display Post Categories?','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" type="checkbox" <?php checked( $instance['show_author'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php esc_html_e( 'Display Post Author?','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" type="checkbox" <?php checked( $instance['show_date'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display Post Date?','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" type="checkbox" <?php checked( $instance['show_comments'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Display Number of Comments?','elegantwp-pro' ); ?></label>
        </p>
<?php
  }

  function update($new_instance,$old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['title_one'] = sanitize_text_field( $new_instance['title_one'] );
    $instance['title_two'] = sanitize_text_field( $new_instance['title_two'] );
    $instance['post_type_one'] = sanitize_text_field( $new_instance['post_type_one'] );
    $instance['post_type_two'] = sanitize_text_field( $new_instance['post_type_two'] );
    $instance['featured_cat_one'] = absint( $new_instance['featured_cat_one'] );
    $instance['featured_cat_two'] = absint( $new_instance['featured_cat_two'] );
    $instance['featured_tag_one'] = absint( $new_instance['featured_tag_one'] );
    $instance['featured_tag_two'] = absint( $new_instance['featured_tag_two'] );
    $instance['number'] = absint( $new_instance['number'] );
    $instance['show_cats'] = isset( $new_instance['show_cats'] ) ? (bool) $new_instance['show_cats'] : false;
    $instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : false;
    return $instance;
  }

  function widget($args,$instance)
  {
    extract($args, EXTR_SKIP);

    $title = ( ! empty( $instance['title'] ) ) ? apply_filters('widget_title',$instance['title'],$this->id_base) : '';
    $title_one = ( ! empty( $instance['title_one'] ) ) ? apply_filters('widget_title',$instance['title_one'],$this->id_base) : '';
    $title_two = ( ! empty( $instance['title_two'] ) ) ? apply_filters('widget_title',$instance['title_two'],$this->id_base) : '';
    $post_type_one = ( ! empty( $instance['post_type_one'] ) ) ? sanitize_text_field( $instance['post_type_one'] ) : 'recentposts';
    $post_type_two = ( ! empty( $instance['post_type_two'] ) ) ? sanitize_text_field( $instance['post_type_two'] ) : 'recentposts';
    $featured_cat_one = ( ! empty( $instance['featured_cat_one'] ) ) ? absint( $instance['featured_cat_one'] ) : '';
    $featured_cat_two = ( ! empty( $instance['featured_cat_two'] ) ) ? absint( $instance['featured_cat_two'] ) : '';
    $featured_tag_one = ( ! empty( $instance['featured_tag_one'] ) ) ? absint( $instance['featured_tag_one'] ) : '';
    $featured_tag_two = ( ! empty( $instance['featured_tag_two'] ) ) ? absint( $instance['featured_tag_two'] ) : '';
    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    $allowed_html = array('a' => array('href' => array(), 'title' => array()), 'br'=> array(), 'strong'=> array(), 'em'=> array());
    $show_cats = isset( $instance['show_cats'] ) ? (bool) $instance['show_cats'] : false;
    $show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    $show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : false;

    if($post_type_one === 'popularposts') {
        $elegantwplabelpostsone = new WP_Query("orderby=comment_count&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif($post_type_one === 'randomposts') {
        $elegantwplabelpostsone = new WP_Query("orderby=rand&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif(($post_type_one === 'catposts') && $featured_cat_one) {
        $elegantwplabelpostsone = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&cat=$featured_cat_one");
    } elseif(($post_type_one === 'tagposts') && $featured_tag_one) {
        $elegantwplabelpostsone = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&tag_id=$featured_tag_one");
    } else {
        $elegantwplabelpostsone = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    }

    if($post_type_two === 'popularposts') {
        $elegantwplabelpoststwo = new WP_Query("orderby=comment_count&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif($post_type_two === 'randomposts') {
        $elegantwplabelpoststwo = new WP_Query("orderby=rand&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif(($post_type_two === 'catposts') && $featured_cat_two) {
        $elegantwplabelpoststwo = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&cat=$featured_cat_two");
    } elseif(($post_type_two === 'tagposts') && $featured_tag_two) {
        $elegantwplabelpoststwo = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&tag_id=$featured_tag_two");
    } else {
        $elegantwplabelpoststwo = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    }

    echo $before_widget;
    if(!empty($title)) { echo $before_title.$title.$after_title; }
    ?><div class="elegantwp-fp15-posts-wrapper"><?php

    if ($elegantwplabelpostsone->have_posts()) :

        ?><div class="elegantwp-fp15-posts-left"><?php
        if(!empty($title_one)) { echo $before_title.$title_one.$after_title; } ?>

        <div class="elegantwp-fp15-posts">
        <?php $x=0; while ($elegantwplabelpostsone->have_posts()) : $elegantwplabelpostsone->the_post();  ?>

        <?php if($x==0){ ?>

        <div class="elegantwp-fp15-post">
            <div class="elegantwp-fp15-post-thumbnail">
            <?php if(has_post_thumbnail()) { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-fp15-post-img', 'title' => get_the_title())); ?></a>
            <?php } else { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-3.jpg' ); ?>" class="elegantwp-fp15-post-img"/></a>
            <?php } ?>
            </div>
            <div class="elegantwp-fp15-post-details">
            <?php
            if($show_cats) {
            if ( 'post' == get_post_type() ) {
                /* translators: used between list items, there is a space */
                $categories_list = get_the_category_list( ' ' );
                if ( $categories_list ) {
                    /* translators: 1: list of categories. */
                    printf( '<div class="elegantwp-fp15-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
                }
            }
            }
            ?>
            <h3 class="elegantwp-fp15-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
            <div class="elegantwp-fp15-post-footer">
            <?php if($show_author) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
            <?php if($show_date) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-date"><?php echo get_the_date('d-m-Y'); ?></span><?php } ?>
            <?php if($show_comments) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span><?php } ?>
            </div>
            </div>
        </div>

        <?php $x++; } else { ?>

        <div class="elegantwp-fp15-post">
            <div class="elegantwp-fp15-post-details">
            <h3 class="elegantwp-fp15-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
            </div>
        </div>

        <?php } ?>

        <?php endwhile; ?>
        </div>
        </div>

        <?php wp_reset_postdata();  // Restore global post data stomped by the_post().

    endif;


    if ($elegantwplabelpoststwo->have_posts()) :

        ?><div class="elegantwp-fp15-posts-right"><?php
        if(!empty($title_two)) { echo $before_title.$title_two.$after_title; } ?>

        <div class="elegantwp-fp15-posts">
        <?php $y=0; while ($elegantwplabelpoststwo->have_posts()) : $elegantwplabelpoststwo->the_post();  ?>

        <?php if($y==0){ ?>

        <div class="elegantwp-fp15-post">
            <div class="elegantwp-fp15-post-thumbnail">
            <?php if(has_post_thumbnail()) { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-fp15-post-img', 'title' => get_the_title())); ?></a>
            <?php } else { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-3.jpg' ); ?>" class="elegantwp-fp15-post-img"/></a>
            <?php } ?>
            </div>
            <div class="elegantwp-fp15-post-details">
            <?php
            if($show_cats) {
            if ( 'post' == get_post_type() ) {
                /* translators: used between list items, there is a space */
                $categories_list = get_the_category_list( ' ' );
                if ( $categories_list ) {
                    /* translators: 1: list of categories. */
                    printf( '<div class="elegantwp-fp15-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'elegantwp-pro' ) . '</div>', $categories_list ); // WPCS: XSS OK.
                }
            }
            }
            ?>
            <h3 class="elegantwp-fp15-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
            <div class="elegantwp-fp15-post-footer">
            <?php if($show_author) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
            <?php if($show_date) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-date"><?php echo get_the_date('d-m-Y'); ?></span><?php } ?>
            <?php if($show_comments) { ?><span class="elegantwp-fp15-post-meta elegantwp-fp15-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span><?php } ?>
            </div>
            </div>
        </div>

        <?php $y++; } else { ?>

        <div class="elegantwp-fp15-post">
            <div class="elegantwp-fp15-post-details">
            <h3 class="elegantwp-fp15-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
            </div>
        </div>

        <?php } ?>

        <?php endwhile; ?>
        </div>
        </div>

        <?php wp_reset_postdata();  // Restore global post data stomped by the_post().

    endif;


    echo $after_widget;
    ?></div><?php
  }

}

function elegantwp_posts_widget_fifteen_function() {
    register_widget( 'elegantwp_posts_widget_fifteen' );
}
add_action( 'widgets_init', 'elegantwp_posts_widget_fifteen_function' );