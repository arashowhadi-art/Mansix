<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Themento_slider_widget extends Widget_Base{

    public function get_name(){
        return 'themento_slides';
    }

    public function get_title(){
        return __( 'Slider', text_domain );
    }

    public function get_icon() {
        return 'eicon-slider-device';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'slides', 'carousel', 'image', 'title', 'slider' ];
    }

    protected function _register_controls() {
        $this->register_general_slide_controls();
        $this->register_general_slide_setting_controls();
        $this->register_general_slide_style_controls();
        $this->register_general_slide_title_style_controls();
        $this->register_general_slide_description_style_controls();
        $this->register_general_slide_button_style_controls();
        $this->register_general_slide_navigation_style_controls();
    }

    protected function register_general_slide_controls() {
        $this->start_controls_section(
            'section_slides',
            [
                'label' => __( 'Slides', text_domain ),
            ]
        );

        $repeater = new Repeater();
        $repeater->start_controls_tabs( 'slides_repeater' );
        $repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', text_domain ) ] );

        $repeater->add_control(
            'source',
            [
                'label'   => esc_html__( 'Select Source', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'        => esc_html__( 'Custom Content', text_domain ),
                    'elementor'     => esc_html__( 'Elementor Template', text_domain ),
                ],
            ]
        );
        $repeater->add_control(
            'template_id',
            [
                'label'       => __( 'Select Template', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => tmt_customizer_elementor_library( 'library' ),
                'label_block' => 'true',
                'condition'   => [ 'source' => 'elementor' ],
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#bbbbbb',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tmt-slider-item' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'background_image',
            [
                'label' => _x( 'Image', 'Background Control', text_domain ),
                'type' => Controls_Manager::MEDIA,
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'background_size',
            [
                'label' => _x( 'Size', 'Background Control', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'inherit' => _x( 'None', 'Background Control', text_domain ),
                    'cover' => _x( 'Cover', 'Background Control', text_domain ),
                    'contain' => _x( 'Contain', 'Background Control', text_domain ),
                    'none' => _x( 'Auto', 'Background Control', text_domain ),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'object-fit: {{VALUE}}',
                ],
                'condition' => [
                    'background_image[url]!' => '',
                    'source' => 'custom'
                ],
            ]
        );
        $repeater->add_control(
            'animation_bg',
            [
                'label' => __( 'Background Animate', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'separator' => 'before',
                'condition' => [
                    'background_image[url]!' => '',
                    'source' => 'custom'
                ],
            ]
        );
        $repeater->add_control(
            'animation_bg_style',
            [
                'label' => __( 'Background Animation Type', text_domain ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'bounceIn',
                'condition' => [
                    'animation_bg!' => '',
                    'source' => 'custom'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.slick-current' => '-webkit-animation-name: {{VALUE}};animation-name: {{VALUE}};',
                ],
            ]
        );
        $repeater->add_control(
            'animation_bg_speed',
            [
                'label' => __( 'Background Animation Speed', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 2,
                ],
                'condition' => [
                    'animation_bg!' => '',
                    'source' => 'custom'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.slick-current' => '-webkit-animation-duration: {{SIZE}}{{UNIT}}; animation-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            'animation_text',
            [
                'label' => __( 'Text Animate', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'separator' => 'before',
                'condition' => [
                    'background_image[url]!' => '',
                    'source' => 'custom'
                ],
            ]
        );
        $repeater->add_control(
            'animation_text_style',
            [
                'label' => __( 'Text Animation Type', text_domain ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'bounceIn',
                'condition' => [
                    'animation_text!' => '',
                    'source' => 'custom'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.slick-current .content > div > *' => '-webkit-animation-name: {{VALUE}};animation-name: {{VALUE}};',
                ],
            ]
        );
        $repeater->add_control(
            'background_overlay',
            [
                'label' => __( 'Background Overlay', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'separator' => 'before',
                'condition' => [
                    'background_image[url]!' => '',
                    'source' => 'custom'
                ],
            ]
        );
        $repeater->add_control(
            'background_overlay_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.5)',
                'condition' => [
                    'background_overlay' => 'yes',
                    'source' => 'custom'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', text_domain ) ] );

        $repeater->add_control(
            'heading',
            [
                'label' => __( 'Title & Description', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Heading', text_domain ),
                'label_block' => true,
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', text_domain ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                'show_label' => false,
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Click Here', text_domain ),
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', text_domain ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', text_domain ),
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_control(
            'link_click',
            [
                'label' => __( 'Apply Link On', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slide' => __( 'Whole Slide', text_domain ),
                    'button' => __( 'Button Only', text_domain ),
                ],
                'default' => 'slide',
                'condition' => [
                    'link[url]!' => '',
                    'source' => 'custom'
                ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab( 'style', [ 'label' => __( 'Style', text_domain ) ] );
        $repeater->add_control(
            'custom_style',
            [
                'label' => __( 'Custom', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __( 'Set custom style that will only affect this specific slide.', text_domain ),
                'condition'   => [ 'source' => 'custom' ],
            ]
        );
        $repeater->add_responsive_control(
            'horizontal_position',
            [
                'label' => __( 'Horizontal Position', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'eicon-h-align-left',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content > div' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
                'condition'   => [ 'custom_style' => 'yes' ],
            ]
        );
        $repeater->add_responsive_control(
            'vertical_position',
            [
                'label' => __( 'Vertical Position', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Top', text_domain ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Middle', text_domain ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'Bottom', text_domain ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content' => 'justify-content: {{VALUE}}',
                ],
                'condition'   => [ 'custom_style' => 'yes' ],
            ]
        );
        $repeater->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Text Align', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content' => 'text-align: {{VALUE}}',
                ],
                'condition'   => [ 'custom_style' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'content_color',
            [
                'label' => __( 'Content Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content > *' => 'color: {{VALUE}};border-color: {{VALUE}}',
                ],
                'condition'   => [ 'custom_style' => 'yes' ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', text_domain ),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'heading' => __( 'Slide 1 Heading', text_domain ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'button_text' => __( 'Click Here', text_domain ),
                        'background_color' => '#833ca3',
                    ],
                    [
                        'heading' => __( 'Slide 2 Heading', text_domain ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'button_text' => __( 'Click Here', text_domain ),
                        'background_color' => '#4054b2',
                    ],
                    [
                        'heading' => __( 'Slide 3 Heading', text_domain ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', text_domain ),
                        'button_text' => __( 'Click Here', text_domain ),
                        'background_color' => '#1abc9c',
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );
        $this->add_responsive_control(
            'slides_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-slider,{{WRAPPER}} .tmt-slider-item,{{WRAPPER}} .tmt-slider-item > img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_slide_setting_controls() {
        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => __( 'Slider Options', text_domain ),
                'type' => Controls_Manager::SECTION,
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
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
    protected function register_general_slide_style_controls() {
        $this->start_controls_section(
            'section_style_slides',
            [
                'label' => __( 'Slides', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => '66',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content > div' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slides_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slides_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-slider-item > img,{{WRAPPER}} .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slides_horizontal_position',
            [
                'label' => __( 'Horizontal Position', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'eicon-h-align-left',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content > div' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
            ]
        );
        $this->add_responsive_control(
            'slides_vertical_position',
            [
                'label' => __( 'Vertical Position', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Top', text_domain ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Middle', text_domain ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'Bottom', text_domain ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'slides_text_align',
            [
                'label' => __( 'Text Align', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_slide_title_style_controls() {
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __( 'Title', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'heading_spacing',
            [
                'label' => __( 'Spacing', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-heading' => 'color: {{VALUE}}',
                ],
                'default' => '#FFF',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .slide-heading',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_slide_description_style_controls() {
        $this->start_controls_section(
            'section_style_description',
            [
                'label' => __( 'Description', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Spacing', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-description' => 'color: {{VALUE}}',
                ],
                'default' => '#FFF',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .slide-description',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_slide_button_style_controls() {
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => __( 'Button', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'button_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .slide-button a',
            ]
        );
        $this->add_responsive_control(
            'button_border_width',
            [
                'label' => __( 'Border Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top' => '5',
                    'right' => '20',
                    'bottom' => '5',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'button_tabs' );
        $this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', text_domain ) ] );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
           Group_Control_Background::get_type(),
            [
                'name' => 'button_bg_color',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .slide-button a',
            ]
        );
        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .slide-button a' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', text_domain ) ] );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .slide-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_bg_color',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .slide-button a:hover',
            ]
        );
        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-button a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_general_slide_navigation_style_controls() {
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
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
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
            'arrows_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
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
                    '{{WRAPPER}} .slick-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
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
            'arrows_hover_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover:before' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'arrow_radius',
            [
                'label' => __('Border Radius', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_padding',
            [
                'label' => esc_html__('Padding', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

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
                    'navigation' => ['both', 'dots'],
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
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Dots Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'background-color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'active_dot_color',
            [
                'label' => __( 'Active Dot Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'background-color: {{VALUE}};',
                ],
                'default' => '#4054B2',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
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
                    'size' => 15,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
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
                    'size' => 15,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
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
                    '{{WRAPPER}} .slick-dots .slick-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
       $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

       $this->add_control(

           'style_outline_hover',

           [

               'label' => __( 'Style Outline', text_domain ),

               'type' => Controls_Manager::SELECT,

               'default' => 'solid',

               'options' => [

                   'none' => __( 'None', text_domain ),

                   'solid'  => __( 'Solid', text_domain ),

                   'dashed' => __( 'Dashed', text_domain ),

                   'dotted' => __( 'Dotted', text_domain ),

                   'double' => __( 'Double', text_domain ),

                   ],

               'selectors' => [

                   '{{WRAPPER}} .slick-dots .slick-active' => 'outline-style:{{VALUE}}',
                   ],
               ]
       );

       $this->add_control(
             'outline_thickness_hover',
          [

              'label' => __( 'Thickness', text_domain ),

              'type' => Controls_Manager::SLIDER,

              'range' => [

                  'px' => [

                      'min' => 0,

                      'max' => 100,

                      'step' => 1,

                      ],

                  ],

              'default' => [

                  'size' => 50,

                  ],

              'selectors' => [

                  '{{WRAPPER}} .slick-dots .slick-active' => 'outline-width: {{SIZE}}px;',

                  ],

              'condition' => [

                  'style_outline_hover!' => 'none',

                  'navigation' =>  'dots',

                  ],

              ]

       );


       $this->add_control(
           'outline_color_hover',

           [

               'label' => __( 'Color', text_domain ),

               'type' => Controls_Manager::COLOR,

               'selectors' => [

                   '{{WRAPPER}} .slick-dots .slick-active' => 'outline-color: {{VALUE}}',

                   ],

               'condition' => [

                   'style_outline_hover!' => 'none',

                   'navigation' =>  'dots',

                   ],

               ]

       );

                    $this->add_control(
            'outline_offset_hover',
            [
            'label' => __( 'Padding', text_domain ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
            'px' => [
            'min' => 0,
            'max' => 100,
            ],
            ],
            'default' => [
            'size' => 5,
            ],
            'selectors' => [
            '{{WRAPPER}} .slick-dots .slick-active' => 'outline-offset: {{SIZE}}px;',
            ],
            'condition' => [
            'style_outline_hover!' => 'none',
            'navigation' =>  'dots',
            ],
            ]
            );

                    $this->add_control(
                    'border_radius_outline_hover',
                    [
                    'label' => __( 'Border Radius', text_domain ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};-moz-outline-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                    'condition' => [
                    'style_outline_hover!' => 'none',
                    'navigation' =>  'dots',
                    ],
                    ]
                    );

                    $this->end_controls_tab();
                    $this->end_controls_tabs();

                    $this->end_controls_section();
                    }

    protected function render() {
        $settings = $this->get_settings();
        $slides = $settings['slides'];
        $editor = Plugin::$instance->editor->is_edit_mode();
        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
        $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
        $data_slick = [
            'slidesToShow' => absint( 1 ),
            'slidesToScroll' => absint( 1 ),
            'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
            'autoplay' => ( 'yes' === $settings['autoplay'] ),
            'infinite' => ( 'yes' === $settings['infinite'] ),
            'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
            'speed' => absint( $settings['transition_speed'] ),
            'arrows' => $show_arrows,
            'dots' => $show_dots,
            'rtl' => $is_rtl,
        ];
        $this->add_render_attribute( 'slides', ['data-slick' => wp_json_encode( $data_slick ),] );
        
        if ($slides) {
            echo "<div class='tmt-slider' dir='$direction' ". $this->get_render_attribute_string( 'slides' ) .">";
            foreach (  $slides as $item ) {
                $id = $item['_id'];
                $source = $item['source'];
                $image = $item['background_image']['url'];
                $heading = $item['heading'];
                $description = $item['description'];
                $button_text = $item['button_text'];
                $link = $item['link']['url'];
                $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                $link_click = $item['link_click'];
                echo '<div class="tmt-slider-item elementor-repeater-item-'. $id .'"'; if ( $link == '' || $link_click == 'button' || $editor) {echo '>';} else {echo ' onclick="' . "location.href='"; echo $link . "'" . '">';}
                    switch($source) {
                        case 'elementor' :
                            $template_id = $item['template_id'];
                            echo TMT_Elementor_Template($template_id);
                        break;
                        case 'custom' :
                            if(!empty($image)) {
                                if(!empty($heading)) {$title = $heading;} else {$title = "slide-$id";}
                                echo "<img src='$image' alt='$title' title='$title' />";
                            }
                            echo "<div class='content'><div>";
                                if(!empty($heading)) {echo "<div class='slide-heading'>$heading</div>";}
                                if(!empty($description)) {echo "<div class='slide-description'>$description</div>";}
                                if(!empty($button_text)) {echo "<div class='slide-button'><a href='$link'$target$nofollow>$button_text</a></div>";}
                            echo "</div></div>";
                        break;
                    }
                echo "</div>";
            }
            echo "</div>";
        }
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_slider_widget );