<?php

if ( ! function_exists( 'wellexpo_select_fonts_options_map' ) ) {
	/**
	 * Font options page
	 */
	function wellexpo_select_fonts_options_map() {
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_fonts_page',
				'title' => esc_html__( 'Fonts', 'wellexpo' ),
				'icon'  => 'fa fa-font'
			)
		);
		
		/**
		 * Headings
		 */
		$panel_headings = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_fonts_page',
				'name'  => 'panel_headings',
				'title' => esc_html__( 'Headings', 'wellexpo' )
			)
		);
		
		//H1
		$group_heading_h1 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h1',
				'title'       => esc_html__( 'H1 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h1 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h1_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h1_1',
				'parent' => $group_heading_h1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h1_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h1_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h1_1
			)
		);
		
		$row_heading_h1_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h1_2',
				'parent' => $group_heading_h1,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h1_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h1_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h1_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h1_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h1_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h1_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h1_2
			)
		);
		
		$row_heading_h1_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h1_3',
				'parent' => $group_heading_h1,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h1_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h1_3
			)
		);
		
		//H2
		$group_heading_h2 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h2',
				'title'       => esc_html__( 'H2 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h2 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h2_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h2_1',
				'parent' => $group_heading_h2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h2_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h2_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h2_1
			)
		);
		
		$row_heading_h2_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h2_2',
				'parent' => $group_heading_h2,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h2_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h2_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h2_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h2_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h2_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h2_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h2_2
			)
		);
		
		$row_heading_h2_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h2_3',
				'parent' => $group_heading_h2,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h2_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h2_3
			)
		);
		
		//H3
		$group_heading_h3 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h3',
				'title'       => esc_html__( 'H3 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h3 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h3_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h3_1',
				'parent' => $group_heading_h3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h3_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h3_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h3_1
			)
		);
		
		$row_heading_h3_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h3_2',
				'parent' => $group_heading_h3,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h3_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h3_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h3_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h3_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h3_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h3_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h3_2
			)
		);
		
		$row_heading_h3_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h3_3',
				'parent' => $group_heading_h3,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h3_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h3_3
			)
		);
		
		//H4
		$group_heading_h4 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h4',
				'title'       => esc_html__( 'H4 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h4 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h4_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h4_1',
				'parent' => $group_heading_h4
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h4_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h4_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h4_1
			)
		);
		
		$row_heading_h4_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h4_2',
				'parent' => $group_heading_h4,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h4_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h4_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h4_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h4_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h4_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h4_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h4_2
			)
		);
		
		$row_heading_h4_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h4_3',
				'parent' => $group_heading_h4,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h4_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h4_3
			)
		);
		
		//H5
		$group_heading_h5 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h5',
				'title'       => esc_html__( 'H5 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h5 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h5_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h5_1',
				'parent' => $group_heading_h5
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h5_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h5_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h5_1
			)
		);
		
		$row_heading_h5_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h5_2',
				'parent' => $group_heading_h5,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h5_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h5_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h5_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h5_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h5_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h5_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h5_2
			)
		);
		
		$row_heading_h5_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h5_3',
				'parent' => $group_heading_h5,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h5_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h5_3
			)
		);
		
		//H6
		$group_heading_h6 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_heading_h6',
				'title'       => esc_html__( 'H6 Style', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for h6 heading', 'wellexpo' ),
				'parent'      => $panel_headings
			)
		);
		
		$row_heading_h6_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h6_1',
				'parent' => $group_heading_h6
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'h6_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h6_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_heading_h6_1
			)
		);
		
		$row_heading_h6_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h6_2',
				'parent' => $group_heading_h6,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'h6_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_heading_h6_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h6_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_heading_h6_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'h6_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_heading_h6_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_heading_h6_2
			)
		);
		
		$row_heading_h6_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_heading_h6_3',
				'parent' => $group_heading_h6,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_heading_h6_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_heading_h6_3
			)
		);
		
		/**
		 * Headings Responsive (Tablet Landscape View)
		 */
		$panel_responsive_headings3 = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_fonts_page',
				'name'  => 'panel_responsive_headings3',
				'title' => esc_html__( 'Headings Responsive (Tablet Landscape View)', 'wellexpo' )
			)
		);
		
		//H1
		$group_responsive3_heading_h1 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h1',
				'title'       => esc_html__( 'H1 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h1 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h1_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h1_3',
				'parent' => $group_responsive3_heading_h1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_3
			)
		);
		
		//H2
		$group_responsive3_heading_h2 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h2',
				'title'       => esc_html__( 'H2 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h2 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h2_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h2_3',
				'parent' => $group_responsive3_heading_h2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_3
			)
		);
		
		//H3
		$group_responsive3_heading_h3 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h3',
				'title'       => esc_html__( 'H3 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h3 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h3_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h3_3',
				'parent' => $group_responsive3_heading_h3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_3
			)
		);
		
		//H4
		$group_responsive3_heading_h4 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h4',
				'title'       => esc_html__( 'H4 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h4 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h4_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h4_3',
				'parent' => $group_responsive3_heading_h4
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_3
			)
		);
		
		//H5
		$group_responsive3_heading_h5 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h5',
				'title'       => esc_html__( 'H5 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h5 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h5_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h5_3',
				'parent' => $group_responsive3_heading_h5
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_3
			)
		);
		
		//H6
		$group_responsive3_heading_h6 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive3_heading_h6',
				'title'       => esc_html__( 'H6 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h6 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings3
			)
		);
		
		$row_responsive_heading_h6_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h6_3',
				'parent' => $group_responsive3_heading_h6
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_font_size_3',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_line_height_3',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_letter_spacing_3',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_3
			)
		);
		
		/**
		 * Headings Responsive (Tablet Portrait View)
		 */
		$panel_responsive_headings = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_fonts_page',
				'name'  => 'panel_responsive_headings',
				'title' => esc_html__( 'Headings Responsive (Tablet Portrait View)', 'wellexpo' )
			)
		);
		
		//H1
		$group_responsive_heading_h1 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h1',
				'title'       => esc_html__( 'H1 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h1 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h1_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h1_1',
				'parent' => $group_responsive_heading_h1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h1_1
			)
		);
		
		//H2
		$group_responsive_heading_h2 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h2',
				'title'       => esc_html__( 'H2 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h2 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h2_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h2_1',
				'parent' => $group_responsive_heading_h2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h2_1
			)
		);
		
		//H3
		$group_responsive_heading_h3 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h3',
				'title'       => esc_html__( 'H3 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h3 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h3_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h3_1',
				'parent' => $group_responsive_heading_h3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h3_1
			)
		);
		
		//H4
		$group_responsive_heading_h4 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h4',
				'title'       => esc_html__( 'H4 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h4 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h4_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h4_1',
				'parent' => $group_responsive_heading_h4
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h4_1
			)
		);
		
		//H5
		$group_responsive_heading_h5 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h5',
				'title'       => esc_html__( 'H5 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h5 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h5_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h5_1',
				'parent' => $group_responsive_heading_h5
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h5_1
			)
		);
		
		//H6
		$group_responsive_heading_h6 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive_heading_h6',
				'title'       => esc_html__( 'H6 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h6 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings
			)
		);
		
		$row_responsive_heading_h6_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive_heading_h6_1',
				'parent' => $group_responsive_heading_h6
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive_heading_h6_1
			)
		);
		
		/**
		 * Headings Responsive (Mobile Devices)
		 */
		$panel_responsive_headings2 = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_fonts_page',
				'name'  => 'panel_responsive_headings2',
				'title' => esc_html__( 'Headings Responsive (Mobile Devices)', 'wellexpo' )
			)
		);
		
		//H1
		$group_responsive2_heading_h1 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h1',
				'title'       => esc_html__( 'H1 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h1 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h1_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h1_1',
				'parent' => $group_responsive2_heading_h1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h1_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h1_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h1_1
			)
		);
		
		//H2
		$group_responsive2_heading_h2 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h2',
				'title'       => esc_html__( 'H2 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h2 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h2_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h2_1',
				'parent' => $group_responsive2_heading_h2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h2_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h2_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h2_1
			)
		);
		
		//H3
		$group_responsive2_heading_h3 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h3',
				'title'       => esc_html__( 'H3 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h3 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h3_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h3_1',
				'parent' => $group_responsive2_heading_h3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h3_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h3_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h3_1
			)
		);
		
		//H4
		$group_responsive2_heading_h4 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h4',
				'title'       => esc_html__( 'H4 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h4 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h4_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h4_1',
				'parent' => $group_responsive2_heading_h4
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h4_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h4_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h4_1
			)
		);
		
		//H5
		$group_responsive2_heading_h5 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h5',
				'title'       => esc_html__( 'H5 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h5 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h5_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h5_1',
				'parent' => $group_responsive2_heading_h5
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h5_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h5_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h5_1
			)
		);
		
		//H6
		$group_responsive2_heading_h6 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_responsive2_heading_h6',
				'title'       => esc_html__( 'H6 Responsive Style', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for h6 heading', 'wellexpo' ),
				'parent'      => $panel_responsive_headings2
			)
		);
		
		$row_responsive2_heading_h6_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_responsive2_heading_h6_1',
				'parent' => $group_responsive2_heading_h6
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_font_size_2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_line_height_2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h6_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'h6_responsive_letter_spacing_2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_responsive2_heading_h6_1
			)
		);
		
		/**
		 * Text
		 */
		$panel_text = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_fonts_page',
				'name'  => 'panel_text',
				'title' => esc_html__( 'Text', 'wellexpo' )
			)
		);
		
		$group_text = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_text',
				'title'       => esc_html__( 'Paragraph', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for paragraph text', 'wellexpo' ),
				'parent'      => $panel_text
			)
		);
		
		$row_text_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_text_1',
				'parent' => $group_text
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'text_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'wellexpo' ),
				'parent'        => $row_text_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_text_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_text_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_transform_array(),
				'parent'        => $row_text_1
			)
		);
		
		$row_text_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_text_2',
				'parent' => $group_text,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'parent'        => $row_text_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_text_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_text_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_text_2
			)
		);
		
		$row_text_3 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_text_3',
				'parent' => $group_text,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_margin_top',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Top (px)', 'wellexpo' ),
				'parent'        => $row_text_3
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_margin_bottom',
				'default_value' => '',
				'label'         => esc_html__( 'Margin Bottom (px)', 'wellexpo' ),
				'parent'        => $row_text_3
			)
		);
		
		$group_text_res1 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_text_res1',
				'title'       => esc_html__( 'Paragraph Responsive (Tablet Portrait View)', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for paragraph text for tablet devices - portrait view', 'wellexpo' ),
				'parent'      => $panel_text
			)
		);
		
		$row_res_text_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_text_1',
				'parent' => $group_text_res1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_font_size_res1',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_line_height_res1',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_letter_spacing_res1',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_1
			)
		);
		
		$group_text_res2 = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_text_res2',
				'title'       => esc_html__( 'Paragraph Responsive (Mobile Devices)', 'wellexpo' ),
				'description' => esc_html__( 'Define responsive styles for paragraph text for mobile devices', 'wellexpo' ),
				'parent'      => $panel_text
			)
		);
		
		$row_res_text_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_res_text_2',
				'parent' => $group_text_res2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_font_size_res2',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_line_height_res2',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'text_letter_spacing_res2',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'args'          => array(
					'suffix' => esc_html__( 'px / em', 'wellexpo' )
				),
				'parent'        => $row_res_text_2
			)
		);
		
		$group_link = wellexpo_select_add_admin_group(
			array(
				'name'        => 'group_link',
				'title'       => esc_html__( 'Links', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for link text', 'wellexpo' ),
				'parent'      => $panel_text
			)
		);
		
		$row_link_1 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_link_1',
				'parent' => $group_link
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'link_color',
				'default_value' => '',
				'label'         => esc_html__( 'Link Color', 'wellexpo' ),
				'parent'        => $row_link_1
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'link_hovercolor',
				'default_value' => '',
				'label'         => esc_html__( 'Hover Link Color', 'wellexpo' ),
				'parent'        => $row_link_1
			)
		);
		
		$row_link_2 = wellexpo_select_add_admin_row(
			array(
				'name'   => 'row_link_2',
				'parent' => $group_link,
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'link_fontstyle',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_style_array(),
				'parent'        => $row_link_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'link_fontweight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'options'       => wellexpo_select_get_font_weight_array(),
				'parent'        => $row_link_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'link_fontdecoration',
				'default_value' => '',
				'label'         => esc_html__( 'Link Decoration', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_decorations(),
				'parent'        => $row_link_2
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'link_hover_fontdecoration',
				'default_value' => '',
				'label'         => esc_html__( 'Hovel Link Decoration', 'wellexpo' ),
				'options'       => wellexpo_select_get_text_decorations(),
				'parent'        => $row_link_2
			)
		);
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_fonts_options_map', wellexpo_select_set_options_map_position( 'fonts' ) );
}