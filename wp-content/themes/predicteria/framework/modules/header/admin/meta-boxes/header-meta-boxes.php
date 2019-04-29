<?php

if ( ! function_exists( 'wellexpo_select_header_types_meta_boxes' ) ) {
	function wellexpo_select_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'wellexpo_select_filter_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'wellexpo' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function wellexpo_select_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( SELECT_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( SELECT_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'wellexpo_select_map_header_meta' ) ) {
	function wellexpo_select_map_header_meta() {
		$header_type_meta_boxes              = wellexpo_select_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = wellexpo_select_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'wellexpo' ),
				'name'  => 'header_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'wellexpo' ),
				'description'   => esc_html__( 'Select header type layout', 'wellexpo' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'wellexpo' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'wellexpo' ),
					'light-header' => esc_html__( 'Light', 'wellexpo' ),
					'dark-header'  => esc_html__( 'Dark', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'qodef_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'wellexpo' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'wellexpo' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'wellexpo' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'wellexpo' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'wellexpo' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'wellexpo' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'wellexpo' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);
		
		//additional area
		do_action( 'wellexpo_select_action_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'wellexpo_select_action_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'wellexpo_select_action_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'wellexpo_select_action_header_menu_area_meta_boxes_map', $header_meta_box );

		//dropdown
		do_action( 'wellexpo_select_action_dropdown_meta_boxes_map', $header_meta_box );

		//widget areaa
		do_action( 'wellexpo_select_action_header_widget_areas_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_header_meta', 50 );
}