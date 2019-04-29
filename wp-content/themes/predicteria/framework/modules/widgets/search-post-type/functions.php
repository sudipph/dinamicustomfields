<?php

if ( ! function_exists( 'wellexpo_select_register_search_post_type_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function wellexpo_select_register_search_post_type_widget( $widgets ) {
		$widgets[] = 'WellExpoSelectClassSearchPostType';
		
		return $widgets;
	}
	
	add_filter( 'wellexpo_select_filter_register_widgets', 'wellexpo_select_register_search_post_type_widget' );
}

if ( ! function_exists( 'wellexpo_select_search_post_types' ) ) {
	function wellexpo_select_search_post_types() {
		$user_id = get_current_user_id();
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			wellexpo_select_ajax_status( 'error', esc_html__( 'All fields are empty', 'wellexpo' ) );
		} else {
			$args = array(
				'post_type'      => $_POST['postType'],
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
				's'              => $_POST['term'],
				'posts_per_page' => 5
			);
			
			$html  = '';
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				$html .= '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						$html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					}
				$html              .= '</ul>';
				$json_data['html'] = $html;
				wellexpo_select_ajax_status( 'success', '', $json_data );
			} else {
				$html              .= '<ul>';
					$html              .= '<li>' . esc_html__( 'No posts found.', 'wellexpo' ) . '</li>';
				$html              .= '</ul>';
				$json_data['html'] = $html;
				wellexpo_select_ajax_status( 'success', '', $json_data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_wellexpo_select_search_post_types', 'wellexpo_select_search_post_types' );
    add_action( 'wp_ajax_nopriv_wellexpo_select_search_post_types', 'wellexpo_select_search_post_types' );
}