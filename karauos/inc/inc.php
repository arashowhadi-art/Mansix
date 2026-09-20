<?php
require wp_directory .'/inc/template-tags.php';
require wp_directory .'/inc/settings.php';
require wp_directory .'/inc/mj-wp-breadcrumb.php';
require wp_directory .'/inc/post-type.php';
require wp_directory .'/inc/taxonomy.php';
require wp_directory . '/inc/menus.php';
require wp_directory . '/inc/customizer/customizer-repeater/functions.php';
require wp_directory .'/inc/customizer/customizer.php';
require wp_directory .'/inc/sticky/sticky.php';

/**
 * Load Karauos custom Elementor widgets once Elementor's widgets manager is ready.
 */
function karauos_register_elementor_elements() {
    static $loaded = false;
    if ( $loaded ) {
        return;
    }
    $loaded = true;

    require wp_directory . '/inc/elementor.php';
}
add_action( 'elementor/widgets/register', 'karauos_register_elementor_elements' );
add_action( 'elementor/widgets/widgets_registered', 'karauos_register_elementor_elements' );