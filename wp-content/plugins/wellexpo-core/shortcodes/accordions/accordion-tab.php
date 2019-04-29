<?php

namespace WellExpoCore\CPT\Shortcodes\AccordionTab;

use WellExpoCore\Lib;

class AccordionTab implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_accordion_tab';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					"name"                    => esc_html__( 'Accordion Tab', 'wellexpo-core' ),
					"base"                    => $this->base,
					"as_child"                => array( 'only' => 'qodef_accordion' ),
					'is_container'            => true,
					"category"                => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					"icon"                    => "icon-wpb-accordion-tab extended-custom-icon",
					"show_settings_on_create" => true,
					"js_view"                 => 'VcColumnView',
					"params"                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'wellexpo-core' ),
							'description' => esc_html__( 'Enter accordion section title', 'wellexpo-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'wellexpo-core' ),
							'value'      => array_flip( wellexpo_select_get_title_tag( true, array( 'p' => 'p' ) ) ),
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'title'     => 'Section',
			'title_tag' => 'h5'
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['content']   = $content;
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$output = wellexpo_core_get_shortcode_module_template_part( 'templates/accordion-template', 'accordions', '', $params );
		
		return $output;
	}
}