<div class="qodef-team-list-holder qodef-grid-list qodef-grid-masonry-list qodef-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wellexpo_select_get_inline_attrs($data_attrs); ?>>
	<div class="qodef-tl-inner qodef-outer-space qodef-masonry-list-wrapper <?php echo esc_attr($inner_classes); ?>">
		<div class="qodef-masonry-grid-sizer"></div>
		<div class="qodef-masonry-grid-gutter"></div>
		<?php
		if($query_results->have_posts()):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				
				$params['member_id']         = get_the_ID();
				$params['image']             = get_the_post_thumbnail( $params['member_id'] );
				$params['list_image']        = get_post_meta( $params['member_id'], 'qodef_team_member_list_image', true );
				$params['title']             = get_the_title( $params['member_id'] );
				$params['position']          = get_post_meta( $params['member_id'], 'qodef_team_member_position', true );
				$params['birth_date']        = get_post_meta( $params['member_id'], 'qodef_team_member_birth_date', true );
				$params['email']             = get_post_meta( $params['member_id'], 'qodef_team_member_email', true );
				$params['website']           = get_post_meta( $params['member_id'], 'qodef_team_member_website', true );
				$params['twitter']           = get_post_meta( $params['member_id'], 'qodef_team_member_twitter', true );
				$params['phone']             = get_post_meta( $params['member_id'], 'qodef_team_member_phone', true );
				$params['address']           = get_post_meta( $params['member_id'], 'qodef_team_member_address', true );
				$params['social']            = get_post_meta( $params['member_id'], 'qodef_team_member_social', true );
				$params['resume']            = get_post_meta( $params['member_id'], 'qodef_team_member_resume', true );
				$params['excerpt']           = get_the_excerpt( $params['member_id'] );
				$params['team_social_icons'] = $this_object->getTeamSocialIcons( $params['member_id'] );
				
				echo wellexpo_select_execute_shortcode('qodef_team_member', $params);
			endwhile;
		else:
			esc_html_e( 'Sorry, no posts matched your criteria.', 'wellexpo-core' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
</div>