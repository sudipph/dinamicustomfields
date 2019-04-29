<li class="qodef-bl-item qodef-item-space">
	<div class="qodef-bli-inner">
		<div class="qodef-bli-heading">
	        <?php wellexpo_select_get_module_template_part( 'templates/parts/media', 'blog', '', $params ); ?>
        </div>
        <div class="qodef-bli-text">
            <div class="qodef-bli-text-inner">
	            <div class="qodef-bli-text-inner-2">
	                <div class="qodef-bli-info-top">
	                    <?php
	                    if ( $post_info_category == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
	                    ?>
	                </div>
	                <div class="qodef-bli-text-main">
	                    <?php
	                    wellexpo_select_get_module_template_part( 'templates/parts/title', 'blog', '', $params );
	                    do_action('wellexpo_select_action_single_link_pages');
	                    ?>
	                </div>
	            </div>
            </div>
        </div>
	</div>
</li>