<div class="wrap kamn-iconlist-admin-wrapper">
	<h1><?php printf( '%1$s', esc_html__( 'Icon List Settings', 'kamn-iconlist' ) ); ?></h1>

	<div class="settings-container">
		<div class="settings-col settings-col-options">
			<div class="options-wrapper">

				<form action="options.php" method="post" class="form-options-wrapper">

					<?php settings_fields( 'kamn_iconlist_options_group' ); ?>

					<h2 class="nav-tab-wrapper">
						<a class="nav-tab nav-tab-active" id="fonts-tab" href="#top#fonts"><?php esc_html_e( 'Fonts', 'kamn-iconlist' ); ?></a>
						<a class="nav-tab" id="general-tab" href="#top#general"><?php esc_html_e( 'General', 'kamn-iconlist' ); ?></a>
					</h2>

					<section id="fonts" class="nav-tab-section">
						<?php do_settings_sections( 'kamn_iconlist_section_fonts_page' ); ?>
					</section>

					<section id="general" class="nav-tab-section">
						<?php do_settings_sections( 'kamn_iconlist_section_general_page' ); ?>
					</section>

					<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'kamn-iconlist' ); ?>">
				</form>

			</div><!-- .options-wrapper -->
		</div><!-- .settings-col -->

		<div class="settings-col settings-col-info">
			<div class="info-wrapper">

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Get 30% Discount', 'kamn-iconlist' ); ?></h2>
								<?php
									printf( '<p>%1$s</p> <p><code>%2$s</code></p> <p><a href="%3$s" class="button button-primary" target="_blank">%4$s</a></p> <p><a href="%5$s" class="button" target="_blank">%6$s</a></p>',
										esc_html__( 'Get 30% discount on DesignOrbital premium WordPress themes by using the following discount code.', 'kamn-iconlist' ),
										esc_html__( 'ICONLIST30', 'kamn-iconlist' ),
										esc_url( 'https://designorbital.market/?utm_source=wporg-iconlist&utm_medium=button&utm_campaign=designorbital' ),
										esc_html__( 'Premium WordPress Themes', 'kamn-iconlist' ),
										esc_url( 'https://designorbital.com/free-wordpress-themes/?utm_source=wporg-iconlist&utm_medium=button&utm_campaign=designorbital' ),
										esc_html__( 'Free WordPress Themes', 'kamn-iconlist' )
									);
								?>
						</div>
					</div>

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Rate the Plugin', 'kamn-iconlist' ); ?></h2>
								<?php
									printf( '<p>%1$s</p> <p><a href="%2$s" target="_blank">%3$s</a></p>',
										esc_html__( 'Do you like the plugin?', 'kamn-iconlist' ),
										esc_url( 'https://wordpress.org/support/plugin/icon-list/reviews/' ),
										esc_html__( 'Please rate it at wordpress.org!', 'kamn-iconlist' )
									);
								?>
						</div>
					</div>

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Support Us', 'kamn-iconlist' ); ?></h2>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
									<input type="hidden" name="cmd" value="_s-xclick">
									<input type="hidden" name="hosted_button_id" value="Z3LBGSQDYRCWA">
									<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
						</div>
					</div>

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Follow Us', 'kamn-iconlist' ); ?></h2>
								<p>
									<a href="https://www.facebook.com/designorbital" class="button" target="_blank"><?php echo esc_html__( 'Like Us On Facebook', 'do-etfw' ); ?></a>
								</p>
								<p>
									<a href="https://twitter.com/designorbital" class="button" target="_blank"><?php echo esc_html__( 'Follow On Twitter', 'do-etfw' ); ?></a>
								</p>
						</div>
					</div>

			</div><!-- .info-wrapper -->
		</div><!-- .settings-col -->
	</div><!-- .settings-container -->

</div><!-- .kamn-iconlist-admin-wrapper -->
