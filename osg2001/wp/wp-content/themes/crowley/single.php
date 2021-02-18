<?php
/**
 * The single template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

get_header(); ?>

<?php
	/**
	 * Function that is entitled to display the page content.
	 *
	 * Eg. add_action( 'evolvethemes_page_content', 'your_custom_function' );
	 */
	evolvethemes_page_content();
?>

<?php
get_footer();
