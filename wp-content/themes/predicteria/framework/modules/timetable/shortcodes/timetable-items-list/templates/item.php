<div class="qodef-timetable-list-item">
	<?php if( ! empty($title) ): ?>
		<span class="qodef-tli-title"><?php echo esc_html($title); ?></span>
	<?php endif; ?>
	<?php if( ! empty($content) ): ?>
		<p class="qodef-tli-content"><?php echo do_shortcode($content); ?></p>
	<?php endif; ?>
	<?php if( ! empty($link) ): ?>
		<a class="qodef-tli-link" itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"><span><?php echo esc_html($link_text); ?></span></a>
	<?php endif; ?>
</div>