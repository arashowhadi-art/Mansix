<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Tabs extends Widget_Base {

    public function get_name() {
        return 'tmt-tabs';
    }

    public function get_title() {
        return __( 'Tabs', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_keywords() {
        return [ 'tabs', 'tab' ];
    }

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_nav_style_controls();
        $this->register_content_style_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_general_content',
            [
                'label' => __( 'Content', text_domain ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        
		$this->add_control(
            'tabs',
            [
                'label'   => __( 'Accordion Items', text_domain ),
                'type'    => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'tab_title'   => __( 'Accordion #1', text_domain ),
                        'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                    ],
                    [
                        'tab_title'   => __( 'Accordion #2', text_domain ),
                        'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                    ],
                    [
                        'tab_title'   => __( 'Accordion #3', text_domain ),
                        'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
                    ],
                ],
                'fields' => [
                    [
                        'name'        => 'tab_title',
                        'label'       => __( 'Title & Content', text_domain ),
                        'type'        => Controls_Manager::TEXT,
                        'dynamic'     => [ 'active' => true ],
                        'default'     => __( 'Title' , text_domain ),
                        'label_block' => true,
                    ],
                    [
						'name'             => 'tab_icon',
						'label'            => __( 'Icon', text_domain ),
						'type'             => Controls_Manager::ICONS,
					],
                    [
						'name'    => 'source',
						'label'   => esc_html__( 'Select Source', text_domain ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'custom',
						'options' => [
							'custom'        => esc_html__( 'Custom Content', text_domain ),
							'elementor'     => esc_html__( 'Elementor Template', text_domain ),
						],
					],
                    [
                        'name'       => 'tab_content',
                        'label'      => __( 'Content', text_domain ),
                        'type'       => Controls_Manager::WYSIWYG,
                        'dynamic'    => [ 'active' => true ],
                        'default'    => __( 'Content', text_domain ),
                        'show_label' => false,
                        'condition' => [ 'source' => 'custom' ],
                    ],
                    [
						'name'        => 'template_id',
						'label'       => __( 'Select Template', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::SELECT,
						'default'     => '0',
						'options'     => tmt_customizer_elementor_library( 'library' ),
						'label_block' => 'true',
						'condition'   => [ 'source' => 'elementor' ],
					],
                    
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
		);
		$this->add_control(
			'tab_layout',
			[
				'label'   => esc_html__( 'Layout', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => __( 'Top', text_domain ),
					'bottom'  => __( 'Bottom', text_domain ),
					'left'    => is_rtl() ? __( 'Right', text_domain ) : __( 'Left', text_domain ),
					'right'   => is_rtl() ? __( 'Left', text_domain ) : __( 'Right', text_domain ),
                ],
			]
		);
		$this->add_control(
			'align_v',
			[
				'label'     => __( 'Alignment', text_domain ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
                    'right' => [
                        'title' => is_rtl() ? __( 'Right', text_domain ) : __( 'Left', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-right' : 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'left' => [
                        'title' => is_rtl() ? __( 'Left', text_domain ) : __( 'Right', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-left' : 'eicon-h-align-right',
                    ],
                ],
                'default'      => 'right',
				'condition' => [
					'tab_layout' => [ 'top', 'bottom' ]
				],
			]
        );

        $this->add_control(
			'align_h',
			[
				'label'     => __( 'Alignment', text_domain ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
                'default'      => 'right',
				'condition' => [
					'tab_layout' => [ 'left', 'right' ]
				],
			]
        );
        
        $this->add_control(
            'active_item',
            [
                'label' => __( 'Active Item No', text_domain ),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
                'max'   => 20,
                'default' => 1,
            ]
        );

        $this->end_controls_section();
    }

    protected function register_nav_style_controls() {
        $this->start_controls_section(
            'section_nav_style',
            [
                'label' => __( 'Nav', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'v_nav_item',
            [
                'label' => __( 'Nav Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                    'tab_layout' => [ 'top', 'bottom' ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-nav-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h_nav_item',
            [
                'label' => __( 'Nav Width', text_domain ),
                'type'  => Controls_Manager::SLIDER,
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
                'default' => [
                    'size' => 200,
                    'unit' => 'px',
                ],
                'condition' => [
                    'tab_layout' => [ 'left', 'right' ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-nav-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_item_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-nav-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_nav_style' );
        $this->start_controls_tab('tab_nav_normal',['label' => __( 'Normal', text_domain ),]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'nav_typography',
                'selector' => '{{WRAPPER}} .tab-nav-item',
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-nav-item' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'nav_background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tab-nav-item',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'nav_shadow',
                'selector' => '{{WRAPPER}} .tab-nav-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'nav_border',
                'selector'    => '{{WRAPPER}} .tab-nav-item',
            ]
        );

        $this->add_control(
            'nav_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tab-nav-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('tab_nav_active',['label' => __( 'Active', text_domain ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'active_nav_background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tab-nav-item.tmt-open',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'active_nav_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-nav-item.tmt-open' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_nav_shadow',
                'selector' => '{{WRAPPER}} .tab-nav-item.tmt-open',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'active_nav_border',
                'selector'    => '{{WRAPPER}} .tab-nav-item.tmt-open',
            ]
        );

        $this->add_control(
            'active_nav_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tab-nav-item.tmt-open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'nav_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tab-nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_margin',
            [
                'label'      => __( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tab-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_content_style_controls() {
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .tabs-content-item',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs-content-item' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'content_background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tmt-tabs-content',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_shadow',
                'selector' => '{{WRAPPER}} .tmt-tabs-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'selector'    => '{{WRAPPER}} .tmt-tabs-content',
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-tabs-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-tabs-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $tabs = $settings['tabs'];
        $tab_layout = $settings['tab_layout'];

        $this->add_render_attribute( 'nav-position', 'class', ['tmt-tabs', 'flex']);
        switch($tab_layout) {
            case 'top':
                $align = $settings['align_v'];
                $this->add_render_attribute( 'nav-position', 'class', 'flex-column' );
                break;
            case 'right':
                $align = $settings['align_h'];
                $this->add_render_attribute( 'nav-align', 'class', ['flex-column','row-nav'] );
                $this->add_render_attribute( 'nav-position', 'class', ['flex-row-reverse','row-item'] );
                break;
            case 'bottom':
                $align = $settings['align_v'];
                $this->add_render_attribute( 'nav-position', 'class', 'flex-column flex-column-reverse' );
                break;
            case 'left':
                $align = $settings['align_h'];
                $this->add_render_attribute( 'nav-align', 'class', ['flex-column','row-nav'] );
                $this->add_render_attribute( 'nav-position', 'class', 'row-item' );
                break;
        }
        $nav_position = $this->get_render_attribute_string( 'nav-position' );
        $this->add_render_attribute( 'nav-align', 'class', ['flex', 'flex-wrap',"justify-content-$align"] );
        $nav_align = $this->get_render_attribute_string( 'nav-align' );
        if ($tabs) {
        echo "<div $nav_position>"
            . "<div class='tmt-tabs-nav'>"
                . "<ul $nav_align>";
                    foreach (  $tabs as $index => $item ) {
                        $acc_count = $index + 1;
                        $tmt_open = ($acc_count === $settings['active_item']) ? ' tmt-open' : '';
                        $id = $item['_id'];
                        $tab_title = $item['tab_title'];
                        $tab_icon = $item['tab_icon'];
                        echo "<li rel='tab$id' class='tab-nav-item elementor-repeater-item-$id$tmt_open'> $tab_title ";
                            if(!empty($tab_icon)) {Icons_Manager::render_icon( $tab_icon, [ 'aria-hidden' => 'true' ] );}
                        echo"</li>";
                    }
                echo "</ul>"
            . "</div>"
            . "<div class='tmt-tabs-content'>";
                foreach (  $tabs as $index => $item ) {
                    $acc_count = $index + 1;
                    $tmt_open = ($acc_count === $settings['active_item']) ? ' tmt-open' : '';
                    $id = $item['_id'];
                    $source = $item['source'];
                    echo "<div id='tab$id' class='tabs-content-item elementor-repeater-item-$id$tmt_open'>";
                        switch($source) {
                            case 'elementor' :
                                $template_id = $item['template_id'];
                                echo TMT_Elementor_Template($template_id);
                            break;
                            case 'custom' :
                                echo $item['tab_content'];
                            break;
                        }
                    echo "</div>";
                }
            echo "</div>"
        . "</div>";
        }
		//;

    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Tabs );