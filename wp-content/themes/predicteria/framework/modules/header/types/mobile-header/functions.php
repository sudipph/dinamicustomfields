<?php

if ( ! function_exists( 'wellexpo_select_include_mobile_header_menu' ) ) {
	function wellexpo_select_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'wellexpo' );
		
		return $menus;
	}
	
	add_filter( 'wellexpo_select_filter_register_headers_menu', 'wellexpo_select_include_mobile_header_menu' );
}

if ( ! function_exists( 'wellexpo_select_mobile_header_class' ) ) {
	function wellexpo_select_mobile_header_class( $classes ) {
		$classes[] = 'qodef-default-mobile-header';
		
		$classes[] = 'qodef-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'wellexpo_select_mobile_header_class' );
}

if ( ! function_exists( 'wellexpo_select_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function wellexpo_select_get_mobile_header( $slug = '', $module = '' ) {
		if ( wellexpo_select_is_responsive_on() ) {
			$mobile_menu_title = wellexpo_select_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => wellexpo_select_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('wellexpo_select_filter_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('wellexpo_select_filter_mobile_menu_slug', '');
            $parameters = apply_filters('wellexpo_select_filter_mobile_menu_parameters', $parameters);

            wellexpo_select_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'wellexpo_select_action_after_wrapper_inner', 'wellexpo_select_get_mobile_header', 20 );
}

if ( ! function_exists( 'wellexpo_select_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function wellexpo_select_get_mobile_logo() {
		$show_logo_image = wellexpo_select_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = wellexpo_select_get_meta_field_intersect( 'logo_image_mobile', wellexpo_select_get_page_id() );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : wellexpo_select_get_meta_field_intersect( 'logo_image', wellexpo_select_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = wellexpo_select_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			wellexpo_select_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'wellexpo_select_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function wellexpo_select_get_mobile_nav() {
		wellexpo_select_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'wellexpo_select_mobile_header_per_page_js_var' ) ) {
    function wellexpo_select_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['qodefMobileHeaderHeight'] = wellexpo_select_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'wellexpo_select_filter_per_page_js_vars', 'wellexpo_select_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'wellexpo_select_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function wellexpo_select_get_mobile_navigation_icon_class() {
		$classes = array(
			'qodef-mobile-menu-opener'
		);
		
		$classes[] = wellexpo_select_get_icon_sources_class( 'mobile', 'qodef-mobile-menu-opener' );

		return $classes;
	}
}