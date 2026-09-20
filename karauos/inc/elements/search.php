<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Widget_Search extends Widget_Base {

    public function get_name() {
        return 'tmt-search-form';
    }

    public function get_title() {
        return __( 'Search Form', text_domain );
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'search', 'form' ];
    }


    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_btn_controls();
        $this->register_general_style_controls();
        $this->register_input_form_style_controls();
        $this->register_btn_form_style_controls();
        $this->register_general_btn_style_controls();
    }
    protected function register_general_content_controls() {
        $this->start_controls_section(
            'search_content',
            ['label' => __( 'Search Form', text_domain ),]
        );

        $this->add_control(
			'skin',
			[
				'label'   => __( 'Skin', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', text_domain ),
					'dropdown' => __( 'Dropdown', text_domain ),
				],
				'render_type'  => 'template',
			]
        ); 
        
        $this->add_control(
            'placeholder',
            [
                'label' => __( 'Placeholder', text_domain ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'default' => __( 'Search', text_domain ) . '...',
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => __( 'Type', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __( 'Icon', text_domain ),
                    'text' => __( 'Text', text_domain ),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Search', text_domain ),
                'separator' => 'after',
                'condition' => [
                    'button_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
                'condition' => [
                    'button_type' => 'icon',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_align',
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
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_responsive_control(
            'form_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_btn_controls() {
        $this->start_controls_section(
            'section_btn',
            [
                'label' => __( 'Button Dropdown', text_domain ),
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __( 'Text', text_domain ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Type your text here', text_domain ),
                'condition' => [
                    'skin' => 'dropdown',
                ],
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
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_style_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_width',
            [
                'label' => __( 'DropDown Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .search-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
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
                    '{{WRAPPER}} .search-content' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin' => 'dropdown',
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
                    '{{WRAPPER}} .search-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
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
                    '{{WRAPPER}} .search-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
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
                    '{{WRAPPER}} .search-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .search-content',
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .search-content',
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_input_form_style_controls() {
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __( 'Input Form', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} input[type="search"]',
            ]
        );
        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => __( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
					'{{WRAPPER}} input[type="search"]' => 'color: {{VALUE}}',
					'{{WRAPPER}} ::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255,255,255,.2)',
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} input[type="search"]',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow',
                'selector' => '{{WRAPPER}} input[type="search"]',
            ]
        );
        $this->add_responsive_control(
            'input_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            ['label' => __( 'Focus', text_domain ),]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} input[type="search"]:focus::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color_focus',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border_focus',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} input[type="search"]:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_focus',
                'selector' => '{{WRAPPER}} input[type="search"]:focus',
            ]
        );
        $this->add_responsive_control(
            'input_width_focus',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]:focus' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '50',
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '4',
                    'right' => '10',
                    'bottom' => '4',
                    'left' => '10',
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="search"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_btn_form_style_controls() {
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => __( 'Button Form', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_position',
            [
                'label' => __( 'Position', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'fa fa-align-left',
                    ],
                ],
                'default' => 'left',
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} svg' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'button_type' => 'icon',
                ],
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs( 'tabs_button_colors' );

        $this->start_controls_tab(
            'tab_button_normal',
            ['label' => __( 'Normal', text_domain ),]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999',
                'selectors' => [
                    '{{WRAPPER}} button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            ['label' => __( 'Hover', text_domain ),]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} button:hover svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} button',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '4',
                    'right' => '10',
                    'bottom' => '4',
                    'left' => '10',
                ],
                'selectors' => [
                    '{{WRAPPER}} button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_btn_style_controls() {
        $this->start_controls_section(
            'section_btn_style',
            [
                'label' => __( 'Button Dropdown', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
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
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->start_controls_tabs( 'tabs_btn_colors' );
        $this->start_controls_tab('tab_btn_normal',['label' => __( 'Normal', text_domain ),]);

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
        $this->start_controls_tab('tab_btn_hover',['label' => __( 'Hover', text_domain ),]);

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

        $this->add_control(
            'btn_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'btn_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drop-down-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .drop-down-btn',
                'condition' => [
                    'skin' => 'dropdown',
                ],
            ]
        );

        $this->end_controls_section();
    }

    
    protected function render() {
        $settings = $this->get_settings();
        $skin = $settings['skin'];
        
        switch($skin) {
            case 'default' :
                $this->search_form($settings);
            break;
            case 'dropdown' :
                $btn_text = $settings['btn_text'];
                $btn_align = $settings['btn_align'];
                $this->add_render_attribute( 'btn_class','class', ['drop-down-btn', 'inline-flex', 'align-items-center']  );
                if ($btn_align == 'left') {
                    $this->add_render_attribute( 'btn_class','class', ['flex-row-reverse', 'justify-content-end']);
                }
                $btn_class = $this->get_render_attribute_string( 'btn_class' );
                $form_align = $settings['form_align'];
                $aligns = '';
                switch ($form_align) {
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
                echo "<div class='search-form drop-down flex justify-content-$form_align'>"
                    . "<div>"
                        . "<span $btn_class>$btn_text "; Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); echo "</span>"
                        . "<div class='search-content drop-down-content$aligns'>";
                            $this->search_form($settings);
                        echo "</div>"
                        . "</div>"
                . "</div>";
            break;
        }
        
    }

    private function search_form($settings) {
        $placeholder = $settings['placeholder'];
        $button_type = $settings['button_type'];
        $form_align = $settings['form_align'];
        ?>
        <form class="flex align-items-center justify-content-<?php echo $form_align; ?> search<?php if($settings['btn_position'] == 'left') {echo ' flex-row-reverse';} ?>" method="get" action="<?php bloginfo('url'); ?>">
            <input type="search" name="s" placeholder="<?php echo $placeholder; ?>">
            <button type="submit">
                <?php if ($button_type == 'icon') {Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );}
                else {echo $settings['button_text'];} ?>
            </button>
        </form>
        <?php
    }

    

}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Widget_Search );