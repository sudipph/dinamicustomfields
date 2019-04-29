<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function wellexpo_select_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_header_vertical_area_meta_options_map' ) ) {
	function wellexpo_select_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'wellexpo' )
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'wellexpo' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'wellexpo' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'wellexpo' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'wellexpo' ),
				'description'   => esc_html__( 'Set border on vertical area', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = wellexpo_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'qodef_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'wellexpo' ),
				'description' => esc_html__( 'Choose color of border', 'wellexpo' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'wellexpo' ),
				'description'   => esc_html__( 'Set content in vertical center', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_menu_area_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a menu area style', 'wellexpo' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => array(
					''        => esc_html__( 'Default', 'wellexpo' ),
					'classic' => esc_html__( 'Classic', 'wellexpo' ),
					'custom'  => esc_html__( 'Custom', 'wellexpo' )
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_header_area_meta_boxes_map', 'wellexpo_select_header_vertical_area_meta_options_map', 10, 1 );
}