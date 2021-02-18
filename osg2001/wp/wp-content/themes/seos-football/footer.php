<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->
	
	<?php if (get_theme_mod( 'social_media_activate' )) { seos_football_social_section (); } ?>
	
	<footer role="contentinfo">
			<div class="footer-center sw-clear">
			
				<?php if (  is_active_sidebar('footer-1') ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php endif; ?>
				
				<?php if (  is_active_sidebar('footer-2') ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				<?php endif; ?>
				
				<?php if (  is_active_sidebar('footer-3') ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				<?php endif; ?>
				
				<?php if (  is_active_sidebar('footer-4') ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>
				<?php endif; ?>
				
			</div>	
		<div id="colophon"  class="site-info">
			<p>
					<?php esc_html_e('All rights reserved', 'seos-football'); ?>  &copy; <?php bloginfo('name'); ?>
								
					<a title="Seos Themes" href="<?php echo esc_url('https://seosthemes.com/', 'seos-football'); ?>" target="_blank"><?php esc_html_e('Theme by Seos Themes', 'seos-football'); ?></a>
			</p>	
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	<a id="totop" href="#"><div><img src="<?php echo esc_url(SEOS_FOOTBALL_THEME_URI.'/framework/images/top.png'); ?>" /></div></a>	
</div><!-- #page -->


	
<?php wp_footer(); ?>

</body>
</html>
