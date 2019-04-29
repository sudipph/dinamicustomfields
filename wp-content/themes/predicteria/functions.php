<?php
include_once get_template_directory() . '/theme-includes.php';

if ( ! function_exists( 'wellexpo_select_styles' ) ) {
	/**
	 * Function that includes theme's core styles
	 */
	function wellexpo_select_styles() {

        $modules_css_deps_array = apply_filters( 'wellexpo_select_filter_modules_css_deps', array() );

		//include theme's core styles
		wp_enqueue_style( 'wellexpo-select-default-style', SELECT_ROOT . '/style.css' );
		wp_enqueue_style( 'wellexpo-select-modules', SELECT_ASSETS_ROOT . '/css/modules.min.css', $modules_css_deps_array );

		wellexpo_select_icon_collections()->enqueueStyles();

		wp_enqueue_style( 'wp-mediaelement' );

		do_action( 'wellexpo_select_action_enqueue_third_party_styles' );

		//is woocommerce installed?
		if ( wellexpo_select_is_woocommerce_installed() && wellexpo_select_load_woo_assets() ) {
			//include theme's woocommerce styles
			wp_enqueue_style( 'wellexpo-select-woo', SELECT_ASSETS_ROOT . '/css/woocommerce.min.css' );
		}

		if ( wellexpo_select_dashboard_page() ) {
			wp_enqueue_style( 'wellexpo-select-dashboard', SELECT_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/qodef-dashboard.css' );
		}

		//define files after which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = apply_filters( 'wellexpo_select_filter_style_dynamic_deps', array() );

		if ( file_exists( SELECT_ROOT_DIR . '/assets/css/style_dynamic.css' ) && wellexpo_select_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'wellexpo-select-style-dynamic', SELECT_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime( SELECT_ROOT_DIR . '/assets/css/style_dynamic.css' ) ); //it must be included after woocommerce styles so it can override it
		} else if ( file_exists( SELECT_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css' ) && wellexpo_select_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'wellexpo-select-style-dynamic', SELECT_ASSETS_ROOT . '/css/style_dynamic_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css', $style_dynamic_deps_array, filemtime( SELECT_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css' ) ); //it must be included after woocommerce styles so it can override it
		}

		//is responsive option turned on?
		if ( wellexpo_select_is_responsive_on() ) {
			wp_enqueue_style( 'wellexpo-select-modules-responsive', SELECT_ASSETS_ROOT . '/css/modules-responsive.min.css' );

			//is woocommerce installed?
			if ( wellexpo_select_is_woocommerce_installed() && wellexpo_select_load_woo_assets() ) {
				//include theme's woocommerce responsive styles
				wp_enqueue_style( 'wellexpo-select-woo-responsive', SELECT_ASSETS_ROOT . '/css/woocommerce-responsive.min.css' );
			}

			//include proper styles
			if ( file_exists( SELECT_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) && wellexpo_select_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'wellexpo-select-style-dynamic-responsive', SELECT_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime( SELECT_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) );
			} else if ( file_exists( SELECT_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css' ) && wellexpo_select_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'wellexpo-select-style-dynamic-responsive', SELECT_ASSETS_ROOT . '/css/style_dynamic_responsive_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css', array(), filemtime( SELECT_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . wellexpo_select_get_multisite_blog_id() . '.css' ) );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_styles' );
}

if ( ! function_exists( 'wellexpo_select_google_fonts_styles' ) ) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function wellexpo_select_google_fonts_styles() {
		$font_simple_field_array = wellexpo_select_options()->getOptionsByType( 'fontsimple' );
		if ( ! ( is_array( $font_simple_field_array ) && count( $font_simple_field_array ) > 0 ) ) {
			$font_simple_field_array = array();
		}

		$font_field_array = wellexpo_select_options()->getOptionsByType( 'font' );
		if ( ! ( is_array( $font_field_array ) && count( $font_field_array ) > 0 ) ) {
			$font_field_array = array();
		}

		$available_font_options = array_merge( $font_simple_field_array, $font_field_array );

		$google_font_weight_array = wellexpo_select_options()->getOptionValue( 'google_font_weight' );
		if ( ! empty( $google_font_weight_array ) ) {
			$google_font_weight_array = array_slice( wellexpo_select_options()->getOptionValue( 'google_font_weight' ), 1 );
		}

		$font_weight_str = '300,400,400italic,600,700';
		if ( ! empty( $google_font_weight_array ) && $google_font_weight_array !== '' ) {
			$font_weight_str = implode( ',', $google_font_weight_array );
		}

		$google_font_subset_array = wellexpo_select_options()->getOptionValue( 'google_font_subset' );
		if ( ! empty( $google_font_subset_array ) ) {
			$google_font_subset_array = array_slice( wellexpo_select_options()->getOptionValue( 'google_font_subset' ), 1 );
		}

		$font_subset_str = 'latin-ext';
		if ( ! empty( $google_font_subset_array ) && $google_font_subset_array !== '' ) {
			$font_subset_str = implode( ',', $google_font_subset_array );
		}

		//default fonts
		$default_font_family = array(
			'Poppins',
			'Rubik'
		);

		$modified_default_font_family = array();
		foreach ( $default_font_family as $default_font ) {
			$modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
		}

		$default_font_string = implode( '|', $modified_default_font_family );

		//define available font options array
		$fonts_array = array();
		foreach ( $available_font_options as $font_option ) {
			//is font set and not set to default and not empty?
			$font_option_value = wellexpo_select_options()->getOptionValue( $font_option );

			if ( wellexpo_select_is_font_option_valid( $font_option_value ) && ! wellexpo_select_is_native_font( $font_option_value ) ) {
				$font_option_string = $font_option_value . ':' . $font_weight_str;

				if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
					$fonts_array[] = $font_option_string;
				}
			}
		}

		$fonts_array         = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
		$google_fonts_string = implode( '|', $fonts_array );

		$protocol = is_ssl() ? 'https:' : 'http:';

		//is google font option checked anywhere in theme?
		if ( count( $fonts_array ) > 0 ) {

			//include all checked fonts
			$fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
			$fonts_full_list_args = array(
				'family' => urlencode( $fonts_full_list ),
				'subset' => urlencode( $font_subset_str ),
			);

			$wellexpo_select_global_fonts = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'wellexpo-select-google-fonts', esc_url_raw( $wellexpo_select_global_fonts ), array(), '1.0.0' );

		} else {
			//include default google font that theme is using
			$default_fonts_args          = array(
				'family' => urlencode( $default_font_string ),
				'subset' => urlencode( $font_subset_str ),
			);
			$wellexpo_select_global_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'wellexpo-select-google-fonts', esc_url_raw( $wellexpo_select_global_fonts ), array(), '1.0.0' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_google_fonts_styles' );
}

