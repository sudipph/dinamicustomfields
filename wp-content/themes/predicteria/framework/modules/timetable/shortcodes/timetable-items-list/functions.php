<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qodef_Timetable_List extends WPBakeryShortCodesContainer {}
}

if(!function_exists('wellexpo_select_add_timetable_items_list_shortcode')) {
	function wellexpo_select_add_timetable_items_list_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'WellexpoCore\CPT\Shortcodes\TimetableList\TimetableList',
			'WellexpoCore\CPT\Shortcodes\TimetableListItem\TimetableListItem',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	if(wellexpo_select_core_plugin_installed()) {
		add_filter('wellexpo_core_filter_add_vc_shortcode', 'wellexpo_select_add_timetable_items_list_shortcode');
	}
}