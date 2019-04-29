<div class="qodef-info-slider <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-is-content">
		<div class="qodef-section-title-holder qodef-st-with-animation">
			<div class="qodef-st-inner">
				<?php if(!empty($tagline)) { ?>
					<span class="qodef-st-tagline">
						<?php echo wp_kses($tagline, array('br' => true, 'span' => array('class' => true))); ?>
					</span>
				<?php } ?>
				<?php if(!empty($title)) { ?>
					<div class="qodef-st-title-wrapper">
						<h2 class="qodef-st-title">
							<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
						</h2>
					</div>
				<?php } ?>
				<?php if(!empty($text)) { ?>
					<div class="qodef-st-text-wrapper">
						<p class="qodef-st-text">
							<?php echo wp_kses($text, array('br' => true)); ?>
						</p>
					</div>
				<?php } ?>
				<span class="qodef-bg-svg">
					<?php echo wellexpo_select_get_dot_svg_image('103px', '103px'); ?>
				</span>
			</div>
		</div>
	</div>
	<div class="qodef-is-items">
		<?php if(!empty($slider_items)) { ?>
			<?php $i = 1; ?>
			<?php foreach($slider_items as $item): ?>
				<div class="qodef-is-item" data-index=<?php echo esc_attr($i); ?>>
					<?php if (!empty($item['link'])) { ?>
						<a class="qodef-is-item-link" href="<?php echo esc_url($item['link']) ?>" target="<?php echo esc_attr($item['target']); ?>"></a>
					<?php } ?>
					<img class="qodef-is-item-image" 
						src="<?php echo wp_get_attachment_url($item['image']); ?>" 
						alt="<?php echo get_the_title($item['image']) ?>" />
				</div>
			<?php $i++; ?>
			<?php endforeach; ?>
		<?php } ?>
	</div>
	<?php if ($enable_navigation == 'yes') { ?>
		<div class="qodef-is-nav">
			<?php $j = 1; ?>
			<?php foreach($slider_items as $item): ?>
				<span class="qodef-is-nav-item" data-index=<?php echo esc_attr($j); ?>></span>
				<?php $j++; ?>
			<?php endforeach; ?>
		</div>
	<?php } ?>
</div>