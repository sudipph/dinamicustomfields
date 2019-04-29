<div class="qodef-team-single-info-holder">
	<span class="qodef-ts-about-title-tagline"><?php echo esc_html__('speaker_info', 'wellexpo-core'); ?></span>
	<h3 class="qodef-ts-about-title"><?php echo esc_html__('About The Speaker', 'wellexpo-core'); ?></h3>
	<div class="qodef-grid-row">
		<div class="qodef-ts-image-holder qodef-grid-col-4">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="qodef-ts-details-holder qodef-grid-col-8">
			<h4 itemprop="name" class="qodef-name entry-title"><?php the_title(); ?></h4>
			<p class="qodef-ts-excerpt">
				<?php echo esc_html( get_the_excerpt() );?>
			</p>
			<div class="qodef-ts-bio-holder">
				<?php if(!empty($email)) { ?>
					<div class="qodef-ts-info-row">
						<span itemprop="email" class="qodef-ts-bio-info"><?php echo esc_html__('Email: ', 'wellexpo-core'); ?></span>
						<a href="mailto:<?php echo esc_url($email); ?>" class="qodef-ts-bio-info-value"><?php echo esc_html($email); ?></a>
					</div>
				<?php } ?>
				<?php if(!empty($twitter)) { ?>
					<div class="qodef-ts-info-row">
						<span class="qodef-ts-bio-info"><?php echo esc_html__('Twitter: ', 'wellexpo-core'); ?></span>
						<a href="<?php echo esc_url($twitter); ?>" target="_blank" class="qodef-ts-bio-info-value"><?php echo esc_html($twitter); ?></a>
					</div>
				<?php } ?>
				<?php if(!empty($website)) { ?>
					<div class="qodef-ts-info-row">
						<span class="qodef-ts-bio-info"><?php echo esc_html__('Website: ', 'wellexpo-core'); ?></span>
						<a href="<?php echo esc_url($website); ?>" target="_blank" class="qodef-ts-bio-info-value"><?php echo esc_html($website); ?></a>
					</div>
				<?php } ?>
				<?php if(!empty($interview)) { ?>
					<div class="qodef-ts-info-row">
						<span class="qodef-ts-bio-info"><?php echo esc_html__('Interview: ', 'wellexpo-core'); ?></span>
						<a href="<?php echo esc_url($interview); ?>" target="_blank" class="qodef-ts-bio-info-value"><?php echo esc_html__('Read the Interview', 'wellexpo-core'); ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>