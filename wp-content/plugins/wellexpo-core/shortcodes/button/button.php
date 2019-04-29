<?php
namespace WellExpoCore\CPT\Shortcodes\Button;

use WellExpoCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Button', 'wellexpo-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'wellexpo-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'wellexpo-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'wellexpo-core' ),
								'value'       => array(
									esc_html__( 'Solid', 'wellexpo-core' )   => 'solid',
									esc_html__( 'Outline', 'wellexpo-core' ) => 'outline',
									esc_html__( 'Simple', 'wellexpo-core' )  => 'simple'
								),
								'admin_label' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'size',
								'heading'    => esc_html__( 'Size', 'wellexpo-core' ),
								'value'      => array(
									esc_html__( 'Default', 'wellexpo-core' ) => '',
									esc_html__( 'Small', 'wellexpo-core' )   => 'small',
									esc_html__( 'Medium', 'wellexpo-core' )  => 'medium',
									esc_html__( 'Large', 'wellexpo-core' )   => 'large',
									esc_html__( 'Huge', 'wellexpo-core' )    => 'huge'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text',
								'heading'     => esc_html__( 'Text', 'wellexpo-core' ),
								'value'       => esc_html__( 'Button Text', 'wellexpo-core' ),
								'save_always' => true,
								'admin_label' => true
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'link',
								'heading'    => esc_html__( 'Link', 'wellexpo-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'target',
								'heading'     => esc_html__( 'Link Target', 'wellexpo-core' ),
								'value'       => array_flip( wellexpo_select_get_link_target_array() ),
								'save_always' => true
							),
						),
						wellexpo_select_icon_collections()->getVCParamsArray( array(), '', true ),
						array(
							array(
								'type'       => 'dropdown',
								'param_name' => 'hover_type',
								'heading'    => esc_html__( 'Hover Type', 'wellexpo-core' ),
								'value'      => array(
									esc_html__( 'SVG Arrow', 'wellexpo-core' ) => 'svg-arrow',
									esc_html__( 'Color Based', 'wellexpo-core' ) => 'color-based',
								),
								'save_always' => true,
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid') ),
								'description' => esc_html__( 'Using SVG Arrow as hover type disables hover color options.', 'wellexpo-core' ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'arrow_height',
								'heading'     => esc_html__( 'Arrow height', 'wellexpo-core' ),
								'value'       => esc_html__( '9px', 'wellexpo-core' ),
								'save_always' => true,
								'dependency' => array( 'element' => 'hover_type', 'value' => array( 'svg-arrow') ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'wellexpo-core' ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_color',
								'heading'    => esc_html__( 'Hover Color', 'wellexpo-core' ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'background_color',
								'heading'    => esc_html__( 'Background Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_background_color',
								'heading'    => esc_html__( 'Hover Background Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'border_color',
								'heading'    => esc_html__( 'Border Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_border_color',
								'heading'    => esc_html__( 'Hover Border Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'font_size',
								'heading'    => esc_html__( 'Font Size (px)', 'wellexpo-core' ),
								'group'      => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'font_weight',
								'heading'     => esc_html__( 'Font Weight', 'wellexpo-core' ),
								'value'       => array_flip( wellexpo_select_get_font_weight_array( true ) ),
								'save_always' => true,
								'group'       => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'text_transform',
								'heading'     => esc_html__( 'Text Transform', 'wellexpo-core' ),
								'value'       => array_flip( wellexpo_select_get_text_transform_array( true ) ),
								'save_always' => true
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'margin',
								'heading'     => esc_html__( 'Margin', 'wellexpo-core' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'wellexpo-core' ),
								'group'       => esc_html__( 'Design Options', 'wellexpo-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'padding',
								'heading'     => esc_html__( 'Button Padding', 'wellexpo-core' ),
								'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'wellexpo-core' ),
								'dependency'  => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'       => esc_html__( 'Design Options', 'wellexpo-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'hover_type'			 => 'svg-arrow',
			'arrow_height'			 => '9px',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array()
		);
		$default_atts = array_merge( $default_atts, wellexpo_select_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = wellexpo_select_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		$params['arrow_styles']        = $this->getSVGArrowStyles( $params ); 
		
		return wellexpo_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . wellexpo_select_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'qodef-btn',
			'qodef-btn-' . $params['size'],
			'qodef-btn-' . $params['type']
		);
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'qodef-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$buttonClasses[] = 'qodef-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'qodef-btn-custom-hover-color';
		}
		
		if ( ! empty( $params['icon'] ) ) {
			$buttonClasses[] = 'qodef-btn-icon';
		}
		
		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}

		if ( $params['type'] == 'solid' && $params['hover_type'] == 'svg-arrow') {
			$buttonClasses[] = 'qodef-with-svg-arrow';
		}
		
		return $buttonClasses;
	}

	private function getSVGArrowStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['arrow_height'] ) ) {
			$styles[] = 'height: ' . wellexpo_select_filter_px( $params['arrow_height'] ) . 'px';
		}
		
		return $styles;
	}
}