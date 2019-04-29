<?php

if ( ! function_exists( 'wellexpo_select_map_post_audio_meta' ) ) {
	function wellexpo_select_map_post_audio_meta() {
		$audio_post_format_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'wellexpo' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose audio type', 'wellexpo' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'wellexpo' ),
					'self'            => esc_html__( 'Self Hosted', 'wellexpo' )
				)
			)
		);
		
		$qodef_audio_embedded_container = wellexpo_select_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'qodef_audio_embedded_container'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'wellexpo' ),
				'description' => esc_html__( 'Enter audio URL', 'wellexpo' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'wellexpo' ),
				'description' => esc_html__( 'Enter audio link', 'wellexpo' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_audio_meta', 23 );
}