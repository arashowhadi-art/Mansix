<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Yoast_Breadcrumb extends Widget_Base {

    public function get_name() {
        return 'tmt-yoast-breadcrumb';
    }

    public function get_title() {
        return __( 'Yoast Breadcrumbs', text_domain );
    }

    public function get_icon() {
        return 'eicon-yoast';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'yoast', 'seo', 'breadcrumbs', 'internal links' ];
    }
  

    protected function _register_controls() {
		$this->start_controls_section(
			'section_breadcrumbs_content',
			[
				'label' => __( 'Breadcrumbs', text_domain ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', text_domain ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', text_domain ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', text_domain ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', text_domain ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', text_domain ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', text_domain ),
					'p' => 'p',
					'div' => 'div',
					'nav' => 'nav',
					'span' => 'span',
				],
				'default' => '',
			]
		);

		$this->add_control(
			'html_description',
			[
				'raw' => __( 'Additional settings are available in the Yoast SEO', text_domain ) . ' ' . sprintf( '<a href="%s" target="_blank">%s</a>', admin_url( 'admin.php?page=wpseo_titles#top#breadcrumbs' ), __( 'Breadcrumbs Panel', text_domain ) ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Breadcrumbs', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_breadcrumbs_style' );

		$this->start_controls_tab(
			'tab_color_normal',
			[
				'label' => __( 'Normal', text_domain ),
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'Link Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			[
				'label' => __( 'Hover', text_domain ),
			]
		);

		$this->add_control(
			'link_hover_color',
			[
				'label' => __( 'Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	private function get_html_tag() {
		$html_tag = $this->get_settings( 'html_tag' );

		if ( empty( $html_tag ) ) {
			$html_tag = 'p';
		}

		return Utils::validate_html_tag( $html_tag );
	}

	protected function render() {
		if ( class_exists( '\WPSEO_Breadcrumbs' ) ) {
			$html_tag = $this->get_html_tag();
			WPSEO_Breadcrumbs::breadcrumb( '<' . $html_tag . ' id="breadcrumbs">', '</' . $html_tag . '>' );
		}
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_Yoast_Breadcrumb );