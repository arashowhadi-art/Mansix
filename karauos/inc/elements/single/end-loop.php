<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_End_Loop extends Widget_Base {

    public function get_name() {
        return 'tmt-end-loop';
    }

    public function get_title() {
        return __( 'End Loop', text_domain );
    }

    public function get_icon() {
        return 'eicon-editor-code';
    }

    public function get_categories() {
        return [ 'single_karauos' ];
    }

    public function get_keywords() {
        return [ 'end', 'loop' ];
    }

    protected function _register_controls() {}

    protected function render() {
        $editor = Plugin::$instance->editor->is_edit_mode();
        if($editor) {
            echo '<div class="text-center" style="color: white;background-color: darkgray;padding: 10px 0;border-radius: 4px;">' . __('End Loop', text_domain) . ' ' . __('(Do not delete this element)', text_domain) . '</div>';
        } else {
            wp_reset_postdata();
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TMT_End_Loop );