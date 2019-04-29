<?php

if ( ! function_exists( 'wellexpo_select_register_custom_svg_icon_widget' ) ) {
	/**
	 * Function that register custom svg icon widget
	 */
	function wellexpo_select_register_custom_svg_icon_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassCustomSvgIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_custom_svg_icon_widget' );
}