<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_heading extends Widget_Base {

    public function get_name() {
        return 'themento_heading';
    }

    public function get_title() {
        return __( 'Heading', text_domain );
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
        $this->register_general_content_controls();
        $this->register_separator_content_controls();
        $this->register_style_content_controls();
        $this->register_heading_typo_content_controls();
        $this->register_desc_typo_content_controls();
        $this->register_imgicon_content_controls();
    }

    protected function register_general_content_controls() {

        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'General', text_domain ),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label'   => __( 'Heading', text_domain ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => '2',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Design is a funny word', text_domain ),
            ]
        );
        $this->add_control(
            'heading_link',
            [
                'label'       => __( 'Link', text_domain ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', text_domain ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => [
                    'url' => '',
                ],
            ]
        );
        $this->add_control(
            'heading_description',
            [
                'label'   => __( 'Description', text_domain ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_separator_content_controls() {
        $this->start_controls_section(
            'section_separator_field',
            [
                'label' => __( 'Separator', text_domain ),
            ]
        );
        $this->add_control(
            'heading_separator_style',
            [
                'label'       => __( 'Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'       => __( 'None', text_domain ),
                    'line'       => __( 'Line', text_domain ),
                    'line_icon'  => __( 'Line With Icon', text_domain ),
                    'line_image' => __( 'Line With Image', text_domain ),
                    'line_text'  => __( 'Line With Text', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'heading_separator_position',
            [
                'label'       => __( 'Separator Position', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'center',
                'label_block' => false,
                'options'     => [
                    'center' => __( 'Between Heading & Description', text_domain ),
                    'top'    => __( 'Top', text_domain ),
                    'bottom' => __( 'Bottom', text_domain ),
                    'right'  => __( 'Heading Side', text_domain ),
                ],
                'condition'   => [
                    'heading_separator_style!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'separator_long',
            [
                'label'        => __( 'Out Separator', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', text_domain ),
                'label_off'    => __( 'No', text_domain ),
                'return_value' => 'yes',
                'default'      => '',
                'condition'   => [
                    'heading_separator_position' => 'right',
                ],
                'separator'    => 'before',
            ]
        );

        /* Separator line with Icon */
        $this->add_control(
            'heading_icon',
            [
                'label' => __( 'Select Icon', 'text-domain' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'heading_separator_style' => 'line_icon',
                ],
            ]
        );

        /* Separator line with Image */
        $this->add_control(
            'heading_image_type',
            [
                'label'       => __( 'Photo Source', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'media',
                'label_block' => false,
                'options'     => [
                    'media' => __( 'Media Library', text_domain ),
                    'url'   => __( 'URL', text_domain ),
                ],
                'condition'   => [
                    'heading_separator_style' => 'line_image',
                ],
            ]
        );
        $this->add_control(
            'heading_image',
            [
                'label'     => __( 'Photo', text_domain ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => [
                    'heading_separator_style' => 'line_image',
                    'heading_image_type'      => 'media',
                ],
            ]
        );
        $this->add_control(
            'heading_image_link',
            [
                'label'         => __( 'Photo URL', text_domain ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url' => '',
                ],
                'show_external' => false, // Show the 'open in new tab' button.
                'condition'     => [
                    'heading_separator_style' => 'line_image',
                    'heading_image_type'      => 'url',
                ],
            ]
        );

        /* Separator line with text */
        $this->add_control(
            'heading_line_text',
            [
                'label'     => __( 'Enter Text', text_domain ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Wordpress', text_domain ),
                'condition' => [
                    'heading_separator_style' => 'line_text',
                ],
                'dynamic'   => [
                    'active' => true,
                ],
                'selector'  => '{{WRAPPER}} .themento-divider-text',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_content_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'General', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'heading_text_align',
            [
                'label'        => __( 'Overall Alignment', text_domain ),
                'type'         => Controls_Manager::CHOOSE,
                'default'     => 'center',
                'options'      => [
                    'right'   => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'left'  => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fa fa-align-left',
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} .themento-heading,{{WRAPPER}} .themento-subheading, {{WRAPPER}} .themento-subheading *, {{WRAPPER}} .themento-separator-parent' => 'text-align: {{VALUE}};',
                ],
                'prefix_class' => 'themento%s-heading-align-',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_heading_typo_content_controls() {
        $this->start_controls_section(
            'section_heading_typography',
            [
                'label' => __( 'Heading', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_tag',
            [
                'label'   => __( 'HTML Tag', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => TMT_Title_Tags(),
                'default' => 'h2',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'selector' => '{{WRAPPER}} .themento-heading, {{WRAPPER}} .themento-heading a',
            ]
        );
        $this->add_control(
            'heading_color_type',
            [
                'label'        => __( 'Fill', text_domain ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'color'    => __( 'Color', text_domain ),
                    'gradient' => __( 'Background', text_domain ),
                ],
                'default'      => 'color',
                'prefix_class' => 'themento-heading-fill-',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .themento-heading-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'heading_color_type' => 'color',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'heading_color_gradient',
                'types'          => [ 'gradient', 'classic' ],
                'selector'       => '{{WRAPPER}} .themento-heading-text',
                'condition'      => [
                    'heading_color_type' => 'gradient',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'heading_shadow',
                'selector' => '{{WRAPPER}} .themento-heading-text',
            ]
        );
        $this->add_control(
            'heading_margin',
            [
                'label'      => __( 'Heading Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '0',
                    'bottom'   => '15',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();
    }
    protected function register_desc_typo_content_controls() {

        $this->start_controls_section(
            'section_desc_typography',
            [
                'label'     => __( 'Description', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading_description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'heading_desc_typography',
                'selector'  => '{{WRAPPER}} .themento-subheading',
                'condition' => [
                    'heading_description!' => '',
                ],
            ]
        );
        $this->add_control(
            'heading_desc_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'heading_description!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-subheading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_desc_margin',
            [
                'label'      => __( 'Description Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '15',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'condition'  => [
                    'heading_description!' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();
    }
    protected function register_imgicon_content_controls() {

        $this->start_controls_section(
            'section_separator_line_style',
            [
                'label'     => __( 'Separator - Line', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading_separator_style!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'heading_line_style',
            [
                'label'       => __( 'Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'solid',
                'label_block' => false,
                'options'     => [
                    'solid'  => __( 'Solid', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'double' => __( 'Double', text_domain ),
                ],
                'condition'   => [
                    'heading_separator_style!' => 'none',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .themento-separator, {{WRAPPER}} .themento-separator-line > span' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_line_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_separator_style!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-separator, {{WRAPPER}} .themento-separator-line > span, {{WRAPPER}} .themento-divider-text' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_line_thickness',
            [
                'label'      => __( 'Thickness', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'heading_separator_style!' => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-separator, {{WRAPPER}} .themento-separator-line > span ' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_line_width',
            [
                'label'          => __( 'Width', text_domain ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => [ '%', 'px' ],
                'range'          => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'default'        => [
                    'size' => 20,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'label_block'    => true,
                'condition'      => [
                    'heading_separator_style!' => 'none',
                    'separator_long!' => 'yes',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .themento-separator, {{WRAPPER}} .themento-separator-wrap, {{WRAPPER}} .line-right .themento-separator-parent' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_imgicon_style',
            [
                'label'     => __( 'Separator - Icon / Image / Text', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading_separator_style' => [ 'line_icon', 'line_image', 'line_text' ],
                ],
            ]
        );

        $this->add_control(
            'heading_line_text_color',
            [
                'label'     => __( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_separator_style' => 'line_text',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-divider-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'heading_separator_typography',
                'condition' => [
                    'heading_separator_style' => 'line_text',
                ],
                'selector'  => '{{WRAPPER}} .themento-divider-text',
            ]
        );

        $this->add_responsive_control(
            'heading_icon_size',
            [
                'label'      => __( 'Icon Size', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'heading_separator_style' => 'line_icon',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; text-align: center;',
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon,{{WRAPPER}} .themento-icon-wrap .themento-icon svg' => ' height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_image_size',
            [
                'label'      => __( 'Image Size', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'heading_separator_style' => 'line_image',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-image .themento-photo-img'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_icon_position',
            [
                'label'          => __( 'Position', text_domain ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => [ '%' ],
                'range'          => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'        => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'condition'      => [
                    'heading_separator_style' => [ 'line_icon', 'line_image', 'line_text' ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .themento-side-left'  => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themento-side-right' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_icon_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '10',
                    'right'    => '10',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'condition'  => [
                    'heading_separator_style' => [ 'line_icon', 'line_image', 'line_text' ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-divider-content' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'heading_icon_fields',
            [
                'label'     => __( 'Style', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'heading_separator_style!' => [ 'none', 'line_text' ],
                ],
            ]
        );

        $this->add_control(
            'heading_imgicon_style_options',
            [
                'label'       => __( 'Select Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'simple',
                'label_block' => false,
                'options'     => [
                    'simple' => __( 'Simple', text_domain ),
                    'custom' => __( 'Design your own', text_domain ),
                ],
                'condition'   => [
                    'heading_separator_style!' => [ 'none', 'line_text' ],
                ],
            ]
        );
        $this->add_control(
            'headings_icon_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'simple',
                    'heading_separator_style'       => 'line_icon',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'headings_icon_hover_color',
            [
                'label'     => __( 'Icon Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'simple',
                    'heading_separator_style'       => 'line_icon',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover i'  => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'headings_icon_animation',
            [
                'label'     => __( 'Hover Animation', text_domain ),
                'type'      => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'heading_imgicon_style_options' => 'simple',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
            ]
        );

        $this->start_controls_tabs( 'heading_imgicon_style' );

        $this->start_controls_tab(
            'heading_imgicon_normal',
            [
                'label'     => __( 'Normal', text_domain ),
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
            ]
        );

        $this->add_control(
            'heading_icon_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style'       => 'line_icon',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon svg'  => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_icon_bgcolor',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_icon_bg_size',
            [
                'label'      => __( 'Background Size', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => '0',
                    'unit' => 'px',
                ],
                'condition'  => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content' => 'padding: {{SIZE}}{{UNIT}}; display:inline-block; box-sizing:content-box;',
                ],
            ]
        );

        $this->add_control(
            'heading_icon_border',
            [
                'label'       => __( 'Border Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', text_domain ),
                    'solid'  => __( 'Solid', text_domain ),
                    'double' => __( 'Double', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                ],
                'condition'   => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_icon_border_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                    'heading_icon_border!'          => 'none',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_icon_border_size',
            [
                'label'      => __( 'Border Width', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                    'heading_icon_border!'          => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
                ],
            ]
        );
        $this->add_control(
            'heading_icon_border_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default'    => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'heading_imgicon_hover',
            [
                'label'     => __( 'Hover', text_domain ),
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
            ]
        );
        $this->add_control(
            'heading_icon_hover_color',
            [
                'label'     => __( 'Icon Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style'       => 'line_icon',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover i'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover svg'  => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_hover_bgcolor',
            [
                'label'     => __( 'Background Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover, {{WRAPPER}} .themento-image-content:hover' => 'background-color: {{VALUE}};',

                ],
            ]
        );
        $this->add_control(
            'heading_icon_hover_border',
            [
                'label'     => __( 'Border Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                    'heading_icon_border!'          => 'none',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover, {{WRAPPER}} .themento-image-content:hover ' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_icon_animation',
            [
                'label'     => __( 'Hover Animation', text_domain ),
                'type'      => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'heading_imgicon_style_options' => 'custom',
                    'heading_separator_style!'      => [ 'none', 'line_text' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function render_separator( $pos, $settings ) {
        if ( 'none' != $settings['heading_separator_style'] && $pos == $settings['heading_separator_position'] ) {
            ?>
            <div class="themento-module-content themento-separator-parent <?php if ( 'right' == $settings['heading_separator_position'] && 'yes' == $settings['separator_long'] ) {echo 'separator-long';}?>">
                <?php if ( 'line_icon' == $settings['heading_separator_style'] || 'line_image' == $settings['heading_separator_style'] || 'line_text' == $settings['heading_separator_style'] ) { ?>
                    <div class="themento-separator-wrap">
                        <div class="themento-separator-line themento-side-left">
                            <span></span>
                        </div>
                        <div class="themento-divider-content">
                            <?php $this->render_image(); ?>
                            <?php
                            if ( 'line_text' == $settings['heading_separator_style'] ) {
                                echo '<span class="themento-divider-text elementor-inline-editing" data-elementor-setting-key="heading_line_text" data-elementor-inline-editing-toolbar="basic">' . $this->get_settings_for_display( 'heading_line_text' ) . '</span>';
                            }
                            ?>

                        </div>
                        <div class="themento-separator-line themento-side-right">
                            <span></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( 'line' == $settings['heading_separator_style'] ) { ?>
                    <div class="themento-separator"></div>
                <?php } ?>
            </div>
            <?php
        }
    }
    public function render_image() {
        $settings = $this->get_settings_for_display();

        if ( 'line_icon' == $settings['heading_separator_style'] || 'line_image' == $settings['heading_separator_style'] ) {
            $anim_class = '';
            if ( 'simple' == $settings['heading_imgicon_style_options'] ) {
                $anim_class = $settings['headings_icon_animation'];
            } elseif ( 'custom' == $settings['heading_imgicon_style_options'] ) {
                $anim_class = $settings['heading_icon_animation'];
            }
            ?>
            <div class="themento-module-content themento-imgicon-wrap elementor-animation-<?php echo $anim_class; ?>"><?php /* Module Wrap */ ?>
                <?php /*Icon Html */ ?>
                <?php if ( 'line_icon' == $settings['heading_separator_style'] ) { ?>
                    <div class="themento-icon-wrap">
						<span class="themento-icon">
                            <?php Icons_Manager::render_icon( $settings['heading_icon']); ?>
						</span>
                    </div>
                <?php } // Icon Html End. ?>

                <?php /* Photo Html */ ?>
                <?php
                if ( 'line_image' == $settings['heading_separator_style'] ) {
                    if ( 'media' == $settings['heading_image_type'] ) {
                        if ( ! empty( $settings['heading_image']['url'] ) ) {
                            $this->add_render_attribute( 'heading_image', 'src', $settings['heading_image']['url'] );
                            $this->add_render_attribute( 'heading_image', 'alt', Control_Media::get_image_alt( $settings['heading_image'] ) );

                            $image_html = '<img class="themento-photo-img" ' . $this->get_render_attribute_string( 'heading_image' ) . '>';
                        }
                    }
                    if ( 'url' == $settings['heading_image_type'] ) {
                        if ( ! empty( $settings['heading_image_link'] ) ) {

                            $this->add_render_attribute( 'heading_image_link', 'src', $settings['heading_image_link']['url'] );

                            $image_html = '<img class="themento-photo-img" ' . $this->get_render_attribute_string( 'heading_image_link' ) . '>';
                        }
                    }
                    ?>
                    <div class="themento-image" itemscope itemtype="http://schema.org/ImageObject">
                        <div class="themento-image-content">
                            <?php echo $image_html; ?>
                        </div>
                    </div>
                <?php } // Photo Html End. ?>
            </div>
            <?php
        }
    }
    protected function render() {
        $html             = '';
        $settings         = $this->get_settings();
        $dynamic_settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'heading_title', 'basic' );
        $this->add_inline_editing_attributes( 'heading_description', 'advanced' );

        if ( empty( $dynamic_settings['heading_title'] ) ) {
            return;
        }

        if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) {
            $this->add_render_attribute( 'url', 'href', $dynamic_settings['heading_link']['url'] );

            if ( $dynamic_settings['heading_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $dynamic_settings['heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
            $link = $this->get_render_attribute_string( 'url' );
        }
        ?>
        <div class="themento-module-content themento-heading-wrapper <?php if ( 'right' == $settings['heading_separator_position'] ) {echo 'flex align-items-center line-right flex-wrap';} ?>">
        <?php $this->render_separator( 'top', $settings ); ?>
        <?php $this->render_separator( 'right', $settings ); ?>

        <<?php echo $settings['heading_tag']; ?> class="themento-heading">
        <?php if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) { ?>
        <a <?php echo $link; ?> >
    <?php } ?>
        <span class="themento-heading-text elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" ><?php echo $this->get_settings_for_display( 'heading_title' ); ?></span>
        <?php if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) { ?>
        </a>
    <?php } ?>
        </<?php echo $settings['heading_tag']; ?>>

        <?php $this->render_separator( 'center', $settings ); ?>

        <?php if ( '' != $dynamic_settings['heading_description'] ) { ?>
            <div class="themento-subheading elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="advanced" >
                <?php echo $this->get_settings_for_display( 'heading_description' ); ?>
            </div>
        <?php } ?>

        <?php $this->render_separator( 'bottom', $settings ); ?>
        </div>
        <?php
    }
    protected function _content_template() {
        ?>
        <#
        function render_separator( pos ) {
        if ( 'none' != settings.heading_separator_style && pos == settings.heading_separator_position ) {
        #>
        <div class="themento-module-content themento-separator-parent <# if ( 'right' == settings.heading_separator_position && 'yes' == settings.separator_long ) { #> separator-long <# } #>">
            <# if ( 'line_icon' == settings.heading_separator_style || 'line_image' == settings.heading_separator_style || 'line_text' == settings.heading_separator_style ) { #>
            <div class="themento-separator-wrap">
                <div class="themento-separator-line themento-side-left">
                    <span></span>
                </div>
                <div class="themento-divider-content">
                    <#
                    render_image();
                    if ( 'line_text' == settings.heading_separator_style ) { #>
                    <span class="themento-divider-text elementor-inline-editing" data-elementor-setting-key="heading_line_text" data-elementor-inline-editing-toolbar="basic">{{{ settings.heading_line_text }}}</span>
                    <# } #>
                </div>
                <div class="themento-separator-line themento-side-right">
                    <span></span>
                </div>
            </div>
            <# } #>
            <# if ( 'line' == settings.heading_separator_style ) { #>
            <div class="themento-separator"></div>
            <# } #>
        </div>
        <#
        }
        }
        #>


        <#
        function render_image() {
        if ( 'line_icon' == settings.heading_separator_style || 'line_image' == settings.heading_separator_style ) {

        view.addRenderAttribute( 'anim_class', 'class', 'themento-module-content themento-imgicon-wrap' );

        if ( 'simple' == settings.heading_imgicon_style_options ) {
        view.addRenderAttribute( 'anim_class', 'class', 'elementor-animation-' + settings.headings_icon_animation );
        }
        else if ( 'custom' == settings.heading_imgicon_style_options ) {
        view.addRenderAttribute( 'anim_class', 'class', 'elementor-animation-' + settings.heading_icon_animation );
        }
        #>
        <div {{{ view.getRenderAttributeString( 'anim_class' ) }}} >
        <# if ( 'line_icon' == settings.heading_separator_style ) {
        iconHTML = elementor.helpers.renderIcon( view, settings.heading_icon, { 'aria-hidden': true }, 'i' , 'object' );
        #>
        <div class="themento-icon-wrap">
							<span class="themento-icon">
								{{{ iconHTML.value }}}
							</span>
        </div>
        <# } #>
        <# if ( 'line_image' == settings.heading_separator_style ) { #>
        <div class="themento-image" itemscope itemtype="http://schema.org/ImageObject">
            <div class="themento-image-content">
                <#
                if ( 'media' == settings.heading_image_type ) {
                if ( '' != settings.heading_image.url ) {
                view.addRenderAttribute( 'heading_image', 'src', settings.heading_image.url );
                #>
                <img class="themento-photo-img" {{{ view.getRenderAttributeString( 'heading_image' ) }}}>
                <#
                }
                }
                if ( 'url' == settings.heading_image_type ) {
                if ( '' != settings.heading_image_link ) {
                view.addRenderAttribute( 'heading_image_link', 'src', settings.heading_image_link.url );
                #>
                <img class="themento-photo-img" {{{ view.getRenderAttributeString( 'heading_image_link' ) }}}>
                <#
                }
                } #>
            </div>
        </div>
        <# } #>
        </div>
        <#
        }
        }
        #>

        <#
        if ( '' == settings.heading_title ) {
        return;
        }
        if ( '' != settings.heading_link.url ) {
        view.addRenderAttribute( 'url', 'href', settings.heading_link.url );
        }
        #>
        <div class="themento-module-content themento-heading-wrapper <# if ( 'right' == settings.heading_separator_position ) { #> flex align-items-center line-right flex-wrap <# } #>">
            <# render_separator( 'top' ); #>
            <# render_separator( 'right' ); #>
            <{{{ settings.heading_tag }}} class="themento-heading">
            <# if ( '' != settings.heading_link.url ) { #>
            <a {{{ view.getRenderAttributeString( 'url' ) }}} >
            <# } #>
            <span class="themento-heading-text elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" >{{{ settings.heading_title }}}</span>
            <# if ( '' != settings.heading_link.url ) { #>
            </a>
            <# } #>
        </div>

        <# render_separator( 'center' ); #>

        <# if ( '' != settings.heading_description ) { #>
        <div class="themento-subheading elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="basic" >
            {{{ settings.heading_description }}}
        </div>
        <# } #>
        <# render_separator( 'bottom' ); #>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_heading );