<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package Multipurpose Photography
 */
?>

<header>
	<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'multipurpose-photography' ); ?></h1>
</header>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'multipurpose-photography' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'multipurpose-photography' ); ?></p><br />
		<?php get_search_form(); ?>
<?php else : ?>
	<p><?php esc_html_e( 'Dont worry it happens to the best of us.', 'multipurpose-photography' ); ?></p><br />
	<div class="read-moresec">
		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_html_e( 'Return to the home page', 'multipurpose-photography' ); ?></a>
	</div>
<?php endif; ?>