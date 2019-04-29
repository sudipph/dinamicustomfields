<?php

if ( ! function_exists( 'wellexpo_select_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function wellexpo_select_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_recent_posts_widget' );
}