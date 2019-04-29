<?php

if ( ! function_exists( 'wellexpo_core_team_meta_box_functions' ) ) {
	function wellexpo_core_team_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'wellexpo_select_filter_meta_box_post_types_save', 'wellexpo_core_team_meta_box_functions' );
	add_filter( 'wellexpo_select_filter_meta_box_post_types_remove', 'wellexpo_core_team_meta_box_functions' );
}

if ( ! function_exists( 'wellexpo_core_team_scope_meta_box_functions' ) ) {
	function wellexpo_core_team_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'wellexpo_select_filter_set_scope_for_meta_boxes', 'wellexpo_core_team_scope_meta_box_functions' );
}

if ( ! function_exists( 'wellexpo_select_team_member_body_class' ) ) {
	/**
	 * Function that adds team member skin class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with team member skin class added
	 */
	function wellexpo_select_team_member_body_class( $classes ) {
		$team_member_skin = get_post_meta( get_the_ID(), 'qodef_team_member_skin', true );

		if ( ! empty( $team_member_skin ) ) {
			$classes[] = 'qodef-team-member-' . $team_member_skin . '-skin';
		}

		return $classes;
	}

	add_filter( 'body_class', 'wellexpo_select_team_member_body_class' );
}

if ( ! function_exists( 'wellexpo_core_team_enqueue_meta_box_styles' ) ) {
	function wellexpo_core_team_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'qodef-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'wellexpo_select_action_enqueue_meta_box_styles', 'wellexpo_core_team_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'wellexpo_core_register_team_cpt' ) ) {
	function wellexpo_core_register_team_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'WellExpoCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_register_custom_post_types', 'wellexpo_core_register_team_cpt' );
}

