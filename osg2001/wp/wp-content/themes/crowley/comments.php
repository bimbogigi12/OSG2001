<?php
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$evolvethemes_comments_class = '';

if ( ! isset( $_GET['replytocom'] ) ) {
	$evolvethemes_comments_class = 'crowley-comments-hidden';
}

?>

<?php if ( have_comments() || comments_open() ) : ?>
	<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-c-trigger">
		<a href="#comments">
			<?php
			if ( have_comments() ) {
				esc_html_e( 'Show comments', 'crowley' );
			} else {
				esc_html_e( 'Start the discussion', 'crowley' );
			}
			?>
		</a>
	</p>
<?php endif; ?>

<div id="comments" class="<?php echo esc_attr( $evolvethemes_comments_class ); ?>">
	<?php if ( have_comments() ) : ?>
		<h2 class="<?php echo esc_attr( $evolvethemes_key ); ?>-c-t">
			<?php
			if ( comments_open() ) {
				esc_html_e( 'Join the discussion', 'crowley' );
			} else {
				esc_html_e( 'Read the discussion', 'crowley' );
			}
			?>
		</h2>
		<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-c-st">
			<?php
				$evolvethemes_comments_number = get_comments_number();
			if ( '1' === $evolvethemes_comments_number ) {
				/* translators: %s: post title */
				printf( esc_html( _x( 'One reply to &ldquo;%s&rdquo;', 'comments title', 'crowley' ) ), get_the_title() );
			} else {
				printf(
					esc_html(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s reply to &ldquo;%2$s&rdquo;',
							'%1$s replies to &ldquo;%2$s&rdquo;',
							$evolvethemes_comments_number,
							'comments title',
							'crowley'
						)
					),
					esc_html( number_format_i18n( $evolvethemes_comments_number ) ),
					get_the_title()
				);
			}
			?>
		</p>

		<ol class="<?php echo esc_attr( $evolvethemes_key ); ?>-c-cl">
			<?php
				wp_list_comments(
					array(
						'callback' => 'crowley_comment',
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 60,
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'crowley' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'crowley' ) . '</span>',
			)
		);
		?>

	<?php endif; // have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-c-cc"><?php esc_html_e( 'Comments are closed.', 'crowley' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'submit_button' => '<button name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
		)
	);
	?>

</div><!-- #comments -->
