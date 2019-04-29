<div <?php wellexpo_select_class_attribute( $holder_classes ); ?>>
	<div class="qodef-masonry-elements-item-inner <?php echo esc_attr( $item_class ); ?>" <?php wellexpo_select_inline_style( $holder_style ); ?> <?php echo wellexpo_select_get_inline_attrs( $item_data ); ?>>
		<span class="qodef-masonry-elements-item-background" <?php wellexpo_select_inline_style( $holder_background ); ?>></span>
		<div class="qodef-masonry-elements-item-inner-helper">
			<div class="qodef-masonry-elements-item-inner-tb">
				<div class="qodef-masonry-elements-item-inner-tc" <?php wellexpo_select_inline_style( $inner_style ); ?>>
					<?php echo do_shortcode( $content ); ?>
				</div>
			</div>
		</div>
	</div>
</div>