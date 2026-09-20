<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 4.0.0
 */

get_header();

// Get ID
$get_id = get_theme_mod( 'tmt_error_page_template' );

// Check if page is Elementor page
$elementor  = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Check if there is a template
if ( ! empty( $get_id ) ) {
    // If Elementor
    if ( $elementor ) {
        TMT_Elementor::get_error_page_content();
    }
}


get_footer();