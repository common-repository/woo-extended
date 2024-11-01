<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link 			https://webmat.pro
 * @since 			1.0.0
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 			1.0.0
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/includes
 * @author 			Slushman <chris@slushman.com>
 */
class Wc_Extended_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 		1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-extended',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	} // load_plugin_textdomain()

} // class
