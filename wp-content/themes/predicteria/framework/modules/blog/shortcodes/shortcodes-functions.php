<?php

if ( ! function_exists( 'wellexpo_select_include_blog_shortcodes' ) ) {
	function wellexpo_select_include_blog_shortcodes() {
		foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( wellexpo_select_core_plugin_installed() ) {
		add_action( 'wellexpo_core_action_include_shortcodes_file', 'wellexpo_select_include_blog_shortcodes' );
	}
}
