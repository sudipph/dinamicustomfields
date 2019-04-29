<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = SELECT_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'wellexpo_select_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function wellexpo_select_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'wellexpo_select_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'wellexpo_select_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function wellexpo_select_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'wellexpo' ),
				'value'      => array(
					esc_html__( 'Full Width', 'wellexpo' ) => 'full-width',
					esc_html__( 'In Grid', 'wellexpo' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'wellexpo' ),
				'description' => esc_html__( 'For example "home"', 'wellexpo' ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'wellexpo' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'background_image_fixed_position',
				'heading'     => esc_html__( 'Enable Background Image Fixed Scroll Position', 'wellexpo' ),
				'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
				'save_always' => true,
				'description' => esc_html__( 'Enable this option to set background image as scroll fixed, relative to visible screen', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'wellexpo' ),
				'value'       => array(
					esc_html__( 'Never', 'wellexpo' )        => '',
					esc_html__( 'Below 1280px', 'wellexpo' ) => '1280',
					esc_html__( 'Below 1024px', 'wellexpo' ) => '1024',
					esc_html__( 'Below 768px', 'wellexpo' )  => '768',
					esc_html__( 'Below 680px', 'wellexpo' )  => '680',
					esc_html__( 'Below 480px', 'wellexpo' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'wellexpo' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'wellexpo' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'wellexpo' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row',
			array(	
				'type' => 'textfield',
				'param_name' => 'bg_text',
				'heading' => esc_html__('Background Text', 'wellexpo'),
				'admin_label' => true,
				'group' => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_text_alignment',
				'heading'     => esc_html__( 'Background Text Alignment', 'wellexpo' ),
				'value'       => array(
					esc_html__( 'Left Aligned', 'wellexpo' )  => 'qodef-left-aligned',
					esc_html__( 'Right Aligned', 'wellexpo' )  => 'qodef-right-aligned'
				),
				'dependency'  => array( 'element' => 'bg_text', 'not_empty' => true ),
				'save_always' => true,
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
			
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'wellexpo' ),
				'value'      => array(
					esc_html__( 'Default', 'wellexpo' ) => '',
					esc_html__( 'Left', 'wellexpo' )    => 'left',
					esc_html__( 'Center', 'wellexpo' )  => 'center',
					esc_html__( 'Right', 'wellexpo' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'wellexpo' ),
				'value'      => array(
					esc_html__( 'Full Width', 'wellexpo' ) => 'full-width',
					esc_html__( 'In Grid', 'wellexpo' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'wellexpo' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'background_image_fixed_position_inner',
				'heading'     => esc_html__( 'Enable Background Image Fixed Scroll Position', 'wellexpo' ),
				'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
				'save_always' => true,
				'description' => esc_html__( 'Enable this option to set background image as scroll fixed, relative to visible screen', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'wellexpo' ),
				'value'       => array(
					esc_html__( 'Never', 'wellexpo' )        => '',
					esc_html__( 'Below 1280px', 'wellexpo' ) => '1280',
					esc_html__( 'Below 1024px', 'wellexpo' ) => '1024',
					esc_html__( 'Below 768px', 'wellexpo' )  => '768',
					esc_html__( 'Below 680px', 'wellexpo' )  => '680',
					esc_html__( 'Below 480px', 'wellexpo' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'wellexpo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image_inner',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'wellexpo' ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed_inner',
				'heading'     => esc_html__( 'Select Parallax Speed', 'wellexpo' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'wellexpo' ),
				'dependency'  => array( 'element' => 'parallax_background_image_inner', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height_inner',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'wellexpo' ),
				'dependency' => array( 'element' => 'parallax_background_image_inner', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'wellexpo' ),
				'value'      => array(
					esc_html__( 'Default', 'wellexpo' ) => '',
					esc_html__( 'Left', 'wellexpo' )    => 'left',
					esc_html__( 'Center', 'wellexpo' )  => 'center',
					esc_html__( 'Right', 'wellexpo' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'wellexpo' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( wellexpo_select_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'wellexpo' ),
					'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'wellexpo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'wellexpo' ),
					'value'       => array(
						esc_html__( 'Tiny', 'wellexpo' )   => 'tiny',
						esc_html__( 'Small', 'wellexpo' )  => 'small',
						esc_html__( 'Normal', 'wellexpo' ) => 'normal',
						esc_html__( 'Large', 'wellexpo' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'wellexpo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'wellexpo' ),
					'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'wellexpo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'wellexpo' ),
					'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'wellexpo' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'wellexpo_select_vc_row_map' );
}