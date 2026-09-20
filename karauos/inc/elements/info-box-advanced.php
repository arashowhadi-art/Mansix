<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_Info_Box_Advanced extends Widget_Base {

    public function get_name() {
        return 'tmt-advanced-icon-box';
    }

    public function get_title() {
        return __( 'Advanced Info Box', text_domain );
    }
    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_keywords() {
		return [ 'info box', 'image box', 'icon box', 'icon', 'image', 'photo', 'visual', 'box' ];
	}

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content_icon_box',
            [
                'label' => __( 'Icon Box', text_domain ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'        => esc_html__('Icon Type', text_domain),
                'type'         => Controls_Manager::CHOOSE,
                'toggle'       => false,
                'default'      => 'icon',
                'prefix_class' => 'tmt-icon-type-',
                'render_type'  => 'template',
                'options'      => [
                    'icon' => [
                        'title' => esc_html__('Icon', text_domain),
                        'icon'  => 'fas fa-star'
                    ],
                    'image' => [
                        'title' => esc_html__('Image', text_domain),
                        'icon'  => 'far fa-image'
                    ]
                ]
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => __( 'Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'render_type'      => 'template',
                'condition'        => [
                    'icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'       => __( 'Image Icon', text_domain ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'   => __( 'Title & Description', text_domain ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => __( 'Icon Box Heading', text_domain ),
                'placeholder' => __( 'Enter your title', text_domain ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label'        => __( 'Title Link', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'tmt-title-link-'
            ]
        );


        $this->add_control(
            'title_link_url',
            [
                'label'       => __( 'Title Link URL', text_domain ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'title_link' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'show_separator',
            [
                'label'        => __( 'Title Separator', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'description_text',
            [
                'type'    => Controls_Manager::TEXTAREA,
                'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                'placeholder' => __( 'Enter your description', text_domain ),
                'rows'        => 10,
                'separator'   => 'before',
                'show_label'  => false,
            ]
        );

        $this->add_responsive_control(
            'position',
            [
                'label'     => __( 'Icon Position', text_domain ),
                'type'      => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'default'   => 'top',
                'options'   => [
                    'left' => [
                        'title' => is_rtl() ? __( 'Right', text_domain ) : __( 'Left', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-right' : 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => is_rtl() ? __( 'Left', text_domain ) : __( 'Right', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-left' : 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle'       => false,
                'condition'    => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_vertical_alignment',
            [
                'label'   => __( 'Icon Vertical Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top'   => [
                        'title' => __( 'Top', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', text_domain ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', text_domain ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'      => 'top',
                'toggle'       => false,
                'prefix_class' => 'elementor-vertical-align-',
                'condition'    => [
                    'position' => ['left', 'right']
                ],
            ]
        );

        $this->add_control(
            'readmore',
            [
                'label'     => __( 'Read More Button', text_domain ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'default'   => 'yes',
            ]
        );
        $this->add_control(
            'indicator',
            [
                'label' => __( 'Indicator', text_domain ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'badge',
            [
                'label' => __( 'Badge', text_domain ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'global_link',
            [
                'label'        => __( 'Global Link', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'tmt-global-link-',
                'description'  => __( 'Be aware! When Global Link activated then title link and read more link will not work', text_domain ),
            ]
        );

        $this->add_control(
            'global_link_url',
            [
                'label'       => __( 'Global Link URL', text_domain ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'global_link' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_readmore',
            [
                'label'     => __( 'Read More', text_domain ),
                'condition' => [
                    'readmore' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'readmore_text',
            [
                'label'       => __( 'Text', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => __( 'Read More', text_domain ),
                'placeholder' => __( 'Read More', text_domain ),
            ]
        );

        $this->add_control(
            'readmore_link',
            [
                'label'     => __( 'Link to', text_domain ),
                'type'      => Controls_Manager::URL,
                'separator' => 'before',
                'dynamic'   => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', text_domain ),
                'default'     => [
                    'url' => '#',
                ],
                'condition' => [
                    'readmore'       => 'yes',
                    //'readmore_text!' => '',
                ]
            ]
        );

        $this->add_control(
            'onclick',
            [
                'label'     => esc_html__( 'OnClick', text_domain ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'readmore'       => 'yes',
                    //'readmore_text!' => '',
                ]
            ]
        );

        $this->add_control(
            'onclick_event',
            [
                'label'       => esc_html__( 'OnClick Event', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => 'myFunction()',
                'description' => sprintf( esc_html__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp' ),
                'condition' => [
                    'readmore'       => 'yes',
                    //'readmore_text!' => '',
                    'onclick'        => 'yes'
                ]
            ]
        );

        $this->add_control(
            'advanced_readmore_icon',
            [
                'label'       => __( 'Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'readmore_icon',
                'separator'   => 'before',
                'label_block' => true,
                'condition'   => [
                    'readmore'       => 'yes'
                ]
            ]
        );

        $this->add_control(
            'readmore_icon_align',
            [
                'label'   => __( 'Icon Position', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'   => __( 'Left', text_domain ),
                    'right'  => __( 'Right', text_domain ),
                ],
                'condition' => [
                    'advanced_readmore_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'readmore_icon_indent',
            [
                'label' => __( 'Icon Spacing', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'advanced_readmore_icon[value]!' => '',
                    'readmore_text!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore .tmt-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore .tmt-button-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_on_hover',
            [
                'label'        => __( 'Show on Hover', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'tmt-readmore-on-hover-',
            ]
        );

        $this->add_responsive_control(
            'readmore_horizontal_offset',
            [
                'label' => __( 'Horizontal Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -50,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'readmore_on_hover' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_vertical_offset',
            [
                'label' => __( 'Vertical Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}}.tmt-readmore-on-hover-yes .tmt-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset.SIZE}}%, {{SIZE}}%);',
                    '(tablet){{WRAPPER}}.tmt-readmore-on-hover-yes .tmt-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset_tablet.SIZE}}%, {{SIZE}}%);',
                    '(mobile){{WRAPPER}}.tmt-readmore-on-hover-yes .tmt-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset_mobile.SIZE}}%, {{SIZE}})%);',
                ],
                'condition' => [
                    'readmore_on_hover' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_indicator',
            [
                'label'     => __( 'Indicator', text_domain ),
                'condition' => [
                    'indicator' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_width',
            [
                'label' => __( 'Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 10,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-indicator-svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_horizontal_offset',
            [
                'label' => __( 'Horizontal Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_vertical_offset',
            [
                'label' => __( 'Vertical Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_rotate',
            [
                'label'   => esc_html__( 'Rotate', text_domain ),
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
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .tmt-indicator-svg' => 'transform: translate({{indicator_horizontal_offset.SIZE}}px, {{indicator_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .tmt-indicator-svg' => 'transform: translate({{indicator_horizontal_offset_tablet.SIZE}}px, {{indicator_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .tmt-indicator-svg' => 'transform: translate({{indicator_horizontal_offset_mobile.SIZE}}px, {{indicator_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_badge',
            [
                'label'     => __( 'Badge', text_domain ),
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => __( 'Badge Text', text_domain ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'POPULAR',
                'placeholder' => 'Type Badge Title',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label'   => esc_html__( 'Position', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => themento_position(),
            ]
        );

        $this->add_responsive_control(
            'badge_horizontal_offset',
            [
                'label' => __( 'Horizontal Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_vertical_offset',
            [
                'label' => __( 'Vertical Offset', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_rotate',
            [
                'label'   => esc_html__( 'Rotate', text_domain ),
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
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .tmt-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset.SIZE}}px, {{badge_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .tmt-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset_tablet.SIZE}}px, {{badge_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .tmt-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset_mobile.SIZE}}px, {{badge_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __( 'Additional Options', text_domain ),
            ]
        );

        $this->add_responsive_control(
            'top_icon_vertical_offset',
            [
                'label' => esc_html__('Icon Vertical Offset', text_domain),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'position' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-icon' => 'margin-top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'top_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', text_domain),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'position' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-icon' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', text_domain),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'position' => 'left',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-icon' => 'margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'right_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', text_domain),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'position' => 'right',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-icon' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_right_icon_vertical_offset',
            [
                'label' => esc_html__('Icon Vertical Offset', text_domain),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'position' => ['left', 'right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-icon' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'   => __( 'Title HTML Tag', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon_box',
            [
                'label'      => __( 'Icon/Image', text_domain ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'selected_icon',
                            'operator' => '!=',
                            'value'    => ''
                        ],
                        [
                            'name'     => 'image',
                            'operator' => '!=',
                            'value'    => ''
                        ],
                    ]
                ]
            ]
        );

        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_background',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper'
            ]
        );

        $this->add_control(
            'icon_radius',
            [
                'label'      => esc_html__('Radius', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [
                    'icon_radius_advanced_show!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_radius_advanced_show',
            [
                'label' => __( 'Advanced Radius', text_domain ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_radius_advanced',
            [
                'label'       => esc_html__('Radius', text_domain),
                'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', text_domain), '75% 25% 43% 57% / 46% 29% 71% 54%', 'https://9elements.github.io/fancy-border-radius/'),
                'type'        => Controls_Manager::TEXT,
                'size_units'  => [ 'px', '%' ],
                'separator'   => 'after',
                'default'     => '75% 25% 43% 57% / 46% 29% 71% 54%',
                'selectors'   => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper'     => 'border-radius: {{VALUE}}; overflow: hidden;',
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper img' => 'border-radius: {{VALUE}}; overflow: hidden;'
                ],
                'condition' => [
                    'icon_radius_advanced_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'icon_typography',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper',
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => __( 'Spacing', text_domain ),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default'   => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .tmt-advanced-icon-box-icon' => is_rtl() ? 'margin-right: {{SIZE}}{{UNIT}};' : 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-left .tmt-advanced-icon-box-icon'  => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-top .tmt-advanced-icon-box-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .tmt-advanced-icon-box-icon'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'vh', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper svg,{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'image_fullwidth!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_fullwidth',
            [
                'label' => __( 'Image Fullwidth', text_domain ),
                'type'  => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'width: 100%;box-sizing: border-box;',
                ],
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label'   => __( 'Rotate', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_background_rotate',
            [
                'label'   => __( 'Background Rotate', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_heading',
            [
                'label'     => __( 'Image Effect', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'css_filters',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => __( 'Opacity', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'background_hover_transition',
            [
                'label' => __( 'Transition Duration', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box img' => 'transition-duration: {{SIZE}}s',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => __( 'Hover', text_domain ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_hover_background',
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper:after',
            ]
        );

        $this->add_control(
            'icon_effect',
            [
                'label'        => __( 'Effect', text_domain ),
                'type'         => Controls_Manager::SELECT,
                'prefix_class' => 'tmt-icon-effect-',
                'default'      => 'none',
                'options'      => [
                    'none' => __( 'None', text_domain ),
                    'a'    => __( 'Effect A', text_domain ),
                    'b'    => __( 'Effect B', text_domain ),
                    'c'    => __( 'Effect C', text_domain ),
                    'd'    => __( 'Effect D', text_domain ),
                    'e'    => __( 'Effect E', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'hover_icon_animation',
            [
                'label' => __( 'Hover Animation',  text_domain),
                'type' =>Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => '.tmt-advanced-icon-box:hover .tmt-icon-wrapper:after',
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_radius',
            [
                'label'      => esc_html__('Radius', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper'
            ]
        );

        $this->add_control(
            'icon_hover_rotate',
            [
                'label'   => __( 'Rotate', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_rotate',
            [
                'label'   => __( 'Background Rotate', text_domain ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_hover_heading',
            [
                'label'     => __( 'Image Effect', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'css_filters_hover',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => __( 'Opacity', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-icon-wrapper img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Padding', text_domain),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-advanced-icon-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_control(
            'heading_title',
            [
                'label'     => __( 'Title', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'heading_title_align',
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
                    'justify' => [
                        'title' => __( 'Justified', text_domain ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => __( 'Spacing', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-content .tmt-advanced-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_title_color',
            [
                'label'     => __( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-content .tmt-advanced-icon-box-title',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label'     => __( 'Description', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'text_align',
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
                    'justify' => [
                        'title' => __( 'Justified', text_domain ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_bottom_space',
            [
                'label'     => esc_html__('Spacing', text_domain),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-content .tmt-advanced-icon-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-content .tmt-advanced-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'h_description_color',
            [
                'label'     => __( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-content .tmt-advanced-icon-box-description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_title_separator',
            [
                'label'     => __( 'Title Separator', text_domain ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_separator_type',
            [
                'label'   => esc_html__( 'Separator Type', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'line',
                'options' => [
                    'line'  	  => esc_html__( 'Line', text_domain ),
                    'bloomstar'   => esc_html__( 'Bloomstar', text_domain ),
                    'bobbleaf' 	  => esc_html__( 'Bobbleaf', text_domain ),
                    'demaxa' 	  => esc_html__( 'Demaxa', text_domain ),
                    'fill-circle' => esc_html__( 'Fill Circle', text_domain ),
                    'finalio' 	  => esc_html__( 'Finalio', text_domain ),
                    //'fitical' 	  => esc_html__( 'Fitical', text_domain ),
                    'jemik' 	  => esc_html__( 'Jemik', text_domain ),
                    //'genizen' 	  => esc_html__( 'Genizen', text_domain ),
                    'leaf-line'   => esc_html__( 'Leaf Line', text_domain ),
                    //'lendine' 	  => esc_html__( 'Lendine', text_domain ),
                    'multinus' 	  => esc_html__( 'Multinus', text_domain ),
                    //'oradox' 	  => esc_html__( 'Oradox', text_domain ),
                    'rotate-box'  => esc_html__( 'Rotate Box', text_domain ),
                    'sarator' 	  => esc_html__( 'Sarator', text_domain ),
                    'separk' 	  => esc_html__( 'Separk', text_domain ),
                    'slash-line'  => esc_html__( 'Slash Line', text_domain ),
                    //'subtrexo' 	  => esc_html__( 'Subtrexo', text_domain ),
                    'tripline' 	  => esc_html__( 'Tripline', text_domain ),
                    'vague' 	  => esc_html__( 'Vague', text_domain ),
                    'zigzag-dot'  => esc_html__( 'Zigzag Dot', text_domain ),
                    'zozobe' 	  => esc_html__( 'Zozobe', text_domain ),
                ],
                //'render_type' => 'none',
            ]
        );

        $this->add_control(
            'title_separator_border_style',
            [
                'label'   => esc_html__( 'Separator Style', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'  => esc_html__( 'Solid', text_domain ),
                    'dotted' => esc_html__( 'Dotted', text_domain ),
                    'dashed' => esc_html__( 'Dashed', text_domain ),
                    'groove' => esc_html__( 'Groove', text_domain ),
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_separator_line_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_separator_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 15,
                    ]
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'title_separator_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ]
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'title_separator_svg_fill_color',
            [
                'label'     => esc_html__( 'Fill Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator-wrapper svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_separator_svg_stroke_color',
            [
                'label'     => esc_html__( 'Stroke Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator-wrapper svg *' => 'stroke: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'title_separator_svg_width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ]
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator-wrapper > *' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'title_separator_spacing',
            [
                'label' => __( 'Separator Spacing', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box .tmt-title-separator-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_readmore',
            [
                'label'     => __( 'Read More', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'readmore'       => 'yes',
                ],
            ]
        );

        $this->add_control(
            'style_readmore_text_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .readmore-align' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_readmore_style' );

        $this->start_controls_tab(
            'tab_readmore_normal',
            [
                'label' => __( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'readmore_text_color',
            [
                'label'     => __( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmore_background',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-readmore',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'readmore_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-icon-box-readmore'
            ]
        );

        $this->add_responsive_control(
            'readmore_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'readmore_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-readmore',
            ]
        );

        $this->add_responsive_control(
            'readmore_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'full_width_readmore',
            [
                'label' => __( 'Full Width Read More', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'readmore_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-readmore',
            ]
        );



        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_readmore_hover',
            [
                'label' => __( 'Hover', text_domain ),
            ]
        );

        $this->add_control(
            'readmore_hover_text_color',
            [
                'label'     => __( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-readmore svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmore_hover_background',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-readmore',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'readmore_hover_border_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-readmore' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'readmore_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'readmore_hover_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box:hover .tmt-advanced-icon-box-readmore',
            ]
        );

        $this->add_control(
            'readmore_hover_animation',
            [
                'label' => __( 'Hover Animation', text_domain ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_indicator',
            [
                'label'     => __( 'Indicator', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'indicator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'indicator_style',
            [
                'label'   => __( 'Indicator Style', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', text_domain ),
                    '2'   => __( 'Style 2', text_domain ),
                    '3'   => __( 'Style 3', text_domain ),
                    '4'   => __( 'Style 4', text_domain ),
                    '5'   => __( 'Style 5', text_domain ),
                ],
            ]
        );

        $this->add_control(
            'indicator_fill_color',
            [
                'label'     => __( 'Fill Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-indicator-svg svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'indicator_stroke_color',
            [
                'label'     => __( 'Stroke Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-indicator-svg svg' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge',
            [
                'label'     => __( 'Badge', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'     => __( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-badge span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'badge_background',
                'selector'  => '{{WRAPPER}} .tmt-advanced-icon-box-badge span',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-advanced-icon-box-badge span'
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-badge span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_shadow',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-badge span',
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-advanced-icon-box-badge span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .tmt-advanced-icon-box-badge span',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();

        if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['icon'] = 'fas fa-star';
        }

        $has_icon  = ! empty( $settings['icon'] );

        $has_image = ! empty( $settings['image']['url'] );

        if ( $has_icon and 'icon' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'font-icon', 'class', $settings['selected_icon'] );
            $this->add_render_attribute( 'font-icon', 'aria-hidden', 'true' );
        } elseif ( $has_image and 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        $this->add_render_attribute( 'description_text', 'class', 'tmt-advanced-icon-box-description' );

        $this->add_inline_editing_attributes( 'title_text', 'none' );
        $this->add_inline_editing_attributes( 'description_text' );

        if($settings['full_width_readmore'] == 'yes') {
            $this->add_render_attribute( 'readmore', 'class', ['tmt-advanced-icon-box-readmore', 'tmt-display-block'] );
        } else {
            $this->add_render_attribute( 'readmore', 'class', ['tmt-advanced-icon-box-readmore', 'tmt-display-inline-block'] );
        }

        if ( ! empty( $settings['readmore_link']['url'] ) ) {
            $this->add_render_attribute( 'readmore', 'href', $settings['readmore_link']['url'] );

            if ( $settings['readmore_link']['is_external'] ) {
                $this->add_render_attribute( 'readmore', 'target', '_blank' );
            }

            if ( $settings['readmore_link']['nofollow'] ) {
                $this->add_render_attribute( 'readmore', 'rel', 'nofollow' );
            }

        }
        if ( $settings['readmore_hover_animation'] ) {
            $this->add_render_attribute( 'readmore', 'class', 'elementor-animation-' . $settings['readmore_hover_animation'] );
        }

        if ($settings['onclick']) {
            $this->add_render_attribute( 'readmore', 'onclick', $settings['onclick_event'] );
        }

        $this->add_render_attribute( 'advanced-icon-box-title', 'class', 'tmt-advanced-icon-box-title' );

        if ('yes' == $settings['title_link'] and $settings['title_link_url']['url']) {

            $target = $settings['title_link_url']['is_external'] ? '_blank' : '_self';

            if (Plugin::$instance->editor->is_edit_mode()){}else {$this->add_render_attribute( 'advanced-icon-box-title', 'onclick', "window.open('" . $settings['title_link_url']['url'] . "', '$target')" );
            }
        }

        $this->add_render_attribute( 'advanced-icon-box', 'class', 'tmt-advanced-icon-box' );

        if ('yes' == $settings['global_link'] and $settings['global_link_url']['url']) {

            $target = $settings['global_link_url']['is_external'] ? '_blank' : '_self';

            if (Plugin::$instance->editor->is_edit_mode()){}else {$this->add_render_attribute( 'advanced-icon-box', 'onclick', "window.open('" . $settings['global_link_url']['url'] . "', '$target')" );}
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated  = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new    = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();


        if ( ! isset( $settings['readmore_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['readmore_icon'] = 'fas fa-arrow-right';
        }

        $readmore_migrated  = isset( $settings['__fa4_migrated']['advanced_readmore_icon'] );
        $readmore_is_new    = empty( $settings['readmore_icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
        <div <?php echo $this->get_render_attribute_string( 'advanced-icon-box' ); ?>>
            <?php if ( $has_icon or $has_image ) : ?>
                <div class="tmt-advanced-icon-box-icon">
					<span class="tmt-icon-wrapper">


						<?php if ( $has_icon and 'icon' == $settings['icon_type'] ) { ?>

                            <?php if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            else : ?>
                                <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                            <?php endif; ?>


                        <?php } elseif ( $has_image and 'image' == $settings['icon_type'] ) { ?>
                            <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
                        <?php } ?>
					</span>
                </div>
            <?php endif; ?>

            <div class="tmt-advanced-icon-box-content">
                <?php if ( $settings['title_text'] ) : ?>
                <<?php echo esc_html($settings['title_size']); ?> <?php echo $this->get_render_attribute_string( 'advanced-icon-box-title' ); ?>>
                <span <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
							<?php echo esc_html($settings['title_text']); ?>
						</span>
            </<?php echo esc_html($settings['title_size']); ?>>
        <?php endif; ?>

            <?php if ( $settings['show_separator'] ) : ?>

                <?php if ( 'line' == $settings['title_separator_type'] ) : ?>
                    <div class="tmt-title-separator-wrapper">
                        <div class="tmt-title-separator"></div>
                    </div>
                <?php elseif ( 'line' != $settings['title_separator_type'] ) : ?>
                    <div class="tmt-title-separator-wrapper">
						<?php
						$title_separator_type = $settings['title_separator_type'];
							switch($title_separator_type) {
							    case 'bloomstar':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 221.15 21.95"><path d="M0 3.6c4.12 1.17 8.26 2.26 12.44 3.13a142.02 142.02 0 0 0 12.61 2.19c8.46 1.1 16.98 1.48 25.5 1.1l25.68-.74 12.85.02 12.84.36-25.67.77-12.82.5-12.83.57c-8.58.26-17.23-.1-25.72-1.45-4.24-.7-8.46-1.55-12.6-2.62C8.13 6.32 4.02 5.08 0 3.6z"/><path d="M83.17 10.16s-1.53 2.92-4.52 5.07c-3.9 2.8-9.64 5.27-9.74 4.4-.16-1.3 3.3-4.84 6.55-6.7 2.4-1.36 7.14-3.05 7.7-2.8zm-9.03-.56s-3.9.76-7.6-.2c-4.82-1.25-10.1-3.84-9.62-4.6.44-.72 6.75.2 10.3 1.5 2.62.98 6.82 2.74 6.9 3.3zm43-4.73c-.25-.43-1 .36-2.63 1.25-1.8.97-3.26 1.82-3.7 2.35a.92.92 0 0 1 .3.32c.26.46.05 1.02-.47 1.25s-1.14.04-1.4-.42-.05-1.02.47-1.25c.33-.15.7-.12 1 .03.95-1.23 1.86-6.38.97-6.63-.52-.14-.42.9-.87 2.54-.4 1.48-.7 2.76-.76 3.55-.38-1.8-2.6-5.72-3.42-5.5-.52.14.23.94.93 2.52.62 1.4 1.2 2.63 1.66 3.3-1.47-1.28-5.82-3.35-6.34-2.75-.33.38.8.65 2.4 1.6l3.5 1.85c-2.04-.3-6.93.22-6.97.98-.02.48 1.07.13 2.98.1l4.05-.26c-1.86.8-5.53 3.72-5.07 4.36.3.4.96-.44 2.5-1.45l3.15-2.28c-1 1.6-2.14 5.87-1.34 6.16.5.18.5-.85 1.1-2.46.55-1.44.98-2.7 1.1-3.48.2 1.83 2.04 5.9 2.87 5.73.53-.1-.14-.95-.68-2.58-.48-1.46-.93-2.7-1.33-3.4 1.34 1.4 5.47 3.8 6.05 3.23.36-.35-.73-.7-2.22-1.77l-3.3-2.12c2 .46 6.93.32 7.04-.44.07-.48-1.05-.2-2.96-.32l-4.06-.05c1.9-.63 5.86-3.26 5.46-3.94zM102.6 7.9s-4.66.58-8.12-.9c-4.52-1.94-9.24-5.27-8.64-5.95.57-.64 6.62 1.17 9.9 3 2.4 1.34 6.9 3.3 6.87 3.85zm-58.88 3.12s-2.7 2.63-6.32 3.75c-4.74 1.47-11.08 2.05-10.84 1.2.35-1.28 4.95-3.55 8.72-4.3 2.77-.56 8-1.06 8.44-.64zM16.14 3.6s3.16.04 5.75 1.3c3.4 1.66 7.13 4.15 6.6 4.64-.5.46-5.42-.92-7.83-2.45-1.8-1.12-4.6-3.07-4.52-3.5zm86.46 8.94s-1.14 3.54-3.36 5.14c-2.9 2.1-7.18 3.93-7.26 3.28-.12-.98 2.46-3.6 4.88-4.98 1.8-1 5.32-3.63 5.74-3.44zM221.15 3.6c-4.02 1.5-8.13 2.73-12.27 3.84a142.99 142.99 0 0 1-12.6 2.62c-8.5 1.37-17.14 1.72-25.72 1.45l-12.83-.57-12.82-.5-25.67-.77 12.84-.36h12.85c8.57.05 17.14.5 25.68.74 8.53.4 17.05.02 25.5-1.1a142.02 142.02 0 0 0 12.61-2.19c4.18-.88 8.3-1.97 12.43-3.14z"/><path d="M138.23 10.27s1.28 2.8 4.27 4.96c3.9 2.8 9.64 5.27 9.74 4.4.16-1.3-3.3-4.84-6.55-6.7-2.4-1.36-6.9-2.94-7.46-2.68zm8.8-.67s3.9.76 7.6-.2c4.82-1.25 10.1-3.84 9.62-4.6-.44-.72-6.75.2-10.3 1.5-2.63.98-6.83 2.74-6.9 3.3zM117.8 7.54s5.42.95 8.88-.53c4.52-1.94 9.24-5.27 8.64-5.95-.57-.64-6.62 1.17-9.9 3-2.4 1.34-7.65 2.9-7.63 3.48zm59.63 3.48s2.7 2.63 6.32 3.75c4.74 1.47 11.08 2.05 10.84 1.2-.35-1.28-4.96-3.55-8.72-4.3-2.77-.56-8-1.06-8.44-.64zm27.6-7.42s-3.16.04-5.75 1.3c-3.4 1.66-6.82 4.07-6.3 4.56.5.46 5.1-.85 7.52-2.37 1.78-1.12 4.58-3.07 4.52-3.5zm-86.46 8.56s1.14 3.92 3.36 5.52c2.9 2.1 7.18 3.93 7.26 3.28.12-.98-2.46-3.6-4.88-4.98-1.8-1-5.32-4-5.74-3.82z"/></svg>';
                                    break;
                                case 'bobbleaf':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 211.05 20.49"><path d="M0 12.9c3.5-2.88 7.23-5.47 11.23-7.64 4-2.14 8.3-3.83 12.84-4.64 2.26-.42 4.56-.6 6.86-.57 2.3.02 4.6.27 6.85.7 4.5.88 8.85 2.26 13.12 3.8 4.26 1.57 8.45 3.3 12.6 5.1 4.17 1.78 8.22 3.8 12.5 5.07 4.28 1.26 8.76 1.9 13.25 2.1 4.5.26 9 .04 13.5-.4-8.9 1.52-18.18 1.7-27.07-.6-4.47-1.15-8.55-3.22-12.7-4.92-4.16-1.75-8.35-3.43-12.58-4.95-4.22-1.56-8.5-2.97-12.87-3.86-4.36-.9-8.86-.97-13.26-.34a39.37 39.37 0 0 0-6.49 1.58c-2.1.74-4.2 1.57-6.2 2.58C7.5 7.84 3.7 10.3 0 12.9z"/><path d="M71.12 13.27c1.93 0 1.93-3 0-3-1.94 0-1.94 3 0 3z"/><path d="M73.83 13.9c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-3.2 3.04c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-2.98-.48c1.93 0 1.93-3 0-3s-1.94 3 0 3zm6.5-10.38c.6.6 1.05 1.28 1.46 1.96.42.68.76 1.4 1.07 2.12a16.13 16.13 0 0 1 .77 2.25c.2.77.36 1.56.38 2.42-.6-.6-1.05-1.28-1.46-1.96-.42-.68-.76-1.4-1.07-2.13-.3-.73-.57-1.48-.76-2.25-.22-.77-.37-1.56-.4-2.4z"/><path d="M67.88 17.66c.76-.38 1.53-.62 2.3-.8.78-.2 1.56-.3 2.35-.4.8-.07 1.58-.1 2.38-.06s1.6.13 2.42.36c-.76.38-1.53.62-2.3.8-.78.2-1.56.3-2.35.38a15.74 15.74 0 0 1-2.38.05c-.8-.01-1.6-.1-2.42-.34z"/><use xlink:href="#B"/><use xlink:href="#B" x="-4" y="1.19"/><use xlink:href="#B" x="-7.23" y="4.1"/><path d="M74.28 20.6c.65-.55 1.34-.96 2.05-1.32.7-.37 1.44-.67 2.2-.93a16.24 16.24 0 0 1 2.3-.62c.78-.15 1.58-.26 2.43-.22-.65.55-1.34.97-2.05 1.33-.7.37-1.44.67-2.2.93-.75.25-1.5.47-2.3.62-.78.14-1.58.25-2.43.2zm4.55-12c.72.45 1.32 1 1.88 1.56.57.57 1.07 1.18 1.54 1.8a17.4 17.4 0 0 1 1.28 2c.38.7.72 1.43.94 2.26-.72-.45-1.32-1-1.88-1.56-.57-.57-1.07-1.18-1.54-1.8a17.4 17.4 0 0 1-1.28-2c-.38-.7-.72-1.44-.94-2.26zm132.22 4.3c-3.7-2.6-7.5-5.06-11.57-7-2-1-4.1-1.84-6.2-2.58-2.12-.7-4.3-1.24-6.5-1.58-4.4-.63-8.9-.57-13.26.34-4.37.9-8.65 2.3-12.87 3.86-4.24 1.52-8.43 3.2-12.58 4.95-4.16 1.7-8.24 3.77-12.7 4.92-8.9 2.3-18.18 2.12-27.07.6 4.5.45 9.02.67 13.5.4 4.5-.22 8.97-.85 13.25-2.1 4.27-1.28 8.3-3.28 12.5-5.07 4.16-1.8 8.35-3.53 12.6-5.1 4.27-1.53 8.62-2.92 13.12-3.8 2.25-.44 4.56-.7 6.85-.7 2.3-.04 4.6.15 6.86.57 4.53.82 8.83 2.5 12.84 4.64 3.98 2.17 7.73 4.76 11.22 7.64z"/><use xlink:href="#B" x="67.33" y="2.82"/><use xlink:href="#B" x="64.62" y="3.45"/><use xlink:href="#B" x="67.8" y="6.49"/><use xlink:href="#B" x="70.8" y="6.01"/><path d="M136.9 6.08c-.02.85-.18 1.64-.38 2.4-.2.78-.46 1.52-.76 2.25s-.65 1.44-1.07 2.13c-.4.7-.86 1.35-1.46 1.96.02-.85.17-1.64.38-2.42.2-.78.46-1.52.77-2.25s.66-1.44 1.07-2.12c.4-.7.86-1.35 1.45-1.96zm6.27 11.58c-.82.24-1.62.32-2.42.36a15.74 15.74 0 0 1-2.38-.05 16.92 16.92 0 0 1-2.35-.38c-.78-.18-1.55-.42-2.3-.8.82-.24 1.62-.33 2.42-.36.8-.05 1.6-.02 2.38.06s1.57.2 2.35.4c.78.17 1.55.4 2.3.78z"/><use xlink:href="#B" x="65.84"/><path d="M142.46 11.64c1.93 0 1.93-3 0-3s-1.94 3 0 3zm3.22 2.9c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-8.92 6.05c-.85.04-1.65-.07-2.43-.22a14.7 14.7 0 0 1-2.3-.62 16.85 16.85 0 0 1-2.2-.93c-.7-.36-1.4-.77-2.05-1.33.85-.04 1.65.07 2.43.22a16.24 16.24 0 0 1 2.3.62 16.85 16.85 0 0 1 2.2.93c.72.37 1.4.78 2.05 1.33zm-4.54-12c-.22.82-.56 1.55-.94 2.26a14.44 14.44 0 0 1-1.28 2 15.66 15.66 0 0 1-1.54 1.81c-.56.57-1.16 1.1-1.88 1.56.22-.82.56-1.56.94-2.26a14.44 14.44 0 0 1 1.28-2c.47-.63.98-1.24 1.54-1.8s1.16-1.1 1.88-1.56z"/><defs ><path id="B" d="M72.6 10.45c1.93 0 1.93-3 0-3s-1.93 3 0 3z"/></defs></svg>';
                                    break;
                                case 'sarator':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.5 28.7"><path d="M285.3 18.3c-3.5 2.7-7.7.2-10.2-1.7-2.6-2-5.7-3.3-8.8-3.4-11.4-.4-12.7 12.4-12.7 12.4s7.3-12.1 15.9-7.9c0 0 6 2.6 7 10.4 0 0 1.9-3.7-.4-7.2 2.1 1 5.7 2 9.2-2.6zm-68.4 0c3.5 2.7 7.7.2 10.2-1.7 2.6-2 5.7-3.3 8.8-3.4 11.4-.4 12.7 12.4 12.7 12.4s-7.3-12.1-15.9-7.9c0 0-6 2.6-7 10.4 0 0-1.9-3.7.4-7.2-2.1 1-5.7 2-9.2-2.6zm44.8-7.8c-4-.8-7.7 4.2-9.9 8.2-.3.5-.5.9-.7 1.4-.2-.4-.5-.9-.7-1.4-2.2-4-5.9-9-9.9-8.2 3.1-4.9 8-2.3 10.7 5.6 2.5-8 7.4-10.5 10.5-5.6zm-12.2-4.8c-.5-2.4 1.6-5.7 1.6-5.7s2 3.3 1.6 5.7a1.62 1.62 0 0 1-3.2 0zm35.9 20.2c22.9 3.2 46.7 3.6 69.7 1.8 9.3-.7 18.7-1.8 27.9-3.6 9.8-1.9 19.2-4.7 28.7-7.8 16.2-5.2 33.4-9 50.5-8.3 5.8.3 12.9.7 18.2 3.5.9.4 1.6-.8.8-1.3-4.1-2.2-9.2-2.9-13.8-3.4-14.7-1.6-29.7.8-43.9 4.4-10.2 2.6-19.9 6.4-30.1 9-9.5 2.4-19.3 4-29 5-17.1 1.9-34.4 2.1-51.5 1.3-8.9-.4-18.2-1-26.9-2.3-1.2.2-1.6 1.6-.6 1.7zm-66.6-1.4c-23.3 3.3-48 3.6-71.6 1.6-9.8-.8-19.5-2.1-29.1-4.1-10-2.1-19.5-5.5-29.3-8.4C73.5 9 57.2 5.8 41.1 6.7c-5.7.3-12.4.9-17.6 3.7-.9.5-.1 1.7.8 1.3 4.2-2.2 9.7-2.9 14.4-3.3C54.2 7 70 9.9 84.9 14.1c10 2.8 19.6 6.5 29.7 8.8 9.2 2.1 18.6 3.5 27.9 4.4 16.9 1.7 34 1.9 50.9 1 8.6-.4 17.2-1 25.6-2.2 1.1-.2.7-1.7-.2-1.6zM10.5 1.7c-.8 4 4.2 7.6 8.2 9.9.5.3 1 .5 1.4.7-.4.2-.9.5-1.4.7-4 2.2-9 5.9-8.2 9.9-4.9-3.1-2.3-8 5.6-10.6C8.2 9.7 5.6 4.8 10.5 1.7zM5.7 13.9c-2.4.4-5.7-1.6-5.7-1.6s3.3-2 5.7-1.6a1.62 1.62 0 0 1 0 3.2zM494 1.7c.8 4-4.2 7.6-8.2 9.9-.5.3-1 .5-1.4.7.4.2.9.5 1.4.7 4 2.2 9 5.9 8.2 9.9 4.9-3.1 2.3-8-5.6-10.6 8-2.6 10.5-7.5 5.6-10.6zm4.8 12.2c2.4.5 5.7-1.6 5.7-1.6s-3.3-2-5.7-1.6a1.62 1.62 0 0 0 0 3.2z"/></svg>';
                                    break;
                                case 'separk':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 214.44 13.32"><path d="M0 2.4c9.5 2.78 19.37 4.14 29.2 4.1 4.92.1 9.83-.08 14.7-.7 2.44-.3 4.87-.7 7.32-1.1l7.36-1.07c9.83-1.3 19.72-2.36 29.7-2.28 1.25.02 2.5.03 3.74.12l1.87.1 1.87.18c1.25.1 2.5.35 3.73.52 1.23.3 2.48.5 3.7.93 1.22.33 2.43.93 3.54 1.5L110 6.48c1.1.6 2.18 1.24 3.23 2 .53.38 1.05.78 1.53 1.35.23.3.5.62.6 1.2a1.46 1.46 0 0 1-.15.89c-.14.28-.34.46-.52.6-.74.5-1.4.62-2.05.76-.65.1-1.28.2-1.95.23-.67.02-1.35.02-2.1-.22-.38-.14-.82-.36-1.12-.8-.3-.45-.36-1-.3-1.4.13-.84.5-1.43.85-2 .36-.56.77-1.07 1.2-1.56.85-.97 1.76-1.85 2.72-2.67 1-.88 2.24-1.5 3.43-1.95 1.2-.47 2.43-.78 3.66-1.08 2.46-.56 4.94-.9 7.42-1.16 9.94-.94 19.9-.67 29.8.1 4.95.4 9.9 1 14.8 1.78a152.49 152.49 0 0 1 7.33 1.38 83.27 83.27 0 0 0 7.24 1.29c4.83.7 9.78.77 14.64.1 4.87-.67 9.65-2.06 14.16-4.1-8.75 4.68-19 6.5-28.98 5.5-2.5-.26-4.95-.8-7.37-1.3a162.68 162.68 0 0 0-7.26-1.36c-4.87-.78-9.77-1.36-14.68-1.77-9.82-.78-19.74-1.04-29.53-.12-2.44.25-4.87.6-7.24 1.13-2.34.57-4.74 1.24-6.45 2.7-.9.8-1.8 1.63-2.57 2.52-.4.45-.76.9-1.07 1.4-.3.47-.57 1-.62 1.38-.02.2 0 .3.05.37.04.07.17.16.37.23.42.13 1 .16 1.56.14.57-.02 1.17-.1 1.74-.2.55-.1 1.14-.27 1.42-.48.13-.12.08-.07.1-.1 0-.05-.1-.25-.26-.43-.32-.38-.78-.75-1.26-1.1-.96-.7-2.02-1.3-3.1-1.9L106 6.04c-1.1-.54-2.12-1.05-3.3-1.38-1.12-.4-2.33-.6-3.5-.88-1.2-.17-2.4-.42-3.62-.5l-1.8-.2-1.84-.1c-1.22-.08-2.45-.1-3.68-.1-9.84-.08-19.7.96-29.48 2.26l-7.34 1.06-7.37 1.1c-4.95.62-9.95.86-14.93.74-4.97-.22-9.92-.82-14.8-1.73C9.47 5.37 4.65 4.1 0 2.4z"/></svg>';
                                    break;
                                case 'slash-line':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 10.96"><g fill="none" stroke="#000" stroke-miterlimit="10"><path d="M8.54 1.94L1.46 9.02m12.08-7.08L6.46 9.02"/><use xlink:href="#B"/><use xlink:href="#B" x="5"/><use xlink:href="#B" x="10"/><use xlink:href="#B" x="15"/><use xlink:href="#B" x="20"/><use xlink:href="#B" x="25"/><use xlink:href="#B" x="30"/><use xlink:href="#B" x="35"/><use xlink:href="#B" x="40"/><use xlink:href="#B" x="45"/><use xlink:href="#B" x="50"/><use xlink:href="#B" x="55"/><use xlink:href="#B" x="60"/><use xlink:href="#B" x="65"/><use xlink:href="#B" x="70"/><use xlink:href="#B" x="75"/><use xlink:href="#B" x="80"/><use xlink:href="#B" x="85"/><use xlink:href="#B" x="90"/><use xlink:href="#B" x="95"/><use xlink:href="#B" x="100"/><use xlink:href="#B" x="105"/><use xlink:href="#B" x="110"/><use xlink:href="#B" x="115"/><use xlink:href="#B" x="120"/><use xlink:href="#B" x="125"/><use xlink:href="#B" x="130"/><use xlink:href="#B" x="135"/><use xlink:href="#B" x="140"/><use xlink:href="#B" x="145"/><use xlink:href="#B" x="150"/><use xlink:href="#B" x="155"/><use xlink:href="#B" x="160"/><use xlink:href="#B" x="165"/><use xlink:href="#B" x="170"/><use xlink:href="#B" x="175"/><use xlink:href="#B" x="180"/><use xlink:href="#B" x="185"/><use xlink:href="#B" x="190"/><use xlink:href="#B" x="195"/><use xlink:href="#B" x="200"/><use xlink:href="#B" x="205"/><use xlink:href="#B" x="210"/><use xlink:href="#B" x="215"/><use xlink:href="#B" x="220"/><use xlink:href="#B" x="225"/><use xlink:href="#B" x="230"/><use xlink:href="#B" x="235"/><use xlink:href="#B" x="240"/><use xlink:href="#B" x="245"/><use xlink:href="#B" x="250"/><use xlink:href="#B" x="255"/><use xlink:href="#B" x="260"/><use xlink:href="#B" x="265"/><use xlink:href="#B" x="270"/><use xlink:href="#B" x="275"/><use xlink:href="#B" x="280"/><use xlink:href="#B" x="285"/><use xlink:href="#B" x="290"/><use xlink:href="#B" x="295"/><use xlink:href="#B" x="300"/><use xlink:href="#B" x="305"/><use xlink:href="#B" x="310"/><use xlink:href="#B" x="315"/><use xlink:href="#B" x="320"/><use xlink:href="#B" x="325"/><use xlink:href="#B" x="330"/><use xlink:href="#B" x="335"/><use xlink:href="#B" x="340"/><use xlink:href="#B" x="345"/><use xlink:href="#B" x="350"/><use xlink:href="#B" x="355"/><use xlink:href="#B" x="360"/><use xlink:href="#B" x="365"/><use xlink:href="#B" x="370"/><use xlink:href="#B" x="375"/><use xlink:href="#B" x="380"/></g><defs ><path id="B" d="M18.54 1.94l-7.08 7.08"/></defs></svg>';
                                    break;
                                case 'demaxa':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 211.6 27.87"><path d="M100.45 18a4.98 4.98 0 0 0 .79.56c1.1.68 1.77.1 1.74-.67-.01-.4-.2-.83-.5-1.27-.15-.22-.33-.43-.53-.64-.2-.2-.43-.38-.66-.56-.6-.45-1.24-.9-1.94-1.28l-2.1-1.12-2.2-1.04-2.26-.96c-3.07-1.18-6.32-1.94-9.44-2.34l-1.25-.16-2.5-.16c-1.98-.06-4.48.06-6.84.4l-2.44.47-1.9.5-2.88.95c-1.74.65-3.48 1.35-6.8 3l-6.5 3.45-6.5 3.32c-2.97 1.35-4.65 1.93-6.2 2.42a.77.77 0 0 0-.15.02c-.78.14-1.58.48-2.38.46a5.1 5.1 0 0 1-1.28-.21c-.42-.14-.63-.25-.82-.36-.2-.12-.4-.23-.72-.54-.32-.32-.44-.5-.55-.7a3.13 3.13 0 0 1-.34-.81c-.1-.43-.1-.64-.08-.85.03-.2.05-.43.2-.84.16-.4.28-.6.4-.78a1.78 1.78 0 0 1 .62-.62c.38-.22.6-.26.8-.3.2-.02.43-.04.85.05.4.1.58.24.73.37.14.13.3.27.43.66.1.4.03.6-.04.76-.1.17-.16.3-.45.5a1.17 1.17 0 0 1-.5.17c-.12.01-.24.01-.36-.04-.14.02-.3.04-.34.2s.1.37.35.47.57.1.8.06c.42-.08.8-.33 1.07-.7.15-.26.2-.46.22-.7s.02-.52-.1-.94a1.95 1.95 0 0 0-.63-.96 2.35 2.35 0 0 0-1-.5c-.55-.12-.83-.1-1.12-.1-.28.02-.6.05-1.1.34-.48.32-.66.56-.82.8-.15.24-.3.47-.52.98-.2.52-.24.8-.3 1.07a2.57 2.57 0 0 0 .06 1.14c.15.55.33.78.5 1s.35.43.73.82c.4.38.62.53.84.7.22.15.45.3.95.47l-3.46.64-7.15.68-2.93.02c-1.13-.03-2.48-.13-4.25-.4a29.81 29.81 0 0 1-4.13-.95c-1.06-.33-1.9-.66-2.7-1.02-.8-.35-1.6-.77-2.53-1.34A16.97 16.97 0 0 1 5.07 19a15.74 15.74 0 0 1-2.47-3.35c-.53-.96-.85-1.8-1.1-2.63-.26-.84-.43-1.7-.48-2.8a6.02 6.02 0 0 1 0-.85l.02-.47.06-.5c.07-.68.25-1.43.57-2.24C2.32 4.54 3.18 3.5 4 2.8a6.33 6.33 0 0 1 2.4-1.32 5.38 5.38 0 0 1 2.64-.1c1 .2 2.23.68 3.25 1.86.33.42.56.85.7 1.26.1.43.17.8.1 1.14-.1.68-.4 1.22-.74 1.6-.35.4-.75.68-1.18.84-.42.15-.88.2-1.23.02l-.2.02c-.05 0-.1.04-.15.05a.5.5 0 0 0-.14.12c-.04.05-.1.1-.14.16-.2.28-.5.8-.48 1.47.03.63.5 1.2 1.27 1.33.77.15 1.74-.13 2.53-.7s1.43-1.43 1.82-2.34.54-1.88.46-2.7c-.1-1.54-.9-2.88-2-3.8-.54-.48-1.17-.83-1.8-1.1C10.46.3 9.78.1 9.08.04c-.92-.1-1.7-.01-2.44.18a7.59 7.59 0 0 0-2.05.89 8.77 8.77 0 0 0-1.98 1.7c-.65.76-1.3 1.73-1.85 3.05C.4 6.75.2 7.58.12 8.32c-.07.36-.1.72-.1 1.05-.03.33-.02.64-.01.94a13.39 13.39 0 0 0 .44 3.06 14.11 14.11 0 0 0 1.1 2.88c.54 1.05 1.27 2.3 2.55 3.7a20.93 20.93 0 0 0 3.4 2.96c.98.67 1.8 1.17 2.65 1.6s1.72.85 2.84 1.24a25.79 25.79 0 0 0 4.37 1.11 34.92 34.92 0 0 0 4.46.44h3.05c1.87-.1 3.75-.18 7.45-.76l7.3-1.66c1.8-.53 3.6-1.12 6.95-2.77L53 18.45l6.34-3.7c3.23-1.7 4.93-2.38 6.63-3l2.8-.9 1.83-.47 2.36-.45c3.58-.52 5.4-.4 7.2-.34l2.92.3 1.86.3 2.34.53c1.52.38 2.66.82 3.64 1.15l2.45 1.04c.7.36 1.4.66 2.1 1.13s1.5.98 2.4 1.8l.9.74.84.75.83.65zm-1.48 8.08c.35-.9.32-1.56.2-2.3-.14-.74-.48-1.6-1.33-2.6-.58-.66-1.08-1.05-1.5-1.37l-1.1-.76-.52-.35-1.34-.78-.97-.5-2.96-1.4c-.37-.18-.76-.33-1.24-.5l-.82-.27-1.06-.26c-.8-.18-1.4-.25-1.92-.33l-1.33-.1c-.4-.04-.82-.03-1.32-.06l-1.93-.05H77.9l-1.32.02c-.8.03-1.63.05-3.24.32-1.6.3-2.38.54-3.15.78l-3.07 1-3.04 1.06-2.96 1.24-2.87 1.43-2.8 1.55-4.5 2.76-1.63 1.08c-1 .63-.13.08.73-.4l7.3-3.8 4.14-1.8 2.95-1.14 3-.98 3.05-.77 1.25-.25 1.84-.3 3.1-.28 1.27-.04 1.85.03 1.84.1 1.26.06 1.26.1 1.82.34 1 .25.78.24 1.2.42 2.82 1.25.9.47.7.4 1.06.67c.62.44 1.34.84 2.3 1.9.46.53.68 1 .77 1.36a2.67 2.67 0 0 1 .07.99c-.04.3-.12.58-.27.85-.15.28-.4.55-.8.7a1.73 1.73 0 0 1-.9.04c-.28-.06-.52-.14-.72-.24-.4-.2-.73-.45-1.03-.84l-.5-.36c-.16-.07-.3-.07-.43.08-.24.28-.15 1 .35 1.66a3.76 3.76 0 0 0 2.02 1.33c.65.18 1.4.18 2.1-.12s1.27-.87 1.6-1.53zm12.2-8.08a5.41 5.41 0 0 1-.78.56c-1.1.68-1.77.1-1.74-.67.01-.4.2-.83.5-1.27.15-.22.33-.43.53-.64.2-.2.43-.38.66-.56.6-.45 1.24-.9 1.94-1.28l2.1-1.12 2.2-1.04 2.26-.96c3.07-1.18 6.32-1.94 9.44-2.34l1.25-.16 2.5-.16c1.98-.06 4.48.06 6.84.4l2.44.47 1.9.5 2.88.95c1.74.65 3.48 1.35 6.8 3l6.5 3.45 6.5 3.32c2.97 1.35 4.65 1.93 6.2 2.42a.77.77 0 0 1 .15.02c.78.14 1.58.48 2.38.46a5.1 5.1 0 0 0 1.28-.21c.42-.14.63-.25.82-.36.2-.12.4-.23.72-.54.32-.32.44-.5.55-.7a3.13 3.13 0 0 0 .34-.81c.1-.43.1-.64.08-.85-.03-.2-.05-.43-.2-.84-.16-.4-.28-.6-.4-.78a1.78 1.78 0 0 0-.62-.62c-.38-.22-.6-.26-.8-.3-.2-.02-.43-.04-.85.05-.4.1-.58.24-.73.37-.14.13-.3.27-.43.66-.1.4-.03.6.04.76.1.17.16.3.45.5a1.17 1.17 0 0 0 .5.17c.12.01.24.01.36-.04.14.02.3.04.34.2s-.1.37-.35.47-.57.1-.8.06c-.42-.08-.8-.33-1.07-.7-.14-.26-.2-.46-.2-.7s-.02-.52.1-.94a1.95 1.95 0 0 1 .63-.96 2.35 2.35 0 0 1 1-.5c.55-.12.83-.1 1.12-.1.28.02.6.05 1.1.34.48.32.66.56.82.8.15.24.3.47.52.98.2.52.24.8.3 1.07a2.57 2.57 0 0 1-.06 1.14c-.15.55-.33.78-.5 1s-.35.43-.73.82c-.4.38-.62.53-.84.7-.22.15-.45.3-.95.47l3.46.64 7.15.68 2.93.02c1.13-.03 2.48-.13 4.25-.4a29.81 29.81 0 0 0 4.13-.95c1.06-.33 1.9-.66 2.7-1.02.8-.35 1.6-.77 2.53-1.34a16.92 16.92 0 0 0 3.24-2.6 15.74 15.74 0 0 0 2.47-3.35c.53-.96.85-1.8 1.1-2.63.26-.84.43-1.7.48-2.8.02-.27.02-.56 0-.86l-.02-.47-.06-.5c-.07-.68-.25-1.43-.57-2.24-.65-1.62-1.52-2.66-2.33-3.35a6.33 6.33 0 0 0-2.4-1.32 5.38 5.38 0 0 0-2.64-.1c-1 .2-2.23.68-3.25 1.86a4.04 4.04 0 0 0-.7 1.27c-.1.43-.17.8-.1 1.14.1.68.4 1.22.74 1.6.35.4.75.68 1.18.84.42.15.88.2 1.23.02l.18.02c.05 0 .1.04.15.05a.5.5 0 0 1 .14.12c.04.05.1.1.14.16.2.28.5.8.48 1.47-.03.63-.5 1.2-1.27 1.33-.77.15-1.74-.13-2.53-.7s-1.43-1.43-1.82-2.34-.54-1.88-.46-2.7c.13-1.54.93-2.88 2.02-3.82.54-.48 1.17-.83 1.8-1.1.65-.28 1.33-.46 2.03-.54.92-.1 1.7-.01 2.44.18.73.2 1.4.48 2.04.9a8.77 8.77 0 0 1 1.98 1.7c.65.76 1.32 1.73 1.85 3.05.35.9.56 1.72.65 2.46.07.37.1.72.1 1.05.03.33.02.65.01.94a13.39 13.39 0 0 1-.44 3.06 14.11 14.11 0 0 1-1.1 2.88c-.54 1.05-1.27 2.3-2.55 3.7a20.93 20.93 0 0 1-3.4 2.96c-.98.67-1.8 1.17-2.65 1.6s-1.72.85-2.84 1.24a25.79 25.79 0 0 1-4.37 1.11 34.92 34.92 0 0 1-4.46.44c-1.17.05-2.1.03-3.05-.01-1.87-.1-3.75-.18-7.45-.76L172 24.9c-1.8-.53-3.6-1.12-6.95-2.77l-6.44-3.66-6.34-3.7c-3.23-1.7-4.93-2.38-6.63-3l-2.8-.9-1.83-.47-2.36-.45c-3.58-.52-5.4-.4-7.2-.34l-2.92.3-1.86.3-2.34.53c-1.52.38-2.66.82-3.64 1.15l-2.45 1.04c-.7.36-1.4.66-2.1 1.13s-1.5.98-2.4 1.8l-.9.74-.84.75-.85.65zm1.5 8.08c-.35-.9-.32-1.56-.2-2.3.14-.74.48-1.6 1.33-2.6.58-.66 1.08-1.05 1.5-1.37l1.1-.76.52-.35.6-.35.74-.43.97-.5 2.96-1.4c.37-.18.76-.33 1.24-.5l.82-.27 1.06-.26c.8-.18 1.4-.25 1.92-.33l1.33-.1c.4-.04.82-.03 1.32-.06l1.93-.05h1.93l1.32.02c.8.03 1.63.05 3.24.32 1.6.3 2.38.54 3.15.78l3.07 1 3.04 1.06 2.96 1.24 2.87 1.43 2.8 1.55 4.5 2.76 1.63 1.08c1 .63.13.08-.73-.4l-7.3-3.8-4.14-1.8-2.95-1.14-3-.98-3.05-.77-1.25-.25-1.84-.3-3.1-.28-1.27-.04-1.85.03-3.1.15-1.26.1-1.82.34-1 .25-.78.24-1.2.42-2.82 1.25-.9.47-.7.4-1.06.67c-.62.44-1.34.84-2.3 1.9-.46.53-.68 1-.77 1.36a2.67 2.67 0 0 0-.07.99c.04.3.12.58.27.85.15.28.4.55.8.7a1.73 1.73 0 0 0 .9.04c.28-.06.52-.14.72-.24.4-.2.73-.45 1.03-.84l.5-.36c.16-.07.3-.07.43.08.24.28.15 1-.35 1.66a3.76 3.76 0 0 1-2.02 1.33c-.65.18-1.4.18-2.1-.12-.72-.3-1.28-.87-1.6-1.53z"/></svg>';
                                    break;
                                case 'fill-circle':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 13.48"><ellipse cx="213.6" cy="6.74" rx="4.33" ry="4.32"/><ellipse cx="226.58" cy="6.74" rx="4.13" ry="4.12"/><ellipse cx="239.16" cy="6.74" rx="3.94" ry="3.93"/><circle cx="251.36" cy="6.74" r="3.74"/><ellipse cx="263.18" cy="6.74" rx="3.55" ry="3.54"/><ellipse cx="274.6" cy="6.74" rx="3.36" ry="3.35"/><circle cx="285.64" cy="6.74" r="3.16"/><ellipse cx="296.29" cy="6.74" rx="2.97" ry="2.96"/><ellipse cx="306.53" cy="6.74" rx="2.78" ry="2.77"/><circle cx="316.41" cy="6.74" r="2.58"/><ellipse cx="325.9" cy="6.74" rx="2.39" ry="2.38"/><circle cx="335" cy="6.74" r="2.19"/><circle cx="343.71" cy="6.74" r="2"/><ellipse cx="352.04" cy="6.74" rx="1.81" ry="1.8"/><circle cx="359.98" cy="6.74" r="1.61"/><circle cx="367.53" cy="6.74" r="1.42"/><ellipse cx="374.7" cy="6.74" rx="1.23" ry="1.22"/><circle cx="381.48" cy="6.74" r="1.03"/><circle cx="387.87" cy="6.74" r=".84"/><circle cx="393.87" cy="6.74" r=".65"/><circle cx="399.49" cy="6.74" r=".45"/><ellipse cx="199.76" cy="6.74" rx="4.52" ry="4.51"/><ellipse cx="186.4" cy="6.74" rx="4.33" ry="4.32"/><ellipse cx="173.42" cy="6.74" rx="4.13" ry="4.12"/><ellipse cx="160.84" cy="6.74" rx="3.94" ry="3.93"/><circle cx="148.64" cy="6.74" r="3.74"/><ellipse cx="136.82" cy="6.74" rx="3.55" ry="3.54"/><ellipse cx="125.4" cy="6.74" rx="3.36" ry="3.35"/><circle cx="114.36" cy="6.74" r="3.16"/><ellipse cx="103.71" cy="6.74" rx="2.97" ry="2.96"/><ellipse cx="93.47" cy="6.74" rx="2.78" ry="2.77"/><circle cx="83.59" cy="6.74" r="2.58"/><ellipse cx="74.1" cy="6.74" rx="2.39" ry="2.38"/><circle cx="65" cy="6.74" r="2.19"/><circle cx="56.29" cy="6.74" r="2"/><ellipse cx="47.96" cy="6.74" rx="1.81" ry="1.8"/><circle cx="40.02" cy="6.74" r="1.61"/><circle cx="32.47" cy="6.74" r="1.42"/><ellipse cx="25.3" cy="6.74" rx="1.23" ry="1.22"/><circle cx="18.52" cy="6.74" r="1.03"/><circle cx="12.13" cy="6.74" r=".84"/><circle cx="6.13" cy="6.74" r=".65"/><circle cx=".51" cy="6.74" r=".45"/></svg>';
                                    break;
                                case 'finalio':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 204.45 23.85"><path d="M95.1 1.6L92.47.9c-1-.25-2.25-.46-3.9-.64L84.6.01c-1.04.02-1.88-.03-2.7.01L79.2.2l-1.73.2-2.17.4c-3.25.7-4.8 1.3-6.36 1.84L62.8 5.02l-6.07 2.46-3.1 1.28c-.25.07-.53.16-.95.32l-1.5.74-.44.2-5.94 2.6-2.44.98-3.64 1.22c-3.1.9-4.7 1.15-6.3 1.4l-2.6.3c-1 .1-2.2.16-3.8.18l-3.37-.17.23-.13c.5-.32.68-.6.85-.84.15-.26.3-.54.38-1.13.05-.58-.02-.87-.07-1.15-.07-.28-.14-.56-.4-1.05a3.98 3.98 0 0 0-.7-.9c-.2-.2-.4-.4-.92-.66a2.59 2.59 0 0 0-1.1-.3c-.3 0-.58-.02-1.15.12-.57.18-.8.4-1.02.57-.2.2-.44.4-.65.97-.2.58-.12.92-.04 1.2a1.66 1.66 0 0 0 .77.99c.54.3.86.33 1.17.36.16.01.32 0 .53-.06.2-.06.46-.16.7-.44.32-.38.4-.8.28-1.18-.04-.1-.1-.18-.16-.26s-.2-.17-.3-.2c-.23-.06-.42-.03-.63.08-.2.14-.26.44-.18.56.07.12.15.1.22.02a.25.25 0 0 1 .37-.03c-.03.02 0 .1-.05.22-.1.2-.27.38-.52.43-.15.06-.28.1-.44.1s-.37-.02-.63-.18c-.34-.23-.4-.42-.47-.6-.05-.2-.1-.4.03-.82.16-.4.35-.55.52-.68.18-.1.36-.24.73-.35.4-.1.62-.1.83-.1.22.02.45.04.85.24.4.22.56.4.7.57.14.18.27.35.5.73l.38.8c.07.2.15.43.1.87-.06.43-.2.62-.3.78-.14.16-.26.32-.62.54-.36.2-.6.26-.8.3-.22.04-.44.08-.9.05-.8-.08-.9-.13-1.53-.3-.22-.03-.44-.06-.63-.03-.13.02-.2.07-.2.13-1.23-.27-2.67-.65-4.87-1.47-2.58-1-3.97-1.75-5.2-2.45-.62-.33-1.17-.7-1.78-1.15l-.95-.76c-.32-.3-.7-.6-1.05-1C3.5 8 2.6 7 1.7 6.4.72 5.78.05 6.33 0 7.07c-.05.75.54 1.67 1.34 2.32.5.45 1.07.84 1.66 1.22.58.4 1.2.73 1.8 1.1l3.8 2.06c2.63 1.27 5.42 2.22 8.12 2.9a16.43 16.43 0 0 0 1.08.26l2.18.42c1.73.3 3.94.53 6.05.5l3.92-.2c1.03-.07 1.84-.22 2.66-.32l2.64-.46 3.8-.9 3.75-1.1 2.53-.85 6.13-2.32 5.26-2.15c.22.07.47.16.82.4.46.32.62.57.78.8.14.24.3.5.42 1.03.1.55.01.82-.06 1.06-.1.24-.2.5-.6.9-.42.4-.67.57-.9.74-.25.15-.5.33-1.08.43-.57.08-.86-.01-1.1-.1a2.04 2.04 0 0 1-.88-.63c-.34-.43-.38-.7-.4-.95a1.06 1.06 0 0 1 .04-.39c.04-.14.13-.32.3-.5.38-.36.7-.37.9-.36.1.02.22.04.33.1.1.06.24.16.3.3.07.17.01.25-.1.37-.1.1-.26.2-.47.3-.18.15-.3.3-.17.43.12.13.4.15.7.06.3-.08.67-.33.8-.68a1.06 1.06 0 0 0-.09-.95 1.47 1.47 0 0 0-.68-.58c-.37-.13-.66-.1-.96-.04-.3.1-.65.2-1.05.6-.52.55-.55 1.04-.53 1.4.04.37.1.78.57 1.34.5.54.83.7 1.16.87.35.14.72.27 1.46.17.72-.13 1.03-.33 1.33-.5.3-.2.6-.38 1.1-.86a3.63 3.63 0 0 0 .82-1.2c.13-.35.26-.75.13-1.48-.15-.73-.4-1.03-.6-1.32-.23-.28-.46-.57-1.05-.97l-.25-.15 5.82-2.33 1.78-.68c1.26-.23 2.56-.36 3.8-.25a12.36 12.36 0 0 1 1.5.22 15.01 15.01 0 0 1 2.66.81c1.4.58 2.02 1.02 2.64 1.44.6.44 1.22.9 2.2 2.03.94 1.17 1.22 1.86 1.47 2.52.12.33.2.67.25 1.1a5.57 5.57 0 0 1-.04 1.66c-.26 1.4-.68 2.04-1.05 2.65a9.83 9.83 0 0 1-.7.93 8 8 0 0 1-1.27 1.16c-1.2.84-1.88 1.12-2.56 1.4-.7.25-1.42.52-2.9.46-1.48-.12-2.18-.43-2.75-.78a3.22 3.22 0 0 1-.8-.7c-.24-.32-.52-.75-.68-1.4a3.96 3.96 0 0 1-.05-1.59 4.61 4.61 0 0 1 .34-1.03c.15-.3.35-.6.64-.9a4.74 4.74 0 0 1 1.32-.99 4.3 4.3 0 0 1 1.59-.47c.42-.04.76.01 1.08.08.3.08.6.2.9.38.28.2.54.45.65.93.07.34.02.66-.07.88a1.28 1.28 0 0 1-.33.5 1.5 1.5 0 0 1-1.04.4c-.4.14-.8.15-.76.55.04.37.7.8 1.58.67.42-.05.87-.23 1.24-.52a2.86 2.86 0 0 0 .8-1.04 2.95 2.95 0 0 0 .1-2.13c-.22-.72-.76-1.33-1.37-1.7-.84-.43-1.48-.47-2.2-.46-.73.04-1.58.16-2.77.74A5.63 5.63 0 0 0 67.05 15a5.6 5.6 0 0 0-.84 1.2c-.2.4-.36.85-.46 1.4-.1.56-.13 1.25.08 2.14.22.88.58 1.5.93 1.96a5.14 5.14 0 0 0 1.11 1.05c.78.5 1.63.93 3.4 1.07 1.77.06 2.63-.24 3.45-.5l1.3-.56a11.98 11.98 0 0 0 1.75-1.07 10.79 10.79 0 0 0 1.54-1.37 9.95 9.95 0 0 0 .9-1.1c.5-.72 1.04-1.48 1.38-3.26.15-.9.1-1.6 0-2.16a6.13 6.13 0 0 0-.42-1.42c-.37-.82-.78-1.6-1.85-2.93-1.1-1.3-1.77-1.84-2.43-2.38-.67-.5-1.36-1.05-2.94-1.7-1.6-.62-2.44-.77-3.28-.93l-.46-.07c1.34-.47 2.84-1 5.57-1.6l2.1-.4 1.66-.24c1-.16 1.8-.18 2.58-.26 1.6-.07 3.2-.2 6.34.08 1.57.17 2.74.36 3.7.6.97.18 1.72.44 2.47.66l.57.17.54.2 1.15.57a8.86 8.86 0 0 1 1.27.88c.43.36.9.82 1.22 1.4s.43 1.1.38 1.55c-.05.46-.2.85-.43 1.16-.46.64-1.1 1.08-1.7 1.4-.62.32-1.28.55-2.08.6-.4.01-.83-.02-1.27-.18-.4-.14-.86-.43-1.2-.9-.47-.63-.55-1.26-.45-1.7.05-.24.13-.37.26-.53.12-.15.3-.27.46-.36a1.76 1.76 0 0 1 1.07-.22 1.03 1.03 0 0 1 .77.42l.73.76c0 .01 0 .02-.01.03-.02.07-.02.14.08.23.07.05.2.08.34.01.15-.06.28-.22.36-.43s.12-.46.04-.76a.96.96 0 0 0-.27-.44c-.08-.08-.2-.13-.3-.17-.23-.4-.6-.75-1.1-.93a3.09 3.09 0 0 0-1.65-.15c-.55.1-1.07.32-1.5.67a2.84 2.84 0 0 0-.92 1.3c-.25.7-.23 1.46-.03 2.13.2.68.57 1.28 1.05 1.8a4.38 4.38 0 0 0 1.77 1.13 5.04 5.04 0 0 0 2.03.24c.88-.1 1.58-.35 2.2-.66s1.17-.7 1.7-1.17c.52-.5 1.1-1.1 1.47-2.1.35-.96.33-2.35-.4-3.56-.48-.82-1.05-1.38-1.58-1.83-.53-.44-1.03-.8-1.5-1.05-.93-.52-1.78-.85-2.57-1.06zm14.26 0l2.62-.7c1-.25 2.25-.46 3.9-.64l3.95-.24 2.7.01 2.7.17 1.73.22 2.17.4c3.25.7 4.8 1.3 6.36 1.84l6.14 2.36 6.07 2.46 3.1 1.28c.25.07.53.16.95.32l1.5.74.44.2 5.94 2.6 2.44.98 3.64 1.22c3.1.9 4.7 1.15 6.3 1.4l2.6.3c1 .1 2.2.16 3.8.18l3.37-.17c-.08-.04-.16-.08-.23-.13-.5-.32-.68-.6-.85-.84-.15-.26-.3-.54-.38-1.13-.05-.58.02-.87.07-1.15.07-.28.14-.56.4-1.05a3.93 3.93 0 0 1 .7-.9c.2-.2.4-.4.92-.66a2.59 2.59 0 0 1 1.1-.3c.3 0 .58-.02 1.15.12.57.18.8.4 1.02.57.2.2.44.4.65.97.2.58.12.92.04 1.2a1.66 1.66 0 0 1-.77.99c-.54.3-.86.33-1.17.36-.16.01-.32 0-.53-.06-.2-.06-.46-.16-.7-.44-.32-.38-.4-.8-.28-1.18.04-.1.1-.18.16-.26s.2-.17.3-.2c.23-.06.42-.03.63.08.2.14.26.44.18.56-.07.12-.15.1-.22.02a.25.25 0 0 0-.37-.03c.03.02 0 .1.05.22.1.2.27.38.52.43.15.06.28.1.44.1s.37-.02.63-.18c.34-.23.4-.42.47-.6.05-.2.1-.4-.03-.82-.16-.4-.35-.55-.52-.68-.18-.1-.36-.24-.73-.35-.4-.1-.62-.1-.83-.1-.22.02-.45.04-.85.24-.4.22-.56.4-.7.57-.14.18-.27.35-.5.73l-.38.8c-.07.2-.15.43-.1.87.06.43.2.62.3.78.14.16.26.32.62.54.36.2.6.26.8.3a3.1 3.1 0 0 0 .89.05c.8-.08.9-.13 1.53-.3.22-.03.44-.06.63-.03.13.02.2.07.2.13 1.23-.27 2.67-.65 4.87-1.47 2.58-1 3.97-1.75 5.2-2.45.62-.33 1.17-.7 1.78-1.15l.95-.76c.32-.3.7-.6 1.05-1 1.02-.97 1.93-1.98 2.85-2.58.98-.62 1.64-.07 1.7.67.05.75-.54 1.67-1.34 2.32-.5.45-1.07.84-1.66 1.22-.57.4-1.2.73-1.8 1.1l-3.8 2.06c-2.63 1.27-5.42 2.22-8.12 2.9a16.43 16.43 0 0 1-1.08.26l-2.18.42c-1.73.3-3.94.53-6.05.5l-3.92-.2c-1.03-.07-1.84-.22-2.66-.32l-2.64-.46-3.8-.9-3.75-1.1-2.53-.85-6.13-2.32-5.26-2.15c-.22.07-.47.16-.82.4-.46.32-.62.57-.78.8-.14.24-.3.5-.42 1.03-.1.55-.01.82.06 1.06.1.24.2.5.6.9.42.4.67.57.9.74.25.15.5.33 1.08.43.57.08.86-.01 1.1-.1a2.04 2.04 0 0 0 .88-.63c.34-.43.38-.7.4-.95a1.06 1.06 0 0 0-.04-.39c-.04-.14-.13-.32-.3-.5-.38-.36-.7-.37-.9-.36-.1.02-.22.04-.33.1-.1.06-.24.16-.3.3-.07.17-.01.25.1.37.1.1.26.2.47.3.18.15.3.3.17.43-.12.13-.4.15-.7.06-.3-.08-.67-.33-.8-.68a1.06 1.06 0 0 1 .09-.95 1.47 1.47 0 0 1 .68-.58c.37-.13.66-.1.96-.04.3.1.65.2 1.05.6.52.55.55 1.04.53 1.4-.04.37-.1.78-.57 1.34-.5.54-.83.7-1.16.87-.35.14-.72.27-1.46.17-.72-.13-1.03-.33-1.33-.5-.3-.2-.6-.38-1.1-.86a3.63 3.63 0 0 1-.82-1.2c-.13-.35-.26-.75-.13-1.48.15-.73.4-1.03.6-1.32.23-.28.46-.57 1.05-.97l.25-.15-5.82-2.33-1.78-.68c-1.26-.23-2.56-.36-3.8-.25a12.36 12.36 0 0 0-1.5.22 15.01 15.01 0 0 0-2.66.81c-1.4.58-2.02 1.02-2.64 1.44-.6.44-1.22.9-2.2 2.03-.94 1.17-1.22 1.86-1.47 2.52-.12.33-.2.67-.25 1.1a5.57 5.57 0 0 0 .04 1.66c.26 1.4.68 2.04 1.05 2.65.2.3.4.6.7.93a8 8 0 0 0 1.27 1.16c1.2.84 1.88 1.12 2.56 1.4.7.25 1.42.52 2.9.46 1.48-.12 2.18-.43 2.75-.78a3.22 3.22 0 0 0 .8-.7c.24-.32.52-.75.68-1.4a3.96 3.96 0 0 0 .05-1.59 4.61 4.61 0 0 0-.34-1.03c-.15-.3-.35-.6-.64-.9a4.74 4.74 0 0 0-1.32-.99 4.3 4.3 0 0 0-1.59-.47c-.42-.04-.76.01-1.08.08-.3.08-.6.2-.9.38-.28.2-.54.45-.65.93-.07.34-.02.66.07.88a1.28 1.28 0 0 0 .33.5 1.5 1.5 0 0 0 1.04.4c.4.14.8.15.76.55-.04.37-.7.8-1.58.67-.42-.05-.87-.23-1.24-.52a2.86 2.86 0 0 1-.8-1.04 2.95 2.95 0 0 1-.1-2.13c.22-.72.76-1.33 1.37-1.7.84-.43 1.48-.47 2.2-.46.73.04 1.58.16 2.77.74a5.63 5.63 0 0 1 1.68 1.27 5.6 5.6 0 0 1 .84 1.2c.2.4.36.85.46 1.4.1.56.13 1.25-.08 2.14-.22.88-.58 1.5-.93 1.96a5.14 5.14 0 0 1-1.11 1.05c-.78.5-1.63.93-3.4 1.07-1.77.06-2.63-.24-3.45-.5l-1.3-.56a11.98 11.98 0 0 1-1.75-1.07 10.79 10.79 0 0 1-1.54-1.37 9.95 9.95 0 0 1-.9-1.1c-.5-.72-1.04-1.48-1.38-3.26-.15-.9-.1-1.6 0-2.16a6.13 6.13 0 0 1 .42-1.42c.37-.82.78-1.6 1.85-2.93 1.1-1.3 1.77-1.84 2.43-2.38.67-.5 1.36-1.05 2.94-1.7 1.6-.62 2.44-.77 3.28-.93l.46-.07c-1.34-.47-2.84-1-5.57-1.6l-2.1-.4-1.66-.24c-1-.16-1.8-.18-2.58-.26-1.6-.07-3.2-.2-6.34.08-1.57.17-2.74.36-3.7.6-.97.18-1.72.44-2.47.66l-.57.17-.54.2-1.15.57a8.86 8.86 0 0 0-1.27.88c-.43.36-.9.82-1.22 1.4s-.43 1.1-.38 1.55c.05.46.2.85.43 1.16.46.64 1.1 1.08 1.7 1.4.62.32 1.28.55 2.08.6.4.01.83-.02 1.27-.18.4-.14.86-.43 1.2-.9.47-.63.55-1.26.45-1.7-.05-.24-.13-.37-.26-.53-.12-.15-.3-.27-.46-.36a1.76 1.76 0 0 0-1.07-.22 1.03 1.03 0 0 0-.77.42l-.73.76c0 .01 0 .02.01.03.02.07.02.14-.08.23-.07.05-.2.08-.34.01-.15-.06-.28-.22-.36-.43s-.12-.46-.04-.76a.96.96 0 0 1 .27-.44c.08-.08.2-.13.3-.17.23-.4.6-.75 1.1-.93a3.09 3.09 0 0 1 1.65-.15c.55.1 1.07.32 1.5.67a2.84 2.84 0 0 1 .92 1.3c.25.7.23 1.46.03 2.13-.2.68-.57 1.28-1.05 1.8a4.38 4.38 0 0 1-1.77 1.13 5.04 5.04 0 0 1-2.03.24c-.88-.1-1.58-.35-2.2-.66s-1.17-.7-1.7-1.17c-.52-.5-1.1-1.1-1.47-2.1-.35-.96-.33-2.35.4-3.56.48-.82 1.05-1.38 1.58-1.83.53-.44 1.03-.8 1.5-1.05a11.08 11.08 0 0 1 2.55-1.03z"/></svg>';
                                    break;
                                case 'jemik':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216.73 8.38"><path d="M202.56 7.67a51.74 51.74 0 0 0-6.79-3.48c2.34-1 4.62-2.15 6.8-3.48a.39.39 0 0 0 .13-.53.39.39 0 0 0-.53-.13c-2.36 1.44-4.84 2.68-7.4 3.72-5.3-2.1-10.92-3.35-16.62-3.63-7.85-.4-15.76 1.05-22.56 2.42l-3.32.68-2.66.55c-7.54-1.54-15.3-2.92-23.07-2.56-4.57.22-8.88 1.08-12.74 2.54-1.85-.72-3.6-1.57-5.2-2.56-.12-.08-.28-.08-.4 0-1.6 1-3.36 1.84-5.2 2.56-3.86-1.45-8.18-2.32-12.74-2.54-7.8-.36-15.55 1.03-23.1 2.57l-2.66-.55-3.32-.68C54.36 1.2 46.44-.24 38.6.15c-5.7.28-11.33 1.52-16.62 3.63-2.56-1.04-5.04-2.28-7.4-3.72-.18-.1-.42-.06-.53.12a.39.39 0 0 0 .13.53 51.74 51.74 0 0 0 6.79 3.48c-2.34 1-4.62 2.15-6.8 3.48a.39.39 0 0 0-.13.53c.07.12.2.18.33.18a.36.36 0 0 0 .2-.06c2.36-1.44 4.84-2.68 7.4-3.72 5.3 2.1 10.92 3.35 16.62 3.64a59.46 59.46 0 0 0 2.67.06c6.96 0 13.86-1.27 19.9-2.5l3.32-.68 2.66-.55C74.68 6.1 82.44 7.5 90.2 7.13c4.57-.22 8.88-1.08 12.74-2.54a30.28 30.28 0 0 1 5.2 2.56.36.36 0 0 0 .2.06.36.36 0 0 0 .2-.06c1.6-1 3.36-1.84 5.2-2.56 3.86 1.45 8.18 2.32 12.74 2.54.86.04 1.72.06 2.58.06 6.9 0 13.78-1.25 20.5-2.62l2.66.55 3.32.68c6.03 1.22 12.94 2.5 19.9 2.5a59.46 59.46 0 0 0 2.67-.06c5.7-.28 11.33-1.52 16.62-3.63 2.56 1.04 5.04 2.28 7.4 3.72a.36.36 0 0 0 .2.06.4.4 0 0 0 .33-.18c.12-.2.06-.43-.12-.54zM64.33 4.38L61 5.06c-6.76 1.37-14.6 2.8-22.37 2.4a51.06 51.06 0 0 1-15.61-3.28c5-1.9 10.27-3 15.6-3.28C46.4.53 54.25 1.95 61 3.32l3.32.68.9.2-.9.2zm25.85 2c-7.08.34-14.16-.8-21.1-2.18 6.93-1.38 14-2.5 21.1-2.18 4.15.2 8.1.94 11.66 2.18-3.58 1.24-7.5 1.98-11.66 2.18zm18.2.01c-1.37-.83-2.84-1.55-4.37-2.2A31.28 31.28 0 0 0 108.37 2a34.99 34.99 0 0 0 4.37 2.2c-1.54.64-3 1.36-4.37 2.2zm18.2-.01c-4.15-.2-8.1-.94-11.66-2.18 3.57-1.24 7.5-1.98 11.66-2.18 7.08-.33 14.16.8 21.08 2.18-6.92 1.38-14 2.52-21.08 2.18zm51.54 1.1c-7.76.38-15.6-1.04-22.37-2.4l-3.32-.68-.9-.2.9-.2 3.32-.68c6.76-1.37 14.6-2.8 22.37-2.4a51.12 51.12 0 0 1 15.61 3.28c-5 1.9-10.27 3-15.6 3.28zm38.6-3.55c-.1-.75-.88-1.45-2-1.83-1.47-.5-3.32-.4-4.95-.14-2.88.48-5.45 1.47-8.1 2.28l4.88 1.35c1.4.4 2.83.78 4.36.92s3.22 0 4.4-.58c.98-.5 1.53-1.26 1.4-2zM10.18 2.7c-1.4-.4-2.83-.78-4.36-.92s-3.22 0-4.4.58c-1 .5-1.53 1.26-1.42 2 .1.74.88 1.45 2 1.82 1.47.5 3.32.4 4.95.14 2.88-.48 5.45-1.47 8.1-2.28L10.18 2.7z"/></svg>';
                                    break;
                                case 'leaf-line':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216.8 26.78"><path d="M215.18 12.67c-1.66-1.44-3.76-2.43-5.94-2.72a11.63 11.63 0 0 0 4.07-2.8c1.37-1.47 3.1-4.3 1.54-6.23-1.55-1.9-4.4-.44-5.9.75-2.4 1.9-3.74 4.73-3.9 7.76 0 .02.01.04.01.06a110.8 110.8 0 0 1-12.03 4.36c1.3-1.34 2.48-2.82 3.06-4.6.45-1.38.78-4.1-1.37-4.1-2.04 0-4.03 2.3-4.85 3.94-.92 1.84-1.1 3.84-.4 5.74a105.14 105.14 0 0 1-24.08 3.38c3.26-1.8 6.8-4.68 3.62-6.44-1.78-.98-4.16.43-5.57 1.5-1.7 1.27-2.9 2.98-3.6 4.95a89.68 89.68 0 0 1-4.01-.2c-4.13-.3-8.2-.9-12.24-1.67.05-.32-.4-.48-.58-.2-.02.03-.02.05-.04.08-3.4-.66-6.77-1.43-10.15-2.22 1.86-.8 3.54-2 4.8-3.6.67-.85 1.93-2.55.73-3.52-1.25-1-3.86.58-4.97 1.23-2.02 1.18-3.8 2.84-4.96 4.88-7.07-1.65-14.17-3.2-21.44-3.8a89 89 0 0 0-4.86-.27 1.64 1.64 0 0 0-.03-.11c.02-.01.03-.01.05-.02 1.62-1.36 2.9-3.97 1.94-6.05-.66-1.42-2.4-2.54-3.98-2-3.06 1.03-1.94 6.16.35 8.13-6.66-.12-13.2.4-19.72 1.3-.12-.1-.25-.2-.37-.32-.63-2.1-2.02-3.86-4-4.85-1.32-.67-3.73-1.32-4.86.1-2 2.53 3.05 4.52 6.53 5.44-6.17.93-12.35 2.17-18.6 3.48l-6.77 1.33c-.1-.1-.2-.16-.3-.25 0-.05 0-.1-.02-.16-.7-2.15-2.44-4-4.35-5.17-1.55-.94-4.28-1.9-5.4.2-.97 1.84 1.16 3.6 2.54 4.47 1.35.87 2.86 1.34 4.42 1.44-7.47 1.2-15.02 1.85-22.4 1.13-.07-.1-.15-.18-.23-.28.06-2.32-.37-4.9-1.88-6.7-1.04-1.23-3.3-2.63-4.88-1.54-1.7 1.18-.8 3.92.08 5.32.7 1.14 1.7 2.05 2.87 2.64-4.4-.75-8.7-2.04-12.9-4.05-.6-2.38-1.36-4.85-3.18-6.63C5.87 4.6 3.48 3.2 1.9 4.44c-1.68 1.3.24 3.94 1.17 5.1a11.34 11.34 0 0 0 3.16 2.75c-1.58.43-3.1 1.2-4.34 2.18-1.53 1.2-2.7 3.57-1.15 5.27 1.28 1.4 3.45.88 4.7-.3 1.6-1.5 2.7-3.93 3.37-6.1.06.02.12.04.18.05a.43.43 0 0 0 .16 0c7.58 4.18 15.83 5.78 24.2 5.9-.84.44-1.64.96-2.4 1.55-1.3 1.04-3.16 3.04-2.18 4.88 1 1.86 3.3.88 4.52-.12 1.97-1.62 3.35-3.88 3.95-6.36 5.2-.2 10.43-.86 15.55-1.77l8.34-1.56c-.73.56-1.4 1.2-2 1.9-.82 1-2.95 4.23-1.28 5.35 1.57 1.04 4.3-.92 5.38-1.96 1.57-1.5 2.5-3.55 2.64-5.7.06-.06.13-.12.2-.18.13-.12.13-.26.08-.38 8.36-1.58 16.64-3.03 25.08-3.62-.65.4-1.27.85-1.88 1.34-1.63 1.3-4.22 4.04-3.16 6.45.94 2.13 4 .47 5.23-.46 2.4-1.82 3.73-4.74 4.6-7.56 3.62-.1 7.27-.03 10.97.28.13.01.26.03.4.04.74 1.96 2.08 3.66 3.75 4.92 1.15.87 3.7 2.6 5.26 1.84 1.6-.77.97-2.98.3-4.15-.32-.57-.72-1.08-1.17-1.54 9 1.5 17.83 3.95 26.77 5.73-.1 1.4.37 2.85 1.2 4 .97 1.34 3.26 3.52 5.12 3.07 1.78-.43 1.2-2.77.7-3.96-.32-.78-.77-1.5-1.32-2.1 3.73.6 7.5 1.02 11.3 1.16 5.8.2 11.58-.1 17.3-.86.72 1.8 2.33 3.03 4.1 3.84 1.38.63 4.2 2 5.66 1 1.4-.96.92-2.88-.13-3.88-.94-.9-2.37-1.53-3.84-1.92a107.5 107.5 0 0 0 23.24-7.27c.15 1.83 1.36 3.47 2.92 4.53 1.64 1.12 5.1 2.94 7.1 1.72 2.05-1.25.86-3.73-.5-4.92zM6.2 16.76c-.37.65-.77 1.3-1.3 1.84-.76.75-2.28 1.46-3.2.48-.9-.95-.2-2.43.54-3.2.56-.58 1.25-1.03 1.94-1.43.8-.47 1.64-.8 2.5-1.1-1.27 1.1-2.32 2.57-3.02 3.94-.1.2.16.33.28.17.75-.97 1.56-1.9 2.48-2.7.37-.32.76-.6 1.15-.88-.38 1-.8 1.95-1.34 2.87zM4.58 7c-.2-.2-.48.1-.3.3 1.27 1.55 2.5 3.25 3.94 4.66-.13.01-.26.01-.4.03-2.37-1.3-5.35-3.6-4.9-6.05.2-1.05.4-1 1.4-.78.42.1.84.34 1.2.57.83.53 1.52 1.28 2.05 2.1.76 1.18 1.2 2.53 1.57 3.9C7.83 10 6.1 8.5 4.58 7zm17.9 5.32c.85 1.37 1.82 2.85 2.94 4.1-1.32-.4-2.5-1-3.45-2.02-.6-.66-1.1-1.45-1.38-2.3-.14-.4-.22-.84-.26-1.27-.18-.74.15-1.14.98-1.18 1.2-.54 1.85-.24 2.77.7.57.58.93 1.24 1.22 1.98.4 1.02.5 2.06.57 3.1-1-1.13-2.07-2.23-3.04-3.4-.17-.18-.47.06-.35.27zm11.82 11a10.14 10.14 0 0 1-1.46 1.47c-.46.4-.97.7-1.55.9-1.5-.52-1.9-1.25-1.2-2.17.85-1.44 2.32-2.5 3.93-3.32a13.38 13.38 0 0 0-2.22 3.02c-.14.27.23.6.44.34.66-.84 1.32-1.67 2.1-2.42.6-.58 1.26-1.05 1.9-1.56-.42 1.35-1.02 2.62-1.93 3.74zm13.43-8.78c-1.2-.42-3.5-1.58-3.97-2.87.32-1.7 1.1-2.25 2.33-1.66l.93.4c.77.4 1.48.9 2.1 1.47.62.57 1.1 1.2 1.54 1.9a33.56 33.56 0 0 0-4.39-2.55c-.3-.15-.57.28-.27.47 1.68 1.05 3.28 2.2 4.9 3.3-1.08.01-2.15-.1-3.18-.47zm17.25.9l-4.26 4.22c-.2.2.1.5.3.3l3.8-3.43c-.26 1.17-.77 2.26-1.57 3.2-.55.65-4.67 3.92-4.55 1.42.08-1.7 2.03-3.54 3.26-4.5.56-.44 1.15-.82 1.75-1.2L65 15.2c-.02.08-.04.16-.04.24zm11.46-6.17c-.84-.37-3.46-1.5-3.78-2.37-1.07-2.97 3.44-1.05 4.16-.57.82.55 1.45 1.27 1.95 2.08L76.4 6.5c-.3-.24-.74.16-.44.44 1.15 1.1 2.32 2.24 3.53 3.3-1.05-.24-2.07-.54-3.06-.98zm16.52 6.06c-.77 1.15-5.3 5.56-5.43 2.03-.07-1.8 2.46-3.7 3.75-4.67a15.72 15.72 0 0 1 2.14-1.36c-.56.62-1.07 1.3-1.57 1.9-.75.9-1.5 1.83-2.18 2.78-.17.23.2.52.4.3l2.57-2.87c.7-.75 1.5-1.47 2.13-2.28.1 0 .2-.01.3-.01-.66 1.4-1.25 2.86-2.12 4.16zm7.8-13.63c1.5-.26 2.65 1.23 2.66 2.58.02 1.4-.8 2.47-1.63 3.5-.1-.3-.2-.6-.26-.9-.15-.8-.13-1.62-.05-2.44.03-.32-.46-.37-.54-.07-.26.98-.37 2.24-.16 3.38-1.44-2.07-2.47-5.62-.02-6.04zm15.47 14.1c.4 1.9-1.65 1.22-2.6.77-2.3-1.1-4-2.9-5.24-5.04l1.77.2.87.83 2.2 2.13c.4.35.96-.2.58-.58l-2.2-2.2 1.77.24c.84.5 1.57 1.17 2.12 2.04.3.48.62 1.05.74 1.6zm15-2.18l-.67-.16c1.45-.8 3.02-1.62 4.28-2.66.37-.3-.1-.8-.48-.63-1.53.75-3 1.95-4.37 2.95-.06.05-.1.1-.1.17l-.7-.17c1.87-2.4 4.08-4.26 7.02-5.26.28-.1.55-.18.84-.26.83.8.83 1.5-.01 2.12a10.13 10.13 0 0 1-1.2 1.25c-1.26 1.13-2.7 1.85-4.28 2.38-.15.06-.25.16-.3.27zm16.1 10.3c-1.18-.34-2.5-1.7-3.14-2.7-.56-.86-.8-1.76-.84-2.68.85 1.46 2 2.82 3.4 3.74.38.25.85-.34.5-.64-1.2-.97-2.26-1.95-3.2-3.1l1.8.34c.77.47 1.45 1.08 1.96 1.86.65 1 1.77 3.84-.48 3.2zm15.7-5.7c-.36 0-.73-.01-1.1-.01 1.92-.8 3.8-1.94 5.4-3.17.4-.3.04-.97-.4-.7-2.05 1.32-4.17 2.53-6.22 3.84-.02.01-.03.01-.04.01 1.2-2.52 3.36-4.85 6.1-5.56 1.7-.44 2.1 1.37 1.26 2.5-.53.73-1.52 1.32-2.27 1.78-.88.56-1.8.95-2.75 1.3zm20.1 1.7c.53.2 2.08.78 2.45 1.3.2 1.94-.24 2.7-1.35 2.27-.26-.06-.53-.12-.8-.2-2.47-.66-4.66-1.74-6-3.88.22-.03.43-.07.65-.1 1.58 1.08 3.18 2.2 4.83 3.14.44.25.8-.4.4-.67-1.38-.94-2.84-1.78-4.3-2.6l.7-.1c1.17.22 2.3.44 3.4.86zm7.77-5.5l-1 .27c-.01-.06-.01-.12-.01-.18.12.08.28.1.35-.06.45-.98.97-1.93 1.6-2.8.7-.96 1.56-1.73 2.3-2.64.26-.32-.08-.9-.48-.62-1.8 1.28-3.05 3.6-3.8 5.67-.08-1.38.1-2.76.7-4.03.5-1.08 1.7-3.03 3-3.28 3.18-.62 1 3.38.25 4.48-.82 1.2-1.85 2.22-2.9 3.2zm20.34-10.47c-2.12 1.1-3.9 3.27-5.3 5.2.2-2.02 1-3.9 2.34-5.45.64-.73 1.4-1.37 2.23-1.86 1.35-.8 4-1.4 4.15.92.13 1.98-1.72 3.77-3.17 4.83-1.47 1.08-3.1 1.66-4.85 1.94a24.15 24.15 0 0 1 2.33-2.52c.9-.84 1.93-1.5 2.8-2.35.4-.37-.1-.95-.55-.7zm2.78 12.7c-3.2-.18-6.76-2.45-7.35-5.63 1.7 1.7 4.14 3.3 6.38 3.82.5.12.84-.6.36-.85-1.2-.66-2.52-1.1-3.73-1.8-.68-.4-1.32-.84-1.95-1.3 1.62-.04 3.14.38 4.6 1.15.8.4 1.7.93 2.3 1.58 1.02 1.08 1.48 3.13-.63 3.02z"/></svg>';
                                    break;
                                case 'multinus':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 162 22.1"><path d="M.52 19.23c-.12.2-.2.4-.23.64-.07.38-.05.82.1 1.18a.97.97 0 0 0 .32.47c.25.15.43.01.6-.18L3.38 19l1.84-1.97 2.86 4.12c.17.3.42.45.75.5.54 0 .86-.6 1.02-1.03.17-.48.25-.98.24-1.5 0-.7-.13-1.44-.52-2.04l-1.8-2.74 1.9-1.96 2.06-2.1a1.03 1.03 0 0 0 .35-.52c.15-.4.18-.9.1-1.3-.04-.25-.12-.5-.26-.7-.1-.12-.28-.3-.46-.3-.07 0-.14.02-.2.1L7.52 11.4l-1 1.02L2.1 5.77a.94.94 0 0 0-.78-.5c-.57 0-.9.64-1.07 1.08C.08 6.85 0 7.37 0 7.9c0 .72.13 1.52.54 2.13l3.44 5.13-1.13 1.26-2.33 2.8zm37.02-2.58c.38-.52.48-1.28.48-1.9 0-.48-.07-.94-.23-1.4l-.26-.5c-.16-.27-.4-.42-.7-.45-1.1-.22-2.22-.34-3.33-.42l-3.65-.2-5.73-.1H21.4a1.02 1.02 0 0 0-.81.53c-.44.6-.56 1.5-.56 2.22-.01.56.08 1.1.27 1.63.18.46.52 1.13 1.1 1.13l8.34.03 7.08-.13a.87.87 0 0 0 .71-.45zm25.02-5.5c.24-.63.27-1.38.16-2.04-.1-.52-.42-1.53-1.05-1.53a.71.71 0 0 0-.37.11l-4.84 2.82-3.85-6.08a1.18 1.18 0 0 0-.92-.6c-.67 0-1.06.76-1.25 1.27a5.72 5.72 0 0 0-.3 1.84c0 .88.17 1.76.64 2.5l2.1 3.34c-1.03.67-2.05 1.38-2.8 2.36a2.89 2.89 0 0 0-.39 1.06c-.1.63-.08 1.35.15 1.95a1.58 1.58 0 0 0 .53.77l.34.1a.84.84 0 0 0 .63-.4c.5-.46 1.07-.82 1.63-1.2l1.04-.68 1-.64.12.2c1.16 1.76 2.36 3.53 3.76 5.1.2.33.47.5.84.55.62 0 .97-.7 1.15-1.17a5.12 5.12 0 0 0 .28-1.69c0-.75-.12-1.68-.58-2.3l-1.97-2.9 3.4-1.95c.27-.2.45-.48.55-.8zm15 6.16l8.6-1.58 7.1-1.1 1.16-.13a.8.8 0 0 0 .65-.43c.36-.5.45-1.2.45-1.78a4.07 4.07 0 0 0-.21-1.3c-.13-.33-.4-.9-.86-.9h-.03c-1.27.08-2.53.3-3.78.5l-3.15.57-9.93 1.9a.79.79 0 0 0-.63.4c-.34.47-.44 1.16-.44 1.72 0 .43.06.85.2 1.26l.23.46a.84.84 0 0 0 .64.4zm37.1.54c.5 0 .78-.56.93-.94.15-.44.23-.9.22-1.36l-.06-.73a2.95 2.95 0 0 0-.41-1.13l-.64-.7 6.93-3.93c.23-.18.4-.42.48-.7.2-.55.24-1.2.14-1.77-.08-.45-.37-1.33-.9-1.33-.1 0-.2.03-.32.1l-7.47 4.25-1.2.7-.43-.52-4.02-5a.76.76 0 0 0-.63-.4c-.46 0-.73.52-.86.87-.14.4-.2.83-.2 1.26 0 .55.1 1.27.44 1.72l2.92 3.74-.65.4c-.56.36-1.13.7-1.62 1.15a1.35 1.35 0 0 0-.44.65c-.2.5-.22 1.1-.13 1.63.07.43.47 1.6 1.14 1.14.53-.36 1.1-.67 1.65-1l1.5-.85.73-.42L114 17.4c.13.25.36.4.66.43zm27.74-4.96l1.96-.2c.87-.1 1.74-.2 2.62-.16a.84.84 0 0 0 .66-.43c.36-.5.46-1.22.46-1.8 0-.45-.07-.9-.22-1.32l-.24-.48a.82.82 0 0 0-.66-.43c-.6-.14-1.2-.17-1.8-.17h-.78l-1.9.1-3.6.24-9 .74c-.32.04-.57.2-.73.48-.4.55-.5 1.35-.5 2a4.26 4.26 0 0 0 .24 1.46c.14.37.48 1.06 1 1.02l8.94-.74 3.56-.33zm13.64-8.03l-2.3-3.88a.87.87 0 0 0-.68-.44c-.5 0-.78.56-.93.94a3.88 3.88 0 0 0 .25 3.21l2.36 3.98.68 1.13-1.03 1.9-.67 1.3-.9 1.92a4.44 4.44 0 0 0-.24 1.44c0 .64.1 1.43.5 1.97a.9.9 0 0 0 .72.47c.55 0 .8-.6 1-1 .01-.02.02-.04.03-.07l2.7-4.86.63.88.86 1.1c.45.57.96 1.13 1.52 1.57a.6.6 0 0 0 .7 0c.45-.26.62-.95.7-1.4.16-.94.06-2.15-.7-2.8a1.26 1.26 0 0 1-.2-.2c-.6-.68-1.15-1.43-1.68-2.18l-.07-.1 1.4-2.47c.24-.4.4-.8.46-1.27.13-.76.1-1.62-.18-2.34-.12-.37-.33-.68-.63-.93a.78.78 0 0 0-.41-.12c-.3 0-.6.18-.76.48l-2 3.54-1.1-1.76z"/></svg>';
                                    break;
                                case 'rotate-box':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 13.48"><g fill="none" stroke="#000" stroke-miterlimit="10"><path d="M6.07 2.496l4.243 4.243-4.243 4.24-4.243-4.242zm11.4.001l4.24 4.243-4.243 4.243-4.243-4.243z"/><use xlink:href="#B"/><path d="M40.3 2.494l4.243 4.243L40.3 10.98l-4.243-4.243zm11.4.001l4.243 4.243L51.7 10.98l-4.243-4.243zm11.408.002L67.35 6.74l-4.243 4.243-4.243-4.243zm11.4.003l4.242 4.24-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="57.032" y="-0.007"/><use xlink:href="#B" x="68.442" y="-0.005"/><use xlink:href="#B" x="79.85" y="-0.003"/><path d="M120.147 2.498L124.4 6.74l-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="102.662" y="-0.007"/><use xlink:href="#B" x="114.072" y="-0.006"/><path d="M154.368 2.496L158.6 6.74l-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="136.889" y="-0.002"/><use xlink:href="#B" x="148.292" y="-0.008"/><use xlink:href="#B" x="159.7" y="-0.006"/><use xlink:href="#B" x="171.11" y="-0.004"/><use xlink:href="#B" x="182.519" y="-0.003"/><use xlink:href="#B" x="193.928"/><use xlink:href="#B" x="205.33" y="-0.007"/><use xlink:href="#B" x="216.739" y="-0.005"/><use xlink:href="#B" x="228.149" y="-0.003"/><use xlink:href="#B" x="239.558" y="-0.002"/><use xlink:href="#B" x="250.96" y="-0.007"/><use xlink:href="#B" x="262.369" y="-0.005"/><use xlink:href="#B" x="273.778" y="-0.004"/><use xlink:href="#B" x="285.188" y="-0.002"/><use xlink:href="#B" x="296.59" y="-0.008"/><use xlink:href="#B" x="307.999" y="-0.006"/><use xlink:href="#B" x="319.408" y="-0.004"/><use xlink:href="#B" x="330.817" y="-0.003"/><use xlink:href="#B" x="342.219" y="-0.008"/><use xlink:href="#B" x="353.629" y="-0.006"/><use xlink:href="#B" x="365.038" y="-0.005"/></g><defs ><path id="B" d="M28.888 2.5l4.243 4.243-4.243 4.243-4.243-4.243z"/></defs></svg>';
                                    break;
                                case 'tripline':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.18 18.84"><path d="M5.72 9.45l6.38-.17 2.6-.12 11.43-.57 13.66-.72 19.5-1.1L90.95 5.3l33.67-1.06 34.85-.52 33.44-.13 18.77.06-27.08.38-16.2.24-35.27.95-3.18.14-30.5 1.4-3.02.2L68.6 8.87l-30.9 2.6-20.24 1.77-4.85.42-8.7.94c-.3.03-.57.23-.57.57 0 .32.26.55.57.57l3.17.14c-.13.28-.2.58-.2.88 0 1.08.94 2.15 2.07 2.08l24.82-1.47 55.07-2.63 66.33-1.7 56.1-.88 14.37-.3 11.87-.45 5.92-.25 13.47-.87c0 .01-.01.01-.01.02-.25.43-.32.96-.2 1.44.13.47.44.87.86 1.12.4.23 1 .36 1.44.2l2.92-1.2-.06.03a4.97 4.97 0 0 1 .22-.09l.25-.1c-.03.01-.06.03-.1.04l3.17-1.35c.6-.26 1.15-.57 1.72-.87.64-.34 1.03-1.1 1.03-1.8 0-.38-.1-.73-.28-1.05-.25-.43-.74-.87-1.24-.96s-1-.15-1.5-.22l-.34-.02c-.34 0-.7.05-1.02.07l-2.28.22-1.87.13-5.02.36-1.3.1c.16-.18.27-.38.34-.62.08-.18.12-.38.13-.58l.06-.43c0-.2-.03-.36-.1-.53l.13-.06c.3-.2.57-.44.75-.75.2-.33.3-.68.3-1.06s-.1-.73-.3-1.06l-.33-.43a2.08 2.08 0 0 0-.93-.54c-.63-.23-1.3-.3-2-.3l-1.68.05-5.83.05-9.03.05-16.2.02-30.77.17-23.07.23-10.3.16-29.7.63-3.82.14-22.85.87-6.97.27-3.9.2-22.7 1.22-11.72.68L32.75 6 12.63 7.2l-4.46.2-3.96.06c-.13-.34-.47-.62-.85-.6L.8 7.12c-.4.04-.77.25-.88.68-.13.47.15 1 .64 1.13l1.1.27c.36.08.74.1 1.1.13.97.1 1.95.1 2.93.12zm234-3.2h3.73c.1.28.28.53.5.73l-1.44.08-2.72.1-17.3.65-65.55 1.04-26.96.66-40.62 1.08-8.14.38-23.06 1.1-24.74 1.18 6.1-.48 28.75-2.2 3.84-.24 26.5-1.6 6.24-.24 27.87-1.1 1.32-.03 26.42-.54L171 6.65l34.04-.26 34.68-.15z"/><circle cx="20.75" cy="22.59" r=".57"/></svg>';
                                    break;
                                case 'vague':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 211.79 7.61"><path d="M0 6.87c1.8-1.6 3.73-3.08 5.87-4.24C8 1.5 10.4.66 12.9.64c1.25 0 2.52.2 3.7.65 1.2.46 2.25 1.16 3.24 1.86s1.94 1.4 2.95 1.92a9.06 9.06 0 0 0 3.19.96c2.24.27 4.5-.18 6.6-1.2l6.47-3.27C41.37.57 43.92.1 46.52.4c1.3.18 2.58.72 3.64 1.45 1.07.73 1.95 1.6 2.84 2.33.9.74 1.82 1.34 2.85 1.65 1.03.32 2.17.33 3.26.2 2.2-.28 4.17-1.6 6.2-2.9 1.03-.65 2.1-1.3 3.26-1.8C69.75.8 71 .47 72.3.34c1.28-.1 2.58-.02 3.84.3 1.26.3 2.44.9 3.5 1.56 2.1 1.34 3.9 2.87 6.07 3.5 1.06.33 2.2.47 3.32.4 1.13-.02 2.24-.25 3.3-.64 2.16-.74 4.1-2.16 6.25-3.36 2.14-1.2 4.76-2.1 7.35-1.74a9.01 9.01 0 0 1 3.7 1.23c1.12.66 2.06 1.5 2.97 2.23.9.74 1.84 1.37 2.87 1.76 1.02.4 2.14.58 3.26.55.56.03 1.12-.08 1.68-.13.55-.13 1.1-.22 1.65-.42 1.1-.33 2.15-.84 3.2-1.38 2.1-1.08 4.16-2.44 6.58-3.25 1.2-.43 2.5-.66 3.78-.66 1.3-.03 2.6.2 3.83.74 2.5 1.07 4 3.25 5.87 4.3 1.87 1.05 4.3 1.05 6.3.12 2.05-.92 3.92-2.56 6.2-3.65 2.27-1.1 4.8-1.72 7.4-1.45 1.3.14 2.55.52 3.7 1.07s2.2 1.2 3.2 1.83c2.03 1.27 4.06 2.4 6.32 2.72 2.24.38 4.57.05 6.7-.8 2.16-.8 4.17-2.16 6.44-3.17 1.13-.5 2.33-.9 3.55-1.13 1.23-.2 2.48-.28 3.7-.2 2.47.2 4.85.95 7 2.06 2.17 1.12 4.13 2.56 5.94 4.15-3.77-2.95-8.24-5.3-13-5.42-1.18-.02-2.34.1-3.48.35-1.13.28-2.22.7-3.26 1.22-2.1 1.05-4.03 2.53-6.36 3.53-2.34 1-4.97 1.3-7.5.88-2.56-.36-4.84-1.66-6.87-2.93-2.04-1.28-4.05-2.48-6.28-2.7-1.1-.15-2.24-.01-3.36.2s-2.2.62-3.23 1.12c-2.1.98-3.9 2.6-6.25 3.68-2.35 1.1-5.3 1.14-7.64-.2-1.16-.65-2.07-1.54-2.96-2.32s-1.77-1.5-2.77-1.9c-1-.43-2.1-.64-3.22-.6a9.74 9.74 0 0 0-3.31.58c-2.17.72-4.2 2.03-6.36 3.16-1.1.56-2.22 1.1-3.43 1.48-.6.22-1.23.33-1.85.47-.64.06-1.27.2-1.92.15-1.28.04-2.6-.17-3.82-.65-1.23-.47-2.32-1.22-3.27-2-.96-.77-1.84-1.55-2.8-2.1-.95-.57-2-.9-3.1-1.03-2.24-.3-4.43.43-6.46 1.57-2.05 1.13-4.05 2.6-6.47 3.46-1.2.43-2.47.7-3.76.73-1.28.06-2.58-.1-3.8-.47-2.52-.74-4.48-2.43-6.43-3.65-.98-.62-2-1.1-3.08-1.38a10.34 10.34 0 0 0-3.33-.26c-1.12.12-2.2.4-3.25.85-1.05.45-2.04 1.06-3.05 1.7s-2.03 1.32-3.15 1.9-2.36 1.04-3.65 1.22c-1.3.17-2.62.15-3.9-.24-1.3-.38-2.42-1.13-3.37-1.93-.96-.8-1.8-1.62-2.74-2.25-.92-.64-1.92-1.06-3-1.2-2.2-.26-4.54.14-6.66 1.06-2.15.88-4.16 2.2-6.42 3.25C31 7.26 28.36 7.94 25.8 7.54c-1.28-.2-2.53-.64-3.63-1.3-1.1-.64-2.07-1.43-3-2.17-.94-.74-1.88-1.42-2.92-1.9s-2.18-.7-3.34-.76c-2.33-.1-4.68.57-6.83 1.6C3.9 4.03 1.9 5.38 0 6.87z"/></svg>';
                                    break;
                                case 'zigzag-dot':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 13.48"><circle cx="3.59" cy="9.11" r="2"/><circle cx="8.89" cy="4.37" r="2"/><circle cx="14.21" cy="9.11" r="2"/><circle cx="19.51" cy="4.37" r="2"/><circle cx="24.82" cy="9.11" r="2"/><circle cx="30.13" cy="4.37" r="2"/><circle cx="35.44" cy="9.11" r="2"/><circle cx="35.44" cy="9.11" r="2"/><circle cx="40.74" cy="4.37" r="2"/><circle cx="46.06" cy="9.11" r="2"/><circle cx="46.06" cy="9.11" r="2"/><circle cx="51.36" cy="4.37" r="2"/><circle cx="56.67" cy="9.11" r="2"/><circle cx="56.67" cy="9.11" r="2"/><circle cx="61.98" cy="4.37" r="2"/><circle cx="67.29" cy="9.11" r="2"/><circle cx="67.29" cy="9.11" r="2"/><circle cx="72.59" cy="4.37" r="2"/><circle cx="77.91" cy="9.11" r="2"/><circle cx="77.91" cy="9.11" r="2"/><circle cx="83.21" cy="4.37" r="2"/><circle cx="88.52" cy="9.11" r="2"/><circle cx="88.52" cy="9.11" r="2"/><circle cx="93.83" cy="4.37" r="2"/><circle cx="99.14" cy="9.11" r="2"/><circle cx="99.14" cy="9.11" r="2"/><circle cx="104.44" cy="4.37" r="2"/><circle cx="109.76" cy="9.11" r="2"/><circle cx="109.76" cy="9.11" r="2"/><circle cx="115.06" cy="4.37" r="2"/><circle cx="120.37" cy="9.11" r="2"/><circle cx="120.37" cy="9.11" r="2"/><circle cx="125.68" cy="4.37" r="2"/><circle cx="130.99" cy="9.11" r="2"/><circle cx="130.99" cy="9.11" r="2"/><circle cx="136.29" cy="4.37" r="2"/><circle cx="141.61" cy="9.11" r="2"/><circle cx="141.61" cy="9.11" r="2"/><circle cx="146.91" cy="4.37" r="2"/><circle cx="152.22" cy="9.11" r="2"/><circle cx="152.22" cy="9.11" r="2"/><circle cx="157.53" cy="4.37" r="2"/><circle cx="162.84" cy="9.11" r="2"/><circle cx="162.84" cy="9.11" r="2"/><circle cx="168.14" cy="4.37" r="2"/><circle cx="173.46" cy="9.11" r="2"/><circle cx="173.46" cy="9.11" r="2"/><circle cx="178.76" cy="4.37" r="2"/><circle cx="184.07" cy="9.11" r="2"/><circle cx="184.07" cy="9.11" r="2"/><circle cx="189.38" cy="4.37" r="2"/><circle cx="194.69" cy="9.11" r="2"/><circle cx="194.69" cy="9.11" r="2"/><circle cx="199.99" cy="4.37" r="2"/><circle cx="205.31" cy="9.11" r="2"/><circle cx="205.31" cy="9.11" r="2"/><circle cx="210.61" cy="4.37" r="2"/><circle cx="215.93" cy="9.11" r="2"/><circle cx="215.93" cy="9.11" r="2"/><circle cx="221.23" cy="4.37" r="2"/><circle cx="226.54" cy="9.11" r="2"/><circle cx="226.54" cy="9.11" r="2"/><circle cx="231.84" cy="4.37" r="2"/><circle cx="237.16" cy="9.11" r="2"/><circle cx="237.16" cy="9.11" r="2"/><circle cx="242.46" cy="4.37" r="2"/><circle cx="247.78" cy="9.11" r="2"/><circle cx="247.78" cy="9.11" r="2"/><circle cx="253.08" cy="4.37" r="2"/><circle cx="258.39" cy="9.11" r="2"/><circle cx="258.39" cy="9.11" r="2"/><circle cx="263.69" cy="4.37" r="2"/><circle cx="269.01" cy="9.11" r="2"/><circle cx="269.01" cy="9.11" r="2"/><circle cx="274.31" cy="4.37" r="2"/><circle cx="279.63" cy="9.11" r="2"/><circle cx="279.63" cy="9.11" r="2"/><circle cx="284.93" cy="4.37" r="2"/><circle cx="290.24" cy="9.11" r="2"/><circle cx="290.24" cy="9.11" r="2"/><circle cx="295.54" cy="4.37" r="2"/><circle cx="300.86" cy="9.11" r="2"/><circle cx="300.86" cy="9.11" r="2"/><circle cx="306.16" cy="4.37" r="2"/><circle cx="311.48" cy="9.11" r="2"/><circle cx="311.48" cy="9.11" r="2"/><circle cx="316.78" cy="4.37" r="2"/><circle cx="322.09" cy="9.11" r="2"/><circle cx="322.09" cy="9.11" r="2"/><circle cx="327.4" cy="4.37" r="2"/><circle cx="332.71" cy="9.11" r="2"/><circle cx="332.71" cy="9.11" r="2"/><circle cx="338.01" cy="4.37" r="2"/><circle cx="343.33" cy="9.11" r="2"/><circle cx="343.33" cy="9.11" r="2"/><circle cx="348.63" cy="4.37" r="2"/><circle cx="353.94" cy="9.11" r="2"/><circle cx="353.94" cy="9.11" r="2"/><circle cx="359.25" cy="4.37" r="2"/><circle cx="364.56" cy="9.11" r="2"/><circle cx="364.56" cy="9.11" r="2"/><circle cx="369.86" cy="4.37" r="2"/><circle cx="375.18" cy="9.11" r="2"/><circle cx="375.18" cy="9.11" r="2"/><circle cx="380.48" cy="4.37" r="2"/><circle cx="385.79" cy="9.11" r="2"/><circle cx="385.79" cy="9.11" r="2"/><circle cx="391.1" cy="4.37" r="2"/><circle cx="396.41" cy="9.11" r="2"/></svg>';
                                    break;
                                case 'zozobe':
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 226.76 14.31"><path d="M225.8 2.6c-1.52-2.33-4.72-3.27-7.12-2.1-1.8.88-2.93 2.87-2.67 4.73.14 1 .72 1.93 1.58 2.56.8.58 1.72.82 2.6.68.97-.16 1.87-.87 2.34-1.84.44-.92.45-1.9 0-2.7-.08-.13-.25-.18-.38-.1-.14.08-.18.25-.1.38.35.63.35 1.43-.02 2.18-.4.82-1.13 1.4-1.92 1.54-.73.12-1.5-.1-2.18-.58-.73-.54-1.24-1.35-1.36-2.2-.23-1.62.76-3.36 2.36-4.14 2.12-1.03 5.06-.16 6.4 1.9 1.3 2 1.13 4.9-.4 6.9-1.46 1.9-4.04 2.94-6.6 2.66-2.36-.26-4.7-1.64-6.27-3.7-.47-.62-.88-1.3-1.28-1.97-.6-1-1.23-2.05-2.1-2.9-2.74-2.76-7.66-2.87-10.53-.24-.87.8-1.54 1.8-2.18 2.75-.16.24-.33.47-.5.7l-10.38.24c-1.16-.96-2.38-1.9-3.85-2.3-1.2-.32-2.65-.1-3.67.6-.73.5-1.18 1.15-1.32 1.92-17.9.48-34.93.87-52.72-.1-4.06-1.1-7.56-3.2-9.85-5.93a.43.43 0 0 0-.64 0c-2.3 2.73-5.8 4.83-9.85 5.93-17.8.96-34.83.57-52.72.1-.14-.77-.6-1.43-1.32-1.92-1.02-.7-2.46-.92-3.67-.6-1.48.4-2.7 1.32-3.85 2.3L31.27 7.1c-.16-.24-.33-.47-.5-.7-.64-.96-1.3-1.94-2.18-2.75-2.87-2.63-7.8-2.5-10.53.24-.85.86-1.48 1.9-2.1 2.9-.4.66-.8 1.35-1.28 1.97-1.6 2.1-3.87 3.44-6.27 3.7-2.54.28-5.13-.77-6.6-2.66-1.54-2-1.7-4.9-.4-6.9C2.78.84 5.7-.03 7.84 1c1.6.78 2.6 2.52 2.36 4.14-.13.84-.63 1.66-1.37 2.2-.67.5-1.45.7-2.18.58-.8-.13-1.53-.72-1.92-1.54-.36-.75-.37-1.55-.02-2.18.08-.13.03-.3-.1-.38-.13-.07-.3-.03-.38.1-.44.8-.44 1.78 0 2.7.48.97 1.37 1.68 2.34 1.84.88.14 1.8-.1 2.6-.68.86-.63 1.44-1.57 1.58-2.56C11.02 3.37 9.9 1.4 8.08.5 5.67-.67 2.48.27.96 2.6-.47 4.8-.3 7.96 1.4 10.14c1.4 1.83 3.78 2.92 6.2 2.92.3 0 .58-.02.88-.05 2.55-.28 4.97-1.7 6.65-3.92a19.25 19.25 0 0 0 .89-1.33l15.14.16c1.27 1.72 2.58 2.68 4 2.93 1.68.3 3.52-.4 5.62-2.1a19.06 19.06 0 0 0 .72-.6l6.6.17 31.25.56c7.8 0 15.63-.17 23.6-.6.02.01.03.02.04.02 4.14 1.1 7.7 3.2 10.04 5.98.08.1.2.15.32.15s.24-.05.32-.15c2.33-2.77 5.9-4.9 10.04-5.98.02 0 .03-.01.04-.02 7.97.43 15.8.6 23.6.6 10.3 0 20.62-.28 31.25-.56l6.6-.17.72.6c2.1 1.7 3.94 2.4 5.62 2.1 1.43-.25 2.74-1.2 4-2.93l15.14-.16a19.25 19.25 0 0 0 .89 1.33c1.68 2.2 4.1 3.64 6.65 3.92a8.49 8.49 0 0 0 .88.05c2.44 0 4.8-1.1 6.2-2.92 1.7-2.17 1.87-5.34.44-7.53zM18.46 4.28c2.54-2.56 7.1-2.66 9.75-.23.82.76 1.47 1.72 2.1 2.65l.27.4-14.04-.16c.58-.97 1.15-1.88 1.92-2.65zm22 4.05c-1.97 1.6-3.66 2.25-5.17 1.98-1.18-.2-2.3-1-3.4-2.37l8.78.2c-.07.07-.15.13-.22.2zm2.05-.98c.96-.77 1.98-1.46 3.14-1.77 1.06-.28 2.32-.08 3.2.52.4.27.9.73 1.05 1.44l-1.76-.05-5.64-.14zm70.88 6.05c-2.16-2.4-5.23-4.32-8.77-5.48 3.54-1.16 6.6-3.07 8.77-5.48 2.16 2.4 5.23 4.32 8.77 5.48-3.55 1.15-6.6 3.06-8.77 5.48zm83.07-6.7c.63-.93 1.27-1.9 2.1-2.65 2.66-2.44 7.2-2.33 9.75.23.77.77 1.33 1.7 1.9 2.66l-14.04.15.28-.4zm-17.84.8l-1.76.05c.17-.7.65-1.17 1.05-1.44.9-.6 2.15-.8 3.2-.52 1.16.3 2.18 1 3.14 1.77l-5.64.14zm12.87 2.8c-1.5.27-3.2-.38-5.17-1.98-.07-.06-.15-.12-.22-.18l8.78-.2c-1.1 1.37-2.2 2.15-3.4 2.36z"/></svg>';
                                    break;
							}
						?>
					</div>
                <?php endif; ?>

            <?php endif; ?>

            <?php if ( $settings['description_text'] ) : ?>
                <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>>
						<?php echo esc_html($settings['description_text']); ?>
					</div>
            <?php endif; ?>

            <?php if ($settings['readmore']) : ?>
            <div class="readmore-align">
                <a <?php echo $this->get_render_attribute_string( 'readmore' ); ?>>
                    <?php echo esc_html($settings['readmore_text']); ?>

                    <?php if ($settings['advanced_readmore_icon']['value']) : ?>
                        <span class="tmt-button-icon-align-<?php echo esc_html($settings['readmore_icon_align']); ?>">
                            <?php if ( $readmore_is_new || $readmore_migrated ) :
                                Icons_Manager::render_icon( $settings['advanced_readmore_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] );
                            else : ?>
                                <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                            <?php endif; ?>
                        </span>

                    <?php endif; ?>
                </a>
            </div>

            <?php endif ?>
        </div>
        </div>

        <?php $indicator_style = $settings['indicator_style']; if ($indicator_style) : ?>
            <div class="tmt-indicator-svg tmt-svg-style-<?php echo esc_attr($indicator_style); ?>">
                <?php
                switch ($indicator_style) {
                    case "1" :
                        echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M145.2,26.8c0.3,5.3,0.7,10.5,1.1,15.8c-10.5-10.1-19.1-22.4-31-30.9C104.7,4.1,91.9,0.9,79,1.4C48.2,2.5,22.3,22.7,0.4,42.5c-0.8,0.7,0.2,2,1.1,1.3c23.4-18.3,47.6-39.2,79-39.8c13.4-0.2,26,3.8,36.5,12.2c10,8.1,17.7,18.5,26.8,27.5C137,42,130.5,40,124,37.8c-1.1-0.4-1.7,1.2-0.6,1.7c7.8,3.4,15.9,5.9,24.2,7.9c0.1,0,0.1,0,0.2,0c0.1,0.1,0.2,0.2,0.2,0.2c1.3,1.2,2.9-1.1,1.6-2.2c-0.1-0.1-0.2-0.2-0.3-0.2c-0.4-6.3-0.8-12.6-1.4-18.9C147.7,24.6,145.1,25,145.2,26.8z"/></svg>';
                    break;
                    case "2" :
                        echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M137,10.3c2.7,5.7,4.5,12.2,6.5,18.2c0.4,1.3-1,2.6-2.2,2.2c-6.7-2.3-13.5-4.5-20.3-6.8c-1.8-0.6-1.1-3.4,0.7-2.8c3.2,0.9,6.5,1.9,9.7,2.9c0-0.1-0.1-0.1-0.1-0.2c-3.7-6.4-13.1-18.6-20.2-7.5c-2.3,3.7-2.6,8.7-3.8,12.8c-1.5,5-4.3,9.8-10,10.3c-6.2,0.5-10.7-4.9-13.6-9.6c-2.6-4.4-4.6-9.3-6.8-13.9c-0.7-1.6-1.5-3.2-2.3-4.8c-2.8-4.2-6.4-4.2-8.5-4.1c-4.3,0.2-8.4,5.4-10.7,8.6c-6.2,8.6-9.8,41.1-27.6,32.9C12.2,41.2,6.5,16.6,7.9,1.1c0.1-1.2,1.9-1.2,1.9,0c-0.1,11.7,2.5,23.1,8.8,33c3.8,6.1,9.8,14,18.2,11c5.3-1.9,7.1-11.7,8.6-16.3c3.1-9.7,16.7-35.6,30.3-23c6.8,6.4,7.8,17.8,13.8,25c11.8,14.2,14.5-6.5,17.4-13.9c2.1-5.2,5.9-9.1,11.9-8.7c7.9,0.4,12.6,7.3,15.8,13.7c0.6,1.1-0.1,2.1-1,2.5c1.8,0.5,3.6,1.1,5.3,1.6c-1.9-4.8-3.8-9.6-5-14.5C133.4,9.7,136.2,8.4,137,10.3z"/></svg>';
                    break;
                    case "3" :
                        echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M4.3,12.3c2.9,6.7,5.6,14.2,11.3,19.2c9.3,8.1,20.4,2,29-3.8c12.7-8.5,23.8-20,39-24c26.5-7.1,55,9.2,61.4,35.8c0.7-3.1,1.2-6.2,1.7-9.4c0.2-1.2,2-0.9,2.1,0.3c0.2,5.5-1.1,11.2-2.4,16.5c-0.3,1.2-2,1.7-2.8,0.7c-4-4.8-8.4-9.2-12.4-14c-1.4-1.7,0.7-3.7,2.4-2.4c3.6,2.8,6.8,6.5,9.7,10.3c-5.2-16.6-17.2-30.3-34.7-34.5c-19-4.6-34.8,3.5-49.5,14.7C49.1,29.1,35.7,41.7,22.2,39C10.7,36.7,4.3,23.8,1.4,13.5C0.9,11.9,3.5,10.6,4.3,12.3z"/></svg>';
                    break;
                    case "4" :
                        echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M128,27.9c-1.2,6.2-1.9,11.7-4.4,17.3c-0.6-0.7-1.1-1.4-1.7-2.1c2.6-21.9-14.6-42.5-37.3-40.7c-2.1,0.2-4.4,0.7-6.6,1.4C67-1.4,52.2-1,41.8,3.5c-9.7,4.3-17.6,12.1-22,21.8c-3.5,7.6-6.2,18.8,1.7,24.5c1,0.7,2.2-0.6,1.3-1.4c-10.1-8,0.1-25.4,6.5-32.4C36,8.7,45.3,4.1,55.2,3.1c6.1-0.6,12.7,0.1,18.5,2.5C61.2,11.5,51,25,61.5,37.7c12.3,14.9,33.9,1.1,30.4-16.3c-1.4-6.7-5.1-11.7-10.1-15.2c1.6-0.3,3.2-0.4,4.7-0.5c19.2-0.4,32.2,15.8,32.3,33.8c-2.8-3.4-5.6-6.8-8.5-10c-0.8-0.9-2.3,0.4-1.6,1.4c3.2,4.5,6.6,8.8,10,13.2c0.1,0.5,0.4,0.9,0.8,1.1c1,1.3,2,2.6,3,3.9c0.7,1,2.1,1,2.8-0.1c3.4-6,6.2-13.7,5.2-20.7C130.3,26.8,128.3,26.4,128,27.9z M80.1,39.5c-14.7,5.8-24.2-11.8-15.8-23.1c3.2-4.3,7.9-7.4,13-9.1c2.1,1.2,4,2.6,5.8,4.4C90.9,19.5,91.9,34.9,80.1,39.5z"/></svg>';
                    break;
                    case "5" :
                        echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><g><path class="st0" d="M5.7,40.9c-0.8-0.1-1.5,0.5-1.5,1.3c-0.1,0.8,0.5,1.5,1.3,1.5C6.3,43.8,7,43.2,7,42.5    C7.1,41.7,6.5,41,5.7,40.9z"/><circle class="st0" cx="10.4" cy="36.6" r="1.7"/><path class="st0" d="M15.8,29c-1.1-0.1-2,0.7-2.1,1.8c-0.1,1.1,0.7,2,1.8,2.1c1.1,0.1,2-0.7,2.1-1.8S16.8,29,15.8,29z"/><path class="st0" d="M21.8,22.9c-1.1-0.1-2.1,0.8-2.2,1.9c-0.1,1.1,0.8,2.1,1.9,2.2c1.1,0.1,2.1-0.8,2.2-1.9    C23.8,24,22.9,23,21.8,22.9z"/><circle class="st0" cx="28.3" cy="19.9" r="2"/><path class="st0" d="M36.2,12.7c-1.1-0.1-2.1,0.8-2.2,1.9c-0.1,1.1,0.8,2.1,1.9,2.2c1.1,0.1,2.1-0.8,2.2-1.9    C38.2,13.7,37.4,12.8,36.2,12.7z"/><path class="st0" d="M55.4,5.8c-1.2-0.1-2.2,0.8-2.3,2c-0.1,1.2,0.8,2.2,2,2.3c1.2,0.1,2.2-0.8,2.3-2C57.5,6.9,56.6,5.8,55.4,5.8z"    /><path class="st0" d="M45.5,8.8c-1.2-0.1-2.3,0.8-2.3,2c-0.1,1.2,0.8,2.3,2,2.3c1.2,0.1,2.3-0.8,2.3-2C47.6,9.9,46.7,8.9,45.5,8.8z"    /><circle class="st0" cx="65.9" cy="6" r="2.4"/><circle class="st0" cx="76.8" cy="4.8" r="2.4"/><circle class="st0" cx="88.7" cy="6.1" r="2.4"/><circle class="st0" cx="99.9" cy="9.4" r="2.4"/><circle class="st0" cx="109.7" cy="13.4" r="2.4"/><circle class="st0" cx="119.6" cy="19.1" r="2.4"/><circle class="st0" cx="128.5" cy="25.6" r="2.4"/><circle class="st0" cx="135.3" cy="32.5" r="2.4"/><circle class="st0" cx="142.6" cy="41.8" r="2.4"/><circle class="st0" cx="143.1" cy="34.7" r="2.4"/><circle class="st0" cx="143.6" cy="27.9" r="2.4"/><circle class="st0" cx="144.1" cy="21" r="2.4"/><circle class="st0" cx="120.9" cy="40.3" r="2.4"/><circle class="st0" cx="127.8" cy="40.8" r="2.4"/><circle class="st0" cx="134.6" cy="41.3" r="2.4"/></g></svg>';
                    break;
                }
                ?>
			</div>
        <?php endif; ?>

        <?php if ( $settings['badge'] and '' != $settings['badge_text'] ) : ?>
            <div class="tmt-advanced-icon-box-badge tmt-position-<?php echo esc_attr($settings['badge_position']); ?>">
                <span class="tmt-badge tmt-padding-small"><?php echo esc_html($settings['badge_text']); ?></span>
            </div>
        <?php endif; ?>

        <?php
    }

    protected function _content_template() {
        ?>
        <#
        view.addRenderAttribute( 'description_text', 'class', 'tmt-advanced-icon-box-description' );

        view.addInlineEditingAttributes( 'title_text', 'none' );
        view.addInlineEditingAttributes( 'description_text' );

        view.addRenderAttribute( 'advanced-icon-box-title', 'class', 'tmt-advanced-icon-box-title' );
        view.addRenderAttribute( 'advanced-icon-box', 'class', 'tmt-advanced-icon-box' );

        iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
        migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );

        #>

        <div {{{ view.getRenderAttributeString( 'advanced-icon-box' ) }}}>

        <div class="tmt-advanced-icon-box-icon">
            <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon  && settings.icon_type == 'icon' )) { #>
            <span class="tmt-icon-wrapper">
						<# if ( settings.image.url && settings.icon_type == 'image' ) { #>
							<img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
						<# } else if ( settings.selected_icon  && settings.icon_type == 'icon' ) { #>
							<# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
								{{{ iconHTML.value }}}
							<# } else { #>
								<i class="{{ settings.icon }}" aria-hidden="true"></i>
							<# } #>
						<# } #>
					</span>
            <# } #>
        </div>

        <div class="tmt-advanced-icon-box-content">
            <{{{ settings.title_size }}} {{{ view.getRenderAttributeString( 'advanced-icon-box-title' ) }}}>
            <span {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</span>
            </{{{ settings.title_size }}}>

        <# if ( 'yes' == settings.show_separator) { #>
        <# if ( 'line' == settings.title_separator_type ) { #>
        <div class="tmt-title-separator-wrapper">
            <div class="tmt-title-separator"></div>
        </div>
        <# } else if ( 'line' != settings.title_separator_type ) { #>
        <div class="tmt-title-separator-wrapper">
            <# if (settings.title_separator_type == 'bloomstar') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 221.15 21.95"><path d="M0 3.6c4.12 1.17 8.26 2.26 12.44 3.13a142.02 142.02 0 0 0 12.61 2.19c8.46 1.1 16.98 1.48 25.5 1.1l25.68-.74 12.85.02 12.84.36-25.67.77-12.82.5-12.83.57c-8.58.26-17.23-.1-25.72-1.45-4.24-.7-8.46-1.55-12.6-2.62C8.13 6.32 4.02 5.08 0 3.6z"/><path d="M83.17 10.16s-1.53 2.92-4.52 5.07c-3.9 2.8-9.64 5.27-9.74 4.4-.16-1.3 3.3-4.84 6.55-6.7 2.4-1.36 7.14-3.05 7.7-2.8zm-9.03-.56s-3.9.76-7.6-.2c-4.82-1.25-10.1-3.84-9.62-4.6.44-.72 6.75.2 10.3 1.5 2.62.98 6.82 2.74 6.9 3.3zm43-4.73c-.25-.43-1 .36-2.63 1.25-1.8.97-3.26 1.82-3.7 2.35a.92.92 0 0 1 .3.32c.26.46.05 1.02-.47 1.25s-1.14.04-1.4-.42-.05-1.02.47-1.25c.33-.15.7-.12 1 .03.95-1.23 1.86-6.38.97-6.63-.52-.14-.42.9-.87 2.54-.4 1.48-.7 2.76-.76 3.55-.38-1.8-2.6-5.72-3.42-5.5-.52.14.23.94.93 2.52.62 1.4 1.2 2.63 1.66 3.3-1.47-1.28-5.82-3.35-6.34-2.75-.33.38.8.65 2.4 1.6l3.5 1.85c-2.04-.3-6.93.22-6.97.98-.02.48 1.07.13 2.98.1l4.05-.26c-1.86.8-5.53 3.72-5.07 4.36.3.4.96-.44 2.5-1.45l3.15-2.28c-1 1.6-2.14 5.87-1.34 6.16.5.18.5-.85 1.1-2.46.55-1.44.98-2.7 1.1-3.48.2 1.83 2.04 5.9 2.87 5.73.53-.1-.14-.95-.68-2.58-.48-1.46-.93-2.7-1.33-3.4 1.34 1.4 5.47 3.8 6.05 3.23.36-.35-.73-.7-2.22-1.77l-3.3-2.12c2 .46 6.93.32 7.04-.44.07-.48-1.05-.2-2.96-.32l-4.06-.05c1.9-.63 5.86-3.26 5.46-3.94zM102.6 7.9s-4.66.58-8.12-.9c-4.52-1.94-9.24-5.27-8.64-5.95.57-.64 6.62 1.17 9.9 3 2.4 1.34 6.9 3.3 6.87 3.85zm-58.88 3.12s-2.7 2.63-6.32 3.75c-4.74 1.47-11.08 2.05-10.84 1.2.35-1.28 4.95-3.55 8.72-4.3 2.77-.56 8-1.06 8.44-.64zM16.14 3.6s3.16.04 5.75 1.3c3.4 1.66 7.13 4.15 6.6 4.64-.5.46-5.42-.92-7.83-2.45-1.8-1.12-4.6-3.07-4.52-3.5zm86.46 8.94s-1.14 3.54-3.36 5.14c-2.9 2.1-7.18 3.93-7.26 3.28-.12-.98 2.46-3.6 4.88-4.98 1.8-1 5.32-3.63 5.74-3.44zM221.15 3.6c-4.02 1.5-8.13 2.73-12.27 3.84a142.99 142.99 0 0 1-12.6 2.62c-8.5 1.37-17.14 1.72-25.72 1.45l-12.83-.57-12.82-.5-25.67-.77 12.84-.36h12.85c8.57.05 17.14.5 25.68.74 8.53.4 17.05.02 25.5-1.1a142.02 142.02 0 0 0 12.61-2.19c4.18-.88 8.3-1.97 12.43-3.14z"/><path d="M138.23 10.27s1.28 2.8 4.27 4.96c3.9 2.8 9.64 5.27 9.74 4.4.16-1.3-3.3-4.84-6.55-6.7-2.4-1.36-6.9-2.94-7.46-2.68zm8.8-.67s3.9.76 7.6-.2c4.82-1.25 10.1-3.84 9.62-4.6-.44-.72-6.75.2-10.3 1.5-2.63.98-6.83 2.74-6.9 3.3zM117.8 7.54s5.42.95 8.88-.53c4.52-1.94 9.24-5.27 8.64-5.95-.57-.64-6.62 1.17-9.9 3-2.4 1.34-7.65 2.9-7.63 3.48zm59.63 3.48s2.7 2.63 6.32 3.75c4.74 1.47 11.08 2.05 10.84 1.2-.35-1.28-4.96-3.55-8.72-4.3-2.77-.56-8-1.06-8.44-.64zm27.6-7.42s-3.16.04-5.75 1.3c-3.4 1.66-6.82 4.07-6.3 4.56.5.46 5.1-.85 7.52-2.37 1.78-1.12 4.58-3.07 4.52-3.5zm-86.46 8.56s1.14 3.92 3.36 5.52c2.9 2.1 7.18 3.93 7.26 3.28.12-.98-2.46-3.6-4.88-4.98-1.8-1-5.32-4-5.74-3.82z"/></svg>
            <# } else if (settings.title_separator_type == 'bobbleaf') { #>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 211.05 20.49"><path d="M0 12.9c3.5-2.88 7.23-5.47 11.23-7.64 4-2.14 8.3-3.83 12.84-4.64 2.26-.42 4.56-.6 6.86-.57 2.3.02 4.6.27 6.85.7 4.5.88 8.85 2.26 13.12 3.8 4.26 1.57 8.45 3.3 12.6 5.1 4.17 1.78 8.22 3.8 12.5 5.07 4.28 1.26 8.76 1.9 13.25 2.1 4.5.26 9 .04 13.5-.4-8.9 1.52-18.18 1.7-27.07-.6-4.47-1.15-8.55-3.22-12.7-4.92-4.16-1.75-8.35-3.43-12.58-4.95-4.22-1.56-8.5-2.97-12.87-3.86-4.36-.9-8.86-.97-13.26-.34a39.37 39.37 0 0 0-6.49 1.58c-2.1.74-4.2 1.57-6.2 2.58C7.5 7.84 3.7 10.3 0 12.9z"/><path d="M71.12 13.27c1.93 0 1.93-3 0-3-1.94 0-1.94 3 0 3z"/><path d="M73.83 13.9c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-3.2 3.04c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-2.98-.48c1.93 0 1.93-3 0-3s-1.94 3 0 3zm6.5-10.38c.6.6 1.05 1.28 1.46 1.96.42.68.76 1.4 1.07 2.12a16.13 16.13 0 0 1 .77 2.25c.2.77.36 1.56.38 2.42-.6-.6-1.05-1.28-1.46-1.96-.42-.68-.76-1.4-1.07-2.13-.3-.73-.57-1.48-.76-2.25-.22-.77-.37-1.56-.4-2.4z"/><path d="M67.88 17.66c.76-.38 1.53-.62 2.3-.8.78-.2 1.56-.3 2.35-.4.8-.07 1.58-.1 2.38-.06s1.6.13 2.42.36c-.76.38-1.53.62-2.3.8-.78.2-1.56.3-2.35.38a15.74 15.74 0 0 1-2.38.05c-.8-.01-1.6-.1-2.42-.34z"/><use xlink:href="#B"/><use xlink:href="#B" x="-4" y="1.19"/><use xlink:href="#B" x="-7.23" y="4.1"/><path d="M74.28 20.6c.65-.55 1.34-.96 2.05-1.32.7-.37 1.44-.67 2.2-.93a16.24 16.24 0 0 1 2.3-.62c.78-.15 1.58-.26 2.43-.22-.65.55-1.34.97-2.05 1.33-.7.37-1.44.67-2.2.93-.75.25-1.5.47-2.3.62-.78.14-1.58.25-2.43.2zm4.55-12c.72.45 1.32 1 1.88 1.56.57.57 1.07 1.18 1.54 1.8a17.4 17.4 0 0 1 1.28 2c.38.7.72 1.43.94 2.26-.72-.45-1.32-1-1.88-1.56-.57-.57-1.07-1.18-1.54-1.8a17.4 17.4 0 0 1-1.28-2c-.38-.7-.72-1.44-.94-2.26zm132.22 4.3c-3.7-2.6-7.5-5.06-11.57-7-2-1-4.1-1.84-6.2-2.58-2.12-.7-4.3-1.24-6.5-1.58-4.4-.63-8.9-.57-13.26.34-4.37.9-8.65 2.3-12.87 3.86-4.24 1.52-8.43 3.2-12.58 4.95-4.16 1.7-8.24 3.77-12.7 4.92-8.9 2.3-18.18 2.12-27.07.6 4.5.45 9.02.67 13.5.4 4.5-.22 8.97-.85 13.25-2.1 4.27-1.28 8.3-3.28 12.5-5.07 4.16-1.8 8.35-3.53 12.6-5.1 4.27-1.53 8.62-2.92 13.12-3.8 2.25-.44 4.56-.7 6.85-.7 2.3-.04 4.6.15 6.86.57 4.53.82 8.83 2.5 12.84 4.64 3.98 2.17 7.73 4.76 11.22 7.64z"/><use xlink:href="#B" x="67.33" y="2.82"/><use xlink:href="#B" x="64.62" y="3.45"/><use xlink:href="#B" x="67.8" y="6.49"/><use xlink:href="#B" x="70.8" y="6.01"/><path d="M136.9 6.08c-.02.85-.18 1.64-.38 2.4-.2.78-.46 1.52-.76 2.25s-.65 1.44-1.07 2.13c-.4.7-.86 1.35-1.46 1.96.02-.85.17-1.64.38-2.42.2-.78.46-1.52.77-2.25s.66-1.44 1.07-2.12c.4-.7.86-1.35 1.45-1.96zm6.27 11.58c-.82.24-1.62.32-2.42.36a15.74 15.74 0 0 1-2.38-.05 16.92 16.92 0 0 1-2.35-.38c-.78-.18-1.55-.42-2.3-.8.82-.24 1.62-.33 2.42-.36.8-.05 1.6-.02 2.38.06s1.57.2 2.35.4c.78.17 1.55.4 2.3.78z"/><use xlink:href="#B" x="65.84"/><path d="M142.46 11.64c1.93 0 1.93-3 0-3s-1.94 3 0 3zm3.22 2.9c1.93 0 1.93-3 0-3s-1.94 3 0 3zm-8.92 6.05c-.85.04-1.65-.07-2.43-.22a14.7 14.7 0 0 1-2.3-.62 16.85 16.85 0 0 1-2.2-.93c-.7-.36-1.4-.77-2.05-1.33.85-.04 1.65.07 2.43.22a16.24 16.24 0 0 1 2.3.62 16.85 16.85 0 0 1 2.2.93c.72.37 1.4.78 2.05 1.33zm-4.54-12c-.22.82-.56 1.55-.94 2.26a14.44 14.44 0 0 1-1.28 2 15.66 15.66 0 0 1-1.54 1.81c-.56.57-1.16 1.1-1.88 1.56.22-.82.56-1.56.94-2.26a14.44 14.44 0 0 1 1.28-2c.47-.63.98-1.24 1.54-1.8s1.16-1.1 1.88-1.56z"/><defs ><path id="B" d="M72.6 10.45c1.93 0 1.93-3 0-3s-1.93 3 0 3z"/></defs></svg>
            <# } else if (settings.title_separator_type == 'sarator') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.5 28.7"><path d="M285.3 18.3c-3.5 2.7-7.7.2-10.2-1.7-2.6-2-5.7-3.3-8.8-3.4-11.4-.4-12.7 12.4-12.7 12.4s7.3-12.1 15.9-7.9c0 0 6 2.6 7 10.4 0 0 1.9-3.7-.4-7.2 2.1 1 5.7 2 9.2-2.6zm-68.4 0c3.5 2.7 7.7.2 10.2-1.7 2.6-2 5.7-3.3 8.8-3.4 11.4-.4 12.7 12.4 12.7 12.4s-7.3-12.1-15.9-7.9c0 0-6 2.6-7 10.4 0 0-1.9-3.7.4-7.2-2.1 1-5.7 2-9.2-2.6zm44.8-7.8c-4-.8-7.7 4.2-9.9 8.2-.3.5-.5.9-.7 1.4-.2-.4-.5-.9-.7-1.4-2.2-4-5.9-9-9.9-8.2 3.1-4.9 8-2.3 10.7 5.6 2.5-8 7.4-10.5 10.5-5.6zm-12.2-4.8c-.5-2.4 1.6-5.7 1.6-5.7s2 3.3 1.6 5.7a1.62 1.62 0 0 1-3.2 0zm35.9 20.2c22.9 3.2 46.7 3.6 69.7 1.8 9.3-.7 18.7-1.8 27.9-3.6 9.8-1.9 19.2-4.7 28.7-7.8 16.2-5.2 33.4-9 50.5-8.3 5.8.3 12.9.7 18.2 3.5.9.4 1.6-.8.8-1.3-4.1-2.2-9.2-2.9-13.8-3.4-14.7-1.6-29.7.8-43.9 4.4-10.2 2.6-19.9 6.4-30.1 9-9.5 2.4-19.3 4-29 5-17.1 1.9-34.4 2.1-51.5 1.3-8.9-.4-18.2-1-26.9-2.3-1.2.2-1.6 1.6-.6 1.7zm-66.6-1.4c-23.3 3.3-48 3.6-71.6 1.6-9.8-.8-19.5-2.1-29.1-4.1-10-2.1-19.5-5.5-29.3-8.4C73.5 9 57.2 5.8 41.1 6.7c-5.7.3-12.4.9-17.6 3.7-.9.5-.1 1.7.8 1.3 4.2-2.2 9.7-2.9 14.4-3.3C54.2 7 70 9.9 84.9 14.1c10 2.8 19.6 6.5 29.7 8.8 9.2 2.1 18.6 3.5 27.9 4.4 16.9 1.7 34 1.9 50.9 1 8.6-.4 17.2-1 25.6-2.2 1.1-.2.7-1.7-.2-1.6zM10.5 1.7c-.8 4 4.2 7.6 8.2 9.9.5.3 1 .5 1.4.7-.4.2-.9.5-1.4.7-4 2.2-9 5.9-8.2 9.9-4.9-3.1-2.3-8 5.6-10.6C8.2 9.7 5.6 4.8 10.5 1.7zM5.7 13.9c-2.4.4-5.7-1.6-5.7-1.6s3.3-2 5.7-1.6a1.62 1.62 0 0 1 0 3.2zM494 1.7c.8 4-4.2 7.6-8.2 9.9-.5.3-1 .5-1.4.7.4.2.9.5 1.4.7 4 2.2 9 5.9 8.2 9.9 4.9-3.1 2.3-8-5.6-10.6 8-2.6 10.5-7.5 5.6-10.6zm4.8 12.2c2.4.5 5.7-1.6 5.7-1.6s-3.3-2-5.7-1.6a1.62 1.62 0 0 0 0 3.2z"/></svg>
            <# } else if (settings.title_separator_type == 'separk') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 214.44 13.32"><path d="M0 2.4c9.5 2.78 19.37 4.14 29.2 4.1 4.92.1 9.83-.08 14.7-.7 2.44-.3 4.87-.7 7.32-1.1l7.36-1.07c9.83-1.3 19.72-2.36 29.7-2.28 1.25.02 2.5.03 3.74.12l1.87.1 1.87.18c1.25.1 2.5.35 3.73.52 1.23.3 2.48.5 3.7.93 1.22.33 2.43.93 3.54 1.5L110 6.48c1.1.6 2.18 1.24 3.23 2 .53.38 1.05.78 1.53 1.35.23.3.5.62.6 1.2a1.46 1.46 0 0 1-.15.89c-.14.28-.34.46-.52.6-.74.5-1.4.62-2.05.76-.65.1-1.28.2-1.95.23-.67.02-1.35.02-2.1-.22-.38-.14-.82-.36-1.12-.8-.3-.45-.36-1-.3-1.4.13-.84.5-1.43.85-2 .36-.56.77-1.07 1.2-1.56.85-.97 1.76-1.85 2.72-2.67 1-.88 2.24-1.5 3.43-1.95 1.2-.47 2.43-.78 3.66-1.08 2.46-.56 4.94-.9 7.42-1.16 9.94-.94 19.9-.67 29.8.1 4.95.4 9.9 1 14.8 1.78a152.49 152.49 0 0 1 7.33 1.38 83.27 83.27 0 0 0 7.24 1.29c4.83.7 9.78.77 14.64.1 4.87-.67 9.65-2.06 14.16-4.1-8.75 4.68-19 6.5-28.98 5.5-2.5-.26-4.95-.8-7.37-1.3a162.68 162.68 0 0 0-7.26-1.36c-4.87-.78-9.77-1.36-14.68-1.77-9.82-.78-19.74-1.04-29.53-.12-2.44.25-4.87.6-7.24 1.13-2.34.57-4.74 1.24-6.45 2.7-.9.8-1.8 1.63-2.57 2.52-.4.45-.76.9-1.07 1.4-.3.47-.57 1-.62 1.38-.02.2 0 .3.05.37.04.07.17.16.37.23.42.13 1 .16 1.56.14.57-.02 1.17-.1 1.74-.2.55-.1 1.14-.27 1.42-.48.13-.12.08-.07.1-.1 0-.05-.1-.25-.26-.43-.32-.38-.78-.75-1.26-1.1-.96-.7-2.02-1.3-3.1-1.9L106 6.04c-1.1-.54-2.12-1.05-3.3-1.38-1.12-.4-2.33-.6-3.5-.88-1.2-.17-2.4-.42-3.62-.5l-1.8-.2-1.84-.1c-1.22-.08-2.45-.1-3.68-.1-9.84-.08-19.7.96-29.48 2.26l-7.34 1.06-7.37 1.1c-4.95.62-9.95.86-14.93.74-4.97-.22-9.92-.82-14.8-1.73C9.47 5.37 4.65 4.1 0 2.4z"/></svg>
            <# } else if (settings.title_separator_type == 'slash-line') { #>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 10.96"><g fill="none" stroke="#000" stroke-miterlimit="10"><path d="M8.54 1.94L1.46 9.02m12.08-7.08L6.46 9.02"/><use xlink:href="#B"/><use xlink:href="#B" x="5"/><use xlink:href="#B" x="10"/><use xlink:href="#B" x="15"/><use xlink:href="#B" x="20"/><use xlink:href="#B" x="25"/><use xlink:href="#B" x="30"/><use xlink:href="#B" x="35"/><use xlink:href="#B" x="40"/><use xlink:href="#B" x="45"/><use xlink:href="#B" x="50"/><use xlink:href="#B" x="55"/><use xlink:href="#B" x="60"/><use xlink:href="#B" x="65"/><use xlink:href="#B" x="70"/><use xlink:href="#B" x="75"/><use xlink:href="#B" x="80"/><use xlink:href="#B" x="85"/><use xlink:href="#B" x="90"/><use xlink:href="#B" x="95"/><use xlink:href="#B" x="100"/><use xlink:href="#B" x="105"/><use xlink:href="#B" x="110"/><use xlink:href="#B" x="115"/><use xlink:href="#B" x="120"/><use xlink:href="#B" x="125"/><use xlink:href="#B" x="130"/><use xlink:href="#B" x="135"/><use xlink:href="#B" x="140"/><use xlink:href="#B" x="145"/><use xlink:href="#B" x="150"/><use xlink:href="#B" x="155"/><use xlink:href="#B" x="160"/><use xlink:href="#B" x="165"/><use xlink:href="#B" x="170"/><use xlink:href="#B" x="175"/><use xlink:href="#B" x="180"/><use xlink:href="#B" x="185"/><use xlink:href="#B" x="190"/><use xlink:href="#B" x="195"/><use xlink:href="#B" x="200"/><use xlink:href="#B" x="205"/><use xlink:href="#B" x="210"/><use xlink:href="#B" x="215"/><use xlink:href="#B" x="220"/><use xlink:href="#B" x="225"/><use xlink:href="#B" x="230"/><use xlink:href="#B" x="235"/><use xlink:href="#B" x="240"/><use xlink:href="#B" x="245"/><use xlink:href="#B" x="250"/><use xlink:href="#B" x="255"/><use xlink:href="#B" x="260"/><use xlink:href="#B" x="265"/><use xlink:href="#B" x="270"/><use xlink:href="#B" x="275"/><use xlink:href="#B" x="280"/><use xlink:href="#B" x="285"/><use xlink:href="#B" x="290"/><use xlink:href="#B" x="295"/><use xlink:href="#B" x="300"/><use xlink:href="#B" x="305"/><use xlink:href="#B" x="310"/><use xlink:href="#B" x="315"/><use xlink:href="#B" x="320"/><use xlink:href="#B" x="325"/><use xlink:href="#B" x="330"/><use xlink:href="#B" x="335"/><use xlink:href="#B" x="340"/><use xlink:href="#B" x="345"/><use xlink:href="#B" x="350"/><use xlink:href="#B" x="355"/><use xlink:href="#B" x="360"/><use xlink:href="#B" x="365"/><use xlink:href="#B" x="370"/><use xlink:href="#B" x="375"/><use xlink:href="#B" x="380"/></g><defs ><path id="B" d="M18.54 1.94l-7.08 7.08"/></defs></svg>
            <# } else if (settings.title_separator_type == 'demaxa') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 211.6 27.87"><path d="M100.45 18a4.98 4.98 0 0 0 .79.56c1.1.68 1.77.1 1.74-.67-.01-.4-.2-.83-.5-1.27-.15-.22-.33-.43-.53-.64-.2-.2-.43-.38-.66-.56-.6-.45-1.24-.9-1.94-1.28l-2.1-1.12-2.2-1.04-2.26-.96c-3.07-1.18-6.32-1.94-9.44-2.34l-1.25-.16-2.5-.16c-1.98-.06-4.48.06-6.84.4l-2.44.47-1.9.5-2.88.95c-1.74.65-3.48 1.35-6.8 3l-6.5 3.45-6.5 3.32c-2.97 1.35-4.65 1.93-6.2 2.42a.77.77 0 0 0-.15.02c-.78.14-1.58.48-2.38.46a5.1 5.1 0 0 1-1.28-.21c-.42-.14-.63-.25-.82-.36-.2-.12-.4-.23-.72-.54-.32-.32-.44-.5-.55-.7a3.13 3.13 0 0 1-.34-.81c-.1-.43-.1-.64-.08-.85.03-.2.05-.43.2-.84.16-.4.28-.6.4-.78a1.78 1.78 0 0 1 .62-.62c.38-.22.6-.26.8-.3.2-.02.43-.04.85.05.4.1.58.24.73.37.14.13.3.27.43.66.1.4.03.6-.04.76-.1.17-.16.3-.45.5a1.17 1.17 0 0 1-.5.17c-.12.01-.24.01-.36-.04-.14.02-.3.04-.34.2s.1.37.35.47.57.1.8.06c.42-.08.8-.33 1.07-.7.15-.26.2-.46.22-.7s.02-.52-.1-.94a1.95 1.95 0 0 0-.63-.96 2.35 2.35 0 0 0-1-.5c-.55-.12-.83-.1-1.12-.1-.28.02-.6.05-1.1.34-.48.32-.66.56-.82.8-.15.24-.3.47-.52.98-.2.52-.24.8-.3 1.07a2.57 2.57 0 0 0 .06 1.14c.15.55.33.78.5 1s.35.43.73.82c.4.38.62.53.84.7.22.15.45.3.95.47l-3.46.64-7.15.68-2.93.02c-1.13-.03-2.48-.13-4.25-.4a29.81 29.81 0 0 1-4.13-.95c-1.06-.33-1.9-.66-2.7-1.02-.8-.35-1.6-.77-2.53-1.34A16.97 16.97 0 0 1 5.07 19a15.74 15.74 0 0 1-2.47-3.35c-.53-.96-.85-1.8-1.1-2.63-.26-.84-.43-1.7-.48-2.8a6.02 6.02 0 0 1 0-.85l.02-.47.06-.5c.07-.68.25-1.43.57-2.24C2.32 4.54 3.18 3.5 4 2.8a6.33 6.33 0 0 1 2.4-1.32 5.38 5.38 0 0 1 2.64-.1c1 .2 2.23.68 3.25 1.86.33.42.56.85.7 1.26.1.43.17.8.1 1.14-.1.68-.4 1.22-.74 1.6-.35.4-.75.68-1.18.84-.42.15-.88.2-1.23.02l-.2.02c-.05 0-.1.04-.15.05a.5.5 0 0 0-.14.12c-.04.05-.1.1-.14.16-.2.28-.5.8-.48 1.47.03.63.5 1.2 1.27 1.33.77.15 1.74-.13 2.53-.7s1.43-1.43 1.82-2.34.54-1.88.46-2.7c-.1-1.54-.9-2.88-2-3.8-.54-.48-1.17-.83-1.8-1.1C10.46.3 9.78.1 9.08.04c-.92-.1-1.7-.01-2.44.18a7.59 7.59 0 0 0-2.05.89 8.77 8.77 0 0 0-1.98 1.7c-.65.76-1.3 1.73-1.85 3.05C.4 6.75.2 7.58.12 8.32c-.07.36-.1.72-.1 1.05-.03.33-.02.64-.01.94a13.39 13.39 0 0 0 .44 3.06 14.11 14.11 0 0 0 1.1 2.88c.54 1.05 1.27 2.3 2.55 3.7a20.93 20.93 0 0 0 3.4 2.96c.98.67 1.8 1.17 2.65 1.6s1.72.85 2.84 1.24a25.79 25.79 0 0 0 4.37 1.11 34.92 34.92 0 0 0 4.46.44h3.05c1.87-.1 3.75-.18 7.45-.76l7.3-1.66c1.8-.53 3.6-1.12 6.95-2.77L53 18.45l6.34-3.7c3.23-1.7 4.93-2.38 6.63-3l2.8-.9 1.83-.47 2.36-.45c3.58-.52 5.4-.4 7.2-.34l2.92.3 1.86.3 2.34.53c1.52.38 2.66.82 3.64 1.15l2.45 1.04c.7.36 1.4.66 2.1 1.13s1.5.98 2.4 1.8l.9.74.84.75.83.65zm-1.48 8.08c.35-.9.32-1.56.2-2.3-.14-.74-.48-1.6-1.33-2.6-.58-.66-1.08-1.05-1.5-1.37l-1.1-.76-.52-.35-1.34-.78-.97-.5-2.96-1.4c-.37-.18-.76-.33-1.24-.5l-.82-.27-1.06-.26c-.8-.18-1.4-.25-1.92-.33l-1.33-.1c-.4-.04-.82-.03-1.32-.06l-1.93-.05H77.9l-1.32.02c-.8.03-1.63.05-3.24.32-1.6.3-2.38.54-3.15.78l-3.07 1-3.04 1.06-2.96 1.24-2.87 1.43-2.8 1.55-4.5 2.76-1.63 1.08c-1 .63-.13.08.73-.4l7.3-3.8 4.14-1.8 2.95-1.14 3-.98 3.05-.77 1.25-.25 1.84-.3 3.1-.28 1.27-.04 1.85.03 1.84.1 1.26.06 1.26.1 1.82.34 1 .25.78.24 1.2.42 2.82 1.25.9.47.7.4 1.06.67c.62.44 1.34.84 2.3 1.9.46.53.68 1 .77 1.36a2.67 2.67 0 0 1 .07.99c-.04.3-.12.58-.27.85-.15.28-.4.55-.8.7a1.73 1.73 0 0 1-.9.04c-.28-.06-.52-.14-.72-.24-.4-.2-.73-.45-1.03-.84l-.5-.36c-.16-.07-.3-.07-.43.08-.24.28-.15 1 .35 1.66a3.76 3.76 0 0 0 2.02 1.33c.65.18 1.4.18 2.1-.12s1.27-.87 1.6-1.53zm12.2-8.08a5.41 5.41 0 0 1-.78.56c-1.1.68-1.77.1-1.74-.67.01-.4.2-.83.5-1.27.15-.22.33-.43.53-.64.2-.2.43-.38.66-.56.6-.45 1.24-.9 1.94-1.28l2.1-1.12 2.2-1.04 2.26-.96c3.07-1.18 6.32-1.94 9.44-2.34l1.25-.16 2.5-.16c1.98-.06 4.48.06 6.84.4l2.44.47 1.9.5 2.88.95c1.74.65 3.48 1.35 6.8 3l6.5 3.45 6.5 3.32c2.97 1.35 4.65 1.93 6.2 2.42a.77.77 0 0 1 .15.02c.78.14 1.58.48 2.38.46a5.1 5.1 0 0 0 1.28-.21c.42-.14.63-.25.82-.36.2-.12.4-.23.72-.54.32-.32.44-.5.55-.7a3.13 3.13 0 0 0 .34-.81c.1-.43.1-.64.08-.85-.03-.2-.05-.43-.2-.84-.16-.4-.28-.6-.4-.78a1.78 1.78 0 0 0-.62-.62c-.38-.22-.6-.26-.8-.3-.2-.02-.43-.04-.85.05-.4.1-.58.24-.73.37-.14.13-.3.27-.43.66-.1.4-.03.6.04.76.1.17.16.3.45.5a1.17 1.17 0 0 0 .5.17c.12.01.24.01.36-.04.14.02.3.04.34.2s-.1.37-.35.47-.57.1-.8.06c-.42-.08-.8-.33-1.07-.7-.14-.26-.2-.46-.2-.7s-.02-.52.1-.94a1.95 1.95 0 0 1 .63-.96 2.35 2.35 0 0 1 1-.5c.55-.12.83-.1 1.12-.1.28.02.6.05 1.1.34.48.32.66.56.82.8.15.24.3.47.52.98.2.52.24.8.3 1.07a2.57 2.57 0 0 1-.06 1.14c-.15.55-.33.78-.5 1s-.35.43-.73.82c-.4.38-.62.53-.84.7-.22.15-.45.3-.95.47l3.46.64 7.15.68 2.93.02c1.13-.03 2.48-.13 4.25-.4a29.81 29.81 0 0 0 4.13-.95c1.06-.33 1.9-.66 2.7-1.02.8-.35 1.6-.77 2.53-1.34a16.92 16.92 0 0 0 3.24-2.6 15.74 15.74 0 0 0 2.47-3.35c.53-.96.85-1.8 1.1-2.63.26-.84.43-1.7.48-2.8.02-.27.02-.56 0-.86l-.02-.47-.06-.5c-.07-.68-.25-1.43-.57-2.24-.65-1.62-1.52-2.66-2.33-3.35a6.33 6.33 0 0 0-2.4-1.32 5.38 5.38 0 0 0-2.64-.1c-1 .2-2.23.68-3.25 1.86a4.04 4.04 0 0 0-.7 1.27c-.1.43-.17.8-.1 1.14.1.68.4 1.22.74 1.6.35.4.75.68 1.18.84.42.15.88.2 1.23.02l.18.02c.05 0 .1.04.15.05a.5.5 0 0 1 .14.12c.04.05.1.1.14.16.2.28.5.8.48 1.47-.03.63-.5 1.2-1.27 1.33-.77.15-1.74-.13-2.53-.7s-1.43-1.43-1.82-2.34-.54-1.88-.46-2.7c.13-1.54.93-2.88 2.02-3.82.54-.48 1.17-.83 1.8-1.1.65-.28 1.33-.46 2.03-.54.92-.1 1.7-.01 2.44.18.73.2 1.4.48 2.04.9a8.77 8.77 0 0 1 1.98 1.7c.65.76 1.32 1.73 1.85 3.05.35.9.56 1.72.65 2.46.07.37.1.72.1 1.05.03.33.02.65.01.94a13.39 13.39 0 0 1-.44 3.06 14.11 14.11 0 0 1-1.1 2.88c-.54 1.05-1.27 2.3-2.55 3.7a20.93 20.93 0 0 1-3.4 2.96c-.98.67-1.8 1.17-2.65 1.6s-1.72.85-2.84 1.24a25.79 25.79 0 0 1-4.37 1.11 34.92 34.92 0 0 1-4.46.44c-1.17.05-2.1.03-3.05-.01-1.87-.1-3.75-.18-7.45-.76L172 24.9c-1.8-.53-3.6-1.12-6.95-2.77l-6.44-3.66-6.34-3.7c-3.23-1.7-4.93-2.38-6.63-3l-2.8-.9-1.83-.47-2.36-.45c-3.58-.52-5.4-.4-7.2-.34l-2.92.3-1.86.3-2.34.53c-1.52.38-2.66.82-3.64 1.15l-2.45 1.04c-.7.36-1.4.66-2.1 1.13s-1.5.98-2.4 1.8l-.9.74-.84.75-.85.65zm1.5 8.08c-.35-.9-.32-1.56-.2-2.3.14-.74.48-1.6 1.33-2.6.58-.66 1.08-1.05 1.5-1.37l1.1-.76.52-.35.6-.35.74-.43.97-.5 2.96-1.4c.37-.18.76-.33 1.24-.5l.82-.27 1.06-.26c.8-.18 1.4-.25 1.92-.33l1.33-.1c.4-.04.82-.03 1.32-.06l1.93-.05h1.93l1.32.02c.8.03 1.63.05 3.24.32 1.6.3 2.38.54 3.15.78l3.07 1 3.04 1.06 2.96 1.24 2.87 1.43 2.8 1.55 4.5 2.76 1.63 1.08c1 .63.13.08-.73-.4l-7.3-3.8-4.14-1.8-2.95-1.14-3-.98-3.05-.77-1.25-.25-1.84-.3-3.1-.28-1.27-.04-1.85.03-3.1.15-1.26.1-1.82.34-1 .25-.78.24-1.2.42-2.82 1.25-.9.47-.7.4-1.06.67c-.62.44-1.34.84-2.3 1.9-.46.53-.68 1-.77 1.36a2.67 2.67 0 0 0-.07.99c.04.3.12.58.27.85.15.28.4.55.8.7a1.73 1.73 0 0 0 .9.04c.28-.06.52-.14.72-.24.4-.2.73-.45 1.03-.84l.5-.36c.16-.07.3-.07.43.08.24.28.15 1-.35 1.66a3.76 3.76 0 0 1-2.02 1.33c-.65.18-1.4.18-2.1-.12-.72-.3-1.28-.87-1.6-1.53z"/></svg>
            <# } else if (settings.title_separator_type == 'fill-circle') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 13.48"><ellipse cx="213.6" cy="6.74" rx="4.33" ry="4.32"/><ellipse cx="226.58" cy="6.74" rx="4.13" ry="4.12"/><ellipse cx="239.16" cy="6.74" rx="3.94" ry="3.93"/><circle cx="251.36" cy="6.74" r="3.74"/><ellipse cx="263.18" cy="6.74" rx="3.55" ry="3.54"/><ellipse cx="274.6" cy="6.74" rx="3.36" ry="3.35"/><circle cx="285.64" cy="6.74" r="3.16"/><ellipse cx="296.29" cy="6.74" rx="2.97" ry="2.96"/><ellipse cx="306.53" cy="6.74" rx="2.78" ry="2.77"/><circle cx="316.41" cy="6.74" r="2.58"/><ellipse cx="325.9" cy="6.74" rx="2.39" ry="2.38"/><circle cx="335" cy="6.74" r="2.19"/><circle cx="343.71" cy="6.74" r="2"/><ellipse cx="352.04" cy="6.74" rx="1.81" ry="1.8"/><circle cx="359.98" cy="6.74" r="1.61"/><circle cx="367.53" cy="6.74" r="1.42"/><ellipse cx="374.7" cy="6.74" rx="1.23" ry="1.22"/><circle cx="381.48" cy="6.74" r="1.03"/><circle cx="387.87" cy="6.74" r=".84"/><circle cx="393.87" cy="6.74" r=".65"/><circle cx="399.49" cy="6.74" r=".45"/><ellipse cx="199.76" cy="6.74" rx="4.52" ry="4.51"/><ellipse cx="186.4" cy="6.74" rx="4.33" ry="4.32"/><ellipse cx="173.42" cy="6.74" rx="4.13" ry="4.12"/><ellipse cx="160.84" cy="6.74" rx="3.94" ry="3.93"/><circle cx="148.64" cy="6.74" r="3.74"/><ellipse cx="136.82" cy="6.74" rx="3.55" ry="3.54"/><ellipse cx="125.4" cy="6.74" rx="3.36" ry="3.35"/><circle cx="114.36" cy="6.74" r="3.16"/><ellipse cx="103.71" cy="6.74" rx="2.97" ry="2.96"/><ellipse cx="93.47" cy="6.74" rx="2.78" ry="2.77"/><circle cx="83.59" cy="6.74" r="2.58"/><ellipse cx="74.1" cy="6.74" rx="2.39" ry="2.38"/><circle cx="65" cy="6.74" r="2.19"/><circle cx="56.29" cy="6.74" r="2"/><ellipse cx="47.96" cy="6.74" rx="1.81" ry="1.8"/><circle cx="40.02" cy="6.74" r="1.61"/><circle cx="32.47" cy="6.74" r="1.42"/><ellipse cx="25.3" cy="6.74" rx="1.23" ry="1.22"/><circle cx="18.52" cy="6.74" r="1.03"/><circle cx="12.13" cy="6.74" r=".84"/><circle cx="6.13" cy="6.74" r=".65"/><circle cx=".51" cy="6.74" r=".45"/></svg>
            <# } else if (settings.title_separator_type == 'finalio') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 204.45 23.85"><path d="M95.1 1.6L92.47.9c-1-.25-2.25-.46-3.9-.64L84.6.01c-1.04.02-1.88-.03-2.7.01L79.2.2l-1.73.2-2.17.4c-3.25.7-4.8 1.3-6.36 1.84L62.8 5.02l-6.07 2.46-3.1 1.28c-.25.07-.53.16-.95.32l-1.5.74-.44.2-5.94 2.6-2.44.98-3.64 1.22c-3.1.9-4.7 1.15-6.3 1.4l-2.6.3c-1 .1-2.2.16-3.8.18l-3.37-.17.23-.13c.5-.32.68-.6.85-.84.15-.26.3-.54.38-1.13.05-.58-.02-.87-.07-1.15-.07-.28-.14-.56-.4-1.05a3.98 3.98 0 0 0-.7-.9c-.2-.2-.4-.4-.92-.66a2.59 2.59 0 0 0-1.1-.3c-.3 0-.58-.02-1.15.12-.57.18-.8.4-1.02.57-.2.2-.44.4-.65.97-.2.58-.12.92-.04 1.2a1.66 1.66 0 0 0 .77.99c.54.3.86.33 1.17.36.16.01.32 0 .53-.06.2-.06.46-.16.7-.44.32-.38.4-.8.28-1.18-.04-.1-.1-.18-.16-.26s-.2-.17-.3-.2c-.23-.06-.42-.03-.63.08-.2.14-.26.44-.18.56.07.12.15.1.22.02a.25.25 0 0 1 .37-.03c-.03.02 0 .1-.05.22-.1.2-.27.38-.52.43-.15.06-.28.1-.44.1s-.37-.02-.63-.18c-.34-.23-.4-.42-.47-.6-.05-.2-.1-.4.03-.82.16-.4.35-.55.52-.68.18-.1.36-.24.73-.35.4-.1.62-.1.83-.1.22.02.45.04.85.24.4.22.56.4.7.57.14.18.27.35.5.73l.38.8c.07.2.15.43.1.87-.06.43-.2.62-.3.78-.14.16-.26.32-.62.54-.36.2-.6.26-.8.3-.22.04-.44.08-.9.05-.8-.08-.9-.13-1.53-.3-.22-.03-.44-.06-.63-.03-.13.02-.2.07-.2.13-1.23-.27-2.67-.65-4.87-1.47-2.58-1-3.97-1.75-5.2-2.45-.62-.33-1.17-.7-1.78-1.15l-.95-.76c-.32-.3-.7-.6-1.05-1C3.5 8 2.6 7 1.7 6.4.72 5.78.05 6.33 0 7.07c-.05.75.54 1.67 1.34 2.32.5.45 1.07.84 1.66 1.22.58.4 1.2.73 1.8 1.1l3.8 2.06c2.63 1.27 5.42 2.22 8.12 2.9a16.43 16.43 0 0 0 1.08.26l2.18.42c1.73.3 3.94.53 6.05.5l3.92-.2c1.03-.07 1.84-.22 2.66-.32l2.64-.46 3.8-.9 3.75-1.1 2.53-.85 6.13-2.32 5.26-2.15c.22.07.47.16.82.4.46.32.62.57.78.8.14.24.3.5.42 1.03.1.55.01.82-.06 1.06-.1.24-.2.5-.6.9-.42.4-.67.57-.9.74-.25.15-.5.33-1.08.43-.57.08-.86-.01-1.1-.1a2.04 2.04 0 0 1-.88-.63c-.34-.43-.38-.7-.4-.95a1.06 1.06 0 0 1 .04-.39c.04-.14.13-.32.3-.5.38-.36.7-.37.9-.36.1.02.22.04.33.1.1.06.24.16.3.3.07.17.01.25-.1.37-.1.1-.26.2-.47.3-.18.15-.3.3-.17.43.12.13.4.15.7.06.3-.08.67-.33.8-.68a1.06 1.06 0 0 0-.09-.95 1.47 1.47 0 0 0-.68-.58c-.37-.13-.66-.1-.96-.04-.3.1-.65.2-1.05.6-.52.55-.55 1.04-.53 1.4.04.37.1.78.57 1.34.5.54.83.7 1.16.87.35.14.72.27 1.46.17.72-.13 1.03-.33 1.33-.5.3-.2.6-.38 1.1-.86a3.63 3.63 0 0 0 .82-1.2c.13-.35.26-.75.13-1.48-.15-.73-.4-1.03-.6-1.32-.23-.28-.46-.57-1.05-.97l-.25-.15 5.82-2.33 1.78-.68c1.26-.23 2.56-.36 3.8-.25a12.36 12.36 0 0 1 1.5.22 15.01 15.01 0 0 1 2.66.81c1.4.58 2.02 1.02 2.64 1.44.6.44 1.22.9 2.2 2.03.94 1.17 1.22 1.86 1.47 2.52.12.33.2.67.25 1.1a5.57 5.57 0 0 1-.04 1.66c-.26 1.4-.68 2.04-1.05 2.65a9.83 9.83 0 0 1-.7.93 8 8 0 0 1-1.27 1.16c-1.2.84-1.88 1.12-2.56 1.4-.7.25-1.42.52-2.9.46-1.48-.12-2.18-.43-2.75-.78a3.22 3.22 0 0 1-.8-.7c-.24-.32-.52-.75-.68-1.4a3.96 3.96 0 0 1-.05-1.59 4.61 4.61 0 0 1 .34-1.03c.15-.3.35-.6.64-.9a4.74 4.74 0 0 1 1.32-.99 4.3 4.3 0 0 1 1.59-.47c.42-.04.76.01 1.08.08.3.08.6.2.9.38.28.2.54.45.65.93.07.34.02.66-.07.88a1.28 1.28 0 0 1-.33.5 1.5 1.5 0 0 1-1.04.4c-.4.14-.8.15-.76.55.04.37.7.8 1.58.67.42-.05.87-.23 1.24-.52a2.86 2.86 0 0 0 .8-1.04 2.95 2.95 0 0 0 .1-2.13c-.22-.72-.76-1.33-1.37-1.7-.84-.43-1.48-.47-2.2-.46-.73.04-1.58.16-2.77.74A5.63 5.63 0 0 0 67.05 15a5.6 5.6 0 0 0-.84 1.2c-.2.4-.36.85-.46 1.4-.1.56-.13 1.25.08 2.14.22.88.58 1.5.93 1.96a5.14 5.14 0 0 0 1.11 1.05c.78.5 1.63.93 3.4 1.07 1.77.06 2.63-.24 3.45-.5l1.3-.56a11.98 11.98 0 0 0 1.75-1.07 10.79 10.79 0 0 0 1.54-1.37 9.95 9.95 0 0 0 .9-1.1c.5-.72 1.04-1.48 1.38-3.26.15-.9.1-1.6 0-2.16a6.13 6.13 0 0 0-.42-1.42c-.37-.82-.78-1.6-1.85-2.93-1.1-1.3-1.77-1.84-2.43-2.38-.67-.5-1.36-1.05-2.94-1.7-1.6-.62-2.44-.77-3.28-.93l-.46-.07c1.34-.47 2.84-1 5.57-1.6l2.1-.4 1.66-.24c1-.16 1.8-.18 2.58-.26 1.6-.07 3.2-.2 6.34.08 1.57.17 2.74.36 3.7.6.97.18 1.72.44 2.47.66l.57.17.54.2 1.15.57a8.86 8.86 0 0 1 1.27.88c.43.36.9.82 1.22 1.4s.43 1.1.38 1.55c-.05.46-.2.85-.43 1.16-.46.64-1.1 1.08-1.7 1.4-.62.32-1.28.55-2.08.6-.4.01-.83-.02-1.27-.18-.4-.14-.86-.43-1.2-.9-.47-.63-.55-1.26-.45-1.7.05-.24.13-.37.26-.53.12-.15.3-.27.46-.36a1.76 1.76 0 0 1 1.07-.22 1.03 1.03 0 0 1 .77.42l.73.76c0 .01 0 .02-.01.03-.02.07-.02.14.08.23.07.05.2.08.34.01.15-.06.28-.22.36-.43s.12-.46.04-.76a.96.96 0 0 0-.27-.44c-.08-.08-.2-.13-.3-.17-.23-.4-.6-.75-1.1-.93a3.09 3.09 0 0 0-1.65-.15c-.55.1-1.07.32-1.5.67a2.84 2.84 0 0 0-.92 1.3c-.25.7-.23 1.46-.03 2.13.2.68.57 1.28 1.05 1.8a4.38 4.38 0 0 0 1.77 1.13 5.04 5.04 0 0 0 2.03.24c.88-.1 1.58-.35 2.2-.66s1.17-.7 1.7-1.17c.52-.5 1.1-1.1 1.47-2.1.35-.96.33-2.35-.4-3.56-.48-.82-1.05-1.38-1.58-1.83-.53-.44-1.03-.8-1.5-1.05-.93-.52-1.78-.85-2.57-1.06zm14.26 0l2.62-.7c1-.25 2.25-.46 3.9-.64l3.95-.24 2.7.01 2.7.17 1.73.22 2.17.4c3.25.7 4.8 1.3 6.36 1.84l6.14 2.36 6.07 2.46 3.1 1.28c.25.07.53.16.95.32l1.5.74.44.2 5.94 2.6 2.44.98 3.64 1.22c3.1.9 4.7 1.15 6.3 1.4l2.6.3c1 .1 2.2.16 3.8.18l3.37-.17c-.08-.04-.16-.08-.23-.13-.5-.32-.68-.6-.85-.84-.15-.26-.3-.54-.38-1.13-.05-.58.02-.87.07-1.15.07-.28.14-.56.4-1.05a3.93 3.93 0 0 1 .7-.9c.2-.2.4-.4.92-.66a2.59 2.59 0 0 1 1.1-.3c.3 0 .58-.02 1.15.12.57.18.8.4 1.02.57.2.2.44.4.65.97.2.58.12.92.04 1.2a1.66 1.66 0 0 1-.77.99c-.54.3-.86.33-1.17.36-.16.01-.32 0-.53-.06-.2-.06-.46-.16-.7-.44-.32-.38-.4-.8-.28-1.18.04-.1.1-.18.16-.26s.2-.17.3-.2c.23-.06.42-.03.63.08.2.14.26.44.18.56-.07.12-.15.1-.22.02a.25.25 0 0 0-.37-.03c.03.02 0 .1.05.22.1.2.27.38.52.43.15.06.28.1.44.1s.37-.02.63-.18c.34-.23.4-.42.47-.6.05-.2.1-.4-.03-.82-.16-.4-.35-.55-.52-.68-.18-.1-.36-.24-.73-.35-.4-.1-.62-.1-.83-.1-.22.02-.45.04-.85.24-.4.22-.56.4-.7.57-.14.18-.27.35-.5.73l-.38.8c-.07.2-.15.43-.1.87.06.43.2.62.3.78.14.16.26.32.62.54.36.2.6.26.8.3a3.1 3.1 0 0 0 .89.05c.8-.08.9-.13 1.53-.3.22-.03.44-.06.63-.03.13.02.2.07.2.13 1.23-.27 2.67-.65 4.87-1.47 2.58-1 3.97-1.75 5.2-2.45.62-.33 1.17-.7 1.78-1.15l.95-.76c.32-.3.7-.6 1.05-1 1.02-.97 1.93-1.98 2.85-2.58.98-.62 1.64-.07 1.7.67.05.75-.54 1.67-1.34 2.32-.5.45-1.07.84-1.66 1.22-.57.4-1.2.73-1.8 1.1l-3.8 2.06c-2.63 1.27-5.42 2.22-8.12 2.9a16.43 16.43 0 0 1-1.08.26l-2.18.42c-1.73.3-3.94.53-6.05.5l-3.92-.2c-1.03-.07-1.84-.22-2.66-.32l-2.64-.46-3.8-.9-3.75-1.1-2.53-.85-6.13-2.32-5.26-2.15c-.22.07-.47.16-.82.4-.46.32-.62.57-.78.8-.14.24-.3.5-.42 1.03-.1.55-.01.82.06 1.06.1.24.2.5.6.9.42.4.67.57.9.74.25.15.5.33 1.08.43.57.08.86-.01 1.1-.1a2.04 2.04 0 0 0 .88-.63c.34-.43.38-.7.4-.95a1.06 1.06 0 0 0-.04-.39c-.04-.14-.13-.32-.3-.5-.38-.36-.7-.37-.9-.36-.1.02-.22.04-.33.1-.1.06-.24.16-.3.3-.07.17-.01.25.1.37.1.1.26.2.47.3.18.15.3.3.17.43-.12.13-.4.15-.7.06-.3-.08-.67-.33-.8-.68a1.06 1.06 0 0 1 .09-.95 1.47 1.47 0 0 1 .68-.58c.37-.13.66-.1.96-.04.3.1.65.2 1.05.6.52.55.55 1.04.53 1.4-.04.37-.1.78-.57 1.34-.5.54-.83.7-1.16.87-.35.14-.72.27-1.46.17-.72-.13-1.03-.33-1.33-.5-.3-.2-.6-.38-1.1-.86a3.63 3.63 0 0 1-.82-1.2c-.13-.35-.26-.75-.13-1.48.15-.73.4-1.03.6-1.32.23-.28.46-.57 1.05-.97l.25-.15-5.82-2.33-1.78-.68c-1.26-.23-2.56-.36-3.8-.25a12.36 12.36 0 0 0-1.5.22 15.01 15.01 0 0 0-2.66.81c-1.4.58-2.02 1.02-2.64 1.44-.6.44-1.22.9-2.2 2.03-.94 1.17-1.22 1.86-1.47 2.52-.12.33-.2.67-.25 1.1a5.57 5.57 0 0 0 .04 1.66c.26 1.4.68 2.04 1.05 2.65.2.3.4.6.7.93a8 8 0 0 0 1.27 1.16c1.2.84 1.88 1.12 2.56 1.4.7.25 1.42.52 2.9.46 1.48-.12 2.18-.43 2.75-.78a3.22 3.22 0 0 0 .8-.7c.24-.32.52-.75.68-1.4a3.96 3.96 0 0 0 .05-1.59 4.61 4.61 0 0 0-.34-1.03c-.15-.3-.35-.6-.64-.9a4.74 4.74 0 0 0-1.32-.99 4.3 4.3 0 0 0-1.59-.47c-.42-.04-.76.01-1.08.08-.3.08-.6.2-.9.38-.28.2-.54.45-.65.93-.07.34-.02.66.07.88a1.28 1.28 0 0 0 .33.5 1.5 1.5 0 0 0 1.04.4c.4.14.8.15.76.55-.04.37-.7.8-1.58.67-.42-.05-.87-.23-1.24-.52a2.86 2.86 0 0 1-.8-1.04 2.95 2.95 0 0 1-.1-2.13c.22-.72.76-1.33 1.37-1.7.84-.43 1.48-.47 2.2-.46.73.04 1.58.16 2.77.74a5.63 5.63 0 0 1 1.68 1.27 5.6 5.6 0 0 1 .84 1.2c.2.4.36.85.46 1.4.1.56.13 1.25-.08 2.14-.22.88-.58 1.5-.93 1.96a5.14 5.14 0 0 1-1.11 1.05c-.78.5-1.63.93-3.4 1.07-1.77.06-2.63-.24-3.45-.5l-1.3-.56a11.98 11.98 0 0 1-1.75-1.07 10.79 10.79 0 0 1-1.54-1.37 9.95 9.95 0 0 1-.9-1.1c-.5-.72-1.04-1.48-1.38-3.26-.15-.9-.1-1.6 0-2.16a6.13 6.13 0 0 1 .42-1.42c.37-.82.78-1.6 1.85-2.93 1.1-1.3 1.77-1.84 2.43-2.38.67-.5 1.36-1.05 2.94-1.7 1.6-.62 2.44-.77 3.28-.93l.46-.07c-1.34-.47-2.84-1-5.57-1.6l-2.1-.4-1.66-.24c-1-.16-1.8-.18-2.58-.26-1.6-.07-3.2-.2-6.34.08-1.57.17-2.74.36-3.7.6-.97.18-1.72.44-2.47.66l-.57.17-.54.2-1.15.57a8.86 8.86 0 0 0-1.27.88c-.43.36-.9.82-1.22 1.4s-.43 1.1-.38 1.55c.05.46.2.85.43 1.16.46.64 1.1 1.08 1.7 1.4.62.32 1.28.55 2.08.6.4.01.83-.02 1.27-.18.4-.14.86-.43 1.2-.9.47-.63.55-1.26.45-1.7-.05-.24-.13-.37-.26-.53-.12-.15-.3-.27-.46-.36a1.76 1.76 0 0 0-1.07-.22 1.03 1.03 0 0 0-.77.42l-.73.76c0 .01 0 .02.01.03.02.07.02.14-.08.23-.07.05-.2.08-.34.01-.15-.06-.28-.22-.36-.43s-.12-.46-.04-.76a.96.96 0 0 1 .27-.44c.08-.08.2-.13.3-.17.23-.4.6-.75 1.1-.93a3.09 3.09 0 0 1 1.65-.15c.55.1 1.07.32 1.5.67a2.84 2.84 0 0 1 .92 1.3c.25.7.23 1.46.03 2.13-.2.68-.57 1.28-1.05 1.8a4.38 4.38 0 0 1-1.77 1.13 5.04 5.04 0 0 1-2.03.24c-.88-.1-1.58-.35-2.2-.66s-1.17-.7-1.7-1.17c-.52-.5-1.1-1.1-1.47-2.1-.35-.96-.33-2.35.4-3.56.48-.82 1.05-1.38 1.58-1.83.53-.44 1.03-.8 1.5-1.05a11.08 11.08 0 0 1 2.55-1.03z"/></svg>
            <# } else if (settings.title_separator_type == 'jemik') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216.73 8.38"><path d="M202.56 7.67a51.74 51.74 0 0 0-6.79-3.48c2.34-1 4.62-2.15 6.8-3.48a.39.39 0 0 0 .13-.53.39.39 0 0 0-.53-.13c-2.36 1.44-4.84 2.68-7.4 3.72-5.3-2.1-10.92-3.35-16.62-3.63-7.85-.4-15.76 1.05-22.56 2.42l-3.32.68-2.66.55c-7.54-1.54-15.3-2.92-23.07-2.56-4.57.22-8.88 1.08-12.74 2.54-1.85-.72-3.6-1.57-5.2-2.56-.12-.08-.28-.08-.4 0-1.6 1-3.36 1.84-5.2 2.56-3.86-1.45-8.18-2.32-12.74-2.54-7.8-.36-15.55 1.03-23.1 2.57l-2.66-.55-3.32-.68C54.36 1.2 46.44-.24 38.6.15c-5.7.28-11.33 1.52-16.62 3.63-2.56-1.04-5.04-2.28-7.4-3.72-.18-.1-.42-.06-.53.12a.39.39 0 0 0 .13.53 51.74 51.74 0 0 0 6.79 3.48c-2.34 1-4.62 2.15-6.8 3.48a.39.39 0 0 0-.13.53c.07.12.2.18.33.18a.36.36 0 0 0 .2-.06c2.36-1.44 4.84-2.68 7.4-3.72 5.3 2.1 10.92 3.35 16.62 3.64a59.46 59.46 0 0 0 2.67.06c6.96 0 13.86-1.27 19.9-2.5l3.32-.68 2.66-.55C74.68 6.1 82.44 7.5 90.2 7.13c4.57-.22 8.88-1.08 12.74-2.54a30.28 30.28 0 0 1 5.2 2.56.36.36 0 0 0 .2.06.36.36 0 0 0 .2-.06c1.6-1 3.36-1.84 5.2-2.56 3.86 1.45 8.18 2.32 12.74 2.54.86.04 1.72.06 2.58.06 6.9 0 13.78-1.25 20.5-2.62l2.66.55 3.32.68c6.03 1.22 12.94 2.5 19.9 2.5a59.46 59.46 0 0 0 2.67-.06c5.7-.28 11.33-1.52 16.62-3.63 2.56 1.04 5.04 2.28 7.4 3.72a.36.36 0 0 0 .2.06.4.4 0 0 0 .33-.18c.12-.2.06-.43-.12-.54zM64.33 4.38L61 5.06c-6.76 1.37-14.6 2.8-22.37 2.4a51.06 51.06 0 0 1-15.61-3.28c5-1.9 10.27-3 15.6-3.28C46.4.53 54.25 1.95 61 3.32l3.32.68.9.2-.9.2zm25.85 2c-7.08.34-14.16-.8-21.1-2.18 6.93-1.38 14-2.5 21.1-2.18 4.15.2 8.1.94 11.66 2.18-3.58 1.24-7.5 1.98-11.66 2.18zm18.2.01c-1.37-.83-2.84-1.55-4.37-2.2A31.28 31.28 0 0 0 108.37 2a34.99 34.99 0 0 0 4.37 2.2c-1.54.64-3 1.36-4.37 2.2zm18.2-.01c-4.15-.2-8.1-.94-11.66-2.18 3.57-1.24 7.5-1.98 11.66-2.18 7.08-.33 14.16.8 21.08 2.18-6.92 1.38-14 2.52-21.08 2.18zm51.54 1.1c-7.76.38-15.6-1.04-22.37-2.4l-3.32-.68-.9-.2.9-.2 3.32-.68c6.76-1.37 14.6-2.8 22.37-2.4a51.12 51.12 0 0 1 15.61 3.28c-5 1.9-10.27 3-15.6 3.28zm38.6-3.55c-.1-.75-.88-1.45-2-1.83-1.47-.5-3.32-.4-4.95-.14-2.88.48-5.45 1.47-8.1 2.28l4.88 1.35c1.4.4 2.83.78 4.36.92s3.22 0 4.4-.58c.98-.5 1.53-1.26 1.4-2zM10.18 2.7c-1.4-.4-2.83-.78-4.36-.92s-3.22 0-4.4.58c-1 .5-1.53 1.26-1.42 2 .1.74.88 1.45 2 1.82 1.47.5 3.32.4 4.95.14 2.88-.48 5.45-1.47 8.1-2.28L10.18 2.7z"/></svg>
            <# } else if (settings.title_separator_type == 'leaf-line') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216.8 26.78"><path d="M215.18 12.67c-1.66-1.44-3.76-2.43-5.94-2.72a11.63 11.63 0 0 0 4.07-2.8c1.37-1.47 3.1-4.3 1.54-6.23-1.55-1.9-4.4-.44-5.9.75-2.4 1.9-3.74 4.73-3.9 7.76 0 .02.01.04.01.06a110.8 110.8 0 0 1-12.03 4.36c1.3-1.34 2.48-2.82 3.06-4.6.45-1.38.78-4.1-1.37-4.1-2.04 0-4.03 2.3-4.85 3.94-.92 1.84-1.1 3.84-.4 5.74a105.14 105.14 0 0 1-24.08 3.38c3.26-1.8 6.8-4.68 3.62-6.44-1.78-.98-4.16.43-5.57 1.5-1.7 1.27-2.9 2.98-3.6 4.95a89.68 89.68 0 0 1-4.01-.2c-4.13-.3-8.2-.9-12.24-1.67.05-.32-.4-.48-.58-.2-.02.03-.02.05-.04.08-3.4-.66-6.77-1.43-10.15-2.22 1.86-.8 3.54-2 4.8-3.6.67-.85 1.93-2.55.73-3.52-1.25-1-3.86.58-4.97 1.23-2.02 1.18-3.8 2.84-4.96 4.88-7.07-1.65-14.17-3.2-21.44-3.8a89 89 0 0 0-4.86-.27 1.64 1.64 0 0 0-.03-.11c.02-.01.03-.01.05-.02 1.62-1.36 2.9-3.97 1.94-6.05-.66-1.42-2.4-2.54-3.98-2-3.06 1.03-1.94 6.16.35 8.13-6.66-.12-13.2.4-19.72 1.3-.12-.1-.25-.2-.37-.32-.63-2.1-2.02-3.86-4-4.85-1.32-.67-3.73-1.32-4.86.1-2 2.53 3.05 4.52 6.53 5.44-6.17.93-12.35 2.17-18.6 3.48l-6.77 1.33c-.1-.1-.2-.16-.3-.25 0-.05 0-.1-.02-.16-.7-2.15-2.44-4-4.35-5.17-1.55-.94-4.28-1.9-5.4.2-.97 1.84 1.16 3.6 2.54 4.47 1.35.87 2.86 1.34 4.42 1.44-7.47 1.2-15.02 1.85-22.4 1.13-.07-.1-.15-.18-.23-.28.06-2.32-.37-4.9-1.88-6.7-1.04-1.23-3.3-2.63-4.88-1.54-1.7 1.18-.8 3.92.08 5.32.7 1.14 1.7 2.05 2.87 2.64-4.4-.75-8.7-2.04-12.9-4.05-.6-2.38-1.36-4.85-3.18-6.63C5.87 4.6 3.48 3.2 1.9 4.44c-1.68 1.3.24 3.94 1.17 5.1a11.34 11.34 0 0 0 3.16 2.75c-1.58.43-3.1 1.2-4.34 2.18-1.53 1.2-2.7 3.57-1.15 5.27 1.28 1.4 3.45.88 4.7-.3 1.6-1.5 2.7-3.93 3.37-6.1.06.02.12.04.18.05a.43.43 0 0 0 .16 0c7.58 4.18 15.83 5.78 24.2 5.9-.84.44-1.64.96-2.4 1.55-1.3 1.04-3.16 3.04-2.18 4.88 1 1.86 3.3.88 4.52-.12 1.97-1.62 3.35-3.88 3.95-6.36 5.2-.2 10.43-.86 15.55-1.77l8.34-1.56c-.73.56-1.4 1.2-2 1.9-.82 1-2.95 4.23-1.28 5.35 1.57 1.04 4.3-.92 5.38-1.96 1.57-1.5 2.5-3.55 2.64-5.7.06-.06.13-.12.2-.18.13-.12.13-.26.08-.38 8.36-1.58 16.64-3.03 25.08-3.62-.65.4-1.27.85-1.88 1.34-1.63 1.3-4.22 4.04-3.16 6.45.94 2.13 4 .47 5.23-.46 2.4-1.82 3.73-4.74 4.6-7.56 3.62-.1 7.27-.03 10.97.28.13.01.26.03.4.04.74 1.96 2.08 3.66 3.75 4.92 1.15.87 3.7 2.6 5.26 1.84 1.6-.77.97-2.98.3-4.15-.32-.57-.72-1.08-1.17-1.54 9 1.5 17.83 3.95 26.77 5.73-.1 1.4.37 2.85 1.2 4 .97 1.34 3.26 3.52 5.12 3.07 1.78-.43 1.2-2.77.7-3.96-.32-.78-.77-1.5-1.32-2.1 3.73.6 7.5 1.02 11.3 1.16 5.8.2 11.58-.1 17.3-.86.72 1.8 2.33 3.03 4.1 3.84 1.38.63 4.2 2 5.66 1 1.4-.96.92-2.88-.13-3.88-.94-.9-2.37-1.53-3.84-1.92a107.5 107.5 0 0 0 23.24-7.27c.15 1.83 1.36 3.47 2.92 4.53 1.64 1.12 5.1 2.94 7.1 1.72 2.05-1.25.86-3.73-.5-4.92zM6.2 16.76c-.37.65-.77 1.3-1.3 1.84-.76.75-2.28 1.46-3.2.48-.9-.95-.2-2.43.54-3.2.56-.58 1.25-1.03 1.94-1.43.8-.47 1.64-.8 2.5-1.1-1.27 1.1-2.32 2.57-3.02 3.94-.1.2.16.33.28.17.75-.97 1.56-1.9 2.48-2.7.37-.32.76-.6 1.15-.88-.38 1-.8 1.95-1.34 2.87zM4.58 7c-.2-.2-.48.1-.3.3 1.27 1.55 2.5 3.25 3.94 4.66-.13.01-.26.01-.4.03-2.37-1.3-5.35-3.6-4.9-6.05.2-1.05.4-1 1.4-.78.42.1.84.34 1.2.57.83.53 1.52 1.28 2.05 2.1.76 1.18 1.2 2.53 1.57 3.9C7.83 10 6.1 8.5 4.58 7zm17.9 5.32c.85 1.37 1.82 2.85 2.94 4.1-1.32-.4-2.5-1-3.45-2.02-.6-.66-1.1-1.45-1.38-2.3-.14-.4-.22-.84-.26-1.27-.18-.74.15-1.14.98-1.18 1.2-.54 1.85-.24 2.77.7.57.58.93 1.24 1.22 1.98.4 1.02.5 2.06.57 3.1-1-1.13-2.07-2.23-3.04-3.4-.17-.18-.47.06-.35.27zm11.82 11a10.14 10.14 0 0 1-1.46 1.47c-.46.4-.97.7-1.55.9-1.5-.52-1.9-1.25-1.2-2.17.85-1.44 2.32-2.5 3.93-3.32a13.38 13.38 0 0 0-2.22 3.02c-.14.27.23.6.44.34.66-.84 1.32-1.67 2.1-2.42.6-.58 1.26-1.05 1.9-1.56-.42 1.35-1.02 2.62-1.93 3.74zm13.43-8.78c-1.2-.42-3.5-1.58-3.97-2.87.32-1.7 1.1-2.25 2.33-1.66l.93.4c.77.4 1.48.9 2.1 1.47.62.57 1.1 1.2 1.54 1.9a33.56 33.56 0 0 0-4.39-2.55c-.3-.15-.57.28-.27.47 1.68 1.05 3.28 2.2 4.9 3.3-1.08.01-2.15-.1-3.18-.47zm17.25.9l-4.26 4.22c-.2.2.1.5.3.3l3.8-3.43c-.26 1.17-.77 2.26-1.57 3.2-.55.65-4.67 3.92-4.55 1.42.08-1.7 2.03-3.54 3.26-4.5.56-.44 1.15-.82 1.75-1.2L65 15.2c-.02.08-.04.16-.04.24zm11.46-6.17c-.84-.37-3.46-1.5-3.78-2.37-1.07-2.97 3.44-1.05 4.16-.57.82.55 1.45 1.27 1.95 2.08L76.4 6.5c-.3-.24-.74.16-.44.44 1.15 1.1 2.32 2.24 3.53 3.3-1.05-.24-2.07-.54-3.06-.98zm16.52 6.06c-.77 1.15-5.3 5.56-5.43 2.03-.07-1.8 2.46-3.7 3.75-4.67a15.72 15.72 0 0 1 2.14-1.36c-.56.62-1.07 1.3-1.57 1.9-.75.9-1.5 1.83-2.18 2.78-.17.23.2.52.4.3l2.57-2.87c.7-.75 1.5-1.47 2.13-2.28.1 0 .2-.01.3-.01-.66 1.4-1.25 2.86-2.12 4.16zm7.8-13.63c1.5-.26 2.65 1.23 2.66 2.58.02 1.4-.8 2.47-1.63 3.5-.1-.3-.2-.6-.26-.9-.15-.8-.13-1.62-.05-2.44.03-.32-.46-.37-.54-.07-.26.98-.37 2.24-.16 3.38-1.44-2.07-2.47-5.62-.02-6.04zm15.47 14.1c.4 1.9-1.65 1.22-2.6.77-2.3-1.1-4-2.9-5.24-5.04l1.77.2.87.83 2.2 2.13c.4.35.96-.2.58-.58l-2.2-2.2 1.77.24c.84.5 1.57 1.17 2.12 2.04.3.48.62 1.05.74 1.6zm15-2.18l-.67-.16c1.45-.8 3.02-1.62 4.28-2.66.37-.3-.1-.8-.48-.63-1.53.75-3 1.95-4.37 2.95-.06.05-.1.1-.1.17l-.7-.17c1.87-2.4 4.08-4.26 7.02-5.26.28-.1.55-.18.84-.26.83.8.83 1.5-.01 2.12a10.13 10.13 0 0 1-1.2 1.25c-1.26 1.13-2.7 1.85-4.28 2.38-.15.06-.25.16-.3.27zm16.1 10.3c-1.18-.34-2.5-1.7-3.14-2.7-.56-.86-.8-1.76-.84-2.68.85 1.46 2 2.82 3.4 3.74.38.25.85-.34.5-.64-1.2-.97-2.26-1.95-3.2-3.1l1.8.34c.77.47 1.45 1.08 1.96 1.86.65 1 1.77 3.84-.48 3.2zm15.7-5.7c-.36 0-.73-.01-1.1-.01 1.92-.8 3.8-1.94 5.4-3.17.4-.3.04-.97-.4-.7-2.05 1.32-4.17 2.53-6.22 3.84-.02.01-.03.01-.04.01 1.2-2.52 3.36-4.85 6.1-5.56 1.7-.44 2.1 1.37 1.26 2.5-.53.73-1.52 1.32-2.27 1.78-.88.56-1.8.95-2.75 1.3zm20.1 1.7c.53.2 2.08.78 2.45 1.3.2 1.94-.24 2.7-1.35 2.27-.26-.06-.53-.12-.8-.2-2.47-.66-4.66-1.74-6-3.88.22-.03.43-.07.65-.1 1.58 1.08 3.18 2.2 4.83 3.14.44.25.8-.4.4-.67-1.38-.94-2.84-1.78-4.3-2.6l.7-.1c1.17.22 2.3.44 3.4.86zm7.77-5.5l-1 .27c-.01-.06-.01-.12-.01-.18.12.08.28.1.35-.06.45-.98.97-1.93 1.6-2.8.7-.96 1.56-1.73 2.3-2.64.26-.32-.08-.9-.48-.62-1.8 1.28-3.05 3.6-3.8 5.67-.08-1.38.1-2.76.7-4.03.5-1.08 1.7-3.03 3-3.28 3.18-.62 1 3.38.25 4.48-.82 1.2-1.85 2.22-2.9 3.2zm20.34-10.47c-2.12 1.1-3.9 3.27-5.3 5.2.2-2.02 1-3.9 2.34-5.45.64-.73 1.4-1.37 2.23-1.86 1.35-.8 4-1.4 4.15.92.13 1.98-1.72 3.77-3.17 4.83-1.47 1.08-3.1 1.66-4.85 1.94a24.15 24.15 0 0 1 2.33-2.52c.9-.84 1.93-1.5 2.8-2.35.4-.37-.1-.95-.55-.7zm2.78 12.7c-3.2-.18-6.76-2.45-7.35-5.63 1.7 1.7 4.14 3.3 6.38 3.82.5.12.84-.6.36-.85-1.2-.66-2.52-1.1-3.73-1.8-.68-.4-1.32-.84-1.95-1.3 1.62-.04 3.14.38 4.6 1.15.8.4 1.7.93 2.3 1.58 1.02 1.08 1.48 3.13-.63 3.02z"/></svg>
            <# } else if (settings.title_separator_type == 'multinus') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 162 22.1"><path d="M.52 19.23c-.12.2-.2.4-.23.64-.07.38-.05.82.1 1.18a.97.97 0 0 0 .32.47c.25.15.43.01.6-.18L3.38 19l1.84-1.97 2.86 4.12c.17.3.42.45.75.5.54 0 .86-.6 1.02-1.03.17-.48.25-.98.24-1.5 0-.7-.13-1.44-.52-2.04l-1.8-2.74 1.9-1.96 2.06-2.1a1.03 1.03 0 0 0 .35-.52c.15-.4.18-.9.1-1.3-.04-.25-.12-.5-.26-.7-.1-.12-.28-.3-.46-.3-.07 0-.14.02-.2.1L7.52 11.4l-1 1.02L2.1 5.77a.94.94 0 0 0-.78-.5c-.57 0-.9.64-1.07 1.08C.08 6.85 0 7.37 0 7.9c0 .72.13 1.52.54 2.13l3.44 5.13-1.13 1.26-2.33 2.8zm37.02-2.58c.38-.52.48-1.28.48-1.9 0-.48-.07-.94-.23-1.4l-.26-.5c-.16-.27-.4-.42-.7-.45-1.1-.22-2.22-.34-3.33-.42l-3.65-.2-5.73-.1H21.4a1.02 1.02 0 0 0-.81.53c-.44.6-.56 1.5-.56 2.22-.01.56.08 1.1.27 1.63.18.46.52 1.13 1.1 1.13l8.34.03 7.08-.13a.87.87 0 0 0 .71-.45zm25.02-5.5c.24-.63.27-1.38.16-2.04-.1-.52-.42-1.53-1.05-1.53a.71.71 0 0 0-.37.11l-4.84 2.82-3.85-6.08a1.18 1.18 0 0 0-.92-.6c-.67 0-1.06.76-1.25 1.27a5.72 5.72 0 0 0-.3 1.84c0 .88.17 1.76.64 2.5l2.1 3.34c-1.03.67-2.05 1.38-2.8 2.36a2.89 2.89 0 0 0-.39 1.06c-.1.63-.08 1.35.15 1.95a1.58 1.58 0 0 0 .53.77l.34.1a.84.84 0 0 0 .63-.4c.5-.46 1.07-.82 1.63-1.2l1.04-.68 1-.64.12.2c1.16 1.76 2.36 3.53 3.76 5.1.2.33.47.5.84.55.62 0 .97-.7 1.15-1.17a5.12 5.12 0 0 0 .28-1.69c0-.75-.12-1.68-.58-2.3l-1.97-2.9 3.4-1.95c.27-.2.45-.48.55-.8zm15 6.16l8.6-1.58 7.1-1.1 1.16-.13a.8.8 0 0 0 .65-.43c.36-.5.45-1.2.45-1.78a4.07 4.07 0 0 0-.21-1.3c-.13-.33-.4-.9-.86-.9h-.03c-1.27.08-2.53.3-3.78.5l-3.15.57-9.93 1.9a.79.79 0 0 0-.63.4c-.34.47-.44 1.16-.44 1.72 0 .43.06.85.2 1.26l.23.46a.84.84 0 0 0 .64.4zm37.1.54c.5 0 .78-.56.93-.94.15-.44.23-.9.22-1.36l-.06-.73a2.95 2.95 0 0 0-.41-1.13l-.64-.7 6.93-3.93c.23-.18.4-.42.48-.7.2-.55.24-1.2.14-1.77-.08-.45-.37-1.33-.9-1.33-.1 0-.2.03-.32.1l-7.47 4.25-1.2.7-.43-.52-4.02-5a.76.76 0 0 0-.63-.4c-.46 0-.73.52-.86.87-.14.4-.2.83-.2 1.26 0 .55.1 1.27.44 1.72l2.92 3.74-.65.4c-.56.36-1.13.7-1.62 1.15a1.35 1.35 0 0 0-.44.65c-.2.5-.22 1.1-.13 1.63.07.43.47 1.6 1.14 1.14.53-.36 1.1-.67 1.65-1l1.5-.85.73-.42L114 17.4c.13.25.36.4.66.43zm27.74-4.96l1.96-.2c.87-.1 1.74-.2 2.62-.16a.84.84 0 0 0 .66-.43c.36-.5.46-1.22.46-1.8 0-.45-.07-.9-.22-1.32l-.24-.48a.82.82 0 0 0-.66-.43c-.6-.14-1.2-.17-1.8-.17h-.78l-1.9.1-3.6.24-9 .74c-.32.04-.57.2-.73.48-.4.55-.5 1.35-.5 2a4.26 4.26 0 0 0 .24 1.46c.14.37.48 1.06 1 1.02l8.94-.74 3.56-.33zm13.64-8.03l-2.3-3.88a.87.87 0 0 0-.68-.44c-.5 0-.78.56-.93.94a3.88 3.88 0 0 0 .25 3.21l2.36 3.98.68 1.13-1.03 1.9-.67 1.3-.9 1.92a4.44 4.44 0 0 0-.24 1.44c0 .64.1 1.43.5 1.97a.9.9 0 0 0 .72.47c.55 0 .8-.6 1-1 .01-.02.02-.04.03-.07l2.7-4.86.63.88.86 1.1c.45.57.96 1.13 1.52 1.57a.6.6 0 0 0 .7 0c.45-.26.62-.95.7-1.4.16-.94.06-2.15-.7-2.8a1.26 1.26 0 0 1-.2-.2c-.6-.68-1.15-1.43-1.68-2.18l-.07-.1 1.4-2.47c.24-.4.4-.8.46-1.27.13-.76.1-1.62-.18-2.34-.12-.37-.33-.68-.63-.93a.78.78 0 0 0-.41-.12c-.3 0-.6.18-.76.48l-2 3.54-1.1-1.76z"/></svg>
            <# } else if (settings.title_separator_type == 'rotate-box') { #>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 13.48"><g fill="none" stroke="#000" stroke-miterlimit="10"><path d="M6.07 2.496l4.243 4.243-4.243 4.24-4.243-4.242zm11.4.001l4.24 4.243-4.243 4.243-4.243-4.243z"/><use xlink:href="#B"/><path d="M40.3 2.494l4.243 4.243L40.3 10.98l-4.243-4.243zm11.4.001l4.243 4.243L51.7 10.98l-4.243-4.243zm11.408.002L67.35 6.74l-4.243 4.243-4.243-4.243zm11.4.003l4.242 4.24-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="57.032" y="-0.007"/><use xlink:href="#B" x="68.442" y="-0.005"/><use xlink:href="#B" x="79.85" y="-0.003"/><path d="M120.147 2.498L124.4 6.74l-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="102.662" y="-0.007"/><use xlink:href="#B" x="114.072" y="-0.006"/><path d="M154.368 2.496L158.6 6.74l-4.243 4.243-4.243-4.243z"/><use xlink:href="#B" x="136.889" y="-0.002"/><use xlink:href="#B" x="148.292" y="-0.008"/><use xlink:href="#B" x="159.7" y="-0.006"/><use xlink:href="#B" x="171.11" y="-0.004"/><use xlink:href="#B" x="182.519" y="-0.003"/><use xlink:href="#B" x="193.928"/><use xlink:href="#B" x="205.33" y="-0.007"/><use xlink:href="#B" x="216.739" y="-0.005"/><use xlink:href="#B" x="228.149" y="-0.003"/><use xlink:href="#B" x="239.558" y="-0.002"/><use xlink:href="#B" x="250.96" y="-0.007"/><use xlink:href="#B" x="262.369" y="-0.005"/><use xlink:href="#B" x="273.778" y="-0.004"/><use xlink:href="#B" x="285.188" y="-0.002"/><use xlink:href="#B" x="296.59" y="-0.008"/><use xlink:href="#B" x="307.999" y="-0.006"/><use xlink:href="#B" x="319.408" y="-0.004"/><use xlink:href="#B" x="330.817" y="-0.003"/><use xlink:href="#B" x="342.219" y="-0.008"/><use xlink:href="#B" x="353.629" y="-0.006"/><use xlink:href="#B" x="365.038" y="-0.005"/></g><defs ><path id="B" d="M28.888 2.5l4.243 4.243-4.243 4.243-4.243-4.243z"/></defs></svg>
            <# } else if (settings.title_separator_type == 'tripline') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.18 18.84"><path d="M5.72 9.45l6.38-.17 2.6-.12 11.43-.57 13.66-.72 19.5-1.1L90.95 5.3l33.67-1.06 34.85-.52 33.44-.13 18.77.06-27.08.38-16.2.24-35.27.95-3.18.14-30.5 1.4-3.02.2L68.6 8.87l-30.9 2.6-20.24 1.77-4.85.42-8.7.94c-.3.03-.57.23-.57.57 0 .32.26.55.57.57l3.17.14c-.13.28-.2.58-.2.88 0 1.08.94 2.15 2.07 2.08l24.82-1.47 55.07-2.63 66.33-1.7 56.1-.88 14.37-.3 11.87-.45 5.92-.25 13.47-.87c0 .01-.01.01-.01.02-.25.43-.32.96-.2 1.44.13.47.44.87.86 1.12.4.23 1 .36 1.44.2l2.92-1.2-.06.03a4.97 4.97 0 0 1 .22-.09l.25-.1c-.03.01-.06.03-.1.04l3.17-1.35c.6-.26 1.15-.57 1.72-.87.64-.34 1.03-1.1 1.03-1.8 0-.38-.1-.73-.28-1.05-.25-.43-.74-.87-1.24-.96s-1-.15-1.5-.22l-.34-.02c-.34 0-.7.05-1.02.07l-2.28.22-1.87.13-5.02.36-1.3.1c.16-.18.27-.38.34-.62.08-.18.12-.38.13-.58l.06-.43c0-.2-.03-.36-.1-.53l.13-.06c.3-.2.57-.44.75-.75.2-.33.3-.68.3-1.06s-.1-.73-.3-1.06l-.33-.43a2.08 2.08 0 0 0-.93-.54c-.63-.23-1.3-.3-2-.3l-1.68.05-5.83.05-9.03.05-16.2.02-30.77.17-23.07.23-10.3.16-29.7.63-3.82.14-22.85.87-6.97.27-3.9.2-22.7 1.22-11.72.68L32.75 6 12.63 7.2l-4.46.2-3.96.06c-.13-.34-.47-.62-.85-.6L.8 7.12c-.4.04-.77.25-.88.68-.13.47.15 1 .64 1.13l1.1.27c.36.08.74.1 1.1.13.97.1 1.95.1 2.93.12zm234-3.2h3.73c.1.28.28.53.5.73l-1.44.08-2.72.1-17.3.65-65.55 1.04-26.96.66-40.62 1.08-8.14.38-23.06 1.1-24.74 1.18 6.1-.48 28.75-2.2 3.84-.24 26.5-1.6 6.24-.24 27.87-1.1 1.32-.03 26.42-.54L171 6.65l34.04-.26 34.68-.15z"/><circle cx="20.75" cy="22.59" r=".57"/></svg>
            <# } else if (settings.title_separator_type == 'vague') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 211.79 7.61"><path d="M0 6.87c1.8-1.6 3.73-3.08 5.87-4.24C8 1.5 10.4.66 12.9.64c1.25 0 2.52.2 3.7.65 1.2.46 2.25 1.16 3.24 1.86s1.94 1.4 2.95 1.92a9.06 9.06 0 0 0 3.19.96c2.24.27 4.5-.18 6.6-1.2l6.47-3.27C41.37.57 43.92.1 46.52.4c1.3.18 2.58.72 3.64 1.45 1.07.73 1.95 1.6 2.84 2.33.9.74 1.82 1.34 2.85 1.65 1.03.32 2.17.33 3.26.2 2.2-.28 4.17-1.6 6.2-2.9 1.03-.65 2.1-1.3 3.26-1.8C69.75.8 71 .47 72.3.34c1.28-.1 2.58-.02 3.84.3 1.26.3 2.44.9 3.5 1.56 2.1 1.34 3.9 2.87 6.07 3.5 1.06.33 2.2.47 3.32.4 1.13-.02 2.24-.25 3.3-.64 2.16-.74 4.1-2.16 6.25-3.36 2.14-1.2 4.76-2.1 7.35-1.74a9.01 9.01 0 0 1 3.7 1.23c1.12.66 2.06 1.5 2.97 2.23.9.74 1.84 1.37 2.87 1.76 1.02.4 2.14.58 3.26.55.56.03 1.12-.08 1.68-.13.55-.13 1.1-.22 1.65-.42 1.1-.33 2.15-.84 3.2-1.38 2.1-1.08 4.16-2.44 6.58-3.25 1.2-.43 2.5-.66 3.78-.66 1.3-.03 2.6.2 3.83.74 2.5 1.07 4 3.25 5.87 4.3 1.87 1.05 4.3 1.05 6.3.12 2.05-.92 3.92-2.56 6.2-3.65 2.27-1.1 4.8-1.72 7.4-1.45 1.3.14 2.55.52 3.7 1.07s2.2 1.2 3.2 1.83c2.03 1.27 4.06 2.4 6.32 2.72 2.24.38 4.57.05 6.7-.8 2.16-.8 4.17-2.16 6.44-3.17 1.13-.5 2.33-.9 3.55-1.13 1.23-.2 2.48-.28 3.7-.2 2.47.2 4.85.95 7 2.06 2.17 1.12 4.13 2.56 5.94 4.15-3.77-2.95-8.24-5.3-13-5.42-1.18-.02-2.34.1-3.48.35-1.13.28-2.22.7-3.26 1.22-2.1 1.05-4.03 2.53-6.36 3.53-2.34 1-4.97 1.3-7.5.88-2.56-.36-4.84-1.66-6.87-2.93-2.04-1.28-4.05-2.48-6.28-2.7-1.1-.15-2.24-.01-3.36.2s-2.2.62-3.23 1.12c-2.1.98-3.9 2.6-6.25 3.68-2.35 1.1-5.3 1.14-7.64-.2-1.16-.65-2.07-1.54-2.96-2.32s-1.77-1.5-2.77-1.9c-1-.43-2.1-.64-3.22-.6a9.74 9.74 0 0 0-3.31.58c-2.17.72-4.2 2.03-6.36 3.16-1.1.56-2.22 1.1-3.43 1.48-.6.22-1.23.33-1.85.47-.64.06-1.27.2-1.92.15-1.28.04-2.6-.17-3.82-.65-1.23-.47-2.32-1.22-3.27-2-.96-.77-1.84-1.55-2.8-2.1-.95-.57-2-.9-3.1-1.03-2.24-.3-4.43.43-6.46 1.57-2.05 1.13-4.05 2.6-6.47 3.46-1.2.43-2.47.7-3.76.73-1.28.06-2.58-.1-3.8-.47-2.52-.74-4.48-2.43-6.43-3.65-.98-.62-2-1.1-3.08-1.38a10.34 10.34 0 0 0-3.33-.26c-1.12.12-2.2.4-3.25.85-1.05.45-2.04 1.06-3.05 1.7s-2.03 1.32-3.15 1.9-2.36 1.04-3.65 1.22c-1.3.17-2.62.15-3.9-.24-1.3-.38-2.42-1.13-3.37-1.93-.96-.8-1.8-1.62-2.74-2.25-.92-.64-1.92-1.06-3-1.2-2.2-.26-4.54.14-6.66 1.06-2.15.88-4.16 2.2-6.42 3.25C31 7.26 28.36 7.94 25.8 7.54c-1.28-.2-2.53-.64-3.63-1.3-1.1-.64-2.07-1.43-3-2.17-.94-.74-1.88-1.42-2.92-1.9s-2.18-.7-3.34-.76c-2.33-.1-4.68.57-6.83 1.6C3.9 4.03 1.9 5.38 0 6.87z"/></svg>
            <# } else if (settings.title_separator_type == 'zigzag-dot') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 13.48"><circle cx="3.59" cy="9.11" r="2"/><circle cx="8.89" cy="4.37" r="2"/><circle cx="14.21" cy="9.11" r="2"/><circle cx="19.51" cy="4.37" r="2"/><circle cx="24.82" cy="9.11" r="2"/><circle cx="30.13" cy="4.37" r="2"/><circle cx="35.44" cy="9.11" r="2"/><circle cx="35.44" cy="9.11" r="2"/><circle cx="40.74" cy="4.37" r="2"/><circle cx="46.06" cy="9.11" r="2"/><circle cx="46.06" cy="9.11" r="2"/><circle cx="51.36" cy="4.37" r="2"/><circle cx="56.67" cy="9.11" r="2"/><circle cx="56.67" cy="9.11" r="2"/><circle cx="61.98" cy="4.37" r="2"/><circle cx="67.29" cy="9.11" r="2"/><circle cx="67.29" cy="9.11" r="2"/><circle cx="72.59" cy="4.37" r="2"/><circle cx="77.91" cy="9.11" r="2"/><circle cx="77.91" cy="9.11" r="2"/><circle cx="83.21" cy="4.37" r="2"/><circle cx="88.52" cy="9.11" r="2"/><circle cx="88.52" cy="9.11" r="2"/><circle cx="93.83" cy="4.37" r="2"/><circle cx="99.14" cy="9.11" r="2"/><circle cx="99.14" cy="9.11" r="2"/><circle cx="104.44" cy="4.37" r="2"/><circle cx="109.76" cy="9.11" r="2"/><circle cx="109.76" cy="9.11" r="2"/><circle cx="115.06" cy="4.37" r="2"/><circle cx="120.37" cy="9.11" r="2"/><circle cx="120.37" cy="9.11" r="2"/><circle cx="125.68" cy="4.37" r="2"/><circle cx="130.99" cy="9.11" r="2"/><circle cx="130.99" cy="9.11" r="2"/><circle cx="136.29" cy="4.37" r="2"/><circle cx="141.61" cy="9.11" r="2"/><circle cx="141.61" cy="9.11" r="2"/><circle cx="146.91" cy="4.37" r="2"/><circle cx="152.22" cy="9.11" r="2"/><circle cx="152.22" cy="9.11" r="2"/><circle cx="157.53" cy="4.37" r="2"/><circle cx="162.84" cy="9.11" r="2"/><circle cx="162.84" cy="9.11" r="2"/><circle cx="168.14" cy="4.37" r="2"/><circle cx="173.46" cy="9.11" r="2"/><circle cx="173.46" cy="9.11" r="2"/><circle cx="178.76" cy="4.37" r="2"/><circle cx="184.07" cy="9.11" r="2"/><circle cx="184.07" cy="9.11" r="2"/><circle cx="189.38" cy="4.37" r="2"/><circle cx="194.69" cy="9.11" r="2"/><circle cx="194.69" cy="9.11" r="2"/><circle cx="199.99" cy="4.37" r="2"/><circle cx="205.31" cy="9.11" r="2"/><circle cx="205.31" cy="9.11" r="2"/><circle cx="210.61" cy="4.37" r="2"/><circle cx="215.93" cy="9.11" r="2"/><circle cx="215.93" cy="9.11" r="2"/><circle cx="221.23" cy="4.37" r="2"/><circle cx="226.54" cy="9.11" r="2"/><circle cx="226.54" cy="9.11" r="2"/><circle cx="231.84" cy="4.37" r="2"/><circle cx="237.16" cy="9.11" r="2"/><circle cx="237.16" cy="9.11" r="2"/><circle cx="242.46" cy="4.37" r="2"/><circle cx="247.78" cy="9.11" r="2"/><circle cx="247.78" cy="9.11" r="2"/><circle cx="253.08" cy="4.37" r="2"/><circle cx="258.39" cy="9.11" r="2"/><circle cx="258.39" cy="9.11" r="2"/><circle cx="263.69" cy="4.37" r="2"/><circle cx="269.01" cy="9.11" r="2"/><circle cx="269.01" cy="9.11" r="2"/><circle cx="274.31" cy="4.37" r="2"/><circle cx="279.63" cy="9.11" r="2"/><circle cx="279.63" cy="9.11" r="2"/><circle cx="284.93" cy="4.37" r="2"/><circle cx="290.24" cy="9.11" r="2"/><circle cx="290.24" cy="9.11" r="2"/><circle cx="295.54" cy="4.37" r="2"/><circle cx="300.86" cy="9.11" r="2"/><circle cx="300.86" cy="9.11" r="2"/><circle cx="306.16" cy="4.37" r="2"/><circle cx="311.48" cy="9.11" r="2"/><circle cx="311.48" cy="9.11" r="2"/><circle cx="316.78" cy="4.37" r="2"/><circle cx="322.09" cy="9.11" r="2"/><circle cx="322.09" cy="9.11" r="2"/><circle cx="327.4" cy="4.37" r="2"/><circle cx="332.71" cy="9.11" r="2"/><circle cx="332.71" cy="9.11" r="2"/><circle cx="338.01" cy="4.37" r="2"/><circle cx="343.33" cy="9.11" r="2"/><circle cx="343.33" cy="9.11" r="2"/><circle cx="348.63" cy="4.37" r="2"/><circle cx="353.94" cy="9.11" r="2"/><circle cx="353.94" cy="9.11" r="2"/><circle cx="359.25" cy="4.37" r="2"/><circle cx="364.56" cy="9.11" r="2"/><circle cx="364.56" cy="9.11" r="2"/><circle cx="369.86" cy="4.37" r="2"/><circle cx="375.18" cy="9.11" r="2"/><circle cx="375.18" cy="9.11" r="2"/><circle cx="380.48" cy="4.37" r="2"/><circle cx="385.79" cy="9.11" r="2"/><circle cx="385.79" cy="9.11" r="2"/><circle cx="391.1" cy="4.37" r="2"/><circle cx="396.41" cy="9.11" r="2"/></svg>
            <# } else if (settings.title_separator_type == 'zozobe') { #>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 226.76 14.31"><path d="M225.8 2.6c-1.52-2.33-4.72-3.27-7.12-2.1-1.8.88-2.93 2.87-2.67 4.73.14 1 .72 1.93 1.58 2.56.8.58 1.72.82 2.6.68.97-.16 1.87-.87 2.34-1.84.44-.92.45-1.9 0-2.7-.08-.13-.25-.18-.38-.1-.14.08-.18.25-.1.38.35.63.35 1.43-.02 2.18-.4.82-1.13 1.4-1.92 1.54-.73.12-1.5-.1-2.18-.58-.73-.54-1.24-1.35-1.36-2.2-.23-1.62.76-3.36 2.36-4.14 2.12-1.03 5.06-.16 6.4 1.9 1.3 2 1.13 4.9-.4 6.9-1.46 1.9-4.04 2.94-6.6 2.66-2.36-.26-4.7-1.64-6.27-3.7-.47-.62-.88-1.3-1.28-1.97-.6-1-1.23-2.05-2.1-2.9-2.74-2.76-7.66-2.87-10.53-.24-.87.8-1.54 1.8-2.18 2.75-.16.24-.33.47-.5.7l-10.38.24c-1.16-.96-2.38-1.9-3.85-2.3-1.2-.32-2.65-.1-3.67.6-.73.5-1.18 1.15-1.32 1.92-17.9.48-34.93.87-52.72-.1-4.06-1.1-7.56-3.2-9.85-5.93a.43.43 0 0 0-.64 0c-2.3 2.73-5.8 4.83-9.85 5.93-17.8.96-34.83.57-52.72.1-.14-.77-.6-1.43-1.32-1.92-1.02-.7-2.46-.92-3.67-.6-1.48.4-2.7 1.32-3.85 2.3L31.27 7.1c-.16-.24-.33-.47-.5-.7-.64-.96-1.3-1.94-2.18-2.75-2.87-2.63-7.8-2.5-10.53.24-.85.86-1.48 1.9-2.1 2.9-.4.66-.8 1.35-1.28 1.97-1.6 2.1-3.87 3.44-6.27 3.7-2.54.28-5.13-.77-6.6-2.66-1.54-2-1.7-4.9-.4-6.9C2.78.84 5.7-.03 7.84 1c1.6.78 2.6 2.52 2.36 4.14-.13.84-.63 1.66-1.37 2.2-.67.5-1.45.7-2.18.58-.8-.13-1.53-.72-1.92-1.54-.36-.75-.37-1.55-.02-2.18.08-.13.03-.3-.1-.38-.13-.07-.3-.03-.38.1-.44.8-.44 1.78 0 2.7.48.97 1.37 1.68 2.34 1.84.88.14 1.8-.1 2.6-.68.86-.63 1.44-1.57 1.58-2.56C11.02 3.37 9.9 1.4 8.08.5 5.67-.67 2.48.27.96 2.6-.47 4.8-.3 7.96 1.4 10.14c1.4 1.83 3.78 2.92 6.2 2.92.3 0 .58-.02.88-.05 2.55-.28 4.97-1.7 6.65-3.92a19.25 19.25 0 0 0 .89-1.33l15.14.16c1.27 1.72 2.58 2.68 4 2.93 1.68.3 3.52-.4 5.62-2.1a19.06 19.06 0 0 0 .72-.6l6.6.17 31.25.56c7.8 0 15.63-.17 23.6-.6.02.01.03.02.04.02 4.14 1.1 7.7 3.2 10.04 5.98.08.1.2.15.32.15s.24-.05.32-.15c2.33-2.77 5.9-4.9 10.04-5.98.02 0 .03-.01.04-.02 7.97.43 15.8.6 23.6.6 10.3 0 20.62-.28 31.25-.56l6.6-.17.72.6c2.1 1.7 3.94 2.4 5.62 2.1 1.43-.25 2.74-1.2 4-2.93l15.14-.16a19.25 19.25 0 0 0 .89 1.33c1.68 2.2 4.1 3.64 6.65 3.92a8.49 8.49 0 0 0 .88.05c2.44 0 4.8-1.1 6.2-2.92 1.7-2.17 1.87-5.34.44-7.53zM18.46 4.28c2.54-2.56 7.1-2.66 9.75-.23.82.76 1.47 1.72 2.1 2.65l.27.4-14.04-.16c.58-.97 1.15-1.88 1.92-2.65zm22 4.05c-1.97 1.6-3.66 2.25-5.17 1.98-1.18-.2-2.3-1-3.4-2.37l8.78.2c-.07.07-.15.13-.22.2zm2.05-.98c.96-.77 1.98-1.46 3.14-1.77 1.06-.28 2.32-.08 3.2.52.4.27.9.73 1.05 1.44l-1.76-.05-5.64-.14zm70.88 6.05c-2.16-2.4-5.23-4.32-8.77-5.48 3.54-1.16 6.6-3.07 8.77-5.48 2.16 2.4 5.23 4.32 8.77 5.48-3.55 1.15-6.6 3.06-8.77 5.48zm83.07-6.7c.63-.93 1.27-1.9 2.1-2.65 2.66-2.44 7.2-2.33 9.75.23.77.77 1.33 1.7 1.9 2.66l-14.04.15.28-.4zm-17.84.8l-1.76.05c.17-.7.65-1.17 1.05-1.44.9-.6 2.15-.8 3.2-.52 1.16.3 2.18 1 3.14 1.77l-5.64.14zm12.87 2.8c-1.5.27-3.2-.38-5.17-1.98-.07-.06-.15-.12-.22-.18l8.78-.2c-1.1 1.37-2.2 2.15-3.4 2.36z"/></svg>
            <# } #>

        </div>
        <# } #>
        <# } #>

        <div {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</div>

        <#
        var animation = (settings.readmore_hover_animation) ? ' elementor-animation-' + settings.readmore_hover_animation : '';
        var attention = (settings.attention_button) ? ' tmt-ep-attention-button' : '';
        var onclick = view.addRenderAttribute( 'button', 'onclick', settings.onclick_event );

        if ( settings.full_width_readmore == 'yes' ) {
            var full_width_more = 'tmt-display-block';
        } else {
            var full_width_more = 'tmt-display-inline-block';
        }

        iconHTML = elementor.helpers.renderIcon( view, settings.advanced_readmore_icon, { 'aria-hidden': true }, 'i' , 'object' );

        migrated = elementor.helpers.isIconMigrated( settings, 'advanced_readmore_icon' );

        #>

        <# if ( settings.readmore == 'yes' ) { #>
        <a class="tmt-advanced-icon-box-readmore {{full_width_more}} {{animation}}{{attention}}" href="{{ settings.readmore_link.url }}" {{onclick}}>
            {{{ settings.readmore_text }}}

            <# if ( settings.advanced_readmore_icon.value ) { #>
            <span class="tmt-button-icon-align-{{ settings.readmore_icon_align }}">

                <# if ( iconHTML && iconHTML.rendered && ( ! settings.readmore_icon || migrated ) ) { #>
                    {{{ iconHTML.value }}}
                <# } else { #>
                    <i class="{{ settings.readmore_icon }}" aria-hidden="true"></i>
                <# } #>

            </span>
            <# } #>
        </a>
        <# } #>
        </div>
        </div>

        <# if ( settings.indicator === 'yes' ) { #>
        <div class="tmt-indicator-svg tmt-svg-style-{{{settings.indicator_style}}}">
            <# if (settings.indicator_style == '1') { #>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M145.2,26.8c0.3,5.3,0.7,10.5,1.1,15.8c-10.5-10.1-19.1-22.4-31-30.9C104.7,4.1,91.9,0.9,79,1.4C48.2,2.5,22.3,22.7,0.4,42.5c-0.8,0.7,0.2,2,1.1,1.3c23.4-18.3,47.6-39.2,79-39.8c13.4-0.2,26,3.8,36.5,12.2c10,8.1,17.7,18.5,26.8,27.5C137,42,130.5,40,124,37.8c-1.1-0.4-1.7,1.2-0.6,1.7c7.8,3.4,15.9,5.9,24.2,7.9c0.1,0,0.1,0,0.2,0c0.1,0.1,0.2,0.2,0.2,0.2c1.3,1.2,2.9-1.1,1.6-2.2c-0.1-0.1-0.2-0.2-0.3-0.2c-0.4-6.3-0.8-12.6-1.4-18.9C147.7,24.6,145.1,25,145.2,26.8z"/></svg>
            <# } else if (settings.indicator_style == '2') { #>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M137,10.3c2.7,5.7,4.5,12.2,6.5,18.2c0.4,1.3-1,2.6-2.2,2.2c-6.7-2.3-13.5-4.5-20.3-6.8c-1.8-0.6-1.1-3.4,0.7-2.8c3.2,0.9,6.5,1.9,9.7,2.9c0-0.1-0.1-0.1-0.1-0.2c-3.7-6.4-13.1-18.6-20.2-7.5c-2.3,3.7-2.6,8.7-3.8,12.8c-1.5,5-4.3,9.8-10,10.3c-6.2,0.5-10.7-4.9-13.6-9.6c-2.6-4.4-4.6-9.3-6.8-13.9c-0.7-1.6-1.5-3.2-2.3-4.8c-2.8-4.2-6.4-4.2-8.5-4.1c-4.3,0.2-8.4,5.4-10.7,8.6c-6.2,8.6-9.8,41.1-27.6,32.9C12.2,41.2,6.5,16.6,7.9,1.1c0.1-1.2,1.9-1.2,1.9,0c-0.1,11.7,2.5,23.1,8.8,33c3.8,6.1,9.8,14,18.2,11c5.3-1.9,7.1-11.7,8.6-16.3c3.1-9.7,16.7-35.6,30.3-23c6.8,6.4,7.8,17.8,13.8,25c11.8,14.2,14.5-6.5,17.4-13.9c2.1-5.2,5.9-9.1,11.9-8.7c7.9,0.4,12.6,7.3,15.8,13.7c0.6,1.1-0.1,2.1-1,2.5c1.8,0.5,3.6,1.1,5.3,1.6c-1.9-4.8-3.8-9.6-5-14.5C133.4,9.7,136.2,8.4,137,10.3z"/></svg>
            <# } else if (settings.indicator_style == '3') { #>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M4.3,12.3c2.9,6.7,5.6,14.2,11.3,19.2c9.3,8.1,20.4,2,29-3.8c12.7-8.5,23.8-20,39-24c26.5-7.1,55,9.2,61.4,35.8c0.7-3.1,1.2-6.2,1.7-9.4c0.2-1.2,2-0.9,2.1,0.3c0.2,5.5-1.1,11.2-2.4,16.5c-0.3,1.2-2,1.7-2.8,0.7c-4-4.8-8.4-9.2-12.4-14c-1.4-1.7,0.7-3.7,2.4-2.4c3.6,2.8,6.8,6.5,9.7,10.3c-5.2-16.6-17.2-30.3-34.7-34.5c-19-4.6-34.8,3.5-49.5,14.7C49.1,29.1,35.7,41.7,22.2,39C10.7,36.7,4.3,23.8,1.4,13.5C0.9,11.9,3.5,10.6,4.3,12.3z"/></svg>
            <# } else if (settings.indicator_style == '4') { #>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><path d="M128,27.9c-1.2,6.2-1.9,11.7-4.4,17.3c-0.6-0.7-1.1-1.4-1.7-2.1c2.6-21.9-14.6-42.5-37.3-40.7c-2.1,0.2-4.4,0.7-6.6,1.4C67-1.4,52.2-1,41.8,3.5c-9.7,4.3-17.6,12.1-22,21.8c-3.5,7.6-6.2,18.8,1.7,24.5c1,0.7,2.2-0.6,1.3-1.4c-10.1-8,0.1-25.4,6.5-32.4C36,8.7,45.3,4.1,55.2,3.1c6.1-0.6,12.7,0.1,18.5,2.5C61.2,11.5,51,25,61.5,37.7c12.3,14.9,33.9,1.1,30.4-16.3c-1.4-6.7-5.1-11.7-10.1-15.2c1.6-0.3,3.2-0.4,4.7-0.5c19.2-0.4,32.2,15.8,32.3,33.8c-2.8-3.4-5.6-6.8-8.5-10c-0.8-0.9-2.3,0.4-1.6,1.4c3.2,4.5,6.6,8.8,10,13.2c0.1,0.5,0.4,0.9,0.8,1.1c1,1.3,2,2.6,3,3.9c0.7,1,2.1,1,2.8-0.1c3.4-6,6.2-13.7,5.2-20.7C130.3,26.8,128.3,26.4,128,27.9z M80.1,39.5c-14.7,5.8-24.2-11.8-15.8-23.1c3.2-4.3,7.9-7.4,13-9.1c2.1,1.2,4,2.6,5.8,4.4C90.9,19.5,91.9,34.9,80.1,39.5z"/></svg>
            <# } else if (settings.indicator_style == '5') { #>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 50"><g><path class="st0" d="M5.7,40.9c-0.8-0.1-1.5,0.5-1.5,1.3c-0.1,0.8,0.5,1.5,1.3,1.5C6.3,43.8,7,43.2,7,42.5    C7.1,41.7,6.5,41,5.7,40.9z"/><circle class="st0" cx="10.4" cy="36.6" r="1.7"/><path class="st0" d="M15.8,29c-1.1-0.1-2,0.7-2.1,1.8c-0.1,1.1,0.7,2,1.8,2.1c1.1,0.1,2-0.7,2.1-1.8S16.8,29,15.8,29z"/><path class="st0" d="M21.8,22.9c-1.1-0.1-2.1,0.8-2.2,1.9c-0.1,1.1,0.8,2.1,1.9,2.2c1.1,0.1,2.1-0.8,2.2-1.9    C23.8,24,22.9,23,21.8,22.9z"/><circle class="st0" cx="28.3" cy="19.9" r="2"/><path class="st0" d="M36.2,12.7c-1.1-0.1-2.1,0.8-2.2,1.9c-0.1,1.1,0.8,2.1,1.9,2.2c1.1,0.1,2.1-0.8,2.2-1.9    C38.2,13.7,37.4,12.8,36.2,12.7z"/><path class="st0" d="M55.4,5.8c-1.2-0.1-2.2,0.8-2.3,2c-0.1,1.2,0.8,2.2,2,2.3c1.2,0.1,2.2-0.8,2.3-2C57.5,6.9,56.6,5.8,55.4,5.8z"    /><path class="st0" d="M45.5,8.8c-1.2-0.1-2.3,0.8-2.3,2c-0.1,1.2,0.8,2.3,2,2.3c1.2,0.1,2.3-0.8,2.3-2C47.6,9.9,46.7,8.9,45.5,8.8z"    /><circle class="st0" cx="65.9" cy="6" r="2.4"/><circle class="st0" cx="76.8" cy="4.8" r="2.4"/><circle class="st0" cx="88.7" cy="6.1" r="2.4"/><circle class="st0" cx="99.9" cy="9.4" r="2.4"/><circle class="st0" cx="109.7" cy="13.4" r="2.4"/><circle class="st0" cx="119.6" cy="19.1" r="2.4"/><circle class="st0" cx="128.5" cy="25.6" r="2.4"/><circle class="st0" cx="135.3" cy="32.5" r="2.4"/><circle class="st0" cx="142.6" cy="41.8" r="2.4"/><circle class="st0" cx="143.1" cy="34.7" r="2.4"/><circle class="st0" cx="143.6" cy="27.9" r="2.4"/><circle class="st0" cx="144.1" cy="21" r="2.4"/><circle class="st0" cx="120.9" cy="40.3" r="2.4"/><circle class="st0" cx="127.8" cy="40.8" r="2.4"/><circle class="st0" cx="134.6" cy="41.3" r="2.4"/></g></svg>
            <# } #>

        </div>
        <# } #>

        <# if ( settings.badge && settings.badge_text != '' ) { #>
        <div class="tmt-advanced-icon-box-badge tmt-position-{{{settings.badge_position}}}">
            <span class="tmt-badge tmt-padding-small">{{{settings.badge_text}}}</span>
        </div>
        <# } #>

        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_Info_Box_Advanced );