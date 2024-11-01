<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/**
 * The public-facing functionality of the plugin.
 *
 * @link 			https://webmat.pro
 * @since 			1.0.0
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/public
 * @author 			Slushman <chris@slushman.com>
 */
class Wc_Extended_Public {

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
	 * @param 		string 		$plugin_name 		The name of the plugin.
	 * @param 		string 		$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	} // __construct()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( 'wc-extended', plugin_dir_url( __FILE__ ) . 'css/wc-extended-public.css', array(), constant( 'WC_EXTENDED_VERSION' ), 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-extended-public.js', array( 'jquery' ), $this->version, false );


		// Only on front-end and checkout page
		if( is_checkout() ) {
			//wp_enqueue_script( 'wc-extended-checkout', plugin_dir_url( __FILE__ ) . 'js/wc-extended-checkout.js', array( 'jquery' ), constant( 'WC_EXTENDED_VERSION' ), false );

			// pass Ajax Url to script.js
			//wp_localize_script('wc-extended-checkout', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
		}


	} // enqueue_scripts()


	private function load_dependencies() {

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WCE_PATH . 'public/partials/wc-extended-public-display.php';

	}


} // class
