<?php
/**
 * CanCan Class
 *
 * @author   WooThemes
 * @package  CanCan
 * @since    1.0
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

if ( ! class_exists('CanCan') ) {
    /**
     * The main CanCan class
     */
    class CanCan
    {
        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct()
        {
            add_filter('body_class', array( $this, 'body_classes' ));
            add_action('wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 40); // After Storefront
            add_filter('storefront_google_font_families', array( $this, 'cancan_fonts' ));
            add_filter('woocommerce_breadcrumb_defaults', array( $this,'change_breadcrumb_delimiter' ));

            add_filter('storefront_woocommerce_args', array( $this, 'woocommerce_support' ));

            add_filter('storefront_product_categories_args', array( $this, 'cancan_homepage_categories'));
            add_filter('storefront_recent_products_args', array( $this, 'cancan_homepage_products' ));
            add_filter('storefront_featured_products_args', array( $this, 'cancan_homepage_products' ));
            add_filter('storefront_popular_products_args', array( $this, 'cancan_homepage_products' ));
            add_filter('storefront_on_sale_products_args', array( $this, 'cancan_homepage_products' ));
            add_filter('storefront_best_selling_products_args', array( $this, 'cancan_homepage_products' ));
        }

        /**
         * Adds custom classes to the array of body classes.
         *
         * @param array $classes Classes for the body element.
         * @return array
         */
        public function body_classes( $classes )
        {
            global $storefront_version;

            if ( version_compare($storefront_version, '2.3.0', '>=') ) {
                $classes[] = 'storefront-2-3';
            }

            return $classes;
        }

        /**
         * Override Storefront default theme settings for WooCommerce.
         * @return array the modified arguments
         */
        public function woocommerce_support( $args )
        {
            $args['single_image_width']    = 420;
            $args['thumbnail_image_width'] = 360;

            return $args;
        }

        /**
         * Enqueue Storefront Styles
         *
         * @return void
         */
        public function enqueue_styles()
        {
            global $storefront_version, $cancan_version;

            /**
             * Styles
             */
            wp_enqueue_style('storefront-style', get_template_directory_uri() . '/style.css', $storefront_version);
            wp_enqueue_style('cancan-style', get_stylesheet_directory_uri() . '/assets/css/cancan.min.css', $storefront_version);
            wp_dequeue_style('storefront-gutenberg-blocks');
            wp_style_add_data('storefront-child-style', 'rtl', 'replace');

            if ( is_page_template('page-templates/template-homepage.php') ) {
                //wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . '/assets/css/vendor.slick.min.css' );
            }

            if ( is_page_template('page-templates/template-flex-content.php') ) {
                wp_enqueue_style('flex-template-styles', get_stylesheet_directory_uri() . '/assets/css/flex/flex-content.min.css');
            }

            /**
             * Javascript
             */
            wp_enqueue_script('cancan', get_stylesheet_directory_uri() . '/assets/js/cancan.min.js', array( 'jquery', 'select2'), $cancan_version, true);

            if ( is_page_template('page-templates/template-homepage.php') ) {
                //wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), true );
                //wp_enqueue_script( 'slick-init', get_stylesheet_directory_uri() . '/assets/js/slick-init.min.js', array( 'jquery' ), true );
            }
        }

        /**
         * Replaces Source Sans with the CanCan fonts
         *
         * @param  array $fonts the desired fonts.
         * @return array
         */
        public function cancan_fonts( $fonts )
        {
            $fonts = array(
                'alegreya'      => 'Alegreya:400,400italic,700,900',
                'alegreya-sans' => 'Alegreya+Sans:400,400italic,700,900',
            );

            return $fonts;
        }

        /**
         * Remove the breadcrumb delimiter
         * @param  array $defaults thre breadcrumb defaults
         * @return array           thre breadcrumb defaults
         */
        public function change_breadcrumb_delimiter( $defaults )
        {
            $defaults['delimiter'] = '<span class="breadcrumb-separator"> / </span>';
            return $defaults;
        }

        /**
         * Specified how many categories to display on the homepage
         *
         * @param array $args The arguments used to control the layout of the homepage category section.
         */
        public function cancan_homepage_categories( $args )
        {
            $args['limit']   = 4;
            $args['columns'] = 4;
            $args['exclude'] = array('142');
            return $args;
        }

        /**
         * Specified how many categories to display on the homepage
         *
         * @param array $args The arguments used to control the layout of the homepage category section.
         */
        public function cancan_homepage_products( $args )
        {
            $args['limit']   = 9;
            $args['columns'] = 3;

            return $args;
        }
    }
}

return new CanCan();
