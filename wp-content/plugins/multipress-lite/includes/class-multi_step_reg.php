<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/includes
 * @author     
 */
class Multi_step_reg {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Multi_step_reg_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'multi_step_reg';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Multi_step_reg_Loader. Orchestrates the hooks of the plugin.
	 * - Multi_step_reg_i18n. Defines internationalization functionality.
	 * - Multi_step_reg_Admin. Defines all hooks for the admin area.
	 * - Multi_step_reg_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-multi_step_reg-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-multi_step_reg-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-multi_step_reg-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-multi_step_reg-public.php';

		$this->loader = new Multi_step_reg_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Multi_step_reg_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Multi_step_reg_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Multi_step_reg_Admin( $this->get_plugin_name(), $this->get_version() );
		/***
		* Hooks for form builder page.
		****/
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_callback' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );		
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxs' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_msf' );
		//Inserting notification before title
		$this->loader->add_action( 'admin_notices', $plugin_admin , 'add_notification_before_title' );
		/***
		* Hooks for user's profile page.
		****/
		$this->loader->add_action( 'show_user_profile', $plugin_admin, 'msr_show_registration_fields' );
		$this->loader->add_action( 'edit_user_profile', $plugin_admin, 'msr_show_registration_fields' );
		$this->loader->add_action( 'personal_options_update', $plugin_admin, 'msr_show_registration_fields' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'msr_show_registration_fields' );
		/***
		* Hooks for admin response.
		****/
		$this->loader->add_action( 'wp_ajax_action_number_of_fields_to_repeat', $plugin_admin, 'handle_logedin_response' );
		$this->loader->add_action( 'wp_ajax_save_section_form', $plugin_admin, 'handle_logedin_response' );
		$this->loader->add_action( 'wp_ajax_delete_section_form', $plugin_admin, 'handle_logedin_response' );
		$this->loader->add_action( 'profile_update', $plugin_admin, 'msr_profile_update' );		
		/***
		* Enabling the shortcodes on different locations
		****/		
		//To enable shortcodes in any text widget area
		$this->loader->add_filter( 'widget_text',  $plugin_admin , 'shortcode_unautop');
		$this->loader->add_filter( 'widget_text',  $plugin_admin , 'do_shortcode');
		//This enables short codes in excerpts:
		$this->loader->add_filter( 'the_excerpt',  $plugin_admin , 'shortcode_unautop');
		$this->loader->add_filter( 'the_excerpt',  $plugin_admin , 'do_shortcode');
		//This enables use of short codes in your description field for archive pages
		$this->loader->add_filter( 'term_description',  $plugin_admin , 'shortcode_unautop');
		$this->loader->add_filter( 'term_description',  $plugin_admin , 'do_shortcode' );
		//This enables use of short codes in comments:
		$this->loader->add_filter( 'comment_text',  $plugin_admin , 'shortcode_unautop');
		$this->loader->add_filter( 'comment_text', $plugin_admin , 'do_shortcode' );
		/*$this->loader->add_filter( 'manage_users_columns', $plugin_admin, 'add_user_columns' );
		$this->loader->add_filter( 'manage_users_custom_column', $plugin_admin, 'add_user_column_data', 10, 3 );*/
		//Inserting banner image after title.
		//$this->loader->add_filter( 'the_title', $plugin_admin , 'insert_image_before_title',10,2 );
        $this->loader->add_action('admin_notices', $plugin_admin , 'msr_banner_ad');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
	  $plugin_public = new Multi_step_reg_Public( $this->get_plugin_name(), $this->get_version() );
	  $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
	  $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	  $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	  $this->loader->add_action( 'wp', $plugin_public, 'handle_post_response' );
	  $this->loader->add_action( 'wp_footer', $plugin_public, 'handle_alert_messages' );
	  $this->loader->add_action( 'wp_ajax_is_field_exists', $plugin_public, 'is_field_exists' );
	  $this->loader->add_action( 'wp_ajax_nopriv_is_field_exists', $plugin_public, 'is_field_exists' );
	  $this->loader->add_shortcode( 'multi_step_reg', $plugin_public, 'msr_shortcode_callback' );
 	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Multi_step_reg_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}	

}