if ( ! function_exists( 'wellexpo_select_scripts' ) ) {
	/**
	 * Function that includes all necessary scripts
	 */
	function wellexpo_select_scripts() {
		global $wp_scripts;

		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'wp-mediaelement' );

		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'appear', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', SELECT_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverIntent.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-plugin', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl-carousel', SELECT_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fluidvids', SELECT_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'perfect-scrollbar', SELECT_ASSETS_ROOT . '/js/modules/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'ScrollToPlugin', SELECT_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'parallax', SELECT_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope', SELECT_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'packery', SELECT_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'geocomplete', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.geocomplete.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'parallax-scroll', SELECT_ASSETS_ROOT . '/js/modules/plugins/jquery.parallax-scroll.js', array('jquery'), false, true );

		wp_enqueue_script( 'custom', SELECT_ASSETS_ROOT . '/js/scripts.js', array('jquery'), false, true );

		do_action( 'wellexpo_select_action_enqueue_third_party_scripts' );

		if ( wellexpo_select_is_woocommerce_installed() ) {
			wp_enqueue_script( 'select2' );
		}

		if ( wellexpo_select_is_page_smooth_scroll_enabled() ) {
			wp_enqueue_script( 'tweenLite', SELECT_ASSETS_ROOT . '/js/modules/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'smoothPageScroll', SELECT_ASSETS_ROOT . '/js/modules/plugins/smoothPageScroll.js', array( 'jquery' ), false, true );
		}

		//include google map api script
		$google_maps_api_key          = wellexpo_select_options()->getOptionValue( 'google_maps_api_key' );
		$google_maps_extensions       = '';
		$google_maps_extensions_array = apply_filters( 'wellexpo_select_filter_google_maps_extensions_array', array() );

		if ( ! empty( $google_maps_extensions_array ) ) {
			$google_maps_extensions .= '&libraries=';
			$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
		}

		if ( ! empty( $google_maps_api_key ) ) {
			wp_enqueue_script( 'wellexpo-select-google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
		}

		wp_enqueue_script( 'wellexpo-select-modules', SELECT_ASSETS_ROOT . '/js/modules.min.js', array( 'jquery' ), false, true );

		if ( wellexpo_select_dashboard_page() ) {
			$dash_array_deps = array(
				'jquery-ui-datepicker',
				'jquery-ui-sortable'
			);

			wp_enqueue_script( 'wellexpo-select-dashboard', SELECT_FRAMEWORK_ADMIN_ASSETS_ROOT . '/js/qodef-dashboard.js', $dash_array_deps, false, true );

			wp_enqueue_script( 'wp-util' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
			wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );

			$colorpicker_l10n = array(
				'clear'         => esc_html__( 'Clear', 'wellexpo' ),
				'defaultString' => esc_html__( 'Default', 'wellexpo' ),
				'pick'          => esc_html__( 'Select Color', 'wellexpo' ),
				'current'       => esc_html__( 'Current Color', 'wellexpo' ),
			);

			wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
		}

		//include comment reply script
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_scripts' );
}

if ( ! function_exists( 'wellexpo_select_theme_setup' ) ) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function wellexpo_select_theme_setup() {
		//add support for feed links
		add_theme_support( 'automatic-feed-links' );

		//add support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );

		//add theme support for post thumbnails
		add_theme_support( 'post-thumbnails' );

		//add theme support for title tag
		add_theme_support( 'title-tag' );

        //add theme support for editor style
        add_editor_style( 'framework/admin/assets/css/editor-style.css' );

		//defined content width variable
		$GLOBALS['content_width'] = apply_filters( 'wellexpo_select_filter_set_content_width', 1100 );

		//define thumbnail sizes
		add_image_size( 'wellexpo_select_image_square', 650, 650, true );
		add_image_size( 'wellexpo_select_image_landscape', 1300, 650, true );
		add_image_size( 'wellexpo_select_image_portrait', 650, 1300, true );
		add_image_size( 'wellexpo_select_image_huge', 1300, 1300, true );

		load_theme_textdomain( 'wellexpo', get_template_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'wellexpo_select_theme_setup' );
}

if ( ! function_exists( 'wellexpo_select_is_responsive_on' ) ) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function wellexpo_select_is_responsive_on() {
		return wellexpo_select_options()->getOptionValue( 'responsiveness' ) !== 'no';
	}
}

if ( ! function_exists( 'wellexpo_select_rgba_color' ) ) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function wellexpo_select_rgba_color( $color, $transparency ) {
		if ( $color !== '' && $transparency !== '' ) {
			$rgba_color = '';

			$rgb_color_array = wellexpo_select_hex2rgb( $color );
			$rgba_color      .= 'rgba(' . implode( ', ', $rgb_color_array ) . ', ' . $transparency . ')';

			return $rgba_color;
		}
	}
}

if ( ! function_exists( 'wellexpo_select_header_meta' ) ) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function wellexpo_select_header_meta() { ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>

	<?php }

	add_action( 'wellexpo_select_action_header_meta', 'wellexpo_select_header_meta' );
}

if ( ! function_exists( 'wellexpo_select_user_scalable_meta' ) ) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to wellexpo_select_action_header_meta action
	 */
	function wellexpo_select_user_scalable_meta() {
		//is responsiveness option is chosen?
		if ( wellexpo_select_is_responsive_on() ) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
		<?php }
	}

	add_action( 'wellexpo_select_action_header_meta', 'wellexpo_select_user_scalable_meta' );
}

if ( ! function_exists( 'wellexpo_select_smooth_page_transitions' ) ) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to wellexpo_select_action_after_body_tag action
	 */
	function wellexpo_select_smooth_page_transitions() {
		$id = wellexpo_select_get_page_id();

		if ( wellexpo_select_get_meta_field_intersect( 'smooth_page_transitions', $id ) === 'yes' && wellexpo_select_get_meta_field_intersect( 'page_transition_preloader', $id ) === 'yes' ) { ?>
			<div class="qodef-smooth-transition-loader qodef-mimic-ajax">
				<div class="qodef-st-loader">
					<?php wellexpo_select_loading_spinners(); ?>
				</div>
			</div>
		<?php }
	}

	add_action( 'wellexpo_select_action_after_body_tag', 'wellexpo_select_smooth_page_transitions', 10 );
}

if ( ! function_exists( 'wellexpo_select_back_to_top_button' ) ) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to wellexpo_select_action_after_wrapper_inner action
	 */
	function wellexpo_select_back_to_top_button() {
		if ( wellexpo_select_options()->getOptionValue( 'show_back_button' ) == 'yes' ) { ?>
			<a id='qodef-back-to-top' href='#'>
                <span class="qodef-icon-stack">
                     <?php wellexpo_select_icon_collections()->getBackToTopIcon( 'font_awesome' ); ?>
                </span>
			</a>
		<?php }
	}

	add_action( 'wellexpo_select_action_after_wrapper_inner', 'wellexpo_select_back_to_top_button', 30 );
}

if ( ! function_exists( 'wellexpo_select_get_page_id' ) ) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see wellexpo_select_is_woocommerce_installed()
	 * @see wellexpo_select_is_woocommerce_shop()
	 */
	function wellexpo_select_get_page_id() {
		if ( wellexpo_select_is_woocommerce_installed() && wellexpo_select_is_woocommerce_shop() ) {
			return wellexpo_select_get_woo_shop_page_id();
		}

		if ( wellexpo_select_is_default_wp_template() ) {
			return - 1;
		}

		return get_queried_object_id();
	}
}

if ( ! function_exists( 'wellexpo_select_get_multisite_blog_id' ) ) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function wellexpo_select_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if ( ! function_exists( 'wellexpo_select_is_default_wp_template' ) ) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function wellexpo_select_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'wellexpo_select_has_shortcode' ) ) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function wellexpo_select_has_shortcode( $shortcode, $content = '' ) {
		$has_shortcode = false;

		if ( $shortcode ) {
			//if content variable isn't past
			if ( $content == '' ) {
				//take content from current post
				$page_id = wellexpo_select_get_page_id();
				if ( ! empty( $page_id ) ) {
					$current_post = get_post( $page_id );

					if ( is_object( $current_post ) && property_exists( $current_post, 'post_content' ) ) {
						$content = $current_post->post_content;
					}
				}
			}

			//does content has shortcode added?
			if( has_shortcode( $content, $shortcode ) ) {
				$has_shortcode = true;
			}
		}

		return $has_shortcode;
	}
}

