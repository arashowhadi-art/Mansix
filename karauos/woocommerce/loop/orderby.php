<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="sort-by">
    <span><i class="fas fa-sort-amount-down"></i> <?php echo __('Sort by: ', text_domain) ?> </span>
    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
        <?php
        $link = remove_query_arg( 'orderby' );
        $link = add_query_arg( array( 'orderby' => $id ), $link );
        $name = str_replace( __('Sort by ', text_domain), '', esc_html( $name ) );
        $name = str_replace( __('Sort ', text_domain), '', esc_html( $name ) );
        $name = str_replace( 'مرتب سازی بر اساس ', '', esc_html( $name ) );
        $name = str_replace( 'بر اساس ', '', esc_html( $name ) );
        $name = str_replace( 'مرتب سازی ', '', esc_html( $name ) );
        $name = str_replace( '', '', esc_html( $name ) );
        ?>
        <a href="<?php echo $link; ?>" class="list-inline-item <?php echo $orderby == $id ? 'active' : ''; ?>" rel="nofollow"><?php echo $name; ?></a>
    <?php endforeach; ?>
</div>