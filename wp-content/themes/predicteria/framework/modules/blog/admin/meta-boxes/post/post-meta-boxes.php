<?php

/*** Post Settings ***/

if ( ! function_exists( 'wellexpo_select_map_post_meta' ) ) {
	function wellexpo_select_map_post_meta() {
		
		$post_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'wellexpo' ),
				'name'  => 'post-meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'wellexpo' ),
				'parent'        => $post_meta_box,
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'wellexpo' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => wellexpo_select_get_custom_sidebars_options( true )
			)
		);
		
		$wellexpo_custom_sidebars = wellexpo_select_get_custom_sidebars();
		if ( count( $wellexpo_custom_sidebars ) > 0 ) {
			wellexpo_select_create_meta_box_field( array(
				'name'        => 'qodef_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'wellexpo' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'wellexpo' ),
				'parent'      => $post_meta_box,
				'options'     => wellexpo_select_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'wellexpo' ),
				'parent'      => $post_meta_box
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_shortcode_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Shortcode Background Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a Background Image for displaying in blog list shortcode (Standard type).', 'wellexpo' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('wellexpo_select_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_post_meta', 20 );
}
