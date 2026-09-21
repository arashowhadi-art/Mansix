jQuery(document).ready(function ($) {
    new $.Zebra_Pin($('.tmt-sticky-yes'), {class_name: 'is-sticky'});

    $('.blocks-gallery-item a').attr("data-fancybox", "gallery");
    $('.wp-block-image a').attr("data-fancybox", "");
    $('[data-fancybox="gallery"]').fancybox();
    $('.wpcf7-submit').parent().addClass('tmt-wpcf7-submit');

	$(".tmt-navbar-wrapper").parents('.elementor-row,.elementor-container').addClass('position-menu');
	
    // Accordion
    $(".tmt-accordion-title").on("click", function() {
        if ($(this).hasClass("tmt-open")) {
            $(this).removeClass("tmt-open");
            $(this).siblings(".tmt-accordion-content").slideUp(200);
        } else {
            if ($(this).hasClass("multiple")) {}
            else {
                $(".tmt-accordion-title").removeClass("tmt-open");
                $(".tmt-accordion-content").slideUp(200);
            }
            $(this).addClass("tmt-open");
            $(this).siblings(".tmt-accordion-content").slideDown(200);
        }
    });

    // Tabs    
    $('.tab-nav-item').on("click", function() {
        var id = $(this).attr('rel');
        $(this).parents('.tmt-tabs').find('.tmt-open').removeClass('tmt-open');
        $(this).addClass('tmt-open');
        $('#'+id).addClass('tmt-open');
    });

    // STAART Back to Top Settings
    var btn = $('#top');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
    // END Back to Top Settings

    
    // Whatsapp
    $( ".whatsapp-pupup" ).click(function(e) {
        e.stopPropagation();
        $( ".whatsapp-chat" ).toggleClass( "open-chat");
        $(this).children("i").toggleClass( "fab fa-whatsapp fas fa-times");
    });

    // Icon header
    $(window).click(function(){$(".drop-down-content").slideUp(300);});
    $('.drop-down-content,.drop-down-btn').click(function(e){e.stopPropagation();});
    $(".drop-down-btn").on("click", function(e) {
        e.preventDefault();
        if ($(this).hasClass("tmt-open")) {
            $(this).removeClass("tmt-open");
            $(this).next(".drop-down-content").slideUp(300);
        } else {
            $(".drop-down-btn").removeClass("tmt-open");
            $(".drop-down-content").slideUp(300);
            $(this).addClass("tmt-open");
            $(this).next(".drop-down-content").slideDown(300);
        }
    });


    $(document).on('click', '.elementor-product-simple .single_add_to_cart_button:not(.disabled)', function (e) {
        e.preventDefault();

        var $thisbutton = $(this),
                $form = $thisbutton.closest('form.cart'),
                id = $thisbutton.val(),
                product_qty = $form.find('input[name=quantity]').val() || 1,
                product_id = $form.find('input[name=product_id]').val() || id,
                variation_id = $form.find('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {

                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
					$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
					var count = $('.shopping-cart .card-count').text();
					var x = parseInt(count) + parseInt(product_qty);
					$('.shopping-cart .card-count').html(x);
                }
            },
        });

        return false;
	});

    // wc_add_to_cart_params is required to continue, ensure the object exists
	if ( typeof wc_add_to_cart_params === 'undefined' )
    return false;

    // Ajax add to cart
    $( document ).on( 'click', '.variations_form .single_add_to_cart_button', function(e) {
        
        e.preventDefault();
        
        $variation_form = $( this ).closest( '.variations_form' );
        var var_id = $variation_form.find( 'input[name=variation_id]' ).val();
        var product_id = $variation_form.find( 'input[name=product_id]' ).val();
        var quantity = $variation_form.find( 'input[name=quantity]' ).val();
        
        //attributes = [];
        $( '.ajaxerrors' ).remove();
        var item = {},
            check = true;
            
            variations = $variation_form.find( 'select[name^=attribute]' );
            
            /* Updated code to work with radio button - mantish - WC Variations Radio Buttons - 8manos */ 
            if ( !variations.length) {
                variations = $variation_form.find( '[name^=attribute]:checked' );
            }
            
            /* Backup Code for getting input variable */
            if ( !variations.length) {
                variations = $variation_form.find( 'input[name^=attribute]' );
            }
        
        variations.each( function() {
        
            var $this = $( this ),
                attributeName = $this.attr( 'name' ),
                attributevalue = $this.val(),
                index,
                attributeTaxName;
        
            $this.removeClass( 'error' );
        
            if ( attributevalue.length === 0 ) {
                index = attributeName.lastIndexOf( '_' );
                attributeTaxName = attributeName.substring( index + 1 );
        
                $this
                    .addClass( 'required error' )
                    .before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' )
        
                check = false;
            } else {
                item[attributeName] = attributevalue;
            }
        
        } );
        
        if ( !check ) {
            return false;
        }
        
        var $thisbutton = $( this );

        if ( $thisbutton.is( '.variations_form .single_add_to_cart_button' ) ) {

            $thisbutton.removeClass( 'added' );
            $thisbutton.addClass( 'loading' );

            var data = {
                action: 'woocommerce_add_to_cart_variable_tmt',
            };

            $variation_form.serializeArray().map(function (attr) {
                if (attr.name !== 'add-to-cart') {
                    if (attr.name.endsWith('[]')) {
                        let name = attr.name.substring(0, attr.name.length - 2);
                        if (!(name in data)) {
                            data[name] = [];
                        }
                        data[name].push(attr.value);
                    } else {
                        data[attr.name] = attr.value;
                    }
                }
            });

            // Trigger event
            $( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

            // Ajax action
            $.post( wc_add_to_cart_params.ajax_url, data, function( response ) {

                if ( ! response ) {
                    return;
                }

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                }

                // Trigger event so themes can refresh other areas.
                $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
                var count = document.querySelector(".shopping-cart .card-count").textContent;
                var x = parseInt(count) + parseInt(quantity);
                $('.shopping-cart .card-count').html(x);

            });

            return false;

        } else {
            
            return true;
        }

    });
});

