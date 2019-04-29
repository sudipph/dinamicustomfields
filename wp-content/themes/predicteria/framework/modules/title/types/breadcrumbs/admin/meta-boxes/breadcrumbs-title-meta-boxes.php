<?php

if ( ! function_exists( 'wellexpo_select_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function wellexpo_select_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'wellexpo' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'wellexpo' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_title_area_meta_boxes', 'wellexpo_select_breadcrumbs_title_type_options_meta_boxes' );
}