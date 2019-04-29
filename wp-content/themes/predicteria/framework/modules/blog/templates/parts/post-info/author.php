<?php
$author_id     = get_the_author_meta( 'ID' );
$author_avatar = get_avatar( $author_id, '40' );
$author_url    = get_author_posts_url( $author_id );
?>
<div class="qodef-post-info-author">
	<a itemprop="author" class="qodef-post-info-author-link" href="<?php echo esc_url( $author_url ); ?>">
		<span class="qodef-post-info-author-avatar">
	        <?php echo wellexpo_select_kses_img( $author_avatar ); ?>
	    </span>
	</a>
	<span class="qodef-post-info-author-text"><?php esc_html_e( 'by', 'wellexpo' ); ?></span>
	<a itemprop="author" class="qodef-post-info-author-link" href="<?php echo esc_url( $author_url ); ?>">
		<?php the_author_meta( 'display_name' ) ?>
	</a>
</div>