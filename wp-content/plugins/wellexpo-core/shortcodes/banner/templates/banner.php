<div class="qodef-banner-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="qodef-banner-text-holder" <?php echo wellexpo_select_get_inline_style($overlay_styles); ?>>
	    <div class="qodef-banner-text-outer">
		    <div class="qodef-banner-text-inner">
		        <?php if(!empty($subtitle)) { ?>
		            <<?php echo esc_attr($subtitle_tag); ?> class="qodef-banner-subtitle" <?php echo wellexpo_select_get_inline_style($subtitle_styles); ?>>
			            <?php echo esc_html($subtitle); ?>
		            </<?php echo esc_attr($subtitle_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="qodef-banner-title" <?php echo wellexpo_select_get_inline_style($title_styles); ?>>
		                <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
	                </<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
				<?php if(!empty($link) && !empty($link_text)) {

					$button_params = array(
						'type'         => 'simple',
						'link'         => esc_url($link),
						'target'       => esc_attr($target),
						'text'         => esc_html($link_text),
						'custom_class' => 'qodef-banner-link-text'
					);

					echo wellexpo_select_return_button_html( $button_params );

				} ?>
			</div>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="qodef-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>