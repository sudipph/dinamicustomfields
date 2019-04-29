<?php

if ( ! function_exists( 'wellexpo_select_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function wellexpo_select_register_icon_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_icon_widget' );
}