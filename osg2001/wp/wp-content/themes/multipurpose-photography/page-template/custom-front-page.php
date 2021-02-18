<?php
/**
 * Template Name: Custom home page
 */

get_header(); ?>

<?php do_action('multipurpose_photography_above_slider_section'); ?>

<?php if( get_theme_mod('multipurpose_photography_slider_hide_show') != ''){ ?>
  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'multipurpose_photography_slidersettings_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $pages[] = $mod;
            }
          }
          if( !empty($pages) ) :
          $args = array(
              'post_type' => 'page',
              'post__in' => $pages,
              'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              <div class="carousel-caption">
                <div class="inner_carousel">
                    <h2><?php the_title();?></h2> 
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( multipurpose_photography_string_limit_words( $excerpt,25) ); ?></p>
                    <div class ="read-more">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','multipurpose-photography'); ?><i class="fas fa-caret-right"></i></a>
                    </div>                    
                </div>
              </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
      </div>
      <?php else : ?>
        <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-caret-left"></i></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-caret-right"></i></span>
        </a>
    </div>
    <div class="clearfix"></div>
  </section> 
<?php }?>

<?php do_action('multipurpose_photography_below_slider_section'); ?>

<div class="header-nav">
  <?php get_template_part( 'template-parts/header/navigation' ); ?> 
</div>

<?php if( get_theme_mod('multipurpose_photography_services_title') != '' || get_theme_mod('multipurpose_photography_services_category') != ''){ ?>
  <section id="services">
    <div class="container">
      <?php if( get_theme_mod('multipurpose_photography_services_title') != ''){ ?>
        <h3 class="btn--corners"><span><?php echo esc_html(get_theme_mod('multipurpose_photography_services_title','')); ?></span></h3>
      <?php }?>
      <div class="row">
        <?php 
          $catData=  get_theme_mod('multipurpose_photography_services_category');
            if($catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html( $catData ,'multipurpose-photography')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-3 col-md-3">
                  <div class="service-content">
                    <h4><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h4>
                      <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                  </div>
                </div>
                <?php endwhile;
              wp_reset_postdata();
            } ?>
      </div>
    </div>
  </section>
<?php }?>

<?php do_action('multipurpose_photography_after_service_section'); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>