<?php
/*
# ====================================
# 404.php
#
# The template for displaying 404 pages (not found)
# ====================================
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
						<h2><?php esc_html_e('Oops! That page can\'t be found.', 'akyl'); ?></h2>
					</header>

					<div class="post-content">
						<div class="post-main">

							<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'akyl'); ?></p>

							<div class="row"><?php get_search_form(); ?></div>

						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>