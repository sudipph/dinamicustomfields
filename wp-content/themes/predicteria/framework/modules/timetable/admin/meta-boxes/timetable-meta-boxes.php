<?php

if ( ! function_exists( 'wellexpo_select_map_timetable_meta' ) ) {
	function wellexpo_select_map_timetable_meta() {
		
		$timetable_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'events' ),
				'title' => esc_html__( 'Event Timetable', 'wellexpo' ),
				'name'  => 'timetable_meta_map'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_event_time_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Event Time', 'wellexpo' ),
				'description'   => esc_html__( 'Enter a time for this event, for example: 12h - 14h', 'wellexpo' ),
				'parent'        => $timetable_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_event_author_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Event Author', 'wellexpo' ),
				'description'   => esc_html__( 'Enter author of this event', 'wellexpo' ),
				'parent'        => $timetable_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_event_custom_link_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Event link', 'wellexpo' ),
				'description'   => esc_html__( 'Enter custom link for this event', 'wellexpo' ),
				'parent'        => $timetable_meta_box
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_timetable_meta', 99 );
}