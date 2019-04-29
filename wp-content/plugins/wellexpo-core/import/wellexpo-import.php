<?php

if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class WellExpoCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;
	
	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;
	
	/**
	 * @return WellExpoCoreImport
	 */
	public static function getInstance() {
		if ( self::$instance === null ) {
			return new self();
		}
		
		return self::$instance;
	}
	
	public $message = "";
	public $attachments = false;
	
	function __construct() {
		$this->revSliderFolder = 'qodef-rev-sliders';
		$this->importURI       = defined( 'SELECT_PROFILE_SLUG' ) ? 'http://export.' . SELECT_PROFILE_SLUG . '-themes.com/' : '';
		
		add_action( 'admin_menu', array( &$this, 'qodef_admin_import' ) );
		add_action( 'admin_init', array( &$this, 'qodef_register_theme_settings' ) );

	}
	
	function qodef_register_theme_settings() {
		register_setting( 'qodef_options_import_page', 'qodef_options_import' );
	}
	
	public function import_content( $file ) {
		ob_start();
		require_once( WELLEXPO_CORE_ABS_PATH . '/import/class.wordpress-importer.php' );
		$wellexpo_import = new WP_Import();
		set_time_limit( 0 );
		
		$wellexpo_import->fetch_attachments = $this->attachments;
		$returned_value                  = $wellexpo_import->import( $file );
		
		if ( is_wp_error( $returned_value ) ) {
			$this->message = esc_html__( 'An Error Occurred During Import', 'wellexpo-core' );
		} else {
			$this->message = esc_html__( 'Content imported successfully', 'wellexpo-core' );
		}
		
		ob_get_clean();
	}
	
	public function import_widgets( $file, $file2 ) {
		$this->import_custom_sidebars( $file2 );
		$options = $this->file_options( $file );
		
		foreach ( (array) $options['widgets'] as $wellexpo_widget_id => $wellexpo_widget_data ) {
			update_option( 'widget_' . $wellexpo_widget_id, $wellexpo_widget_data );
		}
		
		$this->import_sidebars_widgets( $file );
		$this->message = esc_html__( 'Widgets imported successfully', 'wellexpo-core' );
	}
	
	public function import_sidebars_widgets( $file ) {
		$wellexpo_sidebars = get_option( "sidebars_widgets" );
		unset( $wellexpo_sidebars['array_version'] );
		$data = $this->file_options( $file );
		
		if ( is_array( $data['sidebars'] ) ) {
			$wellexpo_sidebars = array_merge( (array) $wellexpo_sidebars, (array) $data['sidebars'] );
			unset( $wellexpo_sidebars['wp_inactive_widgets'] );
			$wellexpo_sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $wellexpo_sidebars );
			$wellexpo_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets( $wellexpo_sidebars );
		}
	}
	
	public function import_custom_sidebars( $file ) {
		$options = $this->file_options( $file );
		update_option( 'qodef_sidebars', $options );
		$this->message = esc_html__( 'Custom sidebars imported successfully', 'wellexpo-core' );
	}
	
	public function import_options( $file ) {
		$options       = $this->file_options( $file );
		$result        = update_option( 'qodef_options_wellexpo', $options );
		$this->message = esc_html__( 'Options imported successfully', 'wellexpo-core' );
	}
	
	public function import_menus( $file ) {
		global $wpdb;
		$wellexpo_terms_table = $wpdb->prefix . "terms";
		$this->menus_data  = $this->file_options( $file );
		$menu_array        = array();
		
		foreach ( $this->menus_data as $registered_menu => $menu_slug ) {
			$term_rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wellexpo_terms_table where slug=%s", $menu_slug ), ARRAY_A );
			
			if ( isset( $term_rows[0]['term_id'] ) ) {
				$term_id_by_slug = $term_rows[0]['term_id'];
			} else {
				$term_id_by_slug = null;
			}
			
			$menu_array[ $registered_menu ] = $term_id_by_slug;
		}
		
		set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );
	}
	
	public function import_settings_pages( $file ) {
		$pages = $this->file_options( $file );
		
		foreach ( $pages as $wellexpo_page_option => $wellexpo_page_id ) {
			update_option( $wellexpo_page_option, $wellexpo_page_id );
		}
	}
	
	public function rev_sliders() {
		$rev_sldiers = array(
			'home-2.zip',
			'home-2-small-slider.zip',
			'home-3.zip',
			'home-5.zip',
			'home-6.zip',
			'landing-ii.zip',
			'landing-iii.zip',
			'landing-iv.zip',
			'landing-top.zip',
			'landing-v.zip',
			'landing-vi.zip',
			'landing-vii.zip',
			'main-home.zip',
			'Tech-summit-images.zip'
		);

		return $rev_sldiers;
	}
	
	public function create_rev_slider_files( $folder ) {
		$rev_list = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;
		
		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if ( ! is_dir( $upload_dir ) ) {
			mkdir( $upload_dir, 0700 );
			mkdir( $upload_dir . '/' . $folder, 0700 );
		}
		
		foreach ( $rev_list as $rev_slider ) {
			file_put_contents( WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider, file_get_contents( $this->importURI . $folder . '/revslider/' . $rev_slider ) );
		}
	}
	
	public function rev_slider_import( $folder ) {
		$this->create_rev_slider_files( $folder );
		
		$rev_sliders   = $this->rev_sliders();
		$dir_name      = $this->revSliderFolder;
		$absolute_path = __FILE__;
		$path_to_file  = explode( 'wp-content', $absolute_path );
		$path_to_wp    = $path_to_file[0];
		
		require_once( $path_to_wp . '/wp-load.php' );
		require_once( $path_to_wp . '/wp-includes/functions.php' );
		require_once( $path_to_wp . '/wp-admin/includes/file.php' );
		
		$rev_slider_instance = new RevSlider();
		
		foreach ( $rev_sliders as $rev_slider ) {
			$nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
			$rev_slider_instance->importSliderFromPost( true, true, $nf );
		}
	}
	
	public function file_options( $file ) {
		$file_content = $this->qodef_file_contents( $file );
		
		if ( $file_content ) {
			$unserialized_content = unserialize( base64_decode( $file_content ) );
			
			if ( $unserialized_content ) {
				return $unserialized_content;
			}
		}
		
		return false;
	}
	
	function qodef_file_contents( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get( $url );
		$body     = wp_remote_retrieve_body( $response );
		
		return $body;
	}
	
	function qodef_admin_import() {
		if ( wellexpo_core_theme_installed() ) {
			global $wellexpo_select_global_Framework;
			
			$slug           = "_tabimport";
			$this->pagehook = add_submenu_page(
                SELECT_OPTIONS_SLUG,
				esc_html__( 'WellExpo Options - WellExpo Import', 'wellexpo-core' ), // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Import', 'wellexpo-core' ),                     // The text of the menu in the administrator's sidebar
				'administrator',                                          // What roles are able to access the menu
                SELECT_OPTIONS_SLUG . $slug,                  // The ID used to bind submenu items to this menu
				array( $wellexpo_select_global_Framework->getSkin(), 'renderImport' )
			);
			
			add_action( 'admin_print_scripts-' . $this->pagehook, 'wellexpo_select_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $this->pagehook, 'wellexpo_select_enqueue_admin_styles' );
		}
	}
	
	function qodef_update_meta_fields_after_import( $folder ) {
		global $wpdb;
		$url = home_url( '/' );
		
		$demo_url = $this->qodef_import_get_demo_url( $folder );
		
		$images_field_array = wellexpo_select_meta_boxes()->getOptionsByType( 'image' );
		
		if ( ! ( is_array( $images_field_array ) && count( $images_field_array ) > 0 ) ) {
			$images_field_array = array();
		}
		
		foreach ( $images_field_array as $image_field ) {
			
			$meta_values = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '" . $image_field . "'" );
			
			foreach ( $meta_values as $meta_value ) {
				$new_value = $this->qodef_recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );
				
				$wpdb->update(
					$wpdb->postmeta,
					array(
						'meta_value' => $new_value,
					),
					array( 'meta_id' => $meta_value->meta_id )
				);
			}
		}
	}
	
	function qodef_update_options_after_import( $folder ) {
		$url      = home_url( '/' );
		$demo_url = $this->qodef_import_get_demo_url( $folder );
		
		$global_options    = get_option( 'qodef_options_wellexpo' );
		$new_global_values = str_replace( $demo_url, $url, $global_options );
		
		update_option( 'qodef_options_wellexpo', $new_global_values );
	}
	
	function qodef_import_get_demo_url( $folder ) {
		$demo_url = defined( 'SELECT_PROFILE_SLUG' ) ? 'http://' . str_replace( '/', '', $folder ) . '.' . SELECT_PROFILE_SLUG . '-themes.com/' : '';
		
		return $demo_url;
	}
	
	function qodef_recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', 'qodef_recalc_serialized_lengths_callback', $sObject );
		
		return $ret;
	}
	
	function qodef_recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}
}