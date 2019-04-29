<?php

if ( ! function_exists( 'wellexpo_select_add_product_info_shortcode' ) ) {
	function wellexpo_select_add_product_info_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\ProductInfo\ProductInfo',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_select_add_product_info_shortcode' );
}

if ( ! function_exists( 'wellexpo_select_set_product_info_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for product info shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function wellexpo_select_set_product_info_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-product-info';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', 'wellexpo_select_set_product_info_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'wellexpo_select_add_product_info_into_shortcodes_list' ) ) {
	function wellexpo_select_add_product_info_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'qodef_product_info';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'wellexpo_select_filter_woocommerce_shortcodes_list', 'wellexpo_select_add_product_info_into_shortcodes_list' );
}