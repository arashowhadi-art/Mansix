<?php

/**
 * Template Name: Page Without Elementor
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 4.0.0
 */

__( 'Page Without Elementor', text_domain );

get_header();

// Get ID
$get_id = get_theme_mod( 'tmt_static_page_template' );

// Check if page is Elementor page
$elementor  = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Check if there is a template
if ( ! empty( $get_id ) ) {
    // If Elementor
    if ( $elementor ) {
        TMT_Elementor::get_static_page_content();
    }
}

get_footer();