<?php

if ( ! function_exists( 'wellexpo_select_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function wellexpo_select_register_social_icons_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_social_icons_widget' );
}