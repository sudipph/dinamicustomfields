<div class="qodef-content-fixed <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-content-fixed-inner qodef-grid">
		<span class="qodef-content-fixed-close icon_close"></span>
		<div class="qodef-content-fixed-text-holder">
			<?php if (!empty($title)) { ?>
				<div class="qodef-content-fixed-title"><?php echo  esc_html($title); ?></div>
			<?php } ?>
			<?php if (!empty($text)) { ?>
				<div class="qodef-content-fixed-text"><?php echo wp_kses($text , array('br' => true)); ?></div>
			<?php } ?>
		</div>
		<?php if (!empty($button) && is_array($button) && array_key_exists('enabled', $button) && $button['enabled'] === 'yes') { ?>
			<div class="qodef-content-fixed-btn-holder">
				<?php echo wellexpo_select_get_button_html( array(
					'link'   => array_key_exists( 'url', $button ) ? $button['url'] : '',
					'text'   => array_key_exists( 'text', $button ) ? $button['text'] : 'Go',
					'target' => array_key_exists( 'target', $button ) ? $button['target'] : '_self',
					'type'   => 'solid',
					'size'   => 'large'
				) ); ?>
			</div>
		<?php } ?>

	</div>
</div>