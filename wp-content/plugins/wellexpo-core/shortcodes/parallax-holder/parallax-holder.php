<?php
namespace WellExpoCore\CPT\Shortcodes\ParallaxHolder;

use WellExpoCore\Lib;

class ParallaxHolder implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_parallax_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Parallax Holder', 'wellexpo-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
					'icon'                      => 'icon-wpb-parallax-holder extended-custom-icon',
					'as_parent' => array('except' => ''),
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Y Axis Translation', 'wellexpo-core'),
							'admin_label' => true,
							'param_name' => 'y_axis_translation',
							'value' => '-200',
							'description' => esc_html__('Enter the value in pixels. Negative value changes parallax direction.', 'wellexpo-core')
						),
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
	
		$args = array(
			'y_axis_translation' => '-200',
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html= '';
		$y_absolute = wellexpo_select_filter_px($y_axis_translation);
		$smoothness = 20; //1 is for linear, non-animated parallax

		$parallax = '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';

		$html .= '<div class="qodef-parallax-holder" data-parallax="'.$parallax.'">'; 
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}
}