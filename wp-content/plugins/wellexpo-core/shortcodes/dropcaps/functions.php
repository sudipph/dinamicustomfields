<?php

if ( ! function_exists( 'wellexpo_core_add_dropcaps_shortcodes' ) ) {
	function wellexpo_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'WellExpoCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'wellexpo_core_filter_add_vc_shortcode', 'wellexpo_core_add_dropcaps_shortcodes' );
}