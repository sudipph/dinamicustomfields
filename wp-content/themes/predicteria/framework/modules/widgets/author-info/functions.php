<?php

if ( ! function_exists( 'wellexpo_select_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function wellexpo_select_register_author_info_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_author_info_widget' );
}