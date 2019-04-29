<?php

if ( ! function_exists( 'wellexpo_select_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function wellexpo_select_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_sticky_sidebar_widget' );
}