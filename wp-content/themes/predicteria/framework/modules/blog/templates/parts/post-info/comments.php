<?php if(comments_open()) { ?>
	<div class="qodef-post-info-comments-holder">
		<span class="qodef-post-info-meta-icon icon_comment_alt"></span>
		<a itemprop="url" class="qodef-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0', '1', '%'); ?>
		</a>
	</div>
<?php } ?>