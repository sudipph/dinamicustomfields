<?php
$attachment_meta = wellexpo_select_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

if ( ! empty( $logo_image_dark ) ) {
	$attachment_meta_dark = wellexpo_select_get_attachment_meta_from_url( $logo_image_dark );
	$hwstring_dark        = ! empty( $attachment_meta_dark ) ? image_hwstring( $attachment_meta_dark['width'], $attachment_meta_dark['height'] ) : '';
}

if ( ! empty( $logo_image_light ) ) {
	$attachment_meta_light = wellexpo_select_get_attachment_meta_from_url( $logo_image_light );
	$hwstring_light        = ! empty( $attachment_meta_light ) ? image_hwstring( $attachment_meta_light['width'], $attachment_meta_light['height'] ) : '';
}
?>

<?php do_action( 'wellexpo_select_action_before_site_logo' ); ?>
	
	<div class="qodef-logo-wrapper">
		<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php wellexpo_select_inline_style( $logo_styles ); ?>>
			<img itemprop="image" class="qodef-normal-logo" src="<?php echo esc_url( $logo_image ); ?>" <?php echo wp_kses( $hwstring, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'logo', 'wellexpo' ); ?>"/>
			<?php if ( ! empty( $logo_image_dark ) ) { ?><img itemprop="image" class="qodef-dark-logo" src="<?php echo esc_url( $logo_image_dark ); ?>" <?php echo wp_kses( $hwstring_dark, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'dark logo', 'wellexpo' ); ?>"/><?php } ?>
			<?php if ( ! empty( $logo_image_light ) ) { ?><img itemprop="image" class="qodef-light-logo" src="<?php echo esc_url( $logo_image_light ); ?>" <?php echo wp_kses( $hwstring_light, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'light logo', 'wellexpo' ); ?>"/><?php } ?>
		</a>
	</div>

<?php do_action( 'wellexpo_select_action_after_site_logo' ); ?>