<?php

if ( ! function_exists( 'wellexpo_select_content_fixed_options_map' ) ) {
	function wellexpo_select_content_fixed_options_map() {
		
		$panel_content_fixed = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_fixed',
				'title' => esc_html__( 'Content Fixed Area Style', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'enable_content_fixed_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Fixed Area', 'wellexpo' ),
				'description'   => esc_html__( 'This option will enable Content Fixed area on pages', 'wellexpo' ),
				'parent'        => $panel_content_fixed
			)
		);
		
		$enable_content_fixed_area_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $panel_content_fixed,
				'name'            => 'enable_content_fixed_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_fixed_area' => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_fixed_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a Content Fixed title', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $enable_content_fixed_area_container
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textarea',
				'name'          => 'content_fixed_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a Content Fixed text', 'wellexpo' ),
				'parent'        => $enable_content_fixed_area_container
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_fixed_button',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Button', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will place a buttom inside Content Fixed area', 'wellexpo' ),
				'parent'        => $enable_content_fixed_area_container
			)
		);

		$enable_content_fixed_button_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $enable_content_fixed_area_container,
				'name'            => 'enable_content_fixed_button_container',
				'dependency' => array(
					'show' => array(
						'content_fixed_button' => 'yes'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_fixed_button_text',
				'default_value' => '',
				'label'         => esc_html__( 'Button Text', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a Content Fixed button text', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $enable_content_fixed_button_container
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_fixed_button_url',
				'default_value' => '',
				'label'         => esc_html__( 'Button Url', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a Content Fixed button url', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $enable_content_fixed_button_container
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'content_fixed_button_target',
				'default_value' => '',
				'label'         => esc_html__( 'Button Target', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a Content Fixed button target', 'wellexpo' ),
				'options'       => wellexpo_select_get_link_target_array(),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $enable_content_fixed_button_container
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_page_options_map', 'wellexpo_select_content_fixed_options_map' );
}