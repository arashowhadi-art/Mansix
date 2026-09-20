<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Themento_product_widget extends Widget_Base{

    public function get_name(){return 'themento-product-grid';}
    public function get_title(){return __( 'Product', text_domain);}
    public function get_icon() {return 'eicon-products';}
    public function get_categories() {return [ 'shop_karauos' ];}

    protected function _register_controls() {

        $this->start_controls_section(
            'section_woocommerce_layout',
            [
                'label' => esc_html__( 'Layout', text_domain ),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'Columns', text_domain ),
                'type'           => Controls_Manager::SELECT,
                'default'        => '4',
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'   => esc_html__( 'Column Gap', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-products-wrapper.grid' => 'grid-column-gap: {{SIZE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'   => esc_html__( 'Row Gap', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-products-wrapper.grid' => 'grid-row-gap: {{SIZE}}px',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label'   => esc_html__( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', text_domain ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', text_domain ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', text_domain ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .star-rating' => 'text-align: {{VALUE}}; display: inline-block !important',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image',
                'label'     => esc_html__( 'Image Size', text_domain ),
                'exclude'   => [ 'custom' ],
                'default'   => 'medium',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_query',
            [
                'label' => esc_html__( 'Query', text_domain ),
            ]
        );

        $this->add_control(
            'source',
            [
                'label'   => _x( 'Source', 'Posts Query Control', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''        => esc_html__( 'Show All', text_domain ),
                    'by_name' => esc_html__( 'Manual Selection', text_domain ),
                ],
                'label_block' => true,
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
                'condition'   => [
                    'source'    => 'by_name',
                ],
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
            'posts_per_page',
            [
                'label'   => esc_html__( 'Product Limit', text_domain ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
            ]
        );

        $this->add_control(
            'show_product_type',
            [
                'label'   => esc_html__( 'Show Product', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'total_sales',
                'options' => [
                    'all'      => esc_html__( 'All Products', text_domain ),
                    'onsale'   => esc_html__( 'On Sale', text_domain ),
                    'featured' => esc_html__( 'Featured', text_domain ),
                ],
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
            'order',
            [
                'label'   => esc_html__( 'Order', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__( 'Descending', text_domain ),
                    'ASC'  => esc_html__( 'Ascending', text_domain ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_woocommerce_additional',
            [
                'label' => esc_html__( 'Additional', text_domain ),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label'     => esc_html__( 'Show Badge', text_domain ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'   => esc_html__( 'Title', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
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
            'show_price',
            [
                'label'   => esc_html__( 'Price', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label'   => esc_html__( 'Add to Cart', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_item',
            [
                'label'     => esc_html__( 'Item', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'item_border',
                'label'       => esc_html__( 'Border Color', text_domain ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Item Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__( 'Description Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner:hover' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_shadow',
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-wc-product-inner:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => esc_html__( 'Image Border', text_domain ),
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-image',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-image',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label'     => esc_html__( 'Title', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_title_color',
            [
                'label'     => esc_html__( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-title:hover a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_rating',
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
                    '{{WRAPPER}} .tmt-wc-products .star-rating:before' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tmt-wc-products .star-rating span' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tmt-wc-products .star-rating span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_price',
            [
                'label'     => esc_html__( 'Price', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'old_price_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price del' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'old_price_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'old_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price del',
            ]
        );

        $this->add_control(
            'sale_price_heading',
            [
                'label'     => esc_html__( 'Sale Price', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price, {{WRAPPER}} .tmt-wc-products .tmt-wc-product-price ins' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sale_price_margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price, {{WRAPPER}} .tmt-wc-products .tmt-wc-product-price ins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sale_price_typography',
                'label'    => esc_html__( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product-price, {{WRAPPER}} .tmt-wc-products .tmt-wc-product-price ins',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label'     => esc_html__( 'Button', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cart' => 'yes',
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
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border',
                'label'       => esc_html__( 'Border', text_domain ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_fullwidth',
            [
                'label'     => esc_html__( 'Fullwidth Button', text_domain ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a' => 'width: 100%;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'label'     => esc_html__( 'Typography', text_domain ),
                'selector'  => '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a',
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
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-add-to-cart a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

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
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'label'       => esc_html__( 'Border', text_domain ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'badge_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_shadow',
                'selector' => '{{WRAPPER}} .tmt-wc-products .tmt-wc-product .tmt-badge',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    public function render_image() {
        $settings = $this->get_settings();
        ?>
        <div class="tmt-wc-product-image tmt-background-cover">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size']); ?>">
            </a>
        </div>
        <?php
    }

    public function render_header() {

        $settings = $this->get_settings();

        $this->add_render_attribute('wc-products', 'class', 'tmt-wc-products');

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wc-products' ); ?>>

        <?php
    }

    public function render_footer() {
        ?>
        </div>
        <?php
    }

    public function render_query() {
        $settings = $this->get_settings();

        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }

        $exclude_products = ($settings['exclude_products']) ? explode(',', $settings['exclude_products']) : [];

        $query_args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['posts_per_page'],
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => true,
            'meta_query'          => [],
            'tax_query'           => [ 'relation' => 'AND' ],
            'paged'               => $paged,
            'order'               => $settings['order'],
            'post__not_in'        => $exclude_products,
        );

        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

        if ( 'by_name' === $settings['source'] and !empty($settings['product_categories']) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'           => 'product_cat',
                'field'              => 'slug',
                'terms'              => $settings['product_categories'],
                'post__not_in'       => $exclude_products,
            );
        }

        if ( 'yes' == $settings['hide_free'] ) {
            $query_args['meta_query'][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        if ( 'yes' == $settings['hide_out_stock'] ) {
            $query_args['tax_query'][] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['outofstock'],
                    'operator' => 'NOT IN',
                ),
            ); // WPCS: slow query ok.
        }


        switch ( $settings['show_product_type'] ) {
            case 'featured':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'onsale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
        }


        switch ( $settings['orderby'] ) {
            case 'price':
                $query_args['meta_key'] = '_price'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
            case 'sales':
                $query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            default:
                $query_args['orderby'] = 'date';
        }

        $wp_query = new \WP_Query($query_args);

        return $wp_query;
    }

    public function render_loop_item() {
        $settings = $this->get_settings();
        $id       = 'tmt-wc-product-' . $this->get_id();

        $wp_query = $this->render_query();

        if($wp_query->have_posts()) {


            $this->add_render_attribute(
                [
                    'wc-products-wrapper' => [
                        'class' => [
                            'tmt-wc-products-wrapper',
                            'flex',
                            'flex-wrap',
                            'cols-'. $settings['columns'],
                        ],
                        'id' => esc_attr( $id ),
                    ],
                ]
            );

            ?>
            <div <?php echo $this->get_render_attribute_string( 'wc-products-wrapper' ); ?>>
                <?php

                $this->add_render_attribute( 'wc-product', 'class', 'tmt-wc-product' );

                while ( $wp_query->have_posts() ) : $wp_query->the_post(); global $product; ?>

                    <div <?php echo $this->get_render_attribute_string( 'wc-product' ); ?>>
                        <div class="tmt-wc-product-inner">
                            <?php if ( $settings['show_badge'] and $product->is_on_sale() ) : ?>
                                <div class="tmt-badge">
					  			<?php woocommerce_show_product_loop_sale_flash(); ?>
				  			</div>
                            <?php endif; ?>

                            <?php $this->render_image(); ?>

                            <div class="tmt-wc-product-desc">
                                <?php if ( 'yes' == $settings['show_title']) : ?>
                                    <h2 class="tmt-wc-product-title">
                                        <a href="<?php the_permalink(); ?>" class="tmt-link-reset">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                <?php endif; ?>

                                <?php if (('yes' == $settings['show_price']) or ('yes' == $settings['show_rating'])) : ?>
                                    <?php if ( 'yes' == $settings['show_price']) : ?>
                                        <span class="tmt-wc-product-price">
										<?php woocommerce_template_single_price(); ?>
									</span>
                                    <?php endif; ?>

                                    <?php if ('yes' == $settings['show_rating']) : ?>
                                        <div class="tmt-wc-rating">
					           			<?php woocommerce_template_loop_rating(); ?>
				           			</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php if ('yes' == $settings['show_cart']) : ?>
                                <div class="tmt-wc-add-to-cart">
								<?php woocommerce_template_loop_add_to_cart();?>
							    </div>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php endwhile;	?>

            </div>
            <?php
            wp_reset_postdata();

            the_posts_navigation();

        } else {
            echo '<div class="tmt-alert-warning">' . esc_html__( 'Ops! There is no product.', text_domain ) .'<div>';
        }
    }

    public function render() {
        $this->render_header();
        $this->render_loop_item();
        $this->render_footer();
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_product_widget );