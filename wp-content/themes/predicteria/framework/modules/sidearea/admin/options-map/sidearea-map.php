<?php

if ( ! function_exists( 'wellexpo_select_sidearea_options_map' ) ) {
	function wellexpo_select_sidearea_options_map() {

        wellexpo_select_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'wellexpo'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = wellexpo_select_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'wellexpo'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'wellexpo'),
                'description'   => esc_html__('Choose a type of Side Area', 'wellexpo'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'wellexpo'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'wellexpo'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'wellexpo'),
                ),
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'wellexpo'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'wellexpo'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = wellexpo_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'wellexpo'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'wellexpo'),
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'wellexpo'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'wellexpo'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'wellexpo'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'wellexpo'),
                'options'       => wellexpo_select_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = wellexpo_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'wellexpo'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'wellexpo'),
                'options'       => wellexpo_select_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = wellexpo_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'wellexpo'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo'),
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'wellexpo'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'wellexpo'),
            )
        );

        $side_area_icon_style_group = wellexpo_select_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'wellexpo'),
                'description' => esc_html__('Define styles for Side Area icon', 'wellexpo')
            )
        );

        $side_area_icon_style_row1 = wellexpo_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'wellexpo')
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'wellexpo')
            )
        );

        $side_area_icon_style_row2 = wellexpo_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'wellexpo')
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'wellexpo')
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'wellexpo'),
                'description' => esc_html__('Choose a background color for Side Area', 'wellexpo')
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'wellexpo'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'wellexpo'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        wellexpo_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'wellexpo'),
                'description'   => esc_html__('Choose text alignment for side area', 'wellexpo'),
                'options'       => array(
                    ''       => esc_html__('Default', 'wellexpo'),
                    'left'   => esc_html__('Left', 'wellexpo'),
                    'center' => esc_html__('Center', 'wellexpo'),
                    'right'  => esc_html__('Right', 'wellexpo')
                )
            )
        );
    }

    add_action('wellexpo_select_action_options_map', 'wellexpo_select_sidearea_options_map', wellexpo_select_set_options_map_position( 'sidearea' ) );
}