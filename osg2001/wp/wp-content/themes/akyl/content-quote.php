<?php
/*
# ==============================================
# content-quote.php
#
# Template part for displaying quote post type
# ==============================================
*/
?>

<!-- Start single post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry col-md-4' ); ?>>
	<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-paperclip"></i></span> <?php } ?>
	<div class="post-wrapper">
			
		<div class="thumb-quote">
			<?php
				// Display the quote
				the_content('');
			?>

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
		</div>
	</div>
</article>
<!-- End single post -->