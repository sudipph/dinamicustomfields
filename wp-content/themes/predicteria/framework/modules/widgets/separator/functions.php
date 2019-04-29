<?php

if ( ! function_exists( 'wellexpo_select_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function wellexpo_select_register_separator_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_separator_widget' );
}