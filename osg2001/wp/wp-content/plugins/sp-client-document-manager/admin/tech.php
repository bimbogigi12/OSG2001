<?php


$sp_cdm_admin_technical_info = new sp_cdm_admin_technical_info;
add_filter('sp_client_upload_nav_menu', array($sp_cdm_admin_technical_info , 'submenu'));
add_action('sp_cu_admin_menu', array($sp_cdm_admin_technical_info , 'menu'));
add_action('admin_init', array($sp_cdm_admin_technical_info , 'permissions'));

class sp_cdm_admin_technical_info{
		
	function permissions(){
		
		global $current_user;
			if($current_user != ''){
			
					if (  user_can($current_user->ID,'manage_options') && !current_user_can('sp_cdm_system_info') ) {
						@require_once(ABSPATH . 'wp-includes/pluggable.php');
							$role = get_role( 'administrator' );
							$role->add_cap( 'sp_cdm_system_info' );	
							
					}
			
			}
		
	}
	
	
	function menu(){
	
	add_submenu_page('sp-client-document-manager', 'System Info', 'System Information', 'sp_cdm_system_info', 'sp-client-document-manager-system-info', array(
        $this,
        'view'
    ));
}
function let_to_num( $size ) {
     $l   = substr( $size, -1 );
     $ret = substr( $size, 0, -1 );
     switch ( strtoupper( $l ) ) {
         case 'P':
             $ret *= 1024;
         case 'T':
             $ret *= 1024;
         case 'G':
             $ret *= 1024;
         case 'M':
             $ret *= 1024;
       case 'K':
            $ret *= 1024;
     }
    return $ret;
 }
function submenu($content){
	
	if(current_user_can('sp_cdm_user_logs')){
	$content .= '<li><a href="admin.php?page=sp-client-document-manager-system-info" >' . __("System Information", "sp-cdm") . '</a></li>';
	}
	return $content;

}
	
	
	
