<?php

if ( ! function_exists( 'wellexpo_select_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function wellexpo_select_register_button_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_button_widget' );
}