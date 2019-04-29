<?php
namespace WellExpoCore\CPT\Shortcodes\IconWithText;

use WellExpoCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Icon With Text', 'wellexpo-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
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
									esc_html__( 'Icon Left From Text', 'wellexpo-core' )  => 'icon-left',
									esc_html__( 'Icon Left From Title', 'wellexpo-core' ) => 'icon-left-from-title',
									esc_html__( 'Icon Top', 'wellexpo-core' )             => 'icon-top'
								),
								'save_always' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'background_decoration',
								'heading'    => esc_html__( 'Background Decoration', 'wellexpo-core' ),
								'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
								'dependency' => array(
									'element' => 'type',
									'value'   => array( 'icon-top' )
								)
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'background_decoration_size',
								'heading'    => esc_html__( 'Background Decoration Size', 'wellexpo-core' ),
								'value'       => array(
									esc_html__( 'Default', 'wellexpo-core' ) => '',
									esc_html__( 'Small', 'wellexpo-core' )   => 'small',
									esc_html__( 'Medium', 'wellexpo-core' )  => 'medium',
									esc_html__( 'Large', 'wellexpo-core' )   => 'large',
								),
								'dependency' => array(
									'element' => 'background_decoration',
									'value'   => array( 'yes' )
								)
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'background_decoration_top_padding',
								'heading'    => esc_html__( 'Background Decoration Top Padding (px)', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'background_decoration',
									'value'   => array( 'yes' )
								)
							)
						),
						wellexpo_select_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'wellexpo-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'wellexpo-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'wellexpo-core' ) => 'qodef-normal',
									esc_html__( 'Circle', 'wellexpo-core' ) => 'qodef-circle',
									esc_html__( 'Square', 'wellexpo-core' ) => 'qodef-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'wellexpo-core' ),
								'value'      => array(
									esc_html__( 'Medium', 'wellexpo-core' )     => 'qodef-icon-medium',
									esc_html__( 'Tiny', 'wellexpo-core' )       => 'qodef-icon-tiny',
									esc_html__( 'Small', 'wellexpo-core' )      => 'qodef-icon-small',
									esc_html__( 'Large', 'wellexpo-core' )      => 'qodef-icon-large',
									esc_html__( 'Very Large', 'wellexpo-core' ) => 'qodef-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'wellexpo-core' ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'wellexpo-core' ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'wellexpo-core' ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'wellexpo-core' ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'qodef-square', 'qodef-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'qodef-square', 'qodef-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'qodef-square', 'qodef-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'qodef-square', 'qodef-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'wellexpo-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'qodef-square', 'qodef-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'wellexpo-core' ),
								'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title',
								'heading'    => esc_html__( 'Title', 'wellexpo-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'title_tag',
								'heading'     => esc_html__( 'Title Tag', 'wellexpo-core' ),
								'value'       => array_flip( wellexpo_select_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'wellexpo-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'wellexpo-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'wellexpo-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'wellexpo-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'wellexpo-core' ),
								'value'      => array_flip( wellexpo_select_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Padding (px)', 'wellexpo-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'wellexpo-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'wellexpo-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'                      => '',
			'type'                              => 'icon-left',
			'background_decoration'             => '',
			'background_decoration_size'        => 'medium',
			'background_decoration_top_padding' => '',
			'custom_icon'                       => '',
			'icon_type'                         => 'qodef-normal',
			'icon_size'                         => 'qodef-icon-medium',
			'custom_icon_size'                  => '',
			'shape_size'                        => '',
			'icon_color'                        => '',
			'icon_hover_color'                  => '',
			'icon_background_color'             => '',
			'icon_hover_background_color'       => '',
			'icon_border_color'                 => '',
			'icon_border_hover_color'           => '',
			'icon_border_width'                 => '',
			'icon_animation'                    => '',
			'icon_animation_delay'              => '',
			'title'                             => '',
			'title_tag'                         => 'h4',
			'title_color'                       => '',
			'title_top_margin'                  => '',
			'text'                              => '',
			'text_color'                        => '',
			'text_top_margin'                   => '',
			'link'                              => '',
			'target'                            => '_self',
			'text_padding'                      => ''
		);
		$default_atts = array_merge( $default_atts, wellexpo_select_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];

		$params['background_decoration_size']       = ! empty( $params['background_decoration_size'] ) ? $params['background_decoration_size'] : $default_atts['background_decoration_size'];
		$params['background_decoration_parameters'] = $this->getBackgroundDecorationParameters( $params );
		$params['icon_styles']                      = $this->getIconStyles( $params );

		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['holder_classes']  = $this->getHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		return wellexpo_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}

	private function getBackgroundDecorationParameters( $params ) {
		$params_array = array(
			'width'  => '140px',
			'height' => '140px'
		);

		if ( $params['background_decoration'] == 'yes' ) {

			switch ($params['background_decoration_size']) {

				case 'small':
					$params_array['width'] = $params_array['height'] = '100px';
					break;
				case 'medium':
					$params_array['width'] = $params_array['height'] = '140px';
					break;
				case 'large':
					$params_array['width'] = $params_array['height'] = '180px';
					break;
				default:
					break;
			}
		}

		return $params_array;
	}

	private function getIconStyles( $params ) {
		$styles = array();

		if ( $params['background_decoration'] == 'yes' ) {

			if ( $params['background_decoration_top_padding'] !== '' ) {
				$styles[] = 'padding-top: ' . wellexpo_select_filter_px( $params['background_decoration_top_padding'] ) . 'px';
			}
		}

		return implode( ';', $styles );
	}

	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = wellexpo_select_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = wellexpo_select_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = wellexpo_select_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = wellexpo_select_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'qodef-iwt', 'clearfix' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'qodef-iwt-' . str_replace( 'qodef-', '', $params['icon_size'] ) : '';
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . wellexpo_select_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . wellexpo_select_filter_px( $params['text_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . wellexpo_select_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . wellexpo_select_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}