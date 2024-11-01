<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}


/**
 * Overwrite product_tag taxonomy properties to effectively hide it from WP admin ..
 */
add_action('init', function() {
    register_taxonomy('product_cat', 'product', [
        'public'            => false,
        'show_ui'           => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
    ]);
}, 101); //override remove slug module

/**
 * .. and also remove the column from Products table - it's also hardcoded there.
 */
add_action( 'admin_init' , function() {
    add_filter('manage_product_posts_columns', function($columns) {
        unset($columns['product_cat']);
        return $columns;
    }, 100);
});
