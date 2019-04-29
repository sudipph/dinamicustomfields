<?php

if ( ! function_exists( 'wellexpo_select_disable_wpml_css' ) ) {
	function wellexpo_select_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'wellexpo_select_disable_wpml_css' );
}