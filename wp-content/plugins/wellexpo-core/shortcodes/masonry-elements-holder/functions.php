<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qodef_Masonry_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Masonry_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'wellexpo_core_add_masonry_elements_holder_shortcodes' ) ) {
	function wellexpo_core_add_masonry_elements_holder_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\MasonryElementsHolder\MasonryElementsHolder',
			'WellExpoCore\CPT\Shortcodes\MasonryElementsHolderItem\MasonryElementsHolderItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_masonry_elements_holder_shortcodes' );
}

if ( ! function_exists( 'wellexpo_core_set_masonry_elements_holder_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for masonry elements holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_core_set_masonry_elements_holder_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-masonry-elements-holder';
		$shortcodes_icon_class_array[] = '.icon-wpb-masonry-elements-holder-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_core_set_masonry_elements_holder_icon_class_name_for_vc_shortcodes' );
}