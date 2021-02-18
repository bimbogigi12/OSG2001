<?php

/*
Plugin Name: Il Meteo
Plugin URI: http://imeteo.wordpress.com
Description: il plugin aggiunge un widget con le previsioni meteo della localit&agrave; selezionata
Author: ilmeteo.it
Version: 0.1
Author URI: http://www.ilmeteo.it
*/


function widget_ilmeteo_init()
{
	if ( !function_exists('register_sidebar_widget') )
		return;


	function widget_ilmeteo($args) {
		global $wpdb;
		global $wpdb_query;
		global $wp_rewrite;
		extract($args);


		$options = get_option('widget_ilmeteo');
		//title
		$title= $options['title'];
		//lid
		$location = urlencode($options['location']);
		//id-cliente
		$client = urlencode($options['client']);


		$iframe_width = '190';
		$iframe_height = '240';

		echo $before_widget;
		echo $before_title; echo $title; echo $after_title;
		$site_base = get_bloginfo('url');


		echo <<<EOD
<iframe width="{$iframe_width}" height="{$iframe_height}" scrolling="no" frameborder="no" noresize="noresize"
allowtransparency="true"
src="http://www.ilmeteo.it/script/meteo.php?id={$client}&citta={$location}"></iframe>
EOD;

		echo $after_widget;
	}

	function widget_ilmeteo_control ()
	{
			$options = get_option('widget_ilmeteo');
			if ( !is_array($options) )
				$options = array(
				'title' => 'Previsioni Meteo',
				'location' => '4074',
				'client' => 'wordpress',
			);

			if ( $_POST['ilmeteo-submit'] )
			{

				// Remember to sanitize and format use input appropriately.
				$options['title'] = strip_tags(stripslashes($_POST['ilmeteo-title']));
				$options['location'] = strip_tags(stripslashes($_POST['ilmeteo-location']));
				$options['client'] = strip_tags(stripslashes($_POST['ilmeteo-client']));

				update_option('widget_ilmeteo', $options);
			}

			$title = htmlspecialchars($options['title'], ENT_QUOTES);
			$location = htmlspecialchars($options['location'], ENT_QUOTES);
			$client = htmlspecialchars($options['client'], ENT_QUOTES);


			echo '<p style="text-align:right;"><label for="ilmeteo-title">' . __('Titolo:') . ' <input style="width: 200px;" id="ilmeteo-title" name="ilmeteo-title" type="text" value="'.$title.'" /></label></p>';

			echo '<p style="text-align:right;"><label for="ilmeteo-location">' . __('Scegli la tua localit&agrave: <a href="http://imeteo.wordpress.com/2009/09/10/configurazione-widget/ ">?</a>:', 'widgets') . ' <input style="width: 200px;" id="ilmeteo-location" name="ilmeteo-location" type="text" value="'.$location.'" /></label></p>';

			echo '<p style="text-align:right;"><label for="ilmeteo-client">' . __('Controlla il tuo ID-CLIENTE <a href="http://imeteo.wordpress.com/2009/09/10/configurazione-widget/ ">?</a>:', 'widgets') . ' <input style="width: 200px;" id="ilmeteo-client" name="ilmeteo-client" type="text" value="'.$client.'" /></label></p>';

			echo '<input type="hidden" id="ilmeteo-submit" name="ilmeteo-submit" value="1" />';
	}



	// This registers our widget so it appears with the other available
	// widgets and can be dragged and dropped into any active sidebars.
	register_sidebar_widget(array('Il Meteo', 'widgets'), 'widget_ilmeteo');

	// This registers our optional widget control form.
	register_widget_control(array('Il Meteo', 'widgets'), 'widget_ilmeteo_control', 450, 325);
}

add_action("widgets_init", "widget_ilmeteo_init");


?>
