<?php
$day = get_the_time('jS');
$month = get_the_time('M');
$year = get_the_time('Y');
$title = get_the_title();
?>
<div class="qodef-post-date-pattern">
	<span class="qodef-bg-svg">
		<?php echo wellexpo_select_get_dot_svg_image(); ?>
	</span>
    <div class="qodef-post-date-pattern-inner">
        <div itemprop="dateCreated" class="qodef-post-info-date entry-date published updated">
		    <?php if(empty($title) && wellexpo_select_blog_item_has_link()) { ?>
		        <a itemprop="url" href="<?php the_permalink() ?>">
		    <?php } else { ?>
		        <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
		    <?php } ?>

		            <span><?php echo esc_html($month); ?></span>
		            <span><?php echo esc_html($day); ?></span>
		        </a>
		    <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(wellexpo_select_get_page_id()); ?>"/>
		</div>
    </div>
</div>