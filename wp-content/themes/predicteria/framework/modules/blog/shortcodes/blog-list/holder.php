<div class="qodef-blog-list-holder qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<div class="qodef-bl-wrapper qodef-outer-space">
		<ul class="qodef-blog-list">
			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();
					wellexpo_select_get_module_template_part( 'shortcodes/blog-list/layout-collections/post', 'blog', $type, $params );
				endwhile;
			else:
				wellexpo_select_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;
			
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php wellexpo_select_get_module_template_part( 'templates/parts/pagination/' . $params['pagination_type'], 'blog', '', $params ); ?>
</div>