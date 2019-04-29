<?php
get_header();
wellexpo_select_get_title();
do_action('wellexpo_select_action_before_main_content'); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('wellexpo_select_action_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$wellexpo_taxonomy_id = get_queried_object_id();
			$wellexpo_taxonomy = !empty($wellexpo_taxonomy_id) ? get_term_by( 'id', $wellexpo_taxonomy_id, 'team-category' ) : '';
			$wellexpo_taxonomy_slug = !empty($wellexpo_taxonomy) ? $wellexpo_taxonomy->slug : '';
		
			wellexpo_core_get_team_category_list($wellexpo_taxonomy_slug);
		?>
	</div>
	<?php do_action('wellexpo_select_action_before_container_close'); ?>
</div>
<?php get_footer(); ?>
