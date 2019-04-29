<?php

if ( ! function_exists( 'wellexpo_select_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function wellexpo_select_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'WellExpoSelectNamespace\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'wellexpo_select_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function wellexpo_select_init_register_header_standard_type() {
		add_filter( 'wellexpo_select_filter_register_header_type_class', 'wellexpo_select_register_header_standard_type' );
	}
	
	add_action( 'wellexpo_select_action_before_header_function_init', 'wellexpo_select_init_register_header_standard_type' );
}