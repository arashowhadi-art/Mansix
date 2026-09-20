<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class TMT_Whatsapp extends Widget_Base {

    public function get_name() {
        return 'tmt-whatsapp';
    }

    public function get_title() {
        return __( 'Whatsapp', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'fab fa-whatsapp';
    }

    public function get_keywords() {
        return [ 'whatsapp', 'socile', 'chat' ];
    }

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_style_controls();
        $this->register_general_icon_style_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_general_content',
            [
                'label' => __( 'Content', text_domain ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
			'heading',
			[
				'label' => __( 'Heading', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Start A Conversation', text_domain ),
			]
        );
        $this->add_control(
			'description',
			[
				'label' => __( 'Description', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Select a member and chat on WhatsApp', text_domain ),
			]
        );
        
        $repeater = new Repeater();

        $repeater->start_controls_tabs('whatsapp_tabs');
        $repeater->start_controls_tab('content_tab', ['label' => __( 'Content', text_domain ),]);

        $repeater->add_control(
			'name', [
				'label' => __( 'Name', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Ali Amini' , text_domain ),
				'label_block' => true,
			]
        );
        $repeater->add_control(
			'role', [
				'label' => __( 'Role', text_domain ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Support Staff' , text_domain ),
				'label_block' => true,
			]
        );

        $repeater->add_control(
			'number', [
				'label' => __( 'Number', text_domain ),
				'type' => Controls_Manager::TEXT,
                'default' => '98961111111',
                'description' => __( 'Enter the country code before the number.' , text_domain ),
				'label_block' => true,
			]
        );

        $repeater->add_control(
			'text', [
				'label' => __( 'Default Text In WhatsApp', text_domain ),
				'type' => Controls_Manager::TEXT,
                'default' => __( 'Hello Good Morning' , text_domain ),
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'photo',
			[
				'label' => __( 'Choose Image', text_domain ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => wp_directory_uri . '/assets/images/member.svg',
				],
			]
		);
        
        $repeater->end_controls_tab();
        $repeater->start_controls_tab('style_tab', ['label' => __( 'Style', text_domain ),]);

        $repeater->add_control(
			'name_color',
			[
				'label' => __( 'Name Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} h6' => 'color: {{VALUE}}'
				],
			]
        );
        $repeater->add_control(
			'role_color',
			[
				'label' => __( 'Role Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} p' => 'color: {{VALUE}}'
				],
			]
        );

        $repeater->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'
				],
			]
        );

        $repeater->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-left-color: {{VALUE}}'
				],
			]
        );

        $repeater->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};color: {{VALUE}}'
				],
			]
        );
        
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

		$this->add_control(
			'whatsapp',
			[
				'label' => __( 'User List', text_domain ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Ali Amini', text_domain ),
						'role' => __( 'Support Staff', text_domain ),
					],
				],
				'title_field' => '{{{ name }}}',
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
                    '{{WRAPPER}} .whatsapp-pupup' => '{{VALUE}}: 30px;bottom:30px',
                    '{{WRAPPER}} .whatsapp-chat' => '{{VALUE}}: 40px',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_style_controls() {
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'Style', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
			'list_name_color',
			[
				'label' => __( 'Name Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usrt-chat h6' => 'color: {{VALUE}}'
				],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Name Typography', text_domain ),
				'selector' => '{{WRAPPER}} .usrt-chat h6',
			]
		);
        $this->add_control(
			'list_role_color',
			[
				'label' => __( 'Role Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usrt-chat p' => 'color: {{VALUE}}'
				],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'role_typography',
				'label' => __( 'Role Typography', text_domain ),
				'selector' => '{{WRAPPER}} .usrt-chat p',
			]
		);
        $this->add_control(
			'list_bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usrt-chat' => 'background-color: {{VALUE}}'
				],
			]
        );

        $this->add_control(
			'list_border_color',
			[
				'label' => __( 'Border Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .usrt-chat' => 'border-left-color: {{VALUE}}'
				],
			]
        );

        $this->add_control(
			'list_icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .usrt-chat i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .usrt-chat svg' => 'fill: {{VALUE}};color: {{VALUE}}'
				],
			]
        );
		$this->add_control(
			'list_icon_size',
			[
				'label' => __( 'Icon Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .usrt-chat i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .usrt-chat svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
				],
			]
		);
        $this->add_control(
			'list_margin',
			[
				'label' => __( 'Margin', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .usrt-chat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_control(
			'list_padding',
			[
				'label' => __( 'Padding', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .usrt-chat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_control(
			'list_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .usrt-chat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_box_shadow',
				'label' => __( 'Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} .usrt-chat',
			]
        );   

        $this->end_controls_section();
    }
    protected function register_general_icon_style_controls() {
        $this->start_controls_section(
            'section_general_icon_style',
            [
                'label' => __( 'Icon', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_size',
			[
				'label' => __( 'Background Size', text_domain ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup' => 'color: {{VALUE}}'
				],
			]
        );

        $this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '#2db742',
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup' => 'background-color: {{VALUE}}'
				],
			]
        );

        $this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', text_domain ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .whatsapp-pupup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __( 'Box Shadow', text_domain ),
				'selector' => '{{WRAPPER}} .whatsapp-pupup',
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', text_domain ),
				'selector' => '{{WRAPPER}} .whatsapp-pupup',
			]
		);
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $whatsapp = $settings['whatsapp'];
        $heading = $settings['heading'];
        $description = $settings['description'];

        echo "<div class='whatsapp-pupup'>"
            . "<i class='fab fa-whatsapp'></i>"
        . "</div>"
        . "<div class='whatsapp-chat'>"
            . "<div class='flex whatsapp-header'>"
                . "<div class='text'>";
                    if(! empty($heading)) {echo "<h4>$heading</h4>";}
                    if(! empty($description)) {echo "<p>$description</p>";}
                echo "</div>"
            . "<i class='fab fa-whatsapp'></i>"
         . "</div>"
         . "<div class='whatsapp-body'>";
         if ( $whatsapp ) {
			foreach (  $whatsapp as $item ) {
                $name = $item['name'];
                $role = $item['role'];
                $photo = $item['photo']['url'];
                $number = $item['number'];
                $text = $item['text'];
                ?>
                <div class="flex usrt-chat justify-content-between elementor-repeater-item-<?php echo $item['_id']; ?>" onClick="window.open('<?php if(wp_is_mobile()) {echo "whatsapp://send?phone=$number&amp;&text=$text";} else {echo "https://web.whatsapp.com/send?phone=$number&text=$text";} ?>','_blank')">
                    <?php echo "<div class='flex usrt-chat-id align-items-center'>"
                        . "<i class='fab fa-whatsapp'></i>"
                        . "<div class='text'>";
                            if (! empty($name)) {echo "<h4>$name</h4>";}
                            if (! empty($role)) {echo "<p>$role</p>";}
                        echo "</div>"
                    . "</div>";
                    if(! empty($photo)) {
                        echo "<img src='$photo' alt='$name' title='$name' width='50' height='50' />";
                    } 
                    echo "</div>";
			}
		}
         echo "</div>"
        . "</div>";
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Whatsapp );