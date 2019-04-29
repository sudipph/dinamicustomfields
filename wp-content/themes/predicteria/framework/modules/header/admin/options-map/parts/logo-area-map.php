<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_header_logo_area_options' ) ) {
	function wellexpo_select_get_hide_dep_for_header_logo_area_options() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_header_logo_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_header_logo_area_options_map' ) ) {
	function wellexpo_select_header_logo_area_options_map( $panel_header ) {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_header_logo_area_options();
		
		$logo_area_container = wellexpo_select_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'logo_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__( 'Logo Area', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area In Grid', 'wellexpo' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'wellexpo' )
			)
		);
		
		$logo_area_in_grid_container = wellexpo_select_add_admin_container(
			array(
				'parent'     => $logo_area_container,
                'name'       => 'logo_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid' => 'no'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'logo_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'wellexpo' ),
				'description'   => esc_html__( 'Set grid background color for logo area', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'logo_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'wellexpo' ),
				'description'   => esc_html__( 'Set grid background transparency', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'wellexpo' ),
				'description'   => esc_html__( 'Set border on grid area', 'wellexpo' )
			)
		);
		
		$logo_area_in_grid_border_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $logo_area_in_grid_container,
				'name'            => 'logo_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $logo_area_in_grid_border_container,
				'type'        => 'color',
				'name'        => 'logo_area_in_grid_border_color',
				'label'       => esc_html__( 'Border Color', 'wellexpo' ),
				'description' => esc_html__( 'Set border color for grid area', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $logo_area_container,
				'type'        => 'color',
				'name'        => 'logo_area_background_color',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Set background color for logo area', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'wellexpo' ),
				'description'   => esc_html__( 'Set background transparency for logo area', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area Border', 'wellexpo' ),
				'description'   => esc_html__( 'Set border on logo area', 'wellexpo' )
			)
		);
		
		$logo_area_border_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_border'  => 'no'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'color',
				'name'          => 'logo_area_border_color',
				'label'         => esc_html__( 'Border Color', 'wellexpo' ),
				'description'   => esc_html__( 'Set border color for logo area', 'wellexpo' ),
				'parent'        => $logo_area_border_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'logo_area_height',
				'label'         => esc_html__( 'Height', 'wellexpo' ),
				'description'   => esc_html__( 'Enter logo area height (default is 100px)', 'wellexpo' ),
				'parent'        => $logo_area_container,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		do_action( 'wellexpo_select_header_logo_area_additional_options', $logo_area_container );
	}
	
	add_action( 'wellexpo_select_action_header_logo_area_options_map', 'wellexpo_select_header_logo_area_options_map', 10, 1 );
}