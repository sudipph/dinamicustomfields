<?php

foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'wellexpo_select_map_blog_meta' ) ) {
	function wellexpo_select_map_blog_meta() {
		$qodef_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$qodef_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'wellexpo' ),
				'name'  => 'blog_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'wellexpo' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'wellexpo' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'wellexpo' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'wellexpo' ),
				'parent'      => $blog_meta_box,
				'options'     => $qodef_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'wellexpo' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'wellexpo' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'wellexpo' ),
					'in-grid'    => esc_html__( 'In Grid', 'wellexpo' ),
					'full-width' => esc_html__( 'Full Width', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'wellexpo' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'wellexpo' ),
				'parent'      => $blog_meta_box,
				'options'     => wellexpo_select_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'wellexpo' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'wellexpo' ),
				'options'     => wellexpo_select_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'wellexpo' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'wellexpo' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'wellexpo' ),
					'fixed'    => esc_html__( 'Fixed', 'wellexpo' ),
					'original' => esc_html__( 'Original', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'wellexpo' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'wellexpo' ),
					'standard'        => esc_html__( 'Standard', 'wellexpo' ),
					'load-more'       => esc_html__( 'Load More', 'wellexpo' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'wellexpo' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'wellexpo' )
				)
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'wellexpo' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'wellexpo' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_list_decoration_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Standard List Decoration Type', 'wellexpo' ),
				'description'   => esc_html__( 'Choose a type of decoration for Standard Blog Lists', 'wellexpo' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''           => esc_html__( 'Default', 'wellexpo' ),
					'left-side'  => esc_html__( 'Left Side', 'wellexpo' ),
					'right-side' => esc_html__( 'Right Side', 'wellexpo' ),
					'none'       => esc_html__( 'None', 'wellexpo' )
				)
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_blog_meta', 30 );
}