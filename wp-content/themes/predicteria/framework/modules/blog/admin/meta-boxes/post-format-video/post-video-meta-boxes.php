<?php

if ( ! function_exists( 'wellexpo_select_map_post_video_meta' ) ) {
	function wellexpo_select_map_post_video_meta() {
		$video_post_format_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'wellexpo' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose video type', 'wellexpo' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'wellexpo' ),
					'self'            => esc_html__( 'Self Hosted', 'wellexpo' )
				)
			)
		);
		
		$qodef_video_embedded_container = wellexpo_select_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'qodef_video_embedded_container'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'wellexpo' ),
				'description' => esc_html__( 'Enter Video URL', 'wellexpo' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'wellexpo' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'wellexpo' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'wellexpo' ),
				'description' => esc_html__( 'Enter video image', 'wellexpo' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_video_meta', 22 );
}