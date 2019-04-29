<?php

namespace WellExpoCore\CPT\Shortcodes\MasonryElementsHolder;

use WellExpoCore\Lib;

class MasonryElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_masonry_elements_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Masonry Elements Holder', 'wellexpo-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-masonry-elements-holder extended-custom-icon',
					'category'  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'as_parent' => array( 'only' => 'qodef_masonry_elements_holder_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Columns', 'wellexpo-core' ),
							'param_name'  => 'columns',
							'value'       => array(
								esc_html__( 'Two', 'wellexpo-core' )   => 'two',
								esc_html__( 'Three', 'wellexpo-core' ) => 'three',
								esc_html__( 'Four', 'wellexpo-core' )  => 'four'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getClasses( $params );
		$params['content']        = $content;
		
		$html = wellexpo_core_get_shortcode_module_template_part( 'templates/masonry-elements-holder-template', 'masonry-elements-holder', '', $params );
		
		return $html;
	}
	
	private function getClasses( $params ) {
		$classes = array(
			'qodef-masonry-elements-holder'
		);
		
		if ( $params['columns'] !== '' ) {
			$classes[] = 'qodef-masonry-' . esc_attr( $params['columns'] ) . '-columns';
		}
		
		return $classes;
	}
}