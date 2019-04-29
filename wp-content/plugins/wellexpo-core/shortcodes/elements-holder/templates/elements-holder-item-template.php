<div class="qodef-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo wellexpo_select_get_inline_attrs($holder_data); ?>>
	<?php if (!empty($link)) { ?>
		<a class="qodef-eh-item-link" href=<?php echo esc_url($link); ?> target=<?php echo esc_attr($link_target); ?>></a>
	<?php } ?>
	<div class="qodef-eh-item-inner">
		<div class="qodef-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo wellexpo_select_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
	<?php if (!empty($background_color) || !empty($background_image)) { ?>
		<div class="qodef-eh-item-background" <?php echo wellexpo_select_get_inline_style($bg_styles); ?>></div>	
	<?php } ?>
</div>