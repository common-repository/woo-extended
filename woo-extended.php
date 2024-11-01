<?php

/**
 * @wordpress-plugin
 * Plugin Name: 		Woo Extended for Woocommerce
 * Plugin URI: 			https://wordpress.org/plugins/woo-extended/
 * Description: 		This is a plugin to extended Woocommerce
 * Version: 			1.0.1
 * Author: 				WebMat
 * Author URI: 			https://webmat.pro
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		wc-extended
 * Domain Path: 		/languages
**/

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$plugin_version = $plugin_data['Version'];

define( 'WC_EXTENDED_VERSION', $plugin_version );
define( 'WC_EXTENDED_BASENAME', plugin_basename(__FILE__) );
define( 'WCE_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Check if WooCommerce is active
 **/
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action( 'admin_notices', 'admin_notice_missing_main_plugin' );
	return; //stop there
}

function admin_notice_missing_main_plugin() {

	if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

	$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
		esc_html__( '%1$s requires %2$s for working.', 'wc-extended' ),
		'<strong>' . esc_html__( 'WC Extended', 'wc-extended' ) . '</strong>',
		'<strong>' . esc_html__( 'WooCommerce', 'wc-extended' ) . '</strong>'
	);

	printf( '<div class="notice notice-error"><p>%1$s</p></div>', $message );

}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-extended-activator.php
 */
function activate_wc_extended() {
	require_once WCE_PATH . 'includes/class-wc-extended-activator.php';
	Wc_Extended_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-extended-deactivator.php
 */
function deactivate_wc_extended() {
	require_once WCE_PATH . 'includes/class-wc-extended-deactivator.php';
	Wc_Extended_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_extended' );
register_deactivation_hook( __FILE__, 'deactivate_wc_extended' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once WCE_PATH . 'includes/class-wc-extended.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 		1.0.0
 */
function run_wc_extended() {

	$plugin = new Wc_Extended();
	$plugin->run();

}
run_wc_extended();
