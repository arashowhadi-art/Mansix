<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Themento_product_classic extends Widget_Base {

    public function get_name(){return 'themento-product-classic';}
    public function get_title(){return __( 'Product Classic', text_domain);}
    public function get_icon() {return 'eicon-products';}
    public function get_categories() {return [ 'shop_karauos' ];}

    protected function _register_controls() {
        $this->register_general_product_grid_controls();
        $this->register_general_product_slider_controls();
        $this->register_general_style_product_grid_controls();
        $this->register_image_style_product_grid_controls();
        $this->register_title_style_product_grid_controls();
        $this->register_rating_style_product_grid_controls();
        $this->register_price_style_product_grid_controls();
        $this->register_button_style_product_grid_controls();
        $this->register_badge_style_product_grid_controls();
        $this->register_pagination_product_grid_controls();
        $this->register_general_product_style_slider_controls();
    }

    protected function register_general_product_grid_controls() {
        $this->start_controls_section(
            'section_product_grid',
            [
                'label' => __( 'product Settings' ,text_domain)
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label' => __( 'Post Type', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'product',
                'options' => [
                    'product' => __( 'Product', text_domain ),
                    'cross_sells' => __( 'Cross Sells',   text_domain ),
                ],
            ]
        );


        $this->add_control(
            'show_product_type',
            [
                'label'   => esc_html__( 'Show Product', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all'      => esc_html__( 'All Products', text_domain ),
                    'onsale'   => esc_html__( 'On Sale', text_domain ),
                    'featured' => esc_html__( 'Featured', text_domain ),
                ],
            ]
        );

        $this->add_control(
            'product_grid_columns',
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
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'products_count',
            [
                'label' => __( 'Number of Posts', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4'
            ]
        );
        $this->add_control(
            'products_order',
            [
                'label' => __( 'Order', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => __( 'Ascending', text_domain ),
                    'desc' => __( 'Descending', text_domain )
                ],
                'default' => 'desc',
            ]
        );
        $product_categories = get_terms( 'product_cat' );

        $options = [];
        foreach ( $product_categories as $category ) {
            $options[ $category->slug ] = $category->name;
        }

        $this->add_control(
            'product_categories',
            [
                'label'       => esc_html__( 'Categories', text_domain ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $options,
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        $this->add_control(
            'exclude_products',
            [
                'label'       => esc_html__( 'Exclude Product(s)', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'placeholder'     => 'product_id',
                'label_block' => true,
                'description' => __( 'Write product id here, if you want to exclude multiple products so use comma as separator. Such as 1 , 2', text_domain ),
            ]
        );
        
        $this->add_control(
            'hide_free',
            [
                'label'   => esc_html__( 'Hide Free', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'hide_out_stock',
            [
                'label'   => esc_html__( 'Hide Out of Stock', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order by', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'  => esc_html__( 'Date', text_domain ),
                    'price' => esc_html__( 'Price', text_domain ),
                    'sales' => esc_html__( 'Sales', text_domain ),
                    'rand'  => esc_html__( 'Random', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', text_domain),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'show_rating',
            [
                'label'   => esc_html__( 'Rating', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_slider',
            [
                'label' => __( 'Enable Slider', text_domain),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'default' => 'no',
                'condition' => [
                    'show_pagination!' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_product_slider_controls() {
        $this->start_controls_section(
            'product_slider',
            [
                'label'     => esc_html__( 'Slider', text_domain ),
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '3',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'columns_tablet',
            [
                'label' => __( 'Columns Tablet', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '2',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'columns_mobile',
            [
                'label' => __( 'Columns Mobile', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '1',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slidesToScroll',
            [
                'label' => __( 'slides To Scroll', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
	                'both' => __( 'Arrows and Dots', text_domain ),
	                'arrows' => __( 'Arrows', text_domain ),
	                'dots' => __( 'Dots', text_domain ),
	                'none' => __( 'None', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
	            'label' => __( 'Pause on Hover', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
	            'label' => __( 'Autoplay', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'speed',
            [
	            'label' => __( 'Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );
        $this->add_control(
            'autoplay_speed',
            [
	            'label' => __( 'Autoplay Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
            ]
        );
        $this->add_control(
            'infinite',
            [
	            'label' => __( 'Infinite Loop', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'centerMode',
            [
                'label' => __( 'Center Mode', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
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
                'condition' => [
                    'show_rating' => 'yes',
                ],
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
    protected function register_pagination_product_grid_controls() {
		$this->start_controls_section(
			'section_pagination_post_grid_style',
			[
				'label' => __( 'Pagination', text_domain ),
				'condition' => [
					'show_pagination' => 'yes'
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'post_grid_pagination_alignment',
			[
				'label' => __( 'Pagination Alignment', text_domain ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'Right', text_domain ),
						'icon' => 'fa fa-align-right',
					],
					'center' => [
						'title' => __( 'Center', text_domain ),
						'icon' => 'fa fa-align-center',
					],
					'left' => [
						'title' => __( 'Left', text_domain ),
						'icon' => 'fa fa-align-left',
					]
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .pagination' => 'text-align: {{VALUE}};',
				]
			]
		);
		$this->start_controls_tabs('style_pagination_tabs');
		$this->start_controls_tab('style_pagination_normal_tab', ['label' => __( 'Normal', text_domain ),]);

		$this->add_control(
			'post_grid_pagination_number_color',
			[
				'label' => __( 'Pagination Number Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eead16',
				'selectors' => [
					'{{WRAPPER}} .navigation a' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_pagination_bg_color',
			[
				'label' => __( 'Pagination Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .navigation a' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_pagination_border',
				'selector' => '{{WRAPPER}} .navigation a',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab('style_pagination_hover_tab', ['label' => __( 'Hover', text_domain ),]);

		$this->add_control(
			'post_grid_pagination_number_hover_color',
			[
				'label' => __( 'Pagination Number Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_pagination_bg_hover_color',
			[
				'label' => __( 'Pagination Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eead16',
				'selectors' => [
					'{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_pagination_hover_border',
				'selector' => '{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'post_grid_pagination_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .navigation a, {{WRAPPER}} .pagination .current' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		$this->add_control(
			'pagination_size',
			[
				'label' => __( 'Pagination Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min' => 2,
						'max' => 5,
					],
				],
				'default' => [
					'unit' => 'em',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .navigation a, {{WRAPPER}} .pagination .current' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
    protected function register_general_product_style_slider_controls() {
        $this->start_controls_section(
            'style_slider',
            [
                'label' => __( 'Slider Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'slider_style',
            [
                'label' => __('Arrows Style', text_domain),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_responsive_control(
            'right_arrow',
            [
                'label' => __( 'Right Arrow', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'top: {{TOP}}%;right: {{RIGHT}}%;left: auto;',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_responsive_control(
            'left_arrow',
            [
                'label' => __( 'Left Arrow', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'left' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'top: {{TOP}}%;left: {{LEFT}}%;right: auto;',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );

        $this->start_controls_tabs( 'arrows_icon_tabs' );
        $this->start_controls_tab( 'arrows_icon_normal', [ 
            'label' => __( 'Normal', text_domain ),
            'condition' => [
                'navigation' => [ 'arrows', 'both' ],
            ],
        ] );

        $this->add_control(
            'arrow_slider_color',
            [
                'label' => __('Icon Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_control(
            'arrow_slider_bg_color',
            [
                'label' => __('Background Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 'arrows_icon_hover', [ 
            'label' => __( 'Hover', text_domain ),
            'condition' => [
                'navigation' => [ 'arrows', 'both' ],
            ],
        ] );

        $this->add_control(
            'arrow_slider_hover_color',
            [
                'label' => __('Icon Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#f19001',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover:before' => 'color: {{VALUE}}; '
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_control(
            'arrow_slider_hover_bg_color',
            [
                'label' => __('Background Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_slider_typography',
                'label' => __('Typography', text_domain),
                'selector' => '{{WRAPPER}} .slick-arrow:before',
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_radius_slider',
            [
                'label' => __('Border Radius', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_slider_padding',
            [
                'label' => esc_html__('Padding', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );


        $this->add_control(
            'dots_style',
            [
                'label' => __('Dots Style', text_domain),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_position',
            [
                'label' => __( 'Dots Position', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'top: {{TOP}}%;right: {{RIGHT}}%;left: auto;',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_slider_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_slider_height',
            [
                'label' => __( 'Height', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label' => __('Dots Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_control(
            'dot_active',
            [
                'label' => __('Active Dots Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#f19001',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dots_slider_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dots_slider_height',
            [
                'label' => __( 'Height', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_margin',
            [
                'label' => esc_html__('Margin', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_radius',
            [
                'label' => __('Border Radius', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'   => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li button,{{WRAPPER}} ul.slick-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $editor = Plugin::$instance->editor->is_edit_mode();
        $product_grid_columns = $settings['product_grid_columns'];
        $show_product_type = $settings['show_product_type'];
        $product_type = $settings['product_type'];

        echo "<div class='woocommerce'>";
            if($settings['enable_slider'] == 'yes') {
                $is_rtl = is_rtl();
                $direction = $is_rtl ? 'rtl' : 'ltr';
                $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
                $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
                $data_slick = [
                    'slidesToShow' => absint( $settings['columns'] ),
                    'slidesToScroll' => absint( $settings['slidesToScroll'] ),
                    'autoplay' => ( 'yes' === $settings['autoplay'] ),
                    'infinite' => ( 'yes' === $settings['infinite'] ),
                    'speed' => absint( $settings['speed'] ),
                    'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
                    'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
                    'arrows' => $show_arrows,
                    'dots' => $show_dots,
                    'rtl' => $is_rtl,
                    'centerMode' => ( 'yes' === $settings['centerMode'] ),
                    'responsive' => [
                        ['breakpoint' => 1024,
                            'settings' => ['slidesToShow' => absint( $settings['columns'] - 1 ),]
                        ],
                        ['breakpoint' => 769,
                            'settings' => ['slidesToShow' => absint( $settings['columns_tablet'] ),]
                        ],
                        ['breakpoint' => 480,
                            'settings' => ['slidesToShow' => absint( $settings['columns_mobile'] ),]
                        ],
                    ],
                ];

                $this->add_render_attribute( 'slides', [
                    'data-slick' => wp_json_encode( $data_slick ),
                ] );
                echo "<ul class='products product-slider' dir='". esc_attr( $direction ) ."' ". $this->get_render_attribute_string( 'slides' ) .">";
            } else {
                echo "<ul class='products flex flex-wrap $product_grid_columns'>";
            }
            switch ($product_type) {
                case "product":
                    $exclude_products = ($settings['exclude_products']) ? explode(',', $settings['exclude_products']) : [];
                    $args = array(
                        'posts_per_page' => $settings['products_count'],
                        'post_status' => 'publish',
                        'order' => $settings['products_order'],
                        'post_type' => 'product',
                        'post__not_in'        => $exclude_products,
                    );
                    if (!empty($settings['product_categories']) ) {
                        $args['tax_query'][] = array(
                            'taxonomy'           => 'product_cat',
                            'field'              => 'slug',
                            'terms'              => $settings['product_categories'],
                            'post__not_in'       => $exclude_products,
                        );
                    }
                    if ( 'yes' == $settings['hide_free'] ) {
                        $args['meta_query'][] = array(
                            'key'     => '_price',
                            'value'   => 0,
                            'compare' => '>',
                            'type'    => 'DECIMAL',
                        );
                    }
                    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                    if ( 'yes' == $settings['hide_out_stock'] ) {
                        $args['tax_query'][] = array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'term_taxonomy_id',
                                'terms'    => $product_visibility_term_ids['outofstock'],
                                'operator' => 'NOT IN',
                            ),
                        ); // WPCS: slow query ok.
                    }
                    switch ( $show_product_type ) {
                        case 'featured':
                            $args['tax_query'][] = array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'term_taxonomy_id',
                                'terms'    => $product_visibility_term_ids['featured'],
                            );
                            break;
                        case 'onsale':
                            $product_ids_on_sale    = wc_get_product_ids_on_sale();
                            $product_ids_on_sale[]  = 0;
                            $args['post__in'] = $product_ids_on_sale;
                            break;
                    }
            
            
                    switch ( $settings['orderby'] ) {
                        case 'price':
                            $args['meta_key'] = '_price'; // WPCS: slow query ok.
                            $args['orderby']  = 'meta_value_num';
                            break;
                        case 'rand':
                            $args['orderby'] = 'rand';
                            break;
                        case 'sales':
                            $args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
                            $args['orderby']  = 'meta_value_num';
                            break;
                        default:
                            $args['orderby'] = 'date';
                    }
            
                    $query = new \WP_Query($args);
                    if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
                        global $product;
            
                        // Ensure visibility.
                        if ( empty( $product ) || ! $product->is_visible() ) {
                            return;
                        }
                        ?>
                        <li <?php wc_product_class( '', $product ); ?>>
                            <div class="tmt-product-item">
                            <?php
                            if ($editor) {
                                woocommerce_template_loop_product_thumbnail();
                                woocommerce_template_loop_price();
                                wc_get_template( '/loop/sale-flash.php' );
                                echo '<h2 class="woocommerce-loop-product__title">'. get_the_title() .'</h2>';
                                woocommerce_template_loop_add_to_cart();
                            } else {
                                do_action( 'woocommerce_before_shop_loop_item' );
                                do_action( 'woocommerce_before_shop_loop_item_title' );
                                do_action( 'woocommerce_shop_loop_item_title' );
                                do_action( 'woocommerce_after_shop_loop_item_title' );
                                do_action( 'woocommerce_after_shop_loop_item' );
                            }
                            ?>
                            </div>
                        </li>
                        <?php
                    endwhile;
                        echo "</ul>";
                        if (( 'yes' === $settings['show_pagination'] )) {
                            $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
                            karauos_the_posts_navigation(3);
                        };
                    endif;wp_reset_postdata();
                break;
                case "cross_sells":
                    $crosssell_ids = get_post_meta( get_the_ID(), '_crosssell_ids' ); 
                    $crosssell_ids=$crosssell_ids[0];
                    if(count($crosssell_ids)>0){
                        $args = array(
                            'posts_per_page' => $products_count,
                            'post__in' => $crosssell_ids,
                            'post_status' => 'publish',
                            'post_type' => 'product',
                        );
                        $query = new \WP_Query($args);
                        if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
                        ?>
                        <li <?php wc_product_class( '', $product ); ?>>
                            <div class="tmt-product-item">
                            <?php
                            if ($editor) {
                                woocommerce_template_loop_product_thumbnail();
                                woocommerce_template_loop_price();
                                wc_get_template( '/loop/sale-flash.php' );
                                echo '<h2 class="woocommerce-loop-product__title">'. get_the_title() .'</h2>';
                                woocommerce_template_loop_add_to_cart();
                            } else {
                                do_action( 'woocommerce_before_shop_loop_item' );
                                do_action( 'woocommerce_before_shop_loop_item_title' );
                                do_action( 'woocommerce_shop_loop_item_title' );
                                do_action( 'woocommerce_after_shop_loop_item_title' );
                                do_action( 'woocommerce_after_shop_loop_item' );
                            }
                            ?>
                            </div>
                        </li>
                        <?php
                        endwhile;echo "</ul>";endif; wp_reset_postdata();
                    }
                break;  
            }
            
            echo "</div>";
        
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_product_classic );