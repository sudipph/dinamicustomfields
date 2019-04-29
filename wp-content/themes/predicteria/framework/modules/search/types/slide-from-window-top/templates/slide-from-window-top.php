<?php ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="qodef-grid">
	<?php } ?>
		<div class="qodef-search-form-inner">
			<span <?php wellexpo_select_class_attribute( $search_submit_icon_class ); ?>>
	            <?php echo wellexpo_select_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</span>
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'wellexpo' ); ?>" name="s" class="qodef-swt-search-field" autocomplete="off"/>
			<a <?php wellexpo_select_class_attribute( $search_close_icon_class ); ?> href="#">
				<?php echo wellexpo_select_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
			</a>
		</div>
	<?php if ( $search_in_grid ) { ?>
	</div>
	<?php } ?>
</form>