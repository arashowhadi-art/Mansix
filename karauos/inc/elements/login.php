<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TMT_Login extends Widget_Base {

	public function get_name() {
		return 'tmt-login';
	}

	public function get_title() {
		return __( 'Login', text_domain );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
        return [ text_domain ];
	}

	public function get_keywords() {
		return [ 'login', 'member', 'form', 'user'];
	}

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_btn_controls();
        $this->register_general_drop_down_login_controls();
        $this->register_general_style_controls();
        $this->register_general_form_style_controls();
        $this->register_general_btn_style_controls();
        $this->register_general_drop_down_login_style_controls();
        $this->register_general_register_btn_style_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __( 'Login', text_domain ),
            ]
        );
        $this->add_control(
			'skin_before_login',
			[
				'label'   => __( 'Skin Before Login', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dropdown',
				'options' => [
					'dropdown'  => __( 'Dropdown', text_domain ),
					'link' => __( 'Link', text_domain ),
				],
			]
        );

        $this->add_control(
			'enable_register',
			[
				'label' => __( 'Enable Register', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'before_login_link',
			[
				'label' => __( 'Before Login Link', text_domain ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', text_domain ),
				'show_external' => true,
				'default' => [
					'url' => '',
                ],
                'condition' => [
                    'skin_before_login' => 'link',
                ],
			]
		);

        $this->add_control(
			'skin_after_login',
			[
				'label'   => __( 'Skin After Login', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dropdown',
				'options' => [
					'dropdown'  => __( 'Dropdown', text_domain ),
					'link' => __( 'Link', text_domain ),
				],
			]
        );

        $this->add_control(
			'after_login_link',
			[
				'label' => __( 'After Login Link', text_domain ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', text_domain ),
				'show_external' => true,
				'default' => [
					'url' => '',
                ],
                'condition' => [
                    'skin_after_login' => 'link',
                ],
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
            'before_btn_text',
            [
                'label' => __( 'Before Login Text', text_domain ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Type your text here', text_domain ),
            ]
        );
        $this->add_control(
            'after_btn_text',
            [
                'label' => __( 'After Login Text', text_domain ),
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
                    'value' => 'far fa-user-circle',
                    'library' => 'regular',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_drop_down_login_controls() {
        $this->start_controls_section(
            'section_drop_down_login_setting',
            [
                'label' => __( 'Drop Down After Login', text_domain ),
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'before_name_text',
            [
                'label' => __( 'Text Before Name', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Welcome', text_domain),
                'placeholder' => __( 'Type your text here', text_domain ),
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List Title' , text_domain ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-cog',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'list_link',
            [
                'label' => __( 'Link', text_domain ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', text_domain ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Repeater List', text_domain ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Bills', text_domain ),
                        'list_icon' => [
                            'value' => 'fas fa-dollar-sign',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_title' => __( 'Settings', text_domain ),
                        'list_icon' => [
                            'value' => 'fas fa-cog',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_title' => __( 'Support', text_domain ),
                        'list_icon' => [
                            'value' => 'far fa-life-ring',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );
        $this->add_control(
            'show_logout',
            [
                'label' => __( 'Show Logout', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
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
            ]
        );
        $this->add_control(
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
                    '{{WRAPPER}} .user-content' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .user-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'content_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .user-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .user-content',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_form_style_controls() {
        $this->start_controls_section(
            'section_form_style',
            [
                'label' => __( 'Form Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin_before_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'form_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} #loginform' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_before_login' => 'dropdown',
                ],
            ]
        );

        $this->start_controls_tabs('style_form_tabs');
        $this->start_controls_tab('style_form_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'form_label_options',
            [
                'label' => __( 'Label Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'label_space',
            [
                'label' => __( 'Label Space', text_domain ),
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
                    '{{WRAPPER}} #loginform label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'form_label_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} #loginform label',
            ]
        );
        $this->add_control(
            'form_label_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'form_input_options',
            [
                'label' => __( 'Input Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'form_input_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'form_input_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'form_input_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'form_input_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_before_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'form_input_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_input_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} #loginform input[type=text],{{WRAPPER}} #loginform input[type=password]',
            ]
        );
        $this->add_control(
            'form_submit_options',
            [
                'label' => __( 'Submit Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'form_submit_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'form_submit_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#051934',
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_before_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'form_submit_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'form_submit_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'form_submit_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_submit_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} #loginform input[type=submit]',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('style_form_hover_tab', ['label' => __( 'Hover', text_domain ),]);

        $this->add_control(
            'h_form_input_options',
            [
                'label' => __( 'Input Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'h_form_input_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=text]:focus,{{WRAPPER}} #loginform input[type=password]:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'h_form_input_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} #loginform input[type=text]:focus,{{WRAPPER}} #loginform input[type=password]:focus',
            ]
        );
        $this->add_control(
            'h_form_submit_options',
            [
                'label' => __( 'Submit Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'h_form_submit_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'h_form_submit_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} #loginform input[type=submit]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

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
                    '{{WRAPPER}} .icon' => 'margin: 0 {{SIZE}}{{UNIT}};',
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
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .icon svg' => 'height: {{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .btn-login',
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
                    '{{WRAPPER}} .btn-login' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-login' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_bg_color',
            [
                'label' => __( 'Icon Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_icon_border',
                'selector' => '{{WRAPPER}} .icon',
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_icon_box_shadow',
				'label' => __( 'Icon Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} .icon',
			]
        );
        $this->add_control(
            'btn_icon_padding',
            [
                'label' => __( 'Icon Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_border_radius',
            [
                'label' => __( 'Icon Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .btn-login:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'h_btn_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-login:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_btn_icon_bg_color',
            [
                'label' => __( 'Icon Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-login:hover .icon' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'h_btn_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-login:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-login:hover svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_btn_icon_border_color',
            [
                'label' => __( 'Icon Border Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'btn_icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-login:hover .icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'h_btn_icon_box_shadow',
				'label' => __( 'Icon Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} .btn-login:hover .icon',
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
                    '{{WRAPPER}} .btn-login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'btn_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .btn-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .btn-login',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .btn-login',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_drop_down_login_style_controls() {
        $this->start_controls_section(
            'section_drop_down_login_style',
            [
                'label' => __( 'Drop Down After Login Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'header_options',
            [
                'label' => __( 'Header Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .user-header',
            ]
        );
        $this->add_control(
            'header_bg_color',
            [
                'label' => __( 'Header Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.05)',
                'selectors' => [
                    '{{WRAPPER}} .user-header' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'header_text_color',
            [
                'label' => __( 'Text Header Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .user-header' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'avatar_size',
            [
                'label' => __( 'Avatar Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 10,
                    ],
                ],
                'default' => ['size' => 40,],
                'selectors' => [
                    '{{WRAPPER}} .user-header img' => 'height: {{SIZE}}px;width: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control(
            'avatar_space',
            [
                'label' => __( 'Avatar Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => ['size' => 10,],
                'selectors' => [
                    '{{WRAPPER}} .user-header img' => 'margin-right: {{SIZE}}px;',
                    'body.rtl {{WRAPPER}} .user-header img' => 'margin-left: {{SIZE}}px;margin-right:0;',
                ],
            ]
        );
        $this->add_control(
            'header_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .user-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'header_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .user-header',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'header_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .user-header',
            ]
        );

        $this->add_control(
            'main_options',
            [
                'label' => __( 'Main Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'main_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .user-main' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'main_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'main_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'main_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'main_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .user-main',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'main_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .user-main',
            ]
        );
        $this->start_controls_tabs('style_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', text_domain ),]);
        $this->add_control(
            'main_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999',
                'selectors' => [
                    '{{WRAPPER}} .user-main a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'main_text_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-main i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'main_icon_space',
            [
                'label' => __( 'Icon Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => ['size' => 10,],
                'selectors' => [
                    '{{WRAPPER}} .user-main i' => 'margin-right: {{SIZE}}px;',
                    'body.rtl {{WRAPPER}} .user-main i' => 'margin-left: {{SIZE}}px;margin-right:0;',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'main_space_between',
            [
                'label' => __( 'Space Between', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => ['size' => 5,],
                'selectors' => [
                    '{{WRAPPER}} .user-main li' => 'margin-bottom: {{SIZE}}px;',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', text_domain ),]);
        $this->add_control(
            'main_hover_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .user-main a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'skin_after_login' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'main_hover_text_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-main a:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_general_register_btn_style_controls() {
        $this->start_controls_section(
            'section_register_style',
            [
                'label' => __( 'Register Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'register_btn_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .register-btn',
            ]
        );

        $this->add_control(
            'register_btn_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .register-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'register_btn_bg',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .register-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
           
        $this->add_control(
            'register_btn_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .register-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'register_btn_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .register-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'register_btn_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .register-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'register_btn_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .register-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'register_btn_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .register-btn',
            ]
        );
        $this->end_controls_section();
    }


	protected function render() {
        $settings = $this->get_settings();

        $align = $settings['align'];
        $skin_before_login = $settings['skin_before_login'];
        $skin_after_login = $settings['skin_after_login'];
        $btn_align = $settings['btn_align'];
        $list = $settings['list'];
        $show_logout = $settings['show_logout'];
        $before_name_text = $settings['before_name_text'];
        $enable_register = $settings['enable_register'];
        $avatar_size = $settings['avatar_size']['size'];
        $user = is_user_logged_in();
        if ($user) {
            global $current_user;
            wp_get_current_user();
        }

        $this->add_render_attribute( 'btn_class','class', [ 'inline-flex','btn-login', 'align-items-center']  );
        if ($btn_align == 'left') {
            $this->add_render_attribute( 'btn_class','class', ['flex-row-reverse', 'justify-content-end']);
        }
        if ((!$user && $skin_before_login == 'dropdown') || ($user && $skin_after_login == 'dropdown')) {
            $this->add_render_attribute( 'btn_class','class', 'drop-down-btn');
        }
        if (!$user && $skin_before_login == 'link') {
            $this->add_render_attribute( 'btn_class','href', $settings['before_login_link']['url']);
            if ( $settings['before_login_link']['is_external'] ) {
                $this->add_render_attribute( 'btn_class', 'target', '_blank' );
            }
            if ( $settings['before_login_link']['nofollow'] ) {
                $this->add_render_attribute( 'btn_class', 'rel', 'nofollow' );
            }
        }
        if ($user && $skin_after_login == 'link') {
            $this->add_render_attribute( 'btn_class','href', $settings['after_login_link']['url']);
            if ( $settings['after_login_link']['is_external'] ) {
                $this->add_render_attribute( 'btn_class', 'target', '_blank' );
            }
            if ( $settings['after_login_link']['nofollow'] ) {
                $this->add_render_attribute( 'btn_class', 'rel', 'nofollow' );
            }
        }
        $btn_class = $this->get_render_attribute_string( 'btn_class' );

        
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

        echo "<div class='user-login drop-down flex justify-content-$align'>"
            . "<div>";
            if (!$user && $skin_before_login == 'dropdown') {
                $btn = $settings['before_btn_text'];
                echo "<div $btn_class>$btn <span class='icon'>"; Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); echo "</span></div>";
            } elseif($user && $skin_after_login == 'dropdown') {
                $btn = $settings['after_btn_text'];
                echo "<div $btn_class>$btn <span class='icon'>"; Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); echo "</span></div>";
            } elseif(!$user && $skin_before_login == 'link') {
                $btn = $settings['before_btn_text'];
                echo "<a $btn_class>$btn <span class='icon'>"; Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); echo "</span></a>";
            } elseif($user && $skin_after_login == 'link') {
                $btn = $settings['after_btn_text'];
                echo "<a $btn_class>$btn <span class='icon'>"; Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); echo "</span></a>";
            }
                if($skin_before_login == 'dropdown' || $skin_after_login == 'dropdown') {
                        echo "<div class='user-content drop-down-content$aligns'>";
                        if (!$user && $skin_before_login == 'dropdown') {
                            wp_login_form();
                            if($enable_register == 'yes' && get_option('users_can_register')) {
                                echo "<a href='". wp_registration_url() ."' class='register-btn'>". __( 'Register', text_domain ) ."</a>";
                            }
                        } elseif($user && $skin_after_login == 'dropdown') {
                            echo "<div class='user-header flex align-items-center flex-wrap'>";
                            echo get_avatar($current_user->user_id, $size = $avatar_size) . $before_name_text . ' ' . $current_user->display_name;
                            echo "</div>";
                            if ($list) {
                                echo "<ul class='user-main flex flex-column'>";
                                foreach (  $list as $item ) {
                                    echo "<li>";
                                        $target = $item['list_link']['is_external'] ? ' target="_blank"' : '';
                                        $nofollow = $item['list_link']['nofollow'] ? ' rel="nofollow"' : '';
                                        echo '<a href="' . $item['list_link']['url'] . '"' . $target . $nofollow . '>'; Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); echo $item['list_title'] . "</a>";
                                    echo "</li>";
                                }
                                if ($show_logout == 'yes') {$wp_logout_url = wp_logout_url();echo "<li><a href='$wp_logout_url'><i class='fas fa-sign-out-alt'></i> " . __('Log Out', text_domain) . "</a></li>";}
                                echo "</ul>";
                            }
                        }
                        echo "</div>";
                    }
            echo "</div>"
        . "</div>";
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Login );