	function view(){
		
		
		
		echo '<h2>'.__("Technical Information","sp-cdm").'</h2>'.sp_client_upload_nav_menu().'';	
		?>
        
   <div class="sp-cdm-status-report">     
<div class="updated Client Document Manager-message">
	<p><?php _e( 'Please copy and paste this information in your ticket when contacting support:', "sp-cdm" ); ?> </p>
	<p class="submit"><a href="#" class="button-primary debug-report"><?php _e( 'Get System Report', "sp-cdm" ); ?></a>
</p>
	<div id="debug-report" style="display:none">
		<textarea readonly style="width:100%;height:400px"></textarea>
		<p class="submit"><button id="copy-for-support" class="button-primary" href="#" data-tip="<?php _e( 'Copied!', "sp-cdm" ); ?>"><?php _e( 'Copy for Support', "sp-cdm" ); ?></button></p>
	</div>
</div>
<br/>
<table class="wc_status_table widefat" cellspacing="0" id="status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress Environment', "sp-cdm" ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td data-export-label="Home URL"><?php _e( 'Home URL', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The URL of your site\'s homepage.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php form_option( 'home' ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Site URL"><?php _e( 'Site URL', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The root URL of your site.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php form_option( 'siteurl' ); ?></td>
		</tr>
        		<tr>
			<td data-export-label="WP Version"><?php _e( 'WP Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of WordPress installed on your site.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php bloginfo('version'); ?></td>
		</tr>
		<tr>
			<td data-export-label="CDM Version"><?php _e( 'CDM Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of Client Document Manager installed on your site.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo esc_html( get_option('sp_client_upload') ); ?></td>
		</tr>
        <? if(get_option('sp_client_upload_premium') != false){ ?>
        <tr>
			<td data-export-label="CDM Premium Version"><?php _e( 'CDM Premium Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of Client Document Manager that the database is formatted for. This should be the same as your Client Document Manager Version.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo esc_html(get_option('sp_client_upload_premium') ); ?></td>
		</tr>
        <? } ?>
		
		<tr>
			<td data-export-label="Uploads Folder Writeable?"><?php _e( 'Uploads Folder Writeable?', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'If your folder is not writable files will never make it to the server.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				if ( @fopen(SP_CDM_UPLOADS_DIR . 'test-log.log', 'a' ) ) {
					echo '<mark class="yes">' . 'Yes <code>' . SP_CDM_UPLOADS_DIR . ' is Writable!</code></mark> ';
				} else {
					printf( '<mark class="error">' . '&#10005; ' . __( 'To upload properly, make <code>%s</code> writable or define a custom <code>SP_CDM_UPLOADS_DIR</code>.', "sp-cdm" ) . '</mark>', SP_CDM_UPLOADS_DIR );
				}
			?></td>
		</tr>

		<tr>
			<td data-export-label="WP Multisite"><?php _e( 'WP Multisite', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php if ( is_multisite() ) echo 'Yes'; else echo 'No'; ?></td>
		</tr>
		<tr>
			<td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				$memory = $this->let_to_num( WP_MEMORY_LIMIT );

				if ( $memory < 67108864 ) {
					echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 64MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', "sp-cdm" ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
				} else {
					echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
				}
			?></td>
		</tr>
		<tr>
			<td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . 'Yes' . '</mark>'; else echo '<mark class="no">' . 'No' . '</mark>'; ?></td>
		</tr>
		<tr>
			<td data-export-label="Language"><?php _e( 'Language', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The current language used by WordPress. Default = English', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo get_locale() ?></td>
		</tr>
	</tbody>
</table>
<table class="wc_status_table widefat" cellspacing="0" id="status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', "sp-cdm" ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td data-export-label="Server Info"><?php _e( 'Server Info', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="PHP Version"><?php _e( 'PHP Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of PHP installed on your hosting server.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				// Check if phpversion function exists
				if ( function_exists( 'phpversion' ) ) {
					$php_version = phpversion();

					if ( version_compare( $php_version, '5.4', '<' ) ) {
						echo '<mark class="error">' . sprintf( __( '%s - We recommend a minimum PHP version of 5.4. See: <a href="%s" target="_blank">How to update your PHP version</a>', "sp-cdm" ), esc_html( $php_version ), 'http://docs.woothemes.com/document/how-to-update-your-php-version/' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . esc_html( $php_version ) . '</mark>';
					}
				} else {
					_e( "Couldn't determine PHP version because phpversion() doesn't exist.", "sp-cdm" );
				}
				?></td>
		</tr>
		<?php if ( function_exists( 'ini_get' ) ) : ?>
			<tr>
				<td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', "sp-cdm" ); ?>:</td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest filesize that can be contained in one post.', "sp-cdm" ) . '"></a>'; ?></td>
				<td><?php echo size_format(  $this->let_to_num( ini_get('post_max_size') ) ); ?></td>
			</tr>
			<tr>
				<td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', "sp-cdm" ); ?>:</td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', "sp-cdm" ) . '"></a>'; ?></td>
				<td><?php echo ini_get('max_execution_time'); ?></td>
			</tr>
			<tr>
				<td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', "sp-cdm" ); ?>:</td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', "sp-cdm" ) . '"></a>'; ?></td>
				<td><?php echo ini_get('max_input_vars'); ?></td>
			</tr>
			<tr>
				<td data-export-label="SUHOSIN Installed"><?php _e( 'SUHOSIN Installed', "sp-cdm" ); ?>:</td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself. If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', "sp-cdm" ) . '"></a>'; ?></td>
				<td><?php echo extension_loaded( 'suhosin' ) ? 'Yes' : 'No'; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td data-export-label="MySQL Version"><?php _e( 'MySQL Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', "sp-cdm" ) . '"></a>'; ?></td>
			<td>
				<?php
				/** @global wpdb $wpdb */
				global $wpdb;
				echo $wpdb->db_version();
				?>
			</td>
		</tr>
		<tr>
			<td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest filesize that can be uploaded to your WordPress installation.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo size_format( wp_max_upload_size() ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Default Timezone is UTC"><?php _e( 'Default Timezone is UTC', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The default timezone for your server.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				$default_timezone = date_default_timezone_get();
				if ( 'UTC' !== $default_timezone ) {
					echo '<mark class="error">' . '&#10005; ' . sprintf( __( 'Default timezone is %s - it should be UTC', "sp-cdm" ), $default_timezone ) . '</mark>';
				} else {
					echo '<mark class="yes">' . 'Yes' . '</mark>';
				} ?>
			</td>
		</tr>
		<?php
			$posting = array();

			// fsockopen/cURL
			$posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
			$posting['fsockopen_curl']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services.', "sp-cdm" ) . '"></a>';

			if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
				$posting['fsockopen_curl']['success'] = true;
			} else {
				$posting['fsockopen_curl']['success'] = false;
				$posting['fsockopen_curl']['note']    = __( 'Your server does not have fsockopen or cURL enabled - PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider.', "sp-cdm" ). '</mark>';
			}

			// SOAP
			$posting['soap_client']['name'] = 'SoapClient';
			$posting['soap_client']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Some webservices like shipping use SOAP to get information from remote servers, for example, live shipping quotes from FedEx require SOAP to be installed.', "sp-cdm" ) . '"></a>';

			if ( class_exists( 'SoapClient' ) ) {
				$posting['soap_client']['success'] = true;
			} else {
				$posting['soap_client']['success'] = false;
				$posting['soap_client']['note']    = sprintf( __( 'Your server does not have the <a href="%s">SOAP Client</a> class enabled - some gateway plugins which use SOAP may not work as expected.', "sp-cdm" ), 'http://php.net/manual/en/class.soapclient.php' ) . '</mark>';
			}

			// DOMDocument
			$posting['dom_document']['name'] = 'DOMDocument';
			$posting['dom_document']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'HTML/Multipart emails use DOMDocument to generate inline CSS in templates.', "sp-cdm" ) . '"></a>';

			if ( class_exists( 'DOMDocument' ) ) {
				$posting['dom_document']['success'] = true;
			} else {
				$posting['dom_document']['success'] = false;
				$posting['dom_document']['note']    = sprintf( __( 'Your server does not have the <a href="%s">DOMDocument</a> class enabled - HTML/Multipart emails, and also some extensions, will not work without DOMDocument.', "sp-cdm" ), 'http://php.net/manual/en/class.domdocument.php' ) . '</mark>';
			}

			// GZIP
			$posting['gzip']['name'] = 'GZip';
			$posting['gzip']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'GZip (gzopen) is used to open the GEOIP database from MaxMind.', "sp-cdm" ) . '"></a>';

			if ( is_callable( 'gzopen' ) ) {
				$posting['gzip']['success'] = true;
			} else {
				$posting['gzip']['success'] = false;
				$posting['gzip']['note']    = sprintf( __( 'Your server does not support the <a href="%s">gzopen</a> function - this is required to use the GeoIP database from MaxMind. The API fallback will be used instead for geolocation.', "sp-cdm" ), 'http://php.net/manual/en/zlib.installation.php' ) . '</mark>';
			}

			// WP Remote Post Check
			$posting['wp_remote_post']['name'] = __( 'Remote Post', "sp-cdm");
			$posting['wp_remote_post']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'PayPal uses this method of communicating when sending back transaction information.', "sp-cdm" ) . '"></a>';

			$response = wp_safe_remote_post( 'https://www.paypal.com/cgi-bin/webscr', array(
				'timeout'    => 60,
				'user-agent' => 'Client Document Manager/',
				'body'       => array(
					'cmd'    => '_notify-validate'
				)
			) );

			if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
				$posting['wp_remote_post']['success'] = true;
			} else {
				$posting['wp_remote_post']['note']    = __( 'wp_remote_post() failed. PayPal IPN won\'t work with your server. Contact your hosting provider.', "sp-cdm" );
				if ( is_wp_error( $response ) ) {
					$posting['wp_remote_post']['note'] .= ' ' . sprintf( __( 'Error: %s', "sp-cdm" ), wc_clean( $response->get_error_message() ) );
				} else {
					$posting['wp_remote_post']['note'] .= ' ' . sprintf( __( 'Status code: %s', "sp-cdm" ), wc_clean( $response['response']['code'] ) );
				}
				$posting['wp_remote_post']['success'] = false;
			}

			// WP Remote Get Check
			$posting['wp_remote_get']['name'] = __( 'Remote Get', "sp-cdm");
			$posting['wp_remote_get']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Client Document Manager plugins may use this method of communication when checking for plugin updates.', "sp-cdm" ) . '"></a>';

			$response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

			if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
				$posting['wp_remote_get']['success'] = true;
			} else {
				$posting['wp_remote_get']['note']    = __( 'wp_remote_get() failed. The Client Document Manager plugin updater won\'t work with your server. Contact your hosting provider.', "sp-cdm" );
				if ( is_wp_error( $response ) ) {
					$posting['wp_remote_get']['note'] .= ' ' . sprintf( __( 'Error: %s', "sp-cdm" ), wc_clean( $response->get_error_message() ) );
				} else {
					$posting['wp_remote_get']['note'] .= ' ' . sprintf( __( 'Status code: %s', "sp-cdm" ), wc_clean( $response['response']['code'] ) );
				}
				$posting['wp_remote_get']['success'] = false;
			}

