<?php
/*
# =============================================
# comments.php
#
# The template file for displaying comments
# =============================================
*/

if ( post_password_required() ) {
	return;
}
?>
<div class="row">
	<div class="post-comments">	
		
		<?php if ( have_comments() ) : ?>
			<div id="comments" class="comments-area">
				<div class="comment-title-wrapper">
					<h4 class="comments-title alignleft">
						<?php 	
							printf( _nx( '%s Comment', '%s Comments', get_comments_number(), 'comments title', 'akyl' ), 
								number_format_i18n( get_comments_number() ) );
						?>
					</h4>

					<?php if ( comments_open() ) : ?>
					
						<h5 class="add-comment-title alignright"><a href="#respond"><?php esc_html_e('Add yours', 'akyl') . ' &rarr;'; ?></a></h5>
					
					<?php endif; ?>

					<div class="clearfix"></div>
				</div>
				
				<!-- comment navigation -->
				<?php 
				the_comments_navigation( array(
					'prev_text' => '&larr;  ' . __('Older comments', 'akyl'),
					'next_text' => __('Newer comments', 'akyl') . ' &rarr;'
				) )
				?>
				
				<ul class="comment-list">
					<?php
						wp_list_comments( array(
							'type'      => 'comment',
							'callback'  => 'akyl_comment',
						) );
					?>
				</ul><!-- .comment-list -->
				
				<?php if (!empty($comments_by_type['pingback'])) : ?>
				
					<div class="pingbacks">
					
						<div class="pingbacks-inner">
					
							<h3 class="pingbacks-title">
							
								<?php 

									$pingback_count = count($wp_query->comments_by_type['pingback']);
									echo $pingback_count . ' ';
									echo _n( 'Pingback', 'Pingbacks', $pingback_count, 'akyl' ); 
								
								?>
							
							</h3>
						
							<ul class="comment-list pingbacklist">
							    <?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'akyl_comment' ) ); ?>
							</ul>
							
						</div>
						
					</div>
				
				<?php endif; ?>

				<!-- comment navigation -->
				<?php 
				the_comments_navigation( array(
					'prev_text' => '&larr;  ' . __('Older comments', 'akyl'),
					'next_text' => __('Newer comments', 'akyl') . ' &rarr;'
				) )
				?>
			</div><!-- #comments -->
		<?php endif; ?>
		
		<?php if ( ! comments_open() && !is_page() ) : ?>
		
			<p class="nocomments"><?php _e( 'Comments are closed.', 'akyl' ); ?></p>
			
		<?php endif; ?>

		<?php $comments_args = array(
			'class_submit' => 'btn btn-blue',

			'comment_notes_before' => 
				'<p class="comment-notes">' . __( 'Your email address will not be published.', 'akyl' ) . '</p>',

			'comment_field' => 
				'<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="6" required>' . '</textarea></p>',
			
			'fields' => apply_filters( 'comment_form_default_fields', array(
			
				'author' =>
					'<p class="comment-form-author">' .
					'<input id="author" name="author" type="text" placeholder="' . __('Name','akyl') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />' . '<label for="author">Author</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
				
				'email' =>
					'<p class="comment-form-email">' . '<input id="email" name="email" type="text" placeholder="' . __('Email','akyl') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /><label for="email">Email</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
				
				'url' =>
				'<p class="comment-form-url">' . '<input id="url" name="url" type="text" placeholder="' . __('Website','akyl') . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><label for="url">Website</label></p>')

			
			),
		);
		comment_form($comments_args); ?>

	</div>
</div>