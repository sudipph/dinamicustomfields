<?php
namespace WellExpoCore\CPT\Shortcodes\VerticalSplitSliderLeftPanel;

use WellExpoCore\Lib;

class VerticalSplitSliderLeftPanel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_vertical_split_slider_left_panel';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Left Sliding Panel', 'wellexpo-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'qodef_vertical_split_slider_content_item' ),
					'as_child'                => array( 'only' => 'qodef_vertical_split_slider' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                    => 'icon-wpb-vertical-split-slider-left-panel extended-custom-icon',
					'show_settings_on_create' => false,
					'js_view'                 => 'VcColumnView'
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$html = '<div class="qodef-vss-ms-left">';
			$html .= do_shortcode( $content );
		$html .= '</div>';
		
		return $html;
	}
}
