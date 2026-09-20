<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Content extends Widget_Base {

    public function get_name() {
        return 'tmt-content';
    }

    public function get_title() {
        return __( 'Content', text_domain );
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'content', 'post' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_setting',
            [
                'label' => __( 'Setting', text_domain ),
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
                    'justify' => [
                        'title' => __( 'Justified', text_domain ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} p' => 'text-align: {{VALUE}}',
                ],
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', text_domain ),
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'link_color',
            [
                'label' => __( 'Link Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h1',
                'label' => __( 'H1', text_domain ),
                'selector' => '{{WRAPPER}} h1',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h2',
                'label' => __( 'H2', text_domain ),
                'selector' => '{{WRAPPER}} h2',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h3',
                'label' => __( 'H3', text_domain ),
                'selector' => '{{WRAPPER}} h3',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h4',
                'label' => __( 'H4', text_domain ),
                'selector' => '{{WRAPPER}} h4',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h5',
                'label' => __( 'H5', text_domain ),
                'selector' => '{{WRAPPER}} h5',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_h6',
                'label' => __( 'H6', text_domain ),
                'selector' => '{{WRAPPER}} h6',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        if (!Plugin::$instance->editor->is_edit_mode() ) {
            echo "<div class='tmt-content'>";
            the_content();
            echo "</div>";
        } else {
            echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas purus viverra accumsan in nisl nisi. Arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque. In egestas erat imperdiet sed euismod nisi porta lorem mollis. Morbi tristique senectus et netus. Mattis pellentesque id nibh tortor id aliquet lectus proin. Sapien faucibus et molestie ac feugiat sed lectus vestibulum. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget. Dictum varius duis at consectetur lorem. Nisi vitae suscipit tellus mauris a diam maecenas sed enim. Velit ut tortor pretium viverra suspendisse potenti nullam. Et molestie ac feugiat sed lectus. Non nisi est sit amet facilisis magna. Dignissim diam quis enim lobortis scelerisque fermentum. Odio ut enim blandit volutpat maecenas volutpat. Ornare lectus sit amet est placerat in egestas erat. Nisi vitae suscipit tellus mauris a diam maecenas sed. Placerat duis ultricies lacus sed turpis tincidunt id aliquet.</p>";
        }

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Content );