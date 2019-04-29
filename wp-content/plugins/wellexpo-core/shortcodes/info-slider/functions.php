<?php

if ( ! function_exists( 'wellexpo_core_add_info_slider_shortcodes' ) ) {
	function wellexpo_core_add_info_slider_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\InfoSlider\InfoSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_info_slider_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_set_info_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for info slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_info_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-info-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_info_slider_icon_class_name_for_vc_shortcodes' );
}