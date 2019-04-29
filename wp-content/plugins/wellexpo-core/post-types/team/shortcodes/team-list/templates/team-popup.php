<div class="qodef-team-popup">
    <div class="qodef-team-popup-inner">
	    <div class="qodef-team-popup-content">
		    <div class="qodef-team-popup-image-holder">
			    <?php if( ! empty($list_image) ): ?>
				    <?php
				        $image_id = wellexpo_select_get_attachment_id_from_url($list_image);
				    ?>
				    <div class="qodef-team-popup-image qodef-team-popup-image-bgrnd" style="background-image:url(<?php echo esc_url($list_image); ?>)">
					    <!-- <?php echo wp_get_attachment_image($image_id, 'wellexpo_select_landscape'); ?> -->
					    <i class="icon_close qodef-close" aria-hidden="true" <?php wellexpo_select_inline_style($team_main_bckg_color); ?>></i>
				    </div>
			    <?php else: ?>
				    <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
					    <div class="qodef-team-popup-image">
						    <?php echo get_the_post_thumbnail($member_id, 'wellexpo_select_landscape'); ?>
						    <i class="icon_close qodef-close" aria-hidden="true" <?php wellexpo_select_inline_style($team_main_bckg_color); ?>></i>
					    </div>
				    <?php } ?>
			    <?php endif; ?>
			    <div class="qodef-team-popup-info-on-image-holder">
				    <?php if ($position !== '') { ?>
		                <div class="qodef-team-position-holder">
		                    <?php echo esc_html('< '); echo esc_html($position); echo esc_html(' />'); ?>
		                </div>
	                <?php } ?>
				    <div class="qodef-team-title-holder">
	                    <h3 itemprop="name" class="qodef-team-name entry-title">
		                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
	                    </h3>
	                </div>
			    </div>
		    </div>
            <div class="qodef-team-popup-info-holder">
                <?php if (get_the_excerpt($member_id) !== '') { ?>
	                <div class="qodef-team-info-section qodef-excerpt-section">
		                <p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt( $member_id ), 40 ) ); ?></p>
	                </div>
                <?php } ?>
	            <?php if ($twitter !== '') { ?>
                <div class="qodef-team-info-section">
                    <h6 class="qodef-team-info-section-title"><?php esc_html_e('Twitter','wellexpo-core'); ?>:</h6>
	                <a href="<?php echo esc_url($twitter); ?>" class="qodef-team-twitter"><?php echo esc_html($twitter); ?></a>
                </div>
                <?php } ?>
                <?php if ($website !== '') { ?>
                <div class="qodef-team-info-section">
                    <h6 class="qodef-team-info-section-title"><?php esc_html_e('Website','wellexpo-core')?>:</h6>
	                <a href="<?php echo esc_url($website); ?>" class="qodef-team-website"><?php echo esc_html($website); ?></a>
                </div>
                <?php } ?>
            </div>
	    </div>
    </div>
</div>