			$posting = apply_filters( 'Client Document Manager_debug_posting', $posting );


			foreach ( $posting as $post ) {
				$mark = ! empty( $post['success'] ) ? 'yes' : 'error';
				?>
				<tr>
					<td data-export-label="<?php echo esc_html( $post['name'] ); ?>"><?php echo esc_html( $post['name'] ); ?>:</td>
					<td class="help"><?php echo isset( $post['help'] ) ? $post['help'] : ''; ?></td>
					<td>
						<mark class="<?php echo $mark; ?>">
							<?php echo ! empty( $post['success'] ) ? 'Yes' : 'No'; ?>
							<?php echo ! empty( $post['note'] ) ? wp_kses_data( $post['note'] ) : ''; ?>
						</mark>
					</td>
				</tr>
				<?php
			}
		?>
	</tbody>
</table>
<table class="wc_status_table widefat" cellspacing="0" id="status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php _e( 'Active Plugins', "sp-cdm" ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		foreach ( $active_plugins as $plugin ) {

			$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$dirname        = dirname( $plugin );
			$version_string = '';
			$network_string = '';

			if ( ! empty( $plugin_data['Name'] ) ) {

				// link the plugin name to the plugin url if available
				$plugin_name = esc_html( $plugin_data['Name'] );

				if ( ! empty( $plugin_data['PluginURI'] ) ) {
					$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , "sp-cdm" ) . '" target="_blank">' . $plugin_name . '</a>';
				}

