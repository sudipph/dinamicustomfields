<?php
namespace WellExpoCore\CPT\Shortcodes\AnimationHolder;

use WellExpoCore\Lib;

class AnimationHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_animation_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Animation Holder', 'wellexpo-core' ),
					'base'                    => $this->base,
					"as_parent"               => array( 'except' => 'vc_row' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'animation',
							'heading'     => esc_html__( 'Animation Type', 'wellexpo-core' ),
							'value'       => array(
								esc_html__( 'Element Grow In', 'wellexpo-core' )          => 'qodef-grow-in',
								esc_html__( 'Element Fade In Down', 'wellexpo-core' )     => 'qodef-fade-in-down',
								esc_html__( 'Element From Fade', 'wellexpo-core' )        => 'qodef-element-from-fade',
								esc_html__( 'Element From Left', 'wellexpo-core' )        => 'qodef-element-from-left',
								esc_html__( 'Element From Right', 'wellexpo-core' )       => 'qodef-element-from-right',
								esc_html__( 'Element From Top', 'wellexpo-core' )         => 'qodef-element-from-top',
								esc_html__( 'Element From Bottom', 'wellexpo-core' )      => 'qodef-element-from-bottom',
								esc_html__( 'Element Flip In', 'wellexpo-core' )          => 'qodef-flip-in',
								esc_html__( 'Element X Rotate', 'wellexpo-core' )         => 'qodef-x-rotate',
								esc_html__( 'Element Z Rotate', 'wellexpo-core' )         => 'qodef-z-rotate',
								esc_html__( 'Element Y Translate', 'wellexpo-core' )      => 'qodef-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'wellexpo-core' ) => 'qodef-fade-in-left-x-rotate',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'wellexpo-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'animation'       => '',
			'animation_delay' => ''
		);
		extract( shortcode_atts( $args, $atts ) );
		
		$html = '<div class="qodef-animation-holder ' . esc_attr( $animation ) . '" data-animation="' . esc_attr( $animation ) . '" data-animation-delay="' . esc_attr( $animation_delay ) . '"><div class="qodef-animation-inner">' . do_shortcode( $content ) . '</div></div>';
		
		return $html;
	}
}