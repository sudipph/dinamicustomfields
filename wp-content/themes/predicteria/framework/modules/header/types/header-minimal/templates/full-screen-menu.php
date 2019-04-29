<div class="qodef-fullscreen-menu-holder-outer">
	<div class="qodef-fullscreen-menu-holder">
		<div class="qodef-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="qodef-container-inner">
			<?php endif; ?>

			<?php if( ! empty( $tagline ) || ! empty( $title ) ): ?>
				<div class="qodef-fullscreen-menu-top">
					<?php if( ! empty( $tagline ) ): ?>
						<span class="qodef-fullscreen-tagline"><?php echo esc_html('<'); echo esc_html( $tagline ); echo esc_html('/>'); ?></span>
					<?php endif; ?>
					<?php if( ! empty( $title ) ): ?>
						<span class="qodef-fullscreen-title"><?php  echo esc_html( $title ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php //Navigation
				wellexpo_select_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;
			?>

			<?php if( is_active_sidebar( 'fullscreen_menu_bottom_column_1' ) || is_active_sidebar( 'fullscreen_menu_bottom_column_2' )  || is_active_sidebar( 'fullscreen_menu_bottom_column_3' ) ) : ?>
				<div class="qodef-fullscreen-menu-bottom <?php echo ! $fullscreen_menu_in_grid ? 'qodef-full-width-bottom' : ''; ?>">
					<?php if ($fullscreen_menu_in_grid) : ?>
						<div class="qodef-container-inner">
					<?php endif; ?>
					<?php
						if( is_active_sidebar( 'fullscreen_menu_bottom_column_1' ) ) : ?>
							<div class="qodef-fullscreen-below-menu-widget-holder-column-1">
								<?php dynamic_sidebar('fullscreen_menu_bottom_column_1'); ?>
							</div>
						<?php endif;
					?>
					<?php
						if( is_active_sidebar( 'fullscreen_menu_bottom_column_2' ) ) : ?>
							<div class="qodef-fullscreen-below-menu-widget-holder-column-2">
								<?php dynamic_sidebar('fullscreen_menu_bottom_column_2'); ?>
							</div>
						<?php endif;
					?>
					<?php
						if( is_active_sidebar( 'fullscreen_menu_bottom_column_3' ) ) : ?>
							<div class="qodef-fullscreen-below-menu-widget-holder-column-3">
								<?php dynamic_sidebar('fullscreen_menu_bottom_column_3'); ?>
							</div>
						<?php endif;
					?>
					<?php if ($fullscreen_menu_in_grid) : ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>