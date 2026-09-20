<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Product_Related extends Widget_Base {

	public function get_name() {
		return 'tmt-product-related';
	}

	public function get_title() {
		return __( 'Product Related', text_domain );
	}

	public function get_icon() {
		return 'eicon-product-related';
	}

	public function get_categories() {
		return [ 'shop_karauos' ];
	}
	
	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'related', 'similar', 'product' ];
	}

	protected function _register_controls() {
        $this->register_general_product_grid_controls();
        $this->register_general_style_product_grid_controls();
        $this->register_image_style_product_grid_controls();
        $this->register_title_style_product_grid_controls();
        $this->register_rating_style_product_grid_controls();
        $this->register_price_style_product_grid_controls();
        $this->register_button_style_product_grid_controls();
        $this->register_badge_style_product_grid_controls();
	}


	protected function register_general_product_grid_controls() {
        $this->start_controls_section(
            'section_product_grid',
            [
                'label' => __( 'product Settings' ,text_domain)
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Number of Columns', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cols-4',
                'options' => [
                    'cols-1' => __( '1 Columns', text_domain ),
                    'cols-2' => __( '2 Columns', text_domain ),
                    'cols-3' => __( '3 Columns', text_domain ),
                    'cols-4' => __( '4 Columns', text_domain ),
                    'cols-5' => __( '5 Columns', text_domain ),
                    'cols-6' => __( '6 Columns', text_domain ),
                ],
            ]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Products Per Page', text_domain ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'range' => [
					'px' => [
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', text_domain ),
					'title' => __( 'Title', text_domain ),
					'price' => __( 'Price', text_domain ),
					'popularity' => __( 'Popularity', text_domain ),
					'rating' => __( 'Rating', text_domain ),
					'rand' => __( 'Random', text_domain ),
					'menu_order' => __( 'Menu Order', text_domain ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', text_domain ),
					'desc' => __( 'DESC', text_domain ),
				],
			]
		);
		$this->add_control(
            'heading_heading',
            [
                'label'     => esc_html__( 'Heading', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .related > h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .related > h2',
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label' => __( 'Text Align', text_domain ),
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
					'{{WRAPPER}} .related > h2' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => __( 'Spacing', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .related > h2' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
            'height',
            [
                'label'   => esc_html__( 'Height', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 430,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-product-item' => 'height: {{SIZE}}px',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    protected function register_general_style_product_grid_controls() {
        $this->start_controls_section(
            'general_style',
            [
                'label'     => esc_html__( 'General', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'item_gap',
            [
                'label'   => esc_html__( 'Column Gap', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product' => 'padding-right: {{SIZE}}px;padding-left: {{SIZE}}px',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_gap',
            [
                'label'   => esc_html__( 'Row Gap', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product' => 'padding-top: {{SIZE}}px;padding-bottom: {{SIZE}}px',
                ],
            ]
        );
        $this->start_controls_tabs( 'tabs_item_style' );

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label'     => esc_html__( 'Background', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-product-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'item_border',
                'label'       => esc_html__( 'Border Color', text_domain ),
                'selector'    => '{{WRAPPER}} .tmt-product-item',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => false,
				],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .tmt-product-item',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Item Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__( 'Hover', text_domain ),
            ]
        );

        $this->add_control(
            'item_hover_background',
            [
                'label'     => esc_html__( 'Background', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-product-item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-product-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_shadow',
                'selector' => '{{WRAPPER}} .tmt-product-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function register_image_style_product_grid_controls() {
        $this->start_controls_section(
            'image_style',
            [
                'label'     => esc_html__( 'Image', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => esc_html__( 'Image Border', text_domain ),
                'selector' => '{{WRAPPER}} img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'    => 'image_shadow',
                'exclude' => [
                    'shadow_position',
                ],
                'selector' => '{{WRAPPER}} img',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_title_style_product_grid_controls() {
        $this->start_controls_section(
            'title_style',
            [
                'label'     => esc_html__( 'Title', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'align_title',
            [
                'label'   => __( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-loop-product__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-loop-product__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_title_color',
            [
                'label'     => esc_html__( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .product:hover .woocommerce-loop-product__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-product__title',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_rating_style_product_grid_controls() {
        $this->start_controls_section(
            'style_rating',
            [
                'label'     => esc_html__( 'Rating', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e7e7e7',
                'selectors' => [
                    '{{WRAPPER}} .star-rating:before' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'active_rating_color',
            [
                'label'     => esc_html__( 'Active Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFCC00',
                'selectors' => [
                    '{{WRAPPER}} .star-rating span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_price_style_product_grid_controls() {
        $this->start_controls_section(
            'style_price',
            [
                'label'     => esc_html__( 'Price', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_price_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .price' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top' => '4',
                    'right' => '10',
                    'bottom' => '4',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .price ins,{{WRAPPER}} .price .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sale_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .price ins,{{WRAPPER}} .price .woocommerce-Price-amount',
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
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .price del,{{WRAPPER}} .price del .woocommerce-Price-amount' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'old_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .price del .woocommerce-Price-amount',
            ]
        );

        

        $this->end_controls_section();
    }
    protected function register_button_style_product_grid_controls() {
        $this->start_controls_section(
            'style_button',
            [
                'label'     => esc_html__( 'Button', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align_button',
            [
                'label'   => __( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border',
                'label'       => esc_html__( 'Border', text_domain ),
                'selector'    => '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '3',
                    'left' => '3',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '15',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'size_units' => [ '%'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'label'     => esc_html__( 'Typography', text_domain ),
                'selector'  => '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} li.product a.added_to_cart',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', text_domain ),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'     => esc_html__( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product:hover .button,{{WRAPPER}} li.product:hover a.added_to_cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product:hover .button,{{WRAPPER}} li.product:hover a.added_to_cart' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border!' => '',
                ],
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product:hover .button,{{WRAPPER}} li.product:hover a.added_to_cart' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_badge_style_product_grid_controls() {
        $this->start_controls_section(
            'section_style_badge',
            [
                'label'     => esc_html__( 'Badge', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'     => esc_html__( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#051934',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
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
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'badge_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'label'       => esc_html__( 'Border', text_domain ),
                'selector'    => '{{WRAPPER}} .woocommerce ul.products li.product .onsale',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'badge_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_shadow',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .onsale',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
	}
	

	  
	
		
	protected function render() {
		$settings = $this->get_settings();

		global $product; // If not set…

		if( ! is_a( $product, 'WC_Product' ) ){
			$product = wc_get_product(get_the_id());
		}

		$args = array(
			'posts_per_page' => $settings['posts_per_page'],
			'columns'        => $settings['columns'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
		);

		if ( is_product() ) {
			$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
			$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

			// Set global loop values.
			wc_set_loop_prop( 'name', 'related' );
			wc_set_loop_prop( 'columns', $args['columns'] );

			wc_get_template( 'single-product/related.php', $args );
	   }
		

	}

}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Product_Related );