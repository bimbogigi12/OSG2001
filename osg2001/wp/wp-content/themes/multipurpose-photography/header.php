<?php
/**
 * The Header for our theme.
 * @package Multipurpose Photography
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'multipurpose-photography' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="top-bar">
  	<div class="container">
	    <div class="row">
	      	<div class="col-lg-4 col-md-4">
		        <div class="call">
		          	<?php if ( get_theme_mod('multipurpose_photography_call','') != "" ) {?>
		            	<span><i class="fas fa-phone-volume"></i><?php echo esc_html(get_theme_mod('multipurpose_photography_call','')); ?></span>
		          	<?php }?>
		        </div>
	      	</div>
	      	<div class="col-lg-4 col-md-4">
		        <div class="logo">
		          	<?php if( has_custom_logo() ){ multipurpose_photography_the_custom_logo();
		           		}else{ ?>
		          	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		          	<?php $description = get_bloginfo( 'description', 'display' );
		         		if ( $description || is_customize_preview() ) : ?> 
		            	<p class="site-description"><?php echo esc_html($description); ?></p>
		          	<?php endif; }?>
		        </div>
	      	</div>
	      	<div class="col-lg-4 col-md-4">
		        <div class="social-icon">
		          	<?php if( get_theme_mod( 'multipurpose_photography_facebook_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_facebook_url','' ) ); ?>"><i class="flaticon-facebook" aria-hidden="true"></i></a>
		          	<?php } ?>
		          	<?php if( get_theme_mod( 'multipurpose_photography_twitter_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_twitter_url','' ) ); ?>"><i class="flaticon-twitter"></i></a>
		          	<?php } ?>
		          	<?php if( get_theme_mod( 'multipurpose_photography_insta_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_insta_url','' ) ); ?>"><i class="flaticon-instagram"></i></a>
		          	<?php } ?>
		          	<?php if( get_theme_mod( 'multipurpose_photography_youtube_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_youtube_url','' ) ); ?>"><i class="fab flaticon-follow"></i></a>
		          	<?php } ?>
		          	<?php if( get_theme_mod( 'multipurpose_photography_linkedin_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_linkedin_url','' ) ); ?>"><i class="flaticon-linkedin"></i></a>
		         	<?php } ?> 
		          	<?php if( get_theme_mod( 'multipurpose_photography_pinterest_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_pinterest_url','' ) ); ?>"><i class="flaticon-pinterest"></i></a>
		          	<?php } ?> 
		          	<?php if( get_theme_mod( 'multipurpose_photography_tumblr_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_tumblr_url','' ) ); ?>"><i class="flaticon-tumblr"></i></a>
		         	<?php } ?> 
		          	<?php if( get_theme_mod( 'multipurpose_photography_google_url') != '') { ?>
		            	<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_google_url','' ) ); ?>"><i class="flaticon-follow-1"></i></a>
		          	<?php } ?> 
		          	<?php if( get_theme_mod( 'multipurpose_photography_rss_url') != '') { ?>
		           		<a href="<?php echo esc_url( get_theme_mod( 'multipurpose_photography_rss_url','' ) ); ?>"><i class="flaticon-follow-me"></i></a>
		          	<?php } ?> 
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
<div class="toggle">
	<a class="toggleMenu" href="#"><?php esc_html_e('Menu','multipurpose-photography'); ?></a>
</div>
<?php get_template_part( 'template-parts/header/navigation' ); ?> 