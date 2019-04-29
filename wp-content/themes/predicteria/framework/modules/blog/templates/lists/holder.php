<div class="qodef-grid-row <?php echo esc_attr($holder_classes); ?>">
	<div <?php echo wellexpo_select_get_content_sidebar_class(); ?>>
		<?php if ( wellexpo_select_options()->getOptionValue( 'show_content_on_standard_blog' ) === 'yes' && $post = get_post() ) { ?>
			<div class="qodef-blog-content-holder"><?php echo apply_filters( 'the_content', $post->post_content ); ?></div>
		<?php } ?>
		<?php wellexpo_select_get_blog_type($blog_type); ?>
	</div>
	<?php if($sidebar_layout !== 'no-sidebar') { ?>
		<div <?php echo wellexpo_select_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>