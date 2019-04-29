<section class="qodef-side-menu">
	<a <?php wellexpo_select_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo wellexpo_select_get_icon_sources_html( 'side_area', true ); ?>
	</a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
</section>