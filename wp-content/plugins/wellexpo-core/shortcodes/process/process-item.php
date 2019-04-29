<?php
namespace WellExpoCore\CPT\Shortcodes\Process;

use WellExpoCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_process_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Process Item', 'wellexpo-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'     => 'icon-wpb-process-item extended-custom-icon',
					'as_child' => array( 'only' => 'qodef_process' ),
					'params'   => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'wellexpo-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'wellexpo-core' )
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
								'dependency'  => array( 'element' => 'title', 'not_empty' => true )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true )
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
								'dependency' => array( 'element' => 'text', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'wellexpo-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'process_mark_image',
								'heading'    => esc_html__( 'Process Mark', 'wellexpo-core' ),
								'group'      => esc_html__( 'Background Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'process_mark_image_offset_x',
								'heading'    => esc_html__( 'Process Mark Left Offset (px)', 'wellexpo-core' ),
								'group'      => esc_html__( 'Background Settings', 'wellexpo-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'process_mark_image_offset_y',
								'heading'    => esc_html__( 'Process Mark Top Offset (px)', 'wellexpo-core' ),
								'group'      => esc_html__( 'Background Settings', 'wellexpo-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                => '',
			'custom_icon'                 => '',
			'icon_type'                   => 'qodef-normal',
			'icon_size'                   => 'qodef-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
			'process_mark_image'          => '',
			'process_mark_image_offset_x' => '',
			'process_mark_image_offset_y' => ''
		);
		$args = array_merge( $args, wellexpo_select_icon_collections()->getShortcodeParams() );
		$params = shortcode_atts( $args, $atts );

		$holder_classes = $this->getHolderClasses( $params );
		unset( $params['custom_class'] );

		$params['icon_parameters']     = $this->getIconParameters( $params );
		$params['title_tag']           = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']        = $this->getTitleStyles( $params );
		$params['text_styles']         = $this->getTextStyles( $params );
		$params['process_mark_styles'] = $this->getProcessMarkStyles( $params );

		$html = wellexpo_core_get_shortcode_module_template_part( 'templates/process-item-template', 'process', '', array(
			'holder_classes'      => $holder_classes,
			'process_mark_image'  => $params['process_mark_image'],
			'process_mark_styles' => $params['process_mark_styles'],
			'params'              => $params
		) );
		
		return $html;
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
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
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

	private function getProcessMarkStyles( $params ) {
		$styles = array();

		if ( $params['process_mark_image_offset_x'] !== '' ) {
			$styles[] = 'left: ' . wellexpo_select_filter_px( $params['process_mark_image_offset_x'] ) . 'px';
		}

		if ( $params['process_mark_image_offset_y'] !== '' ) {
			$styles[] = 'top: ' . wellexpo_select_filter_px( $params['process_mark_image_offset_y'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}
