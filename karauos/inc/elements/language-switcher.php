<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TMT_Language_Switcher extends Widget_Base {

	public function get_name() {
		return 'tmt-language-switcher';
	}

	public function get_title() {
		return __( 'Language Switcher', text_domain );
	}

	public function get_icon() {
		return 'eicon-global-settings';
	}

	public function get_categories() {
        return [ text_domain ];
	}

	public function get_keywords() {
		return [ 'languages', 'multilingual', 'lang', 'sitepress', 'wpml', 'switcher'];
	}

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_style_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'setting',
            [
                'label' => __( 'Languages', text_domain ),
            ]
        );

        $this->add_control(
            'lang_style',
            [
                'label' => __( 'Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list'  => __( 'List', text_domain ),
                    'dropdown' => __( 'Dropdown', text_domain ),
                ],
            ]
        );

        $this->add_control(
            'vertical_list',
            [
                'label' => __( 'Show Vertical', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'lang_style' => 'list'
                ],
            ]
        );
        $this->add_responsive_control(
            'alignment',
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
                'default' => 'center',
            ]
        );
        $this->add_control(
            'show_flags',
            [
                'label' => __( 'Show Flags', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'flag_style',
            [
                'label' => __( 'Flags Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal'  => __( 'Normal', text_domain ),
                    'circle' => __( 'Circle', text_domain ),
                ],
                'condition' => [
                    'show_names' => 'yes'
                ],
                'prefix_class' => 'flag-style-',
            ]
        );
        $this->add_control(
            'show_names',
            [
                'label' => __( 'Show Names', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_names_as',
            [
                'label' => __( 'Names Style', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name'  => __( 'Name', text_domain ),
                    'slug' => __( 'Slug', text_domain ),
                ],
                'condition' => [
                    'show_names' => 'yes'
                ],
                'prefix_class' => 'flag-names-',
            ]
        );
        $this->add_control(
            'show_current',
            [
                'label' => __( 'Show Current', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'show_current_flag',
            [
                'label' => __( 'Show Current Flag', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'Hide', text_domain ),
                        'icon' => 'fas fa-ban',
                    ],
                    'inline-block' => [
                        'title' => __( 'Show', text_domain ),
                        'icon' => 'fas fa-check',
                    ],
                ],
                'default' => 'inline-block',
                'selectors' => [
                    '{{WRAPPER}} .flags li.current-lang img' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    'show_current' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'show_current_name',
            [
                'label' => __( 'Show Current Name', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'Hide', text_domain ),
                        'icon' => 'fas fa-ban',
                    ],
                    'inline-block' => [
                        'title' => __( 'Show', text_domain ),
                        'icon' => 'fas fa-check',
                    ],
                ],
                'default' => 'inline-block',
                'selectors' => [
                    '{{WRAPPER}} .flags li.current-lang span' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    'show_current' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'dropdown_weight',
            [
                'label' => __( 'Dropdown Weight', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 80,
                ],
                'condition' => [
                    'lang_style' => 'dropdown',
                ],
                'selectors' => [
                    '{{WRAPPER}} .flags.dropdown li:not(.current-lang)' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_general_style_controls() {
        $this->start_controls_section(
            'item_style',
            [
                'label' => __( 'Item', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('style_tabs');
        $this->start_controls_tab('style_normal_tab', ['label' => __( 'Normal', 'elementor' ),]);
        $this->add_control(
            'normal_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'condition' => [
                    'lang_style' => 'dropdown'
                ],
                'selectors' => [
                    '{{WRAPPER}} li.current-lang:after' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'normal_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'dropdown_text_color',
            [
                'label' => __( 'Dropdown Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags.dropdown li:not(.current-lang) a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'lang_style' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'dropdown_background_color',
            [
                'label' => __( 'Dropdown Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags.dropdown li:not(.current-lang)' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'lang_style' => 'dropdown',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_hover_tab', ['label' => __( 'Hover', 'elementor' ),]);

        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'hover_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_dropdown_text_color',
            [
                'label' => __( 'Dropdown Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags.dropdown li:not(.current-lang):hover a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'lang_style' => 'dropdown',
                ],
            ]
        );
        $this->add_control(
            'hover_dropdown_background_color',
            [
                'label' => __( 'Dropdown Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags.dropdown li:not(.current-lang):hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'lang_style' => 'dropdown',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_active_tab', ['label' => __( 'Active', 'elementor' ),]);

        $this->add_control(
            'active_color',
            [
                'label' => __( 'Text Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li.current-lang a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'active_background_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flags li.current-lang' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .flags li a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .flags li',
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __( 'Margin', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .flags li:not(.current-lang)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .flags li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border-radius',
            [
                'label' => __( 'Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .flags li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} .flags li',
            ]
        );
        $this->end_controls_section();
    }


	protected function render() {
        $settings = $this->get_settings();
        $align = $settings['alignment'];

        $flags = '0';
        if ( 'yes' === $settings['show_flags'] ) {$flags = '1';}
        $names = '0';
        if ( 'yes' === $settings['show_names'] ) {$names = '1';}
        $show_current = '1';
        if ( "yes" === $settings["show_current"] ) {$show_current = "0";}
        $dropdown = '';
        $language = '';
        if ( "dropdown" === $settings["lang_style"] ) {$dropdown = " dropdown";$language = " flex align-items-center justify-content-$align";}

        $alignment = "align-items-center justify-content-$align";

        $vertical = '';
        if ( "yes" === $settings["vertical_list"] ) {$vertical = " flex-column";$alignment = "justify-content-center align-items-$align";}

        echo "<div class='language$dropdown$language'><ul class='flex flags text-$align $alignment$dropdown$vertical'>";
            pll_the_languages(array('show_flags' => $flags, 'show_names' => $names, 'hide_current' => $show_current, 'display_names_as' => $settings['show_names_as']));
        echo "</ul></div>";
        if (Plugin::$instance->editor->is_edit_mode() ) {echo "<span style='font-size: 1px;display: inherit;'>tmt</span>";}
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Language_Switcher );