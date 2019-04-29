<?php

if ( ! function_exists( 'wellexpo_select_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function wellexpo_select_get_subscribe_popup() {
		
		if ( wellexpo_select_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( wellexpo_select_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || wellexpo_select_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			wellexpo_select_load_subscribe_popup_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'wellexpo_select_action_before_page_header', 'wellexpo_select_get_subscribe_popup' );
}

if ( ! function_exists( 'wellexpo_select_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function wellexpo_select_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = wellexpo_select_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = wellexpo_select_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = wellexpo_select_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = wellexpo_select_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = wellexpo_select_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = wellexpo_select_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = wellexpo_select_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'qodef-prevent-enable' : 'qodef-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'qodef-prevent-' . $parameters['prevent_behavior'] : 'qodef-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'qodef-sp-has-image' : '';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		wellexpo_select_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}