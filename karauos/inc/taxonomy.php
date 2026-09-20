<?php

// Register Custom portfolio cat Taxonomy
function portfolio_cat()  {

	$labels = array(
		'name'                       => __( 'Project Categories', text_domain ),
		'singular_name'              => __( 'Project Category', text_domain ),
		'menu_name'                  => __( 'Project Categories', text_domain ),
		'edit_item'                  => __( 'Edit Project Category', text_domain ),
		'update_item'                => __( 'Update Project Category', text_domain ),
		'add_new_item'               => __( 'Add New Project Category', text_domain ),
		'new_item_name'              => __( 'New Project Category Name', text_domain ),
		'parent_item'                => __( 'Parent Project Category', text_domain ),
		'parent_item_colon'          => __( 'Parent Project Category:', text_domain ),
		'all_items'                  => __( 'All Project Categories', text_domain ),
		'search_items'               => __( 'Search Project Categories', text_domain ),
		'popular_items'              => __( 'Popular Project Categories', text_domain ),
		'separate_items_with_commas' => __( 'Separate Project categories with commas', text_domain ),
		'add_or_remove_items'        => __( 'Add or remove Project categories', text_domain ),
		'choose_from_most_used'      => __( 'Choose from the most used Project categories', text_domain ),
		'not_found'                  => __( 'No Project categories found.', text_domain ),
		'items_list_navigation'      => __( 'Project categories list navigation', text_domain ),
		'items_list'                 => __( 'Project categories list', text_domain ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'show_in_rest'               => true,
	);
	register_taxonomy( 'portfolio_cat', 'portfolio', $args );
}


// Hook into the 'init' action
add_action( 'init', 'portfolio_cat', 0 );


// Register Custom Taxonomy
function portfolio_tags() {

	$labels = array(
		'name'                       => __( 'Project Tags', text_domain ),
		'singular_name'              => __( 'Project Tag', text_domain ),
		'menu_name'                  => __( 'Project Tags', text_domain ),
		'edit_item'                  => __( 'Edit Project Tag', text_domain ),
		'update_item'                => __( 'Update Project Tag', text_domain ),
		'add_new_item'               => __( 'Add New Project Tag', text_domain ),
		'new_item_name'              => __( 'New Project Tag Name', text_domain ),
		'parent_item'                => __( 'Parent Project Tag', text_domain ),
		'parent_item_colon'          => __( 'Parent Project Tag:', text_domain ),
		'all_items'                  => __( 'All Project Tags', text_domain ),
		'search_items'               => __( 'Search Project Tags', text_domain ),
		'popular_items'              => __( 'Popular Project Tags', text_domain ),
		'separate_items_with_commas' => __( 'Separate Project tags with commas', text_domain ),
		'add_or_remove_items'        => __( 'Add or remove Project tags', text_domain ),
		'choose_from_most_used'      => __( 'Choose from the most used Project tags', text_domain ),
		'not_found'                  => __( 'No Project tags found.', text_domain ),
		'items_list_navigation'      => __( 'Project tags list navigation', text_domain ),
		'items_list'                 => __( 'Project tags list', text_domain ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'show_in_rest'               => true,
	);
	register_taxonomy( 'portfolio_tags', array( 'portfolio' ), $args );

}
add_action( 'init', 'portfolio_tags', 0 );