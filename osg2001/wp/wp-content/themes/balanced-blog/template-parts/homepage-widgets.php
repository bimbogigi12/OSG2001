<?php if ( is_active_sidebar( 'balanced-blog-homepage-area' ) ) { ?>
	<div class="homepage-widget-area"> 
		<?php
		dynamic_sidebar( 'balanced-blog-homepage-area' );
		?>
	</div>
<?php
}
