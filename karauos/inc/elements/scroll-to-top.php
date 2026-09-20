<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Scroll_To_Top extends Widget_Base {

    public function get_name() {
        return 'tmt-scroll-to-top';
    }

    public function get_title() {
        return __( 'Scroll To Top', text_domain );
    }

    public function get_icon() {
        return 'eicon-arrow-up';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'up', 'scroll', 'top' ];
    }

    protected function _register_controls() {
        $this->register_tags_setting_controls();
        $this->register_tags_style_controls();

    }
    protected function register_tags_setting_controls() {
        $this->start_controls_section(
            'tags_setting',
            [
                'label' => __( 'Setting', text_domain ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', text_domain ),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'caret-up',
                        'angle-up',
                        'arrow-up',
                        'hand-point-up',
                        'caret-square-up',
                        'chevron-circle-up',
                        'arrow-circle-up',
                        'angle-double-up',
                        'long-arrow-alt-up',
                        'arrow-alt-circle-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                        'arrow-alt-circle-up',
                    ],
                ],
                'default' => [
                    'value' => 'fas fa-angle-up',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'position_style',
            [
                'label' => __( 'Position Type', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fixed',
                'options' => [
                    'relative'  => __( 'Static', text_domain ),
                    'fixed' => __( 'Floating', text_domain ),
                ],
                'selectors' => [
                    '{{WRAPPER}} a' => 'position: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Position', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right'  => __( 'Right', text_domain ),
                    'left' => __( 'Left', text_domain ),
                ],
                'selectors' => [
                    '{{WRAPPER}} a' => '{{VALUE}}: 30px;bottom:30px',
                ],
                'condition' => [
                    'position_style' => 'fixed',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_align',
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
                'selectors' => [
                    '{{WRAPPER}} .btn-top' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'position_style' => 'relative',
                ],
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }
    protected function register_tags_style_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'font_size',
            [
                'label' => __( 'Icon Size', text_domain ),
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
                'selectors' => [
                    '{{WRAPPER}} a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('style_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a i,{{WRAPPER}} a svg' => 'color: {{VALUE}}',
                ],
                'default' => '#FFF',
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255,255,255,.2)',
                'selectors' => [
                    '{{WRAPPER}} a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 10,
                    'right' => 15,
                    'bottom' => 10,
                    'left' => 15,
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

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 2,
                    'right' => 2,
                    'bottom' => 2,
                    'left' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} a',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', text_domain ),]);

        $this->add_control(
            'h_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a:hover i,{{WRAPPER}} a:hover svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_bg_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#793ba8',
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'h_padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'h_margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'h_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'h_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} a:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'h_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} a:hover',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', text_domain ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function render() {

        $settings = $this->get_settings();

        $hover_animation = $settings['hover_animation'];

        ?>
        <div class="btn-top">
            <a href="#top" id="top" class="<?php echo $hover_animation ?>" title="Back to Top"><?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></a>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
        migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
        #>
        <a href="#top" id="top" class="{{ settings.hover_animation }}" title="Back to Top">{{{ iconHTML.value }}}</a>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Scroll_To_Top );