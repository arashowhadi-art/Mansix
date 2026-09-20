<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_Info_Box extends Widget_Base {

    public function get_name() {
        return 'info-box';
    }

    public function get_title() {
        return __( 'Info Box', text_domain );
    }
    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_keywords() {
		return [ 'info box', 'image box', 'icon box', 'icon', 'image', 'photo', 'visual', 'box' ];
	}
    protected function _register_controls() {

        $this->register_general_content_controls();
        $this->register_imgicon_content_controls();
        $this->register_separator_content_controls();
        $this->register_link_content_controls();
        $this->register_style_content_controls();
        $this->register_style_icon_controls();
        $this->register_style_hr_controls();
        $this->register_style_link_controls();
        $this->register_margin_content_controls();
    }

    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_general_field',
            [
                'label' => __( 'General', text_domain ),
            ]
        );

        $this->add_control(
            'infobox_title_prefix',
            [
                'label'    => __( 'Title Prefix', text_domain ),
                'type'     => Controls_Manager::TEXT,
                'dynamic'  => [
                    'active' => true,
                ],
                'selector' => '{{WRAPPER}} .themento-infobox-title-prefix',
            ]
        );
        $this->add_control(
            'infobox_title',
            [
                'label'    => __( 'Title', text_domain ),
                'type'     => Controls_Manager::TEXT,
                'selector' => '{{WRAPPER}} .themento-infobox-title',
                'dynamic'  => [
                    'active' => true,
                ],
                'default'  => __( 'Info Box', text_domain ),
            ]
        );
        $this->add_control(
            'infobox_description',
            [
                'label'    => __( 'Description', text_domain ),
                'type'     => Controls_Manager::TEXTAREA,
                'selector' => '{{WRAPPER}} .themento-infobox-text',
                'dynamic'  => [
                    'active' => true,
                ],
                'default'  => __( 'Enter description text here.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', text_domain ),
            ]
        );
        $this->end_controls_section();

    }
    protected function register_imgicon_content_controls() {
        $this->start_controls_section(
            'section_image_field',
            [
                'label' => __( 'Image/Icon', text_domain ),
            ]
        );

        $this->add_control(
            'infobox_image_position',
            [
                'label'       => __( 'Select Position', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'above-title',
                'label_block' => false,
                'options'     => [
                    'above-title' => __( 'Above Heading', text_domain ),
                    'below-title' => __( 'Below Heading', text_domain ),
                    'left-title'  => __( 'Left of Heading', text_domain ),
                    'right-title' => __( 'Right of Heading', text_domain ),
                    'left'        => __( 'Left of Text and Heading', text_domain ),
                    'right'       => __( 'Right of Text and Heading', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'infobox_imgicon_style',
            [
                'label'       => __( 'Image/Icon Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'normal',
                'label_block' => false,
                'options'     => [
                    'normal' => __( 'Normal', text_domain ),
                    'circle' => __( 'Circle Background', text_domain ),
                    'square' => __( 'Square / Rectangle Background', text_domain ),
                    'custom' => __( 'Design your own', text_domain ),
                ],
                'condition'   => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                ],
            ]
        );
        $this->add_control(
            'themento_infobox_image_type',
            [
                'label'   => __( 'Image Type', text_domain ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'photo' => [
                        'title' => __( 'Image', text_domain ),
                        'icon'  => 'fa fa-picture-o',
                    ],
                    'icon'  => [
                        'title' => __( 'Font Icon', text_domain ),
                        'icon'  => 'fa fa-info-circle',
                    ],
                ],
                'default' => 'icon',
                'toggle'  => true,
            ]
        );
        $this->add_control(
            'infobox_icon_basics',
            [
                'label'     => __( 'Icon Basics', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'infobox_select_icon',
            [
                'label'            => __( 'Select Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'render_type'      => 'template',
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                ],
            ]
        );


        $this->add_control(
            'infobox_image_basics',
            [
                'label'     => __( 'Image Basics', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'themento_infobox_image_type' => 'photo',
                ],
            ]
        );
        $this->add_control(
            'themento_infobox_photo_type',
            [
                'label'       => __( 'Photo Source', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'media',
                'label_block' => false,
                'options'     => [
                    'media' => __( 'Media Library', text_domain ),
                    'url'   => __( 'URL', text_domain ),
                ],
                'condition'   => [
                    'themento_infobox_image_type' => 'photo',
                ],
            ]
        );
        $this->add_control(
            'infobox_image',
            [
                'label'     => __( 'Photo', text_domain ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'themento_infobox_image_type' => 'photo',
                    'themento_infobox_photo_type' => 'media',

                ],
            ]
        );
        $this->add_control(
            'infobox_image_link',
            [
                'label'         => __( 'Photo URL', text_domain ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url' => '',
                ],
                'show_external' => false, // Show the 'open in new tab' button.
                'condition'     => [
                    'themento_infobox_image_type' => 'photo',
                    'themento_infobox_photo_type' => 'url',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'themento_infobox_image_type' => 'photo',
                    'themento_infobox_photo_type' => 'media',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_separator_content_controls() {

        $this->start_controls_section(
            'section_separator_field',
            [
                'label' => __( 'Separator', text_domain ),
            ]
        );

        $this->add_control(
            'infobox_separator',
            [
                'label'        => __( 'Separator', text_domain ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', text_domain ),
                'label_off'    => __( 'No', text_domain ),
                'return_value' => 'yes',
                'default'      => '',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'infobox_separator_style',
            [
                'label'       => __( 'Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'solid',
                'label_block' => false,
                'options'     => [
                    'solid'  => __( 'Solid', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'double' => __( 'Double', text_domain ),
                ],
                'condition'   => [
                    'infobox_separator' => 'yes',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .themento-separator' => 'border-top-style: {{VALUE}}; display: inline-block;',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_link_content_controls() {
        $this->start_controls_section(
            'section_cta_field',
            [
                'label' => __( 'Call To Action', text_domain ),
            ]
        );

        $this->add_control(
            'infobox_cta_type',
            [
                'label'       => __( 'Type', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', text_domain ),
                    'link'   => __( 'Text', text_domain ),
                    'button' => __( 'Button', text_domain ),
                    'module' => __( 'Complete Box', text_domain ),
                ],
            ]
        );

        $this->add_control(
            'infobox_link_text',
            [
                'label'     => __( 'Text', text_domain ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Read More', text_domain ),
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => [
                    'infobox_cta_type' => 'link',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_text',
            [
                'label'     => __( 'Text', text_domain ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Click Here', text_domain ),
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->add_control(
            'infobox_text_link',
            [
                'label'         => __( 'Link', text_domain ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'dynamic'       => [
                    'active' => true,
                ],
                'show_external' => true, // Show the 'open in new tab' button.
                'condition'     => [
                    'infobox_cta_type!' => 'none',
                ],
                'selector'      => '{{WRAPPER}} a.themento-infobox-cta-link',
            ]
        );

        $this->add_control(
            'infobox_button_size',
            [
                'label'     => __( 'Size', text_domain ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'sm',
                'options'   => [
                    'xs' => __( 'Extra Small', text_domain ),
                    'sm' => __( 'Small', text_domain ),
                    'md' => __( 'Medium', text_domain ),
                    'lg' => __( 'Large', text_domain ),
                    'xl' => __( 'Extra Large', text_domain ),
                ],
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->add_control(
            'infobox_icon_structure',
            [
                'label'     => __( 'Icon', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'infobox_cta_type' => [ 'button', 'link' ],
                ],
            ]
        );
        $this->add_control(
            'infobox_button_icon',
            [
                'label'            => __( 'Select Icon', text_domain ),
                'type'             => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'infobox_cta_type' => [ 'button', 'link' ],
                ],
            ]
        );
        $this->add_control(
            'infobox_button_icon_position',
            [
                'label'       => __( 'Icon Position', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'left',
                'label_block' => false,
                'options'     => [
                    'right' => __( 'After Text', text_domain ),
                    'left'  => __( 'Before Text', text_domain ),
                ],
                'condition'   => [
                    'infobox_cta_type'     => [ 'button', 'link' ],
                    'infobox_button_icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'infobox_icon_spacing',
            [
                'label'     => __( 'Icon Spacing', text_domain ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'   => [
                    'size' => '5',
                    'unit' => 'px',
                ],
                'condition' => [
                    'infobox_cta_type'     => [ 'button', 'link' ],
                    'infobox_button_icon!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-right,{{WRAPPER}} .themento-infobox-link-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-left, {{WRAPPER}} .themento-infobox-link-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_content_controls() {
        $this->start_controls_section(
            'section_typography_field',
            [
                'label' => __( 'Typography', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'infobox_overall_align',
            [
                'label'     => __( 'Overall Alignment', text_domain ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
                    'right'   => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'left'  => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fa fa-align-left',
                    ],
                ],
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_image_position'  => [ 'left-title', 'right-title', 'left', 'right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox, {{WRAPPER}} .themento-separator-parent' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_prefix_typo',
            [
                'label'     => __( 'Title Prefix', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'infobox_title_prefix!' => '',
                ],
            ]
        );

        $this->add_control(
            'infobox_prefix_tag',
            [
                'label'     => __( 'Prefix Tag', text_domain ),
                'type'      => Controls_Manager::SELECT,
                'options'   => TMT_Title_Tags(),
                'default'   => 'h5',
                'condition' => [
                    'infobox_title_prefix!' => '',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'prefix_typography',
                'selector'  => '{{WRAPPER}} .themento-infobox-title-prefix',
                'condition' => [
                    'infobox_title_prefix!' => '',
                ],
            ]
        );
        $this->add_control(
            'infobox_prefix_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_title_prefix!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-title-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_prefix_hover_color',
            [
                'label'     => __( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_title_prefix!' => '',
                    'infobox_cta_type'      => 'module',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover + .themento-infobox-content .themento-infobox-title-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_prefix_title_separator',
            [
                'type'      => Controls_Manager::DIVIDER,
                'style'     => 'default',
                'condition' => [
                    'infobox_title_prefix!' => '',
                ],
            ]
        );

        $this->add_control(
            'infobox_title_typo',
            [
                'label'     => __( 'Title', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'infobox_title!' => '',
                ],
            ]
        );
        $this->add_control(
            'infobox_title_tag',
            [
                'label'     => __( 'Title Tag', text_domain ),
                'type'      => Controls_Manager::SELECT,
                'options'   => TMT_Title_Tags(),
                'default'   => 'h3',
                'condition' => [
                    'infobox_title!' => '',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'selector'  => '{{WRAPPER}} .themento-infobox-title',
                'condition' => [
                    'infobox_title!' => '',
                ],
            ]
        );
        $this->add_control(
            'infobox_title_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_title!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_title_hover_color',
            [
                'label'     => __( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_title!'   => '',
                    'infobox_cta_type' => 'module',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-link-type-module a.themento-infobox-module-link:hover + .themento-infobox-content .themento-infobox-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_desc_typo',
            [
                'label'     => __( 'Description', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'infobox_description!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'infobox_description_align',
            [
                'label'     => __( 'Alignment', text_domain ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'right'   => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'left'  => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'justify'  => [
                        'title' => __( 'Justify', text_domain ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'center',
                'condition' => [
                    'infobox_description!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-text-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'selector'  => '{{WRAPPER}} .themento-infobox-text',
                'condition' => [
                    'infobox_description!' => '',
                ],
            ]
        );
        $this->add_control(
            'infobox_desc_color',
            [
                'label'     => __( 'Description Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_description!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_desc_hover_color',
            [
                'label'     => __( 'Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_description!' => '',
                    'infobox_cta_type'     => 'module',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-link-type-module a.themento-infobox-module-link:hover + .themento-infobox-content .themento-infobox-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_style_typo',
            [
                'label'     => __( 'Advanced', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'infobox_animation',
            [
                'label'     => __( 'Box animation on hover', text_domain ),
                'type'      => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_control(
            'infobox_img_mob_view',
            [
                'label'       => __( 'Responsive Support', text_domain ),
                'description' => __( 'Choose on what breakpoint the Infobox will stack.', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'tablet',
                'options'     => [
                    'none'   => __( 'No', text_domain ),
                    'tablet' => __( 'For Tablet & Mobile', text_domain ),
                    'mobile' => __( 'For Mobile Only', text_domain ),
                ],
                'condition'   => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_image_position'  => [ 'left', 'right' ],
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_icon_controls() {
        $this->start_controls_section(
            'section_style_icon_field',
            [
                'label' => __( 'Image/Icon Style', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'infobox_align',
            [
                'label'     => __( 'Overall Alignment', text_domain ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'right'   => [
                        'title' => __( 'Right', text_domain ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'center' => [
                        'title' => __( 'Center', text_domain ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'left'  => [
                        'title' => __( 'Left', text_domain ),
                        'icon'  => 'fa fa-align-left',
                    ],
                ],
                'default'   => 'center',
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_image_position'  => [ 'above-title', 'below-title' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox,  {{WRAPPER}} .themento-separator-parent' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_image_valign',
            [
                'label'       => __( 'Vertical Alignment', text_domain ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => __( 'Top', text_domain ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', text_domain ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                ],
                'default'     => 'middle',
                'condition'   => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_image_position'  => [ 'left-title', 'right-title', 'left', 'right' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'infobox_icon_size',
            [
                'label'      => __( 'Size', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'themento_infobox_image_type' => 'icon',
                    'infobox_select_icon!'    => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}; text-align: center;',
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon' => ' height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_rotate',
            [
                'label'     => __( 'Rotate', text_domain ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                    'infobox_select_icon!'    => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'infobox_image_size',
            [
                'label'      => __( 'Width', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 150,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'themento_infobox_image_type' => 'photo',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'infobox_icon_bg_size',
            [
                'label'      => __( 'Background Size', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content img' => 'padding: {{SIZE}}{{UNIT}}; display:inline-block; box-sizing:content-box;',
                ],
            ]
        );

        $this->start_controls_tabs( 'infobox_tabs_icon_style' );

        $this->start_controls_tab(
            'infobox_icon_normal',
            [
                'label'     => __( 'Normal', text_domain ),
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_color',
            [
                'label'     => __( 'Icon Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                    'infobox_select_icon!'    => '',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icons_hover_color',
            [
                'label'     => __( 'Icon Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                    'infobox_select_icon!'    => '',
                    'infobox_imgicon_style'   => 'normal',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover > i, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-infobox-content .themento-imgicon-wrap i, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_bgcolor',
            [
                'label'     => __( 'Background Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6ec1e4',
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-image .themento-image-content img' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .themento-imgicon-style-normal .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-imgicon-style-normal .themento-image .themento-image-content img' => 'background: none;',
                ],
            ]
        );

        $this->add_control(
            'infobox_icon_border',
            [
                'label'       => __( 'Border Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', text_domain ),
                    'solid'  => __( 'Solid', text_domain ),
                    'double' => __( 'Double', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                ],
                'condition'   => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style'   => 'custom',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .themento-imgicon-style-custom .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-imgicon-style-custom .themento-image .themento-image-content img' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_border_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style'   => 'custom',
                    'infobox_icon_border!'    => 'none',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-imgicon-style-custom .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-imgicon-style-custom .themento-image .themento-image-content img' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_border_size',
            [
                'label'      => __( 'Border Width', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style'   => 'custom',
                    'infobox_icon_border!'    => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-imgicon-style-custom .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-imgicon-style-custom .themento-image .themento-image-content img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_icon_border_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '5',
                    'bottom' => '5',
                    'left'   => '5',
                    'right'  => '5',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => [ 'normal', 'circle', 'square' ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-imgicon-style-custom .themento-icon-wrap .themento-icon, {{WRAPPER}} .themento-imgicon-style-custom .themento-image .themento-image-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'infobox_icon_hover',
            [
                'label'     => __( 'Hover', text_domain ),
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_hover_color',
            [
                'label'     => __( 'Icon Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'themento_infobox_image_type' => 'icon',
                    'infobox_select_icon!'    => '',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover > i, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-infobox-content .themento-imgicon-wrap i, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_icon_hover_bgcolor',
            [
                'label'     => __( 'Background Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover, {{WRAPPER}} .themento-image-content img:hover, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-infobox-content .themento-imgicon-wrap .themento-icon, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap .themento-icon, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-image .themento-image-content img, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap img' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_icon_hover_border',
            [
                'label'     => __( 'Border Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_icon_border!'    => 'none',
                    'infobox_imgicon_style!'  => 'normal',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .themento-icon-wrap .themento-icon:hover, {{WRAPPER}} .themento-image-content img:hover,  {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-infobox-content .themento-imgicon-wrap .themento-icon, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap .themento-icon, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-image .themento-image-content img, {{WRAPPER}} .themento-infobox-link-type-module .themento-infobox-module-link:hover ~ .themento-imgicon-wrap img ' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_imgicon_animation',
            [
                'label'     => __( 'Hover Animation', text_domain ),
                'type'      => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style!'  => 'normal',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'normal_imgicon_animation',
            [
                'label'     => __( 'Hover Animation', text_domain ),
                'type'      => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                    'infobox_imgicon_style'   => 'normal',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_hr_controls() {
        $this->start_controls_section(
            'section_style_hr_field',
            [
                'label' => __( 'Separator', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'infobox_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infobox_separator_color',
            [
                'label'     => __( 'Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'infobox_separator' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .themento-separator' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_separator_thickness',
            [
                'label'      => __( 'Thickness', text_domain ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'condition'  => [
                    'infobox_separator' => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_separator_width',
            [
                'label'          => __( 'Width', text_domain ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => [ '%', 'px' ],
                'range'          => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'default'        => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'label_block'    => true,
                'condition'      => [
                    'infobox_separator' => 'yes',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .themento-separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_link_controls() {
        $this->start_controls_section(
            'section_style_link_field',
            [
                'label' => __( 'Call To Action', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'infobox_cta_type' => [ 'link', 'button' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'cta_typography',
                'selector'  => '{{WRAPPER}} .themento-infobox-cta-link, {{WRAPPER}} .elementor-button, {{WRAPPER}} a.elementor-button',
                'condition' => [
                    'infobox_cta_type' => [ 'link', 'button' ],
                ],
            ]
        );
        $this->add_control(
            'infobox_cta_color',
            [
                'label'     => __( 'Link Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .themento-infobox-cta-link' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'infobox_cta_type' => 'link',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_colors',
            [
                'label'     => __( 'Colors', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->start_controls_tabs( 'infobox_tabs_button_style' );

        $this->start_controls_tab(
            'infobox_button_normal',
            [
                'label'     => __( 'Normal', text_domain ),
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );
        $this->add_control(
            'infobox_button_text_color',
            [
                'label'     => __( 'Text Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'btn_background_color',
                'label'          => __( 'Background Color', text_domain ),
                'types'          => [ 'classic', 'gradient' ],
                'selector'       => '{{WRAPPER}} .elementor-button',
                'condition'      => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_border',
            [
                'label'       => __( 'Border Style', text_domain ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', text_domain ),
                    'solid'  => __( 'Solid', text_domain ),
                    'double' => __( 'Double', text_domain ),
                    'dotted' => __( 'Dotted', text_domain ),
                    'dashed' => __( 'Dashed', text_domain ),
                ],
                'condition'   => [
                    'infobox_cta_type' => 'button',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .elementor-button' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_button_border_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'infobox_cta_type'       => 'button',
                    'infobox_button_border!' => 'none',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'infobox_button_border_size',
            [
                'label'      => __( 'Border Width', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'infobox_cta_type'       => 'button',
                    'infobox_button_border!' => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_radius',
            [
                'label'      => __( 'Border Radius', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '0',
                    'bottom' => '0',
                    'left'   => '0',
                    'right'  => '0',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'infobox_button_box_shadow',
                'selector'  => '{{WRAPPER}} .elementor-button',
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_button_custom_padding',
            [
                'label'      => __( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'infobox_button_hover',
            [
                'label'     => __( 'Hover', text_domain ),
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );
        $this->add_control(
            'infobox_button_hover_color',
            [
                'label'     => __( 'Text Hover Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'infobox_cta_type' => 'button',
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'infobox_button_hover_bgcolor',
                'label'          => __( 'Background Hover Color', text_domain ),
                'types'          => [ 'classic', 'gradient' ],
                'selector'       => '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover',
                'condition'      => [
                    'infobox_cta_type' => 'button',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_border_hover_color',
            [
                'label'     => __( 'Border Color', text_domain ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'infobox_cta_type'       => 'button',
                    'infobox_button_border!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'infobox_button_animation',
            [
                'label'       => __( 'Hover Animation', text_domain ),
                'type'        => Controls_Manager::HOVER_ANIMATION,
                'label_block' => false,
                'condition'   => [
                    'infobox_cta_type' => 'button',
                ],
                'selector'    => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_margin_content_controls() {
        $this->start_controls_section(
            'section_margin_field',
            [
                'label' => __( 'Margins', text_domain ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'infobox_title_margin',
            [
                'label'      => __( 'Title Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-infobox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'infobox_title!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_prefix_margin',
            [
                'label'      => __( 'Prefix Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'size_units' => [ 'px' ],
                'condition'  => [
                    'infobox_title_prefix!' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-infobox-title-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_responsive_imgicon_margin',
            [
                'label'      => __( 'Image/Icon Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'condition'  => [
                    'themento_infobox_image_type' => [ 'icon', 'photo' ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-imgicon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_desc_margin',
            [
                'label'      => __( 'Description Margins', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'condition'  => [
                    'infobox_description!' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-infobox-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'infobox_separator_margin',
            [
                'label'      => __( 'Separator Margins', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '20',
                    'bottom'   => '20',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'condition'  => [
                    'infobox_separator' => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'infobox_cta_margin',
            [
                'label'      => __( 'CTA Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '10',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '0',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themento-infobox-cta-link-style, {{WRAPPER}} .themento-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'infobox_cta_type' => [ 'link', 'button' ],
                ],
            ]
        );
        $this->end_controls_section();
    }
    public function render_image( $position, $settings ) {

        $set_pos          = '';
        $anim_class       = '';
        $animation_class  = '';
        $image_html       = '';
        $dynamic_settings = $this->get_settings_for_display();

        if ( 'icon' == $settings['themento_infobox_image_type'] || 'photo' == $settings['themento_infobox_image_type'] ) {
            $set_pos = $settings['infobox_image_position'];
        }
        if ( $position == $set_pos ) {
            if ( 'icon' == $settings['themento_infobox_image_type'] || 'photo' == $settings['themento_infobox_image_type'] ) {

                if ( 'normal' != $settings['infobox_imgicon_style'] ) {
                    $anim_class = 'elementor-animation-' . $settings['infobox_imgicon_animation'];
                } elseif ( 'normal' == $settings['infobox_imgicon_style'] ) {
                    $anim_class = 'elementor-animation-' . $settings['normal_imgicon_animation'];
                }
                ?>
                <div class="themento-module-content themento-imgicon-wrap"><?php /* Module Wrap */ ?>
                    <?php /*Icon Html */ ?>
                    <?php if ( 'icon' == $settings['themento_infobox_image_type'] ) { ?>
                        <div class="themento-icon-wrap <?php echo $anim_class; ?>">
							<span class="themento-icon">
                                <?php Icons_Manager::render_icon( $settings['infobox_select_icon'] ); ?>
							</span>
                        </div>
                    <?php } // Icon Html End. ?>

                    <?php /* Photo Html */ ?>
                    <?php
                    if ( 'photo' == $settings['themento_infobox_image_type'] ) {
                        if ( 'media' == $settings['themento_infobox_photo_type'] ) {
                            if ( ! empty( $dynamic_settings['infobox_image']['url'] ) ) {

                                $this->add_render_attribute( 'image', 'src', $dynamic_settings['infobox_image']['url'] );
                                $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $dynamic_settings['infobox_image'] ) );
                                $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $dynamic_settings['infobox_image'] ) );

                                $image_html = Group_Control_Image_Size::get_attachment_image_html( $dynamic_settings, 'image', 'infobox_image' );
                            }
                        }
                        if ( 'url' == $settings['themento_infobox_photo_type'] ) {
                            if ( ! empty( $settings['infobox_image_link'] ) ) {

                                $this->add_render_attribute( 'infobox_image_link', 'src', $settings['infobox_image_link']['url'] );

                                $image_html = '<img ' . $this->get_render_attribute_string( 'infobox_image_link' ) . '>';
                            }
                        }
                        ?>
                        <div class="themento-image">
                            <div class="themento-image-content <?php echo $anim_class; ?> ">
                                <?php echo $image_html; ?>
                            </div>
                        </div>

                    <?php } // Photo Html End. ?>
                </div>
                <?php
            }
        }
    }
    public function render_title( $settings ) {
        $flag             = false;
        $dynamic_settings = $this->get_settings_for_display();

        if ( ( 'photo' == $settings['themento_infobox_image_type'] && 'left-title' == $settings['infobox_image_position'] ) || ( 'icon' == $settings['themento_infobox_image_type'] && 'left-title' == $settings['infobox_image_position'] ) ) {
            echo '<div class="left-title-image">';
            $flag = true;
        }
        if ( ( 'photo' == $settings['themento_infobox_image_type'] && 'right-title' == $settings['infobox_image_position'] ) || ( 'icon' == $settings['themento_infobox_image_type'] && 'right-title' == $settings['infobox_image_position'] ) ) {
            echo '<div class="right-title-image">';
            $flag = true;
        }
        $this->render_image( 'left-title', $settings );
        echo "<div class='themento-infobox-title-wrap'>";
        if ( ! empty( $dynamic_settings['infobox_title_prefix'] ) ) {
            echo '<' . $settings['infobox_prefix_tag'] . ' class="themento-infobox-title-prefix elementor-inline-editing" data-elementor-setting-key="infobox_title_prefix" data-elementor-inline-editing-toolbar="basic" >' . $this->get_settings_for_display( 'infobox_title_prefix' ) . '</' . $settings['infobox_prefix_tag'] . '>';
        }

        echo '<' . $settings['infobox_title_tag'] . ' class="themento-infobox-title elementor-inline-editing" data-elementor-setting-key="infobox_title" data-elementor-inline-editing-toolbar="basic" >';
        echo $this->get_settings_for_display( 'infobox_title' );
        echo '</' . $settings['infobox_title_tag'] . '>';
        echo '</div>';
        $this->render_image( 'right-title', $settings );

        if ( $flag ) {
            echo '</div>';
        }
    }
    public function render_link( $settings ) {

        $dynamic_settings = $this->get_settings_for_display();

        $_link     = ( isset( $dynamic_settings['infobox_text_link']['url'] ) ) ? $dynamic_settings['infobox_text_link']['url'] : '';
        if ( 'link' == $settings['infobox_cta_type'] ) {
            $target = $dynamic_settings['infobox_text_link']['is_external'] ? ' target="_blank"' : '';
		    $nofollow = $dynamic_settings['infobox_text_link']['nofollow'] ? ' rel="nofollow"' : '';
            ?>
            <div class="themento-infobox-cta-link-style">
                <a href="<?php echo $_link; ?>" <?php echo $target . $nofollow; ?> class="themento-infobox-cta-link">
                    <?php
                    if ( ! empty( $settings['infobox_button_icon'] ) && ( 'left' == $settings['infobox_button_icon_position'] ) ) {
                        echo '<span class="themento-infobox-link-icon themento-infobox-link-icon-before">'; Icons_Manager::render_icon( $settings['infobox_button_icon']); echo '</span>';
                        } ?>
                    <span class="elementor-inline-editing" data-elementor-setting-key="infobox_link_text" data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'infobox_link_text' ); ?></span>
                    <?php
                    if ( ! empty( $settings['infobox_button_icon'] ) && 'right' == $settings['infobox_button_icon_position'] ) {
                        echo '<span class="themento-infobox-link-icon themento-infobox-link-icon-after">'; Icons_Manager::render_icon( $settings['infobox_button_icon']); echo '</span>';
                    } ?>
                </a>
            </div>
            <?php
        } elseif ( 'button' == $settings['infobox_cta_type'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'themento-button-wrapper elementor-button-wrapper' );

            if ( ! empty( $dynamic_settings['infobox_text_link']['url'] ) ) {
                $this->add_render_attribute( 'button', 'href', $dynamic_settings['infobox_text_link']['url'] );
                if ( $dynamic_settings['infobox_text_link']['is_external'] ) {
                    $this->add_render_attribute( 'button', 'target', '_blank' );
                }
    
                if ( $dynamic_settings['infobox_text_link']['nofollow'] ) {
                    $this->add_render_attribute( 'button', 'rel', 'nofollow' );
                }
                $this->add_render_attribute( 'button', 'class', 'elementor-button-link' );
            }
            $this->add_render_attribute( 'button', 'class', ' elementor-button' );

            if ( ! empty( $settings['infobox_button_size'] ) ) {
                $this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['infobox_button_size'] );
            }
            if ( $settings['infobox_button_animation'] ) {
                $this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['infobox_button_animation'] );
            }
            ?>
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                    <?php $this->render_button_text(); ?>
                </a>
            </div>
            <?php
        }
    }
    protected function render_button_text() {

        $settings = $this->get_settings();

        $this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );
        $this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['infobox_button_icon_position'] );
        $this->add_render_attribute( 'icon-align', 'class', 'elementor-button-icon' );

        $this->add_render_attribute( 'text', 'class', 'elementor-button-text' );
        $this->add_render_attribute( 'text', 'class', 'elementor-inline-editing' );

        ?>
        <span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['infobox_button_icon'] ) ) : ?>
                <span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php Icons_Manager::render_icon( $settings['infobox_button_icon']); ?>
			</span>
            <?php endif; ?>
            <span <?php echo $this->get_render_attribute_string( 'text' ); ?>  data-elementor-setting-key="infobox_button_text" data-elementor-inline-editing-toolbar="none"><?php echo $this->get_settings_for_display( 'infobox_button_text' ); ?></span>
		</span>
        <?php
    }
    protected function render() {
        $html     = '';
        $settings = $this->get_settings();
        $node_id  = $this->get_id();
        ob_start();
            $dynamic_settings = $this->get_settings_for_display();
            $_link            = ( isset( $dynamic_settings['infobox_text_link']['url'] ) ) ? $dynamic_settings['infobox_text_link']['url'] : '';

            $this->add_render_attribute( 'classname', 'class', 'themento-module-content themento-infobox elementor-animation-' . $settings['infobox_animation'] );

            if ( 'icon' == $settings['themento_infobox_image_type'] || 'photo' == $settings['themento_infobox_image_type'] ) {

                $this->add_render_attribute( 'classname', 'class', 'themento-imgicon-style-' . $settings['infobox_imgicon_style'] );

                if ( 'above-title' == $settings['infobox_image_position'] || 'below-title' == $settings['infobox_image_position'] ) {
                    $this->add_render_attribute( 'classname', 'class', ' themento-infobox-' . $settings['infobox_align'] );
                }
                if ( 'left-title' == $settings['infobox_image_position'] || 'left' == $settings['infobox_image_position'] ) {
                    $this->add_render_attribute( 'classname', 'class', ' themento-infobox-left' );
                }
                if ( 'right-title' == $settings['infobox_image_position'] || 'right' == $settings['infobox_image_position'] ) {
                    $this->add_render_attribute( 'classname', 'class', ' themento-infobox-right' );
                }
                if ( 'icon' == $settings['themento_infobox_image_type'] ) {
                    $this->add_render_attribute( 'classname', 'class', ' infobox-has-icon themento-infobox-icon-' . $settings['infobox_image_position'] );
                }
                if ( 'photo' == $settings['themento_infobox_image_type'] ) {
                    $this->add_render_attribute( 'classname', 'class', ' infobox-has-photo themento-infobox-photo-' . $settings['infobox_image_position'] );
                }
                if ( 'above-title' != $settings['infobox_image_position'] && 'below-title' != $settings['infobox_image_position'] ) {

                    if ( 'middle' == $settings['infobox_image_valign'] ) {
                        $this->add_render_attribute( 'classname', 'class', ' themento-infobox-image-valign-middle' );
                    } else {
                        $this->add_render_attribute( 'classname', 'class', ' themento-infobox-image-valign-top' );
                    }
                }
                if ( 'left' == $settings['infobox_image_position'] || 'right' == $settings['infobox_image_position'] ) {
                    if ( 'tablet' == $settings['infobox_img_mob_view'] ) {
                        $this->add_render_attribute( 'classname', 'class', ' themento-infobox-stacked-tablet' );
                    }
                    if ( 'mobile' == $settings['infobox_img_mob_view'] ) {
                        $this->add_render_attribute( 'classname', 'class', ' themento-infobox-stacked-mobile' );
                    }
                }
                if ( 'right' == $settings['infobox_image_position'] ) {
                    if ( 'tablet' == $settings['infobox_img_mob_view'] ) {
                        $this->add_render_attribute( 'classname', 'class', ' themento-reverse-order-tablet' );
                    }
                    if ( 'mobile' == $settings['infobox_img_mob_view'] ) {
                        $this->add_render_attribute( 'classname', 'class', ' themento-reverse-order-mobile' );
                    }
                }
            } else {
                if ( 'left' == $settings['infobox_overall_align'] || 'center' == $settings['infobox_overall_align'] || 'right' == $settings['infobox_overall_align'] ) {
                    $classname = 'themento-infobox-' . $settings['infobox_overall_align'];
                    $this->add_render_attribute( 'classname', 'class', ' themento-infobox-' . $settings['infobox_overall_align'] );
                }
            }

            $this->add_render_attribute( 'classname', 'class', ' themento-infobox-link-type-' . $settings['infobox_cta_type'] );

        ?>

        <div <?php echo $this->get_render_attribute_string( 'classname' ); ?>>
            <div class="themento-infobox-left-right-wrap">
                <?php
                if ( 'module' == $settings['infobox_cta_type'] && '' != $settings['infobox_text_link'] ) {
                    $target = $dynamic_settings['infobox_text_link']['is_external'] ? ' target="_blank"' : '';
		            $nofollow = $dynamic_settings['infobox_text_link']['nofollow'] ? ' rel="nofollow"' : '';
                    ?>
                    <a href="<?php echo $_link; ?>" <?php echo $target . $nofollow; ?> class="themento-infobox-module-link"></a>
                    <?php
                }
                ?>
                <?php $this->render_image( 'left', $settings ); ?>
                <div class="themento-infobox-content">
                    <?php $this->render_image( 'above-title', $settings ); ?>
                    <?php $this->render_title( $settings ); ?>
                    <?php $this->render_image( 'below-title', $settings ); ?>

                    <?php if ( 'yes' == $settings['infobox_separator'] ) { ?>
                        <div class="themento-separator-parent">
                            <div class="themento-separator"></div>
                        </div>
                    <?php } ?>

                    <div class="themento-infobox-text-wrap">
                        <div class="themento-infobox-text elementor-inline-editing" data-elementor-setting-key="infobox_description" data-elementor-inline-editing-toolbar="advanced">
                            <?php echo $this->get_settings_for_display( 'infobox_description' ); ?>
                        </div>
                        <?php $this->render_link( $settings ); ?>
                    </div>
                </div>
                <?php $this->render_image( 'right', $settings ); ?>
            </div>
        </div>
        <?php $html = ob_get_clean();
        echo $html;

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themento_Info_Box );