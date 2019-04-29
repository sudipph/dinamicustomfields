<?php

if ( ! function_exists( 'wellexpo_core_map_masonry_gallery_meta' ) ) {
	function wellexpo_core_map_masonry_gallery_meta() {
		
		$masonry_gallery_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'masonry-gallery' ),
				'title' => esc_html__( 'Masonry Gallery General', 'wellexpo-core' ),
				'name'  => 'masonry_gallery_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_masonry_gallery_item_title_tag',
				'type'          => 'select',
				'default_value' => 'h4',
				'label'         => esc_html__( 'Title Tag', 'wellexpo-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => wellexpo_select_get_title_tag()
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'   => 'qodef_masonry_gallery_item_text',
				'type'   => 'text',
				'label'  => esc_html__( 'Text', 'wellexpo-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'   => 'qodef_masonry_gallery_item_image',
				'type'   => 'image',
				'label'  => esc_html__( 'Custom Item Icon', 'wellexpo-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'   => 'qodef_masonry_gallery_item_link',
				'type'   => 'text',
				'label'  => esc_html__( 'Link', 'wellexpo-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_masonry_gallery_item_link_target',
				'type'          => 'select',
				'default_value' => '_self',
				'label'         => esc_html__( 'Link Target', 'wellexpo-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => wellexpo_select_get_link_target_array()
			)
		);
		
		wellexpo_select_add_admin_section_title( array(
			'name'   => 'qodef_section_style_title',
			'parent' => $masonry_gallery_meta_box,
			'title'  => esc_html__( 'Masonry Gallery Item Style', 'wellexpo-core' )
		) );
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_masonry_gallery_item_size',
				'type'          => 'select',
				'default_value' => 'small',
				'label'         => esc_html__( 'Size', 'wellexpo-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'wellexpo-core' ),
					'large-width'        => esc_html__( 'Large Width', 'wellexpo-core' ),
					'large-height'       => esc_html__( 'Large Height', 'wellexpo-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'wellexpo-core' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_masonry_gallery_item_type',
				'type'          => 'select',
				'default_value' => 'standard',
				'label'         => esc_html__( 'Type', 'wellexpo-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'standard'    => esc_html__( 'Standard', 'wellexpo-core' ),
					'with-button' => esc_html__( 'With Button', 'wellexpo-core' ),
					'simple'      => esc_html__( 'Simple', 'wellexpo-core' )
				)
			)
		);
		
		$masonry_gallery_item_button_type_container = wellexpo_select_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_button_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_masonry_gallery_item_type'  => array( 'standard', 'simple' )
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'   => 'qodef_masonry_gallery_button_label',
				'type'   => 'text',
				'label'  => esc_html__( 'Button Label', 'wellexpo-core' ),
				'parent' => $masonry_gallery_item_button_type_container
			)
		);
		
		$masonry_gallery_item_simple_type_container = wellexpo_select_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_simple_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_masonry_gallery_item_type'  => array( 'standard', 'with-button' )
					)
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_masonry_gallery_simple_content_background_skin',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Skin', 'wellexpo-core' ),
				'parent'        => $masonry_gallery_item_simple_type_container,
				'options'       => array(
					'default' => esc_html__( 'Default', 'wellexpo-core' ),
					'light'   => esc_html__( 'Light', 'wellexpo-core' ),
					'dark'    => esc_html__( 'Dark', 'wellexpo-core' )
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_core_map_masonry_gallery_meta', 45 );
}