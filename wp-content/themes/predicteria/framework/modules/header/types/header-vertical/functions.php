<?php

if ( ! function_exists( 'wellexpo_select_register_header_vertical_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function wellexpo_select_register_header_vertical_type( $header_types ) {
		$header_type = array(
			'header-vertical' => 'WellExpoSelectNamespace\Modules\Header\Types\HeaderVertical'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'wellexpo_select_init_register_header_vertical_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function wellexpo_select_init_register_header_vertical_type() {
		add_filter( 'wellexpo_select_filter_register_header_type_class', 'wellexpo_select_register_header_vertical_type' );
	}
	
	add_action( 'wellexpo_select_action_before_header_function_init', 'wellexpo_select_init_register_header_vertical_type' );
}

if ( ! function_exists( 'wellexpo_select_include_header_vertical_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function wellexpo_select_include_header_vertical_menu( $menus ) {
		$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'wellexpo' );
		
		return $menus;
	}
	
	if ( wellexpo_select_check_is_header_type_enabled( 'header-vertical' ) ) {
		add_filter( 'wellexpo_select_filter_register_headers_menu', 'wellexpo_select_include_header_vertical_menu' );
	}
}

if ( ! function_exists( 'wellexpo_select_get_header_vertical_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function wellexpo_select_get_header_vertical_main_menu() {
		$menu_opening = wellexpo_select_options()->getOptionValue('vertical_menu_dropdown_opening');
		
		$params = array(
			'opening_class' => 'qodef-vertical-dropdown-'. ( $menu_opening !== '' ? $menu_opening : 'below' )
		);

		wellexpo_select_get_module_template_part( 'templates/vertical-navigation', 'header/types/header-vertical', '', $params );
	}
}

if ( ! function_exists( 'wellexpo_select_header_vertical_menu_area_type_body_class' ) ) {
	/**
	 * Function that adds header vertical menu area type class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with header vertical menu area type class added
	 */
	function wellexpo_select_header_vertical_menu_area_type_body_class( $classes ) {
		$menu_area_type = wellexpo_select_get_meta_field_intersect( 'vertical_header_menu_area_type', wellexpo_select_get_page_id() );

		if ( ! empty( $menu_area_type ) ) {
			$classes[] = 'qodef-vertical-header-menu-area-' . $menu_area_type;
		}

		return $classes;
	}

	add_filter( 'body_class', 'wellexpo_select_header_vertical_menu_area_type_body_class' );
}

if ( ! function_exists( 'wellexpo_select_vertical_header_holder_class' ) ) {
	/**
	 * Return holder class
	 */
	function wellexpo_select_vertical_header_holder_class() {
		$center_content = wellexpo_select_get_meta_field_intersect( 'vertical_header_center_content', wellexpo_select_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'qodef-vertical-alignment-center' : 'qodef-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'wellexpo_select_header_vertical_per_page_custom_styles' ) ) {
	/**
	 * Return header per page styles
	 */
	function wellexpo_select_header_vertical_per_page_custom_styles( $style, $class_prefix, $page_id ) {
		$header_area_style    = array();
		$header_area_selector = array( $class_prefix . '.qodef-header-vertical .qodef-vertical-area-background' );

		$vertical_header_background_color  = get_post_meta( $page_id, 'qodef_vertical_header_background_color_meta', true );
		$disable_vertical_background_image = get_post_meta( $page_id, 'qodef_disable_vertical_header_background_image_meta', true );
		$vertical_background_image         = get_post_meta( $page_id, 'qodef_vertical_header_background_image_meta', true );
		$vertical_shadow                   = get_post_meta( $page_id, 'qodef_vertical_header_shadow_meta', true );
		$vertical_border                   = get_post_meta( $page_id, 'qodef_vertical_header_border_meta', true );
		
		if ( ! empty( $vertical_header_background_color ) ) {
			$header_area_style['background-color'] = $vertical_header_background_color;
		}
		
		if ( $disable_vertical_background_image == 'yes' ) {
			$header_area_style['background-image'] = 'none';
		} elseif ( $vertical_background_image !== '' ) {
			$header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
		}
		
		if ( $vertical_shadow == 'yes' ) {
			$header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border == 'yes' ) {
			$header_border_color = get_post_meta( $page_id, 'qodef_vertical_header_border_color_meta', true );
			
			if ( $header_border_color !== '' ) {
				$header_area_style['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		$current_style = '';
		
		if ( ! empty( $header_area_style ) ) {
			$current_style .= wellexpo_select_dynamic_css( $header_area_selector, $header_area_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'wellexpo_select_filter_add_header_page_custom_style', 'wellexpo_select_header_vertical_per_page_custom_styles', 10, 3 );
}