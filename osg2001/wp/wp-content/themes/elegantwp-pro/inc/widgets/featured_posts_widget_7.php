<?php
/**
* Featured posts widget 7
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class elegantwp_posts_widget_seven extends WP_Widget
{

  function load_widget_scripts()
  {
    wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), NULL );
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() .'/assets/js/owl.carousel.min.js', array( 'jquery' ), NULL, true);
    wp_enqueue_script('imagesloaded', get_template_directory_uri() .'/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), NULL, true);
  }

  function __construct()
  {
    $widget_ops = array( 'classname' => 'elegantwp-featured-posts-widget-seven', 'description' => esc_html__( 'This widget displays recent/popular/random posts or displays posts from a given category or tag.', 'elegantwp-pro' ) );
    $control_ops = array( 'id_base' => 'elegantwp-featured-posts-widget-seven-id' );
    parent::__construct( 'elegantwp-featured-posts-widget-seven-id', esc_html__( 'ElegantWP Featured Posts - Style 7', 'elegantwp-pro' ), $widget_ops, $control_ops );
    if(is_active_widget(false, false, $this->id_base)) {
        add_action('wp_enqueue_scripts', array($this, 'load_widget_scripts'), 9);
    }
  }

  function form($instance)
  {
    $posttypes = array( 'recentposts' => esc_html__( 'Recent Posts', 'elegantwp-pro' ), 'popularposts' => esc_html__( 'Popular Posts', 'elegantwp-pro' ), 'randomposts' => esc_html__( 'Random Posts', 'elegantwp-pro' ), 'catposts' => esc_html__( 'Category Posts', 'elegantwp-pro' ), 'tagposts' => esc_html__( 'Tag Posts', 'elegantwp-pro' ) );
    $defaults = array( 'title' => esc_html__( 'Featured Posts - Style 7', 'elegantwp-pro' ), 'number' => 5, 'post_type' => 'recentposts', 'featured_cat' => '', 'featured_tag' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:','elegantwp-pro'); ?></label>
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
    $allowed_html = array('a' => array('href' => array(), 'title' => array()), 'br'=> array(), 'strong'=> array(), 'em'=> array());

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

        <div class="elegantwp-posts-carousel">
        <div class="owl-carousel">
        <?php while ($elegantwplabelposts->have_posts()) : $elegantwplabelposts->the_post();  ?>
        <div class="elegantwp-slide-item">
            <?php if(has_post_thumbnail()) { ?>
                <?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-fp07-post-thumbnail-img', 'title' => get_the_title())); ?>
            <?php } else { ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-3.jpg' ); ?>" class="elegantwp-fp07-post-thumbnail-img"/>
            <?php } ?>
            <div class="text-over"><h4 class="elegantwp-carousel-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h4></div>
        </div>
        <?php endwhile; ?>
        </div>
        </div>

        <?php wp_reset_postdata();  // Restore global post data stomped by the_post().

    endif;
    echo $after_widget;
  }

}

function elegantwp_posts_widget_seven_function() {
    register_widget( 'elegantwp_posts_widget_seven' );
}
add_action( 'widgets_init', 'elegantwp_posts_widget_seven_function' );