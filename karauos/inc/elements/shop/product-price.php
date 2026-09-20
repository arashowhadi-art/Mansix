<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Product_Price extends Widget_Base{

	public function get_name(){
		return 'tmt-product-price';
	}

	public function get_title(){
		return __( 'Product Price', text_domain );
	}

	public function get_icon() {
		return 'eicon-product-price';
	}

	public function get_categories() {
		return [ 'shop_karauos' ];
    }
    
    public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'price', 'product', 'sale' ];
	}

    protected function _register_controls() {
        $this->register_general_style_product_grid_controls();
    }

    protected function register_general_style_product_grid_controls() {
        $this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', text_domain ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', text_domain ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', text_domain ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', text_domain ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'.single-product .woocommerce .woocommerce-variation-price .price' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .price' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'sale_price_heading',
            [
                'label'     => esc_html__( 'Price', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '.single-product .woocommerce  .price ins,.single-product .woocommerce  .price .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sale_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '.single-product .woocommerce  .price ins,.single-product .woocommerce  .price .woocommerce-Price-amount',
            ]
        );

        $this->add_control(
            'old_price_heading',
            [
                'label'     => esc_html__( 'Price Del', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'old_price_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '.single-product .woocommerce  .price del,.single-product .woocommerce  .price del .woocommerce-Price-amount' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'old_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '.single-product .woocommerce  .price del .woocommerce-Price-amount',
            ]
        );

		$this->end_controls_section();
    }

	protected function render() {
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		if($product->get_type() !== "variable") {
            wc_get_template( '/single-product/price.php' );
        }
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Product_Price );