<?php

$time_meta  = get_post_meta( get_the_ID(), 'qodef_event_time_meta', true );
$author_meta = get_post_meta( get_the_ID(), 'qodef_event_author_meta', true );
$custom_link_meta  = get_post_meta( get_the_ID(), 'qodef_event_custom_link_meta', true );

if ( ! empty( $time_meta ) || ! empty( $author_meta ) || ! empty( $custom_link_meta ) ) {
		 if ( ! empty( $time_meta ) ) { ?>
			<div class="qodef-eli-info-time">
				<span class="qodef-eli-info-label"><?php echo esc_html( $time_meta ); ?></span>
			</div>
		<?php } ?>
		<?php if ( ! empty( $author_meta ) ) { ?>
			<div class="qodef-eli-info-author">
				<span class="qodef-eli-info-label"><?php echo esc_html( $author_meta ); ?></span>
			</div>
		<?php } ?>
		<?php if ($enable_button === 'yes') { ?>
			<div class="qodef-eli-info-button">
				<span class="qodef-eli-button">
					<?php echo wellexpo_select_get_button_html(array(
						'link' => $custom_link_meta,
						'text' => 'buy now',
						'type' => 'simple',
						'size' => 'medium'
					)); ?>
				</span>
			</div>
<?php } }
