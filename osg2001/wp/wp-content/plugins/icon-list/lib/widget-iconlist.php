<?php
/**********************************************
* Icon List Widget
**********************************************/

class Kamn_Widget_Iconlist extends WP_Widget {

	/**
	 *  Set up the widget's unique name, ID, class, description, and other options.
	 */
	function __construct() {

		parent::__construct(
			'widget-iconlist-kamn',
			apply_filters( 'icon_list_widget_name', esc_html__( 'Icon List', 'kamn-iconlist') ),
			array(
				'classname'   => 'widget-iconlist-kamn',
				'description' => esc_html__( 'A widget to display list using icons.', 'kamn-iconlist' )
			)
		);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */

	function widget( $args, $instance ) {

		/** Global Data */
		global $post;

		/** Extract Args */
		extract( $args );

		/** Set up the default form values. */
		$defaults = $this->kamn_iconlist_defaults();

		/** Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		/** Open the output of the widget. */
		echo $before_widget;

?>
		<div class="widget-iconlist-global-wrapper">
			<div class="widget-iconlist-container">

				<?php if( !empty( $instance['title'] ) ): ?>
				<div class="widget-iconlist-row">
				  <div class="widget-iconlist-col">
					<?php echo $before_title . '<span>' . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . '</span>' . $after_title; ?>
				  </div>
				</div>
				<?php endif; ?>

	          	<div class="widget-iconlist-row">
		          	<div class="widget-iconlist-col">

						<ul class="widget-iconlist <?php echo $widget_id; ?>">
							<?php foreach( $instance['iconlist_skeleton'] as $val ) : ?>
							<li>
								<span class="iconlist-icon fa fa-fw <?php echo $val['icon']; ?>"></span>
								<?php if ( ! empty( $val['link'] ) ) : ?>
								<a href="<?php echo esc_url( $val['link'] ); ?>">
								<?php endif; ?>
									<span class="iconlist-title"><?php echo $val['title']; ?></span>
								<?php if ( ! empty( $val['link'] ) ) : ?>
								</a>
								<?php endif; ?>
							</li>
							<?php endforeach; ?>
						</ul>

	          		</div>
          		</div>

          	</div> <!-- End .widget-global-wrapper -->
        </div>

<?php

		/** Close the output of the widget. */
		echo $after_widget;

	}

	/** Updates the widget control options for the particular instance of the widget.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {

		/** Default Args */
		$defaults = $this->kamn_iconlist_defaults();

		/** Update Logic */
		$instance = $old_instance;
		foreach( $defaults as $key => $val ) {
			if( $key != 'iconlist_skeleton' ) {
				$instance[$key] = strip_tags( trim( $new_instance[$key] ) );
			}
		}
		$instance['iconlist_skeleton'] = $new_instance['iconlist_skeleton'];
		return $instance;

	}

	/**
	 *
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		/** Set up the default form values. */
		$defaults = $this->kamn_iconlist_defaults();

		/** Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = strip_tags( $instance['title'] );
		$iconlist_number = range( 1, 50 );
?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'kamn-iconlist' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>


		<p><strong><?php esc_html_e( 'Icon List Settings', 'kamn-iconlist' ); ?></strong></p>
		<hr />

		<p>
			<label for="<?php echo $this->get_field_id( 'iconlist_number' ); ?>"><?php esc_html_e( 'Number of icon list to display:', 'kamn-iconlist' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'iconlist_number' ); ?>" name="<?php echo $this->get_field_name( 'iconlist_number' ); ?>">
              <?php foreach ( $iconlist_number as $val ): ?>
			    <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $instance['iconlist_number'], $val ); ?>><?php echo esc_html( $val ); ?></option>
			  <?php endforeach; ?>
            </select>
		</p>

        <?php
		foreach ( $iconlist_number as $val ):
		$title = isset( $instance['iconlist_skeleton'][$val]['title'] )? $instance['iconlist_skeleton'][$val]['title']: '';
		$link  = isset( $instance['iconlist_skeleton'][$val]['link'] )? $instance['iconlist_skeleton'][$val]['link']: '';
		$icon  = isset( $instance['iconlist_skeleton'][$val]['icon'] )? $instance['iconlist_skeleton'][$val]['icon']: '';
		?>

        <p><strong><?php esc_html_e( 'Icon List', 'kamn-iconlist' ); ?> <?php echo $val; ?></strong></p>

        <p>
			<label><?php esc_html_e( 'Title:', 'kamn-iconlist' ); ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'iconlist_skeleton' ); ?>[<?php echo $val; ?>][title]" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label><?php esc_html_e( 'Title Link (if any):', 'kamn-iconlist' ); ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'iconlist_skeleton' ); ?>[<?php echo $val; ?>][link]" value="<?php echo esc_attr( $link ); ?>" />
		</p>

        <p>
			<label><?php esc_html_e( 'Icon Code:', 'kamn-iconlist' ); ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'iconlist_skeleton' ); ?>[<?php echo $val; ?>][icon]" value="<?php echo esc_attr( $icon ); ?>" />
			<small>
				<?php
				printf( '%1$s <code>fa-facebook</code> - <a href="%2$s" target="_blank">%3$s</a>',
					esc_html__( 'For Font Awesome:' ),
					esc_url( kamn_iconlist_external_link( 'fa-icons' ) ),
					esc_html__( 'Choose Font Awesome Icons' )
				)
				?>
			</small><br />
		</p>

        <?php
		if( $val >= $instance['iconlist_number'] ) {
			break;
		}
		endforeach;
		?>

		<hr class="wp-header-end">

		<p>
			<?php
				printf( '<a href="%2$s" class="page-title-action" target="_blank">%1$s</a>',
					esc_html__( 'Get 30% discount on premium WordPress themes', 'kamn-iconlist' ),
					esc_url( add_query_arg( array( 'page' => 'iconlist-options' ), admin_url( 'options-general.php' ) ) )
				);
			?>
		</p>

		<p>
			<?php
				printf( '<a href="%1$s" class="page-title-action" target="_blank">%2$s</a>',
					esc_url( 'https://wordpress.org/support/plugin/icon-list/reviews/' ),
					esc_html__( 'Please rate the plugin at wordpress.org!', 'kamn-iconlist' )
				);
			?>
		</p>

<?php
	}

	/** Set up the default form values. */
	function kamn_iconlist_defaults() {

		$defaults = array(
			'title'             => esc_attr__( 'Icon List', 'kamn-iconlist'),
			'iconlist_number'   => 1,
			'iconlist_skeleton' => array( '1' => array(
				'title' => 'Facebook',
				'link'  => 'https://www.facebook.com/designorbital',
				'icon' => 'fa-facebook' )
				)
		);

		return $defaults;

	}

}
