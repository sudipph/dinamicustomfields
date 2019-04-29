<?php

if ( ! function_exists( 'wellexpo_select_footer_options_map' ) ) {
	function wellexpo_select_footer_options_map() {

		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'wellexpo' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = wellexpo_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'wellexpo' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'wellexpo' ),
				'parent'        => $footer_panel
			)
		);

        wellexpo_select_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'wellexpo' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'wellexpo' ),
                'parent'        => $footer_panel,
            )
        );

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'wellexpo' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = wellexpo_select_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'wellexpo' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'wellexpo' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'wellexpo' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'wellexpo' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'wellexpo' ),
					'left'   => esc_html__( 'Left', 'wellexpo' ),
					'center' => esc_html__( 'Center', 'wellexpo' ),
					'right'  => esc_html__( 'Right', 'wellexpo' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Set background color for top footer area', 'wellexpo' ),
				'parent'      => $show_footer_top_container
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'wellexpo' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'wellexpo' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'wellexpo' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		wellexpo_select_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'wellexpo' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_footer_options_map', wellexpo_select_set_options_map_position( 'footer' ) );
}