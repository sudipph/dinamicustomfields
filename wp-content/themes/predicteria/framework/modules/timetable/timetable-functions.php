<?php

if ( ! function_exists( 'wellexpo_select_timetable_meta_box_functions' ) ) {
	function wellexpo_select_timetable_meta_box_functions( $post_types ) {
		$post_types[] = 'events';
		$post_types[] = 'tt-events';
		
		return $post_types;
	}
	
	add_filter( 'wellexpo_select_filter_meta_box_post_types_save', 'wellexpo_select_timetable_meta_box_functions' );
	add_filter( 'wellexpo_select_filter_meta_box_post_types_remove', 'wellexpo_select_timetable_meta_box_functions' );
}

// Loads sidebar on a single event page shortcodes
if ( ! function_exists( 'wellexpo_select_events_scope_meta_box_functions' ) ) {
	function wellexpo_select_events_scope_meta_box_functions( $post_types, $meta_panel ) {
		if ( $meta_panel === 'sidebar_meta' ) {
			$post_types[] = 'events';
		}
		
		return $post_types;
	}
	
	add_filter( 'wellexpo_select_filter_set_scope_for_meta_boxes', 'wellexpo_select_events_scope_meta_box_functions', 10, 2 );
}

// Loads timetable shortcodes
if ( ! function_exists( 'wellexpo_select_include_timetable_shortcodes_files' ) ) {
	/**
	 * Loads all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function wellexpo_select_include_timetable_shortcodes_files() {
		foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/timetable/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'wellexpo_core_action_include_shortcodes_file', 'wellexpo_select_include_timetable_shortcodes_files' );
}

if ( ! function_exists( 'wellexpo_select_get_tt_event_single_content' ) ) {
	/**
	 * Loads timetable single event page
	 */
	function wellexpo_select_get_tt_event_single_content() {
		$subtitle = get_post_meta( get_the_ID(), 'timetable_subtitle', true );
		
		$params = array(
			'subtitle' => $subtitle
		);
		
		wellexpo_select_get_module_template_part( 'templates/event-single', 'timetable', '', $params );
	}
}


if(!function_exists('wellexpo_select_events_scope_meta_box_functions')) {
	function wellexpo_select_events_scope_meta_box_functions($post_types) {
		$post_types[] = 'events';
		$post_types[] = 'tt-events';
		
		return $post_types;
	}
	
	add_filter('wellexpo_select_filter_meta_box_post_types_save', 'wellexpo_select_events_scope_meta_box_functions');
	add_filter('wellexpo_select_filter_meta_box_post_types_remove', 'wellexpo_select_events_scope_meta_box_functions');
	add_filter('wellexpo_select_filter_set_scope_for_meta_boxes', 'wellexpo_select_events_scope_meta_box_functions');
}
