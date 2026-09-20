<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Testimonial extends Widget_Base {

    public function get_name() {
        return 'tmt-testimonial';
    }

    public function get_title() {
        return __( 'Testimonial', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_keywords() {
        return [ 'testimonial', 'carousel', 'comments' ];
    }

    protected function _register_controls() {
        $this->register_general_slides_controls();
        $this->register_general_setting_controls();
        $this->register_general_slides_style_controls();
        $this->register_general_image_style_controls();
        $this->register_general_content_style_controls();
        $this->register_general_navigation_style_controls();
    }

    protected function register_general_slides_controls() {
        $this->start_controls_section(
            'section_slides',
            [
                'label' => __( 'Slides', text_domain ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __( 'Description', text_domain ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'photo',
            [
                'label'   => __( 'Choose Photo', text_domain ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => wp_directory_uri . '/assets/images/member.svg',
                ],
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => __( 'Name', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Ali Amini', text_domain ),
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'CEO', text_domain ),
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', text_domain ),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'name' => __( 'Ali Amini 1', text_domain ),
                        'title' => __( 'CEO 1', text_domain ),
                    ],
                    [
                        'text' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'name' => __( 'Ali Amini 2', text_domain ),
                        'title' => __( 'CEO 2', text_domain ),
                    ],
                    [
                        'text' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'name' => __( 'Ali Amini 3', text_domain ),
                        'title' => __( 'CEO 3', text_domain ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => __( 'Image Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top-title',
                'options' => [
                    'right-title'  => __( 'Right Title', text_domain ),
                    'left-title' => __( 'Left Title', text_domain ),
                    'top-title' => __( 'Top Title', text_domain ),
                    'bottom-title' => __( 'Bottom Title', text_domain ),
                    'right-box' => __( 'Right Box', text_domain ),
                    'left-box' => __( 'Left Box', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'text_position',
            [
                'label' => __( 'Text Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'  => __( 'Top', text_domain ),
                    'bottom' => __( 'Bottom', text_domain ),
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_setting_controls() {
        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => __( 'Slider Options', text_domain ),
                'type' => Controls_Manager::SECTION,
            ]
        );
        $this->add_control(
            'scroll',
            [
                'label' => __( 'Slides To Scroll', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'dots',
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
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
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
            'transition',
            [
                'label' => __( 'Transition', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', text_domain ),
                    'fade' => __( 'Fade', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'transition_speed',
            [
                'label' => __( 'Transition Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_slides_style_controls() {
        $this->start_controls_section(
            'section_slides_style',
            [
                'label' => __( 'Slide', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slide_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slide' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slide_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'slide_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slide_radius',
            [
                'label' => __( 'Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slide_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slide' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slide_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .testimonial-slide',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .testimonial-slide',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_image_style_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => __( 'Image', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_alignment',
            [
                'label'   => __( 'Image Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'right'   => [
                        'title' => __( 'Top', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'left' => [
                        'title' => __( 'Bottom', text_domain ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'      => 'center',
                'toggle'       => false,
                'condition'    => [
                    'image_position' => ['right-box', 'left-box']
                ],
            ]
        );
        $this->add_control(
            'image_h_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .content p' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .position-testimonial' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'image_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'image_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_radius',
            [
                'label' => __( 'Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 100,
                    'right' => 100,
                    'bottom' => 100,
                    'left' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_content_style_controls() {
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_heading',
            [
                'label' => __( 'Text', text_domain ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'text_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'text_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .content p',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .content p' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'name_heading',
            [
                'label' => __( 'Name', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'name_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .name',
            ]
        );
        $this->add_control(
            'name_align',
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
                'selectors' => [
                    '{{WRAPPER}} .name' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Name', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_align',
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
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_navigation_style_controls() {
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __( 'Navigation', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'heading_style_arrows',
            [
                'label' => __( 'Arrows', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'right_arrow',
            [
                'label' => __( 'Right Arrow', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'top: {{TOP}}%;right: {{RIGHT}}%;left: auto;',
                ],
            ]
        );
        $this->add_control(
            'left_arrow',
            [
                'label' => __( 'Left Arrow', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'left' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'top: {{TOP}}%;left: {{LEFT}}%;right: auto;',
                ],
            ]
        );
        $this->add_control(
            'arrows_size',
            [
                'label' => __( 'Arrows Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->start_controls_tabs( 'arrows_icon_tabs' );
        $this->start_controls_tab( 'arrows_icon_normal', [ 'label' => __( 'Normal', text_domain ) ] );

        $this->add_control(
            'arrows_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'arrows_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'arrows_icon_hover', [ 'label' => __( 'Hover', text_domain ) ] );

        $this->add_control(
            'arrows_hover_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:hover:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:hover:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'arrows_hover_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:hover:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:hover:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'heading_style_dots',
            [
                'label' => __( 'Dots', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dots_position',
            [
                'label' => __( 'Dots Position', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots' => 'top: {{TOP}}%;right: {{RIGHT}}%;width: auto;bottom: 0;',
                ],
            ]
        );
        $this->add_control(
            'dots_size_width',
            [
                'label' => __( 'Dots Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => '25',
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li,{{WRAPPER}} ul.slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dots_size_height',
            [
                'label' => __( 'Dots Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => '5',
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li,{{WRAPPER}} ul.slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Dots Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li,{{WRAPPER}} ul.slick-dots li button' => 'background-color: {{VALUE}};',
                ],
                'default'  => '#E11739',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
        $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

        $slick_options = [
            'slidesToShow' => absint( $settings['columns'] ),
            'slidesToScroll' => absint( $settings['scroll'] ),
            'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
            'autoplay' => ( 'yes' === $settings['autoplay'] ),
            'infinite' => ( 'yes' === $settings['infinite'] ),
            'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
            'speed' => absint( $settings['transition_speed'] ),
            'arrows' => $show_arrows,
            'dots' => $show_dots,
            'rtl' => $is_rtl,
        ];
        if ( 'fade' === $settings['transition'] ) {
            $slick_options['fade'] = true;
        }

        $carousel_classes = [ 'elementor-slides' ];

        $this->add_render_attribute( 'slides', [
            'class' => $carousel_classes,
            'data-slick' => wp_json_encode( $slick_options ),
        ] );

        $img_position = '';
        $image_position = $settings['image_position'];
        if ($image_position == 'left-title'){$img_position = 'flex-row-reverse';}
        elseif ($image_position == 'top-title') {$img_position = 'flex-column';}
        elseif ($image_position == 'bottom-title') {$img_position = 'flex-column-reverse';}

        $image_alignment = $settings['image_alignment'];
        $image_h_alignment = $settings['image_h_alignment'];

        $img_box = in_array( $image_position, [ 'right-box', 'left-box' ] );
        $box_img = '';
        if ($image_position == 'left-box') {$box_img = 'flex-row-reverse';}

        $content_position = '';
        if ($settings['text_position'] == 'bottom') {$content_position = 'flex-column-reverse';}

        if ( $settings['slides'] ) {
        $slider = $this->get_render_attribute_string( 'slides' );
        echo "<div class='tmt-testimonial elementor-slides-wrapper' dir='$direction'><div class='testimonial-slider' $slider>";
            foreach (  $settings['slides'] as $slide ) {
            $id = $slide['_id'];
            $img_url = $slide['photo']['url'];
            $text = $slide['text'];
            $name = $slide['name'];
            $title = $slide['title'];
            $image = "<img src='$img_url' alt='$name' title='$name'>";
            echo "<div class='elementor-repeater-item-$id'>"
                . "<div class='flex align-items-$image_alignment justify-content-center $box_img'>";
                    if ($img_box) {echo $image;}
                    echo "<div class='testimonial-slide flex flex-column $content_position'>"
                        . "<div class='content'><p>$text</p></div>";
                        echo "<div class='flex position-testimonial align-items-center justify-content-$image_h_alignment $img_position'>";
                            if (in_array( $image_position, [ 'right-title', 'left-title', 'top-title', 'bottom-title' ] )) {echo $image;}
                            echo "<div class='info flex flex-column'>"
                            . "<h4 class='name'>$name</h4>"
                            . "<h5 class='title'>$title</h5>"
                            . "</div>"
                        . "</div>"
                    . "</div>"
                . "</div>"
            . "</div>";
            }
        echo "</div>"
        . "</div>";
        }


    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Testimonial );