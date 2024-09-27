<?php
/**
 * Cancan engine room
 *
 * @package cancan
 */

/**
 * Set the theme version number as a global variable
 */
$theme          = wp_get_theme( 'cancan' );
$cancan_version = $theme['Version'];

$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Load the individual classes required by this theme
 */
require_once( 'inc/class-cancan.php' );
require_once( 'inc/custom-post-types/testimonials.php' );
// require_once( 'inc/class-bistro-customizer.php' );
// require_once( 'inc/class-bistro-integrations.php' );
require_once( 'inc/cancan-template-hooks.php' );
require_once( 'inc/cancan-template-functions.php' );
require_once( 'inc/cancan-customizations.php' );
require_once( 'inc/cancan-shortcodes.php' );
require_once( 'inc/acf.php' );
require_once( 'inc/plugged.php' );

/**
 * Do not add custom code / snippets here.
 * While Child Themes are generally recommended for customisations, in this case it is not
 * wise. Modifying this file means that your changes will be lost when an automatic update
 * of this theme is performed. Instead, add your customisations to a plugin such as
 * https://github.com/woothemes/theme-customisations
 */

/**
 * Exclude products from a particular category on the shop page
 */
// function custom_pre_get_posts_query( $q ) {

//     $tax_query = (array) $q->get( 'tax_query' );

//     $tax_query[] = array(
//            'taxonomy' => 'product_cat',
//            'field' => 'slug',
//            'terms' => array( 'legacy' ),
//            'operator' => 'NOT IN'
//     );


//     $q->set( 'tax_query', $tax_query );

// }
// add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );

