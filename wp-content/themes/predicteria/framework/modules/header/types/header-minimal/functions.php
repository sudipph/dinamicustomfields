<?php

if ( ! function_exists( 'wellexpo_select_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function wellexpo_select_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'WellExpoSelectNamespace\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'wellexpo_select_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function wellexpo_select_init_register_header_minimal_type() {
		add_filter( 'wellexpo_select_filter_register_header_type_class', 'wellexpo_select_register_header_minimal_type' );
	}
	
	add_action( 'wellexpo_select_action_before_header_function_init', 'wellexpo_select_init_register_header_minimal_type' );
}

if ( ! function_exists( 'wellexpo_select_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function wellexpo_select_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'wellexpo' );
		
		return $menus;
	}
	
	if ( wellexpo_select_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'wellexpo_select_filter_register_headers_menu', 'wellexpo_select_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'wellexpo_select_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function wellexpo_select_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_bottom_column_1',
				'name'          => esc_html__( 'Fullscreen Menu Bottom Column 1', 'wellexpo' ),
				'description'   => esc_html__( 'This widget area is rendered in the first column bellow full screen menu ', 'wellexpo' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-fullscreen-menu-bottom-column-1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="qodef-widget-title">',
				'after_title'   => '</h5>'
			)
		);

		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_bottom_column_2',
				'name'          => esc_html__( 'Fullscreen Menu Bottom Column 2', 'wellexpo' ),
				'description'   => esc_html__( 'This widget area is rendered in the second column bellow full screen menu ', 'wellexpo' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-fullscreen-menu-bottom-column-2 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="qodef-widget-title">',
				'after_title'   => '</h5>'
			)
		);

		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_bottom_column_3',
				'name'          => esc_html__( 'Fullscreen Menu Bottom Column 3', 'wellexpo' ),
				'description'   => esc_html__( 'This widget area is rendered in the third column bellow full screen menu ', 'wellexpo' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-fullscreen-menu-bottom-column-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="qodef-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}

	if ( wellexpo_select_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'wellexpo_select_register_header_minimal_full_screen_menu_widgets' );
	}
}

if ( ! function_exists( 'wellexpo_select_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function wellexpo_select_get_header_minimal_full_screen_menu() {
		$tagline = wellexpo_select_options()->getOptionValue( 'fullscreen_menu_tagline' );
		$title   = wellexpo_select_options()->getOptionValue( 'fullscreen_menu_title' );

		$parameters = array(
			'fullscreen_menu_in_grid' => wellexpo_select_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false,
			'tagline'                 => ! empty( $tagline ) ? $tagline : '',
			'title'                   => ! empty( $title ) ? $title : ''
		);

		wellexpo_select_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}

	if ( wellexpo_select_check_is_header_type_enabled( 'header-minimal', wellexpo_select_get_page_id() ) ) {
		add_action( 'wellexpo_select_action_after_wrapper_inner', 'wellexpo_select_get_header_minimal_full_screen_menu', 10 );
	}
}

if ( ! function_exists( 'wellexpo_select_get_fullscreen_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function wellexpo_select_get_fullscreen_menu_icon_class() {
		$classes = array(
			'qodef-fullscreen-menu-opener'
		);
		
		$classes[] = wellexpo_select_get_icon_sources_class( 'fullscreen_menu', 'qodef-fullscreen-menu-opener' );
		
		return $classes;
	}
}