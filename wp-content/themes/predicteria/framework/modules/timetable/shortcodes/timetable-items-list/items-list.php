<?php
namespace WellExpoCore\CPT\Shortcodes\TimetableList;

use WellExpoCore\Lib;

class TimetableList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_timetable_list';

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
					'name'                      => esc_html__( 'Timetable List', 'wellexpo' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo' ),
					'icon'                      => 'icon-wpb-a-timetable-list extended-custom-icon',
					'content_element'           => true,
					'as_parent'                 => array( 'only' => 'qodef_timetable_list_item' ),
					'js_view'                   => 'VcColumnView',
					'show_settings_on_create'   => true,
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'minimalistic',
							'heading'     => esc_html__('Enable minimalistic style?', 'wellexpo'),
							'value'       => array_flip(wellexpo_select_get_yes_no_select_array(false, false)),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'subtitle',
							'heading'     => esc_html__( 'Subtitle', 'wellexpo' ),
							'dependency'  => array( 'element' => 'minimalistic', 'value' => array( 'no' ) )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'wellexpo' ),
							'dependency'  => array( 'element' => 'minimalistic', 'value' => array( 'no' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_border',
							'heading'     => esc_html__('Enable Border Around List', 'wellexpo'),
							'value'       => array_flip(wellexpo_select_get_yes_no_select_array(false, true)),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'wellexpo' ),
							'value'      => array(
								esc_html__( 'Default', 'wellexpo' ) => '',
								esc_html__( 'Light', 'wellexpo' )    => 'light',
							),
							'dependency'  => array( 'element' => 'minimalistic', 'value' => array( 'yes' ) ),
							'save_always' => true
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
	public function render( $atts, $content = null ) {
		$args   = array(
			'minimalistic'  => 'no',
			'subtitle'      => '',
			'title'         => '',
			'enable_border' => 'yes',
			'skin'          => ''
			
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClass( $params );
		$params['content']        = $content;
		
		ob_start();
		
		wellexpo_select_get_module_template_part( 'shortcodes/timetable-items-list/templates/items-list', 'timetable', '', $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();

		return $html;
	}

	private function getHolderClass( $params ) {
		$classes      = array('qodef-timetable-list');
		
		if( $params['enable_border'] === 'yes' ) {
			$classes[] = 'qodef-tl-has-border';
		}
		
		if( $params['minimalistic'] === 'yes' ) {
			$classes[] = 'qodef-tl-minimalistic';
		}
		
		if( $params['skin'] === 'light' ) {
			$classes[] = 'light';
		}
		
		return $classes;
	}
}