<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link 			https://wc-extended.com
 * @since 			1.0.0
 *
 * @package 		Wc_Extended
 * @subpackage 		Wc_Extended/public/partials
 */

/*** IF OPTIONS DISABLED CART IS ENABLED ***/
if ( get_option( 'wce_disable_cart' ) == 'yes' ) {
    require_once WCE_PATH . 'public/partials/modules/disable-cart.php';
}

if ( get_option( 'wce_remove_ugs' ) == 'yes' ) {
    add_filter( 'wc_product_sku_enabled', '__return_false' );
}

if ( get_option( 'wce_remove_categories' ) == 'yes' ) {
    require_once WCE_PATH . 'public/partials/modules/remove-categories.php';
}

if ( get_option( 'wce_remove_tags' ) == 'yes' ) {
    require_once WCE_PATH . 'public/partials/modules/remove-tags.php';
}

if ( get_option( 'wce_autocheck_terms' ) == 'yes' ) {
    add_filter( 'woocommerce_terms_is_checked_default', function ( $terms_is_checked ) {return true;}, 10 ); // autocheck terms and conditions
}

if ( get_option( 'wce_uncheck_different_ship' ) == 'yes' ) {
    add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' ); // Ship to a different address closed by default
}

if ( get_option( 'wce_remove_notes' ) == 'yes' ) {
    add_filter('woocommerce_enable_order_notes_field', '__return_false'); // remove order field notes
}

if ( get_option( 'wce_sold_individually' ) == 'yes' ) {
    /**
     * @desc Remove in all product type
     */
    function wc_remove_all_quantity_fields( $return, $product ) {
        return true;
    }
    add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
}

if ( get_option( 'wce_redirect_login' ) == 'yes' ) {
    require_once WCE_PATH . 'public/partials/modules/redirect-login.php';
}




// add prefix and suffix to the price of woocommerce
function custom_price_message( $price ) {

	  $new_price = '<span class="border"></span><br><span class="price-prefix">' . __( 'From' , 'wc-extended' ).'</span><br>' . $price . '&nbsp;<span class="price-suffix">' . __( '/ pers.' , 'wc-extended' ).'</span></div><div>';
	  return $new_price;
}
//add_filter( 'woocommerce_get_price_html', 'custom_price_message' );


// remove add to cart in loop shop
function custom_text_replace_button( $button, $product  ) {
	if( is_home() || is_front_page() )  {
		return;
	} else {
		$button_text = __('View offer', 'wc-extended');
		return '<a class="button" href="' . $product->get_permalink() . '"><i class="fas fa-toolbox"></i> ' . $button_text . '</a>';
	}
}
//add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_text_replace_button', 10, 2 );


// disable decimal on price
//add_filter( 'woocommerce_price_trim_zeros', '__return_true' );


/*
add_filter('request', function( $vars ) {
    global $wpdb;
    if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
        $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
        $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
        if( $exists ){
            $old_vars = $vars;
            $vars = array('product_cat' => $slug );
            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
            if ( !empty( $old_vars['orderby'] ) )
                    $vars['orderby'] = $old_vars['orderby'];
                if ( !empty( $old_vars['order'] ) )
                    $vars['order'] = $old_vars['order'];
        }
    }
    return $vars;
});
*/
