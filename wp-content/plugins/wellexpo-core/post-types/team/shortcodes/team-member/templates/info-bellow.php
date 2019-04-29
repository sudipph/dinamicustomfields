<div class="qodef-team qodef-item-space <?php echo esc_attr($team_member_layout) ?> <?php echo esc_attr($holder_classes); ?>" data-member-id="<?php echo esc_attr($member_id);?>">
	<div class="qodef-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="qodef-team-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php echo get_the_post_thumbnail($member_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="qodef-team-info">
            <div class="qodef-team-title-holder">
                <h4 itemprop="name" class="qodef-team-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position)) { ?>
                    <h6 class="qodef-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="qodef-team-text">
					<div class="qodef-team-text-inner">
						<div class="qodef-team-description">
							<p itemprop="description" class="qodef-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="qodef-team-social-holder-between">
				<div class="qodef-team-social">
					<div class="qodef-team-social-inner">
						<div class="qodef-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								echo wp_kses_post($team_social_icon);
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>