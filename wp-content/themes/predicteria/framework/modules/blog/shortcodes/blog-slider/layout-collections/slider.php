<li class="qodef-blog-slider-item">
    <div class="qodef-blog-slider-item-inner">
        <div class="qodef-item-image">
            <a itemprop="url" href="<?php echo get_permalink(); ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), $image_size); ?>
            </a>
        </div>
        <div class="qodef-item-text-wrapper">
            <div class="qodef-item-text-holder">
                <div class="qodef-item-text-holder-inner">
	                <div class="qodef-bsi-info-top">
	                    <?php
	                    if ( $post_info_category == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
	                    ?>
	                </div>
	                <div class="qodef-bsi-text-main">
	                    <?php wellexpo_select_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	                </div>
	                <div class="qodef-bsi-info-bottom clearfix">
                        <?php
                        if ( $post_info_author == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_date == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
                        ?>
	                </div>
                </div>
            </div>
        </div>
    </div>
</li>