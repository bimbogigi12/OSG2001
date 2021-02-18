<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php
$elegantwp_wrapper_class_start = $elegantwp_wrapper_class_end = '';
global $elegantwp_post_counter;
global $elegantwp_total_posts;
if(1 == $elegantwp_post_counter) {
    $elegantwp_wrapper_class_start = '<div class="elegantwp-fp12-posts-left">';
    $elegantwp_wrapper_class_end = '</div>';
} else {
    if(2 == $elegantwp_post_counter) {
        $elegantwp_wrapper_class_start = '<div class="elegantwp-fp12-posts-right">';
    }
    if($elegantwp_post_counter == $elegantwp_total_posts) {
        $elegantwp_wrapper_class_end = '</div>';
    }
}
?>

<?php echo wp_kses_post($elegantwp_wrapper_class_start);?>
<div id="post-<?php the_ID(); ?>" class="elegantwp-fp12-post">

    <div class="elegantwp-fp12-post-thumbnail">
    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('elegantwp-medium-image', array('class' => 'elegantwp-fp12-post-img')); ?></a>
    <?php } else { ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'elegantwp-pro' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-3.jpg' ); ?>" class="elegantwp-fp12-post-img"/></a>
    <?php } ?>
    </div>

    <div class="elegantwp-fp12-post-details">

    <?php if(1 == $elegantwp_post_counter) { ?>
    <?php if ( !(elegantwp_get_option('hide_post_categories_home')) ) { ?><?php elegantwp_style_12_cats(); ?><?php } ?>
    <?php } ?>

    <?php the_title( sprintf( '<h3 class="elegantwp-fp12-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

    <?php elegantwp_style_12_postmeta(); ?>

    <?php if(1 == $elegantwp_post_counter) { ?>
    <?php if ( !(elegantwp_get_option('hide_post_snippet')) ) { ?><div class="elegantwp-fp12-post-snippet"><?php the_excerpt(); ?></div><?php } ?>

    <?php if ( !(elegantwp_get_option('hide_read_more_button')) ) { ?><div class='elegantwp-fp12-post-read-more'><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( elegantwp_read_more_text() ); ?></a></div><?php } ?>
    <?php } ?>

    </div>

</div>
<?php echo wp_kses_post($elegantwp_wrapper_class_end);?>