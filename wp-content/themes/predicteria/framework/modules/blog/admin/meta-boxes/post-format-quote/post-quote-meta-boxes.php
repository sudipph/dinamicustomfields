<?php

if ( ! function_exists( 'wellexpo_select_map_post_quote_meta' ) ) {
	function wellexpo_select_map_post_quote_meta() {
		$quote_post_format_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'wellexpo' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'wellexpo' ),
				'description' => esc_html__( 'Enter Quote text', 'wellexpo' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'wellexpo' ),
				'description' => esc_html__( 'Enter Quote author', 'wellexpo' ),
				'parent'      => $quote_post_format_meta_box
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_label_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author Label', 'wellexpo' ),
				'description' => esc_html__( 'Enter Quote author label', 'wellexpo' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_quote_meta', 25 );
}