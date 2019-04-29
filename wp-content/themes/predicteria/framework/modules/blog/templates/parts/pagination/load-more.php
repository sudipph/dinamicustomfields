<?php if($max_num_pages > 1) { ?>
	<div class="qodef-blog-pag-loading">
		<div class="qodef-blog-pag-bounce1"></div>
		<div class="qodef-blog-pag-bounce2"></div>
		<div class="qodef-blog-pag-bounce3"></div>
	</div>
	<div class="qodef-blog-pag-load-more">
		<?php
			$button_params = array(
				'link' => 'javascript: void(0)',
				'text' => esc_html__( 'Load More', 'wellexpo' )
			);
			
			echo wellexpo_select_return_button_html( $button_params );
		?>
	</div>
<?php }