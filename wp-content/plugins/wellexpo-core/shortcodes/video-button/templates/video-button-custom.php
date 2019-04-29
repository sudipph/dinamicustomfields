<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'qodef-vb-has-hover-image' : '';
?>
<div class="qodef-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<span class="qodef-video-button-custom-play" <?php echo wellexpo_select_get_inline_style($play_button_styles); ?>>
		<span class="qodef-bg-svg">
			<?php echo wellexpo_select_get_dot_svg_image(); ?>
		</span>
		<a itemprop="url" class="qodef-video-button-custom-play-inner"  href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="arrow_triangle-right_alt2"></span>
		</a>
	</span>
	<div class="qodef-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
</div>