<?php

if ( ! function_exists( 'wellexpo_select_add_timetable_event_list_shortcodes' ) ) {
	function wellexpo_select_add_timetable_event_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellexpoCore\CPT\Shortcodes\EventList\EventList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_select_add_timetable_event_list_shortcodes' );
}

if ( ! function_exists( 'wellexpo_select_set_timetable_event_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for event list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_select_set_timetable_event_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-event-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_select_set_timetable_event_list_icon_class_name_for_vc_shortcodes' );
}