if ( ! function_exists( 'wellexpo_select_get_unique_page_class' ) ) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * $params int $id is page id
	 * $params bool $allowSingleProductOption
	 * @return string
	 */
	function wellexpo_select_get_unique_page_class( $id, $allowSingleProductOption = false ) {
		$page_class = '';

		if ( wellexpo_select_is_woocommerce_installed() && $allowSingleProductOption ) {

			if ( is_product() ) {
				$id = get_the_ID();
			}
		}

		if ( is_single() ) {
			$page_class = '.postid-' . $id;
		} elseif ( is_home() ) {
			$page_class .= '.home';
		} elseif ( is_archive() || $id === wellexpo_select_get_woo_shop_page_id() ) {
			$page_class .= '.archive';
		} elseif ( is_search() ) {
			$page_class .= '.search';
		} elseif ( is_404() ) {
			$page_class .= '.error404';
		} else {
			$page_class .= '.page-id-' . $id;
		}

		return $page_class;
	}
}

if ( ! function_exists( 'wellexpo_select_page_custom_style' ) ) {
	/**
	 * Function that print custom page style
	 */
	function wellexpo_select_page_custom_style() {
		$style = apply_filters( 'wellexpo_select_filter_add_page_custom_style', $style = '' );

		if ( $style !== '' ) {

			if ( wellexpo_select_is_woocommerce_installed() && wellexpo_select_load_woo_assets() ) {
				wp_add_inline_style( 'wellexpo-select-woo', $style );
			} else {
				wp_add_inline_style( 'wellexpo-select-modules', $style );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_page_custom_style' );
}

if ( ! function_exists( 'wellexpo_select_print_custom_js' ) ) {
	/**
	 * Prints out custom css from theme options
	 */
	function wellexpo_select_print_custom_js() {
		$custom_js = wellexpo_select_options()->getOptionValue( 'custom_js' );

		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'wellexpo-select-modules', $custom_js );
		}
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_print_custom_js' );
}

if ( ! function_exists( 'wellexpo_select_get_global_variables' ) ) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function wellexpo_select_get_global_variables() {
		$global_variables = array();

		$global_variables['qodefAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
		$global_variables['qodefElementAppearAmount'] = -100;
		$global_variables['qodefAjaxUrl']             = esc_url( admin_url( 'admin-ajax.php' ) );
		$global_variables['sliderNavPrevArrow']       = 'ion-ios-arrow-left';
		$global_variables['sliderNavNextArrow']       = 'ion-ios-arrow-right';

		$global_variables = apply_filters( 'wellexpo_select_filter_js_global_variables', $global_variables );

		wp_localize_script( 'wellexpo-select-modules', 'qodefGlobalVars', array(
			'vars' => $global_variables
		) );
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_get_global_variables' );
}

if ( ! function_exists( 'wellexpo_select_per_page_js_variables' ) ) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function wellexpo_select_per_page_js_variables() {
		$per_page_js_vars = apply_filters( 'wellexpo_select_filter_per_page_js_vars', array() );

		wp_localize_script( 'wellexpo-select-modules', 'qodefPerPageVars', array(
			'vars' => $per_page_js_vars
		) );
	}

	add_action( 'wp_enqueue_scripts', 'wellexpo_select_per_page_js_variables' );
}

if ( ! function_exists( 'wellexpo_select_content_elem_style_attr' ) ) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function wellexpo_select_content_elem_style_attr() {
		$styles = apply_filters( 'wellexpo_select_filter_content_elem_style_attr', array() );

		wellexpo_select_inline_style( $styles );
	}
}

if ( ! function_exists( 'wellexpo_select_core_plugin_installed' ) ) {
	/**
	 * Function that checks if Select Core plugin installed
	 * @return bool
	 */
	function wellexpo_select_core_plugin_installed() {
		return defined( 'WELLEXPO_CORE_VERSION' );
	}
}

if ( ! function_exists( 'wellexpo_select_is_woocommerce_installed' ) ) {
	/**
	 * Function that checks if Woocommerce plugin installed
	 * @return bool
	 */
	function wellexpo_select_is_woocommerce_installed() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'wellexpo_select_visual_composer_installed' ) ) {
	/**
	 * Function that checks if Visual Composer plugin installed
	 * @return bool
	 */
	function wellexpo_select_visual_composer_installed() {
		return class_exists( 'WPBakeryVisualComposerAbstract' );
	}
}

if ( ! function_exists( 'wellexpo_select_revolution_slider_installed' ) ) {
	/**
	 * Function that checks if Revolution Slider plugin installed
	 * @return bool
	 */
	function wellexpo_select_revolution_slider_installed() {
		return class_exists( 'RevSliderFront' );
	}
}

if ( ! function_exists( 'wellexpo_select_contact_form_7_installed' ) ) {
	/**
	 * Function that checks if Contact Form 7 plugin installed
	 * @return bool
	 */
	function wellexpo_select_contact_form_7_installed() {
		return defined( 'WPCF7_VERSION' );
	}
}

if ( ! function_exists( 'wellexpo_select_is_wpml_installed' ) ) {
	/**
	 * Function that checks if WPML plugin installed
	 * @return bool
	 */
	function wellexpo_select_is_wpml_installed() {
		return defined( 'ICL_SITEPRESS_VERSION' );
	}
}

if ( ! function_exists( 'wellexpo_select_is_timetable_installed' ) ) {
	/**
	 * Function that checks if Timetable Responsive Schedule plugin is installed
	 * @return bool
	 */
	function wellexpo_select_is_timetable_installed() {
		//checking for this dummy function because plugin doesn't have constant or class
		//that we can hook to. Poorly coded plugin
		return function_exists( 'timetable_load_textdomain' );
	}
}

