<?php
/**
 * The comments theme block.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();

// If comments are open or we have at least one comment, load up the comment template.
if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
	printf( '<div class="%s-mc-comments">', esc_attr( $evolvethemes_key ) );
		printf( '<div class="%s-mc-comments_wi">', esc_attr( $evolvethemes_key ) );
			comments_template();
		echo '</div>';
	echo '</div>';
endif;
