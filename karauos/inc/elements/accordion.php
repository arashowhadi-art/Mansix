<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_Accordion extends Widget_Base {

    public function get_name() {
        return 'tmt-accordion';
    }

    public function get_title() {
        return __( 'Accordion', text_domain );
    }
    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_keywords() {
        return [ 'accordion', 'tabs', 'toggle' ];
	}

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Accordion', text_domain ),
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
            'view',
            [
                'label'   => __( 'View', text_domain ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label'   => __( 'Title HTML Tag', text_domain ),
                'type'    => Controls_Manager::SELECT,
                'options' => TMT_Title_Tags(),
                'default' => 'div',
            ]
        );

        $this->add_control(
            'accordion_icon',
            [
                'label'       => __( 'Icon', text_domain ),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'accordion_active_icon',
            [
                'label'       => __( 'Active Icon', text_domain ),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'accordion_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __( 'Additional', text_domain ),
            ]
        );

        $this->add_control(
            'multiple',
            [
                'label' => __( 'Multiple Open', text_domain ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'active_item',
            [
                'label' => __( 'Active Item No', text_domain ),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
                'max'   => 20,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_item',
            [
                'label' => __( 'Item', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => __( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_spacing',
            [
                'label' => __( 'Item Spacing', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-item + .tmt-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __( 'Title', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __( 'Normal', text_domain ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'title_background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tmt-accordion .tmt-accordion-title',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title',
            ]
        );

        $this->add_control(
            'title_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .tmt-accordion .tmt-accordion-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_active',
            [
                'label' => __( 'Active', text_domain ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'active_title_background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title.tmt-open',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'active_title_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title.tmt-open' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_title_shadow',
                'selector' => '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title.tmt-open',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'active_title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title.tmt-open',
            ]
        );

        $this->add_control(
            'active_title_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-item .tmt-accordion-title.tmt-open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label'     => __( 'Icon', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'accordion_icon[value]!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_style' );

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __( 'Normal', text_domain ),
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'   => __( 'Alignment', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => is_rtl() ? __( 'End', text_domain ) : __( 'Start', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-right' : 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => is_rtl() ? __( 'Start', text_domain ) : __( 'End', text_domain ),
                        'icon'  => is_rtl() ? 'eicon-h-align-left' : 'eicon-h-align-right',
                    ],
                ],
                'default'     => is_rtl() ? 'left' : 'right',
                'toggle'      => false,
                'label_block' => false,
            ]
        );

        $this->add_control(
            'icon_align_reverse',
            [
                'label'   => __( 'Reverse', text_domain ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title .tmt-accordion-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title .tmt-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => __( 'Spacing', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-icon.tmt-flex-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-icon.tmt-flex-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_active',
            [
                'label' => __( 'Active', text_domain ),
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label'     => esc_html__( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title.tmt-open .tmt-accordion-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title.tmt-open .tmt-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-title .tmt-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label'     => __( 'Content', text_domain ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'content_background_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tmt-accordion .tmt-accordion-content',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-content' => 'color: {{VALUE}};',
                    'separator' => 'before',
                ],
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_spacing',
            [
                'label' => __( 'Spacing', text_domain ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tmt-accordion .tmt-accordion-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .tmt-accordion .tmt-accordion-content',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = 'tmt-accordion-' . $this->get_id();


        $this->add_render_attribute(['accordion' => ['id' => $id, 'class' => 'tmt-accordion',]]);

        $id_int = substr( $this->get_id_int(), 0, 3 );

        $migrated = isset( $settings['__fa4_migrated']['accordion_icon'] );
        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        $active_migrated  = isset( $settings['__fa4_migrated']['accordion_active_icon'] );
        $active_is_new    = empty( $settings['icon_active'] ) && Icons_Manager::is_migration_allowed();

        if (Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $(".tmt-accordion-title").on("click", function() {
                        if ($(this).hasClass("tmt-open")) {
                            $(this).removeClass("tmt-open");
                            $(this).siblings(".tmt-accordion-content").slideUp(200);
                        } else {
                            if ($(this).hasClass("multiple")) {}
                            else {
                                $(".tmt-accordion-title").removeClass("tmt-open");
                                $(".tmt-accordion-content").slideUp(200);
                            }
                            $(this).addClass("tmt-open");
                            $(this).siblings(".tmt-accordion-content").slideDown(200);
                        }
                    });
                });
            </script>
            <?php
        }

        ?>
        <div class="tmt-accordion-container">
            <div <?php echo $this->get_render_attribute_string( 'accordion' ); ?>>
                <?php foreach ( $settings['tabs'] as $index => $item ) :
                $acc_count = $index + 1;

                $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                $this->add_render_attribute( $tab_title_setting_key, ['class' => [ 'tmt-accordion-title flex align-items-center' ],]);

                $this->add_render_attribute( $tab_title_setting_key, 'class', ( 'right' == $settings['icon_align'] ) ? 'justify-content-between' : '' );

                $this->add_render_attribute( $tab_title_setting_key, 'class', ( 'yes' == $settings['icon_align_reverse'] ) ? 'flex-row-reverse' : '' );

                $this->add_render_attribute( $tab_title_setting_key, 'class', ( $acc_count === $settings['active_item']) ? 'tmt-open' : '' );

                if (true == $settings['multiple']){
                    $this->add_render_attribute( $tab_title_setting_key, ['class' => [ 'multiple' ],]);
                }

                $this->add_render_attribute( $tab_content_setting_key, [
                    'class' => [ 'tmt-accordion-content' ],
                ]);

                $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
                ?>
                <div class="tmt-accordion-item<?php echo ($acc_count === $settings['active_item']) ? ' tmt-open' : ''; ?>">
                    <<?php echo $settings['title_html_tag']; ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>

                    <?php if ( $settings['accordion_icon']['value'] ) : ?>
                        <span class="tmt-accordion-icon tmt-flex-align-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">

								<?php if ( $is_new || $migrated ) : ?>
                                    <span class="tmt-accordion-icon-closed">

									<?php Icons_Manager::render_icon( $settings['accordion_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] ); ?>
									</span>
                                <?php else : ?>
                                    <i class="tmt-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
                                <?php endif; ?>

                            <?php if ( $active_is_new || $active_migrated ) : ?>
                                <span class="tmt-accordion-icon-opened">
									<?php Icons_Manager::render_icon( $settings['accordion_active_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] ); ?>
                                </span>
                            <?php else : ?>
                                <i class="tmt-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>" aria-hidden="true"></i>
                            <?php endif; ?>

							</span>
                    <?php endif; ?>
                    <?php echo esc_html($item['tab_title']); ?>

                </<?php echo esc_html($settings['title_html_tag']); ?>>
                <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                    <?php
                    $source = $item['source'];
                    switch($source) {
                        case 'elementor' :
                            $template_id = $item['template_id'];
                            echo TMT_Elementor_Template($template_id);
                        break;
                        case 'custom' :
                            echo $this->parse_text_editor( $item['tab_content'] );
                        break;
                    }
                    ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
        <?php
    }
    
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_Accordion );