<?php

if ( ! function_exists( 'wellexpo_select_map_sidebar_meta' ) ) {
	function wellexpo_select_map_sidebar_meta() {
		$qodef_sidebar_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'wellexpo' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'wellexpo' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'wellexpo' ),
				'parent'      => $qodef_sidebar_meta_box,
                'options'       => wellexpo_select_get_custom_sidebars_options( true )
			)
		);
		
		$qodef_custom_sidebars = wellexpo_select_get_custom_sidebars();
		if ( count( $qodef_custom_sidebars ) > 0 ) {
			wellexpo_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'wellexpo' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'wellexpo' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_sidebar_meta', 31 );
}