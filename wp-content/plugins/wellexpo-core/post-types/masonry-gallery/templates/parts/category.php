<div class="qodef-mg-item-category">
	<?php if ($item_categories) {
		echo esc_html('< ');
		$first_item = true;
		foreach ($item_categories as $item_category) {
			if (!$first_item) {
				echo esc_html(', ');
			} else {
				$first_item = false;
			}
			echo esc_html($item_category->name);
		}
		echo esc_html(' />');
	} ?>
</div>