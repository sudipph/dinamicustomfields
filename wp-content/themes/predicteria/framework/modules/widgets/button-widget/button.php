<?php

class WellExpoSelectClassButtonWidget extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_button_widget',
			esc_html__( 'Predicteria Button Widget', 'wellexpo' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'wellexpo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'wellexpo' ),
				'options' => array(
					'solid'   => esc_html__( 'Solid', 'wellexpo' ),
					'outline' => esc_html__( 'Outline', 'wellexpo' ),
					'simple'  => esc_html__( 'Simple', 'wellexpo' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'wellexpo' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'wellexpo' ),
					'medium' => esc_html__( 'Medium', 'wellexpo' ),
					'large'  => esc_html__( 'Large', 'wellexpo' ),
					'huge'   => esc_html__( 'Huge', 'wellexpo' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'wellexpo' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'wellexpo' ),
				'default' => esc_html__( 'Button Text', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'wellexpo' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'wellexpo' ),
				'options' => wellexpo_select_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'wellexpo' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'wellexpo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'wellexpo' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'wellexpo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'wellexpo' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'wellexpo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'wellexpo' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'wellexpo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'wellexpo' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'wellexpo' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'wellexpo' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'wellexpo' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget qodef-button-widget">';
			echo do_shortcode( "[qodef_button $params]" ); // XSS OK
		echo '</div>';
	}
}