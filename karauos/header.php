<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 4.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, height=device-height">
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <?php
    $meta_description = get_theme_mod( 'meta_description' );
    $before_closing_head = get_theme_mod( 'before_closing_head' );
    $mobile_color = get_theme_mod( 'mobile_color', '#eead16' );
    echo "<meta name='theme-color' content='$mobile_color' />";
    if(!is_rtl()) {echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">';}
    if(!empty($meta_description)) {echo "<meta name='description' content='$meta_description' />";}
    wp_head();
    if($before_closing_head){echo $before_closing_head;}
    echo '</head>';
    ?>
<body <?php body_class(); ?>>

<?php

// Get ID
$get_id = get_theme_mod( 'tmt_header_page_template' );

// Check if page is Elementor page
$elementor  = get_post_meta( $get_id, '_elementor_edit_mode', true );
$checkbox = get_theme_mod( 'checkbox_setting_id' );
echo "<header "; if($checkbox == true) {echo 'class="position-header"';} echo ">";

// Check if there is a template
if ( ! empty( $get_id ) ) {
    // If Elementor
    if ( $elementor ) {
        TMT_Elementor::get_header_content();
    }
}

echo "</header>";