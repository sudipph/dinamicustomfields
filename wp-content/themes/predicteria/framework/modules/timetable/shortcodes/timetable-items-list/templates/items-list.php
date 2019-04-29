<div <?php wellexpo_select_class_attribute($holder_classes); ?>>
	<div class="qodef-tl-wrapper">
		<div class="qodef-tl-heading">
			<?php if( ! empty($subtitle) ): ?>
				<span class="qodef-tl-subtitle"><?php echo esc_html($subtitle); ?></span>
			<?php endif; ?>
			<?php if( ! empty($title) ): ?>
				<h4 class="qodef-tl-title"><?php echo esc_html($title); ?></h4>
			<?php endif; ?>
		</div>
		<?php echo do_shortcode($content); ?>
	</div>
</div>