<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Themento_icon_tab extends Widget_Base {

    public function get_name() {
        return 'themento-icon-tab';
    }

    public function get_title() {
        return __('Icon Tab', text_domain);
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [text_domain];
    }

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_style_background_controls();
        $this->register_general_style_icon_controls();
        $this->register_general_style_content_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', text_domain),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('tabs');
        $repeater->start_controls_tab('content_tab', ['label' => __('Content', 'elementor'),]);

        $repeater->add_control(
            'tab_icon',
            [
                'label' => __('Icon', text_domain),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'tab_title', [
                'label' => __('Title', text_domain),
                'type' => Controls_Manager::TEXT,
                'default' => __('Tab Title', text_domain),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content', [
                'label' => __('Content', text_domain),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Tab Content', text_domain),
                'show_label' => false,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->start_controls_tab('style_tab', ['label' => __('Style', 'elementor'),]);

        $repeater->add_control(
            'tab_title_color',
            [
                'label' => __('Color Title', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .services_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'tab_content_color',
            [
                'label' => __('Color Content', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .services_descr' => 'color: {{VALUE}}'
                ],
            ]
        );
        $repeater->add_control(
            'tab_icon_normal',
            [
                'label' => __( 'Icon Normal', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tab_icon_color',
            [
                'label' => __('Color Icon', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon i,{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon svg' => 'color: {{VALUE}};fill: {{VALUE}}'
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_icon_background_color',
                'label' => __('Color Background Icon', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon',
            ]
        );

        $repeater->add_control(
            'tab_icon_hover',
            [
                'label' => __( 'Icon Hover', text_domain ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tab_icon_hover_color',
            [
                'label' => __('Hover Color Icon', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon.current i,{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon:hover i,{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon.current svg,{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon:hover svg' => 'color: {{VALUE}};fill: {{VALUE}}'
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_icon_hover_background_color',
                'label' => __('Hover Color Background Icon', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon:hover, {{WRAPPER}} {{CURRENT_ITEM}} .services_item-icon.current',
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'list',
            [
                'label' => __('Repeater List', text_domain),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => __('Title #1', text_domain),
                        'tab_content' => __('Item content. Click the edit button to change this text.', text_domain),
                    ],
                    [
                        'tab_title' => __('Title #2', text_domain),
                        'tab_content' => __('Item content. Click the edit button to change this text.', text_domain),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_general_style_icon_controls() {
        $this->start_controls_section(
            'style_icon_tab',
            [
                'label' => __( 'Icon', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'main_tab_icon_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .services_item-icon',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'main_tab_icon_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .services_item-icon',
            ]
        );

        $this->add_control(
            'border-radius-icon',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .services_item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 45,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .services_item-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .services_item-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs('style_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);

        $this->add_control(
            'main_tab_icon_color',
            [
                'label' => __('Color Icon', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services_item-icon i,{{WRAPPER}} .services_item-icon svg' => 'color: {{VALUE}};fill: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_tab_icon_background_color',
                'label' => __('Color Background Icon', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services_item-icon',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_control(
            'main_tab_icon_hover_color',
            [
                'label' => __('Hover Color Icon', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services_item-icon.current i,{{WRAPPER}} .services_item-icon:hover i,{{WRAPPER}} .services_item-icon.current svg,{{WRAPPER}} .services_item-icon:hover svg' => 'color: {{VALUE}};fill: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_tab_icon_hover_background_color',
                'label' => __('Hover Color Background Icon', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services_item-icon:hover, {{WRAPPER}} .services_item-icon.current',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function register_general_style_content_controls() {
        $this->start_controls_section(
            'style_content_tab',
            [
                'label' => __( 'Content', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'main_tab_title_typography',
                'label' => __( 'Title Typography', text_domain ),
                'selector' => '{{WRAPPER}} .services_title',
            ]
        );

        $this->add_control(
            'main_tab_title_color',
            [
                'label' => __('Color Title', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'main_tab_content_typography',
                'label' => __( 'Content Typography', text_domain ),
                'selector' => '{{WRAPPER}} .services_descr',
            ]
        );
        $this->add_control(
            'main_tab_content_color',
            [
                'label' => __('Color Content', text_domain),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services_descr' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'main_tab_content_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .service-wrapper::after',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'main_tab_content_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .service-wrapper::after',
            ]
        );

        $this->add_control(
            'border_radius_content',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .service-wrapper::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_background_color',
                'label' => __('Hover Color Background Icon', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services_item-content',
            ]
        );

        $this->add_control(
            'padding_content',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .services_item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'space_content',
            [
                'label' => __( 'Space', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .services_item-content .services_descr' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }
    protected function register_general_style_background_controls() {
        $this->start_controls_section(
            'style_background',
            [
                'label' => __( 'background', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
      
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background ', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .service-wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => __('Background ', text_domain),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .service-wrapper:after',
            ]
        );
      
      

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'background_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .service-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'background_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .service-wrapper',
            ]
        );

    
     

      


        $this->end_controls_section();
    } 

    protected function render() {
        $settings = $this->get_settings();

        if (Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $(".services_item-wrap:first-child .services_item-icon,.services_item-wrap:first-child .services_item-content").addClass('current');
                    $('.services_item-wrap > .services_item-icon').hover(function(e){
                        e.stopPropagation();
                        var tab_id = $(this).attr('data-tab');

                        $('.services_item-wrap > .services_item-icon').removeClass('current');
                        $('.services_item-wrap > .services_item-content').removeClass('current');

                        $(this).addClass('current');
                        $("#"+tab_id).addClass('current');
                    });
                });
            </script>
            <?php
        }

        if ($settings['list']) { ?>
        
            <div class="service-wrapper">
            <?php
            foreach ($settings['list'] as $item); ?>
                <div class="services_item-wrap elementor-repeater-item">
            <div class="services_inner flex">
                    <div class="services_item-icon">
                        <?php Icons_Manager::render_icon($item["tab_icon"]); ?>
                    </div>
                    <div class="services_item-content">
                        <h3 class="services_title"><?php echo $item["tab_title"] ?></h3>
                        <div class="services_descr"><?php echo $item["tab_content"] ?></div>
                    </div>
                </div>
                </div>
            <?php } ?>
            
            </div>
            <?php
        }
}

Plugin::instance()->widgets_manager->register_widget_type(new Themento_icon_tab);