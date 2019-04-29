<div class="qodef-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<?php if (!empty($process_mark_image)) { ?>
		<div class="qodef-pi-image-holder" <?php wellexpo_select_inline_style($process_mark_styles); ?>>
			<?php echo wp_get_attachment_image($process_mark_image, 'full'); ?>
		</div>
	<?php } ?>
	<?php echo wellexpo_select_execute_shortcode('qodef_icon_with_text', $params); ?>
</div>