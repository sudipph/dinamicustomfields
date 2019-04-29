<?php

if ( ! function_exists( 'wellexpo_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function wellexpo_core_include_shortcodes_file() {
		if ( wellexpo_core_theme_installed() ) {
			foreach ( glob( WELLEXPO_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode ) {
				if ( wellexpo_select_is_customizer_item_enabled( $shortcode, 'wellexpo_performance_disable_shortcode_' ) ) {
					include_once $shortcode;
				}
			}
		}
		
		do_action( 'wellexpo_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'wellexpo_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'wellexpo_core_load_shortcodes' ) ) {
	function wellexpo_core_load_shortcodes() {
		include_once WELLEXPO_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		WellExpoCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'wellexpo_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after wellexpo_core_include_shortcodes_file hook
}

if ( ! function_exists( 'wellexpo_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function wellexpo_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'wellexpo-core-vc-shortcodes', WELLEXPO_CORE_ASSETS_URL_PATH . '/css/admin/wellexpo-vc-shortcodes.css' );
	}
	
	add_action( 'wellexpo_select_action_admin_scripts_init', 'wellexpo_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'wellexpo_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function wellexpo_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'wellexpo_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'wellexpo_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );
		
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'wellexpo-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'wellexpo_select_action_admin_scripts_init', 'wellexpo_core_add_admin_shortcodes_custom_styles' );
}