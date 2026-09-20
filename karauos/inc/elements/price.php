<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Price extends Widget_Base{

	public function get_name(){
		return 'themento-price-table';
	}

	public function get_title(){
		return __( 'Price Table', text_domain );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ text_domain ];
	}

	protected function _register_controls() {
		$this->register_header_controls();
		$this->register_item_controls();
		$this->register_footer_controls();
		$this->register_general_style_controls();
		$this->register_header_style_controls();
		$this->register_item_style_controls();
		$this->register_footer_style_controls();
	}
	protected function register_header_controls() {
		$this->start_controls_section(
			'header',
			[
				'label' => __( 'Header', text_domain )
			]
		);
        $this->add_control(
            'logo_type',
            [
                'label' => __( 'Type', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', text_domain ),
                        'icon' => 'fas fa-info-circle',
                    ],
                    'image' => [
                        'title' => __( 'Image', text_domain ),
                        'icon' => 'far fa-image',
                    ],
                    'none' => [
                        'title' => __( 'None', text_domain ),
                        'icon' => 'fas fa-ban',
                    ],
                ],
                'default' => 'icon',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'header_icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'logo_type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'header_image',
            [
                'label' => __( 'Choose Image', text_domain ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'logo_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'header_title',
            [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Default title', text_domain ),
                'placeholder' => __( 'Type your title here', text_domain ),
            ]
        );

        $this->add_control(
            'header_sub_title',
            [
                'label' => __( 'Sub Title', text_domain ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Type your sub title here', text_domain ),
            ]
        );


		$this->end_controls_section();
	}
	protected function register_item_controls() {
        $this->start_controls_section(
            'list',
            [
                'label' => __( 'List', text_domain )
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
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'list_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i,{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'color: {{VALUE}} !important;fill: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_control(
            'list_item',
            [
                'label' => __( 'Repeater List', text_domain ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Title #1', text_domain ),
                    ],
                    [
                        'list_title' => __( 'Title #2', text_domain ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_footer_controls() {
        $this->start_controls_section(
            'footer',
            [
                'label' => __( 'Footer', text_domain )
            ]
        );

        $this->add_control(
            'before',
            [
                'label' => __( 'Before Button', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Default title', text_domain ),
                'placeholder' => __( 'Type your before button here', text_domain ),
            ]
        );

        $this->add_control(
            'text_btn',
            [
                'label' => __( 'Text Button', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Default title', text_domain ),
                'placeholder' => __( 'Type your text button here', text_domain ),
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => __( 'Link', text_domain ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', text_domain ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                ],
                'condition' => [
                    'text_btn!' => ''
                ]
            ]
        );

        $this->add_control(
            'after',
            [
                'label' => __( 'After Button', text_domain ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Default title', text_domain ),
                'placeholder' => __( 'Type your after button here', text_domain ),
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_style_controls() {
        $this->start_controls_section(
            'style_general',
            [
                'label' => __( 'General', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'general_height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .general-list-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('style_general_tabs');
        $this->start_controls_tab('style_general_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);

        $this->add_control(
            'border_radius_general',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_general',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .item',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_general',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .item',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_general_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_control(
            'hover_border_radius_general',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_border_general',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow_general',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .item:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
    }
    protected function register_header_style_controls() {
        $this->start_controls_section(
            'style_header',
            [
                'label' => __( 'Header', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .price-header' => 'text-align: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'padding_header',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('style_header_tabs');
        $this->start_controls_tab('style_header_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_header',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .item .price-header',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_header_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_header',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .item:hover .price-header',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'icon_heading',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'logo_type' => 'icon'
                ]
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
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-price i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .image-price svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'logo_type' => 'icon'
                ]
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image-price i,{{WRAPPER}} .image-price svg' => 'color: {{VALUE}};fill: {{VALUE}};',
                ],
                'condition' => [
                    'logo_type' => 'icon'
                ]
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __( 'Icon Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .image-price i,{{WRAPPER}} .item:hover .image-price svg' => 'color: {{VALUE}};fill: {{VALUE}};',
                ],
                'condition' => [
                    'logo_type' => 'icon'
                ]
            ]
        );
        $this->add_control(
            'image_heading',
            [
                'label' => __( 'Image', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'logo_type' => 'image'
                ]
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-price img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'logo_type' => 'image'
                ]
            ]
        );
        $this->start_controls_tabs('style_img_tabs');
        $this->start_controls_tab('style_img_normal_tab', ['label' => __( 'Normal', 'elementor' ),
            'condition' => [
                'logo_type' => 'image'
            ]
            ]);

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .image-price img',
                'condition' => [
                    'logo_type' => 'image'
                ]
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_img_hover_tab', [
            'label' => __( 'Hover', 'elementor' ),
            'condition' => [
                'logo_type' => 'image'
            ]
            ]);

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'hover_css_filters',
                'selector' => '{{WRAPPER}} .item:hover .image-price img',
                'condition' => [
                    'logo_type' => 'image'
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Title', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_title!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', text_domain ),
                'selector' => '{{WRAPPER}} .price-header .title',
                'condition' => [
                    'header_title!' => ''
                ]
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-header .title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'header_title!' => ''
                ]
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Title Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .price-header .title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'header_title!' => ''
                ]
            ]
        );
        $this->add_control(
            'sub_title_heading',
            [
                'label' => __( 'Sub Title', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_sub_title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __( 'Sub Title Typography', text_domain ),
                'selector' => '{{WRAPPER}} .price-header .sub-title',
                'condition' => [
                    'header_sub_title!' => ''
                ]
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Sub Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-header .sub-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'header_sub_title!' => ''
                ]
            ]
        );
        $this->add_control(
            'sub_title_hover_color',
            [
                'label' => __( 'Sub Title Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .price-header .sub-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'header_sub_title!' => ''
                ]
            ]
        );


        $this->end_controls_section();
    }
    protected function register_item_style_controls() {
        $this->start_controls_section(
            'style_item',
            [
                'label' => __( 'Item', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_item',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .item ul',
            ]
        );
        $this->add_control(
            'padding_item',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .item ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => is_rtl() ? '' : 'flex-row-reverse',
                'options' => [
                    ''  => __( 'Before', text_domain ),
                    'flex-row-reverse' => __( 'After', text_domain ),
                ],
            ]
        );
        $this->start_controls_tabs('style_item_tabs');
        $this->start_controls_tab('style_item_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);

        $this->add_control(
            'item_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'item_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item ul li i,{{WRAPPER}} .item ul li svg' => 'color: {{VALUE}};fill: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->start_controls_tab('style_item_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_control(
            'item_hover_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item ul li:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'item_hover_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item ul li:hover i,{{WRAPPER}} .item ul li:hover svg' => 'color: {{VALUE}} !important;fill: {{VALUE}} !important',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();




        $this->end_controls_section();
    }
    protected function register_footer_style_controls() {
        $this->start_controls_section(
            'style_footer',
            [
                'label' => __( 'Footer', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_align_footer',
            [
                'label' => __( 'Alignment', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __( 'Left', text_domain ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __( 'Right', text_domain ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );
        $this->add_control(
            'padding_footer',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('style_footer_tabs');
        $this->start_controls_tab('style_footer_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_footer',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} footer',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_footer_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_footer',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .item:hover footer',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'before_btn_heading',
            [
                'label' => __( 'Before Button', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'before!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'before_button_typography',
                'label' => __( 'Before Button Typography', text_domain ),
                'selector' => '{{WRAPPER}} footer .price-item',
                'condition' => [
                    'before!' => ''
                ]
            ]
        );
        $this->add_control(
            'before_button_color',
            [
                'label' => __( 'Before Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} footer .price-item' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'before!' => ''
                ]
            ]
        );
        $this->add_control(
            'before_button_hover_color',
            [
                'label' => __( 'Before Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover footer .price-item' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'before!' => ''
                ]
            ]
        );

        $this->add_control(
            'after_btn_heading',
            [
                'label' => __( 'After Button', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'after!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'after_button_typography',
                'label' => __( 'After Button Typography', text_domain ),
                'selector' => '{{WRAPPER}} footer .ft-text',
                'condition' => [
                    'after!' => ''
                ]
            ]
        );
        $this->add_control(
            'after_button_color',
            [
                'label' => __( 'After Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} footer .ft-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'after!' => ''
                ]
            ]
        );
        $this->add_control(
            'after_button_hover_color',
            [
                'label' => __( 'After Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover footer .ft-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'after!' => ''
                ]
            ]
        );

        $this->add_control(
            'btn_heading',
            [
                'label' => __( 'Button', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'text_btn!' => ''
                ]
            ]
        );
        $this->add_control(
            'padding_link',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .link-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'text_btn!' => ''
                ]
            ]
        );
        $this->add_control(
            'border_radius_link',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .link-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('style_link_tabs');
        $this->start_controls_tab('style_link_normal_tab', ['label' => __( 'Normal', 'elementor' ),
            'condition' => [
                'text_btn!' => ''
            ]
        ]);

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link-price' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'after!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_link',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .link-price',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_link',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .link-price',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_link_hover_tab', ['label' => __( 'Hover', 'elementor' ),
            'condition' => [
                'text_btn!' => ''
            ]
            ]);
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item:hover .link-price' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'after!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_link',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .item:hover .link-price',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_border_link',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .item:hover .link-price',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


	protected function render( ) {
		$settings = $this->get_settings();

        $logo_type = $settings['logo_type'];
        $header_title = $settings['header_title'];
        $header_sub_title = $settings['header_sub_title'];
        $list_item = $settings['list_item'];
        $before = $settings['before'];
        $after = $settings['after'];
        $text_btn = $settings['text_btn'];
        $btn_link = $settings['btn_link'];
        $text_align_footer = $settings['text_align_footer'];

        echo "<div class='price'>"
            . "<article class='item text-center'>"
            . "<header class='price-header'>"
                . "<div class='image-price'>";
                    if ($logo_type == 'icon') {
                        Icons_Manager::render_icon($settings["header_icon"]);
                    } elseif ($logo_type == 'image') {
                        echo '<img src="' . $settings['header_image']['url'] . '">';
                    }
                echo "</div>";
                if (!empty($header_title)){
                    echo "<h3 class='title'>$header_title</h3>";
                }
                if (!empty($header_sub_title)){
                    echo "<h4 class='sub-title'>$header_sub_title</h4>";
                }
            echo "</header>"
            . "<div class='general-list-item flex flex-column justify-content-between'>";
                if ($list_item) {
                    echo "<ul class='flex flex-column align-items-center'>";
                    foreach ($list_item as $item ) {
                        echo '<li class="flex align-items-center '. $settings['icon_position'] .' list-item elementor-repeater-item-' . $item['_id'] . '">'; Icons_Manager::render_icon($item["list_icon"]); echo $item['list_title'] . '</li>';
                    }
                    echo "</ul>";
                }
                echo "<footer class='flex flex-column align-items-$text_align_footer'>"
                    . "<span class='price-item'>$before</span>";
                        $target = $btn_link['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $btn_link['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<a class="link-price" href="' . $btn_link['url'] . '"' . $target . $nofollow . '>'. $text_btn .'</a>';
                    echo "<span class='ft-text'>$after</span>"
                . "</footer>"
            . "</div>"
        . "</article>"
        . "</div>";
	}
	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Price );