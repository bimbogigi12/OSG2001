<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php do_action( 'vw_education_academy_before_slider' ); ?>

<?php if( get_theme_mod( 'vw_education_academy_slider_arrows') != '') { ?>

<section id="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
    <?php $pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'vw_education_academy_slider_page' . $count ));
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
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title(); ?></h2>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_education_academy_string_limit_words( $excerpt,20 ) ); ?></p>
              <div class="more-btn">
                <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-education-academy' ); ?><i class="fa fa-angle-right"></i></a>
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
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    </a>
  </div>
  <div class="clearfix"></div>
</section>

<?php } ?>

<?php do_action( 'vw_education_academy_after_slider' ); ?>

<section id="about-section">
  <div class="container">
    <div class="row m-0">
      <?php $pages = array();
        $mod = absint( get_theme_mod( 'vw_education_academy_about_page' ));
        if ( 'page-none-selected' != $mod ) {
          $pages[] = $mod;
        }
        if( !empty($pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="col-lg-7 col-md-7">
                <?php if( get_theme_mod( 'vw_education_academy_section_title') != '') { ?>
                  <span><i class="fas fa-graduation-cap"></i></span>
                  <h3><?php echo esc_html(get_theme_mod('vw_education_academy_section_title',''));?></h3>
                  <hr>
                <?php }?>
                <h4><?php the_title(); ?></h4>
                <p><?php the_excerpt(); ?></p>
                <div class="more-btn">
                  <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-education-academy' ); ?><i class="fa fa-angle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-5 col-md-5">
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
        endif;
        wp_reset_postdata()?>
      <div class="clearfix"></div> 
    </div>
  </div>
</section>

<?php do_action( 'vw_education_academy_after_services' ); ?>

<div id="content-vw">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</div>

<?php get_footer(); ?>
