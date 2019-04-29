<?php

if ( ! function_exists( 'wellexpo_select_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function wellexpo_select_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( wellexpo_select_check_is_header_type_enabled( 'header-vertical', wellexpo_select_get_page_id() ) ) {
		add_filter( 'wellexpo_select_filter_allow_sticky_header_behavior', 'wellexpo_select_disable_behaviors_for_header_vertical' );
		add_filter( 'wellexpo_select_filter_allow_content_boxed_layout', 'wellexpo_select_disable_behaviors_for_header_vertical' );
	}
}