<?php

if ( ! function_exists( 'wellexpo_select_breadcrumbs_title_area_typography_style' ) ) {
	function wellexpo_select_breadcrumbs_title_area_typography_style() {
		
		$item_styles = wellexpo_select_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs'
		);
		
		echo wellexpo_select_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = wellexpo_select_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs a:hover'
		);
		
		echo wellexpo_select_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_breadcrumbs_title_area_typography_style' );
}