<?php
/**
 * The single post navigation template.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

if ( ! is_singular( 'post' ) ) {
	return;
}
$evolvethemes_key = evolvethemes_theme_key();
$crowley_prev_post = get_previous_post();
$crowley_next_post = get_next_post();

if ( ! empty( $crowley_prev_post ) || ! empty( $crowley_next_post ) ) : ?>
	<?php printf( '<div class="%s-sp-p">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<div class="%s-sp-p_w-i">', esc_attr( $evolvethemes_key ) ); ?>
			<?php
			if ( $crowley_prev_post ) {
				$crowley_prev_post_title     = get_the_title( $crowley_prev_post->ID );
				$crowley_prev_post_permalink = get_permalink( $crowley_prev_post->ID );

				printf(
					'<a href="%s" class="%s-previous-post %s-sp-ni">
						<span class="%s-previous-post-label %s-sp-label">%s</span>
						<span class="%s-sp-title">%s</span>
					</a>',
					esc_url( $crowley_prev_post_permalink ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_html__( 'Previous', 'crowley' ),
					esc_attr( $evolvethemes_key ),
					esc_html( $crowley_prev_post_title )
				);
			}

			if ( $crowley_next_post ) {
				$crowley_next_post_title     = get_the_title( $crowley_next_post->ID );
				$crowley_next_post_permalink = get_permalink( $crowley_next_post->ID );

				printf(
					'<a href="%s" class="%s-next-post %s-sp-ni">
						<span class="%s-next-post-label %s-sp-label">%s</span>
						<span class="%s-sp-title">%s</span>
					</a>',
					esc_url( $crowley_next_post_permalink ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_attr( $evolvethemes_key ),
					esc_html__( 'Next', 'crowley' ),
					esc_attr( $evolvethemes_key ),
					esc_html( $crowley_next_post_title )
				);
			}
			?>
		</div>
	</div>
	<?php
endif;
