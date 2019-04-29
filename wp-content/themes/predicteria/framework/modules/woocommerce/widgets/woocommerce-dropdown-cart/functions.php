<?php

if ( ! function_exists( 'wellexpo_select_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function wellexpo_select_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'wellexpo_select_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function wellexpo_select_get_dropdown_cart_icon_class() {
		$classes = array(
			'qodef-header-cart'
		);
		
		$classes[] = wellexpo_select_get_icon_sources_class( 'dropdown_cart', 'qodef-header-cart' );
		
		return $classes;
	}
}