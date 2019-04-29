<?php

if ( ! function_exists( 'wellexpo_select_map_post_gallery_meta' ) ) {
	
	function wellexpo_select_map_post_gallery_meta() {
		$gallery_post_format_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'wellexpo' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		wellexpo_select_add_multiple_images_field(
			array(
				'name'        => 'qodef_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'wellexpo' ),
				'description' => esc_html__( 'Choose your gallery images', 'wellexpo' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_gallery_meta', 21 );
}
