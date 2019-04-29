<div class="qodef-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="qodef-form-holder">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'wellexpo' ); ?>" name="s" class="qodef-search-field" autocomplete="off" />
			<button type="submit" <?php wellexpo_select_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo wellexpo_select_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</button>
		</div>
	</form>
</div>