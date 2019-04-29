<?php

class WellExpoSelectClassRecentPosts extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_recent_posts',
			esc_html__( 'Predicteria Recent Posts', 'wellexpo' ),
			array( 'description' => esc_html__( 'Select recent posts that you would like to display', 'wellexpo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$post_types = apply_filters( 'wellexpo_select_filter_search_post_type_widget_params_post_type', array( 'post' => esc_html__( 'Post', 'wellexpo' ) ) );
		
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'wellexpo' )
			),
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__( 'Widget Title', 'wellexpo' )
            ),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title_bottom_margin',
				'title' => esc_html__( 'Widget Title Bottom Margin (px)', 'wellexpo' )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'post_type',
				'title'       => esc_html__( 'Post Type', 'wellexpo' ),
				'description' => esc_html__( 'Choose post type that you want to be searched for', 'wellexpo' ),
				'options'     => $post_types
			),
            array(
                'type'        => 'dropdown',
                'name'        => 'title_tag',
                'title'       => esc_html__( 'Title Tag', 'wellexpo' ),
                'options'     => wellexpo_select_get_title_tag(true, array('p' => 'p'))
            )
		);
	}
	
	public function widget( $args, $instance ) {
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . wellexpo_select_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}
		
		$widget_title_styles = array();
		if ( isset( $instance['widget_title_bottom_margin'] ) && $instance['widget_title_bottom_margin'] !== '' ) {
			$widget_title_styles[] = 'margin-bottom: ' . wellexpo_select_filter_px( $instance['widget_title_bottom_margin'] ) . 'px';
		}
		
		$type = $instance['post_type'] !== '' ? $instance['post_type'] : 'post';
		
		if ( empty( $instance['title_tag'] ) ) {
			$instance['title_tag'] = 'h6';
		}

        $params = array(
            'post_type'      => $type,
            'post_status'    => 'publish',
            'order'          => 'DESC',
            'orderby'        => 'date',
            'posts_per_page' => 4
        );

        $query = new WP_Query( $params );

        $html = '<div class="widget qodef-recent-post-widget" ' . wellexpo_select_get_inline_style( $widget_styles ) . '>';

        if ( ! empty( $instance['widget_title'] ) ) {
	        if ( ! empty( $widget_title_styles ) ) {
		        $args['before_title'] = wellexpo_select_widget_modified_before_title( $args['before_title'], $widget_title_styles ) ;
	        }
	
	        $html .= wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
        }

        if ( $query->have_posts() ) {
            $html .= '<ul class="qodef-recent-posts">';
            while ( $query->have_posts() ) {
                $query->the_post();
                $html .= '<li class="qodef-rp-item"><a href="' . get_the_permalink() . '"><div class="qodef-rp-image">' . get_the_post_thumbnail(get_the_ID(), array(56, 56)) . '</div><'.$instance['title_tag'].' class="qodef-rp-title">' . get_the_title() . '</'.$instance['title_tag'].'></a></li>';
            }
            $html .= '</ul>';
        }

        else {
            $html .= esc_html__('Sorry, there are no posts matching your criteria', 'wellexpo');
        }

        $html .= '</div>';

        wp_reset_postdata();

        print $html;
    }
}