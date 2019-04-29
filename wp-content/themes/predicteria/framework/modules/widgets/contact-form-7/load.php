<?php

if ( wellexpo_select_contact_form_7_installed() ) {
	include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_cf7_widget' );
}

if ( ! function_exists( 'wellexpo_select_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function wellexpo_select_register_cf7_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassContactForm7Widget';
		
		return $widgets;
	}
}