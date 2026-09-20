<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Business_Hours extends Widget_Base {

    public function get_name() {
        return 'tmt-business-hours';
    }

    public function get_title() {
        return __( 'Business Hours', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-clock-o';
    }

    public function get_keywords() {
        return [ 'business', 'hours', 'time', 'duty', 'schedule' ];
    }

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_style_controls();
        $this->register_general_divider_style_controls();
        $this->register_general_day_style_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
			'section_business_days_layout',
			[
				'label' => esc_html__( 'Business Days & Times', text_domain ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'enter_day',
			[
				'label'       => esc_html__( 'Enter Day', text_domain ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sunday',
			]
		);

		$repeater->add_control(
			'enter_time',
			[
				'label'       => esc_html__( 'Enter Time', text_domain ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '8:00 AM - 4:00 PM',
			]
		);

		$repeater->add_control(
			'current_styling_heading',
			[
				'label'     => esc_html__( 'Styling', text_domain ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'highlight_this',
			[
				'label'        => esc_html__( 'Style This Day', text_domain ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$repeater->add_control(
			'single_business_day_color',
			[
				'label'     => esc_html__( 'Day Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#db6159',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .day' => 'color: {{VALUE}}',
				],
				'condition' => [
					'highlight_this' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'single_business_timing_color',
			[
				'label'     => esc_html__( 'Time Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#db6159',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .time' => 'color: {{VALUE}}',
				],
				'condition' => [
					'highlight_this' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'single_business_background_color',
			[
				'label'     => esc_html__( 'Background Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'highlight_this' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'business_days_times',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => [
					[
						'enter_day'  => esc_html__( 'Monday', text_domain ),
						'enter_time' => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'  => esc_html__( 'Tuesday', text_domain ),
						'enter_time' => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'  => esc_html__( 'Wednesday', text_domain ),
						'enter_time' => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'  => esc_html__( 'Thursday', text_domain ),
						'enter_time' => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'  => esc_html__( 'Friday', text_domain ),
						'enter_time' => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'      => esc_html__( 'Saturday', text_domain ),
						'enter_time'     => esc_html__( '10:00 AM - 6:00 PM', text_domain ),
					],
					[
						'enter_day'      => esc_html__( 'Sunday', text_domain ),
						'enter_time'     => esc_html__( 'Closed', text_domain ),
						'highlight_this' => esc_html__( 'yes', text_domain ),
					],
				],
				'title_field' => '{{{ enter_day }}}',
			]
		);

		$this->end_controls_section();
    }
    protected function register_general_style_controls() {
        $this->start_controls_section(
			'section_bs_general',
			[
				'label' => esc_html__( 'General', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_bs_list_padding',
			[
				'label'      => esc_html__( 'Row Spacing', text_domain ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => ['top' => 10, 'right' => 5, 'bottom' => 10, 'left' => 5],
				'selectors'  => [
					'{{WRAPPER}} .business-hour' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }
    protected function register_general_divider_style_controls() {
        $this->start_controls_section(
			'section_bs_divider',
			[
				'label' => esc_html__( 'Divider', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'day_divider',
			[
				'label'        => esc_html__( 'Divider', text_domain ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'day_divider_style',
			[
				'label'     => esc_html__( 'Style', text_domain ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'solid'  => esc_html__( 'Solid', text_domain ),
					'dotted' => esc_html__( 'Dotted', text_domain ),
					'dashed' => esc_html__( 'Dashed', text_domain ),
				],
				'default'   => 'solid',
				'selectors' => [
					'{{WRAPPER}} hr' => 'border-top-style: {{VALUE}};',
				],
				'condition' => [
					'day_divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'day_divider_color',
			[
				'label'     => esc_html__( 'Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e8e8e8',
				'selectors' => [
					'{{WRAPPER}} hr' => 'border-top-color: {{VALUE}};',
				],
				'condition' => [
					'day_divider' => 'yes',
				],
			]
        );
        
        $this->add_control(
			'day_divider_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e8e8e8',
				'selectors' => [
					'{{WRAPPER}} .business-hour:hover hr' => 'border-top-color: {{VALUE}};',
				],
				'condition' => [
					'day_divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'day_divider_weight',
			[
				'label'     => esc_html__( 'Weight', text_domain ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} hr' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'day_divider' => 'yes',
				],
			]
		);

		$this->end_controls_section();
    }
    protected function register_general_day_style_controls() {
        $this->start_controls_section(
			'section_business_day_style',
			[
				'label' => esc_html__( 'Day and Time', text_domain ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'business_day_color',
			[
				'label'     => esc_html__( 'Day Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .day' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Day Typography', text_domain ),
				'name'     => 'business_day_typography',
				'selector' => '{{WRAPPER}} .day',
			]
		);

		$this->add_control(
			'business_timing_color',
			[
				'label'     => esc_html__( 'Time Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .time' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Time Typography', text_domain ),
				'name'     => 'business_timings_typography',
				'selector' => '{{WRAPPER}} .time',
			]
		);

		$this->add_control(
			'business_hours_striped',
			[
				'label'        => esc_html__( 'Striped Effect', text_domain ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'business_hours_striped_odd_color',
			[
				'label'     => esc_html__( 'Striped Odd Rows Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeaea',
				'selectors' => [
					'{{WRAPPER}} .business-hour:nth-child(odd)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'business_hours_striped' => 'yes',
				],
			]
		);

		$this->add_control(
			'striped_effect_even',
			[
				'label'     => esc_html__( 'Striped Even Rows Color', text_domain ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .business-hour:nth-child(even)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'business_hours_striped' => 'yes',
				],
			]
		);

		$this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings();
        $day_divider = $settings['day_divider'];
        if ( $settings['business_days_times'] ) {
            echo "<div class='business-hours'>";
            foreach ( $settings['business_days_times'] as $index => $item ) {
                $enter_day = $item['enter_day'];
                $enter_time = $item['enter_time'];
                echo '<div class="elementor-repeater-item-' . $item["_id"] . ' business-hour flex justify-content-between align-items-center">'
                    . "<span class='day'>$enter_day</span>";
                    if($day_divider == 'yes'){echo "<hr>";}
                    echo "<span class='time'>$enter_time</span>"
                . "</div>";
            }
            echo "</div>";       
        }        
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Business_Hours );