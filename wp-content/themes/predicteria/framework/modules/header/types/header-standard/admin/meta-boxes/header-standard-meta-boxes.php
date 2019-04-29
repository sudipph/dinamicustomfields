<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function wellexpo_select_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_header_standard_meta_map' ) ) {
	function wellexpo_select_header_standard_meta_map( $parent ) {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_header_standard_meta_boxes();
		
		wellexpo_select_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'wellexpo' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'wellexpo' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'wellexpo' ),
					'left'   => esc_html__( 'Left', 'wellexpo' ),
					'right'  => esc_html__( 'Right', 'wellexpo' ),
					'center' => esc_html__( 'Center', 'wellexpo' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_header_area_meta_boxes_map', 'wellexpo_select_header_standard_meta_map' );
}