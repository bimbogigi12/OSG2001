<?php
/*
# =====================================================================
# content-none.php
#
# Template part for displaying a message that posts cannot be found
# =====================================================================
*/
?>

<?php get_header(); ?>

<div class="section style-full">
	<div class="container">
		<!-- post content -->
		<div class="row">
			<div class="col-xs-12">
				<div class="post-wrapper">
					<header>
						<h2><?php _e( 'Nothing Found', 'akyl' ); ?></h2>
					</header>

					<div class="post-content">
						<div class="post-main">

							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'akyl' ); ?></p>

							 <?php get_search_form(); ?>
							 
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>