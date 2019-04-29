<?php
namespace WEllexpoCore\CPT\Shortcodes\TimetableListItem;

use WellexpoCore\Lib;

class TimetableListItem implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_timetable_list_item';

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
					'name'                      => esc_html__( 'Welexpo Timetable List Item', 'wellexpo' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo' ),
					'icon'                      => 'icon-wpb-a-timetable-list-item extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'qodef_timetable_list' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'wellexpo' )
						),
						array(
							'type'        => 'textarea_html',
							'param_name'  => 'content',
							'heading'     => esc_html__( 'Text', 'wellexpo' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'link',
							'heading'     => esc_html__( 'Custom Link', 'wellexpo' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'link_text',
							'heading'     => esc_html__( 'Custom Link Text', 'wellexpo' ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true ),
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Target', 'wellexpo' ),
							'value'      => array_flip( wellexpo_select_get_link_target_array() ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true )
						)
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
			'title'     => '',
			'link'      => '',
			'link_text' => '',
			'target'    => '_self'
		);
		$params = shortcode_atts( $args, $atts );

		$params['content'] = $content;
		
		ob_start();
		
		wellexpo_select_get_module_template_part( 'shortcodes/timetable-items-list/templates/item', 'timetable', '', $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();

		return $html;
	}
}