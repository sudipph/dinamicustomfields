<article class="qodef-item-space <?php echo esc_attr($item_classes) ?>">
	<div class="qodef-mg-content">
		<?php if (has_post_thumbnail()) { ?>
			<div class="qodef-mg-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>
		<div class="qodef-mg-item-outer">
			<div class="qodef-mg-item-inner">
				<div class="qodef-mg-item-content">
					<div class="qodef-mg-item-content-inner">
						<?php if(!empty($item_image)) { ?>
							<img itemprop="image" class="qodef-mg-item-icon" src="<?php echo esc_url($item_image['url'])?>" alt="<?php echo esc_attr($item_image['alt']); ?>" />
						<?php } ?>
						<?php if (!empty($item_title)) { ?>
							<<?php echo esc_attr($item_title_tag); ?> itemprop="name" class="qodef-mg-item-title entry-title">
								<?php if(!empty($item_link)) { ?>
									<a itemprop="url" href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_link_target); ?>">
								<?php } ?>
								<?php echo esc_html($item_title); ?>
								<?php if(!empty($item_link)) { ?>
									</a>
								<?php } ?>
							</<?php echo esc_attr($item_title_tag); ?>>
						<?php } ?>
						<?php if (!empty($item_text)) { ?>
							<p class="qodef-mg-item-text"><?php echo esc_html($item_text); ?></p>
						<?php } ?>
						<?php if(!empty($item_button_label) && !empty($item_link)) {

								$button_params = array(
									'type'         => 'simple',
									'link'         => esc_url($item_link),
									'target'       => esc_attr($item_link_target),
									'text'         => esc_html($item_button_label),
									'custom_class' => 'qodef-mg-item-button'
								);

								echo wellexpo_select_return_button_html( $button_params );

						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
