<?php
/**
 * Karauos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 3.0.0
 */

define("wp_directory", get_template_directory());
define("wp_directory_uri", get_template_directory_uri());
define("woo", class_exists('WooCommerce'));
define("pll", function_exists('pll_default_language'));
define("wpml", function_exists('icl_object_id'));
define("text_domain", 'karauos');

if (!function_exists('karauos_setup')) :
    /**
     * Theme setup
     */
    function karauos_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Nineteen, use a find and replace
         * to change text_domain to the name of your theme in all the template files.
         */
        load_theme_textdomain(text_domain, wp_directory . '/languages');

        // Update Translate
        $base = wp_directory;
        $path = dirname(dirname($base)) . '/languages/themes';
        $path = str_replace("\\", "/", $path);
        $base = str_replace("\\", "/", $base);
        copy("$base/languages/fa_IR.mo","$path/karauos-fa_IR.mo");
        copy("$base/languages/fa_IR.po","$path/karauos-fa_IR.po");


        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Woocommerce
         *
         * See: https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
        */
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array('main' => __('Main Menu', text_domain)));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }
endif;
add_action('after_setup_theme', 'karauos_setup');


/**
 * Enqueue scripts and styles.
 */
function karauos_scripts()
{

    /* Theme stylesheet */
    wp_enqueue_style('karauos-style', get_stylesheet_uri());

    wp_register_script('fancybox', wp_directory_uri . '/assets/js/jquery.fancybox.min.js', array('jquery'), '3.0.0', true);
    wp_enqueue_script('fancybox');

    wp_register_script('slick', wp_directory_uri . '/assets/js/slick.min.js', array('jquery'), '3.0.0', true);
    wp_enqueue_script('slick');

    wp_register_script('inc', wp_directory_uri . '/assets/js/inc.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('inc');

    wp_register_script('prefixfree', wp_directory_uri . '/assets/js/prefixfree.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('prefixfree');

    wp_register_script('sticky', wp_directory_uri . '/assets/js/sticky.min.js', array('jquery'), '2.0.0', true);
    wp_enqueue_script('sticky');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action('wp_enqueue_scripts', 'karauos_scripts');


/**
 * Includes PHP Files.
 */
require wp_directory . '/inc/inc.php';