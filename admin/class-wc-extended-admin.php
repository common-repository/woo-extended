<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link 			https://webmat.pro
 * @since 			1.0.0
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/admin
 * @author 			Slushman <chris@slushman.com>
 */
class Wc_Extended_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$version 		The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$plugin_name 		The name of this plugin.
	 * @param 		string 		$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	} // __ construct()

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-extended-admin.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-extended-admin.js', array( 'jquery' ), $this->version, false );

	} // enqueue_scripts()



	private function load_dependencies() {

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WCE_PATH . 'admin/partials/wc-extended-admin-display.php';

	}

} // class
