<div class="qodef-social-share-holder qodef-text">
	<?php if(!empty($title)) { ?>
		<p class="qodef-social-title"><?php echo esc_html($title); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ($networks as $net) {
			echo wp_kses($net, array(
				'li'   => array(
					'class' => true
				),
				'a'    => array(
					'itemprop' => true,
					'class'    => true,
					'href'     => true,
					'target'   => true,
					'onclick'  => true
				),
				'span' => array(
					'class' => true
				)
			));
		} ?>
	</ul>
</div>