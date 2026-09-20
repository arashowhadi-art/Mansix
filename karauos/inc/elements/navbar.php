<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class TMT_Navbar extends Widget_Base {

    public function get_name() {
        return 'tmt-navbar';
    }

    public function get_title() {
        return __( 'Navbar', text_domain );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'navbar', 'menu' ];
    }

    protected function tmt_get_menu() {

        $menus = wp_get_nav_menus();
        $items = ['0' => __( 'Select Menu', text_domain ) ];
        foreach ( $menus as $menu ) {
            $items[ $menu->slug ] = $menu->name;
        }

        return $items;
    }

    protected function _register_controls() {
        $this->register_navbar_controls();
        $this->register_dropdown_controls();
        $this->register_navbar_style_controls();
        $this->register_dropdown_style_controls();
        $this->register_responsive_style_controls();
    }
    protected function register_navbar_controls() {
        $this->start_controls_section(
            'section_navbar_content',
            [
                'label' => __( 'Navbar', text_domain ),
            ]
        );

        $this->add_control(
            'navbar',
            [
                'label'   => __( 'Select Menu', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->tmt_get_menu(),
                'default' => 0,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => __( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label'      => __( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_height',
            [
                'label' => __( 'Menu Height', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li > a' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_drop_down',
            [
                'label' => __( 'Submenu Icon', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'f067' => [
                        'title' => 'Plus',
                        'icon' => 'fas fa-plus',
                    ],
                    'f150' => [
                        'title' => 'Square Down',
                        'icon' => 'fas fa-caret-square-down',
                    ],
                    'f13a' => [
                        'title' => 'Circle Down',
                        'icon' => 'fas fa-chevron-circle-down',
                    ],
                    'f107' => [
                        'title' => 'Angle Down',
                        'icon' => 'fas fa-angle-down',
                    ],
                    'f103' => [
                        'title' => 'Angle Double Down',
                        'icon' => 'fas fa-angle-double-down',
                    ],
                    'f078' => [
                        'title' => 'Chevron Down',
                        'icon' => 'fas fa-chevron-down',
                    ],
                    'f0dd' => [
                        'title' => 'Sort Down',
                        'icon' => 'fas fa-sort-down',
                    ],
                ],
                'default' => 'f107',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_dropdown_controls() {
        $this->start_controls_section(
            'dropdown_content',
            [
                'label' => __( 'Dropdown', text_domain ),
            ]
        );

        $this->add_responsive_control(
            'dropdown_link_align',
            [
                'label'   => __( 'Item Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu li > a' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_padding',
            [
                'label'      => __( 'Dropdown Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu) > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_width',
            [
                'label' => __( 'Dropdown Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 400,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu .sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'dropdown_offset',
			[
				'label' => __( 'Dropdown Offset', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 35,
				],
				'selectors' => [
                    '{{WRAPPER}} .main-menu li.menu-item-has-children > .sub-menu' => 'padding-top: {{SIZE}}px;',
                    '{{WRAPPER}} .main-menu li.menu-item-has-children > .sub-menu .sub-menu' => 'padding-top: 0;',
				],
			]
        );
        $this->add_control(
			'dropdown_animation',
			[
				'label' => __( 'Dropdown Animation', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'none'  => __( 'None', text_domain ),
					'top' => __( 'Top', text_domain ),
					'right' => __( 'Right', text_domain ),
					'left' => __( 'Left', text_domain ),
                    'bottom' => __( 'Bottom', text_domain ),
                    '2db' => __( '2D Bottom', text_domain ),
                ],
                'prefix_class' => 'tmt-drop-',
			]
		);
        $this->add_control(
			'dropdown_submenu_offset',
			[
				'label' => __( 'Dropdown Submenu Offset', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 20,
				],
				'selectors' => [
                    '{{WRAPPER}} .sub-menu li.menu-item-has-children > .sub-menu' => 'padding-left: {{SIZE}}px;',
                    'body.rtl {{WRAPPER}} .sub-menu li.menu-item-has-children > .sub-menu' => 'padding-left: 0;padding-right: {{SIZE}}px;',
				],
			]
		);
        $this->add_control(
			'dropdown2_animation',
			[
				'label' => __( 'Dropdown SubMenu Animation', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'none'  => __( 'None', text_domain ),
					'top' => __( 'Top', text_domain ),
					'right' => __( 'Right', text_domain ),
					'left' => __( 'Left', text_domain ),
                    'bottom' => __( 'Bottom', text_domain ),
                ],
                'prefix_class' => 'tmt-drop2-',
			]
		);
        $this->end_controls_section();
    }
    protected function register_navbar_style_controls() {
        $this->start_controls_section(
            'section_menu_style',
            [
                'label' => __( 'Navbar', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'menu_link_styles' );
        $this->start_controls_tab( 'menu_link_normal', [ 'label' => __( 'Normal', text_domain ) ] );

        $this->add_control(
            'menu_link_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_link_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_spacing',
            [
                'label' => __( 'Gap', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 25,
                    ],
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'menu_border',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu > li',
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography_normal',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu > li > a',
            ]
        );

        $this->add_control(
            'menu_parent_arrow_color',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .main-menu li.menu-item-has-children::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'menu_link_hover', [ 'label' => __( 'Hover', text_domain ) ] );

        $this->add_control(
            'menu_link_color_hover',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li:hover > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_background_hover',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_border_color_hover',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius_hover',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography_hover',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu > li:hover > a',
            ]
        );

        $this->add_control(
            'menu_parent_arrow_color_hover',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .main-menu li.menu-item-has-children:hover::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 'menu_link_active', [ 'label' => __( 'Active', text_domain ) ] );

        $this->add_control(
            'menu_hover_color_active',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li.current-menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_hover_background_color_active',
            [
                'label'     => __( 'Background', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li.current-menu-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_border_color_active',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > li.current-menu-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius_active',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu > li.current-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography_active',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu > li.current-menu-item > a',
            ]
        );

        $this->add_control(
            'menu_parent_arrow_color_active',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu li.menu-item-has-children.current-menu-item::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'menu_parent_arrow_options',
            [
                'label' => __( 'Drop Down Icon', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'menu_parent_arrow_spacing',
            [
                'label'      => __( 'Offset', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'allowed_dimensions' => [ 'top', 'right' ],
                'default'    => [
                    'right' => '8',
                    'top' => '3',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu li.menu-item-has-children::after' => 'transform: translate({{RIGHT}}{{UNIT}},{{TOP}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_parent_arrow_typography',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu li.menu-item-has-children::after',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_dropdown_style_controls() {
        $this->start_controls_section(
            'dropdown_color',
            [
                'label' => __( 'Dropdown', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'dropdown_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:first-child' => 'border-top-left-radius: {{SIZE}}{{UNIT}};border-top-right-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .main-menu .sub-menu > li:last-child' => 'border-bottom-left-radius: {{SIZE}}{{UNIT}};border-bottom-right-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'dropdown_link_styles' );
        $this->start_controls_tab( 'dropdown_link_normal', [ 'label' => __( 'Normal', text_domain ) ] );

        $this->add_control(
            'dropdown_link_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu) > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_link_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu)' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_link_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dropdown_border_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu)',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_typography',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu) > a',
            ]
        );
        $this->add_control(
            'dropdown_menu_parent_arrow_color',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'dropdown_link_hover', [ 'label' => __( 'Hover', text_domain ) ] );

        $this->add_control(
            'dropdown_link_hover_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu):hover > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_link_hover_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu):hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dropdown_border_hover_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu):hover',
            ]
        );
        $this->add_responsive_control(
            'dropdown_radius_hover',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu):hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_typography_hover',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li:not(.mega-menu):hover > a',
            ]
        );

        $this->add_control(
            'dropdown_parent_arrow_color_hover',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children:hover::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'dropdown_link_active', [ 'label' => __( 'Active', text_domain ) ] );

        $this->add_control(
            'dropdown_link_active_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.current-menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_link_active_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.current-menu-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dropdown_border_active_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li.current-menu-item',
            ]
        );
        $this->add_responsive_control(
            'dropdown_border_active_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.current-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_typography_active',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li.current-menu-item > a',
            ]
        );

        $this->add_control(
            'dropdown_parent_arrow_color_active',
            [
                'label'     => __( 'Drop Down Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children.current-menu-item::after' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dropdown_menu_parent_arrow_options',
            [
                'label' => __( 'Drop Down Icon', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'dropdown_menu_parent_arrow_spacing',
            [
                'label'      => __( 'Offset', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'allowed_dimensions' => [ 'top', 'right' ],
                'default'    => [
                    'right' => '5',
                    'top' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children::after' => 'transform: translate({{RIGHT}}{{UNIT}},{{TOP}}{{UNIT}}) rotateZ(-90deg);',
                    'body.rtl {{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children::after' => 'transform: translate({{RIGHT}}{{UNIT}},{{TOP}}{{UNIT}}) rotateZ(90deg);',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_menu_parent_arrow_typography',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .main-menu .sub-menu > li.menu-item-has-children::after',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_responsive_style_controls() {
        $this->start_controls_section(
            'responsive_icon',
            [
                'label' => __( 'Responsive', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'skin',
			[
				'label'   => __( 'Skin', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fix',
				'options' => [
					'fix'  => __( 'Fix', text_domain ),
					'under' => __( 'Under Bottom', text_domain ),
                ],
                'prefix_class' => 'responsive-',
			]
        );
        $this->add_control(
			'open_position',
			[
				'label'   => __( 'Open Position', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right'  => __( 'Right', text_domain ),
					'left' => __( 'Left', text_domain ),
                ],
                'prefix_class' => 'open-position-',
                'condition'        => [
                    'skin' => 'fix',
                ]
			]
        );
        $this->add_control(
            'responsive_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'em' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 90,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}}.responsive-fix .open-menu .main-menu' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.responsive-fix .open-menu .bars' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.open-position-left.responsive-fix .open-menu .bars' => 'right: auto;left:{{SIZE}}{{UNIT}};',
                ],
                'condition'        => [
                    'skin' => 'fix',
                ]
            ]
        );
        $this->add_control(
            'open_sub_menu',
            [
                'label'   => __( 'Open Sub Menu', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
                'prefix_class' => 'open-sub-menu-',
            ]
        );
        $this->add_control(
            'responsive_icon_options',
            [
                'label' => __( 'Icon Setting', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'responsive_icon_align',
            [
                'label'   => __( 'Icon Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .main-bar' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_icon_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .bars' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'responsive_icon_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .bars' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_icon_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bars' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_icon_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bars' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'responsive_border_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .bars',
            ]
        );

        $this->add_control(
            'responsive_icon_width',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 1.6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bars' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_menu_options',
            [
                'label' => __( 'Menu Setting', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'responsive_menu_background',
            [
                'label'     => __( 'Background Color Menu', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('style_responsive_menu_tabs');
        $this->start_controls_tab('style_responsive_menu_normal_tab', ['label' => __( 'Main Menu', text_domain ),]);

        $this->add_control(
            'responsive_menu_link_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu li > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'responsive_menu_border_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .open-menu .main-menu li',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'responsive_menu_typography',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .open-menu .main-menu li a',
            ]
        );
        $this->add_control(
            'responsive_menu_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .open-menu .main-menu .sub-menu > li:not(.mega-menu) > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_menu_margin',
            [
                'label'      => __( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .open-menu .main-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_responsive_sub_menu_tab', ['label' => __( 'Sub Menu', text_domain ),]);

        $this->add_control(
            'responsive_sub_menu_link_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu .sub-menu > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'responsive_sub_menu_background',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu .sub-menu > li' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'responsive_sub_menu_border_color',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .open-menu .main-menu .sub-menu',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'responsive_sub_menu_typography',
                'label'    => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .open-menu .main-menu .sub-menu > li > a',
            ]
        );
        $this->add_control(
            'responsive_sub_menu_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .open-menu .main-menu .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'responsive_sub_menu_margin',
            [
                'label'      => __( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .open-menu .main-menu .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'responsive_menu_parent_arrow_options',
            [
                'label' => __( 'Icon Setting', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'responsive_parent_arrow_color_active',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu li.menu-item-has-children::after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'responsive_parent_arrow_bg_color_active',
            [
                'label'     => __( 'Background Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open-menu .main-menu li.menu-item-has-children::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'responsive_parent_arrow_border_color_active',
                'label'    => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .open-menu .main-menu li.menu-item-has-children::after',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $id = 'tmt-navbar-' . $this->get_id();
        $nav_menu = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;
        $icon_drop_down = $settings['icon_drop_down'];

        if ( ! $nav_menu ) {
            return;
        }

        $nav_menu_args = array(
            'fallback_cb'    => false,
            'container'      => false,
            'menu_id'        => 'tmt-navmenu',
            'menu_class'     => "main-menu flex tmt-icon-$icon_drop_down",
            'theme_location' => 'default_navmenu', // creating a fake location for better functional control
            'menu'           => $nav_menu,
            'echo'           => true,
            'depth'          => 0,
            'walker'		 => new \tmt_main_nav_walker(),
        );
        ?>
        <div id="<?php echo esc_attr($id); ?>" class="tmt-navbar-wrapper">
            <div class="flex main-bar"><div class="bars"><i class="fas fa-bars"></i></div></div>
            <nav class="menu"><?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) ); ?></nav>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Navbar );