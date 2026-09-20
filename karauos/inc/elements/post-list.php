<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Post_List extends Widget_Base{

	public function get_name(){
		return 'tmt-post-list';
	}

	public function get_title(){
		return __( 'Post List', text_domain );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ text_domain ];
	}

	protected function _register_controls() {
		$this->register_general_post_list_controls();
        $this->register_general_post_list_style_controls();
        $this->register_image_post_list_style_controls();
		$this->register_title_post_list_style_controls();
		$this->register_icon_post_list_style_controls();
		$this->register_mata_tag_post_list_style_controls();
		$this->register_pagination_post_grid_style_controls();
	}
	protected function register_general_post_list_controls() {
		$this->start_controls_section(
			'section_post_list',
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
            foreach ( $taxonomies as $taxonomy => $object ) {
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

		$this->add_responsive_control(
			'post_list_columns',
			[
				'label' => __( 'Number of Columns', text_domain ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    '100%'       => __( '1 Columns', text_domain ),
                    '50%'        => __( '2 Columns', text_domain ),
                    '33.333333%' => __( '3 Columns', text_domain ),
                    '25%'        => __( '4 Columns', text_domain ),
                    '20%'        => __( '5 Columns', text_domain ),
                    '16.666667%' => __( '6 Columns', text_domain ),
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => '100%',
				'tablet_default' => '50%',
				'mobile_default' => '100%',
				'selectors' => [
                    '{{WRAPPER}} .post-list > *' => '-ms-flex: 0 0 {{VALUE}};flex: 0 0 {{VALUE}};max-width: {{VALUE}};',
                ],
			]
		);
		
		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Number of Posts', text_domain ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6'
			]
		);

		$this->add_control(
			'post_order',
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
            'image_position',
            [
                'label'     => __( 'Icon Position', text_domain ),
                'type'      => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'default'   => '',
                'options'   => [
                    '' => [
                        'title' => is_rtl() ? __( 'Right', text_domain ) : __( 'Left', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-right' : 'eicon-h-align-left',
                    ],
                    'flex-column' => [
                        'title' => __( 'Top', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'flex-row-reverse' => [
                        'title' => is_rtl() ? __( 'Left', text_domain ) : __( 'Right', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-left' : 'eicon-h-align-right',
                    ],
                ],
                'toggle'       => false,
            ]
        );
		
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'thumbnail',
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
            'show_icon_post',
            [
                'label' => __( 'Show Icon', text_domain ),
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
                'separator' => 'before',
                'default' => '1'
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
				'separator' => 'before',
				'default' => '1'
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
				'condition' => [
					'show_title' => '1',
				],
            ]
        );
		$this->add_control(
			'show_meta_data',
			[
				'label' => __( 'Show Meta', text_domain ),
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
				'separator' => 'before',
				'default' => '1'
			]
		);
		$this->add_control(
			'meta_data',
			[
				'label' => __( 'Meta Post', text_domain ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => [ 'date' ],
				'multiple' => true,
				'options' => [
					'author' => __( 'Author', text_domain ),
					'date' => __( 'Date', text_domain ),
					'time' => __( 'Time', text_domain ),
					'comments' => __( 'Comments', text_domain ),
				],
				'condition' => [
					'show_meta_data' => '1',
				],
			]
		);
		$this->add_control(
			'icon_date',
			[
				'label' => __( 'Icon Date', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-calendar-alt',
					'library' => 'regular',
				],
				'condition' => [
					'meta_data' => 'date',
				],
			]
		);
		$this->add_control(
			'icon_clock',
			[
				'label' => __( 'Icon Date', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'regular',
				],
				'condition' => [
					'meta_data' => 'time',
				],
			]
		);
		$this->add_control(
			'icon_user',
			[
				'label' => __( 'Icon Author', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-user-circle',
					'library' => 'regular',
				],
				'condition' => [
					'meta_data' => 'author',
				],
			]
		);
		$this->add_control(
			'icon_comment',
			[
				'label' => __( 'Icon Comments', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-comment',
					'library' => 'regular',
				],
				'condition' => [
					'meta_data' => 'comments',
				],
			]
		);
		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'Show Pagination', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'condition' => [
					'post_type!' => 'loop'
				],
			]
		);
		$this->end_controls_section();
	}
	protected function register_general_post_list_style_controls() {
		$this->start_controls_section(
			'section_post_list_style',
			[
				'label' => __( 'Post list Style', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
            'post_list_height',
            [
                'label' => __( 'Height', text_domain ),
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
                'default' => [
                    'size' => 100,
                    'unit' => 'px',

                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .list-item,{{WRAPPER}} .list-info,{{WRAPPER}} .list-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} img,{{WRAPPER}} .list-image a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_list_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'post_list_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_list_padding_info',
            [
                'label' => __( 'Padding Info', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'   => [
                    'top' => '5',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('style_post_list_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_responsive_control(
            'post_list_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .list-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_list_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .list-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_list_bg_color',
                'label' => __( 'Background Color', text_domain ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .list-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_list_border',
                'selector' => '{{WRAPPER}} .list-item',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', text_domain ),]);

        $this->add_responsive_control(
            'post_list_border_hover_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .list-item:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_list_box_hover_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .list-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_list_bg_hover_color',
                'label' => __( 'Background Color', text_domain ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .list-item:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_list_hover_border',
                'selector' => '{{WRAPPER}} .list-item:hover',
            ]
        );
        $this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', text_domain ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();
    }
    protected function register_image_post_list_style_controls() {
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'image_width',
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
                    'unit' => '%',

                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .list-info' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .list-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'post_list_image_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '15',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'post_list_image_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_list_border_image_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'default'   => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} img,{{WRAPPER}} i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_list_box_image_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} img',
            ]
        );
        $this->end_controls_section();
    }
    protected function register_icon_post_list_style_controls() {
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->add_control(
            'post_list_icon',
            [
                'label'            => __( 'Select Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-link',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon_post' => '1'
                ],
            ]
        );
        $this->add_responsive_control(
            'post_list_icon_size',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 12,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'size_units' => [ 'px', 'em' ],
                'condition' => [
                    'show_icon_post' => '1'
                ],
                'selectors' => [
					'{{WRAPPER}} .list-image svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-image i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'post_list_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_icon_post' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-image svg,{{WRAPPER}} .list-image i' => 'color: {{VALUE}}',
                ]

            ]
		);
		$this->add_control(
            'post_list_icon_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_icon_post' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-image svg,{{WRAPPER}} .list-image i' => 'background-color: {{VALUE}}',
                ]

            ]
        );
        $this->add_responsive_control(
            'post_list_icon_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
	}
	protected function register_title_post_list_style_controls() {
		$this->start_controls_section(
			'section_title_post_list_style',
			[
				'label' => __( 'Title Style', text_domain ),
				'condition' => [
					'show_title' => '1',
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
        );
        $this->add_responsive_control(
            'title_list_height',
            [
                'label' => __( 'Height', text_domain ),
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
                'default' => [
                    'size' => 75,
                    'unit' => '%',

                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .list-title' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'show_title' => '1',
				],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_title_typography',
                'label' => __( 'Typography', text_domain ),
                'condition' => [
					'show_title' => '1',
				],
                'selector' => '{{WRAPPER}} .list-title',
            ]
        );
        $this->add_responsive_control(
            'post_list_title_alignment',
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
                'condition' => [
					'show_title' => '1',
				],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .list-title' => 'text-align: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'post_list_title_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
					'show_title' => '1',
				],
                'selectors' => [
                    '{{WRAPPER}} .list-title a' => 'color: {{VALUE}}',
                ]

            ]
		);
		$this->add_control(
            'post_list_title_hover_color',
            [
                'label' => __( 'Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
					'show_title' => '1',
				],
                'selectors' => [
                    '{{WRAPPER}} .list-item:hover .list-title a' => 'color: {{VALUE}}',
                ]

            ]
        );
		$this->end_controls_section();
	}
	protected function register_mata_tag_post_list_style_controls() {
		$this->start_controls_section(
			'section_mata_tag_post_list_style',
			[
				'label' => __( 'Meta Style', text_domain ),
				'condition' => [
					'show_meta_data' => '1',
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'post_list_mata_tag_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .meta-data, {{WRAPPER}} .meta-data a' => 'color: {{VALUE}}',
				]

			]
        );
        $this->add_control(
			'hover_post_list_mata_tag_color',
			[
				'label' => __( 'Hover Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .list-item:hover .meta-data, {{WRAPPER}} .list-item:hover .meta-data a' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_list_mata_tag_icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .meta-data i' => 'color: {{VALUE}}',
				]

			]
        );
        $this->add_control(
			'hover_post_list_mata_tag_icon_color',
			[
				'label' => __( 'Hover Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .list-item:hover .meta-data i' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'mata_tag_size',
			[
				'label' => __( 'Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 36,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .meta-data i,{{WRAPPER}} .meta-data li,{{WRAPPER}} .meta-data a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'mata_tag_padding',
			[
				'label' => __( 'Padding', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .meta-data li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function register_pagination_post_grid_style_controls() {
		$this->start_controls_section(
			'section_pagination_post_grid_style',
			[
				'label' => __( 'Pagination', text_domain ),
				'condition' => [
					'show_pagination' => 'yes'
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'post_grid_pagination_alignment',
			[
				'label' => __( 'Pagination Alignment', text_domain ),
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
					'{{WRAPPER}} .pagination' => 'text-align: {{VALUE}};',
				]
			]
		);
		$this->start_controls_tabs('style_pagination_tabs');
		$this->start_controls_tab('style_pagination_normal_tab', ['label' => __( 'Normal', text_domain ),]);

		$this->add_control(
			'post_grid_pagination_number_color',
			[
				'label' => __( 'Pagination Number Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eead16',
				'selectors' => [
					'{{WRAPPER}} .navigation a' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_pagination_bg_color',
			[
				'label' => __( 'Pagination Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .navigation a' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_pagination_border',
				'selector' => '{{WRAPPER}} .navigation a',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab('style_pagination_hover_tab', ['label' => __( 'Hover', text_domain ),]);

		$this->add_control(
			'post_grid_pagination_number_hover_color',
			[
				'label' => __( 'Pagination Number Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_pagination_bg_hover_color',
			[
				'label' => __( 'Pagination Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eead16',
				'selectors' => [
					'{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_pagination_hover_border',
				'selector' => '{{WRAPPER}} .navigation a:hover , {{WRAPPER}} .pagination .current',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'post_grid_pagination_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .navigation a, {{WRAPPER}} .pagination .current' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		$this->add_control(
			'pagination_size',
			[
				'label' => __( 'Pagination Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min' => 2,
						'max' => 5,
					],
				],
				'default' => [
					'unit' => 'em',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .navigation a, {{WRAPPER}} .pagination .current' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function render( ) {
		$settings = $this->get_settings();

		$post_type = $settings['post_type'];
		$meta_data = $settings['meta_data'];
        $title_tag = $settings['title_tag'];
        $show_title = $settings['show_title'];
        $show_meta_data = $settings['show_meta_data'];
        $hover_animation = $settings['hover_animation'];
        $amimation ='';
        if(!empty($hover_animation)) {$amimation = " elementor-animation-$hover_animation";}
		$show_icon_post = $settings['show_icon_post'];
		$image_position = $settings['image_position'];
        $image_size = $settings['image_size'];
        $id = $this->get_id();
        if('custom' == $image_size) {
            $width = $settings['image_custom_dimension']['width'];
            $height = $settings['image_custom_dimension']['height'];
            add_image_size( "custom-$id", $width, $height, true );
		}
		if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
		elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
		else { $paged = 1; }
		$args = array(
			'posts_per_page' => $settings['posts_count'],
			'post_status' => 'publish',
			'post_type' => $post_type,
			'order' => $settings['post_order'],
		);
		
		if ( 'yes' == $settings['show_pagination']) {
			$args['paged'] = $paged;
		}

		$taxonomies = get_object_taxonomies($post_type, 'objects');
		foreach ( $taxonomies as $object ) {
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

		
		if ( $query->have_posts() ):
            echo "<div class='post-list flex flex-wrap align-items-center justify-content-between'>";
            while ( $query->have_posts() ):$query->the_post();
			$title_tag = $settings['title_tag'];
			$link = get_the_permalink();
			$title = get_the_title();
			echo "<div class='list-item flex align-items-center $image_position$amimation'>"
			 . "<div class='list-image'>"
				. "<a href='$link'>";
					if('custom' == $image_size) {tmt_post_thumbnail("$image_size-$id");} else {tmt_post_thumbnail($image_size);}
					if ($show_icon_post == '1') {echo "<div class='icon'>";Icons_Manager::render_icon( $settings['post_list_icon']);echo "</div>";}
				echo "</a>"
            . "</div>";
            if($show_title == '1' || $show_meta_data == '1'){
			    echo "<div class='list-info flex flex-column justify-content-between'>";
                    if($show_title == '1'){echo "<$title_tag class='list-title'><a href='$link'>$title</a></$title_tag>";}
                    if($show_meta_data == '1'){
                        echo '<ul class="meta-data flex">';
                        if (in_array('date', $meta_data)) {echo '<li class="date">';Icons_Manager::render_icon( $settings['icon_date'], [ 'aria-hidden' => 'true' ] );echo the_time('j F Y') . '</li>';}
                        if (in_array('time', $meta_data)) {echo '<li class="time">';Icons_Manager::render_icon( $settings['icon_clock'], [ 'aria-hidden' => 'true' ] );echo the_time('H:i') . '</li>';}
                        if (in_array('author', $meta_data)) {echo '<li class="author">';Icons_Manager::render_icon( $settings['icon_user'], [ 'aria-hidden' => 'true' ] );the_author_posts_link();echo '</li>';}
                        if (in_array('comments', $meta_data)) {echo '<li class="comments">';Icons_Manager::render_icon( $settings['icon_comment'], [ 'aria-hidden' => 'true' ] );echo comments_number() . '</li>';}
                        echo '</ul>';
                    }
                echo "</div>";
            }
			echo "</div>";
		endwhile;
		echo '</div>';
		if ( 'yes' == $settings['show_pagination']) {
			echo "<nav class='navigation pagination'><div class='nav-links'>";
			$current_page = max(1, get_query_var('paged'));
			echo paginate_links(array(
				'base' => get_pagenum_link(1) . '%_%',
				'format' => '/page/%#%',
				'current' => max( 1, $paged ),
				'total' => $query->max_num_pages,
				'mid_size' => 3,
				'prev_text' => ('<i class="fas fa-angle-double-right"></i>'),
				'next_text' => ('<i class="fas fa-angle-double-left"></i>'),
				'prev_next' => false,
			));
			echo "</div></nav>";
		};
		endif;wp_reset_postdata();
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Post_List );