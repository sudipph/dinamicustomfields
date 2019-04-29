<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_vertical_area_options' ) ) {
	function wellexpo_select_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_header_vertical_options_map' ) ) {
	function wellexpo_select_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = wellexpo_select_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'wellexpo' ),
				'parent'      => $vertical_area_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'wellexpo' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'wellexpo' ),
				'parent'        => $vertical_area_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'wellexpo' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'wellexpo' ),
				'description'   => esc_html__( 'Set border on vertical area', 'wellexpo' )
			)
		);
		
		$vertical_header_shadow_border_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'dependency' => array(
					'hide' => array(
						'vertical_header_border'  => 'no'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'wellexpo' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__( 'Center Content', 'wellexpo' ),
				'description'   => esc_html__( 'Set content in vertical center', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'select',
				'name'          => 'vertical_header_menu_area_type',
				'default_value' => '',
				'label'         => esc_html__( 'Menu Area Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a menu area style', 'wellexpo' ),
				'options'       => array(
					''        => esc_html__( 'Default', 'wellexpo' ),
					'classic' => esc_html__( 'Classic', 'wellexpo' ),
					'custom'  => esc_html__( 'Custom', 'wellexpo' )
				)
			)
		);
		
		do_action( 'wellexpo_select_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'wellexpo_select_action_additional_header_menu_area_options_map', 'wellexpo_select_header_vertical_options_map' );
}