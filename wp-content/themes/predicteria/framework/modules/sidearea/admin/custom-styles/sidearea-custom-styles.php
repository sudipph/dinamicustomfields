<?php

if ( ! function_exists( 'wellexpo_select_side_area_slide_from_right_type_style' ) ) {
	function wellexpo_select_side_area_slide_from_right_type_style() {
		
		if ( wellexpo_select_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-from-right' ) {
			
			if ( wellexpo_select_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo wellexpo_select_dynamic_css( '.qodef-side-menu-slide-from-right .qodef-side-menu', array(
					'right' => '-' . wellexpo_select_options()->getOptionValue( 'side_area_width' ),
					'width' => wellexpo_select_options()->getOptionValue( 'side_area_width' )
				) );
			}
			
			if ( wellexpo_select_options()->getOptionValue( 'side_area_content_overlay_color' ) !== '' ) {
				
				echo wellexpo_select_dynamic_css( '.qodef-side-menu-slide-from-right .qodef-wrapper .qodef-cover', array(
					'background-color' => wellexpo_select_options()->getOptionValue( 'side_area_content_overlay_color' )
				) );
			}
			
			if ( wellexpo_select_options()->getOptionValue( 'side_area_content_overlay_opacity' ) !== '' ) {
				
				echo wellexpo_select_dynamic_css( '.qodef-side-menu-slide-from-right.qodef-right-side-menu-opened .qodef-wrapper .qodef-cover', array(
					'opacity' => wellexpo_select_options()->getOptionValue( 'side_area_content_overlay_opacity' )
				) );
			}
		}
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'wellexpo_select_side_area_slide_with_content_type_style' ) ) {
	function wellexpo_select_side_area_slide_with_content_type_style() {
		
		if ( wellexpo_select_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-with-content' ) {
			
			if ( wellexpo_select_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo wellexpo_select_dynamic_css( '.qodef-side-menu-slide-with-content .qodef-side-menu', array(
					'right' => '-' . wellexpo_select_options()->getOptionValue( 'side_area_width' ),
					'width' => wellexpo_select_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.qodef-side-menu-slide-with-content.qodef-side-menu-open .qodef-wrapper',
					'.qodef-side-menu-slide-with-content.qodef-side-menu-open footer.uncover',
					'.qodef-side-menu-slide-with-content.qodef-side-menu-open .qodef-sticky-header',
					'.qodef-side-menu-slide-with-content.qodef-side-menu-open .qodef-fixed-wrapper',
					'.qodef-side-menu-slide-with-content.qodef-side-menu-open .qodef-mobile-header-inner',
				);
				
				echo wellexpo_select_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . wellexpo_select_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_side_area_slide_with_content_type_style' );
}

if ( ! function_exists( 'wellexpo_select_side_area_uncovered_from_content_type_style' ) ) {
	function wellexpo_select_side_area_uncovered_from_content_type_style() {
		
		if ( wellexpo_select_options()->getOptionValue( 'side_area_type' ) == 'side-area-uncovered-from-content' ) {
			
			if ( wellexpo_select_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo wellexpo_select_dynamic_css( '.qodef-side-area-uncovered-from-content .qodef-side-menu', array(
					'width' => wellexpo_select_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened .qodef-wrapper',
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened footer.uncover',
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened .qodef-sticky-header',
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened .qodef-fixed-wrapper.fixed',
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened .qodef-mobile-header-inner',
					'.qodef-side-area-uncovered-from-content.qodef-right-side-menu-opened .mobile-header-appear .qodef-mobile-header-inner',
				);
				
				echo wellexpo_select_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . wellexpo_select_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_side_area_uncovered_from_content_type_style' );
}

if ( ! function_exists( 'wellexpo_select_side_area_icon_color_styles' ) ) {
	function wellexpo_select_side_area_icon_color_styles() {
		$icon_color             = wellexpo_select_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = wellexpo_select_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = wellexpo_select_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = wellexpo_select_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.qodef-side-menu-button-opener:hover',
			'.qodef-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo wellexpo_select_dynamic_css( '.qodef-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo wellexpo_select_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo wellexpo_select_dynamic_css( '.qodef-side-menu a.qodef-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo wellexpo_select_dynamic_css( '.qodef-side-menu a.qodef-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_side_area_icon_color_styles' );
}

if ( ! function_exists( 'wellexpo_select_side_area_styles' ) ) {
	function wellexpo_select_side_area_styles() {
		$side_area_styles = array();
		$background_color = wellexpo_select_options()->getOptionValue( 'side_area_background_color' );
		$padding          = wellexpo_select_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = wellexpo_select_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo wellexpo_select_dynamic_css( '.qodef-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo wellexpo_select_dynamic_css( '.qodef-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'wellexpo_select_action_style_dynamic', 'wellexpo_select_side_area_styles' );
}