				if ( strstr( $dirname, 'Client Document Manager-' ) ) {

					if ( false === ( $version_data = get_transient( md5( $plugin ) . '_version_data' ) ) ) {
						$changelog = wp_safe_remote_get( 'http://dzv365zjfbd8v.cloudfront.net/changelogs/' . $dirname . '/changelog.txt' );
						$cl_lines  = explode( "\n", wp_remote_retrieve_body( $changelog ) );
						if ( ! empty( $cl_lines ) ) {
							foreach ( $cl_lines as $line_num => $cl_line ) {
								if ( preg_match( '/^[0-9]/', $cl_line ) ) {

									$date         = str_replace( '.' , '-' , trim( substr( $cl_line , 0 , strpos( $cl_line , '-' ) ) ) );
									$version      = preg_replace( '~[^0-9,.]~' , '' ,stristr( $cl_line , "version" ) );
									$update       = trim( str_replace( "*" , "" , $cl_lines[ $line_num + 1 ] ) );
									$version_data = array( 'date' => $date , 'version' => $version , 'update' => $update , 'changelog' => $changelog );
									set_transient( md5( $plugin ) . '_version_data', $version_data, DAY_IN_SECONDS );
									break;
								}
							}
						}
					}

					if ( ! empty( $version_data['version'] ) && version_compare( $version_data['version'], $plugin_data['Version'], '>' ) ) {
						$version_string = ' No <strong style="color:red;">' . esc_html( sprintf( _x( '%s is available', 'Version info', "sp-cdm" ), $version_data['version'] ) ) . '</strong>';
					}

					if ( $plugin_data['Network'] != false ) {
						$network_string = ' No <strong style="color:black;">' . __( 'Network enabled', "sp-cdm" ) . '</strong>';
					}
				}

