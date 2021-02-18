<?php
/*
# ==============================================
# content-video.php
#
# Template part for displaying video post type
# ==============================================
*/
?>

<!-- Start single post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry col-md-4' ); ?>>
	<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-paperclip"></i></span> <?php } ?>
	<div class="post-wrapper">
		
		<?php
			$content = apply_filters( 'the_content', get_the_content() );
			$media = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );

			if ( ! empty($media) ) {
				printf( '<div class="thumb-video">%s</div>', $media[0] );
			}
		?>

		<div class="post-content">
			<div class="nothumb">
				<div class="post-meta-1">
					<?php akyl_post_meta( 'date' ); ?>
					<?php akyl_post_meta( 'comment' ); ?>
					<div class="clearfix"></div>
				</div>
			</div>
			<header>
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
				</h2>
			</header>
			<div class="post-main">
			
				<div class="post-meta-2 tags"></div>

				<div class="post-excerpt">
					<?php 
						the_excerpt();
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