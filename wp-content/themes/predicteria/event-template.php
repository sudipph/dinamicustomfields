<?php
$qodef_sidebar_layout  = wellexpo_select_sidebar_layout();

get_header();
wellexpo_select_get_title();
get_template_part('slider');
?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('wellexpo_select_action_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="qodef-grid-row">
				<div <?php echo wellexpo_select_get_content_sidebar_class(); ?>>
					<?php
					wellexpo_select_get_tt_event_single_content();
					do_action('wellexpo_select_action_page_after_content');
					?>
				</div>
				<?php if($qodef_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo wellexpo_select_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('wellexpo_select_action_before_container_close'); ?>
</div>
<?php get_footer(); ?>
