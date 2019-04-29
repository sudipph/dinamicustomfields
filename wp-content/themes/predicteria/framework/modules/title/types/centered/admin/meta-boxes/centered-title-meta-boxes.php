<?php

if ( ! function_exists( 'wellexpo_select_centered_title_type_options_meta_boxes' ) ) {
	function wellexpo_select_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'wellexpo' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'wellexpo' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_title_area_meta_boxes', 'wellexpo_select_centered_title_type_options_meta_boxes', 5 );
}