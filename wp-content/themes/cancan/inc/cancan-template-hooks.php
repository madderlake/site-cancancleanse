<?php
/**
 * Cancan hooks
 *
 * @package cancan
 */

add_action('init', 'cancan_hooks');

/**
 * Add and remove Cancan/Storefront functions.
 *
 * @return void
 */
function cancan_hooks()
{
    global $storefront_version;

    add_action('storefront_header', 'storefront_header_container', 0);

    remove_action('storefront_header', 'storefront_site_branding', 20);
    add_action('storefront_header', 'storefront_site_branding', 45);

    remove_action('storefront_header', 'storefront_product_search', 40);
    add_action('storefront_header', 'storefront_product_search', 32);

    remove_action('storefront_header', 'storefront_header_cart', 60);
    add_action('storefront_header', 'storefront_header_cart', 33);
    add_filter('woocommerce_add_to_cart_fragments', 'cancan_cart_link_fragment');

    add_action('woocommerce_shop_loop_subcategory_title', 'cancan_product_category_description_title_wrap', 5);
    add_action('woocommerce_shop_loop_subcategory_title', 'cancan_product_category_description', 15);
    add_action('woocommerce_shop_loop_subcategory_title', 'cancan_wrapper_close', 20);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    add_action('woocommerce_after_shop_loop_item', 'cancan_rating_button_wrapper', 6);
    add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 7);
    add_action('woocommerce_after_shop_loop_item', 'cancan_wrapper_close', 11);

    add_action('woocommerce_before_shop_loop_item_title', 'cancan_image_wapper', 9);
    add_action('woocommerce_before_shop_loop_item_title', 'cancan_wrapper_close', 11);

    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_footer', 'cancan_store_credit', 20);

    remove_action('storefront_post_header_before', 'storefront_post_meta', 10);
    add_action('storefront_post_content_after', 'cancan_post_meta', 10);
    // if ( version_compare( $storefront_version, '2.3.0', '>=' ) ) {
    //     remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
    //     add_action( 'storefront_header', 'storefront_header_container_close', 100 );
    // }
}
