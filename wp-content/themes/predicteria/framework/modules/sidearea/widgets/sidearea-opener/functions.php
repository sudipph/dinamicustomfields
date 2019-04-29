<?php

if ( ! function_exists( 'wellexpo_select_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function wellexpo_select_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_sidearea_opener_widget' );
}