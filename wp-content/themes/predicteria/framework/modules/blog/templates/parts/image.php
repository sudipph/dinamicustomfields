<?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $image_meta ) && wellexpo_select_blog_item_has_link() ? wellexpo_select_get_attachment_id_from_url( $image_meta ) : '';
?>

<?php if ( $has_featured ) { ?>
	<div class="qodef-post-image">
		<?php if ( wellexpo_select_blog_item_has_link() ) { ?>
			<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php } ?>
			<?php
			if ( $image_size != 'custom' ) {
				if ( ! empty( $blog_list_image_id ) ) {
					echo wp_get_attachment_image( $blog_list_image_id, $image_size );
				} else {
					the_post_thumbnail( $image_size );
				}
			} elseif ( $custom_image_width != '' && $custom_image_height != '' ) {
				if ( ! empty( $blog_list_image_id ) ) {
					echo wellexpo_select_generate_thumbnail( $blog_list_image_id, null, $custom_image_width, $custom_image_height );
				} else {
					echo wellexpo_select_generate_thumbnail( get_post_thumbnail_id( get_the_ID() ), null, $custom_image_width, $custom_image_height );
				}
			}
			?>
		<?php if ( wellexpo_select_blog_item_has_link() ) { ?>
			</a>
		<?php } ?>
		<?php do_action('wellexpo_select_action_blog_inside_image_tag')?>
	</div>
<?php } ?>