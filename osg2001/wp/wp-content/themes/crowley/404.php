<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
