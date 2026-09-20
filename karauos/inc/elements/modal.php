<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class TMT_Modal extends Widget_Base {

    public function get_name(){
        return 'tmt-modal';
    }

    public function get_title(){
        return __( 'Modal', text_domain );
    }

    public function get_icon() {
        return 'eicon-lightbox-expand';
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_keywords() {
        return [ 'modal', 'lightbox', 'popup' ];
    }

    protected function _register_controls() {
        $this->register_content_controls();
        $this->register_style_controls();
        $this->register_style_btn_controls();
        $this->register_style_header_controls();
        $this->register_style_content_controls();
        $this->register_style_footer_controls();
        $this->register_style_close_controls();
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', text_domain )
            ]
        );
        $this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn',
				'options' => [
					'btn' => __( 'Botton', text_domain ),
					'auto'  => __( 'Auto', text_domain )
				],				
			]
		);
        $this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Text', text_domain ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Open Modal', text_domain ),
                'condition'   => [ 'layout' => 'btn' ],
			]
		);
        $this->add_control(
			'modal_button_icon',
			[
				'label' => __( 'Icon', 'text-domain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'load_after',
			[
				'label'   => esc_html__( 'Load After (s)', text_domain ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 60,
					],
				],
                'selectors' => [
					'{{WRAPPER}} .tmt-modal-bg,{{WRAPPER}} .tmt-modal-box' => 'animation: loadAfter 0s {{SIZE}}s forwards;',
				],
				'condition'   => [ 'layout' => 'auto' ],
			]
		);
        $this->add_control(
			'source',
			[
				'label'   => __( 'Select Source', text_domain ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'        => esc_html__( 'Custom Content', text_domain ),
                    'elementor'     => esc_html__( 'Elementor Template', text_domain ),
				],				
			]
		);
        $this->add_control(
            'template_id',
            [
                'label'       => __( 'Select Template', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => tmt_customizer_elementor_library( 'library' ),
                'label_block' => 'true',
                'condition'   => [ 'source' => 'elementor' ],
            ]
        );
        
        $this->add_control(
			'header',
			[
				'label'       => esc_html__( 'Header', text_domain ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'This is your modal header title', text_domain ),
				'placeholder' => esc_html__( 'Modal header title', text_domain ),
				'label_block' => true,
                'condition'   => ['source' => 'custom'],
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Custom Content', text_domain ),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'show_label'  => false,
				'condition'   => ['source' => 'custom'],
				'default'     => esc_html__( 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.', text_domain ),
			]
		);

		$this->add_control(
			'footer',
			[
				'label'       => esc_html__( 'Footer', text_domain ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'This is your modal footer text', text_domain ),
				'label_block' => true,
                'condition'   => ['source' => 'custom'],
			]
		);
        $this->add_control(
			'close_button',
			[
				'label'       => esc_html__( 'Close Button', text_domain ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'inside',
				'options'     => [
					'inside' => esc_html__( 'Inside', text_domain ),
					'outside' => esc_html__( 'Outside', text_domain ),
					'none'    => esc_html__( 'No Close Button', text_domain ),
				],
			]
		);
        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'modal_width',
			[
				'label' => esc_html__( 'Modal Width', text_domain ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 320,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }
    protected function register_style_btn_controls() {
        $this->start_controls_section(
            'style_btn_section',
            [
                'label' => __( 'Button', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => ['layout' => 'btn'],
            ]
        );
        $this->add_responsive_control(
			'button_align',
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
					'justify' => [
						'title' => __( 'Justified', text_domain ),
						'icon'  => 'fas fa-align-justify',
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-botton' => 'text-align: {{VALUE}};',
				],
			]
		);
        

        $this->add_control(
			'button_icon_indent',
			[
				'label'   => esc_html__( 'Icon Spacing', text_domain ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'modal_button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton i,{{WRAPPER}} .tmt-modal-botton svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .tmt-modal-botton i,body.rtl {{WRAPPER}} .tmt-modal-botton svg'  => 'margin-left: {{SIZE}}{{UNIT}};margin-right:0;',
				],
			]
		);
        $this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', text_domain ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tmt-modal-botton a svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Background Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'button_border',
				'label'       => esc_html__( 'Border', text_domain ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tmt-modal-botton a',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-botton a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label'      => esc_html__( 'Padding', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-botton a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .tmt-modal-botton a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', text_domain ),
				'selector' => '{{WRAPPER}} .tmt-modal-botton a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', text_domain ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Text Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tmt-modal-botton a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-botton a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_style_header_controls() {
        $this->start_controls_section(
            'style_header_section',
            [
                'label' => __( 'Header', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => ['source' => 'custom'],
            ]
        );
        $this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-header' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_background',
			[
				'label'     => esc_html__( 'Background', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label'      => esc_html__( 'Padding', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'header_align',
			[
				'label'       => esc_html__( 'Titlt Align', text_domain ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left' => [
						'title' => esc_html__( 'Left', text_domain ),
						'icon'  => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', text_domain ),
						'icon'  => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', text_domain ),
						'icon'  => 'fas fa-align-right',
					],
				],
				'default' => 'left',
                'selectors'  => [
					'{{WRAPPER}} .tmt-modal-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'header_border',
				'label'       => esc_html__( 'Border', text_domain ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tmt-modal-header',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'header_box_shadow',
				'selector' => '{{WRAPPER}} .tmt-modal-header',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .tmt-modal-header',
			]
		);

        $this->end_controls_section();
    }
    protected function register_style_content_controls() {
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __( 'Content', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => ['source' => 'custom'],
            ]
        );
        $this->add_responsive_control(
			'content_align',
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
					'justify' => [
						'title' => __( 'Justified', text_domain ),
						'icon'  => 'fas fa-align-justify',
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-content' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'content_text_color',
			[
				'label'     => esc_html__( 'Text Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_background',
			[
				'label'     => esc_html__( 'Background', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', text_domain ),
				'selector' => '{{WRAPPER}} .tmt-modal-content',
			]
		);

        $this->end_controls_section();
    }
    protected function register_style_footer_controls() {
        $this->start_controls_section(
            'style_footer_section',
            [
                'label' => __( 'Footer', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => ['source' => 'custom'],
            ]
        );
        $this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-footer' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'footer_background',
			[
				'label'     => esc_html__( 'Background', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-footer' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'footer_padding',
			[
				'label'      => esc_html__( 'Padding', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'footer_align',
			[
				'label'       => esc_html__( 'Text Align', text_domain ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left' => [
						'title' => esc_html__( 'Left', text_domain ),
						'icon'  => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', text_domain ),
						'icon'  => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', text_domain ),
						'icon'  => 'fas fa-align-right',
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-footer' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'footer_border',
				'label'       => esc_html__( 'Border', text_domain ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tmt-modal-footer',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'footer_box_shadow',
				'selector' => '{{WRAPPER}} .tmt-modal-footer',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .tmt-modal-footer',
			]
		);

        $this->end_controls_section();
    }
    protected function register_style_close_controls() {
        $this->start_controls_section(
            'style_close_section',
            [
                'label' => __( 'Close Botton', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => ['close_button!' => 'none'],
            ]
        );
        $this->add_control(
			'close_button_color',
			[
				'label'     => esc_html__( 'Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-close' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_backgroun_color',
			[
				'label'     => esc_html__( 'Background', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-modal-close' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'close_button_border',
				'label'       => esc_html__( 'Border', text_domain ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tmt-modal-close',
			]
		);

		$this->add_control(
			'close_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_padding',
			[
				'label'      => esc_html__( 'Padding', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_margin',
			[
				'label'      => esc_html__( 'Margin', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tmt-modal-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }
    

    protected function render() {
        $settings = $this->get_settings();
        $id = 'tmt-modal-' . $this->get_id();
        $layout = $settings['layout'];
        $source = $settings['source'];
        $header = $settings['header'];
        $content = $settings['content'];
        $footer = $settings['footer'];
        $close_button = $settings['close_button'];
        echo "<div class='tmt-modal $layout'>";
            if($layout == 'btn') {$button_text = $settings['button_text'];echo "<div class='tmt-modal-botton'><a href='#$id'>";Icons_Manager::render_icon( $settings['modal_button_icon'], [ 'aria-hidden' => 'true' ] );echo " $button_text</a></div>";}
            echo "<div id='$id' class='tmt-modal-bg flex align-items-center justify-content-center'>";
                echo "<div class='tmt-modal-box'>";
                    if($source == 'custom') {
                        if(!empty($header)) {echo  "<div class='tmt-modal-header'>$header</div>";}
                        if(!empty($content)) {echo  "<div class='tmt-modal-content'>$content</div>";}
                        if(!empty($footer)) {echo  "<div class='tmt-modal-footer'>$footer</div>";}
                        if($close_button != 'none') {echo '<button class="tmt-modal-close" type="button"><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>';}
                    } else {
                        $template_id = $settings['template_id'];
                        echo TMT_Elementor_Template($template_id);
                    }
                echo "</div>"
            . "</div>"
        . "</div>";
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Modal );