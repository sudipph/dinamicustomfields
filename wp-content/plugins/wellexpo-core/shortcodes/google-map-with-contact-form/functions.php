<?php

if ( ! function_exists( 'wellexpo_core_add_google_map_with_contact_form_shortcodes' ) ) {
	function wellexpo_core_add_google_map_with_contact_form_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\GoogleMapWithContactForm\GoogleMapWithContactForm'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_google_map_with_contact_form_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_set_google_map_with_contact_form_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for google map with contact form shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_google_map_with_contact_form_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-google-map-with-contact-form';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_google_map_with_contact_form_icon_class_name_for_vc_shortcodes' );
}