<?php

if ( ! function_exists( 'wellexpo_select_get_title_types_meta_boxes' ) ) {
	function wellexpo_select_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'wellexpo_select_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'wellexpo' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'wellexpo_select_map_title_meta' ) ) {
	function wellexpo_select_map_title_meta() {
		$title_type_meta_boxes = wellexpo_select_get_title_types_meta_boxes();
		
		$title_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'wellexpo' ),
				'name'  => 'title_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'wellexpo' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'wellexpo' ),
				'parent'        => $title_meta_box,
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = wellexpo_select_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'qodef_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'qodef_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'wellexpo' ),
						'description'   => esc_html__( 'Choose title type', 'wellexpo' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'wellexpo' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'wellexpo' ),
						'options'       => wellexpo_select_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'wellexpo' ),
						'description' => esc_html__( 'Set a height for Title Area', 'wellexpo' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'wellexpo' ),
						'description' => esc_html__( 'Choose a background color for title area', 'wellexpo' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'wellexpo' ),
						'description' => esc_html__( 'Choose an Image for title area', 'wellexpo' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'wellexpo' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'wellexpo' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'wellexpo' ),
							'hide'                => esc_html__( 'Hide Image', 'wellexpo' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'wellexpo' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'wellexpo' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'wellexpo' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'wellexpo' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'wellexpo' )
						)
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'wellexpo' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'wellexpo' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'wellexpo' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'wellexpo' ),
							'window-top'    => esc_html__( 'From Window Top', 'wellexpo' )
						)
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'wellexpo' ),
						'options'       => wellexpo_select_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'wellexpo' ),
						'description' => esc_html__( 'Choose a color for title text', 'wellexpo' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'wellexpo' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'wellexpo' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'wellexpo' ),
						'options'       => wellexpo_select_get_title_tag( true, array( 'p' => 'p', 'span' => 'Custom' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'wellexpo' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'wellexpo' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'wellexpo_select_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_title_meta', 60 );
}