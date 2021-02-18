<?php
/**
 * Template of a single post in a loop.
 *
 * This template can be used by loop pages such as the index page, or archives.
 *
 * @package WordPress
 * @subpackage Crowley
 * @since 1.0.0
 */

$evolvethemes_query = null;

if ( ! isset( $query ) ) {
	global $wp_query;

	$evolvethemes_query = $wp_query;
} else {
	$evolvethemes_query = $query;
}

$evolvethemes_key = evolvethemes_theme_key();

/* Custom post classes. */
$evolvethemes_post_classes = apply_filters( 'crowley_loop_post_classes', array(), $evolvethemes_query );

/* Meta order. */
$evolvethemes_meta_order = apply_filters(
	'crowley_loop_post_meta_order',
	array(
		'category',
		'title',
		'date',
	)
);

$crowley_entry_thumbnail = get_post_thumbnail_id();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $evolvethemes_post_classes ); ?>>
	<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-w">

		<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-w_i">
			<?php if ( ! crowley_loop_first_entry( $query ) ) : ?>
				<?php if ( ! empty( $crowley_entry_thumbnail ) ) : ?>
					<a class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-i" href="<?php the_permalink(); ?>" rel="bookmark">
						<?php evolvethemes_get_image( get_post_thumbnail_id(), array( 'echo' => true ) ); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>

			<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-h_w">
				<?php if ( ! empty( $evolvethemes_meta_order ) ) : ?>
					<header>
						<?php
						foreach ( $evolvethemes_meta_order as $evolvethemes_meta ) {
							switch ( $evolvethemes_meta ) {
								case 'title':
									?>
										<h2 <?php evolvethemes_entry_title_attrs(); ?>>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<?php echo wp_kses_post( evolvethemes_get_entry_title() ); ?>
											</a>
										</h2>
										<?php
									break;
								case 'category':
									?>
										<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-bt">
											<?php evolvethemes_post_categories(); ?>
										</div>
										<?php
									break;
								case 'date':
									?>
										<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-bt">
											<?php evolvethemes_entry_date(); ?>
										</div>
										<?php
									break;
								case 'author':
									?>
										<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-bt">
											<?php evolvethemes_entry_author(); ?>
										</div>
										<?php
									break;
							}
						}
						?>
					</header>
				<?php endif; ?>
			</div>

			<?php if ( crowley_loop_first_entry( $query ) ) : ?>
				<?php if ( ! empty( $crowley_entry_thumbnail ) ) : ?>
					<a class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-i" href="<?php the_permalink(); ?>" rel="bookmark">
						<?php evolvethemes_get_image( get_post_thumbnail_id(), array( 'echo' => true ) ); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( crowley_loop_first_entry( $query ) ) : ?>
				<div class="<?php echo esc_attr( $evolvethemes_key ); ?>-e-c_w">
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>

					<?php printf( '<a class="%s-e-read-more" href="%s" rel="bookmark">%s</a>', esc_attr( $evolvethemes_key ), esc_attr( get_the_permalink() ), esc_html__( 'Continue reading', 'crowley' ) ); ?>
				</div>
			<?php endif; ?>

		</div>

	</div>

</article>
