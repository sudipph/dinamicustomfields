<?php

if ( ! function_exists( 'wellexpo_select_get_hide_dep_for_full_screen_menu_options' ) ) {
	function wellexpo_select_get_hide_dep_for_full_screen_menu_options() {
		$hide_dep_options = apply_filters( 'wellexpo_select_filter_full_screen_menu_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wellexpo_select_fullscreen_menu_options_map' ) ) {
	function wellexpo_select_fullscreen_menu_options_map() {
		$hide_dep_options = wellexpo_select_get_hide_dep_for_full_screen_menu_options();
		
		$fullscreen_panel = wellexpo_select_add_admin_panel(
			array(
				'title'           => esc_html__( 'Full Screen Menu', 'wellexpo' ),
				'name'            => 'panel_fullscreen_menu',
				'page'            => '_header_page',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label'         => esc_html__( 'Full Screen Menu Overlay Animation', 'wellexpo' ),
				'description'   => esc_html__( 'Choose animation type for full screen menu overlay', 'wellexpo' ),
				'options'       => array(
					'fade-push-text-right' => esc_html__( 'Fade Push Text Right', 'wellexpo' ),
					'fade-push-text-top'   => esc_html__( 'Fade Push Text Top', 'wellexpo' ),
					'fade-text-scaledown'  => esc_html__( 'Fade Text Scaledown', 'wellexpo' )
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'text',
				'name'          => 'fullscreen_menu_tagline',
				'default_value' => '',
				'label'         => esc_html__( 'Tagline', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'text',
				'name'          => 'fullscreen_menu_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'yesno',
				'name'          => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Full Screen Menu in Grid', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will put full screen menu content in grid', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'selectblank',
				'name'          => 'fullscreen_alignment',
				'default_value' => '',
				'label'         => esc_html__( 'Full Screen Menu Alignment', 'wellexpo' ),
				'description'   => esc_html__( 'Choose alignment for full screen menu content', 'wellexpo' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'wellexpo' ),
					'left'   => esc_html__( 'Left', 'wellexpo' ),
					'center' => esc_html__( 'Center', 'wellexpo' ),
					'right'  => esc_html__( 'Right', 'wellexpo' )
				)
			)
		);
		
		$background_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'background_group',
				'title'       => esc_html__( 'Background', 'wellexpo' ),
				'description' => esc_html__( 'Select a background color and transparency for full screen menu (0 = fully transparent, 1 = opaque)', 'wellexpo' )
			)
		);
		
		$background_group_row = wellexpo_select_add_admin_row(
			array(
				'parent' => $background_group,
				'name'   => 'background_group_row'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_background_color',
				'label'  => esc_html__( 'Background Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type'   => 'textsimple',
				'name'   => 'fullscreen_menu_background_transparency',
				'label'  => esc_html__( 'Background Transparency', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $fullscreen_panel,
				'type'        => 'image',
				'name'        => 'fullscreen_menu_background_image',
				'label'       => esc_html__( 'Background Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a background image for full screen menu background', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $fullscreen_panel,
				'type'        => 'image',
				'name'        => 'fullscreen_menu_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a pattern image for full screen menu background', 'wellexpo' )
			)
		);
		
		//1st level style group
		$first_level_style_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'first_level_style_group',
				'title'       => esc_html__( '1st Level Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 1st level in full screen menu', 'wellexpo' )
			)
		);
		
		$first_level_style_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label'         => esc_html__( 'Hover Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label'         => esc_html__( 'Active Text Color', 'wellexpo' ),
			)
		);
		
		$first_level_style_row3 = wellexpo_select_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row3'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_style_row4 = wellexpo_select_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name'   => 'first_level_style_row4'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_style_row4,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);
		
		//2nd level style group
		$second_level_style_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'second_level_style_group',
				'title'       => esc_html__( '2nd Level Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 2nd level in full screen menu', 'wellexpo' )
			)
		);
		
		$second_level_style_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Text Color', 'wellexpo' ),
			)
		);
		
		$second_level_style_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row2'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_style_row3 = wellexpo_select_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name'   => 'second_level_style_row3'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);
		
		$third_level_style_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'third_level_style_group',
				'title'       => esc_html__( '3rd Level Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 3rd level in full screen menu', 'wellexpo' )
			)
		);
		
		$third_level_style_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'third_level_style_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Text Color', 'wellexpo' ),
			)
		);
		
		$third_level_style_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'second_level_style_row2'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'fontsimple',
				'name'          => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row2,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$third_level_style_row3 = wellexpo_select_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name'   => 'second_level_style_row3'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'textsimple',
				'name'          => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Lettert Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_style_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Full Screen Menu Icon Source', 'wellexpo' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'wellexpo' ),
				'options'       => wellexpo_select_get_icon_sources_array()
			)
		);

		$fullscreen_menu_icon_pack_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $fullscreen_panel,
				'name'            => 'fullscreen_menu_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'fullscreen_menu_icon_source' => 'icon_pack'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $fullscreen_menu_icon_pack_container,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Full Screen Menu Icon Pack', 'wellexpo' ),
				'description'   => esc_html__( 'Choose icon pack for full screen menu icon', 'wellexpo' ),
				'options'       => wellexpo_select_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$fullscreen_menu_icon_svg_path_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $fullscreen_panel,
				'name'            => 'fullscreen_menu_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'fullscreen_menu_icon_source' => 'svg_path'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'      => $fullscreen_menu_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'fullscreen_menu_icon_svg_path',
				'label'       => esc_html__( 'Full Screen Menu Icon SVG Path', 'wellexpo' ),
				'description' => esc_html__( 'Enter your full screen menu icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'      => $fullscreen_menu_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'fullscreen_menu_close_icon_svg_path',
				'label'       => esc_html__( 'Full Screen Menu Close Icon SVG Path', 'wellexpo' ),
				'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo' ),
			)
		);

		$icon_style_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $fullscreen_panel,
				'name'        => 'fullscreen_menu_icon_style_group',
				'title'       => esc_html__( 'Full Screen Menu Icon Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for full screen menu icon', 'wellexpo' )
			)
		);
		
		$icon_colors_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $icon_style_group,
				'name'   => 'icon_colors_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_color',
				'label'  => esc_html__( 'Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_color',
				'label'  => esc_html__( 'Mobile Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_hover_color',
				'label'  => esc_html__( 'Mobile Hover Color', 'wellexpo' ),
			)
		);
	}
	
	add_action( 'wellexpo_select_action_additional_header_menu_area_options_map', 'wellexpo_select_fullscreen_menu_options_map' );
}