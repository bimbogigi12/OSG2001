<?php
/*
# ============================================
# footer.php
#
# The template for displaying the footer
# ============================================
*/


?>
	<!-- Jet pack 'Older posts' button will append here -->
	<div id="infinite-handle-container"></div>

	<!--==== Start Footer Widget Area ====-->
	<?php if ( is_active_sidebar( 'footer-1' ) || 
				is_active_sidebar( 'footer-2' ) || 
				is_active_sidebar( 'footer-3' ) ) : ?>
				
		<div class="section footer-widget-area">
			<div class="container">

				<div class="row">

					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

						<div class="col-md-4 col-sm-6">
							
							<?php dynamic_sidebar( 'footer-1' ); ?>
						
						</div>

					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>

						<div class="col-md-4 col-sm-6">
							
							<?php dynamic_sidebar( 'footer-2' ); ?>
						
						</div>

					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>

						<div class="col-md-4 col-sm-6">
							
							<?php dynamic_sidebar( 'footer-3' ); ?>
						
						</div>

					<?php endif; ?>

				</div>

			</div>
		</div>

	<?php endif; ?>
	<!--==== End Footer Widget Area ====-->

	<!--==== Start Footer====-->
	<footer id="footer" class="section-dark">
		<div class="container">
			<div class="row">
				<p class="footer-text">
					&copy; <?php echo date_i18n('Y', strtotime(date('Y'))) ?> <a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>. <?php _e('Theme by', 'akyl'); ?> <a href="http://akilathiwanka.info">Akila Thiwanka</a>.
				</p>

				<p class="social-icons">
					<?php 
						$links = akyl_load_social_links();
						foreach ( $links as $link ) {
							echo $link;
						}
					?>
				</p>
			</div>
		</div>
	</footer>
	<!--==== End Footer ====-->
	
	<div id="blog-masonry-temp" style="opacity: 0"></div>
	<?php wp_footer(); ?>
</body>
</html>