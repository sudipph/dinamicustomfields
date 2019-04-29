<div class="<?php echo esc_attr( $blog_classes ) ?> qodef-grid-list qodef-disable-bottom-space qodef-two-columns qodef-huge-space" <?php echo esc_attr( $blog_data_params ) ?>>
	<div class="qodef-blog-holder-inner qodef-outer-space">
		<?php
		if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			wellexpo_select_get_post_format_html( $blog_type );
		endwhile;
		else:
			wellexpo_select_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	<?php wellexpo_select_get_module_template_part( 'templates/parts/pagination/pagination', 'blog', '', $params ); ?>
</div>