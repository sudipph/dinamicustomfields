<div class="qodef-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wellexpo_select_get_inline_style($holder_styles); ?>>
	<div class="qodef-st-inner">
		<?php if(!empty($tagline)) { ?>
			<span class="qodef-st-tagline" <?php echo wellexpo_select_get_inline_style($tagline_styles); ?>>
				<?php echo wp_kses($tagline, array('br' => true, 'span' => array('class' => true))); ?>
			</span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<div class="qodef-st-title-wrapper">
				<<?php echo esc_attr($title_tag); ?> class="qodef-st-title" <?php echo wellexpo_select_get_inline_style($title_styles); ?>>
					<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
				</<?php echo esc_attr($title_tag); ?>>
			</div>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<div class="qodef-st-text-wrapper">
				<<?php echo esc_attr($text_tag); ?> class="qodef-st-text" <?php echo wellexpo_select_get_inline_style($text_styles); ?>>
					<?php echo wp_kses($text, array('br' => true)); ?>
				</<?php echo esc_attr($text_tag); ?>>
			</div>
		<?php } ?>
	</div>
</div>