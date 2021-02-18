<?php
/*
# ===============================================
# content-gallery.php
#
# Template part for displaying gallery post type
# ===============================================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry col-md-4' ); ?>>
	<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-paperclip"></i></span> <?php } ?>
	<div class="post-wrapper">

		<div class="post-thumb flexslider-thumb">

			<a class="text-center" href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php the_title_attribute(); ?>" >
				
				<?php if ( has_post_thumbnail() ) : ?>

					<?php the_post_thumbnail( 'akyl-thumbnail' ); ?>

				<?php else : ?>

					<div class="flexslider">
						<ul class="slides">

							<?php

							$gallery_images = get_post_gallery_images( $post ); 

							foreach ( $gallery_images as $img ) :

							    echo '<li><img src="' . $img . '" /></li>';
							
							endforeach; 

							?>

						</ul>
					</div>
					
				<?php endif; ?>

			</a>

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
				<div class="post-meta-2 tags">
					<?php akyl_post_meta( 'category' ); ?>
				</div>

				<div class="post-excerpt">
					<?php 
						$content = $post->post_content;
						$pos = strpos($content, '<!--more-->');
						if ( $pos ) {
							the_content('');
						}else{
							the_excerpt();
						}
					?>
				</div>

				<div class="read-more">
					<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'akyl' ); ?> <i class="fa fa-long-arrow-right"></i></a>
				</div>

			</div>
		</div>
	</div>
</article>