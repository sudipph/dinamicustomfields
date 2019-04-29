<?php

if ( ! function_exists( 'wellexpo_core_add_call_to_action_shortcodes' ) ) {
	function wellexpo_core_add_call_to_action_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\CallToAction\CallToAction'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_call_to_action_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_set_call_to_action_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for call to action shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_call_to_action_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-call-to-action';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_call_to_action_icon_class_name_for_vc_shortcodes' );
}