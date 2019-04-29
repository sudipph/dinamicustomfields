<?php

if ( ! function_exists( 'wellexpo_select_logo_options_map' ) ) {
	function wellexpo_select_logo_options_map() {
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'wellexpo' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'wellexpo' )
			)
		);
		
		$hide_logo_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'wellexpo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'wellexpo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'wellexpo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'wellexpo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'wellexpo' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_logo_options_map', wellexpo_select_set_options_map_position( 'logo' ) );
}