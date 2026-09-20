<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Before_After extends Widget_Base {

    public function get_name() {
        return 'tmt-before-after';
    }

    public function get_title() {
        return __( 'Before & After Post', text_domain );
    }

    public function get_icon() {
        return 'eicon-post-title';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'before', 'after', 'post' ];
    }

	protected function _register_controls() {
        $this->register_content_controls();
		$this->register_style_controls();
		$this->register_style_icon_controls();
		$this->register_style_image_controls();
	}

	protected function register_content_controls() {
		$this->start_controls_section(
            'content_setting',
            [
                'label' => __( 'Content', text_domain ),
            ]
        );
        $this->add_control(
			'side_post',
			[
				'label' => __( 'Side Post', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', text_domain ),
					'image' => __( 'Image', text_domain ),
				],
			]
        );
        
        $this->add_control(
			'reverse',
			[
				'label' => __( 'Reverse', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', text_domain ),
				'label_off' => __( 'No', text_domain ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        
        $this->add_control(
			'before_options',
			[
				'label' => __( 'Before Options', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );
        $this->add_control(
			'before_icon',
			[
				'label' => __( 'Icon', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'solid',
                ],
                'condition' => [
					'side_post' => 'icon',
				],
			]
		);
        $this->add_control(
			'before_text',
			[
				'label' => __( 'Before Text', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Previous Post:', text_domain ),
			]
        );
        $this->add_control(
			'before_text_align',
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
			]
		);
        
        $this->add_control(
			'after_options',
			[
				'label' => __( 'After Options', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );
        $this->add_control(
			'after_icon',
			[
				'label' => __( 'Icon', text_domain ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-left',
					'library' => 'solid',
                ],
                'condition' => [
					'side_post' => 'icon',
				],
			]
		);
        $this->add_control(
			'after_text',
			[
				'label' => __( 'After Text', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Next Post:', text_domain ),
			]
        );
        $this->add_control(
			'after_text_align',
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
				'default' => 'left',
				'toggle' => true,
			]
		);

        $this->end_controls_section();
	}
	protected function register_style_controls() {
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Text Typography', text_domain ),
				'selector' => '{{WRAPPER}} .text',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_margin',
			[
				'label' => __( 'Margin', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', text_domain ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function register_style_icon_controls() {
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '6',
					'right' => '12',
					'bottom' => '2',
					'left' => '12',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};transition: .3s;',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'Margin', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '8',
					'bottom' => '0',
					'left' => '8',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => __( 'Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', text_domain ),
				'selector' => '{{WRAPPER}} .icon',
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __( 'Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} .icon',
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->start_controls_tabs('icon_tabs');
        $this->start_controls_tab('icon_normal_tab', ['label' => __( 'Normal', text_domain ),]);
        $this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} i' => 'color: {{VALUE}};transition: .3s;',
					'{{WRAPPER}} svg' => 'fill: {{VALUE}};transition: .3s;',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ececec',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab('icon_hover_tab', ['label' => __( 'Hover', text_domain ),]);
		$this->add_control(
			'h_icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .before-after:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .before-after:hover svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
		$this->add_control(
			'h_icon_bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .before-after:hover .icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'side_post' => 'icon',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function register_style_image_controls() {
		$this->start_controls_section(
			'style_image_section',
			[
				'label' => __( 'Image', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'side_post' => 'image',
				],
			]
		);
		$this->add_control(
			'image_size',
			[
				'label' => __( 'Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'image',
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
					'top' => '0',
					'right' => '8',
					'bottom' => '0',
					'left' => '8',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'image',
				],
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label' => __( 'Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'side_post' => 'image',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Border', text_domain ),
				'selector' => '{{WRAPPER}} img',
				'condition' => [
					'side_post' => 'image',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __( 'Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} img',
				'condition' => [
					'side_post' => 'image',
				],
			]
		);
		$this->end_controls_section();
	}


    protected function render() {

        $settings = $this->get_settings();

        $side_post = $settings['side_post'];
        $reverse = $settings['reverse'];
        if($reverse == 'yes') {
            $this->add_render_attribute('tmt_before_after','class', 'flex-row-reverse');
            $this->add_render_attribute('before','class', 'flex-row-reverse');
            $this->add_render_attribute('after','class', 'flex-row-reverse');
        }
        $this->add_render_attribute('tmt_before_after','class', ['tmt-before-after','flex','align-items-center','justify-content-between']);
        $tmt_before_after = $this->get_render_attribute_string( 'tmt_before_after' );

        echo "<div $tmt_before_after>";
        $prev_post = get_adjacent_post(false, '', true);
        if(!empty($prev_post)) {
            $before_text = $settings['before_text'];
            $before_text_align = $settings['before_text_align'];
            $prev_link = get_permalink($prev_post->ID);
            if (!Plugin::$instance->editor->is_edit_mode()) {
                $this->add_render_attribute( 'before', 'onclick', "window.open('$prev_link', '_self')" );
            }
            $this->add_render_attribute('before','class', ['before','before-after','flex','align-items-center']);
            $before = $this->get_render_attribute_string( 'before' );
            echo "<div $before>"
                . "<a href='$prev_link' class='icon'>";
                switch($side_post) {
                    case 'icon' :
                        Icons_Manager::render_icon( $settings['before_icon'], [ 'aria-hidden' => 'true' ] );
                    break;
                    case 'image' :
                        echo get_the_post_thumbnail($prev_post->ID, 'thumbnail');
                    break;
                }
                echo "</a>"
                . "<div><a class='flex flex-column align-items-$before_text_align' href='$prev_link'><span class='text'>$before_text</span><span class='title'>$prev_post->post_title</span></a></div>"
            . "</div>";
        }
        $next_post = get_adjacent_post(false, '', false);
        if(!empty($next_post)) {
            $after_text = $settings['after_text'];
            $after_text_align = $settings['after_text_align'];
            $next_link = get_permalink($next_post->ID);
            if (!Plugin::$instance->editor->is_edit_mode()) {
                $this->add_render_attribute( 'after', 'onclick', "window.open('$next_link', '_self')" );
            }
            $this->add_render_attribute( 'after','class', ['after','before-after','flex','align-items-center']  );
            $after = $this->get_render_attribute_string( 'after' );
            echo "<div $after>"
                . "<div><a class='flex flex-column align-items-$after_text_align' href='$next_link'><span class='text'>$after_text</span><span class='title'>$next_post->post_title</span></a></div>"
                . "<a href='$next_link' class='icon'>";
                switch($side_post) {
                    case 'icon' :
                        Icons_Manager::render_icon( $settings['after_icon'], [ 'aria-hidden' => 'true' ] );
                    break;
                    case 'image' :
                        echo get_the_post_thumbnail($next_post->ID, 'thumbnail');
                    break;
                }
                echo "</a>"
            . "</div>";
        }
        echo "</div>";

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Before_After );