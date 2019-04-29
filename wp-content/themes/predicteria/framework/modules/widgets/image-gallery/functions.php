<?php

if ( ! function_exists( 'wellexpo_select_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function wellexpo_select_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_image_gallery_widget' );
}