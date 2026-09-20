<?php

if ( defined( 'KARAUOS_ELEMENTOR_ELEMENTS_LOADED' ) ) {
	return;
}
define( 'KARAUOS_ELEMENTOR_ELEMENTS_LOADED', true );


if ( ! class_exists( '\\Elementor\\Themento_post_widget' ) ) { require wp_directory .'/inc/elements/post-grid.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Post_Carousel' ) ) { require wp_directory .'/inc/elements/post-carousel.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Post_List' ) ) { require wp_directory .'/inc/elements/post-list.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Navbar' ) ) { require wp_directory .'/inc/elements/navbar.php'; }
if ( ! class_exists( '\\Elementor\\Themento_slider_widget' ) ) { require wp_directory .'/inc/elements/slider.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Widget_Social_Icons' ) ) { require wp_directory .'/inc/elements/social-icons.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Login' ) ) { require wp_directory .'/inc/elements/login.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Widget_Search' ) ) { require wp_directory .'/inc/elements/search.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Business_Hours' ) ) { require wp_directory .'/inc/elements/business-hours.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Info_Box' ) ) { require wp_directory .'/inc/elements/info-box.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Info_Box_Advanced' ) ) { require wp_directory .'/inc/elements/info-box-advanced.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Heading' ) ) { require wp_directory .'/inc/elements/tmt-heading.php'; }
if ( ! class_exists( '\\Elementor\\Themento_heading' ) ) { require wp_directory .'/inc/elements/heading.php'; }
if ( ! class_exists( '\\Elementor\\Themento_heading_Advanced' ) ) { require wp_directory .'/inc/elements/heading-advanced.php'; }
if ( ! class_exists( '\\Elementor\\Themento_header' ) ) { require wp_directory .'/inc/elements/header.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Gallery' ) ) { require wp_directory .'/inc/elements/gallery.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Flip_Box' ) ) { require wp_directory .'/inc/elements/flip-box.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Member' ) ) { require wp_directory .'/inc/elements/member.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Accordion' ) ) { require wp_directory .'/inc/elements/accordion.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Text_List' ) ) { require wp_directory .'/inc/elements/list.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Svg_Cover' ) ) { require wp_directory .'/inc/elements/svg.php'; }
if ( ! class_exists( '\\Elementor\\Themento_Video' ) ) { require wp_directory .'/inc/elements/video.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Tag_Cloud' ) ) { require wp_directory .'/inc/elements/tag-cloud.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Category_List' ) ) { require wp_directory .'/inc/elements/category-list.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Price' ) ) { require wp_directory .'/inc/elements/price.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Whatsapp' ) ) { require wp_directory .'/inc/elements/whatsapp.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Scroll_To_Top' ) ) { require wp_directory .'/inc/elements/scroll-to-top.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Testimonial' ) ) { require wp_directory .'/inc/elements/testimonial.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Tabs' ) ) { require wp_directory .'/inc/elements/tabs.php'; }
if ( ! class_exists( '\\Elementor\\Themento_icon_tab' ) ) { require wp_directory .'/inc/elements/icon-tab.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Category_Archive_Description' ) ) { require wp_directory .'/inc/elements/cat-archive-description.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Modal' ) ) { require wp_directory .'/inc/elements/modal.php'; }
//////////// SINGLE ELEMENT ////////////
if ( ! class_exists( '\\Elementor\\TMT_Title' ) ) { require wp_directory .'/inc/elements/single/title.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Content' ) ) { require wp_directory .'/inc/elements/single/content.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Start_Loop' ) ) { require wp_directory .'/inc/elements/single/start-loop.php'; }
if ( ! class_exists( '\\Elementor\\TMT_End_Loop' ) ) { require wp_directory .'/inc/elements/single/end-loop.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Post_Thumbnail' ) ) { require wp_directory .'/inc/elements/single/thumbnail.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Breadcrumbs' ) ) { require wp_directory .'/inc/elements/single/breadcrumb.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Post_Info' ) ) { require wp_directory .'/inc/elements/single/post-info.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Comments' ) ) { require wp_directory .'/inc/elements/single/comments.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Short_Link' ) ) { require wp_directory .'/inc/elements/single/short-link.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Social_Share' ) ) { require wp_directory .'/inc/elements/single/social-share.php'; }
if ( ! class_exists( '\\Elementor\\TMT_Before_After' ) ) { require wp_directory .'/inc/elements/single/before-after.php'; }
//////////// SHOP ELEMENT ////////////
if(woo) {
    if ( ! class_exists( '\\Elementor\\Themento_product_widget' ) ) { require wp_directory .'/inc/elements/shop/product.php'; }
    if ( ! class_exists( '\\Elementor\\Themento_product_classic' ) ) { require wp_directory .'/inc/elements/shop/product-classic.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Basket' ) ) { require wp_directory .'/inc/elements/shop/basket.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Shop_Elements' ) ) { require wp_directory .'/inc/elements/shop/shop-elements.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Archive_Product' ) ) { require wp_directory .'/inc/elements/shop/archive-product.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Images' ) ) { require wp_directory .'/inc/elements/shop/product-images.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Price' ) ) { require wp_directory .'/inc/elements/shop/product-price.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Add_To_Cart' ) ) { require wp_directory .'/inc/elements/shop/product-add-to-cart.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Meta' ) ) { require wp_directory .'/inc/elements/shop/product-meta.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Rating' ) ) { require wp_directory .'/inc/elements/shop/product-rating.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Related' ) ) { require wp_directory .'/inc/elements/shop/product-related.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Short_Description' ) ) { require wp_directory .'/inc/elements/shop/product-short-description.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Product_Data_Tabs' ) ) { require wp_directory .'/inc/elements/shop/product-data-tabs.php'; }
    if ( ! class_exists( '\\Elementor\\TMT_Archive_Description' ) ) { require wp_directory .'/inc/elements/shop/archive-description.php'; }
}
//////////// PLUGINS ELEMENT ////////////
if (pll) {
    if ( ! class_exists( '\\Elementor\\TMT_Language_Switcher' ) ) { require wp_directory .'/inc/elements/language-switcher.php'; }
}
if (class_exists( 'WPCF7_ContactForm' ) ) {
    if ( ! class_exists( '\\Elementor\\Themento_wpcf7' ) ) { require wp_directory .'/inc/elements/cf-styler.php'; }
}
if ( class_exists( 'GFCommon' ) ) {
    if ( ! class_exists( '\\Elementor\\Themento_Gravity_Forms' ) ) { require wp_directory .'/inc/elements/gravity-forms.php'; }
}
if(class_exists('yoast_breadcrumb')){
    if ( ! class_exists( '\\Elementor\\TMT_Yoast_Breadcrumb' ) ) { require wp_directory .'/inc/elements/single/yoast-breadcrumb.php'; }
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
