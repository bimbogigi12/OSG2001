<?php
/**
 * The template part for header
 *
 * @package VW Education Academy 
 * @subpackage vw_education_academy
 * @since VW Education Academy 1.0
 */
?>

<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-education-academy'); ?></a></div>
<div id="header" class="menubar">
	<div class="nav">
		<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
	</div>
</div>