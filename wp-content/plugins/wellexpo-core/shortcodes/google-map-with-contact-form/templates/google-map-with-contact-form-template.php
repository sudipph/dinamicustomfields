<div class="qodef-google-map-with-contact-form-holder <?php echo esc_attr( $holder_classes ); ?>">

	<?php if ( ! empty( $tagline ) || ! empty( $title ) ) { ?>
		<div class="qodef-grid">
			<div class="qodef-contact-form">
				<div class="qodef-contact-form-inner clearfix">
					<div class="qodef-contact-form-info">
						<?php if ( ! empty( $tagline ) ) { ?>
							<span class="qodef-contact-form-tagline">
								<?php echo esc_html( '<' );
								echo wp_kses( $tagline, array( 'br' => true, 'span' => array( 'class' => true ) ) );
								echo esc_html( '/>' ); ?>
							</span>
						<?php } ?>
						<?php if ( ! empty( $title ) ) { ?>
							<h2 class="qodef-contact-form-title">
								<?php echo wp_kses( $title, array( 'br'   => true,
								                                   'span' => array( 'class' => true )
								) ); ?>
							</h2>
						<?php } ?>
					</div>
					<div class="qodef-contact-form-content">
						<?php if ( ! empty( $contact_form ) ) {
							echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form ) . '"]' );
						} ?>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="qodef-contact-form-only">
			<div class="qodef-grid">
				<?php if ( ! empty( $contact_form ) ) {
					echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form ) . '"]' );
				} ?>
			</div>
		</div>
	<?php } ?>

	<div class="qodef-google-map-with-contact-form" id="<?php echo esc_attr( $map_id ); ?>" <?php echo wp_kses( $map_data, array( 'data' ) ); ?>></div>
	<?php if ( $params['snazzy_map_style'] === 'yes' ) { ?>
		<input type="hidden" class="qodef-snazzy-map" value="<?php echo str_replace( '<br />', '', $params['snazzy_map_code'] ); ?>"/>
	<?php } ?>
	<?php if ( $scroll_wheel == 'no' ) { ?>
		<div class="qodef-google-map-with-contact-form-overlay"></div>
	<?php } ?>
</div>
