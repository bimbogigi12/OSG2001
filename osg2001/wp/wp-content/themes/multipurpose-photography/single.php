<?php
/**
 * The Template for displaying all single posts.
 * @package Multipurpose Photography
 */

get_header(); ?>

<div class="container">
    <div class="main-wrap-box">
    	<?php
	    $left_right = get_theme_mod( 'multipurpose_photography_layout','Right Sidebar');
	    if($left_right == 'Right Sidebar'){ ?>
		    <div class="row">
				<div class="col-lg-9 col-md-9" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 

						get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>
				<div class="col-lg-3 col-md-3"><?php get_sidebar();?></div>
			</div>
		<?php }else if($left_right == 'Left Sidebar'){ ?>
			<div class="row">
				<div class="col-lg-3 col-md-3"><?php get_sidebar();?></div>
				<div class="col-lg-9 col-md-9" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 
						
						get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>	     
		    </div>  	
		<?php }else if($left_right == 'One Column'){ ?>
			<div id="wrapper">
	            <div class="bradcrumbs">
	                <?php multipurpose_photography_the_breadcrumb(); ?>
	            </div>
				<?php while ( have_posts() ) : the_post(); 
						
						get_template_part( 'template-parts/single-post');

	            endwhile; // end of the loop. 
	            wp_reset_postdata();?>
	       	</div>
	    <?php }else if($left_right == 'Three Columns'){ ?>
		    <div class="row">
		        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
				<div class="col-lg-6 col-md-6" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 
						
						get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>
	       		<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
		    </div>
	    <?php }else if($left_right == 'Four Columns'){ ?>
		    <div class="row">
		        <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
				<div class="col-lg-3 col-md-3" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 
						
						get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>
		       	<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
		       	<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3');?></div>
		    </div>
	    <?php }else if($left_right == 'Grid Layout'){ ?>
		    <div class="row">
		    	<div class="col-lg-4 col-md-4"><?php get_sidebar();?></div>
				<div class="col-lg-8 col-md-8" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 
							
							get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>
		    </div>
		<?php }else {?>
			<div class="row">
				<div class="col-lg-9 col-md-9" id="wrapper">
		            <div class="bradcrumbs">
		                <?php multipurpose_photography_the_breadcrumb(); ?>
		            </div>
					<?php while ( have_posts() ) : the_post(); 

						get_template_part( 'template-parts/single-post');

		            endwhile; // end of the loop. 
		            wp_reset_postdata();?>
		       	</div>
				<div class="col-lg-3 col-md-3"><?php get_sidebar();?></div>
			</div>
	    <?php }?>
        <div class="clearfix"></div>
    </div>
</div>
<?php get_footer(); ?>