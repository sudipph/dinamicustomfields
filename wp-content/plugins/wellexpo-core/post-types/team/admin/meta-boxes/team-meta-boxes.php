<?php

if ( ! function_exists( 'wellexpo_core_map_team_single_meta' ) ) {
	function wellexpo_core_map_team_single_meta() {
		
		$meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => 'team-member',
				'title' => esc_html__( 'Team Member Info', 'wellexpo-core' ),
				'name'  => 'team_meta'
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_skin',
				'type'        => 'select',
				'label'       => esc_html__( 'Skin', 'wellexpo-core' ),
				'description' => esc_html__( 'Choose a skin for the Team Member\'s single page', 'wellexpo-core' ),
				'parent'      => $meta_box,
				'options'     => array(
					''     => esc_html__( 'Default', 'wellexpo-core' ),
					'dark' => esc_html__( 'Dark', 'wellexpo-core' )
				)
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Position', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s role within the team', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_birth_date',
				'type'        => 'date',
				'label'       => esc_html__( 'Birth date', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s birth date', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s email', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_twitter',
				'type'        => 'text',
				'label'       => esc_html__( 'Twitter', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s twitter', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_website',
				'type'        => 'text',
				'label'       => esc_html__( 'Website', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s website', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Phone', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s phone', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Address', 'wellexpo-core' ),
				'description' => esc_html__( 'The member\'s addres', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_interview',
				'type'        => 'text',
				'label'       => esc_html__( 'Interview', 'wellexpo-core' ),
				'description' => esc_html__( 'Enter member\'s interview link', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_team_member_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'wellexpo-core' ),
				'description' => esc_html__( 'Upload member\'s resume', 'wellexpo-core' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			
			$social_icon_group = wellexpo_select_add_admin_group(
				array(
					'name'   => 'qodef_team_member_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'wellexpo-core' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = wellexpo_select_add_admin_row(
				array(
					'name'   => 'qodef_team_member_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			wellexpo_select_icon_collections()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'wellexpo-core' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'qodef_team_member_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = wellexpo_select_add_admin_row(
				array(
					'name'   => 'qodef_team_member_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			wellexpo_select_create_meta_box_field(
				array(
					'type'            => 'textsimple',
					'label'           => esc_html__( 'Link', 'wellexpo-core' ),
					'name'            => 'qodef_team_member_social_icon_' . $x . '_link',
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'qodef_team_member_social_icon_pack_'. $x  => ''
						)
					)
				)
			);
			
			wellexpo_select_create_meta_box_field(
				array(
					'type'            => 'selectsimple',
					'label'           => esc_html__( 'Target', 'wellexpo-core' ),
					'name'            => 'qodef_team_member_social_icon_' . $x . '_target',
					'options'         => wellexpo_select_get_link_target_array(),
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'qodef_team_member_social_icon_' . $x . '_link'  => ''
						)
					)
				)
			);
		}
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_core_map_team_single_meta', 46 );
}