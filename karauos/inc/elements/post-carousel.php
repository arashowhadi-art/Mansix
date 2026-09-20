<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_Post_Carousel extends Widget_Base {

    public function get_name() {
        return 'themento_post_carousel';
    }

    public function get_title() {
        return __( 'Post Carousel', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    protected function _register_controls() {
        $this->register_general_post_carousel_controls();
        $this->register_general_post_carousel_slider_setting_controls();
        $this->register_general_post_carousel_style_controls();
        $this->register_post_carousel_title_style_controls();
        $this->register_post_carousel_icon_style_controls();
        $this->register_general_slide_navigation_style_controls();
    }

    protected function register_general_post_carousel_controls() {
        $this->start_controls_section(
            'section_post_carousel',
            [
                'label' => __( 'Post Settings', text_domain )
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => __( 'Post Type', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => get_posts_types(),
            ]
        );

        $post_types = get_posts_types();
        foreach ( $post_types as $post_type => $x ) {
			$taxonomies = get_object_taxonomies($post_type, 'objects');
			unset($taxonomies['post_translations'],$taxonomies['language'],$taxonomies['post_format']); 
            foreach ( $taxonomies as $object ) {
                $categories = get_terms( array(
                    'taxonomy'    => $object->name,
                    'hide_empty' => 0,
                ) );
                $cat_array  = array();
                foreach( $categories as $cat_id => $cat_name ) {
                    $cat_array[ $cat_name->term_id ] = $cat_name->name;
                }
                @$this->add_control(
                    $object->name,
                    [
                        'label' => $object->label,
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => $cat_array,
                        'condition' => [
                            'post_type' => $object->object_type
                        ],
                    ]
                );
            }
        }
        $this->add_control(
            'posts_count_carousel',
            [
	            'label' => __( 'Number of Posts', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => '6'
            ]
        );
        $this->add_control(
            'post_order_carousel',
            [
	            'label' => __( 'Order', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
					'asc' => __( 'Ascending', text_domain ),
					'desc' => __( 'Descending', text_domain )
				],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'post_carousel_columns',
            [
	            'label' => __( 'Number of Columns', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title Tag', text_domain ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'multiple' => true,
                'options' => TMT_Title_Tags(),
                'default' => 'h3',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );
        $this->add_control(
            'object_fit',
            [
                'label' => __( 'Image Fit', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'inherit' => __( 'None', text_domain ),
                    'cover' => __( 'Cover', text_domain ),
                    'contain' => __( 'Contain', text_domain ),
                    'fill' => __( 'Fill', text_domain ),
                    'scale-down' => __( 'Scale Down', text_domain ),
                ],
                'default' => 'inherit',
                'selectors' => [
                    '{{WRAPPER}} img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
			'light_box_icon',
			[
				'label' => __( 'Enable Light Box Icon', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'light_link_icon',
			[
				'label' => __( 'Enable Link Icon', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'full_link',
			[
				'label' => __( 'Enable Full Link', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->end_controls_section();
    }
    protected function register_general_post_carousel_slider_setting_controls() {
        $this->start_controls_section(
            'section_post_carousel_slider',
            [
                'label' => __( 'Slider Settings', text_domain )
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
                    '{{WRAPPER}} .slick-slide' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
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
            'centerMode',
            [
                'label' => __( 'Center Mode', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_title',
            [
                'label' => __( 'Show Title', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( 'Yes', text_domain ),
                        'icon' => 'fa fa-check',
                    ],
                    '0' => [
                        'title' => __( 'No', text_domain ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => '1'
            ]
        );
        $this->end_controls_section();
    }
    protected function register_general_post_carousel_style_controls() {
        $this->start_controls_section(
            'section_post_carousel_style',
            [
	            'label' => __( 'Post Carousel Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'post_carousel_height',
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
                    'size' => 300,
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'themento_thumbnail_overlay_color',
            [
	            'label' => __( 'Hover Post Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slider-item' => 'background-color: {{VALUE}}',
                ]

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'themento_post_carousel_border',
                'selector' => '{{WRAPPER}} .elementor-slick-slider .slick-slide img',
            ]
        );
        $this->add_control(
            'themento_post_carousel_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slick-slider .slick-slide, {{WRAPPER}} .elementor-slick-slider .slick-slide img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'themento_post_carousel_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-slick-slider .slick-slide',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_post_carousel_title_style_controls() {
        $this->start_controls_section(
            'section_title_post_carousel_style',
            [
	            'label' => __( 'Title Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_carousel_title_typography',
                'selector' => '{{WRAPPER}} .title-portfolio',
            ]
        );
        $this->add_responsive_control(
            'post_carousel_title_alignment',
            [
	            'label' => __( 'Title Alignment', text_domain ),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'post_carousel_title_height',
            [
	            'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'padding: {{SIZE}}{{UNIT}} 0;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'post_carousel_title_width',
            [
	            'label' => __( 'Title Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'        => [
                    'unit' => '%',
                ],
                'size_units' => '%',
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->start_controls_tabs( 'post_carousel_title_tabs' );
        $this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', text_domain ) ] );

        $this->add_control(
            'post_carousel_title_color',
            [
	            'label' => __( 'Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'color: {{VALUE}}',
                ]

            ]
        );
        $this->add_control(
            'post_carousel_bg_title_color',
            [
	            'label' => __( 'Title Background', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'background-color: {{VALUE}}',
                ]

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_carousel_bg_title_border',
                'selector' => '{{WRAPPER}} .title-portfolio',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', text_domain ) ] );

        $this->add_control(
            'post_carousel_title_hover_color',
            [
	            'label' => __( 'Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio:hover' => 'color: {{VALUE}}',
                ]

            ]
        );
        $this->add_control(
            'post_carousel_bg_hover_title_color',
            [
	            'label' => __( 'Title Background', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_carousel_bg_c_hover_border',
                'selector' => '{{WRAPPER}} .title-portfolio:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'post_carousel_border_radius_title',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .title-portfolio' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_carousel_title_box_shadow',
                'selector' => '{{WRAPPER}} .title-portfolio',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_post_carousel_icon_style_controls() {
        $this->start_controls_section(
            'section_icon_style',
            [
	            'label' => __( 'Icons', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'post_carousel_icon_size',
            [
	            'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 2.4,
                ],
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .back a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'post_carousel_icon_border_radius',
            [
	            'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .back a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'after',
            ]
        );
        $this->start_controls_tabs('style_icon_tabs');
        $this->start_controls_tab('style_icon_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'post_carousel_icon_color',
            [
	            'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .back a' => 'color: {{VALUE}}',
                ]

            ]
        );
        $this->add_control(
            'post_carousel_icon_bg_color',
            [
	            'label' => __( 'Icon Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .back a' => 'background-color: {{VALUE}}',
                ]

            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_icon_hover_tab', ['label' => __( 'Hover', text_domain ),]);
        $this->add_control(
            'post_carousel_icon_hover_color',
            [
	            'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .back a:hover' => 'color: {{VALUE}}',
                ]

            ]
        );
        $this->add_control(
            'post_carousel_icon_hover_bg_color',
            [
	            'label' => __( 'Icon Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .back a:hover' => 'background-color: {{VALUE}}',
                ]

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
                'default' => '#000000C4',
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
                    '{{WRAPPER}} .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'   => [
                    'top' => '0',
                    'right' => '3',
                    'bottom' => '0',
                    'left' => '3',
                    'unit' => 'px',
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
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $post_type = $settings['post_type'];
        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $light_link_icon = $settings['light_link_icon'];
        $light_box_icon = $settings['light_box_icon'];
        $full_link = $settings['full_link'];
        $editor = Plugin::$instance->editor->is_edit_mode();
        $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
        $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
        $data_slick = [
            'slidesToShow' => $settings['post_carousel_columns'],
            'slidesToScroll' => 1,
            'autoplay' => ( 'yes' === $settings['autoplay'] ),
            'infinite' => ( 'yes' === $settings['infinite'] ),
            'speed' => absint( $settings['autoplay_speed'] ),
            'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
            'autoplaySpeed' => 2000,
            'arrows' => $show_arrows,
            'dots' => $show_dots,
            'rtl' => $is_rtl,
            'centerMode' => ( 'yes' === $settings['centerMode'] ),
        ];

        $this->add_render_attribute( 'slides', [
            'data-slick' => wp_json_encode( $data_slick ),
        ] );
        $image_size = $settings['image_size'];
        $id = $this->get_id();
        if('custom' == $image_size) {
            $width = $settings['image_custom_dimension']['width'];
            $height = $settings['image_custom_dimension']['height'];
            add_image_size( "custom-$id", $width, $height, true );
        }

        echo '<div class="elementor-slides-wrapper elementor-slick-slider" dir="' . esc_attr( $direction ) . '"> <div class="slider-show slick-slider" '.$this->get_render_attribute_string( 'slides' ).'>' ;
        $args = array(
            'posts_per_page' => $settings['posts_count_carousel'],
            'post_type' => $post_type,
            'post_status' => 'publish',
            'order' => $settings['post_order_carousel'],
        );
        $taxonomies = get_object_taxonomies($post_type, 'objects');
        foreach ( $taxonomies as $taxonomy => $object ) {
            if (! empty($settings[$object->name])) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $object->name,
                        'terms' => $settings[$object->name],
                    )
                );
            }
        }
        $query = new \WP_Query($args);
            if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
                $title_tag = $settings['title_tag'];
                $post_carousel_title_alignment = $settings['post_carousel_title_alignment'];
                $title = get_the_title();
                $permalink = get_the_permalink();
                echo "<div class='slider-item'>";
                if($full_link == 'yes') {echo "<a class='full-link' href='$permalink'>". __( 'Read More', text_domain ) ."</a>";}
                if('custom' == $image_size) {
                    tmt_post_thumbnail("$image_size-$id");
                } else {
                    tmt_post_thumbnail($image_size);
                }
                if( '1' === $settings['show_title'] ){echo "<$title_tag class='title-portfolio flex align-items-center justify-content-$post_carousel_title_alignment'>$title</$title_tag>";}
                if($light_box_icon == 'yes' || $light_link_icon == 'yes') {
                    echo "<div class='back-item flex justify-content-between'>";
                        if($light_box_icon == 'yes') {echo "<div class='back'><a href='"; if(has_post_thumbnail()){echo the_post_thumbnail_url('large');} else{echo wp_directory_uri . '/assets/images/thumbnail.jpg';} echo "' data-fancybox='gallery' data-caption='$title'><i class='fas fa-search'></i></a></div>";}
                        if($light_link_icon == 'yes') {echo "<div class='back'><a href='$permalink'><i class='fas fa-link'></i></a></div>";}
                    echo "</div>";
                }
                echo '</div>';
            endwhile;endif;wp_reset_postdata();
        echo '</div></div>';
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_Post_Carousel );