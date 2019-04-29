<?php

if ( ! function_exists( 'wellexpo_core_map_testimonials_meta' ) ) {
	function wellexpo_core_map_testimonials_meta() {
		$testimonial_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'wellexpo-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'wellexpo-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'wellexpo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'wellexpo-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'wellexpo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'wellexpo-core' ),
				'description' => esc_html__( 'Enter author name', 'wellexpo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'wellexpo-core' ),
				'description' => esc_html__( 'Enter author job position', 'wellexpo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_core_map_testimonials_meta', 95 );
}