if ( ! function_exists( 'wellexpo_select_max_image_width_srcset' ) ) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function wellexpo_select_max_image_width_srcset() {
		return 1920;
	}

	add_filter( 'max_srcset_image_width', 'wellexpo_select_max_image_width_srcset' );
}
add_action('agenda_list','agenda_list_function');
function agenda_list_function(){
	    global $post, $wp_meta_boxes;
	$pid = $post->ID;
    $data = get_post_meta($post->ID, 'gallery_data', true);
	?>
	<div class="agenda_outer">
	<div class="agenda_first_block">
		<div class="left">
			<p>OCTOBER 11-12, 2018</p>
			<h2>Summit Agenda</h2>
		</div>
		<div class="right">
			<a class="javascript:void(0);" onclick="download_data_file('<?php echo $pid;?>');">EXPORT AGENDA</a>
		</div>
		
	</div>
	<div class="agenda_tab">
		<ul id="tabs">
		<?php
		$html_content = '';
		
		if(isset($data['organizer_key']) && count($data['organizer_key'])>0){
           foreach($data['organizer_key'] as $key=>$org_key){
		?>
			<li><a id="tab<?php echo $key?>"><?php echo $data['organizer_name'][$org_key]; ?> <p>
			<?php 
			if(isset($data['organizer_date'][$org_key])){
			echo date('M d,Y',strtotime($data['organizer_date'][$org_key]));
			} ?>
			</p></a></li>

			<?php
			if(isset($data['rand_number'][$org_key]) && count($data['rand_number'][$org_key])>0){
				

				$html_content .= '<div class="container1" id="tab'.$key.'C">';

				$html_content .= '<div class="filter_option_current_box sagen search_by_filter_'.$org_key.'" data-id="'.$org_key.'" >';
				$html_content .= '<form name="" class="form_filter_option_current_box">';
				$html_content .= '<input type="hidden" name="action" value="ajax_dynamic_front_checkbox">';
				$html_content .= '<input type="hidden" name="current_key" value="'.$org_key.'">';
				$html_content .= '<input type="hidden" name="post_id" value="'.$pid.'">';
			
				$terms = get_terms( "topic", array(
                            'hide_empty' => 0,
                            'fields'=>'all'
							) );
				if(isset($terms) && count($terms)>0){
					$html_content .= '<div class="term_checkbox_outer">';
					foreach($terms as $trm){
						$html_content .= '<div class="term_checkbox">';
						$html_content .= '<input type="checkbox" class="search_by_checkbox_onclick" name="search_by_term[]" value="'.$trm->term_id.'">';
						$html_content .= $trm->name;
						$html_content .= '</div>';		
					}
					$html_content .= '</div>';
				}	
				$html_content .= '<div class="location_field">';
$html_content .= 'Location :'.wp_dropdown_categories( array( 'taxonomy' => 'place', 'hide_empty' => 0, 'name' => "agenda_location", 'selected' => '', 'orderby' => 'name', 'hierarchical' => 0, 'show_option_none' => '&mdash;Select Place &mdash;','class'=>'search_by_location_with_topic','echo'=>false ) ); 

				//$html_content .= ' <input type="text" name="agenda_location" id="agenda_location" class="search_by_location_with_topic">';
				$html_content .= ' </div>';		
				$html_content .= '</form>';
				$html_content .= '</div>';
				$html_content .= '<div class="filter_option content_search_by_filter_'.$org_key.'" >';

				foreach($data['rand_number'][$org_key] as $rand_number){

                            $string_wout_rand = str_replace('_'.$org_key,"",$rand_number);
                           $desc = get_post_meta( $pid, $rand_number.'_description', true ) ;
						   $time_set = get_post_meta( $pid, $rand_number.'_time_set', true ) ;
						   $time_unset = get_post_meta( $pid, $rand_number.'_time_unset', true ) ;
                           $location = get_post_meta( $pid, $rand_number.'_location', true ) ;
						   $image_name = get_post_meta( $pid, $rand_number.'_image_name', true ) ;
						   $topic_id = get_post_meta( $pid, $rand_number.'_topic_id', true ) ;
						   $session = get_post_meta( $pid, $rand_number.'_session', true ) ;
						   $eventname = get_post_meta( $pid, $rand_number.'_eventname', true ) ;
						   $user_id = get_post_meta( $pid, $rand_number.'_user_id', true ) ;
						   $user_id_array = get_post_meta( $pid, $rand_number.'_user_id_array', true ) ;

						ob_start();

                    ?>

							

							
							<div class="agenda_list_outer">
								<div class="agenda_list_inner">
									<div class="left">
										<ul>
											<li class="a_time"><?php echo $time_set.' - '.$time_unset;?></li>
											<?php 
											if($location!=''){
											$location_tax = get_term_by("id",$location,'place');
											?>
											<li class="a_loction"><?php 
										echo $location_tax->name;
											//echo $location;?></li>
											<?php }?>
											<li class="a_con_logo" style="background:url('<?php echo $image_name;?>') no-repeat 0 0;">
													
											</li>
										</ul>
									</div>
									<div class="right">
										<ul>
											<li class="a_time_r"><?php echo $session;?></li>
											<li class="a_loction_r"><span class="a-location-sp t<?php echo $string_wout_rand ?>" id="t<?php echo $string_wout_rand ?>"><?php echo $eventname;?></span></li>
											<?php if($topic_id!=''){ ?>
											<li class="a_specilist">
											
											<?php 
											$topic = get_term_by('id', $topic_id, 'topic');
											
											echo $topic->name;//$topic_id;?></li>
											<?php } ?>
											<li class="a_con_logo_r">
												<div class="left">
													<?php 
													//var_dump($user_id_array);
													if(isset($user_id_array) && is_array($user_id_array) && count($user_id_array)>0){
														for($i=0;$i<count($user_id_array);$i++){
															$user_id = $user_id_array[$i];
															if(isset($user_id)){
																//echo $user_id;
																$user_info = get_userdata($user_id);
																?>
															<div class="lf1-rit-outer">
																<div class="lf1">
																<?php echo get_avatar( $user_id, 80 ,'','',array('class'=>'aten_img')); ?>
																	
																</div>
																<div class="rit">
																	<p class="a_title"><?php echo (isset($user_info->first_name)?$user_info->first_name:'') .' '.(isset($user_info->last_name)?$user_info->last_name:'');?></p>
																	<p class="a_designation">Principal Advisor & CEO, Radiant Advisors</p>
																<!--	<p class="a_details"><?php echo (isset($user_info->description)?$user_info->description:'');?></p> -->
																	<div class="a-social-link">
																		<span class="link_in_cust" href="#"></span>
																		<span class="twi_ter" href="#"></span>
																	</div>

																</div>
															</div>
															<?php } 
														}	
													}	
														?>
													<div class="a_cs_desc_outer d<?php echo $string_wout_rand?>" id="dt<?php echo $string_wout_rand ?>" style="display:none">
														<p class="a_description">

														<?php echo $desc; ?>
														
														</p>
														<!-- <h2 class="a_de">Key Takeaways</h2>
														<ul>
															<li>How to better Sales effectiveness in Tech business</li>
															<li>How to leverage Marketing for Sales success</li>
															<li>Using metrics to track unified direction</li>
															<li>Clearly identifying vision across the organization</li>
														</ul> -->
													</div>
												</div>

											</li>
										</ul>
									</div>
								</div>
							</div>
							

                       
						<?php
							$html = ob_get_clean();
							$html_content .= $html;
						}
						$html_content .= '</div>';
						$html_content .= '</div>';
					}
					?>

			<?php
		   }
		}
			?>
		</ul>
		<div class="filter-btn-agenda-outer">
			<button class="filter-btn-agenda" id="filter-btn-agenda"> FILTER AGENDA </button>
		</div>
		<?php
		echo $html_content;
		?>
		

	</div>

</div>

	<?php
}

