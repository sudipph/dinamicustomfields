<?php
namespace WellExpoCore\CPT\Shortcodes\PricingTable;

use WellExpoCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Pricing Table', 'wellexpo-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'qodef_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'wellexpo-core' ),
							'value'       => array_flip( wellexpo_select_get_number_of_columns_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'wellexpo-core' ),
							'value'       => array_flip( wellexpo_select_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'wellexpo-core' ),
							'value'      => array(
								esc_html__( 'Default', 'wellexpo-core' ) => '',
								esc_html__( 'Light', 'wellexpo-core' )   => 'qodef-light-skin',
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
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
			'skin'                => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="qodef-pricing-tables qodef-grid-list qodef-disable-bottom-space clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="qodef-pt-wrapper qodef-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
}