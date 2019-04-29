<?php

class WellExpoSelectClassCustomSvgIconWidget extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_custom_svg_icon_widget',
			esc_html__( 'Predicteria Custom Svg Icon Widget', 'wellexpo' ),
			array( 'description' => esc_html__( 'Add custom svg icons to widget areas', 'wellexpo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textarea',
				'name'  => 'svg_source',
				'title' => esc_html__( 'SVG Source', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'wellexpo' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Target', 'wellexpo' ),
				'options' => wellexpo_select_get_link_target_array()
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
		$holder_classes = array( 'qodef-custom-svg-icon-widget-holder' );
		
		$holder_styles = array();
		if ( isset( $instance['margin'] ) && $instance['margin'] !== '' ) {
			$holder_styles[] = 'margin: ' . $instance['margin'];
		}
		
		$link   = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';

		$icon_holder_html = '<span class="qodef-custom-svg-icon">';
		if ( ! empty( $instance['svg_source'] ) ) {
			$icon_holder_html .= $instance['svg_source'];
		}
		$icon_holder_html .= '</span>';
		?>
		
		<a <?php wellexpo_select_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php echo wellexpo_select_get_inline_style( $holder_styles ); ?>>
			<?php print $icon_holder_html; ?>
		</a>
		<?php
	}
}