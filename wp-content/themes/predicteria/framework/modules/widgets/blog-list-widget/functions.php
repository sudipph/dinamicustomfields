<?php

if ( ! function_exists( 'wellexpo_select_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function wellexpo_select_register_blog_list_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_blog_list_widget' );
}