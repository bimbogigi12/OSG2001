<?php
/**
 * System status tab template.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\theme-page\v1
 * @since 1.0.0
 */

$evolvethemes_status = evolvethemes_system_status();

$evolvethemes_plugins        = array();
$evolvethemes_active_plugins = get_option( 'active_plugins' );
$evolvethemes_all_plugins    = get_plugins();

foreach ( $evolvethemes_active_plugins as $evolvethemes_active_plugin ) {
	$evolvethemes_plugins[ $evolvethemes_all_plugins[ $evolvethemes_active_plugin ]['Name'] ] = $evolvethemes_all_plugins[ $evolvethemes_active_plugin ]['Version'];
}

if ( is_multisite() ) {
	$evolvethemes_network_active_plugins = get_site_option( 'active_sitewide_plugins' );

	foreach ( $evolvethemes_network_active_plugins as $evolvethemes_active_plugin => $evolvethemes_last_updated ) {
		$evolvethemes_plugins[ $evolvethemes_all_plugins[ $evolvethemes_active_plugin ]['Name'] ] = $evolvethemes_all_plugins[ $evolvethemes_active_plugin ]['Version'];
	}
}

/**
 * Print a status row.
 *
 * @since 1.0.0
 * @param array  $status The system status array.
 * @param string $label The row label.
 * @param string $key The system status setting key.
 */
function evolvethemes_print_status_row( $status, $label, $key ) {
	$value = $status[ $key ]['value'];
	$warning = isset( $status[ $key ]['warning'] ) ? $status[ $key ]['warning'] : false;
	$row_class = $warning ? 'evolvethemes-themepage-ss-warning' : '';

	printf( '<tr class="%s">', esc_attr( $row_class ) );
		echo '<td>';
			printf( '<div class="evolvethemes-themepage-ss-r-l">%s</div>', esc_html( $label ) );
			printf( '<div class="evolvethemes-themepage-ss-r-v">%s</div>', esc_html( $value ) );

	if ( $warning ) {
		printf( '<div class="evolvethemes-themepage-ss-r-m">%s</div>', wp_kses_post( $warning ) );
	}
		echo '</td>';
	echo '</tr>';
}

?>

<div class="wp-clearfix">
	<div class="evolvethemes-themepage-ss-t_w">
		<table class="evolvethemes-themepage-ss-t">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'WordPress environment', 'crowley' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'WP version:', 'crowley' ), 'wp_version' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'WP Multisite:', 'crowley' ), 'wp_multisite' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'WP memory limit:', 'crowley' ), 'wp_memory_limit' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'WP debug mode:', 'crowley' ), 'wp_debug' ); ?>
			</tbody>
		</table>

		<table class="evolvethemes-themepage-ss-t">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Server environment', 'crowley' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'PHP version:', 'crowley' ), 'php_version' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'PHP Post Max Size:', 'crowley' ), 'php_post_max_size' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'PHP Time Limit:', 'crowley' ), 'php_time_limit' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'PHP Max Input Vars:', 'crowley' ), 'php_max_input_vars' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'Max Upload Size:', 'crowley' ), 'php_max_file_upload' ); ?>
			</tbody>
		</table>

		<table class="evolvethemes-themepage-ss-t">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Active plugins', 'crowley' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $evolvethemes_plugins as $evolvethemes_name => $evolvethemes_version ) : ?>
					<tr>
						<td>
							<div class="evolvethemes-themepage-ss-r-l"><?php echo esc_html( $evolvethemes_name ); ?></div>
							<div class="evolvethemes-themepage-ss-r-v"><?php echo esc_html( $evolvethemes_version ); ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<table class="evolvethemes-themepage-ss-t">
			<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Theme', 'crowley' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'Version:', 'crowley' ), 'theme_version' ); ?>
				<?php evolvethemes_print_status_row( $evolvethemes_status, __( 'Child theme:', 'crowley' ), 'theme_child' ); ?>
			</tbody>
		</table>
	</div>

	<div class="evolvethemes-themepage-sc_w">
		<p><?php echo wp_kses_post( __( 'The System Status report helps with troubleshooting issues with your site and allows to have a clear view over software versions, server settings and WordPress conifiguration.', 'crowley' ) ); ?></p>
		<p><?php echo wp_kses_post( __( 'Keep in mind that some of the issues that may arise can be solved on your own (following the indications provided), while for others it is best to talk to your host provider directly.', 'crowley' ) ); ?></p>
	</div>

</div>
