<?php

if ( ! function_exists( 'wellexpo_select_map_content_fixed_meta' ) ) {
	function wellexpo_select_map_content_fixed_meta() {
		
		$content_fixed_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_fixed_meta' ),
				'title' => esc_html__( 'Content Fixed', 'wellexpo' ),
				'name'  => 'content_fixed_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_enable_content_fixed_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Fixed Area', 'wellexpo' ),
				'description'   => esc_html__( 'This option will enable Content Fixed area on pages', 'wellexpo' ),
				'parent'        => $content_fixed_meta_box,
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_content_fixed_meta', 71 );
}