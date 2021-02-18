<?php if( ! defined( 'ABSPATH' ) ) exit;

	function seos_football_social_section () { ?>

		<div class="social">

			<div class="fa-icons">
			
				<?php if (get_theme_mod( 'seos_football_facebook' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' )) == "_blank"){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_facebook' )); ?>"><i class="fa fa-facebook-f"></i></a>
				<?php endif; ?>
							
				<?php if (get_theme_mod( 'seos_football_twitter' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_twitter' )) ?>"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
											
				<?php if (get_theme_mod( 'seos_football_google' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_google' )); ?>"><i class="fa fa-google-plus"></i></a>
				<?php endif; ?>
															
				<?php if (get_theme_mod( 'seos_football_youtube' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_youtube' )); ?>"><i class="fa fa-youtube"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_football_vimeo' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_vimeo' )); ?>"><i class="fa fa-vimeo"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_football_pinterest' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_pinterest' )); ?>"><i class="fa fa-pinterest"></i></a>
				<?php endif; ?>	
				
				<?php if (get_theme_mod( 'seos_football_instagram' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_instagram' )); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_football_linkedin' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_linkedin' )); ?>"><i class="fa fa-linkedin"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_football_rss' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_rss' )); ?>"><i class="fa fa-rss"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_football_stumbleupon' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_stumbleupon' )); ?>"><i class="fa fa-stumbleupon"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_kirki_social_10' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_kirki_social_10' )); ?>"><i class="fa fa-flickr" aria-hidden="true"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_dribbble' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_dribbble' )); ?>"><i class="fa fa-dribbble"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_digg' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_digg' )); ?>"><i class="fa fa-digg"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_skype' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_skype' )); ?>"><i class="fa fa-skype"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_deviantart' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_deviantart' )); ?>"><i class="fa fa-deviantart"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_yahoo' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_yahoo' )); ?>"><i class="fa fa-yahoo"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_reddit_alien' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_reddit_alien' )); ?>"><i class="fa fa-reddit-alien"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_paypal' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_paypal' )); ?>"><i class="fa fa-paypal"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_dropbox' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_dropbox' )); ?>"><i class="fa fa-dropbox"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_soundcloud' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_soundcloud' )); ?>"><i class="fa fa-soundcloud"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_vk' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_vk' )); ?>"><i class="fa fa-vk"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_envelope' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_envelope' )); ?>"><i class="fa fa-envelope"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_book' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_book' )); ?>"><i class="fa fa-address-book" aria-hidden="true"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_apple' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_apple' )); ?>"><i class="fa fa-apple"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_amazon' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_amazon' )); ?>"><i class="fa fa-amazon"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_slack' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_slack' )); ?>"><i class="fa fa-slack"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_slideshare' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_slideshare' )); ?>"><i class="fa fa-slideshare"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_wikipedia' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_wikipedia' )); ?>"><i class="fa fa-wikipedia-w"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_wordpress' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_wordpress' )); ?>"><i class="fa fa-wordpress"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_football_address_odnoklassniki' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_odnoklassniki' )); ?>"><i class="fa fa-odnoklassniki"></i></a>
				<?php endif; ?>
																											
				<?php if (get_theme_mod( 'seos_football_address_tumblr' )) : ?>
					<a target="<?php if(esc_attr(get_theme_mod( 'seos_football_social_link_type' ))){echo esc_attr(get_theme_mod( 'seos_football_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_url(get_theme_mod( 'seos_football_address_tumblr' )); ?>"><i class="fa fa-tumblr"></i></a>
				<?php endif; ?>
				
			</div>
	
	<div class="soc-right">
	<?php if (get_theme_mod('social_media_contacts_address')) { ?><span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo get_theme_mod('social_media_contacts_address'); ?></span><?php } ?>
	<?php if (get_theme_mod('social_media_contacts_phone')) { ?><span><i class="fa fa-volume-control-phone" aria-hidden="true"></i> <?php echo get_theme_mod('social_media_contacts_phone'); ?></span><?php } ?>
	
	</div>
		</div>
		
<?php }  ?>