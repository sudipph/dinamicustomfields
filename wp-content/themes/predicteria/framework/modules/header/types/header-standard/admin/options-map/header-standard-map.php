<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_standard_options' ) ) {
	function wellexpo_select_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_header_standard_map' ) ) {
	function wellexpo_select_header_standard_map( $parent ) {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_header_standard_options();
		
		wellexpo_select_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'wellexpo' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'wellexpo' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'wellexpo' ),
					'left'   => esc_html__( 'Left', 'wellexpo' ),
					'center' => esc_html__( 'Center', 'wellexpo' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_header_menu_area_options_map', 'wellexpo_select_header_standard_map' );
}