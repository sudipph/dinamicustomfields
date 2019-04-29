<?php

if ( ! function_exists( 'wellexpo_select_get_search_types_options' ) ) {
    function wellexpo_select_get_search_types_options() {
        $search_type_options = apply_filters( 'wellexpo_select_filter_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'wellexpo_select_search_options_map' ) ) {
	function wellexpo_select_search_options_map() {
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'wellexpo' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = wellexpo_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'wellexpo' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'wellexpo' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'wellexpo' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'wellexpo' ),
					'full-width' => esc_html__( 'Full Width', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'wellexpo' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'wellexpo' ),
				'default_value' => 'no-sidebar',
				'options'       => wellexpo_select_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$wellexpo_custom_sidebars = wellexpo_select_get_custom_sidebars();
		if ( count( $wellexpo_custom_sidebars ) > 0 ) {
			wellexpo_select_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'wellexpo' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'wellexpo' ),
					'parent'      => $search_page_panel,
					'options'     => $wellexpo_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = wellexpo_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'wellexpo' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'wellexpo' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'wellexpo' ),
				'options'       => wellexpo_select_get_search_types_options()
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Search Icon Source', 'wellexpo' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'wellexpo' ),
				'options'       => wellexpo_select_get_icon_sources_array( false, false )
			)
		);

		$search_icon_pack_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_icon_pack_container,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'wellexpo' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'wellexpo' ),
				'options'       => wellexpo_select_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$search_svg_path_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'svg_path'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_icon_svg_path',
				'label'       => esc_html__( 'Search Icon SVG Path', 'wellexpo' ),
				'description' => esc_html__( 'Enter your search icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo' ),
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_close_icon_svg_path',
				'label'       => esc_html__( 'Search Close Icon SVG Path', 'wellexpo' ),
				'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo' ),
			)
		);

        wellexpo_select_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'wellexpo' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'wellexpo' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_sidebar_columns_dependency', $dependency_array = array())
					)
				)
            )
        );
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'wellexpo' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'wellexpo' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_in_grid_dependency', $dependency_array = array())
					)
				)
			)
		);
		
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'wellexpo' )
			)
		);

		$search_icon_pack_icon_styles_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_icon_styles_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_icon_pack_icon_styles_container,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'wellexpo' ),
				'description'   => esc_html__( 'Set size for icon', 'wellexpo' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'wellexpo' ),
				'description' => esc_html__( 'Define color style for icon', 'wellexpo' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = wellexpo_select_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'wellexpo' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'wellexpo' )
			)
		);
		
		$enable_search_icon_text_container = wellexpo_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = wellexpo_select_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'wellexpo' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'wellexpo' )
			)
		);
		
		$enable_search_icon_text_row = wellexpo_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'wellexpo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'wellexpo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = wellexpo_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'wellexpo' ),
				'default_value' => '',
				'options'       => wellexpo_select_get_text_transform_array()
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'wellexpo' ),
				'default_value' => '-1',
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'wellexpo' ),
				'default_value' => '',
				'options'       => wellexpo_select_get_font_style_array(),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'wellexpo' ),
				'default_value' => '',
				'options'       => wellexpo_select_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = wellexpo_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'wellexpo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_search_options_map', wellexpo_select_set_options_map_position( 'search' ) );
}