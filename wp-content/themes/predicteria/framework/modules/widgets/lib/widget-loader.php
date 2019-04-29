<?php

if ( ! function_exists( 'wellexpo_select_register_widgets' ) ) {
	function wellexpo_select_register_widgets() {
		$widgets = apply_filters( 'wellexpo_select_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'wellexpo_select_register_widgets' );
}