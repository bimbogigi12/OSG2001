<?php
/**
 * The comments helpers.
 *
 * @package theme\helpers
 */

/**
 * Output a comment.
 *
 * @param WP_Comment $comment The comment object.
 * @param array      $args An array of arguments.
 * @param integer    $depth Comment depth.
 */
function crowley_comment( $comment, $args, $depth ) {
	$author_tag = '';
	$evolvethemes_key = evolvethemes_theme_key();
	$post = get_post( get_the_ID() );

	if ( $post ) {
		if ( intval( $comment->user_id ) === intval( $post->post_author ) ) {
			$author_tag = sprintf( '<span class="%s-author-tag">%s</span>', esc_attr( $evolvethemes_key ), esc_html__( 'Author', 'crowley' ) );
		}
	}
	?>
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php
			if ( 0 !== $args['avatar_size'] ) {
				echo wp_kses_post( get_avatar( $comment, $args['avatar_size'] ) );
			}

			printf(
				'<b class="fn">%1$s</b> <span class="screen-reader-text">%3$s:</span>%2$s',
				get_comment_author_link(),
				wp_kses_post( $author_tag ),
				esc_html__( 'says', 'crowley' )
			);
			?>
		</div>
		<?php
		if ( '0' === $comment->comment_approved ) {
			?>
			<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'crowley' ); ?></em><br/>
		<?php } ?>
		<div class="comment-metadata">
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
				printf(
					/* Translators: 1: date, 2: time */
					wp_kses_post( __( '%1$s at %2$s', 'crowley' ) ),
					wp_kses_post( get_comment_date() ),
					wp_kses_post( get_comment_time() )
				);
				?>
			</a>
			<?php
				edit_comment_link( __( '(Edit)', 'crowley' ), '  ', '' );
			?>
		</div>

		<div class="comment-content crowley-text" id="div-comment-<?php comment_ID(); ?>">
			<?php comment_text(); ?>
		</div>

		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'callback' => 'crowley_comment',
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		</div>
	<?php
}

/**
 * Check if the comments section should be expanded by default.
 *
 * @since 1.0.0
 * @param array $class The body classes.
 * @return array
 */
function crowley_comments_open_body_class( $class ) {
	$evolvethemes_key = evolvethemes_theme_key();

	if ( isset( $_GET['replytocom'] ) ) {
		$class[] = $evolvethemes_key . '-comments-open';
	}

	return $class;
}

add_filter( 'body_class', 'crowley_comments_open_body_class' );
