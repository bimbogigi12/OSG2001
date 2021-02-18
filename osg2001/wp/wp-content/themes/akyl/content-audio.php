<?php
/*
# ====================================================
# content-audio.php
#
# The default template for displaying audio post type
# ====================================================
*/
?>

<!-- Start single post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry col-md-4' ); ?>>
	<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-paperclip"></i></span> <?php } ?>
	<div class="post-wrapper">
			
			<?php if ( has_post_thumbnail() ) : ?>

				<div class="post-thumb">
					<a class="text-center" href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail( 'akyl-thumbnail' ); ?>
					</a>

			<?php else: ?>

				<div class="post-thumb nothumb">

			<?php endif; ?>

					<div class="post-meta-1">
						<?php akyl_post_meta( 'date' ); ?>
						<?php akyl_post_meta( 'comment' ); ?>
						<div class="clearfix"></div>
					</div>

				</div>
		
		<div class="post-content">
			<header>
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
				</h2>
			</header>
			<div class="post-main">
			
				<div class="post-meta-2 tags"></div>

				<div class="post-excerpt">
					<?php 
						the_content('');
					?>
				</div>

				<div class="read-more">
					<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'akyl' ); ?> <i class="fa fa-long-arrow-right"></i></a>
				</div>

			</div>
		</div>
	</div>
</article>
<!-- End single post -->