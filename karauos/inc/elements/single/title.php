<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Title extends Widget_Base {

    public function get_name() {
        return 'tmt-title';
    }

    public function get_title() {
        return __( 'Title', text_domain );
    }

    public function get_icon() {
        return 'eicon-post-title';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'title', 'heading', 'post' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'tags_setting',
            [
                'label' => __( 'Setting', text_domain ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title Tag', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => TMT_Title_Tags(),
            ]
        );
        $this->add_responsive_control(
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
                'default' => 'right',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', text_domain ),
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

    protected function render() {

        $settings = $this->get_settings();
        $title_tag = $settings['title_tag'];
        $text_align = $settings['text_align'];


        echo "<$title_tag class='title text-$text_align'>"; echo seo_title(); echo "</$title_tag>";

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Title );