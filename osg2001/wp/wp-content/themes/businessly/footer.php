<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package businessly
 */

?>
</div>
</div><!-- #content -->

<footer id="colophon" class="site-footer clearfix">

	<div class="content-wrap">
		<?php if ( is_active_sidebar( 'footerwidget-1' ) ) : ?>
			<div class="footer-column-wrapper">
				<div class="footer-column-three footer-column-left">
					<?php dynamic_sidebar( 'footerwidget-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-2' ) ) : ?>
				<div class="footer-column-three footer-column-middle">
					<?php dynamic_sidebar( 'footerwidget-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-3' ) ) : ?>
				<div class="footer-column-three footer-column-right">
					<?php dynamic_sidebar( 'footerwidget-3' ); ?>				
				</div>
			<?php endif; ?>

		</div>

		<div class="site-info">
			&copy;<?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>
							<!-- Delete below lines to remove copyright from footer -->
				<span class="footer-info-right">
					<?php echo __(' | WordPress Theme by', 'businessly') ?> <a href="<?php echo esc_url('https://superbthemes.com/', 'businessly'); ?>"><?php echo __(' Superb WordPress Themes', 'businessly') ?></a>
				</span>
				<!-- Delete above lines to remove copyright from footer -->
		</div><!-- .site-info -->
	</div>



</footer><!-- #colophon --> 
</div><!-- #page -->

<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>
</html>
