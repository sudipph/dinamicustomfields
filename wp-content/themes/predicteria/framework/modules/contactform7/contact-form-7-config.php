<?php

if ( ! function_exists('wellexpo_select_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function wellexpo_select_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'wellexpo'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'wellexpo') => 'default',
				esc_html__('Custom Style 1', 'wellexpo') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'wellexpo') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'wellexpo') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Select Options > Contact Form 7', 'wellexpo')
		));
	}
	
	add_action('vc_after_init', 'wellexpo_select_contact_form_map');
}