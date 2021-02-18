<?php
/*
# ====================================
# page.php
#
# The template for displaying all pages
# ====================================
*/
?>

<?php get_header(); ?>

<!--==== Start Page Content ====-->
<div class="section style-full">
	<div class="container">
		<!-- post content -->
		<div class="row">
			<!-- Start single post -->
			<article class="col-xs-12">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-wrapper' ); ?>>
						<header>
							<h1>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
							</h1>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>

							<div class="featured-image text-center">

								<?php the_post_thumbnail( 'full'); ?>

							</div>

						<?php endif; ?>

						<div class="post-content">
							<div class="post-main">

								<?php the_content(); ?>

							</div>

							<?php
								/* Posts pagination */
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'akyl' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="num">',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'akyl' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
							
						</div>	
					</div>
		
				<?php endwhile; endif; ?>
			</article><!-- End single post -->
		</div>
		
		<?php 
			if ( have_comments() ) :
				comments_template( '', true );
			endif;
		?>
	</div>
</div>
<!--==== End Page Content ====-->

<?php get_footer(); ?>