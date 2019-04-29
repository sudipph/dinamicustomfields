<?php

if ( ! function_exists( 'wellexpo_core_enqueue_scripts_for_counter_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function wellexpo_core_enqueue_scripts_for_counter_shortcodes() {
		wp_enqueue_script( 'counter', WELLEXPO_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'absoluteCounter', WELLEXPO_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/absoluteCounter.min.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'wellexpo_select_action_enqueue_third_party_scripts', 'wellexpo_core_enqueue_scripts_for_counter_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_add_counter_shortcodes' ) ) {
	function wellexpo_core_add_counter_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\Counter\Counter'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_counter_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_set_counter_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for counter shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_counter_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-counter';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_counter_icon_class_name_for_vc_shortcodes' );
}