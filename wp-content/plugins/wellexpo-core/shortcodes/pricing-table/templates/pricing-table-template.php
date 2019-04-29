<div class="qodef-price-table qodef-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pt-inner" <?php echo wellexpo_select_get_inline_style($holder_styles); ?>>
		<?php if (!empty($image)) { ?>
			<div class="qodef-pt-image-holder">
				<?php if(is_array($image_size) && count($image_size)) : ?>
	                <?php echo wellexpo_select_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
	            <?php else: ?>
					<?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
	            <?php endif; ?>
			</div>
		<?php } ?>
		<div class="qodef-pt-main-holder">
			<div class="qodef-pt-prices">
				<span class="qodef-pt-price" <?php echo wellexpo_select_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<span class="qodef-pt-value" <?php echo wellexpo_select_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
			</div>
			<div class="qodef-pt-text-holder">
				<div class="qodef-pt-title-holder">
					<div class="qodef-pt-title" <?php echo wellexpo_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></div>
					<div class="qodef-pt-mark" <?php echo wellexpo_select_get_inline_style($price_period_styles); ?>><?php echo esc_html('<'); echo esc_html($price_period); echo esc_html('/>'); ?></div>
				</div>
				<div class="qodef-pt-content">
					<?php echo do_shortcode($content); ?>
				</div>
				<?php
				if(!empty($button_text)) { ?>
					<div class="qodef-pt-button">
						<?php echo wellexpo_select_get_button_html(array(
							'link' => $link,
							'text' => $button_text,
							'type' => 'simple'
						)); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>