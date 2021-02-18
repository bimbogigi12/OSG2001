<?php
/*
# ====================================
# header.php
#
# The theme header
# ====================================
*/
?> 
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<!--===== Header Area =====-->
	<header class="site-header">
		<div class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php 
				if ( get_theme_mod( 'custom_logo' ) !='' ) {
					$site_icon = esc_url( get_site_icon_url(32) );
					$site_icon = get_theme_mod( 'custom_logo' );
					the_custom_logo();
				}else{
					echo '<span class="first-letter">' . mb_substr( get_bloginfo('name'), 0, 1 ) . '</span>';
				}
				?>
			</a>
		</div>

		<!-- Navigation -->
		<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
			<nav class="navbar custom-navbar navbar-fixed-top">
				<div class="main-menu">
					<div class="nav-toggle">
						<button class="toggle-btn">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse in">
						<ul class="nav navbar-nav nav-social">
							<?php 
								$links = akyl_load_social_links();
								foreach ( $links as $link ) {
									echo '<li>' . $link . '</li>' ;
								}
							?>
						</ul>
						<?php
						wp_nav_menu( array( 
						 	'theme_location' => 'main-menu',
						 	'menu_class' => 'nav navbar-nav nav-menu',
						 	'container' => ''
						));
						?>
					</div>
				</div>
			</nav>
		<?php endif; ?>

		<!-- Header Banner -->
		<div class="section banner" style="background-image: url('<?php echo esc_url(header_image()) ?>');">
			<div class="display-table">
				<div class="display-table-cell">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="text-center">
									<?php if ( is_front_page() && is_home() ) : ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php endif;
									$tagline = get_bloginfo( 'description', 'display' );
									if ( $tagline || is_customize_preview() ) : ?>
										<p class="site-tagline"><?php echo $tagline; ?></p>
									<?php
									endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!--===== End Header Area ======-->

	<!-- background overlay -->
	<div class="bg-overlay"></div>
