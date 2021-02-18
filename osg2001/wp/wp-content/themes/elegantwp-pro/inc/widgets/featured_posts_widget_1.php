<?php
/**
* Featured posts widget 1
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class elegantwp_posts_widget_one extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array( 'classname' => 'elegantwp-featured-posts-widget-one', 'description' => esc_html__( 'This widget displays recent/popular/random posts or displays posts from a given category or tag.', 'elegantwp-pro' ) );
    $control_ops = array( 'id_base' => 'elegantwp-featured-posts-widget-one-id' );
    parent::__construct( 'elegantwp-featured-posts-widget-one-id', esc_html__( 'ElegantWP Featured Posts - Style 1', 'elegantwp-pro' ), $widget_ops, $control_ops );
  }

  function form($instance)
  {
    $posttypes = array( 'recentposts' => esc_html__( 'Recent Posts', 'elegantwp-pro' ), 'popularposts' => esc_html__( 'Popular Posts', 'elegantwp-pro' ), 'randomposts' => esc_html__( 'Random Posts', 'elegantwp-pro' ), 'catposts' => esc_html__( 'Category Posts', 'elegantwp-pro' ), 'tagposts' => esc_html__( 'Tag Posts', 'elegantwp-pro' ) );
    $defaults = array( 'title' => esc_html__( 'Featured Posts - Style 1', 'elegantwp-pro' ), 'number' => 5, 'show_thumbnail' => true, 'show_author' => false, 'show_date' => true, 'show_comments' => true, 'show_snippet' => true, 'post_type' => 'recentposts', 'featured_cat' => '', 'featured_tag' => '', 'snippet_length' => 20 );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'elegantwp-pro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Choose the Post Type to display', 'elegantwp-pro' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" class="widefat">
                <?php
                foreach ( $posttypes as $posttypevalue => $posttypename ) {
                    echo '<option value="' . esc_attr($posttypevalue) . '" id="' . esc_attr($posttypevalue) . '"', $instance['post_type'] == $posttypevalue ? ' selected="selected"' : '', '>', esc_html($posttypename), '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_cat' ) ); ?>"><?php esc_html_e( 'Select a Category (If post type option is Category Posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_cat'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_cat' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_cat' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'category', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_tag' ) ); ?>"><?php esc_html_e( 'Select a Tag (If post type option is Tag Posts)', 'elegantwp-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'show_option_all' => '', 'show_option_none' => '', 'option_none_value' => '-1', 'orderby' => 'ID', 'order' => 'ASC', 'show_count' => 1, 'hide_empty' => 1, 'child_of' => 0, 'echo' => 1, 'selected' => $instance['featured_tag'], 'hierarchical' => 0, 'name' => esc_attr( $this->get_field_name( 'featured_tag' ) ), 'id' => esc_attr( $this->get_field_id( 'featured_tag' ) ), 'class' => 'widefat', 'depth' => 0, 'tab_index' => 0, 'taxonomy' => 'post_tag', 'hide_if_empty' => false, 'value_field' => 'term_id', )  ); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: 5','elegantwp-pro'); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'snippet_length' ) ); ?>"><?php esc_html_e('Post snippet length(number of words):','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'snippet_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'snippet_length' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['snippet_length'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: 20','elegantwp-pro'); ?></small>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" <?php checked( $instance['show_thumbnail'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Display Post Thumbnail?','elegantwp-pro' ); ?></label>
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
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_snippet' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_snippet' ) ); ?>" type="checkbox" <?php checked( $instance['show_snippet'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_snippet' ) ); ?>"><?php esc_html_e( 'Display Post Snippet?','elegantwp-pro' ); ?></label>
        </p>
<?php
  }

  function update($new_instance,$old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['post_type'] = sanitize_text_field( $new_instance['post_type'] );
    $instance['featured_cat'] = absint( $new_instance['featured_cat'] );
    $instance['featured_tag'] = absint( $new_instance['featured_tag'] );
    $instance['number'] = absint( $new_instance['number'] );
    $instance['snippet_length'] = absint( $new_instance['snippet_length'] );
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : false;
    $instance['show_snippet'] = isset( $new_instance['show_snippet'] ) ? (bool) $new_instance['show_snippet'] : false;
    return $instance;
  }

  function widget($args,$instance)
  {
    extract($args, EXTR_SKIP);

    $title = ( ! empty( $instance['title'] ) ) ? apply_filters('widget_title',$instance['title'],$this->id_base) : '';
    $post_type = ( ! empty( $instance['post_type'] ) ) ? sanitize_text_field( $instance['post_type'] ) : 'recentposts';
    $featured_cat = ( ! empty( $instance['featured_cat'] ) ) ? absint( $instance['featured_cat'] ) : '';
    $featured_tag = ( ! empty( $instance['featured_tag'] ) ) ? absint( $instance['featured_tag'] ) : '';
    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    $snippet_length = ( ! empty( $instance['snippet_length'] ) ) ? absint( $instance['snippet_length'] ) : 20;
    $allowed_html = array('a' => array('href' => array(), 'title' => array()), 'br'=> array(), 'strong'=> array(), 'em'=> array());
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
    $show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    $show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : false;
    $show_snippet = isset( $instance['show_snippet'] ) ? (bool) $instance['show_snippet'] : false;

    if($post_type === 'popularposts') {
        $elegantwplabelposts = new WP_Query("orderby=comment_count&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif($post_type === 'randomposts') {
        $elegantwplabelposts = new WP_Query("orderby=rand&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    } elseif(($post_type === 'catposts') && $featured_cat) {
        $elegantwplabelposts = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&cat=$featured_cat");
    } elseif(($post_type === 'tagposts') && $featured_tag) {
        $elegantwplabelposts = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post&tag_id=$featured_tag");
    } else {
        $elegantwplabelposts = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
    }

    echo $before_widget;
    if ($elegantwplabelposts->have_posts()) :

        if(!empty($title)) { echo $before_title.$title.$after_title; } ?>

        <div class="elegantwp-fp01-posts">
        <?php while ($elegantwplabelposts->have_posts()) : $elegantwplabelposts->the_post();  ?>
        <div class="elegantwp-fp01-post">
            <?php if($show_thumbnail) { ?>
            <div class="elegantwp-fp01-post-thumbnail">
            <?php if(has_post_thumbnail()) { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo /* translators: %s: post title. */ esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-mini-image', array('class' => 'elegantwp-fp01-post-img', 'title' => get_the_title())); ?></a>
            <?php } else { ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo /* translators: %s: post title. */ esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-small.png' ); ?>" class="elegantwp-fp01-post-img"/></a>
            <?php } ?>
            </div>
            <?php } ?>
            <div class="elegantwp-fp01-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></div>
            <div class="elegantwp-fp01-post-footer">
            <?php if($show_author) { ?><span class="elegantwp-fp01-post-author elegantwp-fp01-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
            <?php if($show_date) { ?><span class="elegantwp-fp01-post-meta elegantwp-fp01-post-date"><?php echo get_the_date('d-m-Y'); ?></span><?php } ?>
            <?php if($show_comments) { ?><span class="elegantwp-fp01-post-meta elegantwp-fp01-post-comment"><?php comments_popup_link( esc_attr__( '0 Comments', 'elegantwp-pro' ), esc_attr__( '1 Comment', 'elegantwp-pro' ), esc_attr__( '% Comments', 'elegantwp-pro' ) ); ?></span><?php } ?>
            </div>
            <?php if($show_snippet) { ?><div class="elegantwp-fp01-post-snippet"><?php echo esc_html( wp_trim_words( get_the_content(), $snippet_length, '...' ) ); ?></div><?php } ?>
        </div>
        <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata();  // Restore global post data stomped by the_post().

    endif;
    echo $after_widget;
  }

}

function elegantwp_posts_widget_one_function() {
    register_widget( 'elegantwp_posts_widget_one' );
}
add_action( 'widgets_init', 'elegantwp_posts_widget_one_function' );