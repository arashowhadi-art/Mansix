<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_header extends Widget_Base {

    public function get_name() {
        return 'themento_header';
    }

    public function get_title() {
        return __( 'Header Page', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_keywords() {
        return [ 'heading', 'header', 'page' ];
    }

    protected function _register_controls() {
        $this->register_general_style_controls();
    }

    protected function register_general_style_controls() {
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
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
                'default' => 'h1',
            ]
        );
        $this->add_responsive_control(
            'horizontal_alignment',
            [
                'label' => __( 'Overall Alignment', text_domain ),
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
            ]
        );
        $this->add_responsive_control(
            'font_size_title',
            [
                'label' => __( 'Title Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'size_units' => [ 'px', 'em' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-page .title-header' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'font_size_breadcrumb',
            [
                'label' => __( 'Breadcrumbs Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .header-page ol li' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => __( 'Title Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'separator'    => 'before',
                'selectors' => [
                    '{{WRAPPER}} .header-page .title-header' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'color_breadcrumb_active',
            [
                'label' => __( 'Active Breadcrumbs Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eead16',
                'separator'    => 'before',
                'selectors' => [
                    '{{WRAPPER}} .header-page ol li.active' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $horizontal_alignment = $settings['horizontal_alignment'];
        $title_tag = $settings['title_tag'];
        echo "<div class='header-page flex justify-content-center align-items-$horizontal_alignment flex-column'><$title_tag class='title-header'>" . seo_title() . "</$title_tag>" . mj_wp_breadcrumb() ."</div>";
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_header );