add_action('sponsors_loop','sponsors_function');
function sponsors_function(){
	 global $post, $wp_meta_boxes;
		$data = get_post_meta($post->ID, 'sponsors_key', true);
	    ?>
		<div class="platinum-sponsor-outer">
	<div class="d-exe-header-outer">
		<div class="left">
			<p class="d-about-our">OUR PARTNERS </p>
			<h2 class="d-exe-header">Sponsors</h2>
		</div>
		<div class="right">
			<a class="become-speaker-btn" href="<?php echo site_url(); ?>/sponsor-registration/?pid=<?php echo $post->ID; ?>">BECOME A SPONSOR</a>
		</div>
	</div>
	<div class="d-board-member">
		<p class="d-p-sponsor-title">PLATINUM SPONSORS</p>
		<ul class="platenum-sponsor-slider">
			<?php
			$i = 1;
			if(isset($data) && (is_array($data) && count($data)>0)){
        	    foreach($data as $kk=>$org_key){
				$image_id = get_user_meta( $org_key, 'mycoverimage', true );
				//comany info
                $company_website = get_user_meta( $org_key, 'company_website', true );
                $company_name = get_user_meta( $org_key, 'company_name', true );
                $company_description = get_user_meta( $org_key, 'company_description', true );
                $product_service = get_user_meta( $org_key, 'product_service', true );
                $industries_served = get_user_meta( $org_key, 'industries_served', true );
				$client_include = get_user_meta( $org_key, 'client_include', true );
				$client_designation = get_user_meta( $org_key, 'client_designation', true );
				$client_designation2 = get_user_meta( $org_key, 'client_designation2', true );
				$client_designation3 = get_user_meta( $org_key, 'client_designation3', true );
				$client_testimonial = get_user_meta( $org_key, 'client_testimonial', true );
				$client_testimonial2 = get_user_meta( $org_key, 'client_testimonial2', true );
				$client_testimonial3 = get_user_meta( $org_key, 'client_testimonial3', true );
				//$company_website
                $user_meta=get_userdata($org_key);
                $user_roles=$user_meta->roles;
                if( intval( $image_id ) > 0 ) {
                
                    $image = wp_get_attachment_image( $image_id, array('190', '112'), false, array( 'id' => '','class'=>'' ) );
                    
                } else {
                    $image = '<img id="" class="" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
                }
			?>
			<li>
				<div class="evn-sponsor-listing">
					<?php echo $image;?>
					<a class="d-learn-more" id="p<?php echo $i ?>" href="javascript:void(0);">LEARN MORE</a>
				</div>
				<div class="dmond-pop-up" id="psp<?php echo $i?>" style="display:none">
					<div class="overlay"></div>
					<div class="dmond-pop-up-close">X</div>
					<div class="dimon-sponsor-pop-up">
					    <div class="pop-head-banner-outer">
							<div class="pop-head-banner">
								<div class="img-left">
									<?php echo $image; ?>
								</div>
								<div class="title-and-con-right">
									<div class="spop-title">
										<h2><?php echo $company_name; ?></h2>
									</div>
									<div class="spop-description">
										<p><?php echo $company_description; ?></p>
									</div>
									<div class="pop-website">
										<a href="<?php echo $company_website; ?>" target="_blank">WEBSITE</a>
									</div>
								</div>
							</div>
						</div>
						<div class="pro-indus-clients">
							<div class="ser1">
								<h2>Products & Services</h2>
								<ul class="ser-ul">
								<?php 
								$pro_sers = explode(",",$product_service);
								foreach($pro_sers as $ps )
								{?>
								<li><?php echo $ps; ?></li>
								<?php }?>
								</ul>
							</div>
							<div class="ser2">
								<h2>Industries & Served</h2>
								<ul class="ser-ul">
									<?php 
									$ind_sers = explode(",",$industries_served);
									foreach($ind_sers as $ins )
									{?>
									<li><?php echo $ins; ?></li>
									<?php }?>
								</ul>
							</div>
							<div class="ser3">
								<h2>Clients & Include</h2>
								<ul class="ser-ul">
									<?php 
									$cli_ins = explode(",",$client_include);
									foreach($cli_ins as $cis )
									{?>
									<li><?php echo $cis; ?></li>
									<?php }?>
								</ul>
							</div>
						</div>
						<div class="client_testimonials">
							<h2 class="client_testimonials_heading">Client Testimonials</h2>
							<ul>
							    <?php if($client_testimonial !='' && $client_designation !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation; ?></p>
									</div>
								</li>
								<?php } ?>
								<?php if($client_testimonial2 !='' && $client_designation2 !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial2.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation2; ?></p>
									</div>
								</li>
								<?php } ?>
								<?php if($client_testimonial3 !='' && $client_designation3 !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial3.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation3; ?></p>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</li>
			<?php 
			$i = $i + 1;
				}
			}
			?>
			
			
		</ul>
	</div>
</div>
		<?php
}
add_action('sponsors_loop4','sponsors_function4');
function sponsors_function4(){
	 global $post, $wp_meta_boxes;
		$data = get_post_meta($post->ID, 'dsponsors_key', true);
	    ?>
		<div class="platinum-sponsor-outer">
	
	<div class="d-board-member">
		<p class="d-p-sponsor-title">DIAMOND SPONSORS</p>
		<ul class="platenum-sponsor-slider">
			<?php 
			$i= 1;
			if(isset($data) && (is_array($data) && count($data)>0)){
        	    foreach($data as $kk=>$org_key){
                $image_id = get_user_meta( $org_key, 'mycoverimage', true );
				//comany info
                $company_website = get_user_meta( $org_key, 'company_website', true );
                $company_name = get_user_meta( $org_key, 'company_name', true );
                $company_description = get_user_meta( $org_key, 'company_description', true );
                $product_service = get_user_meta( $org_key, 'product_service', true );
                $industries_served = get_user_meta( $org_key, 'industries_served', true );
				$client_include = get_user_meta( $org_key, 'client_include', true );
				$client_designation = get_user_meta( $org_key, 'client_designation', true );
				$client_designation2 = get_user_meta( $org_key, 'client_designation2', true );
				$client_designation3 = get_user_meta( $org_key, 'client_designation3', true );
				$client_testimonial = get_user_meta( $org_key, 'client_testimonial', true );
				$client_testimonial2 = get_user_meta( $org_key, 'client_testimonial2', true );
				$client_testimonial3 = get_user_meta( $org_key, 'client_testimonial3', true );
				//echo $client_testimonial2;
				//echo $client_designation2;
				//exit;
                $user_meta=get_userdata($org_key);
                $user_roles=$user_meta->roles;
                if( intval( $image_id ) > 0 ) {
                
                    $image = wp_get_attachment_image( $image_id, array('190', '112'), false, array( 'id' => '','class'=>'' ) );
                    
                } else {
                    $image = '<img id="" class="" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
                }
				
			?>
			<li>
				<div class="evn-sponsor-listing">
					<?php echo $image;?>
					<a class="d-learn-more" id="d<?php echo $i ?>" href="javascript:void(0);">LEARN MORE</a>
				</div>
				<div class="dmond-pop-up" id="spd<?php echo $i?>" style="display:none">
					<div class="overlay"></div>
					<div class="dmond-pop-up-close">X</div>
					<div class="dimon-sponsor-pop-up">
					    <div class="pop-head-banner-outer">
							<div class="pop-head-banner">
								<div class="img-left">
									<?php echo $image; ?>
								</div>
								<div class="title-and-con-right">
									<div class="spop-title">
										<h2><?php echo $company_name; ?></h2>
									</div>
									<div class="spop-description">
										<p><?php echo $company_description; ?></p>
									</div>
									<div class="pop-website">
										<a href="<?php echo $company_website; ?>" target="_blank">WEBSITE</a>
									</div>
								</div>
							</div>
						</div>
						<div class="pro-indus-clients">
							<div class="ser1">
								<h2>Products & Services</h2>
								<ul class="ser-ul">
								<?php 
								$pro_sers = explode(",",$product_service);
								foreach($pro_sers as $ps )
								{?>
								<li><?php echo $ps; ?></li>
								<?php }?>
								</ul>
							</div>
							<div class="ser2">
								<h2>Industries & Served</h2>
								<ul class="ser-ul">
									<?php 
									$ind_sers = explode(",",$industries_served);
									foreach($ind_sers as $ins )
									{?>
									<li><?php echo $ins; ?></li>
									<?php }?>
								</ul>
							</div>
							<div class="ser3">
								<h2>Clients & Include</h2>
								<ul class="ser-ul">
									<?php 
									$cli_ins = explode(",",$client_include);
									foreach($cli_ins as $cis )
									{?>
									<li><?php echo $cis; ?></li>
									<?php }?>
								</ul>
							</div>
						</div>
						<div class="client_testimonials">
							<h2 class="client_testimonials_heading">Client Testimonials</h2>
							<ul>
							    <?php if($client_testimonial !='' && $client_designation !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation; ?></p>
									</div>
								</li>
								<?php } ?>
								<?php if($client_testimonial2 !='' && $client_designation2 !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial2.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation2; ?></p>
									</div>
								</li>
								<?php } ?>
								<?php if($client_testimonial3 !='' && $client_designation3 !='') {?>
								<li>
									<div class="client-testimonial-div">
										<p class="client-testimonial-p"><?php echo '"'.$client_testimonial3.'"'; ?></p>
										<p class="client-testimonial-deg"><?php echo '-'.$client_designation3; ?></p>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</li>
			
			<?php 
			  $i = $i + 1;
				}
			}
			?>
			
			
		</ul>
	</div>
</div>
		<?php
}

add_action('attendy_function','register_content',10,1);
function register_content($register){

	?>
	
	  <p class="attendee-head">When attending Predictera’s summits we know it’s all about who you meet and the relationships that are created. We help to provides the right environment with similar industry professionals to make sure you connect with the right people.</p>

	  <div id="attendee-detail">

		<ul id="attendee-list">

			<li>

			<div class="attendee1">

				<p class="attendee1-pic"></p>

				<p class="attendee1-title">Invite-only Attendee list</p>

				<p class="attendee1-details">Our executive summits bring together delegates across several industry verticals, which means that you'll be meeting with your peers. They'll understand your challenges and be able to celebrate  your wins because they're in the same boat.</p>

			</div>

			</li>

			<li>

			<div class="attendee2">

				<p class="attendee2-pic"></p>

				<p class="attendee1-title">Networking Opportunities</p>

				<p class="attendee1-details">Technology leaders need to network with other IT leaders. It's that simple. The summit allows you to catch up with familiar faces and make new, critical business contacts.</p>

			</div>

			</li>

			<li>

			<div class="attendee3">

				<p class="attendee3-pic"></p>

				<p class="attendee1-title">Interactive Sessions</p>

				<p class="attendee1-details">During these small breakouts, ask questions and get the answers you need to determine a successful solution for your organization.</p>

			</div>

			</li>

			<li>

			<div class="attendee4">

				<p class="attendee4-pic"></p>

				<p class="attendee1-title">ROI</p>

				<p class="attendee1-details">At your organization, ROI is expected. The same is true at the Predictera Executive summits. We expect our attendees to achieve ROI, leave the event with new ideas, new solutions and industry contacts.</p>

			</div>

			</li>

			<li>

			<div class="attendee4">

				<p class="attendee5-pic"></p>

				<p class="attendee1-title">Balanced Agenda</p>

				<p class="attendee1-details">The Executive summit agenda balances panel discussions with networking breaks, thought leadership, executive visions and product demos with social networking activities. You won't be overwhelmed. You will be productive.</p>

			</div>

			</li>

			<li>

			<div class="attendee4">

				<p class="attendee6-pic"></p>

				<p class="attendee1-title">15 Minute One-On-Ones</p>

				<p class="attendee1-details">Opportunities with vendors providing a chance to learn more details about their products and services.</p>

			</div>

			</li>

		</ul>

	  </div>

	  <div id="attendee-join">

			<div class="register">

				<span class="reg1">Ready to join our community?</span>

				<span class="reg2"><a href="javascript:void(0)" onClick="register_button('<?php echo $register;?>');">REGISTER</a></span>

			</div>

	  </div>

	  

	<?php
}
add_action('speaker_list','speaker_list_function');
function speaker_list_function(){
	global $post;
			 $gallery_data = get_post_meta($post->ID, 'speakers_key', true);
		$gallery_data_our = get_post_meta($post->ID, 'ospeakers_key', true);

//var_dump($gallery_data);
$user_id = 8;
$pid = $post->ID;			
?>
<div class="executive-board-page">
	<div class="d-exe-header-outer">
		<div class="left">
		<p class="d-about-our">ABOUT OUR</p>
		<h2 class="d-exe-header">Speakers</h2>
		<p class="d-speaker-text">Predictera brings together a global community of C-level executives, Research analysts and decision makers in the fields of AI, Cloud Computing, IoT & VR.</p>
		</div>
		<div class="right">
			<a class="become-speaker-btn test" href="<?php echo site_url(); ?>/speaker-registration/?pid=<?php echo $post->ID; ?>">Become A Speaker</a>
		</div>
	</div>

	<div class="d-board-member">
	    <p class="d-our-keynote">
		<?php 
		//$res = search_agenda_key_by_user_id_and_post_id($user_id,$post->ID);
		//echo '<pre>';
		//var_dump($res);
		//echo '</pre>';
		?>
		Our Keynote Speakers</p>
		<ul class="board-member-slider">
			<?php
			if(is_array($gallery_data) && count($gallery_data)>0){

				foreach($gallery_data as $kk=>$user_id){
					$user_info = get_userdata($user_id);
					if( intval( $user_id ) > 0 ) {
        				$image = '<img src="'.esc_url( get_avatar_url( $user_id,array('size'=>400) ) ).'" class="b-member-img" />';
					} else {
						$image = '<img id="" class="b-member-img" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=400&d=mm&r=g"  />';
					}
			?>
			<li>
				<?php echo $image;?>
				<div class="d-title-deg-outer">
					<p class="b-member-title d-learn-more_dinamic_ajax" data-id="<?php echo $user_id;?>" data-key="<?php echo $pid;?>" data-value="keynote" data-attr="<?php echo $kk;?>" ><?php echo ($user_info->first_name!=''?$user_info->first_name:'');?> 
					<?php echo ($user_info->last_name!=''?$user_info->last_name:'');?>
					</p>
					<!-- <p class="b-member-degignation">
					<?php echo ($user_info->description!=''?$user_info->description:'');?>
					</p> -->
				</div>
			</li>
			
			<?php 
				}
			}?>
			
		</ul>
	</div>


	<div class="d-board-member">
	    <p class="d-our-keynote">Our Speakers</p>
		<ul class="board-member-slider">
			<?php
			if(is_array($gallery_data_our) && count($gallery_data_our)>0){

				foreach($gallery_data_our as $kk=>$user_id){
					$user_info = get_userdata($user_id);
					if( intval( $user_id ) > 0 ) {
        				$image = '<img src="'.esc_url( get_avatar_url( $user_id,array('size'=>400) ) ).'" class="b-member-img" />';
					} else {
						$image = '<img id="" class="b-member-img" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=400&d=mm&r=g"  />';
					}
			?>
			<li>
				<?php echo $image;?>
				<div class="d-title-deg-outer">
					<p class="b-member-title d-learn-more_dinamic_ajax" data-id="<?php echo $user_id;?>" data-key="<?php echo $pid;?>" data-value="our" data-attr="<?php echo $kk;?>" ><?php 
					//echo $user_id;
					echo ($user_info->first_name!=''?$user_info->first_name:'');?> 
					<?php echo ($user_info->last_name!=''?$user_info->last_name:'');?>
					</p>
					<p class="b-member-degignation">
					<?php //echo ($user_info->description!=''?$user_info->description:'');?>
					</p>
				</div>
			</li>
			
			<?php 
				}
			}?>
			
		</ul>
	</div>

</div>
<?php
}
add_action('summit_vanue','summit_vanue_function');
function summit_vanue_function(){
	global $post;
	$pid = $post->ID;
	$venue_image = get_post_meta($pid, 'venue_image', true);
$v_description = get_post_meta($pid, 'v_description', true);
$map_it = get_post_meta($pid, 'map_it', true);
$website = get_post_meta($pid, 'website', true);
$vanue_location = get_post_meta($pid, 'vanue_location', true);


	?>
	<div class="summit-venue-outer">
	<div class="d-exe-header-outer">
		<p class="d-about-our">WHERE</p>
		<h2 class="d-exe-header">Summit Venue</h2>
		<p class="d-exe-header-text">Your full access conference pass includes overnight accommodations, meals and cocktail receptions.</p>
	</div>
	<div class="summit-venue-details">
		<?php if($venue_image!=''){?>
		<div class="left">
			<img src="<?php echo $venue_image;?>" alt="Summit Venue Image"/>
		</div>
		<?php 
		}
		?>
		<div class="right">
			<a class="venue-location" href="#"><?php echo $vanue_location;?></a>
			
			<p class="tx1">
			<?php echo $v_description;?>
			</p>
			
			<div class="rig1">
				<ul>
					<li class="d-map-it">
					<?php if($map_it!=''){?>
					<a href="<?php echo $map_it;?>">MAP IT</a>
					<?php } ?>
					</li>
					<li class="d-venue-website">
					<?php if($website!=''){?>
					<a href="<?php echo $map_it;?>">VENUE WEBSITE</a>
					<?php } ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
	<?php
}

function search_agenda_key_by_user_id_and_post_id($user_id,$post_id=''){
	global $post, $wp_meta_boxes;
	$pid = $post_id;
	$data = get_post_meta($pid, 'gallery_data', true);
	$result = array();
	foreach($data['organizer_key'] as $key=>$org_key){
		$cdate = $data['organizer_name'][$org_key];
		$cevent_date = '';
		if(isset($data['organizer_date'][$org_key])){
			$cevent_date = date('M d,Y',strtotime($data['organizer_date'][$org_key]));
		}
		foreach($data['rand_number'][$org_key] as $k=>$rand_number){
			  $user_id_array = get_post_meta( $pid, $rand_number.'_user_id_array', true ) ;
				if(isset($user_id_array)&& is_array($user_id_array)&&in_array($user_id, $user_id_array)){
					//var_dump($user_id).'----';
					$result[$cdate][$k]['user_id'] = $user_id;
					$desc = get_post_meta( $pid, $rand_number.'_description', true ) ;
					$time_set = get_post_meta( $pid, $rand_number.'_time_set', true ) ;
					$time_unset = get_post_meta( $pid, $rand_number.'_time_unset', true ) ;
					$location = get_post_meta( $pid, $rand_number.'_location', true ) ;
					$image_name = get_post_meta( $pid, $rand_number.'_image_name', true ) ;
					$topic_id = get_post_meta( $pid, $rand_number.'_topic_id', true ) ;
					$session = get_post_meta( $pid, $rand_number.'_session', true ) ;
					$eventname = get_post_meta( $pid, $rand_number.'_eventname', true ) ;
					$result[$cdate][$k]['eventdate'] = $cevent_date;
					
					$result[$cdate][$k]['eventname'] = $eventname;
					$result[$cdate][$k]['session'] = $session;
					$result[$cdate][$k]['location'] = $location;
					$result[$cdate][$k]['description'] = $desc;
					$result[$cdate][$k]['time_set'] = $time_set;	   
					$result[$cdate][$k]['image'] = $image_name;	   
					$result[$cdate][$k]['topic'] = $topic_id;	   
			
					$result[$cdate][$k]['time_unset'] = $time_unset;	   
			
				}		
			  //var_dump( $user_id_array).'----';	 
		}
	}
	return $result;
}

function get_user_info_ajax() {
	
	$user_id = $_REQUEST['user_id'];
	$user_key = $_REQUEST['user_key'];
	$key_index = (int)$_REQUEST['key_index'];
	
	$post_id = $_REQUEST['post_id'];
	$get_data = search_agenda_key_by_user_id_and_post_id($user_id,$post_id);
	$user_info = get_userdata($user_id);
	$first_name = $user_info->first_name;
      $last_name = $user_info->last_name;
	$middle_content = '<div class="pop-head-banner-outer">
						<div class="pop-head-banner">
							<div class="title-and-con-right">
								<div class="spop-title-t">
									<p>Executive Board</hp>
									<h2>'.(isset($first_name)?$first_name:'').' '.(isset($last_name)?$last_name:'').'</h2>
								</div>
								<div class="spop-social-n">
									<ul> 
										<li class="linked-icon-c"><a href=""></a></li>
										<li class="twiter-icon-c"><a href=""></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<div class="pro-indus-clients">
				<div class="ser1-left">
					<p class="more-about">More About</p>
					<h2 class="speake_t">'.(isset($first_name)?$first_name:'').'</h2>
					<div class="speaker-pop-img-text-outer">
						<div class="speaker-pop-img">
							<!--<img src="http://know-it.in/predictera/wp-content/uploads/2019/02/12-1_eventDetail-exec-speaker-detail-copy.jpg" alt="Speaker Image"/>-->
							'.get_avatar( $user_id, 280 ,'','',array('class'=>'aten_img')).'
						</div>
						<p class="speaker-description-pop">
						'.$user_info->description.'
						</p>
					</div>
				</div>
				<div class="ser2-right">
					<h2 class="pop-class-session">Sessions</h2>';
					$i=1;
					foreach($get_data as $key=>$data){
						//var_dump($data);
					$middle_content .= '<div class="pop-class-session-details">
						<div class="day-section-c">
							<h2 class="event-day-c">'.$key.'</h2>
							<p class="event-day-c-text">'.$data[0]['eventdate'].'</p>
						</div>
						<div class="even-timr-c">
							<p class="time-c">'.$data[0]['time_set'].' - '.$data[0]['time_unset'].'</p>
							<p class="location-c">'.$data[0]['location'].'</p>
							<h2 class="l-session">'.$data[0]['session'].'</h2>
							<h2 class="key-note-c">Keynote</h2>
						</div>
						<div class="company-logo-c">';
						if(isset($data[0]['image'])){
						$middle_content .='<img src="'.$data[0]['image'].'" alt="Company Logo"/>';
						}
						$middle_content .='</div>
					</div>';
						break;
						}
			$middle_content .= '</div>';
				$middle_content .= '</div>';
			$next ='';
			$prev ='';
			if($user_key=='our'){
				$gallery_data_our = array_values(get_post_meta($post_id, 'ospeakers_key', true));
					if($key_index==0){
						//endnext
						$prev ='';
						$prev_user = end($gallery_data_our);

						$prev_user_index = count($gallery_data_our)-1;
					}else{
						$prev =$key_index-1;
						$prev_user_index = $prev;
						$prev_user = $gallery_data_our[$prev];
					}
					$prev_user_data = get_userdata($prev_user);
					
					$next = $key_index+1;
					//echo $next;
					//var_dump($gallery_data_our);
					if(array_key_exists($next,$gallery_data_our)){
						$next_user_id_index = $next;
						$next_user = $gallery_data_our[$next];
					}else{
						$next_user_id_index = 0;
						$next_user = $gallery_data_our[0];
					}
					$next_user_data = get_userdata($next_user);
						$middle_content .= '<div class="speaker-next-previous ourspeaker">
							<div class="spaker-previous-div">
								<p class="spaker-previous"><a href="javascript:void(0);" class="b-member-title d-learn-more_dinamic_ajax_close" data-id="'.$prev_user.'" data-key="'.$post_id.'" data-value="our" data-attr="'.$prev_user_index.'">Previous Speaker</a></p>
								<p class="speaker-title-p">'.$prev_user_data->user_login.'</p>
							</div>
							<div class="speaker-next-div">
								<p class="spaker-next"><a href="javascript:void(0);" class="b-member-title d-learn-more_dinamic_ajax_close" data-id="'.$next_user.'" data-key="'.$post_id.'" data-value="our" data-attr="'.$next_user_id_index.'">Next Speaker</a></p>
								<p class="speaker-title-n">'.$next_user_data->user_login.'</p>
							</div>';
				}else{
					 $gallery_data = array_values(get_post_meta($post_id, 'speakers_key', true));
					if($key_index==0){
						//endnext
						$prev ='';
						$prev_user = end($gallery_data);
						$prev_user_index = count($gallery_data)-1;
					}else{
						$prev =$key_index-1;
						$prev_user_index = $prev;
						$prev_user = $gallery_data[$prev];
					}
					$prev_user_data = get_userdata($prev_user);
					$next =$key_index+1;
					
					
					if(array_key_exists($next,$gallery_data)){
						$next_user_id_index = $next;
						$next_user = $gallery_data[$next];
					}else{
						$next_user_id_index = 0;
						$next_user = $gallery_data[0];
					}
					
					$next_user_data = get_userdata($next_user);
					$middle_content .= '<div class="speaker-next-previous">
						<div class="spaker-previous-div">
							<p class="spaker-previous"><a href="javascript:void(0);" class="b-member-title d-learn-more_dinamic_ajax_close" data-id="'.$prev_user.'" data-key="'.$post_id.'" data-value="our" data-attr="'.$prev_user_index.'">Previous Speaker</a></p>
							<p class="speaker-title-p">'.$prev_user_data->user_login.'</p>
						</div>
						<div class="speaker-next-div">
							<p class="spaker-next"><a href="javascript:void(0);" class="b-member-title d-learn-more_dinamic_ajax_close" data-id="'.$next_user.'" data-key="'.$post_id.'" data-value="our" data-attr="'.$next_user_id_index.'">Next Speaker</a></p>
							<p class="speaker-title-n">'.$next_user_data->user_login.'</p>
						</div>';
				}
				
			
			$middle_content .= '</div>';
	//var_dump($get_data);
	echo $middle_content;
	die(0);
}
add_action('wp_ajax_get_user_info_ajax', 'get_user_info_ajax' ); // executed when logged in
add_action('wp_ajax_nopriv_get_user_info_ajax', 'get_user_info_ajax' );

add_action('wp_ajax_get_subcategory_value', 'get_subcategory_value' ); // executed when logged in
add_action('wp_ajax_nopriv_get_subcategory_value', 'get_subcategory_value' );

function get_subcategory_value(){
	if(isset($_REQUEST['parent'])){
		$location = get_term_by('slug', $_REQUEST['parent'], 'location');
	$res['result']= wp_dropdown_categories( array('hierarchical'=>0, 'taxonomy' => 'location', 'hide_empty' => 0, 'name' => "search_city", 'selected' => '', 'orderby' => 'name', 'hierarchical' => 1,'parent' =>$location->term_id, 'show_option_none' => '&mdash;Select State &mdash;','class'=>'search_by_location_city','echo'=>false,'depth'=>0,'child_of'=>0,'value_field'=> 'slug','option_none_value'  => '' ) );
		echo json_encode($res);			
	}
	die();
}
add_action('wp_footer', 'your_function');
function your_function(){
?>
	<div class="dmond-pop-up speaker-popup" id="dinamic_ajax" style="display: none; z-index: 9999;">
		<div class="overlay"></div>
		<div class="dmond-pop-up-close">X</div>
		<div class="dimon-sponsor-pop-up">
			<!--<div class="pop-head-banner-outer">
				<div class="pop-head-banner">
					<div class="title-and-con-right">
						<div class="spop-title-t">
							<p>Executive Board</hp>
							<h2><?php //echo $first_name; ?></h2>
						</div>
						<div class="spop-social-n">
							<ul> 
								<li class="linked-icon-c"><a href=""></a></li>
								<li class="twiter-icon-c"><a href=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->

			<div id="fetch_user_data_with_agenda"></div>
			
		</div>
	</div>
<?php
}

function generate_post_select() {
		$post_type = 'event_listing';
		$select_id = 'event_listing';
        $post_type_object = get_post_type_object($post_type);
        $label = $post_type_object->label;
        $posts = get_posts(array('post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));
        $return = '<span class="wpcf7-form-control-wrap linkedin_url"><select class="wpcf7-form-control wpcf7-text wpcf7-url wpcf7-validates-as-url" name="'. $select_id .'" id="'.$select_id.'">';
        $return .= '<option value = "" >All '.$label.' </option>';
        foreach ($posts as $post) {
            $return .= '<option value="' .$post->ID. '" >'. $post->post_title. '</option>';
        }
		$return .= '</select></span>';
		return $return ;
	}
add_shortcode('dropdown_event','generate_post_select');	
add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

function mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

return $form;
}




function cf7_dynamic_select_do_example1($choices, $args=array()) {
		// this function returns and array of label => value pairs to be used in the select field
		$post_type = 'event_listing';
		$pid= '';
		if(isset($_REQUEST['pid'])&&$_REQUEST['pid']!=''){
			$pid= $_REQUEST['pid'];
		}
		$post_type_object = get_post_type_object($post_type);
        $label = $post_type_object->label;
		$posts = get_posts(array('post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));
		$choices = array('-- Select Event --' => '');
		foreach ($posts as $post) {
			$kt = $post->post_title;
			$choices[$kt] = $post->post_title;
			if($pid==$post->ID){
				$selected = $post->post_title;
			}
            //$return .= '<option value="' .$post->ID. '" >'. $post->post_title. '</option>';
		}
		$choices['default'] = array($selected);
		// $choices = array(
		// 	'-- Make a Selection --' => '',
		// 	'Choice 1' => 'Choice 1',
		// 	'Choice 2' => 'Choice 2',
		// 	'Choice 3' => 'Choice 3',
		// 	'Choice 4' => 'Choice 4',
		// 	'Choice 5' => 'Choice 5',
		// 	'default' => array('Choice 2', 'Choice 3')
		// );
		return $choices;
	} // end function cf7_dynamic_select_do_example1
	add_filter('wpcf7_dynamic_select_example1', 'cf7_dynamic_select_do_example1', 10, 2);
	