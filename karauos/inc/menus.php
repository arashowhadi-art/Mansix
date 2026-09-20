<?php

if ( !defined( 'ABSPATH' ) )
    wp_die( 'Direct access forbidden.' );

/**
 * Register theme menus
 */

class tmt_main_nav_walker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown sub-menu\">\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;


        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if($item->object == 'mega_menu' ){
            if ( class_exists( 'Elementor\Plugin' ) ) {$classes[] = 'mega-menu';}
        }
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

        if($args->has_children  && $depth>0 ) $class_names .= ' dropdown';

        if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
        if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
        if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }


        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';


        $atts = array();
        $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
        $atts['target'] = ! empty( $item->target )  ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
        $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        if($item->object == 'mega_menu' && $depth ==1){
            if ( class_exists( 'Elementor\Plugin' ) ) {
                $elementor = Elementor\Plugin::instance();
                $item_output   .= '<div class="megamenu-content">'.$elementor->frontend->get_builder_content_for_display( $item->object_id ).'</div>';
                wp_reset_postdata();
            }
        } else {
            $description  = ! empty( $item->description ) ? esc_attr( $item->description ) : '';
            $item_output .= '<a'. $attributes .'>';
            if (!empty($description)) {$item_output .= '<i class="' . $description . '"></i>';}
            $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .=  '</a>';
        }
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
