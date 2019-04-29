<div class="qodef-event-list-holder qodef-grid-list qodef-el-table <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-el-wrapper qodef-outer-space">
		<?php
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				wellexpo_select_get_module_template_part( 'shortcodes/event-list/templates/event-list-item', 'timetable', '', $params );
			endwhile;
		else:
			wellexpo_select_get_module_template_part( 'shortcodes/event-list/templates/posts-not-found', 'timetable', '', $params );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
</div>
