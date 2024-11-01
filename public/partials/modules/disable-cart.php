<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}


// Remove cart button from mini-cart
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );

// Force WooCommerce to redirect after product added to cart
update_option( 'woocommerce_cart_redirect_after_add', 'yes' );
add_filter( 'woocommerce_product_settings', function( $fields ) {
    foreach ( $fields as $key => $field ) {
        if ( $field['id'] === 'woocommerce_cart_redirect_after_add' ) {
            $fields[$key]['custom_attributes'] = array(
                'disabled' => true
            );
        }
    }
    return $fields;
}, 10, 1 );

// Empty cart when product is added to cart, so we can't have multiple products in cart
add_action( 'woocommerce_add_cart_item_data', function() {
    wc_empty_cart();
} );

// When add a product to cart, redirect to checkout
add_action( 'woocommerce_init', function() {
    if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
        add_filter( 'add_to_cart_redirect', function() {
            return wc_get_checkout_url();
        } );
    } else {
        add_filter( 'woocommerce_add_to_cart_redirect', function() {
            return wc_get_checkout_url();
        } );
    }
} );

// Remove added to cart message
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

// If someone reaches the cart page, redirect to checkout permanently
add_action( 'template_redirect', function() {
    if ( ! is_cart() ) { return; }
    if ( WC()->cart->get_cart_contents_count() == 0 ) {
        wp_redirect( apply_filters( 'wcdcp_redirect', wc_get_page_permalink( 'shop' ) ) );
        exit;
    }

    // Redirect to checkout page
    wp_redirect( wc_get_checkout_url(), '301' );
    exit;
} );

// Change add to cart button text ( in loop )
add_filter( 'add_to_cart_text', function() {
    return __( 'Order', 'wc-extended' );
} );

// Change add to cart button text ( in product page )
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return __( 'Order', 'wc-extended' );
} );

// Clear cart if there are errors
add_action( 'woocommerce_cart_has_errors', function() {
    wc_empty_cart();
} );
