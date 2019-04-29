<?php
$background_image_meta = get_post_meta( get_the_ID(), 'qodef_blog_list_shortcode_background_image_meta', true );
$background_image_id   = ! empty( $background_image_meta ) ? wellexpo_select_get_attachment_id_from_url( $background_image_meta ) : '';
?>
<li class="qodef-bl-item qodef-item-space">
	<div class="qodef-bli-inner">
		<?php if (!empty($background_image_id)) { ?>
			<div class="qodef-bli-background-image-holder" <?php wellexpo_select_inline_style($background_image_styles); ?>>
				<?php echo wp_get_attachment_image($background_image_id, 'full'); ?>
			</div>
		<?php } ?>
		<div class="qodef-bli-heading">
	        <?php if ( $post_info_image == 'yes' ) {
		        wellexpo_select_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
	        } ?>
        </div>
        <div class="qodef-bli-text">
            <div class="qodef-bli-text-inner">
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
                    wellexpo_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params );
		            if ( $post_read_more == 'yes' ) {
			            wellexpo_select_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params );
		            }
                    do_action('wellexpo_select_action_single_link_pages');
                    ?>
                </div>
                <div class="qodef-bli-info-bottom clearfix">
                    <div class="qodef-bli-info-bottom-left">
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
                    <div class="qodef-bli-info-bottom-right">
                        <?php
                        if ( $post_info_share == 'yes' ) {
			                wellexpo_select_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
</li>