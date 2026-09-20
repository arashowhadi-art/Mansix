<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Post_Thumbnail extends Widget_Base {

    public function get_name() {
        return 'tmt-post-thumbnail';
    }

    public function get_title() {
        return __( 'Thumbnail', text_domain );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'views', 'post' ];
    }

    protected function _register_controls() {
        $this->register_image_controls();
        $this->register_image_style_controls();
    }
    protected function register_image_controls() {
        $this->start_controls_section(
            'image_setting',
            [
                'label' => __( 'Setting', text_domain ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
            ]
        );
        $this->add_responsive_control(
            'object_fit',
            [
                'label' => __( 'Object Fit', text_domain ),
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
        $this->add_responsive_control(
            'alignment',
            [
                'label' => __( 'Position', text_domain ),
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
        $this->add_control(
            'image',
            [
                'label' => __( 'Default Image', text_domain ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => wp_directory_uri . '/assets/images/thumbnail.jpg',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_image_style_controls() {
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __( 'Width', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} figure' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} img' => 'width: 100%;',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'image_effects' );

        $this->start_controls_tab( 'normal', ['label' => __( 'Normal', text_domain ),]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} figure',
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'default'   => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} img,{{WRAPPER}} figure' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} img',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} img',
            ]
        );
        $this->add_control(
            'opacity',
            [
                'label' => __( 'Opacity', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover', ['label' => __( 'Hover', text_domain ),]);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => __( 'Background', text_domain ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} figure:hover',
            ]
        );

        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'default'   => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} figure:hover img,{{WRAPPER}} figure:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} figure:hover img',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} figure:hover img',
            ]
        );
        $this->add_control(
            'opacity_hover',
            [
                'label' => __( 'Opacity', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} figure:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters_hover',
                'selector' => '{{WRAPPER}} figure:hover img',
            ]
        );

        $this->add_control(
            'background_hover_transition',
            [
                'label' => __( 'Transition Duration', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} img,{{WRAPPER}} figure' => 'transition-duration: {{SIZE}}s',
                ],
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

    protected function render() {
        $settings = $this->get_settings();
        $alignment = $settings['alignment'];
        $image_size = $settings['image_size'];
        $image = $settings['image']['url'];
        $hover_animation = $settings['hover_animation'];

        echo "<div class='thumbnail flex justify-content-$alignment'><figure class='figure $hover_animation'>";
        if (has_post_thumbnail()) :
            the_post_thumbnail($image_size, array('alt' => '' . get_the_title() . '', 'title' => '' . get_the_title() . ''));
        else :
            echo '<img src="' . $image . '" alt="' . get_the_title() . '" />';
        endif;
        echo "</figure></div>";
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Post_Thumbnail );