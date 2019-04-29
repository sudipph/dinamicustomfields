<?php

namespace WellExpoCore\CPT\Shortcodes\MasonryElementsHolderItem;

use WellExpoCore\Lib;

class MasonryElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_masonry_elements_holder_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Masonry Elements Holder Item', 'wellexpo-core' ),
					'base'                    => $this->base,
					'as_child'                => array( 'only' => 'qodef_masonry_elements_holder' ),
					'as_parent'               => array( 'except' => 'vc_row, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                    => 'icon-wpb-masonry-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'size',
							'heading'     => esc_html__( 'Size', 'wellexpo-core' ),
							'value'       => array(
								esc_html__( 'Square', 'wellexpo-core' )                 => 'square',
								esc_html__( 'Large Width', 'wellexpo-core' )            => 'large-width',
								esc_html__( 'Large Height', 'wellexpo-core' )           => 'large-height',
								esc_html__( 'Large Width and Height', 'wellexpo-core' ) => 'large-width-height'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'vertical_align',
							'heading'     => esc_html__( 'Vertical Alignment', 'wellexpo-core' ),
							'value'       => array(
								esc_html__( 'Middle', 'wellexpo-core' ) => 'middle',
								esc_html__( 'Top', 'wellexpo-core' )    => 'top',
								esc_html__( 'Bottom', 'wellexpo-core' ) => 'bottom'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_alignment',
							'heading'    => esc_html__( 'Horizontal Alignment', 'wellexpo-core' ),
							'value'      => array(
								esc_html__( 'Left', 'wellexpo-core' )   => 'left',
								esc_html__( 'Right', 'wellexpo-core' )  => 'right',
								esc_html__( 'Center', 'wellexpo-core' ) => 'center'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__( 'Padding', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'wellexpo-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'wellexpo-core' )
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'loading_animation',
							'heading'     => esc_html__( 'Loading Animation', 'wellexpo-core' ),
							'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					    ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1280_1440',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on screen size between 1280px-1440px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1024_1280',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on screen size between 1024px-1280px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_768_1024',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on screen size between 768px-1024px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_600_768',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on screen size between 600px-768px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480_600',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on screen size between 480px-600px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480',
							'group'       => esc_html__( 'Width & Responsiveness', 'wellexpo-core' ),
							'heading'     => esc_html__( 'Padding on Screen Size Bellow 480px', 'wellexpo-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'wellexpo-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'size'                   => '',
			'vertical_align'         => '',
			'horizontal_alignment'   => '',
			'item_padding'           => '',
			'background_color'       => '',
			'background_image'       => '',
			'loading_animation'		 => 'yes',
			'item_padding_1280_1440' => '',
			'item_padding_1024_1280' => '',
			'item_padding_768_1024'  => '',
			'item_padding_600_768'   => '',
			'item_padding_480_600'   => '',
			'item_padding_480'       => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$rand_class = 'qodef-masonry-elements-item-custom-' . mt_rand( 100000, 1000000 );
		
		$params['holder_classes']    = $this->getClasses( $params );
		$params['holder_style']      = $this->getStyle( $params );
		$params['holder_background'] = $this->getBackground( $params );
		$params['inner_style']       = $this->getInnerStyle( $params );
		
		$params['item_class'] = $rand_class;
		$params['item_data']  = $this->getData( $params );
		
		$params['content'] = $content;
		
		$html = wellexpo_core_get_shortcode_module_template_part( 'templates/masonry-elements-holder-item-template', 'masonry-elements-holder', '', $params );
		
		return $html;
	}
	
	private function getClasses( $params ) {
		$classes = array(
			'qodef-masonry-elements-item'
		);
		
		$classes[] = 'qodef-' . $params['size'];
		$classes[] = $params['loading_animation'] == 'yes' ? 'qodef-item-with-animation' : '';
		
		return $classes;
	}
	
	private function getStyle( $params ) {
		$style = array();
		
		if ( isset( $params['item_padding'] ) && $params['item_padding'] !== '' ) {
			$style[] = 'padding: ' . $params['item_padding'];
		}
		
		return implode( ';', $style );
	}
	
	private function getBackground( $params ) {
		$style = array();
		
		if ( isset( $params['background_image'] ) && $params['background_image'] !== '' ) {
			$style[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}
		
		if ( isset( $params['background_color'] ) && $params['background_color'] !== '' ) {
			$style[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $style );
	}
	
	private function getInnerStyle( $params ) {
		$style = array();
		
		if ( isset( $params['vertical_align'] ) && $params['vertical_align'] !== '' ) {
			$style[] = 'vertical-align: ' . $params['vertical_align'];
		}
		
		if ( isset( $params['horizontal_alignment'] ) && $params['horizontal_alignment'] !== '' ) {
			$style[] = 'text-align: ' . $params['horizontal_alignment'];
		}
		
		return implode( ';', $style );
	}
	
	private function getData( $params ) {
		$data = array();
		
		$data['data-item-class'] = $params['item_class'];
		
		if ( $params['item_padding_1280_1440'] !== '' ) {
			$data['data-1280-1440'] = $params['item_padding_1280_1440'];
		}
		
		if ( $params['item_padding_1024_1280'] !== '' ) {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}
		
		if ( $params['item_padding_768_1024'] !== '' ) {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}
		
		if ( $params['item_padding_600_768'] !== '' ) {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}
		
		if ( $params['item_padding_480_600'] !== '' ) {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}
		
		if ( $params['item_padding_480'] !== '' ) {
			$data['data-480'] = $params['item_padding_480'];
		}
		
		return $data;
	}
}
