<?php

if ( ! function_exists( 'wellexpo_select_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function wellexpo_select_search_body_class( $classes ) {
		$classes[] = 'qodef-fullscreen-search';
		$classes[] = 'qodef-search-fade';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'wellexpo_select_search_body_class' );
}

if ( ! function_exists( 'wellexpo_select_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function wellexpo_select_get_search() {
		wellexpo_select_load_search_template();
	}
	
	add_action( 'wellexpo_select_action_before_page_header', 'wellexpo_select_get_search' );
}

if ( ! function_exists( 'wellexpo_select_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function wellexpo_select_load_search_template() {
		$parameters = array(
			'search_close_icon_class' 	=> wellexpo_select_get_search_close_icon_class(),
			'search_submit_icon_class' 	=> wellexpo_select_get_search_submit_icon_class()
		);

        wellexpo_select_get_module_template_part( 'types/fullscreen/templates/fullscreen', 'search', '', $parameters );
	}
}