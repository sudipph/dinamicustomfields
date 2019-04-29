<?php

if ( ! function_exists( 'wellexpo_select_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function wellexpo_select_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'wellexpo' );
		
		return $templates;
	}
	
	add_filter( 'wellexpo_select_filter_register_blog_templates', 'wellexpo_select_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'wellexpo_select_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function wellexpo_select_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'wellexpo' );
		
		return $options;
	}
	
	add_filter( 'wellexpo_select_filter_blog_list_type_global_option', 'wellexpo_select_set_blog_masonry_type_global_option' );
}