<div class="qodef-pl-holder qodef-grid-list qodef-grid-masonry-list qodef-disable-bottom-space <?php echo esc_attr( $holder_classes ) ?>">
	<div class="qodef-pl-outer qodef-outer-space qodef-masonry-list-wrapper">
		<div class="qodef-masonry-grid-sizer"></div>
		<div class="qodef-masonry-grid-gutter"></div>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			echo wellexpo_select_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
		endwhile;
		else:
			wellexpo_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>