<?php

if ( ! function_exists( 'wellexpo_select_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function wellexpo_select_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'wellexpo' );
		
		return $type;
	}
	
	add_filter( 'wellexpo_select_filter_title_type_global_option', 'wellexpo_select_set_title_centered_type_for_options' );
	add_filter( 'wellexpo_select_filter_title_type_meta_boxes', 'wellexpo_select_set_title_centered_type_for_options' );
}