<?php

if ( ! function_exists( 'wellexpo_select_sidebar_options_map' ) ) {
	function wellexpo_select_sidebar_options_map() {
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'wellexpo' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = wellexpo_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'wellexpo' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		wellexpo_select_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'wellexpo' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'wellexpo' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => wellexpo_select_get_custom_sidebars_options()
		) );
		
		$wellexpo_custom_sidebars = wellexpo_select_get_custom_sidebars();
		if ( count( $wellexpo_custom_sidebars ) > 0 ) {
			wellexpo_select_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'wellexpo' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'wellexpo' ),
				'parent'      => $sidebar_panel,
				'options'     => $wellexpo_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_sidebar_options_map', wellexpo_select_set_options_map_position( 'sidebar' ) );
}