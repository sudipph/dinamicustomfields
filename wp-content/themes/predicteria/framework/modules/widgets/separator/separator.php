<?php

class WellExpoSelectClassSeparatorWidget extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_separator_widget',
			esc_html__( 'Predicteria Separator Widget', 'wellexpo' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'wellexpo' ) )
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
					'normal'     => esc_html__( 'Normal', 'wellexpo' ),
					'full-width' => esc_html__( 'Full Width', 'wellexpo' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'wellexpo' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'wellexpo' ),
					'left'   => esc_html__( 'Left', 'wellexpo' ),
					'right'  => esc_html__( 'Right', 'wellexpo' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'wellexpo' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'wellexpo' ),
					'dashed' => esc_html__( 'Dashed', 'wellexpo' ),
					'dotted' => esc_html__( 'Dotted', 'wellexpo' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'wellexpo' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget qodef-separator-widget">';
			echo do_shortcode( "[qodef_separator $params]" ); // XSS OK
		echo '</div>';
	}
}