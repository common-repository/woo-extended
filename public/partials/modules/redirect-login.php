<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}


// Redirect wp-admin to the page of my account woocommerce
function prevent_wp_login() {
    global $pagenow;
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';
    if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass')))) ) {
        wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ), 301 );
        exit();
    }
    if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/profile.php' )){
        wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) . '/' . get_option('woocommerce_myaccount_edit_account_endpoint') , 301 );
        die();
    }
}
add_action('init', 'prevent_wp_login');
