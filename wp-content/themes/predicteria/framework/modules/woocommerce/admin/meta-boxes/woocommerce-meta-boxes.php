<?php

if ( ! function_exists( 'wellexpo_select_map_woocommerce_meta' ) ) {
	function wellexpo_select_map_woocommerce_meta() {
		
		$woocommerce_meta_box = wellexpo_select_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'wellexpo' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'        => 'qodef_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'wellexpo' ),
				'description' => esc_html__( 'Choose image layout when it appears in Select Product List - Masonry layout shortcode', 'wellexpo' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'wellexpo' ),
					'small'              => esc_html__( 'Small', 'wellexpo' ),
					'large-width'        => esc_html__( 'Large Width', 'wellexpo' ),
					'large-height'       => esc_html__( 'Large Height', 'wellexpo' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'wellexpo' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'wellexpo' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'wellexpo' ),
				'options'       => wellexpo_select_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		wellexpo_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'wellexpo' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'wellexpo_select_action_meta_boxes_map', 'wellexpo_select_map_woocommerce_meta', 99 );
}