<?php

if ( ! function_exists( 'wellexpo_select_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function wellexpo_select_header_top_bar_styles() {
		$top_header_height = wellexpo_select_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo wellexpo_select_dynamic_css( '.qodef-top-bar', array( 'height' => wellexpo_select_filter_px( $top_header_height ) . 'px' ) );
			echo wellexpo_select_dynamic_css( '.qodef-top-bar .qodef-logo-wrapper a', array( 'max-height' => wellexpo_select_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo wellexpo_select_dynamic_css( '.qodef-header-box .qodef-top-bar-background', array( 'height' => wellexpo_select_get_top_bar_background_height() . 'px' ) );
		
		$top_bar_container_selector = '.qodef-top-bar > .qodef-vertical-align-containers';
		$top_bar_container_styles   = array();
		$container_side_padding     = wellexpo_select_options()->getOptionValue( 'top_bar_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( wellexpo_select_string_ends_with( $container_side_padding, 'px' ) || wellexpo_select_string_ends_with( $container_side_padding, '%' ) ) {
				$top_bar_container_styles['padding-left'] = $container_side_padding;
				$top_bar_container_styles['padding-right'] = $container_side_padding;
			} else {
				$top_bar_container_styles['padding-left'] = wellexpo_select_filter_px( $container_side_padding ) . 'px';
				$top_bar_container_styles['padding-right'] = wellexpo_select_filter_px( $container_side_padding ) . 'px';
			}
			
			echo wellexpo_select_dynamic_css( $top_bar_container_selector, $top_bar_container_styles );
		}
		
		if ( wellexpo_select_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.qodef-top-bar .qodef-grid .qodef-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = wellexpo_select_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = wellexpo_select_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = wellexpo_select_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo wellexpo_select_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = wellexpo_select_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = wellexpo_select_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( wellexpo_select_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = wellexpo_select_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = wellexpo_select_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo wellexpo_select_dynamic_css( '.qodef-header-box .qodef-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( wellexpo_select_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo wellexpo_select_dynamic_css( '.qodef-top-bar', $top_bar_styles );
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_header_top_bar_styles' );
}