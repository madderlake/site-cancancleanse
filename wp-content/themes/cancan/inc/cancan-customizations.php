<?php
/* Remove Default Sorting */

add_action('wp', 'cancan_remove_default_sorting_storefront');

function cancan_remove_default_sorting_storefront()
{
   remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
   remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
   remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
   remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
}

/* Add Categories to Pages */

function cancan_add_categories_to_pages()
{
register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'cancan_add_categories_to_pages');

/* Show products only of the selected category. */

function get_subcategory_terms( $terms, $taxonomies, $args )
{

            $new_terms = array();
            $hide_category = array( 142 ); // Ids of the category you don't want to display on the shop page

// if a product category and on the shop page

            if ( in_array('product_cat', $taxonomies) && !is_admin() && is_shop() || is_home() ) {
                foreach ( $terms as $key => $term ) {
                        if ( ! in_array($term->term_id, $hide_category) ) {
                                    $new_terms[] = $term;
                        }
                }
                $terms = $new_terms;
            }
      return $terms;

}

add_filter('get_terms', 'get_subcategory_terms', 10, 3);
/* Remove WC Styles*/

// function cancan_remove_storefront_standard_functionality() {

// //remove customizer inline styles from parent theme as I don't need it.
// set_theme_mod('storefront_styles','');
// set_theme_mod('storefront_woocommerce_styles','');

// }

// add_action( 'init', 'cancan_remove_storefront_standard_functionality' );
// function cancan_deregister_scripts_and_styles(){
//     wp_deregister_style('storefront_styles');
//     //wp_deregister_style('storefront-style');
// }
// add_action( 'wp_print_styles', 'cancan_deregister_scripts_and_styles', 100 );
//


/**
 * Add the wp-editor back into WordPress after it was removed in 4.2.2.
 *
 * @see https://wordpress.org/support/topic/you-are-currently-editing-the-page-that-shows-your-latest-posts?replies=3#post-7130021
 * @param $post
 * @return void
 */
 function cancan_fix_no_editor_on_posts_page($post)
 {

   if( $post->ID != get_option('page_for_posts') ) { return;
   }

   remove_action('edit_form_after_title', '_wp_posts_page_notice');
   add_post_type_support('page', 'editor');

 }

 // This is applied in a namespaced file - so amend this if you're not namespacing
 add_action('edit_form_after_title', 'cancan_fix_no_editor_on_posts_page', 0);

function cancan_register_menus()
{
register_nav_menus(
    array(
      'social-menu' => __('Social Menu'),
      'footer-menu' => __('Footer Menu'),
     // 'an-extra-menu' => __( 'An Extra Menu' )
    )
);
}
add_action('init', 'cancan_register_menus');

/**
 * Register cancan widget areas
 */
function cancan_widgets_init()
{
register_sidebar(
    array(
    'name'          => __('Footer Full Width', 'cancan'),
    'id'            => 'footer-full-width',
    'description'   => __('Add widgets here to appear in your footer area.', 'cancan'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    )
);
}
add_action('widgets_init', 'cancan_widgets_init');

// disable srcset on frontend
function disable_wp_responsive_images()
{
    return true;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');

function filter_ptags_on_images($content)
{
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


// Remove archive type from archive page title

add_filter(
    'get_the_archive_title', function ($title) {
        if ( is_category() ) {
                $title = single_cat_title('', false);
} elseif ( is_tag() ) {
                $title = single_tag_title('', false);
    } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_tax() ) { //for custom post types
                $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
                $title = post_type_archive_title('', false);
    }
        return $title;
    }
);
