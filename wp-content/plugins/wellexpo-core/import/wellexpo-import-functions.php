<?php

if ( ! function_exists( 'wellexpo_core_import_object' ) ) {
	function wellexpo_core_import_object() {
		$wellexpo_core_import_object = new WellExpoCoreImport();
	}
	
	add_action( 'init', 'wellexpo_core_import_object' );
}

if ( ! function_exists( 'wellexpo_core_data_import' ) ) {
	function wellexpo_core_data_import() {
		$importObject = WellExpoCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "wellexpo/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_wellexpo_core_data_import', 'wellexpo_core_data_import' );
}

if ( ! function_exists( 'wellexpo_core_widgets_import' ) ) {
	function wellexpo_core_widgets_import() {
		$importObject = WellExpoCoreImport::getInstance();
		
		$folder = "wellexpo/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_wellexpo_core_widgets_import', 'wellexpo_core_widgets_import' );
}

if ( ! function_exists( 'wellexpo_core_options_import' ) ) {
	function wellexpo_core_options_import() {
		$importObject = WellExpoCoreImport::getInstance();
		
		$folder = "wellexpo/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_wellexpo_core_options_import', 'wellexpo_core_options_import' );
}

if ( ! function_exists( 'wellexpo_core_other_import' ) ) {
	function wellexpo_core_other_import() {
		$importObject = WellExpoCoreImport::getInstance();
		
		$folder = "wellexpo/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );

		$importObject->qodef_update_meta_fields_after_import($folder);
		$importObject->qodef_update_options_after_import($folder);

		if ( wellexpo_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_wellexpo_core_other_import', 'wellexpo_core_other_import' );
}