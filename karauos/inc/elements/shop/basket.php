<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TMT_Basket extends Widget_Base {

	public function get_name() {
		return 'tmt-basket';
	}

	public function get_title() {
		return __( 'Basket Shop', text_domain );
	}

	public function get_icon() {
		return 'eicon-basket-light';
	}

	public function get_categories() {
        return [ 'shop_karauos' ];
	}

	public function get_keywords() {
		return [ 'shop', 'basket', 'form'];
	}

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_btn_controls();
        $this->register_general_basket_style_controls();
        $this->register_general_btn_style_controls();
    }
    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __( 'Login', text_domain ),
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => __( 'Alignment', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '.elementor-editor-active {{WRAPPER}} .user-login' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_btn_controls() {
        $this->start_controls_section(
            'section_btn',
            [
                'label' => __( 'Button', text_domain ),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __( 'Text', text_domain ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Type your text here', text_domain ),
            ]
        );
        $this->add_control(
            'btn_align',
            [
                'label' => __( 'Alignment', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'show_count_cart',
            [
                'label' => __( 'Show Count Cart', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_basket_style_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'dropdown_width',
            [
                'label' => __( 'DropDown Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .shopping-cart-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .shopping-cart-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .drop-down-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .shopping-cart-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '15',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .shopping-cart-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .shopping-cart-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .shopping-cart-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .shopping-cart-content',
            ]
        );
        $this->add_control(
            'cart_product_title',
            [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .mini_cart_item a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cart_product_price',
            [
                'label' => __( 'Price', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quantity' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cart_product_remove_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .mini_cart_item a.remove_from_cart_button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cart_product_total_price',
            [
                'label' => __( 'Total Price', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .total' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cart_product_separator',
            [
                'label' => __( 'Separator', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .total' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'buttons_options',
            [
                'label' => __( 'Buttons', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs('style_btn_tabs');
        $this->start_controls_tab('style_btn_normal_tab', ['label' => __( 'Normal', text_domain ),]);
        $this->add_control(
            'btn_button_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttons a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_basket_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttons a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_btn_hover_tab', ['label' => __( 'Hover', text_domain ),]);
        $this->add_control(
            'h_btn_basket_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttons a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'h_btn_basket_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttons a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'btn_basket_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '4',
                    'right' => '4',
                    'bottom' => '4',
                    'left' => '4',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .buttons a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_basket_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '3',
                    'right' => '8',
                    'bottom' => '3',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .buttons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_basket_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .buttons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_basket_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .buttons a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_basket_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .buttons a',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_btn_style_controls() {
        $this->start_controls_section(
            'section_btn_style',
            [
                'label' => __( 'Button Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => __( 'Icon Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn i' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .drop-down-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
            ]
        );
        $this->start_controls_tabs( 'tabs_button_colors' );
        $this->start_controls_tab('tab_button_normal',['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'btn_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('tab_button_hover',['label' => __( 'Hover', text_domain ),]);

        $this->add_control(
            'h_btn_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'h_btn_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'h_btn_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
            ]
        );
        $this->add_control(
            'card_number_options',
            [
                'label' => __( 'Card Number Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'card_number_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .card-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'card_number_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#F00',
                'selectors' => [
                    '{{WRAPPER}} .card-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_count_position',
            [
                'label' => __( 'Card Count Position', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'right' ],
                'default' => [
                    'top' => '-12',
                    'right' => '-12',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-count' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();
        $show_count_cart = $settings['show_count_cart'];
        $btn_text = $settings['btn_text'];
        $btn_align = $settings['btn_align'];
        $this->add_render_attribute( 'btn_class','class', ['drop-down-btn', 'inline-flex', 'align-items-center']  );
        if ($btn_align == 'left') {
            $this->add_render_attribute( 'btn_class','class', ['flex-row-reverse', 'justify-content-end']);
        }
        $btn_class = $this->get_render_attribute_string( 'btn_class' );
        $align = $settings['align'];
        $aligns = '';
        switch ($align) {
            case 'left' :
                $aligns = ' left-0';
                break;
            case 'center' :
                $aligns = ' center-50';
                break;
            case 'right' :
                $aligns = ' right-0';
                break;
        }

        echo "<div class='shopping-cart drop-down flex justify-content-$align'>"
            . "<div>"
                . "<div $btn_class>$btn_text ";
                    Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
                    if ($show_count_cart == 'yes') {
                        if (!Plugin::$instance->editor->is_edit_mode()) {
                            $cart_count = WC()->cart->get_cart_contents_count();
                            if ($cart_count > 0) {echo "<span class='card-count'>$cart_count</span>";}
                        } else {
                            echo "<span class='card-count'>1</span>";
                        }
                    }
                echo "</div>"
                . "<div class='shopping-cart-content drop-down-content$aligns'>"
                    . '<div class="widget_shopping_cart_content"></div>'
                . "</div>"
            . "</div>"
        . "</div>";
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Basket );