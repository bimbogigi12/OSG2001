<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package video
 */

get_header(); ?>
		
	<div id="primary" class="content-area">
		
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>
			
			<div class="postpagination">
				<?php
					the_post_navigation( array(
						'prev_text' => '<span class="prevpost">' . __( 'Previous', 'seos-video' ) . '</span>',
						'next_text' => '<span class="nextpost">' . __( 'Next', 'seos-video' ) . '</span>',
					) );
				?>
			</div>
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop. ?>

		</main><!-- #main -->
		
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
