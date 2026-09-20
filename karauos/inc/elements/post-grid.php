<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_post_widget extends Widget_Base{

	public function get_name(){
		return 'themento-post-grid';
	}

	public function get_title(){
		return __( 'Post Grid', text_domain );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ text_domain ];
	}

	protected function _register_controls() {
		$this->register_general_post_grid_controls();
		$this->register_general_loop_content_controls();
        $this->register_general_post_slider_controls();
		$this->register_general_post_grid_style_controls();
		$this->register_title_post_grid_style_controls();
		$this->register_icon_post_grid_style_controls();
		$this->register_pagination_post_grid_style_controls();
		$this->register_mata_tag_post_grid_style_controls();
		$this->register_excerpt_post_grid_style_controls();
		$this->register_btn_post_grid_style_controls();
        $this->register_general_post_style_slider_controls();
	}
	protected function register_general_post_grid_controls() {
		$this->start_controls_section(
			'section_post_grid',
			[
				'label' => __( 'Post Settings', text_domain )
			]
		);
		$this->add_control(
			'post_grid_style',
			[
				'label' => __( 'Post Style', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one' => __( 'Style One', text_domain ),
					'style-two' => __( 'Style Two',   text_domain ),
					'style-three' => __( 'Style Three', text_domain ),
					'style-four' => __( 'style four', text_domain ),
				],
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
			'post_grid_columns',
			[
				'label' => __( 'Number of Columns', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cols-3',
				'options' => [
                    'cols-1' => __( '1 Columns', text_domain ),
                    'cols-2' => __( '2 Columns', text_domain ),
                    'cols-3' => __( '3 Columns', text_domain ),
                    'cols-4' => __( '4 Columns', text_domain ),
                    'cols-5' => __( '5 Columns', text_domain ),
                    'cols-6' => __( '6 Columns', text_domain ),
                ],
			]
		);
        $this->add_control(
            'slider_columns',
            [
                'label' => __('Columns', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => __('1 Columns', text_domain ),
                    '2' => __('2 Columns', text_domain ),
                    '3' => __('3 Columns', text_domain ),
                    '4' => __('4 Columns', text_domain ),
                    '5' => __('5 Columns', text_domain ),
                    '6' => __('6 Columns', text_domain ),
                ],
                'condition' => [
                    'enable_slider' => 'yes'
                ],
            ]
        );
		
		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Number of Posts', text_domain ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
				'condition' => [
					'post_type!' => 'loop'
				],
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
				'condition' => [
					'post_type!' => 'loop'
				],
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
                'default' => 'h2',
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
			'show_pagination',
			[
				'label' => __( 'Show Pagination', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default' => 'yes',
				'condition' => [
					'post_type!' => 'loop'
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
			'show_excerpt',
			[
				'label' => __( 'Show excerpt', text_domain ),
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
				'condition' => [
					'post_grid_style' => 'style-two'
				],
				'separator' => 'before',
				'default' => '1'
			]
		);
		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Words', text_domain ),
				'type' => Controls_Manager::NUMBER,
				'default' => '18',
				'condition' => [
					'show_excerpt' => '1',
					'post_grid_style' => [ 'style-two', 'style-four' ]
				]
			]
		);
		$this->add_control(
			'show_more_link',
			[
				'label' => __( 'Show Read More', text_domain ),
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
				'condition' => [
					'post_grid_style' => [ 'style-two', 'style-four' ]
				],
				'separator' => 'before',
				'default' => '1'
			]
		);
		$this->add_control(
			'text_more_link',
			[
				'label' => __( 'Read More Text', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', text_domain ),
				'condition' => [
					'show_more_link' => '1',
					'post_grid_style' => [ 'style-two', 'style-four' ]
				]
			]
		);
        $this->add_control(
            'hover_btn_animation',
            [
                'label' => __( 'Animation Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'none', text_domain ),
                    'btn-animation-style-one' => __( 'Style One',   text_domain ),
                ],
                'condition' => [
                    'show_more_link' => '1',
                ]
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
				'condition' => [
					'post_grid_style' => 'style-two'
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
				'default' => [ 'date', 'comments' ],
				'multiple' => true,
				'options' => [
					'author' => __( 'Author', text_domain ),
					'date' => __( 'Date', text_domain ),
					'time' => __( 'Time', text_domain ),
					'comments' => __( 'Comments', text_domain ),
				],
				'condition' => [
					'show_meta_data' => '1',
					'post_grid_style' => 'style-two'
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
            'enable_slider',
            [
                'label' => __( 'Enable Slider', text_domain),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'default' => 'no',
                'condition' => [
                    'show_pagination!' => 'yes',
                    'post_type!' => 'loop'
                ],
            ]
        );
		$this->end_controls_section();
	}
    protected function register_general_post_slider_controls() {
        $this->start_controls_section(
            'product_slider',
            [
                'label'     => esc_html__( 'Slider', text_domain ),
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '3',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'columns_tablet',
            [
                'label' => __( 'Columns Tablet', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '2',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'columns_mobile',
            [
                'label' => __( 'Columns Mobile', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Columns', text_domain ),
                    '2' => __( '2 Columns', text_domain ),
                    '3' => __( '3 Columns', text_domain ),
                    '4' => __( '4 Columns', text_domain ),
                    '5' => __( '5 Columns', text_domain ),
                    '6' => __( '6 Columns', text_domain ),
                ],
                'default' => '1',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slidesToScroll',
            [
                'label' => __( 'slides To Scroll', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
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
            'speed',
            [
                'label' => __( 'Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );
        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', text_domain ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
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
        $this->end_controls_section();
    }
	protected function register_general_loop_content_controls() {
		$this->start_controls_section(
			'section_loop_content',
			[
				'label' => __( 'Post Settings', text_domain ),
				'condition' => [
					'post_type' => 'loop',
				],
			]
		);
		$this->add_control(
			'search_text',
			[
				'label' => __( 'Description', text_domain ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'condition' => [
					'post_type' => 'loop',
				],
				'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', text_domain ),
			]
		);
		$this->add_control(
			'notfind_text',
			[
				'label' => __( 'Description', text_domain ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'condition' => [
					'post_type' => 'loop',
				],
				'default' => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', text_domain ),
			]
		);
		$this->end_controls_section();
	}
	protected function register_general_post_grid_style_controls() {
		$this->start_controls_section(
			'section_post_grid_style',
			[
				'label' => __( 'Post Grid Style', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'post_grid_height',
			[
				'label' => __( 'Post Grid Height', text_domain ),
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
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .article-item, {{WRAPPER}} .article-item-blog,{{WRAPPER}} .image-projects,{{WRAPPER}} .bg-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'post_grid_column_gap',
			[
				'label' => __( 'Spacing Between Columns', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .article-box > *,{{WRAPPER}} .Themento-Posts' => 'padding-left:{{SIZE}}{{UNIT}};padding-right:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'post_grid_row_gap',
			[
				'label' => __( 'Spacing Between Row', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .article-box > *,{{WRAPPER}} .Themento-Posts' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'style_post_grid_basics',
			[
				'label'     => __( 'Border', text_domain ),
				'type'      => Controls_Manager::HEADING,
				'separator'    => 'before',
			]
		);
		$this->start_controls_tabs('style_post_grid_tabs');
		$this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', text_domain ),]);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_border',
				'selector' => '{{WRAPPER}} .article-item, {{WRAPPER}} .article-item-blog figure, {{WRAPPER}} .image-projects, {{WRAPPER}} .item--inner',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', text_domain ),]);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_hover_border',
				'selector' => '{{WRAPPER}} .article-item:hover, {{WRAPPER}} .article-item-blog:hover figure, {{WRAPPER}} .image-projects:hover, {{WRAPPER}} .item--inner:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'post_grid_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .article-item, {{WRAPPER}} .article-item img, {{WRAPPER}} .article-item-blog figure, {{WRAPPER}} .article-item-blog, {{WRAPPER}} .image-projects, {{WRAPPER}} .item--inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_grid_box_shadow',
				'selector' => '{{WRAPPER}} .article-item, {{WRAPPER}} .article-item-blog figure, {{WRAPPER}} .image-projects, {{WRAPPER}} .item--inner',
			]
		);
		$this->add_control(
			'post_grid_bg_hover_color',
			[
				'label' => __( 'Hover Post Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator'    => 'before',
				'selectors' => [
					'{{WRAPPER}} .article-item, {{WRAPPER}} .article-item-blog figure, {{WRAPPER}} .image-projects, {{WRAPPER}} .item--body' => 'background-color: {{VALUE}}',
				]
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_grid_hover_text_border',
                'selector' => '{{WRAPPER}} .article-blog-text, {{WRAPPER}} .item--body',
            ]
        );
		$this->end_controls_section();
	}
	protected function register_title_post_grid_style_controls() {
		$this->start_controls_section(
			'section_title_post_grid_style',
			[
				'label' => __( 'Title Style', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        $this->add_control(
            'title_position',
            [
                'label' => __( 'Title Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'in',
                'options' => [
                    'in'  => __( 'In Thumbnail', text_domain ),
                    'out' => __( 'Out Thumbnail', text_domain ),
                ],
                'condition' => [
                    'post_grid_style!' => 'style-four'
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_grid_title_typography',
				'selector' => '{{WRAPPER}} .title-post, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title a',
			]
		);
		$this->add_responsive_control(
			'post_grid_title_alignment',
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
					'{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'text-align: 0;text-align: {{VALUE}};justify-content: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'post_grid_title_height',
			[
				'label' => __( 'Height', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 150,
					],
					'%' => [
						'min' => 10,
						'max' => 30,
					],
				],
				'default' => [
					'size' => 100,
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .article-item-footer' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'post_grid_style' => 'style-one'
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_grid_title_padding',
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
					'{{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'padding: {{SIZE}}{{UNIT}} 0;',
				],
				'condition' => [
					'post_grid_style' => [ 'style-three', 'style-two' ]
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_grid_title_width',
			[
				'label' => __( 'Title Width', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'default' => [
					'size' => '90',
					'unit' => '%',
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'post_grid_title_space',
            [
                'label' => __( 'Title Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
		$this->start_controls_tabs( 'post_grid_title_tabs' );
		$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', text_domain ) ] );

		$this->add_control(
			'post_grid_title_color',
			[
				'label' => __( 'Title Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .title-post,{{WRAPPER}} .title-post a, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title a' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_bg_title_color',
			[
				'label' => __( 'Title Background', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_bg_title_border',
				'selector' => '{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', text_domain ) ] );

		$this->add_control(
			'post_grid_title_hover_color',
			[
				'label' => __( 'Title Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .article-item:hover .title-post,{{WRAPPER}} .article-item:hover .title-post a,{{WRAPPER}} .article-item-blog:hover .title-post a, {{WRAPPER}} .article-item-blog:hover .title-post, {{WRAPPER}} .title-portfolio:hover, {{WRAPPER}} .item--title:hover a' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_bg_hover_title_color',
			[
				'label' => __( 'Title Background', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .article-item:hover .article-item-footer, {{WRAPPER}} .article-item-blog:hover .article-blog-bottom, {{WRAPPER}} .article-item-blog:hover .title-post, {{WRAPPER}} .title-portfolio:hover, {{WRAPPER}} .item--title:hover' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_grid_bg_c_hover_border',
				'selector' => '{{WRAPPER}} .article-item:hover .article-item-footer, {{WRAPPER}} .article-item-blog:hover .article-blog-bottom, {{WRAPPER}} .article-blog-bottom:hover .title-post, {{WRAPPER}} .title-portfolio:hover, {{WRAPPER}} .item--title:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'post_grid_border_radius_title',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .article-item-footer, {{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_grid_title_box_shadow',
				'selector' => '{{WRAPPER}} .article-item-footer,{{WRAPPER}} .article-blog-bottom, {{WRAPPER}} .title-portfolio, {{WRAPPER}} .item--title',
			]
		);

		$this->end_controls_section();
	}
	protected function register_icon_post_grid_style_controls() {
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
            'post_grid_icon',
            [
                'label'            => __( 'Select Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-link',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'section_post_grid' => [ 'style-one', 'style-two' ],
                    'show_icon_post' => '1'
                ],
            ]
        );
		$this->add_responsive_control(
			'post_grid_icon_size',
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
				'default' => [
					'unit' => 'em',
					'size' => 2,
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .article-item i, {{WRAPPER}} .article-item-blog i, {{WRAPPER}} .back a' => 'font-size: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->add_control(
			'post_grid_icon_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .article-item i, {{WRAPPER}} .article-item-blog i, {{WRAPPER}} .back a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'after',
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->start_controls_tabs('style_icon_tabs');
		$this->start_controls_tab('style_icon_normal_tab', ['label' => __( 'Normal', text_domain ),]);

		$this->add_control(
			'post_grid_icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .article-item i, {{WRAPPER}} .article-item-blog i, {{WRAPPER}} .back a' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->add_control(
			'post_grid_icon_bg_color',
			[
				'label' => __( 'Icon Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .article-item i, {{WRAPPER}} .article-item-blog i, {{WRAPPER}} .back a' => 'background-color: {{VALUE}}',
				],
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab('style_icon_hover_tab', ['label' => __( 'Hover', text_domain ),]);
		$this->add_control(
			'post_grid_icon_hover_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .article-item i:hover, {{WRAPPER}} .article-item-blog i:hover, {{WRAPPER}} .back a:hover' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->add_control(
			'post_grid_icon_hover_bg_color',
			[
				'label' => __( 'Icon Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .article-item i:hover, {{WRAPPER}} .article-item-blog i:hover, {{WRAPPER}} .back a:hover' => 'background-color: {{VALUE}}',
				],
                'condition' => [
                    'show_icon_post' => '1'
                ],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

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
	protected function register_mata_tag_post_grid_style_controls() {
		$this->start_controls_section(
			'section_mata_tag_post_grid_style',
			[
				'label' => __( 'Meta Style', text_domain ),
				'condition' => [
					'show_meta_data' => '1',
                    'post_grid_style' => [ 'style-two', 'style-four' ]
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
            'post_grid_mata_tag_color',
            [
                'label' => __( 'Meta Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-data, {{WRAPPER}} .meta-data a,{{WRAPPER}} .article-blog-text .date, {{WRAPPER}} .meta-data-item  .date' => 'color: {{VALUE}}',
                ]

            ]
        );
        $this->add_control(
            'post_grid_mata_tag_bg_color',
            [
                'label' => __( 'background color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-data,{{WRAPPER}} .meta-data-item' =>  'background-color: {{VALUE}}',
                ]

            ]
        );
		$this->add_control(
			'post_grid_mata_tag_icon_color',
			[
				'label' => __( 'Meta Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .meta-data i' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'section_post_grid!' => 'style-four',

                ],

			]
		);

		$this->add_control(
			'mata_tag_size',
			[
				'label' => __( 'Meta Text Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 36,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .meta-data' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'section_post_grid!' => 'style-four',

                ],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mata_tag_typography',
                'selector' => '{{WRAPPER}} .meta-data,{{WRAPPER}} .meta-data-item',
            ]
        );

		$this->add_control(
			'mata_tag_margin',
			[
				'label' => __( 'Spacing', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .meta-data,{{WRAPPER}} .meta-data-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
			 $this->add_responsive_control(
            'mata_tag_position',
            [
                'label' => __( 'Mata Tag Position', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors' => [
                    '{{WRAPPER}} .meta-data-item' => 'top: {{TOP}}%;right: {{RIGHT}}%;left: auto;',
                ],
              
            ]
        );
		$this->end_controls_section();
	}
	protected function register_excerpt_post_grid_style_controls() {
		$this->start_controls_section(
			'section_excerpt_post_grid_style',
			[
				'label' => __( 'Post Excerpt', text_domain ),
				'condition' => [
					'show_excerpt' => '1',
					'post_grid_style' => [ 'style-two', 'style-four' ]
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'post_grid_excerpt_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .article-blog-text .excerpt, {{WRAPPER}} .article-blog-text .excerpt p, {{WRAPPER}} .item--excerpt' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_responsive_control(
			'post_grid_excerpt_alignment',
			[
				'label' => __( 'Alignment', text_domain ),
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
					],
					'justify' => [
						'title' => __( 'Justify', text_domain ),
						'icon' => 'fa fa-align-justify',
					]
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .article-blog-text .excerpt,{{WRAPPER}} .article-blog-text .excerpt p, {{WRAPPER}} .item--excerpt' => 'text-align: {{VALUE}};',
				]
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_grid_excerpt_typography',
                'selector' => '{{WRAPPER}} .item--excerpt, {{WRAPPER}}  .excerpt',
            ]
        );
		$this->add_control(
			'post_grid_excerpt_margin',
			[
				'label' => __( 'Spacing', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .article-blog-text .excerpt,{{WRAPPER}} .article-blog-text .excerpt p, {{WRAPPER}} .item--excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'post_grid_excerpt_padding',
            [
                'label' => esc_html__('padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .article-blog-text .excerpt, {{WRAPPER}} .item--excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
	}
	protected function register_btn_post_grid_style_controls() {
		$this->start_controls_section(
			'section_btn_post_grid_style',
			[
				'label' => __( 'Read More', text_domain ),
				'condition' => [
					'show_more_link' => '1',
					'post_grid_style' => [ 'style-two', 'style-four' ]
				],
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_grid_btn_typography',
                'selector' => '{{WRAPPER}} .read-more a',
            ]
		); 
		
		$this->start_controls_tabs('style_btn_tabs');
		$this->start_controls_tab('style_btn_normal_tab', ['label' => __( 'Normal', text_domain ),]);
		$this->add_control(
			'post_grid_btn_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .read-more a' => 'color: {{VALUE}}',
				]

			]
		);
	
		$this->add_control(
			'post_grid_btn_bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eead16',
				'selectors' => [
					'{{WRAPPER}} .read-more a' => 'background-color: {{VALUE}}',
				]

			]
		);
        $this->add_control(
            'post_grid_btn_icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'selectors' => [
                    '{{WRAPPER}} .read-more i' => 'color: {{VALUE}}',
                ],
                    'condition' => [
                        'section_post_grid!' => 'style-four',

                ],

            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab('style_btn_hover_tab', ['label' => __( 'Hover', text_domain ),]);
		$this->add_control(
			'post_grid_btn_hover_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .read-more a:hover' => 'color: {{VALUE}}',
				]

			]
		);
		$this->add_control(
			'post_grid_btn_bg_hover_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#051934',
				'selectors' => [
					'{{WRAPPER}} .read-more a:hover' => 'background-color: {{VALUE}}',
				]

			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'post_grid_btn_alignment',
			[
				'label' => __( 'Alignment', text_domain ),
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
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'text-align: {{VALUE}};',
				]
			]
		);

        $this->add_control(
            'post_grid_btn_hover_animation',
            [
                'label' => __( 'Hover Animation', text_domain ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->add_responsive_control(
            'post_grid_btn_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_responsive_control(
            'post_grid_btn_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'post_grid_btn_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .read-more a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();
	}
    protected function register_general_post_style_slider_controls() {
        $this->start_controls_section(
            'style_slider',
            [
                'label' => __( 'Slider Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'slider_style',
            [
                'label' => __('Arrows Style', text_domain),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['both', 'arrows'],
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

        $this->start_controls_tabs( 'arrows_icon_tabs' );
        $this->start_controls_tab( 'arrows_icon_normal', [
            'label' => __( 'Normal', text_domain ),
            'condition' => [
                'navigation' => [ 'arrows', 'both' ],
            ],
        ] );

        $this->add_control(
            'arrow_slider_color',
            [
                'label' => __('Icon Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_control(
            'arrow_slider_bg_color',
            [
                'label' => __('Background Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
				$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_slider_border',
				'selector' => '{{WRAPPER}} .slick-arrow',
				]
		);
		 $this->add_responsive_control(
            'arrow_radius_slider',
            [
                'label' => __('Border Radius', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
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
            'arrow_slider_hover_color',
            [
                'label' => __('Icon Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#f19001',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover:before' => 'color: {{VALUE}}; '
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
        $this->add_control(
            'arrow_slider_hover_bg_color',
            [
                'label' => __('Background Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
			$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_slider_hover_border',
				'selector' => '{{WRAPPER}} .slick-arrow:hover',
				]
		);
		 $this->add_responsive_control(
            'arrow_radius_hover_slider',
            [
                'label' => __('Border Hover Radius', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_slider_typography',
                'label' => __('Typography', text_domain),
                'selector' => '{{WRAPPER}} .slick-arrow:before',
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
       
        $this->add_responsive_control(
            'arrow_slider_padding',
            [
                'label' => esc_html__('Padding', text_domain),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'arrows'],
                ],
            ]
        );
		

        $this->add_control(
            'dots_style',
            [
                'label' => __('Dots Style', text_domain),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['both', 'dots'],
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
                    'navigation' => [ 'dots', 'both' ],
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
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label' => __('Dots Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
                ],
            ]
        );
        $this->add_control(
            'dot_active',
            [
                'label' => __('Active Dots Color', text_domain),
                'type' => Controls_Manager::COLOR,
                'default' => '#f19001',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['both', 'dots'],
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
                    'size' => 40,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
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
                    'size' => 10,
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots .slick-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
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

        $this->start_controls_tab('style_hover_tab_two', ['label' => __( 'Hover', 'elementor' ),]);

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


    protected function render( ) {
		$settings = $this->get_settings();
		$editor = Plugin::$instance->editor->is_edit_mode();
		$post_type = $settings['post_type'];
		$meta_data = $settings['meta_data'];
		$title_position = $settings['title_position'];
		$show_icon_post = $settings['show_icon_post'];
		$image_size = $settings['image_size'];
		$hover_btn_animation = $settings['hover_btn_animation'];
		$id = $this->get_id();
		if('custom' == $image_size) {
			$width = $settings['image_custom_dimension']['width'];
			$height = $settings['image_custom_dimension']['height'];
			add_image_size( "custom-$id", $width, $height, true );
		}
		$title_tag = $settings['title_tag'];
		$post_grid_style = $settings['post_grid_style'];

        if($settings['enable_slider'] == 'yes') {
            $is_rtl = is_rtl();
            $direction = $is_rtl ? 'rtl' : 'ltr';
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
            $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
            $data_slick = [
                'slidesToShow' => absint( $settings['columns'] ),
                'slidesToScroll' => absint( $settings['slidesToScroll'] ),
                'autoplay' => ( 'yes' === $settings['autoplay'] ),
                'infinite' => ( 'yes' === $settings['infinite'] ),
                'speed' => absint( $settings['speed'] ),
                'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
                'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
                'arrows' => $show_arrows,
                'dots' => $show_dots,
                'rtl' => $is_rtl,
                'centerMode' => ( 'yes' === $settings['centerMode'] ),
                'responsive' => [
                    ['breakpoint' => 1024,
                        'settings' => ['slidesToShow' => absint( $settings['columns'] - 1 ),]
                    ],
                    ['breakpoint' => 769,
                        'settings' => ['slidesToShow' => absint( $settings['columns_tablet'] ),]
                    ],
                    ['breakpoint' => 480,
                        'settings' => ['slidesToShow' => absint( $settings['columns_mobile'] ),]
                    ],
                ],
            ];

            $this->add_render_attribute( 'slides', [
                'data-slick' => wp_json_encode( $data_slick ),
            ] );
            echo "<div class='article-box post-slider' dir='". esc_attr( $direction ) ."' ". $this->get_render_attribute_string( 'slides' ) .">";
        } else {
            echo '<div class="article-box flex flex-wrap justify-content-between ' . $settings['post_grid_columns'] . '">';
        }


		switch ($post_type) {
			case "loop":
				if($editor) {
					$args = array(
						'posts_per_page' => 12,
						'post_type' => 'post',
						'post_status' => 'publish',
					);
					$query = new \WP_Query($args);

					if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
						$this->Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation);
					endwhile;endif;wp_reset_postdata();
					echo '</div>';
				} else {
					if ( have_posts() ) { while ( have_posts() ) { the_post();
						$this->Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation);
					}
					echo '</div>';
					// Previous/next page navigation.
					karauos_the_posts_navigation(3);
					}
					else { ?>
						<header class="page-header">
					<h1 class="page-title"><?php _e( 'Nothing Found', text_domain ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
					<?php
					if ( is_home() && current_user_can( 'publish_posts' ) ) :
						printf('<p>' . wp_kses(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', text_domain ),	array('a' => array('href' => array(),),)) . '</p>',esc_url( admin_url( 'post-new.php' ) ));
					elseif ( is_search() ) :
						echo '<p>' . $settings['search_text'] . '</p>';get_search_form();
					else :
						echo '<p>' . $settings['notfind_text'] . '</p>';get_search_form();
					endif;
					?>
					</div></div><!-- .page-content -->
					<?php  }
				}
			break;
			case "related_post":
				global $post;
                // get categories
                $cat_terms = wp_get_post_terms( $post->ID, 'category' );
                foreach ( $cat_terms as $term ) $cats_array[] = $term->term_id;

                // get tags
                $tag_terms = wp_get_post_terms( $post->ID, 'post_tag' );
                foreach ( $tag_terms as $term ) $tags_array[] = $term->term_id;

				$args = array(
					'posts_per_page' => $settings['posts_count'],
					'post_type' => 'post',
					'post_status' => 'publish',
					'order' => $settings['post_order'],
					'post__not_in' => array( $post->ID ),
                    'tax_query' => array(
                        'relation' => 'AND',
                    ),
				);

                if(!empty($cat_terms)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $cats_array
                        ),
                    );
                }

                if(!empty($tag_terms)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $tags_array
                        ),
                    );
                }

				$query = new \WP_Query($args);
				if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
					$this->Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation);
				endwhile;endif;wp_reset_postdata();
				echo '</div>';
			break;
			case "related_project":
				global $post;
                // get categories
                $cat_terms = wp_get_post_terms( $post->ID, 'portfolio_cat' );
                foreach ( $cat_terms as $term ) $cats_array[] = $term->term_id;

                // get tags
                $tag_terms = wp_get_post_terms( $post->ID, 'portfolio_tags' );
                foreach ( $tag_terms as $term ) $tags_array[] = $term->term_id;

				$args = array(
					'posts_per_page' => $settings['posts_count'],
					'post_type' => 'portfolio',
					'post_status' => 'publish',
					'order' => $settings['post_order'],
					'post__not_in' => array( $post->ID ),
                    'tax_query' => array(
                        'relation' => 'AND',
                    ),
				);

                if(!empty($cat_terms)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'portfolio_cat',
                            'field' => 'id',
                            'terms' => $cats_array
                        ),
                    );
                }

                if(!empty($tag_terms)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'portfolio_tags',
                            'field' => 'id',
                            'terms' => $tags_array
                        ),
                    );
                }

				$query = new \WP_Query($args);
				if ( $query->have_posts() ):while ( $query->have_posts() ):$query->the_post();
					$this->Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation);
				endwhile;endif;wp_reset_postdata();
				echo '</div>';
			break;
			default:
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'posts_per_page' => $settings['posts_count'],
				'post_type' => $post_type,
				'post_status' => 'publish',
				'order' => $settings['post_order'],
				'paged'=> $paged,
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
            	$this->Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation);
			endwhile;
				echo '</div>';
				if (( 'yes' === $settings['show_pagination'] )) {
					$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
					karauos_the_posts_navigation(3);
				};
			endif;wp_reset_postdata();
		}
	}
	private function Post_Loop($settings,$editor,$post_grid_style,$image_size,$id,$show_icon_post,$title_tag,$title_position,$meta_data,$hover_btn_animation) {
            $title = get_the_title();
            $permalink = get_the_permalink();
			switch ($post_grid_style) {
				case "style-one":
					echo '<article class="Themento-Posts">'
					     . '<div class="article-item">'
						 . "<a class='full-link' href='$permalink'>". __( 'Read More', text_domain ) ."</a>";
                    if('custom' == $image_size) {
                        tmt_post_thumbnail("$image_size-$id");
                    } else {
                        tmt_post_thumbnail($image_size);
                    }
                    if ($show_icon_post == '1') {Icons_Manager::render_icon( $settings['post_grid_icon']);}
					     echo '<div class="article-item-footer flex align-items-center justify-content-'. $settings['post_grid_title_alignment'] .'">'
					     . "<$title_tag class='title-post'><a href='$permalink'>$title</a></$title_tag></div></div></article>";
					break;
				case "style-two":
					echo '<article class="Themento-Posts">';
					echo '<div class="blog-items">'
					     . '<div class="article-item-blog shadow-img">'
						 . "<a class='full-link' href='$permalink'>". __( 'Read More', text_domain ) ."</a>";
					echo '<figure>';
					if('custom' == $image_size) {
                    tmt_post_thumbnail("$image_size-$id");
                    } else {
                        tmt_post_thumbnail($image_size);
                    }
                echo '</figure>';
                    if ($show_icon_post == '1') {Icons_Manager::render_icon( $settings['post_grid_icon']);}
                    if ($title_position == 'in') {
                        echo '<div class="article-blog-bottom flex align-items-center justify-content-' . $settings['post_grid_title_alignment'] . '">'
                            . "<$title_tag class='title-post'><a href='$permalink'>$title</a></$title_tag>"
                            . '</div>';
                    }
                    echo '</div>'
                    . '<div class="article-blog-text">';
                    if ($title_position == 'out') {
                        echo '<div class="article-blog-bottom flex align-items-center justify-content-' . $settings['post_grid_title_alignment'] . '">'
                            . "<$title_tag class='title-post'><a href='$permalink'>$title</a></$title_tag>"
                            . '</div>';
                    }
					if($settings['show_meta_data'] == '1'){
						echo '<ul class="meta-data flex">';
                        if (in_array('date', $meta_data)) {echo '<li class="date">';Icons_Manager::render_icon( $settings['icon_date'], [ 'aria-hidden' => 'true' ] );echo the_time('j F Y') . '</li>';}
                        if (in_array('time', $meta_data)) {echo '<li class="time">';Icons_Manager::render_icon( $settings['icon_clock'], [ 'aria-hidden' => 'true' ] );echo the_time('H:i') . '</li>';}
                        if (in_array('author', $meta_data)) {echo '<li class="author">';Icons_Manager::render_icon( $settings['icon_user'], [ 'aria-hidden' => 'true' ] );the_author_posts_link();echo '</li>';}
                        if (in_array('comments', $meta_data)) {echo '<li class="comments">';Icons_Manager::render_icon( $settings['icon_comment'], [ 'aria-hidden' => 'true' ] );echo comments_number() . '</li>';}
                        echo '</ul>';
					}
					if($settings['show_excerpt'] == '1'){echo '<div class="excerpt">';
						if(has_excerpt()) {
							the_excerpt();
						} else {
							excerpt_post($settings['excerpt_length']);
						}
						echo '</div>';}
					if($settings['show_more_link'] == '1'){echo '<div class="read-more "><a href="'; echo $permalink . '">'. $settings['text_more_link'] . '<i class="fas fa-arrow-left '.$hover_btn_animation.'"></i></a></div>';}
					echo '</div></div></article>';
					break;
				case "style-three":
					echo '<article class="Themento-Posts"><div class="image-projects">'
						. '<figure>';
                    if('custom' == $image_size) {
                        tmt_post_thumbnail("$image_size-$id");
                    } else {
                        tmt_post_thumbnail($image_size);
                    } $post_grid_title_alignment = $settings['post_grid_title_alignment'];
					 echo '</figure>'
					     . "<$title_tag class='title-portfolio flex align-items-center justify-content-$post_grid_title_alignment'>$title</$title_tag>";
                    if ($show_icon_post == '1') {
                        echo '<div class="back-item flex justify-content-between">'
                            . '<div class="back"><a href="'; echo $permalink; echo '"><i class="fas fa-link"></i></a></div>'
                            . '<div class="back"><a href="';if (has_post_thumbnail()) {echo the_post_thumbnail_url('large');} else {echo wp_directory_uri . '/assets/images/thumbnail.jpg';}echo '" data-fancybox="gallery" data-caption="';echo $title;echo '"><i class="fas fa-search"></i></a></div>'
                        . '</div>';
                    }
                    echo '</div></article>';
					break;
                case "style-four":
                    echo '<article class="Themento-Posts">'
                      . '<div class="item--inner flex">'
                        . '<div class="bg-image">'
                        . "<a href='$permalink'>";
						if('custom' == $image_size) {
							tmt_post_thumbnail("$image_size-$id");
						} else {
							tmt_post_thumbnail($image_size);
						}
						echo "</a>";
                    if($settings['show_meta_data'] == '1'){
                        echo '<ul class="meta-data-item flex">';
                        if (in_array('date', $meta_data)) {echo '<li class="date">';Icons_Manager::render_icon( $settings['icon_date'], [ 'aria-hidden' => 'true' ] );echo the_time('j F') . '</li>';}
                        echo '</ul>';
                    }
                        echo '</div>'
                        . '<div class="item--body">'
                            . "<$title_tag class='item--title'><a href='$permalink'>$title</a></$title_tag>";
                    if($settings['show_excerpt'] == '1'){echo '<div class="item--excerpt">';
                        if(has_excerpt()) {
                            the_excerpt();
                        } else {
                            excerpt_post($settings['excerpt_length']);
                        }
                        echo '</div>';}
                    if($settings['show_more_link'] == '1'){echo "<div class='read-more'><a href='$permalink'>". $settings['text_more_link'] .'</a></div>';}
                    echo '</div></div></article>';
                    break;
			}
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_post_widget );