<?php

if ( ! function_exists( 'wellexpo_select_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function wellexpo_select_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = wellexpo_select_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo wellexpo_select_dynamic_css( '.qodef-page-footer .qodef-footer-top-holder', $item_styles );
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_footer_top_general_styles' );
}

if ( ! function_exists( 'wellexpo_select_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function wellexpo_select_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = wellexpo_select_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo wellexpo_select_dynamic_css( '.qodef-page-footer .qodef-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_footer_bottom_general_styles' );
}