// Load team shortcodes
if ( ! function_exists( 'wellexpo_core_include_team_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function wellexpo_core_include_team_shortcodes_files() {
		foreach ( glob( WELLEXPO_CORE_CPT_PATH . '/team/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'wellexpo_core_action_include_shortcodes_file', 'wellexpo_core_include_team_shortcodes_files' );
}

if ( ! function_exists( 'wellexpo_core_get_single_team' ) ) {
	/**
	 * Loads holder template for team single
	 */
	function wellexpo_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => wellexpo_select_sidebar_layout(),
			'position'       => get_post_meta( $team_member_id, 'qodef_team_member_position', true ),
			'birth_date'     => get_post_meta( $team_member_id, 'qodef_team_member_birth_date', true ),
			'email'          => get_post_meta( $team_member_id, 'qodef_team_member_email', true ),
			'twitter'        => get_post_meta( $team_member_id, 'qodef_team_member_twitter', true ),
			'website'        => get_post_meta( $team_member_id, 'qodef_team_member_website', true ),
			'phone'          => get_post_meta( $team_member_id, 'qodef_team_member_phone', true ),
			'address'        => get_post_meta( $team_member_id, 'qodef_team_member_address', true ),
			'interview'      => get_post_meta( $team_member_id, 'qodef_team_member_interview', true ),
			'resume'         => get_post_meta( $team_member_id, 'qodef_team_member_resume', true ),
			'social_icons'   => wellexpo_core_single_team_social_icons( $team_member_id ),
		);
		
		wellexpo_core_get_cpt_single_module_template_part( 'templates/single/holder', 'team', '', $params );
	}
}

if ( ! function_exists( 'wellexpo_core_single_team_social_icons' ) ) {
	function wellexpo_core_single_team_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$team_icon_pack = get_post_meta( $id, 'qodef_team_member_social_icon_pack_' . $i, true );
			if ( $team_icon_pack !== '' ) {
				$team_icon_collection = wellexpo_select_icon_collections()->getIconCollection( get_post_meta( $id, 'qodef_team_member_social_icon_pack_' . $i, true ) );
				$team_social_icon     = get_post_meta( $id, 'qodef_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true );
				$team_social_link     = get_post_meta( $id, 'qodef_team_member_social_icon_' . $i . '_link', true );
				$team_social_target   = get_post_meta( $id, 'qodef_team_member_social_icon_' . $i . '_target', true );
				
				if ( $team_social_icon !== '' ) {
					$team_icon_params                                 = array();
					$team_icon_params['icon_pack']                    = $team_icon_pack;
					$team_icon_params[ $team_icon_collection->param ] = $team_social_icon;
					$team_icon_params['link']                         = ! empty( $team_social_link ) ? $team_social_link : '';
					$team_icon_params['target']                       = ! empty( $team_social_target ) ? $team_social_target : '_self';
					
					$social_icons[] = wellexpo_select_execute_shortcode( 'qodef_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'wellexpo_core_get_team_category_list' ) ) {
	function wellexpo_core_get_team_category_list( $category = '' ) {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns' => $number_of_columns
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = wellexpo_select_execute_shortcode( 'qodef_team_list', $params );
		
		print $html;
	}
}

if ( ! function_exists( 'wellexpo_core_add_team_to_search_types' ) ) {
	function wellexpo_core_add_team_to_search_types( $post_types ) {
		$post_types['team-member'] = esc_html__( 'Team Member', 'wellexpo-core' );
		
		return $post_types;
	}
	
	add_filter( 'wellexpo_select_filter_search_post_type_widget_params_post_type', 'wellexpo_core_add_team_to_search_types' );
}

if(!function_exists('wellexpo_core_team_list_info_opening')) {
	function wellexpo_core_team_list_info_opening() {

		$data = array();
		$html = '';

		if(isset($_POST) && isset($_POST['member_id']) ) {

			$member_id = $_POST['member_id'];

			if(!empty($member_id)) {

				$data['member_id']  = $member_id;
				$data['title']      = get_the_title($member_id);
				$data['list_image'] = get_post_meta($member_id, 'qodef_team_member_list_image', true);
				$data['position']   = get_post_meta($member_id, 'qodef_team_member_position', true);
				$data['twitter']    = get_post_meta($member_id, 'qodef_team_member_twitter', true);
				$data['website']    = get_post_meta($member_id, 'qodef_team_member_website', true);
				$data['titles']     = get_post_meta($member_id, 'qodef_team_member_title', true);
				$data['dates']      = get_post_meta($member_id, 'qodef_team_member_date', true);
				$data['hours']      = get_post_meta($member_id, 'qodef_team_member_hours', true);
				$data['places']     = get_post_meta($member_id, 'qodef_team_member_place', true);
				$data['boxes']      = count($data['titles']);
				$data['content']    = get_post($member_id)->post_content;
				$data['team_main_bckg_color'] = 'background-color: '.get_post_meta($member_id, 'qodef_team_member_background_color_meta', true);

				$social_icons = array();

				for($i = 1; $i < 6; $i++) {
					$team_icon_pack = get_post_meta($member_id, 'qodef_team_member_social_icon_pack_'.$i, true);
					if($team_icon_pack) {
						$team_icon_collection = wellexpo_select_icon_collections()->getIconCollection(get_post_meta($member_id, 'qodef_team_member_social_icon_pack_' . $i, true));
						$team_social_icon = get_post_meta($member_id, 'qodef_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
						$team_social_link = get_post_meta($member_id, 'qodef_team_member_social_icon_' . $i . '_link', true);
						$team_social_target = get_post_meta($member_id, 'qodef_team_member_social_icon_' . $i . '_target', true);

						if ($team_social_icon !== '') {

							$team_icon_params = array();
							$team_icon_params['icon_pack'] = $team_icon_pack;
							$team_icon_params[$team_icon_collection->param] = $team_social_icon;
							$team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
							$team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

							$social_icons[] = wellexpo_select_execute_shortcode('qodef_icon', $team_icon_params);
						}
					}
				}

				$data['team_social_icons'] = $social_icons;

				$html = wellexpo_core_get_cpt_shortcode_module_template_part('team', 'team-list', 'team-popup', '', $data);
			}

		} else {
			$status = 'error';
		}

		$response = array (
			'html' => $html
		);

		$output = json_encode($response);

		exit($output);

		wp_die();
	}

	add_action( 'wp_ajax_nopriv_wellexpo_core_team_list_info_opening', 'wellexpo_core_team_list_info_opening' );
	add_action( 'wp_ajax_wellexpo_core_team_list_info_opening', 'wellexpo_core_team_list_info_opening' );
}

if(!function_exists('wellexpo_core_team_list_render_box_html')){
	function wellexpo_core_team_list_render_box_html(){
		$html = '<div class="qodef-team-modal-holder"></div>';

		print $html;
	}

	add_action( 'wellexpo_select_action_after_wrapper_inner', 'wellexpo_core_team_list_render_box_html');

}