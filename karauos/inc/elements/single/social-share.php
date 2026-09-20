<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor social icons widget.
 *
 * Elementor widget that displays icons to social pages like Facebook and Twitter.
 *
 * @since 1.0.0
 */
class TMT_Social_Share extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve social icons widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tmt-social-share';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve social icons widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Social Share', text_domain );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve social icons widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'social', 'icon', 'link' ];
	}

    public function get_categories() {
        return [ 'single_karauos' ];
    }

	/**
	 * Register social icons widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

    protected function _register_controls() {
        $this->register_general_content_controls();
        $this->register_general_style_controls();
    }
    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_social_icon',
            [
                'label' => __( 'Social Icons', text_domain ),
            ]
        );

        $this->add_control(
            'linkedin',
            [
                'label' => __( 'Linkedin', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'pinterest',
            [
                'label' => __( 'Pinterest', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'twitter',
            [
                'label' => __( 'Twitter', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'google_plus',
            [
                'label' => __( 'Google Plus', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'facebook',
            [
                'label' => __( 'Facebook', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'mail',
            [
                'label' => __( 'Mail', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'whatsapp',
            [
                'label' => __( 'Whatsapp', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'telegram',
            [
                'label' => __( 'Telegram', text_domain ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', text_domain ),
                'label_off' => __( 'Hide', text_domain ),
                'return_value' => true,
                'default' => true,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', text_domain ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
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
                'default' => 'left',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_style_controls() {
        $this->start_controls_section(
            'section_social_style',
            [
                'label' => __( 'Icon', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'   => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
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
        $this->start_controls_tabs('style_icons_tabs');
        $this->start_controls_tab('style_icons_normal_tab', ['label' => __( 'Normal', text_domain ),]);

        $this->add_control(
            'icon_secondary_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default'   => '#793ba8',
                'selectors' => [
                    '{{WRAPPER}} i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_primary_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
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
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} a',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab('style_icons_hover_tab', ['label' => __( 'Hover', text_domain ),]);

        $this->add_control(
            'hover_secondary_color',
            [
                'label' => __( 'Icon Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => __( 'Background Color', text_domain ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hover_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Box Shadow', text_domain ),
                'selector' => '{{WRAPPER}} a:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} a:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	/**
	 * Render social icons widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$align = $settings['align'];
        $blog_name = get_bloginfo('name');
        $url = urlencode(get_the_permalink());
        $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
        $media = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));

        echo "<ul class='flex align-items-center justify-content-$align'>";
        if ($settings['linkedin'] == true) {
            echo "<li><a href='http://www.linkedin.com/shareArticle?mini=true&amp;url=$url&amp;title=$title&amp;summary=&amp;source=$blog_name;'><i class='fab fa-linkedin-in'></i></a></li>";
        }
        if ($settings['pinterest'] == true) {
            echo "<li><a href='https://pinterest.com/pin/create/button/?url=$url&amp;media=$media&amp;description=$title'><i class='fab fa-pinterest-p'></i></a></li>";
        }
        if ($settings['twitter'] == true) {
            echo "<li><a href='https://twitter.com/intent/tweet?text=$title&amp;url=$url&amp;via=WPCrumbs'><i class='fab fa-twitter'></i></a></li>";
        }
        if ($settings['google_plus'] == true) {
            echo "<li><a href='https://plus.google.com/share?url=$url'><i class='fab fa-google-plus-g'></i></a></li>";
        }
        if ($settings['facebook'] == true) {
            echo "<li><a href='https://www.facebook.com/sharer/sharer.php?u=$url'><i class='fab fa-facebook-f'></i></a></li>";
        }
        if ($settings['mail'] == true) {
            echo "<li><a href='mailto:?subject=$title&amp;body=$url'><i class='far fa-envelope'></i></a></li>";
        }if ($settings['whatsapp'] == true) {
            echo "<li><a href='https://api.whatsapp.com/send?text=$url'><i class='fab fa-whatsapp'></i></a></li>";
        }
        if ($settings['telegram'] == true) {
            echo "<li><a href='https://telegram.me/share/url?url=$url&text=$title'><i class='fab fa-telegram-plane'></i></a></li>";
        }
        echo "</ul>";
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Social_Share );