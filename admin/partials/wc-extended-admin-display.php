<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link 			https://webmat.pro
 * @since 			1.0.0
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/admin/partials
 */

// Add link to configuration page into plugin
add_filter( 'plugin_action_links_' . constant('WC_EXTENDED_BASENAME'), 'add_action_links' );
function add_action_links ( $links ) {
    $mylinks = array(
		'settings' => '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=wce' ) . '">' . __( 'Settings', 'wc-extended' ) . '</a>',
	);
    return array_merge( $links, $mylinks );
}


// Add fields to tab WooCommerce options
function wce_options() {

    $settings_wce = array();

    // Add Title to the Settings
    $settings_wce[] = array( 'name' => __( 'WC Extended Settings', 'wc-extended' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Extended', 'wc-extended' ), 'id' => 'wce_settings' );

    // Option 1
    $settings_wce[] = array(
        'name'     => __( 'Disable cart page', 'wc-extended' ),
        'desc_tip' => __( 'Enabling this option will delete the cart page and for each purchase customers will be redirected directly to the checkout. They will also be able to buy one type of product at a time.', 'wc-extended' ),
        'id'       => 'wce_disable_cart',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Disable cart page and redirect directly to checkout', 'wc-extended' ),
    );

    // Option 2
    $settings_wce[] = array(
        'name'     => __( 'Remove UGS', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_remove_ugs',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Remove UGS', 'wc-extended' ),
    );

    // Option 3
    $settings_wce[] = array(
        'name'     => __( 'Remove Categories', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_remove_categories',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Remove Categories', 'wc-extended' ),
    );

    // Option 4
    $settings_wce[] = array(
        'name'     => __( 'Remove Tags', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_remove_tags',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Remove Tags', 'wc-extended' ),
    );

    // Option 5
    $settings_wce[] = array(
        'name'     => __( 'Auto Check Terms', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_autocheck_terms',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Auto Check the checkbox terms and conditions in checkout page', 'wc-extended' ),
    );

    // Option 6
    $settings_wce[] = array(
        'name'     => __( 'Uncheck Different Address Ship', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_uncheck_different_ship',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Uncheck the checkbox for use the different address shipping', 'wc-extended' ),
    );

    // Option 7
    $settings_wce[] = array(
        'name'     => __( 'Remove Field Order Notes', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_remove_notes',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Remove the field Notes in order checkout', 'wc-extended' ),
    );

    // Option 8
    $settings_wce[] = array(
        'name'     => __( 'Only Sold Individually', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_sold_individually',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Only Sold Individually', 'wc-extended' ),
    );

    // Option 9
    $settings_wce[] = array(
        'name'     => __( 'Redirect Login Wordpress', 'wc-extended' ),
        //'desc_tip' => __( '', 'wc-extended' ),
        'id'       => 'wce_redirect_login',
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Redirect the login page (or register) Wordpress to the page of my account woocommerce', 'wc-extended' ),
    );

    $settings_wce[] = array( 'type' => 'sectionend', 'id' => 'wce_settings' );

    return apply_filters( 'wce_options', $settings_wce );

}

// Add settings tab to WooCommerce options
add_filter( 'woocommerce_settings_tabs_array', function( $tabs ) {
    $tabs['wce'] = __( 'WC Extended', 'wc-extended' );

    return $tabs;
}, 50 );


// Add settings to the new tab
add_action( 'woocommerce_settings_tabs_wce', function() {
    woocommerce_admin_fields( wce_options() );
} );

// Save settings
add_action( 'woocommerce_update_options_wce', function() {
    woocommerce_update_options( wce_options() );
} );


// TINY MCE IN META BOX for product
function admin_init_hook() {
    function blank(){

    }

    foreach (array('product') as $type) {
        add_meta_box('custom_editor', 'Description longue du produit', 'blank', $type, 'normal', 'high');
    }
}
add_action('admin_init','admin_init_hook');

function admin_footer_hook(){
    global $post;
    if ( get_post_type($post) == 'product') {
	?>
        <script>jQuery('#postdiv, #postdivrich').prependTo('#custom_editor .inside');</script>
    <?php
	}
}
add_action('admin_footer','admin_footer_hook');
