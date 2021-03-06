<!-- start content container -->
<div class="row">
		<article class="col-md-<?php balanced_blog_main_content_width_columns(); ?>">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                          
					<div <?php post_class(); ?>>
						<div class="single-wrap col-md-12">
							<?php balanced_blog_thumb_img( 'balanced-blog-single' ); ?>
							<div class="main-content-page">
								<header>                              
									<?php the_title( '<h1 class="single-title">', '</h1>' ); ?>
									<time class="posted-on published" datetime="<?php the_time( 'Y-m-d' ); ?>"></time>                                                        
								</header>                            
								<div class="entry-content">                              
									<?php do_action( 'head_theme_before_content' ); ?>
    							<?php the_content(); ?>
    							<?php do_action( 'head_theme_after_content' ); ?>
								</div>
								<?php wp_link_pages(); ?>
							</div>
						</div>
						<div class="single-footer">
							<?php comments_template(); ?>
						</div>	
					</div>        
				<?php endwhile; ?>        
			<?php else : ?>            
				<?php get_template_part( 'content', 'none' ); ?>        
			<?php endif; ?>    
		</article>       
		<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
