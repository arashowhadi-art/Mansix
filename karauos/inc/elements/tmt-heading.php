<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class TMT_Heading extends Widget_Base {

    public function get_name(){
        return 'tmt-heading';
    }

    public function get_title(){
        return __( 'Heading', text_domain );
    }

    public function get_icon() {
        return 'eicon-t-letter-bold';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'heading', 'title', 'text' ];
    }

    protected function _register_controls() {
        $this->register_content_controls();
        $this->register_content_separator_controls();
        $this->register_style_sub_heading_controls();
        $this->register_style_heading_controls();
        $this->register_style_separator_controls();
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', text_domain )
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'label' => __( 'Sub Heading', text_domain ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'placeholder' => __( 'Type your text here', text_domain ),
            ]
        );
        $this->add_control(
            'heading',
            [
                'label' => __( 'Heading', text_domain ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => __( 'Heading', text_domain ),
                'placeholder' => __( 'Type your text here', text_domain ),
            ]
        );
        $this->add_control(
            'sub_heading_tag',
            [
                'label' => __( 'Sub Heading Tag', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => TMT_Title_Tags(),
                'condition' => [
                    'sub_heading!' => '',
                ],
            ]
        );
        $this->add_control(
            'heading_tag',
            [
                'label' => __( 'Heading Tag', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => TMT_Title_Tags(),
                'condition' => [
                    'heading!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_link',
            [
                'label' => __( 'Link', text_domain ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://www.themento.net/', text_domain ),
                'show_external' => true,
            ]
        );
        $this->add_control(
            'text_align',
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
                'default' => 'right',
                'toggle' => true,
                'prefix_class' => 'heading-position-',
                'selectors' => [
                    '{{WRAPPER}} .tmt-heading' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}}.heading-position-right .separator,{{WRAPPER}}.heading-position-right .heading' => '-ms-flex-pack: end;justify-content: flex-end;',
                    'body.rtl {{WRAPPER}}.heading-position-right .separator,body.rtl {{WRAPPER}}.heading-position-right .heading' => '-ms-flex-pack: start;justify-content: flex-start;',
                    '{{WRAPPER}}.heading-position-center .separator,{{WRAPPER}}.heading-position-center .heading' => '-ms-flex-pack: center;justify-content: center;',
                    '{{WRAPPER}}.heading-position-left .separator,{{WRAPPER}}.heading-position-left .heading' => '-ms-flex-pack: start;justify-content: flex-start;',
                    'body.rtl {{WRAPPER}}.heading-position-left .separator,body.rtl {{WRAPPER}}.heading-position-left .heading' => '-ms-flex-pack: end;justify-content: flex-end;',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_content_separator_controls() {
        $this->start_controls_section(
            'content_separator_section',
            [
                'label' => __( 'Separator', text_domain )
            ]
        );
        $this->add_control(
            'separator_style',
            [
                'label' => __( 'Separator Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'  => __( 'None', text_domain ),
                    'line' => __( 'Line', text_domain ),
                    'line_icon' => __( 'Line With Icon', text_domain ),
                    'line_image' => __( 'Line With Image', text_domain ),
                    'line_text' => __( 'Line With Text', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'separator_position',
            [
                'label' => __( 'Separator Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'between',
                'options' => [
                    'between'  => __( 'Between Sub Heading & Heading', text_domain ),
                    'top' => __( 'Top', text_domain ),
                    'bottom' => __( 'Bottom', text_domain ),
                    'before' => __( 'Before Heading', text_domain ),
                    'after' => __( 'After Heading', text_domain ),
                    'before_after' => __( 'Before & After Heading', text_domain ),
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'separator_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'separator_style' => 'line_icon',
                ],
            ]
        );
        $this->add_control(
            'separator_image',
            [
                'label' => __( 'Choose Image', text_domain ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'separator_style' => 'line_image',
                ],
            ]
        );
        $this->add_control(
            'separator_text',
            [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', text_domain ),
                'placeholder' => __( 'Type your text here', text_domain ),
                'condition' => [
                    'separator_style' => 'line_text',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_style_sub_heading_controls() {
        $this->start_controls_section(
            'content_style_sub_heading_section',
            [
                'label' => __( 'Sub Heading Style', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sub_heading!' => '',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .sub-heading',
            ]
        );
        $this->add_control(
            'sub_heading_color_style',
            [
                'label' => __( 'Color Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color'  => __( 'Color', text_domain ),
                    'background' => __( 'Background', text_domain ),
                ],
                'prefix_class' => 'tmt-sh-',
            ]
        );
        $this->add_control(
            'sub_heading_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-heading' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'sub_heading_color_style' => 'color',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sub_heading_background',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sub-heading',
                'condition' => [
                    'sub_heading_color_style' => 'background',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sub_heading_text_shadow',
                'label' => __( 'Text Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .sub-heading',
            ]
        );
        $this->add_responsive_control(
            'sub_heading_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_style_heading_controls() {
        $this->start_controls_section(
            'content_style_heading_section',
            [
                'label' => __( 'Heading Style', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .heading',
            ]
        );
        $this->add_control(
            'heading_color_style',
            [
                'label' => __( 'Color Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color'  => __( 'Color', text_domain ),
                    'background' => __( 'Background', text_domain ),
                ],
                'prefix_class' => 'tmt-h-',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'heading_color_style' => 'color',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_background',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .heading',
                'condition' => [
                    'heading_color_style' => 'background',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_text_shadow',
                'label' => __( 'Text Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .heading',
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space_heading_separator',
            [
                'label' => __( 'Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .heading span' => 'margin: 0 {{SIZE}}px;',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_style_separator_controls() {
        $this->start_controls_section(
            'content_separator_style_section',
            [
                'label' => __( 'Separator Style', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'separator_options',
            [
                'label' => __( 'Separator Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'line_style',
            [
                'label' => __( 'Line Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'  => __( 'Solid', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                    'double' => __( 'Double', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'groove' => __( 'Groove', text_domain ),
                ],
                'selectors' => [
                    '{{WRAPPER}} hr' => 'border-style: {{VALUE}}',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'separator_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} hr' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} hr' => 'border-width: {{SIZE}}px;',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_width',
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
                'default' => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} hr' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .heading hr' => 'width: 100%;',
                    '{{WRAPPER}} .heading .separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'separator_position!' => ['before_after','none'],
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_before_after_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'width: calc( {{SIZE}}% / 2 );',
                    '{{WRAPPER}} .heading hr' => 'width: 100%;',
                ],
                'condition' => [
                    'separator_position' => 'before_after',
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_options',
            [
                'label' => __( 'Icon Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'separator_style' => 'line_icon',
                ],
            ]
        );
        $this->add_control(
            'text_options',
            [
                'label' => __( 'Text Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'separator_style' => 'line_text',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .separator i,{{WRAPPER}} .separator span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'separator_style' => ['line_text', 'line_icon'],
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator i,{{WRAPPER}} .separator span' => 'font-size: {{SIZE}}px;',
                ],
                'condition' => [
                    'separator_style' => ['line_text', 'line_icon'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_size',
            [
                'label' => __( 'Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'separator_style' => 'line_image',
                ],
            ]
        );
        $this->add_responsive_control(
            'element_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator i,{{WRAPPER}} .separator img,{{WRAPPER}} .separator span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'separator_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .separator',
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'second_line',
            [
                'label' => __( 'Second Line', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'position: relative;',
                    '{{WRAPPER}} .separator:before' => 'position: absolute;top: 0;content: "";display: block;',
                ],
            ]
        );
        $this->add_control(
            'second_separator_options',
            [
                'label' => __( 'Second Line Options', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'second_line_style',
            [
                'label' => __( 'Line Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'  => __( 'Solid', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                    'double' => __( 'Double', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'groove' => __( 'Groove', text_domain ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'border-style: {{VALUE}}',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_separator_after_alignment',
            [
                'label' => __( 'Second Separator Alignment', text_domain ),
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
                'selectors' => [
                    '{{WRAPPER}} .separator:first-child::before' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'right: 0',
                    'center' => 'right: 50%;translate: transformX(50%);',
                    'right' => 'left: 0',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],

            ]
        );
        $this->add_responsive_control(
            'second_separator_before_alignment',
            [
                'label' => __( 'Second Separator Alignment', text_domain ),
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
                'selectors' => [
                    '{{WRAPPER}} .separator:last-child::before' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'right: 0',
                    'center' => 'right: 50%;translate: transformX(50%);',
                    'right' => 'left: 0',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'second_separator_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_separator_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'border-width: {{SIZE}}px;',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_separator_width',
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
                'default' => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_separator_transform',
            [
                'label' => __( 'Position Y', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => -2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'second_line' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $sub_heading = $settings['sub_heading'];
        $heading = $settings['heading'];
        $sub_heading_tag = $settings['sub_heading_tag'];
        $heading_tag = $settings['heading_tag'];
        $separator_style = $settings['separator_style'];
        switch ($separator_style) {
            case 'none' :
                $line = "";
                break;
            case 'line' :
                $line = "<div class='separator flex align-items-center'><hr></div>";
                break;
            case 'line_icon' :
                $icon = $settings['separator_icon']['value'];
                $line = "<div class='separator flex align-items-center'><hr><i class='$icon'></i><hr></div>";
                break;
            case 'line_image' :
                $image = $settings['separator_image']['url'];
                $line = "<div class='separator flex align-items-center'><hr><img src='$image' alt='$image'><hr></div>";
                break;
            case 'line_text' :
                $separator_text = $settings['separator_text'];
                $line = "<div class='separator flex align-items-center'><hr><span>$separator_text</span><hr></div>";
                break;
        }

        $separator_position = $settings['separator_position'];



        // Link
        $heading_link = $settings['heading_link']['url'];
        if (!empty($heading_link) && !Plugin::$instance->editor->is_edit_mode()) {
            $target = $settings['heading_link']['is_external'] ? '_blank' : '_self';
            $this->add_render_attribute( 'heading', 'onclick', "window.open('$heading_link', '$target')" );
            $this->add_render_attribute( 'heading','class', 'pointer'  );
        }

        $this->add_render_attribute( 'heading','class', 'tmt-heading'  );

        $heading_render = $this->get_render_attribute_string( 'heading' );

        echo "<div $heading_render>";
        if ($separator_position == 'top') {echo $line;}
        if(!empty($sub_heading)) {echo "<$sub_heading_tag class='sub-heading'>$sub_heading</$sub_heading_tag>";}
        if ($separator_position == 'between') {echo $line;}
        echo "<$heading_tag class='heading flex'>";if ($separator_position == 'before' || $separator_position == 'before_after') {echo $line;}echo "<span>$heading</span>";if ($separator_position == 'after' || $separator_position == 'before_after') {echo $line;}echo "</$heading_tag>";
        if ($separator_position == 'bottom') {echo $line;}
        echo "</div>";
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Heading );