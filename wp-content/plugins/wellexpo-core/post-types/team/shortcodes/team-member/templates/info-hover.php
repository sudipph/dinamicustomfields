<div class="qodef-team qodef-item-space <?php echo esc_attr($team_member_layout) ?>" data-member-id="<?php echo esc_attr($member_id);?>">
    <div class="qodef-team-inner">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="qodef-team-image">
                <?php echo get_the_post_thumbnail($member_id); ?>
                <div class="qodef-team-info-tb">
                    <div class="qodef-team-info-tc">
                        <div class="qodef-team-title-holder">
	                        <?php if (!empty($position)) { ?>
		                        <h6 class="qodef-team-position"><?php echo esc_html($position); ?></h6>
	                        <?php } ?>
                            <h3 itemprop="name" class="qodef-team-name entry-title">
                                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                            </h3>
                        </div>
	                    <div class="qodef-team-description-holder">
		                    <?php if ($excerpt_length !== '0' && $excerpt_length !== '' && $enable_excerpt === 'yes') {
			                    $excerpt = ($excerpt_length > 0) ? substr(get_the_excerpt($member_id), 0, intval($excerpt_length)) : get_the_excerpt($member_id);
			                    ?>
			                    <p itemprop="description" class="qodef-team-description"><?php echo esc_html($excerpt); ?></p>
		                    <?php } ?>
	                    </div>
                        <div class="qodef-team-social-holder-between">
                            <div class="qodef-team-social">
                                <div class="qodef-team-social-inner">
                                    <div class="qodef-team-social-wrapp">
                                        <?php foreach($team_social_icons as $team_social_icon) {
                                            echo wp_kses_post($team_social_icon);
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>