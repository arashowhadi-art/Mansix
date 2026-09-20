<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TMT_Breadcrumbs extends Widget_Base {

	public function get_name() {
		return 'tmt-breadcrumbs';
	}

	public function get_title() {
		return __( 'Breadcrumbs', text_domain );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	public function get_categories() {
        return [ 'single_karauos' ];
	}

	public function get_keywords() {
		return [ 'breadcrumbs', 'internal links' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
            'section_breadcrumbs_content',
            [
                'label' => __( 'Breadcrumbs', text_domain ),
            ]
        );

        $this->add_responsive_control(
            'align',
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
                'default' => 'center',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_breadcrumbs_style',
            [
                'label' => __( 'Breadcrumbs', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .breadcrumb li,{{WRAPPER}} .breadcrumb li a',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb li:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => __( 'Link Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_breadcrumb_active',
            [
                'label' => __( 'Active Breadcrumbs Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'separator'    => 'before',
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb li.active' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
	}

	public function render() {
        $settings = $this->get_settings();
        $align = $settings['align'];

        return mj_wp_breadcrumb("ol","breadcrumb","breadcrumb flex justify-content-$align","active","false");
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Breadcrumbs );