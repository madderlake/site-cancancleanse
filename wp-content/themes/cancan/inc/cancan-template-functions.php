<?php
/**
 * Cancan template functions.
 *
 * @package cancan
 */

if ( ! function_exists('cancan_cart_link_fragment') ) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param  array $fragments Fragments to refresh via AJAX.
     * @return array            Fragments to refresh via AJAX
     */
    function cancan_cart_link_fragment( $fragments )
    {
        global $woocommerce;

        ob_start();
        storefront_cart_link();
        $fragments['.cancan-header-count'] = ob_get_clean();

        return $fragments;
    }
}

/**
 * Specified how many categories to display on the homepage
 *
 * @param array $args The arguments used to control the layout of the homepage category section.
 */
function cancan_homepage_categories( $args )
{
    $args['limit']   = 6;
    $args['columns'] = 3;
    $args['exclude-from-catalog'] = array(123);

    return $args;
}

/**
 * Specified how many categories to display on the homepage
 *
 * @param array $args The arguments used to control the layout of the homepage category section.
 */
function cancan_homepage_products( $args )
{
    $args['limit']   = 9;
    $args['columns'] = 3;

    return $args;
}

/**
 * Display the product category description
 */
function cancan_product_category_description( $category )
{
    $cat_id      = $category->term_id;
    $prod_term   = get_term($cat_id, 'product_cat');
    $description = $prod_term->description;

    echo '<div class="shop_cat_desc">' . $description . '</div>';
}

/**
 * Category description wrapper
 */
function cancan_product_category_description_title_wrap()
{
    echo '<section class="cancan-category-title-description-wrap">';
}

/**
 * Product loop - image wrapper
 */
function cancan_image_wapper()
{
    echo '<section class="image-wrap">';
}

/**
 * Close wrappers
 */
function cancan_wrapper_close()
{
    echo '</section>';
}

/**
 * Rating / add to cart button wrapper
 * @return void
 */
function cancan_rating_button_wrapper()
{
    echo '<section class="cancan-rating-cart-button">';
}

/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs( $tabs )
{

    //unset( $tabs['description'] );          // Remove the description tab
    //unset( $tabs['reviews'] );             // Remove the reviews tab
    unset($tabs['additional_information']);      // Remove the additional information tab

    return $tabs;
}

/**
 * Rename product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs( $tabs )
{

    $tabs['description']['title'] = __('Product Details');        // Rename the description tab
    //$tabs['reviews']['title'] = __( 'Ratings' );                // Rename the reviews tab
    //$tabs['additional_information']['title'] = __( 'Product Data' );    // Rename the additional information tab

    return $tabs;

}

/**
 * Reorder product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_reorder_tabs', 98);
function woo_reorder_tabs( $tabs )
{

    $tabs['reviews']['priority'] = 15;            // Reviews first
    $tabs['description']['priority'] = 5;            // Description second
   // $tabs['additional_information']['priority'] = 10;    // Additional information third

    return $tabs;
}
// Remove the product description Title

add_filter('woocommerce_product_description_heading', '__return_null');




// Change the product description title -- or hide it as here:

add_filter('woocommerce_product_description_heading', 'change_product_description_heading');

function change_product_description_heading()
{

 return __('', 'woocommerce');

}

add_action('storefront_before_header', 'cancan_storefront_header_topbar', 40);

function cancan_storefront_header_topbar()
{
 ?>
    <div class="top-bar justify-right">
        <div class="col-full">
        <?php wp_nav_menu(array( 'theme_location' => 'social-menu' )); ?>
        </div>
    </div>
    <?php
}
add_action('storefront_before_footer', 'cancan_before_footer');

function cancan_before_footer()
{
    if ( is_active_sidebar('footer-full-width')  ) : ?>

 <div class="col-full footer" role="complementary">

  <?php dynamic_sidebar('footer-full-width'); ?>

 </div>

    <?php endif;
}

add_action('storefront_before_footer', 'cancan_after_footer');

function cancan_after_footer()
{
    if ( is_active_sidebar('footer-full-width')  ) : ?>

 <div class="col-full footer" role="complementary">

 <?php wp_nav_menu(array( 'theme_location' => 'social-menu' )); ?>

 </div>

    <?php endif;
}
function cancan_store_credit()
{
    ?>
    <div class="col-full copyright">
          <span class="message">Feel Ok? Good!&nbsp;</span> <?php echo esc_html(apply_filters('storefront_copyright_text', $content = '&copy;' . get_bloginfo('name') . ' ' . gmdate('Y'))); ?>
    </div>
<?php
}


// Single Post Meta

if ( ! function_exists('cancan_post_meta') ) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function cancan_post_meta()
    {
        if ( 'post' !== get_post_type() ) {
            return;
        }

        // Posted on.
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if ( get_the_time('U') !== get_the_modified_time('U') ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $output_time_string = sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string);
        $container_start = '<div class="cancan-post-meta">';
        $container_end = '</div>';
        $posted_on = '
			<span class="posted-on">' .
            /* translators: %s: post date */
            sprintf(__('Posted on %s', 'cancan'), $output_time_string) .
            '</span>';

        // Author.
        $author = sprintf(
            '<span class="post-author">%1$s <a href="%2$s" class="url fn" rel="author">%3$s</a></span>',
            __('by', 'cancan'),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_html(get_the_author())
        );

        // Comments.
        $comments = '';

        if ( ! post_password_required() && ( comments_open() || 0 !== intval(get_comments_number()) ) ) {
            $comments_number = get_comments_number_text(__('Leave a comment', 'cancan'), __('1 Comment', 'cancan'), __('% Comments', 'cancan'));

            $comments = sprintf(
                '<span class="post-comments">&mdash; <a href="%1$s">%2$s</a></span>',
                esc_url(get_comments_link()),
                $comments_number
            );
        }

        echo wp_kses(
            sprintf('%1$s %2$s %3$s %4$s %5$s', $container_start, $posted_on, $author, $comments, $container_end),
            array(
                'div' => array(
                    'class'=> array(),
				),
                'span' => array(
                    'class' => array(),
                ),
                'a'    => array(
                    'href'  => array(),
                    'title' => array(),
                    'rel'   => array(),
                ),
                'time' => array(
                    'datetime' => array(),
                    'class'    => array(),
                ),
            )
        );
    }
}
