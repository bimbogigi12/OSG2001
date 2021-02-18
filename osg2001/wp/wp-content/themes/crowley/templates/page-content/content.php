<?php
/**
 * The main content template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>
<?php printf( '<div class="%s-c_w">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%s-c_w-i">', esc_attr( $evolvethemes_key ) ); ?>

		<?php printf( '<div id="main-content" class="%s-c" role="main">', esc_attr( $evolvethemes_key ) ); ?>

			<?php do_action( 'evolvethemes_before_content' ); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php printf( '<div class="%s-mc">', esc_attr( $evolvethemes_key ) ); ?>

					<?php printf( '<div class="%s-mc-w_i %s-mc-content crowley-text">', esc_attr( $evolvethemes_key ), esc_attr( $evolvethemes_key ) ); ?>
					   <?php
						the_content(
							sprintf(
								/* translators: %s: The post title. */
								esc_html__( 'Continue reading %s', 'crowley' ),
								the_title( '<span class="screen-reader-text">', '</span>', false )
							)
						);
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'crowley' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'crowley' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							)
						);
						?>
					</div>

					<?php do_action( 'crowley_after_the_content' ); ?>

					<?php get_template_part( 'templates/comments/comments' ); ?>

				</div>
			<?php endwhile; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</div>
