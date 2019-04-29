<?php
namespace WellExpoCore\CPT\Shortcodes\InfoSlider;

use WellExpoCore\Lib;

class InfoSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_info_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Info Slider', 'wellexpo-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                      => 'icon-wpb-info-slider extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'wellexpo-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'tagline',
							'heading'     => esc_html__( 'Tagline', 'wellexpo-core' ),
							'admin_label' => true
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'wellexpo-core' )
						),
						array(
                            'type' => 'param_group',
                            'heading' => esc_html__( 'Slider Items', 'elated-core' ),
                            'param_name' => 'slider_items',
                            'params' => array(
                            	array(
                            		'type'        => 'attach_image',
                            		'param_name'  => 'image',
                            		'heading'     => esc_html__( 'Image', 'elated-core' ),
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link',
									'heading'     => esc_html__( 'Link', 'wellexpo-core' ),
								),
								array(
									'type'        => 'dropdown',
									'param_name'  => 'target',
									'heading'     => esc_html__( 'Link Target', 'wellexpo-core' ),
									'value'       => array_flip( wellexpo_select_get_link_target_array() ),
									'save_always' => true
								),
                            )
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Navigation', 'wellexpo-core' ),
							'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					    )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title'               => '',
			'tagline'             => '',
			'text'                => '',
			'slider_items' 		  => '',
			'enable_navigation'	  => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		$params['content'] = $content;
        $params['slider_items'] = json_decode(urldecode($params['slider_items']), true);
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );

		$html = wellexpo_core_get_shortcode_module_template_part( 'templates/info-slider-template', 'info-slider', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_navigation'] ? 'qodef-is-with-nav' : ''; 
		
		return implode( ' ', $holderClasses );
	}
}