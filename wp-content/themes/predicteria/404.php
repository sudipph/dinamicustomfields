<?php get_header(); ?>
				<div class="qodef-page-not-found">
					<?php
					$qodef_title_image_404 = wellexpo_select_options()->getOptionValue( '404_page_title_image' );
					$qodef_title_404       = wellexpo_select_options()->getOptionValue( '404_title' );
					$qodef_subtitle_404    = wellexpo_select_options()->getOptionValue( '404_subtitle' );
					$qodef_tagline_404     = wellexpo_select_options()->getOptionValue( '404_tagline' );

					if ( ! empty( $qodef_title_image_404 ) ) { ?>
						<div class="qodef-404-title-image">
							<img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'wellexpo' ); ?>" />
						</div>
					<?php } ?>

					<div class="qodef-404-search-table">
						<div class="qodef-404-search-cell">
							<div class="qodef-404-search-inner">
								<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-404-search-form" method="get">
									<div class="qodef-form-holder">
										<div class="qodef-form-holder-inner">
											<div class="qodef-search-info-top">

												<span class="qodef-404-tagline">
													<?php if ( ! empty( $qodef_tagline_404 ) ) {
														echo esc_html('<'); echo esc_html( $qodef_tagline_404 ); echo esc_html('/>');
													} else {
														echo esc_html('<'); esc_html_e( 'Oooops', 'wellexpo' ); echo esc_html('/>');
													} ?>
												</span>

												<h1 class="qodef-404-title">
													<?php if ( ! empty( $qodef_title_404 ) ) {
														echo esc_html( $qodef_title_404 );
													} else {
														esc_html_e( '404', 'wellexpo' );
													} ?>
												</h1>

												<h3 class="qodef-404-subtitle">
													<?php if ( ! empty( $qodef_subtitle_404 ) ) {
														echo esc_html( $qodef_subtitle_404 );
													} else {
														esc_html_e( 'Page not found', 'wellexpo' );
													} ?>
												</h3>

							                </div>
											<div class="qodef-search-form-inner clearfix">
												<input type="text" placeholder="<?php esc_attr_e( '_Enter Your keyword', 'wellexpo' ); ?>" name="s" class="qodef-search-field" autocomplete="off"/>
												<button type="submit" class="qodef-search-submit qodef-search-submit-icon-pack">
													<?php echo esc_html('<'); esc_html_e( 'Search', 'wellexpo' ); echo esc_html('/>'); ?>
												</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>