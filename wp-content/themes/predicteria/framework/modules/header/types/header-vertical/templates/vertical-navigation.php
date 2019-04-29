<?php do_action('wellexpo_select_action_before_top_navigation'); ?>
<div class="qodef-vertical-menu-outer">
	<nav class="qodef-vertical-menu <?php echo esc_attr($opening_class);?>">
		<?php
			wp_nav_menu(array(
				'theme_location'  => 'vertical-navigation',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'fallback_cb'     => 'top_navigation_fallback',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'walker'          => new WellExpoSelectClassTopNavigationWalker()
			));
		?>
	</nav>
</div>
<?php do_action('wellexpo_select_action_after_top_navigation'); ?>