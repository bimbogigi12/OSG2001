<?php
/**
 * Search form template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

global $crowley_searchform_index;

$crowley_searchform_index = (int) $crowley_searchform_index;
$crowley_searchform_index++;

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<label class="screen-reader-text" for="search-<?php echo esc_attr( $crowley_searchform_index ); ?>"><?php esc_html_e( 'Search for:', 'crowley' ); ?></label>
		<input type="text" value="" id="search-<?php echo esc_attr( $crowley_searchform_index ); ?>" name="s" class="s" placeholder="<?php esc_attr_e( 'Search&#8230;', 'crowley' ); ?>">
		<button type="submit" class="searchsubmit" value="<?php esc_attr_e( 'Search', 'crowley' ); ?>"></button>
	</div>
</form>
