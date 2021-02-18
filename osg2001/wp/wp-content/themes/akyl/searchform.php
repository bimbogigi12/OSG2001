<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="col-md-8 col-sm-8 col-xs-12">
		<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search...', 'akyl'); ?>" name="s" />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<button type="submit" class="btn btn-blue"><?php _e( 'Search', 'akyl' ); ?></button>
	</div>
</form>

<div class="clearfix"></div>