<?php

if ( ! function_exists( 'wellexpo_select_map_footer_meta' ) ) {
	function wellexpo_select_map_footer_meta() {
		
		$footer_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'wellexpo' ),
				'name'  => 'footer_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'wellexpo' ),
				'options'       => wellexpo_select_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = wellexpo_select_add_admin_container(
			array(
				'name'       => 'qodef_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			wellexpo_select_create_meta_box_field(
				array(
					'name'          => 'qodef_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'wellexpo' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'wellexpo' ),
					'options'       => wellexpo_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			wellexpo_select_create_meta_box_field(
				array(
					'name'          => 'qodef_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'wellexpo' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'wellexpo' ),
					'options'       => wellexpo_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			wellexpo_select_create_meta_box_field(
				array(
					'name'          => 'qodef_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'wellexpo' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'wellexpo' ),
					'options'       => wellexpo_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			wellexpo_select_create_meta_box_field(
				array(
					'name'        => 'qodef_footer_top_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Top Background Color', 'wellexpo' ),
					'description' => esc_html__( 'Set background color for top footer area', 'wellexpo' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'qodef_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);
			
			wellexpo_select_create_meta_box_field(
				array(
					'name'          => 'qodef_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'wellexpo' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'wellexpo' ),
					'options'       => wellexpo_select_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			wellexpo_select_create_meta_box_field(
				array(
					'name'        => 'qodef_footer_bottom_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Bottom Background Color', 'wellexpo' ),
					'description' => esc_html__( 'Set background color for bottom footer area', 'wellexpo' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'qodef_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_footer_meta', 70 );
}