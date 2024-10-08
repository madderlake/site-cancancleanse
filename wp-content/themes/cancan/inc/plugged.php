<?php
/**
 * Plugged functions
 * Any functions declared here are overwriting counterparts from a plugin or Storefront core.
 *
 * @package storechild
 */

/**
 * Cart Link
 * @since  1.0.0
 */
if ( ! function_exists( 'storefront_cart_link' ) ) {
	function storefront_cart_link() {
		$count    = '<div class="cancan-header-count count">' . wp_kses_data( WC()->cart->get_cart_contents_count() ) . '</div>';
		if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
			$cart_url = get_permalink( woocommerce_get_page_id( 'cart' ) );
		} else {
			$cart_url = get_permalink( wc_get_page_id( 'cart' ) );
		}


		if ( ! is_checkout() ) {
			echo $count;
		} else {
			echo '<a href="' . $cart_url . '">' . $count . '</a>';
		}
	}
}

add_action('admin_init', 'cancan_check_username');
function cancan_check_username()
{
    $user = wp_get_current_user();

    if($user && isset($user->user_login) && 'teresa' == $user->user_login) {
        echo "Teresa is working on the site";
    }
}