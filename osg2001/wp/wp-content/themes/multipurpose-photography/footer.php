<?php
/**
 * The template for displaying the footer.
 * @package Multipurpose Photography
 */
?>
    <div  id="footer">
      <?php
      if ( is_active_sidebar( 'footer-1' ) ||
         is_active_sidebar( 'footer-2' ) ||
         is_active_sidebar( 'footer-3' ) ||
         is_active_sidebar( 'footer-4' ) ) :
      ?>
        <div class="footerinner">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-3">
                <?php dynamic_sidebar('footer-1');?>
              </div>
              <div class="col-lg-3 col-md-3">
                <?php dynamic_sidebar('footer-2');?>
              </div>
              <div class="col-lg-3 col-md-3">
                <?php dynamic_sidebar('footer-3');?>
              </div>
              <div class="col-lg-3 col-md-3">
                <?php dynamic_sidebar('footer-4');?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="inner">
          <div class="copyright text-center">
            <p><?php echo esc_html(get_theme_mod('multipurpose_photography_text',__('Copyright 2018','multipurpose-photography'))); ?> <?php multipurpose_photography_credit_link(); ?></p>
          </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>