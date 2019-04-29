<?php

if ( ! function_exists( 'wellexpo_select_error_404_options_map' ) ) {
	function wellexpo_select_error_404_options_map() {
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'wellexpo' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);
		
		$panel_404_header = wellexpo_select_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Choose a background color for header area', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'wellexpo' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'wellexpo' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'wellexpo' ),
					'light-header' => esc_html__( 'Light', 'wellexpo' ),
					'dark-header'  => esc_html__( 'Dark', 'wellexpo' )
				)
			)
		);
		
		$panel_404_options = wellexpo_select_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'wellexpo' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'wellexpo' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'wellexpo' )
			)
		);
		
		$first_level_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'wellexpo' )
			)
		);
		
		$first_level_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);

        $first_level_group_responsive = wellexpo_select_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'first_level_group_responsive',
                'title'       => esc_html__( 'Title Style Responsive', 'wellexpo' ),
                'description' => esc_html__( 'Define responsive styles for 404 page title (under 680px)', 'wellexpo' )
            )
        );

        $first_level_row3 = wellexpo_select_add_admin_row(
            array(
                'parent' => $first_level_group_responsive,
                'name'   => 'first_level_row3'
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'wellexpo' ),
				'description'   => esc_html__( 'Enter subtitle for 404 page. Default label is "PAGE NOT FOUND".', 'wellexpo' )
			)
		);
		
		$second_level_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Subtitle Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 404 page subtitle', 'wellexpo' )
			)
		);
		
		$second_level_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);

        $second_level_group_responsive = wellexpo_select_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'second_level_group_responsive',
                'title'       => esc_html__( 'Subtitle Style Responsive', 'wellexpo' ),
                'description' => esc_html__( 'Define responsive styles for 404 page subtitle (under 680px)', 'wellexpo' )
            )
        );

        $second_level_row3 = wellexpo_select_add_admin_row(
            array(
                'parent' => $second_level_group_responsive,
                'name'   => 'second_level_row3'
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_tagline',
				'default_value' => '',
				'label'         => esc_html__( 'Tagline', 'wellexpo' ),
				'description'   => esc_html__( 'Enter tagline for 404 page. Default label is "Oooops".', 'wellexpo' )
			)
		);

		$third_level_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'third_level_group',
				'title'       => esc_html__( 'Tagline Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for 404 page tagline', 'wellexpo' )
			)
		);

		$third_level_row1 = wellexpo_select_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row1'
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_tagline_color',
				'label'  => esc_html__( 'Text Color', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_tagline_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_tagline_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_tagline_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row2',
				'next'   => true
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array()
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array()
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_tagline_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);

        $third_level_group_responsive = wellexpo_select_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'third_level_group_responsive',
                'title'       => esc_html__( 'Tagline Style Responsive', 'wellexpo' ),
                'description' => esc_html__( 'Define responsive styles for 404 page tagline (under 680px)', 'wellexpo' )
            )
        );

        $third_level_row3 = wellexpo_select_add_admin_row(
            array(
                'parent' => $third_level_group_responsive,
                'name'   => 'third_level_row3'
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_error_404_options_map', wellexpo_select_set_options_map_position( '404' ) );
}