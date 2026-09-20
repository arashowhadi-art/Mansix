<?php

require wp_directory .'/inc/elements/post-grid.php';
require wp_directory .'/inc/elements/post-carousel.php';
require wp_directory .'/inc/elements/post-list.php';
require wp_directory .'/inc/elements/navbar.php';
require wp_directory .'/inc/elements/slider.php';
require wp_directory .'/inc/elements/social-icons.php';
require wp_directory .'/inc/elements/login.php';
require wp_directory .'/inc/elements/search.php';
require wp_directory .'/inc/elements/business-hours.php';
require wp_directory .'/inc/elements/info-box.php';
require wp_directory .'/inc/elements/info-box-advanced.php';
require wp_directory .'/inc/elements/tmt-heading.php';
require wp_directory .'/inc/elements/heading.php';
require wp_directory .'/inc/elements/heading-advanced.php';
require wp_directory .'/inc/elements/header.php';
require wp_directory .'/inc/elements/gallery.php';
require wp_directory .'/inc/elements/flip-box.php';
require wp_directory .'/inc/elements/member.php';
require wp_directory .'/inc/elements/accordion.php';
require wp_directory .'/inc/elements/list.php';
require wp_directory .'/inc/elements/svg.php';
require wp_directory .'/inc/elements/video.php';
require wp_directory .'/inc/elements/tag-cloud.php';
require wp_directory .'/inc/elements/category-list.php';
require wp_directory .'/inc/elements/price.php';
require wp_directory .'/inc/elements/whatsapp.php';
require wp_directory .'/inc/elements/scroll-to-top.php';
require wp_directory .'/inc/elements/testimonial.php';
require wp_directory .'/inc/elements/tabs.php';
require wp_directory .'/inc/elements/icon-tab.php';
require wp_directory .'/inc/elements/cat-archive-description.php';
require wp_directory .'/inc/elements/modal.php';
//////////// SINGLE ELEMENT ////////////
require wp_directory .'/inc/elements/single/title.php';
require wp_directory .'/inc/elements/single/content.php';
require wp_directory .'/inc/elements/single/start-loop.php';
require wp_directory .'/inc/elements/single/end-loop.php';
require wp_directory .'/inc/elements/single/thumbnail.php';
require wp_directory .'/inc/elements/single/breadcrumb.php';
require wp_directory .'/inc/elements/single/post-info.php';
require wp_directory .'/inc/elements/single/comments.php';
require wp_directory .'/inc/elements/single/short-link.php';
require wp_directory .'/inc/elements/single/social-share.php';
require wp_directory .'/inc/elements/single/before-after.php';
//////////// SHOP ELEMENT ////////////
if(woo) {
    require wp_directory .'/inc/elements/shop/product.php';
    require wp_directory .'/inc/elements/shop/product-classic.php';
    require wp_directory .'/inc/elements/shop/basket.php';
    require wp_directory .'/inc/elements/shop/shop-elements.php';
    require wp_directory .'/inc/elements/shop/archive-product.php';
    require wp_directory .'/inc/elements/shop/product-images.php';
    require wp_directory .'/inc/elements/shop/product-price.php';
    require wp_directory .'/inc/elements/shop/product-add-to-cart.php';
    require wp_directory .'/inc/elements/shop/product-meta.php';
    require wp_directory .'/inc/elements/shop/product-rating.php';
    require wp_directory .'/inc/elements/shop/product-related.php';
    require wp_directory .'/inc/elements/shop/product-short-description.php';
    require wp_directory .'/inc/elements/shop/product-data-tabs.php';
    require wp_directory .'/inc/elements/shop/archive-description.php';
}
//////////// PLUGINS ELEMENT ////////////
if (pll) {
    require wp_directory .'/inc/elements/language-switcher.php';
}
if (class_exists( 'WPCF7_ContactForm' ) ) {
    require wp_directory .'/inc/elements/cf-styler.php';
}
if ( class_exists( 'GFCommon' ) ) {
    require wp_directory . '/inc/elements/gravity-forms.php';
}
if(class_exists('yoast_breadcrumb')){
    require wp_directory .'/inc/elements/single/yoast-breadcrumb.php';
}
if(class_exists('bn_parsidate')){
    global $wpp_settings;
    if (get_locale() == 'fa_IR' && $wpp_settings['persian_date'] == 'disable') {
        add_filter('the_time', 'wpp_fix_post_time', 10, 2);
        add_filter('the_date', 'wpp_fix_post_date', 10, 2);
        add_filter('get_the_time', 'wpp_fix_post_date', 10, 2);
        add_filter('get_the_date', 'wpp_fix_post_date', 10, 2);
        add_filter('get_comment_time', 'wpp_fix_comment_time', 10, 2);
        add_filter('get_comment_date', 'wpp_fix_comment_date', 10, 2);
        add_filter('date_i18n', 'wpp_fix_i18n', 10, 4);
        add_filter('wp_date', 'wpp_fix_i18n', 10, 4);
    }
}