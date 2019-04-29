<?php

if ( ! function_exists( 'wellexpo_select_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function wellexpo_select_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'qodef-container';
		$params_list['inner']  = 'qodef-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'wellexpo_select_filter_blog_holder_params', 'wellexpo_select_get_blog_holder_params' );
}

if ( ! function_exists( 'wellexpo_select_blog_part_params' ) ) {
	function wellexpo_select_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h4';
		$part_params['link_tag']  = 'h4';
		$part_params['quote_tag'] = 'h4';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'wellexpo_select_filter_blog_part_params', 'wellexpo_select_blog_part_params' );
}