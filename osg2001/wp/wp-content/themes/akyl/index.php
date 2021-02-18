<?php
/*
# ====================================
# index.php
#
# The main template file
# ====================================
*/
?>

<?php get_header(); ?>

<!--==== Start Blog Section ====-->
<div class="section" id="blog-grid">
	<div class="container-fluid">
		<div class="row blog-masonry" id="blog-masonry">
			<?php 
			if ( have_posts() ) : 

				/* Start the loop. */
				while ( have_posts() ) : the_post(); 

					/* Include the Post-Format-specific template for the content. */
					get_template_part( 'content', get_post_format() );

				endwhile;

			else :

				get_template_part( 'content', 'none' );

			endif;
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
<!--==== End Blog Section ====-->

<?php get_footer(); ?>