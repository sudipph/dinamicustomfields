<?php

if ( ! function_exists( 'wellexpo_select_map_general_meta' ) ) {
	function wellexpo_select_map_general_meta() {
		
		$general_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => apply_filters( 'wellexpo_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'wellexpo' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'wellexpo' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'wellexpo' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'wellexpo' ),
				'parent'        => $general_meta_box
			)
		);
		
		$qodef_content_padding_group = wellexpo_select_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'wellexpo' ),
				'description' => esc_html__( 'Define styles for Content area', 'wellexpo' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = wellexpo_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'parent' => $qodef_content_padding_group
				)
			);
			
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'wellexpo' ),
						'parent'      => $qodef_content_padding_row
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'wellexpo' ),
						'parent'        => $qodef_content_padding_row
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'wellexpo' ),
						'options'       => wellexpo_select_get_yes_no_select_array(),
						'parent'        => $qodef_content_padding_row
					)
				);
		
			$qodef_content_padding_row_1 = wellexpo_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row_1',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'wellexpo' ),
						'parent' => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'wellexpo' ),
						'parent'  => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'wellexpo' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'wellexpo' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'wellexpo' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'wellexpo' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'wellexpo' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'wellexpo' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'wellexpo' ),
					'qodef-grid-800'  => esc_html__( '800px', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'wellexpo' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'wellexpo' ),
				'options'     => wellexpo_select_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'wellexpo' ),
				'parent'  => $general_meta_box,
				'options' => wellexpo_select_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = wellexpo_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'wellexpo' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'wellexpo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'wellexpo' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'wellexpo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'wellexpo' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'wellexpo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'wellexpo' ),
						'description'   => esc_html__( 'Choose background image attachment', 'wellexpo' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'wellexpo' ),
							'fixed'  => esc_html__( 'Fixed', 'wellexpo' ),
							'scroll' => esc_html__( 'Scroll', 'wellexpo' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'wellexpo' ),
				'parent'        => $general_meta_box,
				'options'       => wellexpo_select_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = wellexpo_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'wellexpo' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'wellexpo' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'wellexpo' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'wellexpo' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'wellexpo' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'wellexpo' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				wellexpo_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'wellexpo' ),
						'options'       => wellexpo_select_get_yes_no_select_array(),
					)
				);
		
				wellexpo_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'wellexpo' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'wellexpo' ),
						'options'       => wellexpo_select_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'wellexpo' ),
				'parent'        => $general_meta_box,
				'options'       => wellexpo_select_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = wellexpo_select_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				wellexpo_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'wellexpo' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'wellexpo' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => wellexpo_select_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = wellexpo_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'qodef_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					wellexpo_select_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'wellexpo' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = wellexpo_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'wellexpo' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'wellexpo' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = wellexpo_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					wellexpo_select_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'wellexpo' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'wellexpo' ),
								'uncover'		        => esc_html__( 'Uncover', 'wellexpo' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'wellexpo' ),
								'pulse'                 => esc_html__( 'Pulse', 'wellexpo' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'wellexpo' ),
								'cube'                  => esc_html__( 'Cube', 'wellexpo' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'wellexpo' ),
								'stripes'               => esc_html__( 'Stripes', 'wellexpo' ),
								'wave'                  => esc_html__( 'Wave', 'wellexpo' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'wellexpo' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'wellexpo' ),
								'atom'                  => esc_html__( 'Atom', 'wellexpo' ),
								'clock'                 => esc_html__( 'Clock', 'wellexpo' ),
								'mitosis'               => esc_html__( 'Mitosis', 'wellexpo' ),
								'lines'                 => esc_html__( 'Lines', 'wellexpo' ),
								'fussion'               => esc_html__( 'Fussion', 'wellexpo' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'wellexpo' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'wellexpo' )
							)
						)
					);
					
					wellexpo_select_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'wellexpo' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					wellexpo_select_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'wellexpo' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'wellexpo' ),
							'options'     => wellexpo_select_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'wellexpo' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'wellexpo' ),
				'parent'      => $general_meta_box,
				'options'     => wellexpo_select_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_general_meta', 10 );
}

if ( ! function_exists( 'wellexpo_select_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function wellexpo_select_container_background_style( $style ) {
		$page_id      = wellexpo_select_get_page_id();
		$class_prefix = wellexpo_select_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .qodef-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'qodef_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'qodef_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'qodef_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = wellexpo_select_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'wellexpo_select_filter_add_page_custom_style', 'wellexpo_select_container_background_style' );
}