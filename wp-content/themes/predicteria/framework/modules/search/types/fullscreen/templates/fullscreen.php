<div class="qodef-fullscreen-search-holder">
	<a <?php wellexpo_select_class_attribute( $search_close_icon_class ); ?> href="javascript:void(0)">
		<?php echo wellexpo_select_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
	</a>
	<div class="qodef-fullscreen-search-table">
		<div class="qodef-fullscreen-search-cell">
			<div class="qodef-fullscreen-search-inner">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-fullscreen-search-form" method="get">
					<div class="qodef-form-holder">
						<div class="qodef-form-holder-inner">
							<div class="qodef-search-info-top">
			                    <span class="qodef-search-tagline"><?php echo esc_html('<'); esc_html_e( 'We_can_help', 'wellexpo' ); echo esc_html('/>'); ?></span>
								<h1 class="qodef-search-title"><?php esc_html_e( 'What are you looking for?', 'wellexpo' ); ?></h1>
			                </div>
							<div class="qodef-search-form-inner clearfix">
								<input type="text" placeholder="<?php esc_attr_e( '_Enter Your keyword', 'wellexpo' ); ?>" name="s" class="qodef-search-field" autocomplete="off"/>
								<button type="submit" <?php wellexpo_select_class_attribute( $search_submit_icon_class ); ?>>
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