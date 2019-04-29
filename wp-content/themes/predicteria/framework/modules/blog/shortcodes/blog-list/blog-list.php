<?php
namespace WellExpoCore\CPT\Shortcodes\BlogList;

use WellExpoCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_list_category_callback', array( &$this, 'blogCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_list_category_render', array( &$this, 'blogCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Blog List', 'wellexpo' ),
				'base'                      => $this->base,
				'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
				'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo' ),
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'type',
						'heading'     => esc_html__( 'Type', 'wellexpo' ),
						'value'       => array(
							esc_html__( 'Standard', 'wellexpo' )        => 'standard',
							esc_html__( 'Masonry', 'wellexpo' )         => 'masonry',
							esc_html__( 'Masonry - Boxed', 'wellexpo' ) => 'masonry-boxed',
							esc_html__( 'Simple', 'wellexpo' )          => 'simple',
							esc_html__( 'Minimal', 'wellexpo' )         => 'minimal',
							esc_html__( 'Custom', 'wellexpo' )          => 'custom'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__( 'Number of Posts', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'number_of_columns',
						'heading'    => esc_html__( 'Number of Columns', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_number_of_columns_array( true ) ),
						'dependency' => array( 'element' => 'type', 'value' => array( 'standard', 'masonry', 'simple', 'minimal' ) )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'space_between_items',
						'heading'     => esc_html__( 'Space Between Items', 'wellexpo' ),
						'value'       => array_flip( wellexpo_select_get_space_between_items_array() ),
						'save_always' => true,
						'dependency'  => array( 'element' => 'type', 'value'   => array( 'standard', 'masonry', 'simple', 'minimal' ) )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__( 'Order By', 'wellexpo' ),
						'value'       => array_flip( wellexpo_select_get_query_order_by_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__( 'Order', 'wellexpo' ),
						'value'       => array_flip( wellexpo_select_get_query_order_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'Category', 'wellexpo' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__( 'Image Size', 'wellexpo' ),
						'value'      => array(
							esc_html__( 'Original', 'wellexpo' )  => 'full',
							esc_html__( 'Square', 'wellexpo' )    => 'wellexpo_select_image_square',
							esc_html__( 'Landscape', 'wellexpo' ) => 'wellexpo_select_image_landscape',
							esc_html__( 'Portrait', 'wellexpo' )  => 'wellexpo_select_image_portrait',
							esc_html__( 'Thumbnail', 'wellexpo' ) => 'thumbnail',
							esc_html__( 'Medium', 'wellexpo' )    => 'medium',
							esc_html__( 'Large', 'wellexpo' )     => 'large'
						),
						'save_always' => true,
						'dependency'  => Array( 'element' => 'type', 'value' => array( 'standard', 'masonry', 'masonry-boxed', 'custom' ) )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_tag',
						'heading'    => esc_html__( 'Title Tag', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_title_tag( true ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_transform',
						'heading'    => esc_html__( 'Title Text Transform', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_text_transform_array( true ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__( 'Text Length', 'wellexpo' ),
						'description' => esc_html__( 'Number of words', 'wellexpo' ),
						'dependency'  => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry', 'custom' ) ),
						'group'       => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_image',
						'heading'    => esc_html__( 'Enable Post Info Image', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry', 'simple', 'custom' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_author',
						'heading'    => esc_html__( 'Enable Post Info Author', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_date',
						'heading'    => esc_html__( 'Enable Post Info Date', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry', 'custom' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_category',
						'heading'    => esc_html__( 'Enable Post Info Category', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_comments',
						'heading'    => esc_html__( 'Enable Post Info Comments', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_share',
						'heading'    => esc_html__( 'Enable Post Info Share', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_read_more',
						'heading'    => esc_html__( 'Enable Read More Button', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard', 'masonry', 'custom' ) ),
						'group'      => esc_html__( 'Post Info', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'layout',
						'heading'    => esc_html__( 'Layout', 'wellexpo' ),
						'value'      => array(
							esc_html__( 'Default', 'wellexpo' ) => '',
							esc_html__( 'Custom', 'wellexpo' )  => 'custom'
						),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'masonry-boxed' ) ),
						'group'      => esc_html__( 'Additional Features', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_location',
						'heading'    => esc_html__( 'Info Location', 'wellexpo' ),
						'value'      => array(
							esc_html__( 'Default', 'wellexpo' ) => '',
							esc_html__( 'Top', 'wellexpo' )     => 'top'
						),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'masonry-boxed' ) ),
						'group'      => esc_html__( 'Additional Features', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'skin',
						'heading'    => esc_html__( 'Skin', 'wellexpo' ),
						'value'      => array(
							esc_html__( 'Default', 'wellexpo' ) => '',
							esc_html__( 'Dark', 'wellexpo' )    => 'dark'
						),
						'group'      => esc_html__( 'Additional Features', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'pagination_type',
						'heading'    => esc_html__( 'Pagination Type', 'wellexpo' ),
						'value'      => array(
							esc_html__( 'None', 'wellexpo' )            => 'no-pagination',
							esc_html__( 'Standard', 'wellexpo' )        => 'standard-shortcodes',
							esc_html__( 'Load More', 'wellexpo' )       => 'load-more',
							esc_html__( 'Infinite Scroll', 'wellexpo' ) => 'infinite-scroll'
						),
						'group'      => esc_html__( 'Additional Features', 'wellexpo' )
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'background_image_offset_x',
						'heading'    => esc_html__( 'Background Image Left Offset (px)', 'wellexpo' ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard' ) ),
						'group'      => esc_html__( 'Background Settings', 'wellexpo' )
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'background_image_offset_y',
						'heading'    => esc_html__( 'Background Image Top Offset (px)', 'wellexpo' ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard' ) ),
						'group'      => esc_html__( 'Background Settings', 'wellexpo' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'background_image_loading_animation',
						'heading'    => esc_html__( 'Background Image Loading Animation', 'wellexpo' ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'group'      => esc_html__( 'Background Settings', 'wellexpo' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'loading_animation',
						'heading'     => esc_html__( 'Loading Animation', 'wellexpo' ),
						'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry-boxed' ) ),
						'value'      => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
						'group'      => esc_html__( 'Additional Features', 'wellexpo' )
					),
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                        => 'standard',
			'number_of_posts'             => '-1',
			'number_of_columns'           => 'three',
			'space_between_items'         => 'no',
			'category'                    => '',
			'orderby'                     => 'title',
			'order'                       => 'ASC',
			'image_size'                  => 'full',
			'custom_image_width'          => '',
			'custom_image_height'         => '',
			'title_tag'                   => 'h4',
			'title_transform'             => '',
			'excerpt_length'              => '40',
			'post_info_image'             => 'yes',
			'post_info_author'            => 'yes',
			'post_info_date'              => 'yes',
			'post_info_category'          => 'yes',
			'post_info_comments'          => 'no',
			'post_info_share'             => 'no',
			'post_read_more'              => 'no',
			'layout'                      => '',
			'info_location'               => '',
			'skin'                        => '',
			'pagination_type'             => 'no-pagination',
			'background_image_offset_x' => '',
			'background_image_offset_y' => '',
			'background_image_loading_animation' => 'yes',
			'loading_animation'			  => 'yes'
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		if ( $params['type'] === 'custom' ) {
			$params['number_of_columns']   = 'two';
			$params['space_between_items'] = 'huge';
		}

		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;

		$params['background_image_styles'] = $this->getBackgroundImageStyles( $params );
		
		$params['this_object'] = $this;
		
		ob_start();
		
		wellexpo_select_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;
	}
	
	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-bl-' . $params['type'] : 'qodef-bl-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['layout'] ) ? 'qodef-' . esc_attr( $params['layout'] ) . '-layout' : '';
		$holderClasses[] = ! empty( $params['info_location'] ) ? 'qodef-info-' . esc_attr( $params['info_location'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? 'qodef-' . esc_attr( $params['skin'] ) . '-skin' : '';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'qodef-bl-pag-' . $params['pagination_type'] : 'qodef-bl-pag-' . $default_atts['pagination_type'];
		$holderClasses[] = $params['loading_animation'] == 'yes' ? 'qodef-bl-with-animation' : '';
		$holderClasses[] = $params['background_image_loading_animation'] == 'yes' ? 'qodef-bl-with-bgrnd-animation' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	public function getHolderData( $params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( str_replace( ' ', '', $value ) );
			}
		}
		
		return $dataString;
	}
	
	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'wellexpo' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'wellexpo' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}

	private function getBackgroundImageStyles( $params ) {
		$styles = array();

		if ( $params['background_image_offset_x'] !== '' ) {
			$styles[] = 'left: ' . wellexpo_select_filter_px( $params['background_image_offset_x'] ) . 'px';
		}

		if ( $params['background_image_offset_y'] !== '' ) {
			$styles[] = 'top: ' . wellexpo_select_filter_px( $params['background_image_offset_y'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}