<?php

if ( ! function_exists( 'wellexpo_select_map_post_link_meta' ) ) {
	function wellexpo_select_map_post_link_meta() {
		$link_post_format_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'wellexpo' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'wellexpo' ),
				'description' => esc_html__( 'Enter link', 'wellexpo' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_link_meta', 24 );
}