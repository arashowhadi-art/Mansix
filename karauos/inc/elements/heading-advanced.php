<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Themento_heading_Advanced extends Widget_Base {

    public function get_name() {
        return 'tmt-advanced-heading';
    }

    public function get_title() {
        return __( 'Advanced Heading', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_keywords() {
        return [ 'heading', 'title', 'text' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => __( 'Heading', text_domain ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => __( 'Sub Heading', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => __( 'Enter your Sub title', text_domain ),
                'default'     => __( 'SUB HEADING HERE', text_domain ),
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label'       => __( 'Main Heading', text_domain ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => __( 'Enter your main heading here', text_domain ),
                'default'     => __( 'I am Advanced Heading', text_domain ),
            ]
        );

        $this->add_control(
            'split_main_heading',
            [
                'label'     => __( 'Split Main Heading', text_domain ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'split_text',
            [
                'label'       => __( 'Split Text', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'label_block' => true,
                'placeholder' => __( 'Enter your split text', text_domain ),
                'default'     => __( 'Split Text', text_domain ),
                'condition'   => [
                    'split_main_heading' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __( 'Link', text_domain ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __( 'HTML Tag', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => TMT_Title_Tags(),
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => __( 'Alignment', text_domain ),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_advanced_heading',
            [
                'label' => __( 'Advanced Heading', text_domain ),
            ]
        );
        $this->add_control(
            'advanced_heading',
            [
                'label'       => __( 'Advanced Heading', text_domain ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => __( 'Enter your advanced heading', text_domain ),
                'description' => __( 'This heading will show as style as background and you can move and style many way.', text_domain ),
                'default'     => esc_html__( 'Advanced Heading', text_domain ),
            ]
        );

        $this->add_responsive_control(
            'advanced_heading_align',
            [
                'label'   => __( 'Alignment', text_domain ),
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
                    '{{WRAPPER}} .tmt-advanced-heading-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'advanced_heading_x_position',
            [
                'label'   => __( 'X Offset', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -800,
                        'max' => 800,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'advanced_heading_y_position',
            [
                'label'   => __( 'Y Offset', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -800,
                        'max' => 800,
                    ],
                ],
            ]
        );

        $this->add_control(
            'advanced_heading_origin',
            [
                'label'       => __( 'Rotate Origin', text_domain ),
                'description' => __( 'Origin work when you set rotate value', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'top-left',
                'options'     => themento_position(),
            ]
        );


        $this->add_responsive_control(
            'advanced_heading_rotate',
            [
                'label'   => __( 'Rotate', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min'  => -180,
                        'max'  => 180,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position.SIZE}}px, {{advanced_heading_y_position.SIZE}}px) rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position_tablet.SIZE}}px, {{advanced_heading_y_position_tablet.SIZE}}px) rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position_mobile.SIZE}}px, {{advanced_heading_y_position_mobile.SIZE}}px) rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_heading',
            [
                'label'     => __( 'Sub Heading', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sub_heading!' => '',
                ]
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'sub_heading_text_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading',
            ]
        );

        $this->add_control(
            'sub_heading_style',
            [
                'label'   => __( 'Style', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''     => esc_html__('None', text_domain),
                    'line' => esc_html__('Line', text_domain),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_style_color',
            [
                'label'     => __( 'Style Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading .line:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sub_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading .line:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_height',
            [
                'label' => __( 'Height', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 48,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-sub-heading .line:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading_style' => 'line',
                ],
            ]
        );

        $this->add_control(
            'sub_heading_style_align',
            [
                'label'   => __( 'Style Position', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right'      => __( 'After', text_domain ),
                    'left'       => __( 'Before', text_domain ),
                    'left-right' => __( 'After and Before', text_domain ),
                    'bottom'     => __( 'Bottom', text_domain ),
                ],
                'condition' => [
                    'sub_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_indent',
            [
                'label'   => __( 'Style Spacing', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'sub_heading_style' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-button-icon-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-button-icon-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-button-icon-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_main_heading',
            [
                'label'     => __( 'Main Heading', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_style_main_heading');

        $this->start_controls_tab(
            'tab_style_normal',
            [
                'label' => esc_html__('Normal', text_domain)
            ]
        );

        $this->add_control(
            'main_heading_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'main_heading_background',
            [
                'label'     => __( 'Background', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'main_heading_padding',
            [
                'label'      => esc_html__('Padding', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'main_heading_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div'
            ]
        );

        $this->add_control(
            'main_heading_radius',
            [
                'label'      => esc_html__('Radius', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'main_heading_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'main_heading_text_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'main_heading_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div',
            ]
        );

        $this->add_control(
            'heading_mainh_split_text',
            [
                'label'     => __( 'Split Text', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_control(
            'mainh_split_text_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_control(
            'mainh_split_text_background',
            [
                'label'     => __( 'Background', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'split_text_space',
            [
                'label'   => __( 'Split Space', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-main-heading .tmt-main-heading-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'split_main_heading' => 'yes'
                ],
                'separator'   => 'after',
            ]
        );

        $this->add_responsive_control(
            'mainh_split_text_padding',
            [
                'label'      => esc_html__('Padding', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'mainh_split_text_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text',
                'condition'   => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_control(
            'mainh_split_text_radius',
            [
                'label'      => esc_html__('Radius', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'mainh_split_text_shadow',
                'selector'  => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'mainh_split_text_typography',
                'selector'  => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-mainh-split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => ''
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_style_advanced',
            [
                'label' => esc_html__('Advanced', text_domain)
            ]
        );

        $this->add_control(
            'main_heading_advanced_color',
            [
                'label'        => __( 'Advanced Style', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'tmt-ep-main-color-',
                'render_type'  => 'template',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'main_heading_advanced_color',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading > div'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'main_heading_style',
            [
                'label'   => __( 'Style', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''     => esc_html__('None', text_domain),
                    'line' => esc_html__('Line', text_domain),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'main_heading_style_color',
            [
                'label'     => __( 'Style Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .line:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'main_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_heading_style_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .line:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'main_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_heading_style_height',
            [
                'label' => __( 'Height', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 48,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .line:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'main_heading_style' => 'line',
                ],
            ]
        );

        $this->add_control(
            'main_heading_style_align',
            [
                'label'   => __( 'Style Position', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'right'      => __( 'After', text_domain ),
                    'left'       => __( 'Before', text_domain ),
                    'left-right' => __( 'After and Before', text_domain ),
                    'bottom'     => __( 'Bottom', text_domain ),
                ],
                'condition' => [
                    'main_heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_heading_style_indent',
            [
                'label'   => __( 'Style Spacing', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'main_heading_style' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-button-icon-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-button-icon-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-main-heading .tmt-button-icon-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_advanced_heading',
            [
                'label'     => __( 'Advanced Heading', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'advanced_heading!' => '',
                ],
            ]
        );

        $this->add_control(
            'advanced_heading_advanced_color',
            [
                'label'        => __( 'Advanced Style', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'tmt-ep-advanced-color-',
                'render_type'  => 'template',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'advanced_heading_advanced_color',
                'selector'  => '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div',
                'condition' => [
                    'advanced_heading_advanced_color' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'advanced_heading_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'advanced_heading_advanced_color!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'advanced_heading_background_color',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'advanced_heading_advanced_color!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'advanced_heading_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'advanced_heading_typography',
                'selector'  => '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'advanced_heading_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'advanced_heading_border',
                'label'       => __( 'Border', text_domain ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'advanced_heading_border_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'advanced_heading_box_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div',
            ]
        );

        $this->add_control(
            'advanced_heading_opacity',
            [
                'label' => __( 'Opacity', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0.05,
                        'max'  => 1,
                        'step' => 0.05,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-heading .tmt-advanced-heading-content > div' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {
        $settings         = $this->get_settings_for_display();
        $id               = $this->get_id();
        $heading_html     = [];
        $advanced_heading = '';
        $sub_heading      = '';
        $main_heading     = '';
        $split_heading    = '';

        if ( empty( $settings['sub_heading'] ) and empty( $settings['advanced_heading'] ) and empty( $settings['main_heading'] ) ) {
            return;
        }

        $this->add_render_attribute( 'heading', 'class', 'tmt-heading-title' );


        if ($settings['sub_heading']) {
            $subh_style = '';
            if ('line' === $settings['sub_heading_style']) {
                if ('left-right' === $settings['sub_heading_style_align']) {
                    $subh_style = '<div class="line tmt-button-icon-align-left"></div><div class="line tmt-button-icon-align-right"></div>';
                } elseif ('bottom' === $settings['sub_heading_style_align']) {
                    $subh_style = '<div class="line tmt-button-icon-align-'.$settings['sub_heading_style_align'].'"></div>';
                } else {
                    $subh_style = '<div class="line tmt-button-icon-align-'.$settings['sub_heading_style_align'].'"></div>';
                }
            }

            $sub_heading = '<div class="tmt-sub-heading"><div class="tmt-sub-heading-content">'.$settings['sub_heading'].'</div>'.$subh_style.'</div> ';
        }

        if ($settings['advanced_heading']) {

            $this->add_render_attribute(
                [
                    'avd-hclass' => [
                        'class' => [
                            'tmt-advanced-heading-content',
                        ],
                    ],
                ]
            );

            $this->add_render_attribute(
                [
                    'avd-hcclass' => [
                        'class' => [
                            $settings['advanced_heading_origin'] ? 'tmt-transform-origin-'.$settings['advanced_heading_origin'] : '',
                        ],
                    ],
                ]
            );

            $advanced_heading = '<div ' . $this->get_render_attribute_string( 'avd-hclass' ) . '><div ' . $this->get_render_attribute_string( 'avd-hcclass' ) . '>' .$settings['advanced_heading']. '</div></div>';
        }

        $this->add_render_attribute( 'main_heading', 'class', 'tmt-main-heading-inner' );
        $this->add_inline_editing_attributes( 'main_heading' );

        $this->add_render_attribute( 'split_heading', 'class', 'tmt-mainh-split-text' );

        if ($settings['main_heading']) :

            $mainh_style = '';

            if ('line' === $settings['main_heading_style']) {
                if ('left-right' === $settings['main_heading_style_align']) {
                    $mainh_style = '<div class="line tmt-button-icon-align-left"></div><div class="line tmt-button-icon-align-right"></div>';
                } elseif ('bottom' === $settings['main_heading_style_align']) {
                    $mainh_style = '<div class="line tmt-button-icon-align-'.$settings['main_heading_style_align'].'"></div>';
                } else {
                    $mainh_style = '<div class="line tmt-button-icon-align-'.$settings['main_heading_style_align'].'"></div>';
                }
            }

            if ( ( 'yes' == $settings['split_main_heading'] ) and ( ! empty($settings['split_text']) ) ) {
                $split_heading = '<div '.$this->get_render_attribute_string( 'split_heading' ).'>' . $settings['split_text'] . '</div>';
            }

            $main_heading = '<div '.$this->get_render_attribute_string( 'main_heading' ).'>' . $settings['main_heading'] . '</div>';

            $main_heading = '<div class="tmt-main-heading">' . $main_heading . $split_heading . $mainh_style . '</div>';

        endif;


        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }

            $main_heading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $main_heading );
        }

        $heading_html[] = '<div id ="'.$id.'" class="tmt-advanced-heading">';


        $heading_html[] = $advanced_heading;
        $heading_html[] = $sub_heading;
        $heading_html[] = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $main_heading );

        $heading_html[] = '</div>';

        echo implode("", $heading_html);

    }
    protected function _content_template() {
        ?>
        <#
        var subh_style    = '';
        var mainh_style   = '';

        view.addRenderAttribute( 'main_heading', 'class', 'tmt-main-heading-inner' );
        view.addInlineEditingAttributes( 'main_heading' );

        view.addRenderAttribute( 'split_text', 'class', 'tmt-mainh-split-text' );
        view.addInlineEditingAttributes( 'split_text' );

        view.addRenderAttribute( 'main_heading_wrapper', 'class', [ 'tmt-heading-title', 'elementor-size-' + settings.size ] );

        view.addRenderAttribute('advanced_heading_content', 'class', ['tmt-advanced-heading-content'] );

        view.addRenderAttribute('advanced_heading', 'class', 'tmt-transform-origin-' + settings.advanced_heading_origin );

        var avdh_content_print = view.getRenderAttributeString( 'advanced_heading_content' );
        var avdh_transform_print = view.getRenderAttributeString( 'advanced_heading' );

        if ( 'line' === settings.sub_heading_style ) {
        if ('left-right' === settings.sub_heading_style_align) {
        subh_style = '<div class="line tmt-button-icon-align-left"></div><div class="line tmt-button-icon-align-right"></div>';
        } else if ('bottom' === settings.sub_heading_style_align) {
        subh_style = '<div class="line tmt-button-icon-align-' + settings.sub_heading_style_align + '"></div>';
        } else {
        subh_style = '<div class="line tmt-button-icon-align-' + settings.sub_heading_style_align + '"></div>';
        }
        }

        if ( 'line' === settings.main_heading_style ) {
        if ('left-right' === settings.main_heading_style_align) {
        mainh_style = '<div class="line tmt-button-icon-align-left"></div><div class="line tmt-button-icon-align-right"></div>';
        } else if ('bottom' === settings.main_heading_style_align) {
        mainh_style = '<div class="line tmt-button-icon-align-' + settings.main_heading_style_align + '"></div>';
        } else {
        mainh_style = '<div class="line tmt-button-icon-align-' + settings.main_heading_style_align + '"></div>';
        }
        }

        #>
        <div class="tmt-advanced-heading">
            <div <# print(avdh_content_print) #> >
            <div <# print(avdh_transform_print) #>>
            <# print(settings.advanced_heading) #>
        </div>
        </div>

        <div class="tmt-sub-heading">
            <div class="tmt-sub-heading-content">
                <# print(settings.sub_heading); #>
            </div>
            <# print(subh_style); #>
        </div>

        <{{settings.header_size}} <# print(view.getRenderAttributeString( 'main_heading_wrapper' )) #> >
        <div class="tmt-main-heading">

            <# if ( '' !== settings.link.url ) { #>
            <a href="{{{settings.link.url}}}">
                <# } #>


                <div {{{view.getRenderAttributeString( 'main_heading' )}}}><# print(settings.main_heading); #></div>

        <# if ( ( 'yes' == settings.split_main_heading ) && ( '' !== (settings.split_text) ) ) { #>
        <div {{{view.getRenderAttributeString( 'split_text' )}}}><# print(settings.split_text); #></div>
        <# } #>

        <# print(mainh_style); #>


        <# if ( '' !== settings.link.url ) { #>
        </a>
        <# } #>

        </div>

        </{{settings.header_size}}>

        </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_heading_Advanced );