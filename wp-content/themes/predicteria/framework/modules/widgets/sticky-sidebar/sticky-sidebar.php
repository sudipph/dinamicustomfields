<?php
class WellExpoSelectClassStickySidebar extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_sticky_sidebar',
			esc_html__('Predicteria Sticky Sidebar Widget', 'wellexpo'),
			array( 'description' => esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'wellexpo'))
		);
		
		$this->setParams();
	}
	
	protected function setParams() {}
	
	public function widget( $args, $instance ) {
		echo '<div class="widget qodef-widget-sticky-sidebar"></div>';
	}
}
