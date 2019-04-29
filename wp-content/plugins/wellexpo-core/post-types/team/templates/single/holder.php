<div class="qodef-container">
	<div class="qodef-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if(post_password_required()) {
				echo get_the_password_form();
			} else { ?>
				<div class="qodef-team-single-holder">
					<div class="qodef-grid-row">
						<div <?php echo wellexpo_select_get_content_sidebar_class(); ?>>
							<div class="qodef-team-single-outer">
								<?php

								//load team info
								wellexpo_core_get_cpt_single_module_template_part('templates/single/parts/info', 'team', '', $params);

								//load team events
								wellexpo_core_get_cpt_single_module_template_part('templates/single/parts/events', 'team', '', $params);
								
								//load content
								wellexpo_core_get_cpt_single_module_template_part('templates/single/parts/content', 'team', '', $params);
								?>
							</div>
						</div>
						<?php if($sidebar_layout !== 'no-sidebar') { ?>
							<div <?php echo wellexpo_select_get_sidebar_holder_class(); ?>>
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile;	endif; ?>
	</div>
</div>