( function( $ ) {
    var WidgetElementorSlidesHandler = function( $scope, $ ) {
        $scope.find('.tmt-slider').slick();
    };
    var WidgetElementorCarouselHandler = function( $scope, $ ) {
        $scope.find('.slider-show').slick({responsive: [{breakpoint: 1024, settings: {slidesToShow: 3}},{breakpoint: 769, settings: {slidesToShow: 2}}, {breakpoint: 480, settings: {slidesToShow: 1}}]});
    };
    var WidgetElementorTestimonialHandler = function( $scope, $ ) {
        $scope.find('.testimonial-slider').slick();
    };
    var WidgetElementorTabHandler = function( $scope, $ ) {
        $scope.find('.tab-nav-item').on("click", function() {
            var id = $(this).attr('rel');
            $(this).parents('.tmt-tabs').find('.tmt-open').removeClass('tmt-open');
            $(this).addClass('tmt-open');
            $('#'+id).addClass('tmt-open');
        });
    };
    var WidgetElementorProductHandler = function( $scope, $ ) {
        $scope.find('.product-slider').slick();
    };
    var WidgetElementorPostHandler = function( $scope, $ ) {
        $scope.find('.post-slider').slick();
    };
    var WidgetElementorMenuHandler = function( $scope, $ ) {
        $scope.find('.menu').click(function(){$('.responsive-fix .tmt-navbar-wrapper').removeClass('open-menu');});
        $scope.find(window).click(function(){$('.responsive-under .tmt-navbar-wrapper').removeClass('open-menu');});
        $scope.find('.responsive-under .tmt-navbar-wrapper').click(function(e){e.stopPropagation();});
    	$scope.find('.main-menu').click(function(e){e.stopPropagation();});
        $scope.find(".bars").click(function(e){
            e.preventDefault();
            if($(this).parents('.tmt-navbar-wrapper').hasClass('open-menu')) {
                $('.tmt-navbar-wrapper').removeClass('open-menu');
            } else {
                $('.tmt-navbar-wrapper').removeClass('open-menu');
                $(this).parents('.tmt-navbar-wrapper').addClass('open-menu');
            }
        });
        $scope.find(".menu-item-has-children").click(function(e) {e.stopPropagation();$(this).toggleClass('open-sub-menu');});
        $scope.find(".menu-item-has-children > ul").click(function(e) {e.stopPropagation();$(this).addClass('open-sub-menu');});
        $scope.find(".open-sub-menu-yes .menu-item-has-children").addClass('open-sub-menu');
        $scope.find("li.mega-menu").parents("li.menu-item-has-children").addClass("main-mega-menu");
    };
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/themento_slides.default', WidgetElementorSlidesHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/themento_post_carousel.default', WidgetElementorCarouselHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmt-testimonial.default', WidgetElementorTestimonialHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmt-tabs.default', WidgetElementorTabHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/themento-product-classic.default', WidgetElementorProductHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/themento-post-grid.default', WidgetElementorPostHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmt-navbar.default', WidgetElementorMenuHandler );
    } );
} )( jQuery );