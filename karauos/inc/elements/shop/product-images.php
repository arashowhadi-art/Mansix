<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Product_Images extends Widget_Base{

	public function get_name(){
		return 'tmt-product-images';
	}

	public function get_title(){
		return __( 'Product Images', text_domain );
	}

	public function get_icon() {
		return 'eicon-product-images';
	}

	public function get_categories() {
		return [ 'shop_karauos' ];
    }
    
    public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'image', 'product', 'gallery', 'lightbox' ];
	}

    protected function _register_controls() {
        $this->register_general_style_product_grid_controls();
    }

    protected function register_general_style_product_grid_controls() {
        $this->start_controls_section(
            'general_style',
            [
                'label'     => esc_html__( 'General', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'sale_flash',
			[
				'label' => __( 'Sale Flash', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', text_domain ),
				'label_off' => __( 'Hide', text_domain ),
				'render_type' => 'template',
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => '',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-product-gallery__trigger + .woocommerce-product-gallery__wrapper,
				.woocommerce {{WRAPPER}} .flex-viewport, .woocommerce {{WRAPPER}} .flex-control-thumbs img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-product-gallery__trigger + .woocommerce-product-gallery__wrapper,
					.woocommerce {{WRAPPER}} .flex-viewport' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'spacing',
			[
				'label' => __( 'Spacing', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .flex-viewport:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_thumbs_style',
			[
				'label' => __( 'Thumbnails', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'thumbs_border',
				'selector' => '.woocommerce {{WRAPPER}} .flex-control-thumbs img',
			]
		);

		$this->add_responsive_control(
			'thumbs_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .flex-control-thumbs img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'spacing_thumbs',
			[
				'label' => __( 'Spacing', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .flex-control-thumbs li' => 'padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-bottom: {{SIZE}}{{UNIT}}',
					'.woocommerce {{WRAPPER}} .flex-control-thumbs' => 'margin-right: calc(-{{SIZE}}{{UNIT}} / 2); margin-left: calc(-{{SIZE}}{{UNIT}} / 2)',
				],
			]
		);
		$this->add_control(
			'heading_onsale_style',
			[
				'label' => __( 'Onsale', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'onsale_typography',
                'label'     => esc_html__( 'Typography', text_domain ),
                'selector'  => '{{WRAPPER}} span.onsale',
                'separator' => 'before',
            ]
        );
		$this->add_control(
            'onsale_text_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} span.onsale' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'onsale_background_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} span.onsale' => 'background-color: {{VALUE}};',
                ],
            ]
		);
		$this->add_control(
            'onsale_padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '3',
                    'right' => '10',
                    'bottom' => '3',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'onsale_border',
				'selector' => '{{WRAPPER}} span.onsale',
			]
		);

		$this->add_responsive_control(
			'onsale_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->end_controls_section();
    }

	public function render() {
		$settings = $this->get_settings_for_display();
		global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		if ( 'yes' === $settings['sale_flash'] ) {
			wc_get_template( 'loop/sale-flash.php' );
		}
		wc_get_template( 'single-product/product-image.php' );

		// On render widget from Editor - trigger the init manually.
		if ( wp_doing_ajax() ) {
			?>
			<script>
				jQuery( '.woocommerce-product-gallery' ).each( function() {
					jQuery( this ).wc_product_gallery();
				} );
			</script>
			<?php
		}
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Product_Images );