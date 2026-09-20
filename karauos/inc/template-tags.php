<?php

function seo_title() {
	if(is_singular()){
		$title = get_the_title();
	} elseif (is_category()) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} else {
		$title = wp_title( '' );
	}
	return $title;
}

if ( ! function_exists( 'karauos_the_posts_navigation' ) ) :

    function karauos_the_posts_navigation($number) {
        the_posts_pagination(
            array(
                'mid_size' => $number,
                'prev_text' => ('<i class="fas fa-angle-double-left"></i>'),
                'next_text' => ('<i class="fas fa-angle-double-right"></i>'),
            )
        );
    }
endif;

if ( ! function_exists( 'tmt_post_thumbnail' ) ) :

    function tmt_post_thumbnail($size) {
        if (has_post_thumbnail()) :
            the_post_thumbnail($size, array('alt' => '' . get_the_title() . '', 'title' => '' . get_the_title() . ''));
        else :
            echo '<img src="' . wp_directory_uri . '/assets/images/thumbnail.jpg" alt="' . get_the_title() . '" />';
        endif;
    }
endif;

if ( ! function_exists( 'excerpt_post' ) ) :
    function excerpt_post($number) {
        preg_match("/^([^.!?\s]*[\.!?\s]+){0,$number}/", strip_tags(get_the_content()), $abstract);echo $abstract[0] . '...';
    }
endif;


function themento_position() {
    $position_options = [
        ''              => esc_html__('Default', text_domain),
        'top-left'      => esc_html__('Top Left', text_domain) ,
        'top-center'    => esc_html__('Top Center', text_domain) ,
        'top-right'     => esc_html__('Top Right', text_domain) ,
        'center'        => esc_html__('Center', text_domain) ,
        'center-left'   => esc_html__('Center Left', text_domain) ,
        'center-right'  => esc_html__('Center Right', text_domain) ,
        'bottom-left'   => esc_html__('Bottom Left', text_domain) ,
        'bottom-center' => esc_html__('Bottom Center', text_domain) ,
        'bottom-right'  => esc_html__('Bottom Right', text_domain) ,
    ];

    return $position_options;
}


function TMT_Title_Tags() {
    $title_tags = [
        'h1'   => esc_html__( 'H1', text_domain ),
        'h2'   => esc_html__( 'H2', text_domain ),
        'h3'   => esc_html__( 'H3', text_domain ),
        'h4'   => esc_html__( 'H4', text_domain ),
        'h5'   => esc_html__( 'H5', text_domain ),
        'h6'   => esc_html__( 'H6', text_domain ),
        'div'  => esc_html__( 'div', text_domain ),
        'span' => esc_html__( 'span', text_domain ),
        'p'    => esc_html__( 'p', text_domain ),
    ];

    return $title_tags;
}

if ( ! function_exists( 'GFCommon' ) ) :
function themento_gravity_forms_options() {


    if ( class_exists( 'GFCommon' ) ) {
        $contact_forms = RGFormsModel::get_forms( null, 'title' );
        $form_options = ['0' => esc_html__( 'Select Form', text_domain )];
        if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {
            foreach ( $contact_forms as $form ) {
                $form_options[ $form->id ] = $form->title;
            }
        }
    } else {
        $form_options = ['0' => esc_html__( 'Form Not Found!', text_domain ) ];
    }

    return $form_options;
}
endif;

function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        text_domain,
        [
            'title' => __( 'Karauos', text_domain ),
            'icon' => 'fa fa-plug',
        ]
    );
    $elements_manager->add_category(
        'single_karauos',
        [
            'title' => __( 'Single Karauos', text_domain ),
            'icon' => 'fa fa-plug',
        ]
    );
    $elements_manager->add_category(
        'shop_karauos',
        [
            'title' => __( 'Shop Karauos', text_domain ),
            'icon' => 'fa fa-plug',
        ]
    );

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

__( 'Current loop', text_domain );


        
if(woo) {
    function woocommerce_ajax_add_to_cart() {
       $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
       $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
       $variation_id = absint($_POST['variation_id']);
       $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
       $product_status = get_post_status($product_id);
       if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
           do_action('woocommerce_ajax_added_to_cart', $product_id);

           if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
               wc_add_to_cart_message(array($product_id => $quantity), true);
           }
           WC_AJAX :: get_refreshed_fragments();
       } else {
           $data = array(
               'error' => true,
               'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
           wp_send_json($data);
       }

       wp_die();
   }
   
   add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
   add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
   
   function wc_varb_price_range( $wcv_price, $product ) {
 
        $prefix = sprintf('%s ', '');
     
        $wcv_reg_min_price = $product->get_variation_regular_price( 'min', true );
        $wcv_min_sale_price    = $product->get_variation_sale_price( 'min', true );
        $wcv_max_price = $product->get_variation_price( 'max', true );
        $wcv_min_price = $product->get_variation_price( 'min', true );
     
        $wcv_price = ( $wcv_min_sale_price == $wcv_reg_min_price ) ?
            wc_price( $wcv_reg_min_price ) :
            '<del>' . wc_price( $wcv_reg_min_price ) . '</del>' . '<ins>' . wc_price( $wcv_min_sale_price ) . '</ins>';
     
        return ( $wcv_min_price == $wcv_max_price ) ?
            $wcv_price :
            sprintf('%s%s', $prefix, $wcv_price);
    }
     
    add_filter( 'woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2 );

    function woocommerce_add_to_cart_variable_tmt_callback() {
    	ob_start();
    	
    	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    	$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
    	$variation_id = $_POST['variation_id'];		
    
    	$cart_item_data = $_POST;
    	unset($cart_item_data['quantity']);
    	
    	$variation = array();
    
    	foreach ($cart_item_data as $key => $value) {
    		if (preg_match("/^attribute*/", $key)) {
    			$variation[$key] = $value;
    		}
    	}
    	
    	foreach ($variation as $key=>$value) { $variation[$key] = stripslashes($value); }
    	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
    
    	if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data  ) ) {
    		do_action( 'woocommerce_ajax_added_to_cart', $product_id );
    		if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
    			wc_add_to_cart_message( $product_id );
    		}
    		global $woocommerce;
    		$items = $woocommerce->cart->get_cart();
    		wc_setcookie( 'woocommerce_items_in_cart', count( $items ) );
            wc_setcookie( 'woocommerce_cart_hash', md5( json_encode( $items ) ) );
            do_action( 'woocommerce_set_cart_cookies', true );
    		// Return fragments
    		WC_AJAX::get_refreshed_fragments();
    	
    	} else {
    
    		// If there was an error adding to the cart, redirect to the product page to show any errors
    		$data = array(
    			'error' => true,
    			'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
    		);
    		wp_send_json_error( $data );
    	}
    }
    add_action( 'wp_ajax_woocommerce_add_to_cart_variable_tmt', 'woocommerce_add_to_cart_variable_tmt_callback' );
    add_action( 'wp_ajax_nopriv_woocommerce_add_to_cart_variable_tmt', 'woocommerce_add_to_cart_variable_tmt_callback' );
}

// Remove Wordpress From Admin Pages Titles
function tmt_my_admin_title($admin_title, $title) {
    return $title . ' - ' . get_bloginfo('name');
}
add_filter('admin_title', 'tmt_my_admin_title', 10, 2);
add_filter('login_title', 'tmt_my_admin_title', 10, 2);