<?php
namespace WellexpoCore\CPT\Shortcodes\EventList;

use WellExpoCore\Lib;

class EventList implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'qodef_event_list';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Event category filter
		add_filter( 'vc_autocomplete_qodef_event_list_category_callback', array( &$this, 'eventListCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Event category render
		add_filter( 'vc_autocomplete_qodef_event_list_category_render', array( &$this, 'eventListCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Event selected events filter
		add_filter( 'vc_autocomplete_qodef_event_list_selected_events_callback', array( &$this, 'eventListIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Event selected events render
		add_filter( 'vc_autocomplete_qodef_event_list_selected_events_render', array( &$this, 'eventListIdAutocompleteRender', ), 10, 1 ); // Render exact event list. Must return an array (label,value)
	}

	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Event List', 'wellexpo' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by WELLEXPO', 'wellexpo' ),
					'icon'     => 'icon-wpb-event-list extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'wellexpo' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'wellexpo' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_events',
							'heading'    => esc_html__( 'Number of Events', 'wellexpo' )
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
							'heading'     => esc_html__( 'One Category List', 'wellexpo' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'wellexpo' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_events',
							'heading'     => esc_html__( 'Show Only Events with Listed IDs', 'wellexpo' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Enter events ids (leave empty for all)', 'wellexpo' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'wellexpo' ),
							'value'      => array_flip( wellexpo_select_get_title_tag( true ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_button',
							'heading'    => esc_html__( 'Enable Button', 'wellexpo' ),
							'value'      => array_flip( wellexpo_select_get_yes_no_select_array('false', 'true'))
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'number_of_events'    => '-1',
			'orderby'             => 'date',
			'order'               => 'ASC',
			'category'            => '',
			'selected_events'     => '',
			'title_tag'           => 'h5',
			'enable_button'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$query_array   = $this->getQueryArray( $params );
		$query_results = new \WP_Query( $query_array );
		
		$params['query_results']  = $query_results;
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		ob_start();
		
		wellexpo_select_get_module_template_part( 'shortcodes/event-list/templates/event-list-holder', 'timetable', '', $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		if( $params['enable_button'] === 'yes' ) {
			$holderClasses[] = 'qodef-el-has-button';
		}
		
		return implode( ' ', $holderClasses );
	}

	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'events',
			'posts_per_page' => $params['number_of_events'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['events_category'] = $params['category'];
		}
		
		$event_ids = null;
		if ( ! empty( $params['selected_events'] ) ) {
			$event_ids             = explode( ',', $params['selected_events'] );
			$query_array['post__in'] = $event_ids;
		}

		return $query_array;
	}
	
	/**
	 * Filter event categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function eventListCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS event_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'events_category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['event_category_title'] ) > 0 ) ? esc_html__( 'Category', 'wellexpo' ) . ': ' . $value['event_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find event category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function eventListCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get event category
			$event_category = get_term_by( 'slug', $query, 'events_category' );
			if ( is_object( $event_category ) ) {
				
				$event_category_slug  = $event_category->slug;
				$event_category_title = $event_category->name;
				
				$event_category_title_display = '';
				if ( ! empty( $event_category_title ) ) {
					$event_category_title_display = esc_html__( 'Category', 'wellexpo' ) . ': ' . $event_category_title;
				}
				
				$data          = array();
				$data['value'] = $event_category_slug;
				$data['label'] = $event_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter events by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function eventListIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$event_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'events' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $event_id > 0 ? $event_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'wellexpo' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'wellexpo' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find event by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function eventListIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get event
			$event = get_post( (int) $query );
			if ( ! is_wp_error( $event ) ) {
				
				$event_id    = $event->ID;
				$event_title = $event->post_title;
				
				$event_title_display = '';
				if ( ! empty( $event_title ) ) {
					$event_title_display = ' - ' . esc_html__( 'Title', 'wellexpo' ) . ': ' . $event_title;
				}
				
				$event_id_display = esc_html__( 'Id', 'wellexpo' ) . ': ' . $event_id;
				
				$data          = array();
				$data['value'] = $event_id;
				$data['label'] = $event_id_display . $event_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}