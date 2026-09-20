<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Category_Archive_Description extends Widget_Base {

	public function get_name() {
		return 'tmt-cat-archive-description';
	}

	public function get_title() {
		return __( 'Category Archive Description', text_domain );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_keywords() {
		return ['description', 'category', 'archive' ];
	}

	public function get_categories() {
		return [text_domain];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_cat_description_style',
			[
				'label' => __( 'Style', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'justify' => [
						'title' => __( 'Justified', text_domain ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tmt-taxonomy-description' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tmt-taxonomy-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', text_domain ),
				'selector' => '{{WRAPPER}} .tmt-taxonomy-description',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		the_archive_description( '<div class="tmt-taxonomy-description tmt-content">', '</div>' );
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Category_Archive_Description );