<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 4.0.0
 */

// Get ID
$get_id = get_theme_mod( 'tmt_footer_page_template' );

// Check if page is Elementor page
$elementor  = get_post_meta( $get_id, '_elementor_edit_mode', true );

echo "<footer>";

// Check if there is a template
if ( ! empty( $get_id ) ) {
    // If Elementor
    if ( $elementor ) {
        TMT_Elementor::get_footer_content();
    }
}

echo "</footer>";

wp_footer();
$custom_js = get_theme_mod( 'custom_js' );
$before_closing_body = get_theme_mod( 'before_closing_body' );
if(!empty($custom_js)) { ?>
    <script type="text/javascript">
        <?php echo $custom_js; ?>
    </script>
<?php } if($before_closing_body){
    echo $before_closing_body;
}
?>
</body>
</html>