				?>
				<tr>
					<td><?php echo $plugin_name; ?></td>
					<td class="help">&nbsp;</td>
					<td><?php echo sprintf( _x( 'by %s', 'by author', "sp-cdm" ), $plugin_data['Author'] ) . ' No ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>

<table class="wc_status_table widefat" cellspacing="0" id="status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Theme"><?php _e( 'Theme', "sp-cdm" ); ?></th>
		</tr>
	</thead>
		<?php
		$active_theme = wp_get_theme();
		if ( $active_theme->{'Author URI'} == 'http://www.woothemes.com' ) {

			$theme_dir = substr( strtolower( str_replace( ' ','', $active_theme->Name ) ), 0, 45 );

			if ( false === ( $theme_version_data = get_transient( $theme_dir . '_version_data' ) ) ) {
				$theme_changelog = wp_safe_remote_get( 'http://dzv365zjfbd8v.cloudfront.net/changelogs/' . $theme_dir . '/changelog.txt' );
				$cl_lines  = explode( "\n", wp_remote_retrieve_body( $theme_changelog ) );
				if ( ! empty( $cl_lines ) ) {

					foreach ( $cl_lines as $line_num => $cl_line ) {
						if ( preg_match( '/^[0-9]/', $cl_line ) ) {

							$theme_date         = str_replace( '.' , '-' , trim( substr( $cl_line , 0 , strpos( $cl_line , '-' ) ) ) );
							$theme_version      = preg_replace( '~[^0-9,.]~' , '' ,stristr( $cl_line , "version" ) );
							$theme_update       = trim( str_replace( "*" , "" , $cl_lines[ $line_num + 1 ] ) );
							$theme_version_data = array( 'date' => $theme_date , 'version' => $theme_version , 'update' => $theme_update , 'changelog' => $theme_changelog );
							set_transient( $theme_dir . '_version_data', $theme_version_data , DAY_IN_SECONDS );
							break;
						}
					}
				}
			}
		}
		?>
	<tbody>
		<tr>
			<td data-export-label="Name"><?php _e( 'Name', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The name of the current active theme.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo $active_theme->Name; ?></td>
		</tr>
		<tr>
			<td data-export-label="Version"><?php _e( 'Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The installed version of the current active theme.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				echo $active_theme->Version;

				if ( ! empty( $theme_version_data['version'] ) && version_compare( $theme_version_data['version'], $active_theme->Version, '!=' ) ) {
					echo ' No <strong style="color:red;">' . $theme_version_data['version'] . ' ' . __( 'is available', "sp-cdm" ) . '</strong>';
				}
			?></td>
		</tr>
		<tr>
			<td data-export-label="Author URL"><?php _e( 'Author URL', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The theme developers URL.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo $active_theme->{'Author URI'}; ?></td>
		</tr>
		<tr>
			<td data-export-label="Child Theme"><?php _e( 'Child Theme', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not the current theme is a child theme.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php
				echo is_child_theme() ? '<mark class="yes">' . 'Yes' . '</mark>' : '&#10005; No ' . sprintf( __( 'If you\'re modifying Client Document Manager or a parent theme you didn\'t build personally we recommend using a child theme. See: <a href="%s" target="_blank">How to create a child theme</a>', "sp-cdm" ), 'http://codex.wordpress.org/Child_Themes' );
			?></td>
		</tr>
		<?php
		if( is_child_theme() ) :
			$parent_theme = wp_get_theme( $active_theme->Template );
		?>
		<tr>
			<td data-export-label="Parent Theme Name"><?php _e( 'Parent Theme Name', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The name of the parent theme.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo $parent_theme->Name; ?></td>
		</tr>
		<tr>
			<td data-export-label="Parent Theme Version"><?php _e( 'Parent Theme Version', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The installed version of the parent theme.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo  $parent_theme->Version; ?></td>
		</tr>
		<tr>
			<td data-export-label="Parent Theme Author URL"><?php _e( 'Parent Theme Author URL', "sp-cdm" ); ?>:</td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The parent theme developers URL.', "sp-cdm" ) . '"></a>'; ?></td>
			<td><?php echo $parent_theme->{'Author URI'}; ?></td>
		</tr>
		<?php endif ?>
		
	</tbody>
</table>
<?php do_action( 'Client Document Manager_system_status_report' ); ?>

<script type="text/javascript">

	jQuery( 'a.help_tip' ).click( function() {
		return false;
	});

	jQuery( 'a.debug-report' ).click( function() {

		var report = '';

		jQuery( '#status thead, #status tbody' ).each(function(){

			if ( jQuery( this ).is('thead') ) {

				var label = jQuery( this ).find( 'th:eq(0)' ).data( 'export-label' ) || jQuery( this ).text();
				report = report + "\n### " + jQuery.trim( label ) + " ###\n\n";

			} else {

				jQuery('tr', jQuery( this ) ).each(function(){

					var label       = jQuery( this ).find( 'td:eq(0)' ).data( 'export-label' ) || jQuery( this ).find( 'td:eq(0)' ).text();
					var the_name    = jQuery.trim( label ).replace( /(<([^>]+)>)/ig, '' ); // Remove HTML
					var the_value   = jQuery.trim( jQuery( this ).find( 'td:eq(2)' ).text() );
					var value_array = the_value.split( ', ' );

					if ( value_array.length > 1 ) {

						// If value have a list of plugins ','
						// Split to add new line
						var output = '';
						var temp_line ='';
						jQuery.each( value_array, function( key, line ){
							temp_line = temp_line + line + '\n';
						});

						the_value = temp_line;
					}

					report = report + '' + the_name + ': ' + the_value + "\n";
				});

			}
		});

			jQuery( "#debug-report" ).slideDown();
			jQuery( "#debug-report textarea" ).val( report ).focus().select();
			jQuery( this ).fadeOut();
			return false;

		return false;
	});

	jQuery( document ).ready( function ( $ ) {
		$( '#copy-for-support' ).tipTip({
			'attribute':  'data-tip',
			'activation': 'click',
			'fadeIn':     50,
			'fadeOut':    50,
			'delay':      0
		});

		$( 'body' ).on( 'copy', '#copy-for-support', function ( e ) {
			e.clipboardData.clearData();
			e.clipboardData.setData( 'text/plain', $( '#debug-report textarea' ).val() );
			e.preventDefault();
		});

	});

</script>
</div>
        
        <?
	}
	
	
	
	
	
	
}