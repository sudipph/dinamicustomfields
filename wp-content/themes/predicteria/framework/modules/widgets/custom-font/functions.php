<?php

if ( ! function_exists( 'wellexpo_select_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function wellexpo_select_register_custom_font_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_custom_font_widget' );
}