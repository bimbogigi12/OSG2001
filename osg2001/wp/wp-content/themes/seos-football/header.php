<?php
/**
 * The Header template
 */ 
 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php endif; ?>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seos-football' ); ?></a>
	<?php if (esc_attr(get_theme_mod( 'social_media_activate_header' ))) { seos_football_social_section (); } ?>

	<div class="nav-center">
	
	<?php if (get_theme_mod( 'search_activate_header' )) { ?><div class="seos-top-serach"><?php echo get_search_form('search-form'); ?></div><?php } ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					
			<a href="#" id="menu-icon">	
				<span class="menu-button"> </span>
				<span class="menu-button"> </span>
				<span class="menu-button"> </span>
			</a>	

			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		
	</div>				
	<header id="masthead" class="site-header" role="banner">				

	
<!---------------- Deactivate Header Image ---------------->	
		
		<?php if (get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
<!---------------- All Pages Header Image ---------------->		
	
		<?php if ( get_theme_mod('custom_header_position') == "all" ) : ?>
		
		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	
		
			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				<div class="dotted">
			<?php } ?>

			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInDown"><p class="site-title"><?php the_custom_logo(); ?></p></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview" data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview" data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
				
			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				</div>
			<?php } ?>
			
		</div>
		
		<?php endif;  ?>
		
<!---------------- Home Page Header Image ---------------->
		
		<?php if ( ( is_front_page() || is_home() ) and get_theme_mod('custom_header_position') == "home" ) { ?>

		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	

			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				<div class="dotted">
			<?php } ?>					

			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInDown"><p class="site-title"><?php the_custom_logo(); ?></p></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview" data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview" data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
						
				
			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				</div>
			<?php } ?>					
		</div>
		
	<?php } 

	} ?> 

<!---------------- Default Header Image ---------------->

		<?php if ( get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
		<?php if ( get_theme_mod('custom_header_position') != "all") { ?>

		<?php if ( get_theme_mod('custom_header_position') != "home" ) { ?>

		<div class="header-img" style="background-image: url('<?php echo esc_url(get_template_directory_uri()). "/framework/images/athletes.jpg"; ?>');">	

			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				<div class="dotted">
			<?php } ?>	
			
			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title aniview"  data-av-animation="bounceInDown"><?php the_custom_logo(); ?></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview"  data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title aniview"  data-av-animation="bounceInDown"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview"  data-av-animation="bounceInUp"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
			<?php if ( get_theme_mod('custom_header_overlay') != "off" ) { ?>
				</div>
			<?php } ?>	
							
		</div>
		
		<?php } } } ?>

	</header><!-- #masthead -->
				
	<div class="clear"></div>
	
	<div id="content" class="site-content">