<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Themento_Gallery extends Widget_Base {

    public function get_name() {
        return 'themento_gallery';
    }

    public function get_title() {
        return __( 'Masonry Image Gallery', text_domain );
    }

    public function get_categories() {
        return [ text_domain ];
    }

    public function get_icon() {
        return 'eicon-gallery-masonry';
    }

    public function get_keywords() {
        return [ 'image', 'photo', 'visual', 'gallery' ];
    }

    protected function _register_controls() {
        $this->register_general_gallery_controls();
        $this->register_general_gallery_style_controls();
    }

    protected function register_general_gallery_controls() {
        $this->start_controls_section(
            'section_gallery',
            [
                'label' => __( 'Image Gallery', text_domain ),
            ]
        );
        $this->add_control(
            'wp_gallery',
            [
                'label' => __( 'Add Images', text_domain ),
                'type' => Controls_Manager::GALLERY,
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'gallery_columns_basics',
            [
                'label' => __( 'Columns', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'gallery_columns',
            [
                'label' => __( 'Columns', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'range' => [
                    'px' => [
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery' => 'column-count: {{SIZE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [ 'custom' ],
                'separator' => 'none',
            ]
        );
        $this->add_control(
            'gallery_link',
            [
                'label' => __( 'Link', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'file',
                'options' => [
                    'file' => __( 'Media File', text_domain ),
                    'attachment' => __( 'Attachment Page', text_domain ),
                    'none' => __( 'None', text_domain ),
                ],
            ]
        );
        $this->add_control(
            'open_lightbox',
            [
                'label' => __( 'Lightbox', text_domain ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', text_domain ),
                    'yes' => __( 'Yes', text_domain ),
                    'no' => __( 'No', text_domain ),
                ],
                'condition' => [
                    'gallery_link' => 'file',
                ],
            ]
        );
        $this->add_control(
            'gallery_rand',
            [
                'label' => __( 'Order By', text_domain ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', text_domain ),
                    'rand' => __( 'Random', text_domain ),
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'View', text_domain ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();
    }
    protected function register_general_gallery_style_controls() {
        $this->start_controls_section(
            'section_gallery_images',
            [
                'label' => __( 'Images', text_domain ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_spacing_column_basics',
            [
                'label' => __( 'Spacing Between Columns', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'image_spacing_column',
            [
                'label' => __( 'Spacing Between Columns', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_spacing_row_basics',
            [
                'label' => __( 'Spacing Between Row', text_domain ),
                'type'      => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'image_spacing_row',
            [
                'label' => __( 'Spacing Between Row', text_domain ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'margin: {{SIZE}}{{UNIT}} 0',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .gallery-item img',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', text_domain ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! $settings['wp_gallery'] ) {
            return;
        }

        $ids = wp_list_pluck( $settings['wp_gallery'], 'id' );

        $this->add_render_attribute( 'shortcode', 'ids', implode( ',', $ids ) );
        $this->add_render_attribute( 'shortcode', 'size', $settings['thumbnail_size'] );
        $this->add_render_attribute( 'shortcode', 'columns', 1 );

        if ( $settings['gallery_link'] ) {
            $this->add_render_attribute( 'shortcode', 'link', $settings['gallery_link'] );
        }

        if ( ! empty( $settings['gallery_rand'] ) ) {
            $this->add_render_attribute( 'shortcode', 'orderby', $settings['gallery_rand'] );
        }
        ?>
        <div class="tmt-image-gallery">
            <?php
            $this->add_render_attribute( 'link', [
                'data-elementor-open-lightbox' => $settings['open_lightbox'],
                'data-elementor-lightbox-slideshow' => $this->get_id(),
            ] );

            if ( Plugin::$instance->editor->is_edit_mode() ) {
                $this->add_render_attribute( 'link', [
                    'class' => 'elementor-clickable',
                ] );
            }


            echo do_shortcode( '[gallery ' . $this->get_render_attribute_string( 'shortcode' ) . ']' );

            ?>
        </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Themento_Gallery );