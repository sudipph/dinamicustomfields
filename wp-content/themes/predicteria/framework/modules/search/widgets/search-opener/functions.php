<?php

if ( ! function_exists( 'wellexpo_select_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function wellexpo_select_register_search_opener_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_search_opener_widget' );
}