<?php
/**
* Tabbed widget
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class elegantwp_tabbed_widget extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array( 'classname' => 'elegantwp-tabbed-widget', 'description' => esc_html__( 'This widget displays widgets in tabbed format.', 'elegantwp-pro' ) );
    $control_ops = array( 'id_base' => 'elegantwp-tabbed-widget-id' );
    parent::__construct( 'elegantwp-tabbed-widget-id', esc_html__( 'ElegantWP Tabbed Widget', 'elegantwp-pro' ), $widget_ops, $control_ops );
  }

  function form($instance)
  {
    $defaults = array( 'title' => esc_html__( 'Tabbed Widget', 'elegantwp-pro' ), 'show_popular_posts' => true, 'show_recent_posts' => true, 'show_random_posts' => true, 'tab_one_name' => esc_html__( 'Popular', 'elegantwp-pro' ), 'tab_two_name' => esc_html__( 'Recent', 'elegantwp-pro' ), 'tab_three_name' => esc_html__( 'Random', 'elegantwp-pro' ), 'number' => 3, 'show_thumbnail' => true, 'show_author' => false, 'show_date' => true, 'show_comments' => true, 'show_snippet' => true, 'snippet_length' => 20 );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_popular_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_popular_posts' ) ); ?>" type="checkbox" <?php checked( $instance['show_popular_posts'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_popular_posts' ) ); ?>"><?php esc_html_e( 'Display Tab 1 (Popular Posts)','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_recent_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_recent_posts' ) ); ?>" type="checkbox" <?php checked( $instance['show_recent_posts'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_recent_posts' ) ); ?>"><?php esc_html_e( 'Display Tab 2 (Recent Posts)','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_random_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_random_posts' ) ); ?>" type="checkbox" <?php checked( $instance['show_random_posts'] ); ?>  />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_random_posts' ) ); ?>"><?php esc_html_e( 'Display Tab 3 (Random Posts)','elegantwp-pro' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tab_one_name' ) ); ?>"><?php esc_html_e('Tab 1 Name:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tab_one_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tab_one_name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tab_one_name'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: Popular','elegantwp-pro'); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tab_two_name' ) ); ?>"><?php esc_html_e('Tab 2 Name:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tab_two_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tab_two_name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tab_two_name'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: Recent','elegantwp-pro'); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tab_three_name' ) ); ?>"><?php esc_html_e('Tab 3 Name:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tab_three_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tab_three_name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tab_three_name'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: Random','elegantwp-pro'); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: 3','elegantwp-pro'); ?></small>
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
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'snippet_length' ) ); ?>"><?php esc_html_e('Post snippet length(number of words):','elegantwp-pro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'snippet_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'snippet_length' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['snippet_length'] ); ?>" />
            <br /><small><?php esc_html_e('Default value: 20','elegantwp-pro'); ?></small>
        </p>
<?php
  }

  function update($new_instance,$old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['show_popular_posts'] = isset( $new_instance['show_popular_posts'] ) ? (bool) $new_instance['show_popular_posts'] : false;
    $instance['show_recent_posts'] = isset( $new_instance['show_recent_posts'] ) ? (bool) $new_instance['show_recent_posts'] : false;
    $instance['show_random_posts'] = isset( $new_instance['show_random_posts'] ) ? (bool) $new_instance['show_random_posts'] : false;
    $instance['tab_one_name'] = sanitize_text_field( $new_instance['tab_one_name'] );
    $instance['tab_two_name'] = sanitize_text_field( $new_instance['tab_two_name'] );
    $instance['tab_three_name'] = sanitize_text_field( $new_instance['tab_three_name'] );
    $instance['number'] = absint( $new_instance['number'] );
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : false;
    $instance['show_snippet'] = isset( $new_instance['show_snippet'] ) ? (bool) $new_instance['show_snippet'] : false;
    $instance['snippet_length'] = absint( $new_instance['snippet_length'] );
    return $instance;
  }

  function widget($args,$instance)
  {
    extract($args, EXTR_SKIP);

    $title = ( ! empty( $instance['title'] ) ) ? apply_filters('widget_title',$instance['title'],$this->id_base) : '';
    $allowed_html = array('a' => array('href' => array(), 'title' => array()), 'br'=> array(), 'strong'=> array(), 'em'=> array());
    $show_popular_posts = isset( $instance['show_popular_posts'] ) ? (bool) $instance['show_popular_posts'] : false;
    $show_recent_posts = isset( $instance['show_recent_posts'] ) ? (bool) $instance['show_recent_posts'] : false;
    $show_random_posts = isset( $instance['show_random_posts'] ) ? (bool) $instance['show_random_posts'] : false;
    $tab_one_name = ( ! empty( $instance['tab_one_name'] ) ) ? sanitize_text_field( $instance['tab_one_name'] ) : 'Popular';
    $tab_two_name = ( ! empty( $instance['tab_two_name'] ) ) ? sanitize_text_field( $instance['tab_two_name'] ) : 'Recent';
    $tab_three_name = ( ! empty( $instance['tab_three_name'] ) ) ? sanitize_text_field( $instance['tab_three_name'] ) : 'Random';
    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
    $show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    $show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : false;
    $show_snippet = isset( $instance['show_snippet'] ) ? (bool) $instance['show_snippet'] : false;
    $snippet_length = ( ! empty( $instance['snippet_length'] ) ) ? absint( $instance['snippet_length'] ) : 20;

    echo $before_widget;

    if(!empty($title)) { echo $before_title.$title.$after_title; } ?>


<div class='elegantwp-tabbed-wrapper'>

<ul class='elegantwp-tabbed-names'>
<?php if($show_popular_posts) { ?><li><a href='#elegantwp-tabbed-content-1'><?php echo esc_html( $tab_one_name ); ?></a></li><?php } ?>
<?php if($show_recent_posts) { ?><li><a href='#elegantwp-tabbed-content-2'><?php echo esc_html( $tab_two_name ); ?></a></li><?php } ?>
<?php if($show_random_posts) { ?><li><a href='#elegantwp-tabbed-content-3'><?php echo esc_html( $tab_three_name ); ?></a></li><?php } ?>
</ul>

<?php if($show_popular_posts) { ?>
<div class='elegantwp-tabbed-content' id='elegantwp-tabbed-content-1'>
<?php
        $elegantwppp = new WP_Query("orderby=comment_count&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
        if ($elegantwppp->have_posts()) :
        ?>

        <div class="elegantwp-fp01-posts">
        <?php while ($elegantwppp->have_posts()) : $elegantwppp->the_post();  ?>
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
?>
</div>
<?php } ?>

<?php if($show_recent_posts) { ?>
<div class='elegantwp-tabbed-content' id='elegantwp-tabbed-content-2'>
<?php
        $elegantwprp = new WP_Query("orderby=date&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
        if ($elegantwprp->have_posts()) :
        ?>

        <div class="elegantwp-fp01-posts">
        <?php while ($elegantwprp->have_posts()) : $elegantwprp->the_post();  ?>
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
?>
</div>
<?php } ?>

<?php if($show_random_posts) { ?>
<div class='elegantwp-tabbed-content' id='elegantwp-tabbed-content-3'>
<?php
        $elegantwpranp = new WP_Query("orderby=rand&showposts=".$number."&nopaging=0&post_status=publish&ignore_sticky_posts=1&post_type=post");
        if ($elegantwpranp->have_posts()) :
        ?>

        <div class="elegantwp-fp01-posts">
        <?php while ($elegantwpranp->have_posts()) : $elegantwpranp->the_post();  ?>
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
?>
</div>
<?php } ?>

</div>

    <?php echo $after_widget;
  }

}

function elegantwp_tabbed_widget_function() {
    register_widget( 'elegantwp_tabbed_widget' );
}
add_action( 'widgets_init', 'elegantwp_tabbed_widget_function' );