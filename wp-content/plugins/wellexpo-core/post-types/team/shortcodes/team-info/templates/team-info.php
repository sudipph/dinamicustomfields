<div class="qodef-team-info <?php echo esc_attr($holder_classes); ?>">
    <?php if ($show_image === 'yes' && get_the_post_thumbnail($member_id) !== '') { ?>
        <div class="qodef-team-image">
            <?php echo get_the_post_thumbnail($member_id); ?>
        </div>
    <?php } ?>
	<div class="qodef-team-content">
		<?php if ($show_title === 'yes' && $title !== '') { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-team-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if ($show_excerpt === 'yes' && $excerpt !== '') { ?>
			<div class="qodef-team-excerpt"><?php echo esc_html($excerpt); ?></div>
		<?php } ?>
		<div class="qodef-team-meta">
			<?php if ($show_position === 'yes' && $position !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Position','wellexpo-core'); ?>:</h6>
	                <span class="qodef-team-meta-value"><?php echo esc_html($position); ?></span>
                </div>
			<?php } ?>
			<?php if ($show_birth_date === 'yes' && $birth_date !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Birth Date','wellexpo-core'); ?>:</h6>
	                <span class="qodef-team-meta-value"><?php echo esc_html($birth_date); ?></span>
                </div>
			<?php } ?>
			<?php if ($show_email === 'yes' && $email !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Email','wellexpo-core'); ?>:</h6>
	                <a href="mailto:<?php echo esc_url($email); ?>" class="qodef-team-meta-value"><?php echo esc_html($email); ?></a>
                </div>
			<?php } ?>
			<?php if ($show_twitter === 'yes' && $twitter !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Twitter','wellexpo-core'); ?>:</h6>
	                <a href="<?php echo esc_url($twitter); ?>" target="_blank" class="qodef-team-meta-value"><?php echo esc_html($twitter); ?></a>
                </div>
			<?php } ?>
			<?php if ($show_website === 'yes' && $website !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Website','wellexpo-core'); ?>:</h6>
	                <a href="<?php echo esc_url($website); ?>" target="_blank" class="qodef-team-meta-value"><?php echo esc_html($website); ?></a>
                </div>
			<?php } ?>
			<?php if ($show_phone === 'yes' && $phone !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Phone','wellexpo-core'); ?>:</h6>
	                <span class="qodef-team-meta-value"><?php echo esc_html($phone); ?></span>
                </div>
			<?php } ?>
			<?php if ($show_address === 'yes' && $address !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Address','wellexpo-core'); ?>:</h6>
	                <span class="qodef-team-meta-value"><?php echo esc_html($address); ?></span>
                </div>
			<?php } ?>
			<?php if ($show_interview === 'yes' && $interview !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Interview','wellexpo-core'); ?>:</h6>
					<a href="<?php echo esc_url($interview); ?>" target="_blank" class="qodef-ts-bio-info-value"><?php echo esc_html__('Read the Interview', 'wellexpo-core'); ?></a>
                </div>
			<?php } ?>
			<?php if ($show_resume === 'yes' && $resume !== '') { ?>
				<div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Resume','wellexpo-core'); ?>:</h6>
	                <span class="qodef-team-meta-value">
						<?php echo wellexpo_select_get_button_html(array(
							'link'   => $resume,
							'text'   => 'click to open',
							'type'   => 'simple',
							'size'   => 'small',
							'target' => '_blank'
						)); ?>
	                </span>
                </div>
			<?php } ?>
			<?php if ($show_social === 'yes' && is_array($team_social_icons) && count($team_social_icons)) { ?>
                <div class="qodef-team-meta-section">
                    <h6 class="qodef-team-meta-section-title"><?php esc_html_e('Social','wellexpo-core'); ?>:</h6>
                    <span class="qodef-team-meta-social">
						<?php foreach ($team_social_icons as $team_social_icon) {
							echo wp_kses_post($team_social_icon);
						} ?>
                    </span>
				</div>
			<?php } ?>
		</div>
	</div>
</div>