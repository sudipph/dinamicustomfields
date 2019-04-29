<div class="qodef-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-testimonials qodef-owl-slider" <?php echo wellexpo_select_get_inline_attrs( $data_attr ) ?>>

        <?php if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'qodef_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'qodef_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'qodef_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'qodef_testimonial_author_position', true );
                $current_id = get_the_ID();
        ?>

                <div class="qodef-testimonial-contentb testi_custom" id="qodef-testimonial-<?php echo esc_attr( $current_id ) ?>">
				
					<div class="qodef-testimonial-text-holder">
                        <?php if ( ! empty( $text ) ) { ?>
                            <p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
                        <?php } ?>
					<!--	<span class="qodef-testimonial-type-id">
		                    <span class="qodef-bg-svg">
								<?php echo wellexpo_select_get_dot_svg_image(); ?>
							</span>
					        <span class="qodef-testimonial-icon-holder">
						        <span class="qodef-testimonial-icon">“</span>
					        </span>
					    </span> -->
                        
                    </div>
					
                    <div class="qodef-testimonial-heading">
	                    <?php if ( has_post_thumbnail() ) { ?>
                            <div class="qodef-testimonial-image">
                                <?php echo get_the_post_thumbnail( get_the_ID(), array( 114, 114 ) ); ?>
                            </div>
                        <?php } ?>
	                    
						<?php if ( ! empty( $author ) ) { ?>
                            <div class="qodef-testimonial-author-holder clearfix">
                                <h5 class="qodef-testimonial-author-name">
                                    <span><?php echo esc_html( $author ); ?></span>
                                </h5>
	                            <?php if ( ! empty( $position ) ) { ?>
	                                <div class="qodef-testimonial-author-job">
                                        <span><?php echo esc_html( $position ); ?></span>
	                                </div>
			                    <?php } ?>
                            </div>
                        <?php } ?>
			        </div>
				
				</div>

        <?php
            endwhile;
        else:
            echo esc_html__( 'Sorry, no posts matched your criteria.', 'wellexpo-core' );
        endif;

        wp_reset_postdata();

        ?>
    </div>
</div>