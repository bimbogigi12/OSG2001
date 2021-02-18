<?php
/*
# ====================================
# search.php
#
# The Template for Search Page
# ====================================
*/
?>

<?php get_header(); ?>

<!-- Show search results, If have -->
<?php if ( have_posts() ) : ?> 

	<!--==== Start Msonry Section ====-->
	<div class="section" id="blog-grid">
		<div class="container-fluid">

				<div class="page-title">
					<!-- Display the title -->
					<h6><?php echo __('Search Results For', 'akyl') . ' : ' . get_search_query(); ?></h6>
				</div> <!-- /page-title -->

				<div class="row blog-masonry">

					<?php
						/* Start the loop. */
						while ( have_posts() ) : the_post(); 

							/* Include the Post-Format-specific template for the content. */
							get_template_part( 'content', get_post_format() );

						endwhile; 
					?>

				</div><!-- end row --> 
				
				<!-- Posts navigation -->
				<?php 
				the_posts_navigation( array(
				    'prev_text' => __( '&larr; Older posts', 'akyl' ),
				    'next_text' => __( 'Newer posts &rarr;', 'akyl' ),
				) ); 
				?>
				
		</div><!-- end container -->
	</div>
	<!--==== End Msonry Section ====-->

<!-- Show No Results Found Message -->
<?php else : ?>

	<div class="section style-full">
		<div class="container">

			<div class="page-title">
				<!-- Display the title -->
				<h6><?php echo __('Search Results For', 'akyl') . ' : ' . get_search_query(); ?></h6>
			</div> <!-- /page-title -->

			<!-- post content -->
			<div class="row">
				<div class="col-xs-12">
					<div class="post-wrapper">
						<header>
							<h2><?php _e('Nothing Found', 'akyl'); ?></h2>
						</header>

						<div class="post-content">
							<div class="post-main">

								<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'akyl' ); ?></p>

								<?php get_search_form(); ?>

							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>