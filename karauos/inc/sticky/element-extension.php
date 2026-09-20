<?php


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'TMT_Sticky_Element_Extension' ) ) {

	/**
	 * Define TMT_Sticky_Element_Extension class
	 */
	class TMT_Sticky_Element_Extension {

		/**
		 * Sections Data
		 *
		 * @var array
		 */
		public $sections_data = array();

		/**
		 * Columns Data
		 *
		 * @var array
		 */
		public $columns_data = array();

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Init Handler
		 */
		public function init() {

			add_action( 'elementor/element/column/section_advanced/after_section_end', array( $this, 'after_column_section_layout' ), 10, 2 );

			add_action( 'elementor/frontend/column/before_render',  array( $this, 'column_before_render' ) );
			add_action( 'elementor/frontend/element/before_render', array( $this, 'column_before_render' ) );

			add_action( 'elementor/element/section/section_advanced/after_section_end', array( $this, 'add_section_sticky_controls' ), 10, 2 );
		}

		/**
		 * After column_layout callback
		 *
		 * @param  object $obj
		 * @param  array $args
		 * @return void
		 */
		public function after_column_section_layout( $obj, $args ) {

			$obj->start_controls_section(
				'tmt_sticky_column_sticky_section',
				array(
					'label' => esc_html__( 'Sticky', text_domain ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				)
			);

			$obj->add_control(
				'tmt_sticky_column_sticky',
				array(
					'label'   => esc_html__( 'Sticky Column', text_domain ),
					'type'    => Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'prefix_class' => 'tmt-sticky-',
				)
			);

			$obj->add_control(
				'tmt_sticky_column_hidden',
				array(
					'label'   => esc_html__( 'Hidden Before Active Column', text_domain ),
					'type'    => Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
					'prefix_class' => 'tmt-hidden-',
				)
			);

			$obj->add_responsive_control(
				'tmt_sticky_column_sticky_margin',
				array(
					'label'      => esc_html__( 'Margin', text_domain ),
					'type'       => Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'allowed_dimensions' => 'vertical',
					'placeholder' => array(
						'top'    => '',
						'right'  => 'auto',
						'bottom' => '',
						'left'   => 'auto',
					),
					'selectors' => array(
						'{{WRAPPER}}.is-sticky' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					),
					'condition' => array(
						'tmt_sticky_column_sticky' => 'yes',
					),
				)
			);

			$obj->add_responsive_control(
				'tmt_sticky_column_sticky_padding',
				array(
					'label'      => esc_html__( 'Padding', text_domain ),
					'type'       => Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}}.is-sticky' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition' => array(
						'tmt_sticky_column_sticky' => 'yes',
					),
				)
			);

			$obj->add_group_control(
				Elementor\Group_Control_Background::get_type(),
				[
					'name'           => 'tmt_sticky_column_sticky_background',
					'label'          => __( 'Background Color', text_domain ),
					'types'          => [ 'classic', 'gradient' ],
					'selector'       => '{{WRAPPER}}.is-sticky',
					'condition' => array(
						'tmt_sticky_column_sticky' => 'yes',
					),
				]
			);

			$obj->add_group_control(
				Elementor\Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'tmt_sticky_column_sticky_box_shadow',
					'selector'  => '{{WRAPPER}}.is-sticky',
					'condition' => array(
						'tmt_sticky_column_sticky' => 'yes',
					),
				)
			);

			$obj->add_control(
				'tmt_sticky_column_sticky_transition',
				array(
					'label'   => esc_html__( 'Transition Duration', text_domain ),
					'type'    => Elementor\Controls_Manager::SLIDER,
					'default' => array(
						'size' => 0.1,
					),
					'range' => array(
						'px' => array(
							'max'  => 3,
							'step' => 0.1,
						),
					),
					'selectors' => array(
						'{{WRAPPER}}' => 'transition: margin {{SIZE}}s, padding {{SIZE}}s, background {{SIZE}}s, box-shadow {{SIZE}}s',
					),
					'condition' => array(
						'tmt_sticky_column_sticky' => 'yes',
					),
				)
			);

			$obj->end_controls_section();
		}

		/**
		 * Before column render callback.
		 *
		 * @param object $element
		 *
		 * @return void
		 */
		public function column_before_render( $element ) {
			$data     = $element->get_data();
			$type     = isset( $data['elType'] ) ? $data['elType'] : 'column';
			$settings = $data['settings'];

			if ( 'column' !== $type ) {
				return;
			}

			if ( isset( $settings['tmt_sticky_column_sticky_enable'] ) ) {
				$column_settings = array(
					'id'            => $data['id'],
					'sticky'        => filter_var( $settings['tmt_sticky_column_sticky_enable'], FILTER_VALIDATE_BOOLEAN ),
					'topSpacing'    => isset( $settings['tmt_sticky_column_sticky_top_spacing'] ) ? $settings['tmt_sticky_column_sticky_top_spacing'] : 50,
					'bottomSpacing' => isset( $settings['tmt_sticky_column_sticky_bottom_spacing'] ) ? $settings['tmt_sticky_column_sticky_bottom_spacing'] : 50,
					'stickyOn'      => isset( $settings['tmt_sticky_column_sticky_enable_on'] ) ? $settings['tmt_sticky_column_sticky_enable_on'] : array( 'desktop', 'tablet' ),
				);

				if ( filter_var( $settings['tmt_sticky_column_sticky_enable'], FILTER_VALIDATE_BOOLEAN ) ) {

					$element->add_render_attribute( '_wrapper', array(
						'class' => 'tmt-sticky-column-sticky',
						'data-tmt-sticky-column-settings' => json_encode( $column_settings ),
					) );
				}

				$this->columns_data[ $data['id'] ] = $column_settings;
			}
		}

		/**
		 * Add sticky controls to section settings.
		 *
		 * @param object $element Element instance.
		 * @param array  $args    Element arguments.
		 */
		public function add_section_sticky_controls( $element, $args ) {
			$element->start_controls_section(
				'tmt_sticky_section_sticky_settings',
				array(
					'label' => esc_html__( 'Sticky', text_domain ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				)
			);

			$element->add_control(
				'tmt_sticky_section_sticky',
				array(
					'label'   => esc_html__( 'Sticky Section', text_domain ),
					'type'    => Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'prefix_class' => 'tmt-sticky-',
				)
			);

			$element->add_control(
				'tmt_sticky_section_sticky_top',
				array(
					'label'   => esc_html__( 'Fix To Top', text_domain ),
					'type'    => Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'selectors' => array(
						'body:not(.elementor-editor-active) {{WRAPPER}}' => 'position: fixed;top: 0;width: 100%;',
					),
				)
			);
			$element->add_control(
				'tmt_sticky_section_sticky_bottom',
				array(
					'label'   => esc_html__( 'Fix To Bottom', text_domain ),
					'type'    => Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'selectors' => array(
						'body:not(.elementor-editor-active) {{WRAPPER}}' => 'position: fixed;bottom: 0;width: 100%;',
					),
				)
			);

			$element->add_responsive_control(
				'tmt_sticky_section_sticky_style_heading',
				array(
					'label'     => esc_html__( 'Sticky Section Style', text_domain ),
					'type'      => Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				)
			);

			$element->add_responsive_control(
				'tmt_sticky_section_sticky_margin',
				array(
					'label'      => esc_html__( 'Margin', text_domain ),
					'type'       => Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'allowed_dimensions' => 'vertical',
					'placeholder' => array(
						'top'    => '',
						'right'  => 'auto',
						'bottom' => '',
						'left'   => 'auto',
					),
					'selectors' => array(
						'{{WRAPPER}}.is-sticky' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					),
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				)
			);

			$element->add_responsive_control(
				'tmt_sticky_section_sticky_padding',
				array(
					'label'      => esc_html__( 'Padding', text_domain ),
					'type'       => Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}}.is-sticky' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				)
			);

			$element->add_group_control(
				Elementor\Group_Control_Background::get_type(),
				[
					'name'           => 'tmt_sticky_section_sticky_background',
					'label'          => __( 'Background Color', text_domain ),
					'types'          => [ 'classic', 'gradient' ],
					'selector'       => '{{WRAPPER}}.is-sticky',
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				]
			);

			$element->add_group_control(
				Elementor\Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'tmt_sticky_section_sticky_box_shadow',
					'selector'  => '{{WRAPPER}}.is-sticky',
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				)
			);

			$element->add_control(
				'tmt_sticky_section_sticky_transition',
				array(
					'label'   => esc_html__( 'Transition Duration', text_domain ),
					'type'    => Elementor\Controls_Manager::SLIDER,
					'default' => array(
						'size' => 0.1,
					),
					'range' => array(
						'px' => array(
							'max'  => 3,
							'step' => 0.1,
						),
					),
					'selectors' => array(
						'{{WRAPPER}}' => 'transition: margin {{SIZE}}s, padding {{SIZE}}s, background {{SIZE}}s, box-shadow {{SIZE}}s',
					),
					'condition' => array(
						'tmt_sticky_section_sticky' => 'yes',
					),
				)
			);

			$element->end_controls_section();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of TMT_Sticky_Element_Extension
 *
 * @return object
 */
function tmt_sticky_element_extension() {
	return TMT_Sticky_Element_Extension::get_instance();
}