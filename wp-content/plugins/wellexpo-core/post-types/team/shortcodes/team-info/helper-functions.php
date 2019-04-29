<?php
if ( ! function_exists( 'wellexpo_core_add_team_info_shortcode' ) ) {
	function wellexpo_core_add_team_info_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\Team\TeamInfo'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_team_info_shortcode' );
}

if ( ! function_exists( 'wellexpo_core_set_team_info_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for team info shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_team_info_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-team-info';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_team_info_icon_class_name_for_vc_shortcodes' );
}