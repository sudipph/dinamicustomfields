<?php $has_featured = has_post_thumbnail(); ?>
<?php if ( $has_featured ) { ?>
	<div class="qodef-event-image">
		<span class="qodef-event-type-id">
			<span class="qodef-bg-svg">
				<?php echo wellexpo_select_get_dot_svg_image(); ?>
			</span>
	        <span class="qodef-event-icon-holder">
		        <span class="qodef-event-icon icon_image"></span>
	        </span>
	    </span>
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
<?php } ?>