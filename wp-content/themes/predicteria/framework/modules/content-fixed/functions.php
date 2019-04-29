<?php

if ( ! function_exists( 'wellexpo_select_get_content_fixed_area' ) ) {
	/**
	 * Loads content fixed area HTML with all needed parameters
	 */
	function wellexpo_select_get_content_fixed_area() {
		$is_enabled = wellexpo_select_get_meta_field_intersect( 'enable_content_fixed_area', wellexpo_select_get_page_id() );

		$holder_classes = array();

		if ( $is_enabled === 'yes' ) {

			$holder_classes[] = 'btn-enabled';

			$params = array(
				'holder_classes' => implode(' ', $holder_classes),
				'title'  => wellexpo_select_options()->getOptionValue( 'content_fixed_title' ),
				'text'   => wellexpo_select_options()->getOptionValue( 'content_fixed_text' ),
				'button' => array(
					'enabled' => wellexpo_select_options()->getOptionValue( 'content_fixed_button' ),
					'text'    => wellexpo_select_options()->getOptionValue( 'content_fixed_button_text' ),
					'url'     => wellexpo_select_options()->getOptionValue( 'content_fixed_button_url' ),
					'target'  => wellexpo_select_options()->getOptionValue( 'content_fixed_button_target' )
				)
			);

			wellexpo_select_get_module_template_part( 'templates/content-fixed-area', 'content-fixed', '', $params );
		}
	}
	
	add_action( 'wellexpo_select_action_after_footer_content', 'wellexpo_select_get_content_fixed_area' );
}