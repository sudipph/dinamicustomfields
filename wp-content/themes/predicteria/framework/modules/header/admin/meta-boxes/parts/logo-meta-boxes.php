<?php

if ( ! function_exists( 'wellexpo_select_logo_meta_box_map' ) ) {
	function wellexpo_select_logo_meta_box_map() {
		
		$logo_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'wellexpo' ),
				'name'  => 'logo_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'wellexpo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'wellexpo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'wellexpo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'wellexpo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'wellexpo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'wellexpo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'wellexpo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'wellexpo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'wellexpo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'wellexpo' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_logo_meta_box_map', 47 );
}