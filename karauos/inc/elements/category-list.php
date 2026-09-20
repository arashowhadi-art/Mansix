<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Category_List extends Widget_Base {

    public function get_name() {
        return 'tmt-category-list';
    }

    public function get_title() {
        return __( 'Category List', text_domain );
    }

    public function get_icon() {
        return 'eicon-sitemap';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'list', 'category' ];
    }

    protected function _register_controls() {
        $this->register_content_controls_controls();
        $this->register_style_controls_controls();
        $this->register_style_text_controls_controls();
        $this->register_style_number_controls_controls();
    }
    protected function register_content_controls_controls() {
        $this->start_controls_section(
            'content_setting',
            [
                'label' => __( 'Setting', text_domain ),
            ]
        );


        $this->add_control(
            'taxonomies',
            [
                'label' => __( 'Show Elements', text_domain ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => TMT_Get_Taxonomies(),
                'default' => 'category',
            ]
        );

        $this->add_control(
            'show_number_posts',
            [
                'label' => __( 'Show Number Posts', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'hide_empty',
            [
                'label' => __( 'Hide Empty', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->end_controls_section();
    }
    protected function register_style_controls_controls() {
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 5,
                    'right' => 0,
                    'bottom' => 5,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_text_controls_controls() {
        $this->start_controls_section(
            'style_text_section',
            [
                'label' => __( 'Style Text', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'txt_font_size',
            [
                'label' => __( 'Font Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'pt' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    'pt' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} a' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'txt_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'txt_h_color',
            [
                'label' => __( 'Hover Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_number_controls_controls() {
        $this->start_controls_section(
            'style_number_section',
            [
                'label' => __( 'Style Number', text_domain ),
                'condition' => [
                    'show_number_posts' => 'yes',
                ],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'num_background_size',
            [
                'label' => __( 'Background Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'pt' ],
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
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} span' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'num_font_size',
            [
                'label' => __( 'Font Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'pt' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    'pt' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} span' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->start_controls_tabs('style_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'num_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'num_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#aaa',
                'selectors' => [
                    '{{WRAPPER}} span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'num_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                ],
                'selectors' => [
                    '{{WRAPPER}} span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'num_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} span',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'num_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} span',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', text_domain ),]);

        $this->add_control(
            'num_h_color',
            [
                'label' => __( 'Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'num_h_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li:hover span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_h_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} li:hover span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'num_h_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} li:hover span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_h_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} li:hover span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'num_h_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}}li:hover span',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'num_h_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} li:hover span',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $hide_empty = $settings['hide_empty'];
        if($hide_empty == 'yes') {$hide_empty = true;} else {$hide_empty = false;}
        $show_number_posts = $settings['show_number_posts'];
        $categories = get_terms( array(
			'taxonomy'    => $settings['taxonomies'],
			'hide_empty' => $settings['hide_empty']
		) );
        
        
        echo "<ul class='tmt-category-list'>";
		    foreach($categories as $category) {
                $category_id = $category->term_id;
                $category_name = $category->name;
                $category_count = $category->count;
		$link = get_term_link($category->term_id,$category->taxonomy);
                echo "<li class='flex justify-content-between' id='cat-$category_id'><a href='$link'>$category_name</a>"; if($show_number_posts == 'yes'){echo "<span class='flex justify-content-center align-items-center'>$category_count</span>";} echo "</li>";
		    }
        echo "</ul>";
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Category_List );