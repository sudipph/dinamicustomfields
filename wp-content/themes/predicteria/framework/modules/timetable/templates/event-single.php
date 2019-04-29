<div class="qodef-ttevent-single">
	<div class="qodef-ttevent-single-holder">
		<div class="qodef-event-heading">
			<?php wellexpo_select_get_module_template_part('templates/parts/heading', 'timetable', '', ''); ?>
		</div>
		
		<?php if(!empty($subtitle)) : ?>
			<p class="qodef-ttevent-single-subtitle"><?php echo esc_html($subtitle); ?></p>
		<?php endif; ?>
		
		<h3 class="qodef-ttevent-single-title"><?php the_title(); ?></h3>

		<div class="qodef-ttevent-single-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>